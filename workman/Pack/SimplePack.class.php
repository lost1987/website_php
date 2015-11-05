<?php

    /**
     * Created by PhpStorm.
     * User: 卜峘
     * Date: 15/10/29
     * Time: 19:56
     * 需要括展 msgpack,socket
     */
    class SimplePack
    {

        protected $_recvBuffer = '';

        protected $_remainBuffer = '';

        /**
         * 打包协议
         * @param $data
         * @return string
         */
        function pack($data){
            $data = msgpack_pack($data);
            $len = strlen($data) + 4;
            return pack('l',$len).$data;
        }

        /**
         * 解包协议
         * @param $buffer
         * @return mixed
         */
        function unpack($buffer){
            $data = substr($buffer,4);
            return msgpack_unpack($data);
        }

        /**
         * 在循环接收中 解包服务器发来的字节流(已处理黏包)
         * @param $streamBuffer stream_socket_recvfrom 接收的字节
         * @return mixed|null   如果长度不够则返回null  如果长度足够则解包出数据
         */
        function breakup($streamBuffer){
            $this->_recvBuffer= $streamBuffer;
            //拿到包长度
            if($this->_remainBuffer != ''){
                $this->_recvBuffer = $this->_remainBuffer.$this->_recvBuffer;
            }

            $head = substr($this->_recvBuffer,0,4);
            $packet = unpack('lplen',$head);
            $len = $packet['plen'];

            if(strlen($this->_recvBuffer) < $len){
                $this->_remainBuffer = $this->_recvBuffer;
                return null;
            }else{
                $unpackBuffer = substr($this->_recvBuffer,0,$len);
                $data = $this->unpack($unpackBuffer);
                $this->_remainBuffer = substr($this->_recvBuffer,$len);
                return $data;
            }
        }
    }