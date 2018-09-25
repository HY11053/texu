@extends('frontend.frontend')
@section('title'){{$thisarticleinfos->title}}-{{$indexname}}@stop
@section('keywords') {{$thisarticleinfos->keywords}}@stop
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
    <link rel="stylesheet" href="/frontend/css/article.css" />
    <link rel="stylesheet" href="/frontend/css/index.css" />
@stop
@section('main_content')
    <div style="background-color: #f5f5f5;">
    <div class="w1200">
        <div class="path"><p>当前位置：<a href="/" title="{{config('app.indexname')}}">{{config('app.indexname')}}</a>&gt; <a class="dq" href="{{config('app.url')}}/{{$thisarticleinfos->arctype->real_path}}/" title="{{$thisarticleinfos->arctype->typename}}">{{$thisarticleinfos->arctype->typename}}</a></p></div>
        <div class="clearfix pb50">
            <div class="fl w870">
                <div class="detail-page">
                    <div class="det-tit">
                        <h1>{{$thisarticleinfos->title}}</h1>
                        <div class="info">
                            <span>{{$thisarticleinfos->created_at}}</span><span>来源：<em class="s-c59">{{config('app.indexname')}}</em></span><span class="s-oe"><i class="iconfont icon-Category"></i>{{$thisarticleinfos->arctype->typename}}</span>
                        </div>
                    </div>
                    <div class="det-nr">
                        {!! $thisarticleinfos->body !!}
                    </div>
                    <div class="other">
                        <div class="fl tag">
                            <span>标签：</span><h3 class="btn">{{$thisarticleinfos->tags}}</h3>
                        </div>
                        {{--
                        <dl class="fr share">
                            <dt>分享到：</dt>
                            <dd>
                                <div class="ico wechat">
                                    <i class="iconfont icon-wechat"></i>
                                </div>
                            </dd>
                            <dd>
                                <a rel="nofollow" target="_blank" href="http://service.weibo.com/share/share.php?url={{config('app.url')}}/news/{{$thisarticleinfos->id}}&amp;title={{$thisarticleinfos->title}}&amp;pic={{str_replace(config('app.url').config('app.url'),config('app.url'),config('app.url').$thisarticleinfos->litpic)}}">
                                    <div class="ico weibo">
                                        <i class="iconfont icon-weibo"></i>
                                    </div>
                                </a>
                            </dd>
                            <dd>
                                <a target="_blank" rel="nofollow" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url={{config('app.url')}}/news/{{$thisarticleinfos->id}}&amp;title={{$thisarticleinfos->title}}&amp;pics={{str_replace(config('app.url').config('app.url'),config('app.url'),config('app.url').$thisarticleinfos->litpic)}}">
                                    <div class="ico qzone">
                                        <i class="iconfont icon-qzone"></i>
                                    </div>
                                </a>
                            </dd>
                        </dl>
                        --}}
                    </div>
                </div>

                <div class="ar_infos">
                    @if(isset($thisBrandArticle))
                    <div class="xg_news">
                        <div class="title"><strong>{{$thisBrandArticle->brandname}}品牌信息</strong></div>
                        <div id="article_brandinfo">
                            <table cellspacing="0">
                                <tbody>
                                <tr>
                                    <td class="td_color logo_size"><img src="{{$thisBrandArticle->litpic}}"></td>
                                    <td class="td_style first_line"><strong><a href="/brand/{{$thisBrandArticle->id}}/">{{$thisBrandArticle->brandname}}</a></strong></td>
                                    <td class="td_color first_line">投资金额</td>
                                    <td class="td_style first_line">{{$thisBrandArticle->brandpay}}</td>
                                </tr>
                                <tr>
                                    <td class="td_color">加盟人气</td>
                                    <td class="td_style">{{$thisBrandArticle->brandnum}}</td>
                                    <td class="td_color">成立时间</td>
                                    <td class="td_style">{{$thisBrandArticle->brandtime}}</td>
                                </tr>
                                <tr>
                                    <td class="td_color">加盟费用</td>
                                    <td class="td_style">{{$thisBrandArticle->brandpay}}</td>
                                    <td class="td_color">区域特许</td>
                                    <td class="td_style">{{$thisBrandArticle->brandarea}}</td>
                                </tr>
                                <tr>
                                    <td class="td_color">公司名称</td>
                                    <td class="td_style">{{$thisBrandArticle->brandgroup}}</td>
                                    <td class="td_color">总部地址</td>
                                    <td class="td_style">{{$thisBrandArticle->brandaddr}}</td>
                                </tr>
                                <tr>
                                    <td class="td_color button_line">品牌详情</td>
                                    <td class="td_style"><button class="btn btn-success ">点击查看<a href="{{config('app.url')}}/brand/{{$thisBrandArticle->id}}/">{{$thisBrandArticle->brandname}}</a>品牌加盟信息</button> </td>
                                    <td class="td_color button_line">项目咨询</td>
                                    <td class="td_style"> <a href="{{config('app.url')}}/brand/{{$thisBrandArticle->id}}/#msg"><button class="btn btn-danger ">快速咨询</button></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                    <div class="shangxiapian">
                        <p>@if(isset($prev_article)) <span>上一篇：<a href="{{config('app.url')}}/news/{{$prev_article->id}}/" title="{{$prev_article->title}}">{{str_limit($prev_article->title,40,'')}}</a></span> @else 没有了 @endif </p>
                        <p>@if(isset($next_article))  <span class="right">下一篇：<a href="{{config('app.url')}}/news/{{$next_article->id}}/" title="{{$next_article->title}}">{{str_limit($next_article->title,40,'')}}</a></span> @else 没有了 @endif  </p>
                    </div>
                    @include('frontend.liuyan')
                    <div class="xg_news">
                        <div class="title"><strong> @if(isset($thisBrandArticle->brandname)) {{$thisBrandArticle->brandname}} @endif加盟资讯</strong></div>
                        <div class="xw">
                            <ul class="clearfix">
                                @if(isset($xg_search))
                                    @foreach($xg_search as $search)
                                        <li><a href="/news/{{$search->id}}/" title="{{$search->title}}">{{$search->title}}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <div class="fr w320">
                <div class="plr20-tb15 bg-ff box-shadow mb20 ">
                    <div class="lh24">
                        <a target="_blank" href="/jm/?c=chuanchuan" class="fr s-c999">更多</a>
                        <h3 class="f22">串串热门加盟项目</h3>
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

                <div class="plr20-tb15 bg-ff box-shadow mt20">
                    <div class="lh24">
                        <a target="_blank" href="/jm/?c=chuanchuan" class="fr s-c999">更多</a>
                        <h3 class="f22">最新加盟项目</h3>
                    </div>
                    <ul class="jm-xm-list mt5 mb10" style="margin-top: 10px;">
                        @foreach($flashlingshibrands as $flashlingshibrand)
                        <li><a target="_blank" href="/brand/{{$flashlingshibrand->id}}/" class="img-block magnify"><img src="{{$flashlingshibrand->litpic}}" alt=""></a>
                            <p class="f16">
                                <a target="_blank" href="/brand/{{$flashlingshibrand->id}}/">{{$flashlingshibrand->brandname}}</a>
                            </p>
                            <p class="f14">
                                投资金额：<span class="s-oe">￥{{$flashlingshibrand->brandpay}}</span>
                            </p>
                            <p class="f14">门店总数：<span class="s-oe">{{$flashlingshibrand->brandnum}}</span>
                            </p>
                        </li>
                       @endforeach
                    </ul>
                </div>
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
                        <li><a target="_blank" href="/news/{{$latestnewslist->id}}/" class="img-block magnify"><img @if($latestnewslist->litpic) src="{{$latestnewslist->litpic}}" alt="{{$latestnewslist->tite}}" @else src="/public/images/noimg.jpg" @endif /></a>
                            <p class="f16"><a target="_blank" href="/news/{{$latestnewslist->id}}/">{{$latestnewslist->title}}</a></p>
                            <p class="f14 s-8c">{{$latestnewslist->created_at}}</p>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    </div>
@stop