<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/7/29
     * Time: 上午10:29
     */

    namespace gms\controller;


    use core\Encoder;
    use gms\core\AdminController;

    class Survey extends AdminController
    {

        function whmj(){

            $this->init_navigator();

            $questions = array(
                    'q0' => array(
                        'question' => '年龄',
                        'anwsers' => array(
                            0 => '0-18',
                            1 => '18-29',
                            2 => '30-50',
                            3 => '50-100',
                        ),
                    ),
                    'q1' => array(
                        'question' => '玩新蜂武汉麻将多久了?',
                        'anwsers' => array(
                            0 => '才玩3天',
                            1 => '一个星期',
                            2 => '一个月',
                            3 => '很久很久了吧'
                        )
                    ),
                    'q2' => array(
                         'question' => '对于武汉麻将来说,您觉得您的水平是?',
                        'anwsers' => array(
                            0 => '菜鸟',
                            1 => '一般',
                            2 => '高手',
                            3 => '大师'
                        )
                    ),
                  'q3' => array(
                      'question' => '您愿意充值购买VIP吗?',
                      'anwsers' => array(
                          0 => '不愿意',
                          1 => '可以考虑',
                          2 => '愿意'
                      )
                  ),
                    'q4' => array(
                        'question' => '您觉得游戏哪些地方需要改进?',
                        'anwsers' => array(
                            0 => '画面',
                            1 => '玩法',
                            2 => '奖品',
                            3 => '活动',
                            4 => '帮助'
                        )
                    )
            );

            $gameDB = $this->getGameDB();
            $sql = "SELECT anwsers FROM survey";
            $gameDB->execute($sql);
            $result = $gameDB->fetch_all();

           foreach($questions as $q => &$question){
                    $anwsers  = array_keys($question['anwsers']);
                    for($i  = 0 ; $i < count($anwsers) ; $i++){
                        $num = 0;
                        foreach($result as $qa){
                            $qa = Encoder::instance()->decode($qa['anwsers']);
                            if(strpos($qa[$q],'-') > -1){//判断多选
                                    $qs = explode('-',$qa[$q]);
                                     if(in_array($anwsers[$i],$qs))
                                         $num++;
                            }else{
                                if($qa[$q] == $anwsers[$i])
                                    $num++;
                            }
                        }
                        $question['anwsers'][$i] = array($question['anwsers'][$i],$num);
                    }
           }
          $this->output_data['questions'] = $questions;
          $this->render('survey.html');
        }

    }