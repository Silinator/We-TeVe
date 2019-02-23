<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet
$_hp = '../'; //für includes
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include


  if(isset($_POST['ASEG']) AND isset($_POST['FAFR'])){
          $email  = $_POST['ASEG'];
          $email  = mysqli_real_escape_string(db::$link,$email);
          $email  = strtolower($email);

          $emails = hash('sha256',$email);
          $emails = sha1($emails);

          $inputpw = $_POST['FAFR'];

          $keeplogin = $_POST['KELO'];
          if($keeplogin != 1 AND $keeplogin != 0){ $keeplogin = 0;}

          $get_salt = db::$link->query("SELECT * FROM user_db WHERE email_s = '$emails'");
          $get_salt = $get_salt->fetch_assoc();
            $salt = $get_salt['uuke'];

          if($salt != ""){
            $hashpw = $inputpw."".$salt;
            $hashpw = sha1($hashpw);
            $hashpw = hash('sha256', "$hashpw");
            $passwort = hash('sha256', "$hashpw");

            $control = 0;
            $abfrage = db::$link->query("SELECT * FROM user_db WHERE email_s = '$emails' AND uukf = '$passwort'");
            $abfrage = $abfrage->fetch_assoc();

            if($abfrage['uuid'] != ""){
              $control = 1;
            }

            if($control != 0){ $isUserLoggedIn = 2;}


            if($isUserLoggedIn == 2){

              $emailverifier = $abfrage['email_verifier'];
                if($emailverifier === '1'){

                  $regincode = $f->mk_code('8');
                  $regincode_2 = sha1($regincode);
                  $eintrag_regincod = "Update user_db SET emailcode='$regincode_2' WHERE email_s = '$emails'";
                  $eintrag_regincod = db::$link->query($eintrag_regincod);

                  $user_key = $abfrage['uuka'];
                  $user_key2 = $abfrage['uukb'];

                  $user_name = $abfrage['user_name'];
                  $user_name = $f->ent($user_name,$user_key,$user_key2);

                  $usercode = $abfrage['uukd'];
                  //$usercode1 = sha1($usercode);
                  //$usercode2 = sha1($usercode1);

                  $_SESSION['user_login'] = $usercode;

                  if($keeplogin == 1) {
                    $_SESSION['user_save'] = "1";
                  }
              //e-mail senden
                  $mt->get_mail_content($email,'login',$user_name,$regincode);

                  echo "gologin";


                }else{
                  $get_usercode = db::$link->query("SELECT * FROM user_db WHERE email_s = '$emails'");
                  $usercode = $get_usercode->fetch_assoc();

                  $usercode = $usercode['uukd'];
                  $usercode = sha1($usercode);
                  $usercode = hash('sha256', "$usercode");

                  if($keeplogin == 1) {
                    setcookie("usercode", $usercode, time()+2592000, "/");
                  }

                  $_SESSION["usercode"] = $usercode;

                    echo "go";

                }

              }else{ //if login ok
                usleep(200000);
                echo "error";
              }


          }else{
            usleep(200000);
            echo "errormail";
          }



  }elseif(isset($_POST['BECO'])){

    $bc = $_POST['BECO'];
    $bc = $f->normtext($bc);

    $usercode = $_SESSION['user_login'];
    $usercode = $f->normtext($usercode);

    $get_usercode = db::$link->query("SELECT emailcode,uuka,uukb,email FROM user_db WHERE uukd = '$usercode'");
    $regin_code_row = $get_usercode->fetch_assoc();

    $regin_code = $regin_code_row['emailcode'];
    $user_key   = $regin_code_row['uuka'];
    $user_key2  = $regin_code_row['uukb'];

    $email      = $f->ent($regin_code_row['email'],$user_key,$user_key2);
    $emails     = hash('sha256',$email);
    $emails     = sha1($emails);

    if($regin_code == sha1($bc)){

      $regin_sql = db::$link->query("SELECT uuid FROM user_db WHERE email_s = '$emails' AND email_verified = '1'");
      $regin_row = $regin_sql->fetch_assoc();
      if($regin_row['uuid'] == ""){ //email ist bereits von einem Anderen Nutzer bestätigt!
        $eintrag_verified = "Update user_db SET email_verified = '1' WHERE uukd = '$usercode' AND email_verified = '0'";
        $eintrag_verified = db::$link->query($eintrag_verified);
      }

        $eintrag_failed = "Update user_db SET failed_count= '0' WHERE uukd = '$usercode'";
        $eintrag_failed = db::$link->query($eintrag_failed);


        $usercode = sha1($usercode);
        $usercode = hash('sha256', "$usercode");

        if(isset($_SESSION['user_save'])){
          if($_SESSION['user_save'] == 1){$keeplogin = 1;}else{$keeplogin = 0;}
        }else{$keeplogin = 0;}

        if($keeplogin == 1) {
          setcookie("usercode", $usercode, time()+2592000, "/");
        }

        $_SESSION["usercode"] = $usercode;
        echo "go";


    }else{

      $get_failed = db::$link->query("SELECT * FROM user_db WHERE uukd = '$usercode'");
      $get_failed = $get_failed->fetch_assoc(); //gibt nur ein ergebniss raus!
      $failed = $get_failed['failed_count'];

      $user_key  = $get_failed['uuka'];
      $user_key2 = $get_failed['uukb'];

      $user_name = $f->ent($get_failed['user_name'],$user_key,$user_key2);
      $email     = $f->ent($get_failed['email'],$user_key,$user_key2);

      if($failed >= 2){
        $regincode = $f->mk_code('8');
        $regincode_2 = sha1($regincode);
        $eintrag_regincod = "Update user_db SET emailcode='$regincode_2' WHERE uukd = '$usercode'";
        $eintrag_regincod = db::$link->query($eintrag_regincod);

        $eintrag_failed = "Update user_db SET failed_count= '0' WHERE uukd = '$usercode'";
        $eintrag_failed = db::$link->query($eintrag_failed);

      //e-mail senden
        $mt->get_mail_content($email,'login',$user_name,$regincode);

        usleep(200000);
        echo "3_bc_error";
      }else{
        $failed++;
        $eintrag_failed = "Update user_db SET failed_count='$failed' WHERE uukd = '$usercode'";
        $eintrag_failed = db::$link->query($eintrag_failed);

        usleep(200000);
        echo $failed."_bc_error";
      }
    }


  }elseif(isset($_POST['SEBE'])){
    if($_POST['SEBE'] == 1 AND isset($_SESSION['user_login'])){

      $regincode = $f->mk_code('8');
      $regincode_2 = sha1($regincode);
      $usercode = $_SESSION['user_login'];
      $eintrag_regincod = "Update user_db SET emailcode='$regincode_2' WHERE uukd = '$usercode'";
      $eintrag_regincod = db::$link->query($eintrag_regincod);

      $abfrage = db::$link->query("SELECT * FROM user_db WHERE uukd = '$usercode'");
      $abfrage = $abfrage->fetch_assoc(); //gibt nur ein ergebniss raus!

      $user_key  = $abfrage['uuka'];
      $user_key2 = $abfrage['uukb'];

      $user_name = $f->ent($abfrage['user_name'],$user_key,$user_key2);
      $email     = $f->ent($abfrage['email'],$user_key,$user_key2);

      //e-mail senden
      if(isset($_POST['RECO']) AND $_POST['RECO'] == 1){
        $mt->get_mail_content($email,'regin',$user_name,$regincode);
      }else{
        $mt->get_mail_content($email,'login',$user_name,$regincode);
      }

      echo "ok";

    }else{
      usleep(200000);
      echo "error";
    }
  }


?>
