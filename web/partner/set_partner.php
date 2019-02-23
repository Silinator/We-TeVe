<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = "../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

//3. site vals
$html_title = $l->partner_title." | We-TeVe"; //Tap title


if($isUserLoggedIn === 1){

  $user_sql = db::$link->query("SELECT * FROM user_find_db WHERE uuid = '$user_uuid'");
  $user_row = $user_sql->fetch_assoc();
  if($user_row['partner_status'] == 0){

    //alle Videos
      $video_needed = 3;
      $video_sql = db::$link->query("SELECT count(vuid) FROM video_db WHERE uuid = '$user_uuid' AND privacy = 'public' AND status = 'uploaded' LIMIT 3");
      $video_row = $video_sql->fetch_row();
      $all_public_videos = $video_row[0];
        $all_public_videos = $video_needed;


    //video Aufrufe
      $s_views = "0";
      $views_needed = 100;
      $sql_s_info = db::$link->query("SELECT views FROM video_db WHERE uuid = '$user_uuid' AND status = 'uploaded' AND privacy = 'public'");
      while ($erg_s_info = $sql_s_info->fetch_array())
      {
        $s_views  = $s_views + $erg_s_info['views'];
      }
        $s_views = $views_needed; //test


    //level
      $level_needed = 30;
      $user_sql = db::$link->query("SELECT xp FROM user_find_db WHERE uuid = '$user_uuid'");
      $user_row = $user_sql->fetch_assoc();
        $user_xp = $user_row['xp'];
        $user_level = $lvl->lvlinfo('level',$user_xp);

        $user_level = $level_needed; //test


    //if anforderungen erfüllt:
    if($all_public_videos >= $video_needed AND $s_views >= $views_needed AND $user_level >= $level_needed){

      if(isset($_POST['payment_info']) AND isset($_POST['payment_info_name']) AND isset($_POST['payment_meth'])){

        $error = 0;
        $payment_meth      = $_POST['payment_meth'];
        $payment_info      = $_POST['payment_info'];
        $payment_info_name = $_POST['payment_info_name'];

        if($payment_meth == "iban"){
          if($payment_info == "" OR $payment_info_name == ""){
            echo "error";
            $error = 1;
            exit;
          }
        }else{
          if($payment_info == ""){
            echo "error";
            $error = 1;
            exit;
          }
        }

        if($payment_meth == "paypal"){
          if(filter_var($payment_info, FILTER_VALIDATE_EMAIL) == false){
            echo "error1";
            $error = 1;
            exit;
          }
        }



        if($error == 0 AND ($payment_meth == "iban" OR $payment_meth == "paypal" OR $payment_meth == "monero")){

          $user_uuif = sha1(sha1($user_uuid));
          $key = $u->userin('key',0,$user_uuif,'');
          $key2 = $u->userin('key2',0,$user_uuif,'');

          //vals
          $time                   = strtotime(date('Y-m-d H:i:s'));
          $user_uuid_ver          = $ver->ver($user_uuid,$key,$key2);
          $payment_meth_ver       = $ver->ver($payment_meth,$key,$key2);
          $payment_info_ver       = $ver->ver($payment_info,$key,$key2);
          $payment_info_name_ver  = $ver->ver($payment_info_name,$key,$key2);
          $status_ver             = $ver->ver('ok',$key,$key2);

          $set_partner = "INSERT INTO partner_db
            (uuid,methode,payment_info,payment_info2,time,status) VALUES
            ('$user_uuid_ver','$payment_meth_ver','$payment_info_ver','$payment_info_name_ver','$time','$status_ver')";
          $set_partner = db::$link->query($set_partner);

          if($set_partner == true){

            // Instantiate the class with your secret key
            $coinhive = new CoinHiveAPI('jxbTJn1DMEYcjcs4oYk7PUyfV1cl2vjb');
            $user_reset = $coinhive->post('/user/reset', ['name' => $user_uuid]);

            $results = db::$link->query("SELECT vuid FROM video_db WHERE uuid = '$user_uuid' AND status != 'deleted' AND status != 'start'");
              while($row = $results->fetch_array()){
                $video_vuid_restet = $row['vuid'];
                $video_rest = $coinhive->post('/user/reset', ['name' => $video_vuid_restet]);
              }


            $up = "UPDATE user_find_db SET partner_status = '1' WHERE uuid = '$user_uuid'";
            $up = db::$link->query($up);
            echo "ok";
          }else{
            echo "error2";
          }

        }


      }//end isset

    }//end can go partner

  }//end no partner yet

}//end logged in
