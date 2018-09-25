<div id="item5" class="clearfix">
    <div class="item5box">
        <i></i>
        <div class="title">在线留言</div>
        <form method="post" action="https://message.5988.com/index.php/my_ci/into/">
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
        </form>
        <div class="lysm">
            本站为资讯展示网站，本网页信息来源互联网，本平台不保证信息的真实性，请用户自行与商家联系核对真实性。此次留言将面向网站内所有页面项目产生留言。
        </div>
    </div>
</div>

@if(Jenssegers\Agent\Facades\Agent::isRobot())
<div id='k_s_ol_inviteWin' class='ks_ol_comm_div' style='display: block; width: auto; z-index: 2147483647; left: 50%; margin-left: -140px; top: 50%; margin-top: -140px; visibility: visible; position: fixed !important; font-family:Microsoft YaHei; line-height:22px;'>
    <div id='k_s_ol_inviteWin_fl'>
        <div style='width:280px; height:280px; background:url(/public/images/boxbj.png) top center no-repeat; background-size:280px auto;' align='center'>
            <div align='right'>
                <div style='height:40px; width:40px; cursor:pointer;' onclick='abc()'></div>
            </div>
            <div style='padding-top:15px; text-align:center; font-size:14px; color:#444444;'>
                <p>在线咨询零食量贩</p>
                <p>一对一专属服务</p>
            </div>
            <div style='padding-top:5px; padding-left:20px; line-height:32px; padding-right:20px; text-align:center; font-size:15px; font-weight:bold; color:#f4751e;'>品牌优势&nbsp;&nbsp;加盟费用&nbsp;&nbsp;近期优惠</div>
            <form  method="post" action="https://message.5988.com/index.php/my_ci/into/">
                <div style='padding-top:10px;' align='center'>
                    <div align='center' style="font-size: .12rem;">
                        <input name='realm' id='set_realm' value="m.51xxsp.com" type='hidden'>
                        <input name='job' id='set_job' value='guestbook' type='hidden'>
                        <input name='title' id='set_title' value="中国休闲食品加盟网" type='hidden'>
                        <input name="cla" value=" @if(isset($thisarticleinfos))
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
@endif " type="hidden">
                        <input name="combrand" value="@if(isset($thisarticleinfos))
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
                               @endif "
                               type="hidden">
                        <input name='resolution' id='resolution'  type='hidden'>
                        <input id='set_resolution' name='set_content'  type='hidden'>
                        <input name='username' id='set_username' class='bjname'  placeholder='姓名' style='font-family: Microsoft YaHei; font-size:14px; background:#ffffff; color:#555555; text-indent:10px;width:200px; height:32px; border:1px solid #9a9a9a; line-height:32px; border-radius:4px; outline:none; margin-bottom:5px;' >
                        <input name='iphone' type='text' id='set_iphone' style='font-family: Microsoft YaHei; font-size:14px; background:#ffffff; color:#555555; text-indent:10px;width:200px; height:32px; border:1px solid #9a9a9a; line-height:32px; border-radius:4px; outline:none;' value='' placeholder='手机' >
                        <div style='clear:both;'></div>
                    </div>
                </div>
                <div style='padding-top:10px; font-size:12px; color:red;display:none;' align='center' id='xs'>我们将立即回电。该通话对您免费，请放心接听！</div>
                <div style='padding-top:10px; padding-left:40px; padding-right:40px;' align='center'>
                    <button type='submit' name='B1' style='float:left; width:90px; line-height:30px; height:30px; text-align:center; font-size:14px; color:#FFFFFF; border-radius:3px; background:#00c897; border:none;' id='tj_btn'>提交留言</button>
                    <a href='javascript:void(0);' onclick='online()'>
                        <div id='tj_btn2' style='float:right; width:90px; line-height:30px; text-align:center; font-size:14px; color:#FFFFFF; border-radius:3px;  background:#fea525;' >在线咨询</div>
                    </a>
                    <div style='clear:both;'></div>
                </div>
            </form>
        </div>
    </div>
</div>
@endif