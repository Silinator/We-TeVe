<?php
	//1. Pfad zum Stammverzeichniss wo sich die index befindet
	$_hp = '../'; //für includes
	$_dhp = ''; // für daten

	//2. all include
	$in_save_code_all_include = "&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z";
	require_once ($_hp.'include/all_include.php'); //haupt include

	//3. site vals
	$item_per_page = 24;
  $norm = 0;


  /*if(isset($page_number)){
  	$page_number = $page_number;
  }elseif(isset($_POST["page"])){
  	$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
  }*/
  $page_number = 0;

  if(isset($_POST["vuid"])){
    $thisvuid = mysqli_real_escape_string(db::$link,$_POST["vuid"]);
  }else{
    $thisvuid = "";
  }

  if(isset($_POST["uuid"])){
    $thisuuid = mysqli_real_escape_string(db::$link,$_POST["uuid"]);
  }else{
    $thisuuid = "";
  }

	if(isset($_POST["searchval"])){
		$searchval2 = urldecode($_POST["searchval"]);
		$searchval = mysqli_real_escape_string(db::$link,$searchval2);
	}else{
		$searchval = "";
	}

	if(isset($_POST["langfilter"])){
		$langfilter = mysqli_real_escape_string(db::$link,$_POST["langfilter"]);
	}else{
		$langfilter = "";
	}

  if(isset($_POST["catfilter"])){
		$catfilter = mysqli_real_escape_string(db::$link,$_POST["catfilter"]);
	}else{
		$catfilter = "";
	}

  if(isset($_POST["tagfilter"])){
    $tagfilter = mysqli_real_escape_string(db::$link,$_POST["tagfilter"]);
  }else{
    $tagfilter = "";
  }


//throw HTTP error if page number is not valid
if(!is_numeric($page_number)){
	header('HTTP/1.1 500 Invalid page number!');
	exit();
}

//get current starting point of records
$position = ($page_number * $item_per_page);


if(isset($catfilter) AND $catfilter != ""){

			$results = db::$link->query("SELECT * FROM video_db WHERE kategorie = '$catfilter' AND status = 'uploaded' AND privacy = 'public' ORDER BY uploaddate DESC, views*pos_vote/neg_vote DESC LIMIT $position, $item_per_page");

			$vid_results = db::$link->query("SELECT count(vuid) FROM video_db WHERE kategorie = '$catfilter' AND status = 'uploaded' AND privacy = 'public' ORDER BY uploaddate DESC, views*pos_vote/neg_vote DESC LIMIT $position, $item_per_page");
			if($vid_results){
				$get_total_rows = $vid_results->fetch_row();
				$get_total_rows = $get_total_rows[0];
				$allvideoCount  = $get_total_rows;
				$allvideoCount  = number_format($allvideoCount,0, ",", ".");
			}


}elseif(isset($langfilter) AND $langfilter != ""){

			$results = db::$link->query("SELECT * FROM video_db WHERE sprache = '$langfilter' AND vuid != '$thisvuid' AND status = 'uploaded' AND privacy = 'public' ORDER BY uploaddate DESC, views*pos_vote/neg_vote DESC LIMIT $position, $item_per_page");

			$vid_results = db::$link->query("SELECT count(vuid) FROM video_db WHERE sprache = '$langfilter' AND vuid != '$thisvuid' AND status = 'uploaded' AND privacy = 'public'");
			if($vid_results){
				$get_total_rows = $vid_results->fetch_row();
				$get_total_rows = $get_total_rows[0];
				$allvideoCount  = $get_total_rows;
				$allvideoCount  = number_format($allvideoCount,0, ",", ".");
			}


}elseif(isset($tagfilter) AND $tagfilter != ""){

			$results = db::$link->query("SELECT * FROM video_db WHERE tags LIKE '%$tagfilter%' AND vuid != '$thisvuid' AND status = 'uploaded' AND privacy = 'public' ORDER BY uploaddate DESC, views*pos_vote/neg_vote DESC LIMIT $position, $item_per_page");

			$vid_results = db::$link->query("SELECT count(vuid) FROM video_db WHERE tags LIKE '%$tagfilter%' AND status = 'uploaded' AND privacy = 'public'");
			if($vid_results){
				$get_total_rows = $vid_results->fetch_row();
				$get_total_rows = $get_total_rows[0];
				$allvideoCount  = $get_total_rows;
				$allvideoCount  = number_format($allvideoCount,0, ",", ".");
			}

}elseif(isset($searchval) AND $searchval != ""){

			$results = db::$link->query("SELECT video_db.* ,
									MATCH (user_name,video_title,tags,info) AGAINST ('+$searchval' IN BOOLEAN MODE) AS v_relevance,
									MATCH (user_name) AGAINST ('+$searchval' IN BOOLEAN MODE) AS v_title_relevance,
									video_title LIKE '%$searchval%' AS v_title2_relevance
			FROM video_db WHERE (match(user_name,video_title,tags,info) against('+$searchval' IN BOOLEAN MODE) OR video_title LIKE '%$searchval%')AND status = 'uploaded' AND privacy = 'public' ORDER BY v_title_relevance DESC, v_title2_relevance DESC, v_relevance DESC, views*pos_vote/neg_vote DESC LIMIT $position, $item_per_page");

			$vid_results = db::$link->query("SELECT count(vuid) FROM video_db WHERE(match(user_name,video_title,tags,info) against('+$searchval' IN BOOLEAN MODE) OR video_title LIKE '%$searchval%') AND status = 'uploaded' AND privacy = 'public'");
			if($vid_results){
				$get_total_rows = $vid_results->fetch_row();
				$get_total_rows = $get_total_rows[0];
				$allvideoCount  = $get_total_rows;
				$allvideoCount  = number_format($allvideoCount,0, ",", ".");
			}

}else{

  $norm = 1;
  echo "<h4 class='marg-top-15 left'>".$l->watch_more_vids_title."</h4>";

  $more_videos_sql = db::$link->query("SELECT vuid FROM video_db WHERE uuid != '$thisuuid' AND status = 'uploaded' AND privacy = 'public' ORDER BY rand() LIMIT 15");
  while ($more_videos_row = $more_videos_sql->fetch_array())
  {
    $more_vuid = $more_videos_row['vuid'];
    echo $f->draw_video_pewview($more_vuid,'1','hor','',$_dhp,$_ddhp,'small','1')."<br>";
  }

}

if($norm == 0){
  if($page_number == 0){

    if($get_total_rows > 0){
  		if($catfilter != ""){
  			echo "<h4 class='marg-top-15 left w-100'> ".$l->search_title4." ".$l->search_title21." \"".$catfilter."\"</h4>";
  		}elseif($langfilter != ""){
  			echo "<h4 class='marg-top-15 left w-100'> ".$l->search_title4." ".$l->search_title21." \"".$langfilter."\"</h4>";
  		}elseif($tagfilter != ""){
  			echo "<h4 class='marg-top-15 left w-100'> ".$l->search_title4." ".$l->search_title21." \"".$tagfilter."\"</h4>";
  		}else{
  			echo "<h4 class='marg-top-15 left w-100'> ".$l->search_title4." ".$l->search_title21." \"".$searchval2."\"</h4>";
  		}

			echo "<div class='backtoallcoms backtomorevideos blue'>".$l->morev_backtomorevideos."</div>";
    }



  	if($get_total_rows <= 0){

  		if($catfilter != ""){
  			echo "<h4 class='marg-top-15 left w-100'> ".$l->search_title2." ".$l->search_title21." \"".$catfilter."\"</h4>";
  		}elseif($langfilter != ""){
  			echo "<h4 class='marg-top-15 left w-100'> ".$l->search_title2." ".$l->search_title21." \"".$langfilter."\"</h4>";
  		}elseif($tagfilter != ""){
  			echo "<h4 class='marg-top-15 left w-100'> ".$l->search_title2." ".$l->search_title21." \"".$tagfilter."\"</h4>";
  		}else{
  			echo "<h4 class='marg-top-15 left w-100'> ".$l->search_title2." \"".$searchval2."\"</h4>";
  		}
				echo "<div class='backtoallcoms backtomorevideos blue'>".$l->morev_backtomorevideos."</div>";
  			echo "<br><h4 class='marg-top-15 left w-100'>".$l->search_non_result."</h4>";

  	}
  }



  while($row = $results->fetch_array()){

  		$video_vuid 		= $row['vuid'];
      $video_title 		= htmlentities($row['video_title']);
  		$video_time 		= $t->invor($row['uploaddate']);
  		$video_info 		= $f->fulltext($row['info']);
  		$views_erg 			= $row['views'];
  		$views 					= number_format($views_erg,0, ",", ".");

  		//userinfo
  			echo $f->draw_video_pewview($video_vuid,1,'hor','',$_dhp,$_ddhp,'small','1')."<br>";

  }
}

?>
