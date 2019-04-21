<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet
$_hp = '../'; //für includes
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ('../include/all_include.php'); //haupt include

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

if($isUserLoggedIn != 1 AND isset($_SESSION['user_login'])){
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
					<a href='<?php echo $_dhp;?>login/' data-sbs='1'><h3><?php echo $l->login_title_0; ?></h3></a>
				</div>
				<div class='login menu'>
					<a href='<?php echo $_dhp;?>registry/' data-sbs='1' ><h3><?php echo $l->regin_title_0; ?></h3></a>
				</div>
				<div class='login clear other-color pad-15' id='login_content'>

					<div class='form-group'>

          <?php
					if(isset($_GET['f']) AND $_GET['f'] == "regin"){
						echo $l->login_goregin_text;
					}else{
						echo $l->login_gologin_text;
					}
					?></br></br>
					<?php echo $l->login_text_1." ";?><span id='send_code' class='underline pointer hover_blue'><?php echo $l->login_text_2 ;?></span>

					<input type='text' class='marg-top-15 form-control' id='bc' placeholder='<?php echo $l->login_title_4; ?>' required="">
					<div id='bc_error' class='error marg-top-5'></div>
					</div>

					<div id='go_login' type='submit' class='blue_btn button button-txt marg-top-15'>
						<?php
						echo "<span class='login_text'>".$l->login_title_0."</span>";
						echo "<span class='load_more_loading hide'><img src='".$_dhp."images/icons/ajax-loader.gif' alt='We-Teve'/> ".$l->loading."</span>";
						?>
					</div>

				</div>
			</div>
			<div class='col-xs-0 col-md-3'>
			</div>
			</div>

			<script>
				$('#go_login').click(function() { go_login_click(); });
				$('#login_content').keyup(function (e){ if (e.keyCode === 13) { go_login_click(); } return false; });


				function go_login_click(){
            //pw error
            $('#bc').removeClass('error');
            $('#bc_error').html('');

            $(".load_more_loading").removeClass('hide');
            $('.login_text').addClass('hide');

            var bc = $('#bc').val();

            $.post('c_login', {'BECO': bc }, function(data) {

              if(data == "go"){

                var backsite = '<?php if(isset($_POST['backsite'])){echo $_POST['backsite'];} ?>';
                  if(backsite != ""){
                    var url = backsite; //one site back or start page
                  }else{
                    var url = "../index";
                  }
                    gotosite(url,'','1');

              }else if(data == "3_bc_error"){

                setTimeout(function () {
                  //bc error
                  $('#bc').addClass('error');
									$('#bc_error').removeClass('blue');
									$('#bc_error').addClass('error');
                  $('#bc_error').html('<?php echo $l->login_alert6; ?>');

                  $(".load_more_loading").addClass('hide');
                  $('.login_text').removeClass('hide');
                }, 500);

              }else if(data == "2_bc_error" || data == "1_bc_error"){

                setTimeout(function () {

                  var errors = data.charAt(0);

                  //bc error
                  $('#bc').addClass('error');
									$('#bc_error').removeClass('blue');
									$('#bc_error').addClass('error');
                  $('#bc_error').html('<?php echo $l->login_alert7; ?> '+errors+'/3');

                  $(".load_more_loading").addClass('hide');
                  $('.login_text').removeClass('hide');
                }, 500);


              }

            });

            return false;
				}


				$('#send_code').click(function() {

						$('#bc').removeClass('error');
						$('#bc_error').html('');

						<?php if(isset($_GET['f']) AND $_GET['f'] == "regin"){ echo "var reco = 1;"; }else{ echo "var reco = 0;"; }?>

						$.post('c_login', {'SEBE': 1, 'RECO': reco }, function(data) {
							if(data == "ok"){

								$('#bc_error').removeClass('error');
								$('#bc_error').addClass('blue');
								$('#bc_error').html('<?php echo $l->login_text_3; ?>');

							}else if(data == "error"){

								$('#bc_error').removeClass('blue');
								$('#bc_error').addClass('error');
								$('#bc_error').html('<?php echo $l->error_text;?>');

							}
						});

				});



			</script>


<?php
}else{
	echo "<script>gotosite('../index');</script>";
}
if($infram != 1){?>
		</div>
	</body>
</html>
<?php }?>
