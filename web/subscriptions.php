<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet
$_hp = ''; //für includes
$_dhp = ''; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

//3. site vals
$html_title = $l->sub_title0.' | We-TeVe'; //Tap title
$item_per_page = 24;

if(isset($_GET['sort'])){$sort=$_GET['sort'];}else{$sort='2';}


if($isUserLoggedIn === 1){


//4. check ist inframed (von andererseite geladen)
if(isset($_POST['inframed'])){
	if($_POST['inframed'] == 1){
		$infram = 1;
	}else{
		$infram = 0;
	}
}else{
	$infram = 0;
}
?>


<?php if($infram != 1){?>
	<!DOCTYPE html>
	<html lang='<?php echo $l->htmldata; ?>'>
		<head>
			<?php require_once ($_hp.'include/head.php'); ?>
		</head>
		<body id='body' class='body'>

		<?php require_once ($_hp.'include/navi.php'); ?>

		<div id='main_container' class='container main_container'>
<?php } ?>

		<span id='site_scripts'>



			<script>
				$(document).ready(function(){
					docready();
					sethtmltitle('<?php echo $html_title; ?>');
				});

			</script>

		</span>

    <?php


    $allvideoCount = 0;

    if($isUserLoggedIn === 1){
        //$friend_sql = db::$link->query("SELECT friend_id FROM friend_db WHERE first_uuid = '$channel_uuid' AND second_uuid = '$user_uuid' AND status = 'confirmed' ");
        //$friend_row = $friend_sql->fetch_assoc();


          $vid_results = db::$link->query("SELECT COUNT(video_db.vuid) FROM video_db
					INNER JOIN abo_db ON video_db.uuid = abo_db.abo_user_uuid
					WHERE
					(abo_db.user_uuid = '$user_uuid' AND abo_db.status = 'public' AND video_db.status = 'uploaded' AND video_db.privacy = 'public')");

					/* davor: wenn videos als nicht gelistet für freunde sichtbar wurde es in der abobox angezeigt
					$vid_results = db::$link->query("SELECT COUNT(video_db.vuid) FROM video_db
					INNER JOIN abo_db ON video_db.uuid = abo_db.abo_user_uuid
					INNER JOIN friend_db ON video_db.uuid = friend_db.first_uuid
					WHERE
					(abo_db.user_uuid = '$user_uuid' AND video_db.status = 'uploaded' AND video_db.privacy = 'public')
					OR
					(friend_db.second_uuid = '$user_uuid' AND friend_db.status = 'confirmed' AND abo_db.user_uuid = '$user_uuid' AND video_db.status = 'uploaded' AND (video_db.privacy = 'public' OR video_db.privacy = 'friend'))
					GROUP BY video_db.uuid ");
					*/
      }

      if($vid_results){
        $get_total_rows = $vid_results->fetch_row();
        $get_total_rows = $get_total_rows[0];
        $allvideoCount  = $get_total_rows;
        $allvideoCount  = number_format($allvideoCount,0, ",", ".");
        $total_pages = ceil($get_total_rows/$item_per_page);
      }
    ?>

    <script>
      $(document).ready(function() {
        resultloadedforthumbpreview();

        var track_click = 1;
        var total_pages = <?php echo $total_pages; ?>;

        $(".load_more").click(function (e) {
          $(this).hide();
          $('.animation_image').show();

            if(track_click <= total_pages)
            {
                $.post('<?php echo $_dhp; ?>ajax/subs', {'page': track_click}, function(data) {
                  $(".load_more").show();
                  $("#results").append(data);

                  //scroll die seite automatisch
                  //$("html, body").animate({scrollTop: $("#load_more_button").offset().top}, 500);

                  $('.animation_image').hide();
                  track_click++; resultloadedforthumbpreview();

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


    <div class='row'>
			<div id="column1" class="col-lg-2 col-xl-2"> </div>
			<div id="column2" class="col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xl-7 col-spl">

				<?php
					$c_results = db::$link->query("SELECT COUNT(abo_id) FROM abo_db WHERE user_uuid = '$user_uuid' AND status = 'public'");

					if($c_results){
						$get_total_rows = $c_results->fetch_row();
						$get_total_rows = $get_total_rows[0];
						$allsubsCount   = $get_total_rows;
						$allsubsCount   = number_format($allsubsCount,0, ",", ".");
					}

					echo "<div class='col-xs-12 col-sm-12 col-xl-12 videolist_title'>".$l->sub_title0." (".$allsubsCount.")</div>";

			if($allsubsCount != 0){
				?>
        <div id="results">
          <?php
					$page_number = 0;
					require_once ($_hp."ajax/subs.php");
					?>
        </div>
          <div align="center">
          <button class="load_more w-100 marg-l-15 blue_btn btn-default btn" id="load_more_button" <?php if($allvideoCount <= $item_per_page){echo "disabled='disabled'";}else{} ?> ><?php echo $l->loadmore; ?></button>
          <div class="animation_image" style="display:none;"><img src="<?php echo $_dhp; ?>images/icons/ajax-loader.gif"> <?php echo $l->loading; ?></div>
          </div>
			<?php
				}else{
					//Kanal empfehlungen
					echo "<div class='marg-l-15'>
						<span class='left w-100'>".$l->sub_title_embty."</span><br/>";

						$recom_users_sql = db::$link->query("SELECT DISTINCT uuid FROM video_db WHERE uuid != '$user_uuid' AND privacy = 'public' AND status = 'uploaded' ORDER BY RAND() DESC LIMIT 9");
						while($row = $recom_users_sql->fetch_array()){
							echo "<user_box class='marg-top-10'>";
							$f->draw_user_preview($row['uuid'],$_dhp);
							echo "</user_box>";
						}

					echo "</div>";
				}
			?>

      </div>
			<div class="column3 col-xs-0 col-sm-0 col-md-0 col-lg-1 col-xl-3 col-spl"></div>
    </div>



<?php if($infram != 1){?>
		</div>
	</body>
</html>
<?php  }

}else{//if logged in
	Header('Location: '.$_dhp.'login');
}

?>
