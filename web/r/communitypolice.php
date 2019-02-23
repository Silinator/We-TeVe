<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet
$_hp = '../'; //für includes
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

//3. site vals
$html_title = $l->footertitle4.' | We-TeVe'; //Tap title

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
			<div class='hidden-xs col-sm-2 col-lg-2 col-xl-2'></div>
			<div class='col-xs-12 col-sm-8 col-lg-6 col-xl-6'>
			<h1>Community Richtlinien</h1>
			<h3>1. Beleidigungen</h3>
			<p>Beleidigungen von Mensch oder Menschengruppen ist nicht erlaubt. Unter dem Begriff "beleidigen" zählen keine offensichtlichere Witze oder Übertreibungen.</p>

			<h3>2. Spam, irreführende Inhalte und Betrug</h3>
			<p>Spam mag keiner, also Spam nicht andere Benutzer voll. Irreführende Inhalte werden mit Strikes bestraft. Irreführende Inhalte sind Titel oder Thumbnails die mit dem Video nichts oder fast nicht zu tun haben.
			Betrug ist Verboten und wird, fals nötig, an die Polizei weitergeleitet. Betrug sind zum Beispiel gefälschte Gewinnspiele oder Spendenaufrufe. Sowie Hacking und Cheating.</p>

			<h3>3. Gewalttätige Inhalte</h3>
			<p>Es ist verboten Inhalte in denen starke Gewaltausübungen verübt werden, so wie Totschlag oder Tötungen hochzuladen.
			Virtuelle Gewalt wie in Spielen ist davon nicht betroffen.</p>

			<h3>4. Sexuelle Inhalte</h3>
			<p>Pornografische und sexuelle Inhalte dürfen nicht auf We-TeVe hochgeladen werden.</p>

			<h3>5. Missbrauch der Vorbildfunktion</h3>
			<p>Insbesondere Kinder sind leicht beinflussbar.
			Wer seine Vorbildfunktion missbraucht, indem er andere zu Straftaten und/oder gefährlichen Aktionen motiviert und/oder anstiftet, wird bestraf und gegebenenfalls der Polizei gemeldet.</p>

			<h3>6. Strikes</h3>
			<p>Für jeden Verstoss unserer Regeln, ob gegen die Nutzungsbedingungen oder gegen die Community Richtlinien etc., bekommt man ein Strike.
			Wenn der Strike mit einem Video zusammenhängt, wird das Video auch gelöscht.
			Es gibt nur zwei Ausnahmen:</p>
			<p>Wer komplette Werke von anderen hochlädt, bekommt drei Strikes.</p>
			<p>Wer die Meldungsfunktion missbraucht, bekommt zwei Strikes.</p>
			<p>Wer auf seinem Konto drei Strikes gesammelt hat, dessen Konto wird gekündigt.</p>

			<h3>7. Ausnahmen</h3>
			<p>Ausnahmen werden gegebenenfalls nach Fall bestimmt. Generell gilt jedoch die Ausnahme: "Wer eine Regelverstoss aufgrund einer dokumentarischen Funktion
				begeht, zum Beispiel um Missstände aufzuzeigen". Bekommt keinen Strike.	</p>

			<h3>Letzte Änderung 31.08.2017</h3>
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
