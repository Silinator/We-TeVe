<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet
$_hp = '../'; //für includes
$_dhp = ''; // für daten


//2. all include
$in_save_code_all_include = "&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z";
require_once ($_hp.'include/all_include.php'); //haupt include


//3. site vals
$sub_user = $_POST['user'];
$sub_user = mysqli_real_escape_string(db::$link,$sub_user);
$time     = strtotime(date('Y-m-d H:i:s'));


if($isUserLoggedIn === 1) {


//prüfen

	// Anstadt die uuid des users den namen nemen und dann durch die user_seach_bank mit der uuid ersetzen aber nur hier.
	//
	//

	//user daten
	$sub_uuif = sha1(sha1($sub_user));

	if($sub_uuif == ""){
		echo "error";
		return false;
	}

	$abodel = 0; $abo = 0;


	$abodel_sql = db::$link->query("SELECT abo_id FROM abo_db WHERE abo_user_uuid = '$sub_user' AND user_uuid = '$user_uuid' AND status = 'deleted'");
	$abodel_row = $abodel_sql->fetch_assoc();

	if($abodel_row['abo_id'] != ""){ $abodel = 1; }


	$abo_sql = db::$link->query("SELECT abo_id FROM abo_db WHERE abo_user_uuid = '$sub_user' AND user_uuid = '$user_uuid' AND status = 'public'");
	$abo_row = $abo_sql->fetch_assoc();

	if($abo_row['abo_id'] != ""){ $abo = 1; }

//prüfen end


	if($abodel == 1){

		$sub_user_abos 		 = $u->userin("abos",0,$sub_uuif,'');
		$sub_user_key 		 = $u->userin("key",1,$sub_uuif,'');
		$sub_user_key2 		 = $u->userin("key2",1,$sub_uuif,'');

		$sub_user_abos = $sub_user_abos + 1;
		$sub_user_abos_ver = $ver->ver($sub_user_abos,$sub_user_key,$sub_user_key2);

		$up_abo_count = "UPDATE user_db SET abos = '$sub_user_abos_ver' WHERE uuif = '$sub_uuif'";
		$up_abo_count = db::$link->query($up_abo_count);

		$up_abo_count2 = "UPDATE user_find_db SET abos = '$sub_user_abos' WHERE uuid = '$sub_user'";
		$up_abo_count2 = db::$link->query($up_abo_count2);

		if($up_abo_count == true && $up_abo_count2 == true){
			$up_abo = "UPDATE abo_db SET status = 'public' WHERE abo_user_uuid = '$sub_user' AND user_uuid = '$user_uuid' AND status = 'deleted'";
			$up_abo = db::$link->query($up_abo);

			$up_abo_time = "UPDATE abo_db SET time = '$time' WHERE abo_user_uuid = '$sub_user' AND user_uuid = '$user_uuid' AND status = 'public'";
			$up_abo_time = db::$link->query($up_abo_time);

			if($up_abo == true AND $up_abo_time == true){

				//add notification
					//$mes->add_not('6',$user_uuid,$sub_user);
					$mes->add_mes('6',$sub_user,$user_uuid,1,$sub_user);

				//add XP
					$lvl->add_xp('30',$sub_user,$user_uuid);
					$lvl->add_xp('31',$sub_user,$sub_user);

				//add Ach
				$abo_c_sql = db::$link->query("SELECT count(abo_id) FROM abo_db WHERE user_uuid = '$user_uuid' AND status = 'public'");
				$abo_c_row = $abo_c_sql->fetch_row();
					if($abo_c_row[0] == 5)  {$ach->add_ach('170','',$user_uuid);}
					if($abo_c_row[0] == 25) {$ach->add_ach('171','',$user_uuid);}
					if($abo_c_row[0] == 250){$ach->add_ach('172','',$user_uuid);}

				$abo_c_sql = db::$link->query("SELECT count(abo_id) FROM abo_db WHERE abo_user_uuid = '$sub_user' AND status = 'public'");
				$abo_c_row = $abo_c_sql->fetch_row();
					if($abo_c_row[0] == 10)  {$ach->add_ach('160','',$sub_user);}
					if($abo_c_row[0] == 100) {$ach->add_ach('161','',$sub_user);}
					if($abo_c_row[0] == 1000){$ach->add_ach('162','',$sub_user);}

				echo "2";
			}

		}


	}elseif($abo == 1){


		$sub_user_abos 		 = $u->userin("abos",0,$sub_uuif,'');
		$sub_user_key 		 = $u->userin("key",1,$sub_uuif,'');
		$sub_user_key2 		 = $u->userin("key2",1,$sub_uuif,'');

		$sub_user_abos = $sub_user_abos - 1;
		$sub_user_abos_ver = $ver->ver($sub_user_abos,$sub_user_key,$sub_user_key2);

		$up_abo_count = "UPDATE user_db SET abos = '$sub_user_abos_ver' WHERE uuif = '$sub_uuif'";
		$up_abo_count = db::$link->query($up_abo_count);

		$up_abo_count2 = "UPDATE user_find_db SET abos = '$sub_user_abos' WHERE uuid = '$sub_user'";
		$up_abo_count2 = db::$link->query($up_abo_count2);

		if($up_abo_count == true && $up_abo_count2 == true){
			$up_abo = "UPDATE abo_db SET status = 'deleted' WHERE abo_user_uuid = '$sub_user' AND user_uuid = '$user_uuid' AND status = 'public'";
			$up_abo = db::$link->query($up_abo);
				if($up_abo == true){

					//remove notification
						$mes->remove_not('6',$user_uuid,$sub_user);
						$mes->remove_mes('6',$user_uuid,$sub_user);

					//remove XP
						$lvl->remove_xp('30',$sub_user,$user_uuid);
						$lvl->remove_xp('31',$sub_user,$sub_user);

					echo "0";
				}
		}

	}elseif($abodel == 0 AND $abo == 0){

		$sub_user_abos 		 = $u->userin("abos",0,$sub_uuif,'');
		$sub_user_key 		 = $u->userin("key",1,$sub_uuif,'');
		$sub_user_key2 		 = $u->userin("key2",1,$sub_uuif,'');

		$sub_user_abos = $sub_user_abos + 1;
		$sub_user_abos_ver = $ver->ver($sub_user_abos,$sub_user_key,$sub_user_key2);

		$up_abo_count = "UPDATE user_db SET abos = '$sub_user_abos_ver' WHERE uuif = '$sub_uuif'";
		$up_abo_count = db::$link->query($up_abo_count);

		$up_abo_count2 = "UPDATE user_find_db SET abos = '$sub_user_abos' WHERE uuid = '$sub_user'";
		$up_abo_count2 = db::$link->query($up_abo_count2);

		if($up_abo_count == true && $up_abo_count2 == true){
			$set_abo = "INSERT INTO abo_db
	     (abo_user_uuid,user_uuid,time,first_time,status) VALUES
	     ('$sub_user','$user_uuid','$time','$time','public')";
	    $set_abo = db::$link->query($set_abo);
				if($set_abo == true){

					//add notification
						$mes->add_not('6',$user_uuid,$sub_user);
						$mes->add_mes('6',$sub_user,$user_uuid,0,$sub_user);

					//add XP
						$lvl->add_xp('30',$sub_user,$user_uuid);
						$lvl->add_xp('31',$sub_user,$sub_user);

					//add Ach
					$abo_c_sql = db::$link->query("SELECT count(abo_id) FROM abo_db WHERE user_uuid = '$user_uuid' AND status = 'public'");
					$abo_c_row = $abo_c_sql->fetch_row();
						if($abo_c_row[0] == 5)  {$ach->add_ach('170','',$user_uuid);}
						if($abo_c_row[0] == 25) {$ach->add_ach('171','',$user_uuid);}
						if($abo_c_row[0] == 250){$ach->add_ach('172','',$user_uuid);}

					$abo_c_sql = db::$link->query("SELECT count(abo_id) FROM abo_db WHERE abo_user_uuid = '$sub_user' AND status = 'public'");
					$abo_c_row = $abo_c_sql->fetch_row();
						if($abo_c_row[0] == 10)  {$ach->add_ach('160','',$sub_user);}
						if($abo_c_row[0] == 100) {$ach->add_ach('161','',$sub_user);}
						if($abo_c_row[0] == 1000){$ach->add_ach('162','',$sub_user);}

					echo "1";
				}

		}

	}

	//echo 0 = deabonniert
	//echo 1 = abonniert
	//echo 2 = erneut abonniert

}//end user logged in
?>
