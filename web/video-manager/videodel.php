<?php
//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = "../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

if ($isUserLoggedIn === 1){

  $vuid = mysqli_real_escape_string(db::$link,$_POST['vuid']);
  $act  = mysqli_real_escape_string(db::$link,$_POST['act']);

  $video_sql = db::$link->query("SELECT * FROM video_db WHERE vuid = '$vuid'");
  $video_row = $video_sql->fetch_assoc();

  $video_uuid = $video_row['uuid'];
  $video_uuif = sha1(sha1($video_uuid));

  $video_max_result = $video_row['max_result'];
  $video_status     = $video_row['status'];
  $data_vuid        = $video_row['datavuid'];

if($video_uuid == $user_uuid OR $user_rang == 1){
  if($video_status != 'rendering'){
    if($act == "del"){
      if($video_uuid == $user_uuid || $user_rang == 1){
        $up = "UPDATE video_db SET status = 'deleted' WHERE vuid = '$vuid'";
        $up = db::$link->query($up);
      }
    }elseif($act == "copyright" AND $user_rang == 1){
      $up = "UPDATE video_db SET status = 'copy_rights' WHERE vuid = '$vuid'";
      $up = db::$link->query($up);

      //strikes + 1
      $user_strikes = $u->userin('strikes','0',$video_uuif,'');
      $user_strikes = $user_strikes + 1;
      $u->userinset('strikes',$user_strikes,$video_uuif);

    }elseif($act == "community_rights" AND $user_rang == 1){
      $up = "UPDATE video_db SET status = 'community_rights' WHERE vuid = '$vuid'";
      $up = db::$link->query($up);

      //strikes + 1
      $user_strikes = $u->userin('strikes','0',$video_uuif,'');
      $user_strikes = $user_strikes + 1;
      $u->userinset('strikes',$user_strikes,$video_uuif);

    }

    if($up == true){
    //remove xp and notifications
      //video selber
        if($video_status == "uploaded"){ $lvl->remove_xp('10',$vuid,$video_uuid); $lvl->remove_xp('11',$vuid,$video_uuid); $lvl->remove_xp('12',$vuid,$video_uuid); }

      //kommentare
        $com_sql = db::$link->query("SELECT kuid,uuid FROM kommentar_db WHERE vuid = '$vuid' AND status = 'public'");
        while($com_row = $com_sql->fetch_array()){
          $del_up = "UPDATE kommentar_db SET status = 'vid_del' WHERE vuid = '$vuid' AND status = 'public'"; $del_up = db::$link->query($del_up);
          $com_kuid = $com_row['kuid'];
          $com_uuid = $com_row['uuid'];
          $lvl->remove_xp('20',$com_kuid,$com_uuid);
          $lvl->remove_xp('21',$com_kuid,$com_uuid);
          $lvl->remove_xp('22',$com_kuid,$com_uuid);
            $mes->remove_mes('4',$com_kuid,$video_uuid);
          //kommentare vote
          $com_vote_sql = db::$link->query("SELECT uuid FROM kommentar_vote_db WHERE kuid = '$com_kuid' AND status = 'public'");
          while($com_vote_row = $com_vote_sql->fetch_array()){
            $del_up = "UPDATE kommentar_vote_db SET status = 'vid_del' WHERE kuid = '$com_kuid' AND status = 'public'"; $del_up = db::$link->query($del_up);
            $lvl->remove_xp('15',$com_kuid.",".$com_vote_row['uuid'],$com_uuid);
            $lvl->remove_xp('16',$com_kuid.",".$com_vote_row['uuid'],$com_uuid);
            $lvl->remove_xp('17',$com_kuid,$com_uuid);
            $lvl->remove_xp('25',$com_kuid,$com_vote_row['uuid']);
            $lvl->remove_xp('26',$com_kuid,$com_vote_row['uuid']);
              $del_mes_up = "UPDATE message_db SET status = 'vid_del' WHERE message_type = '5' AND message_data = '$com_kuid' AND status = 'public'"; $del_mes_up = db::$link->query($del_mes_up);
          }
        }

      //video votes
        $video_vote_sql = db::$link->query("SELECT uuid FROM video_vote_db WHERE vuid = '$vuid' AND status = 'public'");
        while($video_vote_row = $video_vote_sql->fetch_array()){
          $del_up = "UPDATE video_vote_db SET status = 'vid_del' WHERE vuid = '$vuid' AND status = 'public'"; $del_up = db::$link->query($del_up);
          $lvl->remove_xp('01',$vuid,$video_vote_row['uuid']);
          $lvl->remove_xp('02',$vuid,$video_vote_row['uuid']);
          $lvl->remove_xp('03',$vuid.",".$video_vote_row['uuid'],$video_uuid);
          $lvl->remove_xp('04',$vuid.",".$video_vote_row['uuid'],$video_uuid);
            $del_mes_up = "UPDATE message_db SET status = 'vid_del' WHERE message_type = '7' AND message_data = '$vuid' AND status = 'public'"; $del_mes_up = db::$link->query($del_mes_up);
        }

        //orderner umbenennen
        function datavuid() {
        	$check = 0;
        	while ($check != 1) {
        		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        		$pass = array(); //remember to declare $pass as an array
        		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        		for ($i = 0; $i < 25; $i++) {
        				$n = rand(0, $alphaLength);
        				$pass[] = $alphabet[$n];
        		}

        		$datavuid = implode($pass);

        		//test ob es das datavuid schon gibt
        		$check_sql = db::$link->query("SELECT datavuid FROM video_db WHERE datavuid = '$datavuid'");
        		$check_row = $check_sql->fetch_assoc();

        		if($check_row['datavuid'] == ""){
        			$check = 1;
        		}
        	}
        	return $datavuid;
        }

        if(file_exists($_dhp."videos/".$data_vuid."/240p.mp4")) { rename($_dhp."videos/".$data_vuid, $_dhp."videos/".datavuid()); }

        echo "ok";
    }

  }else{
    echo "error_rendering";
  }
}

}

?>
