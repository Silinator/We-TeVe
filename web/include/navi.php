<?php

echo "<div id='navileft' class='white navileft col-xs-12 col-sm-4 col-md-3 col-xl-2 pad-r-10'>";

			if(isset($_GET['q'])){$search_val = $_GET['q'];}else{$search_val = "";}
			$searchtext =  htmlentities($search_val, ENT_QUOTES);

		if($isUserLoggedIn === 1){

			//avatar
			$user_avatar = $_dhp.$f->draw_avatar($user_uuid,"small");


			echo "
				<div class='navi-sm visible-xs-block'>
					<a href='".$_dhp."user/".$user_name."' class=''><img src='".$user_avatar."' alt='".$user_name."'></a>
					<a href='".$_dhp."user/".$user_name."' class='col-black'>".$user_name."</a>
				</div>
				<div class='navi-sm visible-sm-block visible-xs-block'>
					<div class='marg-top-15'>
						<form action='".$_dhp."results'>
							<input type='text' name='q' value='".$searchtext."' class='left form-control navileft-input' placeholder='".$l->search_title."' required>
							<button type='submit' class='search_button btn blue_btn'><span class='glyphicon glyphicon-search' aria-hidden='true'></span></button>
						</form>
					</div>
				</div>

				<a class='navileft-link' href='".$_dhp."user/".$user_name."'><div>
					<span class='glyphicon glyphicon-home' aria-hidden='true'></span>
					<span class='text'>".$l->my_channel_title."</span>
				</div></a>
				<a class='navileft-link' href='".$_dhp."subscriptions'><div>
					<span class='glyphicon glyphicon-star' aria-hidden='true'></span>
					<span class='text'>".$l->my_subs_title."</span>
				</div></a>
				<a class='navileft-link' href='".$_dhp."recommends'><div>
					<i class='fa fa-lightbulb-o' aria-hidden='true'></i>
					<span class='text'>".$l->my_recoms_title."</span>
				</div></a>
				<a class='navileft-link' href='".$_dhp."video-manager/'><div>
					<span class='glyphicon glyphicon-film' aria-hidden='true'></span>
					<span class='text'>".$l->myvideo_title."</span>
				</div></a>";

				$partner_sql = db::$link->query("SELECT partner_status FROM user_find_db WHERE uuid = '$user_uuid'");
				$partner_row = $partner_sql->fetch_assoc();
				$partner_status = $partner_row['partner_status'];
				if($partner_status > 0){
					echo "
					<a class='navileft-link' href='".$_dhp."partner/dashboard'><div>
						<span class='marg-l-5'>P</span>
						<span class='text'>".$l->partner_title."</span>
					</div></a>";
				}

				if($user_rang == 1){
					echo "
					<a class='navileft-link' href='".$_dhp."admin/dashboard'><div>
						<span class='marg-l-5'><span class='glyphicon glyphicon-sunglasses'></span></span>
						<span class='text'>".$l->admin_title."</span>
					</div></a>";
				}

				echo"
				<a class='navileft-link' load='new' href='".$_dhp."options/'><div>
					<span class='glyphicon glyphicon-wrench' aria-hidden='true'></span>
					<span class='text'>".$l->options_title."</span>
				</div></a>";

				/*
				<a class='navileft-link' href=''><div>
					<span class='glyphicon glyphicon-menu-hamburger' aria-hidden='true'></span>
					<span class='text'>".$l->usernavi_title2."</span>
				</div></a>

				<a class='navileft-link' href=''><div>
					<span class='glyphicon glyphicon-send' aria-hidden='true'></span>
					<span class='text'>Private Nachrichten</span>
				</div></a>
				<a class='navileft-link' href=''><div>
					<span class='glyphicon glyphicon-comment' aria-hidden='true'></span>
					<span class='text'>Kommentare</span>
				</div></a>*/
				echo "
				<a class='navileft-link' href='".$_dhp."login/logout'><div>
					<span class='glyphicon glyphicon-log-out' aria-hidden='true'></span>
					<span class='text'>".$l->logout_title."</span>
				</div></a>";


			//PLAYLISTS

				echo "<div class='title'><a class='navileft-link' href='".$_dhp."user/".$user_name."/playlist'>".$l->playlists_title."</a></div>";

				$pls = 0;
				$pl_results = db::$link->query("SELECT title,puid FROM playlist_db WHERE uuid = '$user_uuid' AND status = 'public' ORDER BY last_interaction DESC LIMIT 0, 5");
				while($pl_row = $pl_results->fetch_array()){
					$pl_navi_name = htmlentities($pl_row['title'], ENT_QUOTES); $navi_puid = $pl_row['puid']; $pls++;
					echo "
					<a title='".$pl_navi_name."' class='navileft-link navileft-box' href='".$_dhp."playlist/".$navi_puid."'><div>
						<span class='glyphicon glyphicon-list navileft-icon' aria-hidden='true'></span>
						<span class='text no_overflow navileft-link navileft-text'>".$pl_navi_name."</span>
					</div></a>";
				}

				echo "<div class='pl_more hide'>";
					$pl_results = db::$link->query("SELECT title,puid FROM playlist_db WHERE uuid = '$user_uuid' AND status = 'public' ORDER BY last_interaction DESC LIMIT 5, 20");

					while($pl_row = $pl_results->fetch_array()){
						$pl_navi_name = htmlentities($pl_row['title'], ENT_QUOTES); $navi_puid = $pl_row['puid'];

							echo"
							<a title='".$pl_navi_name."' class='navileft-link navileft-box' href='".$_dhp."playlist/".$navi_puid."'><div>
								<span class='glyphicon glyphicon-list navileft-icon' aria-hidden='true'></span>
								<span class='text no_overflow navileft-link navileft-text'>".$pl_navi_name."</span>
							</div></a>";
					}

				echo "</div>";


				if($pls == 5){
					echo "
					<div class='navileft-link toggle_more_pls navileft-box'><div>
						<span class='more_pls_icon glyphicon glyphicon-chevron-down navileft-icon' aria-hidden='true'></span>
						<span class='text no_overflow navileft-link navileft-text'>".$l->showmore."</span>
					</div></div>";
				}


			//Lesezeiechen

				echo "<div class='title'><div class='navileft-link bm_navi_title' >".$l->bookmark_title."</div></div>";

				echo "<div class='bm_first_five'>";
					$bms = 0; $bmempty = 0;
					$bm_results = db::$link->query("SELECT title,url FROM bookmark_db WHERE uuid = '$user_uuid' AND status = 'public' ORDER BY pos DESC LIMIT 0, 5");
					while($bm_row = $bm_results->fetch_array()){
						$bm_name = htmlentities($bm_row['title'], ENT_QUOTES); $bm_url = $bm_row['url']; $bms++;
						echo "
						<span class='bm_fist_nr_".$bms."'>
							<a title='".$bm_name."' class='navileft-link navileft-box' href='https://www.We-TeVe.com".$bm_url."'><div>
								<span class='glyphicon glyphicon-bookmark navileft-icon' aria-hidden='true'></span>
								<span class='text no_overflow navileft-link navileft-text'>".$bm_name."</span>
							</div></a>
						</span>
						";
					}
				echo "</div>";

				echo "<div class='bm_more hide'>";
					$bm_results = db::$link->query("SELECT title,url FROM bookmark_db WHERE uuid = '$user_uuid' AND status = 'public' ORDER BY pos DESC LIMIT 5, 20");
					while($bm_row = $bm_results->fetch_array()){
						$bm_name = htmlentities($bm_row['title'], ENT_QUOTES); $bm_url = $bm_row['url'];
						echo
						"<a title='".$bm_name."' class='navileft-link navileft-box' href='https://www.We-TeVe.com".$bm_url."'><div>
							<span class='glyphicon glyphicon-bookmark navileft-icon' aria-hidden='true'></span>
							<span class='text no_overflow navileft-link navileft-text'>".$bm_name."</span>
						</div></a>";
					}
				echo "</div>";

				while($bms < 5){
					$bms++; $bmempty = 1;
					echo "<span class='bm_fist_nr_".$bms."'></span>";
				}


				if($bms == 5 AND $bmempty != 1){
					echo "
					<div class='navileft-link toggle_more_bms'><div>
						<span class='more_bms_icon glyphicon glyphicon-chevron-down' aria-hidden='true'></span>
						<span class='text no_overflow navileft-link'>".$l->showmore."</span>
					</div></div>";
				}



		}else{ //if not logged in
			echo"
				<a class='navileft-link' href='".$_dhp."login/'><div>
					<span class='glyphicon glyphicon-log-in' aria-hidden='true'></span>
					<span class='text'>".$l->login_title_0."</span>
				</div></a>
				<a class='navileft-link' load='new' href='".$_dhp."registry/'><div>
					<span class='glyphicon glyphicon-list-alt' aria-hidden='true'></span>
					<span class='text'>".$l->regin_title_0."</span>
				</div></a>

				<div class='navi-sm pad-10 visible-sm-block visible-xs-block'>
					<div class='marg-top-15'>
						<form action='".$_dhp."results'>
							<input type='text' name='q' id='suchen' value='".$searchtext."' class='left form-control navileft-input' placeholder='".$l->search_title."' required/>
							<button type='submit' class='search_button btn blue_btn'><span class='glyphicon glyphicon-search' aria-hidden='true'></span></button>
						</form>
					</div>

				</div>
			";
		} //end logged in

		echo "
			<div class='foot marg-top-15'><a class='navileft-link' href='".$_dhp."r/police' >".$l->footertitle1."</a></div>
			<div class='foot'><a href='".$_dhp."r/terms' class='navileft-link'>".$l->footertitle2."</a></div>
			<div class='foot'><a href='".$_dhp."r/communitypolice' class='navileft-link'>".$l->footertitle4."</a></div>
			<div class='foot'><a href='".$_dhp."r/haftung' class='navileft-link'>".$l->footertitle6."</a></div>
			<div class='foot'><a href='".$_dhp."r/partner' class='navileft-link'>".$l->footertitle7."</a></div>";
			if($isUserLoggedIn === 1){
				$user_sql = db::$link->query("SELECT * FROM user_find_db WHERE uuid = '$user_uuid'");
				$user_row = $user_sql->fetch_assoc();
				if($user_row['partner_status'] == 0){
					echo "<div class='foot'><a href='".$_dhp."r/go_partner' class='navileft-link'>".$l->footertitle8."</a></div>";
				}
			}
			echo"<div class='foot'><a href='".$_dhp."r/patchnotes' class='navileft-link'>Patchnotes</a></div>";

			echo"<div class='foot'><a href='".$_dhp."r/impressum' class='navileft-link'>".$l->footertitle5."</a></div>";

echo "</div>";


		//header:

			echo "
			<div id='hidden_container' class='hide'></div>
			<div class='site_loadering_bar'> <div class='site_loadering_progress'></div> </div>
			<div class='col-xs-12 navitop white col-spl'>
				<div class='container'>
					<div class='col-spl hidden-xs col-sm-4 col-md-3 col-lg-2'>
						<div class='button blue_btn navileft-btn left marg-r-15 hidden-xs '><span class='glyphicon glyphicon-menu-hamburger' aria-hidden='true'></span></div>
						<a href='".$_dhp."'><img class='logo left hidden-xs' alt='Startseite' src='".$_dhp."images/icons/we-teve_logo.svg'/></a>
					</div>
					<div class='col-spl col-xs-12 col-sm-8 col-md-9 col-lg-10'>
							<div class='button blue_btn navileft-btn left visible-xs-block marg-r-5'><span class='glyphicon glyphicon-menu-hamburger' aria-hidden='true'></span></div>
						<a href='".$_dhp."'><img class='logo left visible-xs-block' alt='Startseite' src='".$_dhp."images/icons/logosmall.png'/></a>

						<form action='".$_dhp."results'>
							<input type='text' name='q' value='".$searchtext."' class='left hidden-xs hidden-sm form-control marg-l-15 w-40' placeholder='".$l->search_title."' required>
							<button type='submit' class='search_button left blue_btn hidden-xs hidden-sm'><span class='glyphicon glyphicon-search' aria-hidden='true'></span></button>
						</form>


						<div class='menubar'>";
							if($isUserLoggedIn === 1){
								echo "
									<a href='".$_dhp."upload/' alt='upload' load='new'> <div class='button blue_btn right marg-r-5'><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span> </div></a>


									<div class='button gray_btn right marg-r-5 login_friends'>
										<div class='new_fri_count news_counter_val'> <span class='online_fri'></span> <span class='new_fri_req'></span> </div>
										<div class='navi_dropdown_arrow-border friend_dd_arrow hide'> </div>     <div class='navi_dropdown_arrow friend_dd_arrow hide'> </div> <div class='navi_dropdown_blac_box friend_dd_arrow hide'></div>
										<span class='glyphicon glyphicon-user' aria-hidden='true'></span>
									</div>


									<div class='button gray_btn right marg-r-5 login_messages'>
										<div class='new_mes_count news_counter_val'></div>
										<div class='navi_dropdown_arrow-border messages_dd_arrow hide'> </div>     <div class='navi_dropdown_arrow messages_dd_arrow hide'> </div> <div class='navi_dropdown_blac_box messages_dd_arrow hide'></div>
										<span class='glyphicon glyphicon-bell' aria-hidden='true'></span>
									</div>
								";

								//level


								$xp = $user_xp;

									if($xp >= $lvl->lvlinfo('txp','1000')){ $level = 1000; $levelup = 1000; $levelfortschrit = 0; }
									elseif($xp <= 0){$level = 0; $levelup = 1; $levelfortschrit = 0;
									}else{

										$level = $lvl->lvlinfo('level',$xp);

										$levelup = $level + 1;


										$xplevel_for_this_level = $lvl->lvlinfo('txp',$level);
										$xplevel_for_next_level = $lvl->lvlinfo('txp',$levelup);

										$xplevel_needed_for_next_level = $lvl->lvlinfo('xp',$levelup);
										$xplevel_over = $xp - $xplevel_for_this_level;

										//wie viel Prozent der ramne gefüllt sein soll
										$levelfortschrit = $xplevel_over / $xplevel_needed_for_next_level * 100;
									}

								$b_level = $lvl->lvlicon('b',$level); $n_level = $lvl->lvlicon('n',$level);
								$c_level = $lvl->lvlicon('c',$level); $f_level = $lvl->lvlicon('f',$level);
								echo"<div id='login_level'  class='pointer right marg-r-5 login_level'>";
								echo "<div class='navi_dropdown_arrow-border level_dd_arrow hide'> </div>     <div class='navi_dropdown_arrow level_dd_arrow hide'> </div> <div class='navi_dropdown_blac_box level_dd_arrow hide'> </div>";
								//level icon im Navi:
								echo"<div xp='".$xp."' class='level_content_back channel_small_level_symbol'>";
									echo "<div class='level_border_back level_36_line_top b_level_".$b_level."'> <div class='level_border_front level_36_line_top_draw c_level_".$c_level."'></div> </div>
										<div class='level_border_back level_36_corner_top_left b_level_".$b_level."'> <div class='level_border_front level_36_corner_top_left_draw c_level_".$c_level."'></div> </div>
									<div class='level_border_back level_36_line_right b_level_".$b_level."' > <div class='level_border_front level_36_line_right_draw c_level_".$c_level."'></div> </div>
										<div class='level_border_back level_36_corner_top_right b_level_".$b_level."'> <div class='level_border_front level_36_corner_top_right_draw c_level_".$c_level."'></div> </div>
									<div class='level_border_back level_36_line_bottom b_level_".$b_level."'> <div class='level_border_front level_36_line_bottom_draw c_level_".$c_level."'></div> </div>
										<div class='level_border_back level_36_corner_bottom_right b_level_".$b_level."'> <div class='level_border_front level_36_corner_bottom_right_draw c_level_".$c_level."'></div> </div>
									<div class='level_border_back level_36_line_left b_level_".$b_level."'> <div class='level_border_front level_36_line_left_draw c_level_".$c_level."'></div> </div>
										<div class='level_border_back level_36_corner_bottom_left b_level_".$b_level."'> <div class='level_border_front level_36_corner_bottom_left_draw c_level_".$c_level."'></div> </div>

									<div class='level_content n_36_level_".$n_level." c_level_".$c_level."'>
										<div class='level_number f_level_".$f_level." this_level'>
											".$level."
										</div>
									</div>";
										//f_ = font-size 1 10 100 250 1000
										//c_ = content color / vordergrund 1 10 20 30 40 50 60 ...
										//b_ = background color / hintergrund 1 10 20 30 40 50 60 ...

										//n_ = numberbackground 50 100 250 500 750 1000
										//nc_ = numberbackgroundcolor 1 10 20 30 40 50 60 ... (inventiert background -> Vordergrund - weil ein ild dafor ist)
								echo"</div>";
						echo"</div>";



								echo "
									<a href='".$_dhp."user/".$user_name."' class='right marg-r-5 hidden-xs pointer navi_userinfo'>
										<img src='".$user_avatar."'/>
										<div class='gray_btn col-black noselect no_overflow navi_username'>".$user_name."</div>
									</a>";


									echo "
									<div class='button gray_btn right marg-r-5 set_bm'>
										<div class='navi_dropdown_arrow-border bookmark_dd_arrow hide'> </div> <div class='navi_dropdown_arrow bookmark_dd_arrow hide'> </div> <div class='navi_dropdown_blac_box bookmark_dd_arrow hide'> </div>
										<span class='glyphicon glyphicon-bookmark' aria-hidden='true'></span>
									</div>
								";
							}else{
								echo "
									<a href='".$_dhp."login/' > <div class='btn blue_btn btn-default right'>					<span class='marg-r-5 glyphicon glyphicon-arrow-up' aria-hidden='true'>	</span> Hochladen </div> </a>
									<a href='".$_dhp."login/' > <div class='btn blue_btn btn-default right marg-r-5'> <span class='marg-r-5 glyphicon glyphicon-log-in' aria-hidden='true'>		</span> Anmelden  </div> </a>
								";
							}
							echo"
						</div>
					</div>
				</div>
			</div>
			";

			echo "<div style='height:69px;'></div>";

			//miniplayer
			echo "<div id='miniplayer_box' class='miniplayer_box hide'>";
				echo "<div id='miniplayer_box_header_container' class='miniplayer_box_header_container'>";
					echo "<div id='miniplayer_box_header' class='miniplayer_box_header no_overflow'>Test</div>";
					echo "<div class='close_miniplayer'><span class='glyphicon glyphicon-remove'></span></div>";
				echo "</div>";
				echo "<div class='miniplayer'></div>";
			echo "</div>";

			//miniplayer watchsite
			echo "<div class='miniplayer_watch_site hide'></div>";
			//miniplayer watchurl
			echo "<div class='miniplayer_watch_url hide'></div>";


			if($isUserLoggedIn === 1){


				//bookmark add
					echo "<div class='navi-right set_bm_opt hide'>
						<h5>".$l->bm_new_title.":</h5>
						<input type='text' class='set_bm_ph_name' placeholder='".$l->bm_ph_name."' >
						<div class='set_bm_add btn'>".$l->save."</div>

						<span class='bm_watch_time noselect hide'>
							<input class='bm_time_check' type='checkbox'/> ".$l->bm_new_text." <span class='bm_time_val' type='text'>00:00:00</span> <span class='ctime_refresh glyphicon glyphicon-refresh'></span>
						</span>

						<div class='new_bm_error red pad-5 w-100 hide'>".$l->bm_error."</div>
						<div class='new_bm_error_index red pad-5 w-100 hide'>".$l->bm_index_error."</div>
					</div>";

				//Lesezeichen bm pop up
				echo "
				<div class='bm_pm_container_bg bm_container_bg hide'>
					<div class='col-spl col-xs-0 col-sm-1 col-md-2 col-lg-4 col-xl-3 col-spl'></div>
					<div class='bm_pm_container bm_container col-xs-11 col-sm-10 col-md-8 col-lg-4 col-xl-5'>
						<div class='bm_pm_title_container'>";
							echo "<div class='bm_pm_title pm_title hide'>".$l->bm_edit_title.": </div>";
							echo "<div class='sub_group_pm_title pm_title hide'>".$l->sub_title1.": </div>";
								echo "<div class='bm_pm_close_btn bm_close_btn'><span class='glyphicon glyphicon-remove'></span></div>";
						echo "</div>";

					echo "<div class='bm_pm_pl_container bm_pm_scroll_container bm_scroll_container'>";



					echo  "</div>";
					echo  "</div>";
				echo  "</div>";



				//Dropdown-boxen
					//level_dropdown
					echo "<div class='navi-right navi_dropdown level_dropdown hide'> <div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div> </div>";

					//message_dropdown
					echo "<div class='navi-right navi_dropdown messages_dropdown hide'> <div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div> </div>";

					//friend_dropdown
					echo "<div class='navi-right navi_dropdown friend_dropdown hide'> <div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div> </div>";


				//End Dropdown-boxen



			//notification
				$not_token = $f->mk_key(40);
				$time      = strtotime(date('Y-m-d H:i:s'));

				$up = "DELETE FROM notification_temp WHERE uuid = '$user_uuid'";
				$up = db::$link->query($up);


				$set_token = "INSERT INTO notification_temp
							(token,uuid,time) VALUES
							('$not_token','$user_uuid','$time')";
				$set_token = db::$link->query($set_token);


						echo "<div token='".$not_token."' class='navi-right notifications'>

							<div class='not_slot not_slot_3'>
								<div class='not_avatar not_clear'></div>
								<div class='not_title no_overflow not_clear'></div>
								<div class='not_text no_overflow not_clear'></div>
							</div>
							<div class='not_slot not_slot_2'>
								<div class='not_avatar not_clear'></div>
								<div class='not_title no_overflow not_clear'></div>
								<div class='not_text no_overflow not_clear'></div>
							</div>
							<div class='not_slot not_slot_1'>
								<div class='not_avatar not_clear'></div>
								<div class='not_title no_overflow not_clear'></div>
								<div class='not_text no_overflow not_clear'></div>
							</div>

							<div class='not_time_cont'>
								<div class='not_time'><div class='not_time_left'></div></div>
								<div class='not_close'><span class='glyphicon glyphicon-remove'></span></div>
							</div>
						</div>";

					echo "<div id='popup_event' class='popup_event_placeholder'></div>";
					echo "<div class='pop_background'></div>";

?>
		<script>



		//instant 36 x 36
		setTimeout(function() {
			<?php if($levelfortschrit > 0){?>
				$('.level_36_corner_top_left_draw').width(1);
			<?php } ?>

			<?php if($levelfortschrit >= 25){?>
				$('.level_36_line_top_draw').width(34);
				<?php }elseif($levelfortschrit < 25){ ?>
					$('.level_36_line_top_draw').width(<?php $top_line_width = 34 * $levelfortschrit * 4 / 100;  echo $top_line_width;?>);
				<?php } ?>

			<?php if($levelfortschrit >= 25){?>
				$('.level_36_corner_top_right_draw').width(1);
				$('.level_36_corner_top_right_draw').height(1);
			<?php } ?>

			<?php if($levelfortschrit >= 50){?>
				$('.level_36_line_right_draw').height(34);
			<?php }elseif($levelfortschrit < 50 AND $levelfortschrit > 25){ ?>
				$('.level_36_line_right_draw').height(<?php $right_line_height = 34 * ($levelfortschrit - 25) * 4 / 100;  echo $right_line_height;?>);
			<?php } ?>

			<?php if($levelfortschrit >= 50){?>
				$('.level_36_corner_bottom_right_draw').width(1);
				$('.level_36_corner_bottom_right_draw').height(1);
			<?php } ?>

			<?php if($levelfortschrit >= 75){?>
				$('.level_36_line_bottom_draw').width(34);
				<?php }elseif($levelfortschrit < 75 AND $levelfortschrit > 50){ ?>
					$('.level_36_line_bottom_draw').width(<?php $bottom_line_width = 34 * ($levelfortschrit - 50) * 4 / 100;  echo $bottom_line_width;?>);
				<?php } ?>

			<?php if($levelfortschrit >= 75){?>
				$('.level_36_corner_bottom_left_draw').width(1);
				$('.level_36_corner_bottom_left_draw').height(1);
			<?php } ?>

			<?php if($levelfortschrit >= 100){?>
				$('.level_36_line_left_draw').height(34);
				<?php }elseif($levelfortschrit < 100 AND $levelfortschrit > 75){ ?>
					$('.level_36_line_left_draw').height(<?php $left_line_height = 34 * ($levelfortschrit - 75) * 4 / 100;  echo $left_line_height;?>);
				<?php } ?>
		}, 0);



		//Dropdown-boxen
			//level_dropdown
			var dd_level_open = 0;

			$('.login_level').click(function(){
				if(dd_level_open == 0){
					$('.set_bm_opt').addClass('hide'); $('.bookmark_dd_arrow').addClass('hide');
					$('.level_dropdown').removeClass('hide');
					$('.level_dd_arrow').removeClass('hide');
						$.post('<?php echo $_dhp; ?>level/level_list',function(data){

						dd_level_open = 1;
						$('.level_dropdown').html(data);
						run_navi_level_list_animation();
					});
				}else{
					$('.level_dropdown').addClass('hide');$('.level_dd_arrow').addClass('hide');
					$('.level_dropdown').html("<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");
					dd_level_open = 0;
				}
			});

			$(document).mouseup(function (e){
					var container = $('.level_dropdown'); var container2 = $('.login_level');
					if (!container.is(e.target) && container.has(e.target).length === 0 && !container2.is(e.target) && container2.has(e.target).length === 0){
						$('.level_dropdown').addClass('hide'); $('.level_dd_arrow').addClass('hide');
						$('.level_dropdown').html("<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");
						dd_level_open = 0;
					}
			});


			//messages_dropdown
			var dd_messages_open = 0;

			$('.login_messages').click(function(){
				if(dd_messages_open == 0){
					$('.set_bm_opt').addClass('hide'); $('.bookmark_dd_arrow').addClass('hide');
					$('.messages_dropdown').removeClass('hide');
					$('.messages_dd_arrow').removeClass('hide');
						$.post('<?php echo $_dhp; ?>messages/messages', function(data){

						dd_messages_open = 1;
						$('.messages_dropdown').html(data);
					});
				}else{
					$('.messages_dropdown').addClass('hide');$('.messages_dd_arrow').addClass('hide');
					$('.messages_dropdown').html("<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");
					dd_messages_open = 0;
				}
			});

			$(document).mouseup(function (e){
					var container = $('.messages_dropdown'); var container2 = $('.login_messages');
					if (!container.is(e.target) && container.has(e.target).length === 0 && !container2.is(e.target) && container2.has(e.target).length === 0){
						$('.messages_dropdown').addClass('hide'); $('.messages_dd_arrow').addClass('hide');
						$('.messages_dropdown').html("<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");
						dd_messages_open = 0;
					}
			});


			//friend_dropdown
			var dd_friend_open = 0;

			$('.login_friends').click(function(){
				open_friend_menu(0);
			});

			function open_friend_menu(navi){
				if(navi == 1){ dd_friend_open = 0; }
					if(dd_friend_open == 0){
						$('.set_bm_opt').addClass('hide'); $('.bookmark_dd_arrow').addClass('hide');
						$('.friend_dropdown').removeClass('hide');
						$('.friend_dd_arrow').removeClass('hide');
							$.post('<?php echo $_dhp; ?>friends/friends',function(data){

								dd_friend_open = 1; loadfun_friend();
								$('.friend_dropdown').html(data);
							});
					}else{
						$('.friend_dropdown').addClass('hide');$('.friend_dd_arrow').addClass('hide');
						$('.friend_dropdown').html("<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");
						dd_friend_open = 0;
					}
			}

			$(document).mouseup(function (e){
					var container = $('.friend_dropdown'); var container2 = $('.login_friends');
					if (!container.is(e.target) && container.has(e.target).length === 0 && !container2.is(e.target) && container2.has(e.target).length === 0){
						$('.friend_dropdown').addClass('hide'); $('.friend_dd_arrow').addClass('hide');
						$('.friend_dropdown').html("<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");
						dd_friend_open = 0;
					}
			});



		//notification
		var not_abort = 0;
		var is_running = 0;
		var is_waiting = 0;
		var is_running_animation = 0;
		var not_countdown_ready2start = 0;
		var isFullscreen = 0;

		var not_animation_1 = null; var not_animation_2 = null; var not_animation_new = null;

		var focus = true;
		window.onbeforeunload = function () {
			focus = false;
			$.ajax({type: 'POST',async: false,url: '<?php echo $_dhp; ?>notification/new_tap'});
		};
		window.onblur = function() { focus = false; $.post('<?php echo $_dhp; ?>notification/new_tap'); }
		window.onfocus = function() { focus = true; setTimeout( function(){check_notification();},500);
			if( (not_countdown_ready2start == 1 && $('video').length == false) || (not_countdown_ready2start == 1 && $('video').length == true && $('.video-js').hasClass('vjs-fullscreen') == false && $('.pm_container').is(':visible') == false )){
				not_countdown_ready2start = 0; not_countdown_animation();
			}
		}
			document.onblur = window.onblur;
			document.focus = window.focus;

			setInterval(function(){ //sendet not_countdown_animation(); wenn fullscreen beendet wird oder button window
				if($('.video-js').hasClass('vjs-fullscreen') == false && $('.pm_container,.bm_pm_container').is(':visible') == false){
					if(isFullscreen == 1){
						isFullscreen = 0;
						not_countdown_animation();
					}
				}else{
					isFullscreen = 1;
				}
			},500);



		check_notification();




		function check_notification(){
			if(is_running == 0 && is_waiting == 0){
				not_abort = 0;
				is_running = 1;
				is_waiting = 1;
				$.post('<?php echo $_dhp; ?>notification/check',{'usercode':'<?php echo $_SESSION['usercode']; ?>', 'xp': $('.channel_small_level_symbol').attr('xp'), 'new_mes': $('.new_mes_count').html(),'online_fri': $('.online_fri').html(), 'new_fri': $('.new_fri_req').html(), 'is_mobile':isMobile, 'token': $('.notifications').attr('token')},function(data){

				if(data != "error"){
					is_waiting = 0;
						if(data != ""){
							var json = JSON.parse(data);


								if(json['new_level_icon']){

									$('.channel_small_level_symbol').html(json['new_level_icon']);
									$('.channel_small_level_symbol').attr('xp',json['new_xp']);

									is_running = 0;
									is_running_animation = 0;

									if(focus == true){
										check_notification();
									}

								}else if(json['big_level_content']){

									$('#popup_event').html(json['big_level_content']);
									$('.popup_event').show();
									$('body').addClass('stop_srolling');
									$('#big_popup_event').fadeIn(50);
									$('.pop_background').fadeIn(50);

									loadfun_big_level();


								}else if(json['new_mes_count']){

									if(json['new_mes_count'] == '0' || json['new_mes_count'] == '' || json['new_mes_count'] == 0 ){
										$('.new_mes_count').html('');
									}else{
										$('.new_mes_count').html(json['new_mes_count']);
									}

									is_running = 0;
									is_running_animation = 0;

									if(focus == true){
										check_notification();
									}

								}else if(json['new_fri_count']){

									if(json['new_fri_count'] == '0' || json['new_fri_count'] == '' || json['new_fri_count'] == 0 ){
										$('.new_fri_req').html('');
									}else{
										$('.new_fri_req').html(json['new_fri_count']);
									}

									is_running = 0;
									is_running_animation = 0;

									if(focus == true){
										check_notification();
									}

								}else if(json['new_online_fri_count']){

									if(json['new_online_fri_count'] == '0' || json['new_online_fri_count'] == '' || json['new_online_fri_count'] == 0 ){
										$('.online_fri').html('');
									}else{
										$('.online_fri').html(json['new_online_fri_count']);
									}

									is_running = 0;
									is_running_animation = 0;

									if(focus == true){
										check_notification();
									}

								}else if(json['new_token']){

									$('.notifications').attr('token',json['new_token']);
									is_running = 0;
									is_running_animation = 0;

									if(focus == true){
										check_notification();
									}

								}else if(isMobile == false){

									if(json['slot1']){
										$('.not_slot_1 .not_avatar').html(json['slot1'].avatar);
										$('.not_slot_1 .not_title').html(json['slot1'].title);
										$('.not_slot_1 .not_text').html(json['slot1'].text);

										$('.notifications').addClass('not_top_row1');
										$('.notifications').show();

										if((focus == true && $('video').length == false) || (focus == true && $('video').length == true && $('.video-js').hasClass('vjs-fullscreen') == false && $('.pm_container').is(':visible') == false ) ){
											not_countdown_animation();
										}else{
											not_countdown_ready2start = 1;
										}

										$('.not_slot_1').show();
										$('.not_slot_1').animate({'margin-left': '0px'}, 500);

									}
									if(json['slot2']){
										$('.notifications').removeClass('not_top_row1');
										$('.notifications').addClass('not_top_row2');
										$('.not_slot_2 .not_avatar').html(json['slot2'].avatar);
										$('.not_slot_2 .not_title').html(json['slot2'].title);
										$('.not_slot_2 .not_text').html(json['slot2'].text);

										$('.not_slot_2').show();
										not_animation_1 = setTimeout( function(){
											$('.not_slot_2').animate({'margin-left': '0px'}, 500);
										},250);
									}
									if(json['slot3']){
										$('.notifications').removeClass('not_top_row1');
										$('.notifications').removeClass('not_top_row2');
										$('.notifications').addClass('not_top_row3');
										$('.not_slot_3 .not_avatar').html(json['slot3'].avatar);
										$('.not_slot_3 .not_title').html(json['slot3'].title);
										$('.not_slot_3 .not_text').html(json['slot3'].text);

										$('.not_slot_3').show();
										not_animation_2 = setTimeout( function(){
											$('.not_slot_3').animate({'margin-left': '0px'}, 500);
										},500);
									}

									if(json['slot4']){
										//big update

									}


							}else{
								is_running = 0;
								is_running_animation = 0;
								check_notification();
							}

						}else{
							is_running = 0;
							is_running_animation = 0;
							check_notification();
						}

					}else{

					}

				});
			}
		}

		function not_countdown_animation(){
			if(is_running_animation == 0){
				is_running_animation = 1;
				$('.not_time_left').animate({'width': '0%'}, 5500, function(){
					if(not_abort == 0){

						$('.not_slot').animate({'margin-left': '600px'}, 500, function(){
							$('.notifications').hide();
							$('.not_slot').hide();
							$('.not_time_left').css("width", "100%");

							$('.notifications').removeClass('not_top_row1');
							$('.notifications').removeClass('not_top_row2');
							$('.notifications').removeClass('not_top_row3');

						});
					}
				});

				not_animation_new = setTimeout( function(){
					is_running = 0;
					is_running_animation = 0;
					if(not_abort == 0 && focus == true){
						check_notification();
					}
				},6000);

			}
		}

		function loadfun_big_level(){
			$('.pop_ok_btn').unbind('click').click(function(){
				is_running = 0;
				is_running_animation = 0;

				if(focus == true){
					check_notification();
				}
			});
		}

			$('.not_close').unbind('click').click(function(){
				not_abort = 1;
				$('.notifications').hide();
				$('.not_time_left').stop();
				clearTimeout(not_animation_1); clearTimeout(not_animation_2); clearTimeout(not_animation_new);
				$('.not_time_left').css("width", "100%");
				$('.not_slot').animate({'margin-left': '600px'}, 200);
				$('.not_slot').hide();
					is_running = 0;
					setTimeout( function(){
						check_notification();
					},1000);
			});


</script>
<?php }?>





<script>
		var navileft = 0;
		var morepl = 0,morebm = 0;
		var left_width = 0;
			$('.navileft-btn').click(function () {

			left_width = $('.navileft').width() + 50;
			 //show
				 if(navileft == 0){
					 		$('body').addClass('stop_srolling');
					 	 $('.navileft').show();
						 $('.navileft').animate({left:'0'}, 200, function() {
						 	navileft = 1;

						});
				 }
			 //not show
				 if(navileft == 1){
					 $('body').removeClass('stop_srolling');
					 $('.navileft').animate({left:'-='+left_width}, 200, function() {
					 	$('.navileft').hide();
						navileft = 0;
					});

				 }
			 });

		//not show
			 $(document).mouseup(function (e)
			 {
				 if(navileft == 1){
					 var container = $('.navileft');
					 var container2 = $('.bm_container');
					 left_width = $('.navileft').width() + 50;

					if (!container.is(e.target) && container.has(e.target).length === 0 && !container2.is(e.target) && container2.has(e.target).length === 0){
						$('body').removeClass('stop_srolling');
						 	$('.navileft').animate({left:'-='+left_width}, 200, function() {
							 	$('.navileft').hide();
								navileft = 0;
							});

						}
					}
			 });

			//pls
			 $('.toggle_more_pls').click(function(){
				 if(morepl == 0){
					$('.more_pls_icon').removeClass('glyphicon-chevron-down');
					$('.more_pls_icon').addClass('glyphicon-chevron-up');
					$('.pl_more').removeClass('hide');
					morepl = 1;
	 		 	}else{
					$('.more_pls_icon').removeClass('glyphicon-chevron-up');
					$('.more_pls_icon').addClass('glyphicon-chevron-down');
	 				$('.pl_more').addClass('hide');
	 				morepl = 0;
	 			}
			 });



			 //bmset
			 function toHHMMSS(sec) {
				 var sec_num = parseInt(sec, 10); // don't forget the second param
				 var hours   = Math.floor(sec_num / 3600);
				 var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
				 var seconds = sec_num - (hours * 3600) - (minutes * 60);

				 if (hours   < 10) {hours   = "0"+hours;}
				 if (minutes < 10) {minutes = "0"+minutes;}
				 if (seconds < 10) {seconds = "0"+seconds;}
				 return hours+':'+minutes+':'+seconds;
			 }


			 $('.set_bm').click(function(){
				 if($(".set_bm_opt").hasClass('hide') == true){
					 //show pop up
					 var bm_ph_text = document.title.slice(0, -10);
					 $('.set_bm_ph_name').val(bm_ph_text);
						 $('.new_bm_error').addClass('hide');
						 $('.new_bm_error_index').addClass('hide');
					 $('.set_bm_opt').removeClass('hide');
					 $('.bookmark_dd_arrow').removeClass('hide');

					 if($('.video_container video').length) {
						$('.bm_watch_time').removeClass('hide');
						if($('.channel_home_main_container video').length) {
						 	$('.bm_time_check').prop('checked', false);
						}else{
							$('.bm_time_check').prop('checked', true);
						}
						bm_set_ctime();
					 }else{
						 $('.bm_watch_time').addClass('hide');
						 $('.bm_time_val').attr('time','');
						 $('.bm_time_val').html('00:00:00');
						 $('.bm_time_check').prop('checked', false);
					 }

				 }else{
					 $('.set_bm_opt').addClass('hide');
					 $('.bookmark_dd_arrow').addClass('hide');
				 }
			 });

			 $('.ctime_refresh').click(function(){
				 bm_set_ctime();
			 });


			 function bm_set_ctime(){
				 var player = videojs("we-teve_video");
				 var ctime = Math.round(player.currentTime());
				 $('.bm_time_val').attr('time',ctime);
				 var ctime2 = toHHMMSS(ctime);
				 $('.bm_time_val').html(ctime2);
			 }

			 function getUrlVars(url){
				 var vars = {};
				 var parts = url.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
				 vars[key] = value;
				 });
				 return vars;
			 }


			 $('.set_bm_add').click(function(){

				 var url = document.location.pathname;
				 var time_var = getUrlVars(url)['t'];
				 	if(time_var != ""){
						url = url.replace("&t="+time_var, "");
					}

				 var name = $('.set_bm_ph_name').val();

				 if($('.bm_time_check').is(":checked")){
					 var startat = "&t="+$('.bm_time_val').attr('time');
				 }else{
					 var startat = "";
				 }


				 if(url != "" && name != ""){
					 url = url+startat;
					 $.post('<?php echo $_dhp;?>bookmark/add',{'bookmark':url ,'bm_name':name},function(data){

						 if(data == 'error'){
							 $('.new_bm_error').removeClass('hide');
						 }else if(data == 'index_error'){
							 $('.new_bm_error_index').removeClass('hide');
						 }else{
							 //close pop up
							 $('.set_bm_opt').addClass('hide'); $('.bookmark_dd_arrow').addClass('hide');
							 //add bm in list
							 var newbm,bm1,bm2,bm3,bm4,bm5;

							 newbm = '<a title="'+name+'" class="navileft-link navileft-box" href="https://www.We-TeVe.com'+url+'"><div> <span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span> <span class="text no_overflow navileft-link navileft-text">'+name+'</span> </div></a>';
							 bm1 = $('.bm_fist_nr_1').html();
							 bm2 = $('.bm_fist_nr_2').html();
							 bm3 = $('.bm_fist_nr_3').html();
							 bm4 = $('.bm_fist_nr_4').html();
							 bm5 = $('.bm_fist_nr_5').html();

							 //schiebt den 5ten eintrag in more und den neuen als ersten
							 $('.bm_more').html(bm5+$('.bm_more').html());
							 $('.bm_fist_nr_4').html(bm3);
							 $('.bm_fist_nr_3').html(bm2);
							 $('.bm_fist_nr_2').html(bm1);
							 $('.bm_fist_nr_1').html(newbm);


							 setTimeout(function(){
									//show left
									if(navileft == 0){
										left_width = $('.navileft').width() + 50;
				 					 	$('body').addClass('stop_srolling');
				 					 	$('.navileft').show();
				 						$('.navileft').animate({left:'0'}, 200, function() {
				 						 	navileft = 1;
					 					});
					 				}
							 },100)

							 setTimeout(function(){
									//add blue back
									$('.bm_fist_nr_1 a').addClass('back_blue');
							 },600)

							 setTimeout(function(){
								 	//remove blue back
								  $('.bm_fist_nr_1 a').removeClass('back_blue');
							 },1400)


							 setTimeout(function(){
								 //close left
								 if(navileft == 1){
									 left_width = $('.navileft').width() + 50;
									 $('body').removeClass('stop_srolling');
									 $('.navileft').animate({left:'-='+left_width}, 200, function() {
											$('.navileft').hide();
											navileft = 0;
										});
									}
							 },1800)


					 	 }
					 });
				 }
			 });



			 //bmlist
			 $('.toggle_more_bms').click(function(){
				 if(morebm == 0){
					$('.more_bms_icon').removeClass('glyphicon-chevron-down');
					$('.more_bms_icon').addClass('glyphicon-chevron-up');
					$('.bm_more').removeClass('hide');
					morebm = 1;
				}else{
					$('.more_bms_icon').removeClass('glyphicon-chevron-up');
					$('.more_bms_icon').addClass('glyphicon-chevron-down');
					$('.bm_more').addClass('hide');
					morebm = 0;
				}
			 });


			 //bm edit menu
			$(document).ready(function() {
				 $('.bm_navi_title').unbind('click').click(function(){
					 $('.bm_container_bg').removeClass('hide');
					 $('.bm_pm_title').removeClass('hide');
					 $('.sub_group_pm_title').addClass('hide');

					 $('.body').addClass('stop_srolling');
					 	if(navileft == 1){
							 $('.navileft').animate({left:'-='+left_width}, 200, function() {
								$('.navileft').hide();
								navileft = 0;
							});
						 }

						 $.post('<?php echo $_dhp; ?>bookmark/bookmarks',function(data){
							 $('.bm_scroll_container').html(data);
						 });
				 });

				 $('.bm_close_btn').click(function(){
					 $('.bm_container_bg').addClass('hide');
					 $('.body').removeClass('stop_srolling');
				 });

				 $('.bm_container_bg').mouseup(function (e){
						 var container = $('.bm_container');
						 if (!container.is(e.target) && container.has(e.target).length === 0){
								$('.bm_container_bg').addClass('hide');
								$('.body').removeClass('stop_srolling');
						 }
			 });
			});




		</script>
