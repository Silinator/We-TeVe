<?php
echo "
<div class='pm_container_bg pm_container_edit_info pm_edit_to_hide hide'>
  <div class='col-spl col-xs-0 col-sm-1 col-md-2 col-lg-4 col-xl-3 col-spl'></div>
  <div class='pm_container pm_container_edit col-xs-11 col-sm-10 col-md-8 col-lg-4 col-xl-5'>
    <div class='pm_title_container'>";
      echo "<div class='pm_title'>".$la->edit_info_title.":</div>";
        echo "<div class='pm_close_btn pm_close_btn' onClick=[CloseEditBox('info')]><span class='glyphicon glyphicon-remove'></span></div>";
    echo "</div>";

  echo "<div class='pm_pl_container pm_scroll_container'>";


echo  "<form method='POST'>";

$channel_design_sql = db::$link->query("SELECT * FROM channel_design_db WHERE uuid = '$channel_uuid'");
$channel_design_row = $channel_design_sql->fetch_assoc();

$info_date_value = $channel_design['view_date'];
$info_country_value = $channel_design['view_country'];
$title_1 = $channel_design['info_title_1'];
$text_1 = $channel_design['info_text_1'];
$title_2 = $channel_design['info_title_2'];
$text_2 = $channel_design['info_text_2'];
$title_3 = $channel_design['info_title_3'];
$text_3 = $channel_design['info_text_3'];
$title_4 = $channel_design['info_title_4'];
$text_4 = $channel_design['info_text_4'];


$channel_uuif = sha1(sha1($channel_uuid));

$date_beitrit = $u->userin('beitrit',0,$channel_uuif,'');
$date_info = $t->normtime($date_beitrit,'date');

$channel_land_sql = db::$link->query("SELECT * FROM user_find_db WHERE uuid = '$channel_uuid'");
$channel_land_row = $channel_land_sql->fetch_assoc();

$land_info = "land_label_".$channel_land_row['land'];
$land_info = $la->$land_info;

      //info
					echo "
					<editTitleLeft>".$la->edit_info_title1."</editTitleLeft> <editTitleRight>".$la->edit_info_title2."</editTitleRight>
					<input type='text' class='i_edit_info_title i_edit_info_input' value='".$la->edit_info_title3."' title='".$la->edit_info_title4."' disabled/>:
					<input type='text' class='i_edit_info_text i_edit_info_input' value='".$date_info."' title='".$la->edit_info_title4."' disabled/>
					";

					if($info_date_value == '1'){echo"<style>autoTitle,autoText{color:#007abf;}</style>";}else{echo"<style>autoTitle,autoText{color:#333333;}</style>";};

					?>
					<select name='info_date' class='i_edit_info_dropdown info_date'>
						<option value='1'<?php if($info_date_value == '1'){echo 'selected';}?>><?php echo $la->edit_info_title5;?></option>
						<option value='0'<?php if($info_date_value == '0'){echo 'selected';}?>><?php echo $la->edit_info_title6;?></option>
					</select>
					<?php

					echo "
					<input type='text' class='i_edit_info_title i_edit_info_input' value='".$la->edit_info_title3_5."' title='".$la->edit_info_title4."' disabled/>:
					<input type='text' class='i_edit_info_text i_edit_info_input' value='".$land_info."' title='".$la->edit_info_title4."' disabled/>
					";

					?>
					<select name='info_land' class='i_edit_info_dropdown info_land'>
						<option value='1'<?php if($info_country_value == '1'){echo 'selected';}?>><?php echo $la->edit_info_title5;?></option>
						<option value='0'<?php if($info_country_value == '0'){echo 'selected';}?>><?php echo $la->edit_info_title6;?></option>
					</select>
					<?php


					?>
				<!--info1-->
					<input type="text" class="i_edit_info_title i_edit_info_input no_overflow" name="titel_1" value="<?php echo $title_1 ?>"/>:
					<input type="text" class="i_edit_info_text i_edit_info_input no_overflow" name="text_1" value="<?php echo $text_1 ?>"/>

				<!--info2-->
					<input type="text" class="i_edit_info_title i_edit_info_input no_overflow" name="titel_2" value="<?php echo $title_2 ?>"/>:
					<input type="text" class="i_edit_info_text i_edit_info_input no_overflow" name="text_2"  value="<?php echo $text_2 ?>"/>

				<!--info3-->
					<input type="text" class="i_edit_info_title i_edit_info_input  no_overflow" name="titel_3" value="<?php echo $title_3 ?>"/>:
					<input type="text" class="i_edit_info_text i_edit_info_input no_overflow" name="text_3"  value="<?php echo $text_3 ?>"/>

				<!--info4-->
					<input type="text" class="i_edit_info_title i_edit_info_input no_overflow" name="titel_4" value="<?php echo $title_4 ?>"/>:
					<input type="text" class="i_edit_info_text i_edit_info_input no_overflow" name="text_4" value="<?php echo $text_4 ?>"/>


					<input type="submit" class="savebutton" name="save_info" value="<?php echo $la->edit_info_title7;?>" required />

          <?php

		echo "<div class='placeholder_edit'></div>";

	echo  "</form>";

	echo  "</div>";

	echo  "</div>";
echo  "</div>";

if(isset($_POST['save_info'])) {
	$save_date_value =	$_POST['info_date'];
	$save_date_country = $_POST['info_land'];
	$save_title_1 = $_POST['titel_1'];
	$save_text_1 = $_POST['text_1'];
	$save_title_2 = $_POST['titel_2'];
	$save_text_2 = $_POST['text_2'];
	$save_title_3 = $_POST['titel_3'];
	$save_text_3 = $_POST['text_3'];
	$save_title_4 = $_POST['titel_4'];
	$save_text_4 = $_POST['text_4'];


	$save_title_1 = mysqli_real_escape_string(db::$link,$save_title_1);
	$save_text_1  = mysqli_real_escape_string(db::$link,$save_text_1);

	$save_title_2 = mysqli_real_escape_string(db::$link,$save_title_2);
	$save_text_2  = mysqli_real_escape_string(db::$link,$save_text_2);

	$save_title_3 = mysqli_real_escape_string(db::$link,$save_title_3);
	$save_text_3  = mysqli_real_escape_string(db::$link,$save_text_3);

	$save_title_4 = mysqli_real_escape_string(db::$link,$save_title_4);
	$save_text_4  = mysqli_real_escape_string(db::$link,$save_text_4);

	$update_box1 = "Update channel_design_db SET view_date='$save_date_value' WHERE uuid='$user_uuid'"; $update_box1 = db::$link->query($update_box1);
	$update_box2 = "Update channel_design_db SET view_country='$save_date_country' WHERE uuid='$user_uuid'"; $update_box2 =db::$link->query($update_box2);
	$update_box3 = "Update channel_design_db SET info_title_1='$save_title_1' WHERE uuid='$user_uuid'"; $update_box3 = db::$link->query($update_box3);
	$update_box4 = "Update channel_design_db SET info_text_1='$save_text_1' WHERE uuid='$user_uuid'"; $update_box4 = db::$link->query($update_box4);
	$update_box5 = "Update channel_design_db SET info_title_2='$save_title_2' WHERE uuid='$user_uuid'"; $update_box5 = db::$link->query($update_box5);
	$update_box6 = "Update channel_design_db SET info_text_2='$save_text_2' WHERE uuid='$user_uuid'"; $update_box6 = db::$link->query($update_box6);
	$update_box7 = "Update channel_design_db SET info_title_3='$save_title_3' WHERE uuid='$user_uuid'"; $update_box7 = db::$link->query($update_box7);
	$update_box8 = "Update channel_design_db SET info_text_3='$save_text_3' WHERE uuid='$user_uuid'"; $update_box8 = db::$link->query($update_box8);
	$update_box9 = "Update channel_design_db SET info_title_4='$save_title_4' WHERE uuid='$user_uuid'"; $update_box9 = db::$link->query($update_box9);
	$update_box10 = "Update channel_design_db SET info_text_4='$save_text_4' WHERE uuid='$user_uuid'"; $update_box10 = db::$link->query($update_box10);

	echo "<script type='text/javascript'>window.location.href = 'back';</script>";
}


?>
<script>

  function OpenEditBox_info(){
      document.getElementById("edit_box-info").style.display = 'block';
      document.getElementById("edit_background-info").style.display = 'block';
			document.getElementById("editboxtitle-info").style.display = 'block';
  }

  function CloseEditBox_info(){
      document.getElementById("edit_box-info").style.display = 'none';
      document.getElementById("edit_background-info").style.display = 'none';
			document.getElementById("editboxtitle-info").style.display = 'none';
  }

</script>
