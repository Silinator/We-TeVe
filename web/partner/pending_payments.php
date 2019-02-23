<?php

	//1. Pfad zum Stammverzeichniss wo sich die index befindet
	$_hp = '../'; //für includes
	$_dhp = '../../'; // für daten


	//2. all include
	$in_save_code_all_include = "&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z";
	require_once ($_hp.'include/all_include.php'); //haupt include



if($isUserLoggedIn === 1){

  $partner_sql = db::$link->query("SELECT partner_status FROM user_find_db WHERE uuid = '$user_uuid'");
  $partner_row = $partner_sql->fetch_assoc();
  $partner_status = $partner_row['partner_status'];
  if($user_rang == 1 OR $partner_status > 0){




    $results = db::$link->query("SELECT * FROM video_db WHERE uuid = '$user_uuid' AND status = 'uploaded'");

    $xmr_all_videos = 0;
    // Instantiate the class with your secret key
    $coinhive = new CoinHiveAPI('jxbTJn1DMEYcjcs4oYk7PUyfV1cl2vjb');
    $payout_info = $coinhive->get('/stats/payout');
    	$globalDifficulty = $payout_info->globalDifficulty;
    	$blockReward = $payout_info->blockReward;

    while($row = $results->fetch_array()){
      $video_vuid = $row['vuid'];
      $user = $coinhive->get('/user/balance', ['name' => $video_vuid]);
			if($user->success == true){
	      $video_balance = $user->balance;
	      $video_payout = (($video_balance / $globalDifficulty) * $blockReward * 0.7) * 0.6;
	      $xmr_all_videos = $xmr_all_videos + $video_payout;
			}else{
				$video_payout = 0;
				$xmr_all_videos = $xmr_all_videos + $video_payout;
			}
    }
      $video_payout = number_format($xmr_all_videos, 12,'.','');

    $user = $coinhive->get('/user/balance', ['name' => $user_uuid]);
		if($user->success == true){
			$channel_balance = $user->balance;
	    $xmr_channel_payout = (($channel_balance / $globalDifficulty) * $blockReward * 0.7) * 0.6;
	      $channel_payout = number_format($xmr_channel_payout, 12,'.','');
		}else{
			$xmr_channel_payout = 0;
				$channel_payout = number_format($xmr_channel_payout, 12,'.','');
		}

    echo $l->part_title_2_1.": ".$channel_payout." XMR<br/>";
    echo $l->part_title_2_2.": ".$video_payout." XMR<br/>";
		echo $l->part_title_2_4.": ".number_format($video_payout+$channel_payout, 12,'.','')." XMR<br/>";

    echo "<h3>".$l->part_title_2.":<br/>";

			//total payout - bereits bezahlt
			$total_payout = $xmr_all_videos + $channel_payout;

			$user_uuif = sha1(sha1($user_uuid));
			$key = $u->userin('key',0,$user_uuif,'');
			$key2 = $u->userin('key2',0,$user_uuif,'');
			$status_ok_ver = $ver->ver('ok',$key,$key2);

			//get current starting point of records
			$results = db::$link->query("SELECT paid_xmr FROM payments_db WHERE uuif = '$user_uuif' AND status = '$status_ok_ver'");

			$payed_payout = 0;

			while($row = $results->fetch_array()){
				$payed_paout_xmr = $ver->ent($row['paid_xmr'],$key,$key2);
				$payed_payout = $payed_payout + $payed_paout_xmr;
			}

				$total_payout = $total_payout - $payed_payout;

    echo number_format($total_payout, 12,'.','')." XMR</h3>";

		echo "<br/>";
		echo $l->part_title_3;

  } //if partner

} // if user logged in
