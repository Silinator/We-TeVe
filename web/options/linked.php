<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = "../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include


if($isUserLoggedIn === 1){

//3. site vals
$html_title = $l->opt_title_0." | We-TeVe"; //Tap title

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

			<?php require_once ($_hp.'include/coinhivescript.php'); ?>

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
						<div class='option_holder option_navi col-lg-4 col-xl-2 col-spl'>
              <h3><?php echo $l->opt_title_0; ?>:</h3>
              <a href='../options/' load='new' class='opt_a'> <?php echo $l->opt_title_1; ?> </a>
							<a href='linked' load='new' class='opt_a opt_activ'> <?php echo $l->opt_title_2; ?> </a>

						</div>
						<div class='col-lg-8 col-xl-10'>
							<div class='option_content option_holder'>
								<h3><?php echo $l->opt_title_2; ?>:</h3>

							<?php
								$results = db::$link->query("SELECT * FROM google_db WHERE uuid = '$user_uuid' AND status = 'ok'");
								$results2 = db::$link->query("SELECT * FROM google_db WHERE uuid = '$user_uuid' AND status = 'ok'");
								$res_row = $results2->fetch_assoc();
							?>
                <h5><?php echo $l->opt_title_2_1; ?>:</h5> <?php // verbundene google konten?>

                <div class='row g-konten_list'>
	                <?php
										if($res_row['uuid'] != ""){
			                  while($row = $results->fetch_array()){

			                    $key = "AIzaSyB0lfjskQyR175GlFxZoEyuBYdRW9Y0uiQ"; // -> from: https://console.cloud.google.com/apis/credentials?project=weteve-177204&hl=de&authuser=1 (user: CEO we-teve)
			                    $channel_id = $row['g_channel_id'];
			                    $ated_at = $row['data'];
			                    $ated_at = $t->invor($ated_at);


			                    $html = "https://www.googleapis.com/youtube/v3/channels?part=snippet&id=".$channel_id."&key=".$key; //'https://www.googleapis.com/youtube/v3/videos?id='.$video_id.'&key='.$key.'&part=snippet';
			                    $response = file_get_contents($html);
													if($response != ""){
				                    $decoded = json_decode($response, true);
				                    foreach ($decoded['items'] as $items) {
				                         $title       = $items['snippet']['title'];
				                         $avatar      = $items['snippet']['thumbnails']['default']['url'];
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
											echo "<span class='marg-l-15 red g_acc_to_hide'>".$l->opt_title_2_empty."</span>";
										}

										//errors
										echo "<span class='marg-l-15 red g_acc_error_1 hide'>".$l->opt_title_2_error."</span>";
										echo "<span class='marg-l-15 red g_acc_error_2 hide'>".$l->opt_title_2_error2."</span>";


	                 ?>
								 </div>

								 <div style="clear: both;"></div>

								 <h5><?php echo $l->opt_title_2_2; ?>:</h5> <?php // Weitere Konten verbnden ?>

								 		<div id='g_sign-in' class='btn blue_btn g_sign-in marg-bot-10'><?php echo $l->opt_title_2_2; ?></div>

							 			<div id="auth-status" style="display: inline; padding-left: 25px"></div>



							</div>
						</div>
				</div>
				<div class='col-lg-2 col-xl-2 col-spl'> </div>
			</div>

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
							$('.g_acc_error_1').addClass('hide');
							$('.g_acc_error_2').addClass('hide');
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
							$.post('addgkonto',{'at': user['Zi']['access_token']},function(data){
								if(data == "error"){
									//user not Authorized
									$('.g_acc_error_1').removeClass('hide');
								}else if(data == "already"){
									//user Authorized but already connected
									$('.g_acc_error_2').removeClass('hide');
								}else if(data != ""){
									//user Authorized but already connected
									$('.g-konten_list').html($('.g-konten_list').html() + data);
									$('.g_acc_to_hide').addClass('hide');
								}
							});
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

	</div>


<?php if($infram != 1){?>
		</div>

	</body>
</html>

<?php }

}else{//if logged in
	Header('Location: '.$_dhp.'login');
}
?>
