<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet
$_hp = '../'; //für includes
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

//3. site vals
$html_title = 'We-TeVe Patchnotes | We-TeVe'; //Tap title

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
					docready();
					sethtmltitle('<?php echo $html_title; ?>');
				});

			</script>

		</span>

		<div class='row'>
			<div class='hidden-xs col-sm-2 col-lg-2 col-xl-2'></div>
			<div class='col-xs-12 col-sm-8 col-lg-6 col-xl-6'>
      <h1>We-TeVe Patchnotes (Deutsch)</h1>

      <h2 id='v1-5-5'>Beta v1.5.5</h2>
        <h4>Einstellungen</h4>
          <li>Autoplay wurde von den Einstellungen entfernt.</li>
          <i><b>Grund</b>: Bei ausgeschaltetem Autoplay kam es zu mehreren Fehlern, bei denen das Video oftmals trotzdem abgespielt wurde.<br>
          Da die Einstellung sowieso nur von ganz wenigen genutzt wurde, wurde sie entfernt. (Wenn die Einstellung aber einige unbedingt zurückhaben wollen. Kann ich mal schauen, ob ich es noch irgendwie anders umsetzen kann.)</i>
          <br>
          <br>
        <h4>Videoseite</h4>
          <li>Links, bei den letzten Videos des Uploaders, steht nun der Text: "Weitere Videos von [NameDesNutzers]" über den drei Videos.</li>
          <br>
          <h5>Kommentare</h5>
            <li>Für das Senden der Kommentare wird ein anderer Codec verwendet als bisher.</li>
            <li>Die Kommentarsuche wurde leicht verbessert. (Kommentare mit Sonderzeichen sollten besser gefunden werden.)</li>
          <br>
          <h5>Weitere Videos</h5>
            <li>Die Suche nach weiteren Videos wurde leicht verbessert. (Videos mit Sonderzeichen im Titel sollten besser gefunden werden.)</li>
            <li>Das Video, welches man grade schaut, wird in der Suche nun auch angezeigt. (Wurde zuvor ausgeblendet)</li>
          <br>
        <h4>Behobene Fehler</h4>
          <li>Ein Schreibfehler bei den Playlistoptionen wurde behoben. (Deutsch: Manuel -> Manuell | Englisch: Manuel -> Manual)</li>
          <li>Ein Fehler in den Einstellungen wurde behoben, wodurch man den Namen öfters als alle 30 Tage ändern konnte.</li>
          <li>Ein Fehler im Player wurde behoben, wodurch die Videos auch bei autoplay manchmal kein "Autoplay-Tag" erhielten.</li>
          <li>Ein Fehler beim Senden eines Kommentars wurde behoben, wodurch ein "&" in ein "&amp;amp;" ersetzt wurde.</li>
          <br>
        <h4>Teilweise behobene Fehler</h4>
          <li>Autoplay startet beim Neuladen der Videoseite oftmals nicht automatisch. (Fehler tritt nur in Chrome und Opera auf.)</li>
          <i><b>Grund</b>: Unbekannt! Der Player benutzt ganz normal das "Autoplay-Tag" und wird beim Laden der Seite auch nicht mehr pausiert.</i>

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
