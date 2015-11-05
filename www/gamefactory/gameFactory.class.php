<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/17
     * Time: 上午9:49
     */

    namespace gamefactory;

    use common\model\GamesModel;

    /**
     *游戏工厂类
     */
    class GameFactory
    {

        /**
         * 根据游戏id和数据库实例 来实例化游戏对象
         * @param $game_id
         * @param $gameDB
         * @return \gamefactory\IGameFactory
         */
        static function invoke( $game_id , $gameDB )
        {
            $games = GamesModel::instance()->listCache();
            $className = $games[ $game_id ]['api_factory_name'];
            $class = __NAMESPACE__ . '\\games\\' . $className;
            $reflect = new \ReflectionClass( $class );

            return $reflect->newInstance( $gameDB );
        }

    }