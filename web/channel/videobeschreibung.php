<?php
//videobeschriebung


$video_sql = db::$link->query("SELECT * FROM video_db WHERE vuid = '$video_vuid'");
$video_row = $video_sql->fetch_assoc();


if($video_row['vuid'] != ""){
  $v_error 				= 0;
  $vuid				= $video_row['vuid'];
  $video_uuid 		= $video_row['uuid'];
  $video_title 		= $video_row['video_title'];
  $video_views 		= $video_row['views'];
  $video_pos_vote = $video_row['pos_vote'];
  $video_neg_vote = $video_row['neg_vote'];
}


$can_show = 0;

  if($video_row['vuid'] != ''){
      $video_status 		= $video_row['status'];
      $video_privacy 		= $video_row['privacy'];
      $video_render_status 	= $video_row['render_status'];
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
  $video_description = $video_row['info'];
  $video_title = $video_row['video_title'];

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

  echo "
      <div class='videobeschreibung_box'>";
        ?>
          <div class="videotitle">
            <a href="<?php echo $_dhp; ?>watch/<?php echo $video_vuid; ?>"><?php echo $video_title; ?></a>
          </div>

            <div class="videodate">
              <?php echo $video_date; ?>
            </div>

        <div class="video_inhalt">
        <?php
        echo $video_description."


        <span class='video_description_line'></span>

        <div class='video_description_extra'>
        <span class='video_extra_title'> Kategorie:</span> <a href='".$_dhp."results?cf=".$video_row['kategorie']."' class='video_extra_text'>".$video_kategorie."</a>
        <span class='video_extra_title'> Sprache:</span> <a href='".$_dhp."results?lf=".$video_lang_s."' class='video_extra_text'>".$video_lang."</a>
        </div>
        </div>
    </div>
";

}
  ?>
