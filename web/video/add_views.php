<?php

    $_hp = "../";
    $_dhp = "../"; // für daten
    $in_save_code_all_include = "&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z";
    require_once ('../include/all_include.php');


    $video_vuid =  $_POST['vuid'];
    $video_vuid =  mysqli_real_escape_string(db::$link,$video_vuid);



      $time = date('H:i:s d-m-Y');
      $time = strtotime($time);

      if($isUserLoggedIn === 1) {
        $user = $user_uuid;
      }else{
        $user = getenv("REMOTE_ADDR"); //ip
      }

        $sql_data = db::$link->query("SELECT tmp_id,user,time FROM tmp_view_db WHERE vuid = '$video_vuid' AND user = '$user' ORDER BY tmp_id ASC");
        $get_v_data = $sql_data->fetch_assoc();
        $check_id = $get_v_data['tmp_id'];


        if($check_id != ""){
          $check_time = $get_v_data['time'];

          if($check_time <= $time){
            //video views
            $views = "UPDATE video_db SET views = (views + 1) WHERE vuid = '$video_vuid'";
            $views = db::$link->query($views);

            //pl_views
            if($_POST['pl'] != ""){
              $puid = $_POST['pl'];
              $puid = mysqli_real_escape_string(db::$link,$puid);

              $pl_views = "UPDATE playlist_db SET views = (views + 1) WHERE puid = '$puid'";
              $pl_views = db::$link->query($pl_views);
            }

            if($views == true){

              $sql_views = db::$link->query("SELECT vuid,uuid,views FROM video_db WHERE vuid = '$video_vuid'");
              $get_views = $sql_views->fetch_assoc();
              $video_uuid = $get_views['uuid'];
              $video_vuid = $get_views['vuid'];
              $video_views = $get_views['views'];

              //add xp
              $lvl->add_xp('35',$video_vuid,$user_uuid);

              //add Errungenschaften
              if($video_views == 100)       {$ach->add_ach('100',$video_vuid,$video_uuid);}
              elseif($video_views == 1000)  {$ach->add_ach('101',$video_vuid,$video_uuid);}
              elseif($video_views == 10000) {$ach->add_ach('102',$video_vuid,$video_uuid);}

              $del_tmp = "DELETE FROM tmp_view_db WHERE tmp_id = '$check_id'";
              $del_tmp = db::$link->query($del_tmp);

              echo "test-we_teve ok";
              //test_we-teve
            }
          }

        }

 ?>
