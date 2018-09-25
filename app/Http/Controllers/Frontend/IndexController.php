<?php

namespace App\Http\Controllers\Frontend;

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
        //幻灯底部推荐
        $cbrands=Brandarticle::where('mid','1')->where('brandpsp','<>','')->where('flags','like','%c%')->take(4)->orderBy('click','desc')->get();
        //项目抢先看
        $hotbrandsearch=Brandarticle::where('mid','1')->latest()->take(5)->orderBy('click','desc')->get();
        $ctbrand=Brandarticle::where('id',1247)->first();
        //精品推荐左侧
        $otbrands=Brandarticle::where('mid','1')->where('flags','like','%h%')->take(6)->orderBy('id','desc')->get();
        //精品推荐右侧
        $cbrandrs=Brandarticle::where('mid','1')->whereIn('id',[1174,1099,67,46,1278,1193,8,427,244,1283])->orderBy('click','desc')->get();
        //新品上线
        $lbrand=Brandarticle::where('id',1283)->first();
        $latestbrandrs=Brandarticle::where('mid','1')->skip(5)->take(6)->orderBy('id','desc')->get();
        $latestbrands=Brandarticle::where('mid','1')->skip(11)->take(10)->orderBy('id','desc')->get();
        //项目大全
        $clingshibrands=Brandarticle::whereIn('typeid',[7])->where('flags','like','%'.'s'.'%')->take(3)->latest()->get();
        $flingshibrands=Brandarticle::whereIn('typeid',[7])->where('flags','like','%'.'f'.'%')->take(3)->latest()->get();
        $alingshibrands=Brandarticle::whereIn('typeid',[7])->take(6)->latest()->get();
        $chaohuobrands=Brandarticle::where('typeid',10)->where('flags','like','%'.'s'.'%')->take(3)->latest()->get();
        $fchaohuobrands=Brandarticle::where('typeid',10)->where('flags','like','%'.'f'.'%')->take(3)->latest()->get();
        $achaohuobrands=Brandarticle::where('typeid',10)->take(6)->latest()->get();
        $cjinkoubrands=Brandarticle::where('typeid',8)->where('flags','like','%'.'s'.'%')->take(3)->latest()->get();
        $fjinkoubrands=Brandarticle::where('typeid',8)->where('flags','like','%'.'f'.'%')->take(3)->latest()->get();
        $ajinkoubrands=Brandarticle::where('typeid',8)->take(6)->latest()->get();
        $cpenghuabrands=Brandarticle::where('typeid',11)->where('flags','like','%'.'s'.'%')->take(3)->latest()->get();
        $fpenghuabrands=Brandarticle::where('typeid',11)->where('flags','like','%'.'f'.'%')->take(3)->latest()->get();
        $apenghuabrands=Brandarticle::where('typeid',11)->take(6)->latest()->get();
        //项目排行榜
        $paihangbangs=Arctype::where('mid','1')->where('topid','<>',0)->take(12)->orderBy('id','asc')->get();
        //推荐品牌**品牌招商
        $cbrandlists=Brandarticle::where('mid','1')->where('flags','like','%a%')->orWhere('flags','like','%c%')->take(16)->orderBy('id','desc')->get();
        //品牌新闻推荐
        $cnews=Archive::latest()->where('typeid',5)->take(5)->orderBy('id','desc')->get();
        $zhinannews=Archive::latest()->where('typeid',1)->take(5)->orderBy('id','desc')->get();
        $jingyingnews=Archive::latest()->where('typeid',3)->take(5)->orderBy('id','desc')->get();
        $fnew=Archive::where('flags','like','%a%')->first();
        //友情链接
        $flinks=flink::latest()->orderBy('created_at','desc')->take(30)->get();
        $topnavs=Arctype::where('mid',1)->where('reid','<>',0)->take(6)->get();
        $topnav2s=Arctype::where('mid',1)->where('reid','<>',0)->skip(6)->take(6)->get();
        return view('frontend.index',compact('hotbrandsearch','flinks','cbrands','otbrands','cbrandrs','latestbrandrs','latestbrands','paihangbangs','cnews','cbrandlists',
        'canyinbrandlists','clingshibrands','flingshibrands','alingshibrands','chaohuobrands','fchaohuobrands','achaohuobrands','cjinkoubrands','fjinkoubrands','ajinkoubrands','cpenghuabrands',
        'fpenghuabrands','apenghuabrands','fnew','zhinannews','jingyingnews','topnavs','topnav2s','ctbrand','lbrand'));
    }

}
