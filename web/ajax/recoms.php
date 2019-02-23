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


//throw HTTP error if page number is not valid
if(!is_numeric($page_number)){
	header('HTTP/1.1 500 Invalid page number!');
	exit();
}

//get current starting point of records
$position = ($page_number * $item_per_page);


$results = db::$link->query("SELECT DISTINCT vuid FROM recom_db WHERE to_uuid = '$user_uuid' ORDER BY time DESC LIMIT $position, $item_per_page");


while($res_row = $results->fetch_array()){

	$video_vuid = $res_row['vuid'];

	$video_sql = db::$link->query("SELECT * FROM video_db WHERE vuid = '$video_vuid' AND status = 'uploaded' AND privacy != 'privat' ");
	$row = $video_sql->fetch_assoc();

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

		//userinfo from
		$from_string = "";
		$from_c = 0;
			$rc_friend_sql = db::$link->query("SELECT * from recom_db WHERE to_uuid = '$user_uuid' AND vuid = '$video_vuid' ORDER BY time DESC");
			while($rc_row = $rc_friend_sql->fetch_array()){
				$from_c++;
				if($from_c <= 3){
					$video_from_uuid 				= $rc_row['from_uuid']; $video_from_uuif = sha1(sha1($video_from_uuid));
					$video_from_user_name 	= $u->userin('name',0,$video_from_uuif,'');
					$video_from_user_avatar = $_dhp.$f->draw_avatar($video_from_uuid,"small");

					$from_string = $from_string."<a class='videopreview_user_name no_overflow' title='".$video_from_user_name."' href='".$_dhp."user/".$video_from_user_name."'><img class='' src='".$video_from_user_avatar."'>".$video_from_user_name."</a>";
				}
			}
			if($from_c > 3){
				$from_co = $from_c - 3;
				$from_string = $from_string." <span class='left'>".$l->recoms_text2." <b class='blue'>+".$from_co."</b> ".$l->recoms_text3."</span>";
			}

		echo"<div class='col-xs-12 col-xl-12 col-spl videopreviewline'>";
				echo $f->draw_video_pewview($video_vuid,1,'none','',$_dhp,$_ddhp,'small','0');

        echo "<div class='videopreview_title no_overflow'><a href='".$_dhp."watch/".$video_vuid."' title='".$video_title."'>".$video_title."</a></div>";

				echo "<a class='videopreview_user_name no_overflow' title='".$video_user_name."' href='".$_dhp."user/".$video_user_name."'><img class='' src='".$video_user_avatar."'>".$video_user_name."</a>";
				echo "<span class='left marg-l-15'> ".$l->recoms_text1." </span>";
				echo $from_string;

				echo "<div class='videopreview_info no_overflow'>".$video_info."</div>";

				echo"<div class='videopreview_date'>".$video_time." <b> · </b> ".$views." ".$l->views_title." </div>";

        echo "<div style='clear:both'></div>";
		echo "</div>";
}

?>
