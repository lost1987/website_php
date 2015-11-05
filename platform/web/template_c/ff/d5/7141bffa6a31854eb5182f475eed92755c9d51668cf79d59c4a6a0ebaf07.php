<?php

/* userGuide.html */
class __TwigTemplate_ffd57141bffa6a31854eb5182f475eed92755c9d51668cf79d59c4a6a0ebaf07 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("baseArticle.html");

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
        return "baseArticle.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        // line 4
        echo "新蜂游戏平台-新手指南
";
    }

    // line 7
    public function block_keywords($context, array $blocks = array())
    {
        // line 8
        echo "新蜂游戏平台-新手指南
";
    }

    // line 11
    public function block_description($context, array $blocks = array())
    {
        // line 12
        echo "新蜂游戏平台-新手指南
";
    }

    // line 15
    public function block_content($context, array $blocks = array())
    {
        // line 16
        echo "<div class=\"col-xs-8\">
    ";
        // line 17
        $this->env->loadTemplate("article_tablist.html")->display($context);
        // line 18
        echo "    <div class=\"panel p30\">
        <h2 class=\"sTitle\">
            <span class=\"icon icon-rank-b\"></span>
                <span class=\"bl1\">
                  <span class=\"uppercase\">Guide</span><br>新手指南
                </span>

            <div class=\"input-group pull-right input-r\">
            </div>
            <!-- /input-group -->
        </h2>
        <div>
            <div class=\"row nopd border bg-blueL\">
                <div class=\"col-xs-2\">
                    <div class=\"leftSide pt30 pb30 pl10\">
                        <ul class=\"nav nav-pills nav-stacked\" role=\"tablist\" id=\"rules\">
                            <li class=\"active\"><a href=\"javascript:;\">诈金花</a></li>
                <!--            <li><a href=\"javascript:;\">普通规则</a></li>
                            <li><a href=\"javascript:;\">杠牌</a></li>
                            <li><a href=\"javascript:;\">胡牌</a></li>
                            <li><a href=\"javascript:;\">大胡</a></li>
                            <li><a href=\"javascript:;\">包胡</a></li>
                            <li><a href=\"javascript:;\">算番</a></li>
                            <li><a href=\"javascript:;\">封顶</a></li>-->
                        </ul>
                    </div>
                </div>
                <div class=\"col-xs-10 bg-white\" >
                    <div class=\"p30 textCon\" id=\"content_0\">
                        <img src=\"";
        // line 47
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/images/introduce/zjh.jpg\" style=\"width: 430px;\" />
                        <br/><br/>
                        <p>《诈金花》2人即可对战，最多6人参与，不逃跑的就要押注，由挺到最后的玩家收走全部筹码。</p>

                        <p>游戏采用54张牌去除大小王，拿牌之前大家先将约定锅底投入，然后每人拿三张牌，拿牌之后开始下注。经过一番胆识较量后，用户会放弃跟加，当仅剩下两个用户，或者当局者已经到达了下注上限时统一开牌。按照&ldquo;比较规则&rdquo;决定胜负。是一种既比胆略又比智慧的游戏，现实中不同的心理因素之间的较量成为了该游戏的一大特色。</p>

                        <p>&nbsp;</p>

                        <p><strong>牌型</strong></p>

                        <p>豹子：三张点相同的牌。例：AAA、222。</p>

                        <p>顺金：花色相同的顺子。例：黑桃456、红桃789。最大的顺金为花色相同的QKA，最小的顺金为花色相同的123。</p>

                        <p>金花：花色相同，非顺子。例：黑桃368，方块145。</p>

                        <p>顺子：花色不同的顺子。例：黑桃5红桃6方块7。最大的顺子为花色不同的QKA，最小的顺子为花色不同的123。</p>

                        <p>对子：两张点数相同的牌。例：223，334。</p>

                        <p>散牌：三张牌不组成任何类型的牌。</p>

                        <p>特殊：花色不同的235。</p>

                        <p>&nbsp;</p>

                        <p><strong>牌型比较</strong></p>

                        <p>豹子 &gt; 顺金 &gt; 金花 &gt; 顺子 &gt; 对子 &gt; 单张</p>

                        <p>豹子、金花、对子、单张的比较，按照顺序比点的规则比较大小。 牌点从大到小为：A、K、Q、J、10、9、8、7、6、5、4、3、2，各花色不分大小；</p>

                        <p>顺金、顺子按照顺序比点。AKQ&gt; KQJ&gt;&hellip;&gt;32A。</p>

                        <p>特殊牌型在普通时比较大小按单张牌型来算。当豹子存在时，特殊牌型 &gt; 豹子。</p>

                    </div>

                <!--    <div class=\"p30 textCon\" id=\"content_1\" style=\"display:none\">
                        <h4>出牌</h4>
                        <p>凡是抓进或吃、碰、开杠、补牌后，不胡牌便要打出一张牌。<strong>在游戏中不能出（红中、发财、赖子）或（红中、赖子、赖子皮）。</strong></p>
                        <img src=\"";
        // line 88
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/images/introduce/gp.png\" style=\"margin-left:20px;width:180px;\" /><img src=\"";
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/images/introduce/gp2.png\" style=\"margin-left:20px;width:180px;\" />
                        <h4>吃牌</h4>
                        <p>只能吃上家打出的牌，与自己手中的牌可以组成一副顺子，便可以报吃，把组成的顺子摆亮在立牌前。允许吃进（或碰或扛）打出的牌。
                        </p>
                        <img src=\"";
        // line 92
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/images/introduce/cp.png\" style=\"margin-left:150px;width:180px;\" />
                        <h4>碰牌</h4>
                        <p>有人打出的牌与自己手中的对子相同，便可报碰，组成一副刻子并摆亮在立牌前。\"碰\"比\"吃\"优先。
                        </p>\t\t\t<img src=\"";
        // line 95
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/images/introduce/pp.png\" style=\"margin-left:150px;width:180px;\" />
                    </div>

                    <div class=\"p30 textCon\" id=\"content_2\" style=\"display:none\">
                        <p>只要有符合条件而且轮到自己出牌的时候即可随时杠。</p>
                        <img src=\"";
        // line 100
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/images/introduce/kg.png\" style=\"width:400px;\"/>
                        <p>如果这张牌是红中，发财，赖子（或赖子皮），可以直接杠这张牌（将这张牌翻出但是不打出），然后再到整个牌墙的最后开始摸牌。</p>
                        <img src=\"";
        // line 102
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/images/introduce/gp.png\" style=\"margin-left:20px;width:180px;\" /><img src=\"";
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/images/introduce/gp2.png\" style=\"margin-left:20px;width:180px;\" />
                        <p>如果这张牌不是红中、发财、赖子（或赖子皮），而且起牌者已经碰了三张同样的牌了，则可以蓄杠，即将这张牌与已经碰的三张牌放到一起。在此期间，可以发生抢杠，然后再到整个牌墙的最后开始摸牌。</p>
                        <p>如果这张牌不是红中，发财，赖子（或赖子皮），而且起牌者已经有三张同样的牌了(但是不是碰的)，则可以暗杠，即将四张牌背面朝上，然后再到整个牌墙的最后开始摸牌。</p>
                    </div>

                    <div class=\"p30 textCon\" id=\"content_3\" style=\"display:none\">
                        <p>胡牌分为小胡与大胡，小胡牌型如下：</p>
                        <img src=\"";
        // line 109
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/images/introduce/hp3.png\" style=\"margin-left:20px;margin-top:7px;width:400px;\"/>
                        <img src=\"";
        // line 110
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/images/introduce/hp1.png\" style=\"margin-left:20px;margin-top:7px;width:400px;\"/>
                        <img src=\"";
        // line 111
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/images/introduce/hp2.png\" style=\"margin-left:20px;margin-top:7px;margin-bottom:7px;width:400px;\"/>
                        <p>小胡里必须有一对将，即筒、条、万的二、五、八。</p>
                        <img src=\"";
        // line 113
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/images/introduce/jp.png\" style=\"margin-left:20px;width:400px;\"/>
                        <p>此外，在武汉麻将中，胡牌时手牌不能有红中与发财，也不能有四张同样的牌，必须暗杠。在胡牌之前至少有一次开口，如果是在胡牌的那一张牌才开口则不算。</p>
                        <p>硬胡，是指胡牌后没有赖子、赖子被杠、用本身花数胡的情况。
                            软胡，如果有赖子并且充当万能牌使用的情况。
                            一炮单响，只能有一个胡牌者，以庄家逆时针为序。</p>
                    </div>

                    <div class=\"p30 textCon\" id=\"content_4\" style=\"display:none\">
                        <p><strong>碰碰胡</strong>，即所有牌型为AAA，而且至少有一次开口，对牌可以不是将。</p>
                        <img src=\"";
        // line 122
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/images/introduce/pph.png\" style=\"margin-left:20px;margin-top:7px;width:400px;\"/>
                        <p><strong>清一色</strong>，即所有的牌都是同一种花色，例如条、筒、万，牌型需要是小胡的牌型或者碰碰胡的牌型，对牌可以不是将。
                        </p>
                        <img src=\"";
        // line 125
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/images/introduce/qys1.png\" style=\"margin-left:20px;margin-top:7px;width:400px;\"/>
                        <img src=\"";
        // line 126
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/images/introduce/qys3.png\" style=\"margin-left:20px;margin-top:7px;width:400px;\"/>
                        <img src=\"";
        // line 127
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/images/introduce/qys2.png\" style=\"margin-left:20px;margin-top:7px;width:400px;\"/>
                        <p><strong>风一色</strong>，即所有的牌都是东南西北白，这种情况下并不需要碰或者对，但是仍然需要至少碰一次。</p>
                        <img src=\"";
        // line 129
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/images/introduce/fys.png\" style=\"margin-left:20px;margin-top:7px;width:400px;\"/>
                        <p><strong>将一色</strong>，即所有的牌都是2、5、8的条、筒、万，这种情况下并不需要碰或者对，但是仍然需要至少碰一次。</p>
                        <img src=\"";
        // line 131
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/images/introduce/jys.png\" style=\"margin-left:20px;margin-top:7px;width:400px;\"/>
                        <p><strong>全求人</strong>，所有的牌都是吃、碰、杠牌(不含暗杠)，如果是小胡牌型则最后一对牌必须是2、5、8的条、筒、万。</p>
                        <img src=\"";
        // line 133
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/images/introduce/qqr.png\" style=\"margin-left:20px;margin-top:7px;width:400px;\"/>
                        <p><strong>杠上开花</strong>，即在杠牌以后(包括明杠、暗杠、中发赖子杠)起了牌墙的最后一张以后胡牌。</p>
                        <img src=\"";
        // line 135
        echo twig_escape_filter($this->env, twig_constant("STATIC_HOST"), "html", null, true);
        echo "/images/introduce/gsk.png\" style=\"margin-left:20px;margin-top:7px;width:400px;\"/>
                        <p><strong>海底捞</strong>，即起最后一张牌的时候(除了整个牌墙的最后10张牌以外的最后一张)胡牌，但是此牌不能用来杠、也不能打出，只能自摸胡。</p>
                        <p><strong>抢杠</strong>，X已经碰了一张牌，又起到了一张同样的牌可以杠(明杠)的时候，如果其他玩家可以胡这张牌，则称其为抢杠。</p>
                    </div>

                    <div class=\"p30 textCon\" id=\"content_5\" style=\"display:none;height:394px;\">
                        <p>承包者承担所有输点，以下情况承包：</p>
                        <p>1） A放冲给B作全求人，A没听牌，A承包。</p>
                        <p>2） B胡清一色，B的第三次开口对象是A，A承包。</p>
                        <p>3） B抢杠胡，被抢的A承包。</p>
                    </div>

                    <div class=\"p30 textCon\" id=\"content_6\" style=\"display:none;height:394px;\">
                        <p>小胡又称屁胡，基数为1，大胡基数是10。</p>
                        <p>大胡可以叠加，例如同时胡风一色与全求人，即可将基数变为10+10=20，同时胡全求人，风一色与碰碰胡，即为30。</p>
                        <p>红中发财杠1番，赖子杠2番，明杠2番，暗杠2番，吃1番，碰1番，自摸1番，放冲1番，庄家1番，硬胡1番。其中硬胡表示没有癞子或者没有使用赖子混牌，而是用赖子的本来点数胡。</p>
                        <p>如果是蓄杠被抢杠了，蓄杠因为是明杠，仍然算两番。输家输去的点数=基数x2^(番数)（自己与赢家番数之和）。</p>
                        <p>对于风一色、将一色、清一色与碰碰胡，如果是自摸，此时番数比较特殊，为其他番数算完以后得到的2的次方的结果再乘以1.5。</p>
                        <p>海底捞与杠上开花的自摸不算番数。对于大胡来说，庄家不算番。</p>
                    </div>

                    <div class=\"p30 textCon\" id=\"content_7\" style=\"display:none;height:394px;\">
                        <p>每个输家输点最高不超过400，超过400则为400。</p>
                        <p>但是有下列特殊情况则需要调整封顶(在下面开口的定义不仅包括吃、碰、明杠，也包括红中发财赖子杠)：</p>
                        <p>如果输家的最低点数不超过400，则每家输的点数最多是400，如果低于400按照实际点数算。</p>
                        <p>如果每家输的点数都超过400，而且都开口了，则每家都付600(金顶)。</p>
                        <p>如果每家输的点数都超过400，而且有一个或者两个输家没有开口，则没有开口的输家要加付给赢家200，即800(阳光顶)。</p>
                        <p>如果每家输的点数都超过400，而且三家都没有开口，则所有人都付1000(钻石顶)。</p>
                        <p>如果胡的是风一色，则每家不算实际番数，均按照每家输点超过400来算，即只与各输家的开口有关。</p>
                    </div>
                    -->
                </div>
            </div>
        </div>
    </div>
</div>
";
    }

    // line 172
    public function block_script($context, array $blocks = array())
    {
        // line 173
        echo "        <script>
            \$(function(){
                \$(\"#rules\").find('li').each(function(i){
                    \$(this).click(function(){
                        \$(\".textCon\").hide();
                        \$(\"#rules\").find('li').removeClass('active');
                        \$(this).addClass('active');
                        \$(\"#content_\"+i).show();
                    })
                });
            })
        </script>
";
    }

    public function getTemplateName()
    {
        return "userGuide.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  282 => 173,  279 => 172,  238 => 135,  233 => 133,  228 => 131,  223 => 129,  218 => 127,  214 => 126,  210 => 125,  204 => 122,  192 => 113,  187 => 111,  183 => 110,  179 => 109,  167 => 102,  162 => 100,  154 => 95,  148 => 92,  139 => 88,  95 => 47,  64 => 18,  62 => 17,  59 => 16,  56 => 15,  51 => 12,  48 => 11,  43 => 8,  40 => 7,  35 => 4,  32 => 3,);
    }
}
