@extends('frontend.frontend')
@section('title'){{$thistypeinfo->title}}-中国休闲食品加盟网@stop
@section('keywords'){{$thistypeinfo->keywords}} @stop
@section('description'){{trim($thistypeinfo->description)}}@stop
@section('headlibs')
    <meta name="Copyright" content="中国休闲食品加盟网-{{env('APP_URL')}}"/>
    <meta name="author" content="中国休闲食品加盟网" />
    <meta http-equiv="mobile-agent" content="format=wml; url={{str_replace('https://www.','https://m.',config('app.url'))}}/index.php{{str_replace('/index.php','',Request::getrequesturi())}}" />
    <meta http-equiv="mobile-agent" content="format=xhtml; url={{str_replace('https://www.','https://m.',config('app.url'))}}/index.php{{str_replace('/index.php','',Request::getrequesturi())}}" />
    <meta http-equiv="mobile-agent" content="format=html5; url={{str_replace('https://www.','https://m.',config('app.url'))}}/index.php{{str_replace('/index.php','',Request::getrequesturi())}}" />
    <link rel="alternate" media="only screen and(max-width: 640px)" href="{{str_replace('https://www.','https://m.',config('app.url'))}}/index.php{{str_replace('/index.php','',Request::getrequesturi())}}" >
    <link rel="canonical" href="{{config('app.url')}}{{str_replace('/index.php','',Request::getrequesturi())}}"/>
    <link rel="stylesheet" href="/frontend/css/index.css" />
    <link href="/frontend/css/list.css" rel="stylesheet" type="text/css" />
@stop
@section('main_content')
    <div style="background-color: #f5f5f5;">
        <div class="w1200">
            <!--分类-->
            <div class="type-sift bg-ff box-shadow">
                <dl class="c">
                    <dt>项目分类：</dt>
                    <dd>
                        @foreach($topbrandnavs as $topbrandnav)
                            <a @if(Request::getrequesturi() =='/'.$topbrandnav->real_path.'/')class="cur" @endif href="{{config('app.url')}}/{{$topbrandnav->real_path}}/"  title="{{$topbrandnav->typename}}">{{$topbrandnav->typename}}</a>
                        @endforeach
                    </dd>
                </dl>
            </div>
            <!--分类end-->
            <div class="paixu-nav bg-ff box-shadow mt20">
                <h1>{{$thistypeinfo->typename}}产品批发列表</h1>
                <div class="px-btn o">
                    <span class="cur"><a href="javascript:void(0);" data-f="time" data-o="d" rel="nofollow">默认排序</a></span><span><a href="javascript:void(0);" class="iconfont" data-f="investment" data-o="a" rel="nofollow">投资金额</a></span><span><a href="javascript:void(0);" class="iconfont" data-f="shop" data-o="d" rel="nofollow">门店数</a></span>
                </div>
            </div>
            <div class="w870 fl">
                <ul class="xm-list-H224 clearfix" style="width: 870px; float:left; cursor: pointer">
                    @foreach($pagelists as $pagelist)
                        <li class="">
                            <div class="btn-duibi btn-addbyb" data-id="{{$pagelist->id}}">
                                <i class="iconfont icon-Contrast"></i>对比
                            </div>
                            <a target="_blank" href="/item/{{$pagelist->id}}/" class="img-block magnify"><img src="{{$pagelist->litpic}}" alt="{{$pagelist->productionname}}"></a>
                            <div class="f20">
                                <a target="_blank" href="/item/{{$pagelist->id}}/">{{$pagelist->productionname}}</a>
                            </div>
                            <div class="info">
                                <span>所属品牌：<b class="s-oe">@if(isset($pagelist->brandinfo->brandname)){{$pagelist->brandinfo->brandname}}@else 暂无@endif</b></span><span>产品类型：<b class="s-oe">@if(isset($pagelist->arctype->typename)){{$pagelist->arctype->typename}}@endif</b></span>
                            </div>
                            <p> 产品特色：<span class="s-c26">{{$pagelist->pdintr}}</span></p>
                            <p>产品供应商：<span class="s-c26">@if(isset($pagelist->brandinfo->brandgroup)){{$pagelist->brandinfo->brandgroup}}@else 暂无 @endif</span></p>
                            <p>公司主营产品：<span class="s-c26">@if(isset($pagelist->brandinfo->brandmap)){{$pagelist->brandinfo->brandmap}}@else 暂无@endif</span></p>
                            <p style="height:48px">产品详情：<span>{{$pagelist->description}}</span></p>
                        </li>
                    @endforeach
                </ul>
                <div class="clear"></div>
                <div class=" page-bar tc mb20 ">&nbsp;&nbsp;&nbsp;
                    {!! str_replace('page=','page/',str_replace('?','/',preg_replace('/<a href=[\'\"]?([^\'\" ]+).*?>/','<a href="${1}/">',$pagelists->links()))) !!}
                </div>
            </div>

            <div class="w320 fr">
                <dl class="rank-bar mr30">
                    <dt><h3>综合品牌排行榜</h3><span class="fr">关注量</span></dt>
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

                <div class="bg-ff p20">
                    <div class="lh24">
                        <a target="_blank" href="/jm/?c=chuanchuan" class="fr s-c999">更多</a>
                        <h3 class="f22">热门加盟项目</h3>
                    </div>
                    <ul class="join-project mt30">
                        @foreach($flashlingshibrands as $flashlingshibrand)
                            <li>
                                <a target="_blank" href="/brand/{{$flashlingshibrand->id}}/" class="img-block magnify"><img src="{{$flashlingshibrand->litpic}}" alt="{{$flashlingshibrand->brandname}}"></a>
                                <p class="f16"><a target="_blank" href="/brand/{{$flashlingshibrand->id}}/">{{$flashlingshibrand->brandname}}</a></p>
                                <p class="f14">投资金额：<span class="s-oe">{{$flashlingshibrand->brandpay}}</span></p>
                                <p class="f14">加盟门店数：<span class="s-oe">{{$flashlingshibrand->brandnum}}</span></p>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="bg-ff p20">
                    <div class="lh24">
                        <a target="_blank" href="/jm/?c=chuanchuan" class="fr s-c999">更多</a>
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
                <div class="bg-ff p20 mt20">
                    <div class="lh24">
                        <a target="_blank" href="/jmzx/chuanchuan/" class="fr s-c999">更多</a>
                        <h3 class="f22">加盟资讯</h3>
                    </div>
                    <ul class="tw-list tw-list-h84 mt15">
                        @foreach($cnewslists as $cnewslist)
                            <li><a target="_blank" href="/news/{{$cnewslist->id}}/" class="img-block magnify"><img src="{{$cnewslist->litpic}}" alt="{{$cnewslist->title}}"></a>
                                <p class="f16">
                                    <a target="_blank" href="/news/{{$cnewslist->id}}/">{{$cnewslist->title}}</a>
                                </p>
                                <p class="f14 s-8c">{{$cnewslist->description}}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
@stop
