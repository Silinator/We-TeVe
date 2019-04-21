<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = ''; //für include
$_dhp = "../../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

if(isset($_GET['u']) AND $_GET['u'] != ""){

  $channel = $_GET['u'];
  $channel = mysqli_real_escape_string(db::$link,$channel);

  $channel_smart = strtolower($channel);


  $channel_find_sql = db::$link->query("SELECT * FROM user_find_db WHERE user_name_s = '$channel_smart'");
  $channel_find_row = $channel_find_sql->fetch_assoc();

  if($channel_find_row['uuid'] != ""){
    $channel_uuid = $channel_find_row['uuid'];
    $channel_uuif = sha1(sha1($channel_uuid));
    $channel_name  = $channel_find_row['user_name'];
    $channel_subs  = $channel_find_row['abos'];
    $channel_sub_n = number_format($channel_subs,0, ",", ".");
    $channel_land  = $channel_find_row['land'];
    $channel_xp    = $channel_find_row['xp'];

      //3. site vals
      $html_title = $channel_name." | We-TeVe"; //Tap title
      $item_per_page = 24;

  }else{
        //3. site vals
        $channel_name = ""; $channel_uuid = "main";
        $html_title = "404 Channel not found | We-TeVe"; //Tap title
  }

}else{
    //3. site vals
    $channel_name = ""; $channel_uuid = "main";
    $html_title = "404 Channel not found | We-TeVe"; //Tap title
}


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

      //twitter infos
      if(isset($channel_uuid)){
        $tw_channel_design = db::$link->query("SELECT * FROM channel_design_db WHERE uuid = '$channel_uuid'");
        $tw_channel_design = $tw_channel_design->fetch_assoc();
          $twitter_info = $tw_channel_design['info_full_text'];
          $twitter_info = substr($f->normtext($twitter_info),0,200);
      ?>
      <meta content='text/html; charset=UTF-8' http-equiv='Content-Type' />
      <meta name="twitter:card" content="summary" />
      <meta name="twitter:site" content="@We-TeVe" />
      <meta name="twitter:title" content="<?php echo $channel_name; ?>" />
      <meta name="twitter:description" content="<?php echo $twitter_info; ?>" />
      <meta name="twitter:image" content="https://www.We-TeVe.com/<?php echo $f->draw_avatar($channel_uuid,"large"); ?>" />
      <?php
      }
      ?>
		</head>
		<body id='body' class='body'>

			<?php require_once ($_hp.'include/navi.php'); ?>



    <div id='main_container' class='container main_container'>

<?php	}?>

		<span id='site_scripts'>



			<script>
				var playlist_id = 'not_set';

				$(document).ready(function() {
					docready();
          loadfun_friend();
					sethtmltitle('<?php echo $html_title; ?>');
				});

        $('.body').addClass('channel-background');

			</script>
		</span>

    <div class='row'>
      <div id="column1" class="col-lg-2 col-xl-2"> </div>
      <div id="column2" class="channel_main_container col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-spl channel_container">




    <?php if($channel_name == ""){
        //error 404 channel not found
        echo $l->channel_error_1;
      }else{

        function shortText($string,$lenght) {
            if(strlen($string) > $lenght) {
                $string = substr($string,0,$lenght)."...";
                $string_ende = strrchr($string, " ");
                $string = str_replace($string_ende," ...", $string);
                }
            return $string;
        }



        $channel_design = db::$link->query("SELECT * FROM channel_design_db WHERE uuid = '$channel_uuid'");
        $channel_design = $channel_design->fetch_assoc();


        echo "<style>";
          echo ".channel-background{";
            if($channel_design['background_type'] == "" OR $channel_design['background_type'] == "none"){echo "";}else{
              if($channel_design['background_type'] == 'png' or $channel_design['background_type'] == 'jpg'){

                echo"background-image: url('".$_dhp."images/channel/background/".$channel_uuid.".".$channel_design['background_type']."');";
              }else{
              }
            }

            if($channel_design['background_color'] != ""){
              echo"background-color: ".$channel_design['background_color']." !important;";
            }
            echo"background-size: 1920px auto;";
            echo"background-position: center 0%;";
            echo"background-repeat: no-repeat;";
            echo"background-attachment: fixed;";

          echo "}";
        echo "</style>";


          $channel_xp = $channel_xp;

            if($channel_xp >= $lvl->lvlinfo('txp','1000')){ $channel_level = 1000; $channel_levelup = 1000; $channel_levelfortschrit = 0; }
            elseif($channel_xp <= 0){$channel_level = 0; $channel_levelup = 1; $channel_levelfortschrit = 0;
            }else{

              $channel_level = $lvl->lvlinfo('level',$channel_xp);

              $channel_levelup = $channel_level + 1;


              $channel_xplevel_for_this_level = $lvl->lvlinfo('txp',$channel_level);
              $channel_xplevel_for_next_level = $lvl->lvlinfo('txp',$channel_levelup);

              $channel_xplevel_needed_for_next_level = $lvl->lvlinfo('xp',$channel_levelup);
              $channel_xplevel_over = $channel_xp - $channel_xplevel_for_this_level;

              //wie viel Prozent der ramne gefüllt sein soll
              $channel_levelfortschrit = $channel_xplevel_over / $channel_xplevel_needed_for_next_level * 100;
            }
            $channel_b_level = $lvl->lvlicon('b',$channel_level); $channel_n_level = $lvl->lvlicon('n',$channel_level);
            $channel_c_level = $lvl->lvlicon('c',$channel_level); $channel_f_level = $lvl->lvlicon('f',$channel_level);
      ?>

      <div class='channel_header'>
        <div class='channel_header_user_info'>
          <?php
              $f->draw_user_preview($channel_uuid,$_dhp);
          ?>
        </div>

              <script>
              setTimeout(function() {
                <?php if($channel_levelfortschrit > 0){?>
                  $('.level_67_corner_top_left_draw').width(3);
                <?php } ?>

                <?php if($channel_levelfortschrit >= 25){?>
                  $('.level_67_line_top_draw').width(61);
                  <?php }elseif($channel_levelfortschrit < 25){ ?>
                    $('.level_67_line_top_draw').width(<?php $top_line_width = 61 * $channel_levelfortschrit * 4 / 100;  echo $top_line_width;?>);
                  <?php } ?>

                <?php if($channel_levelfortschrit >= 25){?>
                  $('.level_67_corner_top_right_draw').width(3);
                  $('.level_67_corner_top_right_draw').height(3);
                <?php } ?>

                <?php if($channel_levelfortschrit >= 50){?>
                  $('.level_67_line_right_draw').height(61);
                <?php }elseif($channel_levelfortschrit < 50 AND $channel_levelfortschrit > 25){ ?>
                  $('.level_67_line_right_draw').height(<?php $right_line_height = 61 * ($channel_levelfortschrit - 25) * 4 / 100;  echo $right_line_height;?>);
                <?php } ?>

                <?php if($channel_levelfortschrit >= 50){?>
                  $('.level_67_corner_bottom_right_draw').width(3);
                  $('.level_67_corner_bottom_right_draw').height(3);
                <?php } ?>

                <?php if($channel_levelfortschrit >= 75){?>
                  $('.level_67_line_bottom_draw').width(61);
                  <?php }elseif($channel_levelfortschrit < 75 AND $channel_levelfortschrit > 50){ ?>
                    $('.level_67_line_bottom_draw').width(<?php $bottom_line_width = 61 * ($channel_levelfortschrit - 50) * 4 / 100;  echo $bottom_line_width;?>);
                  <?php } ?>

                <?php if($channel_levelfortschrit >= 75){?>
                  $('.level_67_corner_bottom_left_draw').width(3);
                  $('.level_67_corner_bottom_left_draw').height(3);
                <?php } ?>

                <?php if($channel_levelfortschrit >= 100){?>
                  $('.level_67_line_left_draw').height(61);
                  <?php }elseif($channel_levelfortschrit < 100 AND $channel_levelfortschrit > 75){ ?>
                    $('.level_67_line_left_draw').height(<?php $left_line_height = 61 * ($channel_levelfortschrit - 75) * 4 / 100;  echo $left_line_height;?>);
                  <?php } ?>
              }, 0);
              </script>

              <div class='channel_header_level_icon'>
              <?php
                  echo"<div class='level_content_back channel_middle_level_symbol'>";
                    echo "<div class='level_border_back level_67_line_top b_level_".$channel_b_level."'> <div class='level_border_front level_67_line_top_draw c_level_".$channel_c_level."'></div> </div>
                      <div class='level_border_back level_67_corner_top_left b_level_".$channel_b_level."'> <div class='level_border_front level_67_corner_top_left_draw c_level_".$channel_c_level."'></div> </div>
                    <div class='level_border_back level_67_line_right b_level_".$channel_b_level."' > <div class='level_border_front level_67_line_right_draw c_level_".$channel_c_level."'></div> </div>
                      <div class='level_border_back level_67_corner_top_right b_level_".$channel_b_level."'> <div class='level_border_front level_67_corner_top_right_draw c_level_".$channel_c_level."'></div> </div>
                    <div class='level_border_back level_67_line_bottom b_level_".$channel_b_level."'> <div class='level_border_front level_67_line_bottom_draw c_level_".$channel_c_level."'></div> </div>
                      <div class='level_border_back level_67_corner_bottom_right b_level_".$channel_b_level."'> <div class='level_border_front level_67_corner_bottom_right_draw c_level_".$channel_c_level."'></div> </div>
                    <div class='level_border_back level_67_line_left b_level_".$channel_b_level."'> <div class='level_border_front level_67_line_left_draw c_level_".$channel_c_level."'></div> </div>
                      <div class='level_border_back level_67_corner_bottom_left b_level_".$channel_b_level."'> <div class='level_border_front level_67_corner_bottom_left_draw c_level_".$channel_c_level."'></div> </div>

                    <div class='level_content n_67_level_".$channel_n_level." c_level_".$channel_c_level."'>
                      <div class='level_number f_level_".$channel_f_level." this_level'>
                        ".$channel_level."
                      </div>
                    </div>";

                    ?>
                    <?php
                      //f_ = font-size 1 10 100 250 1000
                      //c_ = content color / vordergrund 1 10 20 30 40 50 60 ...
                      //b_ = background color / hintergrund 1 10 20 30 40 50 60 ...

                      //n_ = numberbackground 50 100 250 500 750 1000
                      //nc_ = numberbackgroundcolor 1 10 20 30 40 50 60 ... (inventiert background -> Vordergrund - weil ein ild dafor ist)
                  echo"</div>";

               ?>
             </div>

             <div class='channel_header_navi'>

                <?php
                echo "<div class='channel_navi_btn no_overflow'>                               <a href='".$_dhp."user/".$channel_name."'>".$l->home_navi_title."</a></div>";
                echo "<div class='channel_navi_btn no_overflow'>                               <a href='".$_dhp."user/".$channel_name."/videos'>".$l->video_navi_title."</a></div>";
                echo "<div class='channel_navi_btn no_overflow'>                               <a href='".$_dhp."user/".$channel_name."/playlist'>".$l->pl_navi_title."</a></div>";
                echo "<div class='channel_navi_btn channel_navi_btn_hide no_overflow'>         <a href='".$_dhp."user/".$channel_name."/achv'>".$l->achievement_navi_title."</a></div>";
                echo "<div class='channel_navi_btn channel_navi_btn_hide no_overflow channel_navi_btn_activ'>         <a href='".$_dhp."user/".$channel_name."/info'>".$l->info_navi_title."</a></div>";

              if($isUserLoggedIn === 1 AND $channel_uuid == $user_uuid){
                echo"<div class='channel_navi_btn channel_navi_btn_hide no_overflow' title='".$l->home_edit_navi_title."'>       <a href='".$_dhp."edit'><span class='glyphicon glyphicon-pencil'></span></a></div>";
                echo "<style>.channel_navi_btn{width: calc(100% / 6 - 5px);}</style>";
              }

                echo "<div class='channel_navi_btn channel_navi_btn_show channel_navi_btn_show_more no_overflow'>         <div class='channel_navi_more'><span class='glyphicon glyphicon-option-horizontal'></div> </div>";
                  echo "<div class='channel_navi_more_menu hide'>";
                    if($isUserLoggedIn === 1 AND $channel_uuid == $user_uuid){
                      echo"<div class='channel_navi_btn no_overflow' title='".$l->home_edit_navi_title."'>  <a href='".$_dhp."edit'><span class='glyphicon glyphicon-pencil'></span></a></div>";
                    }
                    echo "<div class='channel_navi_btn no_overflow channel_navi_btn_activ'>                 <a href='".$_dhp."user/".$channel_name."/info'>".$l->info_navi_title."</a></div>";
                    echo "<div class='channel_navi_btn no_overflow'>                                        <a href='".$_dhp."user/".$channel_name."/achv'>".$l->achievement_navi_title."</a></div>";

                  echo "</div>";
                 ?>
           </div>

           <script>
            $('.channel_navi_btn_show_more').click(function(){
              $('.channel_navi_more_menu').toggleClass('hide');
            });

            $(document).mouseup(function (e){
                var container = $('.channel_navi_more_menu'); var container2 = $('.channel_navi_btn_show_more');
                if (!container.is(e.target) && container.has(e.target).length === 0 && !container2.is(e.target) && container2.has(e.target).length === 0){
                  $('.channel_navi_more_menu').addClass('hide');
                }
            });

           </script>

        </div>

        <div class='marg-top-15 col-xs-12 col-sm-5 col-md-5 col-lg-5 col-xl-5 col-spl left_line'>
          <main_avatar>
            <img id="profilepic" src="<?php echo $_dhp;?>images/profile/<?php echo $channel_uuid;?>.jpg" onerror="document.getElementById(this.id).src = '<?php echo $_dhp;?>images/profile/default.jpg'"/>
          </main_avatar>
        <!--	<overview_info>
            <h2>Statistik:</h2>
            <a href="#">link1</a>
            <a href="#">link2</a>
            <a href="#">link3</a>
            <a href="#">link4</a>
            <a href="#">link5</a>
          </overview_info> -->
        </div>

        <div class='marg-top-15 col-xs-12 col-sm-7 col-md-7 col-lg-7 col-xl-7 col-spl right_line'>
          <?php if(($isUserLoggedIn === 1)){?>
						<f_add_button>
              <?php if(($channel_uuid != $user_uuid)){
                if($f->isbloked($user_uuid,$channel_uuid,2) == false AND $f->isbloked($channel_uuid,$user_uuid,2) == false){
                  $frind_sql = db::$link->query("SELECT status FROM friend_db WHERE first_uuid = '$user_uuid' AND second_uuid = '$channel_uuid'");
                  $frind_row = $frind_sql->fetch_assoc();

                  $frind_sql2 = db::$link->query("SELECT status FROM friend_db WHERE first_uuid = '$channel_uuid' AND second_uuid = '$user_uuid'");
                  $frind_row2 = $frind_sql2->fetch_assoc();


                  if($frind_row['status'] == 'sent'){
                    //wurde eine Einladung gesendet? / freiend_class = remove_friend
                    echo "<div class='blue_btn no_overflow noselect kanal_info_btns left remove_friend' friend_uuid='".$channel_uuid."'>";
                      echo "<span class='glyphicon glyphicon-user'></span> ".$l->friend_title_3;
                    echo "</div>";

                  }elseif($frind_row['status'] == 'confirmed'){
                    //schon freunde? / freiend_class = remove_friend
                    echo "<div class='blue_btn no_overflow noselect kanal_info_btns left remove_friend' friend_uuid='".$channel_uuid."'>";
                      echo "<span class='glyphicon glyphicon-user'></span> ".$l->friend_title_4;
                    echo "</div>";
                  }elseif($frind_row2['status'] == 'sent'){
                    //wurde er schon von dem Kanal als Freund angefragt / freiend_class = accept_friend
                    echo "<div class='blue_btn no_overflow noselect kanal_info_btns left accept_friend' friend_uuid='".$channel_uuid."'>";
                      echo "<span class='glyphicon glyphicon-user'></span> ".$l->friend_title_2;
                    echo "</div>";
                  }else{
                    //keine freunde / freiend_class = add_friend
                    echo "<div class='blue_btn no_overflow noselect kanal_info_btns left add_friend' friend_uuid='".$channel_uuid."'>";
                      echo "<span class='glyphicon glyphicon-user'></span> ".$l->friend_title_1;
                    echo "</div>";
                  }
                }else{
                  echo "<div class='blue_btn no_overflow noselect kanal_info_btns left'>";
                    echo "<span class='glyphicon glyphicon-user'></span> ".$l->block_friend_text_1;
                  echo "</div>";
                }
								?>

							<div class="blue_btn no_overflow noselect channel_flag kanal_info_btns left"><span class='glyphicon glyphicon-flag'></span>
								<?php echo $l->i_flag_title;?>
							</div>
            <?php

              echo "<div class='w-100 left marg-top-5'>";
                echo "<div class='blue friend_return_1 fr_to_hide hide'>".$l->friend_text_1."</div>";
                echo "<div class='blue friend_return_2 fr_to_hide hide'>".$l->friend_text_2."</div>";
                echo "<div class='blue friend_return_3 fr_to_hide hide'>".$l->friend_text_3."</div>";
                echo "<div class='blue friend_return_4 fr_to_hide hide'>".$l->friend_text_4."</div>";
                echo "<div class='blue friend_return_5 fr_to_hide hide'>".$l->friend_text_5."</div>";
                echo "<div class='red  friend_return_6 fr_to_hide hide'>".$l->friend_text_6."</div>";
                echo "<div class='red  friend_return_7 fr_to_hide hide'>".$l->friend_text_7."</div>";
                echo "<div class='red  friend_return_10 fr_to_hide hide'>".$l->block_friend_error_2."</div>";
                echo "<div class='red  friend_error_1  fr_to_hide hide'>".$l->friend_error1."</div>";
              echo "</div>";
            }

            if($isUserLoggedIn === 1 AND $channel_uuid == $user_uuid){
							?>
							<div class="blue_btn no_overflow noselect kanal_info_btns kanal_info_btn_opt right marg-r-0"><span class='glyphicon glyphicon-pencil'></span>
								<?php echo $l->i_edit_title; ?>
							</div>
						<?php } ?>
						</f_add_button>
        <?php
          $kanal_info_class='';
        } //end user is logged in
          else{$kanal_info_class='marg-top-0';} ?>


            <kanal_info class='<?php echo $kanal_info_class; ?>'>
  						<?php
  						$date_beitrit = $u->userin('beitrit',0,$channel_uuif,'');
  						$date_info = $t->normtime($date_beitrit,'date');


  						$channel_land_sql = db::$link->query("SELECT * FROM user_find_db WHERE uuid = '$channel_uuid'");
  						$channel_land_row = $channel_land_sql->fetch_assoc();

  						$land_info = "land_label_".$channel_land_row['land'];
              $land_info = $l->$land_info;

              $channel_design_sql = db::$link->query("SELECT * FROM channel_design_db WHERE uuid = '$channel_uuid'");
              $channel_design_row = $channel_design_sql->fetch_assoc();

  						$info_date_value = $channel_design['view_date'];
  						$info_country_value = $channel_design['view_country'];
  						$title_1 = $channel_design['info_title_1'];
  						$text_1 = $channel_design['info_text_1'];
  						$title_2 = $channel_design['info_title_2'];
  						$text_2 = $channel_design['info_text_2'];
  						$title_3 = $channel_design['info_title_3'];
  						$text_3 = $channel_design['info_text_3'];
  						$title_4 = $channel_design['info_title_4'];
  						$text_4 = $channel_design['info_text_4'];
  						$full_text_norm = $channel_design['info_full_text'];
              $full_text = $com->fulltext($full_text_norm);
              $full_text = $f->autolink($full_text,array("target"=>"_blank"));
                $sonderzeichen_info2 = array(
                  '<br />' => '',
                  '<br/>' => '',
                  '<br>' => '',
                );
                $full_text_ohne_br = str_replace(array_keys($sonderzeichen_info2),
                  array_values($sonderzeichen_info2), $full_text_norm);

  						echo"<div class='info_frame'>";
  						echo"<profil>".$l->edit_info_title8.":</profil>";
  						echo"<div class='info'>";

  						    if($info_date_value == 1){
  						    echo"<info_line>";
  						    echo"<InfoTitle class='no_overflow'>".$l->edit_info_title3.":</InfoTitle> <InfoText class='no_overflow'>".$date_info."</InfoText>";
  						    echo"</info_line>";
  						    }

  						    if($info_country_value == 1){
  						    echo"<info_line>";
  						    echo"<InfoTitle class='no_overflow'>".$l->edit_info_title3_5.":</InfoTitle> <InfoText class='no_overflow'>".$land_info."</InfoText>";
  						    echo"</info_line>";
  						    }

  						    if($title_1 != "" AND $text_1 != ""){
  						    echo"<info_line>";
  						    echo"<InfoTitle class='no_overflow'>".$title_1.":</InfoTitle> <InfoText class='no_overflow'>".$text_1."</InfoText>";
  						    echo"</info_line>";
  						    }

  						    if($title_2 != "" AND $text_2 != ""){
  						    echo"<info_line>";
  						    echo"<InfoTitle class='no_overflow'>".$title_2.":</InfoTitle> <InfoText class='no_overflow'>".$text_2."</InfoText>";
  						    echo"</info_line>";
  						    }

  						    if($title_3 != "" AND $text_3 != ""){
  						    echo"<info_line>";
  						    echo"<InfoTitle class='no_overflow'>".$title_3.":</InfoTitle> <InfoText class='no_overflow'>".$text_3."</InfoText>";
  						    echo"</info_line>";
  						    }

  						    if($title_4 != "" AND $text_4 != ""){
  						    echo"<info_line>";
  						    echo"<InfoTitle class='no_overflow'>".$title_4.":</InfoTitle> <InfoText class='no_overflow'>".$text_4."<InfoText>";
  						    echo"</info_line>";
  						    }

  						echo"</div>";
  						echo"</div>";
  						?>
  					</kanal_info>

            <kanal_dis>
              <profil><?php echo $l->infofulltext_edit_title; ?>:</profil>
              <?php
              if($full_text == "" OR $full_text == " "){echo $l->no_channel_description;}
              else
              {echo $full_text; } ?>
            </kanal_dis>


            <stats>
              <profil><?php echo $l->s_title; ?>:</profil>
              <?php
                $s_abos = $channel_sub_n;

                $lot_sql = db::$link->query("SELECT last_online_time,online_time FROM user_find_db WHERE uuid = '$channel_uuid'");
                $lot_row = $lot_sql->fetch_assoc();
                $s_date = $lot_row['last_online_time'];
                $s_online_time = $lot_row['online_time'];
                  $s_date = $t->normtime($s_date,'date');
                  $s_online_time = $t->sekinzeit($s_online_time);

                $result_sql = db::$link->query("SELECT COUNT(*) FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' AND privacy = 'public'");
                $s_videos = $result_sql->fetch_row(); $s_videos = number_format($s_videos[0],0, ",", ".");


                $s_time = "0";

                $sql_s_info = db::$link->query("SELECT dauer FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' AND privacy = 'public'");
                while ($erg_s_info = $sql_s_info->fetch_array())
                {
                  $s_time = $s_time + $erg_s_info['dauer'];
                }

                $s_time = $t->sekinzeit($s_time);

                echo"<info_line>";
                echo"<InfoTitle class='no_overflow'>".$l->s_title_abos.":</InfoTitle> <InfoText class='no_overflow'>".$s_abos."</InfoText>";
                echo"</info_line>";

                echo"<info_line>";
                echo"<InfoTitle class='no_overflow'>".$l->s_title_videos.":</InfoTitle> <InfoText class='no_overflow'>".$s_videos."</InfoText>";
                echo"</info_line>";

                echo"<info_line>";
                echo"<InfoTitle class='no_overflow'>".$l->s_title_last.":</InfoTitle> <InfoText class='no_overflow'>".$s_date."</InfoText>";
                echo"</info_line>";

                echo"<info_line>";
                echo"<InfoTitle class='no_overflow'>".$l->s_title_online_time.":</InfoTitle> <InfoText class='no_overflow'>".$s_online_time."</InfoText>";
                echo"</info_line>";

                echo"<info_line>";
                echo"<InfoTitle class='no_overflow'>".$l->s_title_time.":</InfoTitle> <InfoText class='no_overflow'>".$s_time."</InfoText>";
                echo"</info_line>";
                ?>
            </stats>
          </div>



      <?php
      }//end if user exist
      ?>

    </channelcontent_index>

  <?php
    if($isUserLoggedIn === 1 AND $channel_uuid == $user_uuid){
      $usercode = $_SESSION["usercode"];

      echo "
      <div class='pm_container_bg pm_to_hide hide'>
        <div class='col-spl col-xs-0 col-sm-1 col-md-2 col-lg-4 col-xl-3 col-spl'></div>
        <div class='pm_container col-xs-11 col-sm-10 col-md-8 col-lg-4 col-xl-5'>
          <div class='pm_title_container'>";
            echo "<div class='pm_title'>".$l->i_edit_title_long.":</div>";
              echo "<div class='pm_close_btn'><span class='glyphicon glyphicon-remove'></span></div>";
          echo "</div>";

        echo "<div class='pm_pl_container pm_scroll_container'>";

            echo  "<form method='POST'>";

              //info
                  echo "
                  <edittitle>".$l->i_edit_profile_title.":</edittitle>

                  <thumb>
                    <div id='profil_img_upl' class='norm_upload_btn fileUpload btn btn-primary btn-default'>
                      <span>".$l->i_edit_upload_title."</span>
                      <input type='file' id='thumb' class='upload' name='thumb'>
                    </div>

                    <div id='thumb_status'></div>
                  </thumb>

                  <div style='display:none;' id='vorschau-thumb'>
                    <edittitleleft>".$l->i_edit_profile_title2.":</edittitleleft>
                    <div class='profil_preview'><img style='width:200px; height: 200px;' id='profil_preview_new' src='#' alt='Vorschau'/></div>
                  </div>";

                  $profile_thumb = $_dhp."images/profile/".$channel_uuid.".jpg";

                  echo"<div id='old-vorschau-thumb'>
                    <edittitleleft>".$l->i_edit_profile_title3.":</edittitleleft>
                    <div class='profil_preview'><img style='width:200px; height: 200px;' id='profil_preview_old' src='".$profile_thumb."' alt='Vorschau'"; ?> onerror="document.getElementById(this.id).src = '<?php echo $_dhp;?>images/profile/default.jpg'"/> <?php echo "</div>
                  </div>";
                  ?>
                  <script>
                  $("#thumb").change(function(){

                      function readURL(input) {

                          if (input.files && input.files[0]) {
                              var reader = new FileReader();

                              reader.onload = function (e) {
                                  $('#profil_preview_new').attr('src', e.target.result);
                              }

                              reader.readAsDataURL(input.files[0]);
                          }
                        }

                        document.getElementById("old-vorschau-thumb").style.display = "none";
                        document.getElementById("vorschau-thumb").style.display = "block";
                        readURL(this);

                        var file =  document.getElementById("thumb").files[0];
                        //alert(file.name+" | "+file.size+" | "+file.type);
                        var formdata = new FormData();
                        formdata.append("thumb", file);
                        var ajax = new XMLHttpRequest();
                        ajax.addEventListener("load", thumbcompleteHandler, false);


                        ajax.open("POST", "<?php echo $_dhp; ?>upload/profile_uploader?usercode=<?php echo $usercode; ?>");
                        ajax.send(formdata);
                      });

                      function thumbcompleteHandler(event) {
                        document.getElementById("thumb_status").innerHTML = event.target.responseText;
                      }
                  </script>
                  <?php

                  echo"
                  <edittitle>".$l->edit_info_title8.":</edittitle>
                  <editTitleLeft>".$l->edit_info_title1.":</editTitleLeft> <editTitleRight>".$l->edit_info_title2.":</editTitleRight>

                  <input type='text' class='i_edit_info_title i_edit_info_input' value='".$l->edit_info_title3."' title='".$l->edit_info_title4."' disabled/>:
                  <input type='text' class='i_edit_info_text i_edit_info_input' value='".$date_info."' title='".$l->edit_info_title4."' disabled/>
                  ";

                  if($info_date_value == '1'){echo"<style>autoTitle,autoText{color:#007abf;}</style>";}else{echo"<style>autoTitle,autoText{color:#333333;}</style>";};

                  ?>
                  <select name='info_date' class='i_edit_info_dropdown info_date'>
                    <option value='1'<?php if($info_date_value == '1'){echo 'selected';}?>><?php echo $l->edit_info_title5;?></option>
                    <option value='0'<?php if($info_date_value == '0'){echo 'selected';}?>><?php echo $l->edit_info_title6;?></option>
                  </select>
                  <?php

                  echo "
                  <input type='text' class='i_edit_info_title i_edit_info_input' value='".$l->edit_info_title3_5."' title='".$l->edit_info_title4."' disabled/>:
                  <input type='text' class='i_edit_info_text i_edit_info_input' value='".$land_info."' title='".$l->edit_info_title4."' disabled/>
                  ";

                  ?>
                  <select name='info_land' class='i_edit_info_dropdown info_land'>
                    <option value='1'<?php if($info_country_value == '1'){echo 'selected';}?>><?php echo $l->edit_info_title5;?></option>
                    <option value='0'<?php if($info_country_value == '0'){echo 'selected';}?>><?php echo $l->edit_info_title6;?></option>
                  </select>
                  <?php


                  ?>
                <!--info1-->
                  <input type="text" class="i_edit_info_title i_edit_info_input form-control no_overflow" name="titel_1" value="<?php echo $title_1 ?>"/>:
                  <input type="text" class="i_edit_info_text i_edit_info_input form-control no_overflow" name="text_1" value="<?php echo $text_1 ?>"/>

                <!--info2-->
                  <input type="text" class="i_edit_info_title i_edit_info_input form-control no_overflow" name="titel_2" value="<?php echo $title_2 ?>"/>:
                  <input type="text" class="i_edit_info_text i_edit_info_input form-control no_overflow" name="text_2"  value="<?php echo $text_2 ?>"/>

                <!--info3-->
                  <input type="text" class="i_edit_info_title i_edit_info_input form-control no_overflow" name="titel_3" value="<?php echo $title_3 ?>"/>:
                  <input type="text" class="i_edit_info_text i_edit_info_input form-control no_overflow" name="text_3"  value="<?php echo $text_3 ?>"/>

                <!--info4-->
                  <input type="text" class="i_edit_info_title i_edit_info_input form-control no_overflow" name="titel_4" value="<?php echo $title_4 ?>"/>:
                  <input type="text" class="i_edit_info_text i_edit_info_input form-control no_overflow" name="text_4" value="<?php echo $text_4 ?>"/>



                  <edittitle><?php echo $l->infofulltext_edit_title; ?>:</edittitle>

                  <textarea class="i_edit_info_textarea form-control" id="kanalinfo" name="kanalinfo" maxlength="1000" placeholder="<?php echo $l->i_info_placeholder; ?>"><?php echo $full_text_ohne_br; ?></textarea>


                  <input type="submit" class="savebutton" name="save_info" value="<?php echo $l->edit_info_title7;?>" required />

                  <?php

            echo "<div class='placeholder_edit'></div>";

        echo  "</form>";


        if(isset($_POST['save_info'])) {
                $save_date_value =	$_POST['info_date'];
                $save_date_country = $_POST['info_land'];
                $save_title_1 = $_POST['titel_1'];
                $save_text_1 = $_POST['text_1'];
                $save_title_2 = $_POST['titel_2'];
                $save_text_2 = $_POST['text_2'];
                $save_title_3 = $_POST['titel_3'];
                $save_text_3 = $_POST['text_3'];
                $save_title_4 = $_POST['titel_4'];
                $save_text_4 = $_POST['text_4'];

                $kanalinfo = substr($_POST['kanalinfo'],0,1000);


                $save_title_1 = mysqli_real_escape_string(db::$link,$save_title_1);
                $save_text_1  = mysqli_real_escape_string(db::$link,$save_text_1);

                $save_title_2 = mysqli_real_escape_string(db::$link,$save_title_2);
                $save_text_2  = mysqli_real_escape_string(db::$link,$save_text_2);

                $save_title_3 = mysqli_real_escape_string(db::$link,$save_title_3);
                $save_text_3  = mysqli_real_escape_string(db::$link,$save_text_3);

                $save_title_4 = mysqli_real_escape_string(db::$link,$save_title_4);
                $save_text_4  = mysqli_real_escape_string(db::$link,$save_text_4);


                $kanalinfo    = nl2br($kanalinfo);
                $kanalinfo    = trim($kanalinfo);
                  $kanalinfo    = mysqli_real_escape_string(db::$link,$kanalinfo);

                $update_box1 = "Update channel_design_db SET view_date='$save_date_value' WHERE uuid='$user_uuid'"; $update_box1 = db::$link->query($update_box1);
                $update_box2 = "Update channel_design_db SET view_country='$save_date_country' WHERE uuid='$user_uuid'"; $update_box2 =db::$link->query($update_box2);
                $update_box3 = "Update channel_design_db SET info_title_1='$save_title_1' WHERE uuid='$user_uuid'"; $update_box3 = db::$link->query($update_box3);
                $update_box4 = "Update channel_design_db SET info_text_1='$save_text_1' WHERE uuid='$user_uuid'"; $update_box4 = db::$link->query($update_box4);
                $update_box5 = "Update channel_design_db SET info_title_2='$save_title_2' WHERE uuid='$user_uuid'"; $update_box5 = db::$link->query($update_box5);
                $update_box6 = "Update channel_design_db SET info_text_2='$save_text_2' WHERE uuid='$user_uuid'"; $update_box6 = db::$link->query($update_box6);
                $update_box7 = "Update channel_design_db SET info_title_3='$save_title_3' WHERE uuid='$user_uuid'"; $update_box7 = db::$link->query($update_box7);
                $update_box8 = "Update channel_design_db SET info_text_3='$save_text_3' WHERE uuid='$user_uuid'"; $update_box8 = db::$link->query($update_box8);
                $update_box9 = "Update channel_design_db SET info_title_4='$save_title_4' WHERE uuid='$user_uuid'"; $update_box9 = db::$link->query($update_box9);
                $update_box10 = "Update channel_design_db SET info_text_4='$save_text_4' WHERE uuid='$user_uuid'"; $update_box10 = db::$link->query($update_box10);
                $update_box11 = "Update channel_design_db SET info_full_text='$kanalinfo' WHERE uuid='$user_uuid'"; $update_box10 = db::$link->query($update_box11);

                echo "<script type='text/javascript'>window.location.href = '".$_dhp."back';</script>";
                }

        echo "</div>";
      echo "</div>";


      ?>

    <script>

      $('.kanal_info_btn_opt').unbind('click').click(function(){
        $('.pm_to_hide').removeClass('hide');
        $('.body').addClass('stop_srolling');
      });

      $('.pm_close_btn').unbind('click').click(function(){
        $('.pm_to_hide').addClass('hide');
      });

      $(document).mouseup(function (e){
        var container = $('.pm_container');
        var container2 = $('.bm_container');
        if (!container.is(e.target) && container.has(e.target).length === 0 && !container2.is(e.target) && container2.has(e.target).length === 0){
          $('.pm_to_hide').addClass('hide');
          $('.body').removeClass('stop_srolling');
        }
      });
    </script>

    <?php
      }//end if loggedinuser = channel
    ?>

  </div>
  <div class="column3 col-xs-0 col-sm-0 col-md-0 col-lg-1 col-xl-3 col-spl"></div>
</div>

<?php if($infram != 1){?>
		</div>

	</body>
</html>

<?php }
?>
