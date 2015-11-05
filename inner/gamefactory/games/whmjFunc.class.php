<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 15/3/17
     * Time: 上午10:02
     */

    namespace gamefactory\games;

    use common\model\UserModel_M;
    use common\ResourceManager;
    use gamefactory\IGameFactory;
    use gms\libs\Error;

    class WhmjFunc implements IGameFactory
    {

        function __construct( $gameDB )
        {
            $this->gameDB = $gameDB;
        }

        function saveProfile( $fields )
        {
            return $this->gameDB->save( $fields , 'profile' );
        }

        function readProfileDirect($user_id){
            $sql = "SELECT * FROM profile WHERE user_id = ?";
            $this->gameDB->execute( $sql , array( $user_id ) );
            return $this->gameDB->fetch();
        }

        function readProfile( $user_id )
        {
            $sql = "SELECT * FROM profile WHERE user_id = ?";
            $this->gameDB->execute( $sql , array( $user_id ) );
            $profile = $this->gameDB->fetch();
            $profileResource = ResourceManager::instance()->formatToArray( $profile['items'] , $profile['items_num'] );
            return array_merge( $profile , $profileResource );
        }

        function updateProfile( $user_id , $fields )
        {
            return $this->gameDB->update( $fields , 'profile' , ' WHERE user_id = ' . $user_id );
        }

        function payCallBack( Array $order )
        {
            $uid = $order['user_id'];
            $diamond = $order['diamond'];

            $user = UserModel_M::instance()->read( $uid );

            $fields = array(
                'diamond' => intval( $diamond ) + intval( $user['diamond'] )
            );
            unset( $user );

            if ( !$this->updateProfile( $uid , $fields ) )
                throw new \Exception( Error::DATA_WRITE );

            if ( !UserModel_M::instance()->update( $fields , $uid ) )
                throw new \Exception( Error::DATA_WRITE );
        }

        function initProfile( $user_id )
        {
            $fields = array(
                'user_id'   => $user_id ,
                'items'     => '0' ,
                'items_num' => '8000'
            );
            $this->saveProfile( $fields );

            return $fields;
        }

        function gameSummary( $user_id )
        {
            $sql = "SELECT * FROM gamesummary WHERE player_id = ?";
            $this->gameDB->execute( $sql , array( $user_id ) );

            return $this->gameDB->fetch();
        }
    }