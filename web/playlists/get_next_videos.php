<?php
//1. Pfad zum Stammverzeichniss wo sich die index befindet

if(isset($_POST['puid']) AND isset($_POST['vuid']) AND isset($_POST['after_sort'])){
  $_hp = '../'; //für include
  $_dhp = "../"; // für daten

  //2. all include
  $in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
  require_once ($_hp.'include/all_include.php'); //haupt include
}


if(isset($puid)){
	$puid = $puid;
}elseif(isset($_POST['puid'])){
	$puid = mysqli_real_escape_string(db::$link,$_POST['puid']);
}

if(isset($after_sort)){
	$after_sort = $after_sort;
}elseif(isset($_POST['after_sort'])){
	$after_sort = mysqli_real_escape_string(db::$link,$_POST['after_sort']);
}


if(isset($video_vuid)){
	$vuid = $video_vuid;
}elseif(isset($_POST['vuid'])){
	$vuid = mysqli_real_escape_string(db::$link,$_POST['vuid']);
}


$playlist_sql = db::$link->query("SELECT orderby,privacy,uuid FROM playlist_db WHERE puid = '$puid'");
$playlist_row = $playlist_sql->fetch_assoc();
  $playlist_orderby = $playlist_row['orderby'];
  $playlist_privay  = $playlist_row['privacy'];
  $pl_uuid          = $playlist_row['uuid'];

  if($playlist_privay == "0"){
    if($isUserLoggedIn === 1){
      if($pl_uuid != $user_uuid){
        $puid = "";
      }
    }else{
      $puid = "";
    }
  }

if(isset($vuid) AND $vuid != "" AND isset($puid) AND $puid != ""){

  $pl_check_sql = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND vuid = '$vuid'");
  $pl_check_row = $pl_check_sql->fetch_assoc();
  if($pl_check_row['vuid'] != ""){

    //playlist counts
      $vid_results = db::$link->query("SELECT COUNT(puid) FROM playlist_content_db WHERE puid = '$puid' AND status = 'public'");
        $get_total_rows = $vid_results->fetch_row();
        $allvideoCount  = $get_total_rows[0];

      if($after_sort == "norm"){

        if($playlist_orderby != 0){
          if($playlist_orderby  == 1)	{ $posi_coint = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at DESC");
          }elseif($playlist_orderby  == 2)	{ $posi_coint = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at ASC");
          }elseif($playlist_orderby  == 3)	{ $posi_coint = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate DESC");
          }elseif($playlist_orderby  == 4)	{ $posi_coint = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate ASC");
          }
            $stop = 0; $start = 0;
            while($row_list = $posi_coint->fetch_array() AND $stop == 0){
              if($vuid == $row_list['vuid']){
                $stop = 1;
              }else{
                $start++;
              }
            }

            $start = $start + 1;

        }else{
          $posi_sql = db::$link->query("SELECT posi FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' AND vuid = '$vuid'");
          $posi_row = $posi_sql->fetch_assoc();
            $start = $posi_row['posi'];
        }

          $start = $start;

          //prev_video
            $prev_video_start = $start - 1;
            if($prev_video_start <= 0){ $prev_video_start = $allvideoCount; }
              $prev_video_start = $prev_video_start - 1;
                   if($playlist_orderby  == 0)	{ $prev_posi = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY posi ASC       LIMIT $prev_video_start,1");
              }elseif($playlist_orderby  == 1)	{ $prev_posi = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at DESC   LIMIT $prev_video_start,1");
              }elseif($playlist_orderby  == 2)	{ $prev_posi = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at ASC    LIMIT $prev_video_start,1");
              }elseif($playlist_orderby  == 3)	{ $prev_posi = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate DESC LIMIT $prev_video_start,1");
              }elseif($playlist_orderby  == 4)	{ $prev_posi = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate ASC  LIMIT $prev_video_start,1");
              }
                $prev_posi_row  = $prev_posi->fetch_assoc();
                $prev_video     = $prev_posi_row['vuid'];



          //next_video
            $next_video_start = $start + 1;
            if($next_video_start > $allvideoCount){ $next_video_start = 1; }
              $next_video_start = $next_video_start - 1;
                   if($playlist_orderby  == 0)	{ $next_posi = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY posi ASC       LIMIT $next_video_start,1");
              }elseif($playlist_orderby  == 1)	{ $next_posi = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at DESC   LIMIT $next_video_start,1");
              }elseif($playlist_orderby  == 2)	{ $next_posi = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at ASC    LIMIT $next_video_start,1");
              }elseif($playlist_orderby  == 3)	{ $next_posi = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate DESC LIMIT $next_video_start,1");
              }elseif($playlist_orderby  == 4)	{ $next_posi = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate ASC  LIMIT $next_video_start,1");
              }
                $next_posi_row  = $next_posi->fetch_assoc();
                $next_video     = $next_posi_row['vuid'];

              if($allvideoCount == 1){
                $prev_video = $vuid;
                $next_video = $vuid;
              }


              header('Content-type:application/json;charset=utf-8');
              echo json_encode('{ "prev_video": "'.$prev_video.'", "next_video": "'.$next_video.'" }');

      }elseif($after_sort == "switch"){

               if($playlist_orderby  == 0)	{ $posi_coint = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY posi DESC");
          }elseif($playlist_orderby  == 1)	{ $posi_coint = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at ASC");
          }elseif($playlist_orderby  == 2)	{ $posi_coint = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at DESC");
          }elseif($playlist_orderby  == 3)	{ $posi_coint = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate ASC");
          }elseif($playlist_orderby  == 4)	{ $posi_coint = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate DESC");
          }
            $stop = 0; $start = 0;
            while($row_list = $posi_coint->fetch_array() AND $stop == 0){
              if($vuid == $row_list['vuid']){
                $stop = 1;
              }else{
                $start++;
              }
            }

          $start = $start;

          //prev_video
            $prev_video_start = $start - 1;
            if($prev_video_start < 0){ $prev_video_start = $allvideoCount - 1; }
              $prev_video_start = $prev_video_start ;
                   if($playlist_orderby  == 0)	{ $prev_posi = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY posi DESC       LIMIT $prev_video_start,1");
              }elseif($playlist_orderby  == 1)	{ $prev_posi = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at ASC    LIMIT $prev_video_start,1");
              }elseif($playlist_orderby  == 2)	{ $prev_posi = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at DESC   LIMIT $prev_video_start,1");
              }elseif($playlist_orderby  == 3)	{ $prev_posi = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate ASC  LIMIT $prev_video_start,1");
              }elseif($playlist_orderby  == 4)	{ $prev_posi = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate DESC LIMIT $prev_video_start,1");
              }
                $prev_posi_row  = $prev_posi->fetch_assoc();
                $prev_video     = $prev_posi_row['vuid'];



          //next_video
            $next_video_start = $start + 1;
            if($next_video_start >= $allvideoCount){ $next_video_start = 0; }
              $next_video_start = $next_video_start ;
                   if($playlist_orderby  == 0)	{ $next_posi = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY posi DESC       LIMIT $next_video_start,1");
              }elseif($playlist_orderby  == 1)	{ $next_posi = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at ASC    LIMIT $next_video_start,1");
              }elseif($playlist_orderby  == 2)	{ $next_posi = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at DESC   LIMIT $next_video_start,1");
              }elseif($playlist_orderby  == 3)	{ $next_posi = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate ASC  LIMIT $next_video_start,1");
              }elseif($playlist_orderby  == 4)	{ $next_posi = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate DESC LIMIT $next_video_start,1");
              }
                $next_posi_row  = $next_posi->fetch_assoc();
                $next_video     = $next_posi_row['vuid'];

                if($allvideoCount == 1){
                  $prev_video = $vuid;
                  $next_video = $vuid;
                }


              header('Content-type:application/json;charset=utf-8');
              echo json_encode('{ "prev_video": "'.$prev_video.'&o=t", "next_video": "'.$next_video.'&o=t" }');


      }elseif($after_sort == "random"){

        $rand_string = $_SESSION[$puid];
        $allvideoCount = count($rand_string) - 1;
        $start = array_search($vuid, $rand_string);

        $prev_video_start = $start - 1;
        $next_video_start = $start + 1;

        if($prev_video_start < 0)             { $prev_video_start = $allvideoCount;}
        if($next_video_start > $allvideoCount){ $next_video_start = 0;}


        $prev_video = $rand_string[$prev_video_start];
        $next_video = $rand_string[$next_video_start];

        if($allvideoCount == 1){
          $prev_video = $vuid;
          $next_video = $vuid;
        }

        header('Content-type:application/json;charset=utf-8');
        echo json_encode('{ "prev_video": "'.$prev_video.'&o=r", "next_video": "'.$next_video.'&o=r" }');

      }


  }else{
    header('HTTP/1.1 500 Invalid VALUES!');
    exit();
  }
}else{
  header('HTTP/1.1 500 Invalid VALUES!');
  exit();
}
