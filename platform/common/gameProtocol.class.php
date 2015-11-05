<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/31
     * Time: 11:26
     */

    namespace common;


    use core\Encoder;

    /**
     * 游戏平台服务socket协议
     * Class GameProtocol
     * @package common
     */
    class GameProtocol
    {

        const MSG_ID_PLATFORM = 99;

        const MSG_ID_GAMESERVER_CONNECT_REQ = 0;

        const MSG_ID_GAME_ZJH = 2;

        const MSG_ID_GAME_GATEWAY_ZJH = 12;

        const MSG_JSON_HEAD_IS_ONLINE_SEND = '0001';//询问用户是否在线

        const MSG_JSON_HEAD_IS_ONLINE_RECV = '0002';

        const MSG_JSON_HEAD_ITEM_CHANGE = '0003';

        protected $_recvBuffer = '';

        protected $_remainBuffer = '';

        /**
         * @param $data 数据包 json
         * @param $dataMsgHead json数据包头部
         * @param $to   发送去哪里的
         * @param $from 从哪儿来的
         * @return string 返回打包后的字节流
         * @throws \Exception
         */
        function pack($data,$dataMsgHead,$to,$from=self::MSG_ID_PLATFORM){
            $packetData = '';
            if($data != ''){
                $data = $dataMsgHead.Encoder::instance()->encode($data);
                $data = str_split($data,1);
                for($i = 0 ; $i < count($data) ; $i++){
                    $packetData .= pack('c',ord($data[$i]));
                }
            }

            if($packetData != '') {
                $len = strlen( $packetData ) + 12;
                return pack( 'lll' , $len , $from , $to ) . $packetData;
            }else{
                $len = 12;
                return pack('lll', $len, $from , $to);
            }
        }

        /**
         * 解包数据 -  在循环接收中 解包服务器发来的字节流(已处理黏包)
         * @param $buffer stream_socket_recvfrom 接收的字节
         * @return array|bool|null|string 如果长度不够则返回null  如果长度足够则解包出数据
         * @throws \Exception
         */
        function unpack($buffer,$dataMsgHead){
            $data = substr($buffer,12+strlen($dataMsgHead));
            if(!empty($data))
                return Encoder::instance()->decode($data);
            else
                return false;
        }

        /**
         * 在循环接收中 解包服务器发来的字节流(已处理黏包)
         * @param $streamBuffer
         * @return array|null  $data:数据包 $from:从哪儿发来的 $to:发送去哪儿的
         * 接收直接用 list($data,$from,$to) = GameProtocol::instance()->breakup($streamBuffer);
         */
        function breakup($streamBuffer,$dataMsgHead){
            $this->_recvBuffer= $streamBuffer;
            //拿到包长度
            if($this->_remainBuffer != ''){
                $this->_recvBuffer = $this->_remainBuffer.$this->_recvBuffer;
            }

            $head = substr($this->_recvBuffer,0,12);
            $packet = unpack('lplen/lfrom/lto',$head);
            $len = $packet['plen'];
            $to = $packet['to'];
            $from = $packet['from'];
//            Tools::debug_array_log($packet);//打印包头

            if(strlen($this->_recvBuffer) < $len){
                $this->_remainBuffer = $this->_recvBuffer;
                return null;
            }else{
                $unpackBuffer = substr($this->_recvBuffer,0,$len);
                $data = $this->unpack($unpackBuffer,$dataMsgHead);
//                Tools::debug_array_log($data);//打印解包内容
                $this->_remainBuffer = substr($this->_recvBuffer,$len);
                return array($data,$from,$to);
            }
        }


        /**
         * 检查读写超时
         * @param $socket
         * @return bool
         */
        function checkTimeout($socket){
            $streamStatus = stream_get_meta_data($socket);
            if($streamStatus['timed_out'])
                return true;
            return false;
        }

    }