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

if(isset($puid)){
	$puid = $puid;
}elseif(isset($_POST["puid"])){
	$puid = mysqli_real_escape_string(db::$link,$_POST["puid"]); //save text
}


//throw HTTP error if page number is not valid
if(!is_numeric($page_number)){
	header('HTTP/1.1 500 Invalid page number!');
	exit();
}

//get current starting point of records
$position = ($page_number * $item_per_page);

$posi = $position;
$this_max_posi = $posi + $item_per_page;

$sql_c_playlist_res = db::$link->query("SELECT COUNT(puid) FROM playlist_content_db WHERE puid = '$puid' AND status = 'public'");
$sql_c_playlist_res = $sql_c_playlist_res->fetch_row();
	$heighest_res = $sql_c_playlist_res[0];


$playlist_sql = db::$link->query("SELECT uuid,orderby FROM playlist_db WHERE puid = '$puid'");
$playlist_row = $playlist_sql->fetch_assoc();
	$pl_uuid 		= $playlist_row['uuid'];
 	$pl_orderby = $playlist_row['orderby'];

//check adminrights
if($isUserLoggedIn === 1){
	if($user_uuid == $pl_uuid OR $user_rang == 1){
		$ar = 1;
	}else{
		$ar = 0;
	}
}else{$ar = 0;}
//end check adminrights



if($pl_orderby == 0)		 		{ $results = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY posi ASC LIMIT $position, $item_per_page");
}elseif($pl_orderby  == 1)	{ $results = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at DESC LIMIT $position, $item_per_page");
}elseif($pl_orderby  == 2)	{ $results = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY added_at ASC LIMIT $position, $item_per_page");
}elseif($pl_orderby  == 3)	{ $results = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate DESC LIMIT $position, $item_per_page");
}elseif($pl_orderby  == 4)	{ $results = db::$link->query("SELECT vuid FROM playlist_content_db WHERE puid = '$puid' AND status = 'public' ORDER BY uploaddate ASC LIMIT $position, $item_per_page");
}





while($row2 = $results->fetch_array()){

    $posi++;

    $video_vuid 		= $row2['vuid'];
    $video_sql = db::$link->query("SELECT * FROM video_db WHERE vuid = '$video_vuid'");
    $row = $video_sql->fetch_assoc();
      $video_title 		= htmlentities($row['video_title'], ENT_QUOTES);
  		$video_uuid 		= $row['uuid'];
  		$views_erg 			= $row['views'];
  		$views 					= number_format($views_erg,0, ",", ".");
			$privacy				= $row['privacy'];
			$status					= $row['status'];

    $user_sql = db::$link->query("SELECT user_name FROM user_find_db WHERE uuid = '$video_uuid'");
    $user_row = $user_sql->fetch_assoc();
      $video_user_name = $user_row['user_name'];

    $video_user_avatar = $_dhp.$f->draw_avatar($video_uuid,"small");


		if($privacy == "privat" AND $user_uuid != $video_uuid){
			$video_title 		= $l->watch_error_msg5;
		}elseif($status == "deleted"){
			$video_title		= $l->watch_error_msg0;
		}elseif($status != "uploaded"){
			$video_title 		= $l->watch_error_msg3;
		}


		echo"<div class='col-xs-12 col-xl-12 col-spl videoplaylistline'>";
        echo "<div class='vidpl_posi_box'>";
					if($posi != 1 AND $ar == 1){
          	echo "<div posi='".$posi."' class='vidpl_posi_move vidpl_posi_move_up noselect'> <div class='vidpl_posi_icon'><span class='glyphicon glyphicon-chevron-up'></span> </div> </div>";
					}else{
						echo "<div class='vidpl_posi_move'> </div>";
					}
          echo "<div class='vidpl_posi_posi'>                   <div class='vidpl_posi_icon'> ".$posi." </div> </div>";
          if($posi != $heighest_res AND $posi != $this_max_posi AND $ar == 1){
						echo "<span class='vidpl_posi_move_down_".$posi."'> <div posi='".$posi."' class='vidpl_posi_move vidpl_posi_move_down noselect'> <div class='vidpl_posi_icon'> <span class='glyphicon glyphicon-chevron-down'></span> </div> </div> </span>";
					}else{
						echo "<span class='vidpl_posi_move_down_".$posi."'> <div class='vidpl_posi_move'> </div> </span>";
					}
        echo "</div>";

			echo "<div class='videoplaylist_con_".$posi." videoplaylist_content'>";
				echo $f->draw_video_pewview($video_vuid,1,'none','&pl='.$puid,$_dhp,$_ddhp,'small','0');

	      echo "<div class='videoplaylist_title blue no_overflow'><a href='".$_dhp."watch/".$video_vuid."&pl=".$puid."' title='".$video_title."'>".$video_title."</a></div>";
					if($ar == 1){
						echo "<div vuid='".$video_vuid."' class='videoplaylist_more_opt'>  <span class='glyphicon glyphicon-option-vertical'></span> </div>";
						echo "<div class='videoplaylist_more_opt_menu videoplaylist_more_opt_menu_".$video_vuid." hide'>";
							echo "<div vuid='".$video_vuid."' puid='".$puid."' class='videoplaylist_more_opt_sel videoplaylist_remove_video'>".$l->pl_add_title3."</div>";
							echo "<div vuid='".$video_vuid."' puid='".$puid."' class='videoplaylist_more_opt_sel videoplaylist_change_thumb'>".$l->pl_add_title4."</div>";
						echo "</div>";
					}
	      echo "<a class='videopreview_user_name no_overflow' title='".$video_user_name."' href='".$_dhp."user/".$video_user_name."'><img class='' src='".$video_user_avatar."'>".$video_user_name."</a>";
			echo "</div>";

      echo "<div style='clear:both;'></div>";
		echo "</div>";


}


?>
