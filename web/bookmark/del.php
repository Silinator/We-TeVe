<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

if($isUserLoggedIn === 1){

  $bm_id = $_POST['bm'];

  $up = "UPDATE bookmark_db SET status = 'deleted' WHERE bm_id = '$bm_id' AND uuid = '$user_uuid'";
  $up = db::$link->query($up);

  if($up == true){
    echo "ok";
  }

}

?>
