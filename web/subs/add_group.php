<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet
$_hp = '../'; //für includes
$_dhp = '../../'; // für daten

//2. all include
$in_save_code_all_include = "&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z";
require_once ($_hp.'include/all_include.php'); //haupt include



if($isUserLoggedIn === 1){

  $group_name   = mysqli_real_escape_string(db::$link,$_POST['name']);
  $channel_uuid = mysqli_real_escape_string(db::$link,$_POST['channel_uuid']);


}

?>
