<?php
    /**
     * Created by PhpStorm.
     * User: shameless
     * Date: 14/10/28
     * Time: 上午9:21
     * gms管理后台专用
     */

    namespace gms\core;


    use common\model\GameAreaModel;
    use core\Base;
    use core\Configure;
    use core\Cookie;
    use core\DB;
    use core\Encoder;
    use core\Permission;
    use core\Redirect;
    use core\Redis;
    use gms\libs\AdminUtil;
    use gms\libs\Error;
    use gms\libs\GameServer;
    use gms\model\Module_M;
    use utils\Tools;

    class AdminController extends Base
    {

        protected $output_data = null;

        function  __construct()
        {
            Cookie::instance()->csrf_set_cookie();//如果csrf_token为空 则生成csrf token
            AdminUtil::instance()->check_login();
        }

        /**
         * 验证csrf token
         * @param bool $update_after_validation 是否验证通过后更新token
         * @param      $_token                  如果主动传入token 则只验证传入的token,不会验证$_POST请求中的csrf_token
         * @throws \Exception
         */
        function csrf_token_validation( $update_after_validation = true , $_token = null )
        {
            $config = Configure::instance();
            $cookie = Cookie::instance();
            $csrf_token_name = $config->gms['csrf']['token_name'];
            if ( !empty( $_token ) )
                $token = $_token;
            else
                $token = $this->input->get_post( $csrf_token_name );

            $csrf_cookie = $cookie->get_csrf_cookie();

            if ( $token != $csrf_cookie ) {
                if ( Tools::is_ajax_req() )
                    $this->response( null , Error::CSRF_TOKEN );
                else
                    $this->set_error( Error::CSRF_TOKEN );
            }

            if ( $update_after_validation )
                $cookie->csrf_update_cookie();

            unset( $_POST[ $csrf_token_name ] );
        }

        /**
         * 初始化管理员资料
         */
        private function init_profile()
        {
            $session_data = AdminUtil::instance()->session_data();
            $this->output_data['session'] = $session_data;
        }

        /**
         * 初始化导航 并过滤权限
         */
        protected function init_navigator()
        {
            $this->init_profile();//初始化上层用户导航资料

            $modules = Module_M::instance( true )->listCache();

            $module_root_sel_id = $this->args[0];

            $root_modules = array();
            $child_modules = array();

            foreach ( $modules as $module ) {
                if ( $module['pid'] == 0 )
                    $root_modules[ $module['id'] ] = $module;
                else
                    $child_modules[ $module['id'] ] = $module;
            }

            $permission = Permission::instance();
            if ( !AdminUtil::instance()->is_administrator() ) {
                $permissions = AdminUtil::instance()->permissions();
                if ( !empty( $permissions ) ) {
                    $deleted_modules = array();//被删除的模块
                    foreach ( $child_modules as $k => $v ) {//子模块过滤
                        if ( !$permission->hasPermission( $permissions[ $v['pid'] ]['admin_permission'] , $v['module_permission'] ) ) {
                            unset( $child_modules[ $k ] );
                            if ( !isset( $deleted_modules[ $v['pid'] ] ) )
                                $deleted_modules[ $v['pid'] ] = 0;
                            $deleted_modules[ $v['pid'] ] |= $v['module_permission'];
                        }
                    }

                    //父模块权限过滤
                    foreach ( $deleted_modules as $deleted_modules_id => $deleted_module_permission ) {
                        foreach ( $root_modules as $k => $v ) {
                            if ( $v['id'] == $deleted_modules_id && $deleted_module_permission == $v['module_permission'] ) {
                                unset( $root_modules[ $k ] );
                                break 1;
                            }
                        }
                    }
                } else {
                    $root_modules = null;
                    $child_modules = null;
                }
            }

            $this->output_data['modules_root'] = $root_modules;//根导航
            $this->output_data['modules_child'] = $child_modules;//子导航
            $this->output_data['module_root_sel_id'] = $module_root_sel_id;//被选中的根导航

            //读取服务器分类
            $this->output_data['servers'] = GameAreaModel::instance()->servers( 1 );
            $serverJson = Cookie::instance()->userdata( 'server' );
            if ( !empty( $serverJson ) ) {
                $server = Encoder::instance()->decode( $serverJson );
                $this->output_data['currentServer'] = $server['name'];
            } else
                $this->output_data['currentServer'] = '请选择服务器';
        }

        /**
         * 默认将传递output_data,因为output_data中包含导航数据
         */
        protected function render( $template )
        {
            if ( empty( $this->output_data ) )
                $this->tpl->display( $template );
            else
                $this->tpl->display( $template , $this->output_data );
        }


        /**
         * 输出json,并终止程序
         * @param     $data
         * @param int $error
         * @throws \Exception
         */
        protected function response( $data , $error = 0 )
        {
            $response = array(
                'error' => $error ,
                'data'  => $data
            );

            die( Encoder::instance()->encode( $response ) );
        }


        /**
         * 将错误代码显示 并跳入错误页面
         * @param $error_code  Error::XXXX
         */
        protected function set_error( $error_code )
        {
            Redirect::instance()->forward( '/error/code/' . $error_code );
        }

        /**
         * 单服/单例
         * 得到当前的游戏数据库对象
         */
        protected function getGameDB()
        {
            $server_data = Cookie::instance()->userdata( 'server' );
            if ( empty( $server_data ) )
                throw new \Exception( '您未选择游戏服务器' );
            if ( empty( $this->_game_server ) ) {
                $server = Encoder::instance()->decode( $server_data );
                $this->_game_server = new DB();
                $this->_game_server->init_db( $server );
                $this->bindProperty( '_game_server' , $this->_game_server );
            }

            return $this->_game_server;
        }

        /**
         * 去除重写后的c,m,params 这些参数的$_GET
         * 提供纯净的表单get参数
         */
        protected function http_get_params()
        {
            $get = array();
            $key_filter = array( 'c' , 'm' , 'params' );
            foreach ( $this->input->get() as $k => $v ) {
                if ( !in_array( $k , $key_filter ) )
                    $get[ $k ] = $v;
            }

            return $get;
        }
    }