<?php

namespace App\Http\Controllers\Mip;

use App\AdminModel\Archive;
use App\AdminModel\Arctype;
use App\AdminModel\Ask;
use App\AdminModel\Brandarticle;
use App\AdminModel\flink;
use App\AdminModel\Production;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    function Index()
    {
        $cbrands=Brandarticle::where('mid','1')->where('brandpsp','<>','')->where('flags','like','%c%')->take(4)->orderBy('click','desc')->get();
        $cbrand2s=Brandarticle::where('mid','1')->where('brandpsp','<>','')->where('flags','like','%c%')->skip(4)->take(4)->orderBy('click','desc')->get();
        $cbrand3s=Brandarticle::where('mid','1')->where('brandpsp','<>','')->where('flags','like','%c%')->skip(8)->take(4)->orderBy('click','desc')->get();
        $cbrand4s=Brandarticle::where('mid','1')->where('brandpsp','<>','')->where('flags','like','%c%')->skip(12)->take(4)->orderBy('click','desc')->get();
        $latestbrands=Brandarticle::where('mid','1')->latest()->take(4)->get();
        $latestbrand2s=Brandarticle::where('mid','1')->latest()->skip(4)->take(4)->get();
        $latestbrand3s=Brandarticle::where('mid','1')->latest()->skip(8)->take(4)->get();
        $latestbrand4s=Brandarticle::where('mid','1')->latest()->skip(12)->take(4)->get();
        $latestbrandnews=Archive::where('brandid','<>','')->where('typeid',5)->latest()->take(4)->get();
        $jmzhinannews=Archive::where('brandid','<>','')->where('typeid',1)->latest()->take(4)->get();
        $touzinews=Archive::where('brandid','<>','')->where('typeid',2)->latest()->take(4)->get();
        $jingyingnews=Archive::where('brandid','<>','')->where('typeid',4)->latest()->take(4)->get();
        $ctbrandnews=Archive::where('brandid','<>','')->where('flags','like','%c%')->take(4)->get();
        return view('mip.index',compact('cbrands','cbrand2s','cbrand3s','cbrand4s','latestbrands','latestbrand2s','latestbrand3s','latestbrand4s','latestbrandnews','jmzhinannews','touzinews','jingyingnews','ctbrandnews'));
    }

}
