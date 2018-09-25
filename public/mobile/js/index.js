(function (doc, win) {
    var docEl = doc.documentElement,
        resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
        recalc = function () {
            var clientWidth = docEl.clientWidth;
            if (!clientWidth) return;
            docEl.style.fontSize = 100 * (clientWidth / 640) + 'px';
        };
    if (!doc.addEventListener) return;
    win.addEventListener(resizeEvt, recalc, false);
    doc.addEventListener('DOMContentLoaded', recalc, false);
})(document, window);
//选项卡收起
var  ind1 = 1, ind2 = 1, ind3 = 1;
var arr = [ind1, ind2, ind3];
function tabsNext(o, i) {
    var tabsCTN = $(o).parents(".tabs-tit").next(".tabs-ctn");
    var indLen = tabsCTN.children().length;
    tabsCTN.children().hide().eq(arr[i]).show();
    arr[i]++;
    if (arr[i] == indLen) {
        arr[i] = 0;
    }
}

$(function () {
    $(".search .message b").click(function(){
        $('.d_nav').slideToggle();
    });
    $(".favor-header-bar ul li").click(function () {
        $(".news-content").hide().eq($(this).index()).show();
        $(this).addClass("on").siblings().removeClass("on");
    });
    $(".a_content img").attr({"width":"100%",'height':'auto'}).addClass("img-responsive center-block").css('width','100%').css('height','auto').css('border-radius','5px');
    $(".jm_xq_con img").attr({"width":"100%",'height':'auto'}).addClass("img-responsive center-block").css('height','auto').css('width','100%').css('border-radius','5px');
});
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
})