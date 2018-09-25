@extends('frontend.frontend')
@section('title'){{$thisarticleinfos->title}}-{{$indexname}}@stop
@section('keywords'){{$thisarticleinfos->keywords}}@stop
@section('description'){{$thisarticleinfos->description}}@stop
@section('headlibs')
<meta name="Copyright" content="{{$indexname}}-{{config('app.url')}}"/>
    <meta name="author" content="{{$indexname}}" />
    <meta http-equiv="mobile-agent" content="format=wml; url={{str_replace('http://www.','http://m.',config('app.url'))}}/index.php{{str_replace('/index.php','',Request::getrequesturi())}}" />
    <meta http-equiv="mobile-agent" content="format=xhtml; url={{str_replace('http://www.','http://m.',config('app.url'))}}/index.php{{str_replace('/index.php','',Request::getrequesturi())}}" />
    <meta http-equiv="mobile-agent" content="format=html5; url={{str_replace('http://www.','http://m.',config('app.url'))}}/index.php{{str_replace('/index.php','',Request::getrequesturi())}}" />
    <link rel="alternate" media="only screen and(max-width: 640px)" href="{{str_replace('http://www.','http://m.',config('app.url'))}}/index.php{{str_replace('/index.php','',Request::getrequesturi())}}" >
    <link rel="canonical" href="{{config('app.url')}}{{str_replace('/index.php','',Request::getrequesturi())}}"/>
    <meta property="og:type" content="article"/>
    <meta property="article:published_time" content="{{$thisarticleinfos->created_at}}+08:00" />
    <meta property="og:image" content="{{config('app.url')}}{{str_replace(config('app.url'),'',$thisarticleinfos->litpic)}}"/>
    <meta property="article:author" content="{{$indexname}}" />
    <meta property="article:published_first" content="{{$indexname}}, {{config('app.url')}}{{str_replace('/index.php','',Request::getrequesturi())}}" />
    <link rel="stylesheet" href="/frontend/css/article.css" />
    <link rel="stylesheet" href="/frontend/css/index.css" />
    <link rel="stylesheet" href="/frontend/css/production.css" />
@stop
@section('main_content')
    <main style="background-color: #f5f5f5;">
        <div class="path"><p>当前位置：<a href="/" title="{{$indexname}}">{{$indexname}}</a>&gt;<a class="dq" href="{{config('app.url')}}/{{\App\AdminModel\Arctype::where('id',$thisarticleinfos->typeid)->value('real_path')}}/" title="{{\App\AdminModel\Arctype::where('id',$thisarticleinfos->typeid)->value('typename')}}">{{\App\AdminModel\Arctype::where('id',$thisarticleinfos->typeid)->value('typename')}}</a></p></div>
        <div class="w1200 clearfix">
            <div class="center_list clearfix">
                <div class="fl w870">
                    <div class="news_center">
                        <div class="ny_message">
                            <h1> {{$thisarticleinfos->productionname}}</h1>
                            <div class="ny_message-js">{{$thisarticleinfos->created_at}}&nbsp;|&nbsp; 来源：中国休闲食品加盟网 <span>浏览：{{$thisarticleinfos->click}}</span> </div>
                        </div>
                        <div class="body_tit clearfix">
                            <div class="clearfix">
                                <div class="chanpin_pic"><img src="{{$thisarticleinfos->litpic}}"></div>
                                <div class="chanpin_js1">
                                    <strong>产品信息</strong>
                                    <div class="chanpin_js2">
                                        <p>产品类型：<a href="{{config('app.url')}}/{{\App\AdminModel\Arctype::where('reid',$thisarticleinfos->arctype->reid)->value('real_path')}}/" title="{{\App\AdminModel\Arctype::where('reid',$thisarticleinfos->arctype->reid)->value('typename')}}">{{\App\AdminModel\Arctype::where('reid',$thisarticleinfos->arctype->reid)->value('typename')}}</a> &gt;
                                            <a href="{{config('app.url')}}/{{\App\AdminModel\Arctype::where('id',$thisarticleinfos->typeid)->value('real_path')}}/" title="{{\App\AdminModel\Arctype::where('id',$thisarticleinfos->typeid)->value('typename')}}">{{\App\AdminModel\Arctype::where('id',$thisarticleinfos->typeid)->value('typename')}}</a> &gt;
                                        </p>
                                        <p>发布时间：{{date('Y-m-d',strtotime($thisarticleinfos->created_at))}}</p>
                                        <p>供应商：@if(isset($thisbrandinfo->brandgroup)) {{$thisbrandinfo->brandgroup}} @endif </p>

                                        <p>品牌特色：{{$thisarticleinfos->pdintr}}</p>
                                    </div>
                                    <span><a href="#msg" class="cc_button1" title="">我要代理</a>@if(\App\AdminModel\Brandarticle::where('id',$thisarticleinfos->brandid)->value('id')) <a href="{{config('app.url')}}/brand/{{$thisarticleinfos->brandid}}/" class="cc_button2" title="">进入品牌网站</a> @endif</span>
                                </div>
                            </div>
                            <div class="shuoming">
                                <h2>产品说明</h2>
                                <div class="shuoming_content">
                         <span style="color:#333333;font-family:宋体;font-size:14px;line-height:28px;background-color:#FFFFFF;">
                            {!! $thisarticleinfos->body !!}
                        </span>

                                </div>
                            </div>
                            <div class="jieshao">
                                <h2 class="xmjs_bt">联系方式</h2>
                                <div class="content">
                                    <p>企业名称： @if(isset($thisbrandinfo->brandgroup)){{$thisbrandinfo->brandgroup}} @endif</p>
                                    <p>电 话： 400-8896-216</p>
                                    <p>传 真：400-8896-216</p>
                                    <p>地 址： @if(isset($thisbrandinfo->brandaddr)) {{$thisbrandinfo->brandaddr}}@endif</p>
                                </div>
                            </div>
                            <div class="chanpin_xg">
                                <h2 class="xmjs_bt">相关产品推荐</h2>
                                <div id="slide-box">

                                    <div class="slide-content" id="J_slide">
                                        <div class="wrap">
                                            <ul class="ks-switchable-content clearfix" style="margin-left: 0px;">
                                                @foreach($cproductions as $cproduction)
                                                    <li><span><a href="{{config('app.url')}}/item/{{$cproduction->id}}/" target="_blank"><img src="{{$cproduction->litpic}}" title="{{$cproduction->productionname}}"></a></span><strong><a href="{{config('app.url')}}/item/{{$cproduction->id}}/" target="_blank" title="{{$cproduction->productionname}}">{{$cproduction->productionname}}</a></strong></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="prev"><a id="J_next" href="javascript:void(0)"></a></div>
                                        <div class="next"><a id="J_prev" href="javascript:void(0)"></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="xg_news">
                            <div class="title"><strong> {{$thisarticleinfos->bdname}}加盟资讯</strong></div>
                            <div class="xw">
                                <ul class="clearfix">
                                    @foreach($productionlists as $productionlist)
                                        <li><a href="/item/{{$productionlist->id}}/" title="{{$productionlist->title}}">{{$productionlist->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fr w320">
                    @if(isset($thisarticleinfos->brandinfo->id))
                        <div class="pinpai-syr">
                            <i class="renzheng"></i>
                            <div class="img-block">
                                <img src="{{$thisarticleinfos->brandinfo->litpic}}" alt="" width="180" height="180">
                            </div>
                            <h5>{{$thisarticleinfos->brandinfo->brandgroup}}</h5>
                            <ul>
                                <li>品牌名称：<span>{{$thisarticleinfos->brandinfo->brandname}}</span></li>
                                <li>投资金额：<span>￥{{$thisarticleinfos->brandinfo->brandpay}}</span></li>
                                <li>所在地：<span>{{$thisarticleinfos->brandinfo->brandaddr}}</span></li>
                            </ul>
                            <div class="btn-bar mt15">
                                <a href="javascript:void(0);" class="btn-wyzx btn btn-oe fl">在线咨询</a><a href="#wyjm" class="btn bg-ff fr"><i class="iconfont icon-join"></i>我要加盟</a>
                            </div>
                        </div>
                    @endif
                    <dl class="rank-bar mr30" style="margin-top: 0px; margin-bottom: 20px;">
                        <dt>
                            <h3>综合排行</h3>
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
                    <div class="plr20-tb15 bg-ff box-shadow mt20" >
                        <div class="lh24" style="margin-bottom: 10px;">
                            <a target="_blank" href="/jm/?c=chuanchuan" class="fr s-c999">更多</a>
                            <h3 class="f22">最新品牌加盟新闻</h3>
                        </div>
                        <a target="_blank" href="/news/{{$cnew->id}}/" class="img-block magnify magnify-txt h213 mt15"><img src="{{$cnew->litpic}}" alt="{{$cnew->title}}">
                            <div class="img-bg">
                            </div>
                            <p>{{$cnew->title}} </p>
                        </a>
                        <ul class="tw-list tw-list-h80 mt5">
                            @foreach($latestnewslists as $latestnewslist)
                                <li><a target="_blank" href="/news/{{$latestnewslist->id}}/">{{$latestnewslist->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </main>
@stop