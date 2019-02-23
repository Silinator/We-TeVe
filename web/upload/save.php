<?php
//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = "../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

if ($isUserLoggedIn === 1){

  $v_vuid = mysqli_real_escape_string(db::$link,$_POST['vuid']);

  $video_sql = db::$link->query("SELECT uuid,status,privacy,uploaddate FROM video_db WHERE vuid = '$v_vuid'");
  $video_row = $video_sql->fetch_assoc();

  $video_status	  = $video_row['status'];
  $video_privacy	= $video_row['privacy'];
  $uploaddate     = $video_row['uploaddate'];

  if($video_row['uuid'] == ""){
    echo "error";
    return false;
  }

  if($video_row['uuid'] == $user_uuid || $user_rang == 1){

    if(isset($_POST['status']) && $_POST['status'] == "abort"){
      $up = "UPDATE video_db SET privacy = 'privat' WHERE vuid = '$v_vuid' ";         $up = db::$link->query($up);
      $up = "UPDATE video_db SET status = 'abort' WHERE vuid = '$v_vuid' ";           $up = db::$link->query($up);
    }elseif(isset($_POST['status']) && $_POST['status'] == "uploading"){
      $up = "UPDATE video_db SET status = 'uploading' WHERE vuid = '$v_vuid' ";           $up = db::$link->query($up);
    }else{

        $error =        "";

        $v_title =      mysqli_real_escape_string(db::$link,$_POST['title']);
        $v_title =      substr($v_title,0,150);

        if(ctype_space($v_title) || $v_title == '') {
          $v_title = "[VIDEO TITLE]";
        }

        $v_info = str_replace(["\r\n", "\r", "\n"], "<br>", $_POST['info']);
        $sonderzeichen = array(
          '<div>' => '',
          '</div>' => '',
          '&lt;br&gt;' => '<br>',
          '&lt;br/&gt;' => '<br>',
          '&lt;br /&gt;' => '<br>',
          '&nbsp;' => ' ',
          '&gt;' => '>',
          '&lt;' => '<',
          '&amp;' => '&',
        );
        $v_info =       str_replace(array_keys($sonderzeichen),array_values($sonderzeichen), $v_info);
        $v_info =       mysqli_real_escape_string(db::$link,$v_info);
        $v_info =       substr($v_info,0,5000);
        $v_privacy =    mysqli_real_escape_string(db::$link,$_POST['privacy']);
        $v_time =       intval($_POST['time']);
        $v_cat =        mysqli_real_escape_string(db::$link,$_POST['cat']);
        $v_tags =       mysqli_real_escape_string(db::$link,$_POST['tags']);
        $v_tags =       substr($v_tags,0,200);
        $v_lang =       mysqli_real_escape_string(db::$link,$_POST['lang']);
        $v_color =      mysqli_real_escape_string(db::$link,$_POST['color']);
        $v_color2 =     mysqli_real_escape_string(db::$link,$_POST['color2']);


        $up = "UPDATE video_db SET video_title = '$v_title' WHERE video_title != '$v_title' AND vuid = '$v_vuid' "; $up1 = db::$link->query($up);
        $up = "UPDATE video_db SET info = '$v_info' WHERE info != '$v_info' AND vuid = '$v_vuid' ";                 $up2 = db::$link->query($up);
        $up = "UPDATE video_db SET tags = '$v_tags' WHERE tags != '$v_tags' AND vuid = '$v_vuid' ";                 $up2 = db::$link->query($up);


        $time = strtotime(date('Y-m-d H:i'));
        $time2 = strtotime(date('Y-m-d H:i:s'));

        if($video_status == "uploaded"){
          $time24h = $time2;
        }else{
          if($video_privacy == "planed"){
            $time24h = $uploaddate;
          }else{
            $time24h = $time2 + 80000;  // +24h - toleranz
          }
        }

        if($v_privacy == "planed" AND $v_time != ""){
          if($video_status != "uploaded"){ //wenn video noch nicht fertig gerendert
            if($v_time >= $time24h){
              $up = "UPDATE video_db SET uploaddate = '$v_time' WHERE uploaddate != '$v_time' AND vuid = '$v_vuid'";   $up4 = db::$link->query($up);
            }else{
              echo "error_time"; $error = "time";
            }
          }else{
            if($v_time >= $time2 ){
              $up = "UPDATE video_db SET uploaddate = '$v_time' WHERE vuid = '$v_vuid'";   $up4 = db::$link->query($up);
            }else{
              echo "error_time"; $error = "time";
            }
          }
        }

        if($error == ""){
          if($video_privacy == 'planed' AND $v_privacy != 'planed'){
            $up = "UPDATE video_db SET privacy = '$v_privacy' WHERE privacy != '$v_privacy' AND vuid = '$v_vuid' ";     $up3 = db::$link->query($up);
            $up = "UPDATE video_db SET uploaddate = '$time2' WHERE vuid = '$v_vuid' ";     $up31 = db::$link->query($up);
          }elseif($video_privacy == 'privat' AND $v_privacy != 'privat'){
            $up = "UPDATE video_db SET privacy = '$v_privacy' WHERE privacy != '$v_privacy' AND vuid = '$v_vuid' ";     $up3 = db::$link->query($up);
            $up = "UPDATE video_db SET uploaddate = '$time2' WHERE vuid = '$v_vuid' ";     $up31 = db::$link->query($up);
          }else{
            $up = "UPDATE video_db SET privacy = '$v_privacy' WHERE privacy != '$v_privacy' AND vuid = '$v_vuid' ";     $up3 = db::$link->query($up);
          }
        }

        $up = "UPDATE video_db SET kategorie = '$v_cat' WHERE kategorie != '$v_cat' AND vuid = '$v_vuid' ";         $up5 = db::$link->query($up);
        $up = "UPDATE video_db SET sprache = '$v_lang' WHERE sprache != '$v_lang' AND vuid = '$v_vuid' ";           $up6 = db::$link->query($up);

        $allowed_color = array('#007abf','#2130BC','#7638AD','#C50000','#FF7200','#FFD200','#7EFF00','#00D100','#00FF9C','#00FFFC','#ffffff','#000000');
        if(array_search($v_color, $allowed_color) !== NULL){
          $up = "UPDATE video_db SET color = '$v_color' WHERE color != '$v_color' AND vuid = '$v_vuid' ";            $up7 = db::$link->query($up);
        }else{
          echo "error_color"; $error = "color";
        }
        if(($v_color2 == "#ffffff") OR ($v_color2 == "#000000" AND $v_color == "#ffffff")){
          $up = "UPDATE video_db SET color2 = '$v_color2' WHERE color2 != '$v_color2' AND vuid = '$v_vuid' ";        $up8 = db::$link->query($up);
        }else{
          echo "error_color2"; $error = "color2";
        }

        //alerts
        if($error == ""){
          if($up1 == true AND $up2 == true AND $up3 == true AND $up5 == true AND $up6 == true AND $up7 == true AND $up8 == true){
            $up = "UPDATE video_db SET last_update = '$time2' WHERE vuid = '$v_vuid'";   $up_all = db::$link->query($up);
            echo "saved";
          }else{
            echo "error_save";
          }
        }

    }//ifnot abort

  }

}
?>
