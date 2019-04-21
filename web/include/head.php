<?php
	echo "<title>".$html_title."</title>";
	echo "<meta charset='utf-8'/>";

	echo "<meta name='theme-color' content='#333333'>";
	echo "<meta name='viewport' content='width=device-width, initial-scale=1'/>";

	echo "<link id='favicon' rel='shortcut icon' type='image/png' href='".$_dhp."images/icons/favicon.png' />"; //chrome prüft auf jeder seite ob path richtig ist.

	echo "<link rel='manifest' href='".$_dhp."include/manifest.json'>";

	echo "<link rel='stylesheet' media='screen' href='".$_dhp."bootstrap/css/bootstrap".$min.".css' />";
	echo "<link rel='stylesheet' media='screen' href='".$_dhp."font-awesome/css/font-awesome".$min.".css' />";

	echo "<link rel='stylesheet' media='screen' href='".$_dhp."video/video-js".$min.".css' />";
	echo "<link rel='stylesheet' media='screen' href='".$_dhp."stylesheet/style".$min.".css' />";
	echo "<link rel='stylesheet' media='screen' href='".$_dhp."stylesheet/channel".$min.".css' />";

	echo "<link rel='stylesheet' media='screen' href='".$_dhp."stylesheet/color-style/dark_theme".$min.".css' />";

	echo "<script src='".$_dhp."js/jquery.min.js'></script>";
	echo "<script defer src='".$_dhp."js/cookie".$min.".js'></script>";
	//echo "<script src='".$_dhp."js/jquery_mobile.js'></script>";

	echo "<script async src='".$_dhp."../config/config.js'></script>";

	echo "<script>var isMobile = false;</script>";
	echo "<script async src='".$_dhp."js/function".$min.".js'></script>";
	echo "<script defer src='".$_dhp."comments/com".$min.".js'> </script>";
	echo "<script defer src='".$_dhp."bootstrap/js/bootstrap".$min.".js'></script>";
	//echo "<script src='https://vjs.zencdn.net/6.2.0/video.js'></script>";


	//mining:
	//echo "<script src='".$_dhp."js/authedmine.min.js'></script>";
	echo "<script defer src='https://authedmine.com/lib/authedmine.min.js'></script>"; ?>
		<script>var miner = "";</script>


	<?php
	//echo "<script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js'></script>";

	require_once('meta.php'); //noscript stuff
	echo "<link href='".$_dhp."font/css/open_sans.css' rel='stylesheet' />";

?>
