<?php
//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = "../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

if($isUserLoggedIn === 1){

  $puid = mysqli_real_escape_string(db::$link,$_POST['puid']);

  $playlist_sql   = db::$link->query("SELECT uuid FROM playlist_db WHERE puid = '$puid'");
  $playlist_row   = $playlist_sql->fetch_assoc();
  $playlist_uuid  = $playlist_row['uuid'];


  if($playlist_uuid == $user_uuid OR $user_rang == 1){

    $up = "UPDATE playlist_db SET status = 'deleted' WHERE puid = '$puid'";
    $up = db::$link->query($up);

    $up2 = "UPDATE playlist_content_db SET status = 'pl_del' WHERE puid = '$puid'";
    $up2 = db::$link->query($up2);

    if($up == true){
      echo "ok";
    }

  }
}

?>
