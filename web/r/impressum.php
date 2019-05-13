<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet
$_hp = '../'; //für includes
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

//3. site vals
$html_title = $l->footertitle5.' | We-TeVe'; //Tap title

if(isset($_GET['sort'])){$sort=$_GET['sort'];}else{$sort='2';}


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
			<script class='check_js'></script>

			<script>


				var playlist_id = 'not_set';
				$(document).ready(function(){
					sethtmltitle('<?php echo $html_title; ?>');
				});

			</script>

		</span>

		<div class='row'>
			<div class='hidden-xs col-sm-2 col-lg-2 col-xl-2'></div>
			<div class='col-xs-12 col-sm-8 col-lg-6 col-xl-6'>
      <h1><?php echo $l->footertitle5; ?></h1>
			<br/>
			<p>DreamCode Fux</p>
			<p>Bahnhofstrasse 19</p>
			<p>3922 Stalden (VS)</p>
			<p>Schweiz</p>

			<h3>Kontakt (DreamCode):</h3>
			<p>E-Mail: <a load='new' href="mailto:info@dreamCode.ch">info@dreamCode.ch</a></p>
			<p>Web: <a load='new' href="http://www.DreamCode.ch">www.dreamCode.ch</a></p>

			<h3>Kontakt (We-TeVe):</h3>
			<p>E-Mail: <a load='new' href="mailto:info@We-TeVe.com">info@We-TeVe.com</a></p>
			<p>Web: <a load='new' href="https://www.We-TeVe.com">www.We-TeVe.com</a></p>
			<p>Twitter: <a load='new' target="_blank" href="https://twitter.com/We_TeVe">www.twitter.com/We_TeVe</a></p>
			<p>Instagram: <a load='new' target="_blank" href="https://www.instagram.com/we_teve/">www.instagram.com/we_teve/</a></p>

			<br/>
			<br/>

			<p>&#9400;2018 DreamCode Fux | Made and hosted in Switzerland</p>
		</div>
		<div class='hidden-xs col-sm-2 col-lg-4 col-xl-4'></div>
	</div>
</div>

<?php if($infram != 1){?>
</div>
</body>
</html>
<?php }

?>
