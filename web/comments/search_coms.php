<?php

if(!isset($com_video_vuid) AND !isset($com_cuid) AND !isset($search_val) ){

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

if(isset($_POST['search_val'])){
  $search_val = $_POST['search_val'];
}elseif(isset($search_val)){
  $search_val = $search_val;
}else{
  $search_val = 0;
}

$search_val = urldecode($search_val); $search_val = mysqli_real_escape_string(db::$link,$search_val);

  if($com_video_vuid == ""){
    $com_video_vuid = "!";
  }
  if($com_cuid == ""){
    $com_cuid = "!";
  }



$item_per_page = 20;
$position = $page_number * $item_per_page;


$results = db::$link->query("SELECT kuid FROM kommentar_db WHERE (vuid = '$com_video_vuid' OR cuid = '$com_cuid') AND kommentar LIKE '%$search_val%' AND status = 'public' ORDER BY time DESC LIMIT $position, $item_per_page");

while($row = $results->fetch_array()){

  $kuid = $row['kuid'];

  //gibt layer zurück
    //check kuid
      $c_kuid_ans = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$kuid' LIMIT 1");
      $c_kuid_ans = $c_kuid_ans->fetch_assoc();
         $check_kuid_ans = $c_kuid_ans['re_kuid'];


    if($kuid != "" AND $check_kuid_ans != ""){
      $layer = 2;
    }else{
      $layer = 1;
    }

  echo $com->draw_comment($kuid,$layer,0,1,$_dhp);
}

?>
