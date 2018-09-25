<?php

namespace App\Http\Controllers\Mip;

use App\AdminModel\Archive;
use App\AdminModel\Arctype;
use App\AdminModel\Brandarticle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaihangbangController extends Controller
{
    public function Paihangbang($path='')
    {
        if(!$path)
        {
            $thistypeinfo=Arctype::where('id',14)->first();
        }else{
            $thistypeinfo=Arctype::where('real_path',$path)->first();
        }
        if(!$thistypeinfo)
        {
            abort(404);
        }
        $typeids=Arctype::where('reid',14)->orWhere('topid',14)->pluck('id');
        $paihangbrands=Brandarticle::take(100)->when($path, function ($query) use ($path) {
        return $query->where('typeid',Arctype::where('real_path',$path)->value('id'));
        })->orderBy('click','desc')->get();
        if (!$paihangbrands->count())
        {
            $paihangbrands=Brandarticle::whereIn('typeid',$typeids)->take(100)->orderBy('click','desc')->get();
        }
        $brandnavs=Arctype::where('reid',14)->get();
        return view('mip.paihangbang',compact('thistypeinfo','paihangbrands','brandnavs'));
    }
}
