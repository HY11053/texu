<div class="brandinfo" style="background: #fff; margin-bottom: 10px; padding: 10px;">
    <div class="xm-show-bar">
        <div class="img-block tu">
            @foreach($pics as $pic)
                @if($loop->first)
                    <li class="img-block cur"><img src="{{$pic}}" alt=""></li>
                @endif
            @endforeach
        </div>
        <div class="xm-scroll">
            <div class="btn-left btn-disabled"><i class="iconfont icon-leftarrow"></i></div>
            <div class="btn-right"><i class="iconfont icon-rightarrow"></i></div>
            <div class="ovh">
                <ul style="width: 272px;">
                    @foreach($pics as $pic)
                        <li class="img-block cur"><img src="{{$pic}}" alt=""></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="fl det-xm">
        <div class="btn-duibi btn-addbyb" data-id="49">
            <i class="iconfont icon-Contrast"></i>对比
        </div>
        <h5>【{{$thisarticleinfos->brandname}}】</h5>
        <div>
            <span class="fr s-c999 ml10">{{$thisarticleinfos->created_at}}</span>
        </div>
        <ul class="feiyong">
            <li>投资金额<p>￥{{$thisarticleinfos->brandpay}}</p>
            </li>
            <li>所属行业<p>{{$thisarticleinfos->arctype->typename}}</p></li>
            <li>门店数<p>{{$thisarticleinfos->brandnum}}</p>
            </li>
            <li>所需面积<p>{{\App\AdminModel\Acreagement::where('id',$thisarticleinfos->acreage)->value('type')}}</p>
            </li>
        </ul>
        <ul class="qita clearfix mt15">
            <li>成立时间：<span>{{$thisarticleinfos->brandtime}}</span></li>
            <li>品牌发源地：<span>{{$thisarticleinfos->brandorigin}}</span></li>
            <li>意向加盟：<span>{{$thisarticleinfos->brandattch}}</span></li>
            <li>申请加盟：<span>{{$thisarticleinfos->brandapply}}</span></li>
            <li>加盟区域：<span>{{$thisarticleinfos->brandarea}}</span></li><li>加盟意向：<span>{{$thisarticleinfos->brandattch}}人</span></li>
            <li>经营范围：<span>{{$thisarticleinfos->brandmap}}</span></li>
            <li>加盟人群：<span>{{$thisarticleinfos->brandperson}}</span></li>
            <div class="clear"></div>
        </ul>
        <div class="fx-z-h48 mt20">
            <a href="#wyjm" class="btn btn-oe">申请加盟</a>
            <div class="btn btn-zan ct"><i class="iconfont icon-like"></i><span>{{$thisarticleinfos->click}}</span></div>
            <div class="btn btn-Share"><i class="iconfont icon-Share"></i>成本计算</div>
        </div>
    </div>
    <div class="layout2_right fr">
        <div class="pinpai-syr">
            <i class="renzheng"></i>
            <div class="img-block">
                <img src="{{$thisarticleinfos->litpic}}" alt="" width="180" height="180">
            </div>
            <h5>{{$thisarticleinfos->brandgroup}}</h5>
            <ul>
                <li>所在地：<span>{{$thisarticleinfos->brandaddr}}</span></li>
                <li>注册资金：<span>{{$thisarticleinfos->registeredcapital}}</span></li>
                <li>公司类型：<span>{{$thisarticleinfos->genre}}</span></li>
            </ul>
            <div class="btn-bar mt15">
                <a href="javascript:void(0);" class="btn-wyzx btn btn-oe fl">在线咨询</a><a href="#wyjm" class="btn bg-ff fr"><i class="iconfont icon-join"></i>我要加盟</a>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
