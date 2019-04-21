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
		$video_uuid 		= $video_row['uuid'];
		$video_title 		= $video_row['video_title'];
		$video_description = $video_row['info'];
		$video_views 		= $video_row['views'];
		$video_pos_vote = $video_row['pos_vote'];
			$video_pos_vote_n   = number_format($video_pos_vote,0, ",", ".");
		$video_neg_vote = $video_row['neg_vote'];
			$video_neg_vote_n   = number_format($video_neg_vote,0, ",", ".");

		$video_title= htmlentities($video_row['video_title']);
		$video_tags   = htmlentities($video_row['tags'], ENT_QUOTES);
	}else{
		$video_title 		= "404";
		$v_error 				= 4;
	}

}else{
	$video_title 		= "404";
	$v_error 				= 4;
}


//3. site vals
$video_title = mysqli_real_escape_string(db::$link,$video_title);
$html_title = $video_title." | We-TeVe"; //Tap title
$video_title= $f->normtext($video_title);


if(isset($_GET['sort'])){$sort=$_GET['sort'];}else{$sort='0';}

?>

	<!DOCTYPE html>
	<html lang='<?php echo $l->htmldata; ?>'>
		<head>
			<?php
			require_once ($_hp.'include/head.php');
			//echo "<script src='".$_dhp."video/video.js'></script>";
			//echo "<script src='".$_dhp."video/video-hotkey.js'></script>";
			?>
		</head>
		<body id='body' class='body' style='overflow:hidden;'>

		<span id='site_scripts'>

			<?php //require_once ($_hp.'include/coinhivescript.php'); ?>

			<script class="docready-script">

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
					$video_yt_status 	= $video_row['render_status'];
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

		//==================== options ==================================
			$embed = 1;
				if(isset($_GET['autoplay'])){
					if($_GET['autoplay'] == "true"){$embed_autoplay = 1;}elseif($_GET['autoplay'] == "false"){$emded_autoplay = 0;}else{ $emded_autoplay = 0; }
				}

				if(isset($_GET['autoreplay'])){
					if($_GET['autoreplay'] == "true"){$embed_autoreplay = 1;}elseif($_GET['autoreplay'] == "false"){$emded_autoreplay = 0;}else{ $emded_autoreplay = 0; }
				}

				if(isset($_GET['hud'])){
					if($_GET['hud'] == "on"){$vid_hud = 'show';}elseif($_GET['hud'] == "off"){$vid_hud = 'hide';}else{ $vid_hud = 'show'; }
				}else{ $vid_hud = 'show'; }

				if(isset($_GET['fullscreenmenu'])){
					if($_GET['fullscreenmenu'] == "on"){$fullscreen_hud = 'show'; $embed_class=''; }elseif($_GET['fullscreenmenu'] == "off"){$fullscreen_hud = 'hide'; $embed_class='fullscreenmenu_hide';}else{ $fullscreen_hud = 'show'; $embed_class='';}
				}else{ $fullscreen_hud = 'hide'; $embed_class='';} //links sollten in einem Tap auf gehen
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
						$video_user_land    = $c->draw_land($video_user_land,0);

			//avatar
				$video_user_avatar = $_dhp.$l->draw_avatar($video_uuid,"large");


			//Userinfos
			echo "<div class='rowww'>";

				if($fullscreen_hud == 'show' AND $vid_hud == 'show'){
					echo "<div id='column1' class='col-spl col-xs-12 col-sm-12 col-md-12 col-lg-2 col-xl-2 col-spl'>
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

											$mfu_i++;
											if($own_videos_preview != 1){
												$mfu_video_title	= htmlentities($more_from_user_row['video_title']);
												$mfu_video_vuid		= $more_from_user_row['vuid'];
												$mfu_video_dauer	= $more_from_user_row['dauer'];

												echo "
													<div class=' col-xs-12 col-sm-4 col-md-4 col-lg-12 col-xl-12 marg-bot-10 marg-top-5'>";
															echo $f->draw_video_pewview($mfu_video_vuid,1,'ver','',$_dhp,$_ddhp,'1','small');
													echo"</div>
												";
											}

										}

								echo "</div>";

					if($mfu_i == 0 OR $own_videos_preview == 1){


						echo "own shit here";


					}


				echo "
					</div>
				</div>";
			}


				echo "<div id='column2' class='embed_player ".$embed_class."'>";
					//echo "<div class='sticky-video'></div>";
					$is_channel_video = 0;
					require_once ($_hp.'video/video.php');

				echo "
          <div class='hide'>
    					<h3>".$video_title."</h3>
    					<p class='left view-pad'>".$video_views." ".$l->watch_views."</p>
    					<div class='right'>
    					<div class='marg-r-5 btn-group' role='group'>
    							<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
    								Dropdown
    								<span class='caret'></span>
    							</button>
    							<ul class='dropdown-menu'>
    							  <li><a href='#'>Als Favorit markieren</a></li>
    							  <li><a href='#'>Playlist hinzufügen</a></li>
    							</ul>
    					</div>
    					<div class='btn-group right' role='group' aria-label='...'>
    						<button type='button' class='btn btn-default'><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span>".$video_pos_vote."</button>
    						<button type='button' class='btn btn-default'><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span>".$video_neg_vote."</button>
    					</div>
    					</div>
    					<div style='clear: both;'></div>
    				</div>
        </div>";


				if($fullscreen_hud == 'show' AND $vid_hud == 'show'){
				echo "
					<div id='column3' class='column3 col-xs-12 col-sm-6 col-md-5 col-lg-4 col-xl-3 col-spl'>
						<div class='col-xs-12 col-spl'>
							<div class='comment-icon active menu col-xs-4'>
									<div class='extra_video_info_icon'><h3><span class='glyphicon glyphicon-comment' aria-hidden='true'></span></h3></div>
							</div>
							<div class='info-icon menu col-xs-4'>
									<div class='extra_video_info_icon'><h3 class='middle'><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span></h3></div>
							</div>
							<div class='film-icon menu col-xs-4'>
									<div class='extra_video_info_icon'><h3><span class='glyphicon glyphicon glyphicon-film' aria-hidden='true'></span></h3></div>
							</div>

						</div>";

						echo "<div class='col-xs-12 col-spl'>";
						//extra info rechts
							echo "<div class='extra_video_info white pad-15'>";

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

						echo"
						</div>

				</div>"; }//column3 end

	echo"

			";

			?>

			<script>

			//Rechte Navigaton
				setTimeout(function(){
					loadfun_icon_btn();
					loadfun_more_vids();
				},2);

				function loadfun_icon_btn(){
					$('.comment-icon').click(function(){

						$('.video_comments').removeClass('extra_video_info_hide');
						$('.video_description').addClass('extra_video_info_hide');
						$('.video_more_videos').addClass('extra_video_info_hide');

						$('.comment-icon').addClass('active');
						$('.info-icon').removeClass('active');
						$('.film-icon').removeClass('active');

					});

					$('.info-icon').click(function(){
						$('.video_comments').addClass('extra_video_info_hide');
						$('.video_description').removeClass('extra_video_info_hide');
						$('.video_more_videos').addClass('extra_video_info_hide');

						$('.comment-icon').removeClass('active');
						$('.info-icon').addClass('active');
						$('.film-icon').removeClass('active');
					});

					$('.film-icon').click(function(){
						$('.video_comments').addClass('extra_video_info_hide');
						$('.video_description').addClass('extra_video_info_hide');
						$('.video_more_videos').removeClass('extra_video_info_hide');

						$('.comment-icon').removeClass('active');
						$('.info-icon').removeClass('active');
						$('.film-icon').addClass('active');
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


				<?php if($fullscreen_hud == 'show'){ ?>
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
								console.log(search_filter);
								if(search_filter != "" && search_filter != " "){
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
							loadfun_more_vids(); resultloadedforthumbpreview();
						});
					}
				//end more vids
				<?php }else{ ?> //end if fullscreen hud is showed
					function loadfun_more_vids(){}
				<?php } ?>


			</script>

			<?php

				}else{//can show

				if($v_error != 4){
					$video_sql = db::$link->query("SELECT * FROM video_db WHERE vuid = '$video_vuid'");
					$video_row = $video_sql->fetch_assoc();

						$thumb = $video_row['thumb'];
							if($thumb == "own"){
								$thumb_img = $_dhp."images/thumb/large_img/".$video_vuid.".jpg";
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


						<div id="column2" style='height:100vh;' class="col-xs-12 col-sm-12">
							<?php
								echo "<div style='height:100vh;'> <img class='blac_thumb' src='".$thumb_img."'/>";
									echo "<div class='video_error_screen'>";
										echo "<div class='video_error_text'>";
											echo $error_msg;
										echo "</div>";
									echo "</div>";
								echo "</div>";
							?>
							</div>
						</div>
					<?php
				}
				?>

		</div>

	</body>
</html>

<?php
	/*}else{
			require_once ($_hp.'include/coinhivetext.php');
	}*/
?>
