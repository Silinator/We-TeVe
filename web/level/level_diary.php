<?php

if(isset($_POST['page'])){
	//1. Pfad zum Stammverzeichniss wo sich die index befindet
	$_hp = '../'; //für includes
	$_dhp = '../../'; // für daten

	//2. all include
	$in_save_code_all_include = "&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z";
	require_once ($_hp.'include/all_include.php'); //haupt include
}

	//3. site vals
	$item_per_page = 20;


if($isUserLoggedIn === 1){

if(isset($page)){
	$page_number = $page;
}elseif(isset($_POST['page'])){
	$page_number = $_POST['page'];
}

if(isset($page)){
	$page_number = 0;
}elseif(isset($_POST['u'])){
	$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
}


//throw HTTP error if page number is not valid
if(!is_numeric($page_number)){
	header('HTTP/1.1 500 Invalid page number!');
	exit();
}

//get current starting point of records
$position = ($page_number * $item_per_page);



  $results = db::$link->query("SELECT * FROM xp_db WHERE uuid = '$user_uuid' AND status = 'public' ORDER BY time DESC LIMIT $position, $item_per_page");
  while($row = $results->fetch_array()){

    $level_action       = $row['action'];
    $level_action_data  = $row['action_data'];
    $level_xp           = $row['xp'];
    $level_time         = $row['time'];

    //event_title
      if($level_action < 100){
        $eventtitel = "res_action_title_".$level_action;
        $eventtitel = $l->$eventtitel;
      }elseif($level_action >= 100){
        $eventtitel = "res_ach_title_".$level_action;
        $eventtitel = $l->$eventtitel;
        $eventtitel = "<a class='title_list_ach_title' href='".$_dhp."user/".$user_name."/achv#ach_".$level_action."'> ".$l->ach_title."</a> ".$eventtitel;
      }

      $level_xp = number_format($level_xp,0, ",", ".");
      if($level_xp > 0 ){
        $level_xp_count = "class='level_list_xp blue'>+".$level_xp;
      }else{
        $level_xp_count= "class='level_list_xp red'>".$level_xp;
      }

      $level_date = $t->invor($level_time);

      echo "<tr class='level_list_diary'>";
      echo "<td ".$level_xp_count."".$l->level_xp_title."</td>
            <td class='level_list_event'>".$eventtitel."<span class='level_list_diary_date blue'> ".$level_date."</span></td>";
      echo "</tr>";
			
  }

}//if usser logged in
?>
