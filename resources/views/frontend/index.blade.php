@extends('frontend.frontend')
@section('title'){{config('app.webname')}}@stop
@section('keywords'){{config('app.keywords')}}@stop
@section('keywords'){{config('app.description')}}@stop
@section('headlibs')
    <link rel="stylesheet" href="/frontend/css/index.css" />
@stop
@section('main_content')
    <!-- banner -->
    <div class="zong_banner mt20">
        <div class="clear banWrap wrap_mar">
            <ul class="banWrap_left pr fl">
                <li class="item"> <i class="zong_icon i21"></i><h3><a href="/blist/canyin_8_0_0_0/" title="餐饮加盟" target="_blank">餐饮加盟</a></h3></li>
                <li class="item"> <i class="zong_icon i22"></i><h3><a href="/blist/tianpin_9_0_0_0/" title="甜品加盟" target="_blank">甜品加盟</a></h3></li>
                <li class="item"> <i class="zong_icon i19"></i><h3><a href="/blist/tangguo_6_0_0_0/" title="糖果加盟" target="_blank">糖果加盟</a></h3></li>
                <li class="item"> <i class="zong_icon i22"></i><h3><a href="/blist/sort_10_0_0_0/" title="面馆加盟" target="_blank">面馆加盟</a></h3></li>
                <li class="item"> <i class="zong_icon i14"></i><h3><a href="/blist/lingshi_1_0_0_0" title="零食店加盟" target="_blank">零食店加盟</a></h3></li>
                <li class="item"> <i class="zong_icon i16"></i><h3><a href="/blist/douzhipin_3_0_0_0/" title="豆制品加盟" target="_blank">豆制品加盟</a></h3></li>
                <li class="item"> <i class="zong_icon i15"></i><h3><a href="/blist/jinkou_2_0_0_0/" title="进口食品加盟" target="_blank">进口食品加盟</a></h3></li>
                <li class="item"> <i class="zong_icon i17"></i><h3><a href="/blist/guoren_4_0_0_0/" title="甜点糕点加盟" target="_blank">坚果果仁加盟</a></h3></li>
                <li class="item"> <i class="zong_icon i18"></i><h3><a href="/blist/penghua_5_0_0_0/" title="膨化食品加盟" target="_blank">膨化食品加盟</a></h3></li>
                <li class="item"> <i class="zong_icon i20"></i><h3><a href="/blist/roushi_7_0_0_0/" title="肉制品加盟" target="_blank">肉制品加盟</a></h3></li>
                <li class="item"> <i class="zong_icon i15"></i><h3><a href="/blist/jinkou_2_0_0_0/" title="进口食品加盟" target="_blank">进口食品加盟</a></h3></li>
                <li class="item"> <i class="zong_icon i17"></i><h3><a href="/blist/guoren_4_0_0_0/" title="甜点糕点加盟" target="_blank">坚果果仁加盟</a></h3></li>
                <li class="item"> <i class="zong_icon i18"></i><h3><a href="/blist/penghua_5_0_0_0/" title="膨化食品加盟" target="_blank">膨化食品加盟</a></h3></li>
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
    <!-- main -->
    <div class="fine navhotbox">
        <div class="conta">
            <div class="clearfix">
                <div class="fine-left f-l">
                    <div class="fine-left-top clearfix">
                        <h4 class="f-l">精品推荐</h4>
                        <ul class="f-li clearfix f-r" data-id="pc_jptj" data-type="cmsadpos">
                            @foreach($topnavs as $topnav)
                            <li><a href="/{{$topnav->real_path}}/" target="_blank">{{$topnav->typename}}</a></li>
                            @endforeach
                            <li><a href="/blist/all/" target="_blank">更多+</a></li>
                        </ul>
                    </div>
                    <div class="fine-left-bottom clearfix">
                        <div class="fine-left-bottomL f-l">
                            <ul class="f-li clearfix" data-id="pc_a02_1" data-type="cmsadpos">
                                <li class="li-first" style="position: relative;"><a target="_blank" href="/brand/{{$ctbrand->id}}/"><img  width="260" height="242" alt="{{$ctbrand->brandname}}" src="{{$ctbrand->indexpic}}" style=""></a></li>
                                @foreach($otbrands as $otbrand)
                                        <li><a target="_blank" href="/brand/{{$otbrand->id}}/"><img  alt="{{$otbrand->brandname}}" src="{{$otbrand->litpic}}" style=""></a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="fine-left-bottomR f-r">
                            <ul class="f-li clearfix" data-id="pc_a03_1" data-type="cmsadpos">
                                @foreach($cbrandrs as $cbrandr)
                                    <li>
                                        <a  target="_blank" href="/brand/{{$cbrandr->id}}/"><img  width="174" height="140"  alt="" src="{{$cbrandr->indexpic}}" style=""></a>
                                        <p>品牌名称：<span>{{$cbrandr->brandname}}</span></p>
                                        <p>
                                            <span>￥</span><span class="sq">{{$cbrandr->brandpay}}</span><a target="_blank" href="/brand/{{$cbrandr->id}}/">了解详情</a>
                                        </p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="advment" data-id="pc_image1" data-type="cmsadpos">
                <a href="#" title="豪客来" data-id="5773" data-type="cmsad" target="_blank"> <img class="lazy" width="1200" height="110" alt="豪客来" src="/frontend/images/702711.jpg" style="">
                </a>
            </div>
        </div>
    </div>
    <!--新品上线-->
    <div class="fine navhotbox">
        <div class="conta">
            <div class="clearfix">
                <div class="fine-left f-l">
                    <div class="fine-left-top clearfix">
                        <h4 class="f-l">新品上线</h4>
                        <ul class="f-li clearfix f-r" data-id="pc_jptj" data-type="cmsadpos">
                            @foreach($topnav2s as $topnav2)
                                <li><a href="/{{$topnav2->real_path}}/" target="_blank">{{$topnav2->typename}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="fine-left-bottom clearfix">
                        <div class="fine-left-bottomL f-l">
                            <ul class="f-li clearfix" data-id="pc_a02_1" data-type="cmsadpos">
                                <li class="li-first" style="position: relative;"><a target="_blank" href="/brand/{{$lbrand->id}}/"><img  width="260" height="242" alt="{{$lbrand->brandname}}" src="{{$lbrand->litpic}}" style=""></a></li>
                                @foreach($latestbrandrs as $latestbrandr)
                                    <li><a target="_blank" href="/brand/{{$latestbrandr->id}}/"><img  alt="{{$latestbrandr->brandname}}" src="{{$latestbrandr->litpic}}" style=""></a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="fine-left-bottomR f-r">
                            <ul class="f-li clearfix" data-id="pc_a03_1" data-type="cmsadpos">
                                @foreach($latestbrands as $latestbrand)
                                    <li>
                                        <a  target="_blank" href="/brand/{{$latestbrand->id}}/"><img  width="174" height="140"  alt="" src="{{$latestbrand->litpic}}" style=""></a>
                                        <span class="index_brandinfo"><a href="/brand/1278/" target="_blank">{{$latestbrand->brandname}}</a></span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="advment" data-id="pc_image1" data-type="cmsadpos">
                <a href="#" title="豪客来" data-id="5773" data-type="cmsad" target="_blank"> <img class="lazy" width="1200" height="110" alt="豪客来" src="/frontend/images/702711.jpg" style=""></a>
            </div>
        </div>
    </div>

    <!--新品上线end-->
    <!--项目大全-->
    <div class="fine navhotbox">
        <div class="conta">
            <div class="fourth_floor">
                <div class="fine-left-top clearfix">
                    <h4 class="f-l">项目大全</h4>
                </div>
                <div class="fourth_floor_b">
                    <div class="fourth_floor_b_b">
                        <div class="fourth_floor_b_b_t">
                            <a class="x_canyin" href="/blist/lingshi_1/">零食加盟</a> <span class="fourth_floor_b_b_h">热门：
                                                   @foreach($clingshibrands as $clingshibrand) <a href="/brand/{{$clingshibrand->id}}/" target="_blank">{{$clingshibrand->brandname}}</a>@endforeach
                                      </span>
                        </div>
                        <div class="fourth_floor_b_b_pic">
                            <ul>
                                @foreach($flingshibrands as $flingshibrand)
                                <li>
                                    <a href="/brand/{{$flingshibrand->id}}/" target="_blank"><img src="{{$flingshibrand->litpic}}" alt="{{$flingshibrand->brandname}}"></a>
                                    <div class="fourth_floor_b_b_pic_title"><a href="/brand/{{$flingshibrand->id}}/" target="_blank">{{$flingshibrand->brandname}}</a></div>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="fourth_floor_b_b_link">
                            @foreach($alingshibrands as $alingshibrand)
                            <a href="/brand/{{$alingshibrand->id}}/" target="_blank">{{$alingshibrand->brandname}}</a> <span>|</span>
                            @endforeach
                            <a href="/blist/lingshi_1/" target="_blank">更多&gt;&gt;</a>
                        </div>
                    </div>

                    <div class="fourth_floor_b_b">
                        <div class="fourth_floor_b_b_t"> <a class="x_jiaoyu" href="/blist/guoren_4/">炒货店加盟</a>
                            <span class="fourth_floor_b_b_h">热门：
                                @foreach($chaohuobrands as $chaohuobrand)<a href="/brand/{{$chaohuobrand->id}}/" target="_blank">{{$chaohuobrand->brandname}}</a>@endforeach
                            </span>
                        </div>
                        <div class="fourth_floor_b_b_pic">
                            <ul>
                                @foreach($fchaohuobrands as $fchaohuobrand)
                                <li>
                                    <a href="/brand/{{$fchaohuobrand->id}}/" target="_blank"><img src="{{$fchaohuobrand->litpic}}" alt="{{$fchaohuobrand->brandname}}"></a>
                                    <div class="fourth_floor_b_b_pic_title"><a href="/brand/{{$fchaohuobrand->id}}/" target="_blank">{{$fchaohuobrand->brandname}}</a></div>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="fourth_floor_b_b_link">
                            @foreach($achaohuobrands as $achaohuobrand)
                             <a href="/brand/{{$achaohuobrand->id}}/" target="_blank">{{$achaohuobrand->brandname}}</a> <span>|</span>
                            @endforeach
                            <a href="/blist/guoren_4/" target="_blank">更多&gt;&gt;</a>
                        </div>
                    </div>

                    <div class="fourth_floor_b_b">
                        <div class="fourth_floor_b_b_t"> <a class="x_muying" href="/blist/jinkou_2/">进口零食</a>
                            <span class="fourth_floor_b_b_h">热门：
                                @foreach($cjinkoubrands as $cjinkoubrand)<a href="/brand/{{$cjinkoubrand->id}}" target="_blank">{{$cjinkoubrand->brandname}}</a>@endforeach
                            </span>
                        </div>
                        <div class="fourth_floor_b_b_pic">
                            <ul>
                                @foreach($fjinkoubrands as $fjinkoubrand)
                                <li>
                                    <a href="/brand/{{$fjinkoubrand->id}}/" target="_blank"><img src="{{$fjinkoubrand->litpic}}" alt="{{$fjinkoubrand->brandname}}"></a>
                                    <div class="fourth_floor_b_b_pic_title"><a href="/brand/{{$fjinkoubrand->id}}/" target="_blank">{{$fjinkoubrand->brandname}}</a></div>
                                </li>
                               @endforeach
                            </ul>
                        </div>

                        <div class="fourth_floor_b_b_link">
                            @foreach($ajinkoubrands as $ajinkoubrand)
                            <a href="/brand/{{$ajinkoubrand->id}}/" target="_blank">{{$ajinkoubrand->brandname}}</a> <span>|</span>
                            @endforeach
                            <a href="/blist/jinkou_2/" target="_blank">更多&gt;&gt;</a>
                        </div>
                    </div>

                    <div class="fourth_floor_b_b">
                        <div class="fourth_floor_b_b_t">
                            <a class="x_qiche" href="/blist/penghua_5/">膨化食品</a>
                            <span class="fourth_floor_b_b_h">热门：
                                @foreach($cpenghuabrands as $cpenghuabrand)<a href="/brand/{{$cpenghuabrand->id}}/" target="_blank">{{$cpenghuabrand->brandname}}</a>   @endforeach
                            </span>
                        </div>
                        <div class="fourth_floor_b_b_pic">
                            <ul>
                                @foreach($fpenghuabrands as $fpenghuabrand)
                                <li>
                                    <a href="/brand/{{$fpenghuabrand->id}}/" target="_blank"><img src="{{$fpenghuabrand->litpic}}" alt="{{$fpenghuabrand->brandname}}"></a>
                                    <div class="fourth_floor_b_b_pic_title"><a href="/brand/{{$fpenghuabrand->id}}/" target="_blank">{{$fpenghuabrand->brandname}}</a></div>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="fourth_floor_b_b_link">
                            @foreach($apenghuabrands as $apenghuabrand)
                            <a href="/brand/{{$apenghuabrand->id}}/" target="_blank">{{$apenghuabrand->brandname}}</a> <span>|</span>
                            @endforeach
                            <a href="/blist/penghua_5/" target="_blank">更多&gt;&gt;</a> </div>
                    </div>
                </div>
            </div>
            <div class="advment" data-id="pc_image1" data-type="cmsadpos">
                <a href="#" title="豪客来" data-id="5773" data-type="cmsad" target="_blank"> <img class="lazy" width="1200" height="110" alt="豪客来" src="/frontend/images/702711.jpg" style=""></a>
            </div>
        </div>
    </div>
    <!--排行榜-->


    <div class="fine navhotbox">
        <div class="conta">
            <div class="clearfix">
                <div class="fine-left f-l" style="height: 600px;">
                    <div class="fine-left-top clearfix">
                        <h4 class="f-l">品牌关注排行榜</h4>
                        <ul class="f-li clearfix f-r" data-id="pc_jptj" data-type="cmsadpos">
                            <li><a href="/pro/xc1/" target="_blank">小吃</a></li>
                            <li><a href="/pro/hg/" target="_blank">火锅</a></li>
                            <li><a href="/pro/hb/" target="_blank">汉堡</a></li>
                            <li><a href="/pro/sg/" target="_blank">砂锅</a></li>
                            <li><a href="/pro/mg1/" target="_blank">焖锅</a></li>
                            <li><a href="/pro/kc/" target="_blank">快餐</a></li>
                            <li><a href="/pro/ky/" target="_blank">烤鱼</a></li>
                            <li><a href="/pro/gc/" target="_blank">贡茶</a></li>
                            <li><a href="https://www.1616n.com/xmk/1_0_0.shtml" target="_blank">更多+</a></li>
                        </ul>
                    </div>
                    <ul class="crunchies-list mt10 clearfix">
                        @foreach($paihangbangs as $index=>$paihangbang)
                        <li @if(($index+1)%6) class="" @endif><a href="/paihangbang/{{$paihangbang->real_path}}/"><img src="{{$paihangbang->litpic}}" /><p>{{$paihangbang->typename}}排行榜</p></a></li>
                         @endforeach
                            <div style="clear: both;"></div>
                    </ul>
                </div>
            </div>
            <div class="advment" data-id="pc_image1" data-type="cmsadpos">
                <a href="#" title="豪客来" data-id="5773" data-type="cmsad" target="_blank"> <img class="lazy" width="1200" height="110" alt="豪客来" src="/frontend/images/702711.jpg" style=""></a>
            </div>
        </div>
    </div>

    <!--排行榜end-->

    <!--项目大全end-->
    <!--文档-->
    <div class="bg-ff mt20">
        <div class="w1200 clearfix mt20">
            <div class="fl w360 mr40">
                <div class="nav-h30 nav-h30-line-oe">
                    <h3 class="f22">品牌新闻</h3>
                    <a href="/bnlist/" class="fr s-c59">更多</a>
                </div>
                <ul class="tw-list tw-list-h72 mt10">
                    @foreach($cnews as $cnew)
                    <li><a href="/news/{{$cnew->id}}/" class="img-block magnify"><img src="{{$cnew->litpic}}" alt=""></a>
                        <p class="f16">
                            <a href="/news/{{$cnew->id}}/">{{$cnew->title}}</a>
                        </p>
                        <p class="f14 s-8c">
                        {{$cnew->description}}
                        </p>
                    </li>
                   @endforeach
                </ul>
            </div>
            <div class="fl w380 mr40">
                @if(isset($fnew))<a href="/news/{{$fnew->id}}/" class="img-block magnify magnify-txt h253 pr"><img src="{{$fnew->litpic}}" alt="{{$fnew->title}}"><div class="img-bg"></div><p>{{$fnew->title}}</p></a>@endif
                <ul class="gl-list mt40">
                    <li class="mr20 mb20"><a href="/bnlist/"><i class="icon-all i-a22"></i><h3>品牌新闻</h3></a></li>
                    <li class="mb20"><a href="/nlist/1/"><i class="icon-all i-a23"></i><h3>加盟指南</h3></a></li>
                    <li class="mr20"><a href="/nlist/2/"><i class="icon-all i-a24"></i> <h3>投资分析</h3></a></li>
                    <li><a href="/nlist/4/"><i class="icon-all i-a25"></i><h3>经营管理</h3></a></li>
                </ul>
            </div>
            <div class="fr w380">
                        <dl class="wz-list">
                            @foreach($zhinannews as $zhinannew)
                                @if($loop->first)
                                <dt>
                                    <p class="f24">
                                        <a href="/news/{{$zhinannew->id}}/" class="s-oe">{{$zhinannew->title}}</a>
                                    </p>
                                    <p class="f14 s-8c">{{$zhinannew->description}}<a href="/news/{{$zhinannew->id}}/" class="s-c59">详细&gt;&gt;</a>
                                    </p>
                                </dt>
                                @else
                                <dd><span class="fr s-8c ml20">{{date('Y-m-d',strtotime($zhinannew->created_at))}}</span><a href="/news/{{$zhinannew->id}}/">{{$zhinannew->title}}</a></dd>
                                @endif
                            @endforeach
                        </dl>
                <div class="nav-h30 nav-h30-line-oe mt30">
                    <h3 class="f22">创业大讲堂</h3>
                </div>
                <dl class="wz-list mt25">
                    @foreach($jingyingnews as $jingyingnew)
                    <dd><span class="fr s-8c ml20">{{date('Y-m-d',strtotime($jingyingnew->created_at))}}</span><a href="/news/{{$jingyingnew->id}}/">{{$jingyingnew->title}}</a></dd>
                    @endforeach
                </dl>
            </div>
            <div style="clear: both"></div>
        </div>

        <div class="brands ysbh">
            <div class="conta">
                <div class="clearfix">
                    <div class="content f-l">
                        <div class="fine-left-top clearfix">
                            <h4 class="f-l">友情链接</h4>
                        </div>
                        <div class="fine-left-bottom clearfix">
                            <ul class="yqlj_item">
                                @foreach($flinks as $flink)
                                <li><a href="{{$flink->wenurl}}" target="_blank"><i></i><b>{{$flink->webname}}</b></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div style="clear: both"></div>
            </div>
        </div>
    </div>
    <!--文档end-->

    <!-- /main -->
@stop
@section('footerlibs')

@stop