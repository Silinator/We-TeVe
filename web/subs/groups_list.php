<?php

if(isset($_POST['page']) AND isset($_POST['sub_uuid'])){
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
  $abo_channel_uuid = mysqli_real_escape_string(db::$link,$_POST['sub_uuid']);

  //online Freunde
    $results = db::$link->query("SELECT aguid,group_name,url from abo_group_db WHERE uuid = '$user_uuid' AND status = 'public' ORDER BY posi ASC LIMIT $position, $item_per_page");

		$posi = $position;

    while($row = $results->fetch_array()){
			$posi++;
			$aguid = $row['aguid'];
			$sub_group_name = htmlentities( $row['group_name'], ENT_QUOTES);

      //Abobutton
  		$abo_channel_user_subs = $abo_channel_subs;

  		if($this->isUserLoggedIn() === 1){
  			$user_uuid = $this->userin('uuid',0,'this','');
  			$abo_sql = db::$link->query("SELECT abo_id FROM abo_db WHERE abo_user_uuid = '$abo_channel_uuid' AND user_uuid = '$user_uuid' AND status = 'public'");
  			$abo_row = $abo_sql->fetch_assoc();

  			if($abo_row['abo_id'] != ""){
  				echo "<div class='sub_container'>";
  					echo "<div user='".$abo_channel_uuid."' class='sub_btn sub_btn_".$abo_channel_uuid." blue_btn button left pad-5' aria-label='Left Align'>";
  						echo "<span class='abo_subed'>".$this->sub_subed."</span> <span class='abo_sub hide'>".$this->sub_sub."</span>";
  					echo "</div>";
  					echo "<div class='sub_more_opt'> <span class='glyphicon glyphicon-option-vertical'></span> </div>";
  					echo "<div class='abo_count pad-5 left user-".$abo_channel_uuid." gray_btn nh-button'>".$abo_channel_sub_n."</div>";
  				echo "</div>";
  			}else{
  				echo "<div class='sub_container'>";
  					echo "<div user='".$abo_channel_uuid."' class='sub_btn sub_btn_".$abo_channel_uuid." blue_btn button left pad-5' aria-label='Left Align'>";
  						echo "<span class='abo_subed hide'>".$this->sub_subed."</span> <span class='abo_sub'>".$this->sub_sub."</span>";
  					echo "</div>";
  					echo "<div class='sub_more_opt '> <span class='glyphicon glyphicon-option-vertical'></span> </div>";
  					echo "<div class='abo_count pad-5 left user-".$abo_channel_uuid." gray_btn nh-button'>".$abo_channel_sub_n."</div>";
  				echo "</div>";
  			}
  		}else{
  			echo "<div class='sub_container'>";
  				echo "<a href='".$_dhp."login/'  user='".$abo_channel_uuid."' class='sub_btn blue_btn button left pad-5 pad-top-9' aria-label='Left Align'>";
  					echo "<span class='abo_subed hide'>".$this->sub_subed."</span> <span class='abo_sub'>".$this->sub_sub."</span>";
  				echo "</a>";
  				echo "<div class='abo_count pad-5 left user-".$abo_channel_uuid." gray_btn nh-button'>".$abo_channel_sub_n."</div>";
  			echo "</div>";
  		}
  		//end abobutton

    }

}
