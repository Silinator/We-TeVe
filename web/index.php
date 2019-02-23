<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet
$_hp = ''; //für includes
$_dhp = ''; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

//3. site vals
$html_title = 'We-TeVe | '.$l->hometitle.' (Beta 1.5.5)'; //Tap title

if(isset($_GET['sort'])){$sort=$_GET['sort'];}else{$sort='2';}


//4. coinhive check
/*
$coin_name = "main";
require_once ($_hp.'coinhive/coinhive_check.php');
*/


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

			<meta name="keywords" content="We-teve, wtv, we-teve.com, weteve.com, weteve, we-tv, Silvan Fux, Schweizer Videoplattform, Videoplattform, youtube alternative">
			<meta name="description" content="We-TeVe ist eine Videoplattform welche das Ziel hat, die Community wichtiger zu machen. Gleichzeitig aber auch dem Contentersteller sehr viele freiheiten z.B in der Kanalgestalltung zu geben!">
			<meta name="author" content="Programm: Silvan F., Design: Daniel A.">
			<meta name="copyright" content="Silvan Fux 2015-2018">
			<meta name="robots" content="index, follow">
			<meta http-equiv="content-type" content="text/html;UTF-8">
			<meta http-equiv="cache-control" content="cache">
			<meta http-equiv="content-language" content="<?php echo $l->htmldata; ?>">
			<meta http-equiv="revisit-after" content="1 days">

			<meta name="siteinfo" content="https://www.we-teve.com/robots.txt"/>
			<meta name="google-site-verification" content="jFJ7KypuG4Fv2ljRp9rD6Czc4OLPA95ZtMkyeg8cpI0" />

			<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

			<meta property="og:url" content="https://www.we-teve.com" />
			<meta property="og:title" content="We-TeVe | <?php echo $l->hometitle; ?> " />
			<meta property="og:description" content="We-TeVe ist eine Videoplattform welche das Ziel hat, die Community wichtiger zu machen. Gleichzeitig aber auch dem Contentersteller sehr viele freiheiten z.B in der Kanalgestalltung zu geben!" />
			<meta property="og:image" content="https://www.we-teve.com/images/icons/logo.png" />

		</head>
		<body id='body' class='body'>

		<?php require_once ($_hp.'include/navi.php'); ?>

		<div id='main_container' class='container main_container'>
<?php } ?>

		<span id='site_scripts'>

			<?php // require_once ($_hp.'include/coinhivescript.php'); ?>
			<script class='check_js'></script>

			<script src='<?php echo $_dhp;?>js/load_more.js'></script>
			<script>


				var playlist_id = 'not_set';
				$(document).ready(function(){
					docready();
					loadfirst('<?php echo $_dhp;?>ajax/index_all_videos','all_videos','<?php echo $sort;?>','1');
					sethtmltitle('<?php echo $html_title; ?>');
				});

			</script>

		</span>

			<div class='row'>
				<div class='col-md-12'>

					<?php
					if($isUserLoggedIn === 1){
						$user_sql = db::$link->query("SELECT partner_status FROM user_find_db WHERE uuid = '$user_uuid'");
						$user_row = $user_sql->fetch_assoc();
						if($user_row['partner_status'] == 0){
							echo "<div class='w-100 pad-10' style='background-color:#333333'><a href='".$_dhp."r/go_partner'>".$l->part_go_partner_title1."</a></div>";
						}
					}else{
						echo "<div class='w-100 pad-10' style='background-color:#333333'><a href='".$_dhp."r/go_partner'>".$l->part_go_partner_title1."</a></div>";
					}
					?>

					<h1><?php echo $l->index_public_videos; ?></h1>
				</div>


					<?php
					echo "<div class='col-sm-4 marg-bot-20'>";
						$video_vuid = "2Z7aug3o";
						echo $f->draw_video_pewview($video_vuid,0,'ver','',$_dhp,$_ddhp,'large','0');

						//$index_puid = "0PJce6du9Ytk";
						//echo $f->draw_playlist_pewview($index_puid,'ver',$_dhp,$_ddhp,'large','0');
						//echo "<div style='clear:both'></div>";
					echo "</div>";

					echo "<div class='col-sm-4 marg-bot-20'>";
						$video_vuid = "29ZM5t09";
						echo $f->draw_video_pewview($video_vuid,0,'ver','',$_dhp,$_ddhp,'large','0');
					echo "</div>";

					echo "<div class='col-sm-4 marg-bot-20'>";
						$video_vuid = "uqx0Mxi3";
						echo $f->draw_video_pewview($video_vuid,0,'ver','',$_dhp,$_ddhp,'large','0');
					echo "</div>";
					?>
				</div>

			<div class='row'>
				<div class='col-md-12'>
					<h1><?php echo $l->index_all_videos; ?></h1>
				</div>

				<div class='all_videos' id='all_videos'>
						<?php //results ?>
				</div>

			</div>

			<div class='row'>
				<div class='col-xs-0 col-sm-2 col-lg-3 col-xl-4'></div>
					<div class='col-xs-12 col-sm-8 col-lg-6 col-xl-4'>
						<?php
						$item_per_page = 24; $get_total_rows_1 = 0;
						$results = db::$link->query("SELECT COUNT(*) FROM video_db WHERE status ='uploaded'");
							if($results){$get_total_rows_1 = $results->fetch_row();}
								$total_pages = ceil($get_total_rows_1[0]/$item_per_page);

						echo "
						<div class='load_more_result_btn blue_btn btn-default btn' type='button'
							data-page='ajax/index_all_videos' data-trget='all_videos'
							data-sort='2' data-total_pages='".$total_pages."'
							data-who='1' >
								<span class='load_more_text'>".$l->loadmore."</span>
								<span class='load_more_loading hide'><img src='".$_dhp."images/icons/ajax-loader.gif' alt='We-Teve'/> ".$l->loading."</span>
					</div>";
					?>
					</div>
				<div class='col-xs-0 col-sm-2 col-lg-3 col-xl-4'></div>
			</div>

<?php if($infram != 1){?>
		</div>
	</body>
</html>
<?php }

	/*}else{
			require_once ($_hp.'include/coinhivetext.php');
	}*/

?>
