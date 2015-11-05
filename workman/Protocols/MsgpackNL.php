<?php

    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/10/29
     * Time: 16:07
     */
    namespace Protocols;

    class MsgpackNL
    {
        /**
         * 检查包的完整性
         * 如果能够得到包长，则返回包的在buffer中的长度，否则返回0继续等待数据
         * 如果协议有问题，则可以返回false，当前客户端连接会因此断开
         * @param string $buffer
         * @return int
         */
        public static function input($buffer)
        {
            if(strlen($buffer) < 4)
                return 0;
            $unpackData = unpack('lpacketHead',$buffer);
            return $unpackData['packetHead'];
        }

        /**
         * 打包，当向客户端发送数据的时候会自动调用
         * @param string $buffer
         * @return string
         */
        public static function encode($buffer)
        {
            $data = msgpack_pack($buffer);
            $dataLen = 4 + strlen($data);
            return pack('l',$dataLen).$data;
        }

        /**
         * 解包，当接收到的数据字节数等于input返回的值（大于0的值）自动调用
         * 并传递给onMessage回调函数的$data参数
         * @param string $buffer
         * @return string
         */
        public static function decode($buffer)
        {
            $data = substr($buffer,4);
            return msgpack_unpack($data);
        }
    }