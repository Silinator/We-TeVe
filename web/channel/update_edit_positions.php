<?php
//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = "../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include



  if($isUserLoggedIn === 1) {

		//add ach205
		$ach->add_ach('205','',$user_uuid);

		$get_video = db::$link->query("SELECT * FROM channel_design_db WHERE uuid = '$user_uuid'");
		$get_video = $get_video->fetch_assoc();

    $img = $get_video["img"]; 														$$img = "img";
    $video = $get_video["video"]; 												$$video = "video";
    $videobeschreibung = $get_video["videobeschreibung"]; $$videobeschreibung = "videobeschreibung";
    $diskussion = $get_video["diskussion"]; 							$$diskussion = "diskussion";
    $abonnenten = $get_video["abonnenten"];								$$abonnenten = "abonnenten";
    $info = $get_video["info"]; 													$$info = "info";
		$infofulltext = $get_video["infofulltext"]; 					$$infofulltext = "infofulltext";
		$playlist = $get_video["playlist"]; 									$$playlist = "playlist";

    $nz1 = $get_video["nz1"]; $$nz1 = "nz1";
    $nz2 = $get_video["nz2"]; $$nz2 = "nz2";
    $nz3 = $get_video["nz3"]; $$nz3 = "nz3";
    $nz4 = $get_video["nz4"]; $$nz4 = "nz4";
    $nz5 = $get_video["nz5"]; $$nz5 = "nz5";
    $nz6 = $get_video["nz6"]; $$nz6 = "nz6";
    $nz7 = $get_video["nz7"]; $$nz7 = "nz7";
    $nz8 = $get_video["nz8"]; $$nz8 = "nz8";
    $nz9 = $get_video["nz9"]; $$nz9 = "nz9";
    $nz10 = $get_video["nz10"]; $$nz10 = "nz10";
    $nz11 = $get_video["nz11"]; $$nz11 = "nz11";
    $nz12 = $get_video["nz12"]; $$nz12 = "nz12";
    $nz13 = $get_video["nz13"]; $$nz13 = "nz13";
    $nz14 = $get_video["nz14"]; $$nz14 = "nz14";
    $nz15 = $get_video["nz15"]; $$nz15 = "nz15";
    $nz16 = $get_video["nz16"]; $$nz16 = "nz16";
    $nz17 = $get_video["nz17"]; $$nz17 = "nz17";
    $nz18 = $get_video["nz18"]; $$nz18 = "nz18";
    $nz19 = $get_video["nz19"]; $$nz19 = "nz19";
    $nz20 = $get_video["nz20"]; $$nz20 = "nz20";
    $nz21 = $get_video["nz21"]; $$nz21 = "nz21";
    $nz22 = $get_video["nz22"]; $$nz22 = "nz22";
    $nz23 = $get_video["nz23"]; $$nz23 = "nz23";
    $nz24 = $get_video["nz24"]; $$nz24 = "nz24";


		$stop = 0;
		if($nz1 == "" AND $stop == 0){$leer = 'nz1'; $stop = 1;}
		if($nz2 == "" AND $stop == 0){$leer = 'nz2'; $stop = 1;}
		if($nz3 == "" AND $stop == 0){$leer = 'nz3'; $stop = 1;}
		if($nz4 == "" AND $stop == 0){$leer = 'nz4'; $stop = 1;}
		if($nz5 == "" AND $stop == 0){$leer = 'nz5'; $stop = 1;}
		if($nz6 == "" AND $stop == 0){$leer = 'nz6'; $stop = 1;}
		if($nz7 == "" AND $stop == 0){$leer = 'nz7'; $stop = 1;}
		if($nz8 == "" AND $stop == 0){$leer = 'nz8'; $stop = 1;}
		if($nz9 == "" AND $stop == 0){$leer = 'nz9'; $stop = 1;}
		if($nz10 == "" AND $stop == 0){$leer = 'nz10'; $stop = 1;}
		if($nz11 == "" AND $stop == 0){$leer = 'nz11'; $stop = 1;}
		if($nz12 == "" AND $stop == 0){$leer = 'nz12'; $stop = 1;}
		if($nz13 == "" AND $stop == 0){$leer = 'nz13'; $stop = 1;}
		if($nz14 == "" AND $stop == 0){$leer = 'nz14'; $stop = 1;}
		if($nz15 == "" AND $stop == 0){$leer = 'nz15'; $stop = 1;}
		if($nz16 == "" AND $stop == 0){$leer = 'nz16'; $stop = 1;}
		if($nz17 == "" AND $stop == 0){$leer = 'nz17'; $stop = 1;}
		if($nz18 == "" AND $stop == 0){$leer = 'nz18'; $stop = 1;}
		if($nz19 == "" AND $stop == 0){$leer = 'nz19'; $stop = 1;}
		if($nz20 == "" AND $stop == 0){$leer = 'nz20'; $stop = 1;}
		if($nz21 == "" AND $stop == 0){$leer = 'nz21'; $stop = 1;}
		if($nz22 == "" AND $stop == 0){$leer = 'nz22'; $stop = 1;}
		if($nz23 == "" AND $stop == 0){$leer = 'nz23'; $stop = 1;}
		if($nz24 == "" AND $stop == 0){$leer = 'nz24'; $stop = 1;}


  if(isset($_POST['letter1'])){$get_pos1 = $_POST['letter1'];}else{$get_pos1 = "";}
  if(isset($_POST['letter2'])){$get_pos2 = $_POST['letter2'];}else{$get_pos2 = "";}

  if(isset($_POST['pos1'])){$pos_set1 = $_POST['pos1'];}else{$pos_set1 = "";}
  if(isset($_POST['pos2'])){$pos_set2 = $_POST['pos2'];}else{$pos_set2 = "";}

  if($get_pos1 == "hidden"){$pos_1 = '';}else{$pos_1 = $get_pos1;}
  if($get_pos2 == "hidden"){$pos_2 = '';}else{$pos_2 = $get_pos2;}

	$pos_set1 = $$pos_set1;
  $pos_set2 = $$pos_set2;

	if(isset($_POST['setpos1'])){
		$pos_set2 = $_POST['setpos1'];
		$pos_2 = "";

		$pos_1 = $_POST['setpos1'];
		$pos_set1 = $_POST['setvar'];

		$pos_set2 = $$pos_set2;
	}

	if(isset($_POST['setpos2'])){
		$pos_set1 = $_POST['setpos2'];
		$pos_1 = "";

		$pos_2 = $_POST['leer'];
	}


	$$pos_set1 = $pos_1;
	$$pos_set2 = $pos_2;


	$test_on_all = $img."".$video."".$videobeschreibung."".$diskussion."".$abonnenten."".$info."".$infofulltext."".$playlist."".$nz1."".$nz2."".$nz3."".$nz4."".$nz5."".$nz6."".$nz7."".$nz8."".$nz9."".$nz10."".$nz11."".$nz12."".$nz13."".$nz14."".$nz15."".$nz16."".$nz17."".$nz18."".$nz19."".$nz20."".$nz21."".$nz22."".$nz23."".$nz24;

	//echo $test_on_all;

	//test ob buchstaben mehr als einam vorkommen würden
	$test_on_z = 0;

										$test_on_a = substr_count($test_on_all, 'a');
	if($test_on_a === 1){$test_on_b = substr_count($test_on_all, 'b');
		if($test_on_b === 1){$test_on_c = substr_count($test_on_all, 'c');
			if($test_on_c === 1){$test_on_d = substr_count($test_on_all, 'd');
				if($test_on_d === 1){$test_on_e = substr_count($test_on_all, 'e');
					if($test_on_e === 1){$test_on_f = substr_count($test_on_all, 'f');
						if($test_on_f === 1){$test_on_g = substr_count($test_on_all, 'g');
							if($test_on_g === 1){$test_on_h = substr_count($test_on_all, 'h');
								if($test_on_h === 1){$test_on_i = substr_count($test_on_all, 'i');
									if($test_on_i === 1){$test_on_j = substr_count($test_on_all, 'j');
										if($test_on_j === 1){$test_on_k = substr_count($test_on_all, 'k');
											if($test_on_k === 1){$test_on_l = substr_count($test_on_all, 'l');
												if($test_on_l === 1){$test_on_m = substr_count($test_on_all, 'm');
													if($test_on_m === 1){$test_on_n = substr_count($test_on_all, 'n');
														if($test_on_n === 1){$test_on_o = substr_count($test_on_all, 'o');
															if($test_on_o === 1){$test_on_p = substr_count($test_on_all, 'p');
																if($test_on_p === 1){$test_on_q = substr_count($test_on_all, 'q');
																	if($test_on_q === 1){$test_on_r = substr_count($test_on_all, 'r');
																		if($test_on_r === 1){$test_on_s = substr_count($test_on_all, 's');
																			if($test_on_s === 1){$test_on_t = substr_count($test_on_all, 't');
																				if($test_on_t === 1){$test_on_u = substr_count($test_on_all, 'u');
																					if($test_on_u === 1){$test_on_v = substr_count($test_on_all, 'v');
																						if($test_on_v === 1){$test_on_w = substr_count($test_on_all, 'w');
																							if($test_on_w === 1){$test_on_x = substr_count($test_on_all, 'x');
																								$test_on_z = 1;
																								//to be continued
																							}
																						}
																					}
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}

		if($test_on_z === 1){
		 $con = "Update channel_design_db SET $pos_set1='$pos_1' WHERE uuid = '$user_uuid'";
		 $con2= "Update channel_design_db SET $pos_set2='$pos_2' WHERE uuid = '$user_uuid'";

		 $con = db::$link->query($con); $con2 = db::$link->query($con2);
	 }else{
		 echo"error";
	 }
 }else{}
 ?>
