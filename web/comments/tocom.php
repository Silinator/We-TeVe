<?php

  //1. Pfad zum Stammverzeichniss wo sich die index befindet

  $_hp = '../'; //für include
  $_dhp = '../'; // für daten

  //2. all include
  $in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
  require_once ($_hp.'include/all_include.php'); //haupt includ

  if(isset($_POST['kuid'])){
    $com_kuid = $_POST['kuid'];
    $com_kuid = mysqli_real_escape_string(db::$link,$com_kuid);


    $com_sql = db::$link->query("SELECT kuid FROM kommentar_db WHERE kuid = '$com_kuid'");
    $com_row = $com_sql->fetch_assoc();



        if($com_row['kuid'] != ""){
          $host_kuid = $com->findhostcom($com_row['kuid']);

          echo "<div class='backtoallcoms blue'>".$l->com_backtoallcoms."</div>";

          echo "<h4>".$l->com_sort_title11."</h4>";


          echo $com->draw_comment($host_kuid,1,0,0,$_dhp);


          $kuid = $host_kuid;
          require_once($_hp.'comments/second_level_coms.php');

        }else{ // kein kommentar

        }


  }else{
    echo "error";
  }

?>
