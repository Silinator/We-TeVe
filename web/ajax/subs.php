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


$results = db::$link->query("SELECT DISTINCT video_db.vuid FROM video_db
INNER JOIN abo_db ON video_db.uuid = abo_db.abo_user_uuid
WHERE
(abo_db.user_uuid = '$user_uuid' AND abo_db.status = 'public' AND video_db.status = 'uploaded' AND video_db.privacy = 'public')
ORDER BY video_db.uploaddate DESC LIMIT $position, $item_per_page");

/* davor: wenn videos als nicht gelistet für freunde sichtbar wurde es in der abobox angezeigt
$results = db::$link->query("SELECT DISTINCT video_db.vuid,video_db.video_title,video_db.info,video_db.uuid,video_db.views,video_db.uploaddate FROM video_db
INNER JOIN abo_db ON video_db.uuid = abo_db.abo_user_uuid
INNER JOIN friend_db ON video_db.uuid = friend_db.first_uuid
WHERE
(friend_db.second_uuid = '$user_uuid' AND friend_db.status = 'confirmed' AND abo_db.user_uuid = '$user_uuid' AND video_db.status = 'uploaded' AND (video_db.privacy = 'public' OR video_db.privacy = 'friend'))
OR
(abo_db.user_uuid = '$user_uuid' AND abo_db.status = 'public' AND video_db.status = 'uploaded' AND video_db.privacy = 'public')
ORDER BY video_db.uploaddate DESC LIMIT $position, $item_per_page");
*/

while($row_vuid = $results->fetch_array()){
		$video_vuid 		= $row_vuid['vuid'];
		$video_sql 			= db::$link->query("SELECT * FROM video_db WHERE vuid = '$video_vuid'");
		$row 						= $video_sql->fetch_assoc();

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
