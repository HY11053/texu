<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Cache-Control" content="no-transform" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="csrf-token" content=" {{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="keywords" content="@yield('keywords')"/>
    <meta name="description" content="@yield('description')"/>
    @yield('headlibs')
    <link rel="stylesheet" href="/frontend/css/common.css" />
    <link rel="stylesheet" href="/frontend/css/swiper.min.css" />
</head>
<body>
<div class="zong_topbar clear">
    <div class="wrap_mar f12 clear">
        <div id="testDiv">
            <ul class="fl topbar_left"> <li class="fl"><span class="webtitle">欢迎访问中国休闲食品加盟网</span> </li></ul>
        </div>
        <div class="top_right">
            <a href="/sprodlist/all/" rel="nofollow"><em class="zxm"></em>搜项目</a>
            <a href="/paihangbang/"><em class="phb"></em>品牌排行榜</a>
            <a href="/storage/sitemap.xml"><em class="kdh"></em>快导航</a>
            <a href="http://m.xiuxianshipin.com"><em class="sjb"></em>手机版</a>
        </div>
    </div>
</div>
<!-- logo -->
<div class="zong_logo wrap_mar clear" style="margin-top:0">
    <h1 class="fl"><a href="{{config('app.url')}}" title="中国休闲食品加盟网" class="logo_left" target="_self"><img src="/frontend/images/logo.png" alt="中国休闲食品加盟网"></a></h1>
    <div class="logo_center fr">
        <div class="logo_find clear">
            <div class="logo_select f14 pr fl">行业<i class="zong_icon i7"></i></div>
            <form action="{{config('app.url')}}/sprodlist/all/" method="post">
                {{csrf_field()}}
            <input type="text" name="keywords" value="请输入您想查找的项目" class="fl text fontW" id="keyword_fenci" onfocus="if(this.value=='请输入您想查找的项目'){this.value='';}" onblur="if(this.value==''){this.value='请输入您想查找的项目';}"/>
            <input type="submit" value="搜索" class="button f16 fontW fr" />
            </form>
        </div>
        <ul class="f12">
            <li><a href="/brand/1247/" title="三只松鼠加盟" target="_blank">三只松鼠加盟</a> |</li>
            <li><a href="/brand/7/" title="良品铺子加盟" target="_blank">良品铺子加盟</a> |</li>
            <li><a href="/brand/1062/" title="一扫光加盟" target="_blank">一扫光加盟</a> |</li>
            <li><a href="/brand/67/" title="百味林加盟" target="_blank">百味林加盟</a> |</li>
            <li><a href="/brand/2/" title="零食多加盟" target="_blank">零食多加盟</a></li>
        </ul>
    </div>
</div>
<!-- 导航 -->
<div class="menu">
    <div class="menu_box">
        <div class="header_menu show"><div class="tit">行业分类</div></div>
        <ul class="menu_list">
            <li><a href="/" target="_self">首页</a></li>
            <li><a href="/blist/all/" target="_self">品牌招商</a></li>
            <li><a href="/nlist/1/" target="_self">加盟指南</a></li>
            <li><a href="/nlist/2/" target="_self">投资分析</a></li>
            <li><a href="/nlist/4/" target="_self">经营管理</a></li>
            <li><a href="/bnlist/" target="_self">品牌新闻</a></li>
            <li><a href="/paihangbang/" target="_blank">品牌排行榜</a></li>
        </ul>
    </div>
</div>
@yield('main_content')
<div class="footer clear">
    <div class="footer_nav">
        <a rel="nofollow" href="/guanyu.html">关于我们</a>|
        <a rel="nofollow" href="/flgw.html">本站法律顾问</a>|
        <a rel="nofollow" href="/shantie.html">投诉删除</a>|
        <a href="/ditu.html">网站地图</a>|
        <a rel="nofollow" href="/shengming.html">法律声明</a>|
        <a rel="nofollow" href="/lianxi.html">联系我们</a>
    </div>
    <div class="cert"><img src="/frontend/images/index07.jpg" alt="信用保障"></div>
    <div class="copyright">
        <p>中国休闲食品加盟网友情提示：多打电话、多咨询、实地考察，可降低投资风险！</p>
        <p> Copyright © 2015-2018 www.xiuxianshipin.com Corporation, All Rights Reserved 上海卡哇伊实业有限公司 版权所有</p>
        <p><a rel="nofollow" href="http://www.miitbeian.gov.cn" rel="nofollow" target="_blank"> 沪ICP备15007550号-24</a></p>
    </div>
</div>
<script src="/frontend/js/jquery.min.js"></script>
<script src="/frontend/js/swiper.min.js"></script>
<script>
    var mySwiper = new Swiper ('.swiper-container', {
        direction: 'horizontal',
        loop: true,
        autoplay: {
            delay: 5000,
            stopOnLastSlide: false,
            disableOnInteraction: true,
        },
        pagination: {
            el: '.swiper-pagination',
        },
    });
    $(function() {
        $(".rank-bar dd").hover(function() {
            $(this).addClass("show").siblings().removeClass("show")
        }),
            $(".xm-list-w224 li").hover(function() {
                $(this).addClass("hover"),
                    $(".pop", this).stop().animate({
                        bottom: 0
                    }, 200)
            }, function() {
                $(this).removeClass("hover"),
                    $(".pop", this).stop().animate({
                        bottom: -120
                    }, 200)
            })
    });
    $(function() {
        function t() {
            var e =  $(".xm-show-bar")
                , t =  $(".tu", e)
                , a =  $(".btn-left", e)
                , i =  $(".btn-right", e)
                , s =  $(".xm-scroll .ovh ul", e)
                , o =  $("li", s)
                , c =  $(".xm-scroll .ovh", e).outerWidth() + 8
                , r = o.outerWidth() + 8
                , l = o.length
                , d = 0
                , u = Math.floor(r * l / c)
                , h = "";
            s.css("width", r * l),
                o.on("mouseenter", function() {
                    h =  $("img", this).attr("src"),
                        $(this).addClass("cur").siblings().removeClass("cur"),
                        $("img", t).attr("src", h)
                }),
                a.on("click", function() {
                    i.removeClass("btn-disabled"),
                        d--,
                    0 >= d && (d = 0,
                        a.addClass("btn-disabled")),
                        s.animate({
                            left: -c * d
                        }, 300)
                }),
                i.on("click", function() {
                    a.removeClass("btn-disabled"),
                        d++,
                    d >= u && (d = u,
                        i.addClass("btn-disabled")),
                        s.animate({
                            left: -c * d
                        }, 300)
                })
        }
       function o() {
            var e =  $(".nv-stair")
                , t =  $(".stair-wz_new");
            if (0 !== e.length) {
                var a = e.offset().top;
                navHeight = e.outerHeight(),
                    topArr = [],
                    t.each(function(e, t) {
                        var a =  $(t).offset().top;
                        topArr.push(a)
                    }),
                    e.on("click", "h2", function() {
                        var e =  $(this).index();
                        $(this).addClass("cur").siblings().removeClass("cur"),
                            $("html,body").animate({
                                scrollTop: topArr[e] - 2 * navHeight + 27
                            }, 500)
                    }),
                    $(window).scroll(function() {
                        var t =  $(this).scrollTop();
                        t >= a ? e.addClass("nv-stair-fixed") : e.removeClass("nv-stair-fixed"),
                            $.each(topArr, function(a) {
                                t >= topArr[a] - 2 * navHeight + 27 &&  $("h2", e).eq(a).addClass("cur").siblings().removeClass("cur")
                            })
                    })
            }
        }
        t(), o()
    })
</script>
</body>
</html>
