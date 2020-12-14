<?php

namespace App\Http\Controllers\FE;

use App\Model\admin_heritage_tbl;
use App\Model\admin_news_tbl;
use App\Model\admin_our_services_tbl;
use App\Model\content_collection_tbl;
use App\Model\content_detail_tbl;
use App\Model\content_edu_tbl;
use App\Model\content_event_tbl;
use App\Model\content_gallery_tbl;
use App\Model\form_question_tbl;
use App\Model\guest_book;
use App\Model\institutional;
use App\Model\visiting_order;
use App\Model\visitor_counting;
use App\User;
use App\UserVisitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\Model\content_tbl;

use Alert;
use Share;

class InterfaceController extends Controller
{
    public function email()
    {
        return view('email');
    }

    public function email_post(Request $request)
    {
        Mail::send('BE.email.form-question', [
            'judul_pertanyaan' => "Apa Itu iHeritage.id",
            'nama' => "Firliani Fauziah",
            'pertanyaan' => "secara konsep iHeritage.id itu akan mengarah ke apa?",
            'response' => "pengumpulan data pusaka yang ada di Indonesia",
        ], function ($m) use ($request){
            $m->from('info@iheritage.id', 'Info iHeritage ID');
            $m->to($request->email, "Raka Priyo")->subject('iHeritage.id');
        });
    }

    public function profileVisitor()
    {
        return view('FE.pages.profile');
    }

    public function profileVisitorPost(Request $request)
    {
        if($request->password)
        {
            if($request->password != $request->re_password)
            {
                if(App::isLocale('id'))
                {
                    Alert::error("Password yang anda masukan tidak sama");
                }else{
                    Alert::error("The password you entered is not the same");
                }
                return redirect()->back();
            }

            $update_field = [
              'name' => $request->name,
              'password' => Hash::make($request->password),
              'none_has_pass' => $request->password,
            ];

            $data = UserVisitor::find(auth('visitor')->user()->id);
            Mail::send('FE.email.password', [
                'name' => $request->name,
                'password' => $request->password
            ], function ($m) use ($request, $data){
                $m->from('info@iheritage.id', 'Info iHeritage ID');
                $m->to($data->email, $request->name)->subject('iHeritage.id - change password account visitor');
            });
        }else{
            $update_field = [
                'name' => $request->name
            ];
        }

        UserVisitor::where('id', auth('visitor')->user()->id)->update($update_field);
        if(App::isLocale('id'))
        {
            Alert::success("Profil berhasil diperbarui");
        }else{
            Alert::success("Profile updated successfully");
        }
        return redirect()->back();
    }

    public function resetPassword($role)
    {
        return view('BE.reset-password', compact('role'));
    }

    public function resetPasswordPost(Request $request, $role)
    {
        if($role == "visitor")
        {
            $data = UserVisitor::where('email', $request->email)->first();
        }else{
            $data = User::where('email', $request->email)->first();
        }

        if($data)
        {
            if($data->none_has_pass == null || $data->none_has_pass == "")
            {
                $password = rand(1000,9990);
                if($role == "visitor")
                {
                    UserVisitor::where('email', $request->email)->update(['password'=>Hash::make($password), 'none_has_pass'=>$password]);
                }else{
                    User::where('email', $request->email)->update(['password'=>Hash::make($password), 'none_has_pass'=>$password]);
                }
            }else{
                $password = $data->none_has_pass;
            }
            Mail::send('BE.email.reset-password', [
                'name' => $data->name,
                'password' => $password,
                'role' => $role
            ], function ($m) use ($request, $data){
                $m->from('info@iheritage.id', 'Info iHeritage ID');
                $m->to($data->email, $request->name)->subject('iHeritage.id - change password account visitor');
            });

            if(App::isLocale('id'))
            {
                Alert::success("Email berhasil terkirim");
            }else{
                Alert::success("Email successfully sent");
            }
        }else{
            if(App::isLocale('id'))
            {
                Alert::error("Email tidak terdaftar");
            }else{
                Alert::error("Email not registered");
            }
        }

        return redirect('/');
    }

    public function listContent($category, $limit)
    {
        return content_tbl::listContentCategory($category, $limit);
    }

    public function home()
    {
        $about = admin_heritage_tbl::select('title_en','title_ind','description_en','description_ind')->where('id',1)->first();
        $museum = $this->listContent("museum", 7);
        $library = $this->listContent("library", 4);
        $gallery = $this->listContent("gallery", 4);
        $archive = $this->listContent("archive", 4);
        $community = $this->listContent("community", 4);
        $temple = $this->listContent("temple", 4);
        $palace = $this->listContent("palace", 4);
        $nature = $this->listContent("nature", 4);
        $historical_building = $this->listContent("historical-building", 4);
        $personal = $this->listContent("personal-activities", 4);
        $site = $this->listContent("site", 4);
        $education_institution = $this->listContent("education-institution", 4);
        //$ebook = $this->listContent("ebook", 4);
        $news = admin_news_tbl::where('is_active',"Y")->orderBy('id', "DESC")->take(4)->get();
        return view('FE.pages.home', compact('about','museum','library','gallery','archive','community','temple','palace','nature','historical_building','personal','site','education_institution','news'));
    }

    public function search(Request $request)
    {
        if($request->input_search == "")
        {
            $query = content_tbl::select('content.*','content_detail.place_id', 'institutional.category')
                ->join('institutional','institutional.id',"=",'content.institutional_id')
                ->join('content_detail','content_detail.content_id',"=",'content.id')
                ->join('place','place.id',"=",'institutional.place_id');

            $query->when($request->category != "all", function ($q) use ($request) {
                return $q->where('institutional.category', $request->category);
            });

            $query->when($request->place_id != "all", function ($q) use ($request) {
                return $q->where('content_detail.place_id', $request->place_id);
            });

            $data = $query->where('content.is_active', "Y")
                ->orderBy('place.id', 'asc')
                ->get();
            $about = admin_heritage_tbl::select('title_en','title_ind','description_en','description_ind')->where('id',1)->first();
            $category = $request->category;
            return view('FE.pages.search', compact('data', 'about', 'category'));
        }else{
            $data_content = content_tbl::select('content.id', 'photo', 'name', 'name_en', 'seo', 'location', 'institutional.category')
                ->join('institutional','institutional.id',"=",'content.institutional_id')
                ->join('place','place.id',"=",'institutional.place_id')
                ->where('content.is_active', "Y")
                ->where(function ($query) use ($request){
                    $query->where('name', 'like', "%".$request->input_search."%")
                        ->orWhere('name_en', 'like', "%".$request->input_search."%")
                        ->orWhere('location', 'like', "%".$request->input_search."%")
                        ->orWhere('place_en', 'like', "%".$request->input_search."%")
                        ->orWhere('place_ind', 'like', "%".$request->input_search."%")
                    ;
                })
                ->orderBy('institutional.place_id', 'asc')
                ->get();

            if($request->input_search == "naskah")
            {
                $media_type = "document";
            }elseif($request->input_search == "manuscript"){
                $media_type = "document";
            }elseif($request->input_search == "pdf"){
                $media_type = "document";
            }elseif($request->input_search == "rekaman"){
                $media_type = "audio";
            }elseif($request->input_search == "voice recording"){
                $media_type = "audio";
            }elseif($request->input_search == "gambar"){
                $media_type = "image";
            }elseif($request->input_search == "lukisan"){
                $media_type = "image";
            }elseif($request->input_search == "paint"){
                $media_type = "image";
            }elseif($request->input_search == "object"){
                $media_type = "url";
            }elseif($request->input_search == "objek"){
                $media_type = "url";
            }elseif($request->input_search == "html5"){
                $media_type = "url";
            }else{
                $media_type = $request->input_search;
            }

            if($request->input_search == "naskah")
            {
                $topic = "collection_manuscript";
            }elseif($request->input_search == "senjata"){
                $topic = "collection_traditional_weapon";
            }elseif($request->input_search == "musik"){
                $topic = "collection_traditional_music";
            }elseif($request->input_search == "keramik"){
                $topic = "collection_ceramic";
            }elseif($request->input_search == "lukisan"){
                $topic = "collection_painting";
            }elseif($request->input_search == "rumah"){
                $topic = "collection_traditional_house";
            }elseif($request->input_search == "pertunjukan"){
                $topic = "collection_performing_arts";
            }elseif($request->input_search == "candi"){
                $topic = "collection_temple";
            }elseif($request->input_search == "patung"){
                $topic = "collection_statue";
            }elseif($request->input_search == "mahkota"){
                $topic = "collection_crown";
            }elseif($request->input_search == "perhiasan"){
                $topic = "collection_jewelry";
            }elseif($request->input_search == "kendaraan"){
                $topic = "collection_vehicle";
            }elseif($request->input_search == "sastra"){
                $topic = "collection_literature";
            }elseif($request->input_search == "kain"){
                $topic = "collection_traditional_cloth";
            }elseif($request->input_search == "perhiasan"){
                $topic = "collection_jewelry";
            }elseif($request->input_search == "film"){
                $topic = "collection_movie";
            }elseif($request->input_search == "prasasti"){
                $topic = "collection_inscription";
            }elseif($request->input_search == "wayang"){
                $topic = "collection_puppet";
            }elseif($request->input_search == "topeng"){
                $topic = "collection_mask";
            }elseif($request->input_search == "tarian"){
                $topic = "collection_dance";
            }elseif($request->input_search == "beladiri"){
                $topic = "collection_material_art";
            }elseif($request->input_search == "sejarah"){
                $topic = "collection_history";
            }elseif($request->input_search == "gedung bersejarah"){
                $topic = "collection_historic_building";
            }elseif($request->input_search == "bangunan bersejarah"){
                $topic = "collection_historical_building";
            }elseif($request->input_search == "situs"){
                $topic = "collection_site";
            }elseif($request->input_search == "kuliner"){
                $topic = "collection_culinary";
            }elseif($request->input_search == "alat tukar"){
                $topic = "collection_exchange";
            }elseif($request->input_search == "medali"){
                $topic = "collection_medal";
            }elseif($request->input_search == "navigasi"){
                $topic = "collection_navigation";
            }elseif($request->input_search == "cerita rakyat"){
                $topic = "collection_folklore";
            }elseif($request->input_search == "wisata alamt"){
                $topic = "collection_natural_place";
            }elseif($request->input_search == "relief"){
                $topic = "collection_relief";
            }elseif($request->input_search == "katalog"){
                $topic = "collection_catalog";
            }else{
                $topic = $request->input_search;
            }
            $data_collection = content_collection_tbl::select('content_collection.id', 'content_collection.name', 'content_collection.name_en', 'banner', 'media_type', 'topic', 'place_id')
                ->join('content','content.id',"=",'content_collection.content_id')
                ->join('place','place.id',"=",'content_collection.place_id')
                ->where('content_collection.is_active', "Y")
                ->where(function ($query) use ($request, $media_type, $topic){
                    $query->where('content_collection.name', 'like', "%".$request->input_search."%")
                        ->orWhere('media_type', 'like', "%".$media_type."%")
                        ->orWhere('content_collection.name_en', 'like', "%".$request->input_search."%")
                        ->orWhere('topic', 'like', "%".$topic."%")
                        ->orWhere('creator', 'like', "%".$request->input_search."%")
                        ->orWhere('created_year', 'like', "%".$request->input_search."%")
                        ->orWhere('lang', 'like', "%".$request->input_search."%")
                        ->orWhere('institution_owner', 'like', "%".$request->input_search."%")
                        ->orWhere('location', 'like', "%".$request->input_search."%")
                        ->orWhere('place_en', 'like', "%".$request->input_search."%")
                        ->orWhere('place_ind', 'like', "%".$request->input_search."%")
                    ;
                })
                ->orderBy('place_id', 'asc')
                ->get();

            $data_event = content_event_tbl::select('content_event.id', 'name', 'name_en', 'seo', 'start_date', 'banner', 'price', 'map_area_detail')
                ->join('place','place.id',"=",'content_event.place_id')
                ->where('is_active', "Y")
                ->where('is_publish', "Y")
                ->where(function ($query) use ($request){
                    $query->where('name', 'like', "%".$request->input_search."%")
                        ->orWhere('name_en', 'like', "%".$request->input_search."%")
                        ->orWhere('map_area_detail', 'like', "%".$request->input_search."%")
                        ->orWhere('place_en', 'like', "%".$request->input_search."%")
                        ->orWhere('place_ind', 'like', "%".$request->input_search."%")
                    ;
                })
                ->orderBy('place_id', 'asc')
                ->get();

            $data_education = content_edu_tbl::select('content_edu_program.id', 'name', 'name_en', 'seo', 'banner', 'description_ind', 'description_en', 'map_area_detail')
                ->join('place','place.id',"=",'content_edu_program.place_id')
                ->where('is_active', "Y")
                ->where('is_publish', "Y")
                ->where(function ($query) use ($request){
                    $query->where('name', 'like', "%".$request->input_search."%")
                        ->orWhere('name_en', 'like', "%".$request->input_search."%")
                        ->orWhere('map_area_detail', 'like', "%".$request->input_search."%")
                        ->orWhere('place_en', 'like', "%".$request->input_search."%")
                        ->orWhere('place_ind', 'like', "%".$request->input_search."%")
                    ;
                })
                ->orderBy('place_id', 'asc')
                ->get();

            return view('FE.pages.search-all', compact('data_content', 'data_collection', 'data_event', 'data_education'));
        }
    }

    public function searchInstantion($instantion)
    {
        $query = content_tbl::select('content.*','content_detail.place_id', 'institutional.category')
            ->join('institutional','institutional.id',"=",'content.institutional_id')
            ->join('content_detail','content_detail.content_id',"=",'content.id')
            ->join('place','place.id',"=",'institutional.place_id')
            ->where('institutional.category', $instantion);
            //->where('content.name', 'like', "%".$request->name."%");

        $data = $query->where('content.is_active', "Y")
            ->orderBy('place.id', 'asc')
            ->get();
        $about = admin_heritage_tbl::select('title_en','title_ind','description_en','description_ind')->where('id',1)->first();
        $category = $instantion;
        return view('FE.pages.search', compact('data','about', 'category'));
    }

    public function detailContent(Request $request, $seo, $id)
    {
        $detail = content_tbl::join('content_detail', 'content_detail.content_id', "=", 'content.id')->where('is_active', "Y")->where('seo', $seo)->where('content.id', $id)->first();
        $collection = content_collection_tbl::listCollection($id, 5);
        $education = content_edu_tbl::listEducation($id, 5);
        $event = content_event_tbl::listEvent($id, 5);
        $gallery = content_gallery_tbl::listGallery($id, 3);
        visitor_counting::simpan(institutional::getId($id), $_SERVER['REMOTE_ADDR'], "content", $request->fullUrl());
        return view('FE.pages.detail', compact('id', 'detail','collection','education','event','gallery'));
    }

    public function detailContentPost(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'institutional_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'visitor' => 'required',
            'information' => 'required',
            recaptchaFieldName() => recaptchaRuleName()
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $simpan = new visiting_order;
        $simpan->content_id = $id;
        $simpan->code_booking = date("Ymd").$id.$request->visitor;
        $simpan->institutional_name = $request->institutional_name;
        $simpan->email = $request->email;
        $simpan->phone = $request->phone;
        $simpan->visitor = $request->visitor;
        $simpan->date = $request->date;
        $simpan->information = $request->information;
        $simpan->save();

        Alert::success('visiting order successfully send');
        return redirect()->back();
    }

    public function visitingOrderPost(Request $request, $visiting_order, $id)
    {
        $validator = Validator::make($request->all(), [
            'institutional_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'visitor' => 'required',
            'information' => 'required',
            recaptchaFieldName() => recaptchaRuleName()
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $simpan = new visiting_order;
        if($visiting_order == "education")
        {
            $simpan->education_id = $id;
            $content_id = content_edu_tbl::select('content_id')->where('id', $id)->first()->content_id;
        }else{
            $simpan->event_id = $id;
            $content_id = content_event_tbl::select('content_id')->where('id', $id)->first()->content_id;
        }
        $simpan->content_id = $content_id;
        $simpan->code_booking = date("Ymd").$id.$request->visitor;
        $simpan->institutional_name = $request->institutional_name;
        $simpan->email = $request->email;
        $simpan->phone = $request->phone;
        $simpan->visitor = $request->visitor;
        $simpan->date = $request->date;
        $simpan->information = $request->information;
        $simpan->save();

        Alert::success('visiting order successfully send');
        return redirect()->back();
    }

    public function collection()
    {
        $data = content_collection_tbl::where('is_active',"Y")->paginate(9);
        return view('FE.pages.collection', compact('data'));
    }

    public function collectionSearch(Request $request)
    {
        $query = content_collection_tbl::join('content', 'content_collection.content_id', '=', 'content.id')
            ->select('content_collection.*', 'content.institutional_id');

        $query->when($request->media_type != "all", function ($q) use ($request) {
            return $q->where('media_type', $request->media_type);
        });

        $query->when($request->topic != "all", function ($q) use ($request) {
            return $q->where('topic', $request->topic);
        });

        $query->when($request->place_id != "all", function ($q) use ($request) {
            return $q->where('place_id', $request->place_id);
        });

        $query->when($request->institutional_id != "all", function ($q) use ($request) {
            return $q->where('institutional_id', $request->institutional_id);
        });

        $data = $query->where('content_collection.is_active',"Y")
            ->paginate(9);
        $data->appends([
            'media_type' => $request->media_type,
            'topic' => $request->topic,
            'place_id' => $request->place_id,
            'institutional_id' => $request->institutional_id
        ]);

        return view('FE.pages.collection-search', compact('data'));
    }

    public function collectionDetail(Request $request, $id)
    {
        $detail = content_collection_tbl::where('id',$id)->where('is_active',"Y")->first();
        $facebook = Share::load(route('collection-detail', ['id'=>$id]), "iHeritage.id - ".$detail->name)->facebook();
        $twitter = Share::load(route('collection-detail', ['id'=>$id]), "iHeritage.id - ".$detail->name)->twitter();
        visitor_counting::simpan(content_tbl::fieldContent($detail->content_id, "institutional_id"), $_SERVER['REMOTE_ADDR'], "collection", $request->fullUrl());
        return view('FE.pages.collection-detail', compact('id', 'detail', 'facebook', 'twitter'));
    }

    public function vrTour()
    {
        $data = content_detail_tbl::join('content', 'content_detail.content_id', '=', 'content.id')
            ->select('name', 'name_en', 'photo', 'url_vr', 'place_id', 'content_id')
            ->where('url_vr', '!=', "")
            ->get();
        return view('FE.pages.vr', compact('data'));
    }

    public function aboutUs()
    {
        $data = admin_heritage_tbl::select('about_us_en','about_us_ind','banner')->first();
        return view('FE.pages.about-us', compact('data'));
    }

    public function ourServices()
    {
        $data = admin_our_services_tbl::where('is_active',"Y")->get();
        return view('FE.pages.our-service', compact('data'));
    }

    public function ourServicesDetail($id)
    {
        $data = admin_our_services_tbl::where('id',$id)->where('is_active',"Y")->first();
        return view('FE.pages.our-service-detail', compact('data'));
    }

    public function formQuestion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'messages' => 'required',
            recaptchaFieldName() => recaptchaRuleName()
        ]);

        if ($validator->fails()) {
            return redirect('our-services')
                ->withErrors($validator)
                ->withInput();
        }

        $simpan = new form_question_tbl;
        $simpan->name = $request->name;
        $simpan->email = $request->email;
        $simpan->subject = $request->subject;
        $simpan->messages = $request->messages;
        $simpan->save();

        Alert::success('question sent successfully');
        return redirect()->back();
    }

    public function news()
    {
        $data = admin_news_tbl::where('is_active',"Y")->orderBy('id', "DESC")->paginate(10);
        return view('FE.pages.news', compact('data'));
    }

    public function newsDetail($id)
    {
        $data = admin_news_tbl::where('id',$id)->where('is_active',"Y")->first();
        $news = admin_news_tbl::where('is_active',"Y")->orderBy('id', "DESC")->take(5)->get();
        return view('FE.pages.news-detail', compact('data','news'));
    }

    public function event()
    {
        //$data = content_event_tbl::where('close_registration','>=',date('Y-m-d H:i:s'))
        $data = content_event_tbl::where('is_active',"Y")
            //->where('end_date', '>=', date("Y-m-d"))
            ->where('is_publish',"Y")
            ->orderBy('end_date', "DESC")
            ->paginate(9);
        return view('FE.pages.event', compact('data'));
    }

    public function eventSearch(Request $request)
    {
        $query = content_event_tbl::join('content', 'content_event.content_id', '=', 'content.id')
            ->select('content_event.*', 'content.institutional_id');

        $query->when($request->price != "all", function ($q) use ($request) {
            if($request->price == "free")
            {
                return $q->where('price', 0);
            }elseif($request->price == "paid"){
                return $q->where('price', "!=", 0);
            }
        });

        $query->when($request->duration != "duration", function ($q) use ($request) {
            if($request->duration == "current")
            {
                return $q->where('start_date', '<=', date("Y-m-d"))
                    ->where('end_date', '>=', date("Y-m-d"));
            }elseif($request->duration == "upcoming"){
                return $q->where('start_date', ">", date("Y-m-d"));
            }elseif($request->duration == "archive"){
                return $q->where('end_date', "<", date("Y-m-d"));
            }else{
                return $q;
            }
        });

        $query->when($request->place_id != "all", function ($q) use ($request) {
            return $q->where('place_id', $request->place_id);
        });

        $query->when($request->institutional_id != "all", function ($q) use ($request) {
            return $q->where('institutional_id', $request->institutional_id);
        });

        //$data = $query->where('close_registration','>=',date('Y-m-d H:i:s'))
        $data = $query
            ->where('content_event.is_active',"Y")
            ->where('is_publish',"Y")
            ->orderBy('end_date', "DESC")
            ->get();
        return view('FE.pages.event-search', compact('data'));
    }

    public function eventDetail(Request $request, $seo, $id)
    {
        $detail = content_event_tbl::where('seo',$seo)
            ->where('id',$id)
            //->where('close_registration','>=',date('Y-m-d H:i:s'))
            ->where('is_active',"Y")
            ->where('is_publish',"Y")
            ->first();
        visitor_counting::simpan(content_tbl::fieldContent($detail->content_id, "institutional_id"), $_SERVER['REMOTE_ADDR'], "event", $request->fullUrl());
        return view('FE.pages.event-detail', compact('detail','id'));
    }

    public function educationProgram()
    {
        $data = content_edu_tbl::where('is_active',"Y")
            ->where('is_publish',"Y")
            ->paginate(9);
        return view('FE.pages.edu-program', compact('data'));
    }

    public function educationProgramSearch(Request $request)
    {
       $query = content_edu_tbl::join('content', 'content_edu_program.content_id', '=', 'content.id')
            ->select('content_edu_program.*', 'content.institutional_id');

        $query->when($request->place_id != "all", function ($q) use ($request) {
            return $q->where('place_id', $request->place_id);
        });

        $query->when($request->institutional_id != "all", function ($q) use ($request) {
            return $q->where('institutional_id', $request->institutional_id);
        });

        $data = $query->where('content_edu_program.is_active',"Y")
            ->where('is_publish',"Y")
            ->get();
        return view('FE.pages.edu-program-search', compact('data'));
    }

    public function educationProgramDetail(Request $request, $seo, $id)
    {
        $detail = content_edu_tbl::where('seo',$seo)
            ->where('id',$id)
            ->where('is_active',"Y")
            ->where('is_publish',"Y")
            ->first();
        visitor_counting::simpan(content_tbl::fieldContent($detail->content_id, "institutional_id"), $_SERVER['REMOTE_ADDR'], "education", $request->fullUrl());
        return view('FE.pages.edu-program-detail', compact('detail','id'));
    }

    public function guestBook($museum_name)
    {
        return view('FE.pages.guestBook.'.$museum_name, compact('museum_name'));
    }

    public function guestBookSave(Request $request, $museum_name)
    {
        $guest_book = guest_book::where('ip', $_SERVER['REMOTE_ADDR'])->where('name', $request->name)->whereDate('created_at', date("Y-m-d"))->first();
        if(empty($guest_book))
        {
            $simpan = new guest_book;
            $simpan->name = $request->name;
            $simpan->institution = $request->institution;
            $simpan->museum = $museum_name;
            $simpan->ip = $_SERVER['REMOTE_ADDR'];
            $simpan->save();
        }
        return redirect()->back();
    }
}
