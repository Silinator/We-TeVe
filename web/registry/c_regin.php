<?php
//1. Pfad zum Stammverzeichniss wo sich die index befindet
$_hp = '../'; //für includes
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ('../include/all_include.php'); //haupt include

//3. vals
$username   = mysqli_real_escape_string(db::$link,$_POST['username']);
$username_s = strtolower($username);
$mail       = mysqli_real_escape_string(db::$link,$_POST['mail']); $mail = strtolower($mail);
$emails     = hash('sha256',$mail);  $emails = sha1($emails);
$pwd        = mysqli_real_escape_string(db::$link,$_POST['pwd']);

$date_day   = mysqli_real_escape_string(db::$link,$_POST['date_d']);
$date_month = mysqli_real_escape_string(db::$link,$_POST['date_m']);
$date_year  = mysqli_real_escape_string(db::$link,$_POST['date_y']);

$land       = mysqli_real_escape_string(db::$link,$_POST['land']);
$lang       = mysqli_real_escape_string(db::$link,$_POST['lang']);
$color      = mysqli_real_escape_string(db::$link,$_POST['color']);

$checked    = mysqli_real_escape_string(db::$link,$_POST['agb']);


//checks
  $error = 0;

  //username
  if(strlen($username) > 25 && $error == 0)                                     { $error = 1; echo "11"; }

  $user_check = preg_replace('/\s+/', '', $username);
    if(strlen($user_check) < 1 && $error == 0)                                  { $error = 1; echo "12"; }

  $user_check2 = preg_replace("/[^A-Za-z0-9_-]/", '', $username);
    if($user_check2 != $username && $error == 0)                                { $error = 1; echo "13"; }

  $user_check3 = strtolower($username);
  $user_sql = db::$link->query("SELECT uuid FROM user_find_db WHERE user_name_s = '$user_check3'");
  $user_row = $user_sql->fetch_assoc();
  if($user_row['uuid'] != "" && $error == 0)                                     { $error = 1; echo "14"; }


  //yt-username check
  $key = "AIzaSyB0lfjskQyR175GlFxZoEyuBYdRW9Y0uiQ"; // -> from: https://console.cloud.google.com/apis/credentials?project=weteve-177204&hl=de&authuser=1 (user: CEO we-teve)

  if(isset($_POST['at']) AND $_POST['at'] != "" ){
    /* online
      $html = 'https://www.googleapis.com/youtube/v3/channels?part=id&mine=true&access_token='.$_POST['at'];
      $curl = curl_init($html); curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); $return = curl_exec($curl); curl_close($curl); $decoded = json_decode($return, true);
      foreach ($decoded['items'] as $items) {
        $a_user_key = $items['id'];
      }
    /* */

    /* offline */
      $html = 'https://www.googleapis.com/youtube/v3/channels?part=id&mine=true&access_token='.$_POST['at'];
      $response = file_get_contents($html); $decoded = json_decode($response, true);
      foreach ($decoded['items'] as $items) {
        $a_user_key = $items['id'];
      }
    /* */
  }


  /* online
    $html = "https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername=".$user_check3."&key=".$key;
    $curl = curl_init($html); curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); $return = curl_exec($curl); curl_close($curl); $decoded = json_decode($return, true);
    foreach ($decoded['items'] as $items) {
      $yt_user_id     = $items['id'];
      $yt_user_subs   = $items['statistics']['subscriberCount'];
    }
  /* */

  /* offline */
    $html = "https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername=".$user_check3."&key=".$key;
    $response = file_get_contents($html); $decoded = json_decode($response, true);
    foreach ($decoded['items'] as $items) {
      $yt_user_id     = $items['id'];
      $yt_user_subs   = $items['statistics']['subscriberCount'];
    }
  /* */

    if(isset($yt_user_id) AND isset($yt_user_subs) ){
      if($yt_user_subs > 50000 && $error == 0){
        if(!isset($a_user_key))                                                 { $error = 1; echo "15"; }
        else{
          if($yt_user_id != $a_user_key)                                        { $error = 1; echo "16"; }
        }
      }
    }





  //email
  $mail_check = preg_replace('/\s+/', '', $mail);
    if(strlen($mail_check) < 1 && $error == 0)                                  { $error = 1; echo "21"; }

  if(filter_var($mail, FILTER_VALIDATE_EMAIL) == false && $error == 0)          { $error = 1; echo "22"; }

  $mail_sql = db::$link->query("SELECT uuid FROM user_db WHERE email_s = '$emails' AND email_verified = '1'");
  $mail_row = $mail_sql->fetch_assoc();
  if($mail_row['uuid'] != "" && $error == 0)                                    { $error = 1; echo "23"; }

  //pw
  if(strlen($pwd) < 1 && $error == 0)                                           { $error = 1; echo "31"; }


  //date
  $dateerror = 0;
  if( !is_integer($date_day) AND ($date_day > 31 OR $date_day < 1) AND $error == 0)        { $dateerror = 1; $error = 1; echo "41"; }
  if( !is_integer($date_month) AND ($date_month > 12 OR $date_month < 1)AND $error == 0)   { $dateerror = 1; $error = 1; echo "41"; }

  if($date_year >= 1900 && $date_year <= date("Y"))
  {
    $schaltjahr = 0;

    if(is_integer($date_year / 4) && $date_year != 2000 )
    {
      $schaltjahr = 1;
    }

    if($schaltjahr != 1)
    {
      if($date_month == 2)
      {
        if($date_day == 29)
        {
          $dateerror = 1;
        }
      }
    }

    if($date_month == 2)
    {
      if($date_day == 30)
      {
        $dateerror = 1;
      }
    }


    $day31 = 0;

    if($date_month == 1 || $date_month == 3 || $date_month == 5 || $date_month == 7 || $date_month == 8 || $date_month == 10 || $date_month == 12)
    {
      $day31 = 1;
    }

    if($day31 != 1)
    {
      if($date_day == '31')
      {
        $dateerror = 1;
      }
    }

  }else                                                                         { $error = 1; echo "41"; }

  if($dateerror != 0){
    if($error == 0)                                                             { $error = 1; echo "41"; }
  }else{
    $birthdayvalue = $date_year."-".$date_month."-".$date_day;
    $birthdayvalue = strtotime($birthdayvalue);
    $heutetagvalue = date("Y-m-d");
    $heutetagvalue = strtotime($heutetagvalue);
    if($heutetagvalue - $birthdayvalue >= 441763200){ //14 jahre
      $birthday = $birthdayvalue;
    }else{
      if($error == 0)                                                           { $error = 1; echo "42"; }
    }

  }


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


  //color
  if($color > 6 OR $color < 1)                                                  { $error = 1; echo "71"; }


  //agb
  if($checked != 1)                                                             { $error = 1; echo "81";}


//end checks


// Insert User infos
if($error == 0){

  //keys
  $key            = $f->mk_key('32');
  $key2           = $f->mk_key('32');

  //uuid
  $uuid           = $f->mk_uuid();
  $ver_uuid       = $f->ver($uuid,$key,$key2);
  $sha1_uuid      = sha1(sha1($uuid));

  //usercode
  $rand           = $f->mk_key('32');
  $usercode       = hash('sha256',$rand.$sha1_uuid);
  $usercode       = sha1($usercode);              //uc        uc --> cookie    =   uc -> sha1 + sha256 -> cookie
  $usercode2      = sha1($usercode);
  $usercode2      = hash('sha256', "$usercode2"); //cookie    cookie --> uc2   =   cookie -> sha256 + sha1 -> uc2
  $usercode3      = hash('sha256', "$usercode2");
  $usercode3      = sha1($usercode3);             //uc2

  $uc             = $usercode;
  $uc2            = $usercode3; //in der db ist uc mit uc2 vertauscht
  $uc3            = sha1($f->mk_key(21));

  //PW
  $hashpw         = $pwd.$uc3;
  $hashpw         = sha1($hashpw);
  $hashpw         = hash('sha256', "$hashpw");
  $pw             = hash('sha256', "$hashpw");

  //IP
  $ip             = getenv ("REMOTE_ADDR");
  $host           = gethostbyaddr($ip);

  //time
  $time           = strtotime(date('Y-m-d H:i:s'));

  //ver vars
  $ver_rang       = $f->ver('0',$key,$key2);
  $ver_name       = $f->ver($username,$key,$key2);
  $ver_name_s     = $f->ver($username_s,$key,$key2);
  $ver_mail       = $f->ver($mail,$key,$key2);
  $ver_frinds     = $f->ver('0',$key,$key2);
  $ver_max_frinds = $f->ver('50',$key,$key2);
  $ver_abos       = $f->ver('0',$key,$key2);
  $ver_xp         = $f->ver('0',$key,$key2);
  $ver_level      = $f->ver('0',$key,$key2);
  $ver_max_level  = $f->ver('0',$key,$key2);
  $ver_vpw        = $f->ver('2',$key,$key2);
  $ver_strikes    = $f->ver('0',$key,$key2);
  $ver_blocked    = $f->ver('0',$key,$key2);
  $ver_ip         = $f->ver($ip,$key,$key2);
  $ver_host       = $f->ver($host,$key,$key2);
  $ver_birthday   = $f->ver($birthday,$key,$key2);
  $ver_beitrit    = $f->ver($time,$key,$key2);
  $ver_land       = $f->ver($land,$key,$key2);
  $ver_lang       = $f->ver($lang,$key,$key2);
  $ver_coins      = $f->ver('0',$key,$key2);

  //mail
  $email = $ver_mail;
  $emails = hash('sha256',$mail);
  $emails = sha1($emails);

  //regincode
  $regincode = $f->mk_code('8');
  $regincode_2 = sha1($regincode);

  //color:
  $colors = array(
    '1' => 'blue',
    '2' => 'green',
    '3' => 'red',
    '4' => 'orange',
    '5' => 'white',
    '6' => 'black'
  );
  $color = str_replace(array_keys($colors),array_values($colors), $color);



  //user_db_insert
  $user_db_in = "INSERT INTO user_db
        (uuid,       uuif,        user,         user_name,  user_rang,  uuka,  uukb,   uukc,  uukd, uuke,  uukf,      email,   email_s,  emailcode,ip,      host,       land,       sprache,    beitrit,       birthday,      friends,        max_friends,       abos,      xp,        level,       max_level,       vpw,       strikes,       blocked,       last_online_time,coins) VALUES
        ('$ver_uuid','$sha1_uuid','$ver_name_s','$ver_name','$ver_rang','$key','$key2','$uc2','$uc','$uc3','$pw','$email','$emails','$regincode_2','$ver_ip','$ver_host','$ver_land','$ver_lang','$ver_beitrit','$ver_birthday','$ver_frinds','$ver_max_frinds','$ver_abos','$ver_xp','$ver_level','$ver_max_level','$ver_vpw','$ver_strikes','$ver_blocked','$ver_beitrit',  '$ver_coins')";
  $user_db_in = db::$link->query($user_db_in);

  //"; nur damit es nicht verbugt aussieht
  //channel_design_in
  $channel_design_in = "INSERT INTO channel_design_db
      (uuid,	img, img_data, video, video_data, videobeschreibung, videobeschreibung_data, diskussion, diskussion_data, abonnenten, abonnenten_data, playlist, playlist_data, info, infofulltext, info_full_text, info_title_1, info_text_1, info_title_2, info_text_2, info_title_3, info_text_3, info_title_4, info_text_4, avatar_type, background_type, background_color, nz1, nz2 ,nz3, nz4, nz5, nz6, nz7, nz8, nz9, nz10, nz11, nz12, nz13, nz14, nz15, nz16, nz17, nz18, nz19, nz20, nz21, nz22, nz23, nz24) VALUES
      ('$uuid', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$color', '', '$color', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x')";
  $channel_design_in = db::$link->query($channel_design_in);

  //"; nur damit es nicht verbugt aussieht
  //settings_db
  $settings_db_in = "INSERT INTO setting_db
        (uuid,autoplay,design,last_update) VALUES
        ('$uuid','1','1','$time')";
  $settings_db_in = db::$link->query($settings_db_in);

  //user_find_db
  $user_find_db_in = "INSERT INTO user_find_db
        (uuid,user_name,user_name_s,land,xp,abos,online_status,last_online_time,online_time,status) VALUES
        ('$uuid','$username','$username_s','$land','0','0','offline','$time','0','public')";
  $user_find_db = db::$link->query($user_find_db_in);

  //google_db
  if(isset($yt_user_id)){
    $set_g_konto = "INSERT INTO google_db
           (g_channel_id, uuid,    status, data) VALUES
           ('$yt_user_id','$uuid','ok',   '$time')";
    $set_g_konto = db::$link->query($set_g_konto);
  }

  if($user_db_in == true AND $channel_design_in == true AND $settings_db_in == true AND $user_find_db == true){

    //session


      $_SESSION['user_save'] = "1";
      $_SESSION['user_login'] = $uc;

    //e-mail senden
      $mt->get_mail_content($mail,'regin',$username,$regincode);

    echo "ok";
  }else{
    echo "no ok";
  }

  //echo "uuid: ".$ver_uuid."<br/>user: ".$ver_name_s."<br/>user_name: ".$ver_name."<br/>uuka: ".$key."<br/>uukb: ".$key2."<br/>uukc: ".$uc2."<br/>uukd: ".$uc."<br/>cookie: ".$usercode2."<br/>uuke: ".$uc3;

}



?>
