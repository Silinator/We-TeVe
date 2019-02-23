<?php

		/*if(isset($_GET['v'])){
			$video_vuid = $_GET['v'];
		}else{
			$channel_design = mysqli_query($db_link, "SELECT * FROM channel_design WHERE user_id = '$channel_id'");
			$channel_design = mysqli_fetch_assoc($channel_design); //gibt nur ein ergebniss raus!

			$video_vuid = $channel_design['vuid'];
			$vuid = $channel_design['vuid'];
		}*/


		$video_data_sql = db::$link->query("SELECT * FROM video_db WHERE vuid = '$video_vuid'");
		$data_row = $video_data_sql->fetch_assoc();

		$maxqualli 			= $data_row['max_result'];
		$org_resolution	= $data_row['org_resolution'];
		$video_size	= 		$data_row['size'];
		$datavuid 			= $data_row['datavuid'];
		$vuid 					= $data_row['vuid'];
		$long 					= $data_row['dauer'];


		//video_sizes
		$data = array();
		foreach (explode(",", $video_size) as $cLine) {
				list ($cKey, $cValue) = explode(':', $cLine, 2);
				$data[$cKey] = $cValue;
		}

		//add tmp view to check is video watche complete
				$time = date('H:i:s d-m-Y');
				$time = strtotime($time);


				//del all old tmps
				$m_24h_time = $time - 86400;
				$del_tmp = "DELETE FROM tmp_view_db WHERE time < '$m_24h_time'";
				$del_tmp = db::$link->query($del_tmp);

				//long_p = zeit zum add views
				//long gesamt zeit

				$long_p = round($long *15 / 100); //30% -> 15%

				if($long < 60){ //wenn Video kürzer als 1min
					$long_p = $long; //dann muss es ganz geschaut werden
				}

				if($long < 2){ //wenn das video kürzer ist als 2 sekunden
					$long_p = $long + 2;
				}


				if($long_p > 600){ //wenn 15% des Videos länger als 10min sind
					$long_p = 600; //muss es nur 10min geschaut werden
				}

				$long_p = $long_p - 2; //tolerranz wegen rendering



				$video_p_time = $time + $long_p;

				if($isUserLoggedIn === 1) {
					$user = $user_uuid;
				}else{
					$user = getenv("REMOTE_ADDR");
				}

				$sql_data = db::$link->query("SELECT tmp_id,user,time FROM tmp_view_db WHERE vuid = '$video_vuid' AND user = '$user'");
				$get_v_data = $sql_data->fetch_assoc();
				$check_id = $get_v_data['tmp_id'];

				if($check_id == ""){
					$add_tmp_view = "INSERT INTO tmp_view_db
								(vuid,user,time)
								VALUES
								('$video_vuid','$user','$video_p_time')";
					$add_tmp_view = db::$link->query($add_tmp_view);
				}

		if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
			if(isset($_COOKIE['result'])){
				$def_result = $_COOKIE['result'];
			}else{
				$def_result = "360";
			}
		}else{
			$def_result = "360";
		}

		if($maxqualli >= $def_result)
		{
			$defaultqualli = $def_result;
		}
		else
		{
			$defaultqualli = $maxqualli;
		}

		/*$resul = $defaultqualli;
			if(isset($data[$resul."p"])){
				$defaultqualli = $resul;
			}else{
				if($resul == "2160")		 	{ $defaultqualli = "1440";
				}elseif($resul == "1440")	{ $defaultqualli = "1080";
				}elseif($resul == "1080")	{ $defaultqualli = "720";
				}elseif($resul == "720")	{ $defaultqualli = "480";
				}elseif($resul == "480")	{	$defaultqualli = "360";
				}elseif($resul == "360")	{ $defaultqualli = "240";
				}elseif($resul == "240")	{ $defaultqualli = "120";
				}else 										{ $defaultqualli = "120";
				}
			}*/

		function test_avio_qualli($data,$qualli,$try){
			if($try < 7){
				if(isset($data[$qualli."p"])){
					$defaultqualli = $qualli;
				}else{
					if($try == "1"){
						//pairs: 120p | 240p/360p | 480p/720p | 1080p/1440p | 2160p
						if($qualli == "2160")		 	{ $qualli = "1440";
						}elseif($qualli == "1440"){ $qualli = "1080";
						}elseif($qualli == "1080"){ $qualli = "1440";
						}elseif($qualli == "720")	{ $qualli = "480";
						}elseif($qualli == "480")	{	$qualli = "720";
						}elseif($qualli == "360")	{ $qualli = "240";
						}elseif($qualli == "240")	{ $qualli = "360";
						}else 										{ $qualli = "120";
						}
						if(!isset($data[$qualli."p"]) AND $qualli != "120"){
							$try++;
							$defaultqualli = test_avio_qualli($data,$qualli,$try);
						}else{
							$defaultqualli = $qualli;
						}

					}else{
						if($qualli == "2160")		 	{ $qualli = "1440";
						}elseif($qualli == "1440"){ $qualli = "1080";
						}elseif($qualli == "1080"){ $qualli = "720";
						}elseif($qualli == "720")	{ $qualli = "480";
						}elseif($qualli == "480")	{	$qualli = "360";
						}elseif($qualli == "360")	{ $qualli = "240";
						}elseif($qualli == "240")	{ $qualli = "120";
						}else 										{ $qualli = "120";

						}
						if(!isset($data[$qualli."p"]) AND $qualli != "120"){
							$try++;
							$defaultqualli = test_avio_qualli($data,$qualli,$try);
						}else{
							$defaultqualli = $qualli;
						}

					}
				}
			}else{
				$defaultqualli = "120";
			}

			return $defaultqualli;
		}

		$defaultqualli = test_avio_qualli($data,$defaultqualli,"1");


		if($defaultqualli == "120"){
			$defaultqualli = "audioviso";
		}else{
			$defaultqualli = $defaultqualli."p";
		}

		$video_src = $_ddhp."videos/".$datavuid."/".$defaultqualli.".mp4";
		$thumb = $_ddhp."images/thumb/large_img/".$vuid.".jpg";

		if(isset($autoplay_embed)){$autoplay_emd = $autoplay_embed;}else{$autoplay_emd = "";}


		if(isset($_autoplay)){
			if($_autoplay == 1){
				$autoplay_tag = "autoplay";
			}else{
				$autoplay_tag = "";
			}
		}else{
			$autoplay_tag = "autoplay";
		}




		//autoplay
			if($isUserLoggedIn === 1) {
				$link_setting = db::$link->query("SELECT * FROM setting_db WHERE uuid = '$user_uuid'");
				$daten_setting = $link_setting->fetch_assoc();

					$autoplay = $daten_setting['autoplay'];

				if(isset($playlist_id)){
					if($playlist_id != "not_set"){
						$autoplay = 1;
					}
				}

			}else{
				$autoplay = 1;
			}


		if((isset($_autoplay) AND $_autoplay == 0) OR $is_channel_video == 1 ){
			$autoplay = 0;
			$autoreplay = 0;
		}

		echo "<div class='video_container'>";
			echo "<div class='video_container_u'>";

			if(isset($embed) AND $embed == 1){
				$autoplay = 0;
				$autoreplay = 0;
				if(isset($embed_autoplay)){$autoplay = $embed_autoplay;}
				if(isset($embed_autoreplay)){$autoreplay = $embed_autoreplay;}
				$video_frame = "vjs-fill";
				$video_hide = "";
			}else{
				$video_frame = "";
				$video_hide = "hide";

				echo "<div class='video_blac vjs-default-skin back_gray'> <img class='blac_thumb' src='".$thumb."' /> <span class='vjs-loading-spinner' style='display: inline;'></span> </div>";
			}

			if( $is_channel_video != 1){$player_name = "we-teve_video";}else{$player_name = "channel_video";}

			if($autoplay == 1){ $autoplay_text = "autoplay='autoplay'"; }else{ $autoplay_text = ""; }

				echo "<video id='".$player_name."' class='video-js ".$video_frame." ".$video_hide." vjs-default-skin no-padding' preload='auto' controls background-color='black'";
					echo  " poster='".$thumb."'";
					echo  " data-setup='{}' ".$autoplay_text;
					echo ">";
					echo  "<source src='".$video_src."' type='video/mp4' />";
					echo  "<p class='vjs-no-js'>To view this video please enable JavaScript, and consider upgrading to a web browser that - supports HTML5 video</p>";
					//echo "<track kind='captions' src='".$_dhp."captions/video1/de.vtt' srclang='de' label='Deutsch' />";
				echo "</video>";



	//video info

			$defaultvolume = "1";
			if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
				if(isset($_COOKIE['defaultvolume']))
				{

						if($_COOKIE['defaultvolume'] <= 1 AND $_COOKIE['defaultvolume'] >= 0 AND is_numeric($_COOKIE['defaultvolume']) == true){
							$defaultvolume = $_COOKIE['defaultvolume'];
						}else{

							$defaultvolume = "1";
							?>

								<script>
										Cookies.set('defaultvolume', 1, { expires: 100, path: '/',secure  : true});
										old_volume = 1;
								</script>
							<?php
						}
				}
				else
				{
					$defaultvolume = "1";
				}
			}else{
				$defaultvolume = "1";
			}

			//$time = $_GET['time'];
			$video_srcav = $_ddhp."videos/".$datavuid."/audioviso.mp4";
			$video_src240 = $_ddhp."videos/".$datavuid."/240p.mp4";
			$video_src360 = $_ddhp."videos/".$datavuid."/360p.mp4";
			$video_src480 = $_ddhp."videos/".$datavuid."/480p.mp4";
			$video_src720 = $_ddhp."videos/".$datavuid."/720p.mp4";
			$video_src1080 = $_ddhp."videos/".$datavuid."/1080p.mp4";
			$video_src1440 = $_ddhp."videos/".$datavuid."/1440p.mp4";
			$video_src2160 = $_ddhp."videos/".$datavuid."/2160p.mp4";

			$daten = db::$link->query("SELECT max_result,video_title FROM video_db WHERE vuid = '$video_vuid'");
			$daten = $daten->fetch_assoc();
			$max_result = $daten['max_result'];


			if(isset($data['2160p']))	{$value2160 = "2160,";}else{$value2160 = "";}
			if(isset($data['1440p']))	{$value1440 = "1440,";}else{$value1440 = "";}
			if(isset($data['1080p']))	{$value1080 = "1080,";}else{$value1080 = "";}
			if(isset($data['720p']))	{$value720 = "720,";}else{$value720 = "";}
			if(isset($data['480p']))	{$value480 = "480,";}else{$value480 = "";}
			if(isset($data['360p']))	{$value360 = "360,";}else{$value360 = "";}
			if(isset($data['240p']))	{$value240 = "240,";}else{$value240 = "";}
			$valueav = "120";

			$available_resolution = $value2160."".$value1440."".$value1080." ".$value720." ".$value480." ".$value360." ".$value240." ".$valueav;


			$video_info_title = htmlentities($daten['video_title'], ENT_QUOTES);
			if(!isset($vid_hud)){$vid_hud='show';}

			//video skip time von der URL
			if(isset($_GET['t']) AND is_numeric($_GET['t'])){
				$vid_sec = $_GET['t'];
				$skiptotext = " skipto='".$vid_sec."' ";
			}elseif(isset($_GET['pl']) AND $_GET['pl'] != "" ){
				$skiptotext = " skipto='0' ";
			}else{
				$skiptotext = "";
			}


			echo "<span class='vid_info hide' long_p='".$long_p."' vid_autoplay='".$autoplay."' long='".$long."' default_vol='".$defaultvolume."' default_result='".$defaultqualli."' available_resolution='".$available_resolution."' org_resolution='".$org_resolution	."' vid_hud='".$vid_hud."' video_title='".$video_info_title."' datavuid='".$datavuid."' ".$skiptotext." vuid='".$video_vuid."'></span>";
			echo "</div>"; //end video_container_u
	echo "</div>"; //end video_container


	echo "<script defer src='".$_dhp."js/vid".$min.".js'></script>";
	echo "<script defer src='".$_dhp."video/video".$min.".js'></script>";
	echo "<script defer src='".$_dhp."video/video-hotkey".$min.".js'></script>";

?>





<script>

if (/Firefox[\/\s](\d+\.\d+)/.test(navigator.userAgent)){ //test for Firefox/x.x or Firefox x.x (ignoring remaining digits);
 var ffversion=new Number(RegExp.$1) // capture x.x portion and store as a number
}else{
 var ffversion = 0;
}

var ua = window.navigator.userAgent;
var msie = ua.indexOf("MSIE ");
if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)){
	var internetwixxer = "1";
}

if((!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0){
	var opera = "1";
}else{
	var opera = "0";
}







var qualli;

var video_duration = '<?php echo $long; ?>';
var vid_play;
var played_time = 0;
var view_added;

</script>

<script>

/*
	if($('video').length > 0){
		//alert('baum');

					function vid_skip_to(sec){

						var vid = document.getElementsByTagName('video')[0];
						/if (internetwixxer == 1 || (ffversion <46 && ffversion> 30))  // If Internet Explorer, return version number
						{
							vid.addEventListener("canplay",function(){vid.currentTime = sec;});
						}/

							vid.currentTime = sec;
							vid.play();
					}

					function vid_pause(){
						vid.pause();
						return false;
					}
	}

*/


</script>
