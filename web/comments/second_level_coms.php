<?php

if(!isset($kuid)){

    //1. Pfad zum Stammverzeichniss wo sich die index befindet

    $_hp = '../'; //für include
    $_dhp = '/'; // für daten

    //2. all include
    $in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
    require_once ($_hp.'include/all_include.php'); //haupt includ

}

//post value
if(isset($kuid)){$kuid = $kuid;}
elseif(isset($_POST['kuid']) AND $_POST['kuid'] != ""){$kuid = $_POST['kuid'];}
else{$kuid = 0;}  $kuid = mysqli_real_escape_string(db::$link,$kuid);


//check kuid
  $c_kuid_ans = db::$link->query("SELECT kuid FROM kommentar_db WHERE re_kuid = '$kuid' LIMIT 1");
  $c_kuid_ans = $c_kuid_ans->fetch_assoc();
     $check_kuid_ans = $c_kuid_ans['kuid'];


if($kuid != "" AND $check_kuid_ans != ""){


  //layer 2
  $l2_results = db::$link->query("SELECT kuid FROM kommentar_db WHERE re_kuid = '$kuid' ORDER BY time ASC");
  while($l2_row = $l2_results->fetch_array()){

    $l2_kuid = $l2_row['kuid']; $layer = 2; $mes_s= "0"; $show = 0;  //0 = not show 'zum Kommentar' 1 = show 'zum Kommentar'
    echo $com->draw_comment($l2_kuid,$layer,$mes_s,$show,$_dhp);

      //layer 3
      $l3_results = db::$link->query("SELECT kuid FROM kommentar_db WHERE re_kuid = '$l2_kuid' ORDER BY time ASC");
      while($l3_row = $l3_results->fetch_array()){

        $l3_kuid = $l3_row['kuid']; $layer = 3; $mes_s = "0"; $show = 0;  //0 = not show 'zum Kommentar' 1 = show 'zum Kommentar'
        echo $com->draw_comment($l3_kuid,$layer,$mes_s,$show,$_dhp);

          //layer 4
          $l4_results = db::$link->query("SELECT kuid FROM kommentar_db WHERE re_kuid = '$l3_kuid' ORDER BY time ASC");
          while($l4_row = $l4_results->fetch_array()){

            $l4_kuid = $l4_row['kuid']; $layer = 4; $mes_s = "0"; $show = 0;  //0 = not show 'zum Kommentar' 1 = show 'zum Kommentar'
            echo $com->draw_comment($l4_kuid,$layer,$mes_s,$show,$_dhp);

              //layer 5
              $l5_results = db::$link->query("SELECT kuid FROM kommentar_db WHERE re_kuid = '$l4_kuid' ORDER BY time ASC");
              while($l5_row = $l5_results->fetch_array()){

                $l5_kuid = $l5_row['kuid']; $layer = 5; $mes_s = "0"; $show = 0;  //0 = not show 'zum Kommentar' 1 = show 'zum Kommentar'

                echo $com->draw_comment($l5_kuid,$layer,$mes_s,$show,$_dhp);
                $com->re_commenting($l5_kuid,$mes_s,$show,$_dhp);

              }//end layer 5
          }//end layer 4
      }//end layer 3
    }//end layer 2



  /*
  //layer 2
  $l2_results = db::$link->query("SELECT kuid FROM kommentar_db WHERE  re_kuid = '$kuid' ORDER BY time ASC");
  while($l2_row = $l2_results->fetch_array()){

    $l2_kuid = $l2_row['kuid']; $layer = 2; $host = ""; $show = 0;  //0 = not show 'zum Kommentar' 1 = show 'zum Kommentar'
    echo $com->draw_comment($l2_kuid,$layer,$host,$show,$_dhp);

      //layer 3
      $l3_results = db::$link->query("SELECT kuid FROM kommentar_db WHERE re_kuid = '$l2_kuid' ORDER BY time ASC");
      while($l3_row = $l3_results->fetch_array()){

        $l3_kuid = $l3_row['kuid']; $layer = 3; $host = ""; $show = 0;  //0 = not show 'zum Kommentar' 1 = show 'zum Kommentar'
        echo $com->draw_comment($l3_kuid,$layer,$host,$show,$_dhp);

          //layer 4
          $l4_results = db::$link->query("SELECT kuid FROM kommentar_db WHERE re_kuid = '$l3_kuid' ORDER BY time ASC");
          while($l4_row = $l4_results->fetch_array()){

            $l4_kuid = $l4_row['kuid']; $layer = 4; $host = $l4_kuid; $show = 0;  //0 = not show 'zum Kommentar' 1 = show 'zum Kommentar'
            echo $com->draw_comment($l4_kuid,$layer,$host,$show,$_dhp);

              //layer 5
              $l5_results = db::$link->query("SELECT kuid FROM kommentar_db WHERE host_kuid = '$l4_kuid' ORDER BY time ASC");
              while($l5_row = $l5_results->fetch_array()){

                $l5_kuid = $l5_row['kuid']; $layer = 5; $host = $l4_kuid; $show = 0;  //0 = not show 'zum Kommentar' 1 = show 'zum Kommentar'
                echo $com->draw_comment($l5_kuid,$layer,$host,$show,$_dhp);


              }//end layer 5
          }//end layer 4
      }//end layer 3
    }//end layer 2*/


}else{

  //echo "kuid = ".$kuid."<br/>";
  //echo "check_kuid = ".$check_kuid_ans;

}




//gibt layer zurück -> für copy and paste

/*
  //check kuid

  $kuid = $row['kuid'];
  $layer = 1; $host = "";
  $show = 0;

    $c_kuid_ans = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$kuid' LIMIT 1");
    $c_kuid_ans = $c_kuid_ans->fetch_assoc();
       $check_kuid_ans = $c_kuid_ans['re_kuid'];


  if($kuid != "" AND $check_kuid_ans != ""){
    //layer 2
      $l2_results = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE re_kuid = '$kuid' ORDER BY time ASC LIMIT 1");
      while($l2_row = $l2_results->fetch_array()){

        $l2_kuid = $l2_row['re_kuid']; $layer = 2; $host = "";

          //layer 3
          $l3_results = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE re_kuid = '$l2_kuid' ORDER BY time ASC LIMIT 1");
          while($l3_row = $l3_results->fetch_array()){

            $l3_kuid = $l3_row['re_kuid']; $layer = 3; $host = "";

              //layer 4
              $l4_results = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE re_kuid = '$l3_kuid' ORDER BY time ASC LIMIT 1");
              while($l4_row = $l4_results->fetch_array()){

                $l4_kuid = $l4_row['re_kuid']; $layer = 4; $host = $l4_kuid;
                  //layer 5
                  $l5_results = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE host_kuid = '$l4_kuid' ORDER BY time ASC LIMIT 1");
                  while($l5_row = $l5_results->fetch_array()){

                    $l5_kuid = $l5_row['re_kuid']; $layer = 5; $host = $l4_kuid;


                  }//end layer 5
              }//end layer 4
          }//end layer 3
      }//end layer 2
  }
*/

?>
