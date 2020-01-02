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
use App\Model\visiting_order;
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

    public function listContent($category)
    {
        return content_tbl::select('content.*','category_content.category')->join('category_content','category_content.id',"=",'content.category_ctn_id')->where('category', $category)->where('content.is_active', "Y")->orderBy('content.created_at', 'desc')->take(6)->get();
    }

    public function home()
    {
        $museum = $this->listContent("museum");
        $palace = $this->listContent("palace");
        $nature = $this->listContent("nature");
        $news = admin_news_tbl::where('is_active',"Y")->orderBy('id', "DESC")->take(4)->get();
        return view('FE.pages.home', compact('museum','palace', 'nature', 'news'));
    }

    public function search(Request $request)
    {
        $query = content_tbl::select('content.*','content_detail.place_id', 'institutional.category')
            ->join('institutional','institutional.id',"=",'content.institutional_id')
            ->join('content_detail','content_detail.content_id',"=",'content.id');

        $query->when($request->category != "all", function ($q) use ($request) {
            return $q->where('institutional.category', $request->category);
        });

        $query->when($request->place_id != "all", function ($q) use ($request) {
            return $q->where('content_detail.place_id', $request->place_id);
        });

        $data = $query->where('content.is_active', "Y")
            ->orderBy('content.created_at', 'desc')
            ->get();
        return view('FE.pages.search', compact('data'));
    }

    public function searchInstantion($instantion)
    {
        $query = content_tbl::select('content.*','content_detail.place_id', 'institutional.category')
            ->join('institutional','institutional.id',"=",'content.institutional_id')
            ->join('content_detail','content_detail.content_id',"=",'content.id')
            ->where('institutional.category', $instantion);
            //->where('content.name', 'like', "%".$request->name."%");

        $data = $query->where('content.is_active', "Y")
            ->orderBy('content.created_at', 'desc')
            ->get();
        return view('FE.pages.search', compact('data'));
    }

    public function detailContent($seo, $id)
    {
        $detail = content_tbl::join('content_detail', 'content_detail.content_id', "=", 'content.id')->where('is_active', "Y")->where('seo', $seo)->where('content.id', $id)->first();
        $collection = content_collection_tbl::select('id','name','name_en','banner','media_type','description_ind','description_en','place_id','media_type','topic')->where('content_id', $id)->where('is_active',"Y")->orderBy('id','desc')->take(4)->get();
        $education = content_edu_tbl::select('id','name','name_en','banner','seo','description_ind','description_en','map_area_detail')->where('content_id', $id)->where('is_active',"Y")->where('is_publish',"Y")->orderBy('id','desc')->take(4)->get();
        $event = content_event_tbl::select('id','name','name_en','banner','seo','short_description_ind','short_description_en','price','start_date','map_area_detail')->where('content_id', $id)->where('is_active',"Y")->where('is_publish',"Y")->orderBy('id','desc')->take(4)->get();
        $gallery = content_gallery_tbl::select('photo','id','description_ind','description_en')->where('content_id', $id)->orderBy('id','desc')->take(3)->get();
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
            ->get();
        return view('FE.pages.collection-search', compact('data'));
    }

    public function collectionDetail($id)
    {
        $detail = content_collection_tbl::where('id',$id)->where('is_active',"Y")->first();
        $facebook = Share::load(route('collection-detail', ['id'=>$id]), "iHeritage.id - ".$detail->name)->facebook();
        $twitter = Share::load(route('collection-detail', ['id'=>$id]), "iHeritage.id - ".$detail->name)->twitter();
        return view('FE.pages.collection-detail', compact('detail', 'facebook', 'twitter'));
    }

    public function vrTour()
    {
        $data = content_detail_tbl::join('content', 'content_detail.content_id', '=', 'content.id')
            ->select('name', 'name_en', 'photo', 'url_vr', 'place_id')
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
            ->where('end_date', '>=', date("Y-m-d"))
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
            ->get();
        return view('FE.pages.event-search', compact('data'));
    }

    public function eventDetail($seo, $id)
    {
        $detail = content_event_tbl::where('seo',$seo)
            ->where('id',$id)
            //->where('close_registration','>=',date('Y-m-d H:i:s'))
            ->where('is_active',"Y")
            ->where('is_publish',"Y")
            ->first();
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

    public function educationProgramDetail($seo, $id)
    {
        $detail = content_edu_tbl::where('seo',$seo)
            ->where('id',$id)
            ->where('is_active',"Y")
            ->where('is_publish',"Y")
            ->first();
        return view('FE.pages.edu-program-detail', compact('detail','id'));
    }
}
