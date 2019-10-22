<?php

namespace App\Http\Controllers\BE;

use App\Model\content_detail_tbl;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class VrController extends Controller
{
    public function vr_pages()
    {
        return view('BE.pages.vr.index');
    }

    public function vr_get()
    {
        $data = content_detail_tbl::select(['name','url_vr'])
            ->join('content', 'content.id', '=', 'content_detail.content_id')
            ->whereNotNull('url_vr')
            ->where('institutional_id', auth('admin')->user()->institutional_id);
        return Datatables::of($data)
            ->editColumn('url_vr', function ($data){
                return "<a href='".$data->url_vr."' target='_blank'>".$data->url_vr."</a>";
            })
            ->rawColumns(['url_vr'])
            ->make(true);
    }

}
