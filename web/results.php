<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet
$_hp = ''; //für includes
$_dhp = ''; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

//3. site vals

if(isset($_GET['q'])){$search_val = $_GET['q'];}else{$search_val = "";}
if(isset($_GET['cf'])){$catfilter_val = $_GET['cf'];}else{$catfilter_val = "";}
if(isset($_GET['lf'])){$langfilter_val = $_GET['lf'];}else{$langfilter_val = "";}

if(($search_val == "" OR $search_val == " ") AND $catfilter_val == "" AND $langfilter_val == ""){
  Header('Location: '.$_dhp.'');
  return false;
}else{

  $searchval = mysqli_real_escape_string(db::$link,$search_val);
  $searchtext =  htmlentities($search_val, ENT_QUOTES);

  $catfilter_val = mysqli_real_escape_string(db::$link,$catfilter_val);
  $langfilter_val = mysqli_real_escape_string(db::$link,$langfilter_val);


if($catfilter_val != ""){
  $html_title = $l->search_title2.' '.$l->search_title21.' "'.$catfilter_val.'" | We-TeVe'; //Tap title
}elseif($langfilter_val != ""){
  $html_title = $l->search_title2.' '.$l->search_title21.' "'.$langfilter_val .'" | We-TeVe'; //Tap title
}else{
  $html_title = $l->search_title2.' "'.$searchtext.'" | We-TeVe'; //Tap title
}

$item_per_page = 24;


//4. coinhive check
$coin_name = "main";
require_once ($_hp.'coinhive/coinhive_check.php');


//5. check ist inframed (von andererseite geladen)
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

      <?php require_once ($_hp.'include/coinhivescript.php'); ?>

			<script src='<?php echo $_dhp;?>js/load_more.js'></script>
			<script>
				$(document).ready(function(){
					docready();
          loadfun_sub_button();
					sethtmltitle('<?php echo $html_title; ?>');
				});

			</script>

		</span>

    <?php


    $allvideoCount = 0;

      if($catfilter_val != ""){
        $vid_results = db::$link->query("SELECT count(vuid) FROM video_db WHERE kategorie = '$catfilter_val' AND status = 'uploaded' AND privacy = 'public'");
      }elseif($langfilter_val != ""){
        $vid_results = db::$link->query("SELECT count(vuid) FROM video_db WHERE sprache = '$langfilter_val' AND status = 'uploaded' AND privacy = 'public'");
      }else{
        $vid_results = db::$link->query("SELECT count(vuid) FROM video_db WHERE(match(user_name,video_title,info) against('+$searchval' IN BOOLEAN MODE) OR video_title LIKE '%$searchval%') AND status = 'uploaded' AND privacy = 'public'");
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
        <?php $searchval_js = htmlentities($searchval, ENT_QUOTES); ?>
        var searchval = '<?php echo $searchval_js; ?>';
        var catfilter = '<?php echo $catfilter_val; ?>';
        var langfilter = '<?php echo $langfilter_val; ?>';

        $(".load_more").click(function (e) {
          $(this).hide();
          $('.animation_image').show();

            if(track_click <= total_pages)
            {
                $.post('<?php echo $_dhp; ?>search/videos', {'page': track_click, 'searchval': searchval, 'catfilter': catfilter, 'langfilter': langfilter}, function(data) {
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

        <div id="results">
          <?php
            $page_number = 0;
            require_once ($_hp."search/videos.php");

					?>
        </div>
          <div align="center">
          <button class="load_more w-100 marg-l-15 blue_btn btn-default btn" id="load_more_button" <?php if($get_total_rows <= $item_per_page){echo "disabled='disabled'";}else{} ?> ><?php echo $l->loadmore; ?></button>
          <div class="animation_image" style="display:none;"><img src="<?php echo $_dhp; ?>images/icons/ajax-loader.gif"> <?php echo $l->loading; ?></div>
          </div>
      </div>
			<div class="column3 col-xs-0 col-sm-0 col-md-0 col-lg-1 col-xl-3 col-spl"></div>
    </div>



<?php if($infram != 1){?>
		</div>
	</body>
</html>
<?php }


}
?>
