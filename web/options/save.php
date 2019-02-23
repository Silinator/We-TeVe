<?php
//1. Pfad zum Stammverzeichniss wo sich die index befindet
$_hp = '../'; //für includes
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ('../include/all_include.php'); //haupt include


if($isUserLoggedIn === 1){

//3. vals
$username   = mysqli_real_escape_string(db::$link,$_POST['username']);
$username_s = strtolower($username);
$mail       = mysqli_real_escape_string(db::$link,$_POST['mail']); $mail = strtolower($mail);
$emails     = hash('sha256',$mail);  $emails = sha1($emails);
$pwd        = mysqli_real_escape_string(db::$link,$_POST['pwd']);
$new_pwd    = mysqli_real_escape_string(db::$link,$_POST['new_pwd']);

$land       = mysqli_real_escape_string(db::$link,$_POST['land']);
$lang       = mysqli_real_escape_string(db::$link,$_POST['lang']);

$user_uuif  = sha1(sha1($user_uuid));
$time       = strtotime(date('Y-m-d H:i:s'));


//checks
  $error = 0;

  //username
  if(strlen($username) > 25 && $error == 0)                                     { $error = 1; echo "11"; }

  $user_check = preg_replace('/\s+/', '', $username);
    if(strlen($user_check) < 1 && $error == 0)                                  { $error = 1; echo "12"; }

  $user_check2 = preg_replace("/[^A-Za-z0-9_-]/", '', $username);
    if($user_check2 != $username && $error == 0)                                { $error = 1; echo "13"; }

  $user_check3 = strtolower($username);
  $user_sql = db::$link->query("SELECT uuid FROM user_find_db WHERE user_name_s = '$user_check3' AND uuid != '$user_uuid'");
  $user_row = $user_sql->fetch_assoc();
  if($user_row['uuid'] != "" && $error == 0)                                     { $error = 1; echo "14"; }


  //get old_name
  $user_name_sql = db::$link->query("SELECT user_name FROM user_find_db WHERE uuid = '$user_uuid'");
  $user_name_row = $user_name_sql->fetch_assoc();
  $old_name = $user_name_row['user_name'];

  if($old_name != $username){
    //yt-username check
    $key = $_google_api;

    if(isset($_POST['at']) AND $_POST['at'] != "" ){

      if( $_curl_installed == "true"){
        $html = 'https://www.googleapis.com/youtube/v3/channels?part=id&mine=true&access_token='.$_POST['at'];
        $curl = curl_init($html); curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); $return = curl_exec($curl); curl_close($curl); $decoded = json_decode($return, true);
        foreach ($decoded['items'] as $items) {
          $a_user_key = $items['id'];
        }
      }else{
        $html = 'https://www.googleapis.com/youtube/v3/channels?part=id&mine=true&access_token='.$_POST['at'];
        $response = file_get_contents($html); $decoded = json_decode($response, true);
        foreach ($decoded['items'] as $items) {
          $a_user_key = $items['id'];
        }
      }
    }else{
      $a_user_key = "";
    }

    if( $_curl_installed == "true"){
      $html = "https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername=".$user_check3."&key=".$key;
      $curl = curl_init($html); curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); $return = curl_exec($curl); curl_close($curl); $decoded = json_decode($return, true);
      foreach ($decoded['items'] as $items) {
        $yt_user_id     = $items['id'];
        $yt_user_subs   = $items['statistics']['subscriberCount'];
      }
    }else{
      $html = "https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername=".$user_check3."&key=".$key;
      $response = file_get_contents($html); $decoded = json_decode($response, true);
      foreach ($decoded['items'] as $items) {
        $yt_user_id     = $items['id'];
        $yt_user_subs   = $items['statistics']['subscriberCount'];
      }
    }

      if(isset($yt_user_id) AND isset($yt_user_subs)){
        $google_sql = db::$link->query("SELECT g_channel_id FROM google_db WHERE g_channel_id = '$yt_user_id' AND uuid = '$user_uuid'");
        $google_row = $google_sql->fetch_assoc();
          if($google_row['g_channel_id'] != ""){
            $a_user_key = $google_row['g_channel_id'];
          }

        if($yt_user_subs > 50000 && $error == 0){
          if($a_user_key == "")                                                   { $error = 1; echo "15"; }
          if(!isset($a_user_key) && $error == 0)                                  { $error = 1; echo "15"; }
          else{
            if($yt_user_id != $a_user_key && $error == 0)                         { $error = 1; echo "16"; }
          }
        }
      }


    $settings_sql = db::$link->query("SELECT * FROM setting_db WHERE uuid = '$user_uuid'");
    $settings_row = $settings_sql->fetch_assoc();
      $last_name_update = $settings_row['last_name_update'];
        if($last_name_update + 18144000 > $time && $error == 0)                   { $error = 1; echo "18"; }

  }//end if old_name != username


  //email
  $mail_check = preg_replace('/\s+/', '', $mail);
    if(strlen($mail_check) < 1 && $error == 0)                                  { $error = 1; echo "21"; }

  if(filter_var($mail, FILTER_VALIDATE_EMAIL) == false && $error == 0)          { $error = 1; echo "22"; }

  $mail_sql = db::$link->query("SELECT uuid FROM user_db WHERE email_s = '$emails' AND email_verified = '1' AND uuif != '$user_uuif'");
  $mail_row = $mail_sql->fetch_assoc();
  if($mail_row['uuid'] != "" && $error == 0)                                    { $error = 1; echo "23"; }


  $new_mail_sql = db::$link->query("SELECT email_s,emailcode FROM user_db WHERE uuif = '$user_uuif'");
  $new_mail_row = $new_mail_sql->fetch_assoc();
  if($new_mail_row['email_s'] != $emails && $error == 0){

    $new_mail_code = mysqli_real_escape_string(db::$link,$_POST['new_mail_code']);
    $new_mail_code_2 = sha1($new_mail_code);
      if($new_mail_code == "" OR $new_mail_code_2 != $new_mail_row['emailcode']){
        //set new code
        $regincode = $f->mk_code('8');
        $regincode_2 = sha1($regincode);
        $eintrag_regincod = "Update user_db SET emailcode='$regincode_2' WHERE uuif = '$user_uuif'";
        $eintrag_regincod = db::$link->query($eintrag_regincod);

        //send new mail to new mailadress
        $new_email = $mail;
        $mt->get_mail_content($new_email,'new_mail_code',$user_name,$regincode);

        $error = 1; echo "24";
      }
  }


  //pw
  if(strlen($pwd) < 1 && $error == 0)                                           { $error = 1; echo "31"; }

  //land
  $lands = array(
    'eg' => '','dz' => '','ar' => '','au' => '',
    'bh' => '','be' => '','ba' => '','br' => '',
    'bg' => '','cl' => '','dk' => '','de' => '',
    'ee' => '','fi' => '','fr' => '','ge' => '',
    'gh' => '','gr' => '','hk' => '','in' => '',
    'id' => '','iq' => '','ie' => '','is' => '',
    'il' => '','it' => '','jm' => '','jp' => '',
    'ye' => '','jo' => '','ca' => '','kz' => '',
    'qa' => '','ke' => '','co' => '','hr' => '',
    'kw' => '','lv' => '','lb' => '','li' => '',
    'lt' => '','lu' => '','mk' => '','my' => '',
    'ma' => '','mx' => '','me' => '','np' => '',
    'nz' => '','nl' => '','ng' => '','no' => '',
    'om' => '','at' => '','pw' => '','pk' => '',
    'pe' => '','ph' => '','pl' => '','pt' => '',
    'pr' => '','ro' => '','ru' => '','sa' => '',
    'se' => '','ch' => '','sn' => '','rs' => '',
    'zw' => '','sg' => '','sk' => '','si' => '',
    'es' => '','lk' => '','za' => '','kr' => '',
    'tw' => '','tz' => '','th' => '','cz' => '',
    'tn' => '','tr' => '','ug' => '','ua' => '',
    'hu' => '','us' => '','ae' => '','gb' => '',
    'vn' => '','by' => ''
  );
  $land_check = str_replace(array_keys($lands),array_values($lands), $land);
    if(strlen($land_check) > 0 AND $error == 0)                                 { $error = 1; echo "51"; }


  //lang
  $langs = array(
    'en' => '','de' => ''
  );
  $lang_check = str_replace(array_keys($langs),array_values($langs), $lang);
    if(strlen($lang_check) > 0 AND $error == 0)                                 { $error = 1; echo "61"; }


//updates wenn keine Fehler
if($error == 0){

  //login
  $inputpw = $pwd;

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

      $ver_name       = $f->ver($username,$key,$key2);
      $ver_name_s     = $f->ver($username_s,$key,$key2);
      $ver_mail       = $f->ver($mail,$key,$key2);
        $email        = $ver_mail;
        $emails       = hash('sha256',$mail);
        $emails       = sha1($emails);
        $mail         = $u->userin('mail',0,$user_uuif,'');
        $old_mail     = $u->userin('mail',1,$user_uuif,'');

      $ver_land       = $f->ver($land,$key,$key2);
      $ver_lang       = $f->ver($lang,$key,$key2);


      //new PW
      if($new_pwd != $pwd AND $new_pwd != "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855"){
        $hashpw         = $new_pwd.$salt;
        $hashpw         = sha1($hashpw);
        $hashpw         = hash('sha256', "$hashpw");
        $pw             = hash('sha256', "$hashpw");

        $up_pw = "UPDATE user_db SET uukf = '$pw' WHERE uuif = '$user_uuif'";  $up_pw = db::$link->query($up_pw );

        //usercode
        $rand           = $f->mk_key('32');
        $usercode       = hash('sha256',$rand.$user_uuif);
        $usercode       = sha1($usercode);              //uc        uc --> cookie    =   uc -> sha1 + sha256 -> cookie
        $usercode2      = sha1($usercode);
        $usercode2      = hash('sha256', "$usercode2"); //cookie    cookie --> uc2   =   cookie -> sha256 + sha1 -> uc2
        $usercode3      = hash('sha256', "$usercode2");
        $usercode3      = sha1($usercode3);             //uc2

        $uc             = $usercode;
        $uc2            = $usercode3; //in der db ist uc mit uc2 vertauscht

        $up = "UPDATE user_db SET uukc = '$uc2' WHERE uuif = '$user_uuif'";  $up = db::$link->query($up);
        $up = "UPDATE user_db SET uukd = '$uc' WHERE uuif = '$user_uuif'";  $up = db::$link->query($up);

          echo "new_pw";
      }

      //user_db
      if($old_name != $username){
        $up_name  = "UPDATE user_db SET user_name = '$ver_name' WHERE user_name != '$ver_name' AND uuif = '$user_uuif'";  $up_name = db::$link->query($up_name);
        $up       = "UPDATE user_db SET user = '$ver_name_s' WHERE user != '$ver_name_s' AND uuif = '$user_uuif'";        $up = db::$link->query($up);
        $up       = "UPDATE setting_db SET last_name_update = '$time' WHERE uuid = '$user_uuid'";                         $up = db::$link->query($up);

      }
      $up_mail = "UPDATE user_db SET email = '$email' WHERE email != '$email' AND uuif = '$user_uuif'";           $up_mail = db::$link->query($up_mail);
      $up = "UPDATE user_db SET email_s = '$emails' WHERE email_s != '$emails' AND uuif = '$user_uuif'";          $up = db::$link->query($up);
      $up = "UPDATE user_db SET land = '$ver_land' WHERE land != '$ver_land' AND uuif = '$user_uuif'";            $up = db::$link->query($up);
      $up = "UPDATE user_db SET sprache = '$ver_lang' WHERE sprache != '$ver_lang' AND uuif = '$user_uuif'";      $up = db::$link->query($up);


      //user_find_db
      if($old_name != $username){
        $up = "UPDATE user_find_db SET user_name = '$username' WHERE user_name != '$username' AND uuid = '$user_uuid'";         $up = db::$link->query($up);
        $up = "UPDATE user_find_db SET user_name_s = '$username_s' WHERE user_name_s != '$username_s' AND uuid = '$user_uuid'"; $up = db::$link->query($up);
      }

      //video_db
      $up = "UPDATE video_db SET user_name = '$username' WHERE user_name != '$username' AND uuid = '$user_uuid'";  $up = db::$link->query($up);

      //setting_db
      $up = "UPDATE setting_db SET last_update = '$time' WHERE uuid = '$user_uuid'";                               $up = db::$link->query($up);

        if($username != $user_name){
          $up = "UPDATE setting_db SET last_name_update = '$time' uuid = '$user_uuid'";                            $up = db::$link->query($up);
        }


      //YouTube name
        //google_db
        if(isset($yt_user_id) AND $a_user_key != ""){
          $set_g_konto = "INSERT INTO google_db
                 (g_channel_id, uuid,    status, data) VALUES
                 ('$yt_user_id','$user_uuid','ok',   '$time')";
          $set_g_konto = db::$link->query($set_g_konto);
        }

      //add Ach
        $ach->add_ach('206','',$user_uuid);

      //send mails
        //pw_change
        if(isset($up_pw) AND $up_pw == true){
          $mt->get_mail_content($mail,'new_pw',$user_name,'');
        }

        //email_change
        if($old_mail != $email){
          $mt->get_mail_content($mail,'new_email',$user_name,'');
        }

    }else{
       echo "32";
    }
  }

}//end if error = 0

}//end isUserLoggedIn
