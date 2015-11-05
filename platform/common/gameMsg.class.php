<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/23
     * Time: 10:44
     */

    namespace common;


    use core\ReflectClass;
    use core\SingleNess;
    use utils\Tools;

    class GameMsg extends SingleNess
    {
        protected static $_instance = null;

        /**
         * 给游戏服务端推登陆数据验证 检查玩家是否在线
         * @return array $data
         */
        function pushLoginCheckedPack( $user_id )
        {
                $socket = stream_socket_client( GAME_SOCKET_ADDR , $errno , $errstr , 1 );
                stream_set_blocking($socket,0);
                stream_set_timeout($socket,1);//设置read/write 超时
                if ( empty( $socket ) ) {
                    Tools::debug_log( __CLASS__ , __FUNCTION__ , __FILE__ , '连接socket服务器数据错误:' . $errno . ':' . $errstr );
                    return Error::GAME_CONNECT_FAILED;
                }

                $protocol = new GameProtocol();
                $data = $protocol->pack( '' , GameProtocol::MSG_JSON_HEAD_IS_ONLINE_SEND , GameProtocol::MSG_ID_GAMESERVER_CONNECT_REQ );
                stream_socket_sendto( $socket , $data);

                $rf = new ReflectClass($protocol);
                $consts =$rf->getConstants('MSG_ID_GAME_*');
                $msgIds = array_values($consts);
                $loginState = 0;//无任何错误
                if($protocol->checkTimeout($socket)) {
                    fclose($socket);
                    return $loginState;
                }

                $sendData = array( 'uid' => $user_id );
                foreach ( $msgIds as $msgid ) {
                    $data = $protocol->pack( $sendData , GameProtocol::MSG_JSON_HEAD_IS_ONLINE_SEND , $msgid );
                    stream_socket_sendto( $socket , $data );
                    if($protocol->checkTimeout($socket)) {
                        break;
                    }
                    usleep(5000);
                    if(!feof($socket)) {
                        $recvBuffer = stream_socket_recvfrom($socket,2048);
                        if(empty($recvBuffer)) {
                            error_log('游戏服务器无数据返回,结束socket连接');
                            break;
                        }

                        if($protocol->checkTimeout($socket)) {
                            error_log('读取游戏服务器数据超时,结束socket连接');
                            break;
                        }
                        /**
                         * type UserInGameStateResponse struct { //前缀0002
                         * Uid    string `json:"uid"`
                         * GameId int    `json:"gameid"` //2:扎金花 3:牛牛 4:斗地主 5:十三张
                         * State  int    `json:"state"`  //0:没有 1:在大厅已经踢出 2:在游戏稍后踢出 3.在牌桌上稍后踢出
                         * }
                         */
                        list($data,,) = $protocol->breakup( $recvBuffer,GameProtocol::MSG_JSON_HEAD_IS_ONLINE_RECV );
                        if ( $data === null )
                            continue;

                        if ( $data['state'] != 3 )
                            break 1;
                        else {
                            $loginState = 3;
                            break 1;
                        }
                    }
                }
                fclose($socket);
                return $loginState;
        }

        function itemChangeNotifiction($user_id,$item_cost_type,$item_get_type){
            $socket = stream_socket_client( GAME_SOCKET_ADDR , $errno , $errstr , 1 );
            stream_set_blocking($socket,0);
            stream_set_timeout($socket,1);//设置read/write 超时
            if ( empty( $socket ) ) {
                Tools::debug_log( __CLASS__ , __FUNCTION__ , __FILE__ , '连接socket服务器数据错误:' . $errno . ':' . $errstr );
                return Error::GAME_CONNECT_FAILED;
            }

            $protocol = new GameProtocol();//确认身份
            $data = $protocol->pack( '' , GameProtocol::MSG_JSON_HEAD_IS_ONLINE_SEND , GameProtocol::MSG_ID_GAMESERVER_CONNECT_REQ );
            stream_socket_sendto( $socket , $data);

            $sourceData['uid'] = $user_id;
            $sourceData['itemno'] = array($item_cost_type,$item_get_type);

            $rf = new ReflectClass($protocol);
            $consts =$rf->getConstants('MSG_ID_GAME_*');
            $msgIds = array_values($consts);
            foreach($msgIds as $msgid){
                $sendData = $protocol->pack( $sourceData , GameProtocol::MSG_JSON_HEAD_ITEM_CHANGE , $msgid );
                stream_socket_sendto( $socket , $sendData);
                usleep(5000);
            }
            fclose($socket);
        }

    }