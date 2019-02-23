<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = ''; //für include
$_dhp = "../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

if($isUserLoggedIn === 1){

  $la = new language;

  $channel_find_sql = db::$link->query("SELECT * FROM user_find_db WHERE uuid = '$user_uuid'");
  $channel_find_row = $channel_find_sql->fetch_assoc();

  if($channel_find_row['uuid'] != ""){
    $channel_uuid = $channel_find_row['uuid'];
    $channel_name  = $channel_find_row['user_name'];
    $channel_subs  = $channel_find_row['abos'];
    $channel_sub_n = number_format($channel_subs,0, ",", ".");
    $channel_land  = $channel_find_row['land'];
    $channel_xp    = $channel_find_row['xp'];

      //3. site vals
      $html_title = $channel_name." | We-TeVe"; //Tap title

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


//4. coinhive check
$coin_name = $channel_uuid;
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
	<html lang='<?php echo $la->htmldata; ?>'>
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

    <div id='channel_container' class='channel_container edit_container'>
		<span id='site_scripts'>

      <?php require_once ($_hp.'include/coinhivescript.php'); ?>

			<script>
				var playlist_id = 'not_set';

				$(document).ready(function() {
					docready();
					sethtmltitle('<?php echo $html_title; ?>');
				});

        $('.body').addClass('channel-background');

			</script>
		</span>


    <?php

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


        $img = $channel_design['img'];
        $video = $channel_design['video'];
        $videobeschreibung = $channel_design['videobeschreibung'];
        $diskussion = $channel_design['diskussion'];
        $abonnenten = $channel_design['abonnenten'];
        $info = $channel_design['info'];
        $infofulltext = $channel_design['infofulltext'];
        $playlist = $channel_design['playlist'];

        $infofulltext_data = $channel_design['info_full_text'];
        $img_data = $channel_design['img_data'];
        $video_data = $channel_design['video_data'];
        $video_vuid = $video_data;

        $info_date = $channel_design['view_date'];
        $info_country = $channel_design['view_country'];
        $info_title_1 = $channel_design['info_title_1'];
        $info_text_1 = $channel_design['info_text_1'];
        $info_title_2 = $channel_design['info_title_2'];
        $info_text_2 = $channel_design['info_text_2'];
        $info_title_3 = $channel_design['info_title_3'];
        $info_text_3 = $channel_design['info_text_3'];
        $info_title_4 = $channel_design['info_title_4'];
        $info_text_4 = $channel_design['info_text_4'];

        if($info_date != '0' OR $info_country != '0' OR $info_title_1 != '' OR $info_text_1 != '' OR $info_title_2 != '' OR $info_text_2 != ''
        OR $info_title_3 != '' OR $info_text_3 != '' OR $info_title_4 != '' OR $info_text_4 != '')
        {$info_data = 1;}

				$playlist = $channel_design['playlist'];
				$playlist_data = $channel_design['playlist_data'];

				$infofulltext = $channel_design['infofulltext'];
				$infofulltext_data = $channel_design['info_full_text'];


				$nz1 = $channel_design['nz1'];
				$nz2 = $channel_design['nz2'];
				$nz3 = $channel_design['nz3'];
				$nz4 = $channel_design['nz4'];
				$nz5 = $channel_design['nz5'];
				$nz6 = $channel_design['nz6'];
				$nz7 = $channel_design['nz7'];
				$nz8 = $channel_design['nz8'];
				$nz9 = $channel_design['nz9'];
				$nz10 = $channel_design['nz10'];
				$nz11 = $channel_design['nz11'];
				$nz12 = $channel_design['nz12'];
				$nz13 = $channel_design['nz13'];
				$nz14 = $channel_design['nz14'];
				$nz15 = $channel_design['nz15'];
				$nz16 = $channel_design['nz16'];
				$nz17 = $channel_design['nz17'];
				$nz18 = $channel_design['nz18'];
				$nz19 = $channel_design['nz19'];
				$nz20 = $channel_design['nz20'];
				$nz21 = $channel_design['nz21'];
				$nz22 = $channel_design['nz22'];
				$nz23 = $channel_design['nz23'];
				$nz24 = $channel_design['nz24'];


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

    <?php
      echo"<kanalhead>";
        echo"<userinfo>";

            $f->draw_user_preview($channel_uuid,$_dhp);
        ?>
        </userinfo>

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

        <channelnavi>

            <?php


            echo "<home><a href='".$_dhp."user/".$channel_name."'>".$la->home_navi_title."</a></home>";
            echo "<videos>            <a href='".$_dhp."user/".$channel_name."/videos'>".$la->video_navi_title."</a></videos>";
            echo "<playlist >         <a href='".$_dhp."user/".$channel_name."/playlist'>".$la->pl_navi_title."</a></playlist>";
            echo "<achievements>      <a href='".$_dhp."user/".$channel_name."/achv'>".$la->achievement_navi_title."</a></achievements>";
            echo "<info>              <a href='".$_dhp."user/".$channel_name."/info'>".$la->info_navi_title."</a></info>";

          if($isUserLoggedIn === 1 AND $channel_uuid == $user_uuid){
            echo"<edit class='activ'> <a href='".$_dhp."edit'>".$la->home_edit_navi_title."</a></edit>";
          }
            ?>
            <level>
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
            </level>
        </channelnavi>


      </kanalhead>

			<editnavi>
				<div class='edit-background'> <p><?php echo $la->hintergrund_add_title; ?></p> </div>
				<div class='edit-avatar'> <p><?php echo $la->avatar_add_title; ?></p> </div>
			</editnavi>
				<?php require_once ($_hp.'channel/edit_background.php'); ?>
				<?php require_once ($_hp.'channel/edit_avatar.php'); ?>

      <channelcontent id="main">

			<?php
			//einzelne Elemente!
					require_once ($_hp.'channel/img_edit.php');
					require_once ($_hp.'channel/video_edit.php');
					require_once ($_hp.'channel/info_edit.php');
					require_once ($_hp.'channel/infofulltext_edit.php');

					$c_count = 0; $box_count = 0;

					if($img != "" )											{echo "<div id='".$img."' class='img ".$img." absolute_edit'>																<h1 class='box_title'>".$la->bild_edit_title."</h1> <div class='img_edit edit glyphicon glyphicon-pencil' onClick=[OpenEditBox('img')]></div>";
					echo "<button id=delbox-".$img." onClick=[CloseBoxEdit('".$img."','img')] class='close_box glyphicon glyphicon-remove'></button></div>"; 				$c_count++; $box_count++;
					}
					if($img_data != ""){echo"<style>div.img{background-color: #007abf;}</style>";}else{echo"<style>div.img{background-color: #333333;}</style>";}

					if($video != "" )										{echo "<div id='".$video."' class='video ".$video." absolute_edit'>														<h1 class='box_title'>".$la->video_edit_title."</h1><div class='video_edit edit glyphicon glyphicon-pencil' onClick=[OpenEditBox('video')]></div>";
					echo "<button id=delbox-".$video." onClick=[CloseBoxEdit('".$video."','video')] class='close_box glyphicon glyphicon-remove'></button></div>"; 			$c_count++; $box_count++;
					}
					if($video_data != ""){echo"<style>div.video{background-color: #007abf;}</style>";}else{echo"<style>div.video{background-color: #333333;}</style>";}

					if($videobeschreibung != "" )				{echo "<div id='".$videobeschreibung."' class='videobeschreibung ".$videobeschreibung." absolute_edit'>		<h1 class='box_title'>".$la->videobeschreibung_edit_title."</h1><div class='videobeschreibung_edit none_edit' title='".$la->automatisch."'>A</div>";
					echo "<button id=delbox-".$videobeschreibung." onClick=[CloseBoxEdit('".$videobeschreibung."','videobeschreibung')] class='close_box glyphicon glyphicon-remove'></button></div>"; 			$c_count++; $box_count++;
					}
					if($video_data != "" AND $video != ""){echo"<style>div.videobeschreibung{background-color: #007abf;}</style>";}else{echo"<style>div.videobeschreibung{background-color: #333333;}</style>";}

					if($diskussion != "" )							{echo "<div id='".$diskussion."' class='diskussion ".$diskussion." absolute_edit'>									<h1 class='box_title'>".$la->diskussion_edit_title."</h1><div class='diskussion_edit none_edit' title='".$la->automatisch."'>A</div>";
					echo "<button id=delbox-".$diskussion." onClick=[CloseBoxEdit('".$diskussion."','diskussion')] class='close_box glyphicon glyphicon-remove'></button></div>"; 			$c_count++; $box_count++;
					}
					echo"<style>div.diskussion{background-color: #007abf;}</style>";

					if($abonnenten != "" )							{echo "<div id='".$abonnenten."' class=' abonnenten ".$abonnenten." absolute_edit'>									<h1 class='box_title'>".$la->abonnenten_edit_title."</h1><div class='abonnenten_edit none_edit' title='".$la->automatisch."'>A</div>";
					echo "<button id=delbox-".$abonnenten." onClick=[CloseBoxEdit('".$abonnenten."','abonnenten')] class='close_box glyphicon glyphicon-remove'></button></div>"; 			$c_count++; $box_count++;
					}
					echo"<style>div.abonnenten{background-color: #007abf;}</style>";

					if($info != "" )										{echo "<div id='".$info."' class='info ".$info." absolute_edit'>															<h1 class='box_title'>".$la->info_edit_title."</h1><div class='info_edit edit glyphicon glyphicon-pencil' onClick=[OpenEditBox('info')]></div>";
					echo "<button id=delbox-".$info." onClick=[CloseBoxEdit('".$info."','info')] class='close_box glyphicon glyphicon-remove'></button></div>"; 			$c_count++; $box_count++;
					}
					if($info_data != ""){echo"<style>div.info{background-color: #007abf;}</style>";}else{echo"<style>div.info{background-color: #333333;}</style>";}

					if($infofulltext != "" )										{echo "<div id='".$infofulltext."' class='infofulltext ".$infofulltext." absolute_edit'>															<h1 class='box_title'>".$la->infofulltext_edit_title."</h1><div class='infofulltext_edit edit glyphicon glyphicon-pencil' onClick=[OpenEditBox('infofulltext')]></div>";
					echo "<button id=delbox-".$infofulltext." onClick=[CloseBoxEdit('".$infofulltext."','infofulltext')] class='close_box glyphicon glyphicon-remove'></button></div>"; 			$c_count++; $box_count++;
					}
					if($infofulltext_data != ""){echo"<style>div.infofulltext{background-color: #007abf;}</style>";}else{echo"<style>div.infofulltext{background-color: #333333;}</style>";}

					//if($playlist != "" )								{echo "<div id='".$playlist."' class='playlist ".$playlist." absolute_edit'>											<h1 class='box_title'>Playlist</h1>";
					//echo "<form method='POST'> 					<button name='close_playlist' class='close_box glyphicon glyphicon-remove'></button> 		</form> </div>"; 			$c_count++; $box_count++;
					//if($playlist_data != ""){echo"<style>div.playlist{background-color: #007abf;}</style>";}else{echo"<style>div.playlist{background-color: #333333;}</style>";}}

				//nz leere Kasten!
				$c_count = 0; $nz_count = 0;
				if($nz1 != "" ){echo "<div id='".$nz1."' class='nz ".$nz1."'><div id ='box_".$nz1."' class='nz_box' onClick=[OpenBox('".$nz1."')]><p>+</p></div></div>"; }
				if($nz2 != "" ){echo "<div id='".$nz2."' class='nz ".$nz2."'><div id ='box_".$nz2."' class='nz_box' onClick=[OpenBox('".$nz2."')]><p>+</p></div></div>"; }
				if($nz3 != "" ){echo "<div id='".$nz3."' class='nz ".$nz3."'><div id ='box_".$nz3."' class='nz_box' onClick=[OpenBox('".$nz3."')]><p>+</p></div></div>"; }
				if($nz4 != "" ){echo "<div id='".$nz4."' class='nz ".$nz4."'><div id ='box_".$nz4."' class='nz_box' onClick=[OpenBox('".$nz4."')]><p>+</p></div></div>"; }
				if($nz5 != "" ){echo "<div id='".$nz5."' class='nz ".$nz5."'><div id ='box_".$nz5."' class='nz_box' onClick=[OpenBox('".$nz5."')]><p>+</p></div></div>"; }
				if($nz6 != "" ){echo "<div id='".$nz6."' class='nz ".$nz6."'><div id ='box_".$nz6."' class='nz_box' onClick=[OpenBox('".$nz6."')]><p>+</p></div></div>"; }
				if($nz7 != "" ){echo "<div id='".$nz7."' class='nz ".$nz7."'><div id ='box_".$nz7."' class='nz_box' onClick=[OpenBox('".$nz7."')]><p>+</p></div></div>"; }
				if($nz8 != "" ){echo "<div id='".$nz8."' class='nz ".$nz8."'><div id ='box_".$nz8."' class='nz_box' onClick=[OpenBox('".$nz8."')]><p>+</p></div></div>"; }
				if($nz9 != "" ){echo "<div id='".$nz9."' class='nz ".$nz9."'><div id ='box_".$nz9."' class='nz_box' onClick=[OpenBox('".$nz9."')]><p>+</p></div></div>"; }
				if($nz10 != "" ){echo "<div id='".$nz10."' class='nz ".$nz10."'><div id ='box_".$nz10."' class='nz_box' onClick=[OpenBox('".$nz10."')]><p>+</p></div></div>"; }
				if($nz11 != "" ){echo "<div id='".$nz11."' class='nz ".$nz11."'><div id ='box_".$nz11."' class='nz_box' onClick=[OpenBox('".$nz11."')]><p>+</p></div></div>"; }
				if($nz12 != "" ){echo "<div id='".$nz12."' class='nz ".$nz12."'><div id ='box_".$nz12."' class='nz_box' onClick=[OpenBox('".$nz12."')]><p>+</p></div></div>"; }
				if($nz13 != "" ){echo "<div id='".$nz13."' class='nz ".$nz13."'><div id ='box_".$nz13."' class='nz_box' onClick=[OpenBox('".$nz13."')]><p>+</p></div></div>"; }
				if($nz14 != "" ){echo "<div id='".$nz14."' class='nz ".$nz14."'><div id ='box_".$nz14."' class='nz_box' onClick=[OpenBox('".$nz14."')]><p>+</p></div></div>"; }
				if($nz15 != "" ){echo "<div id='".$nz15."' class='nz ".$nz15."'><div id ='box_".$nz15."' class='nz_box' onClick=[OpenBox('".$nz15."')]><p>+</p></div></div>"; }
				if($nz16 != "" ){echo "<div id='".$nz16."' class='nz ".$nz16."'><div id ='box_".$nz16."' class='nz_box' onClick=[OpenBox('".$nz16."')]><p>+</p></div></div>"; }
				if($nz17 != "" ){echo "<div id='".$nz17."' class='nz ".$nz17."'><div id ='box_".$nz17."' class='nz_box' onClick=[OpenBox('".$nz17."')]><p>+</p></div></div>"; }
				if($nz18 != "" ){echo "<div id='".$nz18."' class='nz ".$nz18."'><div id ='box_".$nz18."' class='nz_box' onClick=[OpenBox('".$nz18."')]><p>+</p></div></div>"; }
				if($nz19 != "" ){echo "<div id='".$nz19."' class='nz ".$nz19."'><div id ='box_".$nz19."' class='nz_box' onClick=[OpenBox('".$nz19."')]><p>+</p></div></div>"; }
				if($nz20 != "" ){echo "<div id='".$nz20."' class='nz ".$nz20."'><div id ='box_".$nz20."' class='nz_box' onClick=[OpenBox('".$nz20."')]><p>+</p></div></div>"; }
				if($nz21 != "" ){echo "<div id='".$nz21."' class='nz ".$nz21."'><div id ='box_".$nz21."' class='nz_box' onClick=[OpenBox('".$nz21."')]><p>+</p></div></div>"; }
				if($nz22 != "" ){echo "<div id='".$nz22."' class='nz ".$nz22."'><div id ='box_".$nz22."' class='nz_box' onClick=[OpenBox('".$nz22."')]><p>+</p></div></div>"; }
				if($nz23 != "" ){echo "<div id='".$nz23."' class='nz ".$nz23."'><div id ='box_".$nz23."' class='nz_box' onClick=[OpenBox('".$nz23."')]><p>+</p></div></div>"; }
				if($nz24 != "" ){echo "<div id='".$nz24."' class='nz ".$nz24."'><div id ='box_".$nz24."' class='nz_box' onClick=[OpenBox('".$nz24."')]><p>+</p></div></div>"; }


			echo"<form method='POST'>";

//===========================================================================================================
//=============================================trennen button!===============================================
//===========================================================================================================


//zwei elemente trennenen
			$bu1 = "a";
			$bu2 = "b";

			while($bu1 != 'x'){

					$cut = $bu1."_".$bu2;

					$class = $bu1."_".$bu2."__".$bu1;
					$class_value = '1';
					include "channel/cut_set_box_class.php";

					$cut_value = "<div id='".$class."' class='cut glyphicon glyphicon-chevron-right cut_arrow ".$class."' onclick=[update_cut('".$bu1."_".$bu2."','".$bu1."','leer','".$bu2."','".$box_class1."','".$absolute1."','2','".$bu1."','".$bu2."','0','0','0','0')]></div>";



					$class2 = $bu1."_".$bu2."__".$bu2;
					$class_value = '2';
					include "channel/cut_set_box_class.php";

					$cut_value2 = "<div id='".$class2."' class='cut glyphicon glyphicon-chevron-right cut_arrow ".$class2."' onclick=[update_cut('".$bu1."_".$bu2."','".$bu2."','leer','".$bu1."','".$box_class2."','".$absolute2."','2','".$bu1."','".$bu2."','0','0','0','0')]></div>";
					include "channel/cut-if.php";

					$bu1++;
					$bu2++;
			}



//zwei elemente senkrecht trennen
			$bu1 = "a";
			$bu2 = "d";

			while($bu1 != 'x'){

			//zwei elemente
				$cut = $bu1."_".$bu2;

				$class = $bu1."_".$bu2."__".$bu1;
				$class_value = '1';
				include "channel/cut_set_box_class.php";

				$cut_value = "<div id='".$class."' class='cut glyphicon glyphicon-chevron-right cut_arrow ".$class."' onclick=[update_cut('".$bu1."_".$bu2."','".$bu1."','leer','".$bu2."','".$box_class1."','".$absolute1."','2','".$bu1."','".$bu2."','0','0','0','0')]></div>";


				$class2 = $bu1."_".$bu2."__".$bu2;
				$class_value = '2';
				include "channel/cut_set_box_class.php";

				$cut_value2 = "<div id='".$class2."' class='cut glyphicon glyphicon-chevron-right cut_arrow ".$class2."' onclick=[update_cut('".$bu1."_".$bu2."','".$bu2."','leer','".$bu1."','".$box_class2."','".$absolute2."','2','".$bu1."','".$bu2."','0','0','0','0')]></div>";
				include "channel/cut-if.php";

				$bu1++;
				$bu2++;
			}



//drei elemente trennen
			$bu1 = "a";
			$bu2 = "b";
			$bu3 = "c";

			while($bu1 != 'x'){
				$cut = $bu1."_".$bu2."_".$bu3;

				$class = $bu1."_".$bu2."_".$bu3."__".$bu1;
				$class_value = '1';
				include "channel/cut_set_box_class.php";

				$cut_value = "<div id='".$class."' class='cut glyphicon glyphicon-chevron-right cut_arrow ".$class."' onclick=[update_cut('".$bu1."_".$bu2."_".$bu3."','".$bu1."_".$bu2."','leer','".$bu3."','".$box_class1."','".$absolute1."','3','".$bu1."','".$bu2."','".$bu3."','0','0','0')]></div>";


				$class2 = $bu1."_".$bu2."_".$bu3."__".$bu2;
				$class_value = '2';
				include "channel/cut_set_box_class.php";

				$cut_value2 = "<div id='".$class2."' class='cut glyphicon glyphicon-chevron-right cut_arrow ".$class2."' onclick=[update_cut('".$bu1."_".$bu2."_".$bu3."','".$bu2."_".$bu3."','leer','".$bu1."','".$box_class2."','".$absolute2."','3','".$bu1."','".$bu2."','".$bu3."','0','0','0')]></div>";

				include "channel/cut-if.php";

				$bu1++;
				$bu2++;
				$bu3++;
			}



//vier elemente 2 x 2 trennen
			$bu1 = "a";
			$bu2 = "b";
			$bu3 = "d";
			$bu4 = "e";

			while($bu1 != 'x'){
				$cut = $bu1."_".$bu2."_".$bu3."_".$bu4;

				$class = $bu1."_".$bu2."_".$bu3."_".$bu4."__".$bu1."_".$bu2;
				$class_value = '1';
				include "channel/cut_set_box_class.php";

				$cut_value = "<div id='".$class."' class='cut glyphicon glyphicon-chevron-right cut_arrow ".$class."' onclick=[update_cut('".$bu1."_".$bu2."_".$bu3."_".$bu4."','".$bu1."_".$bu2."','leer','".$bu3."_".$bu4."','".$box_class1."','".$absolute1."','4','".$bu1."','".$bu2."','".$bu3."','".$bu4."','0','0')]></div>";



				$class2 = $bu1."_".$bu2."_".$bu3."_".$bu4."__".$bu3."_".$bu4;
				$class_value = '2';
				include "channel/cut_set_box_class.php";

				$cut_value2 = "<div id='".$class2."' class='cut glyphicon glyphicon-chevron-right cut_arrow ".$class2."' onclick=[update_cut('".$bu1."_".$bu2."_".$bu3."_".$bu4."','".$bu3."_".$bu4."','leer','".$bu1."_".$bu2."','".$box_class2."','".$absolute2."','4','".$bu1."','".$bu2."','".$bu3."','".$bu4."','0','0')]></div>";



				$class3 = $bu1."_".$bu2."_".$bu3."_".$bu4."__".$bu1."_".$bu3;
				$class_value = '3';
				include "channel/cut_set_box_class.php";

				$cut_value3 = "<div id='".$class3."' class='cut glyphicon glyphicon-chevron-right cut_arrow ".$class3."' onclick=[update_cut('".$bu1."_".$bu2."_".$bu3."_".$bu4."','".$bu1."_".$bu3."','leer','".$bu2."_".$bu4."','".$box_class3."','".$absolute3."','4','".$bu1."','".$bu2."','".$bu3."','".$bu4."','0','0')]></div>";



				$class4 = $bu1."_".$bu2."_".$bu3."_".$bu4."__".$bu2."_".$bu4;
				$class_value = '4';
				include "channel/cut_set_box_class.php";

				$cut_value4 = "<div id='".$class4."' class='cut glyphicon glyphicon-chevron-right cut_arrow ".$class4."' onclick=[update_cut('".$bu1."_".$bu2."_".$bu3."_".$bu4."','".$bu2."_".$bu4."','leer','".$bu1."_".$bu3."','".$box_class4."','".$absolute4."','4','".$bu1."','".$bu2."','".$bu3."','".$bu4."','0','0')]></div>";


				include "channel/cut-if.php";

				$bu1++;
				$bu2++;
				$bu3++;
				$bu4++;
			}



//sechs elemente 2 x 3 trennen
			$bu1 = "a";
			$bu2 = "b";
			$bu3 = "c";
			$bu4 = "d";
			$bu5 = "e";
			$bu6 = "f";

			while($bu1 != 'x'){
				$cut = $bu1."_".$bu2."_".$bu3."_".$bu4."_".$bu5."_".$bu6;

				$class = $bu1."_".$bu2."_".$bu3."_".$bu4."_".$bu5."_".$bu6."__".$bu1."_".$bu2."_".$bu3;
				$class_value = '1';
				include "channel/cut_set_box_class.php";

				$cut_value = "<div id='".$class."' class='cut glyphicon glyphicon-chevron-right cut_arrow ".$class."' onclick=[update_cut('".$bu1."_".$bu2."_".$bu3."_".$bu4."_".$bu5."_".$bu6."','".$bu1."_".$bu2."_".$bu3."','leer','".$bu4."_".$bu5."_".$bu6."','".$box_class1."','".$absolute1."','6','".$bu1."','".$bu2."','".$bu3."','".$bu4."','".$bu5."','".$bu6."')]></div>";



				$class2 = $bu1."_".$bu2."_".$bu3."_".$bu4."_".$bu5."_".$bu6."__".$bu4."_".$bu5."_".$bu6;
				$class_value = '2';
				include "channel/cut_set_box_class.php";

				$cut_value2 = "<div id='".$class2."' class='cut glyphicon glyphicon-chevron-right cut_arrow ".$class2."' onclick=[update_cut('".$bu1."_".$bu2."_".$bu3."_".$bu4."_".$bu5."_".$bu6."','".$bu4."_".$bu5."_".$bu6."','leer','".$bu1."_".$bu2."_".$bu3."','".$box_class2."','".$absolute2."','6','".$bu1."','".$bu2."','".$bu3."','".$bu4."','".$bu5."','".$bu6."')]></div>";



				$class3 = $bu1."_".$bu2."_".$bu3."_".$bu4."_".$bu5."_".$bu6."__".$bu1."_".$bu2."_".$bu4."_".$bu5;
				$class_value = '3';
				include "channel/cut_set_box_class.php";

				$cut_value3 = "<div id='".$class3."' class='cut glyphicon glyphicon-chevron-right cut_arrow ".$class3."' onclick=[update_cut('".$bu1."_".$bu2."_".$bu3."_".$bu4."_".$bu5."_".$bu6."','".$bu1."_".$bu2."_".$bu4."_".$bu5."','leer','".$bu3."_".$bu6."','".$box_class3."','".$absolute3."','6','".$bu1."','".$bu2."','".$bu3."','".$bu4."','".$bu5."','".$bu6."')]></div>";



				$class4 = $bu1."_".$bu2."_".$bu3."_".$bu4."_".$bu5."_".$bu6."__".$bu2."_".$bu3."_".$bu5."_".$bu6;
				$class_value = '4';
				include "channel/cut_set_box_class.php";

				$cut_value4 = "<div id='".$class4."' class='cut glyphicon glyphicon-chevron-right cut_arrow ".$class4."' onclick=[update_cut('".$bu1."_".$bu2."_".$bu3."_".$bu4."_".$bu5."_".$bu6."','".$bu2."_".$bu3."_".$bu5."_".$bu6."','leer','".$bu1."_".$bu4."','".$box_class4."','".$absolute4."','6','".$bu1."','".$bu2."','".$bu3."','".$bu4."','".$bu5."','".$bu6."')]></div>";

				include "channel/cut-if.php";

				$bu1++;
				$bu2++;
				$bu3++;
				$bu4++;
				$bu5++;
				$bu6++;
			}

//===========================================================================================================
//=============================================verbinden button!=============================================
//===========================================================================================================

//zwei elemente verbinden
					$bu1 = "a";
					$bu2 = "b";

					while($bu1 != 'x'){

							$con1 = $bu1;
							$con2 = $bu2;

							$class = $bu1."__".$bu1."_".$bu2;

							$class_value = '1';
							include "channel/con_set_box_class.php";

							$con_value = "<div id='".$class."' class='con glyphicon glyphicon-chevron-right con_arrow ".$class."' onclick=[update_con('".$bu1."','".$bu1."_".$bu2."','".$bu2."','hidden','".$box_class1."','".$absolute1."','1','".$bu1."','0','0','0','1','".$bu2."','0','0','0')]></div>";

							$class2 = $bu2."__".$bu1."_".$bu2;
							$class_value = '2';
							include "channel/con_set_box_class.php";

							$con_value2 = "<div id='".$class2."' class='con glyphicon glyphicon-chevron-right con_arrow ".$class2."' onclick=[update_con('".$bu2."','".$bu1."_".$bu2."','".$bu1."','hidden','".$box_class2."','".$absolute2."','1','".$bu2."','0','0','0','1','".$bu1."','0','0','0')]></div>";
							include "channel/con-if.php";

							$bu1++;
							$bu2++;
					}

//zwei elemente senkrecht verbinden
					$bu1 = "a";
					$bu2 = "d";

					while($bu1 != 'x'){

							$con1 = $bu1;
							$con2 = $bu2;

							$class = $bu1."__".$bu1."_".$bu2;

							$class_value = '1';
							include "channel/con_set_box_class.php";

							$con_value = "<div id='".$class."' class='con glyphicon glyphicon-chevron-right con_arrow ".$class."' onclick=[update_con('".$bu1."','".$bu1."_".$bu2."','".$bu2."','hidden','".$box_class1."','".$absolute1."','1','".$bu1."','0','0','0','1','".$bu2."','0','0','0')]></div>";


							$class2 = $bu2."__".$bu1."_".$bu2;
							$class_value = '2';
							include "channel/con_set_box_class.php";

							$con_value2 = "<div id='".$class2."' class='con glyphicon glyphicon-chevron-right con_arrow ".$class2."' onclick=[update_con('".$bu2."','".$bu1."_".$bu2."','".$bu1."','hidden','".$box_class2."','".$absolute2."','1','".$bu2."','0','0','0','1','".$bu1."','0','0','0')]></div>";
							include "channel/con-if.php";

							$bu1++;
							$bu2++;
					}

//drei elemente zwei + ein verbinden
					$bu1 = "a";
					$bu2 = "b";
					$bu3 = "c";

					while($bu1 != 'x'){

							$con1 = $bu1."_".$bu2;
							$con2 = $bu3;

							$class = $bu1."_".$bu2."__".$bu1."_".$bu2."_".$bu3;
							$class_value = '1';
							include "channel/con_set_box_class.php";

							$con_value = "<div id='".$class."' class='con glyphicon glyphicon-chevron-right con_arrow ".$class."' onclick=[update_con('".$bu1."_".$bu2."','".$bu1."_".$bu2."_".$bu3."','".$bu3."','hidden','".$box_class1."','".$absolute1."','2','".$bu1."','".$bu2."','0','0','1','".$bu3."','0','0','0')]></div>";


							$class2 = $bu3."__".$bu1."_".$bu2."_".$bu3;
							$class_value = '2';
							include "channel/con_set_box_class.php";

							$con_value2 = "<div id='".$class2."' class='con glyphicon glyphicon-chevron-right con_arrow ".$class2."' onclick=[update_con('".$bu3."','".$bu1."_".$bu2."_".$bu3."','".$bu1."_".$bu2."','hidden','".$box_class2."','".$absolute2."','1','".$bu3."','0','0','0','2','".$bu1."','".$bu2."','0','0')]></div>";
							include "channel/con-if.php";

							$bu1++;
							$bu2++;
							$bu3++;
					}


//drei elemente ein + zwei verbinden
					$bu1 = "a";
					$bu2 = "b";
					$bu3 = "c";

					while($bu1 != 'x'){

							$con1 = $bu2."_".$bu3;
							$con2 = $bu1;

							$class = $bu2."_".$bu3."__".$bu1."_".$bu2."_".$bu3;
							$class_value = '1';
							include "channel/con_set_box_class.php";

							$con_value = "<div id='".$class."' class='con glyphicon glyphicon-chevron-right con_arrow ".$class."' onclick=[update_con('".$bu2."_".$bu3."','".$bu1."_".$bu2."_".$bu3."','".$bu1."','hidden','".$box_class1."','".$absolute1."','2','".$bu2."','".$bu3."','0','0','1','".$bu1."','0','0','0')]></div>";



							$class2 = $bu1."__".$bu1."_".$bu2."_".$bu3;
							$class_value = '2';
							include "channel/con_set_box_class.php";

							$con_value2 = "<div id='".$class2."' class='con glyphicon glyphicon-chevron-right con_arrow ".$class2."' onclick=[update_con('".$bu1."','".$bu1."_".$bu2."_".$bu3."','".$bu2."_".$bu3."','hidden','".$box_class2."','".$absolute2."','1','".$bu1."','0','0','0','2','".$bu2."','".$bu3."','0','0')]></div>";

							include "channel/con-if.php";

							$bu1++;
							$bu2++;
							$bu3++;
					}




//vier elemente zwei + zwei senkrecht verbinden
					$bu1 = "a";
					$bu2 = "b";
					$bu3 = "d";
					$bu4 = "e";

					while($bu1 != 'x'){

							$con1 = $bu1."_".$bu2;
							$con2 = $bu3."_".$bu4;

							$class = $bu1."_".$bu2."__".$bu1."_".$bu2."_".$bu3."_".$bu4;
							$class_value = '1';
							include "channel/con_set_box_class.php";

							$con_value = "<div id='".$class."' class='con glyphicon glyphicon-chevron-right con_arrow ".$class."' onclick=[update_con('".$bu1."_".$bu2."','".$bu1."_".$bu2."_".$bu3."_".$bu4."','".$bu3."_".$bu4."','hidden','".$box_class1."','".$absolute1."','2','".$bu1."','".$bu2."','0','0','2','".$bu3."','".$bu4."','0','0')]></div>";


							$class2 = $bu3."_".$bu4."__".$bu1."_".$bu2."_".$bu3."_".$bu4;
							$class_value = '2';
							include "channel/con_set_box_class.php";

							$con_value2 = "<div id='".$class2."' class='con glyphicon glyphicon-chevron-right con_arrow ".$class2."' onclick=[update_con('".$bu3."_".$bu4."','".$bu1."_".$bu2."_".$bu3."_".$bu4."','".$bu1."_".$bu2."','hidden','".$box_class2."','".$absolute2."','2','".$bu3."','".$bu4."','0','0','2','".$bu1."','".$bu2."','0','0')]></div>";

							include "channel/con-if.php";

							$bu1++;
							$bu2++;
							$bu3++;
							$bu4++;
					}

//vier elemente zwei + zwei waggerecht 2 verbinden
					$bu1 = "a";
					$bu2 = "d";
					$bu3 = "b";
					$bu4 = "e";

					while($bu1 != 'x'){

							$con1 = $bu1."_".$bu2;
							$con2 = $bu3."_".$bu4;

							$class = $bu1."_".$bu2."__".$bu1."_".$bu3."_".$bu2."_".$bu4;
							$class_value = '1';
							include "channel/con_set_box_class.php";

							$con_value = "<div id='".$class."' class='con glyphicon glyphicon-chevron-right con_arrow ".$class."' onclick=[update_con('".$bu1."_".$bu2."','".$bu1."_".$bu3."_".$bu2."_".$bu4."','".$bu3."_".$bu4."','hidden','".$box_class1."','".$absolute1."','2','".$bu1."','".$bu2."','0','0','2','".$bu3."','".$bu4."','0','0')]></div>";



							$class2 = $bu3."_".$bu4."__".$bu1."_".$bu3."_".$bu2."_".$bu4;
							$class_value = '2';
							include "channel/con_set_box_class.php";

							$con_value2 = "<div id='".$class2."' class='con glyphicon glyphicon-chevron-right con_arrow ".$class2."' onclick=[update_con('".$bu3."_".$bu4."','".$bu1."_".$bu3."_".$bu2."_".$bu4."','".$bu1."_".$bu2."','hidden','".$box_class2."','".$absolute2."','2','".$bu3."','".$bu4."','0','0','2','".$bu1."','".$bu2."','0','0')]></div>";

							include "channel/con-if.php";

							$bu1++;
							$bu2++;
							$bu3++;
							$bu4++;
					}



//sechs elemente zwei + vier waggerecht 2 verbinden
					$bu1 = "a";
					$bu2 = "b";
					$bu3 = "c";
					$bu4 = "d";
					$bu5 = "e";
					$bu6 = "f";

					while($bu1 != 'x'){

							$con1 = $bu1."_".$bu4;
							$con2 = $bu2."_".$bu3."_".$bu5."_".$bu6;

							$class = $bu1."_".$bu4."__".$bu1."_".$bu2."_".$bu3."_".$bu4."_".$bu5."_".$bu6;
							$class_value = '1';
							include "channel/con_set_box_class.php";

							$con_value = "<div id='".$class."' class='con glyphicon glyphicon-chevron-right con_arrow ".$class."' onclick=[update_con('".$bu1."_".$bu4."','".$bu1."_".$bu2."_".$bu3."_".$bu4."_".$bu5."_".$bu6."','".$bu2."_".$bu3."_".$bu5."_".$bu6."','hidden','".$box_class1."','".$absolute1."','2','".$bu1."','".$bu4."','0','0','4','".$bu2."','".$bu3."','".$bu5."','".$bu6."')]></div>";



							$class2 = $bu2."_".$bu3."_".$bu5."_".$bu6."__".$bu1."_".$bu2."_".$bu3."_".$bu4."_".$bu5."_".$bu6;
							$class_value = '2';
							include "channel/con_set_box_class.php";

							$con_value2 = "<div id='".$class2."' class='con glyphicon glyphicon-chevron-right con_arrow ".$class2."' onclick=[update_con('".$bu2."_".$bu3."_".$bu5."_".$bu6."','".$bu1."_".$bu2."_".$bu3."_".$bu4."_".$bu5."_".$bu6."','".$bu1."_".$bu4."','hidden','".$box_class2."','".$absolute2."','4','".$bu2."','".$bu3."','".$bu5."','".$bu6."','2','".$bu1."','".$bu4."','0','0')]></div>";

						include "channel/con-if.php";

							$bu1++;
							$bu2++;
							$bu3++;
							$bu4++;
							$bu5++;
							$bu6++;
					}




//sechs elemente vier + zwei waggerecht 2 verbinden
					$bu1 = "a";
					$bu2 = "b";
					$bu3 = "c";
					$bu4 = "d";
					$bu5 = "e";
					$bu6 = "f";

					while($bu1 != 'x'){

							$con1 = $bu3."_".$bu6;
							$con2 = $bu1."_".$bu2."_".$bu4."_".$bu5;

							$class = $bu3."_".$bu6."__".$bu1."_".$bu2."_".$bu3."_".$bu4."_".$bu5."_".$bu6;
							$class_value = '1';
							include "channel/con_set_box_class.php";

							$con_value = "<div id='".$class."' class='con glyphicon glyphicon-chevron-right con_arrow ".$class."' onclick=[update_con('".$bu3."_".$bu6."','".$bu1."_".$bu2."_".$bu3."_".$bu4."_".$bu5."_".$bu6."','".$bu1."_".$bu2."_".$bu4."_".$bu5."','hidden','".$box_class1."','".$absolute1."','2','".$bu3."','".$bu6."','0','0','4','".$bu1."','".$bu2."','".$bu4."','".$bu5."')]></div>";



							$class2 = $bu1."_".$bu2."_".$bu4."_".$bu5."__".$bu1."_".$bu2."_".$bu3."_".$bu4."_".$bu5."_".$bu6;
							$class_value = '2';
							include "channel/con_set_box_class.php";

							$con_value2 = "<div id='".$class2."' class='con glyphicon glyphicon-chevron-right con_arrow ".$class2."' onclick=[update_con('".$bu1."_".$bu2."_".$bu4."_".$bu5."','".$bu1."_".$bu2."_".$bu3."_".$bu4."_".$bu5."_".$bu6."','".$bu3."_".$bu6."','hidden','".$box_class2."','".$absolute2."','4','".$bu1."','".$bu2."','".$bu4."','".$bu5."','2','".$bu3."','".$bu6."','0','0')]></div>";

						include "channel/con-if.php";

							$bu1++;
							$bu2++;
							$bu3++;
							$bu4++;
							$bu5++;
							$bu6++;
					}




//sechs elemente drei + drei senkrecht verbinden
					$bu1 = "a";
					$bu2 = "b";
					$bu3 = "c";
					$bu4 = "d";
					$bu5 = "e";
					$bu6 = "f";

					while($bu1 != 'x'){

							$con1 = $bu1."_".$bu2."_".$bu3;
							$con2 = $bu4."_".$bu5."_".$bu6;

							$class = $bu1."_".$bu2."_".$bu3."__".$bu1."_".$bu2."_".$bu3."_".$bu4."_".$bu5."_".$bu6;
							$class_value = '1';
							include "channel/con_set_box_class.php";

							$con_value = "<div id='".$class."' class='con glyphicon glyphicon-chevron-right con_arrow ".$class."' onclick=[update_con('".$bu1."_".$bu2."_".$bu3."','".$bu1."_".$bu2."_".$bu3."_".$bu4."_".$bu5."_".$bu6."','".$bu4."_".$bu5."_".$bu6."','hidden','".$box_class1."','".$absolute1."','3','".$bu1."','".$bu2."','".$bu3."','0','3','".$bu4."','".$bu5."','".$bu6."','0')]></div>";



							$class2 = $bu4."_".$bu5."_".$bu6."__".$bu1."_".$bu2."_".$bu3."_".$bu4."_".$bu5."_".$bu6;
							$class_value = '2';
							include "channel/con_set_box_class.php";

							$con_value2 = "<div id='".$class2."' class='con glyphicon glyphicon-chevron-right con_arrow ".$class2."' onclick=[update_con('".$bu4."_".$bu5."_".$bu6."','".$bu1."_".$bu2."_".$bu3."_".$bu4."_".$bu5."_".$bu6."','".$bu1."_".$bu2."_".$bu3."','hidden','".$box_class2."','".$absolute2."','3','".$bu4."','".$bu5."','".$bu6."','0','3','".$bu1."','".$bu2."','".$bu3."','0')]></div>";

						include "channel/con-if.php";

							$bu1++;
							$bu2++;
							$bu3++;
							$bu4++;
							$bu5++;
							$bu6++;
					}



//============================================================================================================
//============================================================================================================
//============================================================================================================


			echo"</form>";
          $get_video = db::$link->query( "SELECT * FROM channel_design_db WHERE uuid = '$channel_uuid'");
          $get_video = $get_video->fetch_assoc();


					$img = $get_video["img"]; $$img = "img";
					$video = $get_video["video"]; $$video = "video";
					$videobeschreibung = $get_video["videobeschreibung"]; $$videobeschreibung = "videobeschreibung";
					$diskussion = $get_video["diskussion"]; $$diskussion = "diskussion";
					$abonnenten = $get_video["abonnenten"]; $$abonnenten = "abonnenten";
					$info = $get_video["info"]; $$info = "info";
					$infofulltext = $get_video["infofulltext"]; $$infofulltext = "infofulltext";
					$playlist = $get_video["playlist"]; $$playlist = "playlist";


					$nz1 = $get_video["nz1"]; $$nz1 = "nz1";
					$nz2 = $get_video["nz2"]; $$nz2 = "nz2";
					$nz3 = $get_video["nz3"]; $$nz3 = "nz3";
					$nz4 = $get_video["nz4"]; $$nz4 = "nz4";
					$nz5 = $get_video["nz5"]; $$nz5 = "nz5";
					$nz6 = $get_video["nz6"]; $$nz6 = "nz6";
					$nz7 = $get_video["nz7"]; $$nz7 = "nz7";
					$nz8 = $get_video["nz8"]; $$nz8 = "nz8";
					$nz9 = $get_video["nz9"]; $$nz9 = "nz9";
					$nz10 = $get_video["nz10"]; $$nz10 = "nz10";
					$nz11 = $get_video["nz11"]; $$nz11 = "nz11";
					$nz12 = $get_video["nz12"]; $$nz12 = "nz12";
					$nz13 = $get_video["nz13"]; $$nz13 = "nz13";
					$nz14 = $get_video["nz14"]; $$nz14 = "nz14";
					$nz15 = $get_video["nz15"]; $$nz15 = "nz15";
					$nz16 = $get_video["nz16"]; $$nz16 = "nz16";
					$nz17 = $get_video["nz17"]; $$nz17 = "nz17";
					$nz18 = $get_video["nz18"]; $$nz18 = "nz18";
					$nz19 = $get_video["nz19"]; $$nz19 = "nz19";
					$nz20 = $get_video["nz20"]; $$nz20 = "nz20";
					$nz21 = $get_video["nz21"]; $$nz21 = "nz21";
					$nz22 = $get_video["nz22"]; $$nz22 = "nz22";
					$nz23 = $get_video["nz23"]; $$nz23 = "nz23";
					$nz24 = $get_video["nz24"]; $$nz24 = "nz24";


//===========================================================================================================
//================================================  Update  =================================================
//===========================================================================================================
			?><div class="hidden" id="update_conten_load"></div>



			<script>

			//Elemente Verbiden
		    function update_con(pos1,letter1,pos2,letter2,classs,absolute,gross1,l1_1,l1_2,l1_3,l1_4,gross2,l2_1,l2_2,l2_3,l2_4){
				//positions eins (wird grösser)

			//var class und absloute erstellen
				var absolute = IdSearch_Absolute(pos1); var classs = IdSearch_Class(pos1);

				var idTest = document.getElementById(pos1);
				var testNz = (' ' + idTest.className + ' ').indexOf(' ' + "nz" + ' ') > -1;
				if(testNz == true){var absolute = 'nz'; var classs = '';}



		      document.getElementById(pos1).className = letter1+" "+classs+" "+absolute;
					document.getElementById(pos1).id = letter1;


					var idTest = document.getElementById(letter1);
					var testNz = (' ' + idTest.className + ' ').indexOf(' ' + "nz" + ' ') > -1;
					if(testNz == true){
						//vergrössern
						if(document.getElementById("box_"+pos1)){document.getElementById("box_"+pos1).id = "box_"+letter1;}
						if(document.getElementById("box_"+letter1)){document.getElementById("box_"+letter1).setAttribute( "onClick", "[OpenBox('"+letter1+"')]" );}
					} else {
						if(document.getElementById("delbox-"+pos1)){document.getElementById("delbox-"+pos1).id = "delbox-"+letter1;}
						if(document.getElementById("delbox-"+letter1)){document.getElementById("delbox-"+letter1).setAttribute( "onClick", "[CloseBoxEdit('"+letter1+"','"+classs+"')]" );}
					}


					var idTest2 = document.getElementById(pos2);
					var testNz2 = (' ' + idTest2.className + ' ').indexOf(' ' + "nz" + ' ') > -1;
					if(testNz2 == true){
						//auswahlmenu
						var delEditMenu = document.getElementById("nz_box-"+pos2);
						if(delEditMenu){
							delEditMenu.parentNode.removeChild(delEditMenu);
						}
						//auswahlmenu hintergrund
						var delEditBackground = document.getElementById("nz_background-"+pos2);
						if(delEditBackground){
							delEditBackground.parentNode.removeChild(delEditBackground);
						}
					}

					//positions zwei (wird gelöscht)
						var delDiv = document.getElementById(pos2);
						delDiv.parentNode.removeChild(delDiv);

				//Funktions zum löschen der altem Pfeile
					ButtonsDel(gross1,l1_1,l1_2,l1_3,l1_4,'0','0',gross2,l2_1,l2_2,l2_3,l2_4);

				//Funktions zum erstellen der neuen Pfeile
					ButtonsAddCon(gross1,l1_1,l1_2,l1_3,l1_4,'0','0',gross2,l2_1,l2_2,l2_3,l2_4);


				//speichern
		      setTimeout( function() {
							$.post('channel/update_edit_positions',{'pos1': pos1, 'letter1': letter1, 'pos2': pos2, 'letter2': letter2}, function(data) {
		            $('#update_conten_load').html(data);
		          })
		        } , 25);
		    }










//Elemente Trennen
				function update_cut(pos1,letter1,leer,letter2,classs,absolute,gross1,l1_1,l1_2,l1_3,l1_4,l1_5,l1_6,gross2,l2_1,l2_2,l2_3,l2_4){

			//var class und absloute erstellen
				var absolute = IdSearch_Absolute(pos1); var classs = IdSearch_Class(pos1);

				var idTest = document.getElementById(pos1);
				var testNz = (' ' + idTest.className + ' ').indexOf(' ' + "nz" + ' ') > -1;
				if(testNz == true){var absolute = 'nz'; var classs = '';}


				//positions eins (wird kleiner)
					document.getElementById(pos1).className = letter1+" "+classs+" "+absolute;
					document.getElementById(pos1).id = letter1;


					var idTest = document.getElementById(letter1);

					var testNz = (' ' + idTest.className + ' ').indexOf(' ' + "nz" + ' ') > -1;
					if(testNz == true){
						//verkleinern
							document.getElementById("box_"+pos1).id = "box_"+letter1;
							document.getElementById("box_"+letter1).setAttribute( "onClick", "[OpenBox('"+letter1+"')]" );
					} else {
						if(document.getElementById("delbox-"+pos1)){document.getElementById("delbox-"+pos1).id = "delbox-"+letter1;}
						if(document.getElementById("delbox-"+letter1)){document.getElementById("delbox-"+letter1).setAttribute( "onClick", "[CloseBoxEdit('"+letter1+"','"+classs+"')]" );}
					}




				//positions zwei (wird erzeugt)
					//document.getElementById(pos2).className = letter2+" "+classs+" "+absolute;

					// boxRahmen
						var BoxDiv = document.createElement("div");
						var BoxValue = document.createTextNode("");
						BoxDiv.id = letter2;
						BoxDiv.className = letter2+" nz "+absolute;
						BoxDiv.appendChild(BoxValue);
						var Ausgabebereich = document.getElementById("main");
						Ausgabebereich.appendChild(BoxDiv);

					// box +
						var BoxDivPlus = document.createElement("div");
						var BoxValuePlus = document.createTextNode("");
						var BoxIDPlus = "box_"+letter2;
						var BoxOnClickPlus = "OpenBox('"+letter2+"')";
						BoxDivPlus.id = BoxIDPlus;
						BoxDivPlus.className = "nz_box";
						BoxDivPlus.appendChild(BoxValuePlus);
						var AusgabebereichPlus = document.getElementById(letter2);
						AusgabebereichPlus.appendChild(BoxDivPlus);

						document.getElementById(BoxIDPlus).setAttribute( "onClick", BoxOnClickPlus );
						document.getElementById(BoxIDPlus).innerHTML = "<p>+</p>";



				//Funktions zum löschen der altem Pfeile
					ButtonsDel(gross1,l1_1,l1_2,l1_3,l1_4,l1_5,l1_6);

				//Funktions zum erstellen der neuen Pfeile
					ButtonsAddCut(gross1,l1_1,l1_2,l1_3,l1_4,l1_5,l1_6);





				//speichern
					setTimeout( function() {
							$.post('channel/update_edit_positions',{'pos1': pos1, 'letter1': letter1, 'leer': leer, 'letter2': letter2}, function(data) {
								$('#update_conten_load').html(data);
							})
						} , 25);


				}




		function OpenBox(idValue){

			var delOpenMenu = document.getElementById("nz_box-"+idValue);
			if(delOpenMenu){
				delOpenMenu.parentNode.removeChild(delOpenMenu);
			}

			var delOpenMenuBackground = document.getElementById("nz_background-"+idValue);
			if(delOpenMenuBackground){
				delOpenMenuBackground.parentNode.removeChild(delOpenMenuBackground);
			}

			//auswahl Box
				var BoxDivContent = document.createElement("div");
				var BoxValueContent = document.createTextNode("");
				BoxDivContent.id = "nz_box-"+idValue;
				BoxDivContent.className = "nz_add_box";
				BoxDivContent.appendChild(BoxValueContent);
				var AusgabebereichContent = document.getElementById("main");
				AusgabebereichContent.appendChild(BoxDivContent);

				document.getElementById("nz_box-"+idValue).setAttribute( "style", "display:none;" );



				if(document.getElementsByClassName("img")[0]){var imgButton1 = "<div class='addBox add_bild'>";  imgButton2 = "</div>";}else{var imgButton1 = "<button class='addBox add_bild' onClick=[addBoxEdit('"+idValue+"','img')]>";  imgButton2 = "</button>";}
				var imgValue = "<span class='img_edit_box'>"+imgButton1+"<h1><?php echo $la->bild_edit_title; ?></h1>"+imgButton2+"</span>";

				if(document.getElementsByClassName("info")[0]){var infoButton1 = "<div class='addBox add_info'>";  infoButton2 = "</div>";}else{var infoButton1 = "<button class='addBox add_info' onClick=[addBoxEdit('"+idValue+"','info')]>"; infoButton2 = "</button>";}
				var infoValue = "<span class='info_edit_box'>"+infoButton1+"<h1><?php echo $la->info_edit_title; ?></h1>"+infoButton2+"</span>";

				if(document.getElementsByClassName("infofulltext")[0]){var infofulltextButton1 = "<div class='addBox add_infofulltext'>";  infofulltextButton2 = "</div>";}else{var infofulltextButton1 = "<button class='addBox add_infofulltext' onClick=[addBoxEdit('"+idValue+"','infofulltext')]>"; infofulltextButton2 = "</button>";}
				var infofulltextValue = "<span class='infofulltext_edit_box'>"+infofulltextButton1+"<h1><?php echo $la->infofulltext_edit_title; ?></h1>"+infofulltextButton2+"</span>";

				if(document.getElementsByClassName("video")[0]){var videoButton1 = "<div class='addBox add_video'>";  videoButton2 = "</div>";}else{var videoButton1 = "<button class='addBox add_video' onClick=[addBoxEdit('"+idValue+"','video')]>"; videoButton2 = "</button>";}
				var videoValue = "<span class='video_edit_box'>"+videoButton1+"<h1><?php echo $la->video_edit_title; ?></h1>"+videoButton2+"</span>";

				if(document.getElementsByClassName("videobeschreibung")[0]){var videobeschreibungButton1 = "<div class='addBox add_videobeschreibung'>";  videobeschreibungButton2 = "</div>";}else{var videobeschreibungButton1 = "<button class='addBox add_videobeschreibung' onClick=[addBoxEdit('"+idValue+"','videobeschreibung')]>"; videobeschreibungButton2 = "</button>";}
				var videobeschreibungValue = "<span class='videobeschreibung_edit_box'>"+videobeschreibungButton1+"<h1><?php echo $la->videobeschreibung_edit_title; ?></h1>"+videobeschreibungButton2+"</span>";

				if(document.getElementsByClassName("abonnenten")[0]){var abonnentenButton1 = "<div class='addBox add_abonnenten'>";  abonnentenButton2 = "</div>";}else{var abonnentenButton1 = "<button class='addBox add_abonnenten' onClick=[addBoxEdit('"+idValue+"','abonnenten')]>"; abonnentenButton2 = "</button>";}
				var abonnentenValue = "<span class='abonnenten_edit_box'>"+abonnentenButton1+"<h1><?php echo $la->abonnenten_edit_title; ?></h1>"+abonnentenButton2+"</span>";

				if(document.getElementsByClassName("diskussion")[0]){var diskussionButton1 = "<div class='addBox add_diskussion'>";  diskussionButton2 = "</div>";}else{var diskussionButton1 = "<button class='addBox add_diskussion' onClick=[addBoxEdit('"+idValue+"','diskussion')]>"; diskussionButton2 = "</button>";}
				var diskussionValue = "<span class='diskussion_edit_box'>"+diskussionButton1+"<h1><?php echo $la->diskussion_edit_title; ?></h1>"+diskussionButton2+"</span>";

				var commingsoonButton1 = "<div class='addBox add_commingsoon' >"; commingsoonButton2 = "</div>";
				var commingsoonValue = "<span class='commingsoon_edit_box'>"+commingsoonButton1+"<h1><?php echo $la->comming_soon_edit_title; ?></h1>"+commingsoonButton2+"</span>";



				document.getElementById("nz_box-"+idValue).innerHTML =
				"<div class='close_nz_box glyphicon glyphicon-remove' onclick=[CloseBox('"+idValue+"')]></div><boxtitle><?php echo $la->addContent;?></boxtitle>"+imgValue+" "+infoValue+" "+infofulltextValue+" "+videoValue+" "+videobeschreibungValue+" "+abonnentenValue+" "+diskussionValue+" "+commingsoonValue+" "+commingsoonValue+"</div>";


			//auswahl Box Background
				var BoxDivBackground = document.createElement("div");
				var BoxValueBackground = document.createTextNode("");
				var BoxOnClickBackground = "CloseBox('"+idValue+"')";
				BoxDivBackground.id = "nz_background-"+idValue;
				BoxDivBackground.className = "nz_background";
				BoxDivBackground.appendChild(BoxValueBackground);
				var AusgabebereichBackground = document.getElementById("main");
				AusgabebereichBackground.appendChild(BoxDivBackground);

				document.getElementById("nz_background-"+idValue).setAttribute( "onClick", BoxOnClickBackground );
				document.getElementById("nz_background-"+idValue).setAttribute( "style", "display:none;" );


			//Auswahlbox öffnen
				document.getElementById("nz_box-"+idValue).style.display = 'block';
				document.getElementById("nz_background-"+idValue).style.display = 'block';
		}







		function CloseBox(idValue){
			document.getElementById("nz_box-"+idValue).style.display = 'none';
			document.getElementById("nz_background-"+idValue).style.display = 'none';

			var delCloseMenu = document.getElementById("nz_box-"+idValue);
			if(delCloseMenu){
				delCloseMenu.parentNode.removeChild(delCloseMenu);
			}
		}



    function OpenEditBox(edittype){
      $('.pm_container_edit_'+edittype).removeClass('hide');
      $('.body').addClass('stop_srolling');
    }

		/*function OpenEditBox(ElementType){
			document.getElementById("edit_box-"+ElementType).style.display = 'block';
			document.getElementById("editboxtitle-"+ElementType).style.display = 'block';
			document.getElementById("edit_background-"+ElementType).style.display = 'block';
		}*/

		function CloseEditBox(edittype){
      $('.pm_container_edit_'+edittype).addClass('hide');
      $('.body').removeClass('stop_srolling');
		}

    $(document).mouseup(function (e){
      var container = $('.pm_container_edit,.pm_container_edit_av,.pm_container_edit_bg');
      var container2 = $('.bm_container');
      if (!container.is(e.target) && container.has(e.target).length === 0 && !container2.is(e.target) && container2.has(e.target).length === 0){
        $('.pm_edit_to_hide').addClass('hide');
        $('.body').removeClass('stop_srolling');
      }
    });

    /*function CloseEditBox(ElementType){
      document.getElementById("edit_box-"+ElementType).style.display = 'none';
      document.getElementById("editboxtitle-"+ElementType).style.display = 'none';
      document.getElementById("edit_background-"+ElementType).style.display = 'none';
    }*/




		function addBoxEdit(box,classValue) {
		    var x = document.getElementsByClassName(classValue+"_edit_box");
		    var i;
		    for (i = 0; i < x.length; i++) {
		        // x[i].style.backgroundColor = "red";
						if(classValue == "img"){x[i].innerHTML = "<div class='addBox add_bild'><h1><?php echo $la->bild_edit_title; ?></h1></div>";}
						if(classValue == "info"){x[i].innerHTML = "<div class='addBox add_info'><h1><?php echo $la->info_edit_title; ?></h1></div>";}
						if(classValue == "infofulltext"){x[i].innerHTML = "<div class='addBox add_infofulltext'><h1><?php echo $la->infofulltext_edit_title; ?></h1></div>";}
						if(classValue == "video"){x[i].innerHTML = "<div class='addBox add_video'><h1><?php echo $la->video_edit_title; ?></h1></div>";}
						if(classValue == "videobeschreibung"){x[i].innerHTML = "<div class='addBox add_videobeschreibung'><h1><?php echo $la->videobeschreibung_edit_title; ?></h1></div>";}
						if(classValue == "abonnenten"){x[i].innerHTML = "<div class='addBox add_abonnenten'><h1><?php echo $la->abonnenten_edit_title; ?></h1></div>";}
						if(classValue == "diskussion"){x[i].innerHTML = "<div class='addBox add_abonnenten'><h1><?php echo $la->diskussion_edit_title; ?></h1></div>";}


				}

			//löschen, erstellen und schliesen der boxen
				var delbox = document.getElementById("box_"+box);
				delbox.parentNode.removeChild(delbox);

				var delnz_box = document.getElementById("nz_box-"+box);
				delnz_box.parentNode.removeChild(delnz_box);

				var delnz_background = document.getElementById("nz_background-"+box);
				delnz_background.parentNode.removeChild(delnz_background);


				document.getElementById(box).className = classValue+" "+box+" absolute_edit";
				if(classValue == "img"){document.getElementById(box).innerHTML = "<h1 class='box_title'><?php echo $la->bild_edit_title; ?></h1><div class='img_edit edit glyphicon glyphicon-pencil' onClick=[OpenEditBox('img')]></div><button id='delbox-"+box+"' onClick=[CloseBoxEdit('"+box+"','img')] class='close_box glyphicon glyphicon-remove'></button>";}
				if(classValue == "info"){document.getElementById(box).innerHTML = "<h1 class='box_title'><?php echo $la->info_edit_title; ?></h1><div class='info_edit edit glyphicon glyphicon-pencil' onClick=[OpenEditBox('info')]></div><button id='delbox-"+box+"' onClick=[CloseBoxEdit('"+box+"','info')] class='close_box glyphicon glyphicon-remove'></button>";}
				if(classValue == "infofulltext"){document.getElementById(box).innerHTML = "<h1 class='box_title'><?php echo $la->infofulltext_edit_title; ?></h1><div class='infofulltext_edit edit glyphicon glyphicon-pencil' onClick=[OpenEditBox('infofulltext')]></div><button id='delbox-"+box+"' onClick=[CloseBoxEdit('"+box+"','infofulltext')] class='close_box glyphicon glyphicon-remove'></button>";}
				if(classValue == "video"){document.getElementById(box).innerHTML = "<h1 class='box_title'><?php echo $la->video_edit_title; ?></h1><div class='video_edit edit glyphicon glyphicon-pencil' onClick=[OpenEditBox('video')]></div><button id='delbox-"+box+"' onClick=[CloseBoxEdit('"+box+"','video')] class='close_box glyphicon glyphicon-remove'></button>";}
				if(classValue == "videobeschreibung"){document.getElementById(box).innerHTML = "<h1 class='box_title'><?php echo $la->videobeschreibung_edit_title; ?></h1><div class='videobeschreibung_edit none_edit' title='<?php echo $la->automatisch; ?>'>A</div><button id='delbox-"+box+"' onClick=[CloseBoxEdit('"+box+"','videobeschreibung')] class='close_box glyphicon glyphicon-remove'></button>";}
				if(classValue == "abonnenten"){document.getElementById(box).innerHTML = "<h1 class='box_title'><?php echo $la->abonnenten_edit_title; ?></h1><div class='abonnenten_edit none_edit' title='<?php echo $la->automatisch; ?>'>A</div><button id='delbox-"+box+"' onClick=[CloseBoxEdit('"+box+"','abonnenten')] class='close_box glyphicon glyphicon-remove'></button>";}
				if(classValue == "diskussion"){document.getElementById(box).innerHTML = "<h1 class='box_title'><?php echo $la->diskussion_edit_title; ?></h1><div class='diskussion_edit none_edit' title='<?php echo $la->automatisch; ?>'>A</div><button id='delbox-"+box+"' onClick=[CloseBoxEdit('"+box+"','diskussion')] class='close_box glyphicon glyphicon-remove'></button>";}


				//speichern
					setTimeout( function() {
							$.post('channel/update_edit_positions',{'setpos1': box, 'setvar': classValue}, function(data) {
								$('#update_conten_load').html(data);
							})
						} , 25);
		}


		function CloseBoxEdit(box,classValue) {

				var delbox = document.getElementById(box);
				delbox.parentNode.removeChild(delbox);

				// boxRahmen
					var BoxDiv = document.createElement("div");
					var BoxValue = document.createTextNode("");
					BoxDiv.id = box;
					BoxDiv.className = box+" nz";
					BoxDiv.appendChild(BoxValue);
					var Ausgabebereich = document.getElementById("main");
					Ausgabebereich.appendChild(BoxDiv);

				// box +
					var BoxDivPlus = document.createElement("div");
					var BoxValuePlus = document.createTextNode("");
					var BoxIDPlus = "box_"+box;
					var BoxOnClickPlus = "OpenBox('"+box+"')";
					BoxDivPlus.id = BoxIDPlus;
					BoxDivPlus.className = "nz_box";
					BoxDivPlus.appendChild(BoxValuePlus);
					var AusgabebereichPlus = document.getElementById(box);
					AusgabebereichPlus.appendChild(BoxDivPlus);

					document.getElementById(BoxIDPlus).setAttribute( "onClick", BoxOnClickPlus );
					document.getElementById(BoxIDPlus).innerHTML = "<p>+</p>";



				//speichern
					setTimeout( function() {
							$.post('channel/update_edit_positions',{'setpos2': classValue, 'leer': box}, function(data) {
								$('#update_conten_load').html(data);
							})
						} , 25);
		}






//===============================================================================================================
//======================================= id + Class suchen =====================================================
//===============================================================================================================

function IdSearch_Class(idValue){

		var idTest = document.getElementById(idValue);

		var classValue0 = "img";
		var testErg0 = (' ' + idTest.className + ' ').indexOf(' ' + classValue0 + ' ') > -1;
		if(testErg0 == true){var classValue = classValue0; var classCheck = "1";}

		var classValue1 = "video";
		var testErg1 = (' ' + idTest.className + ' ').indexOf(' ' + classValue1 + ' ') > -1;
		if(testErg1 == true){var classValue = classValue1; var classCheck = "1";}

		var classValue2 = "videobeschreibung";
		var testErg2 = (' ' + idTest.className + ' ').indexOf(' ' + classValue2 + ' ') > -1;
		if(testErg2 == true){var classValue = classValue2; var classCheck = "1";}

		var classValue3 = "diskussion";
		var testErg3 = (' ' + idTest.className + ' ').indexOf(' ' + classValue3 + ' ') > -1;
		if(testErg3 == true){var classValue = classValue3; var classCheck = "1";}

		var classValue4 = "abonnenten";
		var testErg4 = (' ' + idTest.className + ' ').indexOf(' ' + classValue4 + ' ') > -1;
		if(testErg4 == true){var classValue = classValue4; var classCheck = "1";}

		var classValue5 = "info";
		var testErg5 = (' ' + idTest.className + ' ').indexOf(' ' + classValue5 + ' ') > -1;
		if(testErg5 == true){var classValue = classValue5; var classCheck = "1";}

		var classValue6 = "infofulltext";
		var testErg6 = (' ' + idTest.className + ' ').indexOf(' ' + classValue6 + ' ') > -1;
		if(testErg6 == true){var classValue = classValue6; var classCheck = "1";}

		var classValue7 = "playlist";
		var testErg7 = (' ' + idTest.className + ' ').indexOf(' ' + classValue7 + ' ') > -1;
		if(testErg7 == true){var classValue = classValue7; var classCheck = "1";}

		if( classCheck != "1"){var classValue = "";}

		return classValue;
}



function IdSearch_Absolute(idValue){

		var idTest = document.getElementById(idValue);

		var classValue0 = "img";
		var testErg0 = (' ' + idTest.className + ' ').indexOf(' ' + classValue0 + ' ') > -1;

		var classValue1 = "video";
		var testErg1 = (' ' + idTest.className + ' ').indexOf(' ' + classValue1 + ' ') > -1;

		var classValue2 = "videobeschreibung";
		var testErg2 = (' ' + idTest.className + ' ').indexOf(' ' + classValue2 + ' ') > -1;

		var classValue3 = "diskussion";
		var testErg3 = (' ' + idTest.className + ' ').indexOf(' ' + classValue3 + ' ') > -1;

		var classValue4 = "abonnenten";
		var testErg4 = (' ' + idTest.className + ' ').indexOf(' ' + classValue4 + ' ') > -1;

		var classValue5 = "info";
		var testErg5 = (' ' + idTest.className + ' ').indexOf(' ' + classValue5 + ' ') > -1;

		var classValue6 = "infofulltext";
		var testErg6 = (' ' + idTest.className + ' ').indexOf(' ' + classValue6 + ' ') > -1;

		var classValue7 = "playlist";
		var testErg7 = (' ' + idTest.className + ' ').indexOf(' ' + classValue7 + ' ') > -1;



		if(testErg0==true || testErg1==true || testErg2==true || testErg3==true || testErg4==true || testErg5==true || testErg6==true || testErg7==true){var absolute = "absolute_edit";}else{var absolute = "nz";}



		return absolute;
}

//===============================================================================================================
//===============================================================================================================
//===============================================================================================================
//======================================= Addieren Button Con ===== =============================================
//===============================================================================================================
//===============================================================================================================
//===============================================================================================================


function ButtonsAddCon(gross1,l1_1,l1_2,l1_3,l1_4,l1_5,l1_6,gross2,l2_1,l2_2,l2_3,l2_4){
						//Generator
						//b1 = Base1 also die pos1
						//hl1 = horizontal1 left also die pos1 - 2 nach links
						//hl2 = horizontal2 left also die pos1 - 1 nach links
						//hl3 = horizontal3 left also die pos1 - 2 nach links und -1 nach unten
						//hl4 = horizontal4 left also die pos1 - 1 nach links und -1 nach unten
						//vd1 = vertical1 down also die pos1 - 1 nach unten
						//vu1 = vertical1 up also die pos1 + 1 nach oben
						//hr1 = horizontal1 right also die pos1 + 1 nach rechts
						//hr2 = horizontal2 right also die pos1 + 2 nach rechts
						//hr3 = horizontal3 right also die pos1 + 1 nach rechts und -1 nach unten
						//hr4 = horizontal4 right also die pos1 + 2 nach rechts und -1 nach unten


	//wenn ein Con button gedrückt wird
					if(gross1 == '1'){


							if(gross2 == '1'){

								//pos1
									var b1_1 = l1_1;
									var b2_1 = l2_1;

										if(b1_1 != 'a' || b1_1 != 'b'){var hl1_1 = String.fromCharCode(b1_1.charCodeAt(0)-2);}
										if(b1_1 != 'a' )							{var hl1_2 = String.fromCharCode(b1_1.charCodeAt(0)-1);}
										if(b2_1 != 'a' | b2_1 != 'b')	{var hl1_3 = String.fromCharCode(b2_1.charCodeAt(0)-2);}
										if(b2_1 != 'a' )							{var hl1_4 = String.fromCharCode(b2_1.charCodeAt(0)-1);}
										if(b1_1 != 'a' || b1_1 != 'b' || b1_1 != 'c'){var vu1_1 = String.fromCharCode(b1_1.charCodeAt(0)-3);}
										if(b2_1 != 'a' || b2_1 != 'b' || b2_1 != 'c'){var vu2_1 = String.fromCharCode(b2_1.charCodeAt(0)-3);}
										if(b1_1 != 'v' || b1_1 != 'w' || b1_1 != 'x'){var vd1_1 = String.fromCharCode(b1_1.charCodeAt(0)+3);}
										if(b2_1 != 'v' || b2_1 != 'w' || b2_1 != 'x'){var vd2_1 = String.fromCharCode(b2_1.charCodeAt(0)+3);}
										if(b1_1 != 'x')								{var hr1_1 = String.fromCharCode(b1_1.charCodeAt(0)+1);}
										if(b1_1 != 'w' || b1_1 != 'x'){var hr1_2 = String.fromCharCode(b1_1.charCodeAt(0)+2);}
										if(b2_1 != 'x')								{var hr1_3 = String.fromCharCode(b2_1.charCodeAt(0)+1);}
										if(b2_1 != 'w' || b2_1 != 'x'){var hr1_4 = String.fromCharCode(b2_1.charCodeAt(0)+2);}


					//cut Pfeiele
					if (document.getElementById(b1_1+"_"+b2_1)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b2_1); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1);
								var addValue = b1_1+"_"+b2_1+"__"+b1_1;
								var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"','"+b1_1+"','leer','"+b2_1+"','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					if (document.getElementById(b1_1+"_"+b2_1)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b2_1); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1);
								var addValue = b1_1+"_"+b2_1+"__"+b2_1;
								var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"','"+b2_1+"','leer','"+b1_1+"','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

			//fals gross2 und gross1 umgekehrt ist:
					//cut Pfeiele
						if (document.getElementById(b2_1+"_"+b1_1)) {
									var	classValue = IdSearch_Class(b2_1+"_"+b1_1); var absolute = IdSearch_Absolute(b2_1+"_"+b1_1);
									var addValue = b2_1+"_"+b1_1+"__"+b2_1;
									var clickValue = "[update_cut('"+b2_1+"_"+b1_1+"','"+b2_1+"','leer','"+b1_1+"','"+classValue+"','"+absolute+"','2','"+b2_1+"','"+b1_1+"','0','0','0','0')]";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}

						if (document.getElementById(b2_1+"_"+b1_1)) {
									var	classValue = IdSearch_Class(b2_1+"_"+b1_1); var absolute = IdSearch_Absolute(b2_1+"_"+b1_1);
									var addValue = b2_1+"_"+b1_1+"__"+b1_1;
									var clickValue = "[update_cut('"+b2_1+"_"+b1_1+"','"+b1_1+"','leer','"+b2_1+"','"+classValue+"','"+absolute+"','2','"+b2_1+"','"+b1_1+"','0','0','0','0')]";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}

					//con Pfeile

						//horizontal
							//pfeil nach oben
								if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(vu1_1+"_"+vu2_1)) {
											var	classValue = IdSearch_Class(b1_1+"_"+b2_1); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1);

											var addValue = b1_1+"_"+b2_1+"__"+vu1_1+"_"+vu2_1+"_"+b1_1+"_"+b2_1;
											var clickValue = "update_con('"+b1_1+"_"+b2_1+"','"+vu1_1+"_"+vu2_1+"_"+b1_1+"_"+b2_1+"','"+vu1_1+"_"+vu2_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','2','"+vu1_1+"','"+vu2_1+"','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
								}

								//pfeil nach oben 2
									if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(vu1_1+"_"+vu2_1)) {
												var	classValue = IdSearch_Class(vu1_1+"_"+vu2_1); var absolute = IdSearch_Absolute(vu1_1+"_"+vu2_1);

												var addValue = vu1_1+"_"+vu2_1+"__"+vu1_1+"_"+vu2_1+"_"+b1_1+"_"+b2_1;
												var clickValue = "update_con('"+vu1_1+"_"+vu2_1+"','"+vu1_1+"_"+vu2_1+"_"+b1_1+"_"+b2_1+"','"+b1_1+"_"+b2_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','2','"+vu1_1+"','"+vu2_1+"','0','0')";
												var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}


							//pfeil nach rechts
								if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hr1_2)) {
											var	classValue = IdSearch_Class(b1_1+"_"+b2_1); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1);

											var addValue = b1_1+"_"+b2_1+"__"+b1_1+"_"+b2_1+"_"+hr1_2;
											var clickValue = "update_con('"+b1_1+"_"+b2_1+"','"+b1_1+"_"+b2_1+"_"+hr1_2+"','"+hr1_2+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','1','"+hr1_2+"','0','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
								}

							//pfeil nach rechts 2
								if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hr1_2)) {
											var	classValue = IdSearch_Class(hr1_2); var absolute = IdSearch_Absolute(hr1_2);

											var addValue = hr1_2+"__"+b1_1+"_"+b2_1+"_"+hr1_2;
											var clickValue = "update_con('"+hr1_2+"','"+b1_1+"_"+b2_1+"_"+hr1_2+"','"+b1_1+"_"+b2_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','1','"+hr1_2+"','0','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
								}


							//pfeil nach unten
								if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(vd1_1+"_"+vd2_1)) {
											var	classValue = IdSearch_Class(b1_1+"_"+b2_1); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1);

											var addValue = b1_1+"_"+b2_1+"__"+b1_1+"_"+b2_1+"_"+vd1_1+"_"+vd2_1;
											var clickValue = "update_con('"+b1_1+"_"+b2_1+"','"+b1_1+"_"+b2_1+"_"+vd1_1+"_"+vd2_1+"','"+vd1_1+"_"+vd2_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','2','"+vd1_1+"','"+vd2_1+"','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
								}

							//pfeil nach unten 2
								if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(vd1_1+"_"+vd2_1)) {
											var	classValue = IdSearch_Class(vd1_1+"_"+vd2_1); var absolute = IdSearch_Absolute(vd1_1+"_"+vd2_1);

											var addValue = vd1_1+"_"+vd2_1+"__"+b1_1+"_"+b2_1+"_"+vd1_1+"_"+vd2_1;
											var clickValue = "update_con('"+vd1_1+"_"+vd2_1+"','"+b1_1+"_"+b2_1+"_"+vd1_1+"_"+vd2_1+"','"+b1_1+"_"+b2_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','2','"+vd1_1+"','"+vd2_1+"','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
								}


							//pfeil nach links
								if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hl1_2)) {
											var	classValue = IdSearch_Class(b1_1+"_"+b2_1); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1);

											var addValue = b1_1+"_"+b2_1+"__"+hl1_2+"_"+b1_1+"_"+b2_1;
											var clickValue = "update_con('"+b1_1+"_"+b2_1+"','"+hl1_2+"_"+b1_1+"_"+b2_1+"','"+hl1_2+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','1','"+hl1_2+"','0','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
								}

							//pfeil nach links 2
								if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hl1_2)) {
											var	classValue = IdSearch_Class(hl1_2); var absolute = IdSearch_Absolute(hl1_2);

											var addValue = hl1_2+"__"+hl1_2+"_"+b1_1+"_"+b2_1;
											var clickValue = "update_con('"+hl1_2+"','"+hl1_2+"_"+b1_1+"_"+b2_1+"','"+b1_1+"_"+b2_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','1','"+hl1_2+"','0','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
								}



				//Vertical
					//pfeil nach rechts
						if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hr1_1+"_"+hr1_3)) {
									var	classValue = IdSearch_Class(b1_1+"_"+b2_1); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1);

									var addValue = b1_1+"_"+b2_1+"__"+b1_1+"_"+hr1_1+"_"+b2_1+"_"+hr1_3;
									var clickValue = "update_con('"+b1_1+"_"+b2_1+"','"+b1_1+"_"+hr1_1+"_"+b2_1+"_"+hr1_3+"','"+hr1_1+"_"+hr1_3+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','2','"+hr1_1+"','"+hr1_3+"','0','0')";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}

					//pfeil nach rechts 2
						if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hr1_1+"_"+hr1_3)) {
									var	classValue = IdSearch_Class(hr1_1+"_"+hr1_3); var absolute = IdSearch_Absolute(hr1_1+"_"+hr1_3);

									var addValue = hr1_1+"_"+hr1_3+"__"+b1_1+"_"+hr1_1+"_"+b2_1+"_"+hr1_3;
									var clickValue = "update_con('"+hr1_1+"_"+hr1_3+"','"+b1_1+"_"+hr1_1+"_"+b2_1+"_"+hr1_3+"','"+b1_1+"_"+b2_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','2','"+hr1_1+"','"+hr1_3+"','0','0')";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}


					//pfeil nach rechts (4 gross)
						if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hr1_1+"_"+hr1_2+"_"+hr1_3+"_"+hr1_4)) {
									var	classValue = IdSearch_Class(b1_1+"_"+b2_1); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1);

									var addValue = b1_1+"_"+b2_1+"__"+b1_1+"_"+hr1_1+"_"+hr1_2+"_"+b2_1+"_"+hr1_3+"_"+hr1_4;
									var clickValue = "update_con('"+b1_1+"_"+b2_1+"','"+b1_1+"_"+hr1_1+"_"+hr1_2+"_"+b2_1+"_"+hr1_3+"_"+hr1_4+"','"+hr1_1+"_"+hr1_2+"_"+hr1_3+"_"+hr1_4+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','4','"+hr1_1+"','"+hr1_2+"','"+hr1_3+"','"+hr1_4+"')";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}

					//pfeil nach rechts 2 (4 gross)
						if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hr1_1+"_"+hr1_2+"_"+hr1_3+"_"+hr1_4)) {
									var	classValue = IdSearch_Class(hr1_1+"_"+hr1_2+"_"+hr1_3+"_"+hr1_4); var absolute = IdSearch_Absolute(hr1_1+"_"+hr1_2+"_"+hr1_3+"_"+hr1_4);

									var addValue = hr1_1+"_"+hr1_2+"_"+hr1_3+"_"+hr1_4+"__"+b1_1+"_"+hr1_1+"_"+hr1_2+"_"+b2_1+"_"+hr1_3+"_"+hr1_4;
									var clickValue = "update_con('"+hr1_1+"_"+hr1_2+"_"+hr1_3+"_"+hr1_4+"','"+b1_1+"_"+hr1_1+"_"+hr1_2+"_"+b2_1+"_"+hr1_3+"_"+hr1_4+"','"+b1_1+"_"+b2_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','4','"+hr1_1+"','"+hr1_2+"','"+hr1_3+"','"+hr1_4+"')";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}


					//pfeil nach links
						if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hl1_2+"_"+hl1_4)) {
									var	classValue = IdSearch_Class(b1_1+"_"+b2_1); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1);

									var addValue = b1_1+"_"+b2_1+"__"+hl1_2+"_"+b1_1+"_"+hl1_4+"_"+b2_1;
									var clickValue = "update_con('"+b1_1+"_"+b2_1+"','"+hl1_2+"_"+b1_1+"_"+hl1_4+"_"+b2_1+"','"+hl1_2+"_"+hl1_4+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','2','"+hl1_2+"','"+hl1_4+"','0','0')";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}

					//pfeil nach links 2
						if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hl1_2+"_"+hl1_4)) {
									var	classValue = IdSearch_Class(hl1_2+"_"+hl1_4); var absolute = IdSearch_Absolute(hl1_2+"_"+hl1_4);

									var addValue = hl1_2+"_"+hl1_4+"__"+hl1_2+"_"+b1_1+"_"+hl1_4+"_"+b2_1;
									var clickValue = "update_con('"+hl1_2+"_"+hl1_4+"','"+hl1_2+"_"+b1_1+"_"+hl1_4+"_"+b2_1+"','"+b1_1+"_"+b2_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','2','"+hl1_2+"','"+hl1_4+"','0','0')";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}


					//pfeil nach links (4 gross)
						if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hl1_1+"_"+hl1_2+"_"+hl1_3+"_"+hl1_4)) {
									var	classValue = IdSearch_Class(b1_1+"_"+b2_1); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1);

									var addValue = b1_1+"_"+b2_1+"__"+hl1_1+"_"+hl1_2+"_"+b1_1+"_"+hl1_3+"_"+hl1_4+"_"+b2_1;
									var clickValue = "update_con('"+b1_1+"_"+b2_1+"','"+hl1_1+"_"+hl1_2+"_"+b1_1+"_"+hl1_3+"_"+hl1_4+"_"+b2_1+"','"+hl1_1+"_"+hl1_2+"_"+hl1_3+"_"+hl1_4+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','4','"+hl1_1+"','"+hl1_2+"','"+hl1_3+"','"+hl1_4+"')";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}

					//pfeil nach links 2 (4 gross)
						if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hl1_1+"_"+hl1_2+"_"+hl1_3+"_"+hl1_4)) {
									var	classValue = IdSearch_Class(hl1_1+"_"+hl1_2+"_"+hl1_3+"_"+hl1_4); var absolute = IdSearch_Absolute(hl1_1+"_"+hl1_2+"_"+hl1_3+"_"+hl1_4);

									var addValue = hl1_1+"_"+hl1_2+"_"+hl1_3+"_"+hl1_4+"__"+hl1_1+"_"+hl1_2+"_"+b1_1+"_"+hl1_3+"_"+hl1_4+"_"+b2_1;
									var clickValue = "update_con('"+hl1_1+"_"+hl1_2+"_"+hl1_3+"_"+hl1_4+"','"+hl1_1+"_"+hl1_2+"_"+b1_1+"_"+hl1_3+"_"+hl1_4+"_"+b2_1+"','"+b1_1+"_"+b2_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','4','"+hl1_1+"','"+hl1_2+"','"+hl1_3+"','"+hl1_4+"')";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}

						} //Ende gross2 = 1






						if(gross2 == '2'){

							//pos1
								var b1_1 = l1_1;
								var b2_1 = l2_1;
								var b2_2 = l2_2;

									if(b1_1 != 'a' || b1_1 != 'b' || b1_1 != 'c'){var vu1_1 = String.fromCharCode(b1_1.charCodeAt(0)-3);}
									if(b2_1 != 'a' || b2_1 != 'b' || b2_1 != 'c'){var vu2_1 = String.fromCharCode(b2_1.charCodeAt(0)-3);}
									if(b2_2 != 'a' || b2_2 != 'b' || b2_2 != 'c'){var vu2_2 = String.fromCharCode(b2_2.charCodeAt(0)-3);}
									if(b1_1 != 'v' || b1_1 != 'w' || b1_1 != 'x'){var vd1_1 = String.fromCharCode(b1_1.charCodeAt(0)+3);}
									if(b2_1 != 'v' || b2_1 != 'w' || b2_1 != 'x'){var vd2_1 = String.fromCharCode(b2_1.charCodeAt(0)+3);}
									if(b2_2 != 'v' || b2_2 != 'w' || b2_2 != 'x'){var vd2_2 = String.fromCharCode(b2_2.charCodeAt(0)+3);}


									//cut Pfeiele
									if (document.getElementById(b2_1+"_"+b2_2+"_"+b1_1)) {

												var	classValue = IdSearch_Class(b2_1+"_"+b2_2+"_"+b1_1); var absolute = IdSearch_Absolute(b2_1+"_"+b2_2+"_"+b1_1);
												var addValue = b2_1+"_"+b2_2+"_"+b1_1+"__"+b2_2;
												var clickValue = "[update_cut('"+b2_1+"_"+b2_2+"_"+b1_1+"','"+b2_2+"_"+b1_1+"','leer','"+b2_1+"','"+classValue+"','"+absolute+"','3','"+b2_1+"','"+b2_2+"','"+b1_1+"','0','0','0')]";
												var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}

									if (document.getElementById(b2_1+"_"+b2_2+"_"+b1_1)) {
												var	classValue = IdSearch_Class(b2_1+"_"+b2_2+"_"+b1_1); var absolute = IdSearch_Absolute(b2_1+"_"+b2_2+"_"+b1_1);

												var addValue = b2_1+"_"+b2_2+"_"+b1_1+"__"+b2_1;
												var clickValue = "[update_cut('"+b2_1+"_"+b2_2+"_"+b1_1+"','"+b2_1+"_"+b2_2+"','leer','"+b1_1+"','"+classValue+"','"+absolute+"','3','"+b2_1+"','"+b2_2+"','"+b1_1+"','0','0','0')]";
												var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}

							//fals gross2 und gross1 umgekehrt ist:
									//cut Pfeiele
									if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2)) {
												var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2);

												var addValue = b1_1+"_"+b2_1+"_"+b2_2+"__"+b2_1;
												var clickValue = "[update_cut('"+b2_1+"_"+b2_2+"_"+b1_1+"','"+b2_1+"_"+b2_2+"','leer','"+b1_1+"','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b2_1+"','"+b2_2+"','0','0','0')]";
												var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}

									if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2)) {
												var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2);

												var addValue = b1_1+"_"+b2_1+"_"+b2_2+"__"+b1_1;
												var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"','"+b1_1+"_"+b2_1+"','leer','"+b2_2+"','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b2_1+"','"+b2_2+"','0','0','0')]";
												var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}


									//pfeil nach oben
										if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2) && document.getElementById(vu1_1+"_"+vu2_1+"_"+vu2_2)) {
													var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2);

													var addValue = b1_1+"_"+b2_1+"_"+b2_2+"__"+vu1_1+"_"+vu2_1+"_"+vu2_2+"_"+b1_1+"_"+b2_1+"_"+b2_2;
													var clickValue = "update_con('"+b1_1+"_"+b2_1+"_"+b2_2+"','"+vu1_1+"_"+vu2_1+"_"+vu2_2+"_"+b1_1+"_"+b2_1+"_"+b2_2+"','"+vu1_1+"_"+vu2_1+"_"+vu2_2+"','hidden','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b2_1+"','"+b2_2+"','0','3','"+vu1_1+"','"+vu2_1+"','"+vu2_2+"','0')";
													var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}

									//pfeil nach oben 2
										if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2) && document.getElementById(vu1_1+"_"+vu2_1+"_"+vu2_2)) {
													var	classValue = IdSearch_Class(vu1_1+"_"+vu2_1+"_"+vu2_2); var absolute = IdSearch_Absolute(vu1_1+"_"+vu2_1+"_"+vu2_2);

													var addValue = vu1_1+"_"+vu2_1+"_"+vu2_2+"__"+vu1_1+"_"+vu2_1+"_"+vu2_2+"_"+b1_1+"_"+b2_1+"_"+b2_2;
													var clickValue = "update_con('"+vu1_1+"_"+vu2_1+"_"+vu2_2+"','"+vu1_1+"_"+vu2_1+"_"+vu2_2+"_"+b1_1+"_"+b2_1+"_"+b2_2+"','"+b1_1+"_"+b2_1+"_"+b2_2+"','hidden','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b2_1+"','"+b2_2+"','0','3','"+vu1_1+"','"+vu2_1+"','"+vu2_2+"','0')";
													var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}


									//pfeil nach unten
										if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2) && document.getElementById(vd1_1+"_"+vd2_1+"_"+vd2_2)) {
													var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2);

													var addValue = b1_1+"_"+b2_1+"_"+b2_2+"__"+b1_1+"_"+b2_1+"_"+b2_2+"_"+vd1_1+"_"+vd2_1+"_"+vd2_2;
													var clickValue = "update_con('"+b1_1+"_"+b2_1+"_"+b2_2+"','"+b1_1+"_"+b2_1+"_"+b2_2+"_"+vd1_1+"_"+vd2_1+"_"+vd2_2+"','"+vd1_1+"_"+vd2_1+"_"+vd2_2+"','hidden','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b2_1+"','"+b2_2+"','0','3','"+vd1_1+"','"+vd2_1+"','"+vd2_2+"','0')";
													var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}

									//pfeil nach unten 2
										if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2) && document.getElementById(vd1_1+"_"+vd2_1+"_"+vd2_2)) {
													var	classValue = IdSearch_Class(vd1_1+"_"+vd2_1+"_"+vd2_2); var absolute = IdSearch_Absolute(vd1_1+"_"+vd2_1+"_"+vd2_2);

													var addValue = vd1_1+"_"+vd2_1+"_"+vd2_2+"__"+b1_1+"_"+b2_1+"_"+b2_2+"_"+vd1_1+"_"+vd2_1+"_"+vd2_2;
													var clickValue = "update_con('"+vd1_1+"_"+vd2_1+"_"+vd2_2+"','"+b1_1+"_"+b2_1+"_"+b2_2+"_"+vd1_1+"_"+vd2_1+"_"+vd2_2+"','"+b1_1+"_"+b2_1+"_"+b2_2+"','hidden','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b2_1+"','"+b2_2+"','0','3','"+vd1_1+"','"+vd2_1+"','"+vd2_2+"','0')";
													var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}

								//pos2
									var b1_1 = l2_1;
									var b2_1 = l2_2;
									var b2_2 = l1_1;

										if(b1_1 != 'a' || b1_1 != 'b' || b1_1 != 'c'){var vu1_1 = String.fromCharCode(b1_1.charCodeAt(0)-3);}
										if(b2_1 != 'a' || b2_1 != 'b' || b2_1 != 'c'){var vu2_1 = String.fromCharCode(b2_1.charCodeAt(0)-3);}
										if(b2_2 != 'a' || b2_2 != 'b' || b2_2 != 'c'){var vu2_2 = String.fromCharCode(b2_2.charCodeAt(0)-3);}
										if(b1_1 != 'v' || b1_1 != 'w' || b1_1 != 'x'){var vd1_1 = String.fromCharCode(b1_1.charCodeAt(0)+3);}
										if(b2_1 != 'v' || b2_1 != 'w' || b2_1 != 'x'){var vd2_1 = String.fromCharCode(b2_1.charCodeAt(0)+3);}
										if(b2_2 != 'v' || b2_2 != 'w' || b2_2 != 'x'){var vd2_2 = String.fromCharCode(b2_2.charCodeAt(0)+3);}


										//pfeil nach oben
											if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2) && document.getElementById(vu1_1+"_"+vu2_1+"_"+vu2_2)) {
														var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2);

														var addValue = b1_1+"_"+b2_1+"_"+b2_2+"__"+vu1_1+"_"+vu2_1+"_"+vu2_2+"_"+b1_1+"_"+b2_1+"_"+b2_2;
														var clickValue = "update_con('"+b1_1+"_"+b2_1+"_"+b2_2+"','"+vu1_1+"_"+vu2_1+"_"+vu2_2+"_"+b1_1+"_"+b2_1+"_"+b2_2+"','"+vu1_1+"_"+vu2_1+"_"+vu2_2+"','hidden','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b2_1+"','"+b2_2+"','0','3','"+vu1_1+"','"+vu2_1+"','"+vu2_2+"','0')";
														var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
											}

										//pfeil nach oben 2
											if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2) && document.getElementById(vu1_1+"_"+vu2_1+"_"+vu2_2)) {
														var	classValue = IdSearch_Class(vu1_1+"_"+vu2_1+"_"+vu2_2); var absolute = IdSearch_Absolute(vu1_1+"_"+vu2_1+"_"+vu2_2);

														var addValue = vu1_1+"_"+vu2_1+"_"+vu2_2+"__"+vu1_1+"_"+vu2_1+"_"+vu2_2+"_"+b1_1+"_"+b2_1+"_"+b2_2;
														var clickValue = "update_con('"+vu1_1+"_"+vu2_1+"_"+vu2_2+"','"+vu1_1+"_"+vu2_1+"_"+vu2_2+"_"+b1_1+"_"+b2_1+"_"+b2_2+"','"+b1_1+"_"+b2_1+"_"+b2_2+"','hidden','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b2_1+"','"+b2_2+"','0','3','"+vu1_1+"','"+vu2_1+"','"+vu2_2+"','0')";
														var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
											}


										//pfeil nach unten
											if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2) && document.getElementById(vd1_1+"_"+vd2_1+"_"+vd2_2)) {
														var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2);

														var addValue = b1_1+"_"+b2_1+"_"+b2_2+"__"+b1_1+"_"+b2_1+"_"+b2_2+"_"+vd1_1+"_"+vd2_1+"_"+vd2_2;
														var clickValue = "update_con('"+b1_1+"_"+b2_1+"_"+b2_2+"','"+b1_1+"_"+b2_1+"_"+b2_2+"_"+vd1_1+"_"+vd2_1+"_"+vd2_2+"','"+vd1_1+"_"+vd2_1+"_"+vd2_2+"','hidden','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b2_1+"','"+b2_2+"','0','3','"+vd1_1+"','"+vd2_1+"','"+vd2_2+"','0')";
														var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
											}

										//pfeil nach unten 2
											if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2) && document.getElementById(vd1_1+"_"+vd2_1+"_"+vd2_2)) {
														var	classValue = IdSearch_Class(vd1_1+"_"+vd2_1+"_"+vd2_2); var absolute = IdSearch_Absolute(vd1_1+"_"+vd2_1+"_"+vd2_2);

														var addValue = vd1_1+"_"+vd2_1+"_"+vd2_2+"__"+b1_1+"_"+b2_1+"_"+b2_2+"_"+vd1_1+"_"+vd2_1+"_"+vd2_2;
														var clickValue = "update_con('"+vd1_1+"_"+vd2_1+"_"+vd2_2+"','"+b1_1+"_"+b2_1+"_"+b2_2+"_"+vd1_1+"_"+vd2_1+"_"+vd2_2+"','"+b1_1+"_"+b2_1+"_"+b2_2+"','hidden','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b2_1+"','"+b2_2+"','0','3','"+vd1_1+"','"+vd2_1+"','"+vd2_2+"','0')";
														var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
											}


						} //Ende gross2 = 2

		} //Ende gross1 = 1


		if(gross1 == '2'){

				if(gross2 == '1'){
					//pos1
					var b1_1 = l2_1;
					var b2_1 = l1_1;
					var b2_2 = l1_2;

						if(b1_1 != 'a' || b1_1 != 'b' || b1_1 != 'c'){var vu1_1 = String.fromCharCode(b1_1.charCodeAt(0)-3);}
						if(b2_1 != 'a' || b2_1 != 'b' || b2_1 != 'c'){var vu2_1 = String.fromCharCode(b2_1.charCodeAt(0)-3);}
						if(b2_2 != 'a' || b2_2 != 'b' || b2_2 != 'c'){var vu2_2 = String.fromCharCode(b2_2.charCodeAt(0)-3);}
						if(b1_1 != 'v' || b1_1 != 'w' || b1_1 != 'x'){var vd1_1 = String.fromCharCode(b1_1.charCodeAt(0)+3);}
						if(b2_1 != 'v' || b2_1 != 'w' || b2_1 != 'x'){var vd2_1 = String.fromCharCode(b2_1.charCodeAt(0)+3);}
						if(b2_2 != 'v' || b2_2 != 'w' || b2_2 != 'x'){var vd2_2 = String.fromCharCode(b2_2.charCodeAt(0)+3);}


						//cut Pfeiele
						if (document.getElementById(b2_1+"_"+b2_2+"_"+b1_1)) {
									var	classValue = IdSearch_Class(b2_1+"_"+b2_2+"_"+b1_1); var absolute = IdSearch_Absolute(b2_1+"_"+b2_2+"_"+b1_1);

									var addValue = b2_1+"_"+b2_2+"_"+b1_1+"__"+b2_2;
									var clickValue = "[update_cut('"+b2_1+"_"+b2_2+"_"+b1_1+"','"+b2_2+"_"+b1_1+"','leer','"+b2_1+"','"+classValue+"','"+absolute+"','3','"+b2_1+"','"+b2_2+"','"+b1_1+"','0','0','0')]";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}

						if (document.getElementById(b2_1+"_"+b2_2+"_"+b1_1)) {
									var	classValue = IdSearch_Class(b2_1+"_"+b2_2+"_"+b1_1); var absolute = IdSearch_Absolute(b2_1+"_"+b2_2+"_"+b1_1);

									var addValue = b2_1+"_"+b2_2+"_"+b1_1+"__"+b2_1;
									var clickValue = "[update_cut('"+b2_1+"_"+b2_2+"_"+b1_1+"','"+b2_1+"_"+b2_2+"','leer','"+b1_1+"','"+classValue+"','"+absolute+"','3','"+b2_1+"','"+b2_2+"','"+b1_1+"','0','0','0')]";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}

				//fals gross2 und gross1 umgekehrt ist:
					//cut Pfeiele
						if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2)) {
									var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2);

									var addValue = b1_1+"_"+b2_1+"_"+b2_2+"__"+b2_1;
									var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"','"+b2_1+"_"+b2_2+"','leer','"+b1_1+"','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b2_1+"','"+b2_2+"','0','0','0')]";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}

						if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2)) {
									var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2);

									var addValue = b1_1+"_"+b2_1+"_"+b2_2+"__"+b1_1;
									var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"','"+b1_1+"_"+b2_1+"','leer','"+b2_2+"','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b2_1+"','"+b2_2+"','0','0','0')]";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}




						//pfeil nach oben
							if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2) && document.getElementById(vu1_1+"_"+vu2_1+"_"+vu2_2)) {
										var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2);

										var addValue = b1_1+"_"+b2_1+"_"+b2_2+"__"+vu1_1+"_"+vu2_1+"_"+vu2_2+"_"+b1_1+"_"+b2_1+"_"+b2_2;
										var clickValue = "update_con('"+b1_1+"_"+b2_1+"_"+b2_2+"','"+vu1_1+"_"+vu2_1+"_"+vu2_2+"_"+b1_1+"_"+b2_1+"_"+b2_2+"','"+vu1_1+"_"+vu2_1+"_"+vu2_2+"','hidden','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b2_1+"','"+b2_2+"','0','3','"+vu1_1+"','"+vu2_1+"','"+vu2_2+"','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

						//pfeil nach oben 2
							if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2) && document.getElementById(vu1_1+"_"+vu2_1+"_"+vu2_2)) {
										var	classValue = IdSearch_Class(vu1_1+"_"+vu2_1+"_"+vu2_2); var absolute = IdSearch_Absolute(vu1_1+"_"+vu2_1+"_"+vu2_2);

										var addValue = vu1_1+"_"+vu2_1+"_"+vu2_2+"__"+vu1_1+"_"+vu2_1+"_"+vu2_2+"_"+b1_1+"_"+b2_1+"_"+b2_2;
										var clickValue = "update_con('"+vu1_1+"_"+vu2_1+"_"+vu2_2+"','"+vu1_1+"_"+vu2_1+"_"+vu2_2+"_"+b1_1+"_"+b2_1+"_"+b2_2+"','"+b1_1+"_"+b2_1+"_"+b2_2+"','hidden','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b2_1+"','"+b2_2+"','0','3','"+vu1_1+"','"+vu2_1+"','"+vu2_2+"','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}


						//pfeil nach unten
							if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2) && document.getElementById(vd1_1+"_"+vd2_1+"_"+vd2_2)) {
										var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2);

										var addValue = b1_1+"_"+b2_1+"_"+b2_2+"__"+b1_1+"_"+b2_1+"_"+b2_2+"_"+vd1_1+"_"+vd2_1+"_"+vd2_2;
										var clickValue = "update_con('"+b1_1+"_"+b2_1+"_"+b2_2+"','"+b1_1+"_"+b2_1+"_"+b2_2+"_"+vd1_1+"_"+vd2_1+"_"+vd2_2+"','"+vd1_1+"_"+vd2_1+"_"+vd2_2+"','hidden','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b2_1+"','"+b2_2+"','0','3','"+vd1_1+"','"+vd2_1+"','"+vd2_2+"','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

						//pfeil nach unten 2
							if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2) && document.getElementById(vd1_1+"_"+vd2_1+"_"+vd2_2)) {
										var	classValue = IdSearch_Class(vd1_1+"_"+vd2_1+"_"+vd2_2); var absolute = IdSearch_Absolute(vd1_1+"_"+vd2_1+"_"+vd2_2);

										var addValue = vd1_1+"_"+vd2_1+"_"+vd2_2+"__"+b1_1+"_"+b2_1+"_"+b2_2+"_"+vd1_1+"_"+vd2_1+"_"+vd2_2;
										var clickValue = "update_con('"+vd1_1+"_"+vd2_1+"_"+vd2_2+"','"+b1_1+"_"+b2_1+"_"+b2_2+"_"+vd1_1+"_"+vd2_1+"_"+vd2_2+"','"+b1_1+"_"+b2_1+"_"+b2_2+"','hidden','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b2_1+"','"+b2_2+"','0','3','"+vd1_1+"','"+vd2_1+"','"+vd2_2+"','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

					//pos2
					var b1_1 = l1_1;
					var b2_1 = l1_2;
					var b2_2 = l2_1;

						if(b1_1 != 'a' || b1_1 != 'b' || b1_1 != 'c'){var vu1_1 = String.fromCharCode(b1_1.charCodeAt(0)-3);}
						if(b2_1 != 'a' || b2_1 != 'b' || b2_1 != 'c'){var vu2_1 = String.fromCharCode(b2_1.charCodeAt(0)-3);}
						if(b2_2 != 'a' || b2_2 != 'b' || b2_2 != 'c'){var vu2_2 = String.fromCharCode(b2_2.charCodeAt(0)-3);}
						if(b1_1 != 'v' || b1_1 != 'w' || b1_1 != 'x'){var vd1_1 = String.fromCharCode(b1_1.charCodeAt(0)+3);}
						if(b2_1 != 'v' || b2_1 != 'w' || b2_1 != 'x'){var vd2_1 = String.fromCharCode(b2_1.charCodeAt(0)+3);}
						if(b2_2 != 'v' || b2_2 != 'w' || b2_2 != 'x'){var vd2_2 = String.fromCharCode(b2_2.charCodeAt(0)+3);}


						//pfeil nach oben
							if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2) && document.getElementById(vu1_1+"_"+vu2_1+"_"+vu2_2)) {
										var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2);

										var addValue = b1_1+"_"+b2_1+"_"+b2_2+"__"+vu1_1+"_"+vu2_1+"_"+vu2_2+"_"+b1_1+"_"+b2_1+"_"+b2_2;
										var clickValue = "update_con('"+b1_1+"_"+b2_1+"_"+b2_2+"','"+vu1_1+"_"+vu2_1+"_"+vu2_2+"_"+b1_1+"_"+b2_1+"_"+b2_2+"','"+vu1_1+"_"+vu2_1+"_"+vu2_2+"','hidden','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b2_1+"','"+b2_2+"','0','3','"+vu1_1+"','"+vu2_1+"','"+vu2_2+"','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

						//pfeil nach oben 2
							if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2) && document.getElementById(vu1_1+"_"+vu2_1+"_"+vu2_2)) {
										var	classValue = IdSearch_Class(vu1_1+"_"+vu2_1+"_"+vu2_2); var absolute = IdSearch_Absolute(vu1_1+"_"+vu2_1+"_"+vu2_2);

										var addValue = vu1_1+"_"+vu2_1+"_"+vu2_2+"__"+vu1_1+"_"+vu2_1+"_"+vu2_2+"_"+b1_1+"_"+b2_1+"_"+b2_2;
										var clickValue = "update_con('"+vu1_1+"_"+vu2_1+"_"+vu2_2+"','"+vu1_1+"_"+vu2_1+"_"+vu2_2+"_"+b1_1+"_"+b2_1+"_"+b2_2+"','"+b1_1+"_"+b2_1+"_"+b2_2+"','hidden','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b2_1+"','"+b2_2+"','0','3','"+vu1_1+"','"+vu2_1+"','"+vu2_2+"','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}


						//pfeil nach unten
							if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2) && document.getElementById(vd1_1+"_"+vd2_1+"_"+vd2_2)) {
										var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2);

										var addValue = b1_1+"_"+b2_1+"_"+b2_2+"__"+b1_1+"_"+b2_1+"_"+b2_2+"_"+vd1_1+"_"+vd2_1+"_"+vd2_2;
										var clickValue = "update_con('"+b1_1+"_"+b2_1+"_"+b2_2+"','"+b1_1+"_"+b2_1+"_"+b2_2+"_"+vd1_1+"_"+vd2_1+"_"+vd2_2+"','"+vd1_1+"_"+vd2_1+"_"+vd2_2+"','hidden','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b2_1+"','"+b2_2+"','0','3','"+vd1_1+"','"+vd2_1+"','"+vd2_2+"','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

						//pfeil nach unten 2
							if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2) && document.getElementById(vd1_1+"_"+vd2_1+"_"+vd2_2)) {
										var	classValue = IdSearch_Class(vd1_1+"_"+vd2_1+"_"+vd2_2); var absolute = IdSearch_Absolute(vd1_1+"_"+vd2_1+"_"+vd2_2);

										var addValue = vd1_1+"_"+vd2_1+"_"+vd2_2+"__"+b1_1+"_"+b2_1+"_"+b2_2+"_"+vd1_1+"_"+vd2_1+"_"+vd2_2;
										var clickValue = "update_con('"+vd1_1+"_"+vd2_1+"_"+vd2_2+"','"+b1_1+"_"+b2_1+"_"+b2_2+"_"+vd1_1+"_"+vd2_1+"_"+vd2_2+"','"+b1_1+"_"+b2_1+"_"+b2_2+"','hidden','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b2_1+"','"+b2_2+"','0','3','"+vd1_1+"','"+vd2_1+"','"+vd2_2+"','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

				} //Ende gross2 = 1

				if(gross2 == '2'){
					//pos1
		//wenn der pfeil nach oben oder unten gedrückt wird
			var b1_1 = l1_1; // a
			var b2_1 = l1_2; // b
			var b1_2 = l2_1; // d
			var b2_2 = l2_2; // e

				if(b1_1 != 'a')								{var hl1_2 = String.fromCharCode(b1_1.charCodeAt(0)-1);}
				if(b1_2 != 'a')								{var hl1_4 = String.fromCharCode(b1_2.charCodeAt(0)-1);}
				if(b2_1 != 'x')								{var hr1_1 = String.fromCharCode(b2_1.charCodeAt(0)+1);}
				if(b2_2 != 'x')								{var hr1_3 = String.fromCharCode(b2_2.charCodeAt(0)+1);}


		//cut pfeile
				if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2)) {
							var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);
							var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+b1_1+"_"+b2_1;
							var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+b1_1+"_"+b2_1+"','leer','"+b1_2+"_"+b2_2+"','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','0','0')]";
							var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
				}

				if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2)) {
							var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);
							var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+b1_2+"_"+b2_2;
							var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+b1_2+"_"+b2_2+"','leer','"+b1_1+"_"+b2_1+"','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','0','0')]";
							var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
				}

				if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2)) {
							var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);
							var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+b1_1+"_"+b1_2;
							var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+b1_1+"_"+b1_2+"','leer','"+b2_1+"_"+b2_2+"','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','0','0')]";
							var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
				}

				if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2)) {
							var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);
							var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+b2_1+"_"+b2_2;
							var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+b2_1+"_"+b2_2+"','leer','"+b1_1+"_"+b1_2+"','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','0','0')]";
							var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
				}



		//con pfeile
			//pfeil nach rechts
				if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2) && document.getElementById(hr1_1+"_"+hr1_3)) {
							var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);

							var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+b1_1+"_"+b2_1+"_"+hr1_1+"_"+b1_2+"_"+b2_2+"_"+hr1_3;
							var clickValue = "update_con('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+b1_1+"_"+b2_1+"_"+hr1_1+"_"+b1_2+"_"+b2_2+"_"+hr1_3+"','"+hr1_1+"_"+hr1_3+"','hidden','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','2','"+hr1_1+"','"+hr1_3+"','0','0')";
							var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
				}

				//pfeil nach rechts 2
					if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2) && document.getElementById(hr1_1+"_"+hr1_3)) {
								var	classValue = IdSearch_Class(hr1_1+"_"+hr1_3); var absolute = IdSearch_Absolute(hr1_1+"_"+hr1_3);

								var addValue = hr1_1+"_"+hr1_3+"__"+b1_1+"_"+b2_1+"_"+hr1_1+"_"+b1_2+"_"+b2_2+"_"+hr1_3;
								var clickValue = "update_con('"+hr1_1+"_"+hr1_3+"','"+b1_1+"_"+b2_1+"_"+hr1_1+"_"+b1_2+"_"+b2_2+"_"+hr1_3+"','"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','hidden','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','2','"+hr1_1+"','"+hr1_3+"','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}


				//pfeil nach links
					if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2) && document.getElementById(hl1_2+"_"+hl1_4)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);

								var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+hl1_2+"_"+b1_1+"_"+b2_1+"_"+hl1_4+"_"+b1_2+"_"+b2_2;
								var clickValue = "update_con('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+hl1_2+"_"+b1_1+"_"+b2_1+"_"+hl1_4+"_"+b1_2+"_"+b2_2+"','"+hl1_2+"_"+hl1_4+"','hidden','"+classValue+"','"+absolute+"','2','"+hl1_2+"','"+hl1_4+"','0','0','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

				//pfeil nach links 2
					if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2) && document.getElementById(hl1_2+"_"+hl1_4)) {
								var	classValue = IdSearch_Class(hl1_2+"_"+hl1_4); var absolute = IdSearch_Absolute(hl1_2+"_"+hl1_4);

								var addValue = hl1_2+"_"+hl1_4+"__"+hl1_2+"_"+b1_1+"_"+b2_1+"_"+hl1_4+"_"+b1_2+"_"+b2_2;
								var clickValue = "update_con('"+hl1_2+"_"+hl1_4+"','"+hl1_2+"_"+b1_1+"_"+b2_1+"_"+hl1_4+"_"+b1_2+"_"+b2_2+"','"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','hidden','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','2','"+hl1_2+"','"+hl1_4+"','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

			//wenn der pfeil nach rechts oder links gedrückt wird
					var b1_1 = l1_1; // a
					var b1_2 = l1_2; // d
					var b2_1 = l2_1; // b
					var b2_2 = l2_2; // e

						if(b1_1 != 'a')								{var hl1_2 = String.fromCharCode(b1_1.charCodeAt(0)-1);}
						if(b1_2 != 'a')								{var hl1_4 = String.fromCharCode(b1_2.charCodeAt(0)-1);}
						if(b2_1 != 'x')								{var hr1_1 = String.fromCharCode(b2_1.charCodeAt(0)+1);}
						if(b2_2 != 'x')								{var hr1_3 = String.fromCharCode(b2_2.charCodeAt(0)+1);}


				//cut pfeile
						if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2)) {
									var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);
									var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+b1_1+"_"+b2_1;
									var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+b1_1+"_"+b2_1+"','leer','"+b1_2+"_"+b2_2+"','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','0','0')]";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}

						if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2)) {
									var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);
									var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+b1_2+"_"+b2_2;
									var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+b1_2+"_"+b2_2+"','leer','"+b1_1+"_"+b2_1+"','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','0','0')]";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}

						if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2)) {
									var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);
									var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+b1_1+"_"+b1_2;
									var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+b1_1+"_"+b1_2+"','leer','"+b2_1+"_"+b2_2+"','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','0','0')]";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}

						if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2)) {
									var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);
									var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+b2_1+"_"+b2_2;
									var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+b2_1+"_"+b2_2+"','leer','"+b1_1+"_"+b1_2+"','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','0','0')]";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}


				//con pfeile
					//pfeil nach rechts
						if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2) && document.getElementById(hr1_1+"_"+hr1_3)) {
									var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);

									var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+b1_1+"_"+b2_1+"_"+hr1_1+"_"+b1_2+"_"+b2_2+"_"+hr1_3;
									var clickValue = "update_con('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+b1_1+"_"+b2_1+"_"+hr1_1+"_"+b1_2+"_"+b2_2+"_"+hr1_3+"','"+hr1_1+"_"+hr1_3+"','hidden','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','2','"+hr1_1+"','"+hr1_3+"','0','0')";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}

						//pfeil nach rechts 2
							if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2) && document.getElementById(hr1_1+"_"+hr1_3)) {
										var	classValue = IdSearch_Class(hr1_1+"_"+hr1_3); var absolute = IdSearch_Absolute(hr1_1+"_"+hr1_3);

										var addValue = hr1_1+"_"+hr1_3+"__"+b1_1+"_"+b2_1+"_"+hr1_1+"_"+b1_2+"_"+b2_2+"_"+hr1_3;
										var clickValue = "update_con('"+hr1_1+"_"+hr1_3+"','"+b1_1+"_"+b2_1+"_"+hr1_1+"_"+b1_2+"_"+b2_2+"_"+hr1_3+"','"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','hidden','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','2','"+hr1_1+"','"+hr1_3+"','0','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}


						//pfeil nach links
							if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2) && document.getElementById(hl1_2+"_"+hl1_4)) {
										var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);

										var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+hl1_2+"_"+b1_1+"_"+b2_1+"_"+hl1_4+"_"+b1_2+"_"+b2_2;
										var clickValue = "update_con('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+hl1_2+"_"+b1_1+"_"+b2_1+"_"+hl1_4+"_"+b1_2+"_"+b2_2+"','"+hl1_2+"_"+hl1_4+"','hidden','"+classValue+"','"+absolute+"','2','"+hl1_2+"','"+hl1_4+"','0','0','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

						//pfeil nach links
							if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2) && document.getElementById(hl1_2+"_"+hl1_4)) {
										var	classValue = IdSearch_Class(hl1_2+"_"+hl1_4); var absolute = IdSearch_Absolute(hl1_2+"_"+hl1_4);

										var addValue = hl1_2+"_"+hl1_4+"__"+hl1_2+"_"+b1_1+"_"+b2_1+"_"+hl1_4+"_"+b1_2+"_"+b2_2;
										var clickValue = "update_con('"+hl1_2+"_"+hl1_4+"','"+hl1_2+"_"+b1_1+"_"+b2_1+"_"+hl1_4+"_"+b1_2+"_"+b2_2+"','"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','hidden','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','2','"+hl1_2+"','"+hl1_4+"','0','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}
//=====================================
//=====================================
//umgekehrt
//=====================================
//=====================================

							//wenn der pfeil nach rechts oder links gedrückt wird
									var b2_1 = l1_1; // a
									var b2_2 = l1_2; // d
									var b1_1 = l2_1; // b
									var b1_2 = l2_2; // e

										if(b1_1 != 'a')								{var hl1_2 = String.fromCharCode(b1_1.charCodeAt(0)-1);}
										if(b1_2 != 'a')								{var hl1_4 = String.fromCharCode(b1_2.charCodeAt(0)-1);}
										if(b2_1 != 'x')								{var hr1_1 = String.fromCharCode(b2_1.charCodeAt(0)+1);}
										if(b2_2 != 'x')								{var hr1_3 = String.fromCharCode(b2_2.charCodeAt(0)+1);}


								//cut pfeile
										if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2)) {
													var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);
													var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+b1_1+"_"+b2_1;
													var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+b1_1+"_"+b2_1+"','leer','"+b1_2+"_"+b2_2+"','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','0','0')]";
													var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}

										if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2)) {
													var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);
													var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+b1_2+"_"+b2_2;
													var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+b1_2+"_"+b2_2+"','leer','"+b1_1+"_"+b2_1+"','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','0','0')]";
													var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}

										if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2)) {
													var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);
													var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+b1_1+"_"+b1_2;
													var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+b1_1+"_"+b1_2+"','leer','"+b2_1+"_"+b2_2+"','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','0','0')]";
													var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}

										if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2)) {
													var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);
													var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+b2_1+"_"+b2_2;
													var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+b2_1+"_"+b2_2+"','leer','"+b1_1+"_"+b1_2+"','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','0','0')]";
													var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}



								//con pfeile
									//pfeil nach rechts
										if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2) && document.getElementById(hr1_1+"_"+hr1_3)) {
													var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);

													var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+b1_1+"_"+b2_1+"_"+hr1_1+"_"+b1_2+"_"+b2_2+"_"+hr1_3;
													var clickValue = "update_con('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+b1_1+"_"+b2_1+"_"+hr1_1+"_"+b1_2+"_"+b2_2+"_"+hr1_3+"','"+hr1_1+"_"+hr1_3+"','hidden','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','2','"+hr1_1+"','"+hr1_3+"','0','0')";
													var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}

										//pfeil nach rechts 2
											if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2) && document.getElementById(hr1_1+"_"+hr1_3)) {
														var	classValue = IdSearch_Class(hr1_1+"_"+hr1_3); var absolute = IdSearch_Absolute(hr1_1+"_"+hr1_3);

														var addValue = hr1_1+"_"+hr1_3+"__"+b1_1+"_"+b2_1+"_"+hr1_1+"_"+b1_2+"_"+b2_2+"_"+hr1_3;
														var clickValue = "update_con('"+hr1_1+"_"+hr1_3+"','"+b1_1+"_"+b2_1+"_"+hr1_1+"_"+b1_2+"_"+b2_2+"_"+hr1_3+"','"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','hidden','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','2','"+hr1_1+"','"+hr1_3+"','0','0')";
														var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
											}


										//pfeil nach links
											if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2) && document.getElementById(hl1_2+"_"+hl1_4)) {
														var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);

														var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+hl1_2+"_"+b1_1+"_"+b2_1+"_"+hl1_4+"_"+b1_2+"_"+b2_2;
														var clickValue = "update_con('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+hl1_2+"_"+b1_1+"_"+b2_1+"_"+hl1_4+"_"+b1_2+"_"+b2_2+"','"+hl1_2+"_"+hl1_4+"','hidden','"+classValue+"','"+absolute+"','2','"+hl1_2+"','"+hl1_4+"','0','0','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"')";
														var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
											}

										//pfeil nach links
											if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2) && document.getElementById(hl1_2+"_"+hl1_4)) {
														var	classValue = IdSearch_Class(hl1_2+"_"+hl1_4); var absolute = IdSearch_Absolute(hl1_2+"_"+hl1_4);

														var addValue = hl1_2+"_"+hl1_4+"__"+hl1_2+"_"+b1_1+"_"+b2_1+"_"+hl1_4+"_"+b1_2+"_"+b2_2;
														var clickValue = "update_con('"+hl1_2+"_"+hl1_4+"','"+hl1_2+"_"+b1_1+"_"+b2_1+"_"+hl1_4+"_"+b1_2+"_"+b2_2+"','"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','hidden','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','2','"+hl1_2+"','"+hl1_4+"','0','0')";
														var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
											}


						//wenn der pfeil nach oben oder unten gedrückt wird
								var b1_1 = l2_1; // a
								var b2_1 = l2_2; // b
								var b1_2 = l1_1; // d
								var b2_2 = l1_2; // e

									if(b1_1 != 'a')								{var hl1_2 = String.fromCharCode(b1_1.charCodeAt(0)-1);}
									if(b1_2 != 'a')								{var hl1_4 = String.fromCharCode(b1_2.charCodeAt(0)-1);}
									if(b2_1 != 'x')								{var hr1_1 = String.fromCharCode(b2_1.charCodeAt(0)+1);}
									if(b2_2 != 'x')								{var hr1_3 = String.fromCharCode(b2_2.charCodeAt(0)+1);}


							//cut pfeile
									if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2)) {
												var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);
												var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+b1_1+"_"+b2_1;
												var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+b1_1+"_"+b2_1+"','leer','"+b1_2+"_"+b2_2+"','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','0','0')]";
												var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}

									if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2)) {
												var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);
												var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+b1_2+"_"+b2_2;
												var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+b1_2+"_"+b2_2+"','leer','"+b1_1+"_"+b2_1+"','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','0','0')]";
												var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}

									if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2)) {
												var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);
												var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+b1_1+"_"+b1_2;
												var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+b1_1+"_"+b1_2+"','leer','"+b2_1+"_"+b2_2+"','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','0','0')]";
												var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}

									if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2)) {
												var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);
												var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+b2_1+"_"+b2_2;
												var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+b2_1+"_"+b2_2+"','leer','"+b1_1+"_"+b1_2+"','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','0','0')]";
												var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}



							//con pfeile
								//pfeil nach rechts
									if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2) && document.getElementById(hr1_1+"_"+hr1_3)) {
												var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);

												var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+b1_1+"_"+b2_1+"_"+hr1_1+"_"+b1_2+"_"+b2_2+"_"+hr1_3;
												var clickValue = "update_con('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+b1_1+"_"+b2_1+"_"+hr1_1+"_"+b1_2+"_"+b2_2+"_"+hr1_3+"','"+hr1_1+"_"+hr1_3+"','hidden','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','2','"+hr1_1+"','"+hr1_3+"','0','0')";
												var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}

									//pfeil nach rechts 2
										if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2) && document.getElementById(hr1_1+"_"+hr1_3)) {
													var	classValue = IdSearch_Class(hr1_1+"_"+hr1_3); var absolute = IdSearch_Absolute(hr1_1+"_"+hr1_3);

													var addValue = hr1_1+"_"+hr1_3+"__"+b1_1+"_"+b2_1+"_"+hr1_1+"_"+b1_2+"_"+b2_2+"_"+hr1_3;
													var clickValue = "update_con('"+hr1_1+"_"+hr1_3+"','"+b1_1+"_"+b2_1+"_"+hr1_1+"_"+b1_2+"_"+b2_2+"_"+hr1_3+"','"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','hidden','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','2','"+hr1_1+"','"+hr1_3+"','0','0')";
													var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}


									//pfeil nach links
										if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2) && document.getElementById(hl1_2+"_"+hl1_4)) {
													var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2);

													var addValue = b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"__"+hl1_2+"_"+b1_1+"_"+b2_1+"_"+hl1_4+"_"+b1_2+"_"+b2_2;
													var clickValue = "update_con('"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','"+hl1_2+"_"+b1_1+"_"+b2_1+"_"+hl1_4+"_"+b1_2+"_"+b2_2+"','"+hl1_2+"_"+hl1_4+"','hidden','"+classValue+"','"+absolute+"','2','"+hl1_2+"','"+hl1_4+"','0','0','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"')";
													var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}

									//pfeil nach links 2
										if (document.getElementById(b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2) && document.getElementById(hl1_2+"_"+hl1_4)) {
													var	classValue = IdSearch_Class(hl1_2+"_"+hl1_4); var absolute = IdSearch_Absolute(hl1_2+"_"+hl1_4);

													var addValue = hl1_2+"_"+hl1_4+"__"+hl1_2+"_"+b1_1+"_"+b2_1+"_"+hl1_4+"_"+b1_2+"_"+b2_2;
													var clickValue = "update_con('"+hl1_2+"_"+hl1_4+"','"+hl1_2+"_"+b1_1+"_"+b2_1+"_"+hl1_4+"_"+b1_2+"_"+b2_2+"','"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_2+"','hidden','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b2_1+"','"+b1_2+"','"+b2_2+"','2','"+hl1_2+"','"+hl1_4+"','0','0')";
													var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}

				} //Ende gross2 = 2


				if(gross2 == '4'){
						var b1_1 = l1_1; // a
						var b1_2 = l1_2; // d
						var b2_1 = l2_1; // b
						var b2_2 = l2_2; // c
						var b2_3 = l2_3; // e
						var b2_4 = l2_4; // f

						//cut pfeile
								if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
											var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
											var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_3;
											var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_3+"','leer','"+b2_2+"_"+b2_4+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
								}

								if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
											var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
											var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b2_1+"_"+b2_2+"_"+b2_3+"_"+b2_4;
											var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b2_1+"_"+b2_2+"_"+b2_3+"_"+b2_4+"','leer','"+b1_1+"_"+b1_2+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
								}

								if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
											var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
											var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b1_1+"_"+b2_1+"_"+b2_2;
											var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b1_1+"_"+b2_1+"_"+b2_2+"','leer','"+b1_2+"_"+b2_3+"_"+b2_4+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
								}

								if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
											var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
											var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b1_2+"_"+b2_3+"_"+b2_4;
											var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b1_2+"_"+b2_3+"_"+b2_4+"','leer','"+b1_1+"_"+b2_1+"_"+b2_2+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
								}


						//umgekeht

						var b1_1 = l2_1; // a
						var b1_2 = l2_3; // d
						var b2_1 = l2_2; // b
						var b2_2 = l1_1; // c
						var b2_3 = l2_4; // e
						var b2_4 = l1_2; // f

							//cut pfeile
									if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
												var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
												var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_3;
												var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_3+"','leer','"+b2_2+"_"+b2_4+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
												var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}

									if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
												var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
												var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b2_1+"_"+b2_2+"_"+b2_3+"_"+b2_4;
												var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b2_1+"_"+b2_2+"_"+b2_3+"_"+b2_4+"','leer','"+b1_1+"_"+b1_2+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
												var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}

									if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
												var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
												var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b1_1+"_"+b2_1+"_"+b2_2;
												var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b1_1+"_"+b2_1+"_"+b2_2+"','leer','"+b1_2+"_"+b2_3+"_"+b2_4+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
												var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}

									if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
												var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
												var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b1_2+"_"+b2_3+"_"+b2_4;
												var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b1_2+"_"+b2_3+"_"+b2_4+"','leer','"+b1_1+"_"+b2_1+"_"+b2_2+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
												var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}

				} //Ende gross2 = 4

		} //Ende gross1 = 2

		if(gross1 == '3'){
			if(gross2 == '3'){
					var b1_1 = l1_1; // a
					var b1_2 = l2_1; // d
					var b2_1 = l1_2; // b
					var b2_2 = l1_3; // c
					var b2_3 = l2_2; // e
					var b2_4 = l2_3; // f


					//cut pfeile
							if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
										var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
										var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_3;
										var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_3+"','leer','"+b2_2+"_"+b2_4+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
										var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
										var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b2_1+"_"+b2_2+"_"+b2_3+"_"+b2_4;
										var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b2_1+"_"+b2_2+"_"+b2_3+"_"+b2_4+"','leer','"+b1_1+"_"+b1_2+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
										var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
										var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b1_1+"_"+b2_1+"_"+b2_2;
										var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b1_1+"_"+b2_1+"_"+b2_2+"','leer','"+b1_2+"_"+b2_3+"_"+b2_4+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
										var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
										var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b1_2+"_"+b2_3+"_"+b2_4;
										var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b1_2+"_"+b2_3+"_"+b2_4+"','leer','"+b1_1+"_"+b2_1+"_"+b2_2+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							//umgekeht

				var b1_1 = l2_1; // d
				var b1_2 = l1_1; // a
				var b2_1 = l2_2; // e
				var b2_2 = l2_3; // f
				var b2_3 = l1_2; // b
				var b2_4 = l1_3; // c


				//cut pfeile
						if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
									var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
									var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_3;
									var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_3+"','leer','"+b2_2+"_"+b2_4+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}

						if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
									var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
									var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b2_1+"_"+b2_2+"_"+b2_3+"_"+b2_4;
									var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b2_1+"_"+b2_2+"_"+b2_3+"_"+b2_4+"','leer','"+b1_1+"_"+b1_2+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}

						if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
									var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
									var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b1_1+"_"+b2_1+"_"+b2_2;
									var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b1_1+"_"+b2_1+"_"+b2_2+"','leer','"+b1_2+"_"+b2_3+"_"+b2_4+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}

						if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
									var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
									var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b1_2+"_"+b2_3+"_"+b2_4;
									var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b1_2+"_"+b2_3+"_"+b2_4+"','leer','"+b1_1+"_"+b2_1+"_"+b2_2+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}

				} //ende gross2 = 3
		}//ende gross1 = 3

		if(gross1 == '4'){

			if(gross2 == '2'){
					var b1_1 = l1_1; // a
					var b1_2 = l1_3; // d
					var b2_1 = l1_2; // b
					var b2_2 = l2_1; // c
					var b2_3 = l1_4; // e
					var b2_4 = l2_2; // f

					//cut pfeile
							if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
										var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
										var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_3;
										var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_3+"','leer','"+b2_2+"_"+b2_4+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
										var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
										var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b2_1+"_"+b2_2+"_"+b2_3+"_"+b2_4;
										var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b2_1+"_"+b2_2+"_"+b2_3+"_"+b2_4+"','leer','"+b1_1+"_"+b1_2+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
										var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
										var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b1_1+"_"+b2_1+"_"+b2_2;
										var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b1_1+"_"+b2_1+"_"+b2_2+"','leer','"+b1_2+"_"+b2_3+"_"+b2_4+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
										var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
										var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b1_2+"_"+b2_3+"_"+b2_4;
										var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b1_2+"_"+b2_3+"_"+b2_4+"','leer','"+b1_1+"_"+b2_1+"_"+b2_2+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

			//umgekeht
					var b1_1 = l2_1; // a
					var b1_2 = l2_2; // c
					var b2_1 = l1_1; // b
					var b2_2 = l1_2; // d
					var b2_3 = l1_3; // e
					var b2_4 = l1_4; // f

					//cut pfeile
							if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
										var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
										var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_3;
										var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b1_1+"_"+b2_1+"_"+b1_2+"_"+b2_3+"','leer','"+b2_2+"_"+b2_4+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
										var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
										var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b2_1+"_"+b2_2+"_"+b2_3+"_"+b2_4;
										var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b2_1+"_"+b2_2+"_"+b2_3+"_"+b2_4+"','leer','"+b1_1+"_"+b1_2+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
										var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
										var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b1_1+"_"+b2_1+"_"+b2_2;
										var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b1_1+"_"+b2_1+"_"+b2_2+"','leer','"+b1_2+"_"+b2_3+"_"+b2_4+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							if (document.getElementById(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4)) {
										var	classValue = IdSearch_Class(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4);
										var addValue = b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"__"+b1_2+"_"+b2_3+"_"+b2_4;
										var clickValue = "[update_cut('"+b1_1+"_"+b2_1+"_"+b2_2+"_"+b1_2+"_"+b2_3+"_"+b2_4+"','"+b1_2+"_"+b2_3+"_"+b2_4+"','leer','"+b1_1+"_"+b2_1+"_"+b2_2+"','"+classValue+"','"+absolute+"','6','"+b1_1+"','"+b2_1+"','"+b2_2+"','"+b1_2+"','"+b2_3+"','"+b2_4+"')]";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}
				} //Ende gross2 = 2
		} //Ende gross1 = 4



						if(gross2 == '1'){


								if(gross1 == '1'){

									//pos1
										var b1_1 = l2_1;
										var b2_1 = l1_1;

											if(b1_1 != 'a' || b1_1 != 'b'){var hl1_1 = String.fromCharCode(b1_1.charCodeAt(0)-2);}
											if(b1_1 != 'a' )							{var hl1_2 = String.fromCharCode(b1_1.charCodeAt(0)-1);}
											if(b2_1 != 'a' | b2_1 != 'b')	{var hl1_3 = String.fromCharCode(b2_1.charCodeAt(0)-2);}
											if(b2_1 != 'a' )							{var hl1_4 = String.fromCharCode(b2_1.charCodeAt(0)-1);}
											if(b1_1 != 'a' || b1_1 != 'b' || b1_1 != 'c'){var vu1_1 = String.fromCharCode(b1_1.charCodeAt(0)-3);}
											if(b2_1 != 'a' || b2_1 != 'b' || b2_1 != 'c'){var vu2_1 = String.fromCharCode(b2_1.charCodeAt(0)-3);}
											if(b1_1 != 'v' || b1_1 != 'w' || b1_1 != 'x'){var vd1_1 = String.fromCharCode(b1_1.charCodeAt(0)+3);}
											if(b2_1 != 'v' || b2_1 != 'w' || b2_1 != 'x'){var vd2_1 = String.fromCharCode(b2_1.charCodeAt(0)+3);}
											if(b1_1 != 'x')								{var hr1_1 = String.fromCharCode(b1_1.charCodeAt(0)+1);}
											if(b1_1 != 'w' || b1_1 != 'x'){var hr1_2 = String.fromCharCode(b1_1.charCodeAt(0)+2);}
											if(b2_1 != 'x')								{var hr1_3 = String.fromCharCode(b2_1.charCodeAt(0)+1);}
											if(b2_1 != 'w' || b2_1 != 'x'){var hr1_4 = String.fromCharCode(b2_1.charCodeAt(0)+2);}



						//con Pfeile

							//horizontal
								//pfeil nach oben
									if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(vu1_1+"_"+vu2_1)) {
												var	classValue = IdSearch_Class(b1_1+"_"+b2_1); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1);

												var addValue = b1_1+"_"+b2_1+"__"+vu1_1+"_"+vu2_1+"_"+b1_1+"_"+b2_1;
												var clickValue = "update_con('"+b1_1+"_"+b2_1+"','"+vu1_1+"_"+vu2_1+"_"+b1_1+"_"+b2_1+"','"+vu1_1+"_"+vu2_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','2','"+vu1_1+"','"+vu2_1+"','0','0')";
												var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}

									//pfeil nach oben 2
										if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(vu1_1+"_"+vu2_1)) {
													var	classValue = IdSearch_Class(vu1_1+"_"+vu2_1); var absolute = IdSearch_Absolute(vu1_1+"_"+vu2_1);

													var addValue = vu1_1+"_"+vu2_1+"__"+vu1_1+"_"+vu2_1+"_"+b1_1+"_"+b2_1;
													var clickValue = "update_con('"+vu1_1+"_"+vu2_1+"','"+vu1_1+"_"+vu2_1+"_"+b1_1+"_"+b2_1+"','"+b1_1+"_"+b2_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','2','"+vu1_1+"','"+vu2_1+"','0','0')";
													var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}


								//pfeil nach rechts
									if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hr1_2)) {
												var	classValue = IdSearch_Class(b1_1+"_"+b2_1); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1);

												var addValue = b1_1+"_"+b2_1+"__"+b1_1+"_"+b2_1+"_"+hr1_2;
												var clickValue = "update_con('"+b1_1+"_"+b2_1+"','"+b1_1+"_"+b2_1+"_"+hr1_2+"','"+hr1_2+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','1','"+hr1_2+"','0','0','0')";
												var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}

								//pfeil nach rechts 2
									if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hr1_2)) {
												var	classValue = IdSearch_Class(hr1_2); var absolute = IdSearch_Absolute(hr1_2);

												var addValue = hr1_2+"__"+b1_1+"_"+b2_1+"_"+hr1_2;
												var clickValue = "update_con('"+hr1_2+"','"+b1_1+"_"+b2_1+"_"+hr1_2+"','"+b1_1+"_"+b2_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','1','"+hr1_2+"','0','0','0')";
												var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}


								//pfeil nach unten
									if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(vd1_1+"_"+vd2_1)) {
												var	classValue = IdSearch_Class(b1_1+"_"+b2_1); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1);

												var addValue = b1_1+"_"+b2_1+"__"+b1_1+"_"+b2_1+"_"+vd1_1+"_"+vd2_1;
												var clickValue = "update_con('"+b1_1+"_"+b2_1+"','"+b1_1+"_"+b2_1+"_"+vd1_1+"_"+vd2_1+"','"+vd1_1+"_"+vd2_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','2','"+vd1_1+"','"+vd2_1+"','0','0')";
												var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}

								//pfeil nach unten 2
									if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(vd1_1+"_"+vd2_1)) {
												var	classValue = IdSearch_Class(vd1_1+"_"+vd2_1); var absolute = IdSearch_Absolute(vd1_1+"_"+vd2_1);

												var addValue = vd1_1+"_"+vd2_1+"__"+b1_1+"_"+b2_1+"_"+vd1_1+"_"+vd2_1;
												var clickValue = "update_con('"+vd1_1+"_"+vd2_1+"','"+b1_1+"_"+b2_1+"_"+vd1_1+"_"+vd2_1+"','"+b1_1+"_"+b2_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','2','"+vd1_1+"','"+vd2_1+"','0','0')";
												var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}


								//pfeil nach links
									if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hl1_2)) {
												var	classValue = IdSearch_Class(b1_1+"_"+b2_1); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1);

												var addValue = b1_1+"_"+b2_1+"__"+hl1_2+"_"+b1_1+"_"+b2_1;
												var clickValue = "update_con('"+b1_1+"_"+b2_1+"','"+hl1_2+"_"+b1_1+"_"+b2_1+"','"+hl1_2+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','1','"+hl1_2+"','0','0','0')";
												var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}

								//pfeil nach links 2
									if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hl1_2)) {
												var	classValue = IdSearch_Class(hl1_2); var absolute = IdSearch_Absolute(hl1_2);

												var addValue = hl1_2+"__"+hl1_2+"_"+b1_1+"_"+b2_1;
												var clickValue = "update_con('"+hl1_2+"','"+hl1_2+"_"+b1_1+"_"+b2_1+"','"+b1_1+"_"+b2_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','1','"+hl1_2+"','0','0','0')";
												var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}



					//Vertical
						//pfeil nach rechts
							if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hr1_1+"_"+hr1_3)) {
										var	classValue = IdSearch_Class(b1_1+"_"+b2_1); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1);

										var addValue = b1_1+"_"+b2_1+"__"+b1_1+"_"+hr1_1+"_"+b2_1+"_"+hr1_3;
										var clickValue = "update_con('"+b1_1+"_"+b2_1+"','"+b1_1+"_"+hr1_1+"_"+b2_1+"_"+hr1_3+"','"+hr1_1+"_"+hr1_3+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','2','"+hr1_1+"','"+hr1_3+"','0','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

						//pfeil nach rechts 2
							if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hr1_1+"_"+hr1_3)) {
										var	classValue = IdSearch_Class(hr1_1+"_"+hr1_3); var absolute = IdSearch_Absolute(hr1_1+"_"+hr1_3);

										var addValue = hr1_1+"_"+hr1_3+"__"+b1_1+"_"+hr1_1+"_"+b2_1+"_"+hr1_3;
										var clickValue = "update_con('"+hr1_1+"_"+hr1_3+"','"+b1_1+"_"+hr1_1+"_"+b2_1+"_"+hr1_3+"','"+b1_1+"_"+b2_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','2','"+hr1_1+"','"+hr1_3+"','0','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}


							//pfeil nach rechts (4 gross)
								if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hr1_1+"_"+hr1_2+"_"+hr1_3+"_"+hr1_4)) {
											var	classValue = IdSearch_Class(b1_1+"_"+b2_1); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1);

											var addValue = b1_1+"_"+b2_1+"__"+b1_1+"_"+hr1_1+"_"+hr1_2+"_"+b2_1+"_"+hr1_3+"_"+hr1_4;
											var clickValue = "update_con('"+b1_1+"_"+b2_1+"','"+b1_1+"_"+hr1_1+"_"+hr1_2+"_"+b2_1+"_"+hr1_3+"_"+hr1_4+"','"+hr1_1+"_"+hr1_2+"_"+hr1_3+"_"+hr1_4+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','4','"+hr1_1+"','"+hr1_2+"','"+hr1_3+"','"+hr1_4+"')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
								}

							//pfeil nach rechts 2 (4 gross)
								if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hr1_1+"_"+hr1_2+"_"+hr1_3+"_"+hr1_4)) {
											var	classValue = IdSearch_Class(hr1_1+"_"+hr1_2+"_"+hr1_3+"_"+hr1_4); var absolute = IdSearch_Absolute(hr1_1+"_"+hr1_2+"_"+hr1_3+"_"+hr1_4);

											var addValue = hr1_1+"_"+hr1_2+"_"+hr1_3+"_"+hr1_4+"__"+b1_1+"_"+hr1_1+"_"+hr1_2+"_"+b2_1+"_"+hr1_3+"_"+hr1_4;
											var clickValue = "update_con('"+hr1_1+"_"+hr1_2+"_"+hr1_3+"_"+hr1_4+"','"+b1_1+"_"+hr1_1+"_"+hr1_2+"_"+b2_1+"_"+hr1_3+"_"+hr1_4+"','"+b1_1+"_"+b2_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','4','"+hr1_1+"','"+hr1_2+"','"+hr1_3+"','"+hr1_4+"')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
								}


							//pfeil nach links
								if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hl1_2+"_"+hl1_4)) {
											var	classValue = IdSearch_Class(b1_1+"_"+b2_1); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1);

											var addValue = b1_1+"_"+b2_1+"__"+hl1_2+"_"+b1_1+"_"+hl1_4+"_"+b2_1;
											var clickValue = "update_con('"+b1_1+"_"+b2_1+"','"+hl1_2+"_"+b1_1+"_"+hl1_4+"_"+b2_1+"','"+hl1_2+"_"+hl1_4+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','2','"+hl1_2+"','"+hl1_4+"','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
								}

							//pfeil nach links 2
								if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hl1_2+"_"+hl1_4)) {
											var	classValue = IdSearch_Class(hl1_2+"_"+hl1_4); var absolute = IdSearch_Absolute(hl1_2+"_"+hl1_4);

											var addValue = hl1_2+"_"+hl1_4+"__"+hl1_2+"_"+b1_1+"_"+hl1_4+"_"+b2_1;
											var clickValue = "update_con('"+hl1_2+"_"+hl1_4+"','"+hl1_2+"_"+b1_1+"_"+hl1_4+"_"+b2_1+"','"+b1_1+"_"+b2_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','2','"+hl1_2+"','"+hl1_4+"','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
								}


							//pfeil nach links (4 gross)
								if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hl1_1+"_"+hl1_2+"_"+hl1_3+"_"+hl1_4)) {
											var	classValue = IdSearch_Class(b1_1+"_"+b2_1); var absolute = IdSearch_Absolute(b1_1+"_"+b2_1);

											var addValue = b1_1+"_"+b2_1+"__"+hl1_1+"_"+hl1_2+"_"+b1_1+"_"+hl1_3+"_"+hl1_4+"_"+b2_1;
											var clickValue = "update_con('"+b1_1+"_"+b2_1+"','"+hl1_1+"_"+hl1_2+"_"+b1_1+"_"+hl1_3+"_"+hl1_4+"_"+b2_1+"','"+hl1_1+"_"+hl1_2+"_"+hl1_3+"_"+hl1_4+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','4','"+hl1_1+"','"+hl1_2+"','"+hl1_3+"','"+hl1_4+"')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
								}

							//pfeil nach links 2 (4 gross)
								if (document.getElementById(b1_1+"_"+b2_1) && document.getElementById(hl1_1+"_"+hl1_2+"_"+hl1_3+"_"+hl1_4)) {
											var	classValue = IdSearch_Class(hl1_1+"_"+hl1_2+"_"+hl1_3+"_"+hl1_4); var absolute = IdSearch_Absolute(hl1_1+"_"+hl1_2+"_"+hl1_3+"_"+hl1_4);

											var addValue = hl1_1+"_"+hl1_2+"_"+hl1_3+"_"+hl1_4+"__"+hl1_1+"_"+hl1_2+"_"+b1_1+"_"+hl1_3+"_"+hl1_4+"_"+b2_1;
											var clickValue = "update_con('"+hl1_1+"_"+hl1_2+"_"+hl1_3+"_"+hl1_4+"','"+hl1_1+"_"+hl1_2+"_"+b1_1+"_"+hl1_3+"_"+hl1_4+"_"+b2_1+"','"+b1_1+"_"+b2_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b2_1+"','0','0','4','"+hl1_1+"','"+hl1_2+"','"+hl1_3+"','"+hl1_4+"')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
								}

							} //Ende gross1 = 1
			} //Ende gross2 = 1


}





//===============================================================================================================
//===============================================================================================================
//===============================================================================================================
//======================================= Addieren Button CUT ===== =============================================
//===============================================================================================================
//===============================================================================================================
//===============================================================================================================


function ButtonsAddCut(gross1,l1_1,l1_2,l1_3,l1_4,l1_5,l1_6,gross2,l2_1,l2_2,l2_3,l2_4){
						//Generator
						//b1 = Base1 also die pos1
						//hl1 = horizontal1 left also die pos1 - 2 nach links
						//hl2 = horizontal2 left also die pos1 - 1 nach links
						//hl3 = horizontal3 left also die pos1 - 2 nach links und -1 nach unten
						//hl4 = horizontal4 left also die pos1 - 1 nach links und -1 nach unten
						//vd1 = vertical1 down also die pos1 - 1 nach unten
						//vu1 = vertical1 up also die pos1 + 1 nach oben
						//hr1 = horizontal1 right also die pos1 + 1 nach rechts
						//hr2 = horizontal2 right also die pos1 + 2 nach rechts
						//hr3 = horizontal3 right also die pos1 + 1 nach rechts und -1 nach unten
						//hr4 = horizontal4 right also die pos1 + 2 nach rechts und -1 nach unten


	//wenn ein cut button gedrückt wird
					if(gross1 == '2'){

								//pos1
									var b1_1 = l1_1;
									var b1_3 = l1_2;
										if(b1_1 != 'a' || b1_1 != 'b'){var hl1_1 = String.fromCharCode(b1_1.charCodeAt(0)-2);}
										if(b1_1 != 'a' )							{var hl1_2 = String.fromCharCode(b1_1.charCodeAt(0)-1);}
										if(b1_1 != 'a' || b1_1 != 'b' || b1_1 != 'c'){var vu1_1 = String.fromCharCode(b1_1.charCodeAt(0)-3);}
										if(b1_1 != 'v' || b1_1 != 'w' || b1_1 != 'x'){var vd1_1 = String.fromCharCode(b1_1.charCodeAt(0)+3);}
										if(b1_1 != 'x')							{var hr1_1 = String.fromCharCode(b1_1.charCodeAt(0)+1);}
										if(b1_1 != 'w' || b1_1 != 'x'){var hr1_2 = String.fromCharCode(b1_1.charCodeAt(0)+2);}


						//pfeil nach oben
							if (document.getElementById(b1_1) && document.getElementById(vu1_1) && b1_3 != vu1_1) {
										var	classValue = IdSearch_Class(b1_1); var absolute = IdSearch_Absolute(b1_1);

										var addValue = b1_1+"__"+vu1_1+"_"+b1_1;
										var clickValue = "update_con('"+b1_1+"','"+vu1_1+"_"+b1_1+"','"+vu1_1+"','hidden','"+classValue+"','"+absolute+"','1','"+b1_1+"','0','0','0','1','"+vu1_1+"','0','0','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}


						//pfeil nach oben 2  (nach unten)
							if (document.getElementById(b1_1) && document.getElementById(vu1_1) && b1_3 != vu1_1) {
										var	classValue = IdSearch_Class(vu1_1); var absolute = IdSearch_Absolute(vu1_1);

										var addValue = vu1_1+"__"+vu1_1+"_"+b1_1;
										var clickValue = "update_con('"+vu1_1+"','"+vu1_1+"_"+b1_1+"','"+b1_1+"','hidden','"+classValue+"','"+absolute+"','1','"+vu1_1+"','0','0','0','1','"+b1_1+"','0','0','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}





						//pfeil nach rechts
							if (document.getElementById(b1_1) && document.getElementById(hr1_1) && b1_3 != hr1_1) {
										var	classValue = IdSearch_Class(b1_1); var	absolute = IdSearch_Absolute(b1_1);

										var addValue = b1_1+"__"+b1_1+"_"+hr1_1;
										var clickValue = "update_con('"+b1_1+"','"+b1_1+"_"+hr1_1+"','"+hr1_1+"','hidden','"+classValue+"','"+absolute+"','1','"+b1_1+"','0','0','0','1','"+hr1_1+"','0','0','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}


						//pfeil nach rechts 2 (nach links)
							if (document.getElementById(b1_1) && document.getElementById(hr1_1) && b1_3 != hr1_1) {
										var	classValue = IdSearch_Class(hr1_1); var	absolute = IdSearch_Absolute(hr1_1);

										var addValue = hr1_1+"__"+b1_1+"_"+hr1_1;
										var clickValue = "update_con('"+hr1_1+"','"+b1_1+"_"+hr1_1+"','"+b1_1+"','hidden','"+classValue+"','"+absolute+"','1','"+hr1_1+"','0','0','0','1','"+b1_1+"','0','0','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}


						//pfeil nach rechts (2 gross)
							if (document.getElementById(b1_1) && document.getElementById(hr1_1+"_"+hr1_2) && b1_3 != hr1_1+"_"+hr1_2) {
										var	classValue = IdSearch_Class(b1_1); var	absolute = IdSearch_Absolute(b1_1);

										var addValue = b1_1+"__"+b1_1+"_"+hr1_1+"_"+hr1_2;
										var clickValue = "update_con('"+b1_1+"','"+b1_1+"_"+hr1_1+"_"+hr1_2+"','"+hr1_1+"_"+hr1_2+"','hidden','"+classValue+"','"+absolute+"','1','"+b1_1+"','0','0','0','2','"+hr1_1+"','"+hr1_2+"','0','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}


						//pfeil nach rechts 2 (2 gross nach links)
							if (document.getElementById(b1_1) && document.getElementById(hr1_1+"_"+hr1_2) && b1_3 != hr1_1+"_"+hr1_2) {
										var	classValue = IdSearch_Class(hr1_1+"_"+hr1_2); var	absolute = IdSearch_Absolute(hr1_1+"_"+hr1_2);

										var addValue = hr1_1+"_"+hr1_2+"__"+b1_1+"_"+hr1_1+"_"+hr1_2;
										var clickValue = "update_con('"+hr1_1+"_"+hr1_2+"','"+b1_1+"_"+hr1_1+"_"+hr1_2+"','"+b1_1+"','hidden','"+classValue+"','"+absolute+"','2','"+hr1_1+"','"+hr1_2+"','0','0','1','"+b1_1+"','0','0','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}




						//pfeil nach unten
							if (document.getElementById(b1_1) && document.getElementById(vd1_1) && b1_3 != vd1_1) {
										var	classValue = IdSearch_Class(b1_1); var	absolute = IdSearch_Absolute(b1_1);

										var addValue = b1_1+"__"+b1_1+"_"+vd1_1;
										var clickValue = "update_con('"+b1_1+"','"+b1_1+"_"+vd1_1+"','"+vd1_1+"','hidden','"+classValue+"','"+absolute+"','1','"+b1_1+"','0','0','0','1','"+vd1_1+"','0','0','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}

						//pfeil nach unten 2 (nach oben)
							if (document.getElementById(b1_1) && document.getElementById(vd1_1) && b1_3 != vd1_1) {
										var	classValue = IdSearch_Class(vd1_1); var	absolute = IdSearch_Absolute(vd1_1);

										var addValue = vd1_1+"__"+b1_1+"_"+vd1_1;
										var clickValue = "update_con('"+vd1_1+"','"+b1_1+"_"+vd1_1+"','"+b1_1+"','hidden','"+classValue+"','"+absolute+"','1','"+vd1_1+"','0','0','0','1','"+b1_1+"','0','0','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}




						//pfeil nach links
							if (document.getElementById(b1_1) && document.getElementById(hl1_2) && b1_3 != hl1_2) {
										var	classValue = IdSearch_Class(b1_1); var	absolute = IdSearch_Absolute(b1_1);

										var addValue = b1_1+"__"+hl1_2+"_"+b1_1;
										var clickValue = "update_con('"+b1_1+"','"+hl1_2+"_"+b1_1+"','"+hl1_2+"','hidden','"+classValue+"','"+absolute+"','1','"+b1_1+"','0','0','0','1','"+hl1_2+"','0','0','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}

						//pfeil nach links 2 (nach rechts)
							if (document.getElementById(b1_1) && document.getElementById(hl1_2) && b1_3 != hl1_2) {
										var	classValue = IdSearch_Class(hl1_2); var	absolute = IdSearch_Absolute(hl1_2);

										var addValue = hl1_2+"__"+hl1_2+"_"+b1_1;
										var clickValue = "update_con('"+hl1_2+"','"+hl1_2+"_"+b1_1+"','"+b1_1+"','hidden','"+classValue+"','"+absolute+"','1','"+hl1_2+"','0','0','0','1','"+b1_1+"','0','0','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}


						//pfeil nach links (2 gross)
							if (document.getElementById(b1_1) && document.getElementById(hl1_1+"_"+hl1_2) && b1_3 != hl1_1+"_"+hl1_2) {
										var	classValue = IdSearch_Class(b1_1); var	absolute = IdSearch_Absolute(b1_1);

										var addValue = b1_1+"__"+hl1_1+"_"+hl1_2+"_"+b1_1;
										var clickValue = "update_con('"+b1_1+"','"+hl1_1+"_"+hl1_2+"_"+b1_1+"','"+hl1_1+"_"+hl1_2+"','hidden','"+classValue+"','"+absolute+"','1','"+b1_1+"','0','0','0','2','"+hl1_1+"','"+hl1_2+"','0','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}

						//pfeil nach links (2 gross) 2 rechts
						if (document.getElementById(b1_1) && document.getElementById(hl1_1+"_"+hl1_2) && b1_3 != hl1_1+"_"+hl1_2) {
									var	classValue = IdSearch_Class(hl1_1+"_"+hl1_2); var	absolute = IdSearch_Absolute(hl1_1+"_"+hl1_2);

									var addValue = hl1_1+"_"+hl1_2+"__"+hl1_1+"_"+hl1_2+"_"+b1_1;
									var clickValue = "update_con('"+hl1_1+"_"+hl1_2+"','"+hl1_1+"_"+hl1_2+"_"+b1_1+"','"+b1_1+"','hidden','"+classValue+"','"+absolute+"','2','"+hl1_1+"','"+hl1_2+"','0','0','1','"+b1_1+"','0','0','0')";
									var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}




						//pos2
						var b2_1 = l1_1;
						var b2_2 = l1_2;
							if(b2_2 != 'a' || b2_2 != 'b'){var hl2_1 = String.fromCharCode(b2_2.charCodeAt(0)-2);}
							if(b2_2 != 'a' )							{var hl2_2 = String.fromCharCode(b2_2.charCodeAt(0)-1);}
							if(b2_2 != 'a' || b2_2 != 'b' || b2_2 != 'c'){var vu2_1 = String.fromCharCode(b2_2.charCodeAt(0)-3);}
							if(b2_2 != 'v' || b2_2 != 'w' || b2_2 != 'x'){var vd2_1 = String.fromCharCode(b2_2.charCodeAt(0)+3);}
							if(b2_2 != 'x' || b2_2 != 'w'){var hr2_1 = String.fromCharCode(b2_2.charCodeAt(0)+1);}
							if(b2_2 != 'w')								{var hr2_2 = String.fromCharCode(b2_2.charCodeAt(0)+2);}

							//pfeil nach oben
								if (document.getElementById(b2_2) && document.getElementById(vu2_1)) {
											var	classValue = IdSearch_Class(b2_2); var absolute = IdSearch_Absolute(b2_2);

											var addValue = b2_2+"__"+vu2_1+"_"+b2_2;
											var clickValue = "update_con('"+b2_2+"','"+vu2_1+"_"+b2_2+"','"+vu2_1+"','hidden','"+classValue+"','"+absolute+"','1','"+b2_2+"','0','0','0','1','"+vu2_1+"','0','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
								}


							//pfeil nach oben 2 (nach unten)
								if (document.getElementById(b2_2) && document.getElementById(vu2_1)) {
											var	classValue = IdSearch_Class(vu2_1); var absolute = IdSearch_Absolute(vu2_1);

											var addValue = vu2_1+"__"+vu2_1+"_"+b2_2;
											var clickValue = "update_con('"+vu2_1+"','"+vu2_1+"_"+b2_2+"','"+b2_2+"','hidden','"+classValue+"','"+absolute+"','1','"+vu2_1+"','0','0','0','1','"+b2_2+"','0','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
								}





						//pfeil nach rechts
							if (document.getElementById(b2_2) && document.getElementById(hr2_1)) {
										var	classValue = IdSearch_Class(b2_2); var absolute = IdSearch_Absolute(b2_2);

										var addValue = b2_2+"__"+b2_2+"_"+hr2_1;
										var clickValue = "update_con('"+b2_2+"','"+b2_2+"_"+hr2_1+"','"+hr2_1+"','hidden','"+classValue+"','"+absolute+"','1','"+b2_2+"','0','0','0','1','"+hr2_1+"','0','0','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							//pfeil nach rechts 2 (nach links)
								if (document.getElementById(b2_2) && document.getElementById(hr2_1)) {
											var	classValue = IdSearch_Class(hr2_1); var absolute = IdSearch_Absolute(hr2_1);

											var addValue = hr2_1+"__"+b2_2+"_"+hr2_1;
											var clickValue = "update_con('"+hr2_1+"','"+b2_2+"_"+hr2_1+"','"+b2_2+"','hidden','"+classValue+"','"+absolute+"','1','"+hr2_1+"','0','0','0','1','"+b2_2+"','0','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
								}


							//pfeil nach rechts (2 gross)
								if (document.getElementById(b2_2) && document.getElementById(hr2_1+"_"+hr2_2) && b1_3 != hr2_1+"_"+hr2_2) {
											var	classValue = IdSearch_Class(b2_2); var	absolute = IdSearch_Absolute(b2_2);

											var addValue = b2_2+"__"+b2_2+"_"+hr2_1+"_"+hr2_2;
											var clickValue = "update_con('"+b2_2+"','"+b2_2+"_"+hr2_1+"_"+hr2_2+"','"+hr2_1+"_"+hr2_2+"','hidden','"+classValue+"','"+absolute+"','1','"+b2_2+"','0','0','0','2','"+hr2_1+"','"+hr2_2+"','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}


							//pfeil nach rechts 2 (2 gross nach links)
								if (document.getElementById(b2_2) && document.getElementById(hr2_1+"_"+hr2_2) && b1_3 != hr2_1+"_"+hr2_2) {
											var	classValue = IdSearch_Class(hr2_1+"_"+hr2_2); var	absolute = IdSearch_Absolute(hr2_1+"_"+hr2_2);

											var addValue = hr2_1+"_"+hr2_2+"__"+b2_2+"_"+hr2_1+"_"+hr2_2;
											var clickValue = "update_con('"+hr2_1+"_"+hr2_2+"','"+b2_2+"_"+hr2_1+"_"+hr2_2+"','"+b2_2+"','hidden','"+classValue+"','"+absolute+"','2','"+hr2_1+"','"+hr2_2+"','0','0','1','"+b2_2+"','0','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}




						//pfeil nach unten
							if (document.getElementById(b2_2) && document.getElementById(vd2_1)) {
										var	classValue = IdSearch_Class(b2_2); var absolute = IdSearch_Absolute(b2_2);

										var addValue = b2_2+"__"+b2_2+"_"+vd2_1;
										var clickValue = "update_con('"+b2_2+"','"+b2_2+"_"+vd2_1+"','"+vd2_1+"','hidden','"+classValue+"','"+absolute+"','1','"+b2_2+"','0','0','0','1','"+vd2_1+"','0','0','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							//pfeil nach unten 2 (nach oben)
								if (document.getElementById(b2_2) && document.getElementById(vd2_1)) {
											var	classValue = IdSearch_Class(vd2_1); var absolute = IdSearch_Absolute(vd2_1);

											var addValue = vd2_1+"__"+b2_2+"_"+vd2_1;
											var clickValue = "update_con('"+vd2_1+"','"+b2_2+"_"+vd2_1+"','"+b2_2+"','hidden','"+classValue+"','"+absolute+"','1','"+vd2_1+"','0','0','0','1','"+b2_2+"','0','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
								}





						//pfeil nach links
							if (document.getElementById(b2_2) && document.getElementById(hl2_2)) {
										var	classValue = IdSearch_Class(b2_2); var absolute = IdSearch_Absolute(b2_2);

										var addValue = b2_2+"__"+hl2_2+"_"+b2_2;
										var clickValue = "update_con('"+b2_2+"','"+hl2_2+"_"+b2_2+"','"+hl2_2+"','hidden','"+classValue+"','"+absolute+"','1','"+b2_2+"','0','0','0','1','"+hl2_2+"','0','0','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							//pfeil nach links 2 (nach rechts)
								if (document.getElementById(b2_2) && document.getElementById(hl2_2)) {
											var	classValue = IdSearch_Class(hl2_2); var absolute = IdSearch_Absolute(hl2_2);

											var addValue = hl2_2+"__"+hl2_2+"_"+b2_2;
											var clickValue = "update_con('"+hl2_2+"','"+hl2_2+"_"+b2_2+"','"+b2_2+"','hidden','"+classValue+"','"+absolute+"','1','"+hl2_2+"','0','0','0','1','"+b2_2+"','0','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
								}

								//pfeil nach links (2 gross)
									if (document.getElementById(b2_2) && document.getElementById(hl2_1+"_"+hl2_2) && b1_3 != hl2_1+"_"+hl2_2) {
												var	classValue = IdSearch_Class(b2_2); var	absolute = IdSearch_Absolute(b2_2);

												var addValue = b2_2+"__"+hl2_1+"_"+hl2_2+"_"+b2_2;
												var clickValue = "update_con('"+b2_2+"','"+hl2_1+"_"+hl2_2+"_"+b2_2+"','"+hl2_1+"_"+hl2_2+"','hidden','"+classValue+"','"+absolute+"','1','"+b2_2+"','0','0','0','2','"+hl2_1+"','"+hl2_2+"','0','0')";
												var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
								}

								//pfeil nach links (2 gross) 2 rechts
								if (document.getElementById(b2_2) && document.getElementById(hl2_1+"_"+hl2_2) && b1_3 != hl2_1+"_"+hl2_2) {
											var	classValue = IdSearch_Class(hl2_1+"_"+hl2_2); var	absolute = IdSearch_Absolute(hl2_1+"_"+hl2_2);

											var addValue = hl2_1+"_"+hl2_2+"__"+hl2_1+"_"+hl2_2+"_"+b2_2;
											var clickValue = "update_con('"+hl2_1+"_"+hl2_2+"','"+hl2_1+"_"+hl2_2+"_"+b2_2+"','"+b2_2+"','hidden','"+classValue+"','"+absolute+"','2','"+hl2_1+"','"+hl2_2+"','0','0','1','"+b2_2+"','0','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}



					} //ende gross1 = 2


/*====================================
======================================
=============gross1 = 3 ==============
======================================
======================================
======================================*/


					if(gross1 == '3'){

								//pos1
									var b1_1 = l1_1;
									var b1_2 = l1_2;
									var b1_3 = l1_3;
										if(b1_1 != 'a' || b1_1 != 'b'){var hl1_1 = String.fromCharCode(b1_1.charCodeAt(0)-2);}
										if(b1_1 != 'a' )							{var hl1_2 = String.fromCharCode(b1_1.charCodeAt(0)-1);}
										if(b1_1 != 'a' || b1_1 != 'b' || b1_1 != 'c'){var vu1_1 = String.fromCharCode(b1_1.charCodeAt(0)-3);}
										if(b1_2 != 'a' || b1_2 != 'b' || b1_2 != 'c'){var vu1_2 = String.fromCharCode(b1_2.charCodeAt(0)-3);}
										if(b1_3 != 'a' || b1_3 != 'b' || b1_3 != 'c'){var vu1_3 = String.fromCharCode(b1_3.charCodeAt(0)-3);}
										if(b1_1 != 'v' || b1_1 != 'w' || b1_1 != 'x'){var vd1_1 = String.fromCharCode(b1_1.charCodeAt(0)+3);}
										if(b1_2 != 'v' || b1_2 != 'w' || b1_2 != 'x'){var vd1_2 = String.fromCharCode(b1_2.charCodeAt(0)+3);}
										if(b1_3 != 'v' || b1_3 != 'w' || b1_3 != 'x'){var vd1_3 = String.fromCharCode(b1_3.charCodeAt(0)+3);}
										if(b1_1 != 'x' || b1_1 != 'w'){var hr1_1 = String.fromCharCode(b1_1.charCodeAt(0)+1);}
										if(b1_1 != 'w')								{var hr1_2 = String.fromCharCode(b1_1.charCodeAt(0)+2);}



							//cut button erstellen
							if (document.getElementById(b1_1+"_"+b1_3)) {
										var	classValue = IdSearch_Class(b1_1+"_"+b1_3); var absolute = IdSearch_Absolute(b1_1+"_"+b1_3);

										var addValue = b1_1+"_"+b1_3+"__"+b1_3;
										var clickValue = "[update_cut('"+b1_1+"_"+b1_3+"','"+b1_3+"','leer','"+b1_1+"','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_3+"','0','0','0','0')]";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							if (document.getElementById(b1_1+"_"+b1_3)) {
										var	classValue = IdSearch_Class(b1_1+"_"+b1_3); var absolute = IdSearch_Absolute(b1_1+"_"+b1_3);

										var addValue = b1_1+"_"+b1_3+"__"+b1_1;
										var clickValue = "[update_cut('"+b1_1+"_"+b1_3+"','"+b1_1+"','leer','"+b1_3+"','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_3+"','0','0','0','0')]";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							if (document.getElementById(b1_1+"_"+b1_2)) {
										var	classValue = IdSearch_Class(b1_1+"_"+b1_2); var absolute = IdSearch_Absolute(b1_1+"_"+b1_2);

										var addValue = b1_1+"_"+b1_2+"__"+b1_2;
										var clickValue = "[update_cut('"+b1_1+"_"+b1_2+"','"+b1_2+"','leer','"+b1_1+"','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_2+"','0','0','0','0')]";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							if (document.getElementById(b1_1+"_"+b1_2)) {
										var	classValue = IdSearch_Class(b1_1+"_"+b1_2); var absolute = IdSearch_Absolute(b1_1+"_"+b1_2);

										var addValue = b1_1+"_"+b1_2+"__"+b1_1;
										var clickValue = "[update_cut('"+b1_1+"_"+b1_2+"','"+b1_1+"','leer','"+b1_2+"','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_2+"','0','0','0','0')]";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}


										//pfeil nach oben
											if (document.getElementById(b1_1) && document.getElementById(vu1_1)) {
														var	classValue = IdSearch_Class(b1_1); var absolute = IdSearch_Absolute(b1_1);

														var addValue = b1_1+"__"+vu1_1+"_"+b1_1;
														var clickValue = "update_con('"+b1_1+"','"+vu1_1+"_"+b1_1+"','"+vu1_1+"','hidden','"+classValue+"','"+absolute+"','1','"+b1_1+"','0','0','0','1','"+vu1_1+"','0','0','0')";
														var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}

										//pfeil nach oben 2  (nach unten)
											if (document.getElementById(b1_1) && document.getElementById(vu1_1)) {
														var	classValue = IdSearch_Class(vu1_1); var absolute = IdSearch_Absolute(vu1_1);

														var addValue = vu1_1+"__"+vu1_1+"_"+b1_1;
														var clickValue = "update_con('"+vu1_1+"','"+vu1_1+"_"+b1_1+"','"+b1_1+"','hidden','"+classValue+"','"+absolute+"','1','"+vu1_1+"','0','0','0','1','"+b1_1+"','0','0','0')";
														var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}


										//pfeil nach oben (2 breit)
											if (document.getElementById(b1_1+"_"+b1_3) && document.getElementById(vu1_1+"_"+vu1_3)) {
														var	classValue = IdSearch_Class(b1_1+"_"+b1_3); var absolute = IdSearch_Absolute(b1_1+"_"+b1_3);

														var addValue = b1_1+"_"+b1_3+"__"+vu1_1+"_"+vu1_3+"_"+b1_1+"_"+b1_3;
														var clickValue = "update_con('"+b1_1+"_"+b1_3+"','"+vu1_1+"_"+vu1_3+"_"+b1_1+"_"+b1_3+"','"+vu1_1+"_"+vu1_3+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_3+"','0','0','2','"+vu1_1+"','"+vu1_3+"','0','0')";
														var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}

										//pfeil nach oben 2 (2 breit)
										if (document.getElementById(b1_1+"_"+b1_3) && document.getElementById(vu1_1+"_"+vu1_3)) {
													var	classValue = IdSearch_Class(vu1_1+"_"+vu1_3); var absolute = IdSearch_Absolute(vu1_1+"_"+vu1_3);

													var addValue = vu1_1+"_"+vu1_3+"__"+vu1_1+"_"+vu1_3+"_"+b1_1+"_"+b1_3;
													var clickValue = "update_con('"+vu1_1+"_"+vu1_3+"','"+vu1_1+"_"+vu1_3+"_"+b1_1+"_"+b1_3+"','"+b1_1+"_"+b1_3+"','hidden','"+classValue+"','"+absolute+"','2','"+vu1_1+"','"+vu1_3+"','0','0','2','"+b1_1+"','"+b1_3+"','0','0')";
													var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}


									//pfeil nach oben 2 + 2
										if (document.getElementById(b1_1+"_"+b1_2) && document.getElementById(vu1_1+"_"+vu1_2)) {
													var	classValue = IdSearch_Class(b1_1+"_"+b1_2); var absolute = IdSearch_Absolute(b1_1+"_"+b1_2);

													var addValue = b1_1+"_"+b1_2+"__"+vu1_1+"_"+vu1_2+"_"+b1_1+"_"+b1_2;
													var clickValue = "update_con('"+b1_1+"_"+b1_2+"','"+vu1_1+"_"+vu1_2+"_"+b1_1+"_"+b1_2+"','"+vu1_1+"_"+vu1_2+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_2+"','0','0','2','"+vu1_1+"','"+vu1_2+"','0','0')";
													var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}

									//pfeil nach oben 2 + 2 (2 nach unten)
										if (document.getElementById(b1_1+"_"+b1_2) && document.getElementById(vu1_1+"_"+vu1_2)) {
												var	classValue = IdSearch_Class(vu1_1+"_"+vu1_2); var absolute = IdSearch_Absolute(vu1_1+"_"+vu1_2);

												var addValue = vu1_1+"_"+vu1_2+"__"+vu1_1+"_"+vu1_2+"_"+b1_1+"_"+b1_2;
												var clickValue = "update_con('"+vu1_1+"_"+vu1_2+"','"+vu1_1+"_"+vu1_2+"_"+b1_1+"_"+b1_2+"','"+b1_1+"_"+b1_2+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_2+"','0','0','2','"+vu1_1+"','"+vu1_2+"','0','0')";
												var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
									}




										//pfeil nach rechts
											if (document.getElementById(b1_1) && document.getElementById(hr1_1)) {
														var	classValue = IdSearch_Class(b1_1); var	absolute = IdSearch_Absolute(b1_1);

														var addValue = b1_1+"__"+b1_1+"_"+hr1_1;
														var clickValue = "update_con('"+b1_1+"','"+b1_1+"_"+hr1_1+"','"+hr1_1+"','hidden','"+classValue+"','"+absolute+"','1','"+b1_1+"','0','0','0','1','"+hr1_1+"','0','0','0')";
														var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}


										//pfeil nach rechts 2 (nach links)
											if (document.getElementById(b1_1) && document.getElementById(hr1_1)) {
														var	classValue = IdSearch_Class(hr1_1); var	absolute = IdSearch_Absolute(hr1_1);

														var addValue = hr1_1+"__"+b1_1+"_"+hr1_1;
														var clickValue = "update_con('"+hr1_1+"','"+b1_1+"_"+hr1_1+"','"+b1_1+"','hidden','"+classValue+"','"+absolute+"','1','"+hr1_1+"','0','0','0','1','"+b1_1+"','0','0','0')";
														var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}


										//pfeil nach rechts (2 gross)
											if (document.getElementById(b1_1) && document.getElementById(hr1_1+"_"+hr1_2)) {
														var	classValue = IdSearch_Class(b1_1); var	absolute = IdSearch_Absolute(b1_1);

														var addValue = b1_1+"__"+b1_1+"_"+hr1_1+"_"+hr1_2;
														var clickValue = "update_con('"+b1_1+"','"+b1_1+"_"+hr1_1+"_"+hr1_2+"','"+hr1_1+"_"+hr1_2+"','hidden','"+classValue+"','"+absolute+"','1','"+b1_1+"','0','0','0','2','"+hr1_1+"','"+hr1_2+"','0','0')";
														var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}


										//pfeil nach rechts 2 (2 gross nach links)
											if (document.getElementById(b1_1) && document.getElementById(hr1_1+"_"+hr1_2)) {
														var	classValue = IdSearch_Class(hr1_1+"_"+hr1_2); var	absolute = IdSearch_Absolute(hr1_1+"_"+hr1_2);

														var addValue = hr1_1+"_"+hr1_2+"__"+b1_1+"_"+hr1_1+"_"+hr1_2;
														var clickValue = "update_con('"+hr1_1+"_"+hr1_2+"','"+b1_1+"_"+hr1_1+"_"+hr1_2+"','"+b1_1+"','hidden','"+classValue+"','"+absolute+"','2','"+hr1_1+"','"+hr1_2+"','0','0','1','"+b1_1+"','0','0','0')";
														var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}




										//pfeil nach unten
											if (document.getElementById(b1_1) && document.getElementById(vd1_1)) {
														var	classValue = IdSearch_Class(b1_1); var	absolute = IdSearch_Absolute(b1_1);

														var addValue = b1_1+"__"+b1_1+"_"+vd1_1;
														var clickValue = "update_con('"+b1_1+"','"+b1_1+"_"+vd1_1+"','"+vd1_1+"','hidden','"+classValue+"','"+absolute+"','1','"+b1_1+"','0','0','0','1','"+vd1_1+"','0','0','0')";
														var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}

										//pfeil nach unten 2 (nach oben)
											if (document.getElementById(b1_1) && document.getElementById(vd1_1)) {
														var	classValue = IdSearch_Class(vd1_1); var	absolute = IdSearch_Absolute(vd1_1);

														var addValue = vd1_1+"__"+b1_1+"_"+vd1_1;
														var clickValue = "update_con('"+vd1_1+"','"+b1_1+"_"+vd1_1+"','"+b1_1+"','hidden','"+classValue+"','"+absolute+"','1','"+vd1_1+"','0','0','0','1','"+b1_1+"','0','0','0')";
														var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}


										//pfeil nach unten (2 Breit)
											if (document.getElementById(b1_1+"_"+b1_3) && document.getElementById(vd1_1+"_"+vd1_3)) {
														var	classValue = IdSearch_Class(b1_1+"_"+b1_3); var	absolute = IdSearch_Absolute(b1_1+"_"+b1_3);

														var addValue = b1_1+"_"+b1_3+"__"+b1_1+"_"+b1_3+"_"+vd1_1+"_"+vd1_3;
														var clickValue = "update_con('"+b1_1+"_"+b1_3+"','"+b1_1+"_"+b1_3+"_"+vd1_1+"_"+vd1_3+"','"+vd1_1+"_"+vd1_3+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_3+"','0','0','2','"+vd1_1+"','"+vd1_3+"','0','0')";
														var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}

										//pfeil nach unten 2 (2 Breit)
											if (document.getElementById(b1_1+"_"+b1_3) && document.getElementById(vd1_1+"_"+vd1_3)) {
														var	classValue = IdSearch_Class(vd1_1+"_"+vd1_3); var	absolute = IdSearch_Absolute(vd1_1+"_"+vd1_3);

														var addValue = vd1_1+"_"+vd1_3+"__"+b1_1+"_"+b1_3+"_"+vd1_1+"_"+vd1_3;
														var clickValue = "update_con('"+vd1_1+"_"+vd1_3+"','"+b1_1+"_"+b1_3+"_"+vd1_1+"_"+vd1_3+"','"+b1_1+"_"+b1_3+"','hidden','"+classValue+"','"+absolute+"','2','"+vd1_1+"','"+vd1_3+"','0','0','2','"+b1_1+"','"+b1_3+"','0','0')";
														var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}


										//pfeil nach unten 2 + 2
											if (document.getElementById(b1_1+"_"+b1_2) && document.getElementById(vd1_1+"_"+vd1_2)) {
														var	classValue = IdSearch_Class(b1_1+"_"+b1_2); var absolute = IdSearch_Absolute(b1_1+"_"+b1_2);

														var addValue = b1_1+"_"+b1_2+"__"+b1_1+"_"+b1_2+"_"+vd1_1+"_"+vd1_2;
														var clickValue = "update_con('"+b1_1+"_"+b1_2+"','"+b1_1+"_"+b1_2+"_"+vd1_1+"_"+vd1_2+"','"+vd1_1+"_"+vd1_2+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_2+"','0','0','2','"+vd1_1+"','"+vd1_2+"','0','0')";
														var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}

										//pfeil nach unten 2 + 2 (2 nach oben)
											if (document.getElementById(b1_1+"_"+b1_2) && document.getElementById(vd1_1+"_"+vd1_2)) {
														var	classValue = IdSearch_Class(vd1_1+"_"+vd1_2); var absolute = IdSearch_Absolute(vd1_1+"_"+vd1_2);

														var addValue = vd1_1+"_"+vd1_2+"__"+b1_1+"_"+b1_2+"_"+vd1_1+"_"+vd1_2;
														var clickValue = "update_con('"+vd1_1+"_"+vd1_2+"','"+b1_1+"_"+b1_2+"_"+vd1_1+"_"+vd1_2+"','"+b1_1+"_"+b1_2+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_2+"','0','0','2','"+vd1_1+"','"+vd1_2+"','0','0')";
														var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}




										//pfeil nach links
											if (document.getElementById(b1_1) && document.getElementById(hl1_2)) {
														var	classValue = IdSearch_Class(b1_1); var	absolute = IdSearch_Absolute(b1_1);

														var addValue = b1_1+"__"+hl1_2+"_"+b1_1;
														var clickValue = "update_con('"+b1_1+"','"+hl1_2+"_"+b1_1+"','"+hl1_2+"','hidden','"+classValue+"','"+absolute+"','1','"+b1_1+"','0','0','0','1','"+hl1_2+"','0','0','0')";
														var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}

										//pfeil nach links 2 (nach rechts)
											if (document.getElementById(b1_1) && document.getElementById(hl1_2)) {
														var	classValue = IdSearch_Class(hl1_2); var	absolute = IdSearch_Absolute(hl1_2);

														var addValue = hl1_2+"__"+hl1_2+"_"+b1_1;
														var clickValue = "update_con('"+hl1_2+"','"+hl1_2+"_"+b1_1+"','"+b1_1+"','hidden','"+classValue+"','"+absolute+"','1','"+hl1_2+"','0','0','0','1','"+b1_1+"','0','0','0')";
														var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}


										//pfeil nach links (2 gross)
											if (document.getElementById(b1_1) && document.getElementById(hl1_1+"_"+hl1_2)) {
														var	classValue = IdSearch_Class(b1_1); var	absolute = IdSearch_Absolute(b1_1);

														var addValue = b1_1+"__"+hl1_1+"_"+hl1_2+"_"+b1_1;
														var clickValue = "update_con('"+b1_1+"','"+hl1_1+"_"+hl1_2+"_"+b1_1+"','"+hl1_1+"_"+hl1_2+"','hidden','"+classValue+"','"+absolute+"','1','"+b1_1+"','0','0','0','2','"+hl1_1+"','"+hl1_2+"','0','0')";
														var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}

										//pfeil nach links (2 gross) 2 rechts
										if (document.getElementById(b1_1) && document.getElementById(hl1_1+"_"+hl1_2)) {
													var	classValue = IdSearch_Class(hl1_1+"_"+hl1_2); var	absolute = IdSearch_Absolute(hl1_1+"_"+hl1_2);

													var addValue = hl1_1+"_"+hl1_2+"__"+hl1_1+"_"+hl1_2+"_"+b1_1;
													var clickValue = "update_con('"+hl1_1+"_"+hl1_2+"','"+hl1_1+"_"+hl1_2+"_"+b1_1+"','"+b1_1+"','hidden','"+classValue+"','"+absolute+"','2','"+hl1_1+"','"+hl1_2+"','0','0','1','"+b1_1+"','0','0','0')";
													var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
										}



						//pos2
						var b2_1 = l1_1;
						var b2_2 = l1_2;
						var b2_3 = l1_3;
							if(b2_3 != 'a' || b2_3 != 'b'){var hl2_1 = String.fromCharCode(b2_3.charCodeAt(0)-2);}
							if(b2_3 != 'a' )							{var hl2_2 = String.fromCharCode(b2_3.charCodeAt(0)-1);}
							if(b2_3 != 'a' || b2_3 != 'b' || b2_3 != 'c'){var vu2_1 = String.fromCharCode(b2_3.charCodeAt(0)-3);}
							if(b2_3 != 'a' || b2_3 != 'b' || b2_3 != 'c'){var vu2_2 = String.fromCharCode(b2_2.charCodeAt(0)-3);}
							if(b2_3 != 'v' || b2_3 != 'w' || b2_3 != 'x'){var vd2_1 = String.fromCharCode(b2_3.charCodeAt(0)+3);}
							if(b2_3 != 'v' || b2_3 != 'w' || b2_3 != 'x'){var vd2_2 = String.fromCharCode(b2_2.charCodeAt(0)+3);}
							if(b2_3 != 'x' || b2_3 != 'w'){var hr2_1 = String.fromCharCode(b2_3.charCodeAt(0)+1);}
							if(b2_3 != 'w')								{var hr2_2 = String.fromCharCode(b2_3.charCodeAt(0)+2);}

					//cut button erstellen
					if (document.getElementById(b2_2+"_"+b2_3)) {
								var	classValue = IdSearch_Class(b2_2+"_"+b2_3); var absolute = IdSearch_Absolute(b2_2+"_"+b2_3);

								var addValue = b2_2+"_"+b2_3+"__"+b2_3;
								var clickValue = "[update_cut('"+b2_2+"_"+b2_3+"','"+b2_3+"','leer','"+b2_2+"','"+classValue+"','"+absolute+"','2','"+b2_2+"','"+b2_3+"','0','0','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					if (document.getElementById(b2_2+"_"+b2_3)) {
								var	classValue = IdSearch_Class(b2_2+"_"+b2_3); var absolute = IdSearch_Absolute(b2_2+"_"+b2_3);

								var addValue = b2_2+"_"+b2_3+"__"+b2_2;
								var clickValue = "[update_cut('"+b2_2+"_"+b2_3+"','"+b2_2+"','leer','"+b2_3+"','"+classValue+"','"+absolute+"','2','"+b2_2+"','"+b2_3+"','0','0','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}


							//pfeil nach oben
								if (document.getElementById(b2_3) && document.getElementById(vu2_1)) {
											var	classValue = IdSearch_Class(b2_3); var absolute = IdSearch_Absolute(b2_3);

											var addValue = b2_3+"__"+vu2_1+"_"+b2_3;
											var clickValue = "update_con('"+b2_3+"','"+vu2_1+"_"+b2_3+"','"+vu2_1+"','hidden','"+classValue+"','"+absolute+"','1','"+b2_3+"','0','0','0','1','"+vu2_1+"','0','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							//pfeil nach oben 2  (nach unten)
								if (document.getElementById(b2_3) && document.getElementById(vu2_1)) {
											var	classValue = IdSearch_Class(vu2_1); var absolute = IdSearch_Absolute(vu2_1);

											var addValue = vu2_1+"__"+vu2_1+"_"+b2_3;
											var clickValue = "update_con('"+vu2_1+"','"+vu2_1+"_"+b2_3+"','"+b2_3+"','hidden','"+classValue+"','"+absolute+"','1','"+vu2_1+"','0','0','0','1','"+b2_3+"','0','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}


							//pfeil nach oben (2 Breit)
								if (document.getElementById(b2_2+"_"+b2_3) && document.getElementById(vu2_2+"_"+vu2_1)) {
											var	classValue = IdSearch_Class(b2_2+"_"+b2_3); var absolute = IdSearch_Absolute(b2_2+"_"+b2_3);

											var addValue = b2_2+"_"+b2_3+"__"+vu2_2+"_"+vu2_1+"_"+b2_2+"_"+b2_3;
											var clickValue = "update_con('"+b2_2+"_"+b2_3+"','"+vu2_2+"_"+vu2_1+"_"+b2_2+"_"+b2_3+"','"+vu2_2+"_"+vu2_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b2_2+"','"+b2_3+"','0','0','2','"+vu2_2+"','"+vu2_1+"','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							//pfeil nach oben 2 (2 Breit)
							if (document.getElementById(b2_2+"_"+b2_3) && document.getElementById(vu2_2+"_"+vu2_1)) {
										var	classValue = IdSearch_Class(vu2_2+"_"+vu2_1); var absolute = IdSearch_Absolute(vu2_2+"_"+vu2_1);

										var addValue = vu2_2+"_"+vu2_1+"__"+vu2_2+"_"+vu2_1+"_"+b2_2+"_"+b2_3;
										var clickValue = "update_con('"+vu2_2+"_"+vu2_1+"','"+vu2_2+"_"+vu2_1+"_"+b2_2+"_"+b2_3+"','"+b2_2+"_"+b2_3+"','hidden','"+classValue+"','"+absolute+"','2','"+vu2_2+"','"+vu2_1+"','0','0','2','"+b2_2+"','"+b2_3+"','0','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}




							//pfeil nach rechts
								if (document.getElementById(b2_3) && document.getElementById(hr2_1)) {
											var	classValue = IdSearch_Class(b2_3); var	absolute = IdSearch_Absolute(b2_3);

											var addValue = b2_3+"__"+b2_3+"_"+hr2_1;
											var clickValue = "update_con('"+b2_3+"','"+b2_3+"_"+hr2_1+"','"+hr2_1+"','hidden','"+classValue+"','"+absolute+"','1','"+b2_3+"','0','0','0','1','"+hr2_1+"','0','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							//pfeil nach rechts 2 (nach links)
								if (document.getElementById(b2_3) && document.getElementById(hr2_1)) {
											var	classValue = IdSearch_Class(hr2_1); var	absolute = IdSearch_Absolute(hr2_1);

											var addValue = hr2_1+"__"+b2_3+"_"+hr2_1;
											var clickValue = "update_con('"+hr2_1+"','"+b2_3+"_"+hr2_1+"','"+b2_3+"','hidden','"+classValue+"','"+absolute+"','1','"+hr2_1+"','0','0','0','1','"+b2_3+"','0','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							//pfeil nach rechts (2 gross)
								if (document.getElementById(b2_3) && document.getElementById(hr2_1+"_"+hr2_2)) {
											var	classValue = IdSearch_Class(b2_3); var	absolute = IdSearch_Absolute(b2_3);

											var addValue = b2_3+"__"+b2_3+"_"+hr2_1+"_"+hr2_2;
											var clickValue = "update_con('"+b2_3+"','"+b2_3+"_"+hr2_1+"_"+hr2_2+"','"+hr2_1+"_"+hr2_2+"','hidden','"+classValue+"','"+absolute+"','1','"+b2_3+"','0','0','0','2','"+hr2_1+"','"+hr2_2+"','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							//pfeil nach rechts 2 (2 gross nach links)
								if (document.getElementById(b2_3) && document.getElementById(hr2_1+"_"+hr2_2)) {
											var	classValue = IdSearch_Class(hr2_1+"_"+hr2_2); var	absolute = IdSearch_Absolute(hr2_1+"_"+hr2_2);

											var addValue = hr2_1+"_"+hr2_2+"__"+b2_3+"_"+hr2_1+"_"+hr2_2;
											var clickValue = "update_con('"+hr2_1+"_"+hr2_2+"','"+b2_3+"_"+hr2_1+"_"+hr2_2+"','"+b2_3+"','hidden','"+classValue+"','"+absolute+"','2','"+hr2_1+"','"+hr2_2+"','0','0','1','"+b2_3+"','0','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}




							//pfeil nach unten
								if (document.getElementById(b2_3) && document.getElementById(vd2_1)) {
											var	classValue = IdSearch_Class(b2_3); var	absolute = IdSearch_Absolute(b2_3);

											var addValue = b2_3+"__"+b2_3+"_"+vd2_1;
											var clickValue = "update_con('"+b2_3+"','"+b2_3+"_"+vd2_1+"','"+vd2_1+"','hidden','"+classValue+"','"+absolute+"','1','"+b2_3+"','0','0','0','1','"+vd2_1+"','0','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							//pfeil nach unten 2 (nach oben)
								if (document.getElementById(b2_3) && document.getElementById(vd2_1)) {
											var	classValue = IdSearch_Class(vd2_1); var	absolute = IdSearch_Absolute(vd2_1);

											var addValue = vd2_1+"__"+b2_3+"_"+vd2_1;
											var clickValue = "update_con('"+vd2_1+"','"+b2_3+"_"+vd2_1+"','"+b2_3+"','hidden','"+classValue+"','"+absolute+"','1','"+vd2_1+"','0','0','0','1','"+b2_3+"','0','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							//pfeil nach unten (2 Breit)
								if (document.getElementById(b2_2+"_"+b2_3) && document.getElementById(vd2_2+"_"+vd2_1)) {
											var	classValue = IdSearch_Class(b2_2+"_"+b2_3); var	absolute = IdSearch_Absolute(b2_2+"_"+b2_3);

											var addValue = b2_2+"_"+b2_3+"__"+b2_2+"_"+b2_3+"_"+vd2_2+"_"+vd2_1;
											var clickValue = "update_con('"+b2_2+"_"+b2_3+"','"+b2_2+"_"+b2_3+"_"+vd2_2+"_"+vd2_1+"','"+vd2_2+"_"+vd2_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b2_2+"','"+b2_3+"','0','0','2','"+vd2_2+"','"+vd2_1+"','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							//pfeil nach unten 2 (2 Breit)
							if (document.getElementById(b2_2+"_"+b2_3) && document.getElementById(vd2_2+"_"+vd2_1)) {
										var	classValue = IdSearch_Class(vd2_2+"_"+vd2_1); var	absolute = IdSearch_Absolute(vd2_2+"_"+vd2_1);

										var addValue = vd2_2+"_"+vd2_1+"__"+b2_2+"_"+b2_3+"_"+vd2_2+"_"+vd2_1;
										var clickValue = "update_con('"+vd2_2+"_"+vd2_1+"','"+b2_2+"_"+b2_3+"_"+vd2_2+"_"+vd2_1+"','"+b2_2+"_"+b2_3+"','hidden','"+classValue+"','"+absolute+"','2','"+vd2_2+"','"+vd2_1+"','0','0','2','"+b2_2+"','"+b2_3+"','0','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
						}



							//pfeil nach links
								if (document.getElementById(b2_3) && document.getElementById(hl2_2)) {
											var	classValue = IdSearch_Class(b2_3); var	absolute = IdSearch_Absolute(b2_3);

											var addValue = b2_3+"__"+hl2_2+"_"+b2_3;
											var clickValue = "update_con('"+b2_3+"','"+hl2_2+"_"+b2_3+"','"+hl2_2+"','hidden','"+classValue+"','"+absolute+"','1','"+b2_3+"','0','0','0','1','"+hl2_2+"','0','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							//pfeil nach links 2 (nach rechts)
								if (document.getElementById(b2_3) && document.getElementById(hl2_2)) {
											var	classValue = IdSearch_Class(hl2_2); var	absolute = IdSearch_Absolute(hl2_2);

											var addValue = hl2_2+"__"+hl2_2+"_"+b2_3;
											var clickValue = "update_con('"+hl2_2+"','"+hl2_2+"_"+b2_3+"','"+b2_3+"','hidden','"+classValue+"','"+absolute+"','1','"+hl2_2+"','0','0','0','1','"+b2_3+"','0','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}


							//pfeil nach links (2 gross)
								if (document.getElementById(b2_3) && document.getElementById(hl2_1+"_"+hl2_2)) {
											var	classValue = IdSearch_Class(b2_3); var	absolute = IdSearch_Absolute(b2_3);

											var addValue = b2_3+"__"+hl2_1+"_"+hl2_2+"_"+b2_3;
											var clickValue = "update_con('"+b2_3+"','"+hl2_1+"_"+hl2_2+"_"+b2_3+"','"+hl2_1+"_"+hl2_2+"','hidden','"+classValue+"','"+absolute+"','1','"+b2_3+"','0','0','0','2','"+hl2_1+"','"+hl2_2+"','0','0')";
											var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}

							//pfeil nach links (2 gross) 2 rechts
							if (document.getElementById(b2_3) && document.getElementById(hl2_1+"_"+hl2_2)) {
										var	classValue = IdSearch_Class(hl2_1+"_"+hl2_2); var	absolute = IdSearch_Absolute(hl2_1+"_"+hl2_2);

										var addValue = hl2_1+"_"+hl2_2+"__"+hl2_1+"_"+hl2_2+"_"+b2_3;
										var clickValue = "update_con('"+hl2_1+"_"+hl2_2+"','"+hl2_1+"_"+hl2_2+"_"+b2_3+"','"+b2_3+"','hidden','"+classValue+"','"+absolute+"','2','"+hl2_1+"','"+hl2_2+"','0','0','1','"+b2_3+"','0','0','0')";
										var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
							}



					} //ende gross1 = 3


/*====================================
======================================
=============gross1 = 4 ==============
======================================
======================================
======================================*/


					if(gross1 == '4'){

								//pos1
									var b1_1 = l1_1;
									var b1_2 = l1_2;
									var b1_3 = l1_3;
									var b1_4 = l1_4;


					//cut button erstellen
					if (document.getElementById(b1_1+"_"+b1_3)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b1_3); var absolute = IdSearch_Absolute(b1_1+"_"+b1_3);

								var addValue = b1_1+"_"+b1_3+"__"+b1_3;
								var clickValue = "[update_cut('"+b1_1+"_"+b1_3+"','"+b1_3+"','leer','"+b1_1+"','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_3+"','0','0','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					if (document.getElementById(b1_1+"_"+b1_3)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b1_3); var absolute = IdSearch_Absolute(b1_1+"_"+b1_3);

								var addValue = b1_1+"_"+b1_3+"__"+b1_1;
								var clickValue = "[update_cut('"+b1_1+"_"+b1_3+"','"+b1_1+"','leer','"+b1_3+"','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_3+"','0','0','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}


					if (document.getElementById(b1_3+"_"+b1_4)) {
								var	classValue = IdSearch_Class(b1_3+"_"+b1_4); var absolute = IdSearch_Absolute(b1_3+"_"+b1_4);

								var addValue = b1_3+"_"+b1_4+"__"+b1_4;
								var clickValue = "[update_cut('"+b1_3+"_"+b1_4+"','"+b1_4+"','leer','"+b1_3+"','"+classValue+"','"+absolute+"','2','"+b1_3+"','"+b1_4+"','0','0','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					if (document.getElementById(b1_3+"_"+b1_4)) {
								var	classValue = IdSearch_Class(b1_3+"_"+b1_4); var absolute = IdSearch_Absolute(b1_3+"_"+b1_4);

								var addValue = b1_3+"_"+b1_4+"__"+b1_3;
								var clickValue = "[update_cut('"+b1_3+"_"+b1_4+"','"+b1_3+"','leer','"+b1_4+"','"+classValue+"','"+absolute+"','2','"+b1_3+"','"+b1_4+"','0','0','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}





					if (document.getElementById(b1_1+"_"+b1_2)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b1_2); var absolute = IdSearch_Absolute(b1_1+"_"+b1_2);

								var addValue = b1_1+"_"+b1_2+"__"+b1_2;
								var clickValue = "[update_cut('"+b1_1+"_"+b1_2+"','"+b1_2+"','leer','"+b1_1+"','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_2+"','0','0','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					if (document.getElementById(b1_1+"_"+b1_2)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b1_2); var absolute = IdSearch_Absolute(b1_1+"_"+b1_2);

								var addValue = b1_1+"_"+b1_2+"__"+b1_1;
								var clickValue = "[update_cut('"+b1_1+"_"+b1_2+"','"+b1_1+"','leer','"+b1_2+"','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_2+"','0','0','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}



					if (document.getElementById(b1_2+"_"+b1_4)) {
								var	classValue = IdSearch_Class(b1_2+"_"+b1_4); var absolute = IdSearch_Absolute(b1_2+"_"+b1_4);

								var addValue = b1_2+"_"+b1_4+"__"+b1_4;
								var clickValue = "[update_cut('"+b1_2+"_"+b1_4+"','"+b1_4+"','leer','"+b1_2+"','"+classValue+"','"+absolute+"','2','"+b1_2+"','"+b1_4+"','0','0','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					if (document.getElementById(b1_2+"_"+b1_4)) {
								var	classValue = IdSearch_Class(b1_2+"_"+b1_4); var absolute = IdSearch_Absolute(b1_2+"_"+b1_4);

								var addValue = b1_2+"_"+b1_4+"__"+b1_2;
								var clickValue = "[update_cut('"+b1_2+"_"+b1_4+"','"+b1_2+"','leer','"+b1_4+"','"+classValue+"','"+absolute+"','2','"+b1_2+"','"+b1_4+"','0','0','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					//cut button erstellen ende

							if(b1_1 != 'a' )							{var hl1_1 = String.fromCharCode(b1_1.charCodeAt(0)-1);}
							if(b1_3 != 'a' )							{var hl1_2 = String.fromCharCode(b1_3.charCodeAt(0)-1);}
							if(b1_1 != 'a' || b1_1 != 'b' || b1_1 != 'C'){var vu1_1 = String.fromCharCode(b1_1.charCodeAt(0)-3);}
							if(b1_2 != 'a' || b1_2 != 'b' || b1_2 != 'C'){var vu1_2 = String.fromCharCode(b1_2.charCodeAt(0)-3);}
							if(b1_3 != 'v' || b1_3 != 'w' || b1_3 != 'x'){var vd1_1 = String.fromCharCode(b1_3.charCodeAt(0)+3);}
							if(b1_4 != 'v' || b1_4 != 'w' || b1_4 != 'x'){var vd1_2 = String.fromCharCode(b1_4.charCodeAt(0)+3);}
							if(b1_2 != 'x' )							{var hr1_1 = String.fromCharCode(b1_2.charCodeAt(0)+1);}
							if(b1_4 != 'x' )							{var hr1_2 = String.fromCharCode(b1_4.charCodeAt(0)+1);}

					//con button erstellen

					//pos1

					//pfeil nach oben
					if (document.getElementById(b1_1+"_"+b1_2) && document.getElementById(vu1_1+"_"+vu1_2)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b1_2); var	absolute = IdSearch_Absolute(b1_1+"_"+b1_2);

								var addValue = b1_1+"_"+b1_2+"__"+vu1_1+"_"+vu1_2+"_"+b1_1+"_"+b1_2;
								var clickValue = "update_con('"+b1_1+"_"+b1_2+"','"+vu1_1+"_"+vu1_2+"_"+b1_1+"_"+b1_2+"','"+vu1_1+"_"+vu1_2+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_2+"','0','0','2','"+vu1_1+"','"+vu1_2+"','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					//pfeil nach oben 2
					if (document.getElementById(b1_1+"_"+b1_2) && document.getElementById(vu1_1+"_"+vu1_2)) {
								var	classValue = IdSearch_Class(vu1_1+"_"+vu1_2); var	absolute = IdSearch_Absolute(vu1_1+"_"+vu1_2);

								var addValue = vu1_1+"_"+vu1_2+"__"+vu1_1+"_"+vu1_2+"_"+b1_1+"_"+b1_2;
								var clickValue = "update_con('"+vu1_1+"_"+vu1_2+"','"+vu1_1+"_"+vu1_2+"_"+b1_1+"_"+b1_2+"','"+b1_1+"_"+b1_2+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_2+"','0','0','2','"+vu1_1+"','"+vu1_2+"','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}



					//pfeil nach rechts
					if (document.getElementById(b1_1+"_"+b1_3) && document.getElementById(b1_2+"_"+b1_4)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b1_3); var	absolute = IdSearch_Absolute(b1_1+"_"+b1_3);

								var addValue = b1_1+"_"+b1_3+"__"+b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4;
								var clickValue = "update_con('"+b1_1+"_"+b1_3+"','"+b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"','"+b1_2+"_"+b1_4+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_3+"','0','0','2','"+b1_2+"','"+b1_4+"','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					//pfeil nach rechts 2
					if (document.getElementById(b1_1+"_"+b1_3) && document.getElementById(b1_2+"_"+b1_4)) {
								var	classValue = IdSearch_Class(b1_2+"_"+b1_4); var	absolute = IdSearch_Absolute(b1_2+"_"+b1_4);

								var addValue = b1_2+"_"+b1_4+"__"+b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4;
								var clickValue = "update_con('"+b1_2+"_"+b1_4+"','"+b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"','"+b1_1+"_"+b1_3+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_3+"','0','0','2','"+b1_2+"','"+b1_4+"','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}


					//pfeil nach rechts horizontal
					if (document.getElementById(b1_1+"_"+b1_2) && document.getElementById(hr1_1)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b1_2); var	absolute = IdSearch_Absolute(b1_1+"_"+b1_2);

								var addValue = b1_1+"_"+b1_2+"__"+b1_1+"_"+b1_2+"_"+hr1_1;
								var clickValue = "update_con('"+b1_1+"_"+b1_2+"','"+b1_1+"_"+b1_2+"_"+hr1_1+"','"+hr1_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_2+"','0','0','1','"+hr1_1+"','0','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					//pfeil nach rechts horizontal 2
					if (document.getElementById(b1_1+"_"+b1_2) && document.getElementById(hr1_1)) {
								var	classValue = IdSearch_Class(hr1_1); var	absolute = IdSearch_Absolute(hr1_1);

								var addValue = hr1_1+"__"+b1_1+"_"+b1_2+"_"+hr1_1;
								var clickValue = "update_con('"+hr1_1+"','"+b1_1+"_"+b1_2+"_"+hr1_1+"','"+b1_1+"_"+b1_2+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_2+"','0','0','1','"+hr1_1+"','0','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}



					//pfeil nach unten
					if (document.getElementById(b1_1+"_"+b1_2) && document.getElementById(b1_3+"_"+b1_4)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b1_2); var	absolute = IdSearch_Absolute(b1_1+"_"+b1_2);

								var addValue = b1_1+"_"+b1_2+"__"+b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4;
								var clickValue = "update_con('"+b1_1+"_"+b1_2+"','"+b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"','"+b1_3+"_"+b1_4+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_2+"','0','0','2','"+b1_3+"','"+b1_4+"','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					//pfeil nach unten 2
					if (document.getElementById(b1_1+"_"+b1_2) && document.getElementById(b1_3+"_"+b1_4)) {
								var	classValue = IdSearch_Class(b1_3+"_"+b1_4); var	absolute = IdSearch_Absolute(b1_3+"_"+b1_4);

								var addValue = b1_3+"_"+b1_4+"__"+b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4;
								var clickValue = "update_con('"+b1_3+"_"+b1_4+"','"+b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"','"+b1_1+"_"+b1_2+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_2+"','0','0','2','"+b1_3+"','"+b1_4+"','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}



					//pfeil nach links
					if (document.getElementById(b1_1+"_"+b1_3) && document.getElementById(hl1_1+"_"+hl1_2)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b1_3); var	absolute = IdSearch_Absolute(b1_1+"_"+b1_3);

								var addValue = b1_1+"_"+b1_3+"__"+hl1_1+"_"+b1_1+"_"+hl1_2+"_"+b1_3;
								var clickValue = "update_con('"+b1_1+"_"+b1_3+"','"+hl1_1+"_"+b1_1+"_"+hl1_2+"_"+b1_3+"','"+hl1_1+"_"+hl1_2+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_3+"','0','0','2','"+hl1_1+"','"+hl1_2+"','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					//pfeil nach links 2
					if (document.getElementById(b1_1+"_"+b1_3) && document.getElementById(hl1_1+"_"+hl1_2)) {
								var	classValue = IdSearch_Class(hl1_1+"_"+hl1_2); var	absolute = IdSearch_Absolute(hl1_1+"_"+hl1_2);

								var addValue = hl1_1+"_"+hl1_2+"__"+hl1_1+"_"+b1_1+"_"+hl1_2+"_"+b1_3;
								var clickValue = "update_con('"+hl1_1+"_"+hl1_2+"','"+hl1_1+"_"+b1_1+"_"+hl1_2+"_"+b1_3+"','"+b1_1+"_"+b1_3+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_3+"','0','0','2','"+hl1_1+"','"+hl1_2+"','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}


					//pfeil nach links horizontal
					if (document.getElementById(b1_1+"_"+b1_2) && document.getElementById(hl1_1)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b1_2); var	absolute = IdSearch_Absolute(b1_1+"_"+b1_2);

								var addValue = b1_1+"_"+b1_2+"__"+hl1_1+"_"+b1_1+"_"+b1_2;
								var clickValue = "update_con('"+b1_1+"_"+b1_2+"','"+hl1_1+"_"+b1_1+"_"+b1_2+"','"+hl1_1+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_2+"','0','0','1','"+hl1_1+"','0','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					//pfeil nach links horizontal 2
					if (document.getElementById(b1_1+"_"+b1_2) && document.getElementById(hl1_1)) {
								var	classValue = IdSearch_Class(hl1_1); var	absolute = IdSearch_Absolute(hl1_1);

								var addValue = hl1_1+"__"+hl1_1+"_"+b1_1+"_"+b1_2;
								var clickValue = "update_con('"+hl1_1+"','"+hl1_1+"_"+b1_1+"_"+b1_2+"','"+b1_1+"_"+b1_2+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_2+"','0','0','1','"+hl1_1+"','0','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}


					//pos2

					//pfeil nach rechts
					if (document.getElementById(b1_2+"_"+b1_4) && document.getElementById(hr1_1+"_"+hr1_2)) {
								var	classValue = IdSearch_Class(b1_2+"_"+b1_4); var	absolute = IdSearch_Absolute(b1_2+"_"+b1_4);

								var addValue = b1_2+"_"+b1_4+"__"+b1_2+"_"+hr1_1+"_"+b1_4+"_"+hr1_2;
								var clickValue = "update_con('"+b1_2+"_"+b1_4+"','"+b1_2+"_"+hr1_1+"_"+b1_4+"_"+hr1_2+"','"+hr1_1+"_"+hr1_2+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_2+"','"+b1_4+"','0','0','2','"+hr1_1+"','"+hr1_2+"','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					//pfeil nach rechts 2
					if (document.getElementById(b1_2+"_"+b1_4) && document.getElementById(hr1_1+"_"+hr1_2)) {
								var	classValue = IdSearch_Class(hr1_1+"_"+hr1_2); var	absolute = IdSearch_Absolute(hr1_1+"_"+hr1_2);

								var addValue = hr1_1+"_"+hr1_2+"__"+b1_2+"_"+hr1_1+"_"+b1_4+"_"+hr1_2;
								var clickValue = "update_con('"+hr1_1+"_"+hr1_2+"','"+b1_2+"_"+hr1_1+"_"+b1_4+"_"+hr1_2+"','"+b1_2+"_"+b1_4+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_2+"','"+b1_4+"','0','0','2','"+hr1_1+"','"+hr1_2+"','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}


					//pfeil nach rechts horizontal
					if (document.getElementById(b1_3+"_"+b1_4) && document.getElementById(hr1_2)) {
								var	classValue = IdSearch_Class(b1_3+"_"+b1_4); var	absolute = IdSearch_Absolute(b1_3+"_"+b1_4);

								var addValue = b1_3+"_"+b1_4+"__"+b1_3+"_"+b1_4+"_"+hr1_2;
								var clickValue = "update_con('"+b1_3+"_"+b1_4+"','"+b1_3+"_"+b1_4+"_"+hr1_2+"','"+hr1_2+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_3+"','"+b1_4+"','0','0','1','"+hr1_2+"','0','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					//pfeil nach rechts horizontal 2
					if (document.getElementById(b1_3+"_"+b1_4) && document.getElementById(hr1_2)) {
								var	classValue = IdSearch_Class(hr1_2); var	absolute = IdSearch_Absolute(hr1_2);

								var addValue = hr1_2+"__"+b1_3+"_"+b1_4+"_"+hr1_2;
								var clickValue = "update_con('"+hr1_2+"','"+b1_3+"_"+b1_4+"_"+hr1_2+"','"+b1_3+"_"+b1_4+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_3+"','"+b1_4+"','0','0','1','"+hr1_2+"','0','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}


					//pfeil nach unten
					if (document.getElementById(b1_3+"_"+b1_4) && document.getElementById(vd1_1+"_"+vd1_2)) {
								var	classValue = IdSearch_Class(b1_3+"_"+b1_4); var	absolute = IdSearch_Absolute(b1_3+"_"+b1_4);

								var addValue = b1_3+"_"+b1_4+"__"+b1_3+"_"+b1_4+"_"+vd1_1+"_"+vd1_2;
								var clickValue = "update_con('"+b1_3+"_"+b1_4+"','"+b1_3+"_"+b1_4+"_"+vd1_1+"_"+vd1_2+"','"+vd1_1+"_"+vd1_2+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_3+"','"+b1_4+"','0','0','2','"+vd1_1+"','"+vd1_2+"','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					//pfeil nach unten 2
					if (document.getElementById(b1_3+"_"+b1_4) && document.getElementById(vd1_1+"_"+vd1_2)) {
								var	classValue = IdSearch_Class(vd1_1+"_"+vd1_2); var	absolute = IdSearch_Absolute(vd1_1+"_"+vd1_2);

								var addValue = vd1_1+"_"+vd1_2+"__"+b1_3+"_"+b1_4+"_"+vd1_1+"_"+vd1_2;
								var clickValue = "update_con('"+vd1_1+"_"+vd1_2+"','"+b1_3+"_"+b1_4+"_"+vd1_1+"_"+vd1_2+"','"+b1_3+"_"+b1_4+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_3+"','"+b1_4+"','0','0','2','"+vd1_1+"','"+vd1_2+"','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}


					//pfeil nach links horizontal
					if (document.getElementById(b1_3+"_"+b1_4) && document.getElementById(hl1_2)) {
								var	classValue = IdSearch_Class(b1_3+"_"+b1_4); var	absolute = IdSearch_Absolute(b1_3+"_"+b1_4);

								var addValue = b1_3+"_"+b1_4+"__"+hl1_2+"_"+b1_3+"_"+b1_4;
								var clickValue = "update_con('"+b1_3+"_"+b1_4+"','"+hl1_2+"_"+b1_3+"_"+b1_4+"','"+hl1_2+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_3+"','"+b1_4+"','0','0','1','"+hl1_2+"','0','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					//pfeil nach links horizontal 2
					if (document.getElementById(b1_3+"_"+b1_4) && document.getElementById(hl1_2)) {
								var	classValue = IdSearch_Class(hl1_2); var	absolute = IdSearch_Absolute(hl1_2);

								var addValue = hl1_2+"__"+hl1_2+"_"+b1_3+"_"+b1_4;
								var clickValue = "update_con('"+hl1_2+"','"+hl1_2+"_"+b1_3+"_"+b1_4+"','"+b1_3+"_"+b1_4+"','hidden','"+classValue+"','"+absolute+"','2','"+b1_3+"','"+b1_4+"','0','0','1','"+hl1_2+"','0','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}


					//con button erstellen ende

				} //ende gross1 = 4


				/*====================================
				======================================
				=============gross1 = 6 ==============
				======================================
				======================================
				======================================*/


			if(gross1 == '6'){

				//pos1
					var b1_1 = l1_1;
					var b1_2 = l1_2;
					var b1_3 = l1_3;
					var b1_4 = l1_4;
					var b1_5 = l1_5;
					var b1_6 = l1_6;

					//cut button erstellen
					if (document.getElementById(b1_1+"_"+b1_4)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b1_4); var absolute = IdSearch_Absolute(b1_1+"_"+b1_4);

								var addValue = b1_1+"_"+b1_4+"__"+b1_4;
								var clickValue = "[update_cut('"+b1_1+"_"+b1_4+"','"+b1_4+"','leer','"+b1_1+"','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_4+"','0','0','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					if (document.getElementById(b1_1+"_"+b1_4)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b1_4); var absolute = IdSearch_Absolute(b1_1+"_"+b1_4);

								var addValue = b1_1+"_"+b1_4+"__"+b1_1;
								var clickValue = "[update_cut('"+b1_1+"_"+b1_4+"','"+b1_1+"','leer','"+b1_4+"','"+classValue+"','"+absolute+"','2','"+b1_1+"','"+b1_4+"','0','0','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}



					if (document.getElementById(b1_3+"_"+b1_6)) {
								var	classValue = IdSearch_Class(b1_3+"_"+b1_6); var absolute = IdSearch_Absolute(b1_3+"_"+b1_6);

								var addValue = b1_3+"_"+b1_6+"__"+b1_6;
								var clickValue = "[update_cut('"+b1_3+"_"+b1_6+"','"+b1_6+"','leer','"+b1_3+"','"+classValue+"','"+absolute+"','2','"+b1_3+"','"+b1_6+"','0','0','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					if (document.getElementById(b1_3+"_"+b1_6)) {
								var	classValue = IdSearch_Class(b1_3+"_"+b1_6); var absolute = IdSearch_Absolute(b1_3+"_"+b1_6);

								var addValue = b1_3+"_"+b1_6+"__"+b1_3;
								var clickValue = "[update_cut('"+b1_3+"_"+b1_6+"','"+b1_3+"','leer','"+b1_6+"','"+classValue+"','"+absolute+"','2','"+b1_3+"','"+b1_6+"','0','0','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}




					if (document.getElementById(b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5); var absolute = IdSearch_Absolute(b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5);

								var addValue = b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5+"__"+b1_4+"_"+b1_5;
								var clickValue = "[update_cut('"+b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5+"','"+b1_4+"_"+b1_5+"','leer','"+b1_1+"_"+b1_2+"','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b1_2+"','"+b1_4+"','"+b1_5+"','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					if (document.getElementById(b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5); var absolute = IdSearch_Absolute(b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5);

								var addValue = b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5+"__"+b1_1+"_"+b1_2;
								var clickValue = "[update_cut('"+b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5+"','"+b1_1+"_"+b1_2+"','leer','"+b1_4+"_"+b1_5+"','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b1_2+"','"+b1_4+"','"+b1_5+"','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					if (document.getElementById(b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5); var absolute = IdSearch_Absolute(b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5);

								var addValue = b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5+"__"+b1_1+"_"+b1_4;
								var clickValue = "[update_cut('"+b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5+"','"+b1_1+"_"+b1_4+"','leer','"+b1_2+"_"+b1_5+"','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b1_2+"','"+b1_4+"','"+b1_5+"','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					if (document.getElementById(b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5); var absolute = IdSearch_Absolute(b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5);

								var addValue = b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5+"__"+b1_2+"_"+b1_5;
								var clickValue = "[update_cut('"+b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5+"','"+b1_2+"_"+b1_5+"','leer','"+b1_1+"_"+b1_4+"','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b1_2+"','"+b1_4+"','"+b1_5+"','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}



					if (document.getElementById(b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6)) {
								var	classValue = IdSearch_Class(b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6); var absolute = IdSearch_Absolute(b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6);

								var addValue = b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6+"__"+b1_5+"_"+b1_6;
								var clickValue = "[update_cut('"+b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6+"','"+b1_5+"_"+b1_6+"','leer','"+b1_2+"_"+b1_3+"','"+classValue+"','"+absolute+"','4','"+b1_2+"','"+b1_3+"','"+b1_5+"','"+b1_6+"','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					if (document.getElementById(b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6)) {
								var	classValue = IdSearch_Class(b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6); var absolute = IdSearch_Absolute(b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6);

								var addValue = b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6+"__"+b1_2+"_"+b1_3;
								var clickValue = "[update_cut('"+b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6+"','"+b1_2+"_"+b1_3+"','leer','"+b1_5+"_"+b1_6+"','"+classValue+"','"+absolute+"','4','"+b1_2+"','"+b1_3+"','"+b1_5+"','"+b1_6+"','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					if (document.getElementById(b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6)) {
								var	classValue = IdSearch_Class(b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6); var absolute = IdSearch_Absolute(b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6);

								var addValue = b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6+"__"+b1_2+"_"+b1_5;
								var clickValue = "[update_cut('"+b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6+"','"+b1_2+"_"+b1_5+"','leer','"+b1_3+"_"+b1_6+"','"+classValue+"','"+absolute+"','4','"+b1_2+"','"+b1_3+"','"+b1_5+"','"+b1_6+"','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					if (document.getElementById(b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6)) {
								var	classValue = IdSearch_Class(b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6); var absolute = IdSearch_Absolute(b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6);

								var addValue = b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6+"__"+b1_3+"_"+b1_6;
								var clickValue = "[update_cut('"+b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6+"','"+b1_3+"_"+b1_6+"','leer','"+b1_2+"_"+b1_5+"','"+classValue+"','"+absolute+"','4','"+b1_2+"','"+b1_3+"','"+b1_5+"','"+b1_6+"','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}




					if (document.getElementById(b1_1+"_"+b1_2+"_"+b1_3)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b1_2+"_"+b1_3); var absolute = IdSearch_Absolute(b1_1+"_"+b1_2+"_"+b1_3);

								var addValue = b1_1+"_"+b1_2+"_"+b1_3+"__"+b1_1;
								var clickValue = "[update_cut('"+b1_1+"_"+b1_2+"_"+b1_3+"','"+b1_1+"_"+b1_2+"','leer','"+b1_3+"','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b1_2+"','"+b1_3+"','0','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					if (document.getElementById(b1_1+"_"+b1_2+"_"+b1_3)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b1_2+"_"+b1_3); var absolute = IdSearch_Absolute(b1_1+"_"+b1_2+"_"+b1_3);

								var addValue = b1_1+"_"+b1_2+"_"+b1_3+"__"+b1_2;
								var clickValue = "[update_cut('"+b1_1+"_"+b1_2+"_"+b1_3+"','"+b1_2+"_"+b1_3+"','leer','"+b1_1+"','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b1_2+"','"+b1_3+"','0','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					if (document.getElementById(b1_4+"_"+b1_5+"_"+b1_6)) {
								var	classValue = IdSearch_Class(b1_4+"_"+b1_5+"_"+b1_6); var absolute = IdSearch_Absolute(b1_4+"_"+b1_5+"_"+b1_6);

								var addValue = b1_4+"_"+b1_5+"_"+b1_6+"__"+b1_4;
								var clickValue = "[update_cut('"+b1_4+"_"+b1_5+"_"+b1_6+"','"+b1_4+"_"+b1_5+"','leer','"+b1_6+"','"+classValue+"','"+absolute+"','3','"+b1_4+"','"+b1_5+"','"+b1_6+"','0','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					if (document.getElementById(b1_4+"_"+b1_5+"_"+b1_6)) {
								var	classValue = IdSearch_Class(b1_4+"_"+b1_5+"_"+b1_6); var absolute = IdSearch_Absolute(b1_4+"_"+b1_5+"_"+b1_6);

								var addValue = b1_4+"_"+b1_5+"_"+b1_6+"__"+b1_5;
								var clickValue = "[update_cut('"+b1_4+"_"+b1_5+"_"+b1_6+"','"+b1_5+"_"+b1_6+"','leer','"+b1_4+"','"+classValue+"','"+absolute+"','3','"+b1_4+"','"+b1_5+"','"+b1_6+"','0','0','0')]";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "cut glyphicon glyphicon-chevron-right cut_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}



					//cut button erstellen ende

					if(b1_1 != 'a' )							{var hl1_1 = String.fromCharCode(b1_1.charCodeAt(0)-1);}
					if(b1_3 != 'a' )							{var hl1_2 = String.fromCharCode(b1_4.charCodeAt(0)-1);}
					if(b1_1 != 'a' || b1_1 != 'b' || b1_1 != 'C'){var vu1_1 = String.fromCharCode(b1_1.charCodeAt(0)-3);}
					if(b1_2 != 'a' || b1_2 != 'b' || b1_2 != 'C'){var vu1_2 = String.fromCharCode(b1_2.charCodeAt(0)-3);}
					if(b1_3 != 'a' || b1_3 != 'b' || b1_3 != 'C'){var vu1_3 = String.fromCharCode(b1_3.charCodeAt(0)-3);}
					if(b1_4 != 'v' || b1_4 != 'w' || b1_4 != 'x'){var vd1_1 = String.fromCharCode(b1_4.charCodeAt(0)+3);}
					if(b1_5 != 'v' || b1_5 != 'w' || b1_5 != 'x'){var vd1_2 = String.fromCharCode(b1_5.charCodeAt(0)+3);}
					if(b1_6 != 'v' || b1_6 != 'w' || b1_6 != 'x'){var vd1_3 = String.fromCharCode(b1_6.charCodeAt(0)+3);}
					if(b1_2 != 'x' )							{var hr1_1 = String.fromCharCode(b1_3.charCodeAt(0)+1);}
					if(b1_4 != 'x' )							{var hr1_2 = String.fromCharCode(b1_6.charCodeAt(0)+1);}

					//con button erstellen

					//pos1

					//pfeil nach oben
					if (document.getElementById(b1_1+"_"+b1_2+"_"+b1_3) && document.getElementById(vu1_1+"_"+vu1_2+"_"+vu1_3)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b1_2+"_"+b1_3); var	absolute = IdSearch_Absolute(b1_1+"_"+b1_2+"_"+b1_3);

								var addValue = b1_1+"_"+b1_2+"_"+b1_3+"__"+vu1_1+"_"+vu1_2+"_"+vu1_3+"_"+b1_1+"_"+b1_2+"_"+b1_3;
								var clickValue = "update_con('"+b1_1+"_"+b1_2+"_"+b1_3+"','"+vu1_1+"_"+vu1_2+"_"+vu1_3+"_"+b1_1+"_"+b1_2+"_"+b1_3+"','"+vu1_1+"_"+vu1_2+"_"+vu1_3+"','hidden','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b1_2+"','"+b1_3+"','0','3','"+vu1_1+"','"+vu1_2+"','"+vu1_3+"','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					//pfeil nach oben 2
					if (document.getElementById(b1_1+"_"+b1_2+"_"+b1_3) && document.getElementById(vu1_1+"_"+vu1_2+"_"+vu1_3)) {
								var	classValue = IdSearch_Class(vu1_1+"_"+vu1_2+"_"+vu1_3); var	absolute = IdSearch_Absolute(vu1_1+"_"+vu1_2+"_"+vu1_3);

								var addValue = vu1_1+"_"+vu1_2+"_"+vu1_3+"__"+vu1_1+"_"+vu1_2+"_"+vu1_3+"_"+b1_1+"_"+b1_2+"_"+b1_3;
								var clickValue = "update_con('"+vu1_1+"_"+vu1_2+"_"+vu1_3+"','"+vu1_1+"_"+vu1_2+"_"+vu1_3+"_"+b1_1+"_"+b1_2+"_"+b1_3+"','"+b1_1+"_"+b1_2+"_"+b1_3+"','hidden','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b1_2+"','"+b1_3+"','0','3','"+vu1_1+"','"+vu1_2+"','"+vu1_3+"','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}



					//pfeil nach unten
					if (document.getElementById(b1_1+"_"+b1_2+"_"+b1_3) && document.getElementById(b1_4+"_"+b1_5+"_"+b1_6)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b1_2+"_"+b1_3); var	absolute = IdSearch_Absolute(b1_1+"_"+b1_2+"_"+b1_3);

								var addValue = b1_1+"_"+b1_2+"_"+b1_3+"__"+b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"_"+b1_5+"_"+b1_6;
								var clickValue = "update_con('"+b1_1+"_"+b1_2+"_"+b1_3+"','"+b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"_"+b1_5+"_"+b1_6+"','"+b1_4+"_"+b1_5+"_"+b1_6+"','hidden','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b1_2+"','"+b1_3+"','0','3','"+b1_4+"','"+b1_5+"','"+b1_6+"','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					//pfeil nach unten 2
					if (document.getElementById(b1_1+"_"+b1_2+"_"+b1_3) && document.getElementById(b1_4+"_"+b1_5+"_"+b1_6)) {
								var	classValue = IdSearch_Class(b1_4+"_"+b1_5+"_"+b1_6); var	absolute = IdSearch_Absolute(b1_4+"_"+b1_5+"_"+b1_6);

								var addValue = b1_4+"_"+b1_5+"_"+b1_6+"__"+b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"_"+b1_5+"_"+b1_6;
								var clickValue = "update_con('"+b1_4+"_"+b1_5+"_"+b1_6+"','"+b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"_"+b1_5+"_"+b1_6+"','"+b1_1+"_"+b1_2+"_"+b1_3+"','hidden','"+classValue+"','"+absolute+"','3','"+b1_1+"','"+b1_2+"','"+b1_3+"','0','3','"+b1_4+"','"+b1_5+"','"+b1_6+"','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}



					//pfeil rechts
					if (document.getElementById(b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5) && document.getElementById(b1_3+"_"+b1_6)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5); var	absolute = IdSearch_Absolute(b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5);

								var addValue = b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5+"__"+b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"_"+b1_5+"_"+b1_6;
								var clickValue = "update_con('"+b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5+"','"+b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"_"+b1_5+"_"+b1_6+"','"+b1_3+"_"+b1_6+"','hidden','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b1_2+"','"+b1_4+"','"+b1_5+"','2','"+b1_3+"','"+b1_6+"','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					//pfeil rechts 2
					if (document.getElementById(b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5) && document.getElementById(b1_3+"_"+b1_6)) {
								var	classValue = IdSearch_Class(b1_3+"_"+b1_6); var	absolute = IdSearch_Absolute(b1_3+"_"+b1_6);

								var addValue = b1_3+"_"+b1_6+"__"+b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"_"+b1_5+"_"+b1_6;
								var clickValue = "update_con('"+b1_3+"_"+b1_6+"','"+b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"_"+b1_5+"_"+b1_6+"','"+b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5+"','hidden','"+classValue+"','"+absolute+"','4','"+b1_1+"','"+b1_2+"','"+b1_4+"','"+b1_5+"','2','"+b1_3+"','"+b1_6+"','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}


					//pfeil links
					if (document.getElementById(b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6) && document.getElementById(b1_1+"_"+b1_4)) {
								var	classValue = IdSearch_Class(b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6); var	absolute = IdSearch_Absolute(b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6);

								var addValue = b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6+"__"+b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"_"+b1_5+"_"+b1_6;
								var clickValue = "update_con('"+b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6+"','"+b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"_"+b1_5+"_"+b1_6+"','"+b1_1+"_"+b1_4+"','hidden','"+classValue+"','"+absolute+"','4','"+b1_2+"','"+b1_3+"','"+b1_5+"','"+b1_6+"','2','"+b1_1+"','"+b1_4+"','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					//pfeil links 2
					if (document.getElementById(b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6) && document.getElementById(b1_1+"_"+b1_4)) {
								var	classValue = IdSearch_Class(b1_1+"_"+b1_4); var	absolute = IdSearch_Absolute(b1_1+"_"+b1_4);

								var addValue = b1_1+"_"+b1_4+"__"+b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"_"+b1_5+"_"+b1_6;
								var clickValue = "update_con('"+b1_1+"_"+b1_4+"','"+b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"_"+b1_5+"_"+b1_6+"','"+b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6+"','hidden','"+classValue+"','"+absolute+"','4','"+b1_2+"','"+b1_3+"','"+b1_5+"','"+b1_6+"','2','"+b1_1+"','"+b1_4+"','0','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}




					//pos2

					//pfeil nach unten
					if (document.getElementById(b1_4+"_"+b1_5+"_"+b1_6) && document.getElementById(vd1_1+"_"+vd1_2+"_"+vd1_3)) {
								var	classValue = IdSearch_Class(b1_4+"_"+b1_5+"_"+b1_6); var	absolute = IdSearch_Absolute(b1_4+"_"+b1_5+"_"+b1_6);

								var addValue = b1_4+"_"+b1_5+"_"+b1_6+"__"+b1_4+"_"+b1_5+"_"+b1_6+"_"+vd1_1+"_"+vd1_2+"_"+vd1_3;
								var clickValue = "update_con('"+b1_4+"_"+b1_5+"_"+b1_6+"','"+b1_4+"_"+b1_5+"_"+b1_6+"_"+vd1_1+"_"+vd1_2+"_"+vd1_3+"','"+vd1_1+"_"+vd1_2+"_"+vd1_3+"','hidden','"+classValue+"','"+absolute+"','3','"+b1_4+"','"+b1_5+"','"+b1_6+"','0','3','"+vd1_1+"','"+vd1_2+"','"+vd1_3+"','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

					//pfeil nach unten 2
					if (document.getElementById(b1_4+"_"+b1_5+"_"+b1_6) && document.getElementById(vd1_1+"_"+vd1_2+"_"+vd1_3)) {
								var	classValue = IdSearch_Class(vd1_1+"_"+vd1_2+"_"+vd1_3); var	absolute = IdSearch_Absolute(vd1_1+"_"+vd1_2+"_"+vd1_3);

								var addValue = vd1_1+"_"+vd1_2+"_"+vd1_3+"__"+b1_4+"_"+b1_5+"_"+b1_6+"_"+vd1_1+"_"+vd1_2+"_"+vd1_3;
								var clickValue = "update_con('"+vd1_1+"_"+vd1_2+"_"+vd1_3+"','"+b1_4+"_"+b1_5+"_"+b1_6+"_"+vd1_1+"_"+vd1_2+"_"+vd1_3+"','"+b1_4+"_"+b1_5+"_"+b1_6+"','hidden','"+classValue+"','"+absolute+"','3','"+b1_4+"','"+b1_5+"','"+b1_6+"','0','3','"+vd1_1+"','"+vd1_2+"','"+vd1_3+"','0')";
								var BoxDiv = document.createElement("div"); var BoxValue = document.createTextNode(""); BoxDiv.id = addValue; BoxDiv.className = "con glyphicon glyphicon-chevron-right con_arrow "+addValue; BoxDiv.appendChild(BoxValue); var Ausgabebereich = document.getElementById("main"); Ausgabebereich.appendChild(BoxDiv); document.getElementById(addValue).setAttribute( "onClick", clickValue );
					}

			} //ende gross1 = 6
}


//===============================================================================================================
//===============================================================================================================
//===============================================================================================================
//======================================= Button Delete ===== ===================================================
//===============================================================================================================
//===============================================================================================================
//===============================================================================================================


function ButtonsDel(gross1,l1_1,l1_2,l1_3,l1_4,l1_5,l1_6,gross2,l2_1,l2_2,l2_3,l2_4){

						//Generator
						//b1 = Base1 also die pos1
						//hl1 = horizontal1 left also die pos1 - 2 nach links
						//hl2 = horizontal2 left also die pos1 - 1 nach links
						//hl3 = horizontal3 left also die pos1 - 2 nach links und -1 nach unten
						//hl4 = horizontal4 left also die pos1 - 1 nach links und -1 nach unten
						//vd1 = vertical1 down also die pos1 - 1 nach unten
						//vu1 = vertical1 up also die pos1 + 1 nach oben
						//hr1 = horizontal1 right also die pos1 + 1 nach rechts
						//hr2 = horizontal2 right also die pos1 + 2 nach rechts
						//hr3 = horizontal3 right also die pos1 + 1 nach rechts und -1 nach unten
						//hr4 = horizontal4 right also die pos1 + 2 nach rechts und -1 nach unten



						//pos1
							if(gross1 == '1'){

								//pos1
									var b2_1 = l1_1;
										if(b2_1 != 'a' || b2_1 != 'b'){var hl1_1 = String.fromCharCode(b2_1.charCodeAt(0)-2);}
										if(b2_1 != 'a' )							{var hl1_2 = String.fromCharCode(b2_1.charCodeAt(0)-1);}
										if(b2_1 != 'a' || b2_1 != 'b' || b2_1 != 'c'){var vu1_1 = String.fromCharCode(b2_1.charCodeAt(0)-3);}
										if(b2_1 != 'v' || b2_1 != 'w' || b2_1 != 'x'){var vd1_1 = String.fromCharCode(b2_1.charCodeAt(0)+3);}
										if(b2_1 != 'x' || b2_1 != 'w'){var hr1_1 = String.fromCharCode(b2_1.charCodeAt(0)+1);}
										if(b2_1 != 'w')								{var hr1_2 = String.fromCharCode(b2_1.charCodeAt(0)+2);}

										//löschen der 'alten' Pfeile bei pos1
											//pfeil nach oben
											var delValue = b2_1+"__"+vu1_1+"_"+b2_1;
											if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

											//pfeil nach oben 2
											var delValue = vu1_1+"__"+vu1_1+"_"+b2_1;
											if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


											//pfeil nach links
											var delValue = b2_1+"__"+hl1_2+"_"+b2_1;
											if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

											//pfeil nach links 2
											var delValue = hl1_2+"__"+hl1_2+"_"+b2_1;
											if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

											//pfeil nach links (wenn das eine zweier box ist)
											var delValue = b2_1+"__"+hl1_1+"_"+hl1_2+"_"+b2_1;
											if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

											//pfeil nach links (wenn das eine zweier box ist) 2 rechts
											var delValue = hl1_1+"_"+hl1_2+"__"+hl1_1+"_"+hl1_2+"_"+b2_1;
											if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


											//pfeil nach unten
											var delValue = b2_1+"__"+b2_1+"_"+vd1_1;
											if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

											//pfeil nach unten 2
											var delValue = vd1_1+"__"+b2_1+"_"+vd1_1;
											if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


											//pfeil nach rechts
											var delValue = b2_1+"__"+b2_1+"_"+hr1_1;
											if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

											//pfeil nach rechts 2
											var delValue = hr1_1+"__"+b2_1+"_"+hr1_1;
											if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

											//pfeil nach rechts (wenn das eine zweier box ist)
											var delValue = b2_1+"__"+b2_1+"_"+hr1_1+"_"+hr1_2;
											if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

											//pfeil nach rechts (wenn das eine zweier box ist) 2 links
											var delValue = hr1_1+"_"+hr1_2+"__"+b2_1+"_"+hr1_1+"_"+hr1_2;
											if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


								//pos2
									if(gross2 == '1'){
										var b2_1 = l2_1;

											if(b2_1 != 'a' || b2_1 != 'b'){var hl2_1 = String.fromCharCode(b2_1.charCodeAt(0)-2);}
											if(b2_1 != 'a' )							{var hl2_2 = String.fromCharCode(b2_1.charCodeAt(0)-1);}
											if(b2_1 != 'a' || b2_1 != 'b' || b2_1 != 'c'){var vu2_1 = String.fromCharCode(b2_1.charCodeAt(0)-3);}
											if(b2_1 != 'v' || b2_1 != 'w' || b2_1 != 'x'){var vd2_1 = String.fromCharCode(b2_1.charCodeAt(0)+3);}
											if(b2_1 != 'x' || b2_1 != 'w'){var hr2_1 = String.fromCharCode(b2_1.charCodeAt(0)+1);}
											if(b2_1 != 'w')								{var hr2_2 = String.fromCharCode(b2_1.charCodeAt(0)+2);}

											//löschen der 'alten' Pfeile bei pos2
												//pfeil nach oben
												var delValue = b2_1+"__"+vu2_1+"_"+b2_1;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

												//pfeil nach oben 2
												var delValue = vu2_1+"__"+vu2_1+"_"+b2_1;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


												//pfeil nach links
												var delValue = b2_1+"__"+hl2_2+"_"+b2_1;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

												//pfeil nach links 2
												var delValue = hl2_2+"__"+hl2_2+"_"+b2_1;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

												//pfeil nach links (wenn das eine zweier box ist)
												var delValue = b2_1+"__"+hl2_1+"_"+hl2_2+"_"+b2_1;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

												//pfeil nach links (wenn das eine zweier box ist) 2 anch rechts
												var delValue = hl2_1+"_"+hl2_2+"__"+hl2_1+"_"+hl2_2+"_"+b2_1;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}



												//pfeil nach unten
												var delValue = b2_1+"__"+b2_1+"_"+vd2_1;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

												//pfeil nach unten 2
												var delValue = vd2_1+"__"+b2_1+"_"+vd2_1;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


												//pfeil nach rechts
												var delValue = b2_1+"__"+b2_1+"_"+hr2_1;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

												//pfeil nach rechts 2
												var delValue = hr2_1+"__"+b2_1+"_"+hr2_1;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

												//pfeil nach rechts (wenn das eine zweier box ist)
												var delValue = b2_1+"__"+b2_1+"_"+hr2_1+"_"+hr2_2;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

												//pfeil nach rechts (wenn das eine zweier box ist) 2 links
												var delValue = hr2_1+"_"+hr2_2+"__"+b2_1+"_"+hr2_1+"_"+hr2_2;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

									}//pos2 == 1 ende

										if(gross2 == '2'){
											var b2_1 = l2_1;
											var b2_2 = l2_2;

												if(b2_1 != 'a' || b2_1 != 'b'){var hl2_1 = String.fromCharCode(b2_1.charCodeAt(0)-2);}
												if(b2_1 != 'a' )							{var hl2_2 = String.fromCharCode(b2_1.charCodeAt(0)-1);}
												if(b2_1 != 'a' || b2_1 != 'b' || b2_1 != 'c'){var vu2_1 = String.fromCharCode(b2_1.charCodeAt(0)-3);}
												if(b2_2 != 'a' || b2_2 != 'b' || b2_2 != 'c'){var vu2_2 = String.fromCharCode(b2_2.charCodeAt(0)-3);}
												if(b2_1 != 'v' || b2_1 != 'w' || b2_1 != 'x'){var vd2_1 = String.fromCharCode(b2_1.charCodeAt(0)+3);}
												if(b2_2 != 'v' || b2_2 != 'w' || b2_2 != 'x'){var vd2_2 = String.fromCharCode(b2_2.charCodeAt(0)+3);}
												if(b2_1 != 'x' || b2_1 != 'w'){var hr2_1 = String.fromCharCode(b2_1.charCodeAt(0)+1);}
												if(b2_1 != 'w')								{var hr2_2 = String.fromCharCode(b2_1.charCodeAt(0)+2);}

												//löschen der 'alten' Pfeile bei pos2
													//pfeil nach oben
													var delValue = b2_1+"_"+b2_2+"__"+vu2_1+"_"+vu2_2+"_"+b2_1+"_"+b2_2;
													if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


													//pfeil nach oben 2 (wenn horizontal)
													var delValue = vu2_1+"_"+vu2_2+"__"+vu2_1+"_"+vu2_2+"_"+b2_1+"_"+b2_2;
													if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

													//pfeil nach links
													var delValue = b2_1+"_"+b2_2+"__"+hl2_2+"_"+b2_1+"_"+b2_2;
													if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


													//pfeil nach unten
													var delValue = b2_1+"_"+b2_2+"__"+b2_1+"_"+b2_2+"_"+vd2_1+"_"+vd2_2;
													if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

													//pfeil nach unten 2 (wenn horizontal)
													var delValue = vd2_1+"_"+vd2_2+"__"+b2_1+"_"+b2_2+"_"+vd2_1+"_"+vd2_2;
													if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

													//pfeil nach rechts
													var delValue = b2_1+"_"+b2_2+"__"+b2_1+"_"+b2_2+"_"+hr2_2;
													if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


													//Cut pfeil 1
													var delValue = b2_1+"_"+b2_2+"__"+b2_1;
													if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

													//Cut pfeil 2
													var delValue = b2_1+"_"+b2_2+"__"+b2_2;
													if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

										}
								} // ende gross 1 = 1

//=================================================================================================================================================
//=================================================================================================================================================
//========================== Erste Position zwei gross ============================================================================================
//=================================================================================================================================================
//=================================================================================================================================================

								if( gross1 == '2'){

									//pos1
										var b2_1 = l1_1;
										var b1_3 = l1_2;

											if(b2_1 != 'a' || b2_1 != 'b'){var hl1_1 = String.fromCharCode(b2_1.charCodeAt(0)-2);}
											if(b2_1 != 'a' )							{var hl1_2 = String.fromCharCode(b2_1.charCodeAt(0)-1);}
											if(b1_3 != 'a' || b1_3 != 'b'){var hl1_3 = String.fromCharCode(b1_3.charCodeAt(0)-2);}
											if(b1_3 != 'a' )							{var hl1_4 = String.fromCharCode(b1_3.charCodeAt(0)-1);}
											if(b2_1 != 'a' || b2_1 != 'b' || b2_1 != 'c'){var vu1_1 = String.fromCharCode(b2_1.charCodeAt(0)-3);}
											if(b1_3 != 'a' || b1_3 != 'b' || b1_3 != 'c'){var vu1_2 = String.fromCharCode(b1_3.charCodeAt(0)-3);}
											if(b2_1 != 'v' || b2_1 != 'w' || b2_1 != 'x'){var vd1_1 = String.fromCharCode(b2_1.charCodeAt(0)+3);}
											if(b1_3 != 'v' || b1_3 != 'w' || b1_3 != 'x'){var vd1_2 = String.fromCharCode(b1_3.charCodeAt(0)+3);}
											if(b2_1 != 'x' || b2_1 != 'w'){var hr1_1 = String.fromCharCode(b2_1.charCodeAt(0)+1);}
											if(b2_1 != 'w')								{var hr1_2 = String.fromCharCode(b2_1.charCodeAt(0)+2);}
											if(b1_3 != 'x' || b1_3 != 'w'){var hr1_3 = String.fromCharCode(b1_3.charCodeAt(0)+1);}
											if(b1_3 != 'w')								{var hr1_4 = String.fromCharCode(b1_3.charCodeAt(0)+2);}

											//löschen der 'alten' Pfeile bei pos1
												//pfeil nach oben
												var delValue = b2_1+"_"+b1_3+"__"+vu1_1+"_"+vu1_2+"_"+b2_1+"_"+b1_3;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

												//pfeil nach oben 2 (wenn horizontal)
												var delValue = vu1_1+"_"+vu1_2+"__"+vu1_1+"_"+vu1_2+"_"+b2_1+"_"+b1_3;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


												//pfeil nach links (wenn horizontal)
												var delValue = b2_1+"_"+b1_3+"__"+hl1_2+"_"+b2_1+"_"+b1_3;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

												//pfeil nach links 2 (wenn horizontal)
												var delValue = hl1_2+"__"+hl1_2+"_"+b2_1+"_"+b1_3;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

												//pfeil nach links (wenn vertikal)
												var delValue = b2_1+"_"+b1_3+"__"+hl1_2+"_"+b2_1+"_"+hl1_4+"_"+b1_3;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

												//pfeil nach links 2 (wenn vertikal)
												var delValue = hl1_2+"_"+hl1_4+"__"+hl1_2+"_"+b2_1+"_"+hl1_4+"_"+b1_3;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

												//pfeil nach links (wenn vertikal 4)
												var delValue = b2_1+"_"+b1_3+"__"+hl1_1+"_"+hl1_2+"_"+b2_1+"_"+hl1_3+"_"+hl1_4+"_"+b1_3;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


												//pfeil nach links 2(wenn vertikal 4)
												var delValue = hl1_1+"_"+hl1_2+"_"+hl1_3+"_"+hl1_4+"__"+hl1_1+"_"+hl1_2+"_"+b2_1+"_"+hl1_3+"_"+hl1_4+"_"+b1_3;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}



												//pfeil nach unten
												var delValue = b2_1+"_"+b1_3+"__"+b2_1+"_"+b1_3+"_"+vd1_1+"_"+vd1_2;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

												//pfeil nach unten 2 (wenn horizontal)
												var delValue = vd1_1+"_"+vd1_2+"__"+b2_1+"_"+b1_3+"_"+vd1_1+"_"+vd1_2;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


												//pfeil nach rechts (wenn horizontal)
												var delValue = b2_1+"_"+b1_3+"__"+b2_1+"_"+b1_3+"_"+hr1_2;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

												//pfeil nach rechts 2 (wenn horizontal)
												var delValue = hr1_2+"__"+b2_1+"_"+b1_3+"_"+hr1_2;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

												//pfeil nach rechts (wenn vertikal)
												var delValue = b2_1+"_"+b1_3+"__"+b2_1+"_"+hr1_1+"_"+b1_3+"_"+hr1_3;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

												//pfeil nach rechts 2(wenn vertikal)
												var delValue = hr1_1+"_"+hr1_3+"__"+b2_1+"_"+hr1_1+"_"+b1_3+"_"+hr1_3;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


												//pfeil nach rechts (wenn vertikal 4)
												var delValue = b2_1+"_"+b1_3+"__"+b2_1+"_"+hr1_1+"_"+hr1_2+"_"+b1_3+"_"+hr1_3+"_"+hr1_4;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

												//pfeil nach rechts 2 (wenn vertikal 4)
												var delValue = hr1_1+"_"+hr1_2+"_"+hr1_3+"_"+hr1_4+"__"+b2_1+"_"+hr1_1+"_"+hr1_2+"_"+b1_3+"_"+hr1_3+"_"+hr1_4;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}



												//Cut pfeil 1
												var delValue = b2_1+"_"+b1_3+"__"+b2_1;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

												//Cut pfeil 2
												var delValue = b2_1+"_"+b1_3+"__"+b1_3;
												if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


									//pos2
									if(gross2 == '1'){
											var b2_1 = l2_1;

												if(b2_1 != 'a' || b2_1 != 'b'){var hl2_1 = String.fromCharCode(b2_1.charCodeAt(0)-2);}
												if(b2_1 != 'a' )							{var hl2_2 = String.fromCharCode(b2_1.charCodeAt(0)-1);}
												if(b2_1 != 'a' || b2_1 != 'b' || b2_1 != 'c'){var vu2_1 = String.fromCharCode(b2_1.charCodeAt(0)-3);}
												if(b2_1 != 'v' || b2_1 != 'w' || b2_1 != 'x'){var vd2_1 = String.fromCharCode(b2_1.charCodeAt(0)+3);}
												if(b2_1 != 'x' )							{var hr2_1 = String.fromCharCode(b2_1.charCodeAt(0)+1);}
												if(b2_1 != 'w'|| b2_1 != 'w')	{var hr2_2 = String.fromCharCode(b2_1.charCodeAt(0)+2);}

												//löschen der 'alten' Pfeile bei pos2
													//pfeil nach oben
													var delValue = b2_1+"__"+vu2_1+"_"+b2_1;
													if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

													//pfeil nach oben 2
													var delValue = vu2_1+"__"+vu2_1+"_"+b2_1;
													if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

													//pfeil nach links
													var delValue = b2_1+"__"+hl2_1+"_"+hl2_2+"_"+b2_1;
													if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}



													//pfeil nach unten
													var delValue = b2_1+"__"+b2_1+"_"+vd2_1;
													if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

													//pfeil nach unten 2
													var delValue = vd2_1+"__"+b2_1+"_"+vd2_1;
													if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


													//pfeil nach rechts
													var delValue = b2_1+"__"+b2_1+"_"+hr2_1+"_"+hr2_2;
													if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


													//Cut pfeil 1
													var delValue = b2_1+"_"+b2_2+"__"+b2_1;
													if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

													//Cut pfeil 2
													var delValue = b2_1+"_"+b2_2+"__"+b2_2;
													if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

										}

											if(gross2 == '2'){
												var b2_1 = l2_1;
												var b2_2 = l2_2;

													if(b2_1 != 'a' || b2_1 != 'b'){var hl2_1 = String.fromCharCode(b2_1.charCodeAt(0)-2);}
													if(b2_1 != 'a' )							{var hl2_2 = String.fromCharCode(b2_1.charCodeAt(0)-1);}
													if(b2_2 != 'a' || b2_2 != 'b'){var hl2_3 = String.fromCharCode(b2_2.charCodeAt(0)-2);}
													if(b2_2 != 'a' )							{var hl2_4 = String.fromCharCode(b2_2.charCodeAt(0)-1);}
													if(b2_1 != 'a' || b2_1 != 'b' || b2_1 != 'c'){var vu2_1 = String.fromCharCode(b2_1.charCodeAt(0)-3);}
													if(b2_2 != 'a' || b2_2 != 'b' || b2_2 != 'c'){var vu2_2 = String.fromCharCode(b2_2.charCodeAt(0)-3);}
													if(b2_1 != 'v' || b2_1 != 'w' || b2_1 != 'x'){var vd2_1 = String.fromCharCode(b2_1.charCodeAt(0)+3);}
													if(b2_2 != 'v' || b2_2 != 'w' || b2_2 != 'x'){var vd2_2 = String.fromCharCode(b2_2.charCodeAt(0)+3);}
													if(b2_1 != 'x' || b2_1 != 'w'){var hr2_1 = String.fromCharCode(b2_1.charCodeAt(0)+1);}
													if(b2_1 != 'w')								{var hr2_2 = String.fromCharCode(b2_1.charCodeAt(0)+2);}
													if(b2_2 != 'x' || b2_2 != 'w'){var hr2_3 = String.fromCharCode(b2_2.charCodeAt(0)+1);}
													if(b2_2 != 'w')								{var hr2_4 = String.fromCharCode(b2_2.charCodeAt(0)+2);}

													//löschen der 'alten' Pfeile bei pos2
														//pfeil nach oben
														var delValue = b2_1+"_"+b2_2+"__"+vu2_1+"_"+vu2_2+"_"+b2_1+"_"+b2_2;
														if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

														//pfeil nach oben 2
														var delValue = vu2_1+"_"+vu2_2+"__"+vu2_1+"_"+vu2_2+"_"+b2_1+"_"+b2_2;
														if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


														//pfeil nach links (wenn horizontal)
														var delValue = b2_1+"_"+b2_2+"__"+hl2_2+"_"+b2_1+"_"+b2_2;
														if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

														//pfeil nach links 2 (wenn horizontal)
														var delValue = hl2_2+"__"+hl2_2+"_"+b2_1+"_"+b2_2;
														if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

														//pfeil nach links (wenn vertikal)
														var delValue = b2_1+"_"+b2_2+"__"+hl2_2+"_"+b2_1+"_"+hl2_4+"_"+b2_2;
														if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

														//pfeil nach links 2(wenn vertikal)
														var delValue = hl2_2+"_"+hl2_4+"__"+hl2_2+"_"+b2_1+"_"+hl2_4+"_"+b2_2;
														if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


														//pfeil nach unten
														var delValue = b2_1+"_"+b2_2+"__"+b2_1+"_"+b2_2+"_"+vd2_1+"_"+vd2_2;
														if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

														//pfeil nach unten 2
														var delValue = vd2_1+"_"+vd2_2+"__"+b2_1+"_"+b2_2+"_"+vd2_1+"_"+vd2_2;
														if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


														//pfeil nach rechts (wenn horizontal)
														var delValue = b2_1+"_"+b2_2+"__"+b2_1+"_"+b2_2+"_"+hr2_2;
														if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

														//pfeil nach rechts 2 (wenn horizontal)
														var delValue = hr2_2+"__"+b2_1+"_"+b2_2+"_"+hr2_2;
														if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

														//pfeil nach rechts (wenn vertikal)
														var delValue = b2_1+"_"+b2_2+"__"+b2_1+"_"+hr2_1+"_"+b2_2+"_"+hr2_3;
														if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

														//pfeil nach rechts 2 (wenn vertikal)
														var delValue = hr2_1+"_"+hr2_3+"__"+b2_1+"_"+hr2_1+"_"+b2_2+"_"+hr2_3;
														if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


														//Cut pfeil 1
														var delValue = b2_1+"_"+b2_2+"__"+b2_1;
														if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

														//Cut pfeil 2
														var delValue = b2_1+"_"+b2_2+"__"+b2_2;
														if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

											}



											if( gross2 == '4'){

												//pos1
													var b2_1 = l2_1;
													var b2_2 = l2_2;
													var b2_3 = l2_3;
													var b2_4 = l2_4;


														if(b2_1 != 'a' )							{var hl2_2 = String.fromCharCode(b2_1.charCodeAt(0)-1);}
														if(b2_3 != 'a' )							{var hl2_4 = String.fromCharCode(b2_3.charCodeAt(0)-1);}


														if(b2_1 != 'x' )							{var hr2_1 = String.fromCharCode(b2_2.charCodeAt(0)+1);}
														if(b2_3 != 'x' )							{var hr2_3 = String.fromCharCode(b2_4.charCodeAt(0)+1);}


														//löschen der 'alten' Pfeile bei pos1
															//pfeil nach rechts
															var delValue = b2_1+"_"+b2_2+"_"+b2_3+"_"+b2_4+"__"+b2_1+"_"+b2_2+"_"+hr2_1+"_"+b2_3+"_"+b2_4+"_"+hr2_3;
															if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

															//pfeil nach links
															var delValue = b2_1+"_"+b2_2+"_"+b2_3+"_"+b2_4+"__"+hl2_2+"_"+b2_1+"_"+b2_2+"_"+hl2_4+"_"+b2_3+"_"+b2_4;
															if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}



															//Cut pfeil 1
															var delValue = b2_1+"_"+b2_2+"_"+b2_3+"_"+b2_4+"__"+b2_3+"_"+b2_4;
															if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

															//Cut pfeil 2
															var delValue = b2_1+"_"+b2_2+"_"+b2_3+"_"+b2_4+"__"+b2_1+"_"+b2_3;
															if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

															//Cut pfeil 3
															var delValue = b2_1+"_"+b2_2+"_"+b2_3+"_"+b2_4+"__"+b2_1+"_"+b2_2;
															if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

															//Cut pfeil 4
															var delValue = b2_1+"_"+b2_2+"_"+b2_3+"_"+b2_4+"__"+b2_2+"_"+b2_4;
															if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}
												}


									} // ende gross1 = 2



									//=================================================================================================================================================
									//=================================================================================================================================================
									//========================== Erste Position drei gross ============================================================================================
									//=================================================================================================================================================
									//=================================================================================================================================================

													if( gross1 == '3'){

														//pos1
															var b1_1 = l1_1;
															var b1_2 = l1_2;
															var b1_3 = l1_3;


																if(b1_1 != 'a' || b2_1 != 'b' || b2_1 != 'c'){var vu1_1 = String.fromCharCode(b1_1.charCodeAt(0)-3);}
																if(b1_3 != 'a' || b1_3 != 'b' || b1_3 != 'c'){var vu1_2 = String.fromCharCode(b1_2.charCodeAt(0)-3);}
																if(b1_3 != 'a' || b1_3 != 'b' || b1_3 != 'c'){var vu1_3 = String.fromCharCode(b1_3.charCodeAt(0)-3);}

																if(b1_1 != 'v' || b1_1 != 'w' || b1_1 != 'x'){var vd1_1 = String.fromCharCode(b1_1.charCodeAt(0)+3);}
																if(b1_3 != 'v' || b1_3 != 'w' || b1_3 != 'x'){var vd1_2 = String.fromCharCode(b1_2.charCodeAt(0)+3);}
																if(b1_3 != 'v' || b1_3 != 'w' || b1_3 != 'x'){var vd1_3 = String.fromCharCode(b1_3.charCodeAt(0)+3);}


																//löschen der 'alten' Pfeile bei pos1
																	//pfeil nach oben
																	var delValue = b1_1+"_"+b1_2+"_"+b1_3+"__"+vu1_1+"_"+vu1_2+"_"+vu1_3+"_"+b1_1+"_"+b1_2+"_"+b1_3;
																	if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

																	//pfeil nach oben 2
																	var delValue = vu1_1+"_"+vu1_2+"_"+vu1_3+"__"+vu1_1+"_"+vu1_2+"_"+vu1_3+"_"+b1_1+"_"+b1_2+"_"+b1_3;
																	if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


																	//pfeil nach unten
																	var delValue = b1_1+"_"+b1_2+"_"+b1_3+"__"+b1_1+"_"+b1_2+"_"+b1_3+"_"+vd1_1+"_"+vd1_2+"_"+vd1_3;
																	if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

																	//pfeil nach unten 2
																	var delValue = vd1_1+"_"+vd1_2+"_"+vd1_3+"__"+b1_1+"_"+b1_2+"_"+b1_3+"_"+vd1_1+"_"+vd1_2+"_"+vd1_3;
																	if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


																	//Cut pfeil 1
																	var delValue = b1_1+"_"+b1_2+"_"+b1_3+"__"+b1_1;
																	if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

																	//Cut pfeil 2
																	var delValue = b1_1+"_"+b1_2+"_"+b1_3+"__"+b1_2;
																	if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


														//pos2
														if(gross2 == '3'){
															var b2_1 = l2_1;
															var b2_2 = l2_2;
															var b2_3 = l2_3;


																if(b2_1 != 'a' || b2_1 != 'b' || b2_1 != 'c'){var vu2_1 = String.fromCharCode(b2_1.charCodeAt(0)-3);}
																if(b2_2 != 'a' || b2_2 != 'b' || b2_2 != 'c'){var vu2_2 = String.fromCharCode(b2_2.charCodeAt(0)-3);}
																if(b2_3 != 'a' || b2_3 != 'b' || b2_3 != 'c'){var vu2_3 = String.fromCharCode(b2_3.charCodeAt(0)-3);}

																if(b2_1 != 'v' || b2_1 != 'w' || b2_1 != 'x'){var vd2_1 = String.fromCharCode(b2_1.charCodeAt(0)+3);}
																if(b2_2 != 'v' || b2_2 != 'w' || b2_2 != 'x'){var vd2_2 = String.fromCharCode(b2_2.charCodeAt(0)+3);}
																if(b2_3 != 'v' || b2_3 != 'w' || b2_3 != 'x'){var vd2_3 = String.fromCharCode(b2_3.charCodeAt(0)+3);}

																	//löschen der 'alten' Pfeile bei pos2
																		//pfeil nach oben
																		var delValue = b2_1+"_"+b2_2+"_"+b2_3+"__"+vu2_1+"_"+vu2_2+"_"+vu2_3+"_"+b2_1+"_"+b2_2+"_"+b2_3;
																		if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

																		//pfeil nach oben 2
																		var delValue = vu2_1+"_"+vu2_2+"_"+vu2_3+"__"+vu2_1+"_"+vu2_2+"_"+vu2_3+"_"+b2_1+"_"+b2_2+"_"+b2_3;
																		if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


																		//pfeil nach unten
																		var delValue = b2_1+"_"+b2_2+"_"+b2_3+"__"+b2_1+"_"+b2_2+"_"+b2_3+"_"+vd2_1+"_"+vd2_2+"_"+vd2_3;
																		if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

																		//pfeil nach unten 2
																		var delValue = vd2_1+"_"+vd2_2+"_"+vd2_3+"__"+b2_1+"_"+b2_2+"_"+b2_3+"_"+vd2_1+"_"+vd2_2+"_"+vd2_3;
																		if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


																		//Cut pfeil 1
																		var delValue = b2_1+"_"+b2_2+"_"+b2_3+"__"+b2_1;
																		if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

																		//Cut pfeil 2
																		var delValue = b2_1+"_"+b2_2+"_"+b2_3+"__"+b2_2;
																		if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

															}
														} // ende gross1 = 3



									//=================================================================================================================================================
									//=================================================================================================================================================
									//========================== Erste Position Vier gross ============================================================================================
									//=================================================================================================================================================
									//=================================================================================================================================================

													if( gross1 == '4'){

														//pos1
															var b1_1 = l1_1;
															var b1_2 = l1_2;
															var b1_3 = l1_3;
															var b1_4 = l1_4;


																if(b1_1 != 'a' )							{var hl1_2 = String.fromCharCode(b1_1.charCodeAt(0)-1);}
																if(b1_2 != 'a' )							{var hl1_4 = String.fromCharCode(b1_3.charCodeAt(0)-1);}


																if(b1_3 != 'x' )							{var hr1_1 = String.fromCharCode(b1_2.charCodeAt(0)+1);}
																if(b1_4 != 'x' )							{var hr1_3 = String.fromCharCode(b1_4.charCodeAt(0)+1);}


																//löschen der 'alten' Pfeile bei pos1
																	//pfeil nach rechts
																	var delValue = b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"__"+b1_1+"_"+b1_2+"_"+hr1_1+"_"+b1_3+"_"+b1_4+"_"+hr1_3;
																	if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

																	//pfeil nach rechts 2
																	var delValue = hr1_1+"_"+hr1_3+"__"+b1_1+"_"+b1_2+"_"+hr1_1+"_"+b1_3+"_"+b1_4+"_"+hr1_3;
																	if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


																	//pfeil nach links
																	var delValue = b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"__"+hl1_2+"_"+b1_1+"_"+b1_2+"_"+hl1_4+"_"+b1_3+"_"+b1_4;
																	if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

																	//pfeil nach links 2
																	var delValue = hl1_2+"_"+hl1_4+"__"+hl1_2+"_"+b1_1+"_"+b1_2+"_"+hl1_4+"_"+b1_3+"_"+b1_4;
																	if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}



																	//Cut pfeil 1
																	var delValue = b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"__"+b1_2+"_"+b1_4;
																	if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

																	//Cut pfeil 2
																	var delValue = b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"__"+b1_1+"_"+b1_3;
																	if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

																	//Cut pfeil 3
																	var delValue = b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"__"+b1_1+"_"+b1_2;
																	if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

																	//Cut pfeil 4
																	var delValue = b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"__"+b1_3+"_"+b1_4;
																	if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


														//pos2
														if(gross2 == '2'){
															var b2_1 = l2_1;
															var b2_2 = l2_2;


															if(b2_1 != 'a' || b2_1 != 'b'){var hl2_1 = String.fromCharCode(b2_1.charCodeAt(0)-2);}
															if(b2_1 != 'a' )							{var hl2_2 = String.fromCharCode(b2_1.charCodeAt(0)-1);}
															if(b2_3 != 'a' || b2_1 != 'b'){var hl2_3 = String.fromCharCode(b2_2.charCodeAt(0)-2);}
															if(b2_3 != 'a' )							{var hl2_4 = String.fromCharCode(b2_2.charCodeAt(0)-1);}


															if(b2_1 != 'x' || b2_1 != 'w'){var hr2_1 = String.fromCharCode(b2_1.charCodeAt(0)+1);}
															if(b2_1 != 'x' )							{var hr2_2 = String.fromCharCode(b2_1.charCodeAt(0)+2);}
															if(b2_3 != 'x' )							{var hr2_3 = String.fromCharCode(b2_2.charCodeAt(0)+1);}
															if(b2_3 != 'x' || b2_1 != 'w'){var hr2_4 = String.fromCharCode(b2_2.charCodeAt(0)+2);}

																	//löschen der 'alten' Pfeile bei pos2
																		//pfeil nach rechts
																		var delValue = b2_1+"_"+b2_2+"__"+hl2_1+"_"+hl2_2+"_"+b2_1+"_"+hl2_3+"_"+hl2_4+"_"+b2_2;
																		if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

																		//pfeil nach links
																		var delValue = b2_1+"_"+b2_2+"__"+b2_1+"_"+hr2_1+"_"+hr2_2+"_"+b2_2+"_"+hr2_3+"_"+hr2_4;
																		if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}


																		//Cut pfeil 1
																		var delValue = b2_1+"_"+b2_2+"__"+b2_1;
																		if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

																		//Cut pfeil 2
																		var delValue = b2_1+"_"+b2_2+"__"+b2_2;
																		if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

															}
														} // ende gross1 = 4


														//=================================================================================================================================================
														//=================================================================================================================================================
														//========================== Erste Position Vier gross ============================================================================================
														//=================================================================================================================================================
														//=================================================================================================================================================

																		if( gross1 == '6'){

																			//pos1
																				var b1_1 = l1_1;
																				var b1_2 = l1_2;
																				var b1_3 = l1_3;
																				var b1_4 = l1_4;
																				var b1_5 = l1_5;
																				var b1_6 = l1_6;


																					//löschen der 'alten' Pfeile bei pos1
																						//Cut pfeil 1
																						var delValue = b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"_"+b1_5+"_"+b1_6+"__"+b1_4+"_"+b1_5+"_"+b1_6;
																						if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

																						//Cut pfeil 2
																						var delValue = b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"_"+b1_5+"_"+b1_6+"__"+b1_2+"_"+b1_3+"_"+b1_5+"_"+b1_6;
																						if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

																						//Cut pfeil 3
																						var delValue = b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"_"+b1_5+"_"+b1_6+"__"+b1_1+"_"+b1_2+"_"+b1_3;
																						if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}

																						//Cut pfeil 4
																						var delValue = b1_1+"_"+b1_2+"_"+b1_3+"_"+b1_4+"_"+b1_5+"_"+b1_6+"__"+b1_1+"_"+b1_2+"_"+b1_4+"_"+b1_5;
																						if (document.getElementById(delValue)) {var delDiv = document.getElementById(delValue);delDiv.parentNode.removeChild(delDiv);}
																}

				} //Funktionsende
		  </script>
			<?php

			?>
		</channelcontent>

</div>

</div>

<?php if($infram != 1){?>
		</div>

	</body>
</html>

<?php }
?>
