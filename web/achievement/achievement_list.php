<?php


//dreiteilige
//errungenschaften


// für das liken von 5 50 500 Videos  140 141 142
  $sql_bewertung_bank = db::$link->query("SELECT COUNT(vote_id) FROM video_vote_db WHERE uuid = '$channel_uuid' AND vote = 'pos' AND status = 'public'");
  $get_bewertung = $sql_bewertung_bank->fetch_row();
    $like_count = $get_bewertung[0];

  if($like_count > 500){$like_count = 500;}
    if($like_count < 5)                          {$for_ach_140 = 0;}
    if($like_count < 50 AND $like_count >= 5)    {$for_ach_140 = 1;}
    if($like_count < 500 AND $like_count >= 50)  {$for_ach_140 = 2;}
    if($like_count >= 500)                       {$for_ach_140 = 3;}

  $like_count = number_format($like_count,0, ",", ".");



  if($for_ach_140 != 0)
  {
    $res_ach140_color = "c_level_".$channel_b_level;
  }

  if($for_ach_140 == 0)
  {
    $res_ach140_sub_text = $l->hidden_achievement;
    $res_ach140_color = "b_level_".$channel_b_level;
    $ach140fortschritline = 100 * $like_count / 5;
    $ach141fortschritline = 0;
    $ach142fortschritline = 0;
    $res_ach140_prog = $like_count."/5";
    $ach140_symbol = "ach140_symbol";
  }
  elseif($for_ach_140 == 1)
  {
    $link = db::$link->query("SELECT * FROM achievement_db WHERE achievement = '140' AND uuid = '$channel_uuid' AND status = 'public'");
    $daten = $link->fetch_assoc();

    $time_code = $daten['time'];
    $time_ach_140 = $t->invor($time_code);

    $get_ach_140_date = $time_ach_140;
    $d_ach_140 = number_format($lvl->ach_140,0, ",", ".");
    $res_ach140_sub_text = $d_ach_140."".$l->level_xp_title." - ".$l->achstep1." ".$l->ach_at." ".$get_ach_140_date;

    $ach140fortschritline = 100;
    $ach141fortschritline = 100 * ($like_count -5) / 45;
    $ach142fortschritline = 0;
    $res_ach140_prog = $like_count."/50";
    $ach140_symbol = "ach140_symbol";
  }
  elseif($for_ach_140 == 2)
  {
    $link = db::$link->query("SELECT * FROM achievement_db WHERE achievement = '141' AND uuid = '$channel_uuid' AND status = 'public'");
    $daten = $link->fetch_assoc();
    $time_code = $daten['time'];
    $time_ach_140 = $t->invor($time_code);

    $get_ach_140_date = $time_ach_140;
    $d_ach_141 = number_format($lvl->ach_141,0, ",", ".");
    $res_ach140_sub_text = $d_ach_141."".$l->level_xp_title." - ".$l->achstep2." ".$l->ach_at." ".$get_ach_140_date;

    $ach140fortschritline = 100;
    $ach141fortschritline = 100;
    $ach142fortschritline = 100 * ($like_count -50) / 450;
    $res_ach140_prog = $like_count."/500";
    $ach140_symbol = "ach141_symbol";
  }
  elseif($for_ach_140 == 3)
  {
    $link = db::$link->query("SELECT * FROM achievement_db WHERE achievement = '140' AND uuid = '$channel_uuid' AND status = 'public'");
    $daten = $link->fetch_assoc();
    $time_code = $daten['time'];
    $time_ach_140 = $t->invor($time_code);

    $get_ach_140_date = $time_ach_140;
    $d_ach_142 = number_format($lvl->ach_142,0, ",", ".");
    $res_ach140_sub_text = $d_ach_142."".$l->level_xp_title." - ".$l->achstep3." ".$l->ach_at." ".$get_ach_140_date;

    $ach140fortschritline = 100;
    $ach141fortschritline = 100;
    $ach142fortschritline = 100;
    $res_ach140_prog = $like_count."/500";
    $ach140_symbol = "ach142_symbol";
  }
// ende für das liken von 5 50 500 Videos  140 141 142






// für das schreiben von 10 100 1000 Kommentare   150 151 152
  $bewertung_bank_sql = db::$link->query("SELECT COUNT(kuid) FROM kommentar_db WHERE uuid = '$channel_uuid' AND status = 'public'");
  $bewertung_bank_row = $bewertung_bank_sql->fetch_row();
    $com_count = $bewertung_bank_row[0];

  if($com_count > 1000){$com_count = 1000;}
    if($com_count < 10)                          {$for_ach_150 = 0;}
    if($com_count < 100 AND $com_count >= 10)    {$for_ach_150 = 1;}
    if($com_count < 1000 AND $com_count >= 100)  {$for_ach_150 = 2;}
    if($com_count >= 1000)                       {$for_ach_150 = 3;}

  $com_count = number_format($com_count,0, ",", ".");


  if($for_ach_150 != 0)
  {
    $res_ach150_color = "c_level_".$channel_b_level;
  }

  if($for_ach_150 == 0)
  {
    $res_ach150_sub_text = $l->hidden_achievement;
    $res_ach150_color = "b_level_".$channel_b_level;
    $ach150fortschritline = 100 * $com_count / 10;
    $ach151fortschritline = 0;
    $ach152fortschritline = 0;
    $res_ach150_prog = $com_count."/10";
    $ach150_symbol = "ach150_symbol";
  }
  elseif($for_ach_150 == 1)
  {
    $link = db::$link->query("SELECT * FROM achievement_db WHERE achievement = '150' AND uuid = '$channel_uuid' AND status = 'public'");
    $daten = $link->fetch_assoc();
    $time_code = $daten['time'];
    $time_ach_150 = $t->invor($time_code);

    $get_ach_150_date = $time_ach_150;
    $d_ach_150 = number_format($lvl->ach_150,0, ",", ".");
    $res_ach150_sub_text = $d_ach_150."".$l->level_xp_title." - ".$l->achstep1." ".$l->ach_at." ".$get_ach_150_date;

    $ach150fortschritline = 100;
    $ach151fortschritline = 100 * ($com_count -10) / 90;
    $ach152fortschritline = 0;
    $res_ach150_prog = $com_count."/100";
    $ach150_symbol = "ach150_symbol";
  }
  elseif($for_ach_150 == 2)
  {
    $link = db::$link->query("SELECT * FROM achievement_db WHERE achievement = '151' AND uuid = '$channel_uuid' AND status = 'public'");
    $daten = $link->fetch_assoc();
    $time_code = $daten['time'];
    $time_ach_150 = $t->invor($time_code);

    $get_ach_150_date = $time_ach_150;
    $d_ach_151 = number_format($lvl->ach_151,0, ",", ".");
    $res_ach150_sub_text = $d_ach_151."".$l->level_xp_title." - ".$l->achstep2." ".$l->ach_at." ".$get_ach_150_date;

    $ach150fortschritline = 100;
    $ach151fortschritline = 100;
    $ach152fortschritline = 100 * ($com_count -100) / 900;
    $res_ach150_prog = $com_count."/1.000";
    $ach150_symbol = "ach151_symbol";
  }
  elseif($for_ach_150 == 3)
  {
    $link = db::$link->query("SELECT * FROM achievement_db WHERE achievement = '152' AND uuid = '$channel_uuid' AND status = 'public'");
    $daten = $link->fetch_assoc();
    $time_code = $daten['time'];
    $time_ach_150 = $t->invor($time_code);

    $get_ach_150_date = $time_ach_150;
    $d_ach_152 = number_format($lvl->ach_152,0, ",", ".");
    $res_ach150_sub_text = $d_ach_152."".$l->level_xp_title." - ".$l->achstep3." ".$l->ach_at." ".$get_ach_150_date;

    $ach150fortschritline = 100;
    $ach151fortschritline = 100;
    $ach152fortschritline = 100;
    $res_ach150_prog = $com_count."/1.000";
    $ach150_symbol = "ach152_symbol";
  }
// ende für das schreiben von 10 100 1000 Kommentare  150 151 152





// für sammeln von 10 100 1000 Abos auf dem Kanal 160 161 162
  $abo_count = $channel_subs;

  if($abo_count > 1000){$abo_count = 1000;}
    if($abo_count < 10)                          {$for_ach_160 = 0;}
    if($abo_count < 100 AND $abo_count >= 10)    {$for_ach_160 = 1;}
    if($abo_count < 1000 AND $abo_count >= 100)  {$for_ach_160 = 2;}
    if($abo_count >= 1000)                       {$for_ach_160 = 3;}

  $abo_count = number_format($abo_count,0, ",", ".");


  if($for_ach_160 != 0)
  {
    $res_ach160_color = "c_level_".$channel_b_level;
  }

  if($for_ach_160 == 0)
  {
    $res_ach160_sub_text = $l->hidden_achievement;
    $res_ach160_color = "b_level_".$channel_b_level;
    $ach160fortschritline = 100 * $abo_count / 10;
    $ach161fortschritline = 0;
    $ach162fortschritline = 0;
    $res_ach160_prog = $abo_count."/10";
    $ach160_symbol = "ach160_symbol";
  }
  elseif($for_ach_160 == 1)
  {
    $link = db::$link->query("SELECT * FROM achievement_db WHERE achievement = '160' AND uuid = '$channel_uuid' AND status = 'public'");
    $daten = $link->fetch_assoc();
    $time_code = $daten['time'];
    $time_ach_160 = $t->invor($time_code);

    $get_ach_160_date = $time_ach_160;
    $d_ach_160 = number_format($lvl->ach_160,0, ",", ".");
    $res_ach160_sub_text = $d_ach_160."".$l->level_xp_title." - ".$l->achstep1." ".$l->ach_at." ".$get_ach_160_date;

    $ach160fortschritline = 100;
    $ach161fortschritline = 100 * ($abo_count -10) / 90;
    $ach162fortschritline = 0;
    $res_ach160_prog = $abo_count."/100";
    $ach160_symbol = "ach160_symbol";
  }
  elseif($for_ach_160 == 2)
  {
    $link = db::$link->query("SELECT * FROM achievement_db WHERE achievement = '161' AND uuid = '$channel_uuid' AND status = 'public'");
    $daten = $link->fetch_assoc();
    $time_code = $daten['time'];
    $time_ach_160 = $t->invor($time_code);

    $get_ach_160_date = $time_ach_160;
    $d_ach_161 = number_format($lvl->ach_161,0, ",", ".");
    $res_ach160_sub_text = $d_ach_161."".$l->level_xp_title." - ".$l->achstep2." ".$l->ach_at." ".$get_ach_160_date;

    $ach160fortschritline = 100;
    $ach161fortschritline = 100;
    $ach162fortschritline = 100 * ($abo_count -100) / 900;
    $res_ach160_prog = $abo_count."/1.000";
    $ach160_symbol = "ach161_symbol";
  }
  elseif($for_ach_160 == 3)
  {
    $link = db::$link->query("SELECT * FROM achievement_db WHERE achievement = '162' AND uuid = '$channel_uuid' AND status = 'public'");
    $daten = $link->fetch_assoc();
    $time_code = $daten['time'];
    $time_ach_160 = $t->invor($time_code);

    $get_ach_160_date = $time_ach_160;
    $d_ach_162 = number_format($lvl->ach_162,0, ",", ".");
    $res_ach160_sub_text = $d_ach_162."".$l->level_xp_title." - ".$l->achstep3." ".$l->ach_at." ".$get_ach_160_date;

    $ach160fortschritline = 100;
    $ach161fortschritline = 100;
    $ach162fortschritline = 100;
    $res_ach160_prog = $abo_count."/1.000";
    $ach160_symbol = "ach162_symbol";
  }
// ende für sammeln von 10 100 1000 Abos auf dem Kanal 160 161 162






// für das abonnieren von 5 25 250 170 171 172
  $abo_bank_sql = db::$link->query("SELECT COUNT(abo_id) FROM abo_db WHERE user_uuid = '$channel_uuid' AND status = 'public'");
  $abo_bank_row = $abo_bank_sql->fetch_row();
    $aboed_count = $abo_bank_row[0];

  if($aboed_count > 250){$aboed_count = 250;}
    if($aboed_count < 5)                           {$for_ach_170 = 0;}
    if($aboed_count < 25 AND $aboed_count >= 5)    {$for_ach_170 = 1;}
    if($aboed_count < 250 AND $aboed_count >= 25)  {$for_ach_170 = 2;}
    if($aboed_count >= 250)                        {$for_ach_170 = 3;}

  $aboed_count = number_format($aboed_count,0, ",", ".");


  if($for_ach_170 != 0)
  {
    $res_ach170_color = "c_level_".$channel_b_level;
  }

  if($for_ach_170 == 0)
  {
    $res_ach170_sub_text = $l->hidden_achievement;
    $res_ach170_color = "b_level_".$channel_b_level;
    $ach170fortschritline = 100 * $aboed_count / 5;
    $ach171fortschritline = 0;
    $ach172fortschritline = 0;
    $res_ach170_prog = $aboed_count."/5";
    $ach170_symbol = "ach170_symbol";
  }
  elseif($for_ach_170 == 1)
  {
    $link = db::$link->query("SELECT * FROM achievement_db WHERE achievement = '170' AND uuid = '$channel_uuid' AND status = 'public'");
    $daten = $link->fetch_assoc();
    $time_code = $daten['time'];
    $time_ach_170 = $t->invor($time_code);

    $get_ach_170_date = $time_ach_170;
    $d_ach_170 = number_format($lvl->ach_170,0, ",", ".");
    $res_ach170_sub_text = $d_ach_170."".$l->level_xp_title." - ".$l->achstep1." ".$l->ach_at." ".$get_ach_170_date;

    $ach170fortschritline = 100;
    $ach171fortschritline = 100 * ($aboed_count -5) / 20;
    $ach172fortschritline = 0;
    $res_ach170_prog = $aboed_count."/25";
    $ach170_symbol = "ach170_symbol";
  }
  elseif($for_ach_170 == 2)
  {
    $link = db::$link->query("SELECT * FROM achievement_db WHERE achievement = '171' AND uuid = '$channel_uuid' AND status = 'public'");
    $daten = $link->fetch_assoc();
    $time_code = $daten['time'];
    $time_ach_170 = $t->invor($time_code);

    $get_ach_170_date = $time_ach_170;
    $d_ach_171 = number_format($lvl->ach_171,0, ",", ".");
    $res_ach170_sub_text = $d_ach_171."".$l->level_xp_title." - ".$l->achstep2." ".$l->ach_at." ".$get_ach_170_date;

    $ach170fortschritline = 100;
    $ach171fortschritline = 100;
    $ach172fortschritline = 100 * ($aboed_count -25) / 225;
    $res_ach170_prog = $aboed_count."/250";
    $ach170_symbol = "ach171_symbol";
  }
  elseif($for_ach_170 == 3)
  {
    $link = db::$link->query("SELECT * FROM achievement_db WHERE achievement = '172' AND uuid = '$channel_uuid' AND status = 'public'");
    $daten = $link->fetch_assoc();
    $time_code = $daten['time'];
    $time_ach_170 = $t->invor($time_code);

    $get_ach_170_date = $time_ach_170;
    $d_ach_172 = number_format($lvl->ach_172,0, ",", ".");
    $res_ach170_sub_text = $d_ach_172."".$l->level_xp_title." - ".$l->achstep3." ".$l->ach_at." ".$get_ach_170_date;

    $ach170fortschritline = 100;
    $ach171fortschritline = 100;
    $ach172fortschritline = 100;
    $res_ach170_prog = $aboed_count."/250";
    $ach170_symbol = "ach172_symbol";
  }
// ende für das abonnieren von 5 25 250   170 171 172



// für das hochladen von 5 50 100 Videos   180 181 182
  $video_bank_sql = db::$link->query("SELECT COUNT(vuid) FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' AND privacy = 'public'");
  $video_bank_row = $video_bank_sql->fetch_row();
    $video_count = $video_bank_row[0];

  if($video_count > 100){$video_count = 100;}
    if($video_count < 5)                           {$for_ach_180 = 0;}
    if($video_count < 50 AND $video_count >= 5)    {$for_ach_180 = 1;}
    if($video_count < 100 AND $video_count >= 50)  {$for_ach_180 = 2;}
    if($video_count >= 100)                        {$for_ach_180 = 3;}

  $video_count = number_format($video_count,0, ",", ".");


  if($for_ach_180 != 0)
  {
    $res_ach180_color = "c_level_".$channel_b_level;
  }

  if($for_ach_180 == 0)
  {
    $res_ach180_sub_text = $l->hidden_achievement;
    $res_ach180_color = "b_level_".$channel_b_level;
    $ach180fortschritline = 100 * $video_count / 5;
    $ach181fortschritline = 0;
    $ach182fortschritline = 0;
    $res_ach180_prog = $video_count."/5";
    $ach180_symbol = "ach180_symbol";
  }
  elseif($for_ach_180 == 1)
  {
    $link = db::$link->query("SELECT * FROM achievement_db WHERE achievement = '180' AND uuid = '$channel_uuid' AND status = 'public'");
    $daten = $link->fetch_assoc();
    $time_code = $daten['time'];
    $time_ach_180 = $t->invor($time_code);

    $get_ach_180_date = $time_ach_180;
    $d_ach_180 = number_format($lvl->ach_180,0, ",", ".");
    $res_ach180_sub_text = $d_ach_180."".$l->level_xp_title." - ".$l->achstep1." ".$l->ach_at." ".$get_ach_180_date;

    $ach180fortschritline = 100;
    $ach181fortschritline = 100 * ($video_count -5) / 45;
    $ach182fortschritline = 0;
    $res_ach180_prog = $video_count."/50";
    $ach180_symbol = "ach180_symbol";
  }
  elseif($for_ach_180 == 2)
  {
    $link = db::$link->query("SELECT * FROM achievement_db WHERE achievement = '181' AND uuid = '$channel_uuid' AND status = 'public'");
    $daten = $link->fetch_assoc();
    $time_code = $daten['time'];
    $time_ach_180 = $t->invor($time_code);

    $get_ach_180_date = $time_ach_180;
    $d_ach_181 = number_format($lvl->ach_181,0, ",", ".");
    $res_ach180_sub_text = $d_ach_181."".$l->level_xp_title." - ".$l->achstep2." ".$l->ach_at." ".$get_ach_180_date;

    $ach180fortschritline = 100;
    $ach181fortschritline = 100;
    $ach182fortschritline = 100 * ($video_count -50) / 50;
    $res_ach180_prog = $video_count."/100";
    $ach180_symbol = "ach181_symbol";
  }
  elseif($for_ach_180 == 3)
  {
    $link = db::$link->query("SELECT * FROM achievement_db WHERE achievement = '182' AND uuid = '$channel_uuid' AND status = 'public'");
    $daten = $link->fetch_assoc();
    $time_code = $daten['time'];
    $time_ach_180 = $t->invor($time_code);

    $get_ach_180_date = $time_ach_180;
    $d_ach_182 = number_format($lvl->ach_182,0, ",", ".");
    $res_ach180_sub_text = $d_ach_182."".$l->level_xp_title." - ".$l->achstep3." ".$l->ach_at." ".$get_ach_180_date;

    $ach180fortschritline = 100;
    $ach181fortschritline = 100;
    $ach182fortschritline = 100;
    $res_ach180_prog = $video_count."/100";
    $ach180_symbol = "ach182_symbol";
  }
// ende für das abonnieren von 5 25 250 180 181 182


  echo "<div class='norm_ach_content'>";

  // für das liken von 5 50 500 Videos  140 - 143
  echo "<div id='ach_150' class='res_ach_box' >
          <div class='res_ach_img ".$res_ach140_color."'><div class='res_ach_img_text ".$ach140_symbol." f_ach_1' ></div></div>
          <div class='res_ach_progressbars'>
            <div class='res_ach_name_title'>".$l->res_ach_title_140."</div>
            <div class='res_ach_todo_text'>".$l->res_ach_text_140."</div>
            <div class='res_ach_sup_text'>".$res_ach140_sub_text."</div>
            <div class='res_ach_progress'>
              <div id='resbigProgressBarach140' class='ThreeRes ThreeResBigProgressBarLevel b_level_".$channel_b_level."'>
                <div id='resbigProgressBarach140f' class='ThreeResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
              </div>
              <div id='resbigProgressBarach141' class='ThreeRes ThreeResBigProgressBarLevel b_level_".$channel_b_level."'>
                <div id='resbigProgressBarach141f' class='ThreeResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
              </div>
              <div id='resbigProgressBarach142' class='ThreeResBigProgressBarLevel b_level_".$channel_b_level."'>
                <div id='resbigProgressBarach142f' class='ThreeResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
              </div>
              <div class='res_ach_progress_counter'>".$res_ach140_prog."</div>
            </div>
          </div>
      </div>";



  // für das schreiben von 10 100 1000 Kommentare  150 - 153
  echo "<div id='ach_160' class='res_ach_box' >
          <div class='res_ach_img ".$res_ach150_color."'><div class='res_ach_img_text ".$ach150_symbol." f_ach_1' ></div></div>
          <div class='res_ach_progressbars'>
            <div class='res_ach_name_title'>".$l->res_ach_title_150."</div>
            <div class='res_ach_todo_text'>".$l->res_ach_text_150."</div>
            <div class='res_ach_sup_text'>".$res_ach150_sub_text."</div>
            <div class='res_ach_progress'>
              <div id='resbigProgressBarach150' class='ThreeRes ThreeResBigProgressBarLevel b_level_".$channel_b_level."'>
                <div id='resbigProgressBarach150f' class='ThreeResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
              </div>
              <div id='resbigProgressBarach151' class='ThreeRes ThreeResBigProgressBarLevel b_level_".$channel_b_level."'>
                <div id='resbigProgressBarach151f' class='ThreeResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
              </div>
              <div id='resbigProgressBarach152' class='ThreeResBigProgressBarLevel b_level_".$channel_b_level."'>
                <div id='resbigProgressBarach152f' class='ThreeResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
              </div>
              <div class='res_ach_progress_counter'>".$res_ach150_prog."</div>
            </div>
          </div>
      </div>";



  // für das erhalten von 10 100 1000 Abos
  echo "<div id='ach_170' class='res_ach_box' >
          <div class='res_ach_img ".$res_ach160_color."'><div class='res_ach_img_text ".$ach160_symbol." f_ach_1' ></div></div>
          <div class='res_ach_progressbars'>
            <div class='res_ach_name_title'>".$l->res_ach_title_160."</div>
            <div class='res_ach_todo_text'>".$l->res_ach_text_160."</div>
            <div class='res_ach_sup_text'>".$res_ach160_sub_text."</div>
            <div class='res_ach_progress'>
              <div id='resbigProgressBarach160' class='ThreeRes ThreeResBigProgressBarLevel b_level_".$channel_b_level."'>
                <div id='resbigProgressBarach160f' class='ThreeResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
              </div>
              <div id='resbigProgressBarach161' class='ThreeRes ThreeResBigProgressBarLevel b_level_".$channel_b_level."'>
                <div id='resbigProgressBarach161f' class='ThreeResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
              </div>
              <div id='resbigProgressBarach162' class='ThreeResBigProgressBarLevel b_level_".$channel_b_level."'>
                <div id='resbigProgressBarach162f' class='ThreeResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
              </div>
              <div class='res_ach_progress_counter'>".$res_ach160_prog."</div>
            </div>
          </div>
      </div>";



    // für das abonnieren von 5 25 250 170 - 173
    echo "<div id='ach_180' class='res_ach_box' >
            <div class='res_ach_img ".$res_ach170_color."'><div class='res_ach_img_text ".$ach170_symbol." f_ach_1' ></div></div>
            <div class='res_ach_progressbars'>
              <div class='res_ach_name_title'>".$l->res_ach_title_170."</div>
              <div class='res_ach_todo_text'>".$l->res_ach_text_170."</div>
              <div class='res_ach_sup_text'>".$res_ach170_sub_text."</div>
              <div class='res_ach_progress'>
                <div id='resbigProgressBarach170' class='ThreeRes ThreeResBigProgressBarLevel b_level_".$channel_b_level."'>
                  <div id='resbigProgressBarach170f' class='ThreeResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
                </div>
                <div id='resbigProgressBarach171' class='ThreeRes ThreeResBigProgressBarLevel b_level_".$channel_b_level."'>
                  <div id='resbigProgressBarach171f' class='ThreeResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
                </div>
                <div id='resbigProgressBarach172' class='ThreeResBigProgressBarLevel b_level_".$channel_b_level."'>
                  <div id='resbigProgressBarach172f' class='ThreeResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
                </div>
                <div class='res_ach_progress_counter'>".$res_ach170_prog."</div>
              </div>
            </div>
        </div>";


    // für das hochladen von 5 50 100 videos 180 - 183
    echo "<div id='ach_200' class='res_ach_box' >
            <div class='res_ach_img ".$res_ach180_color."'><div class='res_ach_img_text ".$ach180_symbol." f_ach_1' ></div></div>
            <div class='res_ach_progressbars'>
              <div class='res_ach_name_title'>".$l->res_ach_title_180."</div>
              <div class='res_ach_todo_text'>".$l->res_ach_text_180."</div>
              <div class='res_ach_sup_text'>".$res_ach180_sub_text."</div>
              <div class='res_ach_progress'>
                <div id='resbigProgressBarach180' class='ThreeRes ThreeResBigProgressBarLevel b_level_".$channel_b_level."'>
                  <div id='resbigProgressBarach180f' class='ThreeResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
                </div>
                <div id='resbigProgressBarach181' class='ThreeRes ThreeResBigProgressBarLevel b_level_".$channel_b_level."'>
                  <div id='resbigProgressBarach181f' class='ThreeResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
                </div>
                <div id='resbigProgressBarach182' class='ThreeResBigProgressBarLevel b_level_".$channel_b_level."'>
                  <div id='resbigProgressBarach182f' class='ThreeResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
                </div>
                <div class='res_ach_progress_counter'>".$res_ach180_prog."</div>
              </div>
            </div>
        </div>";








//Einzelne
//errungenschaften

  $get_ach_c = 199;
  while($get_ach_c != 210){
    $get_ach_c++;

    $link = db::$link->query("SELECT * FROM achievement_db WHERE achievement = '$get_ach_c' AND uuid = '$channel_uuid' AND status = 'public'");
    $daten = $link->fetch_assoc();

    $get_ach_value = "get_ach_".$get_ach_c;
    $time_ach = "time_ach_".$get_ach_c;

    if(isset($daten['ach_id'])){
      $time_code = $daten['time'];
      $$time_ach = $t->invor($time_code);
      $$get_ach_value  = 1;
    }else{
      $$get_ach_value  = 0;
    }
  }

//winter 2016
  $link = db::$link->query("SELECT * FROM achievement_db WHERE achievement = '2016' AND uuid = '$channel_uuid' AND status = 'public'");
  $daten = $link->fetch_assoc();

  $get_ach_value = "get_ach_2016";
  $time_ach = "time_ach_2016";

  if(isset($daten['ach_id'])){
    $time_code = $daten['time'];
    $$time_ach = $t->invor($time_code);
    $get_ach_2016  = 1;
  }else{
    $get_ach_2016  = 0;
  }



  //für das hochladen eines Videos in 4k.
  if($get_ach_200 == 1){
    $get_ach_200_date = $time_ach_200;
    $d_ach_200 = number_format($lvl->ach_200,0, ",", ".");
    $res_ach200_sub_text = $d_ach_200."".$l->level_xp_title." - ".$l->ach_at." ".$get_ach_200_date;
    $res_ach200_color = "c_level_".$channel_b_level;
    $ach200fortschritline = 100;
    $res_ach200_prog = "1/1";
  }else{
    $res_ach200_sub_text = $l->hidden_achievement;
    $res_ach200_color = "b_level_".$channel_b_level;
    $ach200fortschritline = 0;
    $res_ach200_prog = "0/1";
  }

  //für das hinzufügen eines Freundes.
  if($get_ach_201 == 1){
    $get_ach_201_date = $time_ach_201;
    $d_ach_201 = number_format($lvl->ach_201,0, ",", ".");
    $res_ach201_sub_text = $d_ach_201."".$l->level_xp_title." - ".$l->ach_at." ".$get_ach_201_date;
    $res_ach201_color = "c_level_".$channel_b_level;
    $ach201fortschritline = 100;
    $res_ach201_prog = "1/1";
  }else{
    $res_ach201_sub_text = $l->hidden_achievement;
    $res_ach201_color = "b_level_".$channel_b_level;
    $ach201fortschritline = 0;
    $res_ach201_prog = "0/1";
  }

  //für das Bewerten eines Kommentares.
  if($get_ach_202 == 1){
    $get_ach_202_date = $time_ach_202;
    $d_ach_202 = number_format($lvl->ach_202,0, ",", ".");
    $res_ach202_sub_text = $d_ach_202."".$l->level_xp_title." - ".$l->ach_at." ".$get_ach_202_date;
    $res_ach202_color = "c_level_".$channel_b_level;
    $ach202fortschritline = 100;
    $res_ach202_prog = "1/1";
  }else{
    $res_ach202_sub_text = $l->hidden_achievement;
    $res_ach202_color = "b_level_".$channel_b_level;
    $ach202fortschritline = 0;
    $res_ach202_prog = "0/1";
  }

  //für das durchsuchen der kommentare.
  if($get_ach_203 == 1){
    $get_ach_203_date = $time_ach_203;
    $d_ach_203 = number_format($lvl->ach_203,0, ",", ".");
    $res_ach203_sub_text = $d_ach_203."".$l->level_xp_title." - ".$l->ach_at." ".$get_ach_203_date;
    $res_ach203_color = "c_level_".$channel_b_level;
    $ach203fortschritline = 100;
    $res_ach203_prog = "1/1";
  }else{
    $res_ach203_sub_text = $l->hidden_achievement;
    $res_ach203_color = "b_level_".$channel_b_level;
    $ach203fortschritline = 0;
    $res_ach203_prog = "0/1";
  }

  //für das Sortieren der Kommentare.
  if($get_ach_204 == 1){
    $get_ach_204_date = $time_ach_204;
    $d_ach_204 = number_format($lvl->ach_204,0, ",", ".");
    $res_ach204_sub_text = $d_ach_204."".$l->level_xp_title." - ".$l->ach_at." ".$get_ach_204_date;
    $res_ach204_color = "c_level_".$channel_b_level;
    $ach204fortschritline = 100;
    $res_ach204_prog = "1/1";
  }else{
    $res_ach204_sub_text = $l->hidden_achievement;
    $res_ach204_color = "b_level_".$channel_b_level;
    $ach204fortschritline = 0;
    $res_ach204_prog = "0/1";
  }

  //für das Bearbeiten deines Kanaldesign.
  if($get_ach_205 == 1){
    $get_ach_205_date = $time_ach_205;
    $d_ach_205 = number_format($lvl->ach_205,0, ",", ".");
    $res_ach205_sub_text = $d_ach_205."".$l->level_xp_title." - ".$l->ach_at." ".$get_ach_205_date;
    $res_ach205_color = "c_level_".$channel_b_level;
    $ach205fortschritline = 100;
    $res_ach205_prog = "1/1";
  }else{
    $res_ach205_sub_text = $l->hidden_achievement;
    $res_ach205_color = "b_level_".$channel_b_level;
    $ach205fortschritline = 0;
    $res_ach205_prog = "0/1";
  }

  //für das vornehmen von einstellungen.
  if($get_ach_206 == 1){
    $get_ach_206_date = $time_ach_206;
    $d_ach_206 = number_format($lvl->ach_206,0, ",", ".");
    $res_ach206_sub_text = $d_ach_206."".$l->level_xp_title." - ".$l->ach_at." ".$get_ach_206_date;
    $res_ach206_color = "c_level_".$channel_b_level;
    $ach206fortschritline = 100;
    $res_ach206_prog = "1/1";
  }else{
    $res_ach206_sub_text = $l->hidden_achievement;
    $res_ach206_color = "b_level_".$channel_b_level;
    $ach206fortschritline = 0;
    $res_ach206_prog = "0/1";
  }

  //für das liken eines Videos eines Freundes
  if($get_ach_207 == 1){
    $get_ach_207_date = $time_ach_207;
    $d_ach_207 = number_format($lvl->ach_207,0, ",", ".");
    $res_ach207_sub_text = $d_ach_207."".$l->level_xp_title." - ".$l->ach_at." ".$get_ach_207_date;
    $res_ach207_color = "c_level_".$channel_b_level;
    $ach207fortschritline = 100;
    $res_ach207_prog = "1/1";
  }else{
    $res_ach207_sub_text = $l->hidden_achievement;
    $res_ach207_color = "b_level_".$channel_b_level;
    $ach207fortschritline = 0;
    $res_ach207_prog = "0/1";
  }

  //für das hochladen von videos welche zusammen länger als einen Tag gehn.
  if($get_ach_208 == 1){
    $get_ach_208_date = $time_ach_208;
    $d_ach_208 = number_format($lvl->ach_208,0, ",", ".");
    $res_ach208_sub_text = $d_ach_208."".$l->level_xp_title." - ".$l->ach_at." ".$get_ach_208_date;
    $res_ach208_color = "c_level_".$channel_b_level;
    $ach208fortschritline = 100;
    $res_ach208_prog = "24/24";
  }else{
    $res_ach208_sub_text = $l->hidden_achievement;
    $res_ach208_color = "b_level_".$channel_b_level;

    $sql_s_info = db::$link->query("SELECT dauer FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' AND privacy = 'public'");
        $s_time = 0;
        while($erg_s_info = $sql_s_info->fetch_array()){
          $s_time = $s_time + $erg_s_info['dauer'];
        }

        $s_time = floor($s_time/3600);

    $ach208fortschritline = 100 * ($s_time) / 24;
    $res_ach208_prog = $s_time."/24"; //t_count
  }

  //für das hochladen von videos welche zusammen mehr als 50.000 aufrufe haben.
  if($get_ach_209 == 1){
    $get_ach_209_date = $time_ach_209;
    $d_ach_209 = number_format($lvl->ach_209,0, ",", ".");
    $res_ach209_sub_text = $d_ach_209."".$l->level_xp_title." - ".$l->ach_at." ".$get_ach_209_date;
    $res_ach209_color = "c_level_".$channel_b_level;
    $ach209fortschritline =  100;
    $res_ach209_prog = "50k/50k";
  }else{
    $res_ach209_sub_text = $l->hidden_achievement;
    $res_ach209_color = "b_level_".$channel_b_level;

    $sql_s_info = db::$link->query("SELECT views FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' AND privacy = 'public'");
        $v_count = 0;
        while ($erg_s_info = $sql_s_info->fetch_array()){
          $v_count = $v_count + $erg_s_info['views'];
        }
    $ach209fortschritline = 100 * ($v_count) / 50000;

    $v_count_draw = number_format($v_count,0, ",", ".");
    $res_ach209_prog = $v_count_draw."/50k"; // 20.4k/50k v_count
  }

  //für das hochladen eines Videos welches länger ist als 10min.
  if($get_ach_210 == 1){
    $get_ach_210_date = $time_ach_210;
    $d_ach_210 = number_format($lvl->ach_210,0, ",", ".");
    $res_ach210_sub_text = $d_ach_210."".$l->level_xp_title." - ".$l->ach_at." ".$get_ach_210_date;
    $res_ach210_color = "c_level_".$channel_b_level;
    $ach210fortschritline = 100;
    $res_ach210_prog = "1/1";
  }else{
    $res_ach210_sub_text = $l->hidden_achievement;
    $res_ach210_color = "b_level_".$channel_b_level;
    $ach210fortschritline = 0;
    $res_ach210_prog = "0/1";
  }

  //für das erhalten eines Geschneks 2016
  if($get_ach_2016 == 1){
    $get_ach_2016_date = $time_ach_2016;
    $d_ach_2016 = number_format($lvl->ach_2016,0, ",", ".");
    $res_ach2016_sub_text = $d_ach_2016."".$l->level_xp_title." - ".$l->ach_at." ".$get_ach_2016_date;
    $res_ach2016_color = "c_level_".$channel_b_level;
    $ach2016fortschritline = 100;
    $res_ach2016_prog = "1/1";
  }else{
    $res_ach2016_sub_text = $l->hidden_achievement;
    $res_ach2016_color = "b_level_".$channel_b_level;
    $ach2016fortschritline = 0;
    $res_ach2016_prog = "0/1";
  }


  //200 für das hochladen eines Videos in 4k.
  echo "<div id='ach_201' class='res_ach_box' >
          <div class='res_ach_img ".$res_ach200_color."'><div class='res_ach_img_text ach200_symbol f_ach_1' ></div></div>
          <div class='res_ach_progressbars'>
            <div class='res_ach_name_title'>".$l->res_ach_title_200."</div>
            <div class='res_ach_todo_text'>".$l->res_ach_text_200."</div>
            <div class='res_ach_sup_text'>".$res_ach200_sub_text."</div>
            <div class='res_ach_progress'>
              <div id='resbigProgressBarach200' class='ResBigProgressBarLevel b_level_".$channel_b_level."'>
                <div id='resbigProgressBarach200f' class='ResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
              </div>
              <div class='res_ach_progress_counter'>".$res_ach200_prog."</div>
            </div>
          </div>
      </div>";

  //201 für das hinzufügen eines Freundes.
  echo "<div id='ach_202' class='res_ach_box' >
          <div class='res_ach_img ".$res_ach201_color."'><div class='res_ach_img_text ach201_symbol f_ach_1' ></div></div>
          <div class='res_ach_progressbars'>
            <div class='res_ach_name_title'>".$l->res_ach_title_201."</div>
            <div class='res_ach_todo_text'>".$l->res_ach_text_201."</div>
            <div class='res_ach_sup_text'>".$res_ach201_sub_text."</div>
            <div class='res_ach_progress'>
              <div id='resbigProgressBarach201' class='ResBigProgressBarLevel b_level_".$channel_b_level."'>
                <div id='resbigProgressBarach201f' class='ResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
              </div>
              <div class='res_ach_progress_counter'>".$res_ach201_prog."</div>
            </div>
          </div>
      </div>";

  //202 für das Bewerten eines Kommentares.
  echo "<div id='ach_203' class='res_ach_box' >
          <div class='res_ach_img ".$res_ach202_color."'><div class='res_ach_img_text ach202_symbol f_ach_1' ></div></div>
          <div class='res_ach_progressbars'>
            <div class='res_ach_name_title'>".$l->res_ach_title_202."</div>
            <div class='res_ach_todo_text'>".$l->res_ach_text_202."</div>
            <div class='res_ach_sup_text'>".$res_ach202_sub_text."</div>
            <div class='res_ach_progress'>
              <div id='resbigProgressBarach202' class='ResBigProgressBarLevel b_level_".$channel_b_level."'>
                <div id='resbigProgressBarach202f' class='ResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
              </div>
              <div class='res_ach_progress_counter'>".$res_ach202_prog."</div>
            </div>
          </div>
      </div>";

  //203 für das durchsuchen der kommentare.
  echo "<div id='ach_204' class='res_ach_box' >
          <div class='res_ach_img ".$res_ach203_color."'><div class='res_ach_img_text ach203_symbol f_ach_1' ></div></div>
          <div class='res_ach_progressbars'>
            <div class='res_ach_name_title'>".$l->res_ach_title_203."</div>
            <div class='res_ach_todo_text'>".$l->res_ach_text_203."</div>
            <div class='res_ach_sup_text'>".$res_ach203_sub_text."</div>
            <div class='res_ach_progress'>
              <div id='resbigProgressBarach203' class='ResBigProgressBarLevel b_level_".$channel_b_level."'>
                <div id='resbigProgressBarach203f' class='ResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
              </div>
              <div class='res_ach_progress_counter'>".$res_ach203_prog."</div>
            </div>
          </div>
      </div>";

  //204 für das Sortieren der Kommentare.
  echo "<div id='ach_205' class='res_ach_box' >
          <div class='res_ach_img ".$res_ach204_color."'><div class='res_ach_img_text ach204_symbol f_ach_1' ></div></div>
          <div class='res_ach_progressbars'>
            <div class='res_ach_name_title'>".$l->res_ach_title_204."</div>
            <div class='res_ach_todo_text'>".$l->res_ach_text_204."</div>
            <div class='res_ach_sup_text'>".$res_ach204_sub_text."</div>
            <div class='res_ach_progress'>
              <div id='resbigProgressBarach204' class='ResBigProgressBarLevel b_level_".$channel_b_level."'>
                <div id='resbigProgressBarach204f' class='ResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
              </div>
              <div class='res_ach_progress_counter'>".$res_ach204_prog."</div>
            </div>
          </div>
      </div>";

  //205 für das Bearbeiten deines Kanaldesign.
  echo "<div id='ach_206' class='res_ach_box' >
          <div class='res_ach_img ".$res_ach205_color."'><div class='res_ach_img_text ach205_symbol f_ach_1' ></div></div>
          <div class='res_ach_progressbars'>
            <div class='res_ach_name_title'>".$l->res_ach_title_205."</div>
            <div class='res_ach_todo_text'>".$l->res_ach_text_205."</div>
            <div class='res_ach_sup_text'>".$res_ach205_sub_text."</div>
            <div class='res_ach_progress'>
              <div id='resbigProgressBarach205' class='ResBigProgressBarLevel b_level_".$channel_b_level."'>
                <div id='resbigProgressBarach205f' class='ResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
              </div>
              <div class='res_ach_progress_counter'>".$res_ach205_prog."</div>
            </div>
          </div>
      </div>";

  //206 für das vornehmen von einstellungen.
  echo "<div id='ach_207' class='res_ach_box' >
          <div class='res_ach_img ".$res_ach206_color."'><div class='res_ach_img_text ach206_symbol f_ach_1' ></div></div>
          <div class='res_ach_progressbars'>
            <div class='res_ach_name_title'>".$l->res_ach_title_206."</div>
            <div class='res_ach_todo_text'>".$l->res_ach_text_206."</div>
            <div class='res_ach_sup_text'>".$res_ach206_sub_text."</div>
            <div class='res_ach_progress'>
              <div id='resbigProgressBarach206' class='ResBigProgressBarLevel b_level_".$channel_b_level."'>
                <div id='resbigProgressBarach206f' class='ResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
              </div>
              <div class='res_ach_progress_counter'>".$res_ach206_prog."</div>
            </div>
          </div>
      </div>";

  //207 für das liken eines Videos eines Freundes
  echo "<div id='ach_210' class='res_ach_box' >
          <div class='res_ach_img ".$res_ach207_color."'><div class='res_ach_img_text ach207_symbol f_ach_1' ></div></div>
          <div class='res_ach_progressbars'>
            <div class='res_ach_name_title'>".$l->res_ach_title_207."</div>
            <div class='res_ach_todo_text'>".$l->res_ach_text_207."</div>
            <div class='res_ach_sup_text'>".$res_ach207_sub_text."</div>
            <div class='res_ach_progress'>
              <div id='resbigProgressBarach207' class='ResBigProgressBarLevel b_level_".$channel_b_level."'>
                <div id='resbigProgressBarach207f' class='ResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
              </div>
              <div class='res_ach_progress_counter'>".$res_ach207_prog."</div>
            </div>
          </div>
      </div>";

  //210 für das hochladen eines Videos welches länger ist als 10min.
  echo "<div id='ach_208' class='res_ach_box' >
          <div class='res_ach_img ".$res_ach210_color."'><div class='res_ach_img_text ach210_symbol f_ach_1' ></div></div>
          <div class='res_ach_progressbars'>
            <div class='res_ach_name_title'>".$l->res_ach_title_210."</div>
            <div class='res_ach_todo_text'>".$l->res_ach_text_210."</div>
            <div class='res_ach_sup_text'>".$res_ach210_sub_text."</div>
            <div class='res_ach_progress'>
              <div id='resbigProgressBarach210' class='ResBigProgressBarLevel b_level_".$channel_b_level."'>
                <div id='resbigProgressBarach210f' class='ResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
              </div>
              <div class='res_ach_progress_counter'>".$res_ach210_prog."</div>
            </div>
          </div>
      </div>";

  //208 für das hochladen von videos welche zusammen länger als einen Tag gehn.
  echo "<div id='ach_209' class='res_ach_box' >
          <div class='res_ach_img ".$res_ach208_color."'><div class='res_ach_img_text ach208_symbol f_ach_1' ></div></div>
          <div class='res_ach_progressbars'>
            <div class='res_ach_name_title'>".$l->res_ach_title_208."</div>
            <div class='res_ach_todo_text'>".$l->res_ach_text_208."</div>
            <div class='res_ach_sup_text'>".$res_ach208_sub_text."</div>
            <div class='res_ach_progress'>
              <div id='resbigProgressBarach208' class='ResBigProgressBarLevel b_level_".$channel_b_level."'>
                <div id='resbigProgressBarach208f' class='ResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
              </div>
              <div class='res_ach_progress_counter'>".$res_ach208_prog."</div>
            </div>
          </div>
      </div>";

  //209 für das hochladen von videos welche zusammen mehr als 50.000 aufrufe haben.
    echo "<div id='ach_2016' class='res_ach_box' >
          <div class='res_ach_img ".$res_ach209_color."'><div class='res_ach_img_text ach209_symbol f_ach_1' ></div></div>
          <div class='res_ach_progressbars'>
            <div class='res_ach_name_title'>".$l->res_ach_title_209."</div>
            <div class='res_ach_todo_text'>".$l->res_ach_text_209."</div>
            <div class='res_ach_sup_text'>".$res_ach209_sub_text."</div>
            <div class='res_ach_progress'>
              <div id='resbigProgressBarach209' class='ResBigProgressBarLevel b_level_".$channel_b_level."'>
                <div id='resbigProgressBarach209f' class='ResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
              </div>
              <div class='res_ach_progress_counter'>".$res_ach209_prog."</div>
            </div>
          </div>
      </div>";

  //210 oben zwishcen 207 und 208 /\

  //2016 für das das erhalten eines Geschneks 2016.
  if($get_ach_2016 == 1){
    echo "<div id='' class='res_ach_box' >
          <div class='res_ach_img ".$res_ach2016_color."'><div class='res_ach_img_text ach2016_symbol f_ach_1' ></div></div>
          <div class='res_ach_progressbars'>
            <div class='res_ach_name_title'>".$l->res_ach_title_2016."</div>
            <div class='res_ach_todo_text'>".$l->res_ach_text_2016."</div>
            <div class='res_ach_sup_text'>".$res_ach2016_sub_text."</div>
            <div class='res_ach_progress'>
              <div id='resbigProgressBarach2016' class='ResBigProgressBarLevel b_level_".$channel_b_level."'>
                <div id='resbigProgressBarach2016f' class='ResBigProgressBarLevelfront c_level_".$channel_c_level."'></div>
              </div>
              <div class='res_ach_progress_counter'>".$res_ach2016_prog."</div>
            </div>
          </div>
      </div>";
  }

  echo "</div>"; //end norm achievements



  $video_sql = db::$link->query("SELECT count(vuid) FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' AND privacy = 'public'");
  $video_row = $video_sql->fetch_row();

  $all_videos_c = $video_row[0];

  $item_per_page = 9;

  $total_pages = floor($all_videos_c/$item_per_page);

  if($all_videos_c > 0){
    echo"<div class='allvideoTitle no_overflow'> <div class='allvideoCount'>".$l->achievement_video_title."</div> </div>";

  ?>

    <div class='row'>
      <div id="video_ach_result" class='video_ach_result'>
        <?php
        $page = 0;
        require_once ($_hp."achievement/achievement_video.php");
        ?>
      </div>
        <div align='center'>
        <button class='vid_ach_load_more w-100 blue_btn btn-default button <?php if($total_pages < 1){echo "hide";}else{} ?>' id='load_more_button' <?php if($total_pages < 1){echo "disabled='disabled'";}else{} ?>><?php echo $l->loadmore; ?></button>
        <div class='animation_image' style='display:none;'><img src='../../images/icons/ajax-loader.gif' alt='We-Teve'/><?php echo $l->loading; ?></div>
        </div>
    </div>
  <?php
    }
  ?>



<script>
        function iSIV(el) { //isScrolledIntoView
          var elemTop = document.getElementById(el).getBoundingClientRect().top;
          var elemBottom = document.getElementById(el).getBoundingClientRect().bottom;

          var isVisible = (elemTop >= 0) && (elemBottom <= window.innerHeight);
          return isVisible;
      }

    $(window).scroll(function(){ checkvisofach(); });
    $(document).ready(function(){ checkvisofach(); });

      //alert(iSIV('resbigProgressBarach140f'));
    function checkvisofach(){
      if(iSIV('resbigProgressBarach140f') == true){
        $('#resbigProgressBarach140f').animate({width: '<?php echo round($ach140fortschritline)."%";?>' }, 500, function() {
          $('#resbigProgressBarach141f').animate({width: '<?php echo round($ach141fortschritline)."%";?>' }, 500, function() {
            $('#resbigProgressBarach142f').animate({width: '<?php echo round($ach142fortschritline)."%";?>' }, 500);
          });
        });
      }

      if(iSIV('resbigProgressBarach150f') == true){
        $('#resbigProgressBarach150f').animate({width: '<?php echo round($ach150fortschritline)."%";?>' }, 500, function() {
          $('#resbigProgressBarach151f').animate({width: '<?php echo round($ach151fortschritline)."%";?>' }, 500, function() {
            $('#resbigProgressBarach152f').animate({width: '<?php echo round($ach152fortschritline)."%";?>' }, 500);
          });
        });
      }

      if(iSIV('resbigProgressBarach160f') == true){
        $('#resbigProgressBarach160f').animate({width: '<?php echo round($ach160fortschritline)."%";?>' }, 500, function() {
          $('#resbigProgressBarach161f').animate({width: '<?php echo round($ach161fortschritline)."%";?>' }, 500, function() {
            $('#resbigProgressBarach162f').animate({width: '<?php echo round($ach162fortschritline)."%";?>' }, 500);
          });
        });
      }

      if(iSIV('resbigProgressBarach170f') == true){
        $('#resbigProgressBarach170f').animate({width: '<?php echo round($ach170fortschritline)."%";?>' }, 500, function() {
          $('#resbigProgressBarach171f').animate({width: '<?php echo round($ach171fortschritline)."%";?>' }, 500, function() {
            $('#resbigProgressBarach172f').animate({width: '<?php echo round($ach172fortschritline)."%";?>' }, 500);
          });
        });
      }

      if(iSIV('resbigProgressBarach180f') == true){
        $('#resbigProgressBarach180f').animate({width: '<?php echo round($ach180fortschritline)."%";?>' }, 500, function() {
          $('#resbigProgressBarach181f').animate({width: '<?php echo round($ach181fortschritline)."%";?>' }, 500, function() {
            $('#resbigProgressBarach182f').animate({width: '<?php echo round($ach182fortschritline)."%";?>' }, 500);
          });
        });
      }

      if(iSIV('resbigProgressBarach200f') == true){ $('#resbigProgressBarach200f').animate({width:   '<?php echo round($ach200fortschritline)."%";?>' }, 1000); }
      if(iSIV('resbigProgressBarach201f') == true){ $('#resbigProgressBarach201f').animate({width:   '<?php echo round($ach201fortschritline)."%";?>' }, 1000); }
      if(iSIV('resbigProgressBarach202f') == true){ $('#resbigProgressBarach202f').animate({width:   '<?php echo round($ach202fortschritline)."%";?>' }, 1000); }
      if(iSIV('resbigProgressBarach203f') == true){ $('#resbigProgressBarach203f').animate({width:   '<?php echo round($ach203fortschritline)."%";?>' }, 1000); }
      if(iSIV('resbigProgressBarach204f') == true){ $('#resbigProgressBarach204f').animate({width:   '<?php echo round($ach204fortschritline)."%";?>' }, 1000); }
      if(iSIV('resbigProgressBarach205f') == true){ $('#resbigProgressBarach205f').animate({width:   '<?php echo round($ach205fortschritline)."%";?>' }, 1000); }
      if(iSIV('resbigProgressBarach206f') == true){ $('#resbigProgressBarach206f').animate({width:   '<?php echo round($ach206fortschritline)."%";?>' }, 1000); }
      if(iSIV('resbigProgressBarach207f') == true){ $('#resbigProgressBarach207f').animate({width:   '<?php echo round($ach207fortschritline)."%";?>' }, 1000); }
      if(iSIV('resbigProgressBarach208f') == true){ $('#resbigProgressBarach208f').animate({width:   '<?php echo round($ach208fortschritline)."%";?>' }, 1000); }
      if(iSIV('resbigProgressBarach209f') == true){ $('#resbigProgressBarach209f').animate({width:   '<?php echo round($ach209fortschritline)."%";?>' }, 1000); }
      if(iSIV('resbigProgressBarach210f') == true){ $('#resbigProgressBarach210f').animate({width:   '<?php echo round($ach210fortschritline)."%";?>' }, 1000); }
      <?php if($get_ach_2016 == 1){ ?>
        if(iSIV('resbigProgressBarach2016f') == true){ $('#resbigProgressBarach2016f').animate({width: '<?php echo round($ach2016fortschritline)."%";?>' }, 1000); }
      <?php } ?>
    }



    var track_click = 1;
    var channel_uuid = '<?php echo $channel_uuid; ?>';
    var total_pages = '<?php echo $total_pages; ?>';

    $(".vid_ach_load_more").click(function (e) {

      $(this).hide();
      $('.animation_image').show();

      if(track_click <= total_pages)
      {
        $.post('../../achievement/achievement_video',{'page': track_click,'channel_uuid':channel_uuid}, function(data) {

          $(".vid_ach_load_more").show();

          $("#video_ach_result").append(data);

          $('.animation_image').hide();

          track_click++; resultloadedforthumbpreview();

        }).fail(function(xhr, ajaxOptions, thrownError) {
          alert(thrownError);
          $(".vid_ach_load_more").show();
          $('.animation_image').hide();
        });


        if(track_click >= total_pages)
        {
          //reached end of the page yet? disable load button
          $(".vid_ach_load_more").attr("disabled", "disabled");
          $(".vid_ach_load_more").addClass('hide');
        }
       }

      });
</script>
<?php


?>
