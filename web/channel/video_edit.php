<?php
$item_per_page = 12;

$vid_results = db::$link->query("SELECT COUNT(vuid) FROM video_db WHERE uuid = '$channel_uuid' AND status = 'uploaded'");
if($vid_results){
	$get_total_rows = $vid_results->fetch_row();
	$get_total_rows = $get_total_rows[0];
	$allvideoCount  = $get_total_rows;
	$allvideoCount  = number_format($allvideoCount,0, ",", ".");
	$total_pages = ceil($get_total_rows/$item_per_page);
}

	echo "
	<div class='pm_container_bg pm_container_edit_video pm_edit_to_hide hide'>
	  <div class='col-spl col-xs-0 col-sm-1 col-md-2 col-lg-4 col-xl-3 col-spl'></div>
	  <div class='pm_container pm_container_edit col-xs-11 col-sm-10 col-md-8 col-lg-4 col-xl-5'>
	    <div class='pm_title_container'>";
	      echo "<div class='pm_title'>".$la->edit_video_title.":</div>";
	        echo "<div class='pm_close_btn pm_close_btn' onClick=[CloseEditBox('video')]><span class='glyphicon glyphicon-remove'></span></div>";
	    echo "</div>";

	  echo "<div class='pm_pl_container pm_scroll_container'>";
?>



<!--eigene Videos-->
<editTitle><?php echo $la->edit_video_title1; ?></editTitle>

	<div class='video_edit_content_result'>
	<?php
		if($allvideoCount == "0"){
			echo $la->no_uploaded_videos_edit;
		}else{
	?>


	<div class='row'>
		<div class='col-xs-12 col-spl'>
			<div id="results">
				<?php
				$page_number = 0;
				require_once ($_hp."ajax/channel_edit_videos.php");
				?>
			</div>
				<div align="center">
				<button class="load_more w-100 blue_btn btn-default button <?php if($get_total_rows <= $item_per_page){echo "hide";}else{} ?>" id="load_more_button" <?php if($get_total_rows <= $item_per_page){echo "disabled='disabled'";}else{} ?> ><?php echo $l->loadmore; ?></button>
				<div class="animation_image" style="display:none;"><img src="<?php echo $_dhp; ?>images/icons/ajax-loader.gif"> <?php echo $l->loading; ?></div>
				</div>
		</div>
	</div>
	<?php
		}
	?>
	</div>


<?php

//andere Videos
echo  "<editTitle>".$la->edit_video_title2."</editTitle>";

?>

<input type='text' class='video_check_input form-control' onchange="checkpickedvideo(this.value)" onKeyUp="checkpickedvideo(this.value)" placeholder="<?php echo $la->edit_video_text1; ?>"/>
<div id="video_check_result" class="video_check_result marg-top-10">
</div>

	<div class='video_edit_save_box'>
		<form method="post">
			<input type='hidden' id='video_edit_vuid' value='' name='video_edit_data' />
			<button type='submit' id='video_edit_save_btn' class='savebutton' name='video_edit_vuid_save' ><?php echo $la->edit_video_title8;?></button>
		</form>
	</div>

<?php
echo "<div class='placeholder_edit'></div>";


	echo  "</div>";
	echo  "</div>";
echo  "</div>";
?>
<script>

	function loadfun_edit_videos(){
		$('.videoeditbox').unbind('click').click( function(){
			var vuiddata = $(this).attr('vuiddata');
			$('.videoeditbox .thumb_vid_box').removeClass('thumb_vid_box_sel');
			$(this).find('.thumb_vid_box').addClass('thumb_vid_box_sel');
			$('.videoeditbox .thumb_holder').removeClass('thumb_vid_box_sel');
			$(this).find('.thumb_holder').addClass('thumb_vid_box_sel');
			$('#video_edit_vuid').val(vuiddata);
		});
	}

	function checkpickedvideo(video_link){
		$.post('<?php echo $_dhp; ?>channel/video_check', {'link': video_link}, function(data) {
			$('.video_check_result').html(data);
			loadfun_edit_videos();
		});
	}



  function OpenEditBox_video(){
      document.getElementById("edit_box-video").style.display = 'block';
      document.getElementById("edit_background-video").style.display = 'block';
			document.getElementById("editboxtitle-video").style.display = 'block';
  }

  function CloseEditBox_video(){
      document.getElementById("edit_box-video").style.display = 'none';
      document.getElementById("edit_background-video").style.display = 'none';
			document.getElementById("editboxtitle-video").style.display = 'none';
  }

</script>

<script>
	$(document).ready(function() {
		resultloadedforthumbpreview(); loadfun_edit_videos();

		var track_click = 1;
		var total_pages = <?php echo $total_pages; ?>;

		$(".load_more").click(function (e) {
			$(this).hide();
			$('.animation_image').show();

				if(track_click <= total_pages)
				{
						$.post('<?php echo $_dhp; ?>ajax/channel_edit_videos', {'page': track_click}, function(data) {
							$(".load_more").show();
							$("#results").append(data);

							//scroll die seite automatisch
							//$("html, body").animate({scrollTop: $("#load_more_button").offset().top}, 500);

							$('.animation_image').hide();
							track_click++; resultloadedforthumbpreview(); loadfun_edit_videos();

						});

						if(track_click >= total_pages-1)
						{
							$(".load_more").attr("disabled", "disabled");
							$(".load_more").addClass('hide');
						}

				 } //end track_click <= total_pages
			}); //end load more function
	}); //end document load
</script>

<?php
	if(isset($_POST['video_edit_vuid_save'])){
		$video_data = $_POST['video_edit_data'];

		$video_data = mysqli_real_escape_string(db::$link,$video_data);

			$update_box = "Update channel_design_db SET video_data='$video_data' WHERE uuid='$user_uuid'"; $update_box = db::$link->query($update_box);
			echo "<script type='text/javascript'>window.location.href = 'back';</script>";

	}
?>
