<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

if($isUserLoggedIn === 1) {
if(isset($_POST['action'])){

  if($POST['action'] == 'new'){

    $aguid = 

    $set_token = "INSERT INTO abo_group_db
      (aguid,abo_group_db,uuid,group_name,posi,time,status) VALUES
      ('$token','$user_uuid','$use','$time')";
    $set_token = db::$link->query($set_token);
  }


}//end Post set
}//end logged in


?>
