@extends('mobile.mobile')
@section('title'){{$thistypeinfo->title}}-中国休闲食品加盟网@stop
@section('keywords'){{$thistypeinfo->keywords}} @stop
@section('description'){{trim($thistypeinfo->description)}}@stop
@section('headlibs')
    <link href="/mobile/css/list.css" rel="stylesheet" type="text/css"/>
    <link href="/frontend/css/swiper.min.css" rel="stylesheet" type="text/css"/>
@stop
@section('main_content')
    @include('mobile.header')
    <!--menu End-->
    <div class="weizhi">
        <span><a href="/">首页</a>&nbsp;>&nbsp;{{$thistypeinfo->typename}}</span>
    </div>
    <div class="list_middle">
        <div class="text_centre">
            <ul>
                @foreach($pagelists as $pagelist)
                    <li>
                        <a href="/news/{{$pagelist->id}}/">
                            <div class="img_show"><img @if($pagelist->litpic) src="{{$pagelist->litpic}}" @else src="/images/012.jpg" @endif class="img_list" /></div>
                            <div class="cont">
                                <p class="tit_1">{{$pagelist->title}}</p>
                                <p class="info">{{str_limit($pagelist->description,144,'')}}</p>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="page">
        {!! str_replace('page=','page/',str_replace('?','/',preg_replace('/<a href=[\'\"]?([^\'\" ]+).*?>/','<a href="${1}/">',$pagelists->links()))) !!}
    </div>
    @include('mobile.liuyan')
    <div id="item7">
        <div class="item7box clearfix">
            <i></i>
            <div class="title">项目资讯</div>
            <div class="item7content">
                @foreach($latesenews as $latesenews)
                    <div class="item7list">
                    <a href="/news/{{$latesenews->id}}/">
                        <div class="left fl">
                            <div class="lefttitle">{{$latesenews->title}}</div>
                            <div class="text">
                                <div class="message">编辑：中国休闲食品加盟网</div>
                            </div>
                        </div>
                        <div class="right fr">
                            <img src="{{$latesenews->litpic}}">
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
            <div class="title">最新上线项目</div>
            <div class="item8content">
                @foreach($latestbrands as $index=>$latestbrand)
                    <div class="item8list @if(($index+1)%2==0) fl @else fr @endif">
                        <a href="/brand/{{$latestbrand->id}}/">
                            <img src="{{$latestbrand->litpic}}" alt="{{$latestbrand->brandname}}">
                            <div class="item8listcontent">
                                <div class="listtitle">{{$latestbrand->brandname}}</div>
                                <div class="listtext">
                                    <p>{{$latestbrand->brandgroup}}</p>
                                </div>
                                <div class="textleft fl">￥{{$latestbrand->brandpay}}
                                </div>
                                <div class="textright fr">
                                    {{date('m-d',strtotime($latestbrand->created_at))}}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop