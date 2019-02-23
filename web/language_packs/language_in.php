<?php

$language = "";

if($isUserLoggedIn === 1) {
	if(!isset($upload_in)){
		$language = $u->userin("lang",0,"this",''); //$user_lang von 'login/login_in'
	}else{
		$language = $u->userin("lang",0,'',$usercode_up); //$user_lang von 'login/login_in'
	}
}else{
	if(isset($_COOKIE["lang"])){
		$language = $_COOKIE["lang"];
		setcookie("lang", $language, time()+2592000, "/");
	}
}


//$language = 'de';

if($language == ""){

	//nimmt die sprache vom Browser / davon dier ersten zwei zeichen
	if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
		$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

		switch ($lang){
		    case "de": //Deutsch
						$language = 'de';
		        break;
		    case "en": //Englisch
		        $language = 'en';
		        break;
		    default: //wenn unbekannt Englisch
		        $language = 'en';
		        break;
		}
	}else{
		$language = 'en';
	}
}
//de = Deutsch
//en = Englisch UK
//en-us = Englisch US


	if($language == 'de'){
		$include_file = $_hp."language_packs/german.php";
		$lang = 'de';
	}elseif($language == 'en'){
	  $include_file = $_hp."language_packs/english.php";
		$lang = 'en';
	}elseif($language == 'en-us'){
	  $include_file = $_hp."language_packs/english.php";
		$lang = 'en-us';


	}else{ //später dann englisch
		$include_file = $_hp."language_packs/german.php";
		$lang = 'de';
	}


	require_once($include_file);
	$l = new language;

?>
