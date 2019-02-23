<?php

if(!isset($com_video_vuid)){

    //1. Pfad zum Stammverzeichniss wo sich die index befindet

    $_hp = '../'; //für include
    $_dhp = '../'; // für daten

    //2. all include
    $in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
    require_once ($_hp.'include/all_include.php'); //haupt includ

}

//post value

if(isset($_POST["page"])){
	$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
	$page_number = $page_number;
}elseif(isset($page)){
	$page_number = $page;
}

//HTTP error
if(!is_numeric($page_number)){header('HTTP/1.1 500 Invalid page number!');exit();}


if(isset($_POST['vuid'])){$com_video_vuid = $_POST['vuid'];}
elseif(isset($com_video_vuid)){$com_video_vuid = $com_video_vuid;}
else{$com_video_vuid = "!";}  $com_video_vuid = mysqli_real_escape_string(db::$link,$com_video_vuid);

if(isset($_POST['cuid']) AND $_POST['cuid'] != ""){$com_cuid = $_POST['cuid'];}
elseif(isset($com_cuid) AND $com_cuid != ""){$com_cuid = $com_cuid;}
else{$com_cuid = '!';}  $com_cuid = mysqli_real_escape_string(db::$link,$com_cuid);

if(isset($_POST['sort']) AND is_numeric($_POST['sort'])){$sort = $_POST['sort'];}
elseif(isset($sort)){$sort = $sort;}
else{$sort = 1;}


  if($com_video_vuid == ""){
    $com_video_vuid = "!";
  }
  if($com_cuid == ""){
    $com_cuid = "!";
  }



$item_per_page = 20;
$position = $page_number * $item_per_page;



/* Sort

  1 = Alle kommentare mit 2 Top Koimmentaren
  2 = Neuste zuerst
  3 = Älteste zuerst
  4 = Top Kommentare zuerst
  5 = Ohne Antworten
  6 = Mit Antworten
  7 = Mit Videoantwort
  8 = Von Freunden
  9 = Meine Kommentare
 10 = Zufällig

*/


//layer 1
if($sort == 1){ 		 $results = db::$link->query("SELECT kuid FROM kommentar_db WHERE (vuid = '$com_video_vuid' OR cuid = '$com_cuid') AND re_kuid = '' ORDER BY time DESC LIMIT $position, $item_per_page");

}elseif($sort == 2){ $results = db::$link->query("SELECT kuid FROM kommentar_db WHERE (vuid = '$com_video_vuid' OR cuid = '$com_cuid') AND re_kuid = '' ORDER BY time DESC LIMIT $position, $item_per_page");

}elseif($sort == 3){ $results = db::$link->query("SELECT kuid FROM kommentar_db WHERE (vuid = '$com_video_vuid' OR cuid = '$com_cuid') AND re_kuid = '' ORDER BY time ASC LIMIT $position, $item_per_page");

}elseif($sort == 4){ $results = db::$link->query("SELECT kuid FROM kommentar_db WHERE (vuid = '$com_video_vuid' OR cuid = '$com_cuid') AND re_kuid = '' ORDER BY (pos_vote - neg_vote) DESC, time DESC LIMIT $position, $item_per_page");

//ohne antwort
}elseif($sort == 5){ $preresults = db::$link->query("SELECT DISTINCT k_b.kuid as kuid FROM kommentar_db AS k_b INNER JOIN kommentar_db AS c_bank ON k_b.kuid = c_bank.re_kuid
  WHERE (k_b.vuid = '$com_video_vuid' OR k_b.cuid = '$com_cuid') AND k_b.re_kuid = ''");

  $sort_5_vals  = "AND ";
  while($prerow = $preresults->fetch_array()){
    $pre_kuid = $prerow['kuid'];
    $sort_5_vals = $sort_5_vals."kuid != '".$pre_kuid."' AND ";
  }

  $results = db::$link->query("SELECT kuid FROM kommentar_db WHERE (vuid = '$com_video_vuid' OR cuid = '$com_cuid') AND re_kuid = '' $sort_5_vals status = 'public' AND status = 'deleted' ORDER BY time DESC LIMIT $position, $item_per_page");


}elseif($sort == 6){ $results = db::$link->query("SELECT DISTINCT k_b.kuid as kuid FROM kommentar_db AS k_b INNER JOIN kommentar_db AS c_bank ON k_b.kuid = c_bank.re_kuid
  WHERE (k_b.vuid = '$com_video_vuid' OR k_b.cuid = '$com_cuid') AND k_b.re_kuid = '' ORDER BY k_b.time DESC LIMIT $position, $item_per_page");

}elseif($sort == 7){ $results = db::$link->query("SELECT kuid FROM kommentar_db WHERE (vuid = '$com_video_vuid' OR cuid = '$com_cuid') AND re_kuid = '' AND added_video != '' ORDER BY time DESC LIMIT $position, $item_per_page");

}elseif($sort == 8 AND $isUserLoggedIn === 1){ $results = db::$link->query("SELECT kuid FROM kommentar_db INNER JOIN friend_db ON friend_db.second_uuid = kommentar_db.uuid WHERE (kommentar_db.vuid = '$com_video_vuid' OR kommentar_db.cuid = '$com_cuid') AND friend_db.first_uuid = '$user_uuid' AND friend_db.status = 'confirmed' AND kommentar_db.status = 'public' ORDER BY kommentar_db.time DESC LIMIT $position, $item_per_page");

}elseif($sort == 9 AND $isUserLoggedIn === 1){ $results = db::$link->query("SELECT kuid FROM kommentar_db WHERE (vuid = '$com_video_vuid' OR cuid = '$com_cuid') AND uuid = '$user_uuid' ORDER BY time DESC LIMIT $position, $item_per_page");

}elseif($sort == 10){ $results = db::$link->query("SELECT kuid FROM kommentar_db WHERE (vuid = '$com_video_vuid' OR cuid = '$com_cuid') ORDER BY RAND() DESC LIMIT $position, 1");

}else{$results = db::$link->query("SELECT kuid FROM kommentar_db WHERE (vuid = '$com_video_vuid' OR cuid = '$com_cuid') AND re_kuid = '' ORDER BY time DESC LIMIT $position, $item_per_page");}


if($isUserLoggedIn === 1 AND $sort != 1){
	//add ach204
  $ach->add_ach('204','',$user_uuid);
}

//layer 1
while($row = $results->fetch_array()){


  $kuid = $row['kuid'];
	$layer = 1;
  $show = 0;  //0 = not show 'zum Kommentar' 1 = show 'zum Kommenta'


  if($sort == 8 OR $sort == 9 OR $sort == 10){

  //gibt layer zurück
    //check kuid
      $c_kuid_ans = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$kuid' LIMIT 1");
      $c_kuid_ans = $c_kuid_ans->fetch_assoc();
         $check_kuid_ans = $c_kuid_ans['re_kuid'];


    if($kuid != "" AND $check_kuid_ans != ""){
      $layer = 2;
    }

    $show = 1;
  }

		//test ob antworten verfügbar
			$c_kuid_ans = db::$link->query("SELECT kuid FROM kommentar_db WHERE re_kuid = '$kuid' LIMIT 1");
			$c_kuid_ans = $c_kuid_ans->fetch_assoc();
				 $check_kuid_ans = $c_kuid_ans['kuid'];


  echo $com->draw_comment($kuid,$layer,0,$show,$_dhp);

		if($show == 0 AND $check_kuid_ans != ""){
			echo "<div class='toggle_ans_btn noselect' for='".$kuid."'>
        <span class='com_show_ans com_show_ans_".$kuid."'>       <span class=' glyphicon glyphicon-chevron-right'> </span> ".$l->com_show_ans."</span>
        <span class='com_show_ans_load com_show_ans_load_".$kuid." load_more_loading hide'><span class=' glyphicon glyphicon-chevron-right'> </span> <img src='".$_dhp."images/icons/ajax-loader.gif' alt='We-Teve'/> ".$l->loading."</span>
        <span class='com_hide_ans com_hide_ans_".$kuid." hide'>  <span class=' glyphicon glyphicon-chevron-down'>  </span> ".$l->com_hide_ans."</span>
      </div>";

			echo "<div style='display:none' class='com_ans ans_".$kuid."'></div>";
			echo "<div class='toggle_ans_btn hide' for='".$kuid."' > <span class='com_hide_ans '>".$l->com_hide_ans."</span> </div>";
		}

}//end layer 1

?>


<script>
  setTimeout(function(){
    loadfun_falseLink(); //die links müssen vor den kommentaren laden sonnst erkennt es den link an und nicht die zeitangebe zum skipen
    coms_loaded();
  },1);
</script>
