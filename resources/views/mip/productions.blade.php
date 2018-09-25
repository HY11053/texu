@extends('mip.mip')
@section('title'){{$thistypeinfo->title}}-中国休闲食品加盟网@stop
@section('keywords'){{$thistypeinfo->keywords}} @stop
@section('description'){{trim($thistypeinfo->description)}}@stop
@section('headlibs')
    <link href="{{str_replace('www.','mip.',config('app.url'))}}/mobile/css/miplist.css" rel="stylesheet" type="text/css"/>
    <link href="{{str_replace('www.','mip.',config('app.url'))}}/frontend/css/swiper.min.css" rel="stylesheet" type="text/css"/>
@stop
@section('main_content')
    @include('mip.header')
    <!--menu End-->
    <div class="weizhi">
        <span><a href="/">首页</a>&nbsp;>&nbsp; <a href="{{str_replace('www.','mip.',config('app.url'))}}/index.php/{{$thistypeinfo->real_path}}/">{{$thistypeinfo->typename}}</a>&nbsp;>&nbsp;列表：</span>
    </div>
    <div class="brand_list">
        @foreach($pagelists as $index=>$pagelist)
            <div class="brand-detail-list-all">
                <div class="search-list-container  ">
                    <div class="title flex flex-align-center">
                  <span class="num-icon">
                        <span class="top">{{$index+1}}</span>
                    </span>
                        <div class="title-text">
                            <a href="{{str_replace('www.','mip.',config('app.url'))}}/index.php/item/{{$pagelist->id}}/" class="a "><span>{{$pagelist->productionname}}</span></a>
                        </div>
                        <a href="{{str_replace('www.','mip.',config('app.url'))}}/index.php/item/{{$pagelist->id}}/" class="brand-list-item-jump-tmall official"  title="{{$pagelist->productionname}}" data-bde-bind="1"><span class="active">产品详情</span></a>
                    </div>
                    <div class="clear"></div>
                    <a href="{{str_replace('www.','mip.',config('app.url'))}}/index.php/item/{{$pagelist->id}}/">
                        <dl class="list flex flex-align-center">
                            <div class="dt flex flex-align-center">
                                <span>
                                    <mip-img src="{{$pagelist->litpic}}" alt="{{$pagelist->productionname}}" class="autoWH" ></mip-img>
                                </span>
                            </div>
                            <dd class="big-data">
                                <div class="data">
                                    <div>产品名称：<span>{{$pagelist->productionname}}</span></div>
                                    所属品牌：<span>{{\App\AdminModel\Brandarticle::where('id',$pagelist->brandid)->value('brandname')}}</span>
                                </div>
                                <div class="data">
                                    <div>加盟人气：<span>{{$pagelist->click}}</span></div>
                                    所在地区：<span>{{$pagelist->brandaddr}}</span>
                                </div>
                            </dd>
                        </dl>
                        <div class="spe-msg">
                            {{$pagelist->pdintr}}
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
        <div class="page">
            {!! str_replace('page=','page/',str_replace('?','/',preg_replace('/<a href=[\'\"]?([^\'\" ]+).*?>/','<a href="${1}/">',$pagelists->links()))) !!}
        </div>
    </div>
    @include('mip.liuyan')
    <div class="index_item">
        <div class="common_tit">
            <span class="tit" href="/paihangbang/">{{$thistypeinfo->typename}}十大品牌</span>
        </div>
        <div class="bd">
            <ul>
                @foreach($brandtops as $index=>$topbrand)
                    @if($index<3)
                        <li>
                            <a href="{{str_replace('www.','mip.',config('app.url'))}}/index.php/brand/{{$topbrand->id}}/">
                                <div class="img_show"><mip-img src="{{$topbrand->litpic}}"></mip-img></div>
                                <div class="cont">
                                    <p class="tit">{{$topbrand->brandname}}</p>
                                    <p class="desc">{{str_limit($topbrand->description,30,'...')}}</p>
                                    <p class="price">投资金额：<em>￥{{$topbrand->brandpay}}</em></p>
                                </div>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="list">
            <ul>
                @foreach($brandtops as $index=>$brandtop)

                    @if($index>2)
                        <li>
                            <a href="{{str_replace('www.','mip.',config('app.url'))}}/index.php/brand/{{$brandtop->id}}/">
                                <i>{{$index+1}}</i><span>{{$brandtop->brandname}}</span><em>已有{{$brandtop->click}}人申请</em>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
    <!--品牌列表 End-->
    <div id="item7">
        <div class="item7box clearfix">
            <i></i>
            <div class="title">项目资讯</div>
            <div class="item7content">
                @foreach($cnewslists as $cnewslist)
                    <div class="item7list">
                        <a href="/news/{{$cnewslist->id}}/">
                            <div class="left fl">
                                <div class="lefttitle">{{$cnewslist->title}}</div>
                                <div class="text">
                                    <div class="message">编辑：中国休闲食品加盟网</div>
                                    <div class="time">{{date('Y-m-d',strtotime($cnewslist->created_at))}}</div>
                                </div>
                            </div>
                            <div class="right fr">
                                <mip-img src="{{$cnewslist->litpic}}"></mip-img>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop