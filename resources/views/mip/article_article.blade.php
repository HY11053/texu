@extends('mip.mip')
@section('title'){{$thisarticleinfos->title}}-{{$indexname}}@stop
@section('keywords'){{$thisarticleinfos->keywords}} @stop
@section('description'){{trim($thisarticleinfos->description)}}@stop
@section('headlibs')
    <link href="{{str_replace('www.','mip.',config('app.url'))}}/mobile/css/miparticle.css" rel="stylesheet" type="text/css"/>
    <link href="{{str_replace('www.','mip.',config('app.url'))}}/mobile/css/mip_brand.css" rel="stylesheet" type="text/css"/>
    <link href="{{str_replace('www.','mip.',config('app.url'))}}/frontend/css/swiper.min.css" rel="stylesheet" type="text/css"/>
@stop
@section('main_content')
<div class="weizhi">
	<span><a href="/">首页</a>&nbsp;>&nbsp;
            <a href="{{str_replace('www.','mip.',config('app.url'))}}/index.php/{{\App\AdminModel\Arctype::where('id',$thisarticleinfos->typeid)->value('real_path')}}/">{{\App\AdminModel\Arctype::where('id',$thisarticleinfos->typeid)->value('typename')}}</a>&nbsp;>&nbsp;
            正文：
    </span>
</div>
<div class="list_middle">
    <div class="a_content_brand">
        <div class="a_content">
            <h1>{{$thisarticleinfos->title}}</h1>
            <small>时间：{{$thisarticleinfos->created_at}}&nbsp;&nbsp;&nbsp;&nbsp;浏览量:{{$thisarticleinfos->click}}</small>
        </div>
    </div>
    @if(isset($thisBrandArticle))
        <div class="brandinfo">
            <div id="item1">
                <div class="item1box">
                    <div class="item1boxleft fl">
                        <div class="title"><h1><a href="/brand/{{$thisBrandArticle->id}}/">{{$thisBrandArticle->brandname}}</a></h1></div>
                        <div class="text">{{$thisBrandArticle->brandgroup}}</div>
                        <div class="time"><span>{{date('Y-m-d',strtotime($thisBrandArticle->created_at))}}</span></div>
                    </div>
                    <div class="item1boxmiddle fl">
                        <div class="top">{{$thisBrandArticle->brandpay}}</div>
                        <li class="tl">所属行业：<span>{{$thisBrandArticle->arctype->typename}}</span></li>
                        <li class="tl">经营范围：<span>{{$thisBrandArticle->brandmap}}</span></li>
                        <li class="tl">店铺面积：<span>{{\App\AdminModel\Acreagement::where('id',$thisBrandArticle->acreage)->value('type')}}㎡</span></li>
                    </div>
                </div>
            </div>
            <div id="focus" class="focus">
                <div class="swiper-container">
                    <mip-carousel autoplay  defer="5000" layout="responsive" width="730"  height="304">
                        @foreach($pics as $pic)
                            <li class="swiper-slide" ><mip-img src="{{$pic}}"></mip-img></li>
                        @endforeach
                    </mip-carousel>
                </div>
            </div>
            <div id="item3">
                <div class="item3box">
                    <ul class="title clearfix">
                        <li class="tl">品牌地址：<span>{{$thisBrandArticle->country}}</span></li>
                        <li class="tc">门店数目：<span>{{$thisBrandArticle->brandnum}}</span></li>
                        <li class="tr">{{$thisBrandArticle->click}}人关注</li>
                    </ul>
                    <div class="top clearfix">
                        <div class="topleft fl">
                            <i></i>
                            <p>注：{{$thisBrandArticle->brandname}}投资金额可能包含了加盟费、保证金、品牌使用费等其他相关费用，因此投资总额根据实际情况计算，相关费用解释请参考页面
                            </p>
                        </div>
                        <div class="topright fr">
                            <div class="item3boxbtn btn1 js_popup">
                                <a href="/brand/{{$thisBrandArticle->id}}/#msg">立即咨询</a>
                            </div>
                        </div>
                    </div>
                    <div class="bottom clearfix">
                        <div class="bottomleft fl">
                        </div>
                        <div class="bottomright fr">
                            <a href="tel:400-8896-216">
                                <div class="item3boxbtn btn2">
                                    拨打电话
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    @endif
     <div class="a_content">
         @php
             $content=str_replace('<img','<mip-img',preg_replace(["/style=.+?['|\"]/i","/width=.+?['|\"]/i","/height=.+?['|\"]/i"],'',$thisarticleinfos->body));
             preg_match_all("/<mip-img.*?[>]/",$content,$matches);
            if (!empty($matches))
            {
              foreach ($matches as $match)
              {
                  $content=str_replace($match,str_replace(['/>','>'],['>','></mip-img>'],$match),$content);
              }
            }
             echo $content;
         @endphp
    </div>
    @include('mip.liuyan')
    @if(isset($xg_search))
    <div id="item7">
        <div class="item7box clearfix">
            <i></i>
            <div class="title">项目资讯</div>
            <div class="item7content">
            @foreach($xg_search as $xg_article)
                <div class="item7list">
                    <a href="/news/{{$xg_article->id}}/">
                        <div class="left fl">
                            <div class="lefttitle">{{$xg_article->title}}</div>
                            <div class="text">
                                <div class="message">来源：中国休闲食品加盟网</div>
                                <div class="time">{{date('Y-m-d',strtotime($xg_article->created_at))}}</div>
                            </div>
                        </div>
                        <div class="right fr">
                            <mip-img src="{{$xg_article->litpic}}"></mip-img>
                        </div>
                    </a>
                </div>
            @endforeach

            </div>
        </div>
    </div>
    @endif

    <div id="item8">
        <div class="item8box clearfix">
            <i></i>
            <div class="title">猜你喜欢</div>
            <div class="item8content">
                @foreach($topbrands as $index=>$topbrand)
                    <div class="item8list @if(($index+1)%2==0) fl @else fr @endif">
                        <a href="/brand/{{$topbrand->id}}/">
                            <mip-img src="{{$topbrand->litpic}}" alt="{{$topbrand->brandname}}"></mip-img>
                            <div class="item8listcontent">
                                <div class="listtitle">{{$topbrand->brandname}}</div>
                                <div class="listtext">
                                    <p>{{$topbrand->brandgroup}}</p>
                                </div>
                                <div class="textleft fl">￥{{$topbrand->brandpay}}
                                </div>
                                <div class="textright fr">
                                    {{date('Y-m-d',strtotime($topbrand->created_at))}}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@stop