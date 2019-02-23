<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = "../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

if(isset($_POST['res'])){

  if($_POST['res'] < 7 AND $_POST['res'] >= 1){
    $res = $_POST['res'];
  }else{
    $res = 0;
  }
  /*res
    1 Nein geklickt
    2 Miner class geblockt - Miner blockers
    3 Iframe geblockt - Norton
    4 CPU Nutzung geblockt - Antivirus
    5 Miner class geblockt - Miner blockers
    6 Miner Script gelöscht - Miner blockers
  */

  $user_ip     = getenv("REMOTE_ADDR"); //ip
  $user_device = $_SERVER['HTTP_USER_AGENT'];

  if($isUserLoggedIn === 1){
    $user_uuid = $user_uuid;
  }else{
    $user_uuid = "";
  }

  $time = strtotime(date('Y-m-d H:i:s'));


  //eintrag
  $set_stats = "INSERT INTO coinhive_stats_db
    (ip,uuid,res,device,time) VALUES
    ('$user_ip','$user_uuid','$res','$user_device','$time')";
  $set_stats = db::$link->query($set_stats);

}

?>
