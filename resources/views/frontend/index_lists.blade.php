@extends('frontend.frontend')
@section('title'){{$thistypeinfo->title}}-中国休闲食品加盟网@stop
@section('keywords'){{$thistypeinfo->keywords}} @stop
@section('description'){{trim($thistypeinfo->description)}}@stop
@section('headlibs')
    <meta name="Copyright" content="中国休闲食品加盟网-{{env('APP_URL')}}"/>
    <meta name="author" content="中国休闲食品加盟网" />
    <meta http-equiv="mobile-agent" content="format=wml; url={{str_replace('http://www.','http://m.',config('app.url'))}}/index.php{{str_replace('/index.php','',Request::getrequesturi())}}" />
    <meta http-equiv="mobile-agent" content="format=xhtml; url={{str_replace('http://www.','http://m.',config('app.url'))}}/index.php{{str_replace('/index.php','',Request::getrequesturi())}}" />
    <meta http-equiv="mobile-agent" content="format=html5; url={{str_replace('http://www.','http://m.',config('app.url'))}}/index.php{{str_replace('/index.php','',Request::getrequesturi())}}" />
    <link rel="alternate" media="only screen and(max-width: 640px)" href="{{str_replace('http://www.','http://m.',config('app.url'))}}/index.php{{str_replace('/index.php','',Request::getrequesturi())}}" >
    <link rel="canonical" href="{{config('app.url')}}{{str_replace('/index.php','',Request::getrequesturi())}}"/>
    <link href="/frontend/css/list.css" rel="stylesheet" type="text/css" />
    <link href="/frontend/css/index.css" rel="stylesheet" type="text/css" />
    <link href="/frontend/css/article.css" rel="stylesheet" type="text/css" />
@stop
@section('main_content')
    <!-- banner -->
    <div style="background-color: #f5f5f5;">
    <div class="w1200">
        <div class="path"><p>当前位置：<a href="/" title="{{config('app.indexname')}}">{{config('app.indexname')}}</a>&gt; <a class="dq" href="{{config('app.url')}}/{{$thistypeinfo->real_path}}/" title="{{$thistypeinfo->typename}}">{{$thistypeinfo->typename}}</a></p></div>
        <div class="zs-tj-bar bg-ff box-shadow">
            @if(isset($hotnew))
            <a target="_blank" href="/news/{{$hotnew->id}}/" class="img-block magnify magnify-txt w420 pr"><img src="{{$hotnew->litpic}}" alt="{{$hotnew->title}}">
                <div class="img-bg"> </div>
                <p>{{$hotnew->title}}</p>
            </a>
            @endif
            <div class="fr tj-wz">
                @if(isset($cnewtop))
                <dl>
                    <dt><a target="_blank" href="/news/{{$cnewtop->id}}/" class="s-oe">{{$cnewtop->title}}</a></dt>
                    <dd>{{$cnewtop->description}}</dd>
                </dl>
                @endif
                <ul>
                    @foreach($cnewtops as $cnewtop)
                    <li><a target="_blank" href="/news/{{$cnewtop->id}}/">{{$cnewtop->title}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="clearfix mt20">
            <div class="fl w870 bg-ff box-shadow tab-bar">
                <div class="clearfix">
                    <ul class="zs-tw-list tab-item ">
                        @foreach($pagelists as $pagelist)
                        <li><a target="_blank" href="/news/{{$pagelist->id}}/" class="img-block magnify"><img src="{{$pagelist->litpic}}" alt="{{$pagelist->title}}"></a>
                            <div class="f20">
                                <a target="_blank" href="/news/{{$pagelist->id}}/">{{$pagelist->title}}</a>
                            </div>
                            <p>{{$pagelist->description}}</p>
                            <div class="info">
                                <span><i class="iconfont icon-Time"></i>{{$pagelist->created_at}}</span><span><i class="iconfont icon-link"></i>{{config('app.indexname')}}</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class=" page-bar tc mb20 ">
                    {!! str_replace('page=','page/',str_replace('?','/',preg_replace('/<a href=[\'\"]?([^\'\" ]+).*?>/','<a href="${1}/">',$pagelists->links()))) !!}
                </div>
            </div>
            <div class="fr w320">
                <dl class="rank-bar mr30" style="margin: 0px 0 20px 0; ">
                    <dt><h3>品牌综合排行榜</h3><span class="fr">关注量</span></dt>
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
                <div class="plr20-tb15 bg-ff box-shadow ">
                    <div class="lh24">
                        <a target="_blank" href="/blist/all/" class="fr s-c999">更多</a>
                        <h3 class="f22">品牌专栏</h3>
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
                <div class="bg-ff p20">
                    <div class="lh24">
                        <a target="_blank" href="/blist/all/" class="fr s-c999">更多</a>
                        <h3 class="f22">最新入驻品牌</h3>
                    </div>
                    <ul class="join-project mt30">
                        @foreach($latestbrands as $latestbrand)
                            <li>
                                <a target="_blank" href="/brand/{{$latestbrand->id}}/" class="img-block magnify"><img src="{{$latestbrand->litpic}}" alt="{{$latestbrand->brandname}}"></a>
                                <p class="f16"><a target="_blank" href="/brand/{{$latestbrand->id}}/">{{$latestbrand->brandname}}</a></p>
                                <p class="f14">投资金额：<span class="s-oe">{{$latestbrand->brandpay}}</span></p>
                                <p class="f14">加盟门店数：<span class="s-oe">{{$latestbrand->brandnum}}</span></p>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="plr20-tb15 bg-ff box-shadow mt20" >
                    <div class="lh24" style="margin-bottom: 10px;">
                        <a target="_blank" href="/bnlist//" class="fr s-c999">更多</a>
                        <h3 class="f22">最新品牌资讯</h3>
                    </div>
                    <a target="_blank" href="/news/{{$cnew->id}}/" class="img-block magnify magnify-txt h213 mt15"><img src="{{$cnew->litpic}}" alt="{{$cnew->title}}">
                        <div class="img-bg"></div>
                        <p>{{$cnew->title}}</p>
                    </a>
                    <ul class="tw-list tw-list-h80 mt5">
                        @foreach($latesenews as $latesenew)
                        <li><a target="_blank" href="/news/{{$latesenew->id}}/" class="img-block magnify"><img  @if($latesenew->litpic) src="{{$latesenew->litpic}}" alt="{{$latesenew->tite}}" @else src="/public/images/noimg.jpg" @endif /></a>
                            <p class="f16">
                                <a target="_blank" href="/news/{{$latesenew->id}}/">{{$latesenew->title}}</a>
                            </p>
                            <p class="f14 s-8c">{{$latesenew->created_at}}
                            </p>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop
