<?php
$channel_design_img = db::$link->query("SELECT * FROM channel_design_db WHERE uuid = '$channel_uuid'");
$channel_design_img = $channel_design_img->fetch_assoc();

$img_data = $channel_design_img['img_data'];
$channel_id_img = $channel_design_img['uuid'];


if($img_data != ""){
    if($img_data == 'png' OR $img_data == 'jpg' OR $img_data == 'gif' ){

        if($img_data == 'png'){
          echo"<img src='".$_dhp."images/channel/channel_img/".$channel_id_img.".png' height='100%' width='100%'/>";

        }elseif($img_data == 'jpg'){
          echo"<img src='".$_dhp."images/channel/channel_img/".$channel_id_img.".jpg' height='100%' width='100%'/>";

        }else{
          echo"<img src='".$_dhp."images/channel/channel_img/".$channel_id_img.".gif' height='100%' width='100%'/>";
        }
    }else{
      echo"<img src='".$img_data."' height='100%' width='100%'/>";
    }
}
?>
