<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = "../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include


//3. site vals
$html_title = $l->opt_title_0." | We-TeVe"; //Tap title


if($isUserLoggedIn === 1){

//4. check ist inframed (von andererseite geladen)
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
              <h3><?php echo $l->opt_title_0; ?>:</h3>
              <a href='../options/' load='new' class='opt_a opt_activ'> <?php echo $l->opt_title_1; ?> </a>
							<a href='linked' load='new' class='opt_a'> <?php echo $l->opt_title_2; ?> </a>
						</div>


						<div class='col-lg-10 col-xl-10'>
							<div class='option_content option_holder'>
								<h3><?php echo $l->opt_title_1; ?>:</h3>

								<?php
									$user_mail = $u->userin('mail',0,'this','');
									$user_land = $u->userin('land',0,'this','');
									$user_lang = $u->userin('lang',0,'this','');

									$settings_sql = db::$link->query("SELECT * FROM setting_db WHERE uuid = '$user_uuid'");
									$settings_row = $settings_sql->fetch_assoc();

									//land
									$land_name = "land_".$user_land;
									$$land_name = 1;

									//lang
									$lang_name = "lang_".$user_lang;
									$$lang_name = 1;

								?>

								<div class='row'>
									<div class='col-md-12 col-xl-12'> <div class='opt_linetitle'> <?php echo $l->opt_acctitle_0." (".$l->opt_acc_alert_1.")"; ?>: </div> </div>
									<div class='col-md-12 col-xl-12'>
										<input type='text' class='form-control' id='username' value='<?php echo $user_name; ?>' placeholder='<?php echo $l->regin_title_1; ?>' onkeyup='check_error(this.id);' onchange='check_error(this.id);'>
										<div class='error error_texts marg-top-5' id='username_error'></div>
										<div at='' class='google_sign_in to_hide hide'>
											<div id='g_sign-in' class='btn blue_btn left g_sign-in'><?php echo $l->regin_title_1_1; ?></div>
											<div class='google_sign_in_text marg-top-5 marg-l-5 left to_hide hide'><?php echo $l->regin_title_1_2; ?></div>
										</div>
									</div>

									<div class='col-md-12 col-xl-3'> <div class='opt_linetitle'> <?php echo $l->opt_acctitle_1; ?>: </div> </div>
									<div class='col-md-12 col-xl-9'>
										<input type='email' class='form-control' id='mail' value='<?php echo $user_mail; ?>' placeholder='<?php echo $l->regin_title_3; ?>' onkeyup='check_error(this.id);' onchange='check_error(this.id);'>
										<div class='error error_texts marg-top-5' id='mail_error'></div>
									</div>
										<div class='opt_new_email to_hide hide'>
											<div class='col-md-12 col-xl-3'> <div class='opt_linetitle'> <?php echo $l->opt_acctitle_1_1; ?>: </div> </div>
											<div class='col-md-12 col-xl-9'>
												<input type='text' class='form-control' id='new_email' placeholder='<?php echo $l->login_title_4;  ?>' onkeyup='check_error(this.id);' onchange='check_error(this.id);'>
												<div class='error error_texts marg-top-5' id='newemail_error'></div>
											</div>
										</div>


										<div class='col-md-12 col-xl-12'> <div class='opt_pw_change_btn opt_linetitle'> <?php echo $l->opt_acctitle_2; ?> <span class='opt_pw_change_btn_icon marg-l-5 glyphicon glyphicon-chevron-left'> </span> </div> </div>

										<div class='opt_pw_change hide'>
											<div  class='col-md-12 col-xl-3'> <div class='opt_linetitle marg-l-15'> <?php echo $l->opt_acctitle_2_1; ?>: </div> </div>
												<div class='col-md-12 col-xl-9'>
													<input type='password' class='form-control' id='pw1' placeholder='<?php echo $l->regin_title_4; ?>' onkeyup='check_error(this.id);' onchange='check_error(this.id);'>
													<div class='error error_texts marg-top-5'  id='pw1_error'></div>
												</div>
											<div class='col-md-12 col-xl-3'> <div class='opt_linetitle marg-l-15'> <?php echo $l->opt_acctitle_2_2; ?>: </div> </div>
												<div class='col-md-12 col-xl-9 marg-bot-15'>
													<input type='password' class='form-control' id='pw2' placeholder='<?php echo $l->regin_title_5; ?>' onkeyup='check_error(this.id);' onchange='check_error(this.id);'>
													<div class='error error_texts marg-top-5' id='pw2_error'></div>
												</div>
										</div>

									<div class='col-md-12 col-xl-3'> <div class='opt_linetitle '> <?php echo $l->opt_acctitle_3; ?>: </div> </div>
										<div class='col-md-12 col-xl-9'>
											<select class='col-xs-12 col-md-12 col-spl dropdown opt_dropdown' name='country' id='land' onchange='check_error(this.id);'>
												<option value="0" disabled='' selected=''><?php echo $l->regin_title_10; ?></option>
												<option value="eg" <?php if(isset($land_eg)){ echo "selected=''"; } ?>><?php echo $l->land_label_eg; ?></option>
												<option value="dz" <?php if(isset($land_dz)){ echo "selected=''"; } ?>><?php echo $l->land_label_dz; ?></option>
												<option value="ar" <?php if(isset($land_ar)){ echo "selected=''"; } ?>><?php echo $l->land_label_ar; ?></option>
												<option value="au" <?php if(isset($land_au)){ echo "selected=''"; } ?>><?php echo $l->land_label_au; ?></option>
												<option value="bh" <?php if(isset($land_bh)){ echo "selected=''"; } ?>><?php echo $l->land_label_bh; ?></option>
												<option value="be" <?php if(isset($land_be)){ echo "selected=''"; } ?>><?php echo $l->land_label_be; ?></option>
												<option value="ba" <?php if(isset($land_ba)){ echo "selected=''"; } ?>><?php echo $l->land_label_ba; ?></option>
												<option value="br" <?php if(isset($land_br)){ echo "selected=''"; } ?>><?php echo $l->land_label_br; ?></option>
												<option value="bg" <?php if(isset($land_bg)){ echo "selected=''"; } ?>><?php echo $l->land_label_bg; ?></option>
												<option value="cl" <?php if(isset($land_cl)){ echo "selected=''"; } ?>><?php echo $l->land_label_cl; ?></option>
												<option value="dk" <?php if(isset($land_dk)){ echo "selected=''"; } ?>><?php echo $l->land_label_dk; ?></option>
												<option value="de" <?php if(isset($land_de)){ echo "selected=''"; } ?>><?php echo $l->land_label_de; ?></option>
												<option value="ee" <?php if(isset($land_ee)){ echo "selected=''"; } ?>><?php echo $l->land_label_ee; ?></option>
												<option value="fi" <?php if(isset($land_fi)){ echo "selected=''"; } ?>><?php echo $l->land_label_fi; ?></option>
												<option value="fr" <?php if(isset($land_fr)){ echo "selected=''"; } ?>><?php echo $l->land_label_fr; ?></option>
												<option value="ge" <?php if(isset($land_ge)){ echo "selected=''"; } ?>><?php echo $l->land_label_ge; ?></option>
												<option value="gh" <?php if(isset($land_gh)){ echo "selected=''"; } ?>><?php echo $l->land_label_gh; ?></option>
												<option value="gr" <?php if(isset($land_gr)){ echo "selected=''"; } ?>><?php echo $l->land_label_gr; ?></option>
												<option value="hk" <?php if(isset($land_hk)){ echo "selected=''"; } ?>><?php echo $l->land_label_hk; ?></option>
												<option value="in" <?php if(isset($land_in)){ echo "selected=''"; } ?>><?php echo $l->land_label_in; ?></option>
												<option value="id" <?php if(isset($land_id)){ echo "selected=''"; } ?>><?php echo $l->land_label_id; ?></option>
												<option value="iq" <?php if(isset($land_iq)){ echo "selected=''"; } ?>><?php echo $l->land_label_iq; ?></option>
												<option value="ie" <?php if(isset($land_ie)){ echo "selected=''"; } ?>><?php echo $l->land_label_ie; ?></option>
												<option value="is" <?php if(isset($land_is)){ echo "selected=''"; } ?>><?php echo $l->land_label_is; ?></option>
												<option value="il" <?php if(isset($land_il)){ echo "selected=''"; } ?>><?php echo $l->land_label_il; ?></option>
												<option value="it" <?php if(isset($land_it)){ echo "selected=''"; } ?>><?php echo $l->land_label_it; ?></option>
												<option value="jm" <?php if(isset($land_jm)){ echo "selected=''"; } ?>><?php echo $l->land_label_jm; ?></option>
												<option value="jp" <?php if(isset($land_jp)){ echo "selected=''"; } ?>><?php echo $l->land_label_jp; ?></option>
												<option value="ye" <?php if(isset($land_ye)){ echo "selected=''"; } ?>><?php echo $l->land_label_ye; ?></option>
												<option value="jo" <?php if(isset($land_jo)){ echo "selected=''"; } ?>><?php echo $l->land_label_jo; ?></option>
												<option value="ca" <?php if(isset($land_ca)){ echo "selected=''"; } ?>><?php echo $l->land_label_ca; ?></option>
												<option value="kz" <?php if(isset($land_kz)){ echo "selected=''"; } ?>><?php echo $l->land_label_kz; ?></option>
												<option value="qa" <?php if(isset($land_qa)){ echo "selected=''"; } ?>><?php echo $l->land_label_qa; ?></option>
												<option value="ke" <?php if(isset($land_ke)){ echo "selected=''"; } ?>><?php echo $l->land_label_ke; ?></option>
												<option value="co" <?php if(isset($land_co)){ echo "selected=''"; } ?>><?php echo $l->land_label_co; ?></option>
												<option value="hr" <?php if(isset($land_hr)){ echo "selected=''"; } ?>><?php echo $l->land_label_hr; ?></option>
												<option value="kw" <?php if(isset($land_kw)){ echo "selected=''"; } ?>><?php echo $l->land_label_kw; ?></option>
												<option value="lv" <?php if(isset($land_lv)){ echo "selected=''"; } ?>><?php echo $l->land_label_lv; ?></option>
												<option value="lb" <?php if(isset($land_lb)){ echo "selected=''"; } ?>><?php echo $l->land_label_lb; ?></option>
												<option value="li" <?php if(isset($land_li)){ echo "selected=''"; } ?>><?php echo $l->land_label_li; ?></option>
												<option value="lt" <?php if(isset($land_lt)){ echo "selected=''"; } ?>><?php echo $l->land_label_lt; ?></option>
												<option value="lu" <?php if(isset($land_lu)){ echo "selected=''"; } ?>><?php echo $l->land_label_lu; ?></option>
												<option value="mk" <?php if(isset($land_mk)){ echo "selected=''"; } ?>><?php echo $l->land_label_mk; ?></option>
												<option value="my" <?php if(isset($land_my)){ echo "selected=''"; } ?>><?php echo $l->land_label_my; ?></option>
												<option value="ma" <?php if(isset($land_ma)){ echo "selected=''"; } ?>><?php echo $l->land_label_ma; ?></option>
												<option value="mx" <?php if(isset($land_mx)){ echo "selected=''"; } ?>><?php echo $l->land_label_mx; ?></option>
												<option value="me" <?php if(isset($land_me)){ echo "selected=''"; } ?>><?php echo $l->land_label_me; ?></option>
												<option value="np" <?php if(isset($land_np)){ echo "selected=''"; } ?>><?php echo $l->land_label_np; ?></option>
												<option value="nz" <?php if(isset($land_nz)){ echo "selected=''"; } ?>><?php echo $l->land_label_nz; ?></option>
												<option value="nl" <?php if(isset($land_nl)){ echo "selected=''"; } ?>><?php echo $l->land_label_nl; ?></option>
												<option value="ng" <?php if(isset($land_ng)){ echo "selected=''"; } ?>><?php echo $l->land_label_ng; ?></option>
												<option value="no" <?php if(isset($land_no)){ echo "selected=''"; } ?>><?php echo $l->land_label_no; ?></option>
												<option value="om" <?php if(isset($land_om)){ echo "selected=''"; } ?>><?php echo $l->land_label_om; ?></option>
												<option value="at" <?php if(isset($land_at)){ echo "selected=''"; } ?>><?php echo $l->land_label_at; ?></option>
												<option value="pw" <?php if(isset($land_pw)){ echo "selected=''"; } ?>><?php echo $l->land_label_pw; ?></option>
												<option value="pk" <?php if(isset($land_pk)){ echo "selected=''"; } ?>><?php echo $l->land_label_pk; ?></option>
												<option value="pe" <?php if(isset($land_pe)){ echo "selected=''"; } ?>><?php echo $l->land_label_pe; ?></option>
												<option value="ph" <?php if(isset($land_ph)){ echo "selected=''"; } ?>><?php echo $l->land_label_ph; ?></option>
												<option value="pl" <?php if(isset($land_pl)){ echo "selected=''"; } ?>><?php echo $l->land_label_pl; ?></option>
												<option value="pt" <?php if(isset($land_pt)){ echo "selected=''"; } ?>><?php echo $l->land_label_pt; ?></option>
												<option value="pr" <?php if(isset($land_pr)){ echo "selected=''"; } ?>><?php echo $l->land_label_pr; ?></option>
												<option value="ro" <?php if(isset($land_ro)){ echo "selected=''"; } ?>><?php echo $l->land_label_ro; ?></option>
												<option value="ru" <?php if(isset($land_ru)){ echo "selected=''"; } ?>><?php echo $l->land_label_ru; ?></option>
												<option value="sa" <?php if(isset($land_sa)){ echo "selected=''"; } ?>><?php echo $l->land_label_sa; ?></option>
												<option value="se" <?php if(isset($land_se)){ echo "selected=''"; } ?>><?php echo $l->land_label_se; ?></option>
												<option value="ch" <?php if(isset($land_ch)){ echo "selected=''"; } ?>><?php echo $l->land_label_ch; ?></option>
												<option value="sn" <?php if(isset($land_sn)){ echo "selected=''"; } ?>><?php echo $l->land_label_sn; ?></option>
												<option value="rs" <?php if(isset($land_rs)){ echo "selected=''"; } ?>><?php echo $l->land_label_rs; ?></option>
												<option value="zw" <?php if(isset($land_zw)){ echo "selected=''"; } ?>><?php echo $l->land_label_zw; ?></option>
												<option value="sg" <?php if(isset($land_sg)){ echo "selected=''"; } ?>><?php echo $l->land_label_sg; ?></option>
												<option value="sk" <?php if(isset($land_sk)){ echo "selected=''"; } ?>><?php echo $l->land_label_sk; ?></option>
												<option value="si" <?php if(isset($land_si)){ echo "selected=''"; } ?>><?php echo $l->land_label_si; ?></option>
												<option value="es" <?php if(isset($land_es)){ echo "selected=''"; } ?>><?php echo $l->land_label_es; ?></option>
												<option value="lk" <?php if(isset($land_lk)){ echo "selected=''"; } ?>><?php echo $l->land_label_lk; ?></option>
												<option value="za" <?php if(isset($land_za)){ echo "selected=''"; } ?>><?php echo $l->land_label_za; ?></option>
												<option value="kr" <?php if(isset($land_kr)){ echo "selected=''"; } ?>><?php echo $l->land_label_kr; ?></option>
												<option value="tw" <?php if(isset($land_tw)){ echo "selected=''"; } ?>><?php echo $l->land_label_tw; ?></option>
												<option value="tz" <?php if(isset($land_tz)){ echo "selected=''"; } ?>><?php echo $l->land_label_tz; ?></option>
												<option value="th" <?php if(isset($land_th)){ echo "selected=''"; } ?>><?php echo $l->land_label_th; ?></option>
												<option value="cz" <?php if(isset($land_cz)){ echo "selected=''"; } ?>><?php echo $l->land_label_cz; ?></option>
												<option value="tn" <?php if(isset($land_tn)){ echo "selected=''"; } ?>><?php echo $l->land_label_tn; ?></option>
												<option value="tr" <?php if(isset($land_tr)){ echo "selected=''"; } ?>><?php echo $l->land_label_tr; ?></option>
												<option value="ug" <?php if(isset($land_ug)){ echo "selected=''"; } ?>><?php echo $l->land_label_ug; ?></option>
												<option value="ua" <?php if(isset($land_ua)){ echo "selected=''"; } ?>><?php echo $l->land_label_ua; ?></option>
												<option value="hu" <?php if(isset($land_hu)){ echo "selected=''"; } ?>><?php echo $l->land_label_hu; ?></option>
												<option value="us" <?php if(isset($land_us)){ echo "selected=''"; } ?>><?php echo $l->land_label_us; ?></option>
												<option value="ae" <?php if(isset($land_ae)){ echo "selected=''"; } ?>><?php echo $l->land_label_ae; ?></option>
												<option value="gb" <?php if(isset($land_gb)){ echo "selected=''"; } ?>><?php echo $l->land_label_gb; ?></option>
												<option value="vn" <?php if(isset($land_vn)){ echo "selected=''"; } ?>><?php echo $l->land_label_vn; ?></option>
												<option value="by" <?php if(isset($land_by)){ echo "selected=''"; } ?>><?php echo $l->land_label_by; ?></option>
											</select>
										</div>

									<div class='col-md-12 col-xl-3'> <div class='opt_linetitle'> <?php echo $l->opt_acctitle_4; ?>: </div> </div>
										<div class='col-md-12 col-xl-9'>
											<select class='col-xs-12 col-md-12 col-spl dropdown opt_dropdown' name='language' id='lang' onchange='check_error(this.id);'>
												<option value="0" disabled='' selected=''><?php echo $l->regin_title_10; ?></option>
												<option value="de" <?php if(isset($lang_de)){ echo "selected=''"; } ?>><?php echo $l->lang_label_de;?></option>
												<option value="en" <?php if(isset($lang_en)){ echo "selected=''"; } ?>><?php echo $l->lang_label_en;?></option>
											</select>
										</div>

									<div class='col-md-12 col-xl-12 marg-top-15'> <div class='opt_linetitle'> <?php echo $l->opt_acctitle_10; ?>: </div> </div>
										<div class='col-md-12 col-xl-12'>
											<input type='password' class='form-control' id='pw_to_save' placeholder='<?php echo $l->regin_title_4; ?>' onkeyup='check_error(this.id);' onchange='check_error(this.id);'>
											<div class='error error_texts marg-top-5 marg-bot-10'  id='pw_to_save_error'></div>
										</div>

									<div style='clear:both'></div>
									<div class='col-md-12 col-xl-12'>
										<div id='submit' type='submit' class='button blue_btn regin_button button-txt'>
											<?php
												echo "<span class='login_text'>".$l->save."</span>";
												echo "<span class='load_more_loading hide'><img src='".$_dhp."images/icons/ajax-loader.gif' alt='We-Teve'/> ".$l->loading."</span>";
											?>
										</div>
									</div>

								</div>

								<script>
									$('.opt_pw_change_btn').click( function(){
										if($('.opt_pw_change_btn_icon').hasClass('glyphicon-chevron-left')){
											$('.opt_pw_change_btn_icon').removeClass('glyphicon-chevron-left');
											$('.opt_pw_change_btn_icon').addClass('glyphicon-chevron-down');
											$('.opt_pw_change').removeClass('hide');
										}else{
											$('.opt_pw_change_btn_icon').addClass('glyphicon-chevron-left');
											$('.opt_pw_change_btn_icon').removeClass('glyphicon-chevron-down');
											$('.opt_pw_change').addClass('hide');
										}
									});

									//directCheck
									function check_error(id){
										if(id == 'pw1' || id == 'pw2'){

											if($('#pw2').val() != ''){
												if($('#pw1').val() != $('#pw2').val()){ $('#pw1').addClass('error'); 			$('#pw2').addClass('error'); 		$('#pw2_error').html('<?php echo $l->regin_alert_11; ?>');}
												if($('#pw1').val() == $('#pw2').val()){ $('#pw1').removeClass('error');		$('#pw2').removeClass('error');	$('#pw2_error').html('');}
											}

										}

										if(id == 'username'){
											if($('#username').val().length > 25){	$('#username').addClass('error'); 		$('#username_error').html('<?php echo $l->regin_alert_2; ?>');}
											if($('#username').val().length < 26){	$('#username').removeClass('error'); 	$('#username_error').html('');}
											if($('#username').val() == ''){				$('#username').addClass('error'); 		$('#username_error').html('<?php echo $l->regin_alert_0; ?>');}

											var testusername = $('#username').val().replace(/[^a-zA-Z0-9_-]/g,'');
											if(testusername.length != $('#username').val().length) { $('#username').addClass('error'); $('#username_error').html('<?php echo $l->regin_alert_3; ?>'); }
										}
									}
									//end.directCheck

									$('#submit').click(function() { send(); });
									function send(){
										if ($("#submit").hasClass("disabled")) {}else{

											$(".load_more_loading").removeClass('hide');
											$('.login_text').addClass('hide');

											$('.to_hide').addClass('hide');

											$('.error_texts').html('');
											$('.form-control').removeClass('error');

										//disable btn
										$('#submit').addClass('disabled');

									//vars
										var username = $('#username').val();
										var mail = $('#mail').val();
										var new_mail_code = $('#new_email').val();

										var pw1 = $('#pw1').val();
										var pw2 = $('#pw2').val();
										var new_pwd = sha256(pw1);

										var pw_to_save = $('#pw_to_save').val();
										var pwd = sha256(pw_to_save);

										var land = $('#land option:selected').val();
										var lang = $('#lang option:selected').val();

									//end.vars


									//alerts
										var error = 0, error1 = false, error2 = false, error3 = false, error03 = false, error4 = false, error5 = false, error6 = false, error7 = false, error8 = false, error9 = false, error10 = false, error11 = false, error12 = false, error13 = false, error14 = false;
										if(username == ""){ 									error1  = true; error = 1;}
										if(mail == ""){ 	 										error2  = true; error = 1;}
										if(pw_to_save == ""){ 	 							error3  = true; error = 1;}

										if(land == "0"){  										error7  = true; error = 1;}
										if(lang == "0"){  										error8  = true; error = 1;}

										if($('#username').val().length > 25){	error11 = true; error = 1;}
										if(pw1 != pw2){												error12 = true; error = 1;}

										var testusername = username.replace(/[^a-zA-Z0-9_-]/g,'');
										if(testusername.length != username.length) { error13 = true; error = 1; }

										if(pw1 != ""){
											if($('#pw1').val().length < 8){ 			error14 = true; error = 1;}
										}
									//end.alert


										if(error == 0){

											//Send to check function
											var at = $('.google_sign_in').attr('at');
											$.post('save', {'username':username, 'at':at, 'mail':mail, 'new_mail_code': new_mail_code, 'pwd':pwd,'new_pwd':new_pwd,  'land':land, 'lang':lang }, function(data) {

												if(data == '11') { setTimeout(function () { $('#username').addClass('error');		 	$('#username_error').html('<?php echo $l->regin_alert_2; ?>'); 	},300); }
												if(data == '12') { setTimeout(function () { $('#username').addClass('error');		 	$('#username_error').html('<?php echo $l->regin_alert_0; ?>'); 	},300); }
												if(data == '13') { setTimeout(function () { $('#username').addClass('error');		 	$('#username_error').html('<?php echo $l->regin_alert_3; ?>'); 	},300); }
												if(data == '14') { setTimeout(function () { $('#username').addClass('error');		 	$('#username_error').html('<?php echo $l->regin_alert_1; ?>'); 	},300); }
												if(data == '15') { setTimeout(function () { $('#username').addClass('error');		 	$('.google_sign_in').removeClass('hide'); $('#username_error').html('<?php echo $l->regin_alert_6; ?>'); 	},300); }
												if(data == '16') { setTimeout(function () { $('#username').addClass('error');		 	$('.google_sign_in').removeClass('hide'); $('#username_error').html('<?php echo $l->regin_alert_7; ?>'); 	},300); }


												if(data == '18') { setTimeout(function () { $('#username').addClass('error');		 	$('#username_error').html('<?php echo $l->opt_acc_alert_1_1; ?>'); 	},300); }

												if(data == '21') { setTimeout(function () { $('#mail').addClass('error');		 			$('#mail_error').html('<?php echo $l->regin_alert_0; ?>'); 	},300); }
												if(data == '22') { setTimeout(function () { $('#mail').addClass('error');		 			$('#mail_error').html('<?php echo $l->regin_alert_8; ?>'); 	},300); }
												if(data == '23') { setTimeout(function () { $('#mail').addClass('error');		 			$('#mail_error').html('<?php echo $l->regin_alert_9; ?>'); 	},300); }
												if(data == '24') { setTimeout(function () { $('.opt_new_email').removeClass('hide');$('#mail_error').html('<?php echo $l->opt_acc_alert_4; ?>'); },300); }


												if(data == '31') { setTimeout(function () { $('#pw_to_save').addClass('error');		$('#pw_to_save_error').html('<?php echo $l->regin_alert_4; ?>'); 	},300); }
												if(data == '32') { setTimeout(function () { $('#pw_to_save').addClass('error');		$('#pw_to_save_error').html('<?php echo $l->opt_acc_alert_3; ?>'); 	},300); }

												if(data == '51') { setTimeout(function () { $('#land').addClass('error');		 			$('#land').html('<?php echo $l->regin_alert_0; ?>'); 	},300); }
												if(data == '61') { setTimeout(function () { $('#lang').addClass('error');		 			$('#lang_error').html('<?php echo $l->regin_alert_0; ?>'); 	},300); }

												if(data == "new_pw") { setTimeout(function () { gotosite('<?php echo $_dhp;?>login','',1); },300); }

												setTimeout(function () {
													$('#submit').removeClass('disabled');
													$(".load_more_loading").addClass('hide');
													$('.login_text').removeClass('hide');
												},300);

											});

										}else{
											if(error1  == true){ setTimeout(function () { $('#username').addClass('error'); 		$('#username_error').html('<?php echo $l->regin_alert_0; ?>'); 	},300); }
											if(error2  == true){ setTimeout(function () { $('#mail').addClass('error');		 			$('#mail_error').html('<?php echo $l->regin_alert_0; ?>'); 			},300); }
											if(error3  == true){ setTimeout(function () { $('#pw_to_save').addClass('error'); 	$('#pw_to_save_error').html('<?php echo $l->regin_alert_0; ?>'); 			},300); }

											if(error7  == true){ setTimeout(function () { $('#land').addClass('error'); 				$('#land_error').html('<?php echo $l->regin_alert_0; ?>'); 			},300); }
											if(error8  == true){ setTimeout(function () { $('#lang').addClass('error'); 				$('#lang_error').html('<?php echo $l->regin_alert_0; ?>'); 			},300); }
											if(error9  == true){ setTimeout(function () { $('#lang').addClass('error'); 				$('#lang_error').html('<?php echo $l->opt_acc_alert_2; ?>'); 			},300); }

											if(error11 == true){ setTimeout(function () { $('#username').addClass('error');		 	$('#username_error').html('<?php echo $l->regin_alert_2; ?>'); 	},300); }
											if(error12 == true){ setTimeout(function () { $('#pw1').addClass('error'); $('#pw2').addClass('error');		 	$('#pw2_error').html('<?php echo $l->regin_alert_11; ?>'); 			},300); }
											if(error13 == true){ setTimeout(function () { $('#username').addClass('error'); $('#username_error').html('<?php echo $l->regin_alert_3; ?>'); 			},300); }
											if(error14 == true){ setTimeout(function () { $('#pw1').addClass('error'); 					$('#pw1_error').html('<?php echo $l->regin_alert_4; ?>'); 			},300); }

										}//end if error == 0
									//end.function


										//last check
											//btn wieder cklickbar machen
										if(error == 0){
										}else{
											setTimeout(function () {
												$('#submit').removeClass('disabled');
												$(".load_more_loading").addClass('hide');
												$('.login_text').removeClass('hide');
											},500);
										}


											return false;
										}//end if disabled
									}
								</script>


									<script id='gjs' src="https://apis.google.com/js/api.js"></script>
									<script>
										var GoogleAuth;
										var SCOPE = 'https://www.googleapis.com/auth/youtube.readonly';


										;
										function handleClientLoad() {
											gapi.load('client:auth2', initClient);
										}

										function initClient() {
											var discoveryUrl = 'https://www.googleapis.com/discovery/v1/apis/youtubeAnalytics/v1/rest';

											gapi.client.init({
													'apiKey': _google_client_api,
													'discoveryDocs': [discoveryUrl],
													'clientId': _google_client_id,
													'scope': SCOPE
											}).then(function () {
												GoogleAuth = gapi.auth2.getAuthInstance();

												GoogleAuth.isSignedIn.listen(updateSigninStatus);
												var user = GoogleAuth.currentUser.get();
												setSigninStatus();

												// "Sign In/Authorize" button.
												$('#g_sign-in').click(function() {
													handleAuthClick();
												});
											});
										}

										function handleAuthClick() {
												GoogleAuth.signIn();
										}

										function revokeAccess() {
											GoogleAuth.disconnect();
										}

										function setSigninStatus(isSignedIn) {
											var user = GoogleAuth.currentUser.get();

											var isAuthorized = user.hasGrantedScopes(SCOPE);
											if (isAuthorized) {
												if(user['Zi'] != null){
													$('.google_sign_in').attr('at',user['Zi']['access_token']);
													$('.google_sign_in_text').removeClass('hide');
												}
											}else{

											}
										}

										function updateSigninStatus(isSignedIn) {
											setSigninStatus();
										}

									</script>

									<script async defer src="https://apis.google.com/js/api.js"
													onload="this.onload=function(){};handleClientLoad()"
													onreadystatechange="if (this.readyState === 'complete') this.onload()">
									</script>



							</div>
						</div>
				</div>
				<div class='col-lg-2 col-xl-2 col-spl'> </div>
			</div>

	</div>



<?php if($infram != 1){?>
		</div>

	</body>
</html>

<?php  }

}else{//if logged in
	Header('Location: '.$_dhp.'login');
}
?>
