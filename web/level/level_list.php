<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = "../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include



echo "<div class='class='w-100 left'><a class='level_dd_title' href='".$_dhp,"user/".$user_name."/achv'>".$l->level_now_title."</a></div>";

$uuif = sha1(sha1($user_uuid));
$xp = $u->userin('xp',0,$uuif,'');

  if($xp >= $lvl->lvlinfo('txp','1000')){ $level = 1000; $levelup = 1000; $levelfortschrit = 100; $xplevel_over = $lvl->lvlinfo('txp','1000'); $xplevel_needed_for_next_level = $xplevel_over; }
  elseif($xp <= 0){$level = 0; $levelup = 1; $levelfortschrit = 0; $xplevel_over = $xp; $xplevel_needed_for_next_level = $lvl->lvlinfo('xp','1');
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



$level   = $lvl->lvlinfo('level',$xp);

$b_level = $lvl->lvlicon('b',$level);
$n_level = $lvl->lvlicon('n',$level);
$c_level = $lvl->lvlicon('c',$level);
$f_level = $lvl->lvlicon('f',$level);

echo "<div class='level_now' id='level_now'>";
  echo "<div class='level_icon' id='level_icon'>";
      echo"<div class='level_content_back channel_middle_level_symbol'>";
        echo "<div class='level_border_back level_67_line_top b_level_".$b_level."'> <div class='level_border_front navi_level_67_line_top_draw c_level_".$c_level."'></div> </div>
          <div class='level_border_back level_67_corner_top_left b_level_".$b_level."'> <div class='level_border_front navi_level_67_corner_top_left_draw c_level_".$c_level."'></div> </div>
        <div class='level_border_back level_67_line_right b_level_".$b_level."' > <div class='level_border_front navi_level_67_line_right_draw c_level_".$c_level."'></div> </div>
          <div class='level_border_back level_67_corner_top_right b_level_".$b_level."'> <div class='level_border_front navi_level_67_corner_top_right_draw c_level_".$c_level."'></div> </div>
        <div class='level_border_back level_67_line_bottom b_level_".$b_level."'> <div class='level_border_front navi_level_67_line_bottom_draw c_level_".$c_level."'></div> </div>
          <div class='level_border_back level_67_corner_bottom_right b_level_".$b_level."'> <div class='level_border_front navi_level_67_corner_bottom_right_draw c_level_".$c_level."'></div> </div>
        <div class='level_border_back level_67_line_left b_level_".$b_level."'> <div class='level_border_front navi_level_67_line_left_draw c_level_".$c_level."'></div> </div>
          <div class='level_border_back level_67_corner_bottom_left b_level_".$b_level."'> <div class='level_border_front navi_level_67_corner_bottom_left_draw c_level_".$c_level."'></div> </div>

        <div class='level_content n_67_level_".$n_level." c_level_".$c_level."'>
          <div class='level_number f_level_".$f_level." this_level'>
            ".$level."
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

echo "<div class='level_now_content'>";
  echo "<div class='ProgressBarLevel b_level_".$b_level."'>";
    echo "<div class='ProgressBarLevelfront c_level_".$c_level."'></div>";
  echo "</div>";

  echo "<div class='level_xp_needed'>".number_format($xplevel_over,0, ',', '.')."xp</div>";
  echo "<div class='level_xp_to_next_level'>".number_format($xplevel_needed_for_next_level,0, ',', '.')."xp</div>";

  $xplevel_needed_for_next_levelup = $xplevel_needed_for_next_level - $xplevel_over;

  echo "<div class='level_xp_needed_for_next_level'>".$l->level_now_text0." <span class='blue'>".number_format($xplevel_needed_for_next_levelup,0, ',', '.')."xp</span> ".$l->level_now_text01."</div>";

echo "</div>";


$item_per_page = 20;
$get_total_rows = 0;
$results = db::$link->query("SELECT COUNT(xp_id) FROM xp_db WHERE uuid = '$user_uuid' AND status = 'public'");
if($results){
  $get_total_rows = $results->fetch_row();
}

//break total records into pages
$total_pages = ceil($get_total_rows[0]/$item_per_page);


//level Tagebuch
echo "<br><div class='w-100 left blue level_dd_title'>".$l->level_diary_title."</div>";

if($get_total_rows[0] != 0){
  echo "<div id='level_results' class='level_diary_list'>";
    echo "<table><tbody class='level_diary_list_content'>";
      $page = 0;
      require_once ($_hp."level/level_diary.php");
    echo"</tbody></table>";
  ?>

  <div center='marg-l-10' align="center">
  <button class="load_more_level_diary w-100 blue_btn btn-default button <?php if($total_pages <= 1){echo "hide";}else{} ?>" id="load_more_button" <?php if($total_pages <= 1){echo "disabled='disabled'";}else{} ?> ><?php echo $l->loadmore; ?></button>
  <div class="animation_image_level_diary" style="display:none;"><img src="<?php echo $_dhp; ?>images/icons/ajax-loader.gif"> <?php echo $l->loading; ?></div>
  </div>

  <?php

}else{
  echo $l->level_title_empty;
}

  echo "</div>";
?>


<script>

var track_click = 1;
var total_pages = <?php echo $total_pages; ?>;
loadfun_falseLink(); coms_loaded();

$(".load_more_level_diary").click(function (e) {
  $(this).hide();
  $('.animation_image_level_diary').show();

    if(track_click <= total_pages)
    {
        $.post('<?php echo $_dhp; ?>level/level_diary', {'page': track_click}, function(data) {
          $(".load_more_level_diary").show();
          $(".level_diary_list_content").append(data);

          //scroll die seite automatisch
          //$("html, body").animate({scrollTop: $("#load_more_button").offset().top}, 500);

          $('.animation_image_level_diary').hide();
          track_click++; loadfun_falseLink(); coms_loaded();

        });

        if(track_click >= total_pages-1)
        {
          $(".load_more_level_diary").attr("disabled", "disabled");
          $(".load_more_level_diary").addClass('hide');
        }

    } //end track_click <= total_pages
}); //end load more function


function run_navi_level_list_animation(){
  <?php if($levelfortschrit > 0){?>
    $('.navi_level_67_corner_top_left_draw').animate({width: 3}, 0, function() {
  <?php } ?>

    <?php if($levelfortschrit >= 25){?>
      $('.navi_level_67_line_top_draw').animate({width: 61}, 250, function() {
      <?php }elseif($levelfortschrit < 25){ ?>
        $('.navi_level_67_line_top_draw').animate({width: <?php $top_line_width = 61 * $levelfortschrit * 4 / 100;  echo $top_line_width;?>}, 250, function() {
      <?php } ?>

        <?php if($levelfortschrit >= 25){?>
          $('.navi_level_67_corner_top_right_draw').animate({width: 3}, 0);
          $('.navi_level_67_corner_top_right_draw').animate({height: 3}, 0, function() {
        <?php } ?>

          <?php if($levelfortschrit >= 50){?>
            $('.navi_level_67_line_right_draw').animate({height: 61}, 250, function() {
          <?php }elseif($levelfortschrit < 50 AND $levelfortschrit > 25){ ?>
            $('.navi_level_67_line_right_draw').animate({height: <?php $right_line_height = 61 * ($levelfortschrit - 25) * 4 / 100;  echo $right_line_height;?>}, 250, function() {
          <?php } ?>

            <?php if($levelfortschrit >= 50){?>
              $('.navi_level_67_corner_bottom_right_draw').animate({width: 3}, 0);
              $('.navi_level_67_corner_bottom_right_draw').animate({height: 3}, 0, function() {
            <?php } ?>

              <?php if($levelfortschrit >= 75){?>
                $('.navi_level_67_line_bottom_draw').animate({width: 61}, 250, function() {
                <?php }elseif($levelfortschrit < 75 AND $levelfortschrit > 50){ ?>
                  $('.navi_level_67_line_bottom_draw').animate({width:<?php $bottom_line_width = 61 * ($levelfortschrit - 50) * 4 / 100;  echo $bottom_line_width;?>}, 250, function() {
                <?php } ?>

                <?php if($levelfortschrit >= 75){?>
                  $('.navi_level_67_corner_bottom_left_draw').animate({width: 3}, 0);
                  $('.navi_level_67_corner_bottom_left_draw').animate({height: 3}, 0, function() {
                <?php } ?>

                  <?php if($levelfortschrit >= 100){?>
                    $('.navi_level_67_line_left_draw').animate({height: 61}, 250, function() {
                    <?php }elseif($levelfortschrit < 100 AND $levelfortschrit > 75){ ?>
                      $('.navi_level_67_line_left_draw').animate({height:<?php $left_line_height = 61 * ($levelfortschrit - 75) * 4 / 100;  echo $left_line_height;?>}, 250, function() {
                    <?php } ?>

                <?php if($levelfortschrit < 100 AND $levelfortschrit > 75){ ?> }); <?php } ?>
                <?php if($levelfortschrit >= 100){?> }); <?php } ?>

              <?php if($levelfortschrit >= 75){?>	}); <?php } ?>

            <?php if($levelfortschrit < 75 AND $levelfortschrit > 50){ ?> }); <?php } ?>
            <?php if($levelfortschrit >= 75){?> }); <?php } ?>

          <?php if($levelfortschrit >= 50){?> }); <?php } ?>

        <?php if($levelfortschrit < 50 AND $levelfortschrit > 25){ ?> }); <?php } ?>
        <?php if($levelfortschrit >= 50){?> }); <?php } ?>

      <?php if($levelfortschrit >= 25){?> }); <?php } ?>

    <?php if($levelfortschrit < 25){?> }); <?php } ?>
    <?php if($levelfortschrit >= 25){?> }); <?php } ?>

  <?php if($levelfortschrit > 0){?> }); <?php } ?>

  $('.ProgressBarLevelfront').width('<?php echo $levelfortschrit."%";?>');

}

</script>
