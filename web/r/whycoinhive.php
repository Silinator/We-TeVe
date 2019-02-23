<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet
$_hp = '../'; //für includes
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

//3. site vals
$html_title = $l->coinhive_why_title.' | We-TeVe'; //Tap title

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

			<?php // require_once ($_hp.'include/coinhivescript.php'); ?>
			<script class='check_js'></script>
			
			<script>


				var playlist_id = 'not_set';
				$(document).ready(function(){
					docready();
					sethtmltitle('<?php echo $html_title; ?>');
				});

			</script>

		</span>

		<div class='row'>
			<div class='hidden-xs col-sm-3 col-lg-2 col-xl-2'></div>
			<div class='col-xs-12 col-sm-8 col-lg-8 col-xl-8'>

				<h1><?php echo $l->coinhive_why_title; ?></h1>


				<div class='col-xs-12 col-sm-6 col-lg-3 col-xl-3 coinhive_why_box'>
					<img src='<?php echo $_dhp; ?>images/icons/coinhive/noads.png'/>
					<h3><?php echo $l->coinhive_why_stitle1;?></h3>
					<p><?php echo $l->coinhive_why_text1;?></p>
				</div>


				<div class='col-xs-12 col-sm-6 col-lg-3 col-xl-3 coinhive_why_box'>
					<img src='<?php echo $_dhp; ?>images/icons/coinhive/nozen.png'/>
					<h3><?php echo $l->coinhive_why_stitle2;?></h3>
					<p><?php echo $l->coinhive_why_text2;?></p>
				</div>


				<div class='col-xs-12 col-sm-6 col-lg-3 col-xl-3 coinhive_why_box'>
					<img src='<?php echo $_dhp; ?>images/icons/coinhive/nomon.png'/>
					<h3><?php echo $l->coinhive_why_stitle3;?></h3>
					<p><?php echo $l->coinhive_why_text3;?></p>
				</div>


				<div class='col-xs-12 col-sm-6 col-lg-3 col-xl-3 coinhive_why_box'>
					<img src='<?php echo $_dhp; ?>images/icons/coinhive/nodem.png'/>
					<h3><?php echo $l->coinhive_why_stitle4;?></h3>
					<p><?php echo $l->coinhive_why_text4;?></p>
				</div>


		</div>
		<div class='hidden-xs col-sm-3 col-lg-2 col-xl-2'></div>
	</div>
</div>

<?php if($infram != 1){?>
</div>
</body>
</html>
<?php }

?>
