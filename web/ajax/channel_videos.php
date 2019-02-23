<?php

if(isset($_POST['u']) AND isset($_POST['sort'])){
	//1. Pfad zum Stammverzeichniss wo sich die index befindet
	$_hp = '../'; //für includes
	$_dhp = '../../'; // für daten


	//2. all include
	$in_save_code_all_include = "&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z";
	require_once ($_hp.'include/all_include.php'); //haupt include


	//3. site vals
	$item_per_page = 24;

}


if(isset($sort)){
	$sort = $sort;
}elseif(isset($_POST['sort'])){
	$sort = $_POST['sort'];
}

if(isset($channel_uuid)){
	$channel_uuid = $channel_uuid;
	$page_number = 0;
}elseif(isset($_POST['u'])){
	$channel_uuid = $_POST['u'];
	$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
}


$channel_uuid = mysqli_real_escape_string(db::$link,$channel_uuid); //save text





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


if($isUserLoggedIn === 1){
		$friend_sql = db::$link->query("SELECT friend_id FROM friend_db WHERE first_uuid = '$channel_uuid' AND second_uuid = '$user_uuid' AND status = 'confirmed' ");
		$friend_row = $friend_sql->fetch_assoc();


		if($friend_row['friend_id'] != ""){
				if($sort == 0){ $results = db::$link->query("SELECT vuid FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' AND (privacy = 'public' OR privacy = 'friend') ORDER BY views DESC, uploaddate DESC LIMIT $position, $item_per_page");

				}elseif($sort == 1){ $results = db::$link->query("SELECT vuid FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' AND (privacy = 'public' OR privacy = 'friend') ORDER BY uploaddate ASC LIMIT $position, $item_per_page");

				}elseif($sort == 2){ $results = db::$link->query("SELECT vuid FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' AND (privacy = 'public' OR privacy = 'friend') ORDER BY uploaddate DESC LIMIT $position, $item_per_page");

				}elseif($sort == 3){ $results = db::$link->query("SELECT vuid FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' AND (privacy = 'public' OR privacy = 'friend') ORDER BY (pos_vote - neg_vote) DESC, uploaddate DESC LIMIT $position, $item_per_page");

				}else{ $results = db::$link->query("SELECT vuid FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' AND (privacy = 'public' OR privacy = 'friend') ORDER BY uploaddate DESC LIMIT $position, $item_per_page");
				}
		}elseif($channel_uuid == $user_uuid){
				if($sort == 0){ $results = db::$link->query("SELECT vuid FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' ORDER BY views DESC, uploaddate DESC LIMIT $position, $item_per_page");

				}elseif($sort == 1){ $results = db::$link->query("SELECT vuid FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' ORDER BY uploaddate ASC LIMIT $position, $item_per_page");

				}elseif($sort == 2){ $results = db::$link->query("SELECT vuid FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' ORDER BY uploaddate DESC LIMIT $position, $item_per_page");

				}elseif($sort == 3){ $results = db::$link->query("SELECT vuid FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' ORDER BY (pos_vote - neg_vote) DESC, uploaddate DESC LIMIT $position, $item_per_page");

				}else{ $results = db::$link->query("SELECT vuid FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' ORDER BY uploaddate DESC LIMIT $position, $item_per_page");
				}
		}else{
			if($sort == 0){ $results = db::$link->query("SELECT vuid FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' AND privacy = 'public' ORDER BY views DESC, uploaddate DESC LIMIT $position, $item_per_page");

			}elseif($sort == 1){ $results = db::$link->query("SELECT vuid FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' AND privacy = 'public' ORDER BY uploaddate ASC LIMIT $position, $item_per_page");

			}elseif($sort == 2){ $results = db::$link->query("SELECT vuid FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' AND privacy = 'public' ORDER BY uploaddate DESC LIMIT $position, $item_per_page");

			}elseif($sort == 3){ $results = db::$link->query("SELECT vuid FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' AND privacy = 'public' ORDER BY (pos_vote - neg_vote) DESC, uploaddate DESC LIMIT $position, $item_per_page");

			}else{ $results = db::$link->query("SELECT vuid FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' AND privacy = 'public' ORDER BY uploaddate DESC LIMIT $position, $item_per_page");
			}
		}

}else{

	if($sort == 0){ $results = db::$link->query("SELECT vuid FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' AND privacy = 'public' ORDER BY views DESC, uploaddate DESC LIMIT $position, $item_per_page");

	}elseif($sort == 1){ $results = db::$link->query("SELECT vuid FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' AND privacy = 'public' ORDER BY uploaddate ASC LIMIT $position, $item_per_page");

	}elseif($sort == 2){ $results = db::$link->query("SELECT vuid FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' AND privacy = 'public' ORDER BY uploaddate DESC LIMIT $position, $item_per_page");

	}elseif($sort == 3){ $results = db::$link->query("SELECT vuid FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' AND privacy = 'public' ORDER BY (pos_vote - neg_vote) DESC, uploaddate DESC LIMIT $position, $item_per_page");

	}else{ $results = db::$link->query("SELECT vuid FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded' AND privacy = 'public' ORDER BY uploaddate DESC LIMIT $position, $item_per_page");
	}

}
//$results->execute(); //Execute prepared Query
//$results->bind_result(, , , , , , , ); //bind variables to prepared statement



while($row = $results->fetch_array()){
		$video_vuid 		= $row['vuid'];
		echo"<div class='col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 videobox'>";
				echo $f->draw_video_pewview($video_vuid,1,'ver','',$_dhp,$_ddhp,'small','0');
				echo "<div style='clear:both'></div>";
		echo "</div>";
}


?>
