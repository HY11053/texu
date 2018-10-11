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
        });

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