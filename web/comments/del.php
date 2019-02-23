<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

if($isUserLoggedIn === 1) {
if(isset($_POST['kuid'])){

  $kuid = mysqli_real_escape_string(db::$link,$_POST['kuid']);

  $com_sql = db::$link->query("SELECT uuid,vuid,cuid,re_kuid FROM kommentar_db WHERE kuid = '$kuid'");
  $com_row = $com_sql->fetch_assoc();
    $com_uuid = $com_row['uuid'];
    $com_vuid = $com_row['vuid'];
    $com_cuid = $com_row['cuid'];
    $re_kuid  = $com_row['re_kuid'];

  if($com_vuid != ""){

    $video_sql = db::$link->query("SELECT uuid FROM video_db WHERE vuid = '$com_vuid'");
    $video_row = $video_sql->fetch_assoc();
      $op_uuid = $video_row['uuid'];

  }elseif($com_cuid != ""){

      $op_uuid = $com_cuid;

  }else{
    echo "error";
  }




      if($op_uuid == $user_uuid OR $com_uuid == $user_uuid OR $user_rang == 1){
        $check_com_vote_sql = db::$link->query("SELECT vote_id FROM kommentar_vote_db WHERE kuid = '$kuid' AND status = 'public' LIMIT 1");
        $check_com_vote_row = $check_com_vote_sql->fetch_assoc();

        $check_re_com_sql = db::$link->query("SELECT kuid FROM kommentar_db WHERE re_kuid = '$kuid' AND status = 'public' LIMIT 1");
        $check_re_com_row = $check_re_com_sql->fetch_assoc();

        if($check_com_vote_row['vote_id'] == "" AND $check_re_com_row['kuid'] == ""){
          //entgülter Delete
          $up = "DELETE FROM kommentar_db WHERE kuid = '$kuid'";
          $up = db::$link->query($up);

          //remove notification
            if($re_kuid == ""){
              if($op_uuid != $user_uuid){
                $mes->remove_not('4',$kuid,$op_uuid);
                $mes->remove_mes('4',$kuid,$op_uuid);
              }
            }else{
              $com_sql = db::$link->query("SELECT uuid FROM kommentar_db WHERE kuid = '$re_kuid'");
              $com_row = $com_sql->fetch_assoc();
              $re_uuid = $com_row['uuid'];

              if($re_uuid != $user_uuid){
                $mes->remove_not('4',$kuid,$re_uuid);
                $mes->remove_mes('4',$kuid,$re_uuid);
              }
            }

            //remove xp
            if($re_kuid != ""){
              if($video_uuid == $user_uuid AND $re_uuid != $user_uuid){
                $lvl->remove_xp('22',$kuid,$user_uuid);
              }else{
                $lvl->remove_xp('21',$kuid,$user_uuid);
              }
            }else{
              $lvl->remove_xp('20',$kuid,$user_uuid);
            }

          //if ok
          echo "<i>[".$l->com_status_deleted."]</i>";
        }else{
          //wird zu [Kommentar entfernt]
          $up = "UPDATE kommentar_db SET status = 'deleted' WHERE kuid = '$kuid'";
          $up = db::$link->query($up);

          //remove not
            if($re_kuid == ""){

              if($op_uuid != $user_uuid){
                $mes->remove_not('4',$kuid,$op_uuid);
                $mes->remove_mes('4',$kuid,$op_uuid);
              }

            }else{

              $com_sql = db::$link->query("SELECT uuid FROM kommentar_db WHERE kuid = '$re_kuid'");
              $com_row = $com_sql->fetch_assoc();
              $re_uuid = $com_row['uuid'];

              if($re_uuid != $user_uuid){
                $mes->remove_not('4',$kuid,$re_uuid);
                $mes->remove_mes('4',$kuid,$re_uuid);
              }

            }

          //if ok
          echo "<i>[".$l->com_status_deleted."]</i>";
        }
      }

}else{echo "error"; }
}else{echo "error"; }

?>
