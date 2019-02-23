<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = "../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

//3. site vals
$html_title = $l->partner_title." | We-TeVe"; //Tap title


if($isUserLoggedIn === 1){

  if($user_rang == 1){

    $payment_info      = $_POST['payment_1'];
    $payment_topay     = $_POST['payment_3'];
    $payment_topay2    = $_POST['payment_4'];
    $payment_user      = $_POST['user'];

    if($payment_info == "" OR $payment_topay == "" OR $payment_topay2 == "" OR $payment_user == ""){
      echo "error - Fill all inputs";
      $error = 1;
      exit;
    }

    $payment_uuif      = sha1(sha1($payment_user));
    $key               = $u->userin('key',0,$payment_uuif,'');
    $key2              = $u->userin('key2',0,$payment_uuif,'');

    //time
    $time              = strtotime(date('Y-m-d H:i:s'));

    $payment_sql = db::$link->query("SELECT month FROM payments_db WHERE uuif = '$payment_uuif' ORDER BY time DESC");
    $payment_row = $payment_sql->fetch_assoc();

    if($payment_row['month'] == ""){
      $time_month = strtotime(date('Y-m'));
    }else{
      $time_month = strtotime(date('Y-m'));
      if($payment_row['month'] == $time_month){
        echo "already sended in this month!";
        exit;
      }
      $mon_time   = $payment_row['month'];
      $time_month = strtotime(date("Y-m", strtotime("+1 month", $mon_time)));
    }


    //vals
    $time                   = strtotime(date('Y-m-d H:i:s'));
    $user_uuid_ver          = $ver->ver($payment_user,$key,$key2);
    $payment_topay_ver      = $ver->ver($payment_topay,$key,$key2);
    $payment_topay2_ver     = $ver->ver($payment_topay2,$key,$key2);
    $payment_info_ver       = $ver->ver($payment_info,$key,$key2);
    $payment_status_ver     = $ver->ver("sended",$key,$key2);
    $status_ver             = $ver->ver("ok",$key,$key2);

    $set_payment = "INSERT INTO payments_db
      (uuid, uuif, month, paid_xmr, paid, payment_method, payment_status, time, status) VALUES
      ('$user_uuid_ver', '$payment_uuif', '$time_month', '$payment_topay_ver', '$payment_topay2_ver', '$payment_info_ver', '$payment_status_ver', '$time', '$status_ver')";
    $set_payment = db::$link->query($set_payment);

    if($set_payment == true){
      echo "ok";
    }

  }

}
