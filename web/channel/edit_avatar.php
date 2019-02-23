<?php
echo "
<div class='pm_container_bg pm_av_edit_container pm_to_hide hide'>
  <div class='col-spl col-xs-0 col-sm-1 col-md-2 col-lg-4 col-xl-3 col-spl'></div>
  <div class='pm_container pm_container_edit_av col-xs-11 col-sm-10 col-md-8 col-lg-4 col-xl-5'>
    <div class='pm_title_container'>";
      echo "<div class='pm_title'>".$l->edit_avatar_title.":</div>";
        echo "<div class='pm_close_btn pm_av_edit_close_btn'><span class='glyphicon glyphicon-remove'></span></div>";
    echo "</div>";

  echo "<div class='pm_pl_container pm_scroll_container'>";
?>

<form method='POST' id="avatar_edit" runat="server" enctype='multipart/form-data'>

<?php

    $channel_design_sql = db::$link->query("SELECT * FROM channel_design_db WHERE uuid = '$user_uuid'");
    $channel_design = $channel_design_sql->fetch_assoc();

      if($channel_design['avatar_type'] == "none"){
        $check_avatar = "1";
        $old_avatar_type = "0";
      }else{
        $check_avatar = "0";
        $old_avatar_type = $channel_design['avatar_type'];
      }


?>
  <!-- upload -->

        <editTitle><?php echo $l->edit_avatar_title1;?></editTitle>
        <div class='w-100'><?php echo $l->edit_avatar_title2;?></div>

        <div id='profil_img_upl' class='norm_upload_btn fileUpload btn btn-primary btn-default'>
          <span><?php echo $l->edit_avatar_title3;?></span>
          <input type='file' id='avatar_img' class='upload' name='avatar_img'>
        </div>

      <div style="display:none;" id="vorschau-avatar">
        <div class='w-100'><?php echo $l->edit_avatar_title4;?></div>
        <div class="img_preview"><img id="avatar_preview" src="#" alt="<?php echo $l->edit_avatar_title4_5; ?>"/></div>
        <br/>
      </div>
        <?php
        if($old_background_type != "0" || $channel_design['avatar_type'] != ""){
          echo"<div class='w-100'>".$l->edit_avatar_title5.":</div>";
            $channel_avatar = $_dhp.$f->draw_avatar($channel_uuid,'large');
            echo"<div class='old_img_preview'><img id='old_img_preview' src='".$channel_avatar."' alt='old IMG'/></div>";
        }
        ?>
        <script>
        $("#avatar_img").change(function(){
            function readURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#avatar_preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
              }


              document.getElementById("vorschau-avatar").style.display = "block";
              readURL(this);
            });
        </script>

        <br/>
        <input type="submit" class="savebutton" name="save_avatar" value="<?php echo $l->edit_avatar_title7;?>" required />

        <?php

  echo "<div class='placeholder_edit'></div>";

echo  "</form>";

echo  "</div>";
echo  "</div>";

if(isset($_POST['save_avatar'])) {

      if(isset($_FILES['avatar_img']['tmp_name']) && !empty($_FILES['avatar_img']['size'])) {

        $file = $_FILES['avatar_img']['name'];
        $allowed_ex = array('jpg','JPG','JPEG','jpeg','png','PNG','gif','GIF');

        $user_sha_id = $channel_uuid;


        $extension = explode('.', $_FILES['avatar_img']['name']);
        $extension = end($extension);

        if($extension == 'png' OR $extension == 'PNG'){
            //name = $user_sha_id
            $name = $user_sha_id.".png";
            $extension = 'png';

        }elseif($extension == 'jpg' OR $extension == 'JPG' OR $extension == 'jpeg' OR $extension == 'JPEG'){
            //name = $user_sha_id
            $name = $user_sha_id.".jpg";
            $extension = 'jpg';

        }elseif($extension == 'gif' OR $extension == 'GIF'){
            //name = $user_sha_id
            $name = $user_sha_id.".gif";
            $extension = 'gif';

        }

        if(!in_array($extension, $allowed_ex)) {
          echo $l->edit_avatar_alert1;
          return false;
        }

        if ($_FILES['avatar_img']['size'] < 1000000) {
          if($extension == 'jpg' OR $extension == 'png'){
              $file        = $_FILES["avatar_img"]["tmp_name"];
              $target      = "images/avatar/large/".$name;
              $target2     = "images/avatar/small/".$name;
              $target3     = "images/avatar/orginal/".$name;
              $max_width   = "500";
              $max_heigh   = "500";
              $max_width2   = "100";
              $max_heigh2   = "100";
              $quality     = "100";
              if($extension == 'jpg') {$src_img = imagecreatefromjpeg($file);}
              if($extension == 'png') {$src_img = imagecreatefrompng($file); }
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
                $dest_width2 = $src_width2;
                $dest_height2 = $src_height2;
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

              //für png  imagecreatefrompng($file); und den target auf .png ändern
              //für gif  imagecreatefromgif($file); und den target auf .gif  ändern und imagesjprg auf imagegif setzen
          }elseif($extension == 'gif'){

            //animated gif render
              $file   = $_FILES["avatar_img"]["tmp_name"];

              //server path:
              $ffmpeg = "ffmpeg";

              //localhost path:
              //$ffmpeg = "..\\ffmpeg\\bin\\ffmpeg";

            $img1 = "$ffmpeg -i $file -s 50x50 -y images/avatar/small/$name";
            $img2 = "$ffmpeg -i $file -s 100x100 -y images/avatar/large/$name";
            $img3 = "$ffmpeg -i $file -y images/avatar/orginal/$name";
            if(exec($img1)){echo "Error1";} if(exec($img2)){echo "Error2";} if(exec($img3)){echo "Error3";}
          }


          $update_avatar = "Update channel_design_db SET avatar_type='$extension' WHERE uuid='$channel_uuid'"; $update_avatar = db::$link->query($update_avatar);

      }else{ $l->edit_avatar_alert3;
          return false;}

    }

    echo "<script type='text/javascript'>window.location.href = 'edit?u=".$channel_name."';</script>";

}
?>

</div>


<script>
$('.edit-avatar').click( function(){
  $('.pm_av_edit_container').removeClass('hide');
  $('.body').addClass('stop_srolling');
});

$('.pm_av_edit_close_btn').unbind('click').click(function(){
  $('.pm_to_hide').addClass('hide');
  $('.body').removeClass('stop_srolling');
});

$(document).mouseup(function (e){
  var container = $('.pm_container_edit,.pm_container_edit_av,.pm_container_edit_bg');
  var container2 = $('.bm_container');
  if (!container.is(e.target) && container.has(e.target).length === 0 && !container2.is(e.target) && container2.has(e.target).length === 0){
    $('.pm_av_edit_container').addClass('hide');
    $('.body').removeClass('stop_srolling');
  }
});
</script>
