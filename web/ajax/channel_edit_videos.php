<?php

if(isset($_POST['page'])){
	//1. Pfad zum Stammverzeichniss wo sich die index befindet
	$_hp = '../'; //für includes
	$_dhp = '../../'; // für daten


	//2. all include
	$in_save_code_all_include = "&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z";
	require_once ($_hp.'include/all_include.php'); //haupt include


	//3. site vals
	$item_per_page = 12;

}


if(isset($page_number)){
	$page_number = 0;
}else{
	$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
}

if($isUserLoggedIn === 1){

		//throw HTTP error if page number is not valid
		if(!is_numeric($page_number)){
			header('HTTP/1.1 500 Invalid page number!');
			exit();
		}

		//get current starting point of records
		$position = ($page_number * $item_per_page);

		//updateed planed
		$time = strtotime(date('Y-m-d H:i:s'));
		$up 	= "UPDATE video_db SET privacy = 'public' WHERE privacy = 'planed' AND uploaddate < '$time'";
		$up 	= db::$link->query($up);


				$results = db::$link->query("SELECT vuid FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' ORDER BY uploaddate DESC LIMIT $position, $item_per_page");

		//$results->execute(); //Execute prepared Query
		//$results->bind_result(, , , , , , , ); //bind variables to prepared statement



		while($row = $results->fetch_array()){
				$video_vuid 		= $row['vuid'];
				echo"<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 videoeditbox' vuiddata='".$video_vuid."'>";
						echo $f->draw_video_pewview($video_vuid,1,'ver','',$_dhp,$_ddhp,'small','0');
						echo "<div style='clear:both'></div>";
				echo "</div>";
		}

}
?>
