@extends('mip.mip')
@section('title'){{$thisarticleinfos->brandname}}加盟详情-{{$indexname}}@stop
@section('keywords'){{$thisarticleinfos->keywords}}@stop
@section('description'){{trim($thisarticleinfos->description)}}@stop
@section('headlibs')
    <link href="{{str_replace('www.','mip.',config('app.url'))}}/mobile/css/miparticle.css" rel="stylesheet" type="text/css"/>
    <link href="{{str_replace('www.','mip.',config('app.url'))}}/mobile/css/mip_brand.css" rel="stylesheet" type="text/css"/>
    <link href="{{str_replace('www.','mip.',config('app.url'))}}/frontend/css/swiper.min.css" rel="stylesheet" type="text/css"/>
@stop
@section('main_content')
    <div class="weizhi">
	<span><a href="/">首页</a>&nbsp;>&nbsp;
        <a href="{{str_replace('www.','mip.',config('app.url'))}}/index.php/blist/all/">品牌招商</a>&nbsp;>&nbsp;
         <a href="{{str_replace('www.','mip.',config('app.url'))}}/index.php/{{\App\AdminModel\Arctype::where('id',$thisarticleinfos->typeid)->value('real_path')}}/">{{\App\AdminModel\Arctype::where('id',$thisarticleinfos->typeid)->value('typename')}}</a>&nbsp;>&nbsp;详情：
    </span>
    </div>
    @include('mip.brand_header')
    <div id="item3">
        <div class="item3box">
            <ul class="title clearfix">
                <li class="tl">品牌地址：<span>{{$thisarticleinfos->country}}</span></li>
                <li class="tc">门店数目：<span>{{$thisarticleinfos->brandnum}}</span></li>
                <li class="tr">{{$thisarticleinfos->click}}人关注</li>
            </ul>
            <div class="top clearfix">
                <div class="topleft fl">
                    <i></i>
                    <p>注：{{$thisarticleinfos->brandname}}投资金额可能包含了加盟费、保证金、品牌使用费等其他相关费用，因此投资总额根据实际情况计算，相关费用解释请参考页面
                    </p>
                </div>
                <div class="topright fr">
                    <div class="item3boxbtn btn1 js_popup">
                        <div class="item3boxbtn btn1 js_popup"><a href="#msg">立即咨询</a></div>
                    </div>
                </div>
            </div>
            <div class="bottom clearfix">
                <div class="bottomleft fl">
                </div>
                <div class="bottomright fr">
                    <a href="tel:400-8896-216">
                        <div class="item3boxbtn btn2">
                            拨打电话
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div id="item4">
        <div class="item4box">
            <div class="item4content">
                <div class="content">
                    <div class="jm_xq" id="b-info">
                        <div class="tb-first">
                            <div class="title" id="o-info_1">
                                <h2>{{$thisarticleinfos->brandname}}——加盟详情</h2>
                            </div>
                            <div class="jm_xq_con">
                                {!! $thisarticleinfos->jmxq_content !!}
                            </div>
                        </div>
                        <div class="zhuanzai">
                            <i></i>本篇文章为转载，转载目的在于传递更多信息，并不代表本网赞同其观点和对其真实性负责，因内容、版权和其它问题，请及时和本站取得联系，我们将第一时间删除内容！
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('mip.liuyan')
    <div id="item7">
        <div class="item7box clearfix">
            <i></i>
            <div class="title">项目资讯</div>
            <div class="item7content">
                @foreach($brandnews as $brandnew)
                    <div class="item7list">
                        <a href="/news/{{$brandnew->id}}/">
                            <div class="left fl">
                                <div class="lefttitle">{{$brandnew->title}}</div>
                                <div class="text">
                                    <div class="message">编辑：中国休闲食品加盟网</div>
                                    <div class="time">{{$brandnew->created_at}}</div>
                                </div>
                            </div>
                            <div class="right fr">
                                <mip-img src="{{$brandnew->litpic}}"></mip-img>
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
                            <mip-img src="{{$topbrand->litpic}}" alt="{{$topbrand->brandname}}"></mip-img>
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

@stop