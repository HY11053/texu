<?php

namespace App\Http\Controllers\Frontend;

use App\AdminModel\Acreagement;
use App\AdminModel\Archive;
use App\AdminModel\Arctype;
use App\AdminModel\Area;
use App\AdminModel\Brandarticle;
use App\AdminModel\Production;
use Carbon\Carbon;
use App\Overwrite\Paginator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use PhpParser\Node\Expr\PreDec;

class ListNewsController extends Controller
{
    /**文档列表 通配 包含普通文档 品牌文档及产品文档
     * @param $path
     * @param int $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listNews(Request $request,$path,$page=0)
    {
        $typeid=Arctype::where('real_path',preg_replace('/\/page\/[0-9]+/','',$request->path()))->value('id')?:abort(404);
        $thistypeinfo=Arctype::where('id',$typeid)->first();
        $typeids=Arctype::where('reid',$typeid)->pluck('id');
        $cid=$path;
        //针对不同栏目类型返回不同类型页面
        //普通文档列表
        if(Arctype::where('id',$typeid)->value('mid')==0)
        {
            $pagelists=Archive::where('typeid',$typeid)->orderBy('id','desc')->paginate($perPage = 15, $columns = ['*'], $pageName = 'page', $page);
            $pagelists= Paginator::transfer(
                $cid,//传入分类id,
                $pagelists//传入原始分页器
            );
            $hotnew=Archive::where('typeid',$thistypeinfo->id)->where('flags','like','%h%')->latest()->first();
            $cnewtop=Archive::where('typeid',$typeid)->where('flags','like','%'.'c'.'%')->latest()->first();
            $cnewtops=Archive::where('typeid',$typeid)->where('flags','like','%'.'c'.'%')->take(10)->latest()->get();
            $topbrands=Brandarticle::where('mid','1')->take(10)->orderBy('click','desc')->get();
            $abrandlists=Brandarticle::where('mid','1')->where('flags','like','%'.'a'.'%')->take(4)->orderBy('id','desc')->get();
            $latestbrands=Brandarticle::where('mid','1')->take(5)->latest()->get();
            $cnew=Archive::where('typeid','<>',$thistypeinfo->id)->where('flags','like','%c%')->latest()->first();
            $latesenews=Archive::where('typeid','<>',$thistypeinfo->id)->take(7)->latest()->get();
            return view('frontend.index_lists',compact('thistypeinfo','pagelists','hotnew','cnewtop','cnew','cnewtops','topbrands','latestbrands','latesenews','abrandlists'));
        }elseif (Arctype::where('id',$typeid)->value('mid')==1)
        {
            if ($path=='blist/all')
            {
                $typeids=Arctype::where('topid',$typeid)->pluck('id');
                $cnewslists=Archive::where('flags','like','%c%')->take(7)->latest()->get();
            }else{
                $cnewslists=Archive::whereIn('brandid',Brandarticle::where('typeid',$typeid)->take(10)->latest()->pluck('id'))->take(10)->latest()->get();
            }
            $cid=preg_replace('/\/page\/[0-9]+/','',$path);
            $pagelists=Brandarticle::whereIn('typeid',$typeids)->orwhere('typeid',$typeid)->latest()->distinct()->paginate($perPage = 32, $columns = ['*'], $pageName = 'page', $page);
            $pagelists= Paginator::transfer(
                $cid,//传入分类id,
                $pagelists//传入原始分页器
            );
            $topbrandnavs=Arctype::where('mid',1)->where('reid','<>',0)->orderBy('id','asc')->get();
            $topbrands=Brandarticle::whereIn('typeid',$typeids)->orwhere('typeid',$typeid)->take(10)->orderBy('click','desc')->get();
            $flashlingshibrands=Brandarticle::where('mid','1')->where('flags','like','%'.'h'.'%')->take(7)->orderBy('id','desc')->get();
            $cbrands=Brandarticle::where('mid','1')->where('brandpsp','<>','')->where('flags','like','%c%')->take(4)->orderBy('click','desc')->get();
            $hotbrandsearch=Brandarticle::where('mid','1')->latest()->take(5)->orderBy('click','desc')->get();
            return view('frontend.brands',compact('thistypeinfo','topbrandnavs','pagelists','topbrands','flashlingshibrands','cnewslists','cbrands','hotbrandsearch'));
        }else{
            $cid=preg_replace('/\/page\/[0-9]+/','',$path);
            $pagelists=Production::whereIn('typeid',$typeids)->orwhere('typeid',$typeid)->latest()->paginate($perPage = 28, $columns = ['*'], $pageName = 'page', $page);
            $pagelists= Paginator::transfer(
                $cid,//传入分类id,
                $pagelists//传入原始分页器
            );
            $topbrandnavs=Arctype::where('mid',2)->get();
            $flashlingshibrands=Brandarticle::where('mid','1')->where('flags','like','%'.'c'.'%')->take(9)->orderBy('id','desc')->get();
            $topbrands=Brandarticle::take(10)->orderBy('click','desc')->get();
            $cnewslists=Archive::where('flags','like','%c%')->take(10)->latest()->get();
            $latestbrands=Brandarticle::where('mid','1')->take(20)->latest()->get();
            return view('frontend.productions',compact('thistypeinfo','topbrandnavs','pagelists','flashlingshibrands','topbrands','cnewslists','latestbrands'));

        }

    }

    /**品牌分类筛选
     * @param $path
     * @param $tid
     * @param $cid
     * @param $zid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function projectBrandLists($path,$tid=0,$cid=0,$zid=0,$page=0)
    {
        //栏目查找
        if ($path =='blist/all_0')
        {
            $path='blist/all';
            $thistypeinfo=Arctype::where('real_path',$path)->first();
            $topbrands=Brandarticle::where('mid','1')->take(10)->orderBy('click','desc')->get();
        }else{
            $thistypeinfo=Arctype::where('real_path',$path)->first();
            if (empty($thistypeinfo))
            {
                abort(404);
            }
            $topbrands=Brandarticle::where('typeid',$thistypeinfo->id)->take(10)->orderBy('click','desc')->get();
            if (!$topbrands->count())
            {
                $topbrands=Brandarticle::take(10)->orderBy('click','desc')->get();
            }
        }
        //对应栏目品牌相关文档调用
        if (Brandarticle::where('typeid',$thistypeinfo->id)->take(10)->latest()->pluck('id'))
        {
            $cnewslists=Archive::whereIn('brandid',Brandarticle::where('typeid',$thistypeinfo->id)->take(10)->latest()->pluck('id'))->take(10)->latest()->get();
            if (!$cnewslists->count())
            {
                $cnewslists=Archive::where('flags','like','%c%')->take(10)->latest()->get();
            }
        }else{
            $cnewslists=Archive::where('flags','like','%c%')->take(10)->latest()->get();
        }
        $pagelists=Brandarticle::when($tid, function ($query) use ($tid) {
            switch ($tid)
            {
                case 1:
                    $tid='3万以下';
                    break;
                case 2:
                    $tid='3万~5万';
                    break;
                case 3:
                    $tid='5万~8万';
                    break;
                case 4:
                    $tid='8万~12万';
                    break;
                case 5:
                    $tid='12万~15万';
                    break;
                case 6:
                    $tid='15万以上';
                    break;
            }
            return $query->where('brandpay',$tid);
        })->when($cid, function ($query) use ($cid) {
            return $query->whereIn('country',Area::where('parentid',$cid)->pluck('regionname'));
        })->when($zid, function ($query) use ($zid) {
            return $query->where('acreage',$zid);
        })->when($path=='blist/all', function ($query) use ($path) {
            return $query->whereIn('typeid',Arctype::where('topid',6)->pluck('id'));
        }, function ($query) use($thistypeinfo) {
            return $query->where('typeid',$thistypeinfo->id);
        })->paginate($perPage = 32, $columns = ['*'], $pageName = 'page', $page);
        $topbrandnavs=Arctype::where('reid',6)->take(10)->get();
        $flashlingshibrands=Brandarticle::where('mid','1')->where('flags','like','%'.'c'.'%')->take(8)->orderBy('id','desc')->get();
        $cbrands=Brandarticle::where('mid','1')->where('brandpsp','<>','')->where('flags','like','%c%')->take(4)->orderBy('click','desc')->get();
        $hotbrandsearch=Brandarticle::where('mid','1')->latest()->take(5)->orderBy('click','desc')->get();
        //此处为生成的标题传值
        switch ($tid)
        {
            case 1:
                $tid='3万以下';
                break;
            case 2:
                $tid='3万~5万';
                break;
            case 3:
                $tid='5万~8万';
                break;
            case 4:
                $tid='8万~12万';
                break;
            case 5:
                $tid='12万~15万';
                break;
            case 6:
                $tid='15万以上';
                break;
            default:
                $tid=null;
        }
        if ($cid)
        {
            $cid=Area::where('id',$cid)->value('regionname');
        }else{
            $cid=null;
        }
        if ($zid)
        {
            $zid=Acreagement::where('id',$zid)->value('type');
        }else{
            $zid=null;
        }
        return view('frontend.project_brands',compact('thistypeinfo','flashlingshibrands','topbrandnavs','pagelists','topbrands','tid','cid','cnewslists','zid','cbrands','hotbrandsearch'));
    }


}
