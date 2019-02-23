<?php


//für jedes Video:
  //Aufrufe
    $ach_100 = 2500; //für 100+ aufrufe v/
    $ach_101 = 5000; //für 1'000+ aufrufe v/
    $ach_102 = 17500; //für 10'000+ aufrufe v/

  //Kommentare
    $ach_110 = 5000; //für 10+ Kommentare v/
    $ach_111 = 10000; //für 100+ Kommentare v/
    $ach_112 = 25000; //für 1'000+ Kommentare v/

  //Likes
    $ach_120 = 3000; //für 10+ Likes v/
    $ach_121 = 6000; //für 100+ Likes v/
    $ach_122 = 15000; //für 1'000+ Likes v/


//gesamte:
	$ach_140 = 1000; //für das liken von 5 Videos v/
	$ach_141 = 10000; //für das liken von 50 Videos v/
	$ach_142 = 50000; //für das liken von 500 Videos v/

	$ach_150 = 2000; //für das Schreiben von 10 Kommentaren. v/
	$ach_151 = 10000; //für das Schreiben von 100 Kommentaren. v/
	$ach_152 = 75000; //für das Schreiben von 1'000 Kommentaren. v/

	$ach_160 = 15000; //für das erreichen von 10 Abos v/
	$ach_161 = 45000; //für das erreichen von 100 Abos v/
	$ach_162 = 100000; //für das erreichen von 1'0000 Abos v/

	$ach_170 = 7000; //für das abonnieren von 5 Userns v/
	$ach_171 = 15000; //für dsa abonnieren von 25 Userns v/
	$ach_172 = 30000; //für dsa abonnieren von 250 Userns v/

  $ach_180 = 25000; //für das hochladen von 5 Videos v/
  $ach_181 = 100000; //für dsa hochladen von 50 Videos v/
  $ach_182 = 250000; //für dsa hochladen von 100 Videos v/


	$ach_200 = 4000; //für das hochladen eines Videos in 4k. v/
	$ach_201 = 1000; //für das hinzufügen eines Freundes. v/
	$ach_202 = 750; //für das Bewerten eines Kommentares. v/
	$ach_203 = 500; //für das durchsuchen der kommentare. v/
	$ach_204 = 500; //für das Sortieren der Kommentare. v/
	$ach_205 = 2500; //für das Bearbeiten deines Kanaldesign. v/
	$ach_206 = 500; //für das vornehmen von einstellungen. v/
	$ach_207 = 500; //für das liken eines Videos eines Freundes. v/
	$ach_208 = 250000; //für das hochladen von videos welche zusammen länger als einen Tag gehn. v/
	$ach_209 = 10000; //für das hochladen von videos welche zusammen mehr als 50.000 aufrufe haben.
  $ach_210 = 2500; //für das hochladen eines Videos welches länger ist als 10min. v/

  $ach_2016 = 25000; //winter xp für 2016


//add ach hinzufügen
function add_ach($ach,$ach_data,$xp_for_ach,$db_link,$user_id)
{
    $sql_xp_bank = mysqli_query($db_link, "SELECT COUNT(achievement_id) FROM achievement_bank WHERE user_id = '$user_id' AND achievement = '$ach' AND achievement_data = '$ach_data' AND status = 'public'");
    $get_xp_bank = mysqli_fetch_row($sql_xp_bank);


  if($get_xp_bank[0] == 0){

    $time = date('H:i:s d-m-Y');
    $time = strtotime($time);


    $add_ach = "INSERT INTO achievement_bank
          (user_id,achievement,achievement_data,time,status)
          VALUES
          ('$user_id','$ach','$ach_data','$time','public')";
    $add_ach = mysqli_query($db_link, $add_ach);

    if($add_ach == true){
        add_ach_event($ach,$db_link,$user_id);
        add_xp($ach,$ach_data,$xp_for_ach,$db_link,$user_id);
    }
  }

}

//funktions besispiele zum kopieren:
//ach => achievment
//ach add für den actionsausfürenden         ->    add_ach('01',0,$ach_100,$db_link,$user_id);
?>
