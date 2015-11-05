<?php
/**
 * Created by PhpStorm.
 * User: shameless
 * Date: 15/7/28
 * Time: 上午9:40
 */

namespace api\games\whmj\controller;


use api\core\GameBase;
use api\libs\Error;
use core\Encoder;
use gamefactory\GameFactory;
use utils\Curl;

/**
 * 问卷调查
 * Class Survey
 * @package api\games\whmj\controller
 */
class Survey extends GameBase{

    function index(){
        $session = $this->_context->_session;
        $uid = $session['uid'];
        $gameFunc = GameFactory::invoke( $this->_context->_game['game_id'] , $this->_context->_gameDB );
        $profile = $gameFunc->readProfile( $uid );
        if($profile['level'] < 5)
                $this->response(null,Error::SURVEY_ANA_LEVEL5);

        $anwsers  = explode(',',$this->input->post('answers'));
        $anwser_field = array();
        for($i = 0;  $i < count($anwsers) ; $i++){
            $anwser_field['q'.$i] = $anwsers[$i];
        }
        $fields = array(
            'uid' => $uid,
            'anwsers' => Encoder::instance()->encode($anwser_field)
        );

        if(!$this->_context->_gameDB->save($fields,'survey'))
            $this->response(null,Error::DATA_WRITE_ERROR);

        $c = new Curl();
        $url = $this->config->common['http_monitor'].'/item-changed?uid='.$uid.'&types=43';
        $c -> setOpt(CURLOPT_RETURNTRANSFER,1);
        $c -> setOpt(CURLOPT_CONNECTTIMEOUT,1);
        $c -> get($url);
        $c -> close();

        $this->response(null);
    }

} 