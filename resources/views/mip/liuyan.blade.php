<div id="msg">
<div id="item5" class="clearfix">
    <div class="item5box">
        <i></i>
        <div class="title">在线留言</div>
        <mip-form method="post" target="_self" url="https://message.5988.com/index.php/my_ci/into/">
        <input type="hidden" name="realm" value="www.51xxsp.com">
        <input type="hidden" name="job" value="guestbook">
        <input type="hidden" name="title" value="中国休闲食品加盟网">
        <input type="hidden" name="cla" value="
        @if(isset($thisarticleinfos))
        @if($thisarticleinfos->brandname)
        {{\App\AdminModel\Arctype::where('id',$thisarticleinfos->typeid)->value('typename')}}
        @elseif ($thisarticleinfos->brandid)
        {{\App\AdminModel\Arctype::where('id',\App\AdminModel\Brandarticle::where('id',$thisarticleinfos->brandid)->value('typeid'))->value('typename')}}
        @else
        {{$thisarticleinfos->arctype->typename}}
        @endif
        @elseif(isset($thistypeinfo))
        {{$thistypeinfo->typename}}
        @else
                未知分类
        @endif
        ">
        <input type="hidden" name="combrand" value="
        @if(isset($thisarticleinfos))
        @if($thisarticleinfos->brandname)
        {{$thisarticleinfos->brandname}}
        @elseif ($thisarticleinfos->brandid)
        {{\App\AdminModel\Brandarticle::where('id',$thisarticleinfos->brandid)->value('brandname')}}
        @else
        {{$thisarticleinfos->title}}
        @endif
        @elseif(isset($thistypeinfo))
        {{$thistypeinfo->typename}}
        @else
                未知分类
        @endif
        ">
        <input type="hidden" name="resolution" id="resolution">
        <div class="inputbox">
            <input type="text" name="username" id="guestname" value="" placeholder="您的真实姓名"/>
            <span>姓名：</span>
            <div class="tip">*姓名不可以为空</div>
        </div>
        <div class="inputbox">
            <input type="tel" name="iphone" id="phonenum" value="" placeholder="电话是与您联系的重要方式"/>
            <span>手机：</span>
            <div class="tip">*不是完整的11位手机号或者正确的手机号前七位</div>
        </div>
        <div class="inputbox">
            <input type="text" name="note" id="note" value="" placeholder="我对此项目很感兴趣，请联系我。"/>
            <span>留言：</span>
            <div class="tip">*留言不可以为空</div>
        </div>
        <button type="submit" class="submitmessagebtn">提交留言</button>
        </mip-form>
        <div class="lysm">
            本站为资讯展示网站，本网页信息来源互联网，本平台不保证信息的真实性，请用户自行与商家联系核对真实性。此次留言将面向网站内所有页面项目产生留言。
        </div>
    </div>
</div>
</div>