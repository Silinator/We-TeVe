<?php

if(isset($_POST['link'])){
	//1. Pfad zum Stammverzeichniss wo sich die index befindet
	$_hp = '../'; //für includes
	$_dhp = '../'; // für daten


	//2. all include
	$in_save_code_all_include = "&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z";
	require_once ($_hp.'include/all_include.php'); //haupt include


	$link = mysqli_real_escape_string(db::$link,$_POST['link']);

	$cut = array(
		'https://localhost/we-teve/watch/' => '',
		'localhost/we-teve/watch?v=' => '',
		'localhost/we-teve/watch/' => '',
		'https://localhost/we-teve/watch?v=' => '',
		'https://www.we-teve.com/watch/' => '',
		'https://we-teve.com/watch?v=' => '',
		'https://we-teve.com/watch/' => '',
		'https://www.we-teve.com/w/' => '',
		'https://www.we-teve.com/w/' => '',
		'https://we-teve.com/w/' => '',
		'www.we-teve.com/watch?v=' => '',
		'www.we-teve.com/watch/' => '',
		'www.we-teve.com/w/' => '',
		'we-teve.com/watch?v=' => '',
		'we-teve.com/watch/' => '',
		'we-teve.com/w/' => '',
		'/watch?v=' => '',
		'watch?v=' => '',
		'/watch/' => '',
		'watch/' => '',
		'/w/' => ''
	);

	$video_url = str_replace(array_keys($cut),
		array_values($cut), $link);

	$video_url = strlen($video_url) > 8 ? substr($video_url,0,8)."" : $video_url;


	$time = strtotime(date('Y-m-d H:i:s'));
	$up 	= "UPDATE video_db SET privacy = 'public' WHERE privacy = 'planed' AND uploaddate < '$time'";
	$up 	= db::$link->query($up);


	$video_sql = db::$link->query("SELECT vuid FROM video_db WHERE vuid = '$video_url' AND (( uuid = '$user_uuid' AND status = 'uploaded' AND privacy = 'public') OR (uuid != '$user_uuid' AND status = 'uploaded') ) ");
	$video_row = $video_sql->fetch_assoc();

			$video_vuid 		= $video_row['vuid'];
			if($video_vuid != ""){
				echo"<div class='col-xs-12 col-spl videoeditbox' vuiddata='".$video_vuid."'>";
						echo $f->draw_video_pewview($video_vuid,1,'hor','',$_dhp,$_ddhp,'small','0');
						echo "<div style='clear:both'></div>";
				echo "</div>";
			}else{
				echo "<div class='red'>".$l->edit_video_text2."</div>";
			}

}
?>
