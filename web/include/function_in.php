<?php
class functions extends comments{
	//'extends time' fügt die andere Class hinzu

	public function autolink($str, $attributes=array()) {

		$http_re = array('https' => ' https','http' => ' http');
		$str = str_replace(array_keys($http_re),array_values($http_re), $str);

		$http_re = array('  https' => ' https','  http' => ' http');
		$str = str_replace(array_keys($http_re),array_values($http_re), $str);

				$attrs = '';
				foreach ($attributes as $attribute => $value) {
				$attrs .= " {$attribute}=\"{$value}\"";
				}
			$str = ' ' . $str;
			$str = preg_replace(
				'`([^"=\'>])(((http|https|ftp)://|www.)[^\s<]+[^\s<\.)])`i',
				'$1<a href="$2"'.$attrs.'>$2</a>',
				$str
			);
			$str = substr($str, 1);
			$str = preg_replace('`href=\"www`','href="http://www',$str);
			// fügt http:// hinzu, wenn nicht vorhanden
			return $str;
	}

	public function normtext($input){
		$sonderzeichen = array(
			'<' => '&lt;',
			'>' => '&gt;',
			"'" => '&#39;',
			"\'" => '&#39;',
			"(" => '&#40;',
			")" => '&#41;',
			"{" => '&#123;',
			"}" => '&#125;',
			"[" => '&#91;',
			"]" => '&#93;',
			"\\" => '&#92;'
		);
		$output = str_replace(array_keys($sonderzeichen),
			array_values($sonderzeichen), $input);

		return $output;
	}


	public function embty_test($text){

		$zeichen = array(
			'      ' => '',
			'     ' => '',
			'    ' => '',
			'   ' => '',
			'  ' => '',
			'\n\n\n\n' => '',
			'\n\n\n' => '',
			'\n\n' => '',
			'\n' => '',
			'\n \n \n \n ' => '',
			'\n \n \n ' => '',
			'\n \n ' => '',
			'\n ' => '',
			' \n \n \n \n' => '',
			' \n \n \n' => '',
			' \n \n' => '',
			' \n' => '',
			'<br>\n <br>\n <br>\n <br>\n' => '',
			'<br>\n <br>\n <br>\n' => '',
			'<br>\n <br>\n' => '',
			'<br>\n' => '',
			'<br><br><br><br>' => '',
			'<br><br><br>' => '',
			'<br><br>' => '',
			'<br>' => '',
			'<div><br></div><div><br></div><div><br></div><br>' => '',
			'<div><br></div><div><br></div><br>' => '',
			'<div><br></div><br>' => '',
			'<br>' => '',
			'<br> <br> <br> <br>' => '',
			'<br> <br> <br>' => '',
			'<br> <br>' => '',
			'<br>' => '',
			'&nbsp;&nbsp;&nbsp;&nbsp;' => '',
			'&nbsp;&nbsp;&nbsp;' => '',
			'&nbsp;&nbsp;' => '',
			'&nbsp;' => '',
		);
		$text = str_replace(array_keys($zeichen),
			array_values($zeichen), $text);

		//just to be sure -  muss sein.
		$text = str_replace(array_keys($zeichen),
			array_values($zeichen), $text);

		return $text;
	}


	public function mk_code($length) {
		$alphabet = "abcdefghjkmnpqrstuwxyzABCDEFGHJKMNPQRSTUWXYZ123456789";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < $length; $i++) {
				$n = rand(0, $alphaLength);
				$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}


	public function mk_key($length) {
	  $alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789%&/()=?!;:,._-{[]}#";
	  $pass = array(); //remember to declare $pass as an array
	  $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	  for ($i = 0; $i < $length; $i++) {
	      $n = rand(0, $alphaLength);
	      $pass[] = $alphabet[$n];
	  }
	  return implode($pass); //turn the array into a string
	}


	public function mk_kuid(){
		$check = 0;
		while ($check != 1) {

			$alphabet = "abcdefghjkmnopqrstuwxyzABCDEFGHJKMNOPQRSTUWXYZ0123456789";
			$pass = array(); //remember to declare $pass as an array
			$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
			for ($i = 0; $i < 10; $i++) {
					$n = rand(0, $alphaLength);
					$pass[] = $alphabet[$n];
			}

			$kuid = implode($pass);

			//test ob es das kuid schon gibt
			$check_sql = db::$link->query("SELECT kuid FROM kommentar_db WHERE kuid = '$kuid'");
			$check_row = $check_sql->fetch_assoc();

			if($check_row['kuid'] == ""){
				$check = 1;
			}

		}

		return $kuid;
	}



	public function mk_uuid(){
		$check = 0;
		while ($check != 1) {

			$alphabet = "abcdefghjkmnopqrstuwxyzABCDEFGHJKMNOPQRSTUWXYZ0123456789";
			$pass = array(); //remember to declare $pass as an array
			$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
			for ($i = 0; $i < 12; $i++) {
					$n = rand(0, $alphaLength);
					$pass[] = $alphabet[$n];
			}

			$uuid = implode($pass);

			//test ob es das kuid schon gibt
			$check_sql = db::$link->query("SELECT uuid FROM user_find_db WHERE uuid = '$uuid'");
			$check_row = $check_sql->fetch_assoc();
				if($check_row['uuid'] == ""){
					$check = 1;
				}

		}
		return $uuid;
	}



	public function draw_category($cat,$label){

		if($label == 1){
			switch ($cat) {
				case 'ent':
					$cat_e =  '<i class="fa fa-desktop" aria-hidden="true"> </i>'.$this->cat_ent_title;
					break;

				case 'com':
					$cat_e =  '<i class="fa fa-smile-o" aria-hidden="true"> </i>'.$this->cat_com_title;
					break;

				case 'mov':
					$cat_e =  '<i class="fa fa-film" aria-hidden="true"> </i>'.$this->cat_mov_title;
					break;

				case 'mus':
					$cat_e =  '<i class="fa fa-music" aria-hidden="true"> </i>'.$this->cat_mus_title;
					break;

				case 'gam':
					$cat_e =  '<i class="fa fa-gamepad" aria-hidden="true"> </i>'.$this->cat_gam_title;
					break;

				case 'eat':
					$cat_e =  '<i class="fa fa-cutlery" aria-hidden="true"> </i>'.$this->cat_eat_title;
					break;

				case 'spo':
					$cat_e =  '<i class="fa fa-futbol-o" aria-hidden="true"> </i>'.$this->cat_spo_title;
					break;

				case 'vlo':
					$cat_e =  '<i class="fa fa-camera-retro" aria-hidden="true"> </i>'.$this->cat_vlo_title;
					break;

				case 'ads':
					$cat_e =  '<i class="fa fa-money" aria-hidden="true"> </i>'.$this->cat_ads_title;
					break;


				default:
					$cat_e = "";
					break;
			}

		}elseif($label == 0){

			switch ($cat) {
				case 'ent':
					$cat_e =  '<i title="'.$this->cat_ent_title.'" class="fa fa-desktop" aria-hidden="true"> </i>';
					break;

				case 'com':
					$cat_e =  '<i title="'.$this->cat_com_title.'" class="fa fa-smile-o" aria-hidden="true"> </i>';
					break;

				case 'mov':
					$cat_e =  '<i title="'.$this->cat_mov_title.'" class="fa fa-film" aria-hidden="true"> </i>';
					break;

				case 'mus':
					$cat_e =  '<i title="'.$this->cat_mus_title.'" class="fa fa-music" aria-hidden="true"> </i>';
					break;

				case 'gam':
					$cat_e =  '<i title="'.$this->cat_gam_title.'" class="fa fa-gamepad" aria-hidden="true"> </i>';
					break;

				case 'eat':
					$cat_e =  '<i title="'.$this->cat_eat_title.'" class="fa fa-cutlery" aria-hidden="true"> </i>';
					break;

				case 'spo':
					$cat_e =  '<i title="'.$this->cat_spo_title.'" class="fa fa-futbol-o" aria-hidden="true"> </i>';
					break;

				case 'vlo':
					$cat_e =  '<i title="'.$this->cat_vlo_title.'" class="fa fa-camera-retro" aria-hidden="true"> </i>';
					break;

				case 'ads':
					$cat_e =  '<i title="'.$this->cat_ads_title.'" class="fa fa-money" aria-hidden="true"> </i>';
					break;


				default:
					$cat_e  = "";
					break;
			}

		}
		/*
		 ent -> entertainment
		 mov -> movie
		 mus -> music
		 gam -> gameing
		 eat -> eating / food
		 spo -> sport
		 vlo -> vlogs
		 ads -> Werbung
		*/

		return $cat_e;

	}



	public function draw_video_pewview($vuid,$hide_avatar,$type,$link_add,$_dhp,$_ddhp,$size,$autoplay){

		$video_sql = db::$link->query("SELECT * FROM video_db WHERE vuid = '$vuid' LIMIT 1");
		$video_row = $video_sql->fetch_assoc();
		if($video_row['vuid'] != ""){ //if video verfügbar


			if($this->isUserLoggedIn() === 1){
				$user_uuid = $this->userin('uuid',0,'this','');
			}else{
				$user_uuid = "_";
			}

			$views 					= $video_row['views'];
			$video_uuid 		= $video_row['uuid']; $video_uuif = sha1(sha1($video_uuid));
			$sonderzeichen = array(
				'&auml;' => 'ä',
				'&uuml;' => 'ü',
				"&ouml;" => 'ö',
			);
						$video_title = str_replace(array_keys($sonderzeichen),
					array_values($sonderzeichen), $video_row['video_title']);
			$dauer 					= $video_row['dauer'];
			$color 					= $video_row['color'];
			$color2 				= $video_row['color2'];
			$lang 					= $video_row['sprache'];
			$info 					= $video_row['info'];
			$uploaddate 		= $video_row['uploaddate'];
			$cat						= $video_row['kategorie'];
			$privacy				= $video_row['privacy'];
			$status					= $video_row['status'];


	    $views_erg = $views;
	    $views = number_format($views_erg,0, ",", ".");

	    $row_dauer = $dauer;
			$dauer = $this->sekinzeit($row_dauer);

	    //video_tipp_link (l = link)
	    $video_link = $_dhp."watch/".$vuid.$link_add;

	    //video_thumb
			if($size == "large"){
				$size_l = 1;
	    	$video_thumb 		= $_ddhp."images/thumb/large_img/".$vuid.".jpg";
			}else{
				$size_l = 0;
				$video_thumb 		= $_ddhp."images/thumb/small_img/".$vuid.".jpg";
			}
			$video_preview 	= "thumb_preview";

			//video category
			$video_category = $this->draw_category($cat,0);

			//video info
			$video_info = str_replace("<br>", "\n", $info);
			$video_info = htmlentities($video_info, ENT_QUOTES);
			$video_info = str_replace("\n", "<br>", $video_info);

	    //video_tipp_link
	    $fullvideotitle = htmlentities($video_title, ENT_QUOTES);//for title
			$videotitle = htmlentities($video_title, ENT_QUOTES);

	    //upload_datum
		    //$uploadedate = date($time_format_day , $uploaddate);
		    $uploaddate = $this->invor($uploaddate);

			//lang
				$lang = $this->draw_lang($lang,0);

			//errors
			if($privacy == "privat" AND $user_uuid != $video_uuid){
				$video_thumb		= $_ddhp."images/thumb/error.jpg";
				$video_preview 	= "";
				$fullvideotitle = $this->watch_error_msg5;
				$videotitle			= $this->watch_error_msg5;
				$info						= $this->watch_error_msg5;
				$video_category	= "";
				$color 					= "#818181";
				$color2 				= "#818181";
				$lang						= "";
				$row_dauer			= 0;
				$dauer					= "";
				$views					= 0;

			}elseif($status == "deleted"){
				$video_thumb		= $_ddhp."images/thumb/error.jpg";
				$video_preview 	= "";
				$fullvideotitle = $this->watch_error_msg0;
				$videotitle			= $this->watch_error_msg0;
				$info						= $this->watch_error_msg0;
				$video_category	= "";
				$color 					= "#818181";
				$color2 				= "#818181";
				$lang						= "";
				$row_dauer			= 0;
				$dauer					= "";
				$views					= 0;

			}elseif($status != "uploaded"){
				$video_thumb		= $_ddhp."images/thumb/error.jpg";
				$video_preview 	= "";
				$fullvideotitle = $this->watch_error_msg3;
				$videotitle			= $this->watch_error_msg3;
				$info						= $this->watch_error_msg3;
				$video_category	= "";
				$color 					= "#818181";
				$color2 				= "#818181";
				$lang						= "";
				$row_dauer			= 0;
				$dauer					= "";
				$views					= 0;
			}

		}else{ //wenn video nicht verfügbar
			$video_thumb		= $_ddhp."images/thumb/error.jpg";
			$video_preview 	= "thumb_preview";
			$fullvideotitle = $this->watch_error_msg4;
			$videotitle			= $this->watch_error_msg4;
			$info						= $this->watch_error_msg4;
			$video_category	= "";
			$color 					= "#818181";
			$color2 				= "#818181";
			$lang						= "";
			$row_dauer			= 0;
			$dauer					= "";
			$views					= 0;
			$size_l	 				= 1;
			$video_uuif			= "";
			$video_uuid			= "";
			$video_link			= $video_link = $_dhp."watch/".$vuid.$link_add;
			$uploaddate			= "0";
			$hide_avatar 		= 1;
		}

		if($type == "ver"){

			//userinfo
				if($hide_avatar == 0){
						$video_user_name 	= $this->userin('name',0,$video_uuif,'');
						$video_user_avatar = $_ddhp.$this->draw_avatar($video_uuid,"small");
				}

				echo "<div class='thumb_ver'>";
					echo"<a class='thumb_preview_link video_link' href='".$video_link."' data-name='".$video_link."' ><img alt='".$fullvideotitle."' id='' data-vuid='".$vuid."' data-large='".$size_l."' data-time='".$row_dauer."' data-path='".$_ddhp."' class='".$video_preview."' src='".$video_thumb."'";?> onerror="this.src = '<?php echo $_dhp; ?>images/thumb/error.jpg'" <?php echo"/>";
						echo "<div class='thumb_preview_counter hide'>1/20</div>";
						echo "<span id='thumb_video-".$vuid."' class='main_thumb_hover thumb_hover'></span>";
					echo"</a>";

					echo "<div class='thumb-info' style='background-color: ".$color."; color: ".$color2.";'>";
						echo $video_category;
						echo"<span class='category' aria-hidden='true'>".$lang."</span>";
						echo"<span class='right'>".$dauer."</span>";
					echo"</div>";


						if($hide_avatar == 0){
							echo "<div class='thumb_vid_box'>";
								echo"<div class='thumb_vid_title no_overflow blue'><b><a href='".$video_link."' title='".$fullvideotitle."'>".$videotitle."</a></b></div>";
								echo"<a title='".$video_user_name."' href='".$_dhp."user/".$video_user_name."'><img class='small_avatar avatar' src='".$video_user_avatar."'></a>";
								echo"<div class='thumb_vid_date thumb_vid_av'>".$uploaddate."</div>";
								echo"<div class='thumb_vid_vote thumb_vid_av'>".$views." ".$this->views_title."</div>";
								echo "<div style='clear:both'></div>";
							echo "</div>";
						}else{
							echo "<div class='thumb_vid_box'>";
								echo"<div class='thumb_vid_title no_overflow blue'><b><a href='".$video_link."' title='".$fullvideotitle."'>".$videotitle."</a></b></div>";
								echo"<div class='thumb_vid_date'>".$uploaddate."</div>";
								echo"<div class='thumb_vid_vote'>".$views." ".$this->views_title."</div>";
								echo "<div style='clear:both'></div>";
							echo "</div>";
						}
					echo "</div>";

		}elseif($type == "hor"){

			//userinfo
				$video_user_name 	= $this->userin('name',0,$video_uuif,'');
				$video_user_avatar = $_ddhp.$this->draw_avatar($video_uuid,"small");

				echo "<div class='thumb_hor'>";
					echo "<div class='thumb_holder'>";
						echo "<div class='thumb-thumb_box'>";
							echo"<a href='".$video_link."' class='thumb_preview_link video_link' data-name='".$video_link."' ><img alt='".$fullvideotitle."' id='' data-vuid='".$vuid."' data-large='".$size_l."' data-time='".$row_dauer."' data-path='".$_ddhp."' class='".$video_preview."' src='".$video_thumb."'";?> onerror="this.src = '<?php echo $_dhp; ?>images/thumb/error.jpg'" <?php echo"/>";
								echo "<div class='thumb_preview_counter hide'>1/20</div>";
								echo "<span id='thumb_video-".$vuid."' class='main_thumb_hover thumb_hover'></span>";
							echo"</a>";

								echo "<div class='thumb-info' style='background-color: ".$color."; color: ".$color2.";'>";
									echo "<span cat='ent' class='pre_cat'>".$video_category."</span>";
									echo "<span class='pre_lang category' aria-hidden='true'>".$lang."</span>";
									echo"<span class='right'>".$dauer."</span>";
								echo"</div>";
						echo "</div>";

						echo "<div class='thumb-info_box'>";
							if($autoplay == 0){ //click to play next
								echo"<div class='thumb_video_title no_overflow blue'><a href='".$video_link."' title='".$fullvideotitle."'>".$videotitle."</a></div>";
									echo"<a class='user_name' title='".$video_user_name."' href='".$_dhp."user/".$video_user_name."'><img class='small_avatar avatar' src='".$video_user_avatar."'>".$video_user_name."</a>";
									if($hide_avatar == 0){echo"<div class='thumb_video_info'> <div class='thumb_video_info_txt no_overflow'>".$video_info."</div> </div>";}
									echo "<div class='w-100'>";
										echo"<p class='thumb_video_date left'>".$uploaddate." <b> · </b> ".$views." ".$this->views_title." </p>";
									echo "</div>";
							}else{
							echo "<div class='thumb_play_next thumb_play_next_1' vuid='".$vuid."' title='".$this->morev_play_next."'> <span class='glyphicon glyphicon-step-forward'></span> </div>";
								echo"<div class='thumb_video_title thumb_auto_video_title no_overflow blue'><a href='".$video_link."' title='".$fullvideotitle."'>".$videotitle."</a></div>";
									echo"<a class='user_name' title='".$video_user_name."' href='".$_dhp."user/".$video_user_name."'><img class='small_avatar avatar' src='".$video_user_avatar."'>".$video_user_name."</a>";
									if($hide_avatar == 0){echo"<div class='thumb_video_info'> <div class='thumb_video_info_txt no_overflow'>".$video_info."</div> </div>";}
									echo "<div class='w-100'>";
										echo"<p class='thumb_video_date left'>".$uploaddate." <b> · </b> ".$views." ".$this->views_title." </p>";
									echo "</div>";
									echo "<div class='w-100 left'> <div class='thumb_play_next thumb_play_next_2' vuid='".$vuid."'>".$this->morev_play_next."</div> </div>";
							}
						echo "</div><div style='clear:both;'></div>";
					echo "</div>";
				echo "</div>";

		}elseif($type == "none"){
			echo "<div class='thumb_none'>";
				echo "<div class='thumb_holder'>";
					echo "<div class='thumb-thumb_box'>";
						echo"<a href='".$video_link."' class='video_link' data-name='".$video_link."' ><img alt='".$fullvideotitle."' id='' data-vuid='".$vuid."' data-large='".$size_l."' data-time='".$row_dauer."' data-path='".$_ddhp."' class='".$video_preview."' src='".$video_thumb."'";?> onerror="this.src = '<?php echo $_dhp; ?>images/thumb/error.jpg'" <?php echo"/>";
							echo "<div class='thumb_preview_counter hide'>1/20</div>";
							echo "<span id='thumb_video-".$vuid."' class='main_thumb_hover thumb_hover'></span>";
						echo"</a>";

							echo "<div class='thumb-info' style='background-color: ".$color."; color: ".$color2.";'>";
								echo $video_category;
								echo"<span class='category' aria-hidden='true'>".$lang."</span>";
								echo"<span class='right'>".$dauer."</span>";
							echo"</div>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
		}

	}


	public function draw_playlist_pewview($puid,$type,$_dhp,$_ddhp){

		//data
			$video_sql = db::$link->query("SELECT * FROM playlist_db WHERE puid = '$puid'");
			$plist_row = $video_sql->fetch_assoc();

			$pl_views 			= $plist_row['views'];
			$pl_thumb 			= $plist_row['thumb'];
			$pl_title 			= $plist_row['title'];
			$pl_title 			= htmlentities($pl_title, ENT_QUOTES);
			$pl_orderby 		= $plist_row['orderby'];
			$time 					= $plist_row['time'];


			$views_erg 	= $pl_views;
			$views 			= number_format($views_erg,0, ",", ".");

			$time 			= $this->invor($time);

			//videos
				$sql_video 		= db::$link->query("SELECT COUNT(pl_id) FROM playlist_content_db WHERE puid = '$puid' AND status = 'public'");
				$get_video 		= $sql_video->fetch_row();
				$videoscount 	= $get_video[0];

				//pl thumb
					if($pl_orderby == 0)		 		{ $thumb_res = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY posi ASC LIMIT 1");
					}elseif($pl_orderby  == 1)	{ $thumb_res = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at DESC LIMIT 1");
					}elseif($pl_orderby  == 2)	{ $thumb_res = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at ASC LIMIT 1");
					}elseif($pl_orderby  == 3)	{ $thumb_res = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate DESC LIMIT 1");
					}elseif($pl_orderby  == 4)	{ $thumb_res = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate ASC LIMIT 1");
					}

					$get_pl_info 		= $thumb_res->fetch_assoc();
					$first_video_vuid = $get_pl_info['vuid'];


				if($pl_thumb == "norm"){
					$pl_thumb = $first_video_vuid;
				}else{
					//Es ist möglich eine anders Video als thumb zu wählen dafür nur die vuid in thumb speichern.
					$pl_thumb = $pl_thumb;
				}

				//teste ob video auch wirklich gibt
				$sql_video_bank		= db::$link->query("SELECT vuid FROM video_db WHERE vuid = '$pl_thumb'");
				$get_video_info		= $sql_video_bank->fetch_assoc();
				$pl_m_thumb 			= $get_video_info['vuid'];

				$pl_thumb 				= $_ddhp."images/thumb/small_img/".$pl_m_thumb.".jpg";


				$pl_link 					= $_dhp."playlist/".$puid;
				$pl_video_link 		= $_dhp."watch/".$first_video_vuid."&pl=".$puid;




	//echo
		if($type == "ver"){

			echo "<div class='plist_ver'>";
				echo"<a class='plist_preview_link' href='".$pl_video_link ."'>";
					echo"<img alt='".$pl_title ."' class='plist_preview' src='".$pl_thumb."'";?> onerror="this.src = '<?php echo $_dhp; ?>images/thumb/error.jpg'" <?php echo"/>";
				echo"</a>";

				echo"<a class='plist_info_right' href='".$pl_link ."'>";
					echo "<div class='plist_info_center'>";
						echo $videoscount."<br>".$this->pl_video_titel0;
					echo "</div>";
				echo"</a>";

				echo "<div class='plist-info_box'>";
					echo"<div class='plist_title no_overflow blue'><b><a href='".$pl_video_link ."' title='".$pl_title."'>".$pl_title."</a></b></div>";
						echo "<div class='w-100'>";
							echo"<div class='plist_time left'>".$time."</div>";
							echo"<div class='plist_date right'>".$views." ".$this->views_title." </div>";
						echo "</div><div style='clear:both;'></div>";
				echo "</div>";

			echo "</div>";

		}else{

		}


	}



	public function draw_user_preview($uuid,$_dhp){

		$abo_channel_uuid = $uuid;
		$abo_channel_uuif = sha1(sha1($abo_channel_uuid));

		$abo_channel_sql = db::$link->query("SELECT * FROM user_find_db WHERE uuid = '$abo_channel_uuid' AND status = 'public'");
		$abo_channel_row = $abo_channel_sql->fetch_assoc();

		$abo_channel_name  = $abo_channel_row['user_name'];
		$abo_channel_land  = $abo_channel_row['land'];
		$abo_channel_xp    = $abo_channel_row['xp'];
		$abo_channel_subs  = $abo_channel_row['abos'];
		$abo_channel_sub_n = number_format($abo_channel_subs,0, ",", ".");

		$abo_channel_avatar     = $_dhp.$this->draw_avatar($abo_channel_uuid,"large");
		$abo_channel_land_img   = $this->draw_land($abo_channel_land,0);


		$abo_channel_xp = $abo_channel_xp;

			if($abo_channel_xp >= $this->lvlinfo('txp','1000')){ $abo_channel_level = 1000; $abo_channel_levelup = 1000; $abo_channel_levelfortschrit = 0; }
			elseif($abo_channel_xp == 0){$abo_channel_level = 0; $abo_channel_levelup = 1; $abo_channel_levelfortschrit = 0;
			}else{

				$abo_channel_level = $this->lvlinfo('level',$abo_channel_xp);

				$abo_channel_levelup = $abo_channel_level + 1;


				$abo_channel_xplevel_for_this_level = $this->lvlinfo('txp',$abo_channel_level);
				$abo_channel_xplevel_for_next_level = $this->lvlinfo('txp',$abo_channel_levelup);

				$abo_channel_xplevel_needed_for_next_level = $this->lvlinfo('xp',$abo_channel_levelup);
				$abo_channel_xplevel_over = $abo_channel_xp - $abo_channel_xplevel_for_this_level;

				//wie viel Prozent der ramne gefüllt sein soll
				$abo_channel_levelfortschrit = 84;
			}
			$abo_channel_b_level = $this->lvlicon('b',$abo_channel_level); $abo_channel_n_level = $this->lvlicon('n',$abo_channel_level);
			$abo_channel_c_level = $this->lvlicon('c',$abo_channel_level); $abo_channel_f_level = $this->lvlicon('f',$abo_channel_level);


		echo "<a class='video_user_avatar' href='".$_dhp."user/".$abo_channel_name."'><img alt='".$abo_channel_avatar."' class='middle_avatar avatar' title='".$abo_channel_name."' src='".$abo_channel_avatar."'></a>";

		echo "<div class='username'>";
			echo "<a class='no_overflow username_text' title='".$abo_channel_name."' href='".$_dhp."user/".$abo_channel_name."'>".$abo_channel_name."</a>";
			echo "<a href='".$_dhp."results?lf=".$abo_channel_land."' >                                   <div class='video_user_land'>                                 	".$abo_channel_land_img."             </div> </a>";
			echo "<a href='".$_dhp."user/".$abo_channel_name."/achv'>   <div class='video_user_level f_color_".$abo_channel_c_level."'> ".$abo_channel_level."            </div> </a>";
		echo "</div>";


		//Abobutton
		$abo_channel_user_subs = $abo_channel_subs;

		if($this->isUserLoggedIn() === 1){
			$user_uuid = $this->userin('uuid',0,'this','');
			$abo_sql = db::$link->query("SELECT abo_id FROM abo_db WHERE abo_user_uuid = '$abo_channel_uuid' AND user_uuid = '$user_uuid' AND status = 'public'");
			$abo_row = $abo_sql->fetch_assoc();

			if($abo_row['abo_id'] != ""){
				echo "<div class='sub_container'>";
					echo "<div user='".$abo_channel_uuid."' class='sub_btn sub_btn_".$abo_channel_uuid." blue_btn button left pad-5' aria-label='Left Align'>";
						echo "<span class='abo_subed'>".$this->sub_subed."</span> <span class='abo_sub hide'>".$this->sub_sub."</span>";
					echo "</div>";
					//echo "<div sub_uuid='".$abo_channel_uuid."' class='sub_more_opt'> <span class='glyphicon glyphicon-option-vertical'></span> </div>";
					echo "<div class='abo_count pad-5 left user-".$abo_channel_uuid." gray_btn nh-button'>".$abo_channel_sub_n."</div>";
				echo "</div>";
			}else{
				echo "<div class='sub_container'>";
					echo "<div user='".$abo_channel_uuid."' class='sub_btn sub_btn_".$abo_channel_uuid." blue_btn button left pad-5' aria-label='Left Align'>";
						echo "<span class='abo_subed hide'>".$this->sub_subed."</span> <span class='abo_sub'>".$this->sub_sub."</span>";
					echo "</div>";
					//echo "<div sub_uuid='".$abo_channel_uuid."' class='sub_more_opt'> <span class='glyphicon glyphicon-option-vertical'></span> </div>";
					echo "<div class='abo_count pad-5 left user-".$abo_channel_uuid." gray_btn nh-button'>".$abo_channel_sub_n."</div>";
				echo "</div>";
			}
		}else{
			echo "<div class='sub_container'>";
				echo "<a href='".$_dhp."login/'  user='".$abo_channel_uuid."' class='sub_btn blue_btn button left pad-5 pad-top-9' aria-label='Left Align'>";
					echo "<span class='abo_subed hide'>".$this->sub_subed."</span> <span class='abo_sub'>".$this->sub_sub."</span>";
				echo "</a>";
				echo "<div class='abo_count pad-5 left user-".$abo_channel_uuid." gray_btn nh-button'>".$abo_channel_sub_n."</div>";
			echo "</div>";
		}
		//end abobutton
	}



	public function isbloked($fist_uuid,$second_uuid,$use){
		//use / blocktype
			// 1 = fullblock
			// 2 = friends_request
			// 3 = comments

		$checkblock_sql = db::$link->query("SELECT type FROM block_db WHERE first_uuid = '$fist_uuid' AND second_uuid = '$second_uuid'");
		$checkblock_row = $checkblock_sql->fetch_assoc();

		if($checkblock_row['type'] == 1 OR $checkblock_row['type'] == $use){
			return true;
		}else{
			return false;
		}

	}




	public function checktoken($token,$use){

		$token_error = 0;

		//user
		if($this->isUserLoggedIn() === 1){
			$user_uuid = $this->userin('uuid',0,'this','');
		}else{
			$user_uuid = $_SERVER['REMOTE_ADDR'];
		}

		//date
		$time = strtotime(date('Y-m-d H:i:s'));

		$token_sql = db::$link->query("SELECT * FROM token_db WHERE token = '$token' AND token_use = '$use' ORDER BY time DESC");
		$token_row = $token_sql->fetch_assoc();

		if($token_row['token'] != ""){
			$token_user 		= $token_row['user'];
			$next_use_time 	= $token_row['next_use_time'];

			if($token_user == $user_uuid){
				if($next_use_time > $time){
					$token_error = 1;
				}
			}else{
				$token_error = 1;
			}
		}else{
			$token_error = 1;
		}

		if($token_error == 0){
			return "ok";
		}else{
			return "error";
		}

	}



	public function settoken($use,$extra){  //set session key

		//user
		if($this->isUserLoggedIn() === 1){
			$user_uuid = $this->userin('uuid',0,'this','');
		}else{
			$user_uuid = $_SERVER['REMOTE_ADDR'];
		}

		//date
			$time = strtotime(date('Y-m-d H:i:s'));
			$deltime = $time - 86400; //-24h

		//check für bestehende tokens
			$token_sql = db::$link->query("SELECT * FROM token_db WHERE user = '$user_uuid' AND token_use = '$use' ORDER BY time DESC");
			$token_row = $token_sql->fetch_assoc();

			if($token_row['token'] != ""){
				$last_token 					= intval($token_row['token']);
				$last_time_pause 			= intval($token_row['time_pause']);
				$last_next_use_time 	= intval($token_row['next_use_time']);

					if($use == 'login'){

						if($extra === true){
							$new_time_pause = 0;
							$new_next_use_time = $time;

							//del tokens
								$del_token = "DELETE FROM token_db WHERE user = '$user_uuid' AND token_use = '$use'";
								$del_token = db::$link->query($del_token);

						}elseif($extra === false){
							if($last_time_pause == 0){$new_time_pause = 1;}else{$new_time_pause = $last_time_pause * 2;}
							$new_next_use_time = $time + $new_time_pause;

							//del tokens
								$del_token = "DELETE FROM token_db WHERE user = '$user_uuid' AND token_use = '$use'";
								$del_token = db::$link->query($del_token);
						}

					}elseif($use == 'com' OR $use == 'vid_like' OR $use == 'com_like'){
						if($extra != 'blanc'){
								//abkling zeit
								if($last_time_pause == 0){
									$last_time_pause = 2;
									if($last_next_use_time + 4 > $time){ $overtime = 1; }else{ $overtime = 0; }
								}else{
									if($last_next_use_time + $last_time_pause > $time){ $overtime = 1; }else{ $overtime = 0; }
								}

								if($overtime == 1){ //abkling zeit nicht resetten
									$new_time_pause = $last_time_pause * 2;
									$new_next_use_time = $time + $last_time_pause * 2;
								}else{
									$new_time_pause = 0;
									$new_next_use_time = $time;

									//del tokens
										//$del_token = "DELETE FROM token_db WHERE user = '$user_uuid' AND token_use = '$use'";
										//$del_token = db::$link->query($del_token);
										//--> löscht leider alle tokens mit dem selben use,
								}
						}else{
							$new_time_pause 		= $last_time_pause;
							$new_next_use_time 	= $last_next_use_time;

							//del tokens
								//$del_token = "DELETE FROM token_db WHERE user = '$user_uuid' AND token_use = '$use'";
								//$del_token = db::$link->query($del_token);
						}
					}

			}else{
				$new_time_pause = 0;
				$new_next_use_time = $time;
			}


				//erstellt Token
					$alphabet = "abcdefghijlkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_.*%!?";
					$pass = array(); //remember to declare $pass as an array
					$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
					for ($i = 0; $i < 80; $i++) {
							$n = rand(0, $alphaLength);
							$pass[] = $alphabet[$n];
					}
					$new_token = implode($pass); //turn the array into a string



		//erstellt ein neues Token
			$set_token = "INSERT INTO token_db
						(token,token_use,user,time_pause,next_use_time,time)
						VALUES
						('$new_token','$use','$user_uuid','$new_time_pause','$new_next_use_time','$time')";
			$set_token = db::$link->query($set_token);


		//lösche alle Token die älter als 24 Studnen alt sind.
			$del_token = "DELETE FROM token_db WHERE time < '$deltime'";
			$del_token = db::$link->query($del_token);

		if($set_token == true){
			return $new_token;
		}

	}




}//end class

$f = new functions;




//$f->setkey;


?>
