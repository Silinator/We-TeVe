<?php
//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = "../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

if ($isUserLoggedIn === 1){

  if(isset($_FILES['thumb'])){
    if(isset($_GET['vuid'])){

      $vuid = $_GET['vuid'];


      $video_sql = db::$link->query("SELECT uuid FROM video_db WHERE vuid = '$vuid' AND status != 'start'");
      $video_row = $video_sql->fetch_assoc();

      //darf der nutzer diese thumbnail ändern
      if($video_row['uuid'] == ""){
        echo "3";
        return false;
      }

      if($video_row['uuid'] == $user_uuid || $user_rang === 1){

          $thumbname = $vuid.".jpg";

          $file = $_FILES['thumb']['name'];
          $allowed_ex = array('jpg','JPG','JPEG','jpeg','png','PNG');


          $extension = explode('.', $_FILES['thumb']['name']);
          $extension = end($extension);

          if($extension == 'png' OR $extension == 'PNG'){
              //name = $user_sha_id
              $extension = 'png';

          }elseif($extension == 'jpg' OR $extension == 'JPG' OR $extension == 'JPEG' OR $extension == 'jpeg' ){
              //name = $user_sha_id
              $extension = 'jpg';

          }

          if(!in_array($extension, $allowed_ex)) {
            echo "7";
            return false;
            exit;
          }

          if ($_FILES['thumb']['size'] < 3000000) {

                $file        = $_FILES["thumb"]["tmp_name"];
                $target      = "../images/thumb/large_img/".$thumbname;
                $target2     = "../images/thumb/small_img/".$thumbname;
                $target3     = "../images/thumb/org_img/".$thumbname;
                $max_width   = "1280";
                $max_heigh   = "720";
                $max_width2  = "320";
                $max_heigh2  = "180";
                $quality     = "100";
                if($extension == 'jpg') {$src_img = imagecreatefromjpeg($file);}
                if($extension == 'png') {$src_img = imagecreatefrompng($file);}
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

                if($src_width > $max_width2)
                {
                  $convert = $max_width2/$src_width;
                  $dest_width2 = $max_width2;
                  $dest_height2 = $max_heigh2;
                }
                else
                {
                  $dest_width2 = $src_width;
                  $dest_height2 = $src_height;
                }

                $dst_img = imagecreatetruecolor($dest_width,$dest_height);
                imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $dest_width, $dest_height, $src_width, $src_height);
                imagejpeg($dst_img, "$target", $quality);

                $dst_img2 = imagecreatetruecolor($dest_width2,$dest_height2);
                imagecopyresampled($dst_img2, $src_img, 0, 0, 0, 0, $dest_width2, $dest_height2, $src_width, $src_height);
                imagejpeg($dst_img2, "$target2", $quality);

                $dst_img3 = imagecreatetruecolor($src_width,$src_height);
                imagecopyresampled($dst_img3, $src_img, 0, 0, 0, 0, $src_width, $src_height, $src_width, $src_height);
                imagejpeg($dst_img3, "$target3", $quality);


                $up = "UPDATE video_db SET thumb = 'own' WHERE vuid = '$vuid'";
                $up = db::$link->query($up);

          			echo "1";

                //für png  imagecreatefrompng($file); und den target auf .png ändern

                //für gif  imagecreatefromgif($file); und den target auf .gif  ändern und imagesjprg auf imagegif setzen

          }else{echo "5";}

        }else{//user rechte
          echo "2";
        }
    }else{echo "3";}
  }
}else{echo "3";} //end logged in



?>
