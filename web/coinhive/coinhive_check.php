<?php
if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){

	if(!isset($_SESSION["CoinHiveOptOutNum"])){ $CoinHiveOptOutNum = 0; }else{ $CoinHiveOptOutNum = $_SESSION["CoinHiveOptOutNum"]; }
	$_SESSION["CoinHiveOptOutNum"] = $CoinHiveOptOutNum + 1;

	if($CoinHiveOptOutNum == 0 OR $CoinHiveOptOutNum == 5){
		setcookie ("CoinHiveOptOut", "", time() - 3600000, "/"); //entfernt das coockie con coinhive damit er erneut erscheint falls zuvor abgelehnt
		$_SESSION["CoinHiveOptOutNum"] = 1;
		$coinhive_start = 1;
	}else{
		$coinhive_start = 0;
	}
}
?>
