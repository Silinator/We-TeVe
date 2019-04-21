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

if($isUserLoggedIn === 1){

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

$results = db::$link->query("SELECT * FROM video_db WHERE uuid = '$user_uuid' AND status != 'deleted' AND status != 'start' ORDER BY uploaddate DESC LIMIT $position, $item_per_page");

while($row = $results->fetch_array()){

		$video_vuid 		= $row['vuid'];
    $video_title 		= htmlentities($row['video_title'], ENT_QUOTES);
		$video_time 		= $t->invor($row['uploaddate']);
		$views_erg 			= $row['views'];
		$views 					= number_format($views_erg,0, ",", ".");

		$max_result 		= $row['max_result'];
		$render_status2	= $row['render_status'];

		//privacy
		$video_privacy	= $row['privacy'];
		$privacys = array(
			'public' => '<span title="'.$l->up_privacy_title1.'" class="glyphicon glyphicon-globe" aria-hidden="true"></span>',
			'unlist' => '<i 	 title="'.$l->up_privacy_title2.'" class="fa fa-unlock" aria-hidden="true"></i>',
			'friend' => '<span title="'.$l->up_privacy_title3.'" class="glyphicon glyphicon-user" aria-hidden="true"></span>',
			'privat' => '<i 	 title="'.$l->up_privacy_title4.'" class="fa fa-lock" aria-hidden="true"></i>',
			'planed' => '<span title="'.$l->up_privacy_title5.'" class=" glyphicon glyphicon-time" aria-hidden="true"></span>'
		);
		$privacy_content = str_replace(array_keys($privacys),array_values($privacys), $video_privacy);

		//status
		$video_status	= $row['status'];
				 if($video_status == "uploaded" AND $video_privacy == "public"){ 						$status_content = "<span class='blue'>".$l->vm_text1."</span>";
		}elseif($video_status == "uploaded" AND $video_privacy == "planed"){ 						$status_content = "<span class='blue'>".$l->vm_text2.": ".$t->normtime($row['uploaddate'],'date+times')."</span>";
		}elseif($video_status == "uploaded" AND $video_privacy != "planed"){ 						$status_content = "<span class='blue'>".$l->vm_text3."</span>";
		}elseif($video_status == "uploading")															 { 						$status_content = "<span 						 >".$l->vm_text4."</span>";
		}elseif($video_status == "abort")																	 { 						$status_content = "<span class='red' >".$l->vm_text5."</span>";
		}elseif($video_status == "copy_rights")														 { 						$status_content = "<span class='red' >".$l->vm_text5."</span>";
		}elseif($video_status == "community_rights")											 { 						$status_content = "<span class='red' >".$l->vm_text5."</span>";
		}elseif($video_status == "rendering"){
					$progressval = "NaN";
							if($max_result == "240"){
					 if($render_status2 == "uploading" OR $render_status2 == "downloaded")  { $progressval = "11"; }
					 if($render_status2 == "rendering")  { $progressval = "20"; }
					 if($render_status2 == "audio")      { $progressval = "48"; }
					 if($render_status2 == "240")        { $progressval = "100"; }
				 }elseif($max_result == "360"){
					 if($render_status2 == "uploading" OR $render_status2 == "downloaded")  { $progressval = "23"; }
					 if($render_status2 == "rendering")  { $progressval = "30"; }
					 if($render_status2 == "audio")      { $progressval = "68"; }
					 if($render_status2 == "360")        { $progressval = "100"; }
				 }elseif($max_result == "480"){
					 if($render_status2 == "uploading" OR $render_status2 == "downloaded")  { $progressval = "14"; }
					 if($render_status2 == "rendering")  { $progressval = "20"; }
					 if($render_status2 == "audio")      { $progressval = "29"; }
					 if($render_status2 == "480")        { $progressval = "65"; }
					 if($render_status2 == "240")        { $progressval = "100"; }
				 }elseif($max_result == "720"){
					 if($render_status2 == "uploading" OR $render_status2 == "downloaded")  { $progressval = "12"; }
					 if($render_status2 == "rendering")  { $progressval = "20"; }
					 if($render_status2 == "audio")      { $progressval = "26"; }
					 if($render_status2 == "720")        { $progressval = "64"; }
					 if($render_status2 == "360")        { $progressval = "100"; }
				 }elseif($max_result == "1080"){
					 if($render_status2 == "uploading" OR $render_status2 == "downloaded")  { $progressval = "10"; }
					 if($render_status2 == "rendering")  { $progressval = "23"; }
					 if($render_status2 == "audio")      { $progressval = "28"; }
					 if($render_status2 == "1080")       { $progressval = "63"; }
					 if($render_status2 == "480")        { $progressval = "81"; }
					 if($render_status2 == "240")        { $progressval = "100"; }
				 }elseif($max_result == "1440"){
					 if($render_status2 == "uploading" OR $render_status2 == "downloaded")  { $progressval = "8"; }
					 if($render_status2 == "rendering")  { $progressval = "25"; }
					 if($render_status2 == "audio")      { $progressval = "45"; }
					 if($render_status2 == "1440")       { $progressval = "61"; }
					 if($render_status2 == "720")        { $progressval = "83"; }
					 if($render_status2 == "360")        { $progressval = "100"; }
				 }elseif($max_result == "2160"){
					 if($render_status2 == "uploading" OR $render_status2 == "downloaded")  { $progressval = "5"; }
					 if($render_status2 == "rendering")  { $progressval = "12"; }
					 if($render_status2 == "audio")      { $progressval = "31"; }
					 if($render_status2 == "2160")       { $progressval = "53"; }
					 if($render_status2 == "1080")       { $progressval = "62"; }
					 if($render_status2 == "480")        { $progressval = "88"; }
					 if($render_status2 == "240")        { $progressval = "100"; }
				 }else{
					 $progressval = "2";
				 }


			$status_content = "<span>".$l->vm_text6." (ca. ".$progressval."%)</span>";
		}


		echo"<div class='col-xs-12 col-xl-12 col-spl videopreviewline_".$video_vuid." videopreviewline'>";
			echo $f->draw_video_pewview($video_vuid,1,'none','',$_dhp,$_ddhp,'small','0');

      echo "<div class='videopreview_title no_overflow'><a href='".$_dhp."watch/".$video_vuid."' title='".$video_title."'>".$video_title."</a></div>";
			echo"<div class='videopreview_date'>".$video_time." <b> · </b> ".$views." ".$l->views_title."</div>";

			echo "<div class='videopreview_privacy'>".$privacy_content." ".$l->vm_text0.": ".$status_content."</div>";

			echo "<a href='".$_dhp."video-manager/edit/".$video_vuid."'> <div class='video_edit_button marg-l-10 noselect'>".$l->vm_title1."</div></a>";
			echo "<div vuid='".$video_vuid."' class='video_del_button marg-l-10 marg-bot-10 noselect'>".$l->vm_title2."</div>";
			echo "<div class='error_viddel error_viddel_".$video_vuid." left marg-l-10 red hide'>".$l->vm_alert1."</div>";

      echo "<div style='clear:both;'></div>";
		echo "</div>";


		echo "<div class='smalldelmenu_bg videodelmenu_".$video_vuid." hide'>";
			echo "<div class='smalldelmenu'>";
				echo "<div class=''>".$l->vm_title2_0.":<br/><div title='".$video_title."' class='smalldel_title no_overflow blue'>".$video_title."</div></div>";
				echo "<br/>";
				echo "<div vuid='".$video_vuid."' class='smallmenu_del_yes_button noselect'>".$l->vm_title2_1."</div>";
				echo "<div vuid='".$video_vuid."' class='smallmenu_del_no_button marg-l-10 noselect'>".$l->vm_title2_2."</div>";
			echo "</div>";
		echo "</div>";
}

}

?>
