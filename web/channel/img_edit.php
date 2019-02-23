<?php
echo "
<div class='pm_container_bg pm_container_edit_img pm_edit_to_hide hide'>
  <div class='col-spl col-xs-0 col-sm-1 col-md-2 col-lg-4 col-xl-3 col-spl'></div>
  <div class='pm_container pm_container_edit col-xs-11 col-sm-10 col-md-8 col-lg-4 col-xl-5'>
    <div class='pm_title_container'>";
      echo "<div class='pm_title'>".$la->edit_img_title.":</div>";
        echo "<div class='pm_close_btn pm_close_btn' onClick=[CloseEditBox('img')]><span class='glyphicon glyphicon-remove'></span></div>";
    echo "</div>";

  echo "<div class='pm_pl_container pm_scroll_container'>";


echo  "<form method='POST' id='image_edit_form' runat='server' enctype='multipart/form-data'>";


          ?>
		<!-- upload -->
					<editTitle><?php echo $la->edit_img_title3; ?></editTitle>
					<div class='w-100'><?php echo $la->edit_img_title4; ?></div>

					<div id='profil_img_upl' class='norm_upload_btn fileUpload btn btn-primary btn-default'>
						<span><?php echo $la->edit_img_title5;?></span>
						<input type='file' id='image_img' class='upload' name='channel_img'>
					</div>

					<div style="display:none;" id="vorschau-img_edit">
						<div class='w-100'><?php echo $la->edit_img_title6;?></div>
						<div class="img_preview"><img id="image_preview" src="#" alt="<?php echo $la->edit_img_title6_5; ?>"/></div>
						<br/>
					</div>
					<?php
					if($channel_design['img_data'] != ""){
						echo"<div class='w-100'>".$l->edit_img_title5_5.":</div>";
							echo"<div class='old_img_preview'><img id='old_img_preview' src='".$_dhp."images/channel/channel_img/".$channel_uuid.".".$channel_design['img_data']."' alt='old IMG'/></div>";
					}
					?>
					<script>

					function readurl(url){
						document.getElementById("image_preview").src = url;
						document.getElementById("vorschau-img_edit").style.display = "block";
					}

					$("#image_img").change(function(){
							function readURL(input) {

									if (input.files && input.files[0]) {
											var reader = new FileReader();

											reader.onload = function (e) {
													$('#image_preview').attr('src', e.target.result);
											}

											reader.readAsDataURL(input.files[0]);
									}
								}


								document.getElementById("vorschau-img_edit").style.display = "block";
								readURL(this);
							});
					</script>

					<br/>
					<input type="submit" class="savebutton" name="save" value="<?php echo $la->edit_img_title8; ?>" required />

          <?php

		echo "<div class='placeholder_edit'></div>";

	echo  "</form>";

	echo  "</div>";

	echo  "</div>";
echo  "</div>";


if(isset($_POST['save'])) {
				if(isset($_FILES['channel_img']['tmp_name']) && !empty($_FILES['channel_img']['size'])) {

					$file = $_FILES['channel_img']['name'];
					$allowed_ex = array('jpg','JPG','JPEG','jpeg','png','PNG','gif','GIF');

					$user_sha_id = $channel_uuid;


					$extension = explode('.', $_FILES['channel_img']['name']);
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

					if ($_FILES['channel_img']['size'] < 2000000) {
						if($extension == 'jpg' OR $extension == 'png'){
								$file        = $_FILES["channel_img"]["tmp_name"];
								$target      = "images/channel/channel_img/".$name;
								$quality     = "100";
								if($extension == 'jpg') {$src_img = imagecreatefromjpeg($file);}
								if($extension == 'png') {$src_img = imagecreatefrompng($file); }
								$picsize     = getimagesize($file);
								$src_width   = $picsize[0];
								$src_height  = $picsize[1];

								$dst_img = imagecreatetruecolor($src_width,$src_height);
								imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $src_width, $src_height, $src_width, $src_height);
								imagejpeg($dst_img, "$target", $quality);

								//für png  imagecreatefrompng($file); und den target auf .png ändern
								//für gif  imagecreatefromgif($file); und den target auf .gif  ändern und imagesjprg auf imagegif setzen
						}elseif($extension == 'gif'){

							//animated gif render
								$file   = $_FILES["channel_img"]["tmp_name"];

								//server path:
								$ffmpeg = "ffmpeg";

								//localhost path:
								//$ffmpeg = "..\\ffmpeg\\bin\\ffmpeg";

							$img = "$ffmpeg -i $file -y images/channel/channel_img/$name";
							if(exec($img)){echo "Error1";}
						}


				$update_box = "Update channel_design_db SET img_data='$extension' WHERE uuid='$channel_uuid'"; $update_box = db::$link->query($update_box);
				echo "<script type='text/javascript'>window.location.href = 'back';</script>";
			}
		}
}


?>
