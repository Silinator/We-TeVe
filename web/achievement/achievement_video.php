<?php

if(!isset($channel_uuid) AND !isset($page) ){

    //1. Pfad zum Stammverzeichniss wo sich die index befindet

    $_hp = '../'; //für include
    $_dhp = '../'; // für daten

    //2. all include
    $in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
    require_once ($_hp.'include/all_include.php'); //haupt includ

}

//post value
if(isset($_POST["page"])){
	$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
}elseif(isset($page)){
	$page_number = $page;
}

if(isset($_POST['channel_uuid'])){$channel_uuid = $_POST['channel_uuid'];}
elseif(isset($channel_uuid)){$channel_uuid = $channel_uuid;}
else{$channel_uuid = 0;}  $channel_uuid = mysqli_real_escape_string(db::$link,$channel_uuid);


//HTTP error
$item_per_page = 9;

if(!is_numeric($page_number)){header('HTTP/1.1 500 Invalid page number!');exit();}


$channel_uuif = sha1(sha1($channel_uuid));


		$channel_name  = $u->userin('name','0',$channel_uuif,'');
		$channel_subs  = $u->userin('abos',0,$channel_uuif,'');
		$channel_sub_n = number_format($channel_subs,0, ",", ".");
		$channel_land  = $u->userin('land',0,$channel_uuif,'');
		$channel_xp    = $u->userin('xp',0,$channel_uuif,'');
		$channel_beitrit = $u->userin('beitrit',0,$channel_uuif,'');

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

				//wie viel Prozent der totalen level fortschritt balken
				$channel_t_levelfortschritline = $channel_xp / $lvl->lvlinfo('txp','1000') * 100;
			}
			$channel_b_level = $lvl->lvlicon('b',$channel_level); $channel_n_level = $lvl->lvlicon('n',$channel_level);
			$channel_c_level = $lvl->lvlicon('c',$channel_level); $channel_f_level = $lvl->lvlicon('f',$channel_level);



	$position = ($page_number * $item_per_page);

	$video_ach_sql = db::$link->query("SELECT * FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' AND privacy = 'public' ORDER BY uploaddate DESC LIMIT $position, $item_per_page");


while($row = $video_ach_sql->fetch_array()){

	$vuid = $row['vuid'];

	echo "<div class='col-xs-12 col-sm-6 col-md-4 video_ach_box'>";

      echo $f->draw_video_pewview($vuid,1,'ver','',$_dhp,$_ddhp,'small','0');

  //100 ach

    $video_views = $row['views'];

    if($video_views > 10000){$video_views = 10000;}

    if($video_views < 1000)                            {$for_ach_100 = 0;}
    if($video_views < 1000 AND $video_views >= 100)    {$for_ach_100 = 1;}
    if($video_views < 10000 AND $video_views >= 1000)  {$for_ach_100 = 2;}
    if($video_views >= 10000)                         {$for_ach_100 = 3;}

    $videoviews = number_format($video_views,0, ",", ".");


		if($for_ach_100 != 0)
		{
			$res_ach100_color = "c_level_".$channel_b_level;
		}

    if($for_ach_100 == 0)
    {
      $res_ach100_sub_text = $l->hidden_achievement;
      $res_ach100_color = "b_level_".$channel_b_level;
      $ach100fortschritline = 100 * $video_views / 100;
      $ach101fortschritline = 0;
      $ach102fortschritline = 0;
      $res_ach100_prog = $videoviews."/100";
      $ach100_symbol = "ach100_symbol";
    }
    elseif($for_ach_100 == 1)
    {
      $ach100fortschritline = 100;
      $ach101fortschritline = 100 * ($video_views -100) / 900;
      $ach102fortschritline = 0;
      $res_ach100_prog = $videoviews."/1000";
      $ach100_symbol = "ach100_symbol";
    }
    elseif($for_ach_100 == 2)
    {
      $ach100fortschritline = 100;
      $ach101fortschritline = 100;
      $ach102fortschritline = 100 * ($video_views - 1000) / 8900;
      $res_ach100_prog = $videoviews."/10k";
      $ach100_symbol = "ach101_symbol";
    }
    elseif($for_ach_100 == 3)
    {
      $ach100fortschritline = 100;
      $ach101fortschritline = 100;
      $ach102fortschritline = 100;
      $res_ach100_prog = $videoviews."/10k";
      $ach100_symbol = "ach102_symbol";
    }

    echo "<div class='video_ach_info video_ach_100'>";

      echo "<div class='video_ach_top'>
          <div class='video_ach_icon ".$res_ach100_color."'><div class='video_ach_icon_text ".$ach100_symbol." f_ach_1' ></div></div>
          <div class='video_ach_sub_title'>".$l->res_ach_title_100."</div>
          <div class='video_ach_sub_text'>".$l->res_ach_text_100."</div>
      </div>";


      echo"<div class='res_video_ach_progress'>
        <div id='resbigProgressBarach100' class='ThreeRes ThreeResSmallProgressBarLevel b_level_".$channel_b_level."'>
          <div id='resbigProgressBarach100-".$vuid."f' class='ThreeResSmallProgressBarLevelfront c_level_".$channel_c_level."'></div>
        </div>
        <div id='resbigProgressBarach101' class='ThreeRes ThreeResSmallProgressBarLevel b_level_".$channel_b_level."'>
          <div id='resbigProgressBarach101-".$vuid."f' class='ThreeResSmallProgressBarLevelfront c_level_".$channel_c_level."'></div>
        </div>
        <div id='resbigProgressBarach102' class='ThreeResSmallProgressBarLevel b_level_".$channel_b_level."'>
          <div id='resbigProgressBarach102-".$vuid."f' class='ThreeResSmallProgressBarLevelfront c_level_".$channel_c_level."'></div>
        </div>
        <div class='res_ach_progress_counter'>".$res_ach100_prog."</div>
      </div>";



  //110 ach
		$bewertung_bank_sql = db::$link->query("SELECT COUNT(kuid) FROM kommentar_db WHERE vuid = '$vuid' AND uuid != '$channel_uuid' AND status = 'public'");
		$bewertung_bank_row = $bewertung_bank_sql->fetch_row();

    $com_count = $bewertung_bank_row[0];

    if($com_count > 1000){$com_count = 1000;}

    if($com_count < 10)                          {$for_ach_110 = 0;}
    if($com_count < 100 AND $com_count >= 10)    {$for_ach_110 = 1;}
    if($com_count < 1000 AND $com_count >= 100)  {$for_ach_110 = 2;}
    if($com_count >= 1000)                       {$for_ach_110 = 3;}

    $com_count = number_format($com_count,0, ",", ".");

		if($for_ach_110 != 0)
		{
			$res_ach110_color = "c_level_".$channel_b_level;
		}

    if($for_ach_110 == 0)
    {
      $res_ach110_sub_text = $l->hidden_achievement;
      $res_ach110_color = "b_level_".$channel_b_level;
      $ach110fortschritline = 100 * $com_count / 10;
      $ach111fortschritline = 0;
      $ach112fortschritline = 0;
      $res_ach110_prog = $com_count."/10";
      $ach110_symbol = "ach110_symbol";
    }
    elseif($for_ach_110 == 1)
    {
      $ach110fortschritline = 100;
      $ach111fortschritline = 100 * ($com_count -10) / 90;
      $ach112fortschritline = 0;
      $res_ach110_prog = $com_count."/100";
      $ach110_symbol = "ach110_symbol";
    }
    elseif($for_ach_110 == 2)
    {
      $ach110fortschritline = 100;
      $ach111fortschritline = 100;
      $ach112fortschritline = 100 * ($com_count - 100) / 890;
      $res_ach110_prog = $com_count."/1.000";
      $ach110_symbol = "ach111_symbol";
    }
    elseif($for_ach_110 == 3)
    {
      $ach110fortschritline = 100;
      $ach111fortschritline = 100;
      $ach112fortschritline = 100;
      $res_ach110_prog = $com_count."/1.000";
      $ach110_symbol = "ach112_symbol";
    }


      echo "<div class='video_ach_top'>
          <div class='video_ach_icon ".$res_ach110_color."'><div class='video_ach_icon_text ".$ach110_symbol." f_ach_1' ></div></div>
          <div class='video_ach_sub_title'>".$l->res_ach_title_110."</div>
          <div class='video_ach_sub_text'>".$l->res_ach_text_110."</div>
      </div>";


      echo"<div class='res_video_ach_progress'>
        <div id='resbigProgressBarach110' class='ThreeRes ThreeResSmallProgressBarLevel b_level_".$channel_b_level."'>
          <div id='resbigProgressBarach110-".$vuid."f' class='ThreeResSmallProgressBarLevelfront c_level_".$channel_c_level."'></div>
        </div>
        <div id='resbigProgressBarach111' class='ThreeRes ThreeResSmallProgressBarLevel b_level_".$channel_b_level."'>
          <div id='resbigProgressBarach111-".$vuid."f' class='ThreeResSmallProgressBarLevelfront c_level_".$channel_c_level."'></div>
        </div>
        <div id='resbigProgressBarach112' class='ThreeResSmallProgressBarLevel b_level_".$channel_b_level."'>
          <div id='resbigProgressBarach112-".$vuid."f' class='ThreeResSmallProgressBarLevelfront c_level_".$channel_c_level."'></div>
        </div>
        <div class='res_ach_progress_counter'>".$res_ach110_prog."</div>
      </div>";





			//120 ach
				$bewertung_bank_sql = db::$link->query("SELECT pos_vote FROM video_db WHERE uuid = '$channel_uuid' AND vuid = '$vuid' AND status = 'uploaded'");
				$bewertung_bank_row = $bewertung_bank_sql->fetch_assoc();

		    $like_count = $bewertung_bank_row['pos_vote'];

		    if($like_count > 1000){$like_count = 1000;}

		    if($like_count < 10)                          {$for_ach_120 = 0;}
		    if($like_count < 100 AND $like_count >= 10)    {$for_ach_120 = 1;}
		    if($like_count < 1000 AND $like_count >= 100)  {$for_ach_120 = 2;}
		    if($like_count >= 1000)                       {$for_ach_120 = 3;}

		    $like_count = number_format($like_count,0, ",", ".");


				if($for_ach_120 != 0)
				{
					$res_ach120_color = "c_level_".$channel_b_level;
				}


		    if($for_ach_120 == 0)
		    {
		      $res_ach120_sub_text = $l->hidden_achievement;
		      $res_ach120_color = "b_level_".$channel_b_level;
		      $ach120fortschritline = 100 * $like_count / 10;
		      $ach121fortschritline = 0;
		      $ach122fortschritline = 0;
		      $res_ach120_prog = $like_count."/10";
		      $ach120_symbol = "ach120_symbol";
		    }
		    elseif($for_ach_120 == 1)
		    {
		      $ach120fortschritline = 100;
		      $ach121fortschritline = 100 * ($like_count - 10) / 90;
		      $ach122fortschritline = 0;
		      $res_ach120_prog = $like_count."/100";
		      $ach120_symbol = "ach120_symbol";
		    }
		    elseif($for_ach_120 == 2)
		    {
		      $ach120fortschritline = 100;
		      $ach121fortschritline = 100;
		      $ach122fortschritline = 100 * ($like_count - 100) / 890;
		      $res_ach120_prog = $like_count."/1.000";
		      $ach120_symbol = "ach121_symbol";
		    }
		    elseif($for_ach_120 == 3)
		    {
		      $ach120fortschritline = 100;
		      $ach121fortschritline = 100;
		      $ach122fortschritline = 100;
		      $res_ach120_prog = $like_count."/1.000";
		      $ach120_symbol = "ach122_symbol";
		    }


		      echo "<div class='video_ach_top'>
							<div class='video_ach_icon ".$res_ach120_color."'><div class='video_ach_icon_text ".$ach120_symbol." f_ach_1' ></div></div>
		          <div class='video_ach_sub_title'>".$l->res_ach_title_120."</div>
		          <div class='video_ach_sub_text'>".$l->res_ach_text_120."</div>
		      </div>";


		      echo"<div class='res_video_ach_progress'>
		        <div id='resbigProgressBarach120' class='ThreeRes ThreeResSmallProgressBarLevel b_level_".$channel_b_level."'>
		          <div id='resbigProgressBarach120-".$vuid."f' class='ThreeResSmallProgressBarLevelfront c_level_".$channel_c_level."'></div>
		        </div>
		        <div id='resbigProgressBarach121' class='ThreeRes ThreeResSmallProgressBarLevel b_level_".$channel_b_level."'>
		          <div id='resbigProgressBarach121-".$vuid."f' class='ThreeResSmallProgressBarLevelfront c_level_".$channel_c_level."'></div>
		        </div>
		        <div id='resbigProgressBarach122' class='ThreeResSmallProgressBarLevel b_level_".$channel_b_level."'>
		          <div id='resbigProgressBarach122-".$vuid."f' class='ThreeResSmallProgressBarLevelfront c_level_".$channel_c_level."'></div>
		        </div>
		        <div class='res_ach_progress_counter'>".$res_ach120_prog."</div>
		      </div>";






    echo "</div>";
  echo "</div>";
  ?>
  <script>
    $(document).ready(function() {
			resultloadedforthumbpreview();
      $('#resbigProgressBarach100-<?php echo $vuid; ?>f').width('<?php echo $ach100fortschritline."%";?>');
      $('#resbigProgressBarach101-<?php echo $vuid; ?>f').width('<?php echo $ach101fortschritline."%";?>');
      $('#resbigProgressBarach102-<?php echo $vuid; ?>f').width('<?php echo $ach102fortschritline."%";?>');

      $('#resbigProgressBarach110-<?php echo $vuid; ?>f').width('<?php echo $ach110fortschritline."%";?>');
      $('#resbigProgressBarach111-<?php echo $vuid; ?>f').width('<?php echo $ach111fortschritline."%";?>');
      $('#resbigProgressBarach112-<?php echo $vuid; ?>f').width('<?php echo $ach112fortschritline."%";?>');

      $('#resbigProgressBarach120-<?php echo $vuid; ?>f').width('<?php echo $ach120fortschritline."%";?>');
      $('#resbigProgressBarach121-<?php echo $vuid; ?>f').width('<?php echo $ach121fortschritline."%";?>');
      $('#resbigProgressBarach122-<?php echo $vuid; ?>f').width('<?php echo $ach122fortschritline."%";?>');
    });
  </script>
  <?php

}

?>
