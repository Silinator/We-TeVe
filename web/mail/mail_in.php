<?php

require_once("phpmailer.php"); // extends achievement
include("class.smtp.php");

class mail extends SMTP{


  public function sendmail($sendto,$subject,$content){
    //$include_check_code = "email*+*%+34621fsgESfg";
    //$mail_v = "2";
    //$user_n = $user_n;
    //include ('../mail_templates/regin_check_code.php');

    $mail = new phpmailer();
    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';


    $mail->Host     = "mail.we-teve.com";
    $mail->Port     = 587;
    $mail->SMTPAuth = true;
    $mail->Username = "service@we-teve.com";
    $mail->Password = "8&m2U.26_k!h2W!T";
    $mail->From     = "service@we-teve.com";
    $mail->FromName = "We-TeVe Service";

    $mail->AddAddress($sendto);
    $mail->IsHTML(true);
    $mail->Subject     = $subject;
    $mail->Body     =  $content;

    if(!$mail->Send())
       {}
  }

}

$m = new mail;


?>
