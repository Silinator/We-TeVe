<?php

require_once("phpmailer.php"); // extends achievement
include("class.smtp.php");
require_once( $_hp."../config/mailconfig.php" );

class mail extends SMTP
{

  public function sendmail($sendto,$subject,$content)
  {
    $mail = new phpmailer();
    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';

    $mail->Host     = $_mail_host;
    $mail->Port     = $_mail_port;
    $mail->SMTPAuth = $_mail_SMTPAuth;
    $mail->Username = $_mail_username;
    $mail->Password = $_mail_password;
    $mail->From     = $_mail_from;
    $mail->FromName = $_mail_fromname;

    $mail->AddAddress($sendto);
    $mail->IsHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $content;

    if(!$mail->Send())
       {}
  }

}

$m = new mail;


?>
