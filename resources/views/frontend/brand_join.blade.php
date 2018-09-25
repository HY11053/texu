@extends('frontend.frontend')
@section('title'){{$thisarticleinfos->brandname}}加盟详情-{{$indexname}}@stop
@section('keywords'){{$thisarticleinfos->keywords}}@stop
@section('description'){{trim($thisarticleinfos->description)}}@stop
@section('headlibs')
    <meta name="Copyright" content="{{$indexname}}-{{config('app.url')}}"/>
    <meta name="author" content="{{$indexname}}" />
    <meta http-equiv="mobile-agent" content="format=wml; url={{str_replace('https://www.','https://m.',config('app.url'))}}/index.php{{str_replace('/index.php','',Request::getrequesturi())}}" />
    <meta http-equiv="mobile-agent" content="format=xhtml; url={{str_replace('https://www.','https://m.',config('app.url'))}}/index.php{{str_replace('/index.php','',Request::getrequesturi())}}" />
    <meta http-equiv="mobile-agent" content="format=html5; url={{str_replace('https://www.','https://m.',config('app.url'))}}/index.php{{str_replace('/index.php','',Request::getrequesturi())}}" />
    <link rel="alternate" media="only screen and(max-width: 640px)" href="{{str_replace('https://www.','https://m.',config('app.url'))}}/index.php{{str_replace('/index.php','',Request::getrequesturi())}}" >
    <link rel="canonical" href="{{config('app.url')}}{{str_replace('/index.php','',Request::getrequesturi())}}"/>
    <meta property="og:type" content="article"/>
    <meta property="article:published_time" content="{{$thisarticleinfos->created_at}}+08:00" />
    <meta property="og:image" content="{{config('app.url')}}{{str_replace(config('app.url'),'',$thisarticleinfos->litpic)}}"/>
    <meta property="article:author" content="{{$indexname}}" />
    <meta property="article:published_first" content="{{$indexname}}, {{config('app.url')}}{{str_replace('/index.php','',Request::getrequesturi())}}" />
    <link rel="stylesheet" href="/frontend/css/index.css" />
    <link rel="stylesheet" href="/frontend/css/article.css" />
    <link rel="stylesheet" href="/frontend/css/brand_article.css" />
@stop
@section('main_content')
    <div style="background-color: #f5f5f5;">
        <div class="w1200">
            <div class="path"><p>当前位置：<a href="/" title="{{config('app.indexname')}}">{{config('app.indexname')}}</a>&gt; <a class="dq" href="{{config('app.url')}}/{{$thisarticleinfos->arctype->real_path}}/" title="{{$thisarticleinfos->arctype->typename}}">{{$thisarticleinfos->arctype->typename}}</a></p></div>
            <div class="clearfix">
             @include('frontend.brand_info')
                <div class="fl w870 brand_left">
                    <div class="clear"></div>
                    <div class="nv-stair">
                        <h2><a href="/brand/{{$thisarticleinfos->id}}/">项目介绍</a></h2>
                        <h2 @if(Request::getrequesturi() =='/bilist/'.$thisarticleinfos->id.'/') class="cur" @endif><a href="/bilist/{{$thisarticleinfos->id}}/">产品列表</a></h2>
                        <h2 @if(Request::getrequesturi() =='/brand/'.$thisarticleinfos->id.'/company.html') class="cur" @endif><a href="/brand/{{$thisarticleinfos->id}}/company.html">品牌介绍</a></h2>
                        <h2 @if(Request::getrequesturi() =='/brand/'.$thisarticleinfos->id.'/join.html') class="cur" @endif><a href="/brand/{{$thisarticleinfos->id}}/join.html">加盟详情</a></h2>
                        <h2 @if(Request::getrequesturi() =='/brand/'.$thisarticleinfos->id.'/profit.html') class="cur" @endif><a href="/brand/{{$thisarticleinfos->id}}/profit.html">利润分析</a></h2>
                        <h2 @if(Request::getrequesturi() =='/brand/'.$thisarticleinfos->id.'/news.html') class="cur" @endif><a href="/brand/{{$thisarticleinfos->id}}/news.html">品牌新闻</a></h2>
                    </div>
                    <div class="clearfix">
                        <div class="brand_content">
                            <div class="stair-wz">
                                {{$thisarticleinfos->brandname}}加盟详情
                            </div>
                            <div class="det-jies">
                                {!! $thisarticleinfos->jmxq_content !!}
                            </div>
                            @include('frontend.liuyan')
                            <div class="xg_news">
                                <div class="title"><strong> {{$thisarticleinfos->brandname}}加盟资讯</strong></div>
                                <div class="xw">
                                    <ul class="clearfix">
                                        @if(isset($brandnews))
                                            @foreach($brandnews as $brandnew)
                                                <li><a href="/news/{{$brandnew->id}}/" title="{{$brandnew->title}}">{{$brandnew->title}}</a></li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="fr w320">
                    <div class="plr20-tb15 mb20 bg-ff box-shadow ">
                        <div class="lh24">
                            <a target="_blank" href="/jm/?c=chuanchuan" class="fr s-c999">更多</a>
                            <h3 class="f22">{{$thisarticleinfos->arctype->typename}}热门加盟项目</h3>
                        </div>
                        <dl class="tu-list clearfix mt15" style="margin-top: 10px;">
                            @foreach($abrandlists as $index=>$abrandlist)
                                <dd class="magnify magnify-txt @if(($index+1)%2) mr10 @endif"><a target="_blank" href="/brand/{{$abrandlist->id}}/" class="img-block">
                                        <img src="{{$abrandlist->litpic}}" alt=" {{$abrandlist->brandname}}">
                                        <div class="img-bg"></div>
                                        <p>{{$abrandlist->brandname}}</p>
                                    </a>
                                </dd>
                            @endforeach
                            <div class="clear"></div>
                        </dl>
                    </div>

                    <dl class="rank-bar mr30" style="margin-top: 0px; margin-bottom: 20px;">
                        <dt>
                            <h3>{{$thisarticleinfos->arctype->typename}}排行榜</h3>
                            <span class="fr">关注量</span></dt>
                        @foreach($topbrands as $index=>$topbrand)
                            <dd @if($loop->first)  class="show" @endif>
                                <div class="item">
                                    <i class="icon-all @if($index<3) i-a3{{$index}}@else i-a33 @endif">{{$index+1}}</i>
                                    <div class="default">
                                        <span class="fr">{{$topbrand->brandnum}}</span><a target="_blank" href="/brand/{{$topbrand->id}}/" class="f16">{{$topbrand->brandname}}</a>
                                    </div>
                                    <div class="tips">
                                        <a target="_blank" href="/brand/{{$topbrand->id}}/"><img src="{{$topbrand->litpic}}" alt="{{$topbrand->brandname}}" class="fr"></a>
                                        <p> {{$topbrand->description}}</p>
                                    </div>
                                </div>
                            </dd>
                        @endforeach
                    </dl>

                    <div class="plr20-tb15 bg-ff box-shadow mt20">
                        <div class="lh24">
                            <a target="_blank" href="/jm/?c=chuanchuan" class="fr s-c999">更多</a>
                            <h3 class="f22">最新入驻品牌</h3>
                        </div>
                        <ul class="jm-xm-list mt5 mb10" style="margin-top: 10px;">
                            @foreach($latestbrands as $latestbrand)
                                <li><a target="_blank" href="/brand/{{$latestbrand->id}}/" class="img-block magnify"><img src="{{$latestbrand->litpic}}" alt=""></a>
                                    <p class="f16">
                                        <a target="_blank" href="/brand/{{$latestbrand->id}}/">{{$latestbrand->brandname}}</a>
                                    </p>
                                    <p class="f14">
                                        投资金额：<span class="s-oe">￥{{$latestbrand->brandpay}}</span>
                                    </p>
                                    <p class="f14">门店总数：<span class="s-oe">{{$latestbrand->brandnum}}</span>
                                    </p>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="plr20-tb15 bg-ff box-shadow mt20" >
                        <div class="lh24" style="margin-bottom: 10px;">
                            <a target="_blank" href="/jm/?c=chuanchuan" class="fr s-c999">更多</a>
                            <h3 class="f22">最新品牌加盟新闻</h3>
                        </div>
                        @foreach($latesnews as $latesnew)
                            @if($loop->first)
                                <a target="_blank" href="/news/{{$latesnew->id}}/" class="img-block magnify magnify-txt h213 mt15"><img src="{{$latesnew->litpic}}" alt="{{$latesnew->title}}">
                                    <div class="img-bg">
                                    </div>
                                    <p> {{$latesnew->title}}</p>
                                </a>
                            @endif
                        @endforeach
                        <ul class="tw-list tw-list-h80 mt5">
                            @foreach($latesnews as $latesnew)
                                <li><a target="_blank" href="/news/{{$latesnew->id}}/" class="img-block magnify"><img src="{{$latesnew->litpic}}" alt="{{$latesnew->title}}"></a>
                                    <p class="f16"><a target="_blank" href="/news/{{$latesnew->id}}/">{{$latesnew->title}}</a></p>
                                    <p class="f14 s-8c">{{$latesnew->created_at}}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <div class="clear"></div>
    </div>
@stop