<?php

namespace App\Http\Controllers\FE;

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
        $museum = content_tbl::select('id', 'name')->where('is_active', "Y")->where('seo', $museum_name)->where('id', $id)->first();
        return view('FE.pages.museum');
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
