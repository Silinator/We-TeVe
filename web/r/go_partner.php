<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet
$_hp = '../'; //für includes
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

//3. site vals
$html_title = $l->footertitle8.' | We-TeVe'; //Tap title

if(isset($_GET['sort'])){$sort=$_GET['sort'];}else{$sort='2';}


if($isUserLoggedIn === 1){

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
			<?php require_once ($_hp.'include/head.php'); ?>
		</head>
		<body id='body' class='body'>

		<?php require_once ($_hp.'include/navi.php'); ?>

		<div id='main_container' class='container main_container'>
<?php } ?>

		<span id='site_scripts'>
			<script class='check_js'></script>
			<script>


				var playlist_id = 'not_set';
				$(document).ready(function(){
					docready();
					sethtmltitle('<?php echo $html_title; ?>');
				});

			</script>

		</span>

		<div class='row'>
			<div class='hidden-xs col-sm-2 col-lg-2 col-xl-2'></div>
			<div class='col-xs-12 col-sm-8 col-lg-6 col-xl-6'>
			<div class='part_go_partner_step1'>
      <h1><?php echo $l->footertitle8; ?></h1>

			<?php
				echo $l->part_text_1."<br/><br/>";

				//alle Videos
					$video_needed = 3;
					$video_sql = db::$link->query("SELECT count(vuid) FROM video_db WHERE uuid = '$user_uuid' AND privacy = 'public' AND status = 'uploaded' LIMIT 3");
					$video_row = $video_sql->fetch_row();
					$all_public_videos = $video_row[0];


					echo "<div class='part_needs_line'>";
						if($all_public_videos >= $video_needed){
							echo "<span class='glyphicon glyphicon-ok blue part_needs_icon'></span> <div class='part_needs_main'> <span class='blue'>".$video_needed."/".$video_needed."</span> </div>".$l->part_needs_title_1;
						}else{
							echo "<span class='glyphicon glyphicon-remove red part_needs_icon'></span> <div class='part_needs_main'> <span class='red'>".$all_public_videos."/".$video_needed."</span> </div>".$l->part_needs_title_1;
						}
					echo "</div>";


				//video Aufrufe
					$s_views = "0";
					$views_needed = 100;
					$sql_s_info = db::$link->query("SELECT views FROM video_db WHERE uuid = '$user_uuid' AND status = 'uploaded' AND privacy = 'public'");
					while ($erg_s_info = $sql_s_info->fetch_array())
					{
						$s_views  = $s_views + $erg_s_info['views'];
					}

					echo "<div class='part_needs_line'>";
						if($s_views >= $views_needed){
							echo "<span class='glyphicon glyphicon-ok blue part_needs_icon'></span> <div class='part_needs_main'> <span class='blue'>".$views_needed."/".$views_needed."</span> </div>".$l->part_needs_title_2;
						}else{
							echo "<span class='glyphicon glyphicon-remove red part_needs_icon'></span> <div class='part_needs_main'> <span class='red'>".$s_views."/".$views_needed."</span> </div>".$l->part_needs_title_2;
						}
					echo "</div>";



				//level
					$level_needed = 30;
					$user_sql = db::$link->query("SELECT xp FROM user_find_db WHERE uuid = '$user_uuid'");
					$user_row = $user_sql->fetch_assoc();
						$user_xp = $user_row['xp'];
						$user_level = $lvl->lvlinfo('level',$user_xp);

					echo "<div class='part_needs_line'>";
						if($user_level >= $level_needed){
							echo "<span class='glyphicon glyphicon-ok blue part_needs_icon'></span> <div class='part_needs_main'> <span class='blue'>".$level_needed."/".$level_needed."</span> </div>".$l->part_needs_title_3;
						}else{
							echo "<span class='glyphicon glyphicon-remove red part_needs_icon'></span> <div class='part_needs_main'> <span class='red'>".$user_level."/".$level_needed."</span> </div>".$l->part_needs_title_3;
						}
					echo "</div>";

				//if not partner
				$user_sql = db::$link->query("SELECT partner_status FROM user_find_db WHERE uuid = '$user_uuid'");
			  $user_row = $user_sql->fetch_assoc();
			  if($user_row['partner_status'] == 0){

				//if anforderungen erfüllt:
				if($all_public_videos >= $video_needed AND $s_views >= $views_needed AND $user_level >= $level_needed){
					echo "<div class='part_go_partner_btn part_go_partner_btn1 marg-top-15'>".$l->part_go_partner_title."</div>";
					echo "</div>";

					?>
						<script>
							$('.part_go_partner_btn1').click(function(){
								$('.part_go_partner_step1').addClass('hide');
								$('.part_go_partner_step2').removeClass('hide');

								$('.part_go_partner_btn2').click(function(){
									if($('.part_akz_btn').is(':checked')) {
										$('.part_go_partner_step2').addClass('hide');
										$('.part_go_partner_step3').removeClass('hide');
									}


									$('.part_payment_btn1').click( function(){
										$('.part_payment_box1').removeClass('hide');
										$('.part_payment_box2').addClass('hide');
										$('.part_payment_box3').addClass('hide');
											if($('.part_payment_btn1').is(':checked')) {
												if($('.monero_adress').val().length > 0){
													$('.part_go_partner_btn3').removeClass('part_gray_btn');
												}else{
													$('.part_go_partner_btn3').addClass('part_gray_btn');
												}
											}
									});

									$('.part_payment_btn2').click( function(){
										$('.part_payment_box2').removeClass('hide');
										$('.part_payment_box1').addClass('hide');
										$('.part_payment_box3').addClass('hide');
											if($('.part_payment_btn2').is(':checked')) {
												if($('.paypal_adress').val().length > 0){
													$('.part_go_partner_btn3').removeClass('part_gray_btn');
												}else{
													$('.part_go_partner_btn3').addClass('part_gray_btn');
												}
											}
									});

									$('.part_payment_btn3').click( function(){
										$('.part_payment_box3').removeClass('hide');
										$('.part_payment_box1').addClass('hide');
										$('.part_payment_box2').addClass('hide');
											if($('.part_payment_btn3').is(':checked')) {
												if($('.bank_adress').val().length > 0 && $('.bank_adress_name').val().length > 0){
													$('.part_go_partner_btn3').removeClass('part_gray_btn');
												}else{
													$('.part_go_partner_btn3').addClass('part_gray_btn');
												}
											}
									});

										$('.pay_in_form').keyup(function() { 						test_pay_embty(); });
										$('.pay_in_form').click(function() { 						test_pay_embty(); });
										$('.pay_in_form').change(function() { 					test_pay_embty(); });
										$('.pay_in_form').on('paste drop', function() { test_pay_embty(); });
										$('.pay_in_form').on('cut', function() { 				test_pay_embty(); });

										function test_pay_embty(){

											if($('.part_payment_btn1').is(':checked')) {
												if($('.monero_adress').val().length > 0){
													$('.part_go_partner_btn3').removeClass('part_gray_btn');
												}else{
													$('.part_go_partner_btn3').addClass('part_gray_btn');
												}
											}

											if($('.part_payment_btn2').is(':checked')) {
												if($('.paypal_adress').val().length > 0){
													$('.part_go_partner_btn3').removeClass('part_gray_btn');
												}else{
													$('.part_go_partner_btn3').addClass('part_gray_btn');
												}
											}

											if($('.part_payment_btn3').is(':checked')) {
												if($('.bank_adress').val().length > 0 && $('.bank_adress_name').val().length > 0){
													$('.part_go_partner_btn3').removeClass('part_gray_btn');
												}else{
													$('.part_go_partner_btn3').addClass('part_gray_btn');
												}
											}

											$('.error').addClass('hide');

										}

										$('.part_go_partner_btn3').click( function(){
											// final insert
											if($('.part_payment_btn1').is(':checked')) {
												var payment_info = $('.monero_adress').val();
												var payment_info_name = "";
												var payment_meth = "monero";
											}
											if($('.part_payment_btn2').is(':checked')) {
												var payment_info = $('.paypal_adress').val();
												var payment_info_name = "";
												var payment_meth = "paypal";
											}
											if($('.part_payment_btn3').is(':checked')) {
												var payment_info = $('.bank_adress').val();
												var payment_info_name = $('.bank_adress_name').val();
												var payment_meth = "iban";
											}

											payment_info = payment_info.replace(/[\u00A0-\u9999<>\&]/gim, function(i) { return '&#'+i.charCodeAt(0)+';'; });
											payment_info_name = payment_info_name.replace(/[\u00A0-\u9999<>\&]/gim, function(i) { return '&#'+i.charCodeAt(0)+';'; });

											$.post('../partner/set_partner',{'payment_info': payment_info, 'payment_info_name': payment_info_name, 'payment_meth': payment_meth },function(data){
												if(data == "ok"){
													gotosite('../partner/dashboard','',0);
												}else if(data == "error1"){
													$('.part_error1').removeClass('hide');
												}else if(data == "error2"){
													$('.part_error2').removeClass('hide');
												}else{
													$('.part_error2').removeClass('hide');
												}

											});

										});

								});

								$('.part_akz_btn').click( function(){
									$('.part_go_partner_btn2').toggleClass('part_gray_btn');
								});

							});
						</script>
					<?php

					echo "<div class='part_go_partner_step2 hide'>";
						echo "<h2>".$l->part_terms_of_use_titel."</h2>";
						echo $l->part_terms_of_use_text;
						echo "<br/><div class='checkbox'>
							<label><input class='part_akz_btn checkbox' type='checkbox'>".$l->part_go_partner_title2."</label>
						</div>";
						echo "<div class='part_go_partner_btn part_gray_btn part_go_partner_btn2 marg-top-15'>".$l->part_go_partner_title3."</div>";
					echo "</div>";


					echo "<div class='part_go_partner_step3 hide'>";
						echo "<h2>".$l->part_payment_infos_title."</h2>";

						echo "<br/><div class='radiobtn'>
							<label><input class='part_payment_btn part_payment_btn1 radio-inline' checked='' name='payments_meth' type='radio'>".$l->part_payment_infos_title1."</label>
						</div>";
							echo "<div class='part_payment_box1'>
									<input type='text' class='monero_adress pay_in_form form-control' placeholder='".$l->part_payment_infos_text1."'/>

								</div>
							";

						echo "<br/><div class='radiobtn'>
							<label><input class='part_payment_btn part_payment_btn2 radio-inline' name='payments_meth' type='radio'>".$l->part_payment_infos_title2."</label>
						</div>";
							echo "<div class='part_payment_box2 hide'>
									<input type='text' class='paypal_adress pay_in_form form-control' placeholder='".$l->part_payment_infos_text2."'/>

								</div>
							";


						echo "<br/><div class='radiobtn'>
							<label><input class='part_payment_btn part_payment_btn3 radio-inline' name='payments_meth' type='radio'>".$l->part_payment_infos_title3."</label>
						</div>";
							echo "<div class='part_payment_box3 hide'>
									<input type='text' class='bank_adress pay_in_form form-control' placeholder='".$l->part_payment_infos_text3."'/>
									<input type='text' class='bank_adress_name pay_in_form form-control marg-top-5' placeholder='".$l->part_payment_infos_text3_1."'/>
								</div>
							";
						echo "<br/>";

						echo "<div class='error part_error hide'>".$l->part_payment_error."</div>";
						echo "<div class='error part_error1 hide'>".$l->part_payment_error1."</div>";
						echo "<div class='error part_error2 hide'>".$l->part_payment_error2."</div>";

						echo "<div class='part_go_partner_btn part_gray_btn part_go_partner_btn3'>".$l->part_go_partner_title4."</div>";
					echo "</div>";

				}else{
					echo "</div>";
				}

			}else{
				?>
					<script>gotosite('../partner/dashboard','',1);</script>
				<?php
			}
			?>

		</div>
		<div class='hidden-xs col-sm-2 col-lg-4 col-xl-4'></div>
	</div>
</div>

<?php if($infram != 1){?>
</div>
</body>
</html>
<?php }

}else{
  echo "<script>gotosite('".$_dhp."login','',1);</script>";
}
?>
