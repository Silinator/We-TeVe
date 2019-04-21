<?php

if($in_save_code_all_include == "&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z"){

require_once( $_hp."../config/config.php" );

//stammverzeichniss
    //$_hp = für includes
    //$_dhp = für seiten
    //$_ddhp = für bilder und videos

    //für we-teve.com auf $_hpp = "/"; stellen
    $_dhp = $_dhp_path;

  //bilder, video und co: für we-teve.com/we-teve auf $_ddhp = "/"; stellen
    $_ddhp = $_ddhp_path;

// use Minification js
if( $_use_min_files == "true" ) { $min = ".min"; }else{ $min = ""; }

//db_link
$in_save_code_db_include = "X@86AH5K8.pZ_m@6_^-{3BD4cD^s<kF4";
require_once ($_hp.'include/db_in.php'); //class -> db::$link

//ver und entschlüsseln
require_once ($_hp.'include/ver_in.php'); //class -> verschluesseln + extends db

//login and user infos
require_once ($_hp.'login/login_in.php'); //class -> user + extends verschluesseln    $u   session_start();

//language
require_once ($_hp.'language_packs/language_in.php');  //class -> language + extends user  $l

//time
require_once ($_hp.'time/time_in.php'); //class -> time + extends language  $t

//notification / messages
require_once ($_hp.'messages/messages_in.php'); //class -> messages + extends time  $mes

//level
require_once ($_hp.'level/level_in.php'); //class -> level + extends messages $lvl

//achievement
require_once ($_hp.'achievement/achievement_in.php'); //class -> achievement + extends level  $ach

//mail function und phpmailer class
require_once ($_hp.'mail/mail_in.php'); //class -> mail + extends level    $m

//mail_vorlagen function
require_once ($_hp.'mail/mail_temps.php'); //class -> mail + extends mail_temps   $mt

//country/videosprachen_vorlagen function
require_once ($_hp.'countries/country_in.php'); //class -> country + extends mail   $c

//Kommentar_vorlagen function
require_once ($_hp.'comments/comments_in.php'); //class -> comments + extends country  $com

//globale funktionen/class
require_once ($_hp.'include/function_in.php'); //class -> functions + extends comments   $f


if($isUserLoggedIn === 1 OR isset($upload_in)){
  //user_vals
  /*
  $user_id = $u->useri('id','this');
  $user_uuid = $u->useri('uuid','this');
  $user_rang = $u->useri('rang','this');
  $user_name = $u->useri('name','this');
  $user_name_s = $u->useri('name_s','this');
  $user_mail = $u->useri('mail','this');
  $user_abos = $u->useri('abos','this');
  $user_strikes = $u->useri('strikes','this');
  $user_blocked = $u->useri('blocked','this');
  $user_land = $u->useri('land','this');
  $user_lang = $u->useri('lang','this');
  */

  $user_key = $u->userin('key',1,'this','');
  $user_key2 = $u->userin('key2',1,'this','');

  $user_uuid_ver = $u->userin('uuid',1,'this','');           $user_uuid = $u->userin('uuid',0,'this','');
  $user_rang_ver = $u->userin('uuid',1,'this','');           $user_rang = $u->userin('rang',0,'this','');
  $user_name_ver = $u->userin('name',1,'this','');           $user_name = $u->userin('name',0,'this','');
  $user_name_s_ver = $u->userin('name_s',1,'this','');       $user_name_s = $u->userin('name_s',0,'this','');
  $user_xp_ver = $u->userin('xp',1,'this','');               $user_xp = $u->userin('xp',0,'this','');
  $user_level_ver = $u->userin('level',1,'this','');         $user_level = $u->userin('level',0,'this','');
  $user_max_level_ver = $u->userin('max_level',1,'this',''); $user_max_level = $u->userin('max_level',0,'this','');

}


}else{
  header('HTTP/1.1 500!');
  exit();
}
?>
