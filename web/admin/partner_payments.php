<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = "../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

//3. site vals
$html_title = $l->admin_menu_title_3." | We-TeVe"; //Tap title


if($isUserLoggedIn === 1){

  if($user_rang == 1){

//4. coinhive check
$coin_name = "main";
require_once ($_hp.'coinhive/coinhive_check.php');


//5. check ist inframed (von andererseite geladen)
if(isset($_POST['inframed'])){
	if($_POST['inframed'] == 1){
		$infram = 1;
	}else{
		$infram = 0;
	}
}else{
	$infram = 0;
}
?>

<?php if($infram != 1){?>

	<!DOCTYPE html>
	<html lang='<?php echo $l->htmldata; ?>'>
		<head>
			<?php
			require_once ($_hp.'include/head.php');
			//echo "<script src='".$_dhp."video/video.js'></script>";
			//echo "<script src='".$_dhp."video/video-hotkey.js'></script>";
			?>
		</head>
		<body id='body' class='body'>

			<?php require_once ($_hp.'include/navi.php'); ?>




		<div id='main_container' class='container main_container'>
<?php	}?>

		<span id='site_scripts'>

      <?php // require_once ($_hp.'include/coinhivescript.php'); ?>
      <script class='check_js'></script>

			<script src='<?php echo $_dhp;?>js/sha256.js'></script>
			<script>

				var playlist_id = 'not_set';

				$(document).ready(function() {
					docready();
					sethtmltitle('<?php echo $html_title; ?>');
				});

			</script>
		</span>

			<div class='row'>
				<div class='col-lg-2 col-xl-2 col-spl'> </div>
				<div class=' col-lg-8 col-xl-8 col-spl'>
						<div class='option_holder option_navi col-lg-2 col-xl-2 col-spl'>
              <h3><?php echo $l->admin_menu_title_0; ?>:</h3>
              <a href='../admin/dashboard' class='opt_a'> <?php echo $l->admin_menu_title_1; ?> </a>
              <a href='../admin/partner_payments' class='opt_a opt_activ'> <?php echo $l->admin_menu_title_3; ?> </a>
              <a href='../admin/videos' class='opt_a'> <?php echo $l->admin_menu_title_4; ?> </a>
						</div>


						<div class='col-lg-10 col-xl-10'>
							<div class='option_content option_holder pad-15'>

                <?php
                echo "<div class='w-100 marg-bot-10'>".$l->admin_head_title."</div>";

                $max_results = 3;
                $result_count = 0;

                $coinhive = new CoinHiveAPI('jxbTJn1DMEYcjcs4oYk7PUyfV1cl2vjb');
                $payout_info = $coinhive->get('/stats/payout');
                  $globalDifficulty = $payout_info->globalDifficulty;
                  $blockReward = $payout_info->blockReward;

              $results_u = db::$link->query("SELECT uuid FROM user_find_db ORDER BY last_online_time DESC");
              while($row = $results_u->fetch_array()){
                  if($result_count < $max_results){
                  $channel_uuid = $row['uuid'];
                  $channel_uuif = sha1(sha1($channel_uuid));

                  $payed_this_month = 0;

                  $payment_sql = db::$link->query("SELECT month FROM payments_db WHERE uuif = '$channel_uuif' ORDER BY time DESC");
                  $payment_row = $payment_sql->fetch_assoc();

                  if($payment_row['month'] == ""){
                    $payed_this_month = 0;
                  }else{
                    $time_month = strtotime(date('Y-m'));
                    if($payment_row['month'] == $time_month){
                      $payed_this_month = 1;
                    }else{
                      $payed_this_month = 0;
                    }
                  }


                if($payed_this_month == 0){ //ob disen monat bereits bezalt


                  //alle Videos
                    $xmr_all_videos = 0;
                    $results = db::$link->query("SELECT * FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded'");
                    if($results){
                      while($row = $results->fetch_array()){
                        $video_vuid = $row['vuid'];
                        $user = $coinhive->get('/user/balance', ['name' => $video_vuid]);
                        if($user->success == true){
                          $video_balance = $user->balance;
                          $video_payout = (($video_balance / $globalDifficulty) * $blockReward * 0.7) * 0.6;
                          $xmr_all_videos = $xmr_all_videos + $video_payout;
                        }
                      }
                    }

                    $user = $coinhive->get('/user/balance', ['name' => $channel_uuid]);
                    if($user->success == true){
                      $channel_balance = $user->balance;
                      $xmr_channel_payout = (($channel_balance / $globalDifficulty) * $blockReward * 0.7) * 0.6;
                    }else{
                      $xmr_channel_payout = 0;
                    }

                  //total payout - bereits bezahlt
                    $total_payout = $xmr_channel_payout + $xmr_all_videos;

                    $key = $u->userin('key',0,$channel_uuif,'');
                    $key2 = $u->userin('key2',0,$channel_uuif,'');
                    $status_ok_ver = $ver->ver('ok',$key,$key2);

                    //get current starting point of records
                    $results = db::$link->query("SELECT paid_xmr FROM payments_db WHERE uuif = '$channel_uuif' AND status = '$status_ok_ver'");

                    $payed_payout = 0;

                    while($row = $results->fetch_array()){
                      $payed_paout_xmr = $ver->ent($row['paid_xmr'],$key,$key2);
                      $payed_payout = $payed_payout + $payed_paout_xmr;
                    }

                      $total_payout = $total_payout - $payed_payout;

                    $total_xmr_num = number_format($total_payout, 12,'.','');

                    if($total_payout >= 0.2 ){ // >= 0.2 -> auszahlungne erst ab gesamt einnhmen von min. 0.2 XMR
                      $result_count++;

                      echo "<div class='ad_part_payments_box'>";
                        $f->draw_user_preview($channel_uuid,$_dhp);

                        echo "<div class='ad_part_payments_xmr_value'>";
                          echo "<".$total_xmr_num."> XMR";
                        echo "</div>";

                        echo "<div class='ad_part_payments_xmr_pay' ad_part_open='".$result_count."'>";
                          echo $l->admin_pay_payents;
                        echo "</div>";
                      echo "</div>";

                      echo "<div class='ad_part_payments_to_pay_box ad_part_payments_to_pay_box_".$result_count." hide'>";
                        //get zahlungs informationen
                        $channel_uuif = sha1(sha1($channel_uuid));
                        $channel_ver_uuid = $u->userin('uuid',1,$channel_uuif,'');
                        $pay_sql = db::$link->query("SELECT * FROM partner_db WHERE uuid = '$channel_ver_uuid'");
                        $pay_row = $pay_sql->fetch_assoc();

                        if($pay_row['uuid'] != ""){
                          $methode = $pay_row['methode'];
                            $key = $u->userin('key',0,$channel_uuif,'');
                            $key2 = $u->userin('key2',0,$channel_uuif,'');

                            //vals
                            $time              = strtotime(date('Y-m-d H:i:s'));
                            $payment_meth      = $ver->ent($pay_row['methode'],$key,$key2);
                            $payment_info      = $ver->ent($pay_row['payment_info'],$key,$key2);
                            $payment_info_name = $ver->ent($pay_row['payment_info2'],$key,$key2);
                            $status            = $ver->ent($pay_row['status'],$key,$key2);

                          if($payment_meth != "iban"){
                            echo "<b class='left marg-bot-5'>".$payment_meth."</b><br/>";
                            echo "<input type='text' class='form-control marg-bot-5' value='".$payment_info."'/>";
                            echo "<input type='text' class='form-control marg-bot-5' placeholder='".$l->admin_pay_payents2."'/>";
                            echo "<input type='text' class='form-control marg-bot-15' placeholder='".$l->admin_pay_payents2_1."'/>";
                          }else{
                            echo "<b class='left marg-bot-5'>".$payment_meth."</b><br/>";
                            echo "<input type='text' class='pay_payment_info form-control' value='".$payment_info."'/>";
                            echo "<input type='text' class='pay_payment_info_name form-control marg-top-5' value='".$payment_info_name."'/>";
                            echo "<input type='text' class='pay_payment_topay form-control marg-top-5' placeholder='".$l->admin_pay_payents2."'/>";
                            echo "<input type='text' class='pay_payment_topay2 form-control marg-top-5 marg-bot-15' placeholder='".$l->admin_pay_payents2_1."'/>";
                          }

                          echo "<div payment_num='".$result_count."' user='".$channel_uuid."' class='pay_payments blue_btn btn-default btn marg-bot-15 w-100'>".$l->admin_pay_payents1."</div>";

                        }else{
                          echo "ERROR NO PAYMENT INFOS";
                          $payment_meth = 0;
                        }
                      echo "</div>";
                    }

                  }//end if this month payed


                }//end test limit
              }//end while
                ?>

                <script>
                  $('.ad_part_payments_xmr_pay').click( function(){
                    var ad_part_open = $(this).attr('ad_part_open');


                    if($('.ad_part_payments_to_pay_box_'+ad_part_open).hasClass("hide")){
                      $('.ad_part_payments_to_pay_box').addClass('hide');
                      $('.ad_part_payments_to_pay_box_'+ad_part_open).removeClass('hide');
                    }else{
                      $('.ad_part_payments_to_pay_box').addClass('hide');
                    }

                  });

                  $('.pay_payments').click( function(){
                    var payment_num = $(this).attr('payment_num');
                    var user        = $(this).attr('user');
                    var payment_1   = $('.ad_part_payments_to_pay_box_'+payment_num+' .pay_payment_info').val();
                    var payment_3   = $('.ad_part_payments_to_pay_box_'+payment_num+' .pay_payment_topay').val();
                    var payment_4   = $('.ad_part_payments_to_pay_box_'+payment_num+' .pay_payment_topay2').val();

                    $.post('../admin/pay_payments',{'payment_1': '<?php echo $payment_meth; ?>', 'payment_3': payment_3, 'payment_4': payment_4, 'user': user },function(data){
                      alert(data);
                    });

                  });

                </script>

                <div style="clear:both"> </div>
							</div>
						</div>
				</div>
				<div class='col-lg-2 col-xl-2 col-spl'> </div>
			</div>



<?php if($infram != 1){?>
		</div>

	</body>
</html>

<?php  }

}else{//if partner
    Header('Location: '.$_dhp.'r/error404');
  }

}else{//if logged in
	Header('Location: '.$_dhp.'r/error404');
}
?>
