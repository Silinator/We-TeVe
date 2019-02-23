<?php
if(!isset($page_number)){
	//1. Pfad zum Stammverzeichniss wo sich die index befindet
	$_hp = '../'; //für includes
	$_dhp = ''; // für daten

	//2. all include
	$in_save_code_all_include = "&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z";
	require_once ($_hp.'include/all_include.php'); //haupt include

	//3. site vals
	$item_per_page = 24;
}


if(isset($page_number)){
	$page_number = $page_number;
}elseif(isset($_POST["page"])){
	$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
}

	if(isset($searchval)){
		$searchval = $searchval;
	}elseif(isset($_POST["searchval"])){
		$searchval = mysqli_real_escape_string(db::$link,$_POST["searchval"]);
	}else{
		$searchval = "";
	}

	if(isset($langfilter_val)){
		$langfilter = $langfilter_val;
	}elseif(isset($_POST["langfilter"])){
		$langfilter = mysqli_real_escape_string(db::$link,$_POST["langfilter"]);
	}else{
		$langfilter = "";
	}

	if(isset($catfilter_val)){
		$catfilter = $catfilter_val;
	}elseif(isset($_POST["catfilter"])){
		$catfilter = mysqli_real_escape_string(db::$link,$_POST["catfilter"]);
	}else{
		$catfilter = "";
	}


//throw HTTP error if page number is not valid
if(!is_numeric($page_number)){
	header('HTTP/1.1 500 Invalid page number!');
	exit();
}

//get current starting point of records
$position = ($page_number * $item_per_page);


if(isset($catfilter) AND $catfilter != ""){

			$channel_results = "";

			$results = db::$link->query("SELECT * FROM video_db WHERE kategorie = '$catfilter' AND status = 'uploaded' AND privacy = 'public' ORDER BY uploaddate DESC, views*pos_vote/neg_vote DESC LIMIT $position, $item_per_page");


			$get_total_rows_c = 0;
			$allchannelCount  = $get_total_rows_c;
			$allchannelCount  = number_format($allchannelCount,0, ",", ".");

			$vid_results = db::$link->query("SELECT count(vuid) FROM video_db WHERE kategorie = '$catfilter' AND status = 'uploaded' AND privacy = 'public' ORDER BY uploaddate DESC, views*pos_vote/neg_vote DESC LIMIT $position, $item_per_page");
			if($vid_results){
				$get_total_rows = $vid_results->fetch_row();
				$get_total_rows = $get_total_rows[0];
				$allvideoCount  = $get_total_rows;
				$allvideoCount  = number_format($allvideoCount,0, ",", ".");
			}


}elseif(isset($langfilter) AND $langfilter != ""){

			$channel_results = db::$link->query("SELECT * FROM user_find_db WHERE land = '$langfilter' AND status = 'public'");

			$results = db::$link->query("SELECT * FROM video_db WHERE sprache = '$langfilter' AND status = 'uploaded' AND privacy = 'public' ORDER BY uploaddate DESC, views*pos_vote/neg_vote DESC LIMIT $position, $item_per_page");


			$c_results = db::$link->query("SELECT count(uuid) FROM user_find_db WHERE land = '$langfilter' AND status = 'public'");
			if($c_results){
				$get_total_rows_c = $c_results->fetch_row();
				$get_total_rows_c = $get_total_rows_c[0];
				$allchannelCount  = $get_total_rows_c;
				$allchannelCount  = number_format($allchannelCount,0, ",", ".");
			}

			$vid_results = db::$link->query("SELECT count(vuid) FROM video_db WHERE sprache = '$langfilter' AND status = 'uploaded' AND privacy = 'public'");
			if($vid_results){
				$get_total_rows = $vid_results->fetch_row();
				$get_total_rows = $get_total_rows[0];
				$allvideoCount  = $get_total_rows;
				$allvideoCount  = number_format($allvideoCount,0, ",", ".");
			}


}else{

			$channel_results = db::$link->query("SELECT user_find_db.*,
									MATCH (user_name) AGAINST ('+$searchval' IN BOOLEAN MODE) AS v_relevance,
									user_name LIKE '%$searchval%' AS user_name_relevance
			FROM user_find_db WHERE (match(user_name) against('+$searchval' IN BOOLEAN MODE) OR user_name LIKE '%$searchval%') AND status = 'public' ORDER BY xp DESC, user_name_relevance DESC, v_relevance DESC LIMIT 24");


			$results = db::$link->query("SELECT video_db.* ,
									MATCH (user_name,video_title,tags,info) AGAINST ('+$searchval' IN BOOLEAN MODE) AS v_relevance,
									MATCH (user_name) AGAINST ('+$searchval' IN BOOLEAN MODE) AS v_title_relevance,
									video_title LIKE '%$searchval%' AS v_title2_relevance
			FROM video_db WHERE (match(user_name,video_title,tags,info) against('+$searchval' IN BOOLEAN MODE) OR video_title LIKE '%$searchval%') AND status = 'uploaded' AND privacy = 'public' ORDER BY v_title_relevance DESC, v_title2_relevance DESC, v_relevance DESC, views*pos_vote/neg_vote DESC LIMIT $position, $item_per_page");


			$c_results = db::$link->query("SELECT count(uuid) FROM user_find_db WHERE(match(user_name) against('+$searchval' IN BOOLEAN MODE) OR user_name LIKE '%$searchval%') AND status = 'public'");
			if($c_results){
				$get_total_rows_c = $c_results->fetch_row();
				$get_total_rows_c = $get_total_rows_c[0];
				$allchannelCount  = $get_total_rows_c;
				$allchannelCount  = number_format($allchannelCount,0, ",", ".");
			}

			$vid_results = db::$link->query("SELECT count(vuid) FROM video_db WHERE(match(user_name,video_title,tags,info) against('+$searchval' IN BOOLEAN MODE) OR video_title LIKE '%$searchval%') AND status = 'uploaded' AND privacy = 'public'");
			if($vid_results){
				$get_total_rows = $vid_results->fetch_row();
				$get_total_rows = $get_total_rows[0];
				$allvideoCount  = $get_total_rows;
				$allvideoCount  = number_format($allvideoCount,0, ",", ".");
			}


}


if($page_number == 0){

  if($allchannelCount > 0){

		if($catfilter != ""){
			echo "<div class='col-xs-12 col-sm-12 col-xl-12 videolist_title'> ".$l->search_title3." ".$l->search_title21." \"".$catfilter."\" (".$allchannelCount.")</div>";
		}elseif($langfilter != ""){
			echo "<div class='col-xs-12 col-sm-12 col-xl-12 videolist_title'> ".$l->search_title3." ".$l->search_title21." \"".$langfilter."\" (".$allchannelCount.")</div>";
		}else{
			echo "<div class='col-xs-12 col-sm-12 col-xl-12 videolist_title'> ".$l->search_title3." ".$l->search_title21." \"".$searchval."\" (".$allchannelCount.")</div>";
		}

    echo "<div class='userpreviewline'>";

    while($row_channel = $channel_results->fetch_array()){

      echo"<div class='col-xs-12 col-md-6 col-xl-4 col-spl userpreviewbox'>";
				$f->draw_user_preview($row_channel['uuid'],$_dhp);
      echo "</div>";
    }//end row
    echo "</div>";

  }

  if($allvideoCount > 0){
		if($catfilter != ""){
			echo "<div class='col-xs-12 col-sm-12 col-xl-12 videolist_title'> ".$l->search_title4." ".$l->search_title21." \"".$catfilter."\" (".$allvideoCount.")</div>";
		}elseif($langfilter != ""){
			echo "<div class='col-xs-12 col-sm-12 col-xl-12 videolist_title'> ".$l->search_title4." ".$l->search_title21." \"".$langfilter."\" (".$allvideoCount.")</div>";
		}else{
			echo "<div class='col-xs-12 col-sm-12 col-xl-12 videolist_title'> ".$l->search_title4." ".$l->search_title21." \"".$searchval."\" (".$allvideoCount.")</div>";
		}
  }

	if($allvideoCount <= 0 AND $allchannelCount <= 0){

		if($catfilter != ""){
			echo "<div class='col-xs-12 col-sm-12 col-xl-12 videolist_title'> ".$l->search_title2." ".$l->search_title21." \"".$catfilter."\" (0)</div>";
		}elseif($langfilter != ""){
			echo "<div class='col-xs-12 col-sm-12 col-xl-12 videolist_title'> ".$l->search_title2." ".$l->search_title21." \"".$langfilter."\" (0)</div>";
		}else{
			echo "<div class='col-xs-12 col-sm-12 col-xl-12 videolist_title'> ".$l->search_title2." \"".$searchval."\" (0)</div>";
		}
			echo "<div class='marg-l-15'>".$l->search_non_result."</div>";

	}
}


while($row = $results->fetch_array()){

		$video_vuid 		= $row['vuid'];
    $video_title 		= htmlentities($row['video_title']);
		$video_time 		= $t->invor($row['uploaddate']);
		$video_info 		= $f->fulltext($row['info']);
		$views_erg 			= $row['views'];
		$views 					= number_format($views_erg,0, ",", ".");

		$video_uuid 		= $row['uuid']; $video_uuif = sha1(sha1($video_uuid));

		//userinfo
			$video_user_name 	= $u->userin('name',0,$video_uuif,'');
			$video_user_avatar = $_dhp.$f->draw_avatar($video_uuid,"small");

		echo"<div class='col-xs-12 col-xl-12 col-spl videopreviewline'>";
				echo $f->draw_video_pewview($video_vuid,1,'none','',$_dhp,$_ddhp,'small','0');

        echo "<div class='videopreview_title no_overflow'><a href='".$_dhp."watch/".$video_vuid."' title='".$video_title."'>".$video_title."</a></div>";

				echo "<a class='videopreview_user_name no_overflow' title='".$video_user_name."' href='".$_dhp."user/".$video_user_name."'><img class='' src='".$video_user_avatar."'>".$video_user_name."</a>";

				echo "<div class='videopreview_info no_overflow'>".$video_info."</div>";

				echo"<div class='videopreview_date'>".$video_time." <b> · </b> ".$views." ".$l->views_title." </div>";

        echo "<div style='clear:both'></div>";
		echo "</div>";
}

?>
