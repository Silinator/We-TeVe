<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet
$_hp = '../'; //für include
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

//3. if browser or not
if($_SERVER['HTTP_USER_AGENT'] == ""){
  $only_json = 1;
}else{
  $only_json = 0;
}


if($only_json===1){header('Content-type:application/json;charset=utf-8');}

if($only_json===0){
  echo "<!DOCTYPE html> <html lang='de' dir='ltr'> <head> <title>We-TeVe API</title> <style>#json{word-wrap:break-word;white-space:pre-wrap;}</style> </head> <body> <pre id='json'>";
}


if(isset($_GET['username']) OR isset($_GET['uuid'])){



  if(!empty($_GET['username'])){

    $username = mysqli_real_escape_string(db::$link,$_GET['username']);
    $username = strtolower($username);

    $user_sql = db::$link->query("SELECT * FROM user_find_db WHERE user_name_s = '$username'");
    $user_row = $user_sql->fetch_assoc();


  }elseif(!empty($_GET['uuid'])){

    $uuid = mysqli_real_escape_string(db::$link,$_GET['uuid']);

    $user_sql = db::$link->query("SELECT * FROM user_find_db WHERE uuid = '$uuid'");
    $user_row = $user_sql->fetch_assoc();


  }else{
    //error parameter
    $json = array('status'=> 'error', 'error_msg'=> 'Required parameter: username or uuid');
      echo $json = json_encode($json);

    exit;
  }



  if(!empty($user_row['uuid'])){ //if user exist

      $uuid = $user_row['uuid'];

      //channel_design_db
        $channel_sql = db::$link->query("SELECT * FROM channel_design_db WHERE uuid = '$uuid'");
        $channel_row = $channel_sql->fetch_assoc();


      //user_infos
        $user_name    = $user_row['user_name'];
        $location     = $user_row['land'];
        $channel_info = $channel_row['info_full_text'];
          $order   = array("\r\n", "\n", "\r"); $replace = "\n";
            $channel_info = str_replace($order, $replace, $channel_info);
          $order   = array("<br />", "<br/>", "<br>"); $replace = "";
            $channel_info = str_replace($order, $replace, $channel_info);

        $title_1 = $channel_row['info_title_1'];
        $text_1 = $channel_row['info_text_1'];
        $title_2 = $channel_row['info_title_2'];
        $text_2 = $channel_row['info_text_2'];
        $title_3 = $channel_row['info_title_3'];
        $text_3 = $channel_row['info_text_3'];
        $title_4 = $channel_row['info_title_4'];
        $text_4 = $channel_row['info_text_4'];
          $short_bio = array('titel1'=> $title_1, 'text1'=> $text_1, 'titel2'=> $title_2, 'text2'=> $text_2, 'titel3'=> $title_3, 'text3'=> $text_3, 'titel4'=> $title_4, 'text4'=> $text_4 );


          $user_infos = array('username'=> $user_name, 'uuid'=> $uuid, 'country '=> $location, 'description'=> $channel_info, 'shortBio'=> $short_bio );


      //user_stats
        $subscribers      = $user_row['abos'];
        $xp               = $user_row['xp'];
        $level            = $lvl->lvlinfo('level',$xp);
        $last_activity    = $user_row['last_online_time'];
        $total_only_time  = $user_row['online_time'];


        $result_sql = db::$link->query("SELECT COUNT(*) FROM video_db WHERE uuid = '$uuid' AND status = 'uploaded' AND privacy = 'public'");
        $videos = $result_sql->fetch_row(); $videos = $videos[0];

        $s_time = "0";
          $sql_s_info = db::$link->query("SELECT dauer FROM video_db WHERE uuid = '$uuid' AND status = 'uploaded' AND privacy = 'public'");
          while ($erg_s_info = $sql_s_info->fetch_array())
          {
            $s_time = $s_time + $erg_s_info['dauer'];
          }


          $user_stats = array('subscribers'=> $subscribers, 'xp'=> "$xp", 'level'=> "$level", 'videos'=> "$videos", 'totalVideoDuration'=> "$s_time", 'lastActivity'=> "$last_activity", 'totalOnlyTime'=> "$total_only_time" );


      //user_design

        $avatar             = array('small'=> "https://www.we-teve.com/".$f->draw_avatar($uuid,'small'), 'large'=> "https://www.we-teve.com/".$f->draw_avatar($uuid,'large'));

        if($channel_row['background_type'] == 'png' or $channel_row['background_type'] == 'jpg'){
          $background_img   = "https://www.we-teve.com/images/channel/background/".$uuid.".".$channel_row['background_type'];
        }else{
          $background_img   = "none";
        }

        if($channel_row['background_color'] != ""){
          $background_color = $channel_row['background_color'];
        }else{
          $background_color = "none";
        }

        if($channel_row['img_data'] == 'png' OR $channel_row['img_data'] == 'jpg' OR $channel_row['img_data'] == 'gif' ){
          $banner_img  = "https://www.we-teve.com/images/channel/channel_img/".$uuid.".".$channel_row['img_data'] ;
        }else{
          $banner_img  = $img_data;
        }

        if($channel_row['video'] != '' AND $channel_row['video_data'] != ''){
          $featured_vid  = "https://www.we-teve.com/watch/".$channel_row['video_data'];
        }else{
          $featured_vid  = "none";
        }



        $user_design = array('avatar'=> $avatar, 'backgroundImage'=> $background_img, 'backgroundColor'=> $background_color, 'bannerImage'=> $banner_img, 'featuredVideo'=> $featured_vid);

      //response
        if(isset($_GET['part']) AND !empty($_GET['part'])){
          switch ($_GET['part']) {
            case 'all':
              $json = array('infos'=> $user_infos, 'stats'=> $user_stats, 'design'=> $user_design, 'status'=> 'success');
              break;

            case 'infos':
              $json = array('infos'=> $user_infos, 'status'=> 'success');
              break;

            case 'stats':
              $json = array('stats'=> $user_stats, 'status'=> 'success');
              break;

            case 'design':
              $json = array('design'=> $user_design, 'status'=> 'success');
              break;

            default:
              $json = array('infos'=> $user_infos, 'stats'=> $user_stats, 'design'=> $user_design, 'status'=> 'success');
              break;
          }
        }else{
          $json = array('infos'=> $user_infos, 'stats'=> $user_stats, 'design'=> $user_design, 'status'=> 'success');
        }

        echo $json = json_encode($json);

      /*$print = json_decode($json, true);
        echo " ---- ";
        echo $print['user_info']['uuid'];*/

    }else{
      //error user
      $json = array('status'=> 'error', 'error_msg'=> 'user not found');
        echo $json = json_encode($json);
    }

}else{
  //error parameter
  $json = array('status'=> 'error', 'error_msg'=> 'Required parameter: username or uuid');
    echo $json = json_encode($json);
}

if($only_json===0){
  echo "</pre><script id='script'>document.getElementById('json').innerHTML = JSON.stringify(JSON.parse(document.getElementById('json').innerHTML), undefined, 2); </script></body></html>";
}


?>
