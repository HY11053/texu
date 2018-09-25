@extends('mip.mip')
@section('title'){{str_replace('加盟','',$thistypeinfo->typename)}}加盟店排行榜_性价比最高的{{str_replace('加盟','',$thistypeinfo->typename)}}加盟排行榜-中国休闲食品加盟网@stop
@section('keywords'){{str_replace('加盟','',$thistypeinfo->typename)}}加盟店排行榜,性价比最高的{{str_replace('加盟','',$thistypeinfo->typename)}}加盟排行榜,{{str_replace('加盟','',$thistypeinfo->typename)}}品牌排行@stop
@section('description')中国休闲食品加盟网为您全方位解读{{str_replace('加盟','',$thistypeinfo->typename)}}加盟品牌排行信息。分享{{str_replace('加盟','',$thistypeinfo->typename)}}门店信息，{{str_replace('加盟','',$thistypeinfo->typename)}}排行榜分类提供性价比最高{{str_replace('加盟','',$thistypeinfo->typename)}}品牌加盟排行榜信息，供你快速的选择适合自己的{{str_replace('加盟','',$thistypeinfo->typename)}}加盟品牌，让您加盟无忧，顺利开店。快速解决创业致富难题。@stop
@section('headlibs')
    <link href="{{str_replace('www.','mip.',config('app.url'))}}/mobile/css/miplist.css" rel="stylesheet" type="text/css"/>
    <link href="{{str_replace('www.','mip.',config('app.url'))}}/frontend/css/swiper.min.css" rel="stylesheet" type="text/css"/>
@stop
@section('main_content')
    @include('mip.header')
    <!--menu End-->
    <div class="weizhi">
        <span><a href="/">首页</a>&nbsp;>&nbsp; <a href="{{str_replace('www.','mip.',config('app.url'))}}/paihangbang/{{$thistypeinfo->real_path}}/">{{str_replace('加盟','',$thistypeinfo->typename)}}加盟店排行榜</a>&nbsp;>&nbsp;</span>
    </div>
    <div class="brand_list">
        @foreach($paihangbrands as $index=>$pagelist)
            <div class="brand-detail-list-all">
                <div class="search-list-container  ">
                    <div class="title flex flex-align-center">
                  <span class="num-icon">
                        <span class="top">{{$index+1}}</span>
                    </span>
                        <div class="title-text">
                            <a href="{{str_replace('www.','mip.',config('app.url'))}}/index.php/brand/{{$pagelist->id}}/" class="a "><span>{{$pagelist->brandname}}</span></a>
                        </div>
                        <a href="{{str_replace('www.','mip.',config('app.url'))}}/index.php/brand/{{$pagelist->id}}/" class="brand-list-item-jump-tmall official"  title="{{$pagelist->brandname}}" data-bde-bind="1"><span class="active">品牌详情</span></a>
                    </div>
                    <div class="clear"></div>
                    <a href="{{str_replace('www.','mip.',config('app.url'))}}/index.php/brand/{{$pagelist->id}}/">
                        <dl class="list flex flex-align-center">
                            <div class="dt flex flex-align-center">
                                <span>
                                    <mip-img src="{{$pagelist->litpic}}" alt="{{$pagelist->brandname}}" class="autoWH" ></mip-img>
                                </span>
                            </div>
                            <dd class="big-data">
                                <div class="data">
                                    <div>品牌名称：<span>{{$pagelist->brandname}}</span></div>
                                    投资金额：<span>{{$pagelist->brandtouzi}}</span>
                                </div>
                                <div class="data">
                                    <div>加盟人气：<span>{{$pagelist->click}}</span></div>
                                    所在地区：<span>{{$pagelist->brandaddr}}</span>
                                </div>
                            </dd>
                        </dl>
                        <div class="spe-msg">
                            {{$pagelist->description}}
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    @include('mip.liuyan')
@stop