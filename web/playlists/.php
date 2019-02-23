<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet
$_hp = '../'; //für includes
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

//3. site vals
if(isset($_GET['p']) AND $_GET['p'] != ""){

  $item_per_page = 24;

  $puid = mysqli_real_escape_string(db::$link,$_GET['p']);
  $pl_can_show = 0; $pl_error = 0;

  $playlist_sql = db::$link->query("SELECT * FROM playlist_db WHERE puid = '$puid'");
  $playlist_row = $playlist_sql->fetch_assoc();

  if($playlist_row['puid'] != ""){
    $pl_name    = htmlentities($playlist_row['title'], ENT_QUOTES);
    $pl_uuid    = $playlist_row['uuid'];
    $pl_thumb   = $playlist_row['thumb'];
    $pl_notiz1  = $playlist_row['notiz'];
    $pl_notiz   = $com->fulltext($pl_notiz1);
    $pl_notiz_link = $f->autolink($pl_notiz,array("target"=>"_blank"));
    $pl_orderby = $playlist_row['orderby'];
    $pl_privacy = $playlist_row['privacy'];
    $pl_status  = $playlist_row['status'];

  $user_sql = db::$link->query("SELECT * FROM user_find_db WHERE uuid = '$pl_uuid'");
  $user_row = $user_sql->fetch_assoc();
    $pl_user_name = $user_row['user_name'];

    //0 = Privat
    //1 = Öffentlich
    //2 = Nicht gelistet
    //3 = Nur Freunde

    if(($pl_privacy == 1 OR $pl_privacy == 2 OR $pl_privacy == 3) AND $pl_status == "public"){
      $pl_can_show = 1;
      $html_title = $pl_name." | We-TeVe"; //Tap title
    }elseif(($pl_privacy == 0 ) AND $pl_status == "public"){
      if($isUserLoggedIn === 1){
        if($pl_uuid == $user_uuid OR $user_rang == 1){
          $pl_can_show = 1;
          $html_title = $pl_name." | We-TeVe"; //Tap title
        }else{
          $pl_can_show = 0;
          $pl_error = 3;
          $html_title = "Privat | We-TeVe"; //Tap title
        }
      }else{
        $pl_can_show = 0;
        $pl_error = 3;
        $html_title = "Privat | We-TeVe"; //Tap title
      }
    }elseif($pl_status != "public"){
      $pl_can_show = 0;
      $pl_error = 2;
      $html_title = "404 Playlist not found | We-TeVe"; //Tap title
    }

  }else{
        $pl_can_show = 0;
        $pl_error = 4;
        $html_title = "404 Playlist not found | We-TeVe"; //Tap title
  }

}else{
    $pl_can_show = 0;
    $pl_error = 4;
    $html_title = "404 Playlist not found | We-TeVe"; //Tap title
}



//4. coinhive check
$coin_name = $pl_uuid;
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
			<?php require_once ($_hp.'include/head.php'); ?>
		</head>
		<body id='body' class='body'>

		<?php require_once ($_hp.'include/navi.php'); ?>

		<div id='main_container' class='container main_container'>
<?php } ?>

		<span id='site_scripts'>

			<?php require_once ($_hp.'include/coinhivescript.php'); ?>

			<script>
				$(document).ready(function(){
					docready();
					sethtmltitle('<?php echo $html_title; ?>');
				});

        $('.body').addClass('channel-background');

			</script>

		</span>


    <div class='row'>
			<div id="column1" class="col-lg-2 col-xl-2"> </div>
			<div id="column2" class="channel_main_container col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-spl">

      <?php
      if($pl_can_show == 0){
        if($pl_error == 4){
          echo "<span class='red'>".$l->pl_alert_1."</div>";
        }elseif($pl_error == 3){
          echo "<span class='red'>".$l->pl_alert_2."</div>";
        }elseif($pl_error == 2){
          echo "<span class='red'>".$l->pl_alert_3."</div>";
        }else{
          echo "<span class='red'>".$l->pl_alert_9."</div>";
        }

      }else{
      ?>

      <?php
        //check adminrights
        if($isUserLoggedIn === 1){
          if($user_uuid == $pl_uuid OR $user_rang == 1){
            $ar = 1;
          }else{
            $ar = 0;
          }
        }else{$ar = 0;}
        //end check adminrights


        $channel_design = db::$link->query("SELECT * FROM channel_design_db WHERE uuid = '$pl_uuid'");
        $channel_design = $channel_design->fetch_assoc();

        echo "<style>";
          echo ".channel-background{";
            if($channel_design['background_type'] == "" OR $channel_design['background_type'] == "none"){echo "";}else{
              if($channel_design['background_type'] == 'png' or $channel_design['background_type'] == 'jpg'){

                echo"background-image: url('".$_dhp."images/channel/background/".$pl_uuid.".".$channel_design['background_type']."');";
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


        $channel_find_sql = db::$link->query("SELECT * FROM user_find_db WHERE uuid = '$pl_uuid'");
        $channel_find_row = $channel_find_sql->fetch_assoc();

          $channel_name  = $channel_find_row['user_name'];
          $channel_subs  = $channel_find_row['abos'];
          $channel_sub_n = number_format($channel_subs,0, ",", ".");
          $channel_land  = $channel_find_row['land'];
          $channel_xp    = $channel_find_row['xp'];


            if($channel_xp >= $lvl->lvlinfo('txp','1000')){ $channel_level = 1000; $channel_levelup = 1000; $channel_levelfortschrit = 0; }
            elseif($channel_xp <= 0){$channel_level = 0; $channel_levelup = 1; $channel_levelfortschrit = 0;
            }else{

              $channel_level = $lvl->lvlinfo('level',$channel_xp);

              $channel_levelup = $channel_level + 1;

              $channel_xplevel_for_this_level = $lvl->lvlinfo('txp',$channel_level);

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
            $f->draw_user_preview($pl_uuid,$_dhp);
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
              echo "<div class='channel_navi_btn no_overflow'>                               <a href='".$_dhp."user/".$pl_user_name."'>".$l->home_navi_title."</a></div>";
              echo "<div class='channel_navi_btn no_overflow'>                               <a href='".$_dhp."user/".$pl_user_name."/videos'>".$l->video_navi_title."</a></div>";
              echo "<div class='channel_navi_btn no_overflow channel_navi_btn_activ'>        <a href='".$_dhp."user/".$pl_user_name."/playlist'>".$l->pl_navi_title."</a></div>";
              echo "<div class='channel_navi_btn channel_navi_btn_hide no_overflow'>         <a href='".$_dhp."user/".$pl_user_name."/achv'>".$l->achievement_navi_title."</a></div>";
              echo "<div class='channel_navi_btn channel_navi_btn_hide no_overflow'>         <a href='".$_dhp."user/".$pl_user_name."/info'>".$l->info_navi_title."</a></div>";

            if($isUserLoggedIn === 1 AND $pl_uuid == $user_uuid){
              echo"<div class='channel_navi_btn channel_navi_btn_hide no_overflow' title='".$l->home_edit_navi_title."'>       <a href='".$_dhp."edit'>$l->home_edit_navi_title</span></a></div>";
              echo "<style>.channel_navi_btn{width: calc(100% / 6 - 5px);}</style>";
            }

              echo "<div class='channel_navi_btn channel_navi_btn_show channel_navi_btn_show_more no_overflow'>         <div class='channel_navi_more'><span class='glyphicon glyphicon-option-horizontal'></div> </div>";
                echo "<div class='channel_navi_more_menu hide'>";
                  if($isUserLoggedIn === 1 AND $pl_uuid == $user_uuid){
                    echo"<div class='channel_navi_btn right no_overflow' title='".$l->home_edit_navi_title."'>       <a href='".$_dhp."edit'>$l->home_edit_navi_title</span></a></div>";
                  }
                  echo "<div class='channel_navi_btn right no_overflow'>         <a href='".$_dhp."user/".$pl_user_name."/info'>".$l->info_navi_title."</a></div>";
                  echo "<div class='channel_navi_btn right no_overflow'>         <a href='".$_dhp."user/".$pl_user_name."/achv'>".$l->achievement_navi_title."</a></div>";

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

      <?php


          //playlist counts
          $vid_results = db::$link->query("SELECT COUNT(puid) FROM playlist_content_db WHERE puid = '$puid' AND status = 'public'");
            $get_total_rows = $vid_results->fetch_row();
            $allvideoCount  = $get_total_rows[0];

            if($allvideoCount > 0){
              //pl thumb
      					if($pl_orderby == 0)		 		{ $thumb_res = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY posi ASC LIMIT 1");
      					}elseif($pl_orderby  == 1)	{ $thumb_res = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at DESC LIMIT 1");
      					}elseif($pl_orderby  == 2)	{ $thumb_res = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at ASC LIMIT 1");
      					}elseif($pl_orderby  == 3)	{ $thumb_res = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate DESC LIMIT 1");
      					}elseif($pl_orderby  == 4)	{ $thumb_res = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate ASC LIMIT 1");
      					}

      					$get_pl_info 	   	= $thumb_res->fetch_assoc();
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

              $main_thumb_link = $_dhp."watch/".$first_video_vuid."&pl=".$puid;

              $pl_main_thumb = $_ddhp."images/thumb/large_img/".$pl_m_thumb.".jpg";
              //end pl thumb
            }else{
              $pl_main_thumb = $_ddhp."images/thumb/error.jpg";
              $main_thumb_link = "";
            }



        //pl head
          echo "<div class='pl_header'>";
            echo "<a href='".$main_thumb_link."' class='pl_header_thumb'>";
              echo "<img id='".$puid."' src='".$pl_main_thumb."'";?> onerror="document.getElementById(this.id).src = '<?php echo $_dhp; ?>images/thumb/error.jpg'" <?php echo"/>";
            echo "</a>";

            if($ar === 1){ //auf 1 stellen

              //0 = Privat
              //1 = Öffentlich
              //2 = Nicht gelistet
              //3 = Nur Freunde

              $priv_class_0 = ""; $priv_class_1 = ""; $priv_class_2 = ""; $priv_class_3 = "";
                   if($pl_privacy == '0'){ $priv_class_0 = "activ";
              }elseif($pl_privacy == '1'){ $priv_class_1 = "activ";
              }elseif($pl_privacy == '2'){ $priv_class_2 = "activ";
              }elseif($pl_privacy == '3'){ $priv_class_3 = "activ";
              }




              echo "<div class='pl_header_content'>";
                echo "<input type='text' class='pl_header_edit_title form-control' placeholder='".$l->pl_edit_title1."' value='".$pl_name."'/>";
                  echo "<div class='pl_privacy' privacy='".$pl_privacy."' >";
                    echo "<div title='".$l->up_privacy_title1."' priv='1' class='button priv_btn gray_btn left marg-r-5 ".$priv_class_1."'><span class='glyphicon glyphicon-globe' aria-hidden='true'></span></div>";
                    echo "<div title='".$l->up_privacy_title2."' priv='2' class='button priv_btn gray_btn left marg-r-5 ".$priv_class_2."'><i class='fa fa-unlock' aria-hidden='true'></i></div>";
                    echo "<div title='".$l->up_privacy_title3."' priv='3' class='button priv_btn gray_btn left marg-r-5 ".$priv_class_3."'><span class='glyphicon glyphicon-user' aria-hidden='true'></span></div>";
                    echo "<div title='".$l->up_privacy_title4."' priv='0' class='button priv_btn gray_btn left priv_btn_sel ".$priv_class_0."'><i class='fa fa-lock' aria-hidden='true'></i></div>";
                  echo "</div>";
                echo "<a href='".$_dhp."user/".$pl_user_name."' title='".$pl_user_name."' class='videopreview_user_name no_overflow pad-0 marg-top-13'><img src='".$_ddhp.$f->draw_avatar($pl_uuid,'small')."'/>".$pl_user_name."</a>";

                  /*
                    order by
                    0 = Manuel / posi DESC
                    1 = Neu -> Alt addet ad DESC
                    2 = Alt -> Neu addet ad ASC
                    3 = Hochladedatum Neu -> Alt time DESC
                    4 = Hochladedatum Alt -> Neu time ASC
                  */

                  if($pl_orderby == 0)		 		{ $pl_order_by_text = $l->pl_edit_sort_text0;
                  }elseif($pl_orderby  == 1)	{ $pl_order_by_text = $l->pl_edit_sort_text1;
                  }elseif($pl_orderby  == 2)	{ $pl_order_by_text = $l->pl_edit_sort_text2;
                  }elseif($pl_orderby  == 3)	{ $pl_order_by_text = $l->pl_edit_sort_text3;
                  }elseif($pl_orderby  == 4)	{ $pl_order_by_text = $l->pl_edit_sort_text4;
                  }

                  echo "<div class='right'>";
                    echo "<span class='left marg-top-13 marg-r-5'>".$l->pl_edit_sort_title.":</span>";
                    echo "<div class='sort_dropdown up_dropdown dropdown left marg-top-5 marg-l-0'>";
                        echo "<div class='sort_dropdown_btn btn btn-default gray_btn dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>";
                        echo "<span class='sort_dropdown_label dropdown_label no_overflow' sort='".$pl_orderby."'>".$pl_order_by_text."</span>";
                        echo "<span class='caret'></span>";
                      echo "</div>";
                      echo "<ul class='dropdown-menu up_dropdown-menu'>";
                        echo "<li> <div class='sort_dropdown_select dropdown_select' sort='0' >".$l->pl_edit_sort_text0."</div> </li>";
                        echo "<li> <div class='sort_dropdown_select dropdown_select' sort='1' >".$l->pl_edit_sort_text1."</div> </li>";
                        echo "<li> <div class='sort_dropdown_select dropdown_select' sort='2' >".$l->pl_edit_sort_text2."</div> </li>";
                        echo "<li> <div class='sort_dropdown_select dropdown_select' sort='3' >".$l->pl_edit_sort_text3."</div> </li>";
                        echo "<li> <div class='sort_dropdown_select dropdown_select' sort='4' >".$l->pl_edit_sort_text4."</div> </li>";
                      echo "</ul>";
                    echo "</div>";
                  echo "</div>";

                  echo "<div contentEditable='true' class='pl_info_input' placeholder='".$l->pl_edit_info_text1."'>".$pl_notiz."</div>";

                  echo "<div class='pl_header_edit_del_btn left no_overflow'>".$l->pl_edit_title2."</div>";
                  echo "<div class='pl_header_edit_save_btn right no_overflow'>
                    <span class='pl_header_edit_save_text'>".$l->pl_edit_title3."</span>
                    <span class='pl_header_edit_save_loading hide'><img src='".$_dhp."images/icons/ajax-loader.gif' alt='We-Teve'/> ".$l->loading."</span>
                  </div>";
                  echo "<div class='right blue marg-r-5 pl_header_edit_save_error pl_header_edit_save_error_0 hide'>".$l->pl_edit_alert_0."</div>";
                  echo "<div class='right red marg-r-5 pl_header_edit_save_error pl_header_edit_save_error_1 hide'>".$l->pl_edit_alert_1."</div>";

              echo "</div>";

              echo "<div class='smalldelmenu_bg hide'>";
          			echo "<div class='smalldelmenu'>";
          				echo "<div>".$l->pl_del_text.":<br/><div title='".$pl_name."' class='smalldel_title no_overflow blue'>".$pl_name."</div></div>";
          				echo "<br/>";
          				echo "<div class='smallmenu_del_yes_button noselect'>".$l->pl_del_title1."</div>";
          				echo "<div class='smallmenu_del_no_button marg-l-10 noselect'>".$l->pl_del_title2."</div>";
          			echo "</div>";
          		echo "</div>";

              ?>
                <script>
                  //privacy
                    $('.priv_btn').unbind('click').click(function(){
                      $('.priv_btn').removeClass('activ');
                      $(this).addClass('activ');
                      var priv = $(this).attr('priv');
                      $('.pl_privacy').attr('privacy',priv);
                    });

                  //sort
                    $('.sort_dropdown_select').unbind('click').click(function(){
                      $('.sort_dropdown_label').html($(this).html());
                      $('.sort_dropdown_label').attr('sort',$(this).attr('sort'));
                    });


                    $(document).mouseup(function (e){
                      var container = $('.video_info_input');
                      if (!container.is(e.target) && container.has(e.target).length === 0){
                        if($('.info_in_focus').html() == "<br>"){ $('.info_in_focus').html(''); }
                        $('.pl_info_input').removeClass('info_in_focus');
                      }
                    });

                    $.fn.convertLineBreaks = function() {
                      this.each(function() {
                        $(this).on("keypress click change paste cut", function(e) {
                          var br, range, selection, textNode;
                          if (e.keyCode === 13) {
                            e.preventDefault();
                            if (window.getSelection) {
                              selection = window.getSelection();
                              range = selection.getRangeAt(0);
                              br = document.createElement("br");
                              textNode = document.createTextNode("\u00a0");
                              range.deleteContents();
                              range.insertNode(br);
                              range.collapse(false);
                              range.insertNode(textNode);
                              range.selectNodeContents(textNode);
                              selection.removeAllRanges();
                              selection.addRange(range);
                              return false;
                            }
                          }
                        });
                      });
                    };

                    $editField = $('info_in_focus');
                    $editField.convertLineBreaks();

                    $(".pl_info_input").unbind("paste drop").on('paste drop', function(e) {
                      e.preventDefault();
                      var text = null;
                      text = (e.originalEvent || e).clipboardData.getData('text/plain') || prompt('Paste Your Text Here');
                      document.execCommand("insertText", false, text);
                    });

                //playlist save
                  $('.pl_header_edit_save_btn').unbind('click').click(function(){
                    $('.pl_header_edit_save_text').addClass('hide');
                    $('.pl_header_edit_save_loading').removeClass('hide');
                    $('.pl_header_edit_save_error').addClass('hide');

                    var pltitle = $('.pl_header_edit_title').val();
                    var plprivacy = $('.pl_privacy').attr('privacy');
                    var plsort = $('.sort_dropdown_label').attr('sort');
                    var plinfo = $('.pl_info_input').html();

                    $.post('<?php echo $_dhp; ?>playlists/save', {'puid': '<?php echo $puid; ?>', 'pltitle':pltitle, 'plprivacy':plprivacy, 'plsort':plsort, 'plinfo':plinfo }, function(data) {
                      $('.pl_header_edit_save_text').removeClass('hide');
                      $('.pl_header_edit_save_loading').addClass('hide');
                      if(data == "ok"){
                        $('.pl_header_edit_save_error_0').removeClass('hide');
                      }else if(data == "reload_ok"){
                        gotosite('<?php echo $_dhp;?>playlist/<?php echo $puid; ?>','','1');
                      }else{
                        $('.pl_header_edit_save_error_1').removeClass('hide');
                      }
                    });
                  });

                //playlist del
                  $('.pl_header_edit_del_btn').unbind('click').click(function(){
          					$('.smalldelmenu_bg').removeClass('hide');
          					$('.body').addClass('stop_srolling');
          				});

          				$('.smallmenu_del_yes_button').unbind('click').click(function(){
          					$.post('<?php echo $_dhp; ?>playlists/del', {'puid': '<?php echo $puid; ?>'}, function(data) {
          						if(data == "ok"){
          							$('.smalldelmenu_bg').addClass('hide');
          							$('.body').removeClass('stop_srolling');
                        gotosite('<?php echo $_dhp;?>user/<?php echo $user_name;?>/playlist','','0');
          						}else{
          							$('.smalldelmenu_bg').addClass('hide');
          							$('.body').removeClass('stop_srolling');
          						}
          					});
          				});

          				$('.smallmenu_del_no_button').unbind('click').click(function(){
          					$('.smalldelmenu_bg').addClass('hide');
          					$('.body').removeClass('stop_srolling');
          				});

          				$('.smalldelmenu_bg').mouseup(function (e){
          					var container = $('.smalldelmenu');
          					if (!container.is(e.target) && container.has(e.target).length === 0){
          						$('.smalldelmenu_bg').addClass('hide');
          						$('.body').removeClass('stop_srolling');
          					}
          				});


                </script>
              <?php
            }else{
              echo "<div class='pl_header_content'>";
                echo "<a href='".$_dhp."watch/".$first_video_vuid."&pl=".$puid."' title='".$pl_name."' class='pl_header_title no_overflow'>".$pl_name."</a>";
                echo "<a href='".$_dhp."user/".$pl_user_name."' title='".$pl_user_name."' class='videopreview_user_name no_overflow pad-0 marg-top-5'><img src='".$_ddhp.$f->draw_avatar($pl_uuid,'small')."'/>".$pl_user_name."</a>";
                echo "<div class='pl_header_text'>".$pl_notiz_link."</div>";
              echo "</div>";
            }
            echo "<div style='clear:both;'></div>";
        echo "</div>";
        //end pl head

        //pl count videos title
          $vid_results = db::$link->query("SELECT COUNT(puid) FROM playlist_content_db WHERE puid = '$puid' AND status = 'public'");

          if($vid_results){
            $get_total_rows = $vid_results->fetch_row();
            $get_total_rows = $get_total_rows[0];
            $allvideoCount  = $get_total_rows;
            $allvideoCount  = number_format($allvideoCount,0, ",", ".");
            $total_pages = ceil($get_total_rows/$item_per_page);
          }else{
            $allvideoCount = 0; $get_total_rows = 0; $total_pages = 0;
          }

        echo "<div class='allvideoTitle no_overflow marg-top-15'>";
          echo "<div class='allvideoCount left'>".$pl_name." (".$allvideoCount.")</div>";
        echo "</div>";

        //end pl count videos title
      ?>

      <?php //pl content ?>
			<?php if($get_total_rows != 0){ ?>

        <script>
        $(document).ready(function() {
          resultloadedforthumbpreview(); loadfun_plvideos();

          var track_click = 1;
          var total_pages = <?php echo $total_pages; ?>;
          var max_pos_load = 24;

          $(".load_more").click(function (e) {
            $(this).hide();
            $('.animation_image').show();

              if(track_click <= total_pages){
                $.post('<?php echo $_dhp; ?>ajax/pl_videos', {'puid': '<?php echo $puid; ?>','page': track_click}, function(data) {
                  $(".load_more").show();
                  $("#results").append(data);

                  <?php if($ar === 1){ ?>
                    $('.vidpl_posi_move_down_'+max_pos_load).html("<div posi='"+max_pos_load+"' class='vidpl_posi_move vidpl_posi_move_down noselect'> <div class='vidpl_posi_icon'> <span class='glyphicon glyphicon-chevron-down'></span> </div> </div>");
                    max_pos_load + 24;
                  <?php } ?>


                  $('.animation_image').hide();
                  track_click++; resultloadedforthumbpreview(); loadfun_plvideos();
                });

                if(track_click >= total_pages-1){
                  $(".load_more").attr("disabled", "disabled");
                  $(".load_more").addClass('hide');
                }
               } //end track_click <= total_pages

            }); //end load more function
        }); //end document load

        function loadfun_plvideos(){
          $('.vidpl_posi_box').height($('.videoplaylistline').height());

          $('.vidpl_posi_move_up').unbind('click').click(function(){
            var posi     = parseInt($(this).attr('posi'));
            var new_posi = posi - 1;

            $.post('<?php echo $_dhp; ?>playlists/change_posi', {'puid': '<?php echo $puid; ?>', 'first_posi': posi, 'second_posi': new_posi}, function(data) {
              if(data == 'ok'){
                var first_posi_html = $('.videoplaylist_con_'+posi).html();
                $('.videoplaylist_con_'+posi).html( $('.videoplaylist_con_'+new_posi).html() );
                $('.videoplaylist_con_'+new_posi).html(first_posi_html);
                resultloadedforthumbpreview(); loadfun_plvideos();
              }
            });
          });

          $('.vidpl_posi_move_down').unbind('click').click(function(){
            var posi = parseInt($(this).attr('posi'));
            var new_posi = posi + 1;

            $.post('<?php echo $_dhp; ?>playlists/change_posi', {'puid': '<?php echo $puid; ?>', 'first_posi': posi, 'second_posi': new_posi}, function(data) {
              if(data == 'ok'){
                  var first_posi_html = $('.videoplaylist_con_'+posi).html();
                  $('.videoplaylist_con_'+posi).html( $('.videoplaylist_con_'+new_posi).html() );
                  $('.videoplaylist_con_'+new_posi).html(first_posi_html);
                resultloadedforthumbpreview(); loadfun_plvideos();
              }
            });
          });

          $('.videoplaylist_more_opt').unbind('click').click(function(){
            var vuid = $(this).attr('vuid');
              if( $('.videoplaylist_more_opt_menu_'+vuid).hasClass('hide') ){
                $('.videoplaylist_more_opt_menu').addClass('hide');
                $('.videoplaylist_more_opt_menu_'+vuid).removeClass('hide');
              }else{
                $('.videoplaylist_more_opt_menu').addClass('hide');
              }
          });
            $(document).mouseup(function (e){
              var container = $('.videoplaylist_more_opt');
                if (!container.is(e.target) && container.has(e.target).length === 0){
                  $('.videoplaylist_more_opt_menu').addClass('hide');
                }
            });

          $('.videoplaylist_remove_video').unbind('click').click(function(){
            var vuid = $(this).attr('vuid');
            var puid = $(this).attr('puid');
              $.post('<?php echo $_dhp;?>playlists/add',{'vuid': vuid, 'puid': puid, 'move': 'add/remove'}, function(data) {
                if(data == 'add'){
                  $.post('<?php echo $_dhp;?>playlists/add',{'vuid': vuid, 'puid': puid, 'move': 'add/remove'}, function(data) {
                    gotosite('<?php echo $_dhp?>playlist/'+puid,'','0');
                  });
                }else if(data == 'remove'){
                  gotosite('<?php echo $_dhp?>playlist/'+puid,'','0');
                }else{
                  gotosite('<?php echo $_dhp?>playlist/'+puid,'','0');
                }
              });
          });

          $('.videoplaylist_change_thumb').unbind('click').click(function(){
          var vuid = $(this).attr('vuid');
          var puid = $(this).attr('puid');
            $.post('<?php echo $_dhp;?>playlists/add',{'vuid': vuid, 'puid': puid, 'move': 'thumb'}, function(data) {
              if(data == 'new_thumb'){
                $('#'+puid).attr('src','<?php echo $_dhp;?>images/thumb/large_img/'+vuid+'.jpg');
              }
            });
          });


        }

        $(window).resize(function() {
          $('.vidpl_posi_box').height($('.thumb_holder').height());
        });

      </script>


        <div id="results">
          <?php
					$page_number = 0;
					require_once ($_hp."ajax/pl_videos.php");
					?>
        </div>
          <div align="center">
          <button class="load_more w-100 blue_btn btn-default btn" id="load_more_button" <?php if($get_total_rows <= $item_per_page){echo "disabled='disabled'";}else{} ?> ><?php echo $l->loadmore; ?></button>
          <div class="animation_image" style="display:none;"><img src="<?php echo $_dhp; ?>images/icons/ajax-loader.gif"> <?php echo $l->loading; ?></div>
          </div>
				<?php }else{
					echo "<div class='marg-l-15'>
						<span class='left w-100'>".$l->pl_title_embty."</span>";
					echo "</div>";
				} ?>





      <?php
      } //end pl can show
      ?>
      </div>
			<div class="column3 col-xs-0 col-sm-0 col-md-0 col-lg-1 col-xl-3 col-spl"></div>
    </div>



<?php if($infram != 1){?>
		</div>
	</body>
</html>
<?php  }
?>
