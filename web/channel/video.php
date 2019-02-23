<?php
  $can_show = 0;

  $video_sql = db::$link->query("SELECT * FROM video_db WHERE vuid = '$video_vuid'");
  $video_row = $video_sql->fetch_assoc();

    if($video_row['vuid'] != ''){
        $video_uuid 		  = $video_row['uuid'];

        $video_status 		= $video_row['status'];
        $video_privacy 		= $video_row['privacy'];
        $video_render_status 	= $video_row['render_status'];
        $video_max_result = $video_row['max_result'];


      if($video_privacy == 'public' OR $video_privacy == 'unlist' OR $video_privacy == 'friend'){
        if($video_status == 'uploaded'){
          $can_show = 1;
        }else{
          $v_error = 1; //not ready
        }
      }elseif($video_privacy == 'privat'){
        if($isUserLoggedIn === 1){
          if($video_uuid == $user_uuid){
            if($video_status == 'uploaded'){
              $can_show = 1;
            }else{
              $v_error = 1; //not ready
            }
          }else{
            $v_error = 2; //not allowed
          }
        }else{
          $v_error = 2; //not allowed
        }
      }elseif($video_privacy == 'planed'){
        if($isUserLoggedIn === 1){
          if($video_uuid == $user_uuid){
            if($video_status == 'uploaded'){
              $can_show = 1;
            }else{
              $v_error = 1; //not ready
            }
          }else{
            $v_error = 2; //not allowed
          }
        }else{
          $v_error = 2; //not allowed
        }
      }
    }


  if( $can_show == 1){

    $is_channel_video = 1;

		require_once ($_hp.'video/video.php');

  }
?>
