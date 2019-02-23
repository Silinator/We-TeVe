<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once($_hp.'include/all_include.php'); //haupt include

if($isUserLoggedIn === 1){
  $at = $_POST['at'];

  if( $_curl_installed == "true"){
    $html = 'https://www.googleapis.com/youtube/v3/channels?part=id&mine=true&access_token='.$at;
    $curl = curl_init($html);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $return = curl_exec($curl);
    curl_close($curl);
    $decoded = json_decode($return, true);
		foreach ($decoded['items'] as $items) {
				 $channel_id = $items['id'];
		}
  } else {
    $html = 'https://www.googleapis.com/youtube/v3/channels?part=id&mine=true&access_token='.$at;
    $response = file_get_contents($html);
    $decoded = json_decode($response, true);
    foreach ($decoded['items'] as $items) {
         $channel_id = $items['id'];
    }
  }

  if($at != "" AND $channel_id != ""){
      //check ob es das google Konnt vom video auch dem nutzer gehört
        $google_channel_sql = db::$link->query("SELECT google_id FROM google_db WHERE g_channel_id = '$channel_id' AND uuid = '$user_uuid' AND status = 'ok'");
        $google_channel_row = $google_channel_sql->fetch_assoc();
        $userauth           = $google_channel_row['google_id'];

        if($userauth != ""){
          echo "already";
        }else{
            $time        = strtotime(date('Y-m-d H:i:s'));
            $set_g_konto = "INSERT INTO google_db
                   (g_channel_id, uuid,        status, data) VALUES
                   ('$channel_id','$user_uuid','ok',   '$time')";
            $set_g_konto = db::$link->query($set_g_konto);

            if($set_g_konto == true){
              $key = $_google_api;
              $ated_at = $time;
              $ated_at = $t->invor($ated_at);

              if( $_curl_installed == "true"){
                $html = "https://www.googleapis.com/youtube/v3/channels?part=snippet&id=".$channel_id."&key=".$key; //'https://www.googleapis.com/youtube/v3/videos?id='.$video_id.'&key='.$key.'&part=snippet';
                $curl = curl_init($html); curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); $return = curl_exec($curl); curl_close($curl); $decoded = json_decode($return, true);
                $decoded = json_decode($response, true);
                foreach ($decoded['items'] as $items) {
                     $title       = $items['snippet']['title'];
                     $avatar      = $items['snippet']['thumbnails']['default']['url'];
                }
              }else{
                $html = "https://www.googleapis.com/youtube/v3/channels?part=snippet&id=".$channel_id."&key=".$key; //'https://www.googleapis.com/youtube/v3/videos?id='.$video_id.'&key='.$key.'&part=snippet';
                $response = file_get_contents($html);
                $decoded = json_decode($response, true);
                foreach ($decoded['items'] as $items) {
                     $title       = $items['snippet']['title'];
                     $avatar      = $items['snippet']['thumbnails']['default']['url'];
                }
              }

              echo "<div class='g_konten_box col-md-12 col-xl-6'>";
                  echo "<div class='g_avatar'><a target='_blank' href='https://www.youtube.com/channel/".$channel_id."'>";
                    echo "<img class='g_avatar_img' src='".$avatar."' />";
                  echo "</a> </div>";

                  echo "<div class='g_name'>
                    <a target='_blank' href='https://www.youtube.com/channel/".$channel_id."'> <div class='no_overflow'> ".$title." </div> </a>
                    <div class='g_text no_overflow'>".$l->opt_text_1." ".$ated_at."</div>
                  </div>";

              echo "</div>";
            }

        }
  }else{
    echo "error";
  }

}else{
  echo "error";
}
