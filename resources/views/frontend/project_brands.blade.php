@extends('frontend.frontend')
@section('title'){{$cid}}{{$tid}}{{$thistypeinfo->title}}-中国休闲食品加盟网@stop
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
    <!-- banner -->
    <!-- banner -->
    <div class="zong_banner mt20">
        <div class="clear banWrap wrap_mar">
            <ul class="banWrap_left pr fl">
                <img style="margin: 8px" src="/frontend/images/212.png" alt="" />
            </ul>
            <!-- banner 中间 -->
            <div class="jm-index clearfix">
                <div class="fl">
                    <div class="carousel carousel-bar1">
                        <div class="ovh swiper-container">
                            <ul class="ban-ul swiper-wrapper">
                                <a target="_blank" href="/brand/7/" class="item img-block swiper-slide"><img src="/frontend/images/9be32109eec0417d8e474437ed7fb0ea.jpg" alt="良品铺子"></a>
                                <a target="_blank" href="/brand/1062/" class="item img-block swiper-slide"><img src="/frontend/images/aebed277ee964c94bfeaa080c0e0c64a.jpg" alt="一扫光"></a>
                            </ul>
                        </div>
                        <div class="dot">
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                    <dl class="fl char-type char-type-h172 mt20">
                        @foreach($cbrands as $cbrand)
                            <dd class="magnify @if(!$loop->last) mr20 @endif">
                                <a target="_blank" href="/brand/{{$cbrand->id}}/" class="img-block magnify"><img src="{{$cbrand->indexpic}}" alt="" style="width:170px;height:170px">
                                    <div class="txt">
                                        <p class="f18">{{$cbrand->brandname}}</p>
                                        <p class="f14">{{str_limit($cbrand->brandpsp,22,'...')}}</p>
                                    </div>
                                </a>
                            </dd>
                        @endforeach
                    </dl>
                </div>
                <div class="fr xm-qingxian">
                    <h2>项目抢先看</h2>
                    <div class="carousel xm-carousel">
                        <div class="ovh swiper-container">
                            <ul class="ban-ul swiper-wrapper">
                                @foreach($hotbrandsearch as $hotbrandsearch)
                                    <li class="item swiper-slide">
                                        <div style="padding:0 20px">
                                            <img src="{{$hotbrandsearch->litpic}}" width="190" height="190">
                                            <p class="f16"> {{$hotbrandsearch->brandname}}</p>
                                            <p class="f14">
                                                投资金额：<b class="s-oe">{{$hotbrandsearch->brandpay}}</b>
                                            </p>
                                            <p class="h72">{{$hotbrandsearch->description}}</p>
                                            <div class="btn-bar">
                                                <a target="_blank" href="/brand/{{$hotbrandsearch->id}}/" class="btn btn-oe-line fl">详细考察</a><a href="javascript:void(0);" class="btn btn-oe fr btn-wyzx">我要咨询</a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="dot">
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div style="background-color: #f5f5f5;">
        <div class="w1200">
            <!--分类-->
            <div class="type-sift bg-ff box-shadow">
                <dl class="c">
                    <dt>项目分类：</dt>
                    <dd>
                        <a href="javascript:void(0);" data-id="" class="cur">不限</a>
                        @foreach($topbrandnavs as $topbrandnav)
                            <a @if(Request::getrequesturi() =='/'.$topbrandnav->real_path.'/')class=" active" @endif href="{{config('app.url')}}/{{$topbrandnav->real_path}}/"  title="{{$topbrandnav->typename}}">{{$topbrandnav->typename}}</a>
                        @endforeach
                    </dd>
                </dl>
                <dl class="t">
                    <dt>投资金额：</dt>
                    <dd>
                        <a href="javascript:void(0);" data-id="0" class="cur">不限</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_1_0_0/"  title="3万以下">3万以下</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_2_0_0/"  title="3万~5万">3万~5万</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_3_0_0/"  title="5万~8万">5万~8万</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_4_0_0/"  title="8万~12万">8万~12万</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_5_0_0/"  title="12万~15万">12万~15万</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_6_0_0/"  title="15万以上">15万以上</a>
                    </dd>
                </dl>
                <dl class="c">
                    <dt>所需面积：</dt>
                    <dd>
                        <a href="javascript:void(0);" data-id="" class="cur">不限</a>
                        <a  href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_0_1/">10平米以下</a>
                        <a  href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_0_2/">10-30平米</a>
                        <a  href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_0_3/">30-50平米</a>
                        <a  href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_0_4/">50-80平米</a>
                        <a  href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_0_5/">100平米以上</a>
                    </dd>
                </dl>
                <dl class="t">
                    <dt>所在地区：</dt>
                    <dd>
                        <a href="javascript:void(0);" data-id="0" class="cur">不限</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_2_0/"  title="北京">北京</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_3_0/"  title="安徽">安徽</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_4_0/"  title="福建">福建</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_5_0/"  title="甘肃">甘肃</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_6_0/"  title="广东">广东</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_7_0/"  title="广西">广西</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_8_0/"  title="贵州">贵州</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_9_0/"  title="海南">海南</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_10_0/"  title="河北">河北</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_11_0/"  title="河南">河南</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_12_0/"  title="黑龙江">黑龙江</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_13_0/"  title="湖北">湖北</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_14_0/"  title="湖南">湖南</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_15_0/"  title="吉林">吉林</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_16_0/"  title="江苏">江苏</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_17_0/"  title="江西">江西</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_18_0/"  title="辽宁">辽宁</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_19_0/"  title="内蒙古">内蒙古</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_20_0/"  title="宁夏">宁夏</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_21_0/"  title="青海">青海</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_22_0/"  title="山东">山东</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_23_0/"  title="山西">山西</a>
                        <a href="{{config('app.url')}}/{{$thistypeinfo->real_path}}_0_24_0/"  title="陕西">陕西</a>
                    </dd>
                </dl>
            </div>
            <!--分类end-->
            <div class="paixu-nav bg-ff box-shadow mt20">
                <h1>{{$thistypeinfo->typename}}项目列表</h1>
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
                            <a target="_blank" href="/brand/{{$pagelist->id}}/" class="img-block magnify"><img src="{{$pagelist->litpic}}" alt="{{$pagelist->brandname}}"></a>
                            <div class="f20">
                                <a target="_blank" href="/brand/{{$pagelist->id}}/">{{$pagelist->brandname}}</a>
                            </div>
                            <div class="info">
                                <span title="￥5.00-10.00万">投资金额：<b class="s-oe">{{$pagelist->brandpay}}</b></span><span title="{{$pagelist->acreage}}㎡">所需面积：<b class="s-oe">{{$pagelist->acreage}}㎡</b></span>
                            </div>
                            <p> 门店数量：<span class="s-c26">{{$pagelist->brandnum}}</span></p>
                            <p>加盟区域：<span class="s-c26">{{$pagelist->brandarea}}</span></p>
                            <p>主要产品：<span class="s-c26">{{$pagelist->brandmap}}</span></p>
                            <p style="height:48px">项目描述：<span>{{$pagelist->description}}</span></p>
                        </li>
                    @endforeach
                </ul>
                <div class="clear"></div>
                <div class=" page-bar tc mb20 ">&nbsp;&nbsp;&nbsp;
                    {!! preg_replace("#\/page/[\d]+\/page\/#",'/page/',str_replace('page=','page/',str_replace('?','/',preg_replace('/<a href=[\'\"]?([^\'\" ]+).*?>/','<a href="${1}/">',$pagelists->links())))) !!}
                </div>
            </div>

            <div class="w320 fr">
                <dl class="rank-bar mr30">
                    <dt><h3>{{$thistypeinfo->typename}}排行榜</h3><span class="fr">关注量</span></dt>
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
                        <h3 class="f22">{{$thistypeinfo->typename}}热门加盟项目</h3>
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
                <div class="bg-ff p20 mt20">
                    <div class="lh24">
                        <a target="_blank" href="/jmzx/chuanchuan/" class="fr s-c999">更多</a>
                        <h3 class="f22">加盟资讯</h3>
                    </div>
                    <ul class="tw-list tw-list-h84 mt15">
                        @foreach($cnewslists as $cnewslist)
                            <li><a target="_blank" href="/news/{{$cnewslist->id}}/" class="img-block magnify"><img  @if($cnewslist->litpic) src="{{$cnewslist->litpic}}" alt="{{$cnewslist->tite}}" @else src="/public/images/noimg.jpg" @endif /></a>
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
        <div style="clear: both;"></div>
    </div>
@stop
