<?php
//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = "../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

if($isUserLoggedIn === 1){

  $puid         = mysqli_real_escape_string(db::$link,$_POST['puid']);
  $first_posi   = filter_var($_POST['first_posi'], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
  $first_posi   = mysqli_real_escape_string(db::$link,$first_posi);
  $second_posi  = filter_var($_POST['second_posi'], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
  $second_posi  = mysqli_real_escape_string(db::$link,$second_posi);
  $time         = strtotime(date('Y-m-d H:i:s'));

  $playlist_sql     = db::$link->query("SELECT uuid,orderby FROM playlist_db WHERE puid = '$puid'");
  $playlist_row     = $playlist_sql->fetch_assoc();
  $playlist_uuid    = $playlist_row['uuid'];
  $playlist_orderby = $playlist_row['orderby'];

  if($playlist_uuid == $user_uuid OR $user_rang == 1){


    if($playlist_orderby != 0){
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

      $up = "UPDATE playlist_db SET orderby = '0' WHERE puid = '$puid'";
      $up = db::$link->query($up);
    }


    $pl_sql = db::$link->query("SELECT pl_id FROM playlist_content_db WHERE puid = '$puid' AND posi = '$second_posi' AND status = 'public'");
    $pl_row = $pl_sql->fetch_assoc();
    $pl_id  = $pl_row['pl_id'];

    $up = "UPDATE playlist_content_db SET posi = '$second_posi' WHERE puid = '$puid' AND posi = '$first_posi' AND status = 'public'";
    $up = db::$link->query($up);

    $up = "UPDATE playlist_content_db SET posi = '$first_posi' WHERE puid = '$puid' AND pl_id = '$pl_id' AND status = 'public'";
    $up = db::$link->query($up);


    if($up == true){
      echo "ok";
    }

  }
}

?>
