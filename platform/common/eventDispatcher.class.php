<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/9/29
     * Time: 下午3:42
     */

    namespace common;
    use core\Base;
    use core\Encoder;
    use core\Pusher;
    use core\Singleton;

    /**
     * 事件分发器
     * Class EventDispatcher
     * @package common
     */
    class EventDispatcher extends Singleton
    {
        protected static  $_instance = null;
        /**
         * @param  int $event
         * @param array $data
         */
        function dispatch($event,$data){
                $msgpack['event'] = $event;
                $msgpack['data'] = $data;
                $msgpack = Encoder::instance()->encode($msgpack,Encoder::MSGPACK);
                $zmq = new Pusher($this->config->common['zmq_socket']);
                $zmq->push($msgpack);
        }

    }