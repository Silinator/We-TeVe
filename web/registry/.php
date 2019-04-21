<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet
$_hp = '../';
$_dhp = '../';

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ('../include/all_include.php'); //haupt include

//3. site vals
$html_title = $l->regin_title_0." | We-TeVe"; //Tap title

if(isset($_GET['sort'])){$sort=$_GET['sort'];}else{$sort='2';}


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
	<html lang='de'>
		<head>
			<?php require_once ($_hp.'include/head.php'); ?>
		</head>
		<body id='body' class='body'>


		<?php require_once ($_hp.'include/navi.php'); ?>

		<div id='main_container' class='container main_container'>
<?php }
if($isUserLoggedIn != 1){

?>

		<span id='site_scripts'>



			<script src='<?php echo $_dhp;?>js/sha256.js'></script>
			<script>
				$(document).ready(function() {
					var playlist_id = 'not_set';
					docready();
					sethtmltitle('<?php echo $html_title; ?>');
				});
			</script>
		</span>

		<div class='row'>
			<div class='col-xs-0 col-md-3'>
			</div>
			<div class='col-xs-12 col-md-6'>
				<div class='login menu'>
					<a href='../login/' data-sbs='<?php if(isset($_POST['backsite'])){echo $_POST['backsite'];} ?>'><h3><?php echo $l->login_title_0; ?></h3></a>
				</div>
				<div class='login menu active'>
					<a href='' data-sbs='<?php if(isset($_POST['backsite'])){echo $_POST['backsite'];} ?>'><h3><?php echo $l->regin_title_0; ?></h3></a>
				</div>
				<div class='login regin_content clear other-color pad-15'  id='regin_content'>
					<form>
					<div class='col-xs-12 col-spl'>
					<div class='form-group'>
					<input type='text' class='form-control' id='username' placeholder='<?php echo $l->regin_title_1; ?>' onkeyup='check_error(this.id);' onchange='check_error(this.id);'>
						<div class='error error_texts marg-top-5' id='username_error'></div>
						<div at='' class='google_sign_in to_hide hide'>
							<div id='g_sign-in' class='btn blue_btn left g_sign-in'><?php echo $l->regin_title_1_1; ?></div>
							<div class='google_sign_in_text marg-top-5 marg-l-5 left to_hide hide'><?php echo $l->regin_title_1_2; ?></div>
						</div>
					<div class='clear'></div>
					<input type='email' class='form-control marg-top-18' id='mail' placeholder='<?php echo $l->regin_title_3; ?>' onkeyup='check_error(this.id);' onchange='check_error(this.id);'>
						<div class='error error_texts marg-top-5' id='mail_error'></div>
					<input type='password' class='form-control marg-top-18' id='pw1' placeholder='<?php echo $l->regin_title_4; ?>' onkeyup='check_error(this.id);' onchange='check_error(this.id);'>
						<div class='error error_texts marg-top-5'  id='pw1_error'></div>
					<input type='password' class='form-control marg-top-18' id='pw2' placeholder='<?php echo $l->regin_title_5; ?>' onkeyup='check_error(this.id);' onchange='check_error(this.id);'>
						<div class='error error_texts marg-top-5' id='pw2_error'></div>
					</div>
					</div>
						<div class='col-xs-12 col-md-4 col-spl marg-top-18 pad-top-8'>
					<?php echo $l->regin_title_2; ?>:
						</div>
					<div class='col-xs-12 col-md-8 col-spl'>
					<input type='number' class='w-22 right marg-left-3p form-control marg-top-18' min='1900' id='date_year' placeholder='<?php echo $l->regin_title_2_03; ?>' onkeyup='check_error(this.id);' onchange='check_error(this.id);'>
						<select class='w-22 right marg-left-3p dropdown' name='date_month' id='date_month' onchange='check_error(this.id);'>
								<option value="0" disabled='' selected=''><?php echo $l->regin_title_2_02; ?></option>
								<option value="1"> <?php echo $l->monat_january; ?></option>
								<option value="2"> <?php echo $l->monat_february; ?></option>
								<option value="3"> <?php echo $l->monat_march; ?></option>
								<option value="4"> <?php echo $l->monat_april; ?></option>
								<option value="5"> <?php echo $l->monat_may; ?></option>
								<option value="6"> <?php echo $l->monat_june; ?></option>
								<option value="7"> <?php echo $l->monat_july; ?></option>
								<option value="8"> <?php echo $l->monat_august; ?></option>
								<option value="9"> <?php echo $l->monat_september; ?></option>
								<option value="10"><?php echo $l->monat_october; ?></option>
								<option value="11"><?php echo $l->monat_november; ?></option>
								<option value="12"><?php echo $l->monat_december; ?></option>
						</select>
					<input  type='number' class='w-22 right form-control right marg-top-18' id='date_day' min='1' max='31' placeholder='<?php echo $l->regin_title_2_01; ?>' onkeyup='check_error(this.id);' onchange='check_error(this.id);'>
						<div class='error error_texts marg-top-5' id='date_error'></div>

					</div>
						<div class='col-xs-12 col-md-4 col-spl marg-top-18 pad-top-8'>
							<?php echo $l->regin_title_6; ?>:
						</div>
						<div class='col-xs-12 col-md-8 col-spl'>
							<select class='col-xs-12 col-md-12 col-spl dropdown' name='country' id='land' onchange='check_error(this.id);'>
								<option value="0" disabled='' selected=''><?php echo $l->regin_title_10; ?></option>
								<option value="eg"><?php echo $l->land_label_eg; ?></option>
								<option value="dz"><?php echo $l->land_label_dz; ?></option>
								<option value="ar"><?php echo $l->land_label_ar; ?></option>
								<option value="au"><?php echo $l->land_label_au; ?></option>
								<option value="bh"><?php echo $l->land_label_bh; ?></option>
								<option value="be"><?php echo $l->land_label_be; ?></option>
								<option value="ba"><?php echo $l->land_label_ba; ?></option>
								<option value="br"><?php echo $l->land_label_br; ?></option>
								<option value="bg"><?php echo $l->land_label_bg; ?></option>
								<option value="cl"><?php echo $l->land_label_cl; ?></option>
								<option value="dk"><?php echo $l->land_label_dk; ?></option>
								<option value="de"><?php echo $l->land_label_de; ?></option>
								<option value="ee"><?php echo $l->land_label_ee; ?></option>
								<option value="fi"><?php echo $l->land_label_fi; ?></option>
								<option value="fr"><?php echo $l->land_label_fr; ?></option>
								<option value="ge"><?php echo $l->land_label_ge; ?></option>
								<option value="gh"><?php echo $l->land_label_gh; ?></option>
								<option value="gr"><?php echo $l->land_label_gr; ?></option>
								<option value="hk"><?php echo $l->land_label_hk; ?></option>
								<option value="in"><?php echo $l->land_label_in; ?></option>
								<option value="id"><?php echo $l->land_label_id; ?></option>
								<option value="iq"><?php echo $l->land_label_iq; ?></option>
								<option value="ie"><?php echo $l->land_label_ie; ?></option>
								<option value="is"><?php echo $l->land_label_is; ?></option>
								<option value="il"><?php echo $l->land_label_il; ?></option>
								<option value="it"><?php echo $l->land_label_it; ?></option>
								<option value="jm"><?php echo $l->land_label_jm; ?></option>
								<option value="jp"><?php echo $l->land_label_jp; ?></option>
								<option value="ye"><?php echo $l->land_label_ye; ?></option>
								<option value="jo"><?php echo $l->land_label_jo; ?></option>
								<option value="ca"><?php echo $l->land_label_ca; ?></option>
								<option value="kz"><?php echo $l->land_label_kz; ?></option>
								<option value="qa"><?php echo $l->land_label_qa; ?></option>
								<option value="ke"><?php echo $l->land_label_ke; ?></option>
								<option value="co"><?php echo $l->land_label_co; ?></option>
								<option value="hr"><?php echo $l->land_label_hr; ?></option>
								<option value="kw"><?php echo $l->land_label_kw; ?></option>
								<option value="lv"><?php echo $l->land_label_lv; ?></option>
								<option value="lb"><?php echo $l->land_label_lb; ?></option>
								<option value="li"><?php echo $l->land_label_li; ?></option>
								<option value="lt"><?php echo $l->land_label_lt; ?></option>
								<option value="lu"><?php echo $l->land_label_lu; ?></option>
								<option value="mk"><?php echo $l->land_label_mk; ?></option>
								<option value="my"><?php echo $l->land_label_my; ?></option>
								<option value="ma"><?php echo $l->land_label_ma; ?></option>
								<option value="mx"><?php echo $l->land_label_mx; ?></option>
								<option value="me"><?php echo $l->land_label_me; ?></option>
								<option value="np"><?php echo $l->land_label_np; ?></option>
								<option value="nz"><?php echo $l->land_label_nz; ?></option>
								<option value="nl"><?php echo $l->land_label_nl; ?></option>
								<option value="ng"><?php echo $l->land_label_ng; ?></option>
								<option value="no"><?php echo $l->land_label_no; ?></option>
								<option value="om"><?php echo $l->land_label_om; ?></option>
								<option value="at"><?php echo $l->land_label_at; ?></option>
								<option value="pw"><?php echo $l->land_label_pw; ?></option>
								<option value="pk"><?php echo $l->land_label_pk; ?></option>
								<option value="pe"><?php echo $l->land_label_pe; ?></option>
								<option value="ph"><?php echo $l->land_label_ph; ?></option>
								<option value="pl"><?php echo $l->land_label_pl; ?></option>
								<option value="pt"><?php echo $l->land_label_pt; ?></option>
								<option value="pr"><?php echo $l->land_label_pr; ?></option>
								<option value="ro"><?php echo $l->land_label_ro; ?></option>
								<option value="ru"><?php echo $l->land_label_ru; ?></option>
								<option value="sa"><?php echo $l->land_label_sa; ?></option>
								<option value="se"><?php echo $l->land_label_se; ?></option>
								<option value="ch"><?php echo $l->land_label_ch; ?></option>
								<option value="sn"><?php echo $l->land_label_sn; ?></option>
								<option value="rs"><?php echo $l->land_label_rs; ?></option>
								<option value="zw"><?php echo $l->land_label_zw; ?></option>
								<option value="sg"><?php echo $l->land_label_sg; ?></option>
								<option value="sk"><?php echo $l->land_label_sk; ?></option>
								<option value="si"><?php echo $l->land_label_si; ?></option>
								<option value="es"><?php echo $l->land_label_es; ?></option>
								<option value="lk"><?php echo $l->land_label_lk; ?></option>
								<option value="za"><?php echo $l->land_label_za; ?></option>
								<option value="kr"><?php echo $l->land_label_kr; ?></option>
								<option value="tw"><?php echo $l->land_label_tw; ?></option>
								<option value="tz"><?php echo $l->land_label_tz; ?></option>
								<option value="th"><?php echo $l->land_label_th; ?></option>
								<option value="cz"><?php echo $l->land_label_cz; ?></option>
								<option value="tn"><?php echo $l->land_label_tn; ?></option>
								<option value="tr"><?php echo $l->land_label_tr; ?></option>
								<option value="ug"><?php echo $l->land_label_ug; ?></option>
								<option value="ua"><?php echo $l->land_label_ua; ?></option>
								<option value="hu"><?php echo $l->land_label_hu; ?></option>
								<option value="us"><?php echo $l->land_label_us; ?></option>
								<option value="ae"><?php echo $l->land_label_ae; ?></option>
								<option value="gb"><?php echo $l->land_label_gb; ?></option>
								<option value="vn"><?php echo $l->land_label_vn; ?></option>
								<option value="by"><?php echo $l->land_label_by; ?></option>

							</select>
							<div class='error error_texts marg-top-5' id='land_error'></div>
						</div>

						<div class='col-xs-12 col-md-4 col-spl marg-top-18 pad-top-8'>
								<?php echo $l->regin_title_7; ?>:
						</div>
						<div class='col-xs-12 col-md-8 col-spl'>
							<select class='col-xs-12 col-md-12 col-spl dropdown' name='language' id='lang' onchange='check_error(this.id);'>
								<option value="0" disabled='' selected=''><?php echo $l->regin_title_10; ?></option>
								<option value="de"><?php echo $l->lang_label_de;?></option>
								<option value="en"><?php echo $l->lang_label_en;?></option>
							</select>
							<div class='error error_texts marg-top-5' id='lang_error'></div>
						</div>

						<div class='col-xs-12 col-md-4 col-spl marg-top-18 pad-top-8'>
								<?php echo $l->regin_title_8; ?>:
						</div>
						<div class='col-xs-12 col-md-8 col-spl'>
							<select class='col-xs-12 col-md-12 col-spl dropdown' name='channel-color' id='color' onchange='check_error(this.id);'>
								<option value="0" disabled='' selected=''><?php echo $l->regin_title_10; ?></option>
								<option value="1"><?php echo $l->color_blue; 	?></option>
								<option value="2"><?php echo $l->color_green; ?></option>
								<option value="3"><?php echo $l->color_red; 	?></option>
								<option value="4"><?php echo $l->color_orange;?></option>
								<option value="5"><?php echo $l->color_white; ?></option>
								<option value="6"><?php echo $l->color_black; ?></option>
							</select>
							<div class='error error_texts marg-top-5' id='color_error'></div>
						</div>

					<div class='clear pad-top-10 checkbox'>
					<label><input id='agb' class="checkbox" type='checkbox' onclick='check_error(this.id);'> <?php echo $l->regin_title_9; ?> <a target='_blank' href="<?php echo $_dhp; ?>r/terms"><?php echo $l->footertitle2; ?></a>.</label>
						<div class='error error_texts  marg-top-5' id='agb_error'></div>
					</div>
					<div id='submit' type='submit' class='button blue_btn regin_button button-txt marg-top-5'>
						<?php
						echo "<span class='login_text'>".$l->regin_title_0."</span>";
						echo "<span class='load_more_loading hide'><img src='".$_dhp."images/icons/ajax-loader.gif' alt='We-Teve'/> ".$l->loading."</span>";
						?>
					</div>
					</form>
				</div>
			</div>
			<div class='col-xs-0 col-md-3'>
			</div>
		</div>

		<script>
		 	$('#submit').click(function() { send(); });
			$('#regin_content').keyup(function (e) {if (e.keyCode === 13) { send(); } });

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
				var d = new Date();
				var year = d.getFullYear();

				var username = $('#username').val();
				var mail = $('#mail').val();
				var pw1 = $('#pw1').val();
				var pw2 = $('#pw2').val();
				var pwd = sha256(pw1);

				var date_day = $('#date_day').val();
				var date_month = $('#date_month option:selected').val();
				var date_year = $('#date_year').val();

				var land = $('#land option:selected').val();
				var lang = $('#lang option:selected').val();
				var color = $('#color option:selected').val();

				if($('#agb').is(':checked')) { var agb = 1; }else{ var agb = 0; }
			//end.vars


			//alerts
				var error = 0, error1 = false, error2 = false, error3 = false, error03 = false, error4 = false, error5 = false, error6 = false, error7 = false, error8 = false, error9 = false, error10 = false, error11 = false, error12 = false, error13 = false, error14 = false, error15 = false, error16 = false ;
				if(username == ""){ 									error1  = true; error = 1;}
				if(mail == ""){ 	 										error2  = true; error = 1;}
				if(pw1 == ""){  											error3  = true; error = 1;}
				if(pw2 == ""){  											error03 = true; error = 1;}

				if(date_day == ""){  									error4  = true; error = 1;}
				if(date_month == "0"){ 								error5  = true; error = 1;}
				if(date_year == ""){ 		 							error6  = true; error = 1;}

				if(land == "0"){  										error7  = true; error = 1;}
				if(lang == "0"){  										error8  = true; error = 1;}
				if(color == "0"){  										error9  = true; error = 1;}
				if(agb == 0){													error10 = true; error = 1;}

				if($('#username').val().length > 25){	error11 = true; error = 1;}
				if(pw1 != pw2){												error12 = true; error = 1;}

				var testusername = username.replace(/[^a-zA-Z0-9_-]/g,'');
				if(testusername.length != username.length) { error13 = true; error = 1; }

				if($('#pw1').val().length < 8){ 			error14 = true; error = 1;}
				if(date_day > 31 || date_day < 1){ 		error15 = true; error = 1;}
				if(date_year > year || date_year < 1900){error16 = true; error = 1;}

			//end.alert


				if(error == 0){

					//Send to check function
					var at = $('.google_sign_in').attr('at');
					$.post('c_regin', {'username':username,'at':at,'mail':mail,'pwd':pwd,'date_d':date_day,'date_m':date_month,'date_y':date_year,'land':land,'lang':lang,'color':color,'agb':agb}, function(data) {

						if(data == '11') { setTimeout(function () { $('#username').addClass('error');		 	$('#username_error').html('<?php echo $l->regin_alert_2; ?>'); 	},300); }
						if(data == '12') { setTimeout(function () { $('#username').addClass('error');		 	$('#username_error').html('<?php echo $l->regin_alert_0; ?>'); 	},300); }
						if(data == '13') { setTimeout(function () { $('#username').addClass('error');		 	$('#username_error').html('<?php echo $l->regin_alert_3; ?>'); 	},300); }
						if(data == '14') { setTimeout(function () { $('#username').addClass('error');		 	$('#username_error').html('<?php echo $l->regin_alert_1; ?>'); 	},300); }
						if(data == '15') { setTimeout(function () { $('#username').addClass('error');		 	$('.google_sign_in').removeClass('hide'); $('#username_error').html('<?php echo $l->regin_alert_6; ?>'); 	},300); }
						if(data == '16') { setTimeout(function () { $('#username').addClass('error');		 	$('.google_sign_in').removeClass('hide'); $('#username_error').html('<?php echo $l->regin_alert_7; ?>'); 	},300); }

						if(data == '21') { setTimeout(function () { $('#mail').addClass('error');		 			$('#mail_error').html('<?php echo $l->regin_alert_0; ?>'); 	},300); }
						if(data == '22') { setTimeout(function () { $('#mail').addClass('error');		 			$('#mail_error').html('<?php echo $l->regin_alert_8; ?>'); 	},300); }
						if(data == '23') { setTimeout(function () { $('#mail').addClass('error');		 			$('#mail_error').html('<?php echo $l->regin_alert_9; ?>'); 	},300); }

						if(data == '31') { setTimeout(function () { $('#pw1_error').addClass('error');		$('#pw1_error').html('<?php echo $l->regin_alert_4; ?>'); 	},300); }

						if(data == '41') { setTimeout(function () { $('#date_day').addClass('error'); $('#date_month').addClass('error'); $('#date_year').addClass('error'); $('#date_error').html('<?php echo $l->regin_alert_5; ?>'); 	},300); }
						if(data == '42') { setTimeout(function () { $('#date_day').addClass('error'); $('#date_month').addClass('error'); $('#date_year').addClass('error'); $('#date_error').html('<?php echo $l->regin_alert_51; ?>'); 	},300); }

						if(data == '51') { setTimeout(function () { $('#land').addClass('error');		 			$('#land').html('<?php echo $l->regin_alert_0; ?>'); 	},300); }
						if(data == '61') { setTimeout(function () { $('#lang').addClass('error');		 			$('#lang_error').html('<?php echo $l->regin_alert_0; ?>'); 	},300); }
						if(data == '71') { setTimeout(function () { $('#color').addClass('error');		 		$('#color_error').html('<?php echo $l->regin_alert_0; ?>'); 	},300); }
						if(data == '81') { setTimeout(function () { $('#agb').addClass('error');					$('#agb_error').html('<?php echo $l->regin_alert_00; ?>'); 	},300); }

						if(data == "ok") { setTimeout(function () { gotosite('<?php echo $_dhp;?>login/gologin?f=regin','<?php echo $_dhp;?>u/'+username,1); },300); }

						setTimeout(function () {
							$('#submit').removeClass('disabled');
							$(".load_more_loading").addClass('hide');
							$('.login_text').removeClass('hide');
						},300);

					});


				}else{
					if(error1  == true){ setTimeout(function () { $('#username').addClass('error'); 		$('#username_error').html('<?php echo $l->regin_alert_0; ?>'); 	},300); }
					if(error2  == true){ setTimeout(function () { $('#mail').addClass('error');		 			$('#mail_error').html('<?php echo $l->regin_alert_0; ?>'); 			},300); }
					if(error3  == true){ setTimeout(function () { $('#pw1').addClass('error'); 		 			$('#pw1_error').html('<?php echo $l->regin_alert_0; ?>'); 			},300); }
					if(error03 == true){ setTimeout(function () { $('#pw2').addClass('error'); 		 			$('#pw2_error').html('<?php echo $l->regin_alert_0; ?>'); 			},300); }
					if(error4  == true){ setTimeout(function () { $('#date_day').addClass('error'); 		$('#date_error').html('<?php echo $l->regin_alert_0; ?>'); 			},300); }
					if(error5  == true){ setTimeout(function () { $('#date_month').addClass('error'); 	$('#date_error').html('<?php echo $l->regin_alert_0; ?>'); 			},300); }
					if(error6  == true){ setTimeout(function () { $('#date_year').addClass('error'); 		$('#date_error').html('<?php echo $l->regin_alert_0; ?>'); 			},300); }
					if(error7  == true){ setTimeout(function () { $('#land').addClass('error'); 				$('#land_error').html('<?php echo $l->regin_alert_0; ?>'); 			},300); }
					if(error8  == true){ setTimeout(function () { $('#lang').addClass('error'); 				$('#lang_error').html('<?php echo $l->regin_alert_0; ?>'); 			},300); }
					if(error9  == true){ setTimeout(function () { $('#color').addClass('error');				$('#color_error').html('<?php echo $l->regin_alert_0; ?>'); 		},300); }
					if(error10 == true){ setTimeout(function () { $('#agb').addClass('error');					$('#agb_error').html('<?php echo $l->regin_alert_00; ?>'); 			},300); }

					if(error11 == true){ setTimeout(function () { $('#username').addClass('error');		 	$('#username_error').html('<?php echo $l->regin_alert_2; ?>'); 	},300); }
					if(error12 == true){ setTimeout(function () { $('#pw1').addClass('error'); $('#pw2').addClass('error');		 	$('#pw2_error').html('<?php echo $l->regin_alert_11; ?>'); 			},300); }
					if(error13 == true){ setTimeout(function () { $('#username').addClass('error'); $('#username_error').html('<?php echo $l->regin_alert_3; ?>'); 			},300); }
					if(error14 == true){ setTimeout(function () { $('#pw1').addClass('error'); 					$('#pw1_error').html('<?php echo $l->regin_alert_4; ?>'); 			},300); }

					if(error15 == true){ setTimeout(function () { $('#date_day').addClass('error');			$('#date_error').html('<?php echo $l->regin_alert_5; ?>'); 			},300); }
					if(error16 == true){ setTimeout(function () { $('#date_year').addClass('error');		$('#date_error').html('<?php echo $l->regin_alert_5; ?>');			},300); }



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


			//directCheck
			function check_error(id){

				if(id == 'date_day' || id == 'date_month' || id == 'date_year'){

					if($('#date_day').val() != '' && $('#date_month option:selected').val() != '00' && $('#date_year').val() != ''){$('#date_error').html(''); }else{ $('#date_error').html('<?php echo $l->regin_alert_0; ?>');}
					if($('#date_day').val() != ''){$('#date_day').removeClass('error');} 	if($('#date_month option:selected').val() != '00'){$('#date_month').removeClass('error');} 	if($('#date_year').val() != ''){$('#date_year').removeClass('error');}
					if($('#date_day').val() == ''){$('#date_day').addClass('error');} 		if($('#date_month option:selected').val() == '00'){$('#date_month').addClass('error');} 		if($('#date_year').val() == ''){$('#date_year').addClass('error');}

				}


				if(id != 'date_day' || id != 'date_month' || id != 'date_year'){

					if($('#'+id).val() == ''){  $('#'+id).addClass('error');	 		$('#'+id+'_error').html('<?php echo $l->regin_alert_0; ?>');}
					if($('#'+id).val() != ''){  $('#'+id).removeClass('error');		$('#'+id+'_error').html('');}

				}


				if(id == 'pw1' || id == 'pw2'){

					if($('#pw2').val() != ''){
						if($('#pw1').val() != $('#pw2').val()){ $('#pw1').addClass('error'); 			$('#pw2').addClass('error'); 		$('#pw2_error').html('<?php echo $l->regin_alert_11; ?>');}
						if($('#pw1').val() == $('#pw2').val()){ $('#pw1').removeClass('error');		$('#pw2').removeClass('error');	$('#pw2_error').html('');}
					}

				}

				if(id == 'agb'){
					if($('#agb').is(':checked')) { $('#agb_error').html(''); }else{ $('#agb_error').html('<?php echo $l->regin_alert_00; ?>'); }
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
						'apiKey': 'AIzaSyD8RngoYs5Upxx_1QNW0A_ZFBYr_jG7ET4',
						'discoveryDocs': [discoveryUrl],
						'clientId': '768260405565-r0m1uub3lrkhb6ndlf36h0fh9r083hvp.apps.googleusercontent.com',
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
					console.log('abort');
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

<?php

}else{
	echo "<script>gotosite('".$_dhp."index');</script>";
}
if($infram != 1){?>
		</div>
	</body>
</html>
<?php  }

?>
