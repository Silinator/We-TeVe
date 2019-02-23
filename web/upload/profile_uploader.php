<?php
//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = '/we-teve/'; // für daten
$upload_in = true;
$isUserLoggedIn = 1;
$usercode_up = $_GET['usercode'];  //like the cookie value

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

if($isUserLoggedIn === 1){

    $user_uuid = $u->userin('uuid',0,'',$usercode_up);



$profilename = $user_uuid.".jpg";

$file = $_FILES['thumb']['name'];
$allowed_ex = array('jpg','JPG','png','PNG');


$extension = explode('.', $_FILES['thumb']['name']);
$extension = end($extension);

if($extension == 'png' OR $extension == 'PNG'){
    //name = $user_sha_id
    $extension = 'png';

}elseif($extension == 'jpg' OR $extension == 'JPG'){
    //name = $user_sha_id
    $extension = 'jpg';

}elseif($extension == 'gif' OR $extension == 'GIF'){
    //name = $user_sha_id
    $extension = 'gif';

}else{
	$extension = '';
}

if(!in_array($extension, $allowed_ex)) {
  echo "<edittitle class='red'>".$l->edit_info_alert1."</edittitle>";
  return false;
}

if ($_FILES['thumb']['size'] < 2000000) {

      $file        = $_FILES["thumb"]["tmp_name"];
      $target      = $_hp."images/profile/".$profilename;
      $max_width   = "430";
      $max_heigh   = "430";
      $quality     = "100";
      if($extension == 'jpg') {if($src_img = imagecreatefromjpeg($file)){}else{$src_img = imagecreatefrompng($file);}}
      if($extension == 'png') {if($src_img = imagecreatefrompng($file)){}else{$src_img = imagecreatefromjpeg($file);}}
      $picsize     = getimagesize($file);
      $src_width   = $picsize[0];
      $src_height  = $picsize[1];
      if($src_width > $max_width)
      {
        $convert = $max_width/$src_width;
        $dest_width = $max_width;
        $dest_height = $max_heigh;
      }
      else
      {
        $dest_width = $src_width;
        $dest_height = $src_height;
      }

	      $dst_img = imagecreatetruecolor($dest_width,$dest_height);
	      imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $dest_width, $dest_height, $src_width, $src_height);
	      imagejpeg($dst_img, "$target", $quality);

			echo"<edittitle class='blue'>".$l->edit_info_alert2."</edittitle>";

      //für png  imagecreatefrompng($file); und den target auf .png ändern

      //für gif  imagecreatefromgif($file); und den target auf .gif  ändern und imagesjpeg auf imagegif setzen

}else{echo "<edittitle class='red'>".$l->edit_info_alert3."</edittitle>";}
}
?>
