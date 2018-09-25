<div id="item1">
    <div class="item1box">
        <div class="item1boxleft fl">
            <div class="title"><h1>{{$thisarticleinfos->brandname}}</h1></div>
            <div class="text">{{$thisarticleinfos->brandgroup}}</div>
            <div class="time"><span>{{date('Y-m-d',strtotime($thisarticleinfos->created_at))}}</span></div>
        </div>
        <div class="item1boxmiddle fl">
            <div class="top">{{$thisarticleinfos->brandpay}}</div>
            <li class="tl">所属行业：<span>{{$thisarticleinfos->arctype->typename}}</span></li>
            <li class="tl">经营范围：<span>{{$thisarticleinfos->brandmap}}</span></li>
            <li class="tl">店铺面积：<span>{{\App\AdminModel\Acreagement::where('id',$thisarticleinfos->acreage)->value('type')}}㎡</span></li>
        </div>
    </div>
</div>
<div id="focus" class="focus">
    <div class="swiper-container">
        <mip-carousel autoplay  defer="5000" layout="responsive" width="730"  height="304">
            @foreach($pics as $pic)
                @if(!ctype_space($pic))
                    <li class="swiper-slide" ><mip-img src="{{$pic}}"></mip-img></li>
                @else
                    <li class="swiper-slide" ><mip-img src="/mobile/images/noproject.png" ></mip-img></li>
                @endif
            @endforeach
        </mip-carousel>
    </div>
</div>