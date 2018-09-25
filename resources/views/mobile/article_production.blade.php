@extends('mobile.mobile')
@section('title'){{$thisarticleinfos->title}}-{{$indexname}}@stop
@section('keywords'){{$thisarticleinfos->keywords}} @stop
@section('description'){{trim($thisarticleinfos->description)}}@stop
@section('headlibs')
    <link href="/mobile/css/article.css" rel="stylesheet" type="text/css"/>
    <link href="/frontend/css/swiper.min.css" rel="stylesheet" type="text/css"/>
@stop
@section('main_content')
    <div class="weizhi">
	<span><a href="/">首页</a>&nbsp;>&nbsp;
            <a href="{{str_replace('www.','m.',config('app.url'))}}/index.php/{{\App\AdminModel\Arctype::where('id',$thisarticleinfos->typeid)->value('real_path')}}/">{{\App\AdminModel\Arctype::where('id',$thisarticleinfos->typeid)->value('typename')}}</a>&nbsp;>&nbsp;
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
        <div class="a_content">
            <div class="body_tit clearfix">
                <div class="clearfix">
                    <div class="chanpin_pic"><img src="{{$thisarticleinfos->litpic}}"></div>
                    <div class="chanpin_js1">
                        <strong class="tit">产品信息</strong>
                        <div class="chanpin_js2">
                            <p>产品类型：<a href="/{{\App\AdminModel\Arctype::where('reid',$thisarticleinfos->arctype->reid)->value('real_path')}}/" title="{{\App\AdminModel\Arctype::where('reid',$thisarticleinfos->arctype->reid)->value('typename')}}">{{\App\AdminModel\Arctype::where('reid',$thisarticleinfos->arctype->reid)->value('typename')}}</a> &gt;
                                <a href="/{{\App\AdminModel\Arctype::where('id',$thisarticleinfos->typeid)->value('real_path')}}/" title="{{\App\AdminModel\Arctype::where('id',$thisarticleinfos->typeid)->value('typename')}}">{{\App\AdminModel\Arctype::where('id',$thisarticleinfos->typeid)->value('typename')}}</a> &gt;
                            </p>
                            <p>发布时间：{{date('Y-m-d',strtotime($thisarticleinfos->created_at))}}</p>
                            <p>供应商：@if(isset($thisbrandinfo->brandgroup)) {{$thisbrandinfo->brandgroup}} @endif   </p>

                            <p>{{$thisarticleinfos->pdintr}}</p>
                        </div>
                        <span><a href="#msg" class="cc_button1" title="">我要代理</a>@if(\App\AdminModel\Brandarticle::where('id',$thisarticleinfos->brandid)->value('id')) <a href="/brand/{{$thisarticleinfos->brandid}}/" class="cc_button2" title="">进入品牌网站</a> @endif</span>
                    </div>
                </div>
                <div class="shuoming">
                    <h2>产品说明</h2>
                    <div class="shuoming_content">
                        <span>{!! $thisarticleinfos->body !!}</span>

                    </div>
                </div>
                <div class="jieshao">
                    <h2 class="xmjs_bt">联系方式</h2>
                    <div class="content">
                        <p>企业名称： @if(isset($thisbrandinfo->brandgroup)){{$thisbrandinfo->brandgroup}} @endif</p>
                        <p>电 话： 400-8896-216</p>
                        <p>传 真： 400-8896-216</p>
                        <p>地 址： @if(isset($thisbrandinfo->brandaddr)) {{$thisbrandinfo->brandaddr}}@endif</p>
                    </div>
                </div>
                <div class="chanpin_xg">
                    <h2 class="xmjs_bt">相关产品推荐</h2>
                    <div id="slide-box">
                        <div class="slide-content" id="J_slide">
                            <div class="wrap swiper-container">
                                <ul class="swiper-wrapper" >
                                    @foreach($cproductions as $cproduction)
                                        <li class="swiper-slide"><span><a href="/item/{{$cproduction->id}}/" target="_self"><img src="{{$cproduction->litpic}}" title="{{$cproduction->productionname}}"></a></span></li>
                                    @endforeach
                                </ul>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @include('mobile.liuyan')
            <div id="item7">
                <div class="item7box clearfix">
                    <i></i>
                    <div class="title">项目资讯</div>
                    <div class="item7content">
                        @foreach($productionlists as $productionlist)
                            <div class="item7list">
                                <a href="/item/{{$productionlist->id}}/">
                                    <div class="left fl">
                                        <div class="lefttitle">{{$productionlist->title}}</div>
                                        <div class="text">
                                            <div class="message">来源：中国休闲食品加盟网</div>
                                            <div class="time">{{date('Y-m-d',strtotime($productionlist->created_at))}}</div>
                                        </div>
                                    </div>
                                    <div class="right fr">
                                        <img src="{{$productionlist->litpic}}">
                                    </div>
                                </a>
                            </div>
                            @endforeach
                    </div>
                </div>
            </div>


        <div id="item8">
            <div class="item8box clearfix">
                <i></i>
                <div class="title">猜你喜欢</div>
                <div class="item8content">
                    @foreach($topbrands as $index=>$topbrand)
                        <div class="item8list @if(($index+1)%2==0) fl @else fr @endif">
                            <a href="/brand/{{$topbrand->id}}/">
                                <img src="{{$topbrand->litpic}}" alt="{{$topbrand->brandname}}">
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