<?php

namespace App\Http\Controllers\Mobile;
use App\AdminModel\Archive;
use App\AdminModel\Brandarticle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeacrhController extends Controller
{
    public function SeacrhBrand(Request $request)
    {
        $pagelists=Brandarticle::where('brandname','like','%'.$request->keywords.'%')->paginate(30);
        $cnewstop=Archive::where('flags','like','%'.'c'.'%')->take(5)->latest()->get();
        $flashlingshibrands=Brandarticle::where('mid','1')->where('flags','like','%'.'c'.'%')->take(8)->orderBy('id','desc')->get();
        $topbrands=Brandarticle::where('mid','1')->take(10)->orderBy('click','desc')->get();
        $cnewslists=Archive::where('typeid',5)->where('flags','like','%c%')->take(10)->latest()->get();
        $latestbrands=Brandarticle::where('mid','1')->take(20)->latest()->get();
        $hotnewslists=Archive::where('flags','like','%a%')->take(2)->latest()->get();
        $anlinewslists=Archive::where('typeid',3)->take(10)->latest()->get();
        $abrandlists=Brandarticle::where('mid','1')->where('flags','like','%'.'a'.'%')->take(4)->orderBy('id','desc')->get();
        return view('mip.search_brand',compact('thistypeinfo','cnewstop','pagelists','cnewslists','flashlingshibrands','hotnewslists','abrandlists','topbrands','latestbrands','anlinewslists'));
    }
}
