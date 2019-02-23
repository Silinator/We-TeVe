<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = '../'; // für daten
$upload_in = true;
$isUserLoggedIn = 1;
$usercode_up = $_POST['usercode'];  //like the cookie value
$url = $_POST['url'];

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once($_hp.'include/all_include.php'); //haupt include

require_once('getid3-1/getid3.php');

$user_uuid = $u->userin('uuid',0,'',$usercode_up);
$user_rang = $u->userin('rang',0,'',$usercode_up);
$vuid = $_POST['vuid'];  $vuid = mysqli_real_escape_string(db::$link,$vuid);

$upload_allowed = 0;
$user_uuif		 	= sha1(sha1($user_uuid));
$user_vpw 			= $u->userin('vpw',0,$user_uuif,'');
$user_blocked  	= $u->userin('blocked',0,$user_uuif,'');
$time 					= strtotime(date('Y-m-d H:i:s'));

if($user_blocked == 0 AND $user_vpw > 0){
    $video_sql 			= db::$link->query("SELECT uploadstart FROM video_db WHERE uuid = '$user_uuid' AND ((status = 'uploading' OR status = 'rendering' OR status = 'uploaded') AND vuid != '$vuid' ) ORDER BY uploadstart DESC LIMIT 1");
    $video_row 			= $video_sql->fetch_assoc();

    if($video_row['uploadstart'] != ""){
      $wait = 630000 / $user_vpw;
      if($video_row['uploadstart'] + $wait < $time){
        $upload_allowed = 1;
      }else{
        $next_upload = $video_row['uploadstart'] + $wait;
        $next_upload = $f->normtime($next_upload,'date+times');
      }
    }else{
      $upload_allowed = 1;
    }
}else{
  $user_blocked = 1;
}

//ffmpeg path:
if($_ffmpeg_installed == "true"){
  $ffmpeg = "ffmpeg";
}else{
  $ffmpeg = "..\\ffmpeg\\bin\\ffmpeg";
}

if(isset($usercode_up) AND ($upload_allowed == 1 OR $user_rang == 1)){

date_default_timezone_set('UTC');
$uploaddate = date("H:i:s d.m.Y");
$date = strtotime($uploaddate);


//video infos from youtube
$key = $_google_api;


parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
$video_id = $my_array_of_vars['v'];
$video_id = mysqli_real_escape_string(db::$link,$video_id); //save text
if( isset($my_array_of_vars['list'])){$pl = $my_array_of_vars['list'];}else{$pl="";}


/*online */
if( $_curl_installed == "true"){
  $html = 'https://www.googleapis.com/youtube/v3/videos?id='.$video_id.'&key='.$key.'&part=snippet';
  $curl = curl_init($html);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  $return = curl_exec($curl);
  curl_close($curl);
  $decoded = json_decode($return, true);
  foreach ($decoded['items'] as $items) {
    if( isset($items['snippet']['channelId']) )  { $channelId   = $items['snippet']['channelId'];  }else{ $channelId   = "";}

    if( isset($items['snippet']['thumbnails']['maxres']['url']) ){ $thumb = $items['snippet']['thumbnails']['maxres']['url'];}else{ $thumb = $items['snippet']['thumbnails']['standard']['url']; }
  }
}else{
  $html = 'https://www.googleapis.com/youtube/v3/videos?id='.$video_id.'&key='.$key.'&part=snippet';
  $response = file_get_contents($html);
  $decoded = json_decode($response, true);
  foreach ($decoded['items'] as $items) {
    if( isset($items['snippet']['channelId']) )  { $channelId   = $items['snippet']['channelId'];  }else{ $channelId   = "";}

    if( isset($items['snippet']['thumbnails']['maxres']['url']) ){ $thumb = $items['snippet']['thumbnails']['maxres']['url'];}else{ $thumb = $items['snippet']['thumbnails']['standard']['url']; }
  }
}


$channelId = mysqli_real_escape_string(db::$link,$channelId); //save text


$user_name = $u->userin('name',0,'',$usercode_up);

if($video_id != "" AND $pl == ""){
    //check ob es das google Konnt vom video auch dem nutzer gehört
      $google_channel_sql = db::$link->query("SELECT google_id FROM google_db WHERE g_channel_id = '$channelId' AND uuid = '$user_uuid' AND status = 'ok'");
      $google_channel_row = $google_channel_sql->fetch_assoc();
      $userauth           = $google_channel_row['google_id'];
}else{
  $userauth = "";
}

      if($userauth == ""){$error = "error_userauth";}
      if($pl != "")      {$error = "error_is_pl";}
      if($video_id == ""){$error = "error_video_id";}


if($video_id != "" AND $pl == "" AND $userauth != ""){






  $yt_video_id = $video_id;


// eintrag ---- in ---- die ---- DB ----> auf .php

  function calc_video($o_height,$o_width,$result){
    $calc = $o_height / $o_width;

    if($calc <= 0.5625){ //16 zu 9 oder dünner

      if($result == "240"){$v_width = 426;}
      if($result == "360"){$v_width = 640;}
      if($result == "480"){$v_width = 854;}
      if($result == "720"){$v_width = 1280;}
      if($result == "1080"){$v_width = 1920;}
      if($result == "1440"){$v_width = 2560;}
      if($result == "2160"){$v_width = 3840;}

      $v_height = round($v_width * $calc);

    }else{ //16 zu 9 bis ca 4zu3

      $v_width = round($result / $calc);
      $v_height = $result;
    }

    if ($v_height % 2 != 0) {
      $v_height = $v_height + 1;
    }

    if ($v_width % 2 != 0) {
      $v_width = $v_width + 1;
    }

    return "scale=w=".$v_width.":h=".$v_height;
  }


  date_default_timezone_set('UTC');
  $uploaddate = date("H:i:s d.m.Y");
  $date = strtotime($uploaddate);

  $vuid = $_POST['vuid'];
  $datavuid = $_POST['datavuid'];



// end eintrag ---- in ---- die ---- DB

//from youtube download

mkdir( '../videos/'.$datavuid , 0700 );
  $tmp_name = "tmp_".rand(0, 9999999);

  $eintrag_info = "Update video_db SET status='rendering' WHERE vuid='$vuid' AND uuid='$user_uuid'";
  $eintrag_info = db::$link->query($eintrag_info);

//downloaded video file mit tmp_name wird danach ich die richtige quallitätstufe umbenant
$cmd = "youtube-dl -f 'bestvideo+bestaudio' -o '../videos/".$datavuid."/".$tmp_name.".mp4' ".$url;
exec($cmd, $output, $ret);
//echo 'output: ';

//var_export($output);

$error_download = $ret;  // 0 = no error   |    1 = error


if($error_download == 1){
  $error = "error_download";
  echo $url;
  $eintrag_abort = "Update video_db SET status='abort' WHERE vuid='$vuid' AND uuid='$user_uuid'";
  $eintrag_abort = db::$link->query($eintrag_abort);
}


//unwandeln in we-teve format
if($error_download == 0){

    $is_webm = 0;

    $videoFile = "../videos/".$datavuid."/".$tmp_name.".mp4";
    $videoFile2 = "../videos/".$datavuid."/".$tmp_name.".mp4.webm";

    if (file_exists($videoFile)) {
      $fileTmpLoc = $videoFile;
    }elseif(file_exists($videoFile2)){
      $fileTmpLoc = $videoFile2;
      $is_webm = 1;
    }

      $fileName     = $tmp_name;              //$_FILES['file1']['name'];
      $fileType     = "mp4/video";            //$_FILES['file1']['type'];
      $fileSize     = "-";                    //$_FILES['file1']['size'];
      $fileErrorMsg = 0;                      //$_FILES['file1']['error'];//0 = false und 1 = True

      if($fileTmpLoc == ""){
        echo $fileTmpLoc." + ";
        echo $hochladestatus1;
        $eintrag_abort = "Update video_db SET status='abort' WHERE vuid='$vuid' AND uuid='$user_uuid'";
        $eintrag_abort = db::$link->query($eintrag_abort);
        exit;
      }

      $getID3 = new getID3;
      $file = $getID3->analyze($fileTmpLoc);
      $height = $file['video']['resolution_y'];
      $width = $file['video']['resolution_x'];

      if($height >= 2160 	   OR $width >= 3840){$max_result = "2160";}
      elseif($height >= 1440 OR $width >= 2560){$max_result = "1440";}
      elseif($height >= 1080 OR $width >= 1920){$max_result = "1080";}
      elseif($height >= 720  OR $width >= 1280){$max_result = "720";}
      elseif($height >= 480  OR $width >= 854){$max_result = "480";}
      elseif($height >= 360  OR $width >= 640){$max_result = "360";}
      elseif($height >= 240  OR $width >= 426){$max_result = "240";}
      elseif($height < 240   OR $width < 426){$max_result = "240";}


      if($is_webm == 0){

        //rename the downloadfile in max_result
          rename($fileTmpLoc, "../videos/".$datavuid."/".$max_result."p.mp4");
        //neuer name
          $videoFile = "../videos/".$datavuid."/".$max_result."p.mp4";
          $yt_file = $videoFile;

      }else{

        //new render highest qualli
          $videoOutFile = "../videos/".$datavuid."/".$max_result."p.mp4";
          $filter = calc_video($height,$width,$max_result);
            switch ($max_result) {
              case '2160': $ytbitrate = "25000k -bufsize 6000k";  break;
              case '1440': $ytbitrate = "12000k -bufsize 3000k";  break;
              case '1080': $ytbitrate = "7000k -bufsize 2000k";   break;
              case '720': $ytbitrate  = "4000k -bufsize 1000k";   break;
              case '480': $ytbitrate  = "2000k -bufsize 500k";    break;
              case '360': $ytbitrate  = "1000k -bufsize 250k";    break;
              case '240': $ytbitrate  = "500k -bufsize 125k";     break;
                default: $ytbitrate   = "25000k -bufsize 6000";   break;
            }
          $cmdvideo = "$ffmpeg -i $fileTmpLoc -filter:v \"$filter\" -minrate 10k -maxrate $ytbitrate -r 30 -sws_flags lanczos $videoOutFile";
          //$cmdvideo7 = "$ffmpeg -y -i $videoFile -vcodec nvenc_h264 -pix_fmt nv12 -preset fast -pix_fmt nv12 -filter:v \"$filter7\" $videoOutFile7";
          if(exec($cmdvideo)){echo "Error".$max_result;}else{
            //size
              $filesize = $getID3->analyze($videoOutFile);
              $yt_size = $max_result."p:".$filesize['filesize'];
            //new video file
              $videoFile = $videoOutFile;
          }

      }



    //update db

      $eintrag_result = "Update video_db SET max_result='".$max_result."' WHERE vuid='$vuid' AND uuid='$user_uuid'";
      $eintrag_result = db::$link->query($eintrag_result);

      $eintrag_resolution = "Update video_db SET org_resolution='".$width."x".$height."' WHERE vuid='$vuid' AND uuid='$user_uuid'";
      $eintrag_resolution = db::$link->query($eintrag_resolution);

      $eintrag_status = "Update video_db SET render_status='downloaded' WHERE vuid='$vuid' AND uuid='$user_uuid'";
      $eintrag_status = db::$link->query($eintrag_status);

      /*$eintrag_title = "Update video_db SET video_title='".$title."' WHERE vuid='$vuid' AND uuid='$user_uuid' AND video_title=''";
      $eintrag_title = db::$link->query($eintrag_title);

      $eintrag_title = "Update video_db SET info='".$description."' WHERE vuid='$vuid' AND uuid='$user_uuid' AND info=''";
      $eintrag_title = db::$link->query($eintrag_title);*/

      $eintrag_newvuid = "Update video_db SET datavuid='".$datavuid."' WHERE vuid='$vuid' AND uuid='$user_uuid'";
      $eintrag_newvuid = db::$link->query($eintrag_newvuid);


      $eintrag_newuploaddate = "Update video_db SET last_update='".$date."' WHERE vuid='$vuid' AND uuid='$user_uuid'";
      $eintrag_newuploaddate = db::$link->query($eintrag_newuploaddate);

      $eintrag_newuploaddate = "Update video_db SET uploaddate='".$date."' WHERE vuid='$vuid' AND uuid='$user_uuid' AND privacy != 'planed'";
      $eintrag_newuploaddate = db::$link->query($eintrag_newuploaddate);



      //Get one thumbnail from the video

      date_default_timezone_set('UTC');
      $uploaddate = date("H:i:s d.m.Y");
      $uploaddate = strtotime($uploaddate);


      $video_daten = db::$link->query("SELECT dauer,vuid FROM video_db WHERE vuid = '$vuid'");
      $video_daten = $video_daten->fetch_assoc();
      $video_dauer = $video_daten['dauer'];
    	$vuid = $video_daten['vuid'];




    	mkdir( '../images/thumb/preview/'.$vuid , 0700 );

    	//echo $bitrate;

    	//test
    	//$max_result = "480";

      $cmd_pause = 0;

    	//audio visioalisiert
    	$videoOutFile0 = "../videos/".$datavuid."/audioviso.mp4";
         $filter0 = calc_video($height,$width,"720");
         // -vf \"eq=contrast=1.5,eq=saturation=1.5\"
         $cmdvideo0 = "$ffmpeg -i $videoFile -filter:v \"$filter0\" -sws_flags lanczos -b 2500 $videoOutFile0";
         if(exec($cmdvideo0)){echo "Error1";}else{$audio_viso = 1;
           //update db

            //db
              $eintrag_info = "Update video_db SET render_status='audio' WHERE vuid='$vuid' AND uuid='$user_uuid'";
              $eintrag_info = db::$link->query($eintrag_info);}

    //audio mp3
      $cmd_pause = 1;
        $audioOutFile0 = "../videos/".$datavuid."/audio.mp3";
        $cmdvideo0 = "$ffmpeg -i $videoFile -codec:a libmp3lame -qscale:a 2 $audioOutFile0";
        if(exec($cmdvideo0)){echo "Error1";}else{ $cmd_pause = 0;

          //size
            $filesize = $getID3->analyze($videoOutFile0);
            $size = "audioviso:".$filesize['filesize'];
          //size mp3
            $filesize = $getID3->analyze($audioOutFile0);
            $size = $size.",audio:".$filesize['filesize'];
        }

    //die grösste datei soll nicht gerendert werden da es schon existiert

      if($cmd_pause == 0){
        $cmd_pause = 1;
    		//video dauer abfragen nach $videoOutFile0
    		$file = $getID3->analyze($videoOutFile0);
    		$time = $file['playtime_string'];
    		sscanf($time, "%d:%d:%d", $hours, $minutes, $seconds);
    		$time = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;

    		//haubpt thumbnail
        $thumb_sql = db::$link->query("SELECT thumb FROM video_db WHERE vuid = '$vuid'");
        $thumb_row = $thumb_sql->fetch_assoc();

        if($thumb_row['thumb'] == ""){
          $thumbname = $vuid.".jpg";

          $file        = $thumb ;
          $target      = "../images/thumb/large_img/".$thumbname;
          $target2     = "../images/thumb/small_img/".$thumbname;
          $target3     = "../images/thumb/org_img/".$thumbname;
          $max_width   = "1280";
          $max_heigh   = "720";
          $max_width2   = "320";
          $max_heigh2   = "180";
          $quality     = "100";
          $src_img = imagecreatefromjpeg($file);
          $picsize     = getimagesize($file);
          $src_width   = $picsize[0];
          $src_height  = $picsize[1];

          if($src_width > $max_width)
          {
            $convert = $max_width/$src_width;
            $dest_width = $max_width;
            $dest_height = $max_heigh;
          }
          else
          {
            $dest_width = $src_width;
            $dest_height = $src_height;
          }

          if($src_width > $max_width2)
          {
            $convert = $max_width2/$src_width;
            $dest_width2 = $max_width2;
            $dest_height2 = $max_heigh2;
          }
          else
          {
            $dest_width2 = $src_width;
            $dest_height2 = $src_height;
          }

          $dst_img = imagecreatetruecolor($dest_width,$dest_height);
          imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $dest_width, $dest_height, $src_width, $src_height);
          imagejpeg($dst_img, "$target", $quality);

          $dst_img2 = imagecreatetruecolor($dest_width2,$dest_height2);
          imagecopyresampled($dst_img2, $src_img, 0, 0, 0, 0, $dest_width2, $dest_height2, $src_width, $src_height);
          imagejpeg($dst_img2, "$target2", $quality);

          $dst_img3 = imagecreatetruecolor($src_width,$src_height);
          imagecopyresampled($dst_img3, $src_img, 0, 0, 0, 0, $src_width, $src_height, $src_width, $src_height);
          imagejpeg($dst_img3, "$target3", $quality);

          $up = "UPDATE video_db SET thumb = 'own' WHERE vuid = '$vuid'";
          $up = db::$link->query($up);
        }


    		//vorschau foto renderering
      		//für die erstellung von bildern alle drei sekunden oder so: https://www.youtube.com/watch?v=qT4hN5o57hI

      		/*
      		commmands
      		-i -> Inpput file name
      		-an -> Disabled audio
      		-ss -> Get Image from X seconds in the video
      		-s -> Size od the image
      		*/

    		   $interval = $time / 20;

    			//new preview
    				$cmdimgs0 = "$ffmpeg -i $videoFile -vf fps=1/$interval -s 854x480 ../images/thumb/preview/".$vuid."/%d.jpg";
    				if(exec($cmdimgs0)){echo "Error1";}


    			//im video vorschau
        			$img = "$ffmpeg -i $videoFile -vf fps=1/5 ../images/thumb/preview/".$vuid."/temp%d.jpg";
        			if(exec($img)){echo "Error1";}

        			$img2 = "$ffmpeg -i ../images/thumb/preview/".$vuid."/temp%d.jpg -filter_complex scale=320:180,tile=5x4 ../images/thumb/preview/".$vuid."/pre%d.jpg";
        			if(exec($img2)){echo "Error2";}

        				//löschen der Temps
        				$directory = "../images/thumb/preview/".$vuid."/";
        				$images = glob($directory . "temp*.jpg");

        				foreach ($images as $image){
        				  unlink($image);
        				}

            $eintrag_time = "Update video_db SET dauer='$time' WHERE vuid='$vuid' AND uuid='$user_uuid'";
            $eintrag_time = db::$link->query($eintrag_time);
          $cmd_pause = 0;
        }
        //end img render

  //ffmpeg: best seting: -sws_flags lanczos -> awesone !

  //====================================================
  //ffmpeg: best seting: -sws_flags lanczos -> awesome !
  //====================================================
  //================== Video render ====================
  //====================================================

    //4k version

    //2k version


    //1080p version
    if(($max_result == "2160") AND $cmd_pause == 0){
      $cmd_pause = 1;
      $videoOutFile = "../videos/".$datavuid."/1080p.mp4";
      $filter = calc_video($height,$width,"1080");
      $cmdvideo = "$ffmpeg -i $videoFile -filter:v \"$filter\" -minrate 10k -maxrate 7000k -bufsize 2000k -r 30 -sws_flags lanczos $videoOutFile";
      //$cmdvideo7 = "$ffmpeg -y -i $videoFile -vcodec nvenc_h264 -pix_fmt nv12 -preset fast -pix_fmt nv12 -filter:v \"$filter7\" $videoOutFile7";
      if(exec($cmdvideo)){echo "Error1440";}else{ $cmd_pause = 0;
        //size
          $filesize = $getID3->analyze($videoOutFile);
          $size = $size.",1080p:".$filesize['filesize'];
        //db
          $eintrag_info = "Update video_db SET render_status='1080' WHERE vuid='$vuid' AND uuid='$user_uuid'";
          $eintrag_info = db::$link->query($eintrag_info);
        //new video file
          $videoFile = $videoOutFile;
      }
    }

    //720p version
    if(($max_result == "1440") AND $cmd_pause == 0){
      $cmd_pause = 1;
      $videoOutFile = "../videos/".$datavuid."/720p.mp4";
      $filter = calc_video($height,$width,"720");
      $cmdvideo = "$ffmpeg -i $videoFile -filter:v \"$filter\" -minrate 10k -maxrate 4000k -bufsize 1000k -r 30 -sws_flags lanczos $videoOutFile";
      //$cmdvideo7 = "$ffmpeg -y -i $videoFile -vcodec nvenc_h264 -pix_fmt nv12 -preset fast -pix_fmt nv12 -filter:v \"$filter7\" $videoOutFile7";
      if(exec($cmdvideo)){echo "Error720";}else{ $cmd_pause = 0;
        //size
          $filesize = $getID3->analyze($videoOutFile);
          $size = $size.",720p:".$filesize['filesize'];
        //db
          $eintrag_info = "Update video_db SET render_status='720' WHERE vuid='$vuid' AND uuid='$user_uuid'";
          $eintrag_info = db::$link->query($eintrag_info);
        //new video file
          $videoFile = $videoOutFile;
      }
    }

    //480p version
    if(($max_result == "2160" OR $max_result == "1080") AND $cmd_pause == 0){
      $cmd_pause = 1;
      $videoOutFile = "../videos/".$datavuid."/480p.mp4";
      $filter = calc_video($height,$width,"480");
      $cmdvideo = "$ffmpeg -i $videoFile -filter:v \"$filter\" -minrate 10k -maxrate 2000k -bufsize 500k -r 30 -sws_flags lanczos $videoOutFile";
      //$cmdvideo7 = "$ffmpeg -y -i $videoFile -vcodec nvenc_h264 -pix_fmt nv12 -preset fast -pix_fmt nv12 -filter:v \"$filter7\" $videoOutFile7";
      if(exec($cmdvideo)){echo "Error480";}else{ $cmd_pause = 0;
        //size
          $filesize = $getID3->analyze($videoOutFile);
          $size = $size.",480p:".$filesize['filesize'];
        //db
          $eintrag_info = "Update video_db SET render_status='480' WHERE vuid='$vuid' AND uuid='$user_uuid'";
          $eintrag_info = db::$link->query($eintrag_info);
        //new video file
          $videoFile = $videoOutFile;
      }
    }

    //360p version
    if(($max_result == "1440" OR $max_result == "720") AND $cmd_pause == 0){
      $cmd_pause = 1;
      $videoOutFile = "../videos/".$datavuid."/360p.mp4";
      $filter = calc_video($height,$width,"360");
      $cmdvideo = "$ffmpeg -i $videoFile -filter:v \"$filter\" -minrate 10k -maxrate 1000k -bufsize 250k -r 30 -sws_flags lanczos $videoOutFile";
      //$cmdvideo7 = "$ffmpeg -y -i $videoFile -vcodec nvenc_h264 -pix_fmt nv12 -preset fast -pix_fmt nv12 -filter:v \"$filter7\" $videoOutFile7";
      if(exec($cmdvideo)){echo "Error360";}else{ $cmd_pause = 0;
        //size
          $filesize = $getID3->analyze($videoOutFile);
          $size = $size.",360p:".$filesize['filesize'];
        //db
          $eintrag_info = "Update video_db SET render_status='360' WHERE vuid='$vuid' AND uuid='$user_uuid'";
          $eintrag_info = db::$link->query($eintrag_info);
        //new video file
          $videoFile = $videoOutFile;
      }
    }

    //240p version
    if(($max_result == "2160" OR $max_result == "1080" OR $max_result == "480") AND $cmd_pause == 0){
      $cmd_pause = 1;
      $videoOutFile = "../videos/".$datavuid."/240p.mp4";
      $filter = calc_video($height,$width,"240");
      $cmdvideo = "$ffmpeg -i $videoFile -filter:v \"$filter\" -minrate 10k -maxrate 500k -bufsize 125k -r 30 -sws_flags lanczos $videoOutFile";
      //$cmdvideo7 = "$ffmpeg -y -i $videoFile -vcodec nvenc_h264 -pix_fmt nv12 -preset fast -pix_fmt nv12 -filter:v \"$filter7\" $videoOutFile7";
      if(exec($cmdvideo)){echo "Error240";}else{ $cmd_pause = 0;
        //size
          $filesize = $getID3->analyze($videoOutFile);
          $size = $size.",240p:".$filesize['filesize'];
        //db
          $eintrag_info = "Update video_db SET render_status='240' WHERE vuid='$vuid' AND uuid='$user_uuid'";
          $eintrag_info = db::$link->query($eintrag_info);
        //new video file
          $videoFile = $videoOutFile;
      }
    }

    //====================================================
    //=============== end Video render ===================
    //====================================================



    //====================================================
    //============ when video is rendered ================
    //====================================================

    if($cmd_pause == 0){

        //size
          if($is_webm == 0){
            $filesize = $getID3->analyze($yt_file);
            $size = $size.",".$max_result."p:".$filesize['filesize'];
          }else{
            $size = $size.",".$yt_size;
          }

          $eintrag_size = "Update video_db SET size='$size' WHERE vuid='$vuid' AND uuid='$user_uuid'";
          $eintrag_size = db::$link->query($eintrag_size);

        //db
        $eintrag_title = "Update video_db SET status='uploaded' WHERE vuid='$vuid' AND uuid='$user_uuid'";
        $eintrag_title = db::$link->query($eintrag_title);

          $loesch = "DELETE FROM video_db WHERE uuid='$user_uuid' AND video_title = '' AND status = 'start'";
          $eintrag_loesch = db::$link->query($loesch);

          // nach erfolgreichem upload echo:
          //echo "<script>videoUploaded = 2;</script> 100";


        //temp datei Löschen wenn Webm
          if($is_webm == 1){
            unlink($fileTmpLoc);
          }


        //add xp
          if($max_result == '2160'){ /*$lvl->add_xp('12',$vuid,$user_uuid);*/ $ach->add_ach('200','',$user_uuid);
          }elseif($max_result >= '1080'){$lvl->add_xp('11',$vuid,$user_uuid);
          }else{$lvl->add_xp('10',$vuid,$user_uuid);}


          //xp für das achievement lade 5,50,100 Videos öffentlich hoch
          $uvideos_sql = db::$link->query("SELECT COUNT(vuid) FROM video_db WHERE uuid = '$user_uuid' AND status = 'uploaded' AND privacy = 'public'");
          $uvideos_row = $uvideos_sql->fetch_row();

          if($uvideos_row[0] == 5){$ach->add_ach('180','',$user_uuid);}
          elseif($uvideos_row[0] == 50){$ach->add_ach('181','',$user_uuid);}
          elseif($uvideos_row[0] == 100){$ach->add_ach('182','',$user_uuid);}


          //add ach207
          $s_info_sql = db::$link->query("SELECT views FROM video_db WHERE uuid = '$user_uuid' AND status = 'uploaded' AND privacy = 'public'");
          $s_views = 0;
          while($s_info_row = $s_info_sql->fetch_array())
          {
            $s_views = $s_views + $s_info_row['views'];
          }
          if($s_views >= 50000){$ach->add_ach('207','',$user_uuid);}


          //add ach208
          $s_info_sql = db::$link->query("SELECT dauer FROM video_db WHERE uuid = '$user_uuid' AND status = 'uploaded' AND privacy = 'public'");
          $s_time = 0;
          while($s_info_row = $s_info_sql->fetch_array())
          {
            $s_time = $s_time + $s_info_row['dauer'];
          }
          if($s_time >= 86400){$ach->add_ach('208','',$user_uuid);}


          //add ach210
          if($time >= 600){$ach->add_ach('210','',$user_uuid);}
    }



  }// end if youtube download was ok
  else{
    echo $error;
  }


}// end $video_id != "" AND $pl == "" /*AND userauth === 1 */
else{

  if($pl != "")      { echo "error_is_pl"; }
  elseif($video_id == ""){ echo "error_video_id"; }
  elseif($userauth == ""){ echo "error_userauth"; }

}

}else{
  $vuid = $_POST['vuid'];  $vuid = mysqli_real_escape_string(db::$link,$vuid);
  $eintrag_abort = "Update video_db SET status='abort' WHERE vuid = '$vuid' AND uuid = '$user_uuid'";
  $eintrag_abort = db::$link->query($eintrag_abort);

  echo "error_to_many_videos";
}

?>
