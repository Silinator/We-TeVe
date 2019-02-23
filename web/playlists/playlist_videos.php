<?php
//1. Pfad zum Stammverzeichniss wo sich die index befindet

if(isset($_POST['puid']) AND isset($_POST['vuid']) AND isset($_POST['posi']) AND isset($_POST['after_sort'])){
  $_hp = '../'; //für include
  $_dhp = "../"; // für daten

  //2. all include
  $in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
  require_once ($_hp.'include/all_include.php'); //haupt include
}

  //3. site vals
  $item_per_page = 24;


if(isset($puid)){
	$puid = $puid;
}elseif(isset($_POST['puid'])){
	$puid = mysqli_real_escape_string(db::$link,$_POST['puid']);
}

if(isset($after_sort)){
	$after_sort = $after_sort;
  $at_load = 1;
}elseif(isset($_POST['after_sort'])){
  $at_load = 0;
	$after_sort = mysqli_real_escape_string(db::$link,$_POST['after_sort']);
}


if(isset($video_vuid)){
	$vuid = $video_vuid;
  $posi_number = 0;
  $move = "start";
}elseif(isset($_POST['vuid'])){
	$vuid = mysqli_real_escape_string(db::$link,$_POST['vuid']);
  $posi_number = filter_var($_POST["posi"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
  $move = mysqli_real_escape_string(db::$link,$_POST['move']);
}

if(!is_numeric($posi_number)){
	header('HTTP/1.1 500 Invalid page number!');
	exit();
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

if(isset($vuid) AND $vuid != "" AND isset($puid) AND $puid != "" AND ($move == "prev" OR $move == "start" OR $move == "next") ){

$pl_check_sql = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND vuid = '$vuid'");
$pl_check_row = $pl_check_sql->fetch_assoc();
  if($pl_check_row['vuid'] != ""){

    //playlist counts
      $vid_results = db::$link->query("SELECT COUNT(puid) FROM playlist_content_db WHERE puid = '$puid' AND status = 'public'");
        $get_total_rows = $vid_results->fetch_row();
        $allvideoCount  = $get_total_rows[0];


    if($after_sort == "norm"){

        if($move == "start"){
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

          }else{
            $posi_sql = db::$link->query("SELECT posi FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' AND vuid = '$vuid'");
            $posi_row = $posi_sql->fetch_assoc();
              $start = $posi_row['posi'];
          }
            $start = $start - 2;

            if($allvideoCount - $item_per_page <= $start){
              $start = $allvideoCount - $item_per_page;
            }

            if($allvideoCount <= $item_per_page){
              $start = 0;
            }

            if($start < 0){ $start = 0;}
        }else{
          $start = $posi_number;
          if($start < 0){
            $item_per_page = $item_per_page + $start; //sart ist somit z.B -5
            $start = 0;
          }
        }

        if($playlist_orderby == 0)		 		{ $sort_res = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY posi ASC        LIMIT $start, $item_per_page");
        }elseif($playlist_orderby  == 1)	{ $sort_res = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at DESC   LIMIT $start, $item_per_page");
        }elseif($playlist_orderby  == 2)	{ $sort_res = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at ASC    LIMIT $start, $item_per_page");
        }elseif($playlist_orderby  == 3)	{ $sort_res = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate DESC LIMIT $start, $item_per_page");
        }elseif($playlist_orderby  == 4)	{ $sort_res = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate ASC  LIMIT $start, $item_per_page");
        }
          $posi = $start;

          if($move != 'next' AND $start - 1 >= 0){
            $prev_num = $start - $item_per_page;
            echo "<div style='clear:both;'></div>";
            echo "<div start='".$prev_num."' after_sort='norm' class='w_pl_load-videos w_pl_load-previous w_pl_go_to_".$prev_num."'>";
                echo "<span class='load_more_text'> <span class='glyphicon glyphicon-chevron-up'></span> </span>";
            		echo "<span class='load_more_loading hide'><img src='".$_dhp."images/icons/ajax-loader.gif' alt='We-Teve'/> ".$l->loading."</span>";
            echo "</div>";
          }

          while($row = $sort_res->fetch_array()){
            $posi++;
            $pl_vuid = $row['vuid'];
              if($pl_vuid == $vuid){
                $num = "<span class='glyphicon glyphicon-play'></span>";
              }else{
                $num = $posi;
              }

            echo "<div class='col-xs-12 col-xl-12 col-spl w_pl_vid_box'>";
              echo "<div class='w_pl_vid_num_box'><div class='w_pl_vid_num'>".$num."</div></div>";
                echo "<div class='w_pl_vid_content'>";
                  echo $f->draw_video_pewview($pl_vuid,1,'hor','&pl='.$puid,$_dhp,$_ddhp,'small','0');
                echo "</div>";
                echo "<div style='clear:both;'></div>";
            echo "</div>";
          }


          if($move != 'prev' AND $start + $item_per_page < $allvideoCount){
            $next_num = $posi;
            echo "<div style='clear:both;'></div>";
            echo "<div start='".$next_num."' after_sort='norm' class='w_pl_load-videos w_pl_load-next marg-top-15 w_pl_go_to_".$next_num."'>";
                echo "<span class='load_more_text'> <span class='glyphicon glyphicon-chevron-down'></span> </span>";
                echo "<span class='load_more_loading hide'><img src='".$_dhp."images/icons/ajax-loader.gif' alt='We-Teve'/> ".$l->loading."</span>";
            echo "</div>";
          }



    }elseif($after_sort == "switch"){




      if($move == "start"){

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
          $start = $start - 2;

          if($allvideoCount - $item_per_page <= $start){
            $start = $allvideoCount - $item_per_page;
          }

          if($allvideoCount <= $item_per_page){
            $start = 0;
          }

          if($start < 0){ $start = 0;}
      }else{
        $start = $posi_number;
        if($start < 0){
          $item_per_page = $item_per_page + $start; //sart ist somit z.B -5
          $start = 0;
        }
      }

      if($playlist_orderby == 0)		 		{ $sort_res = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY posi DESC       LIMIT $start, $item_per_page");
      }elseif($playlist_orderby  == 1)	{ $sort_res = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at ASC    LIMIT $start, $item_per_page");
      }elseif($playlist_orderby  == 2)	{ $sort_res = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at DESC   LIMIT $start, $item_per_page");
      }elseif($playlist_orderby  == 3)	{ $sort_res = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate ASC  LIMIT $start, $item_per_page");
      }elseif($playlist_orderby  == 4)	{ $sort_res = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate DESC LIMIT $start, $item_per_page");
      }
        $posi = $start;

        if($move != 'next' AND $start - 1 >= 0){
          $prev_num = $start - $item_per_page;
          echo "<div style='clear:both;'></div>";
          echo "<div start='".$prev_num."' after_sort='switch' class='w_pl_load-videos w_pl_load-previous w_pl_go_to_".$prev_num."'>";
              echo "<span class='load_more_text'> <span class='glyphicon glyphicon-chevron-up'></span> </span>";
              echo "<span class='load_more_loading hide'><img src='".$_dhp."images/icons/ajax-loader.gif' alt='We-Teve'/> ".$l->loading."</span>";
          echo "</div>";
        }

        while($row = $sort_res->fetch_array()){
          $posi++;
          $pl_vuid = $row['vuid'];
            if($pl_vuid == $vuid){
              $num = "<span class='glyphicon glyphicon-play'></span>";
            }else{
              $num = $posi;
            }

          echo "<div class='col-xs-12 col-xl-12 col-spl w_pl_vid_box'>";
            echo "<div class='w_pl_vid_num_box'><div class='w_pl_vid_num'>".$num."</div></div>";
              echo "<div class='w_pl_vid_content'>";
                echo $f->draw_video_pewview($pl_vuid,1,'hor','&o=t&pl='.$puid,$_dhp,$_ddhp,'small','0');
              echo "</div>";
              echo "<div style='clear:both;'></div>";
          echo "</div>";
        }


        if($move != 'prev' AND $start + $item_per_page < $allvideoCount){
          $next_num = $posi;
          echo "<div style='clear:both;'></div>";
          echo "<div start='".$next_num."' after_sort='switch' class='w_pl_load-videos w_pl_load-next marg-top-15 w_pl_go_to_".$next_num."'>";
              echo "<span class='load_more_text'> <span class='glyphicon glyphicon-chevron-down'></span> </span>";
              echo "<span class='load_more_loading hide'><img src='".$_dhp."images/icons/ajax-loader.gif' alt='We-Teve'/> ".$l->loading."</span>";
          echo "</div>";
        }

    }elseif($after_sort == "random"){

      if($move == "start"){

        if($at_load == 1 AND isset($_SESSION[$puid]) ){
          $rand_string = $_SESSION[$puid];
        }else{
          $rand_string = array();
          $results_sql = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY RAND()");
          while($row = $results_sql->fetch_array()){
            $rand_string[] = $row['vuid'];
          }
            $_SESSION[$puid] = $rand_string;
        }

        $allvideoCount = count($rand_string);
        $start = array_search($vuid, $rand_string);

          $start = $start - 1;

          if($allvideoCount <= $item_per_page){
            $start = 0;
          }

          if($allvideoCount - $item_per_page <= $start ){
            $start = $allvideoCount - $item_per_page;
          }

          if($start < 0){ $start = 0;}

      }else{
        $rand_string = $_SESSION[$puid];
        $allvideoCount = count($rand_string);

        $start = $posi_number;
        if($start < 0){
          $item_per_page = $item_per_page + $start; //sart ist somit z.B -5
          $start = 0;
        }
      }


      $posi = $start - 1;
      $limit = 1;

      if($move != 'next' AND $start - 1 >= 0){
        $prev_num = $start - $item_per_page;
        echo "<div style='clear:both;'></div>";
        echo "<div start='".$prev_num."' after_sort='random' class='w_pl_load-videos w_pl_load-previous w_pl_go_to_".$prev_num."'>";
            echo "<span class='load_more_text'> <span class='glyphicon glyphicon-chevron-up'></span> </span>";
            echo "<span class='load_more_loading hide'><img src='".$_dhp."images/icons/ajax-loader.gif' alt='We-Teve'/> ".$l->loading."</span>";
        echo "</div>";
      }


      while($limit <= $item_per_page AND $posi+1 < $allvideoCount){

        $posi++; $limit++;
        $pl_vuid = $rand_string[$posi];
          if($pl_vuid == $vuid){
            $num = "<span class='glyphicon glyphicon-play'></span>";
          }else{
            $num = $posi + 1;
          }

        echo "<div class='col-xs-12 col-xl-12 col-spl w_pl_vid_box'>";
          echo "<div class='w_pl_vid_num_box'><div class='w_pl_vid_num'>".$num."</div></div>";
            echo "<div class='w_pl_vid_content'>";
              echo $f->draw_video_pewview($pl_vuid,1,'hor','&o=r&pl='.$puid,$_dhp,$_ddhp,'small','0');
            echo "</div>";
            echo "<div style='clear:both;'></div>";
        echo "</div>";
      }


      if($move != 'prev' AND $start + $item_per_page < $allvideoCount){
        $next_num = $posi + 1;
        echo "<div style='clear:both;'></div>";
        echo "<div start='".$next_num."' after_sort='random' class='w_pl_load-videos w_pl_load-next marg-top-15 w_pl_go_to_".$next_num."'>";
            echo "<span class='load_more_text'> <span class='glyphicon glyphicon-chevron-down'></span> </span>";
            echo "<span class='load_more_loading hide'><img src='".$_dhp."images/icons/ajax-loader.gif' alt='We-Teve'/> ".$l->loading."</span>";
        echo "</div>";
      }

    }


  }else{
    header('HTTP/1.1 500 Invalid VALUES!');
    exit();
  }
}else{
  header('HTTP/1.1 500 Invalid VALUES!');
  exit();
}
?>
