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
    $results = db::$link->query("SELECT bm_id,title,url from bookmark_db WHERE uuid = '$user_uuid' AND status = 'public' ORDER BY pos DESC LIMIT $position, $item_per_page");

		$posi = $position;

    while($row = $results->fetch_array()){
			$posi++;
			$bm_id = $row['bm_id'];
			$bm_title = htmlentities( $row['title'], ENT_QUOTES);
			$bm_url = mysqli_real_escape_string(db::$link,$row['url']."");

			echo "<div class='bm_list_line bm_list_line_".$bm_id."'>";
				echo "<div class='bm_list_posi'>".$posi."</div>";

				echo "<div class='bm_list_main bm_list_main_".$bm_id."'>";
					echo "<div class='bm_list_first_line bm_list_first_line_".$bm_id." no_overflow'><a href='".$_dhp.$bm_url."'>".$bm_title."</a></div>";
					echo "<div class='bm_list_second_line bm_list_second_line_".$bm_id." no_overflow'>www.We-TeVe.com".$bm_url."</div>";
				echo "</div>";

				echo "<div class='bm_list_main bm_list_main_edit bm_list_main_edit_".$bm_id." hide'>";
					echo "<input type='text' class='bm_list_main_edit_in bm_list_first_line bm_list_edit_first_line_".$bm_id."' value='".$bm_title."'>";
					echo "<input type='text' class='bm_list_main_edit_in bm_list_second_line bm_list_edit_second_line_".$bm_id."' value='".$bm_url."'>";
				echo "</div>";

				echo "<div class='bm_list_btns'>";
					echo "<div for='".$bm_id."' class='bm_list_btn bm_list_edit_btn bm_list_edit_btn_".$bm_id."'> <span class='glyphicon glyphicon-cog'></span> </div>";
					echo "<div for='".$bm_id."' class='bm_list_btn bm_list_del_btn bm_list_del_btn_".$bm_id."'>  <span class='glyphicon glyphicon-trash'></span> </div>";
				echo "</div>";
			echo "</div>";

    }

}
