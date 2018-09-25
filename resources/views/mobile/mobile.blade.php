<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <meta name="wap-font-scale" content="no"/>
    <meta name="format-detection" content="telephone=no">
    <meta name="applicable-device" content="mobile">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <meta name="csrf-token" content=" {{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="keywords" content="@yield('keywords')"/>
    <meta name="description" content="@yield('description')"/>
    <link rel="canonical" href="{{config('app.url')}}{{str_replace('/index.php/','/',Request::getrequesturi())}}" >
    <link rel="miphtml" href="{{str_replace('http://www.','http://mip.',config('app.url'))}}{{Request::getrequesturi()}}">
    <link href="/mobile/css/common.css" rel="stylesheet" type="text/css"/>
    @yield('headlibs')
</head>
<body>
<div class="header clearfix mtop84">
    <div class="search clearfix">
        <div class="city fl">
            <a href="/"><img src="/mobile/images/nav-logo2.png" alt="中国休闲食品加盟网"/></a>
        </div>
        <div class="searchCon fl">
            <form action="/sprodlist/all/" method="post">
                {{csrf_field()}}
            <div class="ipt-box"></div>
            <input class="ipt-placeholder" placeholder="输入您想找的项目" />
            <button type="submit" class="search_btn"></button>
            </form>
        </div>
        <div class="message fr">
            <b>项目分类</b>
        </div>
        <div class="d_nav">
            <ul>
                <li><a href="/" target="_self"><span>首页</span></a></li>
                <li><a href="/nlist/1/" target="_self"><span>加盟指南</span></a></li>
                <li><a href="/nlist/2/" target="_self"><span>投资分析</span></a></li>
                <li><a href="/nlist/3/" target="_self"><span>成功案例</span></a></li>
                <li><a href="/nlist/4/" target="_self"><span>经营管理</span></a></li>
                <li><a href="/bnlist/" target="_self"><span>品牌新闻</span></a></li>
                <li><a href="/blist/all/" target="_self"><span>品牌招商</span></a></li>
                <li><a href="/paihangbang/" target="_self"><span>品牌排行榜</span></a></li>
                <li>热门行业</li>
                <li><a href="/blist/lingshi_1/" target="_self"><span>零食加盟</span></a></li>
                <li><a href="/blist/canyin_28/" target="_self"><span>餐饮</span></a></li>
                <li><a href="/blist/zhaji_29/" target="_self"><span>炸鸡</span></a></li>
                <li><a href="/blist/yinpin_30/" target="_self"><span>饮品</span></a></li>
                <li><a href="/blist/xiaochi_34/" target="_self"><span>小吃</span></a></li>
                <li><a href="/blist/suancaiyu/" target="_self"><span>酸菜鱼</span></a></li>
                <li><a href="/blist/mianshi/" target="_self"><span>面食</span></a></li>
                <li><a href="/ccx/" target="_self"><span>串串香</span></a></li>
                <li><a href="/shengjian/" target="_self"><span>生煎</span></a></li>
                <li><a href="/haixuan/" target="_self"><span>海鲜</span></a></li>
                <li><a href="/all/blist/canyin_28/blist/xiaolongxia/" target="_self"><span>小龙虾</span></a></li>
                <li><a href="/bingqilin/" target="_self"><span>冰淇淋</span></a></li>
                <li><a href="/biandang/" target="_self"><span>便当</span></a></li>
                <li><a href="/yuhuoguo/" target="_self"><span>鱼火锅</span></a></li>
                <li><a href="/boboyu/" target="_self"><span>啵啵鱼</span></a></li>
                <li><a href="/malatang/" target="_self"><span>麻辣烫</span></a></li>
                <li><a href="/rouxiebao/" target="_self"><span>肉蟹煲</span></a></li>
                <li><a href="/shaobing/" target="_self"><span>烧饼</span></a></li>
                </li>
            </ul>
        </div>

    </div>

</div>
@yield('main_content')
<footer>
    <div class="link-box ">
        <a href="https://www.51xxsp.com/" class="foot-link">电脑版</a><span class="v-line">|</span>
        <a href="/blist/all/" class="foot-link">品牌招商</a><span class="v-line">|</span>
        <a href="/nlist/1/" class="foot-link">加盟指南</a><span class="v-line">|</span>
        <a href="/nlist/2/" class="foot-link">投资分析</a><span class="v-line">|</span>
        <a href="/nlist/4/" class="foot-link">经营管理</a>
    </div>
    <p class="firm clearfix">
        <span class="foot-text mgr15">上海佐赛网络科技有限公司 版权所有</span>
    </p>
</footer>
<script type="text/javascript" src="/frontend/js/jquery.min.js"></script>
<script type="text/javascript" src="/frontend/js/swiper.min.js"></script>
<script type="text/javascript" src="/mobile/js/index.js"></script>
@yield('footlibs')
</body>
</html>
