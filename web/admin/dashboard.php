<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = "../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

//3. site vals
$html_title = $l->admin_menu_title_1." | We-TeVe"; //Tap title


if($isUserLoggedIn === 1){

  if($user_rang == 1){


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
			<?php
			require_once ($_hp.'include/head.php');
			//echo "<script src='".$_dhp."video/video.js'></script>";
			//echo "<script src='".$_dhp."video/video-hotkey.js'></script>";
			?>
		</head>
		<body id='body' class='body'>

			<?php require_once ($_hp.'include/navi.php'); ?>




		<div id='main_container' class='container main_container'>
<?php	}?>

		<span id='site_scripts'>

      <?php // require_once ($_hp.'include/coinhivescript.php'); ?>
      <script class='check_js'></script>

			<script src='<?php echo $_dhp;?>js/sha256.js'></script>
			<script>

				var playlist_id = 'not_set';

				$(document).ready(function() {
					docready();
					sethtmltitle('<?php echo $html_title; ?>');
				});

			</script>
		</span>

			<div class='row'>
				<div class='col-lg-2 col-xl-2 col-spl'> </div>
				<div class=' col-lg-8 col-xl-8 col-spl'>
						<div class='option_holder option_navi col-lg-2 col-xl-2 col-spl'>
              <h3><?php echo $l->admin_menu_title_0; ?>:</h3>
              <a href='../admin/dashboard' class='opt_a opt_activ'> <?php echo $l->admin_menu_title_1; ?> </a>
              <a href='../admin/videos' class='opt_a'> <?php echo $l->admin_menu_title_4; ?> </a>
						</div>


						<div class='col-lg-10 col-xl-10'>
							<div class='option_content option_holder pad-bot-15'>

							</div>
						</div>
				</div>
				<div class='col-lg-2 col-xl-2 col-spl'> </div>
			</div>



<?php if($infram != 1){?>
		</div>

	</body>
</html>

<?php  }

}else{//if partner
    Header('Location: '.$_dhp.'r/error404');
  }

}else{//if logged in
	Header('Location: '.$_dhp.'r/error404');
}
?>
