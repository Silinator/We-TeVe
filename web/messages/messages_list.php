<?php

if(isset($_POST['page'])){
	//1. Pfad zum Stammverzeichniss wo sich die index befindet
	$_hp = '../'; //für includes
	$_dhp = '../../'; // für daten

	//2. all include
	$in_save_code_all_include = "&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z";
	require_once ($_hp.'include/all_include.php'); //haupt include

}

//3. site vals
$item_per_page = 20;

if($isUserLoggedIn === 1){

  if(isset($page)){
  	$page_number = $page;
  }elseif(isset($_POST['page'])){
  	$page_number = $_POST['page'];
  }

  if(isset($page)){
  	$page_number = 0;
  }elseif(isset($_POST['u'])){
  	$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
  }


  //throw HTTP error if page number is not valid
  if(!is_numeric($page_number)){
  	header('HTTP/1.1 500 Invalid page number!');
  	exit();
  }

  //get current starting point of records
  $position = ($page_number * $item_per_page);

  //message type
  //4 = neue(r) /kommentar/antwort
  //5 = hat dein Kommentar geliket
  //6 = hat dich abonniert
  //7 = hat dein video geliket

  //8 = neue pn


  //message_data by message type
  //4 = kuid
  //5 = comvote (kuid)
  //6 = der der aboniert wird (uuid)
  //7 = vidvote (vuid)


  //message_data2 by message type / angemeldete uuid
  //4 = (user_uuid) com
  //5 = (user_uuid) uuid,uuid,uuid (wie viele andere auch noch (Z.B +99 weitere) comvote
  //6 = (user_uuid) uuid,uuid,uuid (wie viele andere auch noch (Z.B +99 weitere) von dem der aboniert hat
  //7 = (user_uuid) uuid,uuid,uuid (wie viele andere auch noch (Z.B +99 weitere) vidvote

$results = db::$link->query("SELECT * FROM message_db WHERE uuid = '$user_uuid' AND status = 'public' ORDER BY viewed,time DESC LIMIT $position, $item_per_page");

while($row = $results->fetch_array()){

      $mes_type = $row['message_type'];
      $mes_data = $row['message_data'];
      $mes_data2 = $row['message_data2'];
      $mes_viewed = $row['viewed'];

  if($mes_type == '4'){ //neue(r) /kommentar/antwort

        $mes_uuid = $mes_data2; $mes_uuif = sha1(sha1($mes_uuid));
          $avatar_img = $_dhp.$f->draw_avatar($mes_uuid,'small');
          $mes_user_name = $u->userin('name',0,$mes_uuif,'');

        $mes_kuid = $mes_data;
          $kuid_sql = db::$link->query("SELECT * FROM kommentar_db WHERE kuid = '$mes_kuid'");
          $kuid_row = $kuid_sql->fetch_assoc();

          $com_re   = $kuid_row['re_kuid'];
          $com_vuid = $kuid_row['vuid'];
					$com_cuid = $kuid_row['cuid'];

          if($com_re == ""){
            $mes_text = $l->mes_text_type4;
          }else{
            $mes_text = $l->mes_text_type41;
          }


					if($mes_viewed == "0"){
						$read_class = "mes_not_read";
					}else{
						$read_class = "";
					}

        echo "<div class='mes_line mes_".$mes_kuid."_line ".$read_class."'>";
          echo "<div class='mes_user_avatar noselect'> <a href='".$_dhp."user/".$mes_user_name."'> <img src='".$avatar_img."'/> </a> </div>";
            echo "<div class='mes_main_content'>";
              echo "<div class='mes_title no_overflow'><a href='".$_dhp."user/".$mes_user_name."'>".$mes_user_name."</a> </div>";
              echo "<div class='mes_text no_overflow'>".$mes_text."</div>";
            echo "</div>";
            echo "<div class='mes_switch'> <span for='mes_".$mes_kuid."' class='mes_switch_btn mes_open_btn glyphicon glyphicon-chevron-down'></span> </div>";

            //hidden content
            echo "<div vid='".$com_vuid."' channel='".$com_cuid."' class='mes_vcuid_info mes_hidden_content mes_".$mes_kuid."'>";

                // Video zm kommentar
								$link_add = "&k=".$mes_kuid;
                echo "<div class='mes_video_preview'>".$f->draw_video_pewview($com_vuid,'1','ver',$link_add,$_dhp,$_ddhp,'0','small')."</div>";

            if($com_re == ""){
                //get val
                  //test ob es Layer 1 ist
                  $t_layer4 = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$mes_kuid' LIMIT 1");
                  $t_layer4 = $t_layer4->fetch_assoc();
                    $test_layer4 = $t_layer4['re_kuid'];
                    //test ob es Layer 2 ist
                    $t_layer3 = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$test_layer4' LIMIT 1");
                    $t_layer3 = $t_layer3->fetch_assoc();
                      $test_layer3 = $t_layer3['re_kuid'];
                      //test ob es Layer 3 ist
                      $t_layer2 = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$test_layer3' LIMIT 1");
                      $t_layer2 = $t_layer2->fetch_assoc();
                        $test_layer2 = $t_layer2['re_kuid'];
                        //test ob es Layer 4 ist
                        $t_layer1 = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$test_layer2' LIMIT 1");
                        $t_layer1 = $t_layer1->fetch_assoc();
                          $test_layer1 = $t_layer1['re_kuid'];
                          //test ob es Layer 5 ist
                          $t_layer0 = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$test_layer1' LIMIT 1");
                          $t_layer0 = $t_layer0->fetch_assoc();
                            $test_layer0 = $t_layer0['re_kuid'];

                  $layer = 5;
                  if($test_layer1 == ""){$layer = 4;}
                  if($test_layer2 == ""){$layer = 3;}
                  if($test_layer3 == ""){$layer = 2;}
                  if($test_layer4 == ""){$layer = 1;}


              echo $com->draw_comment($mes_kuid,$layer,1,2,$_dhp);


            }else{ //ist antwort


              //get val
                //test ob es Layer 1 ist
                $t_layer4 = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$com_re' LIMIT 1");
                $t_layer4 = $t_layer4->fetch_assoc();
                  $test_layer4 = $t_layer4['re_kuid'];
                  //test ob es Layer 2 ist
                  $t_layer3 = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$test_layer4' LIMIT 1");
                  $t_layer3 = $t_layer3->fetch_assoc();
                    $test_layer3 = $t_layer3['re_kuid'];
                    //test ob es Layer 3 ist
                    $t_layer2 = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$test_layer3' LIMIT 1");
                    $t_layer2 = $t_layer2->fetch_assoc();
                      $test_layer2 = $t_layer2['re_kuid'];
                      //test ob es Layer 4 ist
                      $t_layer1 = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$test_layer2' LIMIT 1");
                      $t_layer1 = $t_layer1->fetch_assoc();
                        $test_layer1 = $t_layer1['re_kuid'];
                        //test ob es Layer 5 ist
                        $t_layer0 = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$test_layer1' LIMIT 1");
                        $t_layer0 = $t_layer0->fetch_assoc();
                          $test_layer0 = $t_layer0['re_kuid'];

                $layer = 5;
                if($test_layer1 == ""){$layer = 4;}
                if($test_layer2 == ""){$layer = 3;}
                if($test_layer3 == ""){$layer = 2;}
                if($test_layer4 == ""){$layer = 1;}


            echo $com->draw_comment($com_re,$layer,1,2,$_dhp);


              //get val
                //test ob es Layer 1 ist
                $t_layer4 = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$mes_kuid' LIMIT 1");
                $t_layer4 = $t_layer4->fetch_assoc();
                  $test_layer4 = $t_layer4['re_kuid'];
                  //test ob es Layer 2 ist
                  $t_layer3 = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$test_layer4' LIMIT 1");
                  $t_layer3 = $t_layer3->fetch_assoc();
                    $test_layer3 = $t_layer3['re_kuid'];
                    //test ob es Layer 3 ist
                    $t_layer2 = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$test_layer3' LIMIT 1");
                    $t_layer2 = $t_layer2->fetch_assoc();
                      $test_layer2 = $t_layer2['re_kuid'];
                      //test ob es Layer 4 ist
                      $t_layer1 = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$test_layer2' LIMIT 1");
                      $t_layer1 = $t_layer1->fetch_assoc();
                        $test_layer1 = $t_layer1['re_kuid'];
                        //test ob es Layer 5 ist
                        $t_layer0 = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$test_layer1' LIMIT 1");
                        $t_layer0 = $t_layer0->fetch_assoc();
                          $test_layer0 = $t_layer0['re_kuid'];

                $layer = 5;
                if($test_layer1 == ""){$layer = 4;}
                if($test_layer2 == ""){$layer = 3;}
                if($test_layer3 == ""){$layer = 2;}
                if($test_layer4 == ""){$layer = 1;}


            echo $com->draw_comment($mes_kuid,$layer,1,2,$_dhp);


            }

            echo "</div>";

        echo "<div style='clear:both;'></div>";
        echo "</div>";



  }elseif($mes_type == '5' AND $mes_data2 != ""){


				$mes_kuid = $mes_data;
				$user_list = $mes_data2;

				$user_list = explode(",",$user_list);

				$mes_uuid = $user_list[0]; $mes_uuif = sha1(sha1($mes_uuid));
					$avatar_img = $_dhp.$f->draw_avatar($mes_uuid,'small');
					$mes_user_name = $u->userin('name',0,$mes_uuif,'');

				$mes_user_c = count($user_list);
				$mes_user_cc = $mes_user_c - 1;
				if($user_list[$mes_user_cc] == ""){ $mes_user_c = $mes_user_c - 1; }

				if($mes_user_c > 1){
					$mes_title = "<a href='".$_dhp."user/".$mes_user_name."'>".$mes_user_name."</a> ".$l->mes_title_type5." <b class='blue'>+".$mes_user_cc."</b> ".$l->mes_title_type51;
				}else{
					$mes_title = "<a href='".$_dhp."user/".$mes_user_name."'>".$mes_user_name."</a>";
				}

				$mes_vuid_sql = db::$link->query("SELECT vuid FROM kommentar_db WHERE kuid = '$mes_kuid'");
				$mes_vuid_row = $mes_vuid_sql->fetch_assoc();

				$mes_vuid = $mes_vuid_row['vuid'];


				if($mes_user_c > 1){
					$mes_text = $l->mes_text_type5." <a href='".$_dhp."watch/".$mes_vuid."&k=".$mes_kuid."'>".$l->mes_text_type51."</a> ".$l->mes_text_type52;
				}else{
					$mes_text = $l->mes_text_type50." <a href='".$_dhp."watch/".$mes_vuid."&k=".$mes_kuid."'>".$l->mes_text_type51."</a> ".$l->mes_text_type52;
				}

				if($mes_viewed == "0"){
					$read_class = "mes_not_read";
				}else{
					$read_class = "";
				}

				echo "<div class='mes_line ".$read_class."'>";
					echo "<div class='mes_user_avatar'> <a href='".$_dhp."user/".$mes_user_name."'> <img src='".$avatar_img."'/> </a> </div>";
						echo "<div class='mes_main_content_full'>";
							echo "<div class='mes_title no_overflow'>".$mes_title."</div>";
							echo "<div class='mes_text no_overflow'>".$mes_text."</div>";
						echo "</div>";


				echo "<div style='clear:both;'></div>";
				echo "</div>";



  }elseif($mes_type == '6' AND $mes_data2 != ""){

				$mes_uuid = $mes_data;
				$user_list = $mes_data2;

				$user_list = explode(",",$user_list);

				$mes_uuid = $user_list[0]; $mes_uuif = sha1(sha1($mes_uuid));
					$avatar_img = $_dhp.$f->draw_avatar($mes_uuid,'small');
					$mes_user_name = $u->userin('name',0,$mes_uuif,'');

				$mes_user_c = count($user_list);
				$mes_user_cc = $mes_user_c - 1;
				if($user_list[$mes_user_cc] == ""){ $mes_user_c = $mes_user_c - 1; }

				if($mes_user_c > 1){
					$mes_title = "<a href='".$_dhp."user/".$mes_user_name."'>".$mes_user_name."</a> ".$l->mes_title_type6." <b class='blue'>+".$mes_user_cc."</b> ".$l->mes_title_type61;
				}else{
					$mes_title = "<a href='".$_dhp."user/".$mes_user_name."'>".$mes_user_name."</a>";
				}


				if($mes_user_c > 1){
					$mes_text = $l->mes_text_type6;
				}else{
					$mes_text = $l->mes_text_type60;
				}

				if($mes_viewed == "0"){
					$read_class = "mes_not_read";
				}else{
					$read_class = "";
				}

				echo "<div class='mes_line ".$read_class."'>";
					echo "<div class='mes_user_avatar'> <a href='".$_dhp."user/".$mes_user_name."'> <img src='".$avatar_img."'/> </a> </div>";
						echo "<div class='mes_main_content_full'>";
							echo "<div class='mes_title no_overflow'>".$mes_title."</div>";
							echo "<div class='mes_text no_overflow'>".$mes_text."</div>";
						echo "</div>";


				echo "<div style='clear:both;'></div>";
				echo "</div>";


  }elseif($mes_type == '7' AND $mes_data2 != ""){


				$mes_vuid = $mes_data;
				$user_list = $mes_data2;

				$user_list = explode(",",$user_list);

				$mes_uuid = $user_list[0]; $mes_uuif = sha1(sha1($mes_uuid));
          $avatar_img = $_dhp.$f->draw_avatar($mes_uuid,'small');
          $mes_user_name = $u->userin('name',0,$mes_uuif,'');

				$mes_user_c = count($user_list);
				$mes_user_cc = $mes_user_c - 1;
				if($user_list[$mes_user_cc] == ""){ $mes_user_c = $mes_user_c - 1; }

				if($mes_user_c > 1){
					$mes_title = "<a href='".$_dhp."user/".$mes_user_name."'>".$mes_user_name."</a> ".$l->mes_title_type7." <b class='blue'>+".$mes_user_cc."</b> ".$l->mes_title_type71;
				}else{
					$mes_title = "<a href='".$_dhp."user/".$mes_user_name."'>".$mes_user_name."</a>";
				}

				if($mes_user_c > 1){
					$mes_text = $l->mes_text_type7." <a href='".$_dhp."watch/".$mes_vuid."'>".$l->mes_text_type71."</a> ".$l->mes_text_type72;
				}else{
					$mes_text = $l->mes_text_type70." <a href='".$_dhp."watch/".$mes_vuid."'>".$l->mes_text_type71."</a> ".$l->mes_text_type72;
				}

				if($mes_viewed == "0"){
					$read_class = "mes_not_read";
				}else{
					$read_class = "";
				}

				echo "<div class='mes_line ".$read_class."'>";
					echo "<div class='mes_user_avatar'> <a href='".$_dhp."user/".$mes_user_name."'> <img src='".$avatar_img."'/> </a> </div>";
						echo "<div class='mes_main_content_full'>";
							echo "<div class='mes_title no_overflow'>".$mes_title."</div>";
							echo "<div class='mes_text no_overflow'>".$mes_text."</div>";
						echo "</div>";


				echo "<div style='clear:both;'></div>";
				echo "</div>";
  }


}//end while

		$up = "UPDATE message_db SET viewed = '1' WHERE uuid = '$user_uuid'";
		$up = db::$link->query($up);


}//if usser logged in
?>
