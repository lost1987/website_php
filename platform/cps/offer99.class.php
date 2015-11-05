<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/8
     * Time: 下午4:00
     */

    namespace cps;
    use common\Error;
    use common\model\GameAreaModel;
    use common\model\UserResourceLogModel;
    use common\ResourceManager;
    use common\UserResource;
    use core\DB;
    use core\Encoder;
    use gamefactory\GameFactory;
    use utils\Tools;

    /**
     * 易瑞特
     * Class Offer99
     * @package cps
     */
    class Offer99 extends Cps
    {
        /**
         * 一定要有该instance属性,否则会使用父类的instance ,则就会出错
         * @var \cps\Offer99
         */
        protected  static $_instance = null;

        /**
         * 注册后的回调地址
         * @var null
         */
        protected  $_register_call_back_url = 'http://app.offer99.com/callback/callback_adv/callback_adv_i3d9431c0f5f6635b180eb6c2f3cd827.php';

        /**
         * @var null
         * 广告平台分配的加密key
         */
        protected $_ad_key = 'vueggrpwvl';

        /**
         * @var null
         * 分配给广告平台的加密key  16位小写md5
         */
        protected $_secrect_key = '70504d8a38c33921';

        /**
         * 根据广告平台的ID获得广告平台用户关联ID的key
         * @return $platform_id_key 例如: 广告平台传递的request的参数 tid = xxxx  那么tid就是该方法返回的数据
         */
        function  getPlatformIdName ()
        {
            return 'tid';
        }

        /**
         * 给广告商平台的用户增加虚拟货币
         * @param int  $user_id     用户ID
         * @param  int $platform_id 广告平台ID
         */
        function addResource($post ,$platform_id,$area_id)
        {
            /*1001 缺少参数
            **1002 签名错误
             * 1003 tid重复
             * 1004 vcpoints超过最大限额
             * 1005 uid 不存在
             * 1006 非法ip
             * */
            $uid = $post['uid'];
            $tid = $post['tid'];
            $vcpoints = intval($post['vcpoints']);
            $pass = $post['pass'];
            $mysign = md5($uid.$vcpoints.$tid.$this->_secrect_key);
            unset($post['pass']);

            if(preg_match('/^\d+$/',$uid) == 0){
                $post['status'] = 'failure';
                $post['errno'] = 1005;
                die(Encoder::instance()->encode($post));
            }

            if(strlen($tid) != 32){
                $post['status'] = 'failure';
                $post['errno'] = 1001;
                die(Encoder::instance()->encode($post));
            }

            if($pass != $mysign){
                $post['status'] = 'failure';
                $post['errno'] = 1002;
                die(Encoder::instance()->encode($post));
            }

            if($vcpoints > 500000){
                $post['status'] = 'failure';
                $post['errno'] = 1004;
                die(Encoder::instance()->encode($post));
            }

            $sql = "SELECT COUNT(*) as num FROM xf_cps_user_resource_log WHERE trade_no = ? AND platform_id = ?";
            $this->db->execute($sql ,array($tid,$platform_id));
            $result = $this->db->fetch();

            if(intval($result['num']) > 0)
            {
                $post['status'] = 'failure';
                $post['errno'] = 1003;
                die(Encoder::instance()->encode($post));
            }
            unset($result);

            //读取游戏库profile里有没有数据
            $server = GameAreaModel::instance()->read( $area_id );
            $game_id = $server['game_id'];
            $gameDB = new DB();
            $gameDB->init_db( $server );
            $gameFunc = GameFactory::invoke( $game_id , $gameDB );
            $profile = $gameFunc->readProfileDirect($uid);

            if(empty($profile)) {
                $post['status'] = 'failure';
                $post['errno'] = 1005;
                die( Encoder::instance()->encode( $post ) );
            }

            //给用户发邮件
            $json = array(
                'itemtypes'   => array(0) ,
                'itemamounts' => array($vcpoints) ,
                'title'       => '任务奖励',
                'content'     => "您已完成【{$post['offer_name']}】任务，获得{$vcpoints}金币，请领取。" ,
                'got'         => false
            );
            $json = Encoder::instance()->encode($json);

            $fields = array(
                'has_read'          => 0 ,
                'receiver_uid' => $uid,
                'msg_type'          => 8 ,
                'sender'            => 'system' ,
                'msg_time'          => date( 'YmdHi' ) ,
                'msg_jsoned_params' => $json
            );
            $gameDB->save( $fields , 'user_messages' );

            $fields1 = array(
                'user_id' => $uid,
                'trade_no' => $tid,//这里tid为交易号
                'resource_num' => $vcpoints,
                'resource_type' => 0,
                'create_time' =>time(),
                'platform_id' => $platform_id,
                'task_name' => $post['offer_name']
            );

            $this->db->save($fields1,'xf_cps_user_resource_log');

            //写入行为到用户日志
            $fields = array(
                'uid'         => $uid ,
                'tool_type'   => 0 ,
                'tool'        => $vcpoints ,
                'price_type'  => 0 ,
                'price'       => 0 ,
                'action_type' => UserResource::ACTION_CPS_OFFER99_ADD_RESOURCE
            );
            UserResourceLogModel::instance()->save( $fields , $area_id );

            $gameDB->close();
            $this->db->close();
            $post['status'] = 'success';
            die(Encoder::instance()->encode($post));
        }

        function saveRelationShip($user_id , $platform_user_id ,$platform_id){
            $fields = array(
                'user_id' => $user_id,
                'platform_user_id' => $platform_user_id,
                'platform_id' => $platform_id,
                'create_time' => time()
            );

            if(!$this->db->save($fields,'xf_cps_user'))
                throw new \Exception(Error::DB_INSERT_ERROR);

        }

        /**
         * 注册后回调广告平台方法
         * @param int $user_id
         * @param int $platform_user_id
         * @param int $platform_id
         */
        function callCooperAfterRegister( $user_id , $platform_user_id ,$platform_id)
        {
            $this->saveRelationShip($user_id,$platform_user_id,$platform_id);

            $params = array(
                'tid' => $platform_user_id,
                'uid'=>$user_id,
                'ad_key' => $this->_ad_key,
                'sign' => md5($platform_user_id.$user_id.$this->_ad_key),
                'ip' => '115.28.176.103'
            );

            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$this->_register_call_back_url);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT_MS,2000);
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($params));
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            $result =  curl_exec($ch);
            /*
                        error_tid: 交易号错误
                        error_1:  交易号重复处理过
                        error_2:  Ip完成过
                        error_3:  一天内ip段完成过
                        error_safe_filename: 回调文件与交易号不匹配
                        error_callback_ip: 广告方IP加调不正确
                        error_sign:签名不正确
                        success:  成功
            */
            if($result != 'success') {
                Tools::debug_log( __CLASS__ , __FUNCTION__ , __FILE__ , $result );
                throw new \Exception(Error::CURL_RETURN_LOGIC_ERROR);
            }
        }

        /**
         * 提供给广告平台的查询接口
         * @param array $post 查询参数
         * @return mixed
         */
        function roleInfo( $post , $platform_id , $area_id )
        {
            $sign = $post['sign'];

            $response = array(
                'errorcode' => 1,
                'errormsg' => '未查询到任何数据',
                'info' => null
            );

            $mysign = md5($post['startday'].$post['endday'].$this->_secrect_key);
            if($sign != $mysign){
                $response['errorcode'] = 0;
                $response['errormsg'] = 'sign验证失败';
                die(Encoder::instance()->encode($response));
            }

            $sql = "SELECT a.user_id as uid,a.platform_user_id as tid,a.create_time as register_time,b.nickname,b.login_name,b.mobile
                    FROM xf_cps_user a LEFT JOIN xf_user b ON a.user_id = b.user_id WHERE a.platform_id = ? ";

            if(!empty($post['startday']) && !empty($post['endday'])){
                $starttime = strtotime($post['startday']);
                $endtime = strtotime($post['endday']);

                $sql .= " AND a.create_time > $starttime AND a.create_time < $endtime ";
            }

            $this->db->execute($sql,array($platform_id));
            $result = $this->db->fetch_all();

            if(count($result) > 0){
                $server = GameAreaModel::instance()->read( $area_id );
                $gameDB = new DB();
                $gameDB->init_db( $server );

                foreach($result as &$item){
                    $sql = "SELECT SUM(resource_num) as resource_num FROM xf_cps_user_resource_log WHERE user_id = ? AND platform_id = ?";
                    $this->db->execute($sql,array($item['uid'],$platform_id));
                    $log = $this->db->fetch();
                    $item['resource_num'] = empty($log) ? 0 : $log['resource_num'];

                    $item['register_time'] = date('Y-m-d H:i:s',$item['register_time']);
                    $sql = 'SELECT wins FROM gamesummary WHERE player_id = ?';
                    $gameDB->execute($sql,array($item['uid']));
                    $summary = $gameDB->fetch();
                    if(empty($summary))
                        $item['wins'] = 0;
                    else
                        $item['wins'] = $summary['wins'];
                }
                $response['errormsg'] = '';
            }

            $response['info'] = $result;
            die(Encoder::instance()->encode($response));
        }
    }