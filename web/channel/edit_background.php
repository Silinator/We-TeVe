<?php
echo "
<div class='pm_container_bg pm_bg_edit_container pm_to_hide hide'>
  <div class='col-spl col-xs-0 col-sm-1 col-md-2 col-lg-4 col-xl-3 col-spl'></div>
  <div class='pm_container pm_container_edit_bg col-xs-11 col-sm-10 col-md-8 col-lg-4 col-xl-5'>
    <div class='pm_title_container'>";
      echo "<div class='pm_title'>".$l->edit_background_title.":</div>";
        echo "<div class='pm_close_btn pm_bg_edit_close_btn'><span class='glyphicon glyphicon-remove'></span></div>";
    echo "</div>";

  echo "<div class='pm_pl_container pm_scroll_container'>";
?>

<form method='POST' id="background_edit" enctype='multipart/form-data'>

<?php
    $channel_design_sql = db::$link->query("SELECT * FROM channel_design_db WHERE uuid = '$user_uuid'");
    $channel_design = $channel_design_sql->fetch_assoc();

      if($channel_design['background_type'] == "none"){
        $check_background = "1";
        $old_background_type = "0";
      }else{
        $check_background = "0";
        $old_background_type = $channel_design['background_type'];
      }


      if($channel_design['background_color'] == "none"){
        $check_color = "1";
        $old_color_type = "0";
      }else{
        $check_color = "0";
        $old_color_type = $channel_design['background_color'];
      }


?>
  <!-- upload -->

        <editTitle><?php echo $l->edit_background_title1 ?></editTitle>
        <div class='w-100'><?php echo $l->edit_background_title2 ?></div>

        <div id='profil_img_upl' class='norm_upload_btn fileUpload btn btn-primary btn-default'>
          <span><?php echo $l->edit_background_title3 ?></span>
          <input type='file' id='background_img' class='upload' name='background_img'>
        </div>


      <div style="display:none;" id="vorschau">
        <div class='w-100'><?php echo $l->edit_background_title4 ?></div>
        <div class="img_preview"><img id="background_preview" src="#" alt="<?php echo $l->edit_background_title4_5 ?>"/></div>
        <br/>
      </div>
        <?php
        if($old_background_type != "0" || $channel_design['background_type'] != ""){
          echo"<div class='w-100'>".$l->edit_background_title5.":</div>";
            echo"<div class='old_img_preview'><img id='old_img_preview' src='images/channel/background/".$channel_uuid.".".$old_background_type."' alt='old IMG'/></div>";
        }
        ?>
        <script>
        $("#background_img").change(function(){
          function readURL(input) {

              if (input.files && input.files[0]) {
                  var reader = new FileReader();

                  reader.onload = function (e) {
                      $('#background_preview').attr('src', e.target.result);
                  }

                  reader.readAsDataURL(input.files[0]);
              }
            }


              document.getElementById("vorschau").style.display = "block";
              readURL(this);
            });
        </script>

        <div class='w-100'><input type="checkbox" name="none_background" value="none_backgornd" <?php if($check_background == '1'){echo"checked";}?>><?php echo $l->edit_background_title6 ?></div>
        <br/>



        <editTitle><?php echo $l->edit_background_title7 ?></editTitle>
        <div class='w-100'><?php echo $l->edit_background_title8 ?></div>


        <div class="fileUpload norm_upload_btn fileUpload btn btn-primary btn-default">
          <span><?php echo $l->edit_background_title8_5 ?></span>
          <input type="color" value="<?php if($check_color == 0){echo $old_color_type;}else{echo"#000000";}?>" class="w-100 color" name="background_color"/>
        </div>

        <div class='w-100'><input type="checkbox" name="none_color" value="none_backgornd" <?php if($check_color == '1'){echo"checked";}?> ><?php echo $l->edit_background_title9 ?></div>
        <br/>



        <br/>
        <input type="submit" class="savebutton" name="save_background" value="<?php echo $l->edit_background_title11 ?>" required />

        <?php

  echo "<div class='placeholder_edit'></div>";

echo  "</form>";

echo "</div>";
echo "</div>";


if(isset($_POST['save_background'])) {

      $error_up = 0;
      if(isset($_POST['none_background'])){
      $none_background =	$_POST['none_background'];
      }else{$none_background = "";}


      if($none_background != ""){
        $up_type = "Update channel_design_db SET background_type='none' WHERE uuid='$channel_uuid'"; $up_type = db::$link->query($up_type);
      }

      if(isset($_FILES['background_img']['tmp_name']) && !empty($_FILES['background_img']['size'])) {

        $file = $_FILES['background_img']['name'];
        $allowed_ex = array('jpg','JPG','JPEG','jpeg','png','PNG');


        $extension = explode('.', $_FILES['background_img']['name']);
        $extension = end($extension);

        if($extension == 'png' OR $extension == 'PNG'){
            //name = $user_sha_id
            $extension = 'png';

        }elseif($extension == 'jpg' OR $extension == 'JPG'){
            //name = $user_sha_id
            $extension = 'jpg';

        }

        if(!in_array($extension, $allowed_ex)) {
          echo $l->edit_background_alert1;
          $error_up = 1;
        }

        if ($_FILES['background_img']['size'] < 2500000) {

              $file        = $_FILES['background_img']["tmp_name"];
              $target      = "images/channel/background/".$channel_uuid.".jpg";
              $quality     = "100";
              if($extension == 'jpg') {$src_img = imagecreatefromjpeg($file);}
              if($extension == 'png') {$src_img = imagecreatefrompng($file);}
              $picsize     = getimagesize($file);
              $src_width   = $picsize[0];
              $src_height  = $picsize[1];

              $dst_img = imagecreatetruecolor($src_width,$src_height);
              imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $src_width, $src_height, $src_width, $src_height);
              imagejpeg($dst_img, "$target", $quality);

              $up_type = "Update channel_design_db SET background_type='jpg' WHERE uuid='$channel_uuid'"; $up_type = db::$link->query($up_type);

        }else{
          echo $l->edit_background_alert3;
          $error_up = 1;
        }

      }


//Bild Color :

        $color_data =	$_POST['background_color'];


        if(isset($_POST['none_color'])){
          $none_color =	$_POST['none_color'];
          $none_color = mysqli_real_escape_string(db::$link,$none_color);
        }else{$none_color = "";}

        if($none_color == "") {

          $up_color = "Update channel_design_db SET background_color='$color_data' WHERE uuid='$channel_uuid'"; $up_color = db::$link->query($up_color);

        }elseif(isset($none_color)){
          $up_color = "Update channel_design_db SET background_color='none' WHERE uuid='$channel_uuid'"; $up_color = db::$link->query($up_color);

        }

      if($error_up == 0){
        echo "<script type='text/javascript'>window.location.href = '".$_dhp."back';</script>";
      }

      return false;
    }
?>

</div>


<script>
$('.edit-background').click( function(){
  $('.pm_bg_edit_container').removeClass('hide');
  $('.body').addClass('stop_srolling');
});

$('.pm_bg_edit_close_btn').unbind('click').click(function(){
  $('.pm_to_hide').addClass('hide');
  $('.body').removeClass('stop_srolling');
});

$(document).mouseup(function (e){
  var container = $('.pm_container_edit,.pm_container_edit_av,.pm_container_edit_bg');
  var container2 = $('.bm_container');
  if (!container.is(e.target) && container.has(e.target).length === 0 && !container2.is(e.target) && container2.has(e.target).length === 0){
    $('.pm_bg_edit_container').addClass('hide');
    $('.body').removeClass('stop_srolling');
  }
});
</script>
