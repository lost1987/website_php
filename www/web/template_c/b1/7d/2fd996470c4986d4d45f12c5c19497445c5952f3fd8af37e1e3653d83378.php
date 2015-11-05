<?php

/* service_helpCenter.html */
class __TwigTemplate_b17d2fd996470c4986d4d45f12c5c19497445c5952f3fd8af37e1e3653d83378 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("baseService.html");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'keywords' => array($this, 'block_keywords'),
            'description' => array($this, 'block_description'),
            'content' => array($this, 'block_content'),
            'script' => array($this, 'block_script'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "baseService.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        // line 4
        echo "武汉麻将-客户服务
";
    }

    // line 7
    public function block_keywords($context, array $blocks = array())
    {
        // line 8
        echo "武汉麻将-客户服务
";
    }

    // line 11
    public function block_description($context, array $blocks = array())
    {
        // line 12
        echo "武汉麻将-客户服务
";
    }

    // line 15
    public function block_content($context, array $blocks = array())
    {
        // line 16
        echo "<div class=\"col-xs-7\">
              <div class=\"panel p15 inner pb50\" id=\"mainPanel\">
                <h4 class=\"mTitle\">帮助中心</h4>
                <div class=\"\">
                  <ul class=\"nav nav-tabs nav-justified nav02\" role=\"tablist\">
                    <li class=\"active\"><a href=\"javascript:;\" rel=\"tab02\">热门</a></li>
                    <li><a href=\"javascript:;\" rel=\"tab03\">注册</a></li>
                    <li><a href=\"javascript:;\" rel=\"tab04\">游戏</a></li>
                    <li><a href=\"javascript:;\" rel=\"tab05\">充值</a></li>
                    <li><a href=\"javascript:;\" rel=\"tab06\">比赛</a></li>
                    <li><a href=\"javascript:;\" rel=\"tab07\">兑奖</a></li>
                  </ul>
                  <div class=\"tab-content p15\">
                    <div class=\"tab-pane fade in active\" id=\"tab02\" >
                        <ol class=\"list-unstyled list\">
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">1.</span><strong>为什么登录时提示账号错误？</strong></p>
                                <p> 用户名：注册时填写的，是登录游戏时需要输入的。
                                    昵称：游戏里的名字，官网注册后，自己起的名字。
                                    登录时，需要输入的是用户名，而不是昵称。
                                    如果实在想不起用户名或者密码，可以申请账号找回，我们会把账号发送到您绑定的邮箱中。</p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">2.</span><strong>金币、钻石、门票、奖券都是做什么用的？怎么获得？</strong></p>
                                <p>金币：金币可以通过在游戏中胜利时赢取，或者用金钻、奖券来兑换。
                                    钻石：游戏中的任务奖励，此外，通过充值也可以快速获取大量金钻。
                                    门票：通过游戏中的日常比赛赢取，是参加高级比赛的入场券。
                                    奖券：游戏中比赛的奖励，可以用奖券来兑换金币、手机充值卡和其他实物奖品！</p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">3.</span><strong>VIP有什么用？怎么变成VIP？</strong></p>
                                <p> VIP在游戏中是一种身份的象征，不同等级的VIP在游戏中有相应的特权。
                                    VIP可以通过在游戏中充值或其他游戏活动获得。</p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">4.</span><strong>注册账号收费吗？注册过程是不是很麻烦？</strong></p>
                                <p>注册账号是完全免费的，且以后也不会收取任何费用。
                                    注册账号的过程非常简单：
                                    1． 在注册栏输入你的用户名
                                    2． 设置你的游戏密码和昵称
                                    3． 选择你所在的地区
                                    注册就这样完成了，整个过程不过30秒左右。</p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">5.</span><strong>我的账号能同时在电脑和手机上用么？</strong></p>
                                <p>同一个游戏账号在电脑和手机上都可以用，而且账号中的数据也是互通的。
                                    但是同一账号无法同时在两个地方登陆。</p>
                            </li>
                        </ol>
                    </div>
                    <div class=\"tab-pane fade\" id=\"tab03\">
                        <ol class=\"list-unstyled list\">
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">1.</span><strong>如何注册帐号？</strong></p>
                                <p>您可以在网站点击左侧\"免费注册\"按钮，根据提示进行填写信息并确认即可注册成功。</p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">2.</span><strong>注册时游戏帐号一栏如何填写？</strong></p>
                                <p>游戏帐号可以是数字、字母或其组合(不能少于4位或多于14位)，您可以直接填写方便您记忆的帐号名称，系统不区分大小写，会自动默认为小写字母注册。</p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">3.</span><strong>注册时每一栏都需要填写吗？</strong></p>
                                <p>在注册时带\"*\"号的内容都是必须填写的，为了保证您的账户安全请您填写真实信息并牢记您的注册资料。</p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">4.</span><strong>注册时点击确定没有反应怎么办？</strong></p>
                                <p>查看您带\"*\"号的内容是否都正确填写并且同意用户服务协议。</p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">5.</span><strong>为什么建议进行实名认证？</strong></p>
                                <p>为了遵守相关部门《网络游戏管理办法》，同时在您以后游戏中获得实物奖励后方便领取，建议您进行实名认证。</p>
                            </li>
                        </ol>
                    </div>
                    <div class=\"tab-pane fade\" id=\"tab04\">
                        <ol class=\"list-unstyled list\">
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">1.</span><strong>如何获得游戏金币？</strong></p>
                                <p>1、注册账号即送8000金币。
                                    2、充值获得钻石，即可用钻石兑换金币。
                                    3、通过游戏大厅左侧，任务系统，根据任务要求完成任务。获得金币奖励。
                                </p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">2.</span><strong>游戏进行中暂离一段时间会怎样？</strong></p>
                                <p>当您在规定时间内没有出牌，您将会进入系统托管状态</p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">3.</span><strong>游戏进行中断线了会怎样？</strong></p>
                                <p>游戏进行中断线后，将进入托管状态，只能起牌打牌。在牌局结束前如果您重新登陆游戏，可以选择继续这一局，或者强制退出这一局（强制退出会扣除一定金币）。</p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">4.</span><strong>游戏中途退出游戏会怎样？</strong></p>
                                <p>正常情况下牌局中无法退出，如果强制结束牌局，系统会扣除一定金币。</p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">5.</span><strong>密码丢失如何找回?</strong></p>
                                <p>您可以通过绑定邮箱或手机号找回密码等多种方式进行密码找回，玩家可以选择相应的方式填写好相关的资料后，重新设置一个新的密码进行游戏。在没有认证手机或邮箱的情况下，只能重新注册一个账号进行游戏，注册好账号后，建议进行手机或邮箱认证。</p>
                            </li>
                        </ol>
                    </div>
                    <div class=\"tab-pane fade\" id=\"tab05\" >
                        <ol class=\"list-unstyled list\">
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">1.</span><strong>如何进行充值?</strong></p>
                                <p>您可以登录我们的官方网站，进入主页后，点击个人信息上方的\"立即充值\"按钮；另外，在游戏大厅也有一个\"充值\"按钮，根据页面的提示选择适合您的充值方式。</p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">2.</span><strong>充值的比例是多少？</strong></p>
                                <p>人民币6元起充，充值6元，即可获得60钻石，充值金额越多，优惠幅度会越大。</p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">3.</span><strong>都有那些充值方式？</strong></p>
                                <p>目前充值方式有：网银、支付宝、充值卡充值。</p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">4.</span><strong>为什么充值时点击立即充值没有反应？</strong></p>
                                <p>这一般是由于浏览器版本过低或自身系统存在病毒与网络状况不良所导致。您可以使用最新的IE浏览器版本，尝试查杀病毒，并且临时允许弹出窗口，清除IE缓存，还原IE高级设置，恢复默认级别等等。</p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">5.</span><strong>VIP有什么用？怎么变成VIP？</strong></p>
                                <p>VIP在游戏中是一种身份的象征，不同等级的VIP在游戏中有相应的特权。（具体可查看游戏中的VIP等级详情）
                                    凡在游戏中进行充值一次（不限金额）即可自动成为VIP，VIP也可通过其他游戏活动获得。
                                </p>
                            </li>
                        </ol>
                    </div>
                    <div class=\"tab-pane fade\" id=\"tab06\" >
                        <ol class=\"list-unstyled list\">
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">1.</span><strong>比赛分几种？具体在什么时间举办？</strong></p>
                                <p>比赛分为乐众积分赛（积分赛）、新蜂精英赛（日赛）、新蜂大师赛（周赛）、全城争霸赛（月赛）四种。
                                    具体时间为：新蜂乐众赛（积分赛）每天早上9点开始，连续举办24场(与其他比赛时间冲突时中止)
                                    新蜂精英赛（日赛）每天举办两场，一场在中午13点，一场在晚上19点。
                                    新蜂大师赛（周赛）每周六上午10点举行。
                                    全城争霸赛（月赛）每月最后一个周日晚上19点举行。
                                </p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">2.</span><strong>如果我已经报名，却未能参加比赛，参赛门票会退还吗？</strong></p>
                                <p>如果你已经报名，但是却未能参加比赛，参加比赛的门票将如数退还。</p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">3.</span><strong>乐众积分赛具体比赛规则和奖励是什么？</strong></p>
                                <p>1. 比赛采取积分制，规定时间段内赢取积分最多的玩家获得冠军。</p>
                                <p>    2. 比赛不需要报名，凡是在比赛时间段内在线的玩家默认参加比赛。</p>
                                <p>   3. 每场比赛时间为20分钟，在这个时间内结算的游戏都会被计算积分。</p>
                                <p>   4. 每局游戏中赢取的单倍金币数量作为积分，输家不损失积分。</p>
                                <p>   5. 乐众积分赛每天早上9点开始，连续举办24场(与其他比赛时间冲突时中止)。</p>
                                <p>    奖励：1. 第一名获得5张门票</p>
                                <p>    2. 第二名获得4张门票</p>
                                <p>   3. 第三名获得3张门票</p>
                                <p>   4. 第四名获得2张门票</p>
                                <p>  5. 第五名获得1张门票</p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">4.</span><strong>新蜂精英赛（日赛）的具体比赛规则和奖励是什么？</strong></p>
                                <p>1. 新蜂精英赛每天举办两场，一场在中午13点，一场在晚上19点。</p>
                                <p>   2. 比赛采取淘汰制，一场比赛64人，需要玩家在比赛开始前进行报名。</p>
                                <p>    3. 比赛开始前2小时可以进行报名，报名需要使用5张门票。</p>
                                <p>    4. 比赛进行三轮，第一轮和第二轮为一局定胜负，胜者晋级；第三轮为决赛，进行4局，如果出现平局则加赛一局，赢取积分最多的用户获得冠军。</p>
                                <p>    5. 决赛中出现选手弃权时，采取全服竞拍的方式寻找新的玩家直接进入决赛。</p>
                                <p>   奖励：</p>
                                <p>   1. 第一名获得200奖券</p>
                                <p>   2. 第二名获得20门票</p>
                                <p>   3. 第3~4名获得10门票</p>
                                <p>    4. 第5~16名获得2门票</p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">5.</span><strong>新蜂大师赛（周赛）的具体比赛规则和奖励是什么？</strong></p>
                                <p>1. 新蜂大师赛每周六上午10点举行。 </p>
                                <p>   2. 比赛采取淘汰制，一场比赛64人，需要玩家在比赛开始前进行报名。 </p>
                                <p>    3. 比赛开始前48小时可以进行报名，报名需要使用50张门票。 </p>
                                <p>     4. 比赛进行三轮，第一轮和第二轮为一局定胜负，胜者晋级；第三轮为决赛，进行4局，如果出现平局则加赛一局，赢取积分最多的用户获得冠军。 </p>
                                <p> 5. 决赛中出现选手弃权时，采取全服竞拍的方式寻找新的玩家直接进入决赛。 </p>
                                <p> 奖励： </p>
                                <p> 1. 第一名获得2000奖券 </p>
                                <p> 2. 第二名获得50门票 </p>
                                <p> 3. 第3~4名获得20门票 </p>
                                <p> 4. 第5~16名获得5门票 </p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">6.</span><strong>全城争霸赛（月赛）的具体比赛规则和奖励是什么？</strong></p>
                                <p>1. 全城争霸赛每月最后一个周日晚上19点举行。</p>
                                <p>    2. 比赛采取淘汰制，一场比赛64人，需要玩家在比赛开始前进行报名。</p>
                                <p>    3. 比赛开始前72小时可以进行报名，报名需要使用200张门票。</p>
                                <p>    4. 比赛进行三轮，第一轮和第二轮为一局定胜负，胜者晋级；第三轮为决赛，进行4局，如果出现平局则加赛一局，赢取积分最多的用户获得冠军。</p>
                                <p>    5. 决赛中出现选手弃权时，采取全服竞拍的方式寻找新的玩家直接进入决赛。</p>
                                <p>    奖励：</p>
                                <p>    1. 第一名获得12000奖券</p>
                                <p>    2. 第二名获得250门票</p>
                                <p>   3. 第3~4名获得100门票</p>
                                <p>   4. 第5~16名获得25门票</p>
                            </li>
                        </ol>
                    </div>
                    <div class=\"tab-pane fade\" id=\"tab07\">
                        <ol class=\"list-unstyled list\">
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">1.</span><strong>如何获得奖券？</strong></p>
                                <p>奖券需要在比赛中赢得，在日赛，周赛，月赛都可赢得不同数额的奖券。</p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">2.</span><strong>在哪里可以查看及领取比赛奖励？</strong></p>
                                <p>在比赛结束后，您可以在个人收件箱中领取属于你的比赛奖励。</p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">3.</span><strong>兑换的实物奖品如何发放给我？</strong></p>
                                <p>奖券兑换的手机充值卡，我们会在一个工作日内直接充值到你所需要充值的手机内。如兑换其他实物奖品，需要提供详细地址，我们将委托配送公司为您配送，配送物品一般将在两个工作日内送到指定地址，请你保持电话畅通。如不方便直接接收，你也可以来我司现场自提，自提前请于我们客服联系确认。</p>
                            </li>
                            <li>
                                <p class=\"text-blueD\"><span class=\"numb\">4.</span><strong>兑换的实物奖品是否可以填写其他人接收？</strong></p>
                                <p>兑换的奖品是可以填写其他人接收的，请您务必保证填写的联系电话是正常接听状态，并备注好您本人的联系方式即可。
                                </p>
                            </li>
                        </ol>
                    </div>
                  </div>
                </div>
              </div>
            </div>
";
    }

    // line 238
    public function block_script($context, array $blocks = array())
    {
        // line 239
        echo "<script type=\"text/javascript\">
    \$(function(){
        \$(\".nav02\").find(\"li\").click(function(){
            var id =  \$(this).children().eq(0).attr('rel');
            \$(\".tab-pane\").hide().removeClass('in active');
            \$('#'+id).addClass('in active').show();
            if(id == 'tab06')
                \$(\"#mainPanel\").css('height','2300px');
            else
                \$(\"#mainPanel\").css('height','935px');
            \$(\".nav02\").find('li').removeClass('active');
            \$(this).addClass('active');
        })
    })
</script>
";
    }

    public function getTemplateName()
    {
        return "service_helpCenter.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  287 => 239,  284 => 238,  59 => 16,  56 => 15,  51 => 12,  48 => 11,  43 => 8,  40 => 7,  35 => 4,  32 => 3,);
    }
}
