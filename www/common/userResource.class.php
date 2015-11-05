<?php
    /**
     * Created by PhpStorm.
     * User: lost
     * Date: 14-9-24
     * Time: 上午11:16
     */

    namespace common;

    /***
     * 用户的资源类
     * Class UserResource
     * @package web\libs
     */
    class UserResource
    {
        //action_type
        const ACTION_EXCHANGE = 1;
        const ACTION_LOTTERY = 2;
        const ACTION_PAYMENT = 3;
        const ACTION_REGISTER = 4;
        const ACTION_SETMOBILE = 5;
        const ACTION_CREATE_PRIVATE_ROOM = 6;
        const ACTION_ROUNDEND_EVENT = 7;
        const ACTION_COINS_GIVEN = 8;
        const ACTION_PICKMATCH_PRIZE = 9;
        const ACTION_SIGNUP_KNOCKOUT = 10;
        const ACTION_AUCTION_KNOCKOUT = 11;
        const ACTION_ADD_PRIVATE_ROOM_TIME = 12;
        const ACTION_COINS_RECEIVER = 13;
        const ACTION_SYS_REWARDS = 14;
        const ACTION_KNOCKOUT_TICKET_RETURN = 15;
        const ACTION_PICK_TASK_REWARDS = 16;
        const ACTION_PICK_LOWEST_REWARDS = 17;
        const ACTION_SIGN = 18;
        const ACTION_LEVELUP = 19;
        const ACTION_BUY_VIP = 20;
        const ACTION_ADM_INVITE = 21;
        const ACTION_NEW_YEAR_BAG = 22;
        const ACTION_ADD_FRIEND_ONE = 23;
        const ACTION_ADD_FRIEND_TEN = 24;
        const ACTION_FRAME_LEVELUP = 25;
        const ACTION_MOBAI = 26;
        const ACTION_DIAMONDZJ = 27;
        const ACTION_DIAMOND_TABLE_START = 28;
        const ACTION_DIAMOND_TABLE_RETURN = 29;
        const ACTION_DIAMOND_TABLE_WIN = 30;
        const ACTION_BAOXIANG = 31;
        const ACTION_ADD_FUCHI = 32;
        const ACTION_CPS_OFFER99_ADD_RESOURCE = 100;
    }