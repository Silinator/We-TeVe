<?php
/*
if($language == ""){
	$time_format_day = "d.m.Y"; $time_format_hour = "H:i:s";
}
  if($language == "de"){$time_format_day = "d.m.Y";} //deutsch
  if($language == "en"){$time_format_day = "d.m.Y";} //Englisch UK
  if($language == "en-us"){$time_format_day = "M d, Y";} //Englisch US

//1 = Deutsch
//2 = Englisch UK
//3 = Englisch US



if($language == "1"){
	date_default_timezone_set('Europe/Berlin');
}elseif($language == "2"){
	date_default_timezone_set('Europe/London');
}elseif($language == "3"){
	date_default_timezone_set('America/Los_Angeles');
}else{
	date_default_timezone_set('Europe/Berlin');
}
*/

date_default_timezone_set('Europe/Berlin');

class time extends language{
	//'extends language' fügt die andere Class hinzu


	public function invor($time){

		$now = date('Y-m-d H:i:s');
		$now = strtotime($now);

		$vor = $now - $time;
		//$vor = $time;

			if($vor < 60){ //Sekunden
					if($vor < 2){
						$erg = $this->time_vor1." ".$this->time_eine." ".$this->time_sekunde." ".$this->time_vor2;
					}else{
						$erg = $this->time_vor1." ".$vor." ".$this->time_sekunden." ".$this->time_vor2;
					}
			}elseif($vor < 3600){ //Minuten
					$v = floor($vor / 60);
						if($v < 2){
							$erg = $this->time_vor1." ".$this->time_einer." ".$this->time_minute. " ".$this->time_vor2;
						}else{
							$erg = $this->time_vor1." ".$v." ".$this->time_minuten. " ".$this->time_vor2;
						}
			}elseif($vor < 86400){ //Stunden
					$v = floor($vor / 3600);
						if($v < 2){
							$erg = $this->time_vor1." ".$this->time_ein." ".$this->time_stunde. " ".$this->time_vor2;
						}else{
							$erg = $this->time_vor1." ".$v." ".$this->time_stunden. " ".$this->time_vor2;
						}
			}elseif($vor < 604800){ //Tage
					$v = floor($vor / 86400);
						if($v < 2){
							$erg = $this->time_vor1." ".$this->time_einem." ".$this->time_tage. " ".$this->time_vor2;
						}else{
							$erg = $this->time_vor1." ".$v." ".$this->time_tagen. " ".$this->time_vor2;
						}
			}elseif($vor < 2592000){ //Wochen
					$v = floor($vor / 604800);
						if($v < 2){
							$erg = $this->time_vor1." ".$this->time_eine." ".$this->time_woche. " ".$this->time_vor2;
						}else{
							$erg = $this->time_vor1." ".$v." ".$this->time_wochen. " ".$this->time_vor2;
						}
			}elseif($vor < 31536000){ //Monate
					$v = floor($vor / 2592000);
						if($v < 2){
							$erg = $this->time_vor1." ".$this->time_einem_a." ".$this->time_monate. " ".$this->time_vor2;
						}else{
							$erg = $this->time_vor1." ".$v." ".$this->time_monaten. " ".$this->time_vor2;
						}
			}elseif($vor > 31536000){ //Monate
					$v = floor($vor / 31536000);
						if($v < 2){
							$erg = $this->time_vor1." ".$this->time_einem_a." ".$this->time_jahr. " ".$this->time_vor2;
						}else{
							$erg = $this->time_vor1." ".$v." ".$this->time_jahren. " ".$this->time_vor2;
						}
			}

		return $erg;
	}



	public function sekinzeit($sekunden) {

		$sekunden = (int)$sekunden;

		$sekunden -= ($stunden=floor($sekunden/3600)) * 3600;
		$sekunden -= ($minuten=floor($sekunden/60)) * 60;

		$stunden = sprintf("%02d", $stunden);
		$minuten = sprintf("%02d", $minuten);
		$sekunden = sprintf("%02d", $sekunden);


		$umwandeln = array(
			'01' => '1',
			'02' => '2',
			'03' => '3',
			'04' => '4',
			'05' => '5',
			'06' => '6',
			'07' => '7',
			'08' => '8',
			'09' => '9',
			'00' => ''
		);

		$umwandeln2 = array(
			'01' => '1',
			'02' => '2',
			'03' => '3',
			'04' => '4',
			'05' => '5',
			'06' => '6',
			'07' => '7',
			'08' => '8',
			'09' => '9',
			'00' => '0'
		);

		$stunden = str_replace(array_keys($umwandeln),
			array_values($umwandeln), $stunden);

		if($stunden == ''){
			$minuten = str_replace(array_keys($umwandeln2),
				array_values($umwandeln2), $minuten);
			$zeit = $minuten.":".$sekunden;
		}else{
			$zeit = $stunden.":".$minuten.":".$sekunden;
		}


		return $zeit;
	}


	public function normtime($unix,$format) {
		if(is_numeric($unix) == true ){
			if($format == "date"){
				$normtime = date("d.m.Y", $unix);
			}elseif($format == "time"){
				$normtime = date("H:i", $unix);
			}elseif($format == "times"){
				$normtime = date("H:i:s", $unix);
			}elseif($format == "date+time"){
				$normtime = date("d.m.Y H:i", $unix);
			}elseif($format == "date+times"){
				$normtime = date("d.m.Y H:i:s", $unix);
			}else{
				$normtime = date("d.m.Y H:i:s", $unix);
			}
		}else{
			$normtime = date("d.m.Y H:i:s", '0');
		}

		return $normtime;
	}

}


$t = new time;

/*
Europe/Berlin = UTC +2
Europe/London = UTC +1
America/Los_Angeles = UTC -9

*/


//function beispiel
//echo $t->invor($time);

//code:
/*
//für die nummer:
$time = date('Y-m-d H:i:s');
$time = strtotime($time);

//für das Datum:
$time = date("H:i:s $time_format_day", $time);

//$time_format_day -> value von time_include = d.m.Y
*/

?>
