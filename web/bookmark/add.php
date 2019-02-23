<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet
$_hp = '../'; //für include
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

if($isUserLoggedIn === 1){
  $bm_url  = $_POST['bookmark'];
  $bm_name = $_POST['bm_name'];
  $bm_name = mysqli_real_escape_string(db::$link,$bm_name);

  $time    = date('Y-m-d H:i:s');
  $time    = strtotime($time);


  //test on mehre leerschläge/enter drin sind - sie werden auf einen verringert
  $bm_name = $f->embty_test($bm_name);

  if($bm_url != "" AND $bm_name != "" AND $bm_name != " "){


      if($bm_url != "index" AND $bm_url != "index<br/>"){
          $bm_sql = db::$link->query("SELECT pos FROM bookmark_db WHERE uuid = '$user_uuid' AND status = 'public' ORDER BY bm_id DESC LIMIT 1");
          $bm_row = $bm_sql->fetch_assoc();

          $bm_pos = $bm_row['pos'] + 1;

          $set_bm = "INSERT INTO bookmark_db
                (uuid,title,url,pos,status,time) VALUES
                ('$user_uuid','$bm_name','$bm_url','$bm_pos','public','$time')";
          $set_bm = db::$link->query($set_bm);

          if($set_bm != true){
            echo "error";
          }

      }else{
        echo "index_error";
      }
  }else{
    echo "error";
  }

}else{
  echo "error";
}
?>
