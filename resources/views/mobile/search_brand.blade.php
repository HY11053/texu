@extends('mobile.mobile')
@section('title')品牌搜索页-中国休闲食品加盟网@stop
@section('keywords')品牌搜索页 @stop
@section('description')品牌搜索页@stop
@section('headlibs')
    <link href="/mobile/css/list.css" rel="stylesheet" type="text/css"/>
    <link href="/frontend/css/swiper.min.css" rel="stylesheet" type="text/css"/>
@stop
@section('main_content')
    <!--nav Start-->
    <div class="zhaodao">共找到<span class="red">{{$pagelists->count()}}</span>个相关项目</div>
    <!--nav End-->
    <!--品牌列表 Start-->
    <div class="pinpai_list1">
        <ul class="clearfix">
            @foreach($pagelists as $index=>$pagelist)
                <div class="brand-detail-list-all">
                    <div class="search-list-container  ">
                        <div class="title flex flex-align-center">
                  <span class="num-icon">
                        <span class="top">{{$index+1}}</span>
                    </span>
                            <div class="title-text">
                                <a href="{{str_replace('www.','m.',config('app.url'))}}/index.php/brand/{{$pagelist->id}}/" class="a "><span>{{$pagelist->brandname}}</span></a>
                            </div>
                            <a href="{{str_replace('www.','m.',config('app.url'))}}/index.php/brand/{{$pagelist->id}}/" class="brand-list-item-jump-tmall official"  title="{{$pagelist->brandname}}" data-bde-bind="1"><span class="active">品牌详情</span></a>
                        </div>
                        <div class="clear"></div>
                        <a href="{{str_replace('www.','m.',config('app.url'))}}/index.php/brand/{{$pagelist->id}}/">
                            <dl class="list flex flex-align-center">
                                <div class="dt flex flex-align-center">
                                <span>
                                    <img src="{{$pagelist->litpic}}" alt="{{$pagelist->brandname}}" class="autoWH" style="display: inline; margin: 1px 0px;" width="73" height="31">
                                </span>
                                </div>
                                <dd class="big-data">
                                    <div class="data">
                                        <div>投资金额：<span>{{$pagelist->brandpay}}</span></div>
                                        品牌名称：<span>{{$pagelist->brandname}}</span>
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

        </ul>
    </div>
    </div>
@stop