<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

if($isUserLoggedIn === 1) {
if(isset($_POST['vuid']) AND isset($_POST['vote']) AND isset($_POST['tok']) AND ($_POST['vote'] == "pos" OR $_POST['vote'] == "neg")){

  $vuid         = $_POST['vuid'];
  $vote         = $_POST['vote'];
  $token        = $_POST['tok'];

  $vote_token = $f->checktoken($token,'vid_like');

  $time = strtotime(date('Y-m-d H:i:s'));


$vid_sql = db::$link->query("SELECT vuid,uuid FROM video_db WHERE vuid = '$vuid' AND status = 'uploaded'");
$vid_row = $vid_sql->fetch_assoc();

if($vid_row['vuid'] != "" AND $vote_token == "ok"){ //ob video existiert UND token ok

  $video_uuid = $vid_row['uuid'];

  if($vote == "pos"){

    $vote_sql = db::$link->query("SELECT status FROM video_vote_db WHERE vuid = '$vuid' AND uuid = '$user_uuid' AND vote = 'pos'");
    $vote_row = $vote_sql->fetch_assoc();

      if($vote_row['status'] == ""){ //wenn video niemals geliket wurde

          //zu vote hinzufügen
          $eintrag = "INSERT INTO video_vote_db
            (uuid,vuid,vote,status,time)
            VALUES
            ('$user_uuid','$vuid','pos','public','$time')";
          $eintrag = db::$link->query($eintrag);

          if($eintrag == true){

            //ob eine neg bewertung gegebung wurde
            $vote2_sql = db::$link->query("SELECT status FROM video_vote_db WHERE vuid = '$vuid' AND uuid = '$user_uuid' AND vote = 'neg'");
            $vote2_row = $vote2_sql->fetch_assoc();

            if($vote2_row['status'] == 'public'){
              //neg vote wieder entfernen & pos vote hinzufügen
              $up = "UPDATE video_vote_db SET status = 'deleted' WHERE vuid = '$vuid' AND uuid = '$user_uuid' AND vote = 'neg'";
              $up = db::$link->query($up);

              $up = "UPDATE video_db SET neg_vote = (neg_vote - 1) WHERE vuid = '$vuid'";
              $up = db::$link->query($up);

              $up = "UPDATE video_db SET pos_vote = (pos_vote + 1) WHERE vuid = '$vuid'";
              $up = db::$link->query($up);

              //add notification
              $data_sql = db::$link->query("SELECT vote_id FROM video_vote_db WHERE vuid = '$vuid' AND uuid = '$user_uuid' AND vote = 'pos' AND status = 'public'");
              $data_row = $data_sql->fetch_assoc();
                $mes->add_not('7',$data_row['vote_id'],$video_uuid);
                $mes->add_mes('7',$vuid,$user_uuid,0,$video_uuid);

              //remove XP
                $lvl->remove_xp('02',$vuid,$user_uuid);
                $lvl->remove_xp('04',$vuid.",".$user_uuid,$video_uuid);

              //add XP
                $lvl->add_xp('01',$vuid,$user_uuid);
                $lvl->add_xp('03',$vuid.",".$user_uuid,$video_uuid);

              //add Ach für video_user
              $pos_c_sql = db::$link->query("SELECT pos_vote FROM video_db WHERE vuid = '$vuid'");
              $pos_c_row = $pos_c_sql->fetch_assoc();
                if($pos_c_row['pos_vote'] == 10)  {$ach->add_ach('120',$vuid,$video_uuid);}
                if($pos_c_row['pos_vote'] == 100) {$ach->add_ach('121',$vuid,$video_uuid);}
                if($pos_c_row['pos_vote'] == 1000){$ach->add_ach('122',$vuid,$video_uuid);}

              //add Ach für vote_user
              $pos_u_sql = db::$link->query("SELECT count(vote_id) FROM video_vote_db WHERE uuid = '$user_uuid' AND vote = 'pos' AND status = 'public'");
              $pos_u_row = $pos_u_sql->fetch_row();
                if($pos_u_row[0] == 5)  {$ach->add_ach('140','',$user_uuid);}
                if($pos_u_row[0] == 50) {$ach->add_ach('141','',$user_uuid);}
                if($pos_u_row[0] == 500){$ach->add_ach('142','',$user_uuid);}

              $friend_sql = db::$link->query("SELECT friend_id FROM friend_db WHERE first_uuid = '$video_uuid' AND second_uuid = '$user_uuid' AND status = 'confirmed' ");
              $friend_row = $friend_sql->fetch_assoc();
                if($friend_row['friend_id'] != ""){ $ach->add_ach('207','',$user_uuid); }


              $erg = "switch";




            }else{
              //nur pos vote hinzufügen
              $up = "UPDATE video_db SET pos_vote = (pos_vote + 1) WHERE vuid = '$vuid'";
              $up = db::$link->query($up);

              //add notification
              $data_sql = db::$link->query("SELECT vote_id FROM video_vote_db WHERE vuid = '$vuid' AND uuid = '$user_uuid' AND vote = 'pos' AND status = 'public'");
              $data_row = $data_sql->fetch_assoc();
                $mes->add_not('7',$data_row['vote_id'],$video_uuid);
                $mes->add_mes('7',$vuid,$user_uuid,0,$video_uuid);

              //add XP
                $lvl->add_xp('01',$vuid,$user_uuid);
                $lvl->add_xp('03',$vuid.",".$user_uuid,$video_uuid);

              //add Ach für video_user
              $pos_c_sql = db::$link->query("SELECT pos_vote FROM video_db WHERE vuid = '$vuid'");
              $pos_c_row = $pos_c_sql->fetch_assoc();
                if($pos_c_row['pos_vote'] == 10)  {$ach->add_ach('120',$vuid,$video_uuid);}
                if($pos_c_row['pos_vote'] == 100) {$ach->add_ach('121',$vuid,$video_uuid);}
                if($pos_c_row['pos_vote'] == 1000){$ach->add_ach('122',$vuid,$video_uuid);}

              //add Ach für vote_user
              $pos_u_sql = db::$link->query("SELECT count(vote_id) FROM video_vote_db WHERE uuid = '$user_uuid' AND vote = 'pos' AND status = 'public'");
              $pos_u_row = $pos_u_sql->fetch_row();
                if($pos_u_row[0] == 5)  {$ach->add_ach('140','',$user_uuid);}
                if($pos_u_row[0] == 50) {$ach->add_ach('141','',$user_uuid);}
                if($pos_u_row[0] == 500){$ach->add_ach('142','',$user_uuid);}

              $friend_sql = db::$link->query("SELECT friend_id FROM friend_db WHERE first_uuid = '$video_uuid' AND second_uuid = '$user_uuid' AND status = 'confirmed' ");
              $friend_row = $friend_sql->fetch_assoc();
                if($friend_row['friend_id'] != ""){ $ach->add_ach('207','',$user_uuid); }

              $erg = "addpos";

            }

            $vote_sql = db::$link->query("SELECT pos_vote,neg_vote FROM video_db WHERE vuid = '$vuid'");
            $vote_row = $vote_sql->fetch_assoc();
              $pos_vote = $vote_row['pos_vote']; $neg_vote = $vote_row['neg_vote'];
              if($pos_vote + $neg_vote == 0){$prozent = 0;}else{
                $res_votes = ($pos_vote) / ($pos_vote + $neg_vote) * 100;
                $prozent = round($res_votes);
              }

            $vid_token = $f->settoken('vid_like','');

            echo $vid_token.",".$erg.",".$prozent;

          }else{
            echo "error";
          }

      }elseif($vote_row['status'] == "deleted"){ //wenn video geliket war aber wieder entfernt wurde

        $up = "UPDATE video_vote_db SET status = 'public' WHERE vuid = '$vuid' AND uuid = '$user_uuid' AND vote = 'pos'";
        $up = db::$link->query($up);

        if($up == true){

          //ob eine neg bewertung gegebung wurde
          $vote2_sql = db::$link->query("SELECT status FROM video_vote_db WHERE vuid = '$vuid' AND uuid = '$user_uuid' AND vote = 'neg'");
          $vote2_row = $vote2_sql->fetch_assoc();

          if($vote2_row['status'] == 'public'){
            //neg vote wieder entfernen & pos vote hinzufügen
            $up = "UPDATE video_vote_db SET status = 'deleted' WHERE vuid = '$vuid' AND uuid = '$user_uuid' AND vote = 'neg'";
            $up = db::$link->query($up);

            $up = "UPDATE video_db SET neg_vote = (neg_vote - 1) WHERE vuid = '$vuid'";
            $up = db::$link->query($up);

            $up = "UPDATE video_db SET pos_vote = (pos_vote + 1) WHERE vuid = '$vuid'";
            $up = db::$link->query($up);

            //add notification
            $data_sql = db::$link->query("SELECT vote_id FROM video_vote_db WHERE vuid = '$vuid' AND uuid = '$user_uuid' AND vote = 'pos' AND status = 'public'");
            $data_row = $data_sql->fetch_assoc();
              //$mes->add_not('7',$data_row['vote_id'],$video_uuid);
              $mes->add_mes('7',$vuid,$user_uuid,1,$video_uuid);

            //remove XP
              $lvl->remove_xp('02',$vuid,$user_uuid);
              $lvl->remove_xp('04',$vuid.",".$user_uuid,$video_uuid);

            //add XP
              $lvl->add_xp('01',$vuid,$user_uuid);
              $lvl->add_xp('03',$vuid.",".$user_uuid,$video_uuid);

            //add Ach für video_user
            $pos_c_sql = db::$link->query("SELECT pos_vote FROM video_db WHERE vuid = '$vuid'");
            $pos_c_row = $pos_c_sql->fetch_assoc();
              if($pos_c_row['pos_vote'] == 10)  {$ach->add_ach('120',$vuid,$video_uuid);}
              if($pos_c_row['pos_vote'] == 100) {$ach->add_ach('121',$vuid,$video_uuid);}
              if($pos_c_row['pos_vote'] == 1000){$ach->add_ach('122',$vuid,$video_uuid);}

            //add Ach für vote_user
            $pos_u_sql = db::$link->query("SELECT count(vote_id) FROM video_vote_db WHERE uuid = '$user_uuid' AND vote = 'pos' AND status = 'public'");
            $pos_u_row = $pos_u_sql->fetch_row();
              if($pos_u_row[0] == 5)  {$ach->add_ach('140','',$user_uuid);}
              if($pos_u_row[0] == 50) {$ach->add_ach('141','',$user_uuid);}
              if($pos_u_row[0] == 500){$ach->add_ach('142','',$user_uuid);}

            $friend_sql = db::$link->query("SELECT friend_id FROM friend_db WHERE first_uuid = '$video_uuid' AND second_uuid = '$user_uuid' AND status = 'confirmed' ");
            $friend_row = $friend_sql->fetch_assoc();
              if($friend_row['friend_id'] != ""){ $ach->add_ach('207','',$user_uuid); }

            $erg = "switch";

          }else{
            //nur pos vote hinzufügen
            $up = "UPDATE video_db SET pos_vote = (pos_vote + 1) WHERE vuid = '$vuid'";
            $up = db::$link->query($up);

            //add notification
            $data_sql = db::$link->query("SELECT vote_id FROM video_vote_db WHERE vuid = '$vuid' AND uuid = '$user_uuid' AND vote = 'pos' AND status = 'public'");
            $data_row = $data_sql->fetch_assoc();
              //$mes->add_not('7',$data_row['vote_id'],$video_uuid);
              $mes->add_mes('7',$vuid,$user_uuid,1,$video_uuid);

            //add XP
              $lvl->add_xp('01',$vuid,$user_uuid);
              $lvl->add_xp('03',$vuid.",".$user_uuid,$video_uuid);

            //add Ach
            $pos_c_sql = db::$link->query("SELECT pos_vote FROM video_db WHERE vuid = '$vuid'");
            $pos_c_row = $pos_c_sql->fetch_assoc();
              if($pos_c_row['pos_vote'] == 10)  {$ach->add_ach('120',$vuid,$video_uuid);}
              if($pos_c_row['pos_vote'] == 100) {$ach->add_ach('121',$vuid,$video_uuid);}
              if($pos_c_row['pos_vote'] == 1000){$ach->add_ach('122',$vuid,$video_uuid);}

            $friend_sql = db::$link->query("SELECT friend_id FROM friend_db WHERE first_uuid = '$video_uuid' AND second_uuid = '$user_uuid' AND status = 'confirmed' ");
            $friend_row = $friend_sql->fetch_assoc();
              if($friend_row['friend_id'] != ""){ $ach->add_ach('207','',$user_uuid); }

            $erg = "addpos";

          }

          $vote_sql = db::$link->query("SELECT pos_vote,neg_vote FROM video_db WHERE vuid = '$vuid'");
          $vote_row = $vote_sql->fetch_assoc();
            $pos_vote = $vote_row['pos_vote']; $neg_vote = $vote_row['neg_vote'];
            if($pos_vote + $neg_vote == 0){$prozent = 0;}else{
              $res_votes = ($pos_vote) / ($pos_vote + $neg_vote) * 100;
              $prozent = round($res_votes);
            }

          $vid_token = $f->settoken('vid_like','');

          echo $vid_token.",".$erg.",".$prozent;

        }else{
          echo "error";
        }

      }elseif($vote_row['status'] == "public"){ //wenn video geliket ist -> entfernen

        $up = "UPDATE video_vote_db SET status = 'deleted' WHERE vuid = '$vuid' AND uuid = '$user_uuid' AND vote = 'pos'";
        $up = db::$link->query($up);

        if($up == true){

          //nur pos vote enterfernen
          $up = "UPDATE video_db SET pos_vote = (pos_vote - 1) WHERE vuid = '$vuid'";
          $up = db::$link->query($up);

          //remove notification
            $data_sql = db::$link->query("SELECT vote_id FROM video_vote_db WHERE vuid = '$vuid' AND uuid = '$user_uuid' AND vote = 'pos' AND status = 'deleted'");
            $data_row = $data_sql->fetch_assoc();
              $mes->remove_not('7',$data_row['vote_id'],$video_uuid);
              $mes->remove_mes('7',$vuid,$video_uuid);


          //remove XP
            $lvl->remove_xp('01',$vuid,$user_uuid);
            $lvl->remove_xp('03',$vuid.",".$user_uuid,$video_uuid);


          $erg = "rempos";


          $vote_sql = db::$link->query("SELECT pos_vote,neg_vote FROM video_db WHERE vuid = '$vuid'");
          $vote_row = $vote_sql->fetch_assoc();
            $pos_vote = $vote_row['pos_vote']; $neg_vote = $vote_row['neg_vote'];
            if($pos_vote + $neg_vote == 0){$prozent = 0;}else{
              $res_votes = ($pos_vote) / ($pos_vote + $neg_vote) * 100;
              $prozent = round($res_votes);
            }

          $vid_token = $f->settoken('vid_like','');

          echo $vid_token.",".$erg.",".$prozent;

        }else{
          echo "error";
        }

      }


    }elseif($vote == "neg"){

      $vote_sql = db::$link->query("SELECT status FROM video_vote_db WHERE vuid = '$vuid' AND uuid = '$user_uuid' AND vote = 'neg'");
      $vote_row = $vote_sql->fetch_assoc();

        if($vote_row['status'] == ""){ //wenn video niemals gedisliket wurde

            //zu vote hinzufügen
            $eintrag = "INSERT INTO video_vote_db
              (uuid,vuid,vote,status,time)
              VALUES
              ('$user_uuid','$vuid','neg','public','$time')";
            $eintrag = db::$link->query($eintrag);

            if($eintrag == true){

              //ob eine pos bewertung gegebung wurde
              $vote2_sql = db::$link->query("SELECT status FROM video_vote_db WHERE vuid = '$vuid' AND uuid = '$user_uuid' AND vote = 'pos'");
              $vote2_row = $vote2_sql->fetch_assoc();

              if($vote2_row['status'] == 'public'){
                //pos vote wieder entfernen & neg vote hinzufügen
                $up = "UPDATE video_vote_db SET status = 'deleted' WHERE vuid = '$vuid' AND uuid = '$user_uuid' AND vote = 'pos'";
                $up = db::$link->query($up);

                $up = "UPDATE video_db SET pos_vote = (pos_vote - 1) WHERE vuid = '$vuid'";
                $up = db::$link->query($up);

                $up = "UPDATE video_db SET neg_vote = (neg_vote + 1) WHERE vuid = '$vuid'";
                $up = db::$link->query($up);

                //remove notification
                  $data_sql = db::$link->query("SELECT vote_id FROM video_vote_db WHERE vuid = '$vuid' AND uuid = '$user_uuid' AND vote = 'pos' AND status = 'deleted'");
                  $data_row = $data_sql->fetch_assoc();
                    $mes->remove_not('7',$data_row['vote_id'],$video_uuid);
                    $mes->remove_mes('7',$vuid,$video_uuid);

                //remove XP
                  $lvl->remove_xp('01',$vuid,$user_uuid);
                  $lvl->remove_xp('03',$vuid.",".$user_uuid,$video_uuid);

                //add XP
                  $lvl->add_xp('02',$vuid,$user_uuid);
                  $lvl->add_xp('04',$vuid.",".$user_uuid,$video_uuid);


                $erg = "switch";

              }else{
                //nur neg vote hinzufügen
                $up = "UPDATE video_db SET neg_vote = (neg_vote + 1) WHERE vuid = '$vuid'";
                $up = db::$link->query($up);

                //add XP
                  $lvl->add_xp('02',$vuid,$user_uuid);
                  $lvl->add_xp('04',$vuid.",".$user_uuid,$video_uuid);

                $erg = "addneg";

              }

              $vote_sql = db::$link->query("SELECT pos_vote,neg_vote FROM video_db WHERE vuid = '$vuid'");
              $vote_row = $vote_sql->fetch_assoc();
                $pos_vote = $vote_row['pos_vote']; $neg_vote = $vote_row['neg_vote'];
                if($pos_vote + $neg_vote == 0){$prozent = 0;}else{
                  $res_votes = ($pos_vote) / ($pos_vote + $neg_vote) * 100;
                  $prozent = round($res_votes);
                }

              $vid_token = $f->settoken('vid_like','');

              echo $vid_token.",".$erg.",".$prozent;

            }else{
              echo "error";
            }

        }elseif($vote_row['status'] == "deleted"){ //wenn video gedisliket war aber wieder entfernt wurde

          $up = "UPDATE video_vote_db SET status = 'public' WHERE vuid = '$vuid' AND uuid = '$user_uuid' AND vote = 'neg'";
          $up = db::$link->query($up);

          if($up == true){

            //ob eine neg bewertung gegebung wurde
            $vote_sql = db::$link->query("SELECT status FROM video_vote_db WHERE vuid = '$vuid' AND uuid = '$user_uuid' AND vote = 'pos'");
            $vote_row = $vote_sql->fetch_assoc();

            if($vote_row['status'] == 'public'){
              //pos vote wieder entfernen & neg vote hinzufügen
              $up = "UPDATE video_vote_db SET status = 'deleted' WHERE vuid = '$vuid' AND uuid = '$user_uuid' AND vote = 'pos'";
              $up = db::$link->query($up);

              $up = "UPDATE video_db SET pos_vote = (pos_vote - 1) WHERE vuid = '$vuid'";
              $up = db::$link->query($up);

              $up = "UPDATE video_db SET neg_vote = (neg_vote + 1) WHERE vuid = '$vuid'";
              $up = db::$link->query($up);

              //remove notification
                $data_sql = db::$link->query("SELECT vote_id FROM video_vote_db WHERE vuid = '$vuid' AND uuid = '$user_uuid' AND vote = 'pos' AND status = 'deleted'");
                $data_row = $data_sql->fetch_assoc();
                  $mes->remove_not('7',$data_row['vote_id'],$video_uuid);
                  $mes->remove_mes('7',$vuid,$video_uuid);

              //remove XP
                $lvl->remove_xp('01',$vuid,$user_uuid);
                $lvl->remove_xp('03',$vuid.",".$user_uuid,$video_uuid);

              //add XP
                $lvl->add_xp('02',$vuid,$user_uuid);
                $lvl->add_xp('04',$vuid.",".$user_uuid,$video_uuid);

              $erg = "switch";

            }else{
              //nur neg vote hinzufügen
              $up = "UPDATE video_db SET neg_vote = (neg_vote + 1) WHERE vuid = '$vuid'";
              $up = db::$link->query($up);

              //add XP
                $lvl->add_xp('02',$vuid,$user_uuid);
                $lvl->add_xp('04',$vuid.",".$user_uuid,$video_uuid);

              $erg = "addneg";

            }

            $vote_sql = db::$link->query("SELECT pos_vote,neg_vote FROM video_db WHERE vuid = '$vuid'");
            $vote_row = $vote_sql->fetch_assoc();
              $pos_vote = $vote_row['pos_vote']; $neg_vote = $vote_row['neg_vote'];
              if($pos_vote + $neg_vote == 0){$prozent = 0;}else{
                $res_votes = ($pos_vote) / ($pos_vote + $neg_vote) * 100;
                $prozent = round($res_votes);
              }

            $vid_token = $f->settoken('vid_like','');

            echo $vid_token.",".$erg.",".$prozent;

          }else{
            echo "error";
          }

        }elseif($vote_row['status'] == "public"){ //wenn video gedisliket ist -> entfernen

          $up = "UPDATE video_vote_db SET status = 'deleted' WHERE vuid = '$vuid' AND uuid = '$user_uuid' AND vote = 'neg'";
          $up = db::$link->query($up);

          if($up == true){

            //nur pos vote enterfernen
            $up = "UPDATE video_db SET neg_vote = (neg_vote - 1) WHERE vuid = '$vuid'";
            $up = db::$link->query($up);

            //remove XP
              $lvl->remove_xp('02',$vuid,$user_uuid);
              $lvl->remove_xp('04',$vuid.",".$user_uuid,$video_uuid);


            $erg = "remneg";


            $vote_sql = db::$link->query("SELECT pos_vote,neg_vote FROM video_db WHERE vuid = '$vuid'");
            $vote_row = $vote_sql->fetch_assoc();
              $pos_vote = $vote_row['pos_vote']; $neg_vote = $vote_row['neg_vote'];
              if($pos_vote + $neg_vote == 0){$prozent = 0;}else{
                $res_votes = ($pos_vote) / ($pos_vote + $neg_vote) * 100;
                $prozent = round($res_votes);
              }

            $vid_token = $f->settoken('vid_like','');

            echo $vid_token.",".$erg.",".$prozent;

          }else{
            echo "error";
          }

        }

    }


  }else{ //video not exist UND token ok
    echo "error";
  }


}else{ //not all parameters
  echo "error";
}

}else{ //not logged in
  echo "error";
}


?>
