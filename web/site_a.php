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
					sethtmltitle('<?php echo $html_title; ?>');
				});

        $('.body').addClass('channel-background');

			</script>
		</span>

    <div class='row'>
      <div id="column1" class="col-lg-2 col-xl-2"> </div>
      <div id="column2" class="channel_main_container col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-spl">


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
          $channel_t_xp2 = number_format($channel_xp,0, ",", ".");

          $channel_xp_needed_total2 = number_format($lvl->lvlinfo('txp','1000') ,0, ",", ".");

            if($channel_xp >= $lvl->lvlinfo('txp','1000')){ $channel_level = 1000; $channel_levelup = 1000; $channel_levelfortschrit = 0; }
            elseif($channel_xp <= 0){
              $channel_level = 0; $channel_levelup = 1; $channel_levelfortschrit = 0; $channel_t_levelfortschritline = 0;

              $channel_xplevel_needed_for_next_level = $lvl->lvlinfo('xp',$channel_levelup);
              $channel_xplevel_over = $channel_xp - $lvl->lvlinfo('txp',$channel_level);
              $channel_xplevel_over2 = number_format($channel_xplevel_over,0, ",", ".");
              $channel_xplevel_needed_for_next_level2 = number_format($channel_xplevel_needed_for_next_level,0, ",", ".");
            }else{

              $channel_level = $lvl->lvlinfo('level',$channel_xp);

              $channel_levelup = $channel_level + 1;


              $channel_xplevel_for_this_level = $lvl->lvlinfo('txp',$channel_level);
              $channel_xplevel_for_next_level = $lvl->lvlinfo('txp',$channel_levelup);

              $channel_xplevel_needed_for_next_level = $lvl->lvlinfo('xp',$channel_levelup);
              $channel_xplevel_over = $channel_xp - $channel_xplevel_for_this_level;

              $channel_xplevel_over2 = number_format($channel_xplevel_over,0, ",", ".");
              $channel_xplevel_needed_for_next_level2 = number_format($channel_xplevel_needed_for_next_level,0, ",", ".");

              //wie viel Prozent der ramne gefüllt sein soll
              $channel_levelfortschrit = $channel_xplevel_over / $channel_xplevel_needed_for_next_level * 100;

              //wie viel Prozent der totalen level fortschritt balken
              $channel_t_levelfortschritline = $channel_xp / $lvl->lvlinfo('txp','1000') * 100;
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
                echo "<div class='channel_navi_btn no_overflow'>        <a href='".$_dhp."user/".$channel_name."/playlist'>".$l->pl_navi_title."</a></div>";
                echo "<div class='channel_navi_btn channel_navi_btn_hide no_overflow channel_navi_btn_activ'>   <a href='".$_dhp."user/".$channel_name."/achv'>".$l->achievement_navi_title."</a></div>";
                echo "<div class='channel_navi_btn channel_navi_btn_hide no_overflow'>         <a href='".$_dhp."user/".$channel_name."/info'>".$l->info_navi_title."</a></div>";

              if($isUserLoggedIn === 1 AND $channel_uuid == $user_uuid){
                echo"<div class='channel_navi_btn channel_navi_btn_hide no_overflow' title='".$l->home_edit_navi_title."'>       <a href='".$_dhp."edit'><span class='glyphicon glyphicon-pencil'></span></a></div>";
                echo "<style>.channel_navi_btn{width: calc(100% / 6 - 5px);}</style>";
              }

                echo "<div class='channel_navi_btn channel_navi_btn_show channel_navi_btn_show_more no_overflow'>         <div class='channel_navi_more'><span class='glyphicon glyphicon-option-horizontal'></div> </div>";
                  echo "<div class='channel_navi_more_menu hide'>";
                    if($isUserLoggedIn === 1 AND $channel_uuid == $user_uuid){
                      echo"<div class='channel_navi_btn no_overflow' title='".$l->home_edit_navi_title."'>       <a href='".$_dhp."edit'><span class='glyphicon glyphicon-pencil'></span></a></div>";
                    }
                    echo "<div class='channel_navi_btn no_overflow'>                                             <a href='".$_dhp."user/".$channel_name."/info'>".$l->info_navi_title."</a></div>";
                    echo "<div class='channel_navi_btn no_overflow channel_navi_btn_activ'>                      <a href='".$_dhp."user/".$channel_name."/achv'>".$l->achievement_navi_title."</a></div>";

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

            <script>
            //instant 300 x 300
            $(document).ready(function() {
              setTimeout(function() {
                <?php if($channel_levelfortschrit > 0){?>
                  $('.level_300_corner_top_left_draw').animate({width: 15}, 0, function() {
                <?php } ?>

                  <?php if($channel_levelfortschrit >= 25){?>
                    $('.level_300_line_top_draw').animate({width: 270}, 500, function() {
                    <?php }elseif($channel_levelfortschrit < 25){ ?>
                      $('.level_300_line_top_draw').animate({width: <?php $top_line_width = floor(270 * $channel_levelfortschrit * 4 / 100);  echo $top_line_width;?>}, 500, function() {
                    <?php } ?>

                      <?php if($channel_levelfortschrit >= 25){?>
                        $('.level_300_corner_top_right_draw').animate({width: 15}, 0);
                        $('.level_300_corner_top_right_draw').animate({height: 15}, 0, function() {
                      <?php } ?>

                        <?php if($channel_levelfortschrit >= 50){?>
                          $('.level_300_line_right_draw').animate({height: 270}, 500, function() {
                        <?php }elseif($channel_levelfortschrit < 50 AND $channel_levelfortschrit > 25){ ?>
                          $('.level_300_line_right_draw').animate({height: <?php $right_line_height = floor(270 * ($channel_levelfortschrit - 25) * 4 / 100);  echo $right_line_height;?>}, 500, function() {
                        <?php } ?>

                          <?php if($channel_levelfortschrit >= 50){?>
                            $('.level_300_corner_bottom_right_draw').animate({width: 15}, 0);
                            $('.level_300_corner_bottom_right_draw').animate({height: 15}, 0, function() {
                          <?php } ?>

                            <?php if($channel_levelfortschrit >= 75){?>
                              $('.level_300_line_bottom_draw').animate({width: 270}, 500, function() {
                              <?php }elseif($channel_levelfortschrit < 75 AND $channel_levelfortschrit > 50){ ?>
                                $('.level_300_line_bottom_draw').animate({width:<?php $bottom_line_width = floor(270 * ($channel_levelfortschrit - 50) * 4 / 100);  echo $bottom_line_width;?>}, 500, function() {
                              <?php } ?>

                              <?php if($channel_levelfortschrit >= 75){?>
                                $('.level_300_corner_bottom_left_draw').animate({width: 15}, 0);
                                $('.level_300_corner_bottom_left_draw').animate({height: 15}, 0, function() {
                              <?php } ?>

                                <?php if($channel_levelfortschrit >= 100){?>
                                  $('.level_300_line_left_draw').animate({height: 270}, 500, function() {
                                  <?php }elseif($channel_levelfortschrit < 100 AND $channel_levelfortschrit > 75){ ?>
                                    $('.level_300_line_left_draw').animate({height:<?php $left_line_height = floor(270 * ($channel_levelfortschrit - 75) * 4 / 100);  echo $left_line_height;?>}, 500, function() {
                                  <?php } ?>

                              <?php if($channel_levelfortschrit < 100 AND $channel_levelfortschrit > 75){ ?> }); <?php } ?>
                              <?php if($channel_levelfortschrit >= 100){?> }); <?php } ?>

                            <?php if($channel_levelfortschrit >= 75){?>	}); <?php } ?>

                          <?php if($channel_levelfortschrit < 75 AND $channel_levelfortschrit > 50){ ?> }); <?php } ?>
                          <?php if($channel_levelfortschrit >= 75){?> }); <?php } ?>

                        <?php if($channel_levelfortschrit >= 50){?> }); <?php } ?>

                      <?php if($channel_levelfortschrit < 50 AND $channel_levelfortschrit > 25){ ?> }); <?php } ?>
                      <?php if($channel_levelfortschrit >= 50){?> }); <?php } ?>

                    <?php if($channel_levelfortschrit >= 25){?> }); <?php } ?>

                  <?php if($channel_levelfortschrit < 25){?> }); <?php } ?>
                  <?php if($channel_levelfortschrit >= 25){?> }); <?php } ?>

                <?php if($channel_levelfortschrit > 0){?> }); <?php } ?>


                  $('.BigProgressBarLevelfront')	.animate({width: '<?php $left_line_height = $channel_levelfortschrit;  echo $left_line_height."%"; ?>'}, 500, function() {
                    $('.BigProgressBarLevelfront_t').animate({width: '<?php $left_line_height = $channel_t_levelfortschritline;  echo $left_line_height."%"; ?>'}, 500);
                  });
              }, 500);
            });
            </script>


            <?php
              echo"<div class='allvideoTitle no_overflow'> <div class='allvideoCount'>".$l->achievement_level_title."</div> </div>";

                echo"<div class='achievement-content'>";

                    echo"<div class='level_icon'>";
                      echo"<div class='level_content_back channel_big_level_symbol'>";
                        echo "<div class='level_border_back level_300_line_top b_level_".$channel_b_level."'> <div class='level_border_front level_300_line_top_draw c_level_".$channel_c_level."'></div> </div>
                          <div class='level_border_back level_300_corner_top_left b_level_".$channel_b_level."'> <div class='level_border_front level_300_corner_top_left_draw c_level_".$channel_c_level."'></div> </div>
                        <div class='level_border_back level_300_line_right b_level_".$channel_b_level."' > <div class='level_border_front level_300_line_right_draw c_level_".$channel_c_level."'></div> </div>
                          <div class='level_border_back level_300_corner_top_right b_level_".$channel_b_level."'> <div class='level_border_front level_300_corner_top_right_draw c_level_".$channel_c_level."'></div> </div>
                        <div class='level_border_back level_300_line_bottom b_level_".$channel_b_level."'> <div class='level_border_front level_300_line_bottom_draw c_level_".$channel_c_level."'></div> </div>
                          <div class='level_border_back level_300_corner_bottom_right b_level_".$channel_b_level."'> <div class='level_border_front level_300_corner_bottom_right_draw c_level_".$channel_c_level."'></div> </div>
                        <div class='level_border_back level_300_line_left b_level_".$channel_b_level."'> <div class='level_border_front level_300_line_left_draw c_level_".$channel_c_level."'></div> </div>
                          <div class='level_border_back level_300_corner_bottom_left b_level_".$channel_b_level."'> <div class='level_border_front level_300_corner_bottom_left_draw c_level_".$channel_c_level."'></div> </div>

                        <div class='level_content n_300_level_".$channel_n_level." c_level_".$channel_c_level."'>
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
                    echo"</div>";

                    echo "<div class='achievement-ProgressBars'>";
                      echo "<div class='bigleveltitle'>".$l->level_title3.":</div>";

                      echo "<div class='BigProgressBarLevel b_level_".$channel_b_level."'>";
                      echo "<div class='BigProgressBarLevelfront c_level_".$channel_c_level."'></div>";
                      echo "</div>";


                      echo "<div class='Biglevel_xp_needed'>".$channel_xplevel_over2."xp</div>";
                      echo "<div class='Biglevel_xp_to_next_level'>".$channel_xplevel_needed_for_next_level2."xp</div>";


                      echo "<div class='bigleveltitle' id='ach_140'>".$l->level_title4.":</div>";

                      echo "<div class='BigProgressBarLevel_t b_level_".$channel_b_level."'>";
                      echo "<div class='BigProgressBarLevelfront_t c_level_".$channel_c_level."'></div>";
                      echo "</div>";

                      echo "<div class='Biglevel_xp_needed_t '>".$channel_t_xp2."xp</div>";
                      echo "<div class='Biglevel_xp_to_next_level_t '>".$channel_xp_needed_total2."xp</div>";
                    echo"</div>";

                  echo"</div>";

              echo"<div class='allvideoTitle no_overflow'> <div class='allvideoCount'>".$l->achievement_main_title."</div> </div>";

                        include ('achievement/achievement_list.php');

                        //$ach->add_ach('180','',$user_uuid);

                      }
            ?>


          </div>
    			<div class="column3 col-xs-0 col-sm-0 col-md-0 col-lg-1 col-xl-3 col-spl"></div>
        </div>

<?php

if($infram != 1){?>
    </div>

  </body>
</html>

<?php }
?>
