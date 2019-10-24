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
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\content_tbl;

use Alert;

class InterfaceController extends Controller
{
    public function listContent($category)
    {
        return content_tbl::select('content.*','category_content.category')->join('category_content','category_content.id',"=",'content.category_ctn_id')->where('category', $category)->where('content.is_active', "Y")->orderBy('content.created_at', 'desc')->take(3)->get();
    }

    public function home()
    {
        $museum = $this->listContent("museum");
        $palace = $this->listContent("palace");
        $nature = $this->listContent("nature");
        $news = admin_news_tbl::where('is_active',"Y")->take(3)->get();
        return view('FE.pages.home', compact('museum','palace', 'nature', 'news'));
    }

    public function museum($museum_name, $id)
    {
        $detail = content_tbl::join('content_detail', 'content_detail.content_id', "=", 'content.id')->where('is_active', "Y")->where('seo', $museum_name)->where('content.id', $id)->first();
        $collection = content_collection_tbl::select('id','name','banner','media_type','description_ind','description_en','place_id','media_type')->where('content_id', $id)->where('is_active',"Y")->orderBy('id','desc')->take(4)->get();
        $color_media = [
            'document'=>'primary',
            'audio'=>'success',
            'video'=>'danger',
            'image'=>'warning'
        ];
        $education = content_edu_tbl::select('id','name','banner','seo','description_ind','description_en','map_area_detail')->where('content_id', $id)->where('is_active',"Y")->where('is_publish',"Y")->orderBy('id','desc')->take(4)->get();
        $event = content_event_tbl::select('id','name','banner','seo','short_description_ind','short_description_en','price','start_date','map_area_detail')->where('content_id', $id)->where('close_registration','>=',date('Y-m-d H:i:s'))->where('is_active',"Y")->where('is_publish',"Y")->orderBy('id','desc')->take(4)->get();
        $gallery = content_gallery_tbl::select('photo','id')->where('content_id', $id)->orderBy('id','desc')->take(3)->get();
        return view('FE.pages.detail', compact('detail','collection','color_media','education','event','gallery'));
    }

    public function collection()
    {
        $data = content_collection_tbl::where('is_active',"Y")->get();
        $color_media = [
            'document'=>'primary',
            'audio'=>'success',
            'video'=>'danger',
            'image'=>'warning'
        ];
        return view('FE.pages.collection', compact('data','color_media'));
    }

    public function collectionDetail($id)
    {
        $detail = content_collection_tbl::where('id',$id)->where('is_active',"Y")->first();
        return view('FE.pages.collection-detail', compact('detail'));
    }

    public function vrTour()
    {
        $data = content_detail_tbl::join('content', 'content_detail.content_id', '=', 'content.id')
            ->select('name', 'photo', 'url_vr', 'place_id')
            ->where('url_vr', '!=', "")
            ->get();
        return view('FE.pages.vr', compact('data'));
    }

    public function aboutUs()
    {
        $data = admin_heritage_tbl::select('about_us_en','about_us_ind')->first();
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
        $data = admin_news_tbl::where('is_active',"Y")->get();
        return view('FE.pages.news', compact('data'));
    }

    public function newsDetail($id)
    {
        $data = admin_news_tbl::where('id',$id)->where('is_active',"Y")->first();
        $news = admin_news_tbl::where('is_active',"Y")->take(5)->get();
        return view('FE.pages.news-detail', compact('data','news'));
    }

    public function event()
    {
        $data = content_event_tbl::where('close_registration','>=',date('Y-m-d H:i:s'))
            ->where('is_active',"Y")
            ->where('is_publish',"Y")
            ->get();
        return view('FE.pages.event', compact('data'));
    }

    public function eventDetail($seo, $id)
    {
        $detail = content_event_tbl::where('seo',$seo)
            ->where('id',$id)
            ->where('close_registration','>=',date('Y-m-d H:i:s'))
            ->where('is_active',"Y")
            ->where('is_publish',"Y")
            ->first();
        return view('FE.pages.event-detail', compact('detail'));
    }

    public function educationProgram()
    {
        $data = content_edu_tbl::where('is_active',"Y")
            ->where('is_publish',"Y")
            ->get();
        return view('FE.pages.edu-program', compact('data'));
    }

    public function educationProgramDetail($seo, $id)
    {
        $detail = content_edu_tbl::where('seo',$seo)
            ->where('id',$id)
            ->where('is_active',"Y")
            ->where('is_publish',"Y")
            ->first();
        return view('FE.pages.edu-program-detail', compact('detail'));
    }
}
