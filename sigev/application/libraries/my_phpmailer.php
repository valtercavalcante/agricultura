<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('/phpmailer/PHPMailerAutoload.php'); 
class My_PHPMailer extends PHPMailer{
    //MY_ para informar ao framework de que se trata de uma classe customizada, ou seja, não faz parte do framework. Pode ser alterada no arquivo config.php em application/config/
    public function __construct(){
    	parent::__construct();
    }
}
?>