<?php
//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = "../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

if($isUserLoggedIn === 1){

  $puid = mysqli_real_escape_string(db::$link,$_POST['puid']);
  $time = strtotime(date('Y-m-d H:i:s'));

  $playlist_sql     = db::$link->query("SELECT uuid,orderby FROM playlist_db WHERE puid = '$puid'");
  $playlist_row     = $playlist_sql->fetch_assoc();
  $playlist_uuid    = $playlist_row['uuid'];
  $playlist_orderby = $playlist_row['orderby'];

  if($playlist_uuid == $user_uuid OR $user_rang == 1){

    $pltitle    = mysqli_real_escape_string(db::$link,$_POST['pltitle']);
    $pltitle    = substr($pltitle,0,150);
    $plprivacy  = mysqli_real_escape_string(db::$link,$_POST['plprivacy']);
    $plsort     = mysqli_real_escape_string(db::$link,$_POST['plsort']);
    $plinfo     = mysqli_real_escape_string(db::$link,$_POST['plinfo']);
    $plinfo     = substr($plinfo,0,2500);

    if(ctype_space($pltitle) || $pltitle == '') {
      $pltitle = "[PLAYLIST TITLE]";
    }

    if($plprivacy > 3 OR $plprivacy < 0){
      $plprivacy = 0;
    }

    if($plsort > 4 OR $plsort  < 0){
      $plsort = 0;
    }

    $up = "UPDATE playlist_db SET title   = '$pltitle' WHERE puid = '$puid'"; $up = db::$link->query($up);
    $up = "UPDATE playlist_db SET privacy = '$plprivacy' WHERE puid = '$puid'"; $up = db::$link->query($up);
    $up = "UPDATE playlist_db SET orderby = '$plsort' WHERE puid = '$puid'"; $up = db::$link->query($up);
    $up = "UPDATE playlist_db SET notiz   = '$plinfo' WHERE puid = '$puid'"; $up = db::$link->query($up);
    $up = "UPDATE playlist_db SET last_interaction = '$time' WHERE puid = '$puid'"; $up = db::$link->query($up);

    if($plsort == 0){
      if($playlist_orderby == 0)		 		{ $sort_res = db::$link->query("SELECT pl_id FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY posi ASC");
      }elseif($playlist_orderby  == 1)	{ $sort_res = db::$link->query("SELECT pl_id FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at DESC");
      }elseif($playlist_orderby  == 2)	{ $sort_res = db::$link->query("SELECT pl_id FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at ASC");
      }elseif($playlist_orderby  == 3)	{ $sort_res = db::$link->query("SELECT pl_id FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate DESC");
      }elseif($playlist_orderby  == 4)	{ $sort_res = db::$link->query("SELECT pl_id FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate ASC");
      }
        $posi = 0;
        while($row = $sort_res->fetch_array()){
          $posi++;
          $pl_id = $row['pl_id'];
          $up = "UPDATE playlist_content_db SET posi = '$posi' WHERE pl_id = '$pl_id'"; $up = db::$link->query($up);
        }
    }

    if($up == true){
      if($playlist_orderby != $plsort){
        echo "reload_ok";
      }else{
        echo "ok";
      }

    }

  }
}

?>
