<?php namespace App;
/**
 * Emails Class
 *
 * @package     Emails
 * @subpackage  Library
 * @category    GoCart
 * @author      Clear Sky Designs
 * @link        http://gocartdv.com
 */
class Emails {

    private static  $config_item = array(
    'smtp_server'=> 'smtp.gmail.com',
    'smtp_port' => '465',
    'smtp_username' => 'oel.shahalam@gmail.com',
    'smtp_password' =>'alam56421'
    );

    function __construct(){}

   private static function config_item($param){

      $config_item = self::$config_item; //  config item
       switch($param){
           case "smtp_server":
               return $config_item[$param];
               break;
           case "smtp_port":
               return $config_item[$param];
               break;
           case "smtp_username":
               return $config_item[$param];
               break;
           case "smtp_password":
               return $config_item[$param];
               break;
           default:
               return false;
               break;
       }

    }


    static function sendEmail($email)
    {

        $mailType = 'smtp';//config_item('email_method');
        if($mailType == 'smtp')
        {
            $transport = \Swift_SmtpTransport::newInstance(self::config_item('smtp_server'), self::config_item('smtp_port'),'ssl')->setUsername(self::config_item('smtp_username'))->setPassword(self::config_item('smtp_password'));
        }
        elseif($mailType == 'sendmail')
        {
            $transport = \Swift_SendmailTransport::newInstance(self::config_item('sendmail_path'));
        }
        else //Mail
        {
            $transport = \Swift_MailTransport::newInstance();
        }
        //get the mailer
        $mailer = \Swift_Mailer::newInstance($transport);

        //send the message
        $mailer->send($email);
    }







}
