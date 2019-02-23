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

  $user_sql = db::$link->query("SELECT * FROM user_find_db WHERE uuid = '$user_uuid'");
  $user_row = $user_sql->fetch_assoc();
  if($user_row['partner_status'] == 1){

    //login
    $user_uuif  = sha1(sha1($user_uuid));
    $inputpw = mysqli_real_escape_string(db::$link,$_POST['pwd']);

    $get_user_db = db::$link->query("SELECT * FROM user_db WHERE uuif = '$user_uuif'");
    $get_user_db = $get_user_db->fetch_assoc();
      $salt = $get_user_db['uuke'];
      $key  = $get_user_db['uuka'];
      $key2 = $get_user_db['uukb'];

    if($salt != ""){
      $hashpw = $inputpw."".$salt;
      $hashpw = sha1($hashpw);
      $hashpw = hash('sha256', "$hashpw");
      $passwort = hash('sha256', "$hashpw");

      $control = 0;
      $abfrage = db::$link->query("SELECT * FROM user_db WHERE uukf = '$passwort' AND uuif = '$user_uuif'");
      $abfrage = $abfrage->fetch_assoc();

      if($abfrage['uuid'] != ""){

        if(isset($_POST['payment_info']) AND isset($_POST['payment_info_name']) AND isset($_POST['payment_meth'])){

          $error = 0;
          $payment_meth      = $_POST['payment_meth'];
          $payment_info      = $_POST['payment_info'];
          $payment_info_name = $_POST['payment_info_name'];

          if($payment_meth == "iban"){
            if($payment_info == "" OR $payment_info_name == ""){
              echo "error";
              $error = 1;
              exit;
            }
          }else{
            if($payment_info == ""){
              echo "error";
              $error = 1;
              exit;
            }
          }

          if($payment_meth == "paypal"){
            if(filter_var($payment_info, FILTER_VALIDATE_EMAIL) == false){
              echo "error1";
              $error = 1;
              exit;
            }
          }



          if($error == 0 AND ($payment_meth == "iban" OR $payment_meth == "paypal" OR $payment_meth == "monero")){

            $user_uuif = sha1(sha1($user_uuid));
            $key = $u->userin('key',0,$user_uuif,'');
            $key2 = $u->userin('key2',0,$user_uuif,'');

            //vals
            $time                   = strtotime(date('Y-m-d H:i:s'));
            $user_uuid_ver          = $ver->ver($user_uuid,$key,$key2);
            $payment_meth_ver       = $ver->ver($payment_meth,$key,$key2);
            $payment_info_ver       = $ver->ver($payment_info,$key,$key2);
            $payment_info_name_ver  = $ver->ver($payment_info_name,$key,$key2);


            $up_partner0 = "UPDATE partner_db SET methode = '$payment_meth_ver' WHERE uuid = '$user_uuid_ver'"; $up_partner0 = db::$link->query($up_partner0);
            $up_partner1 = "UPDATE partner_db SET payment_info = '$payment_info_ver' WHERE uuid = '$user_uuid_ver'"; $up_partner1 = db::$link->query($up_partner1);
            $up_partner2 = "UPDATE partner_db SET payment_info2 = '$payment_info_name_ver' WHERE uuid = '$user_uuid_ver'"; $up_partner2 = db::$link->query($up_partner2);
            $up_partner3 = "UPDATE partner_db SET time = '$time' WHERE uuid = '$user_uuid_ver'"; $up_partner3 = db::$link->query($up_partner3);

            if($up_partner0 == true AND $up_partner1 == true AND $up_partner2 == true AND $up_partner3 == true){
              $mail = $u->userin('mail','0',$user_uuif,'');
              $mt->get_mail_content($mail,'new_payment',$user_name,'');
              echo "ok";
            }else{
              echo "error2";
            }

          }


        }//end isset

      }else{//pw korrekt
        echo "error3";
      }
    }else{//pw salt set
      echo "error3";
    }

  }//end is partner

}//end logged in
