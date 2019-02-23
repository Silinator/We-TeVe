<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

if($isUserLoggedIn === 1) {
if(isset($_POST['vuid']) AND isset($_POST['friend'])){

  $vuid         = $_POST['vuid'];
  $friend_uuid  = $_POST['friend'];

  $time = strtotime(date('Y-m-d H:i:s'));


    $rc_sql = db::$link->query("SELECT status FROM recom_db WHERE from_uuid = '$user_uuid' AND to_uuid = '$friend_uuid' AND vuid = '$vuid'");
    $rc_row = $rc_sql->fetch_assoc();


    $vid_sql = db::$link->query("SELECT vuid FROM video_db WHERE vuid = '$vuid' AND status != 'deleted'");
    $vid_row = $vid_sql->fetch_assoc();

    $friend_sql = db::$link->query("SELECT friend_id FROM friend_db WHERE first_uuid = '$user_uuid' AND second_uuid = '$friend_uuid' AND status = 'confirmed'");
    $friend_row = $friend_sql->fetch_assoc();

    if($vid_row['vuid'] != "" AND $friend_row['friend_id'] != ""){ //ob video existiert UND freunde sind
      if($rc_row['status'] == ""){ //wenn video niemals empfohlen wurde

          //zu rc hinzufügen

          $eintrag = "INSERT INTO recom_db
            (vuid,from_uuid,to_uuid,status,time)
            VALUES
            ('$vuid','$user_uuid','$friend_uuid','public','$time')";
          $eintrag = db::$link->query($eintrag);

          if($eintrag == true){
            echo "add";
          }else{
            echo "error11";
          }

      }elseif($rc_row['status'] == "deleted"){ //wenn video mal in pl war aber wieder entfernt wurde

        $up = "UPDATE recom_db SET status = 'public' WHERE from_uuid = '$user_uuid' AND to_uuid = '$friend_uuid' AND vuid = '$vuid'";
        $up = db::$link->query($up);

        if($up == true){
          echo "add";
        }else{
          echo "error12";
        }

      }elseif($rc_row['status'] == "public"){ //wenn video in pl ist -> entfernen

        $up = "UPDATE recom_db SET status = 'deleted' WHERE from_uuid = '$user_uuid' AND to_uuid = '$friend_uuid' AND vuid = '$vuid'";
        $up = db::$link->query($up);

        if($up == true){
          echo "remove";
        }else{
          echo "error13";
        }

      }
    }else{ //video not exist / kein freunde
      echo "error3";
    }

}else{ //not all parameters
  echo "error4";
}

}else{ //not logged in
  echo "error5";
}


?>
