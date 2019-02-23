<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = "../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include


//3. site vals
if(isset($_POST['friend_uuid']) && $_POST['friend_uuid'] != "" && isset($_POST['action']) && $_POST['action'] != ""){
  $friend_uuid  = $_POST['friend_uuid']; $friend_uuid = mysqli_real_escape_string(db::$link,$friend_uuid);
  $action       = filter_var($_POST['action'], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
}else{
  header('HTTP/1.1 500 Invalid parameter');exit();
}

  // anfrage -> action 1
  // accept -> action 2
  // entfernen / ablehnen / zurückziehen -> action 3
  // blockieren -> action 4
  // block entfernen -> action 5


//checks
  //user check
  $friend_uuif = sha1(sha1($friend_uuid));
  $friend_uuid_check = $u->userin('uuid',0,$friend_uuif,'');

  if($isUserLoggedIn === 1 && $friend_uuid_check == $friend_uuid && is_numeric($action) && $friend_uuid != $user_uuid ){

    $time         = strtotime(date('Y-m-d H:i:s'));
    $friends_c    = $u->userin('friends',0,'this','');
    $friends_max  = $u->userin('max_friends',0,'this','');
    $friend_friends_c    = $u->userin('friends',0,$friend_uuif,'');
    $friend_friends_max  = $u->userin('max_friends',0,$friend_uuif,'');
    $user_uuif    = sha1(sha1($user_uuid));

    $return = "";

    //allowed tests
    if($action == 1){
      if($f->isbloked($user_uuid,$friend_uuid,2) == false AND $f->isbloked($friend_uuid,$user_uuid,2) == false){
        if($friends_c < $friends_max){
          $friend_sql = db::$link->query("SELECT status FROM friend_db WHERE first_uuid = '$user_uuid' AND second_uuid = '$friend_uuid'"); $friend_row = $friend_sql->fetch_assoc();
          $friend_sql2 = db::$link->query("SELECT status FROM friend_db WHERE first_uuid = '$friend_uuid' AND second_uuid = '$user_uuid'"); $friend_row2 = $friend_sql2->fetch_assoc();
          if($friend_row['status'] == "" AND $friend_row2['status'] == ""){
              $set_friend = "INSERT INTO friend_db
                (first_uuid,second_uuid,status,time) VALUES
                ('$user_uuid','$friend_uuid','sent','$time')";
              $set_friend = db::$link->query($set_friend);

              if($set_friend == true){ $return = 1; } else { $return = 20; }

          }elseif($friend_row2['status'] == "sent"){
            $set_friend = "INSERT INTO friend_db
              (first_uuid,second_uuid,status,time) VALUES
              ('$user_uuid','$friend_uuid','confirmed','$time')";
            $set_friend = db::$link->query($set_friend);

            $up = "UPDATE friend_db SET status = 'confirmed' WHERE first_uuid = '$friend_uuid' AND second_uuid = '$user_uuid'";  $up = db::$link->query($up);
              if($set_friend == true){
                $friends_cc = $friends_c + 1;
                $friend_friends_cc = $friend_friends_c + 1;
                $u->userinset('friends',$friend_friends_cc,$friend_uuif);
                $u->userinset('friends',$friends_cc,$user_uuif);
                  $return = 2;
              }else { $return = 21; }

          }elseif($friend_row['status'] == "deleted"){
            $del_up = "DELETE from friend_db WHERE first_uuid = '$friend_uuid' AND second_uuid = '$user_uuid'";             $del_up = db::$link->query($del_up);
            $up = "UPDATE friend_db SET status = 'sent' WHERE first_uuid = '$user_uuid' AND second_uuid = '$friend_uuid'";  $up = db::$link->query($up);
              if($up == true && $del_up == true){ $return = 1; } else { $return = 22; }

          }
        }else{
          $return = 6;
        }
      }else{
        $return = 10;
      }

    }elseif($action == 2){
      if($f->isbloked($user_uuid,$friend_uuid,2) == false AND $f->isbloked($friend_uuid,$user_uuid,2) == false){
        if($friends_c < $friends_max && $friend_friends_c < $friend_friends_max){
          $friend_sql = db::$link->query("SELECT status FROM friend_db WHERE first_uuid = '$friend_uuid' AND second_uuid = '$user_uuid'"); $friend_row = $friend_sql->fetch_assoc();
          if($friend_row['status'] == "sent"){
              $set_friend = "INSERT INTO friend_db
                (first_uuid,second_uuid,status,time) VALUES
                ('$user_uuid','$friend_uuid','confirmed','$time')";
              $set_friend = db::$link->query($set_friend);

              $up = "UPDATE friend_db SET status = 'confirmed' WHERE first_uuid = '$friend_uuid' AND second_uuid = '$user_uuid'";  $up = db::$link->query($up);
                if($set_friend == true){
                  $friends_cc = $friends_c + 1;
                  $friend_friends_cc = $friend_friends_c + 1;
                  $u->userinset('friends',$friend_friends_cc,$friend_uuif);
                  $u->userinset('friends',$friends_cc,$user_uuif);
                    $return = 2;
                }else { $return = 23; }
          }
        }else{
          if($friends_c >= $friends_max){ $return = 6; }
          if($friend_friends_c >= $friend_friends_max){ $return = 7; }
        }
      }else{
        $return = 10;
      }

    }elseif($action == 3){
      if($f->isbloked($user_uuid,$friend_uuid,2) == false AND $f->isbloked($friend_uuid,$user_uuid,2) == false){
        $friend_sql  = db::$link->query("SELECT status FROM friend_db WHERE first_uuid = '$friend_uuid' AND second_uuid = '$user_uuid'");$friend_row  = $friend_sql->fetch_assoc();
        $friend_sql2 = db::$link->query("SELECT status FROM friend_db WHERE first_uuid = '$user_uuid' AND second_uuid = '$friend_uuid'");$friend_row2 = $friend_sql2->fetch_assoc();
          if($friend_row['status'] == "sent"){  //ablehnen
              $up  = "DELETE from friend_db WHERE  first_uuid = '$friend_uuid' AND second_uuid = '$user_uuid' AND status = 'sent'";   $up = db::$link->query($up);
                if($up == true){
                  $return = 3;
                }else { $return = 24; }

          }elseif($friend_row2['status'] == "sent"){ //zurückziehen
              $up  = "DELETE from friend_db WHERE first_uuid = '$user_uuid' AND second_uuid = '$friend_uuid' AND status = 'sent'";   $up = db::$link->query($up);
                if($up == true){
                  $return = 4;
                }else { $return = 25; }

          }elseif($friend_row['status'] == "confirmed" || $friend_row2['status'] == "confirmed"){ //entfernen
              $up  = "UPDATE friend_db SET status = 'deleted' WHERE first_uuid = '$friend_uuid' AND second_uuid = '$user_uuid'";   $up = db::$link->query($up);
              $up2 = "UPDATE friend_db SET status = 'deleted' WHERE first_uuid = '$user_uuid' AND second_uuid = '$friend_uuid'";  $up2 = db::$link->query($up2);
                if($up == true && $up2 == true){
                  $friends_cc = $friends_c - 1;
                  $friend_friends_cc = $friend_friends_c - 1;
                  $u->userinset('friends',$friend_friends_cc,$friend_uuif);
                  $u->userinset('friends',$friends_cc,$user_uuif);
                    $return = 5;
                }else { $return = 26; }
          }
      }else{
        $return = 10;
      }

    }elseif($action == 4){

      //$action4_allowed -> blockieren
        //type 1 = fullblock ( kommentare/Freundschaftsanfragen )
        $block_f_sql = db::$link->query("SELECT friend_id FROM friend_db WHERE first_uuid = '$friend_uuid' AND second_uuid = '$user_uuid' AND status = 'confirmed'");
        $block_f_row = $block_f_sql->fetch_assoc();

        if($block_f_row['friend_id'] != ""){
          $friends_cc = $friends_c - 1;
          $friend_friends_cc = $friend_friends_c - 1;
          $u->userinset('friends',$friend_friends_cc,$friend_uuif);
          $u->userinset('friends',$friends_cc,$user_uuif);
        }

        $up_all  = "DELETE from friend_db WHERE first_uuid = '$friend_uuid' AND second_uuid = '$user_uuid'";   $up_all = db::$link->query($up_all);
        $up2_all = "DELETE from friend_db WHERE first_uuid = '$user_uuid' AND second_uuid = '$friend_uuid'";  $up2_all = db::$link->query($up2_all);

        $set_block = "INSERT INTO block_db
              (first_uuid,second_uuid,type,time) VALUES
              ('$user_uuid','$friend_uuid','1','$time')";
        $set_block = db::$link->query($set_block);

          if($set_block == true){
            $return = 8;
          }

    }else{

      //$action5_allowed -> entblocken
      $up  = "DELETE from block_db WHERE first_uuid = '$user_uuid' AND second_uuid = '$friend_uuid'";   $up = db::$link->query($up);
        if($set_block == true){
          $return = 9;
        }
    }


    //return
      //1 -> anfrage gesendet
      //2 -> anfrage angenommen

      //3 -> anfrage ablehnen
      //4 -> anfrage zurückziehen
      //5 -> freund entfernen

      //6 -> maximale freunde
      //7 -> maximale freunde vom freund

      //8 -> blockiert
      //9 -> entblockt

      //10 -> aktion nicht möglich da einer der nutzer den anderen blockiert hat


      //add notification
      if($return == 1){
        $mes->add_not('10',$user_uuid,$friend_uuid);

      }elseif($return > 1 AND $return < 10){
        $mes->remove_not('10',$user_uuid,$friend_uuid);
      }

      //add Errungenschaften
      if($return == 2){
        $ach->add_ach('201','',$user_uuid);
        $ach->add_ach('201','',$friend_uuid);
      }

      //für jquery
      echo $return;


  }else{//if user exist & user logged in
    header('HTTP/1.1 500 Invalid parameter');exit();
  }

?>
