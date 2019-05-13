<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet
$_hp = '../'; //für includes
$_dhp = '../'; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include

//3. site vals
$html_title = $l->footertitle2.' | We-TeVe'; //Tap title

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
      <h1>Nutzungsbedingungen</h1>
			<h3>Willkommen bei We-TeVe</h3>
			<p>Vielen Dank, dass Sie We-TeVe nutzen. Mit der Nutzung der Webseite www.We-TeVe.com bestätigen Sie die Nutzungsbedingungen.</p>
			<p>Zu den Nutzungsbedingungen gehört die Zustimmung der <a target="_blank" href="<?php echo $_dhp;?>r/police"><?php echo $l->footertitle1;?></a>, des <a target="_blank" href="<?php echo $_dhp;?>r/haftung"><?php echo $l->footertitle6;?></a> und der <a target="_blank" href="<?php echo $_dhp;?>r/communitypolice"><?php echo $l->footertitle4;?></a>.</p>


			<h3>1. Nutzung der Webseite</h3>
			<p>Sie dürfen die Webseite nicht in missbräuchlicher Art und Weise nutzen. Beispielsweise dürfen Sie nicht tiefer in die Webseite eindringen, als wir es über die Benutzeroberfläche bereitstellen.</p>
			<p>Browser Add-ons zur Überwachung oder Manipulation gewisser Abläufe zu nutzen ist absolut verboten.</p>

			<h3>2. Altersbeschränkung</h3>
			<p>Die Webseite darf von allen Altersgruppen genutzt werden. Sobald ein Benutzerkonto erstellt wird, muss der Nutzer des Kontos mindestens 14 Jahre alt sein. Das Geburtsdatum ist bei der Registrierung wahrheitsgemäss anzugeben.</p>

			<h3>3. Haftung</h3>

			<p>Im gesetzlich zulässigen Rahmen übernimmt We-TeVe und das Team hinter We-TeVe keine Verantwortung für den Verlust von entgangenen Daten, entgangene Gewinne, entgangene Einnahmen, finanzielle Verluste oder indirekte, besondere und exemplarische Schäden sowie Folgeschäden und Schäden mit Strafschadensersatz.
			Soweit gesetzlich zulässig, beschränkt sich die Gesamthaftung von We-TeVe und dem Team hinter We-TeVe bezüglich aller Ansprüche im Rahmen dieser Nutzungsbedingungen.
			We-TeVe und das Team hinter We-TeVe ist in keinem Fall haftbar für Verluste oder Schäden, die nicht typischerweise vorhersehbar sind.
			</p>

			<h3>4. Urheberrechtsverletzungen</h3>
			<p>Wir reagieren auf Meldungen zu mutmasslichen Urheberrechtsverletzungen und kündigen die Konten von Personen,
			die wiederholt Verstösse begehen.</p>
			<p>Bei Missbrauch der Meldungsfunktion wird das Konto des Klägers umgehend unwiderruflich gekündigt.</p>

			<h3>4.5. Video wegen Urheberrechtsverletzungen oder anderem Melden</h3>
			<p>In den Fussnoten ist der Punkt "Melden" wenn Sie dort drauf klicken, kommen Sie zu einem Formular. In dem Forular können Sie nun den Grund der Meldung angeben, und auch was bei bei einer gültigen Klage mit dem Video passieren soll.</p>
			<p>Nach absenden der Meldung wird das Video temporär zur überprüfung von We-TeVe entfernt. Fals in der Überprüfung der Meldungsgrund als nicht rechtens gewertet wird, so kündigen wir dem Nutzer das Konto oder entziehen ihm die möglichkeit Videos zu melden.</p>
			<p>Wenn aber der Meldungsgrund rechtens ist. Wird das Video kommplet gelöscht und der Nutzer, welcher das Video hochgeladen hat bekommt nach den Cummunity-Richtlinien bestimmte Anzahl an Strikes</p>


			<h3>5. Urheberrechts-Richtlinie</h3>
			<p>We-TeVe unterhält eine eindeutige Urheberrechts-Richtlinie in Bezug auf Inhalte, die vorgeblich <br/>Urheberrechte eines Dritten verletzen.</p>
			<p>Entsprechend der We-TeVe Urheberrechts-Richtlinie wird We-TeVe den Zugang eines Nutzers zu den Diensten sperren, wenn ein Nutzer als wiederholter Rechtsverletzer identifiziert wird. Ein wiederholter Rechtsverletzer ist ein Nutzer, der mehr als zweimal wegen rechtsverletzender Handlungen ermahnt wurde.</p>


			<h3>6. We-TeVe Konto</h3>
			<p>Bei Registierung eines We-TeVe Kontos werden persönliche Angaben abgefragt, diese sind wahrheitsgemäss einzutragen.<br/>
			Sie sollten mit ihrem Passwort und anderen Angaben sorgfältig umgehen.<br/>
			Bei Einbruch in Ihr We-TeVe Konto tragen wir im Normfall keine Verantwortung.</p>

			<h3>7. Bei Verstössen</h3>
			<p>Bei Verstössen gegen die Community-Richtlinien und/oder gegen das Urheberrecht bekommt der Nutzer sogennante "Strikes." Bei drei Strikes wird das Konto unwiderruflich gekündigt.<br/>
			Wie viele Strikes man für was bekommt, ist in den Community-Richtlinien bestimmt.</p>
			<p>Bei Verstoss gegen die Nutzungsbedingungen und/oder die damit verknüpften Dokumente, riskiert man die Sperrung und/oder die Kündigung seines Kontos und die damit verknüpften Daten und Dateien.
			Gegebenenfalls können auf den Nutzer auch rechtliche Schritte zu kommen.</p>

			<h3>8. Salvatorische Klausel</h3>
			<p>Sollten einzelne Bestimmungen dieses Vertrages unwirksam oder undurchführbar sein, oder nach Vertragsschluss unwirksam oder undurchführbar werden,
			bleibt davon die Wirksamkeit des Vertrages im Übrigen unberührt. An die Stelle der unwirksamen oder undurchführbaren Bestimmung soll diejenige
			wirksame und durchführbare Regelung treten, deren Wirkungen der wirtschaftlichen Zielsetzung am nächsten kommen, die die Vertragsparteien mit der
			unwirksamen bzw. undurchführbaren Bestimmung verfolgt haben. Die vorstehenden Bestimmungen gelten entsprechend für den Fall, dass sich der
			Vertrag als lückenhaft erweist.</p>

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
