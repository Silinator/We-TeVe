<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet
$_hp = ''; //für includes
$_dhp = ''; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

//3. site vals
$html_title = $l->recoms_title0.' | We-TeVe'; //Tap title
$item_per_page = 24;

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



			<script src='<?php echo $_dhp;?>js/load_more.js'></script>
			<script>
				$(document).ready(function(){
					docready();
					sethtmltitle('<?php echo $html_title; ?>');
				});

			</script>

		</span>

    <?php


    $allvideoCount = 0;


        //$frind_sql = db::$link->query("SELECT frind_id FROM frind_db WHERE first_uuid = '$channel_uuid' AND second_uuid = '$user_uuid' AND status = 'confirmed' ");
        //$frind_row = $frind_sql->fetch_assoc();


          $vid_results = db::$link->query("SELECT count(DISTINCT vuid) FROM recom_db WHERE to_uuid = '$user_uuid' AND status = 'public'");


      //$c_results = db::$link->query("SELECT COUNT(kuid) FROM video_db WHERE (vuid = '$vuid' OR cuid = '$cuid') AND status = 'public'");

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
                $.post('<?php echo $_dhp; ?>ajax/recoms', {'page': track_click}, function(data) {
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

					echo "<div class='col-xs-12 col-sm-12 col-xl-12 videolist_title'>".$l->recoms_title0." (".$allvideoCount.")</div>";
				?>

			<?php if($get_total_rows != 0){ ?>
        <div id="results">
          <?php
					$page_number = 0;
					require_once ($_hp."ajax/recoms.php");
					?>
        </div>
          <div align="center">
          <button class="load_more w-100 marg-l-15 blue_btn btn-default btn" id="load_more_button" <?php if($get_total_rows <= $item_per_page){echo "disabled='disabled'";}else{} ?> ><?php echo $l->loadmore; ?></button>
          <div class="animation_image" style="display:none;"><img src="<?php echo $_dhp; ?>images/icons/ajax-loader.gif"> <?php echo $l->loading; ?></div>
          </div>
				<?php }else{
					echo "<div class='marg-l-15'>
						<span class='left w-100'>".$l->recoms_title_embty."</span>";
					echo "</div>";
				} ?>

      </div>
			<div class="column3 col-xs-0 col-sm-0 col-md-0 col-lg-1 col-xl-3 col-spl"></div>
    </div>



<?php if($infram != 1){?>
		</div>
	</body>
</html>
<?php }

}else{//if logged in
	Header('Location: '.$_dhp.'login');
}
?>
