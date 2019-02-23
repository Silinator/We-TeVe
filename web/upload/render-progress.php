<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = '../'; // für daten
$upload_in = true;
$isUserLoggedIn = 1;
$usercode_up = $_POST['usercode'];  //like the coockie value

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once($_hp.'include/all_include.php'); //haupt include


$user_uuid = $u->userin('uuid',0,'',$usercode_up);
$user_name = $u->userin('name',0,'',$usercode_up);


$vuid       = $_POST['vuid'];
$time       = 200;
$render_status  = $_POST['status'];

  for ($i=0; $i < $time; $i++) {

    $render_status_sql = db::$link->query("SELECT render_status,max_result FROM video_db WHERE vuid = '$vuid' AND uuid = '$user_uuid'");
    $render_status_row = $render_status_sql->fetch_assoc();
    $max_result = $render_status_row['max_result'];
    $render_status2 = $render_status_row['render_status'];

    if($render_status2 == $render_status OR $max_result == ''){
      sleep(5);
    }else{

      if($_POST['source'] == 'yt'){
               if($max_result == "240"){
            if($render_status2 == "downloaded") { $progressval = "060"; }
            if($render_status2 == "audio")      { $progressval = "100"; }
          }elseif($max_result == "360"){
            if($render_status2 == "downloaded") { $progressval = "055"; }
            if($render_status2 == "audio")      { $progressval = "100"; }
          }elseif($max_result == "480"){
            if($render_status2 == "downloaded") { $progressval = "020"; }
            if($render_status2 == "audio")      { $progressval = "040"; }
            if($render_status2 == "240")        { $progressval = "065"; }
          }elseif($max_result == "720"){
            if($render_status2 == "downloaded") { $progressval = "025"; }
            if($render_status2 == "audio")      { $progressval = "055"; }
            if($render_status2 == "360")        { $progressval = "100"; }
          }elseif($max_result == "1080"){
            if($render_status2 == "downloaded") { $progressval = "020"; }
            if($render_status2 == "audio")      { $progressval = "045"; }
            if($render_status2 == "480")        { $progressval = "075"; }
            if($render_status2 == "240")        { $progressval = "100"; }
          }elseif($max_result == "1440"){
            if($render_status2 == "downloaded") { $progressval = "015"; }
            if($render_status2 == "audio")      { $progressval = "035"; }
            if($render_status2 == "720")        { $progressval = "075"; }
            if($render_status2 == "360")        { $progressval = "100"; }
          }elseif($max_result == "2160"){
            if($render_status2 == "downloaded") { $progressval = "010"; }
            if($render_status2 == "audio")      { $progressval = "025"; }
            if($render_status2 == "1080")       { $progressval = "055"; }
            if($render_status2 == "480")        { $progressval = "080"; }
            if($render_status2 == "240")        { $progressval = "100"; }
          }else{
            $progressval = "error";
          }
      }else{
              if($max_result == "240"){
           if($render_status2 == "uploading")  { $progressval = "011"; }
           if($render_status2 == "audio")      { $progressval = "048"; }
           if($render_status2 == "240")        { $progressval = "100"; }
         }elseif($max_result == "360"){
           if($render_status2 == "uploading")  { $progressval = "023"; }
           if($render_status2 == "audio")      { $progressval = "068"; }
           if($render_status2 == "360")        { $progressval = "100"; }
         }elseif($max_result == "480"){
           if($render_status2 == "uploading")  { $progressval = "014"; }
           if($render_status2 == "audio")      { $progressval = "038"; }
           if($render_status2 == "480")        { $progressval = "065"; }
           if($render_status2 == "240")        { $progressval = "100"; }
         }elseif($max_result == "720"){
           if($render_status2 == "uploading")  { $progressval = "012"; }
           if($render_status2 == "audio")      { $progressval = "026"; }
           if($render_status2 == "720")        { $progressval = "064"; }
           if($render_status2 == "360")        { $progressval = "100"; }
         }elseif($max_result == "1080"){
           if($render_status2 == "uploading")  { $progressval = "010"; }
           if($render_status2 == "audio")      { $progressval = "048"; }
           if($render_status2 == "1080")       { $progressval = "063"; }
           if($render_status2 == "480")        { $progressval = "081"; }
           if($render_status2 == "240")        { $progressval = "100"; }
         }elseif($max_result == "1440"){
           if($render_status2 == "uploading")  { $progressval = "025"; }
           if($render_status2 == "audio")      { $progressval = "045"; }
           if($render_status2 == "1440")       { $progressval = "061"; }
           if($render_status2 == "720")        { $progressval = "083"; }
           if($render_status2 == "360")        { $progressval = "100"; }
         }elseif($max_result == "2160"){
           if($render_status2 == "uploading")  { $progressval = "012"; }
           if($render_status2 == "audio")      { $progressval = "031"; }
           if($render_status2 == "2160")       { $progressval = "053"; }
           if($render_status2 == "1080")       { $progressval = "062"; }
           if($render_status2 == "480")        { $progressval = "088"; }
           if($render_status2 == "240")        { $progressval = "100"; }
         }else{
           $progressval = "error";
         }
      }

      if($progressval != "error"){
        echo $render_status2.$progressval;
      }

      $i = $time;
    }

  }


?>
