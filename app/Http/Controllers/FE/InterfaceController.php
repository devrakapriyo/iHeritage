<?php

namespace App\Http\Controllers\FE;

use App\Model\content_gallery_tbl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\content_tbl;

class InterfaceController extends Controller
{
    public function listContent($category)
    {
        return content_tbl::select('content.*','category_content.category')->join('category_content','category_content.id',"=",'content.category_ctn_id')->where('category', $category)->where('is_active', "Y")->orderBy('content.created_at', 'desc')->take(3)->get();
    }

    public function home()
    {
        $museum = $this->listContent("museum");
        $palace = $this->listContent("palace");
        $nature = $this->listContent("nature");
        return view('FE.pages.home', compact('museum','palace', 'nature'));
    }

    public function museum($museum_name, $id)
    {
        $detail = content_tbl::join('content_detail', 'content_detail.content_id', "=", 'content.id')->where('is_active', "Y")->where('seo', $museum_name)->where('content.id', $id)->first();
        $gallery = content_gallery_tbl::select('photo')->where('content_id', $id)->get();
        return view('FE.pages.detail', compact('detail','gallery'));
    }

    public function heritagePlace()
    {
        return view('FE.pages.heritage-place');
    }

    public function vrTour()
    {
        return view('FE.pages.vr');
    }
}
