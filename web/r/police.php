<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet
$_hp = '../'; //für includes
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

//3. site vals
$html_title = $l->footertitle1.' | We-TeVe'; //Tap title

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
      <h1>Datenschutzerklärung</h1>
			<h3>1. Daten welche gespeichert werden</h3>
			<p>Neben den selbst angegebenen Daten über Eingabefelder werden IP-Adresse, Land, Internet Hoster, Browser, Betriebssystem und die genaue Zeit gespeichert.</p>
			<p>Beim Hochladen von Videomaterial werden Dateigrösse, Auflösung und Länge des Videos gespeichert. Zusätzlich wird ein sogenanntes Thumbnail erstellt.</p>
			<p>Wir sind immer bemüht, die Webseite zu verbessern. Ohne diese Daten könnten wir dies nicht tun.</p>

			<h3>1.1 Nutzung der E-Mail Adresse</h3>
			<p>Die E-Mail wird vor allem als Sicherheit genutzt. Sprich zum Senden der Bestätigungscodes. Sie kann aber auch zur Kontaktaufnahme des Nutzers ausserhalb
			dieser Regel verwendet werden. Zum Beispiel; wenn dieser eingeladen wird.</p>

			<h3>2. Rechte der hochgeladenen Dateien</h3>
			<p>Der Benutzer/User haftet in vollem Umfang für die von ihm hochgeladenen Dateien (Videos, Bilder). Insbesondere in Hinsicht auf das Urheberrecht hat der
			Benutzer/User dieses einzuhalten. Wenn der Benutzer/User dennoch urheberrechtlich geschütztes Material hochlädt, dann wir dieses von seitens We-TeVe
			gemäss des Punktes 4.5 der Nutzungsbedingungen behandelt<br/></p>
			<p>We-TeVe kann hier auch bei eindeutigen Verstossen gegen das Urheberrecht gemäss des punktes 4.5 und des Punktes 5 der Nutzungsbedingungen handeln.</p>
			<p>Der Benutzer/User gibt We-TeVe das Recht, seine hochgeladenen Dateien weltweit zu verwenden, zu hosten, zu speichern, zu vervielfältigen, zu verändern und
			abgeleitete Werke daraus zu erstellen, einschließlich solcher, die aus Übersetzungen, Anpassungen oder anderen Änderungen, resultieren. Selbst beim Löschen der Datei. Sie behalten jedoch auch das Recht an Ihren Werken.</p>

			<p>Der Benutzer/User ist auch damit einverstanden, dass jeder Nutzer von We-TeVe eine Privatkopie des Videos von der Website erstellen kann. (Download)</p>

			<h3>3. Informationen welche an Dritte weiter gegeben werden</h3>
			<p>Es werden in der Regel keine Daten an Dritte weiter gegeben. Bei Verstoss gegen geltendes Recht und/oder Urheberrechtsverletzungen müssen wir Daten an Dritte weiter geben.</p>


			<h3>4. Datensicherheit</h3>
			<p>Die komplette Webseite ist über eine SSL Verschlüsselung verschlüsselt.</p>
			<p>Passwörter und andere wichtige Daten werden speziell verschlüsselt. (Sprich, nicht mal wir wissen dein Passwort.)</p>
			<p>Zum zusätzlichen Schutz ist standardmässig die Option "Datenschutz Stufe 2" aktiviert.</p>

			<h3>4.1 Datenschutz Stufe 1</h3>
			<p>Diese Option muss manuell eingestellt werden.</p>
			<p>Die Option sorgt dafür, dass man sich ohne Bestätigungs-E-Mail einloggen kann.</p>

			<h3>4.2 Datenschutz Stufe 2</h3>
			<p>Diese Option ist standardmässig eingeschaltet.</p>
			<p>Nach erfolgreichem Einloggen wird eine E-Mail mit einem Bestätigungscode gesendet. Dieser muss dann auf der Seite zur Bestätigung eingegeben werden.</p>


			<h3>5. Konto</h3>
			<p>Dein Konto ist geistiges Eigentum von We-TeVe und kann von uns, wenn nötig, gelöscht oder gekundigt werden.</p>

			<h3>6. Kontoeinstellungen</h3>
			<p>Bei einigen Änderungen ist eine Bestätigung über E-Mail erforderlich. Zum Beispiel bei Änderung der E-Mail
			Adresse wir zuerst eine E-Mail mit einem Bestätigungscode an die "alte" E-Mail Adresse gesendet.</p>

			<h3 id="cookies">7. Cookies</h3>
			<p>Cookies und Sessions werden dafür genutzt, Daten zu speichern, die zum Gerät gehören. (Automatische Login, ein eindeutiger Identifizierungscode, Standard Lautstärke, Einstellungen zu Sprache und Design)</p>

			<h3>Letzte Änderung 06.06.2016</h3>
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
