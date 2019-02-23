<?php
//1. Pfad zum Stammverzeichniss wo sich die index befindet
$_hp = '../'; //für includes
$_dhp = ''; // für daten
$upload_in = true;
$isUserLoggedIn = 1;
$usercode_up = $_POST['usercode'];  //like the cookie value

//2. all include
$in_save_code_all_include = "&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z";
require_once ($_hp.'include/all_include.php'); //haupt include


//3. site vals
$user_uuid = $u->userin('uuid',0,'',$usercode_up);
$user_name = $u->userin('name',0,'',$usercode_up);

$time      = strtotime(date('Y-m-d H:i:s'));

if(isset($_POST['usercode']) AND isset($_POST['token']) AND isset($_POST['new_mes']) AND isset($_POST['xp']) AND isset($user_uuid) AND $user_uuid != ""){

  $token     = mysqli_real_escape_string(db::$link,$_POST['token']);
  $is_mobile = $_POST['is_mobile'];

  $token_sql = db::$link->query("SELECT not_temp_id FROM notification_temp WHERE token = '$token'");
  $token_row = $token_sql->fetch_assoc();

if($token_row['not_temp_id'] != ""){


  $i = 0;
  $not = 0;

  while($i < 60){ //60 x 5 = 300 ~ 5min
    $token_sql = db::$link->query("SELECT not_temp_id FROM notification_temp WHERE token = '$token'");
    $token_row = $token_sql->fetch_assoc();

    if($token_row['not_temp_id'] != ""){

    //notification type
    //1 = achievement
    //2 = neuer Level
    //3 = big level update

    //neu
    //4 = neue(r) /kommentar/antwort
    //5 = hat dein Kommentar geliket
    //6 = hat dich abonniert
    //7 = hat dein video geliket

    //8 = neue pn

    //10 = hat dich als freund eingeladen
    //11 = freund xy kommt online


    //notification date by notification type =
    //1 = achievement
    //2 = level
    //3 = level

    //neu
    //4 = kuid
    //5 = comvote_id
    //6 = uuid von dem der aboniert hat
    //7 = vidvote_id

  $time_20min = $time - 1200;
  $time_6min  = $time - 360;


  //set online status

    //set online status
    $up = "UPDATE user_find_db SET online_status = 'online' WHERE uuid = '$user_uuid'"; $up = db::$link->query($up);

    //set onlie notification to all online friends
    $lot_sql = db::$link->query("SELECT last_online_time FROM user_find_db WHERE uuid = '$user_uuid'");
    $lot_row = $lot_sql->fetch_assoc();

    if($lot_row['last_online_time'] + 1800 <= $time){
      $online_friends_sql = db::$link->query("SELECT user_find_db.uuid FROM user_find_db INNER JOIN friend_db ON friend_db.second_uuid = user_find_db.uuid WHERE friend_db.first_uuid = '$user_uuid' AND friend_db.status = 'confirmed' AND user_find_db.online_status = 'online' ");
      while($row = $online_friends_sql->fetch_array()){
        $friend_uuid = $row['uuid'];
        $mes->add_not('11',$user_uuid,$friend_uuid);
      }
    }

    //update all offline status wo seid länger als 6 minuten einen online update gesetzt hat
      $up = "UPDATE user_find_db SET online_status = 'offline' WHERE last_online_time <= '$time_6min' AND online_status = 'online'";
      $up = db::$link->query($up);


    //add online time
    $up = "UPDATE user_find_db SET online_time = (online_time + 5) WHERE uuid = '$user_uuid' AND (last_online_time + 5) <= '$time'"; $up = db::$link->query($up);
    $up = "UPDATE user_find_db SET last_online_time = '$time' WHERE uuid = '$user_uuid' AND (last_online_time + 5) <= '$time'"; $up = db::$link->query($up);


  //notification check
  if($is_mobile == 'true'){
    $check_sql = db::$link->query("SELECT COUNT(notification_id) FROM notification_db WHERE uuid = '$user_uuid' AND viewed = '0' AND status = 'public' AND notification_type = '3'");
    $check_row = $check_sql->fetch_row();
  }else{
    $check_sql = db::$link->query("SELECT COUNT(notification_id) FROM notification_db WHERE uuid = '$user_uuid' AND viewed = '0' AND status = 'public' AND
      ( ( notification_type <= '3' ) OR ( notification_type >= '4' AND time > '$time_20min') )");
    $check_row = $check_sql->fetch_row();
  }
    //delete die älter als 20min sind
    $del_old = "DELETE FROM notification_db WHERE notification_type >= '4' AND time < '$time_20min'";
    $del_old = db::$link->query($del_old);


  //nex level xp check
  if(is_numeric($_POST['xp'])){
    $old_xp = $_POST['xp'];  $uuif = sha1(sha1($user_uuid));
    $new_xp = $u->userin('xp',0,$uuif,'');
  }else{ header('HTTP/1.1 500 Invalid xp!'); exit(); }


  //new mes count
  if(is_numeric($_POST['new_mes']) OR $_POST['new_mes'] == ""){
    if($_POST['new_mes'] != ""){$old_mes_c = $_POST['new_mes'];}else{ $old_mes_c = 0;}

      $sql_mes_bank = db::$link->query("SELECT COUNT(message_id) FROM message_db WHERE uuid = '$user_uuid' AND status = 'public' AND viewed = '0'");
      $get_mes_bank = $sql_mes_bank->fetch_row();
    $new_mes_c = $get_mes_bank[0];
  }else{ header('HTTP/1.1 500 Invalid new_mes!'); exit(); }


  //new fri req count
  if($_POST['new_fri'] == "*" OR $_POST['new_fri'] == ""){
    if($_POST['new_fri'] != ""){ $old_fri_c = $_POST['new_fri']; }else{ $old_fri_c = '';}

      $sql_fri_bank = db::$link->query("SELECT COUNT(notification_id) FROM notification_db WHERE notification_type = '10' AND uuid = '$user_uuid' AND status = 'public'");
      $get_fri_bank = $sql_fri_bank->fetch_row();
      if($is_mobile == true){
        $up = "UPDATE notification_db SET viewed = '1' WHERE notification_type = '10' AND uuid = '$user_uuid' AND status = 'public'";
        $up = db::$link->query($up);
      }
    $new_fri_c = $get_fri_bank[0];
      if($new_fri_c > 0){$new_fri_c = "*";
      }else{ $new_fri_c = ""; }
  }else{ header('HTTP/1.1 500 Invalid new_fri!'); exit(); }


  //new online fri count
  if(is_numeric($_POST['online_fri']) OR $_POST['online_fri'] == ""){
    if($_POST['online_fri'] != ""){$old_online_fri_c = $_POST['online_fri'];}else{ $old_online_fri_c = 0;}

      $sql_online_fri_bank = db::$link->query("SELECT COUNT(uuid) FROM user_find_db INNER JOIN friend_db on friend_db.first_uuid = user_find_db.uuid WHERE friend_db.second_uuid = '$user_uuid' AND friend_db.status = 'confirmed' AND user_find_db.online_status = 'online' AND user_find_db.status = 'public'");
      $get_online_fri_bank = $sql_online_fri_bank->fetch_row();

    $new_online_fri_c = $get_online_fri_bank[0];
  }else{ header('HTTP/1.1 500 Invalid new_fri!'); exit(); }




  // level update
    if($new_xp != $old_xp){

      if($new_xp >= $lvl->lvlinfo('txp','1000')){ $level = 1000; $levelup = 1000; $levelfortschrit = 0; }
      elseif($new_xp <= 0){$level = 0; $levelup = 1; $levelfortschrit = 0;
      }else{

        $level = $lvl->lvlinfo('level',$new_xp);

        $levelup = $level + 1;
        $xplevel_for_this_level = $lvl->lvlinfo('txp',$level);
        $xplevel_for_next_level = $lvl->lvlinfo('txp',$levelup);

        $xplevel_needed_for_next_level = $lvl->lvlinfo('xp',$levelup);
        $xplevel_over = $new_xp - $xplevel_for_this_level;

        //wie viel Prozent der ramne gefüllt sein soll
        $levelfortschrit = $xplevel_over / $xplevel_needed_for_next_level * 100;
      }

        $b_level = $lvl->lvlicon('b',$level); $n_level = $lvl->lvlicon('n',$level);
        $c_level = $lvl->lvlicon('c',$level); $f_level = $lvl->lvlicon('f',$level);

        //levelfortschrit
          if($levelfortschrit > 0)   { $c_top_left  = "1";  }else                          { $c_top_left  = "0"; }
          if($levelfortschrit >= 25) { $l_top       = "34"; }elseif($levelfortschrit < 25) { $l_top       = 34 * $levelfortschrit * 4 / 100; }
          if($levelfortschrit >= 25) { $c_top_right = "1";  }else                          { $c_top_right = "0"; }
          if($levelfortschrit >= 50) { $l_right     = "34"; }elseif($levelfortschrit < 50) { $l_right     = 34 * ($levelfortschrit - 25) * 4 / 100; }
          if($levelfortschrit >= 50) { $c_bot_right = "1";  }else                          { $c_bot_right = "0"; }
          if($levelfortschrit >= 75) { $l_bot       = "34"; }elseif($levelfortschrit < 75) { $l_bot       = 34 * ($levelfortschrit - 50) * 4 / 100; }
          if($levelfortschrit >= 75) { $c_bot_left  = "1";  }else                          { $c_bot_left  = "0"; }
          if($levelfortschrit >= 100){ $l_left      = "34"; }elseif($levelfortschrit < 100){ $l_left      = 34 * ($levelfortschrit - 75) * 4 / 100; }

          $new_level_icon = "<div class='level_border_back level_36_line_top b_level_".$b_level."'> <div class='level_border_front level_36_line_top_draw c_level_".$c_level."' style='width:".$l_top."px'></div> </div> <div class='level_border_back level_36_corner_top_left b_level_".$b_level."'> <div class='level_border_front level_36_corner_top_left_draw c_level_".$c_level."' style='width:".$c_top_left."px'></div> </div> <div class='level_border_back level_36_line_right b_level_".$b_level."' > <div class='level_border_front level_36_line_right_draw c_level_".$c_level."'  style='height:".$l_right."px'></div> </div> <div class='level_border_back level_36_corner_top_right b_level_".$b_level."'> <div class='level_border_front level_36_corner_top_right_draw c_level_".$c_level."'  style='width:".$c_top_right."px; height:".$c_top_right."px'></div> </div> <div class='level_border_back level_36_line_bottom b_level_".$b_level."'> <div class='level_border_front level_36_line_bottom_draw c_level_".$c_level."'  style='width:".$l_bot."px'></div> </div><div class='level_border_back level_36_corner_bottom_right b_level_".$b_level."'> <div class='level_border_front level_36_corner_bottom_right_draw c_level_".$c_level."'  style='width:".$c_bot_right."px; height:".$c_bot_right."px'></div> </div><div class='level_border_back level_36_line_left b_level_".$b_level."'> <div class='level_border_front level_36_line_left_draw c_level_".$c_level."'  style='height:".$l_left."px'></div> </div><div class='level_border_back level_36_corner_bottom_left b_level_".$b_level."'> <div class='level_border_front level_36_corner_bottom_left_draw c_level_".$c_level."' style='width:".$c_bot_left."px height:".$c_bot_left."px'></div> </div><div class='level_content n_36_level_".$n_level." c_level_".$c_level."'><div class='level_number f_level_".$f_level." this_level'>".$level."</div></div>";

        $i = 60;

        header('Content-type:application/json;charset=utf-8');
        echo json_encode('{ "new_level_icon": "'.$new_level_icon.'", "new_xp": "'.$new_xp.'" }');


    }elseif($new_mes_c != $old_mes_c){


      $i = 60;

      header('Content-type:application/json;charset=utf-8');
      echo json_encode('{ "new_mes_count": "'.$new_mes_c.'"}');

    }elseif($new_fri_c != $old_fri_c){


      $i = 60;

      header('Content-type:application/json;charset=utf-8');
      echo json_encode('{ "new_fri_count": "'.$new_fri_c.'"}');

    }elseif($new_online_fri_c != $old_online_fri_c){


      $i = 60;

      header('Content-type:application/json;charset=utf-8');
      echo json_encode('{ "new_online_fri_count": "'.$new_online_fri_c.'"}');

    }elseif($check_row[0] > 0){ //gibt es was neues zum anzeigen

        $i = 60;

        $not_sql = db::$link->query("SELECT notification_type FROM notification_db WHERE uuid = '$user_uuid' AND viewed = '0' AND status = 'public' ORDER BY time ASC, notification_id ASC LIMIT 0,1");
        $not01_row = $not_sql->fetch_assoc();

        $not_sql = db::$link->query("SELECT notification_type FROM notification_db WHERE uuid = '$user_uuid' AND viewed = '0' AND status = 'public' ORDER BY time ASC, notification_id ASC LIMIT 1,1");
        $not02_row = $not_sql->fetch_assoc();

        $not_sql = db::$link->query("SELECT notification_type FROM notification_db WHERE uuid = '$user_uuid' AND viewed = '0' AND status = 'public' ORDER BY time ASC, notification_id ASC LIMIT 2,1");
        $not03_row = $not_sql->fetch_assoc();

        if($not01_row['notification_type'] != '3' AND $not02_row['notification_type'] != '3' AND $not03_row['notification_type'] != '3'){

                if($check_row[0] > 0){ //1 nachricht / erste nachricht

                  $not_sql = db::$link->query("SELECT * FROM notification_db WHERE uuid = '$user_uuid' AND viewed = '0' AND status = 'public' AND
                    ( ( notification_type <= '3' ) OR ( notification_type >= '4' AND time > '$time_20min') )
                    ORDER BY time ASC, notification_id ASC LIMIT 0,1");
                  $not_row = $not_sql->fetch_assoc();

                  $not_id = $not_row['notification_id'];
                    $up = "UPDATE notification_db SET viewed = '1' WHERE notification_id = '$not_id' LIMIT 1";
                    $up = db::$link->query($up);

                    //freund xy is online wird nach anzeige dirkt gelöscht
                    $del = "DELETE FROM notification_db WHERE notification_id = '$not_id' AND notification_type = '11' LIMIT 1";
                    $del = db::$link->query($del);

                  $not_type = $not_row['notification_type'];
                  $not_data = $not_row['notification_data'];


                  if($not_type == 1){
                      $event_data = $not_data;

                      $user_level = $u->userin('level',0,'',$usercode_up);
                      $b_level = $lvl->lvlicon('b',$user_level);

                    $avatar = "<div class='popup_event_icon'><div class='l_res_ach_img c_level_".$b_level."'><div class='l_res_ach_img_text l_ach".$event_data."_symbol f_ach_1' ></div></div></div>";

                      //event_xp
                      $eventxp = "ach_".$event_data;
                      $eventxp = number_format($lvl->$eventxp,0, ",", ".");
                      $xpforevent = $eventxp.$l->level_xp_title;

                      //event_title
                      $eventtitel = "res_ach_title_".$event_data;
                      $eventtitel = $l->$eventtitel;

                      //event_step
                      if($event_data == 100 OR $event_data == 110 OR $event_data == 120 OR $event_data == 140 OR $event_data == 150 OR $event_data == 160 OR $event_data == 170 OR $event_data == 180){$event_step = " - ".$l->achstep1;}
                      elseif($event_data == 101 OR $event_data == 111 OR $event_data == 121 OR $event_data == 141 OR $event_data == 151 OR $event_data == 161 OR $event_data == 171 OR $event_data == 181){$event_step = " - ".$l->achstep2;}
                      elseif($event_data == 102 OR $event_data == 112 OR $event_data == 122 OR $event_data == 142 OR $event_data == 152 OR $event_data == 162 OR $event_data == 172 OR $event_data == 182){$event_step = " - ".$l->achstep3;}
                      else{$event_step = "";}

                      /* Link nur in der MeldungenList und nicht bei den notification
                      if($event_data > 130 AND $event_data <= 190){
                        if($event_data >= 140 AND $event_data <= 142){$link_add = "ach_140";}
                        elseif($event_data >= 150 AND $event_data <= 152){$link_add = "ach_150";}
                        elseif($event_data >= 160 AND $event_data <= 162){$link_add = "ach_160";}
                        elseif($event_data >= 170 AND $event_data <= 172){$link_add = "ach_170";}
                        elseif($event_data >= 180 AND $event_data <= 182){$link_add = "ach_180";}
                      }elseif($event_data > 190){
                        $link_add = "ach_".$event_data;
                      }else{
                        $link_add = "video_ach";
                      }*/

                    $title  = $l->ach_yea;
                    $text   = "<span class='blue'>+".$xpforevent."</span> ".$l->ach_for."<br> <span class='blue'>".$eventtitel." ".$event_step."</span>";


                  }elseif($not_type == 2){


                    $level = $not_data;

                    $c_level = $lvl->lvlicon('c',$level);
                    $n_level = $lvl->lvlicon('n',$level);
                    $f_level = $lvl->lvlicon('f',$level);

                    //ja es darf keine enter (\n) haben es muss am stück sein:
                    $avatar = "<div class='popup_event_icon'><div class='level_content_back channel_middle_level_symbol'><div class='level_border_back level_67_line_top c_level_".$c_level."'></div><div class='level_border_back level_67_corner_top_left c_level_".$c_level."'></div><div class='level_border_back level_67_line_right c_level_".$c_level."' ></div><div class='level_border_back level_67_corner_top_right c_level_".$c_level."'></div><div class='level_border_back level_67_line_bottom c_level_".$c_level."'></div><div class='level_border_back level_67_corner_bottom_right c_level_".$c_level."'></div><div class='level_border_back level_67_line_left c_level_".$c_level."'></div><div class='level_border_back level_67_corner_bottom_left c_level_".$c_level."'> </div><div class='level_content n_67_level_".$n_level." c_level_".$c_level."'><div class='level_number f_level_".$f_level." this_level'>".$level."</div></div></div></div>";

                      $title  = $l->not_title_type2." ".$level." ".$l->not_title_type21;
                      $text   = "+5 ".$l->not_text_type2;


                  }elseif($not_type == 4){


                    $kuid = $not_data;

                    $com_sql = db::$link->query("SELECT * FROM kommentar_db WHERE kuid = '$kuid'");
                    $com_row = $com_sql->fetch_assoc();

                    $com_uuid       = $com_row['uuid'];
                    $com_uuif       = sha1(sha1($com_uuid));
                    $com_user_name  = $u->userin('name',0,$com_uuif,'');

                      $avatar_src = $u->draw_avatar($com_uuid,'large');
                      $avatar = "<img src='".$_dhp.$avatar_src."'/>";

                    if($com_row['re_kuid'] == ""){ //neuer kommentar
                      $title = $l->not_title_type4;
                      $text = $com_user_name." ".$l->not_text_type4;
                    }else{ //neue antwort
                      $title = $l->not_title_type41;
                      $text = $com_user_name." ".$l->not_text_type41;
                    }


                  }elseif($not_type == 5){


                    $comvote_id = $not_data;

                    $com_sql = db::$link->query("SELECT * FROM kommentar_vote_db WHERE vote_id = '$comvote_id'");
                    $com_row = $com_sql->fetch_assoc();

                    $com_uuid       = $com_row['uuid'];
                    $com_uuif       = sha1(sha1($com_uuid));
                    $com_user_name  = $u->userin('name',0,$com_uuif,'');

                      $avatar_src = $u->draw_avatar($com_uuid,'large');
                      $avatar = "<img src='".$_dhp.$avatar_src."'/>";

                      $title = $l->not_title_type5;
                      $text = $com_user_name." ".$l->not_text_type5;


                  }elseif($not_type == 6){


                    $abo_uuid = $not_data;

                    $abo_uuif       = sha1(sha1($abo_uuid));
                    $abo_user_name  = $u->userin('name',0,$abo_uuif,'');

                      $avatar_src = $u->draw_avatar($abo_uuid,'large');
                      $avatar = "<img src='".$_dhp.$avatar_src."'/>";

                      $title = $l->not_title_type6;
                      $text = $abo_user_name." ".$l->not_text_type6;


                  }elseif($not_type == 7){


                    $vidvote_id = $not_data;

                    $vid_sql = db::$link->query("SELECT * FROM video_vote_db WHERE vote_id = '$vidvote_id'");
                    $vid_row = $vid_sql->fetch_assoc();

                    $vid_uuid       = $vid_row['uuid'];
                    $vid_uuif       = sha1(sha1($vid_uuid));
                    $vid_user_name  = $u->userin('name',0,$vid_uuif,'');

                      $avatar_src = $u->draw_avatar($vid_uuid,'large');
                      $avatar = "<img src='".$_dhp.$avatar_src."'/>";

                      $title = $l->not_title_type7;
                      $text = $vid_user_name." ".$l->not_text_type7;


                  }elseif($not_type == 10){


                    $friend_uuid = $not_data;

                    $friend_uuif       = sha1(sha1($friend_uuid));
                    $friend_user_name  = $u->userin('name',0,$friend_uuif,'');

                      $avatar_src = $u->draw_avatar($friend_uuid,'large');
                      $avatar = "<img src='".$_dhp.$avatar_src."'/>";

                      $title = $l->not_title_type10;
                      $text = $friend_user_name." ".$l->not_text_type10;


                  }elseif($not_type == 11){


                    $friend_uuid = $not_data;

                    $friend_uuif       = sha1(sha1($friend_uuid));
                    $friend_user_name  = $u->userin('name',0,$friend_uuif,'');

                      $avatar_src = $u->draw_avatar($friend_uuid,'large');
                      $avatar = "<img src='".$_dhp.$avatar_src."'/>";

                      $title = $l->not_title_type11;
                      $text = $friend_user_name." ".$l->not_text_type11;


                  }


                  //ausgabe
                  $json = '{"slot1": { "avatar": "'.$avatar.'", "title": "'.$title.'", "text": "'.$text.'"}';

            }
            if($check_row[0] >= 2){ //2 nachricht / zweite nachricht

                    $not_sql = db::$link->query("SELECT * FROM notification_db WHERE uuid = '$user_uuid' AND viewed = '0' AND status = 'public' AND
                      ( ( notification_type <= '3' ) OR ( notification_type >= '4' AND time > '$time_20min') )
                      ORDER BY time ASC, notification_id ASC LIMIT 0,1");
                    $not_row = $not_sql->fetch_assoc();

                    $not_id = $not_row['notification_id'];
                      $up = "UPDATE notification_db SET viewed = '1' WHERE notification_id = '$not_id' LIMIT 1";
                      $up = db::$link->query($up);

                    //freund xy is online wird nach anzeige dirkt gelöscht
                    $del = "DELETE FROM notification_db WHERE notification_id = '$not_id' AND notification_type = '11' LIMIT 1";
                    $del = db::$link->query($del);

                    $not_type = $not_row['notification_type'];
                    $not_data = $not_row['notification_data'];


                    if($not_type == 1){
                        $event_data = $not_data;

                        $user_level = $u->userin('level',0,'',$usercode_up);
                        $b_level = $lvl->lvlicon('b',$user_level);

                      $avatar = "<div class='popup_event_icon'><div class='l_res_ach_img c_level_".$b_level."'><div class='l_res_ach_img_text l_ach".$event_data."_symbol f_ach_1' ></div></div></div>";

                        //event_xp
                        $eventxp = "ach_".$event_data;
                        $eventxp = number_format($lvl->$eventxp,0, ",", ".");
                        $xpforevent = $eventxp.$l->level_xp_title;

                        //event_title
                        $eventtitel = "res_ach_title_".$event_data;
                        $eventtitel = $l->$eventtitel;

                        //event_step
                        if($event_data == 100 OR $event_data == 110 OR $event_data == 120 OR $event_data == 140 OR $event_data == 150 OR $event_data == 160 OR $event_data == 170 OR $event_data == 180){$event_step = " - ".$l->achstep1;}
                        elseif($event_data == 101 OR $event_data == 111 OR $event_data == 121 OR $event_data == 141 OR $event_data == 151 OR $event_data == 161 OR $event_data == 171 OR $event_data == 181){$event_step = " - ".$l->achstep2;}
                        elseif($event_data == 102 OR $event_data == 112 OR $event_data == 122 OR $event_data == 142 OR $event_data == 152 OR $event_data == 162 OR $event_data == 172 OR $event_data == 182){$event_step = " - ".$l->achstep3;}
                        else{$event_step = "";}

                        /* Link nur in der notificationList und nicht bei den Meldungen
                        if($event_data > 130 AND $event_data <= 190){
                          if($event_data >= 140 AND $event_data <= 142){$link_add = "ach_140";}
                          elseif($event_data >= 150 AND $event_data <= 152){$link_add = "ach_150";}
                          elseif($event_data >= 160 AND $event_data <= 162){$link_add = "ach_160";}
                          elseif($event_data >= 170 AND $event_data <= 172){$link_add = "ach_170";}
                          elseif($event_data >= 180 AND $event_data <= 182){$link_add = "ach_180";}
                        }elseif($event_data > 190){
                          $link_add = "ach_".$event_data;
                        }else{
                          $link_add = "video_ach";
                        }*/

                      $title  = $l->ach_yea;
                      $text   = "<span class='blue'>+".$xpforevent."</span> ".$l->ach_for."<br> <span class='blue'>".$eventtitel." ".$event_step."</span>";


                    }elseif($not_type == 2){


                      $level = $not_data;

                      $c_level = $lvl->lvlicon('c',$level);
                      $n_level = $lvl->lvlicon('n',$level);
                      $f_level = $lvl->lvlicon('f',$level);

                      //ja es darf keine enter (\n) haben es muss am stück sein:
                      $avatar = "<div class='popup_event_icon'><div class='level_content_back channel_middle_level_symbol'><div class='level_border_back level_67_line_top c_level_".$c_level."'></div><div class='level_border_back level_67_corner_top_left c_level_".$c_level."'></div><div class='level_border_back level_67_line_right c_level_".$c_level."' ></div><div class='level_border_back level_67_corner_top_right c_level_".$c_level."'></div><div class='level_border_back level_67_line_bottom c_level_".$c_level."'></div><div class='level_border_back level_67_corner_bottom_right c_level_".$c_level."'></div><div class='level_border_back level_67_line_left c_level_".$c_level."'></div><div class='level_border_back level_67_corner_bottom_left c_level_".$c_level."'> </div><div class='level_content n_67_level_".$n_level." c_level_".$c_level."'><div class='level_number f_level_".$f_level." this_level'>".$level."</div></div></div></div>";

                        $title  = $l->not_title_type2." ".$level." ".$l->not_title_type21;
                        $text   = "+5 ".$l->not_text_type2;


                    }elseif($not_type == 4){


                      $kuid = $not_data;

                      $com_sql = db::$link->query("SELECT * FROM kommentar_db WHERE kuid = '$kuid'");
                      $com_row = $com_sql->fetch_assoc();

                      $com_uuid       = $com_row['uuid'];
                      $com_uuif       = sha1(sha1($com_uuid));
                      $com_user_name  = $u->userin('name',0,$com_uuif,'');

                        $avatar_src = $u->draw_avatar($com_uuid,'large');
                        $avatar = "<img src='".$_dhp.$avatar_src."'/>";

                      if($com_row['re_kuid'] == ""){ //neuer kommentar
                        $title = $l->not_title_type4;
                        $text = $com_user_name." ".$l->not_text_type4;
                      }else{ //neue antwort
                        $title = $l->not_title_type41;
                        $text = $com_user_name." ".$l->not_text_type41;
                      }


                    }elseif($not_type == 5){


                      $comvote_id = $not_data;

                      $com_sql = db::$link->query("SELECT * FROM kommentar_vote_db WHERE vote_id = '$comvote_id'");
                      $com_row = $com_sql->fetch_assoc();

                      $com_uuid       = $com_row['uuid'];
                      $com_uuif       = sha1(sha1($com_uuid));
                      $com_user_name  = $u->userin('name',0,$com_uuif,'');

                        $avatar_src = $u->draw_avatar($com_uuid,'large');
                        $avatar = "<img src='".$_dhp.$avatar_src."'/>";

                        $title = $l->not_title_type5;
                        $text = $com_user_name." ".$l->not_text_type5;


                    }elseif($not_type == 6){


                      $abo_uuid = $not_data;

                      $abo_uuif       = sha1(sha1($abo_uuid));
                      $abo_user_name  = $u->userin('name',0,$abo_uuif,'');

                        $avatar_src = $u->draw_avatar($abo_uuid,'large');
                        $avatar = "<img src='".$_dhp.$avatar_src."'/>";

                        $title = $l->not_title_type6;
                        $text = $abo_user_name." ".$l->not_text_type6;


                    }elseif($not_type == 7){


                      $vidvote_id = $not_data;

                      $vid_sql = db::$link->query("SELECT * FROM video_vote_db WHERE vote_id = '$vidvote_id'");
                      $vid_row = $vid_sql->fetch_assoc();

                      $vid_uuid       = $vid_row['uuid'];
                      $vid_uuif       = sha1(sha1($vid_uuid));
                      $vid_user_name  = $u->userin('name',0,$vid_uuif,'');

                        $avatar_src = $u->draw_avatar($vid_uuid,'large');
                        $avatar = "<img src='".$_dhp.$avatar_src."'/>";

                        $title = $l->not_title_type7;
                        $text = $vid_user_name." ".$l->not_text_type7;


                    }elseif($not_type == 10){


                      $friend_uuid = $not_data;

                      $friend_uuif       = sha1(sha1($friend_uuid));
                      $friend_user_name  = $u->userin('name',0,$friend_uuif,'');

                        $avatar_src = $u->draw_avatar($friend_uuid,'large');
                        $avatar = "<img src='".$_dhp.$avatar_src."'/>";

                        $title = $l->not_title_type10;
                        $text = $friend_user_name." ".$l->not_text_type10;


                    }elseif($not_type == 11){


                      $friend_uuid = $not_data;

                      $friend_uuif       = sha1(sha1($friend_uuid));
                      $friend_user_name  = $u->userin('name',0,$friend_uuif,'');

                        $avatar_src = $u->draw_avatar($friend_uuid,'large');
                        $avatar = "<img src='".$_dhp.$avatar_src."'/>";

                        $title = $l->not_title_type11;
                        $text = $friend_user_name." ".$l->not_text_type11;


                    }

                  //ausgabe
                  $json = $json.',"slot2": { "avatar": "'.$avatar.'", "title": "'.$title.'", "text": "'.$text.'"}';

            }
            if($check_row[0] >= 3){ //3 nachricht / drite nachricht

                    $not_sql = db::$link->query("SELECT * FROM notification_db WHERE uuid = '$user_uuid' AND viewed = '0' AND status = 'public' AND
                      ( ( notification_type <= '3' ) OR ( notification_type >= '4' AND time > '$time_20min') )
                      ORDER BY time ASC, notification_id ASC LIMIT 0,1");
                    $not_row = $not_sql->fetch_assoc();


                    $not_id = $not_row['notification_id'];
                      $up = "UPDATE notification_db SET viewed = '1' WHERE notification_id = '$not_id' LIMIT 1";
                      $up = db::$link->query($up);

                    //freund xy is online wird nach anzeige dirkt gelöscht
                    $del = "DELETE FROM notification_db WHERE notification_id = '$not_id' AND notification_type = '11' LIMIT 1";
                    $del = db::$link->query($del);


                    $not_type = $not_row['notification_type'];
                    $not_data = $not_row['notification_data'];


                    if($not_type == 1){
                        $event_data = $not_data;

                        $user_level = $u->userin('level',0,'',$usercode_up);
                        $b_level = $lvl->lvlicon('b',$user_level);

                      $avatar = "<div class='popup_event_icon'><div class='l_res_ach_img c_level_".$b_level."'><div class='l_res_ach_img_text l_ach".$event_data."_symbol f_ach_1' ></div></div></div>";

                        //event_xp
                        $eventxp = "ach_".$event_data;
                        $eventxp = number_format($lvl->$eventxp,0, ",", ".");
                        $xpforevent = $eventxp.$l->level_xp_title;

                        //event_title
                        $eventtitel = "res_ach_title_".$event_data;
                        $eventtitel = $l->$eventtitel;

                        //event_step
                        if($event_data == 100 OR $event_data == 110 OR $event_data == 120 OR $event_data == 140 OR $event_data == 150 OR $event_data == 160 OR $event_data == 170 OR $event_data == 180){$event_step = " - ".$l->achstep1;}
                        elseif($event_data == 101 OR $event_data == 111 OR $event_data == 121 OR $event_data == 141 OR $event_data == 151 OR $event_data == 161 OR $event_data == 171 OR $event_data == 181){$event_step = " - ".$l->achstep2;}
                        elseif($event_data == 102 OR $event_data == 112 OR $event_data == 122 OR $event_data == 142 OR $event_data == 152 OR $event_data == 162 OR $event_data == 172 OR $event_data == 182){$event_step = " - ".$l->achstep3;}
                        else{$event_step = "";}

                        /* Link nur in der notificationList und nicht bei den Meldungen
                        if($event_data > 130 AND $event_data <= 190){
                          if($event_data >= 140 AND $event_data <= 142){$link_add = "ach_140";}
                          elseif($event_data >= 150 AND $event_data <= 152){$link_add = "ach_150";}
                          elseif($event_data >= 160 AND $event_data <= 162){$link_add = "ach_160";}
                          elseif($event_data >= 170 AND $event_data <= 172){$link_add = "ach_170";}
                          elseif($event_data >= 180 AND $event_data <= 182){$link_add = "ach_180";}
                        }elseif($event_data > 190){
                          $link_add = "ach_".$event_data;
                        }else{
                          $link_add = "video_ach";
                        }*/

                      $title  = $l->ach_yea;
                      $text   = "<span class='blue'>+".$xpforevent."</span> ".$l->ach_for."<br> <span class='blue'>".$eventtitel." ".$event_step."</span>";


                    }elseif($not_type == 2){


                      $level = $not_data;

                      $c_level = $lvl->lvlicon('c',$level);
                      $n_level = $lvl->lvlicon('n',$level);
                      $f_level = $lvl->lvlicon('f',$level);

                      //ja es darf keine enter (\n) haben es muss am stück sein:
                      $avatar = "<div class='popup_event_icon'><div class='level_content_back channel_middle_level_symbol'><div class='level_border_back level_67_line_top c_level_".$c_level."'></div><div class='level_border_back level_67_corner_top_left c_level_".$c_level."'></div><div class='level_border_back level_67_line_right c_level_".$c_level."' ></div><div class='level_border_back level_67_corner_top_right c_level_".$c_level."'></div><div class='level_border_back level_67_line_bottom c_level_".$c_level."'></div><div class='level_border_back level_67_corner_bottom_right c_level_".$c_level."'></div><div class='level_border_back level_67_line_left c_level_".$c_level."'></div><div class='level_border_back level_67_corner_bottom_left c_level_".$c_level."'> </div><div class='level_content n_67_level_".$n_level." c_level_".$c_level."'><div class='level_number f_level_".$f_level." this_level'>".$level."</div></div></div></div>";

                        $title  = $l->not_title_type2." ".$level." ".$l->not_title_type21;
                        $text   = "+5 ".$l->not_text_type2;


                    }elseif($not_type == 4){


                      $kuid = $not_data;

                      $com_sql = db::$link->query("SELECT * FROM kommentar_db WHERE kuid = '$kuid'");
                      $com_row = $com_sql->fetch_assoc();

                      $com_uuid       = $com_row['uuid'];
                      $com_uuif       = sha1(sha1($com_uuid));
                      $com_user_name  = $u->userin('name',0,$com_uuif,'');

                        $avatar_src = $u->draw_avatar($com_uuid,'large');
                        $avatar = "<img src='".$_dhp.$avatar_src."'/>";

                      if($com_row['re_kuid'] == ""){ //neuer kommentar
                        $title = $l->not_title_type4;
                        $text = $com_user_name." ".$l->not_text_type4;
                      }else{ //neue antwort
                        $title = $l->not_title_type41;
                        $text = $com_user_name." ".$l->not_text_type41;
                      }


                    }elseif($not_type == 5){


                      $comvote_id = $not_data;

                      $com_sql = db::$link->query("SELECT * FROM kommentar_vote_db WHERE vote_id = '$comvote_id'");
                      $com_row = $com_sql->fetch_assoc();

                      $com_uuid       = $com_row['uuid'];
                      $com_uuif       = sha1(sha1($com_uuid));
                      $com_user_name  = $u->userin('name',0,$com_uuif,'');

                        $avatar_src = $u->draw_avatar($com_uuid,'large');
                        $avatar = "<img src='".$_dhp.$avatar_src."'/>";

                        $title = $l->not_title_type5;
                        $text = $com_user_name." ".$l->not_text_type5;


                    }elseif($not_type == 6){


                      $abo_uuid = $not_data;

                      $abo_uuif       = sha1(sha1($abo_uuid));
                      $abo_user_name  = $u->userin('name',0,$abo_uuif,'');

                        $avatar_src = $u->draw_avatar($abo_uuid,'large');
                        $avatar = "<img src='".$_dhp.$avatar_src."'/>";

                        $title = $l->not_title_type6;
                        $text = $abo_user_name." ".$l->not_text_type6;


                    }elseif($not_type == 7){


                      $vidvote_id = $not_data;

                      $vid_sql = db::$link->query("SELECT * FROM video_vote_db WHERE vote_id = '$vidvote_id'");
                      $vid_row = $vid_sql->fetch_assoc();

                      $vid_uuid       = $vid_row['uuid'];
                      $vid_uuif       = sha1(sha1($vid_uuid));
                      $vid_user_name  = $u->userin('name',0,$vid_uuif,'');

                        $avatar_src = $u->draw_avatar($vid_uuid,'large');
                        $avatar = "<img src='".$_dhp.$avatar_src."'/>";

                        $title = $l->not_title_type7;
                        $text = $vid_user_name." ".$l->not_text_type7;


                    }elseif($not_type == 10){


                      $friend_uuid = $not_data;

                      $friend_uuif       = sha1(sha1($friend_uuid));
                      $friend_user_name  = $u->userin('name',0,$friend_uuif,'');

                        $avatar_src = $u->draw_avatar($friend_uuid,'large');
                        $avatar = "<img src='".$_dhp.$avatar_src."'/>";

                        $title = $l->not_title_type10;
                        $text = $friend_user_name." ".$l->not_text_type10;


                    }elseif($not_type == 11){


                      $friend_uuid = $not_data;

                      $friend_uuif       = sha1(sha1($friend_uuid));
                      $friend_user_name  = $u->userin('name',0,$friend_uuif,'');

                        $avatar_src = $u->draw_avatar($friend_uuid,'large');
                        $avatar = "<img src='".$_dhp.$avatar_src."'/>";

                        $title = $l->not_title_type11;
                        $text = $friend_user_name." ".$l->not_text_type11;


                    }

                  //ausgabe
                  $json = $json.',"slot3": { "avatar": "'.$avatar.'", "title": "'.$title.'", "text": "'.$text.'"}';

                }


              // final ausgabe
              $json = $json.'}';



          }else{ //if event == 3 (big level update);

            $not_sql = db::$link->query("SELECT notification_id,notification_data FROM notification_db WHERE uuid = '$user_uuid' AND viewed = '0' AND notification_type = '3' AND status = 'public' ORDER BY time ASC, notification_id ASC LIMIT 0,1");
            $not_row = $not_sql->fetch_assoc();

            $not_id = $not_row['notification_id'];
              $up = "UPDATE notification_db SET viewed = '1' WHERE notification_id = '$not_id' LIMIT 1";
              $up = db::$link->query($up);

            $not_data = $not_row['notification_data']; //level 10,20 etc...

            $level_up = $not_data; $level_dw = $not_data - 1;

            $level_up_b = $lvl->lvlicon('b',$level_up);
            $level_up_n = $lvl->lvlicon('n',$level_up);
            $level_up_c = $lvl->lvlicon('c',$level_up);
            $level_up_f = $lvl->lvlicon('f',$level_up);

            $level_dw_b = $lvl->lvlicon('b',$level_dw);
            $level_dw_n = $lvl->lvlicon('n',$level_dw);
            $level_dw_c = $lvl->lvlicon('c',$level_dw);
            $level_dw_f = $lvl->lvlicon('f',$level_dw);


            $content = "
            <script>
            var audioDingDingDing = new Audio('".$_dhp."audio/sounds/dingdingding.mp3');
            levelpopupskip = 0;
            function closelvelpopup(){
              levelpopupskip = 1;
              $('#big_popup_event').fadeOut(50);
              $('.pop_background').fadeOut(50);
              $('body').removeClass('stop_srolling');
            }

            setTimeout(function() {
              $('.level_corner_top_left_draw').animate({width: '15'},40, function() {
                $('.level_line_top_draw').animate({width: '270'}, 500, function() {
                  $('.level_corner_top_right_draw').animate({width: '15',height: '15' },200, function() {
                    $('.level_line_right_draw').animate({height: '270'}, 500, function() {
                      $('.level_corner_bottom_right_draw').animate({width: '15',height: '15' },200, function() {
                        $('.level_line_bottom_draw').animate({width: '270'}, 500, function() {
                          $('.level_corner_bottom_left_draw').animate({width: '15',height: '15' },200, function() {
                            $('.level_line_left_draw').animate({height: '270'}, 500, function() {
                               if(levelpopupskip == 0){ levelup(); }
                            });
                          });
                        });
                      });
                    });
                  });
                });
              });
            }, 1000);

             function levelup(){
               audioDingDingDing.play();
                 $('.big_level_border_back').removeClass('b_level_".$level_dw_b."');
                 $('.big_level_border_back').addClass('b_level_".$level_up_b."');

                 $('.big_level_border_front').delay(150).fadeOut(100).delay(50).fadeIn(150,function() {
                   $('.big_level_border_front').delay(150).fadeOut(100,function() {
                     $('.big_level_border_front').width(0);
                   });
                 });

                 $('.big_level_content').removeClass('c_level_".$level_dw_c."');
                 $('.big_level_content').addClass('c_level_".$level_up_c."');

                 setTimeout(function() {
                 $('.big_level_content').removeClass('c_level_".$level_dw_c."');
                 $('.big_level_content').addClass('c_level_".$level_up_c."');
                   setTimeout(function() {
                   $('.big_level_content').removeClass('c_level_".$level_dw_c."');
                   $('.big_level_content').addClass('c_level_".$level_up_c."');
                     setTimeout(function() {
                       $('.big_level_content').removeClass('c_level_".$level_dw_c."');
                       $('.big_level_content').addClass('c_level_".$level_up_c."');
                         setTimeout(function() {
                         $('.big_level_content').removeClass('c_level_".$level_dw_c."');
                         $('.big_level_content').addClass('c_level_".$level_up_c."');
                       }, 150);
                     }, 150);
                   }, 150);
                 }, 150);

                  $('.big_this_level').html('".$level_up."');
                  $('.big_this_level').removeClass('f_level_".$level_dw_f."');
                  $('.big_this_level').addClass('f_level_".$level_up_f."');

                  $('.big_level_content').removeClass('n_level_".$level_dw_n."');
                  $('.big_level_content').addClass('n_level_".$level_up_n."');
             }
           </script>


           <div id='big_popup_event' class='big_popup_event'>
              <div class='big_popup_event_icon'>
                <div class='big_level_border_back level_line_top b_level_".$level_dw_b."'> <div class='big_level_border_front level_line_top_draw c_level_".$level_dw_c."'></div> </div>
                  <div class='big_level_border_back level_corner_top_left b_level_".$level_dw_b."'> <div class='big_level_border_front level_corner_top_left_draw c_level_".$level_dw_c."'></div> </div>
                <div class='big_level_border_back level_line_right b_level_".$level_dw_b."' > <div class='big_level_border_front level_line_right_draw c_level_".$level_dw_c."'></div> </div>
                  <div class='big_level_border_back level_corner_top_right b_level_".$level_dw_b."'> <div class='big_level_border_front level_corner_top_right_draw c_level_".$level_dw_c."'></div> </div>
                <div class='big_level_border_back level_line_bottom b_level_".$level_dw_b."'> <div class='big_level_border_front level_line_bottom_draw c_level_".$level_dw_c."'></div> </div>
                  <div class='big_level_border_back level_corner_bottom_right b_level_".$level_dw_b."'> <div class='big_level_border_front level_corner_bottom_right_draw c_level_".$level_dw_c."'></div> </div>
                <div class='big_level_border_back level_line_left b_level_".$level_dw_b."'> <div class='big_level_border_front level_line_left_draw c_level_".$level_dw_c."'></div> </div>
                  <div class='big_level_border_back level_corner_bottom_left b_level_".$level_dw_b."'> <div class='big_level_border_front level_corner_bottom_left_draw c_level_".$level_dw_c."'></div> </div>

                <div class='big_level_content n_level_".$level_dw_n." c_level_".$level_dw_c."'>
                  <div class='level_number f_level_".$level_dw_f." big_this_level'>
                    ".$level_dw."
                  </div>
                </div>
              </div>

              <div class='big_popup_event_container'>
                  <div class='big_popup_event_fisrt_line'>".$l->ach_yea."</div>";


                    $content = $content." <div class='big_popup_event_second_line'>
                    ".$l->level_big_text_a1." <span class='blue'>".$l->level_big_text_blue." ".$level_up."</span> ".$l->level_big_text_b1."!<br/>";

                  if($level_up == 1000){
                    $content = $content." <br/> <span class='blue'>·".$l->level_gifts0."</span>";
                  }

                  if($level_up == 50 OR $level_up == 100 OR $level_up == 250 OR $level_up == 500 OR $level_up == 750 OR $level_up == 1000){
                    $content = $content." <br/> <span class='blue'>· ".$l->level_gifts1."</span>";
                  }

                  if($level_up == 100 OR $level_up == 300 OR $level_up == 500 OR $level_up == 700 OR $level_up == 900 OR $level_up == 1000){
                    $content = $content." <br/> <span class='blue'>· ".$l->level_gifts2."</span>";
                  }

                  $content = $content." <br/> <span class='blue'>· ".$l->level_gifts3."</span>
                                        <br/> <span class='blue'>· ".$l->level_gifts4."</span>
                                        <br/> <span class='blue'>· ".$l->level_gifts5."</span>
                  </div>
                  <div onclick='closelvelpopup()' class='pop_ok_btn'>".$l->level_big_text_ok."</div>
                  <div style='clear:both;'></div>
            </div>
          </div>";


            $content = trim(preg_replace('/\s\s+/', '', $content));
            $json = "{\"big_level_content\": \"".$content."\"}";
          }


          header('Content-type:application/json;charset=utf-8');
          echo json_encode($json);


      }else{
        $i++;
        sleep(5); //schläft 5s
      }

    }else{
      $i = 60;

      $not_sql = db::$link->query("SELECT token FROM notification_temp WHERE uuid = '$user_uuid'");
      $not_row = $not_sql->fetch_assoc();

      $not_token = $not_row['token'];

      header('Content-type:application/json;charset=utf-8');
      echo json_encode('{ "new_token": "'.$not_token.'" }');

    }
  }

}else{
  $not_sql = db::$link->query("SELECT token FROM notification_temp WHERE uuid = '$user_uuid'");
  $not_row = $not_sql->fetch_assoc();

  $not_token = $not_row['token'];


  //set offline status
  $user_uuif = sha1(sha1($user_uuid));

  $up = "UPDATE user_find_db SET online_status = 'offline' WHERE uuid = '$user_uuid'"; $up = db::$link->query($up);
  $u->userinset('last_online_time',$time,$user_uuif);


  header('Content-type:application/json;charset=utf-8');
  echo json_encode('{ "new_token": "'.$not_token.'" }');
}

}else{
  echo "error";
}


?>
