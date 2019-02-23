<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

if($isUserLoggedIn === 1) {
if(isset($_POST['kuid']) AND isset($_POST['vote']) AND isset($_POST['tok']) AND ($_POST['vote'] == "pos" OR $_POST['vote'] == "neg")){

  $kuid         = $_POST['kuid'];
  $vote         = $_POST['vote'];
  $token        = $_POST['tok'];

  $vote_token = $f->checktoken($token,'com_like');

  $time = strtotime(date('Y-m-d H:i:s'));


$vid_sql = db::$link->query("SELECT kuid,uuid FROM kommentar_db WHERE kuid = '$kuid' AND status = 'public'");
$vid_row = $vid_sql->fetch_assoc();

if($vid_row['kuid'] != "" && $vid_row['uuid'] != $user_uuid){ //ob kommentar existiert

if($vote_token == "ok"){  // token ok

  $com_uuid = $vid_row['uuid'];

  if($vote == "pos"){

    $vote_sql = db::$link->query("SELECT status FROM kommentar_vote_db WHERE kuid = '$kuid' AND uuid = '$user_uuid' AND vote = 'pos'");
    $vote_row = $vote_sql->fetch_assoc();

      if($vote_row['status'] == ""){ //wenn video niemals geliket wurde

          //zu vote hinzufügen
          $eintrag = "INSERT INTO kommentar_vote_db
            (uuid,kuid,vote,status,time)
            VALUES
            ('$user_uuid','$kuid','pos','public','$time')";
          $eintrag = db::$link->query($eintrag);

          if($eintrag == true){

            //ob eine neg bewertung gegebung wurde
            $vote2_sql = db::$link->query("SELECT status FROM kommentar_vote_db WHERE kuid = '$kuid' AND uuid = '$user_uuid' AND vote = 'neg'");
            $vote2_row = $vote2_sql->fetch_assoc();

            if($vote2_row['status'] == 'public'){
              //neg vote wieder entfernen & pos vote hinzufügen
              $up = "UPDATE kommentar_vote_db SET status = 'deleted' WHERE kuid = '$kuid' AND uuid = '$user_uuid' AND vote = 'neg'";
              $up = db::$link->query($up);

              $up = "UPDATE kommentar_db SET neg_vote = (neg_vote - 1) WHERE kuid = '$kuid'";
              $up = db::$link->query($up);

              $up = "UPDATE kommentar_db SET pos_vote = (pos_vote + 1) WHERE kuid = '$kuid'";
              $up = db::$link->query($up);

              //add notification
              $data_sql = db::$link->query("SELECT vote_id FROM kommentar_vote_db WHERE kuid = '$kuid' AND uuid = '$user_uuid' AND vote = 'pos' AND status = 'public'");
              $data_row = $data_sql->fetch_assoc();
                $mes->add_not('5',$data_row['vote_id'],$com_uuid);
                $mes->add_mes('5',$kuid,$user_uuid,0,$com_uuid);

              //remove XP
                $lvl->remove_xp('26',$kuid,$user_uuid);
                $lvl->remove_xp('16',$kuid.",".$user_uuid,$com_uuid);

              //add XP
                $lvl->add_xp('25',$kuid,$user_uuid);
                $lvl->add_xp('15',$kuid.",".$user_uuid,$com_uuid);

              //add Ach
                $ach->add_ach('202','',$user_uuid);

              $erg = "switch";




            }else{
              //nur pos vote hinzufügen
              $up = "UPDATE kommentar_db SET pos_vote = (pos_vote + 1) WHERE kuid = '$kuid'";
              $up = db::$link->query($up);

              //add notification
              $data_sql = db::$link->query("SELECT vote_id FROM kommentar_vote_db WHERE kuid = '$kuid' AND uuid = '$user_uuid' AND vote = 'pos' AND status = 'public'");
              $data_row = $data_sql->fetch_assoc();
                $mes->add_not('5',$data_row['vote_id'],$com_uuid);
                $mes->add_mes('5',$kuid,$user_uuid,0,$com_uuid);

              //add XP
                $lvl->add_xp('25',$kuid,$user_uuid);
                $lvl->add_xp('15',$kuid.",".$user_uuid,$com_uuid);

              //add Ach
                $ach->add_ach('202','',$user_uuid);

              $erg = "addpos";

            }

            $vid_token = $f->settoken('com_like','');

            echo $vid_token.",".$erg;

          }else{
            echo "error";
          }

      }elseif($vote_row['status'] == "deleted"){ //wenn video geliket war aber wieder entfernt wurde

        $up = "UPDATE kommentar_vote_db SET status = 'public' WHERE kuid = '$kuid' AND uuid = '$user_uuid' AND vote = 'pos'";
        $up = db::$link->query($up);

        if($up == true){

          //ob eine neg bewertung gegebung wurde
          $vote2_sql = db::$link->query("SELECT status FROM kommentar_vote_db WHERE kuid = '$kuid' AND uuid = '$user_uuid' AND vote = 'neg'");
          $vote2_row = $vote2_sql->fetch_assoc();

          if($vote2_row['status'] == 'public'){
            //neg vote wieder entfernen & pos vote hinzufügen
            $up = "UPDATE kommentar_vote_db SET status = 'deleted' WHERE kuid = '$kuid' AND uuid = '$user_uuid' AND vote = 'neg'";
            $up = db::$link->query($up);

            $up = "UPDATE kommentar_db SET neg_vote = (neg_vote - 1) WHERE kuid = '$kuid'";
            $up = db::$link->query($up);

            $up = "UPDATE kommentar_db SET pos_vote = (pos_vote + 1) WHERE kuid = '$kuid'";
            $up = db::$link->query($up);

            //add notification
            $data_sql = db::$link->query("SELECT vote_id FROM kommentar_vote_db WHERE kuid = '$kuid' AND uuid = '$user_uuid' AND vote = 'pos' AND status = 'public'");
            $data_row = $data_sql->fetch_assoc();
              //$mes->add_not('5',$data_row['vote_id'],$com_uuid);
              $mes->add_mes('5',$kuid,$user_uuid,1,$com_uuid);

            //remove XP
              $lvl->remove_xp('26',$kuid,$user_uuid);
              $lvl->remove_xp('16',$kuid.",".$user_uuid,$com_uuid);

            //add XP
              $lvl->add_xp('25',$kuid,$user_uuid);
              $lvl->add_xp('15',$kuid.",".$user_uuid,$com_uuid);

            //add Ach
              $ach->add_ach('202','',$user_uuid);

            $erg = "switch";

          }else{
            //nur pos vote hinzufügen
            $up = "UPDATE kommentar_db SET pos_vote = (pos_vote + 1) WHERE kuid = '$kuid'";
            $up = db::$link->query($up);

            //add notification
            $data_sql = db::$link->query("SELECT vote_id FROM kommentar_vote_db WHERE kuid = '$kuid' AND uuid = '$user_uuid' AND vote = 'pos' AND status = 'public'");
            $data_row = $data_sql->fetch_assoc();
              //$mes->add_not('5',$data_row['vote_id'],$com_uuid);
              $mes->add_mes('5',$kuid,$user_uuid,1,$com_uuid);

            //add XP
              $lvl->add_xp('25',$kuid,$user_uuid);
              $lvl->add_xp('15',$kuid.",".$user_uuid,$com_uuid);

            //add Ach
              $ach->add_ach('202','',$user_uuid);

            $erg = "addpos";

          }

          $com_token = $f->settoken('com_like','');

          echo $com_token.",".$erg;

        }else{
          echo "error";
        }

      }elseif($vote_row['status'] == "public"){ //wenn video geliket ist -> entfernen

        $up = "UPDATE kommentar_vote_db SET status = 'deleted' WHERE kuid = '$kuid' AND uuid = '$user_uuid' AND vote = 'pos'";
        $up = db::$link->query($up);

        if($up == true){

          //nur pos vote enterfernen
          $up = "UPDATE kommentar_db SET pos_vote = (pos_vote - 1) WHERE kuid = '$kuid'";
          $up = db::$link->query($up);

          //remove notification
            $data_sql = db::$link->query("SELECT vote_id FROM kommentar_vote_db WHERE kuid = '$kuid' AND uuid = '$user_uuid' AND vote = 'pos' AND status = 'deleted'");
            $data_row = $data_sql->fetch_assoc();
              $mes->remove_not('5',$data_row['vote_id'],$com_uuid);
              $mes->remove_mes('5',$kuid,$com_uuid);


          //remove XP
            $lvl->remove_xp('25',$kuid,$user_uuid);
            $lvl->remove_xp('15',$kuid.",".$user_uuid,$com_uuid);


          $erg = "rempos";


          $vid_token = $f->settoken('com_like','');

          echo $vid_token.",".$erg;

        }else{
          echo "error";
        }

      }


    }elseif($vote == "neg"){

      $vote_sql = db::$link->query("SELECT status FROM kommentar_vote_db WHERE kuid = '$kuid' AND uuid = '$user_uuid' AND vote = 'neg'");
      $vote_row = $vote_sql->fetch_assoc();

        if($vote_row['status'] == ""){ //wenn video niemals gedisliket wurde

            //zu vote hinzufügen
            $eintrag = "INSERT INTO kommentar_vote_db
              (uuid,kuid,vote,status,time)
              VALUES
              ('$user_uuid','$kuid','neg','public','$time')";
            $eintrag = db::$link->query($eintrag);

            if($eintrag == true){

              //ob eine pos bewertung gegebung wurde
              $vote2_sql = db::$link->query("SELECT status FROM kommentar_vote_db WHERE kuid = '$kuid' AND uuid = '$user_uuid' AND vote = 'pos'");
              $vote2_row = $vote2_sql->fetch_assoc();

              if($vote2_row['status'] == 'public'){
                //pos vote wieder entfernen & neg vote hinzufügen
                $up = "UPDATE kommentar_vote_db SET status = 'deleted' WHERE kuid = '$kuid' AND uuid = '$user_uuid' AND vote = 'pos'";
                $up = db::$link->query($up);

                $up = "UPDATE kommentar_db SET pos_vote = (pos_vote - 1) WHERE kuid = '$kuid'";
                $up = db::$link->query($up);

                $up = "UPDATE kommentar_db SET neg_vote = (neg_vote + 1) WHERE kuid = '$kuid'";
                $up = db::$link->query($up);


                //remove XP
                  $lvl->remove_xp('25',$kuid,$user_uuid);
                  $lvl->remove_xp('15',$kuid.",".$user_uuid,$com_uuid);

                //add XP
                  $lvl->add_xp('26',$kuid,$user_uuid);
                  $lvl->add_xp('16',$kuid.",".$user_uuid,$com_uuid);


                $erg = "switch";

              }else{
                //nur neg vote hinzufügen
                $up = "UPDATE kommentar_db SET neg_vote = (neg_vote + 1) WHERE kuid = '$kuid'";
                $up = db::$link->query($up);

                //add XP
                  $lvl->add_xp('26',$kuid,$user_uuid);
                  $lvl->add_xp('16',$kuid.",".$user_uuid,$com_uuid);

                $erg = "addneg";

              }


              $vid_token = $f->settoken('com_like','');

              echo $vid_token.",".$erg;

            }else{
              echo "error";
            }

        }elseif($vote_row['status'] == "deleted"){ //wenn video gedisliket war aber wieder entfernt wurde

          $up = "UPDATE kommentar_vote_db SET status = 'public' WHERE kuid = '$kuid' AND uuid = '$user_uuid' AND vote = 'neg'";
          $up = db::$link->query($up);

          if($up == true){

            //ob eine neg bewertung gegebung wurde
            $vote_sql = db::$link->query("SELECT status FROM kommentar_vote_db WHERE kuid = '$kuid' AND uuid = '$user_uuid' AND vote = 'pos'");
            $vote_row = $vote_sql->fetch_assoc();

            if($vote_row['status'] == 'public'){
              //pos vote wieder entfernen & neg vote hinzufügen
              $up = "UPDATE kommentar_vote_db SET status = 'deleted' WHERE kuid = '$kuid' AND uuid = '$user_uuid' AND vote = 'pos'";
              $up = db::$link->query($up);

              $up = "UPDATE kommentar_db SET pos_vote = (pos_vote - 1) WHERE kuid = '$kuid'";
              $up = db::$link->query($up);

              $up = "UPDATE kommentar_db SET neg_vote = (neg_vote + 1) WHERE kuid = '$kuid'";
              $up = db::$link->query($up);


              //remove XP
                $lvl->remove_xp('25',$kuid,$user_uuid);
                $lvl->remove_xp('15',$kuid.",".$user_uuid,$com_uuid);

              //add XP
                $lvl->add_xp('26',$kuid,$user_uuid);
                $lvl->add_xp('16',$kuid.",".$user_uuid,$com_uuid);

              $erg = "switch";

            }else{
              //nur neg vote hinzufügen
              $up = "UPDATE kommentar_db SET neg_vote = (neg_vote + 1) WHERE kuid = '$kuid'";
              $up = db::$link->query($up);

              //add XP
                $lvl->add_xp('26',$kuid,$user_uuid);
                $lvl->add_xp('16',$kuid.",".$user_uuid,$com_uuid);

              $erg = "addneg";

            }


            $vid_token = $f->settoken('com_like','');

            echo $vid_token.",".$erg;

          }else{
            echo "error";
          }

        }elseif($vote_row['status'] == "public"){ //wenn video gedisliket ist -> entfernen

          $up = "UPDATE kommentar_vote_db SET status = 'deleted' WHERE kuid = '$kuid' AND uuid = '$user_uuid' AND vote = 'neg'";
          $up = db::$link->query($up);

          if($up == true){

            //nur pos vote enterfernen
            $up = "UPDATE kommentar_db SET neg_vote = (neg_vote - 1) WHERE kuid = '$kuid'";
            $up = db::$link->query($up);

            //remove XP
              $lvl->remove_xp('26',$kuid,$user_uuid);
              $lvl->remove_xp('16',$kuid.",".$user_uuid,$com_uuid);


            $erg = "remneg";


            $vid_token = $f->settoken('com_like','');

            echo $vid_token.",".$erg;

          }else{
            echo "error";
          }

        }

    }


  }else{ //token not ok
    echo "tok_error";
  }

}else{ //kommentar not exist
  echo "error";
}


}else{ //not all parameters
  echo "error";
}

}else{ //not logged in
  echo "error";
}


?>
