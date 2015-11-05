<?php

    namespace utils;
    /**
     * 发送邮件类 需要phpmailer
     * Class Email
     * @package utils
     */
    class Email
    {

        private static $_instance = null;

        /**
         * @var $_phpMailer \PHPMailer
         */
        private $_phpMailer = null;

        function __construct( $config )
        {
            require BASE_PATH . '/libs/PHPMailer/PHPMailerAutoload.php';
            $this->_phpMailer = new \PHPMailer();
//        $mail->SMTPDebug = 3;
            $this->_phpMailer->isSMTP();                                      // Set mailer to use SMTP
            $this->_phpMailer->Host = $config['smtp_host'];  // Specify main and backup SMTP servers
            $this->_phpMailer->SMTPAuth = true;                               // Enable SMTP authentication
            $this->_phpMailer->Username = $config['smtp_user'];                 // SMTP username
            $this->_phpMailer->Password = $config['smtp_pass'];                           // SMTP password
            // $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $this->_phpMailer->Port = $config['smtp_port'];                                    // TCP port to connect to
        }

        /**
         * @param Array $config
         * @return null|Email
         */
        static function instance( $config )
        {
            if ( self::$_instance == null )
                self::$_instance = new self( $config );

            return self::$_instance;
        }

        function phpMailer()
        {
            return $this->_phpMailer;
        }
    }
