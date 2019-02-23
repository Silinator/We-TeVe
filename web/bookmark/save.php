<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

if($isUserLoggedIn === 1){

  $bm_id = $_POST['bm'];
  $bm_title = mysqli_real_escape_string(db::$link,$_POST['title']);
  $bm_url = strtolower( mysqli_real_escape_string(db::$link,$_POST['url']) );

    $sonderzeichen = array(
      'https://www.we-teve.com/' => '',
      'https://we-teve.com/' => '',
      'www.we-teve.com/' => '',
      'we-teve.com/' => ''
    );
    $bm_url = str_replace(array_keys($sonderzeichen),array_values($sonderzeichen), $bm_url);

    $up = "UPDATE bookmark_db SET title = '$bm_title' WHERE bm_id = '$bm_id' AND uuid = '$user_uuid'";
    $up = db::$link->query($up);

    $up2 = "UPDATE bookmark_db SET url = '$bm_url' WHERE bm_id = '$bm_id' AND uuid = '$user_uuid'";
    $up2 = db::$link->query($up2);

    if($up  == true AND $up2 == true){
      echo "ok";
    }

}

?>
