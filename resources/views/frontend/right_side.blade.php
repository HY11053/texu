@include('frontend.liuyan')
<!--右侧 Start-->
<div class="w270">
    <div class="bk r_paihang">
        <h2>同类型品牌排行</h2>
        <ol>
            @foreach($brandtop as $brand)
                <li><em>{{$brand->brandpay}}</em><a href="{{config('app.url')}}/brand/{{$brand->id}}/"  title="{{$brand->brandname}}">{{$brand->brandname}}</a></li>
            @endforeach
        </ol>
    </div>

    <div class="bk r_dllb1">
        <h2>品牌推荐</h2>
        @foreach($flashlingshibrands as $flashlingshibrand)
            <dl>
                <dt><a href="{{config('app.url')}}/brand/550/"><img width="120" height="90" src="{{$flashlingshibrand->litpic}}" alt="{{$flashlingshibrand->brandname}}"   title="{{$flashlingshibrand->brandname}}"/></a></dt>
                <dd>
                    <strong><a href="{{config('app.url')}}/brand/{{$flashlingshibrand->id}}/"  title="{{$flashlingshibrand->brandname}}">{{$flashlingshibrand->brandname}}</a></strong>
                    <span>投资金额：<em>{{$flashlingshibrand->brandpay}}/</em></span>
                    <span><a href="{{config('app.url')}}/brand/{{$flashlingshibrand->id}}/"  title="立即咨询">立即咨询</a></span>
                </dd>
            </dl>
        @endforeach

        <script>
            $('.r_dllb1 dl:last').addClass('qline');
        </script>
    </div>

    <div class="bk r_ullb1">
        <h2>同类型品牌排行</h2>
        <ul>
            @foreach($latesnews as $latesnew)
                <li><a href="{{config('app.url')}}/news/{{$latesnew->id}}/" title="{{$latesnew->title}}">{{$latesnew->title}}</a></li>
            @endforeach
        </ul>
    </div>


    <div class="bk r_biaoqian">
        <h2>快速查询</h2>
        <ul class="clearfix">
            @foreach($cproductions as $cproduction)
                <li><a href="{{config('app.url')}}/item/{{$cproduction->id}}/"   title="{{$cproduction->productionname}}">{{$cproduction->productionname}}</a></li>
            @endforeach
        </ul>
    </div>
</div>
<!--右侧 End-->