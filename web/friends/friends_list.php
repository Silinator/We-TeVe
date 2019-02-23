<?php

if(isset($_POST['page'])){
	//1. Pfad zum Stammverzeichniss wo sich die index befindet
	$_hp = '../'; //für includes
	$_dhp = '../../'; // für daten

	//2. all include
	$in_save_code_all_include = "&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z";
	require_once ($_hp.'include/all_include.php'); //haupt include

	//3. site vals
	$item_per_page = 20;
}

if($isUserLoggedIn === 1){

  if(isset($page)){
  	$page_number = 0;
  }elseif(isset($_POST['page'])){
  	$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
  }


  //throw HTTP error if page number is not valid
  if(!is_numeric($page_number)){
  	header('HTTP/1.1 500 Invalid page number!');
  	exit();
  }

  //get current starting point of records
  $position = ($page_number * $item_per_page);

  //online Freunde
    $results = db::$link->query("SELECT friend_db.* FROM friend_db INNER JOIN user_find_db ON friend_db.second_uuid = user_find_db.uuid
    WHERE friend_db.first_uuid = '$user_uuid' AND friend_db.status = 'confirmed' AND user_find_db.online_status = 'online' ORDER BY friend_db.time ASC LIMIT $position, $item_per_page");

    $online_friends = 0;
    while($row = $results->fetch_array()){
      $online_friends++;

      $fri_uuid = $row['second_uuid']; $fri_uuif = sha1(sha1($fri_uuid));
        $avatar_img = $_dhp.$f->draw_avatar($fri_uuid,'small');
        $fri_user_name = $u->userin('name',0,$fri_uuif,'');


      echo "<div class='fri_line fri_".$fri_uuid."_line '>";
        echo "<div class='fri_user_avatar noselect'> <a href='".$_dhp."user/".$fri_user_name."'> <img src='".$avatar_img."'/> </a> </div>";
          echo "<div class='fri_main_content'>";
            echo "<div class='fri_title noselect no_overflow'><a href='".$_dhp."user/".$fri_user_name."'>".$fri_user_name."</a> </div>";
            echo "<div class='fri_text noselect no_overflow'>".$l->fri_online_title."</div>";
          echo "</div>";
          echo "<div class='fri_switch'> <span for='fri_".$fri_uuid."' class='fri_switch_btn fri_open_btn glyphicon glyphicon-chevron-down'></span> </div>";

          //hidden content
          echo "<div class='fri_hidden_content fri_".$fri_uuid."'>";
						echo "<div isnavi='' friend_uuid='".$fri_uuid."' class='fri_list_button noselect block_friend'>".$l->fri_block_title."</div> <div isnavi='' friend_uuid='".$fri_uuid."'  class='fri_list_button noselect remove_friend'>".$l->fri_delete_title."</div>";
          echo "</div>";

      echo "<div style='clear:both;'></div>";
      echo "</div>";
    }


  $item_per_page = $item_per_page - $online_friends;

  //offline Freunde
    $results2 = db::$link->query("SELECT friend_db.* FROM friend_db INNER JOIN user_find_db ON friend_db.second_uuid = user_find_db.uuid
    WHERE friend_db.first_uuid = '$user_uuid' AND friend_db.status = 'confirmed' AND user_find_db.online_status = 'offline' ORDER BY friend_db.time ASC LIMIT $position, $item_per_page");

    while($row2 = $results2->fetch_array()){

			$fri_uuid = $row2['second_uuid']; $fri_uuif = sha1(sha1($fri_uuid));
				$avatar_img = $_dhp.$f->draw_avatar($fri_uuid,'small');
				$fri_user_name = $u->userin('name',0,$fri_uuif,'');


			echo "<div class='fri_line fri_".$fri_uuid."_line '>";
				echo "<div class='fri_user_avatar noselect'> <a href='".$_dhp."user/".$fri_user_name."'> <img src='".$avatar_img."'/> </a> </div>";
					echo "<div class='fri_main_content'>";
						echo "<div class='fri_title noselect no_overflow'><a href='".$_dhp."user/".$fri_user_name."'>".$fri_user_name."</a> </div>";
						echo "<div class='fri_text noselect no_overflow'>".$l->fri_offline_title."</div>";
					echo "</div>";
					echo "<div class='fri_switch'> <span for='fri_".$fri_uuid."' class='fri_switch_btn fri_open_btn glyphicon glyphicon-chevron-down'></span> </div>";

					//hidden content
					echo "<div class='fri_hidden_content fri_".$fri_uuid."'>";
						echo "<div isnavi='' friend_uuid='".$fri_uuid."' class='fri_list_button noselect block_friend'>".$l->fri_block_title."</div> <div isnavi='' friend_uuid='".$fri_uuid."'  class='fri_list_button noselect remove_friend'>".$l->fri_delete_title."</div>";
					echo "</div>";

			echo "<div style='clear:both;'></div>";
			echo "</div>";

    }

}
