<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

if($isUserLoggedIn === 1) {

if(isset($_POST['vuid']) AND isset($_POST['move'])){

  $vuid = mysqli_real_escape_string(db::$link,$_POST['vuid']);
  $move = mysqli_real_escape_string(db::$link,$_POST['move']);

  $time = strtotime(date('Y-m-d H:i:s'));

  if($move == "add/remove" AND isset($_POST['puid'])){
    $puid = mysqli_real_escape_string(db::$link,$_POST['puid']);

    $pl_con_sql = db::$link->query("SELECT status FROM playlist_content_db WHERE puid = '$puid' AND vuid = '$vuid'");
    $pl_con_row = $pl_con_sql->fetch_assoc();

    $pl_sql = db::$link->query("SELECT uuid FROM playlist_db WHERE puid = '$puid'");
    $pl_row = $pl_sql->fetch_assoc();

    $video_sql = db::$link->query("SELECT uploaddate FROM video_db WHERE vuid = '$vuid'");
    $video_row = $video_sql->fetch_assoc();
    $uploaddate = $video_row['uploaddate'];

    $pl_uuid = $pl_row['uuid'];
    if($pl_uuid == $user_uuid OR $user_rang == 1){

      if($pl_con_row['status'] == ""){ //wenn video niemals in pl war

          //zu pl hinzufügen
          $allplcontent = 0;
          $check_posi = db::$link->query("SELECT posi FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY posi DESC");
          $check_posi = $check_posi->fetch_assoc();
          $posi = $check_posi['posi'];
          $posi = $posi + 1;

          $eintrag = "INSERT INTO playlist_content_db
            (puid,uuid,vuid,posi,status,added_at,uploaddate)
            VALUES
            ('$puid','$user_uuid','$vuid','$posi','public','$time','$uploaddate')";
          $eintrag = db::$link->query($eintrag);

          if($eintrag == true){
            $pl_update = "Update playlist_db SET last_interaction='$time' WHERE puid = '$puid'";
            $pl_update = db::$link->query($pl_update);

            /*if($order_by == 1){
              $pl_thumb_update = "Update playlist_bank SET thumb = '$video_id' WHERE playlist_id = '$playlist_id' AND status = 'public'";
              $pl_thumb_update = mysqli_query($db_link,$pl_thumb_update);
            }*/

            echo "add";
          }else{
            echo "error";
          }

      }elseif($pl_con_row['status'] == "deleted"){ //wenn video mal in pl war aber wieder entfernt wurde

        $up = "UPDATE playlist_content_db SET status = 'public' WHERE puid = '$puid' AND vuid = '$vuid'";
        $up = db::$link->query($up);

        if($up == true){
          echo "add";
          $pl_update = "Update playlist_db SET last_interaction='$time' WHERE puid = '$puid'";
          $pl_update = db::$link->query($pl_update);
        }else{
          echo "error";
        }

      }elseif($pl_con_row['status'] == "public"){ //wenn video in pl ist -> entfernen

        $up = "UPDATE playlist_content_db SET status = 'deleted' WHERE puid = '$puid' AND vuid = '$vuid'";
        $up = db::$link->query($up);

        $playlist_sql     = db::$link->query("SELECT orderby FROM playlist_db WHERE puid = '$puid'");
        $playlist_row     = $playlist_sql->fetch_assoc();
          $playlist_orderby = $playlist_row['orderby'];

        $pl_check_sql = db::$link->query("SELECT thumb FROM playlist_db WHERE puid = '$puid'");
        $pl_check_row = $pl_check_sql->fetch_assoc();
          if($pl_check_row['thumb'] == $vuid){
            $up = "UPDATE playlist_db SET thumb = 'norm' WHERE puid = '$puid'";
            $up = db::$link->query($up);
          }

        if($playlist_orderby == 0){
          $sort_res = db::$link->query("SELECT pl_id FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY posi ASC");

          $posi = 0;
          while($row = $sort_res->fetch_array()){
            $posi++;
            $pl_id = $row['pl_id'];
            $up = "UPDATE playlist_content_db SET posi = '$posi' WHERE pl_id = '$pl_id'"; $up = db::$link->query($up);
          }
        }

        if($up == true){
          echo "remove";
        }else{
          echo "error";
        }

      }

    }//if berechtigung


  }elseif($move == "new" AND isset($_POST['pl_name']) AND isset($_POST['priv'])){

    if( $_POST['pl_name'] != "" AND $_POST['pl_name'] != " "){

      function puid() {
      	$check = 0;
      	while ($check != 1) {
      		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
      		$pass = array(); //remember to declare $pass as an array
      		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
      		for ($i = 0; $i < 12; $i++) {
      				$n = rand(0, $alphaLength);
      				$pass[] = $alphabet[$n];
      		}

      		$puid = implode($pass);

      		//test ob es das puid schon gibt
      		$check_sql = db::$link->query("SELECT puid FROM playlist_db WHERE puid = '$puid'");
      		$check_row = $check_sql->fetch_assoc();

      		if($check_row['puid'] == ""){
      			$check = 1;
      		}
      	}
      	return $puid;
      }

      $puid = puid();

      $video_sql = db::$link->query("SELECT uploaddate FROM video_db WHERE vuid = '$vuid'");
      $video_row = $video_sql->fetch_assoc();
      $uploaddate = $video_row['uploaddate'];


      //db:
      if(ctype_space($_POST['pl_name']) || $_POST['pl_name'] == '') {
        $pltitle = "[PLAYLIST TITLE]";
      }else{
        $pltitle = $_POST['pl_name'];
      }

      $pl_name_db = mysqli_real_escape_string(db::$link,$pltitle);

      //show:
      $pl_name = htmlentities($pltitle, ENT_QUOTES);

      //0 = Privat
      //1 = Öffentlich
      //2 = Nicht gelistet
      //3 = Nur Freunde

      switch ($_POST['priv']) {
        case 'privat':
          $priv = 0;
          $priv_icon = "<i class='fa fa-lock' aria-hidden='true'></i>";
          break;

        case 'public':
          $priv = 1;
          $priv_icon = "<span class='glyphicon glyphicon-globe' aria-hidden='true'></span>";
          break;

        case 'unlist':
          $priv = 2;
          $priv_icon = "<i class='fa fa-unlock' aria-hidden='true'></i>";
          break;

        case 'friend':
          $priv = 3;
          $priv_icon = "<span class='glyphicon glyphicon-user' aria-hidden='true'></span>";
          break;

        default:
          $priv = 0;
          $priv_icon = "<i class='fa fa-lock' aria-hidden='true'></i>";
          break;
      }

      $eintrag = "INSERT INTO playlist_db
        (title,uuid,puid,thumb,notiz,views,orderby,privacy,status,last_interaction,time)
        VALUES
        ('$pl_name_db','$user_uuid','$puid','norm','','0','1','$priv','public','$time','$time')";
      $eintrag = db::$link->query($eintrag);

      if($eintrag == true){

        $eintrag = "INSERT INTO playlist_content_db
          (puid,uuid,vuid,posi,status,added_at,uploaddate)
          VALUES
          ('$puid','$user_uuid','$vuid','1','public','$time','$uploaddate')";
        $eintrag = db::$link->query($eintrag);

        if($eintrag == true){
          echo"<div pl='".$puid."' class='pl_add_list_line pl_add_list_line_selectet pl_".$puid."'>";
            echo"<div class='pl_add_list_title no_overflow'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span>".$pl_name."</div>";
            echo"<div class='pl_add_list_privacy'>".$priv_icon."</div>";
          echo" </div>";
        }else{
          echo "error1";
        }

      }else{
        echo "error2";
      }

    }else{
      echo "error";
    }

  }elseif($move == "thumb" AND isset($_POST['puid'])){

    $puid = $_POST['puid'];

    $pl_sql = db::$link->query("SELECT uuid FROM playlist_db WHERE puid = '$puid'");
    $pl_row = $pl_sql->fetch_assoc();
      $pl_uuid = $pl_row['uuid'];
      if($pl_uuid == $user_uuid OR $user_rang == 1){
        $pl_check_sql = db::$link->query("SELECT puid FROM playlist_content_db WHERE puid = '$puid' and vuid = '$vuid' and status = 'public'");
        $pl_check_row = $pl_check_sql->fetch_assoc();

        if($pl_check_row['puid'] != ''){
          $up = "UPDATE playlist_db SET thumb = '$vuid' WHERE puid = '$puid'";
          $up = db::$link->query($up);

          if($up == true){
            echo "new_thumb";
          }
        }

      }

  }else{
    echo "error3";
  }

}else{ //not all parameters
  echo "error4";
}

}else{ //not logged in
  echo "error5";
}


?>
