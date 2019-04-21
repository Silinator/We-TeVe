<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = ''; //für include
$_dhp = '/'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include


if(isset($_GET['v']) AND $_GET['v'] != ""){

	//video data
	$video_vuid = $_GET['v']; $video_vuid = mysqli_real_escape_string(db::$link,$video_vuid);
	$url = $_GET['v']; $url = mysqli_real_escape_string(db::$link,$url);

	$video_sql = db::$link->query("SELECT * FROM video_db WHERE vuid = '$video_vuid'");
	$video_row = $video_sql->fetch_assoc();


	if($video_row['vuid'] != ""){
		$v_error 				= 0;
		$video_datavuid = $video_row['datavuid'];
		$video_uuid 		= $video_row['uuid'];
		$video_description = $video_row['info'];
		$video_views 		= $video_row['views'];
		$video_max_result = $video_row['max_result'];
		$video_size 		= $video_row['size'];
		$video_pos_vote = $video_row['pos_vote'];
			$video_pos_vote_n   = number_format($video_pos_vote,0, ",", ".");
		$video_neg_vote = $video_row['neg_vote'];
			$video_neg_vote_n   = number_format($video_neg_vote,0, ",", ".");
		$video_date = $video_row['uploaddate'];

		$twitter_title = $video_row['video_title'];
		$html_title = mysqli_real_escape_string(db::$link,$video_row['video_title']);
		$video_title= htmlentities($video_row['video_title']);

		$video_tags   = htmlentities($video_row['tags'], ENT_QUOTES);

		$coin_name = $video_vuid;
	}else{
		$coin_name = "main";
		$html_title			= "404"; $video_title 		= "404";
		$video_vuid			= "404"; $video_description = "404";
		$url 						= "404";
		$v_error 				= 4;
	}

}else{
	$coin_name = "main";
	$html_title			= "404"; $video_title 		= "404";
	$video_vuid			= "404"; $video_description = "404";
	$url 						= "404";
	$v_error 				= 4;
}


//3. site vals
$html_title = $html_title." | We-TeVe"; //Tap title
$vid_like = $f->settoken('vid_like','blanc');

if(isset($_GET['sort'])){$sort=$_GET['sort'];}else{$sort='0';}


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

			$sonderzeichen = array(
				'<br>' => ' ',
			);
			$meta_video_description = str_replace(array_keys($sonderzeichen),
				array_values($sonderzeichen), $video_description);

			$meta_video_description = substr($meta_video_description,0,200);

			 $twitter_info = substr($f->normtext($meta_video_description),0,200);
			 if($video_max_result >= 480){
				 $twitter_mp4 = "480p.mp4";
			 }elseif($video_max_result >= 360){
				 $twitter_mp4 = "360p.mp4";
			 }else{
				 $twitter_mp4 = "240p.mp4";
			 }

			?>
			<meta name="title" contetn="<?php echo $video_title; ?>" />
			<meta name="description" content="<?php echo /*$t->normtime($video_date,'date')." - ". //das Datum wird von google  */ $f->normtext($meta_video_description); ?>" />
			<meta name="keywords" content="<?php echo $video_tags ?>" />

			<meta property="og:title" content="<?php echo $video_title; ?>" />
			<meta property="og:description" content="<?php echo /*$t->normtime($video_date,'date')." - ". //das Datum wird von google  */ $f->normtext($meta_video_description); ?>" />
			<meta property="og:url" content="https://www.We-TeVe.com/watch/<?php echo $video_vuid; ?>" />
			<meta property="og:image" content='<?php echo "https://www.We-TeVe.com/images/thumb/large_img/".$url.".jpg"; ?>' />
			<meta property="og:type" content="video.movie" />
			<meta property="og:video" content="https://www.We-TeVe.com/videos/<?php echo $video_datavuid."/".$twitter_mp4; ?>" />



			<?php //twitter card ?>
			<meta content='text/html; charset=UTF-8' http-equiv='Content-Type' />
			<meta name="twitter:card" content="player" />
			<meta name="twitter:site" content="@We-TeVe" />
			<meta name="twitter:title" content="<?php echo $video_title; ?>" />
			<meta name="twitter:description" content="<?php echo $twitter_info; ?>" />
			<meta name="twitter:image" content="https://www.We-TeVe.com/images/thumb/large_img/<?php echo $url; ?>.jpg" />
			<meta name="twitter:player" content="https://www.We-TeVe.com/embed/<?php echo $video_vuid; ?>&autoplay=false&t=0&fullscreenmenu=off" />
			<meta name="twitter:player:width" content="435" />
			<meta name="twitter:player:height" content="245" />
			<meta name="twitter:player:stream" content="https://www.We-TeVe.com/videos/<?php echo $video_datavuid."/".$twitter_mp4; ?>" />
			<meta name="twitter:player:stream:content_type" content="video/mp4" />

		</head>
		<body id='body' class='body'>

			<?php require_once ($_hp.'include/navi.php'); ?>


		<div id='main_container' class='container main_container'>
<?php	}?>

		<span id='site_scripts'>

			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = 'https://connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v2.11';
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>


			<script class="docready-script">
				<?php
				if(isset($_GET['pl'])){
					$playlist_id = mysqli_real_escape_string(db::$link,$_GET['pl']);
					$playlist_sql = db::$link->query("SELECT * FROM playlist_db WHERE puid = '$playlist_id'");
					$playlist_row = $playlist_sql->fetch_assoc();
						$pl_uuid    = $playlist_row['uuid'];
						$pl_privacy = $playlist_row['privacy'];
						$pl_status	= $playlist_row['status'];

						if($pl_status != 'public'){
							$playlist_id = "not_set";
						}

						if($pl_privacy == "0"){
							if($isUserLoggedIn === 1){
								if($pl_uuid != $user_uuid){
									$playlist_id = "not_set";
								}
							}else{
								$playlist_id= "not_set";
							}
						}

				}else{
					$playlist_id = "not_set";
				}

				?>

				var playlist_id = '<?php echo $playlist_id; ?>';

				$(document).unbind('ready').ready(function() {

					if( $('.miniplayer_watch_site .docready-script').length == false ){
						sethtmltitle('<?php echo $html_title; ?>');
					}
					loadfun_thumbpreview();
					docready();
				});

			</script>

		</span>


		<?php

		//video view rechte
		$can_show = 0;

			if($v_error != 4){
					$video_status 		= $video_row['status'];
					$video_privacy 		= $video_row['privacy'];
					$video_render_status 	= $video_row['render_status'];
					$video_max_result = $video_row['max_result'];


				if($video_privacy == 'public' OR $video_privacy == 'unlist' OR $video_privacy == 'friend'){
					if($video_status == 'uploaded'){
						$can_show = 1;
					}else{
						$v_error = 1; //not ready
					}
				}elseif($video_privacy == 'privat'){
					if($isUserLoggedIn === 1){
						if($video_uuid == $user_uuid){
							if($video_status == 'uploaded'){
								$can_show = 1;
							}else{
								$v_error = 1; //not ready
							}
						}else{
							$v_error = 2; //not allowed
						}
					}else{
						$v_error = 2; //not allowed
					}
				}elseif($video_privacy == 'planed'){
					if($isUserLoggedIn === 1){
						if($video_uuid == $user_uuid){
							if($video_status == 'uploaded'){
								$can_show = 1;
							}else{
								$v_error = 1; //not ready
							}
						}else{
							$v_error = 2; //not allowed
						}
					}else{
						$v_error = 2; //not allowed
					}
				}
			}


		if( $can_show == 1){
		?>




			<?php

			//video_user_date
				$video_uuif = sha1(sha1($video_uuid));

					$video_user_name 		 = $u->userin("name",0,$video_uuif,'');
					$video_user_subs 		 = $u->userin("abos",0,$video_uuif,'');
					$video_user_sub_n 	 = number_format($video_user_subs,0, ",", ".");
					$video_user_land     = $u->userin('land',0,$video_uuif,'');
					$video_user_xp       = $u->userin('xp',0,$video_uuif,'');



					//level
						$video_user_level   = $lvl->lvlinfo('level',$video_user_xp);
						$video_user_c_level = $lvl->lvlicon('c',$video_user_level);

					//land

			//avatar
				$video_user_avatar = $_dhp.$l->draw_avatar($video_uuid,"large");


			//Userinfos
				echo "
					<div class='row'>
						<div id='column1' class='col-spl col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-2 col-spl'>
						<div class='video_user_navi col-xl-12'>
							<div class='video_user_infos col-xs-12 col-xl-12'>";
								  $f->draw_user_preview($video_uuid,$_dhp);

					echo "<div class='user_down_info right glyphicon glyphicon-chevron-down'></div>
									<div class='float_line'>1</div>
								</div>";


							//Videovorschläge
							echo "<div class='video_user_navi_content'>";
								//Eigene Videovorschläge = 1 für ja
								$own_videos_preview = 0;

									$mfu_i = 0; //mfu = more from this user
									$more_from_user_sql = db::$link->query("SELECT * FROM video_db WHERE uuid = '$video_uuid' AND status = 'uploaded' AND privacy = 'public' AND vuid != '$video_vuid' ORDER BY uploaddate DESC");
									while ($more_from_user_row = $more_from_user_sql->fetch_array() AND $mfu_i < 3)
									{
										if($mfu_i == 0){
											echo "<div class='marg-l-15 marg-top-10 marg-bot-5'>".$l->watch_more_vids_user." <a href='".$_dhp."user/".$video_user_name."'>".$video_user_name."</a></div>";
										}

										$mfu_i++;
										if($own_videos_preview != 1){
											$mfu_video_title	= htmlentities($more_from_user_row['video_title']);
											$mfu_video_vuid		= $more_from_user_row['vuid'];
											$mfu_video_dauer	= $more_from_user_row['dauer'];

												echo "<div class=' col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-12 marg-bot-10 marg-top-5'>";
														echo $f->draw_video_pewview($mfu_video_vuid,1,'ver','',$_dhp,$_ddhp,'small','0');
												echo "</div>";
										}

									}

									echo "<div style='vlear:both;'></div>";

							echo "</div>";


					if($mfu_i == 0 OR $own_videos_preview == 1){


						//echo "own shit here";


					}


				echo "
					</div>
				</div>";
			//end column1


			//pm = popupmenu
				echo "
				<div class='watch_pop_up_menues'>
					<div class='pm_container_bg pm_to_hide hide'>
						<div class='col-spl col-xs-0 col-sm-1 col-md-2 col-lg-4 col-xl-3 col-spl'></div>
						<div class='pm_container col-xs-11 col-sm-10 col-md-8 col-lg-4 col-xl-5'>
							<div class='pm_title_container'>";
								if($isUserLoggedIn === 1){echo "<div class='pm_title pm_pl_title pm_to_hide hide'>".$l->pl_add_title0.":</div>";}
								echo "<div class='pm_title pm_dw_title pm_to_hide hide'>".$l->dw_title0.":</div>";
								echo "<div class='pm_title pm_rc_title pm_to_hide hide'>".$l->recoms_title1.":</div>";
								echo "<div class='pm_title pm_sh_title pm_to_hide hide'>".$l->sh_title0.":</div>";
									echo "<div class='pm_close_btn'><span class='glyphicon glyphicon-remove'></span></div>";
							echo "</div>";

								//playlist content
								if($isUserLoggedIn === 1){
								echo "<div class='pm_pl_container pm_to_hide hide'>";
									echo "<div class='pm_add_pl_error error w-100 pm_to_hide hide'>".$l->pl_error0."</div>";
									$plss = 0;
									$pl_results = db::$link->query("SELECT title,puid,privacy FROM playlist_db WHERE uuid = '$user_uuid' AND status = 'public' ORDER BY last_interaction DESC LIMIT 100");
										while($pl_row = $pl_results->fetch_array()){ $plss++;
											if($plss == 1){
												echo "<div>".$l->pl_add_title1.":</div>";
												echo "<div class='pm_scroll_container'>";
											}
											$pl_name = $pl_row['title']; $pl_puid = $pl_row['puid']; $privacy = $pl_row['privacy'];
											//ist video in playlist:
											$isvidinpl_sql = db::$link->query("SELECT puid FROM playlist_content_db WHERE puid = '$pl_puid' AND uuid = '$user_uuid' AND vuid = '$video_vuid' AND status = 'public'");
											$isvidinpl_row = $isvidinpl_sql->fetch_assoc();
											if($isvidinpl_row['puid'] != ""){$inplclass="pl_add_list_line_selectet"; $inplcheck="<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";}else{$inplclass=""; $inplcheck="<span class='glyphicon glyphicon-plus' aria-hidden='true'></span>";}

												echo"<div pl='".$pl_puid."' class='pl_add_list_line ".$inplclass." pl_".$pl_puid."'>";
													echo "<div class='pl_add_list_title no_overflow'>".$inplcheck.$pl_name."</div>" ;
													echo "<div class='pl_add_list_privacy'>";
														//0 = Privat
														//1 = Öffentlich
														//2 = Nicht gelistet
														//3 = Nur Freunde
														switch ($privacy) {
															case '0':
																echo "<i class='fa fa-lock' aria-hidden='true'></i>";
															break;

															case '1':
																echo "<span class='glyphicon glyphicon-globe' aria-hidden='true'></span>";
															break;

															case '2':
																echo "<i class='fa fa-unlock' aria-hidden='true'></i>";
															break;

															case '3':
																echo "<span class='glyphicon glyphicon-user' aria-hidden='true'></span>";
															break;
														}
													echo "</div>";
												echo "</div>";
										}
									if($plss == 0){
										echo "<div class='pm_scroll_container'>";
									}
								echo "</div>";

								//new pl
								echo "<div style='clear:both;'></div><br><div>".$l->pl_add_title2.":</div>";
								echo "<div class='pm_new_pl_error error w-100 pm_to_hide hide'>".$l->pl_error1."</div>";
									echo "<input pl_privacy='privat' class='form-control pm_new_pl' placeholder='".$l->pl_add_text."' type='text'/>";
									echo "<div class='pl_privacy'>";
										echo "<div title='".$l->up_privacy_title1."' priv='public' class='button priv_btn gray_btn left marg-r-5'><span class='glyphicon glyphicon-globe' aria-hidden='true'></span></div>";
										echo "<div title='".$l->up_privacy_title2."' priv='unlist' class='button priv_btn gray_btn left marg-r-5'><i class='fa fa-unlock' aria-hidden='true'></i></div>";
										echo "<div title='".$l->up_privacy_title3."' priv='friend' class='button priv_btn gray_btn left marg-r-5'><span class='glyphicon glyphicon-user' aria-hidden='true'></span></div>";
										echo "<div title='".$l->up_privacy_title4."' priv='privat' class='button priv_btn gray_btn left marg-r-5 priv_btn_sel activ'><i class='fa fa-lock' aria-hidden='true'></i></div>";
									echo "</div>";
									echo "<div class='pm_new_pl_btn'>".$l->pl_add_new_pl."</div>";

							echo "</div>";
						}
							//playlist Content end



							//download content
							echo "<div class='pm_dw_container pm_to_hide hide'>";
								echo "<div class='pm_scroll_container'>";
								$data = array();
								foreach (explode(",", $video_size) as $cLine) {
										list ($cKey, $cValue) = explode(':', $cLine, 2);
										$data[$cKey] = $cValue;
								}

								$download_title = $f->normtext($video_row['video_title']);
								$download_title = str_replace('.','',$download_title);

								echo "<div>".$l->dw_title1." (.mp4):</div>";

								if(isset($data['2160p'])){
									$vf_size = $data['2160p'] /1024 /1024; $vf_size = number_format($vf_size,2, ",", "."); //in Megabytes
									echo "<a href='".$_dhp."videos/".$video_datavuid."/2160p.mp4' target='_blank' download='".$download_title.".mp4' class='download_list_line'>";
										echo "<div class='download_list_title'><span class='glyphicon glyphicon-save' aria-hidden='true'></span>2160p</div>";
										echo "<div class='download_size'>".$vf_size." MB</div>";
									echo "</a>";
								}
								if(isset($data['1440p'])){
									$vf_size = $data['1440p'] /1024 /1024; $vf_size = number_format($vf_size,2, ",", ".");
									echo "<a href='".$_dhp."videos/".$video_datavuid."/1440p.mp4' target='_blank' download='".$download_title.".mp4' class='download_list_line'>";
										echo "<div class='download_list_title'><span class='glyphicon glyphicon-save' aria-hidden='true'></span>1440p</div>";
										echo "<div class='download_size'>".$vf_size." MB</div>";
									echo "</a>";
								}
								if(isset($data['1080p'])){
									$vf_size = $data['1080p'] /1024 /1024; $vf_size = number_format($vf_size,2, ",", ".");
									echo "<a href='".$_dhp."videos/".$video_datavuid."/1080p.mp4' target='_blank' download='".$download_title.".mp4' class='download_list_line'>";
										echo "<div class='download_list_title'><span class='glyphicon glyphicon-save' aria-hidden='true'></span>1080p</div>";
										echo "<div class='download_size'>".$vf_size." MB</div>";
									echo "</a>";
								}
								if(isset($data['720p'])){
									$vf_size = $data['720p'] /1024 /1024; $vf_size = number_format($vf_size,2, ",", ".");
									echo "<a href='".$_dhp."videos/".$video_datavuid."/720p.mp4' target='_blank' download='".$download_title.".mp4' class='download_list_line'>";
										echo "<div class='download_list_title'><span class='glyphicon glyphicon-save' aria-hidden='true'></span>720p</div>";
										echo "<div class='download_size'>".$vf_size." MB</div>";
									echo "</a>";
								}
								if(isset($data['480p'])){
									$vf_size = $data['480p'] /1024 /1024; $vf_size = number_format($vf_size,2, ",", ".");
									echo "<a href='".$_dhp."videos/".$video_datavuid."/480p.mp4' target='_blank' download='".$download_title.".mp4' class='download_list_line'>";
										echo "<div class='download_list_title'><span class='glyphicon glyphicon-save' aria-hidden='true'></span>480p</div>";
										echo "<div class='download_size'>".$vf_size." MB</div>";
									echo "</a>";
								}
								if(isset($data['360p'])){
									$vf_size = $data['360p'] /1024 /1024; $vf_size = number_format($vf_size,2, ",", ".");
									echo "<a href='".$_dhp."videos/".$video_datavuid."/360p.mp4' target='_blank' download='".$download_title.".mp4' class='download_list_line'>";
										echo "<div class='download_list_title'><span class='glyphicon glyphicon-save' aria-hidden='true'></span>360p</div>";
										echo "<div class='download_size'>".$vf_size." MB</div>";
									echo "</a>";
								}
								if(isset($data['240p'])){
									$vf_size = $data['240p'] /1024 /1024; $vf_size = number_format($vf_size,2, ",", ".");
									echo "<a href='".$_dhp."videos/".$video_datavuid."/240p.mp4' target='_blank' download='".$download_title.".mp4' class='download_list_line'>";
										echo "<div class='download_list_title'><span class='glyphicon glyphicon-save' aria-hidden='true'></span>240p</div>";
										echo "<div class='download_size'>".$vf_size." MB</div>";
									echo "</a>";
								}

									$vf_size = $data['audioviso'] /1024 /1024; $vf_size = number_format($vf_size,2, ",", ".");
									echo "<a href='".$_dhp."videos/".$video_datavuid."/audioviso.mp4' target='_blank' download='".$download_title.".mp4' class='download_list_line'>";
										echo "<div class='download_list_title'><span class='glyphicon glyphicon-save' aria-hidden='true'></span>".$l->dw_title3."</div>";
										echo "<div class='download_size'>".$vf_size." MB</div>";
									echo "</a>";


								echo "<div style='clear:both;'></div> <br><div>".$l->dw_title2." (.mp3):</div>";
								$vf_size = $data['audio'] /1024 /1024; $vf_size = number_format($vf_size,2, ",", ".");
								echo "<a href='".$_dhp."videos/".$video_datavuid."/audio.mp3' target='_blank' download='".$download_title.".mp3' class='download_list_line'>";
									echo "<div class='download_list_title'><span class='glyphicon glyphicon-save' aria-hidden='true'></span>".$l->dw_title2."</div>";
									echo "<div class='download_size'>".$vf_size." MB</div>";
								echo "</a>";

								echo "</div>";
							echo "</div>";
							//download Content end

							//share content
							echo "<div class='pm_sh_container pm_to_hide hide'>";
								echo "<div class='pm_scroll_container'>";

									echo "<div class='sh_qr_box col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4'>";
										echo "<div class='sh_title'>".$l->sh_title1.":</div>";
										//qr code = https://chart.googleapis.com/chart?chs=400x400&cht=qr&chl=http%3A%2F%2Fwww.we-teve.com%26t=123
										$qr_link = "https://www.We-TeVe.com/watch/".$video_vuid;
										$qr_src = "https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=".$qr_link;
										echo "<img class='sh_qr_link' base='".$qr_src."' src='".$qr_src."'/>";

										echo "<span class='sh_watch_time_qr noselect marg-top-15 checked'><input class='sh_time_check_qr' type='checkbox' checked>	".$l->bm_new_text." <span class='sh_time_val_qr' type='text' time='84'>00:01:24</span></span>";

									echo "</div><br>";

									echo "<div class='sh_to_box col-xs-12 col-sm-6 col-md-8 col-lg-8 col-xl-8'>";
										echo "<div class='sh_title'>".$l->sh_title2.":</div>";

										//share btns
											$twitter_video_title = rawurlencode($twitter_title);
											/*facebook*/echo "<div title='Facebook' class='sh_class_icon_box' data-href='https://www.We-TeVe/watch/".$video_vuid."' data-mobile-iframe='true'><a class='fb-xfbml-parse-ignore' target='_blank' href='https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2FWe-TeVe.com%2Fwatch%2F".$video_vuid."'> <img class='sh_class_icon_box' src='".$_dhp."images/icons/brands/facebook.svg'/> </a></div>";
											/*Twitter*/ echo "<a title='Twitter' class='sh_class_icon_box' href='https://twitter.com/share?url=https%3A%2F%2FWe-TeVe.com%2Fwatch%2F".$video_vuid."&via=We_TeVe&hashtags=".$video_vuid."&text=".$twitter_video_title."&related=We_TeVe' target='_blank'><img class='sh_class_icon_box' src='".$_dhp."images/icons/brands/twitter.svg'/></a>";
											/*email*/ 	echo "<a title='email' class='sh_class_icon_box' href='mailto:?subject=".$l->sh_text1."&amp;body=".$l->sh_text2." https://www.We-TeVe/watch/".$video_vuid."' target='_blank'> <img class='sh_class_icon_box' src='".$_dhp."images/icons/email.svg'/></a>";

										//code
											echo "<div class='sh_title marg-top-15'>".$l->sh_title3.":</div>";
											echo "<input class='sh_link_input sh_embed_link' onClick='this.select();' readonly link1='"; ?><iframe width="560" height="315" src="https://www.We-TeVe.com/embed/<?php echo $video_vuid; ?><?php echo"' link2='";?> frameborder="0" allowfullscreen></iframe><?php echo"' type='text' value='"; ?><iframe width="560" height="315" src="https://www.We-TeVe.com/embed/<?php echo $video_vuid; ?>" frameborder="0" allowfullscreen></iframe><?php echo "'/>";

											echo "<div class='sh_title marg-top-15'>".$l->sh_title4.":</div>";
											echo "<input class='sh_link_input sh_norm_link' onClick='this.select();' readonly  link='https://www.We-TeVe.com/w/".$video_vuid."' type='text' value='https://www.We-TeVe.com/w/".$video_vuid."'/>";


											echo "<div class='sh_title marg-top-15'> <span class='sh_watch_time noselect'><input class='sh_time_check' type='checkbox'>	".$l->bm_new_text." <span class='sh_time_val' type='text' time='84'>00:01:24</span></span> </div>";

										//time btn
										?><script>

											//qr
											$('.sh_watch_time_qr').unbind('click').click(function(){
												$('.sh_watch_time_qr').toggleClass('checked');
												if ($('.sh_watch_time_qr').hasClass('checked')){
													var ctime = $('.sh_time_val_qr').attr('time');
													$('.sh_qr_link').attr('src', $('.sh_qr_link').attr('base')+"%26t="+ctime );
												}else{
													$('.sh_qr_link').attr('src', $('.sh_qr_link').attr('base') );
												}
											});

											//copycode
											$('.sh_watch_time').unbind('click').click(function(){
												$('.sh_watch_time').toggleClass('checked');
												if ($('.sh_watch_time').hasClass('checked')){
													var ctime = $('.sh_time_val').attr('time');
													$('.sh_embed_link').val( $('.sh_embed_link').attr('link1')+'&t='+ctime+'"'+$('.sh_embed_link').attr('link2') );
													$('.sh_norm_link').val( $('.sh_norm_link').attr('link')+"&t="+ctime );
												}else{
													$('.sh_embed_link').val( $('.sh_embed_link').attr('link1')+'" '+$('.sh_embed_link').attr('link2') );
													$('.sh_norm_link').val( $('.sh_norm_link').attr('link') );
												}
											});


										</script><?php

										//facebook js
										?><script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1"; fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>
										<?php

									echo "</div>";

								echo "</div>";
							echo "</div>";
							//share content end

							//recommends content
							if($isUserLoggedIn === 1){
							echo "<div class='pm_rc_container pm_to_hide hide'>";
								echo "<div>".$l->recoms_title2.":</div>";
								echo "<div class='pm_add_rc_error error w-100 pm_to_hide hide'>".$l->recoms_alert1."</div>";
								echo "<div class='pm_scroll_container'>";
								$friends_c = 0;
								$rc_results = db::$link->query("SELECT second_uuid,time FROM friend_db WHERE first_uuid = '$user_uuid' AND status = 'confirmed'");
									while($rc_row = $rc_results->fetch_array()){
										$friends_c++;
										$friend_uuid = $rc_row['second_uuid']; $friend_uuif = sha1(sha1($friend_uuid));
										$friend_seit = $t->invor($rc_row['time']);
										//wurde video schon empfohlen:
											$isvidinrc_sql = db::$link->query("SELECT recom_id FROM recom_db WHERE to_uuid = '$friend_uuid' AND from_uuid = '$user_uuid' AND vuid = '$video_vuid' AND status = 'public'");
											$isvidinrc_row = $isvidinrc_sql->fetch_assoc();
											if($isvidinrc_row['recom_id'] != ""){$inrcclass="friend_list_line_selectet"; $inrccheck="<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";}else{$inrcclass=""; $inrccheck="<span class='glyphicon glyphicon-plus' aria-hidden='true'></span>";}
										//userinfo
											$friend_user_name 	= $u->userin('name',0,$friend_uuif,'');
											$friend_user_avatar = $_dhp.$f->draw_avatar($friend_uuid,"small");
										echo"<div friend='".$friend_uuid."' class='friend_list_line ".$inrcclass." friend_".$friend_uuid."'>";
											echo "<div class='friend_list_title no_overflow'>".$inrccheck."<img class='' src='".$friend_user_avatar."'>".$friend_user_name."</div>" ;

											echo "<div class='friend_date'>".$l->recoms_title3." ".$friend_seit."</div>";
										echo "</div>";
									}
									if($friends_c == 0){
										echo "<div class='marg-top-5 error'>".$l->friend_alert0."</div>";
									}

							echo "</div>";

						echo "</div>";
					}
						//recommends Content end

				echo "
						</div>
						<div class='col-xs-0 col-sm-1 col-md-2 col-lg-4 col-xl-4 col-spl'></div>
					</div>
				</div>
				";


			//column2
				echo "<div id='column2' class='col-xs-12 col-sm-6 col-md-7 col-lg-8 col-xl-7 marg-bot-20'>";

					echo "<div class='sticky-video'></div>"; //ändert die höhe wenn das video sticked

					$is_channel_video = 0;
					require_once ($_hp.'video/video.php');


							$video_neg_vote2 = number_format($video_neg_vote,0, ",", ".");
							$video_pos_vote2 = number_format($video_pos_vote,0, ",", ".");


							if($video_neg_vote == 0 AND $video_pos_vote != 0){
								$res_votes = 100;
							}elseif($video_neg_vote == 0 AND $video_pos_vote == 0){
								$res_votes = 50;
							}else{
								$res_votes = ($video_pos_vote) / ($video_pos_vote + $video_neg_vote) * 100;
							}

							$res_votes = round($res_votes);
							if($res_votes >= 50){$res_vote_color = "watch_btn_blue";}else{$res_vote_color = "watch_btn_gray";}


			echo "<div class='watch_under_video'>";
				echo "<div class='watch_video_title'>";
						if($isUserLoggedIn === 1){
							if($video_uuid == $user_uuid OR $user_rang == '1'){
								echo "<a title='".$l->vm_title1."' href='".$_dhp."video-manager/edit/".$video_vuid."'> <div class='video_edit_button marg-r-10 noselect'><span class='glyphicon glyphicon-pencil'></span></div></a>";
							}
						}
				echo "
					<h3>".$video_title."</h3></div>
					<p class='left view-pad'>".$video_views." ".$l->watch_views."</p>";

				if($isUserLoggedIn === 1){

					$vote_sql = db::$link->query("SELECT vote FROM video_vote_db WHERE vuid = '$video_vuid' AND uuid = '$user_uuid' AND status = 'public'");
					$vote_row = $vote_sql->fetch_assoc();

					if($vote_row['vote'] == "pos"){$video_vote_activ_pos = "watch_btn_activ";}else{$video_vote_activ_pos = "";}
					if($vote_row['vote'] == "neg"){$video_vote_activ_neg = "watch_btn_activ";}else{$video_vote_activ_neg = "";}



					echo "
						<div class='right'>
							<div class='watch_btn watch_dislike_btn ".$video_vote_activ_neg."'><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span> <span class='vote_neg_num'>".$video_neg_vote."</span></div>
							<div class='watch_btn watch_like_btn ".$video_vote_activ_pos."'><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span> <span class='vote_pos_num '>".$video_pos_vote."</span></div>
								<div class='watch_res ".$res_vote_color."'>".$res_votes."%</div>

								<span class='hidden-md hidden-sm hidden-xs'>
									<div class='share_btn recommend_op_btn'><i class='fa fa-lightbulb-o' aria-hidden='true'></i> ".$l->watch_btn_title0."</div>
									<div class='share_btn share_op_btn'><span class='glyphicon glyphicon-link' aria-hidden='true'></span> ".$l->watch_btn_title1."</div>
									<div class='share_btn addplaylist_op_btn'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> ".$l->watch_btn_title2."</div>
									<div class='share_btn download_op_btn'><span class='glyphicon glyphicon-save' aria-hidden='true'></span> ".$l->watch_btn_title3."</div>
								</span>
						</div>


						<div class='watch_full_width_btns visible-md-block visible-sm-block visible-xs-block'>

								<div class='col-xs-3 col-spl'>
									<div class='share_btn download_op_btn'><span class='glyphicon glyphicon-save' aria-hidden='true'></span></div>
								</div>
								<div class='col-xs-3 col-spl'>
									<div class='share_btn addplaylist_op_btn'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></div>
								</div>
								<div class='col-xs-3 col-spl'>
									<div class='share_btn share_op_btn'><span class='glyphicon glyphicon-link' aria-hidden='true'></span></div>
								</div>
								<div class='col-xs-3 col-spl'>
									<div class='share_btn recommend_op_btn'><i class='fa fa-lightbulb-o' aria-hidden='true'></i> </span></div>
								</div>

						</div>

						<div style='clear: both;'></div>

				</div>";



			}else{
				echo "
					<div class='right'>
						<a href='".$_dhp."login/' target='_blank' class='watch_btn watch_dislike_btn'><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span> ".$video_neg_vote."</a>
						<a href='".$_dhp."login/' target='_blank' class='watch_btn watch_like_btn'><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span> ".$video_pos_vote."</a>
							<div class='watch_res ".$res_vote_color."'>".$res_votes."%</div>

							<span class='hidden-md hidden-sm hidden-xs'>
								<a href='".$_dhp."login/' target='_blank' class='share_btn'>		<i class='fa fa-lightbulb-o' aria-hidden='true'></i> 	".$l->watch_btn_title0."</a>
								<div class='share_btn share_op_btn'><span class='glyphicon glyphicon-link' aria-hidden='true'></span> ".$l->watch_btn_title1."</div>
								<a href='".$_dhp."login/' target='_blank' class='share_btn'>	<span class='glyphicon glyphicon-plus' aria-hidden='true'></span> ".$l->watch_btn_title2."</a>
								<div class='share_btn download_op_btn'><span class='glyphicon glyphicon-save' aria-hidden='true'></span> ".$l->watch_btn_title3."</div>
							</span>
					</div>


					<div class='watch_full_width_btns visible-md-block visible-sm-block visible-xs-block'>

							<div class='col-xs-3 col-spl'>
								<div class='share_btn download_op_btn'><span class='glyphicon glyphicon-save' aria-hidden='true'></span></div>
							</div>
							<div class='col-xs-3 col-spl'>
								<a href='".$_dhp."login/' target='_blank' class='share_btn'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></a>
							</div>
							<div class='col-xs-3 col-spl'>
								<div class='share_btn share_op_btn'><span class='glyphicon glyphicon-link' aria-hidden='true'></span></div>
							</div>
							<div class='col-xs-3 col-spl'>
								<a href='".$_dhp."login/' target='_blank' class='share_btn'><i class='fa fa-lightbulb-o' aria-hidden='true'></i> </span></a>
							</div>

					</div>

					<div style='clear: both;'></div>

			</div>";
			}

			echo "</div>";


			//playlist content
			if(isset($_GET['pl'])){
				$puid = mysqli_real_escape_string(db::$link,$_GET['pl']);
				$playlist_sql = db::$link->query("SELECT * FROM playlist_db WHERE puid = '$puid'");
				$playlist_row = $playlist_sql->fetch_assoc();
					$pl_name    = htmlentities($playlist_row['title'], ENT_QUOTES);
					$pl_uuid    = $playlist_row['uuid'];
					$pl_thumb   = $playlist_row['thumb'];
					$pl_notiz1  = $playlist_row['notiz'];
					$pl_notiz   = $com->fulltext($pl_notiz1);
					$pl_notiz_link = $f->autolink($pl_notiz,array("target"=>"_blank"));
					$pl_orderby = $playlist_row['orderby'];
					$pl_privacy = $playlist_row['privacy'];
					$pl_status	= $playlist_row['status'];

					if($pl_status != 'public'){
						$playlist_id = "not_set";
					}

					if($pl_privacy == "0"){
						if($isUserLoggedIn === 1){
							if($pl_uuid != $user_uuid){
								$puid = "none";
							}
						}else{
							$puid = "none";
						}
					}

			}else{
				$puid = "none";
			}
				if($puid != "none"){
					$menu_icon_class = "col-xs-3";
				}else{
					$menu_icon_class = "col-xs-4";
				}

			echo "
				<div id='column3' class='column3 col-xs-12 col-sm-6 col-md-5 col-lg-4 col-xl-3 col-spl'>
					<div class='col-xs-12 col-spl'>";

						if($puid != "none"){echo "
							<div class='playlist-icon menu ".$menu_icon_class."'>
								<div class='extra_video_info_icon'><h3><span class='glyphicon glyphicon-th-list' aria-hidden='true'></span></h3></div>
							</div>";
						}

					echo "
						<div class='comment-icon active menu ".$menu_icon_class."'>
								<div class='extra_video_info_icon'><h3><span class='glyphicon glyphicon-comment' aria-hidden='true'></span></h3></div>
						</div>
						<div class='info-icon menu ".$menu_icon_class."'>
								<div class='extra_video_info_icon'><h3 class='middle'><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span></h3></div>
						</div>
						<div class='film-icon menu ".$menu_icon_class."'>
								<div class='extra_video_info_icon'><h3><span class='glyphicon glyphicon-film' aria-hidden='true'></span></h3></div>
						</div>
					</div>";

					echo "<div class='col-xs-12 col-spl'>";
					//extra info rechts
						echo "<div class='extra_video_info white pad-15'>";


							//playlist
							if($puid != "none"){
								if(isset($_GET['o'])){
									if($_GET['o'] == 't'){
										$after_sort = "switch";
										$after_sort_switch_class = "w_pl_head_btn-activ";
										$after_sort_random_class = "";
									}elseif($_GET['o'] == 'r'){
										$after_sort = "random";
										$after_sort_switch_class = "";
										$after_sort_random_class = "w_pl_head_btn-activ";
									}else{
										$after_sort = "norm";
										$after_sort_switch_class = "";
										$after_sort_random_class = "";
									}
								}else{
									$after_sort = "norm";
									$after_sort_switch_class = "";
									$after_sort_random_class = "";
								}

								echo "<div class='video_playlist extra_video_info_hide'>";
									echo "<div class='w_pl_title no_overflow' title='".$pl_name."'><a href='".$_dhp."playlist/".$puid."'>".$pl_name."</a></div>";

									echo "<div class='w_pl_head_btn-box'>";
										echo "<div class='w_pl_head_btn w_pl_switch ".$after_sort_switch_class."' title='".$l->watch_pl_switch_title."'><i class='fa fa-exchange' aria-hidden='true'></i></div>";
										echo "<div class='w_pl_head_btn w_pl_random ".$after_sort_random_class."' title='".$l->watch_pl_random_title."'><i class='fa fa-random' aria-hidden='true'></i></div>";
									echo "</div>";

									echo "<div style='clear:both;'></div>";

									echo "<div class='w_pl_main_pl_content'>";


										require_once ($_hp.'playlists/playlist_videos.php');
									echo "</div>";

								echo "</div>";

								?>

								<script class='docready-script'>
									$(document).ready(function(){
										resultloadedforthumbpreview(); coms_loaded();
										getNextVideo('<?php echo $after_sort; ?>');
									});
								</script>

								<script>

									$(document).ready(function(){
										$('.w_pl_switch').unbind('click').click( function(){

											if( $('.w_pl_switch').hasClass('w_pl_head_btn-activ') ){
												var after_sort = "norm";
											}else{
												var after_sort = "switch";
											}

											$('.w_pl_random').removeClass('w_pl_head_btn-activ');
											$('.w_pl_switch').toggleClass('w_pl_head_btn-activ');

											$.post('<?php echo $_dhp; ?>playlists/playlist_videos', {'puid': '<?php echo $puid; ?>','vuid': '<?php echo $video_vuid; ?>','posi': 0, 'after_sort': after_sort, 'move': 'start'}, function(data) {

												$('.w_pl_main_pl_content').html(data);

												$('.w_pl_vid_num_box').height( $('.column3 .thumb_holder').height() );

												if($('.body').hasClass('mobile') == false){
													$('.column3 .video_playlist').animate({scrollTop: $(".column3 .w_pl_vid_num .glyphicon-play").offset().top - 250 }, 200);
													$('.video_full_info .video_playlist').animate({scrollTop: $(".video_full_info .w_pl_vid_num .glyphicon-play").offset().top - 200}, 200);
													$('html, body').animate({scrollTop: $(".column3 .w_pl_vid_num .glyphicon-play").offset().top - 250 }, 200);
												}

												getNextVideo(after_sort);
												loadfun_pl_w_videos(); resultloadedforthumbpreview(); coms_loaded();
											});
										});

										$('.w_pl_random').unbind('click').click( function(){
											if( $('.w_pl_random').hasClass('w_pl_head_btn-activ') ){
												var after_sort = "norm";
											}else{
												var after_sort = "random";
											}

											$('.w_pl_switch').removeClass('w_pl_head_btn-activ');
											$('.w_pl_random').toggleClass('w_pl_head_btn-activ');

											$.post('<?php echo $_dhp; ?>playlists/playlist_videos', {'puid': '<?php echo $puid; ?>','vuid': '<?php echo $video_vuid; ?>','posi': 0, 'after_sort': after_sort, 'move': 'start'}, function(data) {

												$('.w_pl_main_pl_content').html(data);

												$('.w_pl_vid_num_box').height( $('.column3 .thumb_holder').height() );

												if($('.body').hasClass('mobile') == false){
													$('.column3 .video_playlist').animate({scrollTop: $(".column3 .w_pl_vid_num .glyphicon-play").offset().top - 250 }, 200);
													$('.video_full_info .video_playlist').animate({scrollTop: $(".video_full_info .w_pl_vid_num .glyphicon-play").offset().top - 200}, 200);
													$('html, body').animate({scrollTop: $(".column3 .w_pl_vid_num .glyphicon-play").offset().top - 250 }, 200);
												}

												getNextVideo(after_sort);
												loadfun_pl_w_videos(); resultloadedforthumbpreview(); coms_loaded();
											});
										});

										setTimeout( function(){
											$('.vjs-play-control').addClass('vjs-pl-play-control');
											$('.vjs-volume-panel').addClass('vjs-pl-volume-panel');
											$('.vjs-current-time').addClass('vjs-pl-current-time');
											$('.vjs-time-divider').addClass('vjs-pl-time-divider');
											$('.vjs-duration').addClass('vjs-pl-duration');
											$('.vjs-pl-control').removeClass('hide');
											loadfun_pl_w_videos(); resultloadedforthumbpreview(); coms_loaded();


											$('.vjs-prev-control').unbind('click').click( function(){
												player = videojs("we-teve_video");
												if(player.currentTime() < 5){

													var prev_video = $('.vid_info').attr('pl_prev_vuid');
													gotovideosite('/watch/'+prev_video+'&pl=<?php echo $puid; ?>','','0');
												}else{
													player.currentTime('0');
												}
											});

											$('.vjs-prev-control').unbind('keypress').on("keypress", function(e) {
												if (e.keyCode === 13) {
													player = videojs("we-teve_video");
													if(player.currentTime() < 5){

														var prev_video = $('.vid_info').attr('pl_prev_vuid');
														gotovideosite('/watch/'+prev_video+'&pl=<?php echo $puid; ?>','','0');
													}else{
														player.currentTime('0');
													}
												}
											});


											$('.vjs-next-control').unbind('click').click( function(){
												var next_video = $('.vid_info').attr('pl_next_vuid');
												gotovideosite('/watch/'+next_video+'&pl=<?php echo $puid; ?>','','0');
											});

											$('.vjs-next-control').unbind('keypress').on("keypress", function(e) {
												if (e.keyCode === 13) {
													var next_video = $('.vid_info').attr('pl_next_vuid');
													gotovideosite('/watch/'+next_video+'&pl=<?php echo $puid; ?>','','0');
												}
											});

										},20);

									});





									function loadfun_pl_w_videos(){
										$('.w_pl_vid_num_box').height( $('.column3 .thumb_holder').height() );

										$('.w_pl_load-previous').unbind('click').click( function(){
											var posi = $(this).attr('start');
											var after_sort = $(this).attr('after_sort');
											$('.w_pl_go_to_'+posi+' .load_more_text').addClass('hide');
											$('.w_pl_go_to_'+posi+' .load_more_loading').removeClass('hide');
											$.post('<?php echo $_dhp; ?>playlists/playlist_videos', {'puid': '<?php echo $puid; ?>','vuid': '<?php echo $video_vuid; ?>','posi': posi, 'after_sort': after_sort, 'move': 'prev'}, function(data) {
												$('.w_pl_go_to_'+posi).remove();
												$('.w_pl_main_pl_content').prepend(data);
													loadfun_pl_w_videos(); resultloadedforthumbpreview(); coms_loaded();
											});
										});

										$('.w_pl_load-next').unbind('click').click( function(){
											var posi = $(this).attr('start');
											var after_sort = $(this).attr('after_sort');
											$(this).addClass('w_pl_del_div');
											$('.w_pl_go_to_'+posi+' .load_more_text').addClass('hide');
											$('.w_pl_go_to_'+posi+' .load_more_loading').removeClass('hide');
											$.post('<?php echo $_dhp; ?>playlists/playlist_videos', {'puid': '<?php echo $puid; ?>','vuid': '<?php echo $video_vuid; ?>','posi': posi, 'after_sort': after_sort, 'move': 'next'}, function(data) {
												$('.w_pl_go_to_'+posi).remove();
												$('.w_pl_main_pl_content').append(data);
													loadfun_pl_w_videos(); resultloadedforthumbpreview(); coms_loaded();
											});
										});

									}

									function getNextVideo(after_sort){
										if(after_sort == ""){ var after_sort = "norm"; }
										$.post('<?php echo $_dhp; ?>playlists/get_next_videos', {'puid': '<?php echo $puid; ?>','vuid': '<?php echo $video_vuid; ?>','after_sort': after_sort}, function(data) {
											var json = JSON.parse(data);
												var prev_vuid = json['prev_video'];
												var next_vuid = json['next_video'];
												$('.vid_info').attr('pl_next_vuid',next_vuid);
												$('.vid_info').attr('pl_prev_vuid',prev_vuid);
										});
									}

									$(window).resize(function() {
										$('.w_pl_vid_num_box').height( $('.column3 .thumb_holder').height() );
									});

								</script>
								<?php
							}

							//video kommentare
							echo "<div class='video_comments'>";
								require_once ($_hp.'comments/com.php');

							echo"</div>";

							//videobeschriebung
							if( strlen($video_description) > 0){
								$video_description = $com->fulltext($video_description);
								$video_description = $com->com_replace_time($video_description,$video_vuid,$_dhp);
								$video_description = $f->autolink($video_description,array("target"=>"_blank"));
							}else{
								$video_description = $l->watch_no_description;
							}

							//videouploaddatum
							$video_date = $video_row['uploaddate'];
								//time format
								$video_date = $t->normtime($video_date,'date');

							//kategorie
							$video_kategorie = $f->draw_category($video_row['kategorie'],1);

							//sprache
							$video_lang_s = $video_row['sprache'];
							$video_lang = $c->draw_lang($video_lang_s,1);

							echo "<div class='video_description extra_video_info_hide'>

										<h2>".$l->watch_hochgeladen_am."<br/>".$video_date."</h2>

										<div class='video_description_text'>
											".$video_description."
										</div>

										<span class='video_description_line'></span>

										<div class='video_description_extra'>
											<span class='video_extra_title'> Kategorie:</span> <a href='".$_dhp."results?cf=".$video_row['kategorie']."' class='video_extra_text'>".$video_kategorie."</a>
											<span class='video_extra_title'> Sprache:</span> <a href='".$_dhp."results?lf=".$video_lang_s."' class='video_extra_text'>".$video_lang."</a>
										</div>

							</div>";




							//more videos
							echo "<div id='more_videos' class='video_more_videos extra_video_info_hide'>";

								//Cat + tags
								echo "<div class='more_vid_tags_line'>";
									echo "<div class='filder_vid_tag filder_vid_cat' 	cat='".$video_row['kategorie']."'>".$f->draw_category($video_row['kategorie'],1)."</div>";
									echo "<div class='filder_vid_tag filder_vid_lang' lang='".$video_lang_s."'>".$c->draw_lang($video_lang_s,1)."</div>";

									if($video_tags != ""){
										$tags_array = (explode(",",$video_tags));
										$tags_c = count($tags_array);
										for ($i=0; $i < $tags_c; $i++) {
											echo "<div class='filder_vid_tag filder_vid_tags' tag='".$tags_array[$i]."'>".$tags_array[$i]."</div>";
										}
									}

								echo "</div>";

								//search
								echo "<div class='more_vid_seach_line'>";
									echo "<input type='text' class='left more_vid_seach_in form-control' placeholder='".$l->morev_search."'>";
									echo "<div class='search_button more_vid_seach_btn left button blue_btn'><span class='glyphicon glyphicon-search' aria-hidden='true'></span></div>";
								echo "</div>";

								//autoplay
								echo "<div class='auto_next_video hide'>";
									echo "<h4 class='marg-top-15 left'>".$l->morev_next_video."</h4> <span class='close_next_video glyphicon glyphicon-remove'></span>";
									echo "<div class='auto_next_video_content thumb_hor'>";
									echo "</div>";
								echo "</div>";

								echo "<div class='more_video_content'>";
									echo "<h4 class='marg-top-15 left'>".$l->watch_more_vids_title."</h4>";
									$more_videos_sql = db::$link->query("SELECT vuid FROM video_db WHERE uuid != '$video_uuid' AND status = 'uploaded' AND privacy = 'public' AND vuid != '$video_vuid' ORDER BY rand() LIMIT 15");
									while ($more_videos_row = $more_videos_sql->fetch_array())
									{
										$more_vuid = $more_videos_row['vuid'];
										echo $f->draw_video_pewview($more_vuid,'1','hor','',$_dhp,$_ddhp,'small','1')."<br>";
									}
								echo "</div>";
							echo "</div>";
							//end more videos

						echo "</div>";

					echo"</div>

			</div>"; //column3 end

	echo"</div>
	</div>

			";
			?>

			<script>

			//sec in 00:00:00
			function shtoHHMMSS(sec) {
				var sec_num = parseInt(sec, 10); // don't forget the second param
				var hours   = Math.floor(sec_num / 3600);
				var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
				var seconds = sec_num - (hours * 3600) - (minutes * 60);

				if (hours   < 10) {hours   = "0"+hours;}
				if (minutes < 10) {minutes = "0"+minutes;}
				if (seconds < 10) {seconds = "0"+seconds;}
				return hours+':'+minutes+':'+seconds;
			}


			//Rechte Navigaton
				setTimeout(function(){
					loadfun_icon_btn();
					loadfun_icon_btn2();
					loadfun_playlists();
					loadfun_more_vids();
				},2);

				function loadfun_icon_btn(){
					$('.comment-icon').unbind('click').click(function(){

						$('.video_comments').removeClass('extra_video_info_hide');
						$('.video_description').addClass('extra_video_info_hide');
						$('.video_more_videos').addClass('extra_video_info_hide');
						$('.video_playlist').addClass('extra_video_info_hide');

						$('.comment-icon').addClass('active');
						$('.info-icon').removeClass('active');
						$('.film-icon').removeClass('active');
						$('.playlist-icon').removeClass('active');

					});

					$('.info-icon').unbind('click').click(function(){
						$('.video_comments').addClass('extra_video_info_hide');
						$('.video_description').removeClass('extra_video_info_hide');
						$('.video_more_videos').addClass('extra_video_info_hide');
						$('.video_playlist').addClass('extra_video_info_hide');

						$('.comment-icon').removeClass('active');
						$('.info-icon').addClass('active');
						$('.film-icon').removeClass('active');
						$('.playlist-icon').removeClass('active');
					});

					$('.film-icon').unbind('click').click(function(){
						$('.video_comments').addClass('extra_video_info_hide');
						$('.video_description').addClass('extra_video_info_hide');
						$('.video_more_videos').removeClass('extra_video_info_hide');
						$('.video_playlist').addClass('extra_video_info_hide');

						$('.comment-icon').removeClass('active');
						$('.info-icon').removeClass('active');
						$('.film-icon').addClass('active');
						$('.playlist-icon').removeClass('active');
					});

					$('.playlist-icon').unbind('click').click(function(){
						$('.video_comments').addClass('extra_video_info_hide');
						$('.video_description').addClass('extra_video_info_hide');
						$('.video_more_videos').addClass('extra_video_info_hide');
						$('.video_playlist').removeClass('extra_video_info_hide');

						$('.comment-icon').removeClass('active');
						$('.info-icon').removeClass('active');
						$('.film-icon').removeClass('active');
						$('.playlist-icon').addClass('active');
							loadfun_pl_w_videos();

							if($('.body').hasClass('mobile') == false){
								$('.column3 .video_playlist').animate({scrollTop: $(".column3 .w_pl_vid_num .glyphicon-play").offset().top - 250 }, 200);
								$('.video_full_info .video_playlist').animate({scrollTop: $(".video_full_info .w_pl_vid_num .glyphicon-play").offset().top - 200}, 200);
								$('html, body').animate({scrollTop: $(".column3 .w_pl_vid_num .glyphicon-play").offset().top - 250 }, 200);
							}

					});

					var user_info_open = 0;
					$('.user_down_info').click(function(){
						if(user_info_open == 0){
							$('.video_user_navi_content').fadeIn();
							$('.user_down_info').removeClass('glyphicon-chevron-down');
							$('.user_down_info').addClass('glyphicon-chevron-up');
							user_info_open = 1;
						}else{
							$('.video_user_navi_content').fadeOut();
							$('.user_down_info').removeClass('glyphicon-chevron-up');
							$('.user_down_info').addClass('glyphicon-chevron-down');
							user_info_open = 0;
						}
					});
				}


				//more vids
					function loadfun_more_vids() {

						$('.column3 .more_vid_seach_in').keyup(function() 						{ $('.video_full_info .more_vid_seach_in').val($(this).val()); });
						$('.column3 .more_vid_seach_in').click(function() 						{ $('.video_full_info .more_vid_seach_in').val($(this).val()); });
						$('.column3 .more_vid_seach_in').change(function() 						{ $('.video_full_info .more_vid_seach_in').val($(this).val()); });
						$('.column3 .more_vid_seach_in').on('paste drop', function() 	{ $('.video_full_info .more_vid_seach_in').val($(this).val()); });
						$('.column3 .more_vid_seach_in').on('cut', function() 				{ $('.video_full_info .more_vid_seach_in').val($(this).val()); });

						$('.video_full_info .more_vid_seach_in').keyup(function() 						{ $('.column3 .more_vid_seach_in').val($(this).val()); });
						$('.video_full_info .more_vid_seach_in').click(function() 						{ $('.column3 .more_vid_seach_in').val($(this).val()); });
						$('.video_full_info .more_vid_seach_in').change(function() 						{ $('.column3 .more_vid_seach_in').val($(this).val()); });
						$('.video_full_info .more_vid_seach_in').on('paste drop', function() 	{ $('.column3 .more_vid_seach_in').val($(this).val()); });
						$('.video_full_info .more_vid_seach_in').on('cut', function() 				{ $('.column3 .more_vid_seach_in').val($(this).val()); });

						$('.more_vid_seach_in').unbind('click').click(function(){
							$(this).addClass('com_in_focus');
						});

						var container = $('.more_vid_seach_in');
						$(document).mouseup(function (e){
							if (!container.is(e.target) && container.has(e.target).length === 0){
								$('.more_vid_seach_in').removeClass('com_in_focus');
							}
						});


						$('.filder_vid_cat').unbind('click').click( function(){
								$('.more_video_content').html("<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");
							var cat_filter = $(this).attr('cat');
							$.post('<?php echo $_dhp;?>ajax/more_videos',{'vuid': '<?php echo $video_vuid;?>', 'catfilter': cat_filter,}, function(data) {
								$('.more_video_content').html(data); loadfun_more_vids(); resultloadedforthumbpreview();
							});
						});

						$('.filder_vid_lang').unbind('click').click( function(){
								$('.more_video_content').html("<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");
							var lang_filter = $(this).attr('lang');
							$.post('<?php echo $_dhp;?>ajax/more_videos',{'vuid': '<?php echo $video_vuid;?>', 'langfilter': lang_filter,}, function(data) {
								$('.more_video_content').html(data); loadfun_more_vids(); resultloadedforthumbpreview();
							});
						});

						$('.filder_vid_tags').unbind('click').click( function(){
								$('.more_video_content').html("<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");
							var tag_filter = $(this).attr('tag');
							$.post('<?php echo $_dhp;?>ajax/more_videos',{'vuid': '<?php echo $video_vuid;?>', 'tagfilter': tag_filter,}, function(data) {
								$('.more_video_content').html(data); loadfun_more_vids(); resultloadedforthumbpreview();
							});
						});

						$('.more_vid_seach_btn').unbind('click').click( function(){ more_video_search(); });
						$('.more_vid_seach_in').unbind("keyup").keyup(function (e) {
					      if (e.keyCode === 13) {
					        more_video_search();
					      }
					  });
							function more_video_search(){
								var search_filter = $('.more_vid_seach_in').val();
								if(search_filter != "" && search_filter != " "){
									search_filter = encodeURIComponent(search_filter);
									$('.more_video_content').html("<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");
									$.post('<?php echo $_dhp;?>ajax/more_videos',{'vuid': '<?php echo $video_vuid;?>', 'searchval': search_filter,}, function(data) {
										$('.more_video_content').html(data); loadfun_more_vids(); resultloadedforthumbpreview();
									});
								}
							}

						$('.backtomorevideos').unbind('click').click( function(){
							$('.more_video_content').html("<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");
							$.post('<?php echo $_dhp;?>ajax/more_videos',{'vuid': '<?php echo $video_vuid;?>','uuid': '<?php echo $video_uuid;?>' }, function(data) {
								$('.more_video_content').html(data); loadfun_more_vids(); resultloadedforthumbpreview();
							});
						});

						//play next video
						$('.thumb_play_next').unbind('click').click( function(){
							var vuid = $(this).attr('vuid');
							$('.auto_next_video_content').html( $(this).parents('.thumb_hor').html() );
							$('.auto_next_video').removeClass('hide');
							$('.thumb_play_next_2 span').remove();
							$('.vid_info').attr('next_vuid',vuid);
							$('.vid_info').attr('in_pl','no');

							if($(this).hasClass('thumb_play_next_2')){
								$(this).html( "<span class='glyphicon glyphicon-ok'></span> "+$(this).html() );
							}

							loadfun_more_vids(); resultloadedforthumbpreview();
						});

						//close_next_video
						$('.close_next_video').unbind('click').click( function(){
							$('.auto_next_video').addClass('hide');
							$('.thumb_play_next_2 span').remove();
							$('.vid_info').attr('next_vuid','');
							$('.vid_info').attr('in_pl','');
							loadfun_more_vids(); resultloadedforthumbpreview();
						});
					}
				//en more vids



				//Btns unter dem Video
				function loadfun_icon_btn2(){
					//playlist
						$('.addplaylist_op_btn').unbind('click').click(function(){
							$('.pm_container_bg').removeClass('hide');
							$('.pm_pl_title').removeClass('hide');
							$('.pm_pl_container').removeClass('hide');
							$('.body').addClass('stop_srolling');
						});

					//download
					$('.download_op_btn').unbind('click').click(function(){
						$('.pm_container_bg').removeClass('hide');
						$('.pm_dw_title').removeClass('hide');
						$('.pm_dw_container').removeClass('hide');
						$('.body').addClass('stop_srolling');
					});

					//share
					$('.share_op_btn').unbind('click').click(function(){
						$('.pm_container_bg').removeClass('hide');
						$('.pm_sh_title').removeClass('hide');
						$('.pm_sh_container').removeClass('hide');
						$('.body').addClass('stop_srolling');
						var player = videojs("we-teve_video");
						var ctime = Math.round(player.currentTime());
	 				 	$('.bm_time_val').attr('time',ctime);
						$('.sh_qr_link').attr('src', $('.sh_qr_link').attr('base')+"%26t="+ctime);
						$('.sh_time_val,.sh_time_val_qr').attr('time',ctime);
	 				 	var ctime2 = shtoHHMMSS(ctime);
						$('.sh_time_val,.sh_time_val_qr').html(ctime2);
					});

					//recommends
					$('.recommend_op_btn').unbind('click').click(function(){
						$('.pm_container_bg').removeClass('hide');
						$('.pm_rc_title').removeClass('hide');
						$('.pm_rc_container').removeClass('hide');
						$('.body').addClass('stop_srolling');
					});


					//alle schliessen
						$('.pm_close_btn').unbind('click').click(function(){
							$('.pm_to_hide').addClass('hide');
							$('.body').removeClass('stop_srolling');
						});

						$(document).mouseup(function (e){
					    var container = $('.pm_container');
					    if (!container.is(e.target) && container.has(e.target).length === 0){
					      $('.pm_to_hide').addClass('hide');
								$('.body').removeClass('stop_srolling');
					    }
						});

					//new playlist
						$('.pm_new_pl_btn').unbind('click').click(function(){
							var pl_name = $('.pm_new_pl').val();
							var priv = $('.pm_new_pl').attr('pl_privacy');
							if(pl_name != "" && pl_name != " "){
								$.post('<?php echo $_dhp;?>playlists/add',{'vuid': '<?php echo $video_vuid;?>','move': 'new', 'priv': priv, 'pl_name': pl_name}, function(data) {
									if(data != "error" || data != "error1" || data != "error2" || data != "error3" || data != "error4" || data != ""){
										$('.pm_pl_container').find('.pm_scroll_container').html(data+""+$('.pm_pl_container').find('.pm_scroll_container').html());
										loadfun_playlists();

										//set default
											$('.pm_new_pl').val('');
											$('.pm_new_pl').attr('pl_privacy','privat');
											$('.priv_btn').removeClass('activ');
											$('.priv_btn_sel').addClass('activ');
									}else{
										$('.pm_new_pl_error').removeClass('hide');
									}
								});
							}
						});

						//privacy
							$('.priv_btn').unbind('click').click(function(){
								$('.priv_btn').removeClass('activ');
								$(this).addClass('activ');
								var priv = $(this).attr('priv');
								$('.pm_new_pl').attr('pl_privacy',priv);
							});

					//recommends add and remove
						$('.friend_list_line').unbind('click').click(function(){
							var friend = $(this).attr('friend');
							$.post('<?php echo $_dhp;?>recommend/add',{'vuid': '<?php echo $video_vuid;?>', 'friend': friend}, function(data) {
								if(data == 'add'){
									$('.friend_'+friend).addClass('friend_list_line_selectet');
									$('.friend_'+friend+' .glyphicon').removeClass('glyphicon-plus');
									$('.friend_'+friend+' .glyphicon').addClass('glyphicon-ok');
								}else if(data == 'remove'){
									$('.friend_'+friend).removeClass('friend_list_line_selectet');
									$('.friend_'+friend+' .glyphicon').removeClass('glyphicon-ok');
									$('.friend_'+friend+' .glyphicon').addClass('glyphicon-plus');
								}else{
									$('.pm_friend_error').removeClass('hide');
								}
							});
						});


					//Vote
					var votetoken = '<?php echo $vid_like; ?>';
						$('.watch_like_btn').click(function(){
							$.post('<?php echo $_dhp;?>video/vote',{'vuid': '<?php echo $video_vuid;?>', 'tok': votetoken, 'vote': 'pos'}, function(data) {
								if(data != 'error'){
									votetoken = data.substring(0, 80);
									var vote = data.substring(81, 87);
									var proz = parseInt(data.substring(88));
									var pos_votes = parseInt($('.vote_pos_num').html());
									var neg_votes = parseInt($('.vote_neg_num').html());

									if(vote == "addpos"){
										pos_votes = pos_votes + 1;
										$('.vote_pos_num').html(pos_votes);
										$('.watch_like_btn').addClass('watch_btn_activ');
									}else if(vote == "rempos"){
										pos_votes = pos_votes - 1;
										$('.vote_pos_num').html(pos_votes);
										$('.watch_like_btn').removeClass('watch_btn_activ');
									}else if(vote == "switch"){
										pos_votes = pos_votes + 1;
										$('.vote_pos_num').html(pos_votes);
										neg_votes = neg_votes - 1;
										$('.vote_neg_num').html(neg_votes);
										$('.watch_like_btn').addClass('watch_btn_activ');
										$('.watch_dislike_btn').removeClass('watch_btn_activ');
									}

									$('.watch_res').html(proz+'%');
										if(proz >= 50){
											$('.watch_res').removeClass('watch_btn_gray');
											$('.watch_res').addClass('watch_btn_blue');
										}else{
											$('.watch_res').removeClass('watch_btn_blue');
											$('.watch_res').addClass('watch_btn_gray');
										}

								}else{

								}
							});
						});


						$('.watch_dislike_btn').click(function(){
							$.post('<?php echo $_dhp;?>video/vote',{'vuid': '<?php echo $video_vuid;?>', 'tok': votetoken, 'vote': 'neg'}, function(data) {
								if(data != 'error'){
									votetoken = data.substring(0, 80);
									var vote = data.substring(81, 87);
									var proz = parseInt(data.substring(88));
									var pos_votes = parseInt($('.vote_pos_num').html());
									var neg_votes = parseInt($('.vote_neg_num').html());

									if(vote == "addneg"){
										neg_votes = neg_votes + 1;
										$('.vote_neg_num').html(neg_votes);
										$('.watch_dislike_btn').addClass('watch_btn_activ');
									}else if(vote == "remneg"){
										neg_votes = neg_votes - 1;
										$('.vote_neg_num').html(neg_votes);
										$('.watch_dislike_btn').removeClass('watch_btn_activ');
									}else if(vote == "switch"){
										pos_votes = pos_votes - 1;
										$('.vote_pos_num').html(pos_votes);
										neg_votes = neg_votes + 1;
										$('.vote_neg_num').html(neg_votes);
										$('.watch_dislike_btn').addClass('watch_btn_activ');
										$('.watch_like_btn').removeClass('watch_btn_activ');
									}

									$('.watch_res').html(proz+'%');
										if(proz >= 50){
											$('.watch_res').removeClass('watch_btn_gray');
											$('.watch_res').addClass('watch_btn_blue');
										}else{
											$('.watch_res').removeClass('watch_btn_blue');
											$('.watch_res').addClass('watch_btn_gray');
										}

								}else{

								}
							});
						});

				}//end loadfun_icon_btn2

				//playlist add and remove
				function loadfun_playlists(){
					$('.pl_add_list_line').unbind('click').click(function(){
						var puid = $(this).attr('pl');
						$.post('<?php echo $_dhp;?>playlists/add',{'vuid': '<?php echo $video_vuid;?>', 'puid': puid, 'move': 'add/remove'}, function(data) {
							if(data == 'add'){
								$('.pl_'+puid).addClass('pl_add_list_line_selectet');
								$('.pl_'+puid+' .glyphicon').removeClass('glyphicon-plus');
								$('.pl_'+puid+' .glyphicon').addClass('glyphicon-ok');
							}else if(data == 'remove'){
								$('.pl_'+puid).removeClass('pl_add_list_line_selectet');
								$('.pl_'+puid+' .glyphicon').removeClass('glyphicon-ok');
								$('.pl_'+puid+' .glyphicon').addClass('glyphicon-plus');
							}else{
								$('.pm_add_pl_error').removeClass('hide');
							}
						});
					});
				}

			</script>

<?php

	}else{//can show

	if($v_error != 4){
		$video_sql = db::$link->query("SELECT * FROM video_db WHERE vuid = '$video_vuid'");
		$video_row = $video_sql->fetch_assoc();

			$thumb = $video_row['thumb'];
				if($thumb == "own"){
					$thumb_img = $_dhp."images/thumb/large_img/".$video_vuid.".jpg";
				}else{
					$thumb_img = $_dhp."images/thumb/error.jpg";
				}

			$status = $video_row['status'];


			if($status == "deleted"){
				$error_msg = $l->watch_error_msg0;
			}elseif($status == "copy_rights"){
				$error_msg = $l->watch_error_msg1;
			}elseif($status == "community_rights"){
				$error_msg = $l->watch_error_msg2;
			}elseif($v_error == 1){
				$error_msg = $l->watch_error_msg3;
			}elseif($v_error == 2){
				$error_msg = $l->watch_error_msg5;
			}

		}else{
			$thumb_img = $_dhp."images/thumb/error.jpg";
			$error_msg = $l->watch_error_msg4;
		}

		//error_msg0 = deleted
		//error_msg1 = copy_rights
		//error_msg2 = community rules

		//error_msg3 = not ready
		//error_msg4 = not found

		//error_msg5 = not allowed

		?>

		<div class="row">
			<div id="column1" class="col-spl col-xs-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 col-spl"></div>

			<div id="column2" class="col-xs-12 col-sm-6 col-md-7 col-lg-6 col-xl-7 marg-bot-20">
				<?php
					echo "<div class='video_blac vjs-default-skin back_gray'> <img class='blac_thumb' src='".$thumb_img."'/>";
						echo "<div class='video_error_screen'>";
							echo "<div class='video_error_text'>";
								echo $error_msg;
							echo "</div>";
						echo "</div>";
					echo "</div>";


					//playlist content
					if(isset($_GET['pl'])){
						$puid = mysqli_real_escape_string(db::$link,$_GET['pl']);
						$playlist_sql = db::$link->query("SELECT * FROM playlist_db WHERE puid = '$puid'");
						$playlist_row = $playlist_sql->fetch_assoc();
							$pl_uuid    = $playlist_row['uuid'];
							$pl_orderby = $playlist_row['orderby'];
							$pl_privacy = $playlist_row['privacy'];
							$pl_status	= $playlist_row['status'];

							if($pl_status != 'public'){
								$playlist_id = "not_set";
							}

							if($pl_privacy == "0"){
								if($isUserLoggedIn === 1){
									if($pl_uuid != $user_uuid){
										$puid = "none";
									}
								}else{
									$puid = "none";
								}
							}

					}else{
						$puid = "none";
					}

					if($puid != "none"){
						if(isset($_GET['o'])){
							if($_GET['o'] == 't'){
								$after_sort = "switch";
								$after_sort_switch_class = "w_pl_head_btn-activ";
								$after_sort_random_class = "";
							}elseif($_GET['o'] == 'r'){
								$after_sort = "random";
								$after_sort_switch_class = "";
								$after_sort_random_class = "w_pl_head_btn-activ";
							}else{
								$after_sort = "norm";
								$after_sort_switch_class = "";
								$after_sort_random_class = "";
							}
						}else{
							$after_sort = "norm";
							$after_sort_switch_class = "";
							$after_sort_random_class = "";
						}
						?>
						<script>
							$.post('<?php echo $_dhp; ?>playlists/get_next_videos', {'puid': '<?php echo $puid; ?>','vuid': '<?php echo $video_vuid; ?>','after_sort': '<?php echo $after_sort; ?>'}, function(data) {
								var json = JSON.parse(data);
									var next_vuid = json['next_video'];

									setTimeout( function(){
											gotovideosite('/watch/'+next_vuid+'&pl=<?php echo $puid; ?>','','0');
									},3000);
							});

						</script>
						<?php
					}
				?>
				</div>
			</div>

			<div id="column3" class="column3 col-xs-12 col-sm-6 col-md-5 col-lg-4 col-xl-3 col-spl"></div>

		</div>
		<?php
	}

if($infram != 1){?>
		</div>

	</body>
</html>

<?php }
?>
