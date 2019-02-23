<?php

if(isset($_POST['page'])){
	//1. Pfad zum Stammverzeichniss wo sich die index befindet
	$_hp = '../'; //für includes
	$_dhp = '../../'; // für daten


	//2. all include
	$in_save_code_all_include = "&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z";
	require_once ($_hp.'include/all_include.php'); //haupt include


	//3. site vals
	$item_per_page = 12;

}


if(isset($page_number)){
	$page_number = 0;
}else{
	$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
}

if($isUserLoggedIn === 1){

  $partner_sql = db::$link->query("SELECT partner_status FROM user_find_db WHERE uuid = '$user_uuid'");
  $partner_row = $partner_sql->fetch_assoc();
  $partner_status = $partner_row['partner_status'];
  if($user_rang == 1 OR $partner_status > 0){


		//throw HTTP error if page number is not valid
		if(!is_numeric($page_number)){
			header('HTTP/1.1 500 Invalid page number!');
			exit();
		}


		//vars
		$user_uuif = sha1(sha1($user_uuid));
		$key = $u->userin('key',0,$user_uuif,'');
		$key2 = $u->userin('key2',0,$user_uuif,'');
		$status_ok_ver = $ver->ver('ok',$key,$key2);

		//get current starting point of records
		$position = ($page_number * $item_per_page);
		$results = db::$link->query("SELECT * FROM payments_db WHERE uuid = '$user_ver_uuid' AND status = '$status_ok_ver' ORDER BY time DESC LIMIT $position, $item_per_page");

		while($row = $results->fetch_array()){

			//ent
			$paid_xmr 			= $ver->ent($row['paid_xmr'],$key,$key2);
			$paid 					= $ver->ent($row['paid'],$key,$key2);
			$payment_method = $ver->ent($row['payment_method'],$key,$key2);
			$payment_status = $ver->ent($row['payment_status'],$key,$key2);

			$namen = array(
				'paypal' => 	$l->part_payment_title1,
				'iban' => 		$l->part_payment_title2,
				'monero' => 	$l->part_payment_title3,
			);
			$payment_method_title = str_replace(array_keys($namen),array_values($namen), $payment_method);

			//vals
			$month 		= $row['month'];
			$pay_time = $row['time'];
			$pay_time_vor = $t->invor($pay_time);

      echo "<div class='part_payment_line'>";
				echo "<div class='part_payment_title'>".$l->part_payment_title0." ".$payment_method_title."</div>";
				if($payment_method != "monero"){
					echo $l->part_payment_title10.": ".$paid." XMR ≈ ".$paid." <i>".$pay_time_vor."</i>";
				}else{
					echo $l->part_payment_title10.": ".$paid." <i>".$pay_time_vor."</i>";
				}
      echo "</div>";
		}

} //if partner

} // if user logged in
?>
