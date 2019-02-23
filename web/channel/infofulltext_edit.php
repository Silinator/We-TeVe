<?php
echo "
<div class='pm_container_bg pm_container_edit_infofulltext pm_edit_to_hide hide'>
  <div class='col-spl col-xs-0 col-sm-1 col-md-2 col-lg-4 col-xl-3 col-spl'></div>
  <div class='pm_container pm_container_edit col-xs-11 col-sm-10 col-md-8 col-lg-4 col-xl-5'>
    <div class='pm_title_container'>";
      echo "<div class='pm_title'>".$la->edit_infofulltext_title.":</div>";
        echo "<div class='pm_close_btn pm_close_btn' onClick=[CloseEditBox('infofulltext')]><span class='glyphicon glyphicon-remove'></span></div>";
    echo "</div>";

  echo "<div class='pm_pl_container pm_scroll_container'>";

echo  "<form method='POST'>";

$channel_design_sql = db::$link->query("SELECT * FROM channel_design_db WHERE uuid = '$channel_uuid'");
$channel_design_row = $channel_design_sql->fetch_assoc();

$full_text_norm = $channel_design['info_full_text'];
$full_text = $com->fulltext($full_text_norm);
$full_text = $f->autolink($full_text,array("target"=>"_blank"));
	$sonderzeichen_info2 = array(
		'<br />' => '',
		'<br/>' => '',
		'<br>' => '',
	);
	$full_text_ohne_br = str_replace(array_keys($sonderzeichen_info2),
		array_values($sonderzeichen_info2), $full_text_norm);
		?>


		<edittitle><?php echo $la->infofulltext_edit_title; ?>:</edittitle>

		<textarea class="i_edit_info_textarea" id="kanalinfo" name="kanalinfo" maxlength="1000" placeholder="<?php echo $la->i_info_placeholder; ?>"><?php echo $full_text_ohne_br; ?></textarea>


		<input type="submit" class="savebutton" name="save_kanalinfo" value="<?php echo $la->edit_info_title7;?>" required />


		<?php
		echo "<div class='placeholder_edit'></div>";

	echo  "</form>";

	echo  "</div>";
	echo  "</div>";
echo  "</div>";

if(isset($_POST['save_kanalinfo'])) {

				$kanalinfo = substr($_POST['kanalinfo'],0,1000);

        $kanalinfo    = nl2br($kanalinfo);
        $kanalinfo    = trim($kanalinfo);
          $kanalinfo    = mysqli_real_escape_string(db::$link,$kanalinfo);

				$update_box11 = "Update channel_design_db SET info_full_text='$kanalinfo' WHERE uuid='$user_uuid'"; $update_box10 = db::$link->query($update_box11);


				echo "<script type='text/javascript'>window.location.href = 'back';</script>";
}
?>
