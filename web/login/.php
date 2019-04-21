<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet
$_hp = '../'; //für includes
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

//3. site vals
$html_title = $l->login_title_0." | We-TeVe"; //Tap title


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
				<div class='login menu active'>
					<a href='' data-sbs='<?php if(isset($_POST['backsite'])){echo $_POST['backsite'];} ?>'><h3>Anmelden</h3></a>
				</div>
				<div class='login menu'>
					<a href='<?php echo $_dhp;?>registry/' load='new' data-sbs='<?php if(isset($_POST['backsite'])){echo $_POST['backsite'];} ?>' ><h3>Registrieren</h3></a>
				</div>
				<div class='login clear other-color pad-15' id='login_content'>
					<form>
					<div class='form-group'>
					<input type='email' class='form-control' id='email' placeholder='<?php echo $l->login_title_1; ?>' required="">
					<div id='email_error' class='error marg-top-5'></div>
					<input type='password' class='form-control marg-top-18' id='pwd' placeholder='<?php echo $l->login_title_2; ?>' required="">
					<div id='pwd_error' class='error marg-top-5'></div>
					</div>
					<div class='checkbox'>
					<label><input id='keeplogin' class="checkbox" type='checkbox'> <?php echo $l->login_title_3; ?></label>
					</div>
					<div id='go_login' type='submit' class='button blue_btn button-txt marg-top-5'>
						<?php
						echo "<span class='login_text'>".$l->login_title_0."</span>";
						echo "<span class='load_more_loading hide'><img src='".$_dhp."images/icons/ajax-loader.gif' alt='We-Teve'/> ".$l->loading."</span>";
						?>
					</div>
					</form>
				</div>
			</div>
			<div class='col-xs-0 col-md-3'>
			</div>
			</div>

			<script src='<?php echo $_dhp;?>js/sha256.js'></script>
			<script>
				$('#go_login').click(function() {  send(); });
				$('#login_content').keyup(function (e) {if (e.keyCode === 13) {send();} });

				function send(){
					if($('#email').val() != "" && $('#pwd').val() != ""){
						//emial error
						$('#email').removeClass('error');
						$('#email_error').html('');

						//pw error
						$('#pwd').removeClass('error');
						$('#pwd_error').html('');

						$(".load_more_loading").removeClass('hide');
						$('.login_text').addClass('hide');

						var bn = 		 $('#email').val();
						var pwd =	 		 $('#pwd').val();
						pwd = sha256(pwd);

						if($('#keeplogin').is(':checked')) {
							var kl = 1;
						}else{
							var kl = 0;
						}

						$.post('c_login', {'ASEG': bn, 'FAFR': pwd, 'KELO': kl}, function(data) {

							 if(data == "errormail"){
								 setTimeout(function () {
										//emial error
										$('#email').addClass('error');
										$('#email_error').html('<?php echo $l->login_alert4; ?>');

										//pw error
										$('#pwd').addClass('error');
										$('#pwd_error').html('<?php echo $l->login_alert5; ?>');

										$(".load_more_loading").hide();
										$('.login_text').show();
									}, 300);
								}else if(data == "error"){
									setTimeout(function () {
										//pw error
										$('#pwd').addClass('error');
										$('#pwd_error').html('<?php echo $l->login_alert5; ?>');

										$(".load_more_loading").addClass('hide');
										$('.login_text').removeClass('hide');
									}, 300)
							 }else if(data == "go"){

								 	var backsite = '<?php if(isset($_POST['backsite'])){echo $_POST['backsite'];} ?>';
										if(backsite != ""){
								 			var url = backsite; //one site back or start page
										}else{
											var url = "<?php echo $_dhp;?>index";
										}
								 			gotosite(url,'','1');

								}else if(data == "gologin"){

									var backsite = '<?php if(isset($_POST['backsite'])){echo $_POST['backsite'];} ?>';
										if(backsite != ""){
											var sbs = backsite; //one site back or start page
										}else{
											var sbs = "<?php echo $_dhp;?>index";
										}

 								 			gotosite('gologin',sbs,'0');

 								}else{
									setTimeout(function () {
										$(".load_more_loading").addClass('hide');
										$('.login_text').removeClass('hide');
									}, 300);
								}




						});

						return false;


					}else{

						//emial error
						$('#email').removeClass('error');
						$('#email_error').html('');

						//pw error
						$('#pwd').removeClass('error');
						$('#pwd_error').html('');

						$(".load_more_loading").removeClass('hide');
						$('.login_text').addClass('hide');


						setTimeout(function () {
							//emial error
							$('#email').addClass('error');
							$('#email_error').html('<?php echo $l->login_alert4; ?>');

							//pw error
							$('#pwd').addClass('error');
							$('#pwd_error').html('<?php echo $l->login_alert5; ?>');

							$(".load_more_loading").addClass('hide');
							$('.login_text').removeClass('hide');
						}, 500);
						return false;
					}

				}
			</script>


<?php
}else{
	echo "<script>gotosite('".$_dhp."index');</script>";
}
if($infram != 1){?>
		</div>
	</body>
</html>
<?php }
?>
