<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

  $time     = date('Y-m-d H:i:s');
  $time     = strtotime($time);

  if(isset($_POST['content']) AND (isset($_POST['vuid']) OR isset($_POST['cuid'])) AND isset($_POST['re']) AND isset($_POST['mes']) AND isset($_POST['addedvid']) AND isset($_POST['token'])){

      $content     = $_POST['content'];

        $content = str_replace(["%26amp%3B"], "&", $content);
        $content = urldecode($content);
        $content = str_replace(["\r\n", "\r", "\n"], "<br>", $content);

        $brs = array(
          '    ' => ' ',
          '   ' => ' ',
          '  ' => ' ',
          '<br><br><br><br>' => '<br>',
          '<br><br><br>' => '<br>',
          '<br><br>' => '<br>',
          '<br>' => '<br>',
          '<br> <br> <br> <br> ' => '<br>',
          '<br> <br> <br> ' => '<br>',
          '<br> <br> ' => '<br>',
          '<br> ' => '<br>',
          ' <br> <br> <br> <br> ' => '<br>',
          ' <br> <br> <br> ' => '<br>',
          ' <br> <br> ' => '<br>',
          ' <br> ' => '<br>',
          ' <br> <br> <br> <br>' => '<br>',
          ' <br> <br> <br>' => '<br>',
          ' <br> <br>' => '<br>',
          ' <br>' => '<br>',
        );


        $a = 0;
        while ($a == 0) {
          $content = str_replace(array_keys($brs),array_values($brs), $content);

          $seach  = strpos($content, "<br><br>");
          $seach2 = strpos($content, "<br> <br>");
          $seach3 = strpos($content, "  ");

          if($seach === false AND $seach2 === false AND $seach3 === false){
            $a = 1;
          }
        }



        $content = mysqli_real_escape_string(db::$link,$content);


      if(isset($_POST['vuid']) AND $_POST['vuid'] != ""){ $cuid = ""; $vuid = $_POST['vuid'];}
      if(isset($_POST['cuid']) AND $_POST['cuid'] != ""){ $vuid = ""; $cuid = $_POST['cuid'];}

        $vuid      = mysqli_real_escape_string(db::$link,$vuid);
          //test ob video existtiert ->
           $c_vuid = db::$link->query("SELECT vuid,uuid FROM video_db WHERE vuid = '$vuid' LIMIT 1");
           $c_vuid = $c_vuid->fetch_assoc();
              $check_vuid = $c_vuid['vuid'];
              $video_uuid = $c_vuid['uuid'];

        $cuid      = mysqli_real_escape_string(db::$link,$cuid);
          //test ob video existtiert ->
           $c_cuid = db::$link->query("SELECT uuid FROM user_find_db WHERE uuid = '$cuid' LIMIT 1");
           $c_cuid = $c_cuid->fetch_assoc();
              $check_cuid = $c_cuid['uuid'];


      $re         = $_POST['re'];
        $re       = mysqli_real_escape_string(db::$link,$re);
          //test ob re existtiert
            $c_re = db::$link->query("SELECT uuid,kuid FROM kommentar_db WHERE kuid = '$re' LIMIT 1");
            $c_re = $c_re->fetch_assoc();
              $re_uuid = $c_re['uuid'];
              $check_re = $c_re['kuid'];


      $mes_s       = $_POST['mes'];
        if($mes_s == 0 OR $mes_s == 1){ $mes_s = $mes_s; }else{ $mes_s = 0;}

      $addedvid   = $_POST['addedvid'];
        $addedvid = mysqli_real_escape_string(db::$link,$addedvid);
          //test ob video existtiert
            $c_vid = db::$link->query("SELECT vuid FROM video_db WHERE vuid = '$addedvid' LIMIT 1");
            $c_vid = $c_vid->fetch_assoc();
              $check_vid = $c_vid['vuid'];


      $token      = $_POST['token'];
        $token    = mysqli_real_escape_string(db::$link,$token);
          //test ob token existtiert
            $check_token = $f->checktoken($token,'com');

      //test on mehre leerschläge/enter drin sind - sie werden auf einen verringert
      $c_content = $f->embty_test($content);


      if($check_token == "ok"){
        if(($check_vuid != "" OR $check_cuid != "") AND ($check_re != "" OR $re == "")
        AND ($check_vid != "" OR $addedvid == "") ){ // test ob gültig
          if($c_content != "" AND $c_content != " "){

              $kuid = $f->mk_kuid();
              $time = date('Y-m-d H:i:s');
              $time = strtotime($time);


              $send_com = "INSERT INTO kommentar_db
                    ( vuid, cuid,  kuid,  re_kuid,  uuid,  kommentar,  added_video, pos_vote,  neg_vote,  time,    status) VALUES
                    ('$vuid', '$cuid', '$kuid',  '$re', '$user_uuid', '$content', '$addedvid', '0', '0', '$time', 'public')";
              $send_com = db::$link->query($send_com);

              $new_token = $f->settoken('com','');

              if($send_com == true){


                //add notification
                if($re == ""){

                  if($video_uuid != $user_uuid){
                    $mes->add_not('4',$kuid,$video_uuid);
                    $mes->add_mes('4',$kuid,$user_uuid,0,$video_uuid);
                  }

                }else{

                  $com_sql = db::$link->query("SELECT uuid FROM kommentar_db WHERE kuid = '$re'");
                  $com_row = $com_sql->fetch_assoc();
                  $re_uuid = $com_row['uuid'];

                  if($re_uuid != $user_uuid){
                    $mes->add_not('4',$kuid,$re_uuid);
                    $mes->add_mes('4',$kuid,$user_uuid,0,$re_uuid);
                  }

                }


                //add xp
                  //xp für schreiber

                  if($re != ""){
                    if($video_uuid == $user_uuid AND $re_uuid != $user_uuid){
                      $lvl->add_xp('22',$kuid,$user_uuid);
                    }else{
                      $lvl->add_xp('21',$kuid,$user_uuid);
                    }
                  }else{
                    $lvl->add_xp('20',$kuid,$user_uuid);
                  }

                  //add Errungenschaften für schreiber
                  $com_c_sql = db::$link->query("SELECT count(kuid) FROM kommentar_db WHERE uuid = '$user_uuid'");
                  $com_c_row = $com_c_sql->fetch_row();
                    if($com_c_row[0] == 10)  {$ach->add_ach('150','',$user_uuid);}
                    if($com_c_row[0] == 100) {$ach->add_ach('151','',$user_uuid);}
                    if($com_c_row[0] == 1000){$ach->add_ach('152','',$user_uuid);}


                  //add Errungenschaften fur das Video
                  $com_c_sql = db::$link->query("SELECT count(kuid) FROM kommentar_db WHERE vuid = '$vuid' AND uuid != '$video_uuid'");
                  $com_c_row = $com_c_sql->fetch_row();
                    if($com_c_row[0] == 10)  {$ach->add_ach('110',$vuid,$video_uuid);}
                    if($com_c_row[0] == 100) {$ach->add_ach('111',$vuid,$video_uuid);}
                    if($com_c_row[0] == 1000){$ach->add_ach('112',$vuid,$video_uuid);}


                //get val
                  //test ob es Layer 1 ist
                  $t_layer4 = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$kuid' LIMIT 1");
                  $t_layer4 = $t_layer4->fetch_assoc();
                    $test_layer4 = $t_layer4['re_kuid'];
                    //test ob es Layer 2 ist
                    $t_layer3 = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$test_layer4' LIMIT 1");
                    $t_layer3 = $t_layer3->fetch_assoc();
                      $test_layer3 = $t_layer3['re_kuid'];
                      //test ob es Layer 3 ist
                      $t_layer2 = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$test_layer3' LIMIT 1");
                      $t_layer2 = $t_layer2->fetch_assoc();
                        $test_layer2 = $t_layer2['re_kuid'];
                        //test ob es Layer 4 ist
                        $t_layer1 = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$test_layer2' LIMIT 1");
                        $t_layer1 = $t_layer1->fetch_assoc();
                          $test_layer1 = $t_layer1['re_kuid'];
                          //test ob es Layer 5 ist
                          $t_layer0 = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$test_layer1' LIMIT 1");
                          $t_layer0 = $t_layer0->fetch_assoc();
                            $test_layer0 = $t_layer0['re_kuid'];

                  $layer = 5;
                  if($test_layer1 == ""){$layer = 4;}
                  if($test_layer2 == ""){$layer = 3;}
                  if($test_layer3 == ""){$layer = 2;}
                  if($test_layer4 == ""){$layer = 1;}

                    $show = 0; //0 = not show 'zum Kommentar' 1 = show 'zum Kommenta'

                    echo $new_token.",";
                    $com->draw_comment($kuid,$layer,$mes_s,$show,$_dhp);
              }else{
                echo "error1"; //konnte nicht gesendet werden
              }

          }else{
            echo "empty"; //kommentar ist leer
          }
        }else{
          echo "error2"; //vuid,re,mes,addedvideo error
        }
      }else{
        echo "error3"; //kein gültiges token
      }
  }else{//$_POST set?
    echo "error4"; //parameter nicht gesetzt
  }
?>
