<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = "../../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include


//3. site vals
$html_title = $l->vm_edit_title0."| We-TeVe"; //Tap title

$vuid = mysqli_real_escape_string(db::$link,$_GET['v']);

  //updateed planed
  $time = strtotime(date('Y-m-d H:i:s'));
  $up 	= "UPDATE video_db SET privacy = 'public' WHERE privacy = 'planed' AND uploaddate < '$time'";
  $up 	= db::$link->query($up);

  $video_sql = db::$link->query("SELECT * FROM video_db WHERE vuid = '$vuid'");
  $video_row = $video_sql->fetch_assoc();

  $video_uuid     = $video_row['uuid'];
  $video_title 		= htmlentities($video_row['video_title'], ENT_QUOTES);
  $uploaddate     = $video_row['uploaddate'];

  $max_result 		= $video_row['max_result'];
  $render_status	= $video_row['render_status'];
  $video_status	  = $video_row['status'];
  $video_privacy	= $video_row['privacy'];

  $video_cat	  = $video_row['kategorie'];
  $video_lang	  = $video_row['sprache'];
  $video_color	= $video_row['color'];
  $video_color2	= $video_row['color2'];

  $video_description = $video_row['info'];
  $video_description = $com->fulltext($video_description);
  $video_tags   = htmlentities($video_row['tags'], ENT_QUOTES);


if($isUserLoggedIn === 1 AND ($video_uuid == $user_uuid OR $user_rang == 1)) {

//4. coinhive check
	$coin_name = "main";
  require_once ($_hp.'coinhive/coinhive_check.php');


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
			<?php
			require_once ($_hp.'include/head.php');
			//echo "<script src='".$_dhp."video/video.js'></script>";
			//echo "<script src='".$_dhp."video/video-hotkey.js'></script>";
			?>
		</head>
		<body id='body' class='body'>

			<?php require_once ($_hp.'include/navi.php'); ?>




		<div id='main_container' class='container main_container'>
<?php	} ?>

		<span id='site_scripts'>

				<?php require_once ($_hp.'include/coinhivescript.php'); ?>

      <script>
				var playlist_id = 'not_set';

				$(document).ready(function() {
					docready();
					sethtmltitle('<?php echo $html_title; ?>');
          resultloadedforthumbpreview();
				});

			</script>
		</span>



		<div class='row'>
			<div class='col-lg-2 col-xl-2 col-spl'> </div>
			<div class='content_box col-lg-8 col-xl-8'>

				<?php // eingaben bereich ^hide ?>
					<div class='upload_content'>
						<div class='col-lg-6 col-xl-6'>

							<?php //video thumb vorschau?>
							<div class='up_title'><?php echo $l->up_video_preview; ?>:</div>

							<?php
								$user_avatar = $_dhp.$f->draw_avatar($user_uuid,"small");
							?>

              <?php echo $f->draw_video_pewview($vuid,0,'hor','',$_dhp,$_ddhp,'0','small'); ?>

							<br/>
							<br/>

              <?php
              $vid_privacy_class1 = "";$vid_privacy_class2 = "";$vid_privacy_class3 = "";$vid_privacy_class4 = "";$vid_privacy_class5 = "";
                    if($video_privacy == "public"){ $vid_privacy_class1 = "activ";}
                elseif($video_privacy == "unlist"){ $vid_privacy_class2 = "activ";}
                elseif($video_privacy == "friend"){ $vid_privacy_class3 = "activ";}
                elseif($video_privacy == "privat"){ $vid_privacy_class4 = "activ";}
                elseif($video_privacy == "planed"){ $vid_privacy_class5 = "activ";}
              ?>

							<div class='video_privacy' priv='<?php echo $video_privacy; ?>'>
								<div class='up_title dropdown_title col-xs-12 col-sm-6 col-spl'><?php echo $l->up_privacy_title0; ?>:</div>
								<div class='right'>
									<div title='<?php echo $l->up_privacy_title1; ?>' priv='public' class="button priv_btn gray_btn left marg-r-5 <?php echo $vid_privacy_class1; ?>"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span></div>
									<div title='<?php echo $l->up_privacy_title2; ?>' priv='unlist' class="button priv_btn gray_btn left marg-r-5 <?php echo $vid_privacy_class2; ?>"><i class="fa fa-unlock" aria-hidden="true"></i></div>
									<div title='<?php echo $l->up_privacy_title3; ?>' priv='friend' class="button priv_btn gray_btn left marg-r-5 <?php echo $vid_privacy_class3; ?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
									<div title='<?php echo $l->up_privacy_title4; ?>' priv='privat' class="button priv_btn gray_btn left marg-r-5 <?php echo $vid_privacy_class4; ?>"><i class="fa fa-lock" aria-hidden="true"></i></div>
                  <div title='<?php echo $l->up_privacy_title5; ?>' priv='planed' class="button priv_btn gray_btn left          <?php echo $vid_privacy_class5; ?>"><span class=" glyphicon glyphicon-time" aria-hidden="true"></span></div>
                </div>



								<?php
                if($video_privacy == "planed"){
                  if($video_status == "uploaded"){
                    $time       = $uploaddate;
                    if($time < strtotime(date('Y-m-d H:i:s')) ){
                      $time24h  = $uploaddate + 300;
                    }else{
                      $time24h  = $uploaddate;
                    }
                  }else{
                    $time       = $uploaddate;
                    $time24h    = $uploaddate;
                  }
                }else{
                  if($video_status == "uploaded"){
                    $time       = strtotime(date('Y-m-d H:i:s'));
                    $time24h    = $time;
                  }else{
                    $time       = strtotime(date('Y-m-d H:i:s'));
                    $time24h    = strtotime(date('Y-m-d H:i:s')) + 80000;
                  }
                }

                  $time24h = ceil($time24h/300)*300;

                  if(date("i", $time24h ) > 55){
                    $time24h = $time24h + 300;
                  }

  								$t_date = new DateTime();

  								$day_24h = date("Y, m, d", $time24h);

  									$t_day 			= date("d", $time24h);
  									$t_day_data = date("j", $time24h);

  									switch (date("n", $time24h)) {
  										case '1':  $t_month = $l->monat_january; 	break;
  										case '2':  $t_month = $l->monat_february; break;
  										case '3':  $t_month = $l->monat_march;		break;
  										case '4':  $t_month = $l->monat_april;		break;
  										case '5':  $t_month = $l->monat_may;			break;
  										case '6':  $t_month = $l->monat_june;			break;
  										case '7':  $t_month = $l->monat_july;			break;
  										case '8':  $t_month = $l->monat_august;		break;
  										case '9':  $t_month = $l->monat_september;break;
  										case '10': $t_month = $l->monat_october;	break;
  										case '11': $t_month = $l->monat_november;	break;
  										case '12': $t_month = $l->monat_december;	break;


  										default:$t_month = $l->monat_january; break;
  									}

  									$t_month_data = date("n", $time24h);

  									$t_year = date("Y", $time24h);

  									$t_hour = date("H", $time24h);
  									$t_min = date("i", $time24h);
  									$t_min = (round($t_min)%5 === 0) ? round($t_min) : round(($t_min+5/2)/5)*5;
  										if($t_min == '0'){$t_min = "00";}
  										if($t_min == '5'){$t_min = "05";}
  								?>


                  <?php
                  if($video_privacy == "planed"){
                    $time_input_hide = "";
                  }else{
                    $time_input_hide = "hide";
                  }

                  //plylist content
                    echo "
                      <div class='pm_container_bg pm_to_hide hide'>
                        <div class='col-spl col-xs-0 col-sm-1 col-md-2 col-lg-4 col-xl-3 col-spl'></div>
                        <div class='pm_container col-xs-11 col-sm-10 col-md-8 col-lg-4 col-xl-5'>
                          <div class='pm_title_container'>";
                            echo "<div class='pm_title pm_pl_title pm_to_hide hide'>".$l->pl_add_title0.":</div>";
                              echo "<div class='pm_close_btn'><span class='glyphicon glyphicon-remove'></span></div>";
                          echo "</div>";

                            //playlist content
                            echo "<div class='pm_pl_container pm_to_hide hide'>";
                              echo "<div class='pm_add_pl_error error w-100 pm_to_hide hide'>".$l->pl_error0."</div>";
                              $plss = 0;
                              $pl_results = db::$link->query("SELECT title,puid,privacy FROM playlist_db WHERE uuid = '$user_uuid' AND status = 'public' ORDER BY last_interaction DESC LIMIT 100");
                                while($pl_row = $pl_results->fetch_array()){ $plss++;
                                  if($plss == 1){
                                    echo "<div>".$l->pl_add_title1.":</div>";
                                    echo "<div class='pm_scroll_container'>";
                                  }
                                  $pl_name = $pl_row['title']; $pl_puid = $pl_row['puid']; $privacy = $pl_row['privacy'];
                                  //ist video in playlist:
                                  $isvidinpl_sql = db::$link->query("SELECT puid FROM playlist_content_db WHERE puid = '$pl_puid' AND uuid = '$user_uuid' AND vuid = '$vuid' AND status = 'public'");
                                  $isvidinpl_row = $isvidinpl_sql->fetch_assoc();
                                  if($isvidinpl_row['puid'] != ""){$inplclass="pl_add_list_line_selectet"; $inplcheck="<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";}else{$inplclass=""; $inplcheck="<span class='glyphicon glyphicon-plus' aria-hidden='true'></span>";}

                                    echo"<div pl='".$pl_puid."' class='pl_add_list_line ".$inplclass." pl_".$pl_puid."'>";
                                      echo "<div class='pl_add_list_title no_overflow'>".$inplcheck.$pl_name."</div>" ;
                                      echo "<div class='pl_add_list_privacy'>";
                                        //0 = Privat
                                        //1 = Öffentlich
                                        //2 = Nicht gelistet
                                        //3 = Nur Freunde
                                        switch ($privacy) {
                                          case '0':
                                            echo "<i class='fa fa-lock' aria-hidden='true'></i>";
                                          break;

                                          case '1':
                                            echo "<span class='glyphicon glyphicon-globe' aria-hidden='true'></span>";
                                          break;

                                          case '2':
                                            echo "<i class='fa fa-unlock' aria-hidden='true'></i>";
                                          break;

                                          case '3':
                                            echo "<span class='glyphicon glyphicon-user' aria-hidden='true'></span>";
                                          break;
                                        }
                                      echo "</div>";
                                    echo "</div>";
                                }
                              if($plss == 0){
                                echo "<div class='pm_scroll_container'>";
                              }
                            echo "</div>";

                            //new pl
                            echo "<div style='clear:both;'></div><br><div>".$l->pl_add_title2.":</div>";
                            echo "<div class='pm_new_pl_error error w-100 pm_to_hide hide'>".$l->pl_error1."</div>";
                              echo "<input pl_privacy='privat' class='form-control pm_new_pl' placeholder='".$l->pl_add_text."' type='text'/>";
                              echo "<div class='pl_privacy'>";
                                echo "<div title='".$l->up_privacy_title1."' priv='public' class='button priv_btn gray_btn left marg-r-5'><span class='glyphicon glyphicon-globe' aria-hidden='true'></span></div>";
                                echo "<div title='".$l->up_privacy_title2."' priv='unlist' class='button priv_btn gray_btn left marg-r-5'><i class='fa fa-unlock' aria-hidden='true'></i></div>";
                                echo "<div title='".$l->up_privacy_title3."' priv='friend' class='button priv_btn gray_btn left marg-r-5'><span class='glyphicon glyphicon-user' aria-hidden='true'></span></div>";
                                echo "<div title='".$l->up_privacy_title4."' priv='privat' class='button priv_btn gray_btn left marg-r-5'><i class='fa fa-lock' aria-hidden='true'></i></div>";
                              echo "</div>";
                              echo "<div class='pm_new_pl_btn'>".$l->pl_add_new_pl."</div>";

                          echo "</div>";

                        echo "
                            </div>
                            <div class='col-xs-0 col-sm-1 col-md-2 col-lg-4 col-xl-4 col-spl'></div>
                          </div>
                        ";

                        //end playlist content

                ?>

								<div class='time_input <?php echo $time_input_hide; ?>' time='<?php echo $time24h; ?>'>
										<div class='up_title dropdown_title col-xs-12 col-sm-6 col-spl'><?php echo $l->up_privacy_time; ?>:</div>
										<div class='right'>

										<div class='time_input_t marg-bot-5'>
											<div class="time_hour_dropdown left dropdown">
												<div class="time_hour_dropdown_btn btn btn-default gray_btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													<span class='time_hour_dropdown_label no_overflow' data='<?php echo $t_hour;?>'><?php echo $t_hour;?></span>
													<span class="caret"></span>
												</div>
												<ul class="dropdown-menu time_dropdown-menu">
													<li d='00'>00</li><li d='1'>01</li><li d='2'>02</li><li d='3'>03</li><li d='4'>04</li><li d='5'>05</li><li d='6'>06</li><li d='7'>07</li><li d='8'>08</li><li d='9'>09</li><li d='10'>10</li><li d='11'>11</li>
													<li d='12'>12</li><li d='13'>13</li><li d='14'>14</li><li d='15'>15</li><li d='16'>16</li><li d='17'>17</li><li d='18'>18</li><li d='19'>19</li><li d='20'>20</li><li d='21'>21</li><li d='22'>22</li><li d='23'>23</li>
												</ul>
											</div>
											<div class='time_input_txt'> :</div>
											<div class="time_min_dropdown left dropdown">
												<div class="time_min_dropdown_btn btn btn-default gray_btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													<span class='time_min_dropdown_label no_overflow' data='<?php echo $t_min; ?>'><?php echo $t_min; ?></span>
													<span class="caret"></span>
												</div>
												<ul class="dropdown-menu time_dropdown-menu">
													<li d='0'>00</li><li d='5'>05</li><li d='10'>10</li><li d='15'>15</li><li d='20'>20</li><li d='25'>25</li><li d='30'>30</li>
													<li d='35'>35</li><li d='40'>40</li><li d='45'>45</li><li d='50'>50</li><li d='55'>55</li>
												</ul>
											</div>

										</div>


										<div class='right'>
											<div class="time_day_dropdown left dropdown">
											  <div class="time_day_dropdown_btn btn btn-default gray_btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
											    <span class='time_day_dropdown_label no_overflow' data='<?php echo $t_day_data; ?>'><?php echo $t_day; ?></span>
											    <span class="caret"></span>
											  </div>
											  <ul class="dropdown-menu time_dropdown-menu">
													<li d='1'>01</li><li d='2'>02</li><li d='3'>03</li><li d='4'>04</li><li d='5'>05</li><li d='6'>06</li><li d='7'>07</li><li d='8'>08</li><li d='9'>09</li><li d='10'>10</li>
													<li d='11'>11</li><li d='12'>12</li><li d='13'>13</li><li d='14'>14</li><li d='15'>15</li><li d='16'>16</li><li d='17'>17</li><li d='18'>18</li><li d='19'>19</li><li d='20'>20</li>
													<li d='21'>21</li><li d='22'>22</li><li d='23'>23</li><li d='24'>24</li><li d='25'>25</li><li d='26'>26</li><li d='27'>27</li><li d='28'>28</li><li d='29'>29</li><li d='30'>30</li><li d='31'>31</li>
											  </ul>
											</div>

											<div class="time_month_dropdown left dropdown">
												<div class="time_month_dropdown_btn btn btn-default gray_btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													<span class='time_month_dropdown_label no_overflow' data='<?php echo $t_month_data; ?>'><?php echo $t_month; ?></span>
													<span class="caret"></span>
												</div>
												<ul class="dropdown-menu time_dropdown-menu">
													<li d='1'><?php echo $l->monat_january; ?></li> <li d='2'><?php echo $l->monat_february; ?></li> <li d='3'><?php echo $l->monat_march; ?></li> <li d='4'><?php echo $l->monat_april; ?></li d='5'> <li><?php echo $l->monat_may; ?></li> <li d='6'><?php echo $l->monat_june; ?></li>
													<li d='7'><?php echo $l->monat_july; ?></li> <li d='8'><?php echo $l->monat_august; ?></li> <li d='9'><?php echo $l->monat_september; ?></li> <li d='10'><?php echo $l->monat_october; ?></li> <li d='11'><?php echo $l->monat_november; ?></li> <li d='12'><?php echo $l->monat_december; ?></li>
												</ul>
											</div>

											<div class="time_year_dropdown left dropdown">
												<div class="time_year_dropdown_btn btn btn-default gray_btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													<span class='time_year_dropdown_label no_overflow' data='<?php echo $t_year;?>'><?php echo $t_year;?></span>
													<span class="caret"></span>
												</div>
												<ul class="dropdown-menu time_dropdown-menu">
													<?php for ($i = date("Y"); $i < date("Y") + 6; $i++) {echo "<li d='".$i."'>".$i."</li>";} ?>
												</ul>
											</div>
										</div>

										</div>

										<div class='date_error date_error_time error hide'><?php echo $l->up_date_error_time2; ?></div>
										<div class='date_error date_error_date error hide'><?php echo $l->up_date_error_date; ?></div>
										<div class='date_error date_error_ie error hide'>	 <?php echo $l->up_date_error_ie; ?>	</div>
								</div>

							</div>


							<div class='up_title'><?php echo $l->up_video_title; ?>:</div>
							<input class='video_title_input up_input' maxlength='150' placeholder='<?php echo $l->up_video_title; ?>' value='<?php echo $video_title; ?>' type='text'/>
							<br/>
							<div class='up_title'><?php echo $l->up_video_des; ?>:</div>
							<p contentEditable='true' class='video_info_input up_input' placeholder='<?php echo $l->up_video_des; ?>' ><?php echo $video_description; ?></p>

              <div class='up_title'><?php echo $l->up_video_tags; ?>:</div>
              <input class='video_tag_input up_input' maxlength='200' placeholder='<?php echo $l->up_video_preview_text2_5; ?>' value='<?php echo $video_tags; ?>' type='text'/>


						</div>
						<div class=' col-lg-6 col-xl-6'>

						<div class='video_info_dropdown_line'>
							<div class='up_title dropdown_title col-xs-12 col-sm-6 col-spl'><?php echo $l->up_cat_title0; ?>:</div>
								<div class="cat_dropdown up_dropdown dropdown">
								  <div class="cat_dropdown_btn btn btn-default gray_btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								    <span class='cat_dropdown_label dropdown_label no_overflow' cat='<?php echo $video_cat; ?>'> <?php echo $f->draw_category($video_cat,1); ?></span>
								    <span class="caret"></span>
								  </div>
								  <ul class="dropdown-menu up_dropdown-menu">
										<li> <div class='cat_dropdown_select dropdown_select' cat='ads' cont='<?php echo $f->draw_category("ads",0); ?>' ><?php echo $f->draw_category('ads',1); ?></div> </li>
                    <li> <div class='cat_dropdown_select dropdown_select' cat='com' cont='<?php echo $f->draw_category("com",0); ?>' ><?php echo $f->draw_category('com',1); ?></div> </li>
										<li> <div class='cat_dropdown_select dropdown_select' cat='eat' cont='<?php echo $f->draw_category("eat",0); ?>' ><?php echo $f->draw_category('eat',1); ?></div> </li>
								    <li> <div class='cat_dropdown_select dropdown_select' cat='ent' cont='<?php echo $f->draw_category("ent",0); ?>' ><?php echo $f->draw_category('ent',1); ?></div> </li>
										<li> <div class='cat_dropdown_select dropdown_select' cat='gam' cont='<?php echo $f->draw_category("gam",0); ?>' ><?php echo $f->draw_category('gam',1); ?></div> </li>
										<li> <div class='cat_dropdown_select dropdown_select' cat='mov' cont='<?php echo $f->draw_category("mov",0); ?>' ><?php echo $f->draw_category('mov',1); ?></div> </li>
										<li> <div class='cat_dropdown_select dropdown_select' cat='mus' cont='<?php echo $f->draw_category("mus",0); ?>' ><?php echo $f->draw_category('mus',1); ?></div> </li>
										<li> <div class='cat_dropdown_select dropdown_select' cat='spo' cont='<?php echo $f->draw_category("spo",0); ?>' ><?php echo $f->draw_category('spo',1); ?></div> </li>
										<li> <div class='cat_dropdown_select dropdown_select' cat='vlo' cont='<?php echo $f->draw_category("vlo",0); ?>' ><?php echo $f->draw_category('vlo',1); ?></div> </li>
								  </ul>
								</div>
						</div>

						<div class='video_info_dropdown_line'>
							<div class='up_title dropdown_title col-xs-12 col-sm-6 col-spl'><?php echo $l->up_lang_title0; ?>:</div>
								<div class="lang_dropdown up_dropdown dropdown">
									<div class="lang_dropdown_btn btn btn-default gray_btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
										<span class='lang_dropdown_label dropdown_label no_overflow' lang='<?php echo $video_lang; ?>'> <?php echo $c->draw_lang($video_lang,1); ?></span>
										<span class="caret"></span>
									</div>
									<ul class="dropdown-menu up_dropdown-menu">
										<li> <div class='lang_dropdown_select dropdown_select' lang='en' cont="<?php echo $c->draw_lang('en',0); ?>" ><?php echo $c->draw_lang('en',1); ?></div> </li>
										<li> <div class='lang_dropdown_select dropdown_select' lang='de' cont="<?php echo $c->draw_lang('de',0); ?>" ><?php echo $c->draw_lang('de',1); ?></div> </li>
										<li> <div class='lang_dropdown_select dropdown_select' lang='fr' cont="<?php echo $c->draw_lang('fr',0); ?>" ><?php echo $c->draw_lang('fr',1); ?></div> </li>
									</ul>
								</div>
						</div>


						<div class='video_info_dropdown_line'>
							<div class='up_title dropdown_title col-xs-12 col-sm-6 col-spl'><?php echo $l->up_color_title0; ?>:</div>
								<div class="color_dropdown up_dropdown dropdown">
									<div class="color_dropdown_btn btn btn-default gray_btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
										<span class='color_dropdown_label dropdown_label no_overflow' color='<?php echo $video_color; ?>' color2='<?php echo $video_color2; ?>'> <div style='background-color:<?php echo $video_color; ?>; border-color:<?php echo $video_color2; ?>;' class='color_preview'></div>  <div class="color_label"><?php echo $video_color; ?></div> </span>
										<span class="caret"></span>
									</div>
									<ul class="dropdown-menu up_dropdown-menu">
										<li> <div class='color_dropdown_select dropdown_select' color='#007abf' color2='#ffffff'> <div style='background-color:#007abf; border-color:#ffffff;' class='color_preview'></div>  <div class="color_label">#007abf</div></div> </li>
										<li> <div class='color_dropdown_select dropdown_select' color='#2130BC' color2='#ffffff'> <div style='background-color:#2130BC; border-color:#ffffff;' class='color_preview'></div>  <div class="color_label">#2130BC</div></div> </li>
										<li> <div class='color_dropdown_select dropdown_select' color='#7638AD' color2='#ffffff'> <div style='background-color:#7638AD; border-color:#ffffff;' class='color_preview'></div>  <div class="color_label">#7638AD</div></div> </li>
										<li> <div class='color_dropdown_select dropdown_select' color='#C50000' color2='#ffffff'> <div style='background-color:#C50000; border-color:#ffffff;' class='color_preview'></div>  <div class="color_label">#C50000</div></div> </li>
										<li> <div class='color_dropdown_select dropdown_select' color='#FF7200' color2='#ffffff'> <div style='background-color:#FF7200; border-color:#ffffff;' class='color_preview'></div>  <div class="color_label">#FF7200</div></div> </li>
										<li> <div class='color_dropdown_select dropdown_select' color='#FFD200' color2='#ffffff'> <div style='background-color:#FFD200; border-color:#ffffff;' class='color_preview'></div>  <div class="color_label">#FFD200</div></div> </li>
										<li> <div class='color_dropdown_select dropdown_select' color='#7EFF00' color2='#ffffff'> <div style='background-color:#7EFF00; border-color:#ffffff;' class='color_preview'></div>  <div class="color_label">#7EFF00</div></div> </li>
										<li> <div class='color_dropdown_select dropdown_select' color='#00D100' color2='#ffffff'> <div style='background-color:#00D100; border-color:#ffffff;' class='color_preview'></div>  <div class="color_label">#00D100</div></div> </li>
										<li> <div class='color_dropdown_select dropdown_select' color='#00FF9C' color2='#ffffff'> <div style='background-color:#00FF9C; border-color:#ffffff;' class='color_preview'></div>  <div class="color_label">#00FF9C</div></div> </li>
										<li> <div class='color_dropdown_select dropdown_select' color='#00FFFC' color2='#ffffff'> <div style='background-color:#00FFFC; border-color:#ffffff;' class='color_preview'></div>  <div class="color_label">#00FFFC</div></div> </li>
										<li> <div class='color_dropdown_select dropdown_select' color='#ffffff' color2='#000000'> <div style='background-color:#ffffff; border-color:#000000;' class='color_preview'></div>  <div class="color_label">#ffffff</div></div> </li>
										<li> <div class='color_dropdown_select dropdown_select' color='#000000' color2='#ffffff'> <div style='background-color:#000000; border-color:#ffffff;' class='color_preview'></div>  <div class="color_label">#000000</div></div> </li>
									</ul>
								</div>
						</div>


						<div class='video_info_dropdown_line'>
							<div class='up_title dropdown_title col-xs-12 col-sm-6 col-spl'><?php echo $l->up_thumb_title0; ?>:</div>
								<div class="lang_dropdown up_dropdown dropdown">
									<label class="up_tuhmb_btn btn blue_btn">
								    <?php echo $l->up_thumb_title1 ?> <input type="file" thumb_up='ready' name="thumb" id="thumb" class='hide'>
									</label>

								</div>
								<div class='thumb_status w-100'>
									<div class='thumb_error blue  thumb_error_1 hide'><?php echo $l->up_thumb_alert1; ?></div>
									<div class='thumb_error error thumb_error_2 hide'><?php echo $l->up_thumb_alert2; ?></div>
									<div class='thumb_error error thumb_error_3 hide'><?php echo $l->up_thumb_alert3; ?></div>
									<div class='thumb_error error thumb_error_5 hide'><?php echo $l->up_thumb_alert5; ?></div>
									<div class='thumb_error error thumb_error_7 hide'><?php echo $l->up_thumb_alert7; ?></div>
								</div>
						</div>



            <div class='video_info_dropdown_line'>
              <div class='up_title dropdown_title col-xs-12 col-sm-6 col-spl'><?php echo $l->watch_btn_title2_5; ?>:</div>
                <div class="lang_dropdown up_dropdown dropdown">
                  <div class='up_tuhmb_btn btn blue_btn addplaylist_op_btn'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> <?php echo $l->watch_btn_title2 ?></div>
                </div>
            </div>



						<div class='up_save_btn btn blue_btn'><?php echo $l->up_save; ?></div>
						<div class='thumb_status w-100'>
							<div class='save_error blue  save_error_saved  hide'>		<?php echo $l->up_save_alert1; ?></div>
							<div class='save_error error save_error hide'>					<?php echo $l->up_save_alert2; ?></div>
							<div class='save_error error save_error_time  hide'>		<?php echo $l->up_save_alert3; ?></div>
							<div class='save_error error save_error_color hide'>		<?php echo $l->up_save_alert4; ?></div>
							<div class='save_error error save_error_color2  hide'>	<?php echo $l->up_save_alert5; ?></div>
							<div class='save_error error save_error_save  hide'>		<?php echo $l->up_save_alert6; ?></div>
						</div>


								<div style="clear:both;"></div>
						</div>
					</div>

		</div>
		<div class='col-lg-2 col-xl-2 col-spl'> </div>
	</div>


		<script>


		/*function getUrlVars(url){
			var vars = {};
			var parts = url.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
			vars[key] = value;
			});
			return vars;
		}*/


	//sync
		$('.video_title_input').keyup(function()						{ $('.thumb_video_title a').html($(this).val()); $('.thumb_video_title a').attr('title',$(this).val()); });
		$('.video_title_input').click(function()						{ $('.thumb_video_title a').html($(this).val()); $('.thumb_video_title a').attr('title',$(this).val()); });
		$('.video_title_input').change(function()						{ $('.thumb_video_title a').html($(this).val()); $('.thumb_video_title a').attr('title',$(this).val()); });
		$('.video_title_input').on('paste drop', function()	{ $('.thumb_video_title a').html($(this).val()); $('.thumb_video_title a').attr('title',$(this).val()); });
		$('.video_title_input').on('cut', function()			 	{ $('.thumb_video_title a').html($(this).val()); $('.thumb_video_title a').attr('title',$(this).val()); });

		$('.video_info_input').keyup(function()							{ $('.thumb_video_info_txt').html($(this).html()); });
		$('.video_info_input').click(function()							{ $('.thumb_video_info_txt').html($(this).html()); });
		$('.video_info_input').change(function()						{ $('.thumb_video_info_txt').html($(this).html()); });
		$('.video_info_input').on('paste drop', function()	{ $('.thumb_video_info_txt').html($(this).html()); });
		$('.video_info_input').on('cut', function()			 		{ $('.thumb_video_info_txt').html($(this).html()); });



	//priv
	$('.priv_btn').unbind('click').click(function(){
		$('.priv_btn').removeClass('activ');
		$(this).addClass('activ');

		var priv = $(this).attr('priv');
		$('.video_privacy').attr('priv',priv);
		if(priv == "planed"){
			$('.time_input').removeClass('hide');
		}else{
			$('.time_input').addClass('hide');
		}
	});

		//time now
		var t_date   = '<?php echo strtotime(date('Y-m-d H:i')); ?>';
    var t_date_c = '<?php echo $time24h; ?>';


		//time input
		$('.time_day_dropdown li').unbind('click').click(function(){
			var d = $(this).html(); 		$('.time_day_dropdown_label').html(d);
			var dd = $(this).attr('d'); $('.time_day_dropdown_label').attr('data',dd);
			checktime();
		});

		$('.time_month_dropdown li').unbind('click').click(function(){
			var d = $(this).html(); 		$('.time_month_dropdown_label').html(d);
			var dd = $(this).attr('d'); $('.time_month_dropdown_label').attr('data',dd);
			checktime();
		});

		$('.time_year_dropdown li').unbind('click').click(function(){
			var d = $(this).html(); 		$('.time_year_dropdown_label').html(d);
			var dd = $(this).attr('d'); $('.time_year_dropdown_label').attr('data',dd);
			checktime();
		});


		$('.time_hour_dropdown li').unbind('click').click(function(){
			var d = $(this).html(); 		$('.time_hour_dropdown_label').html(d);
			var dd = $(this).attr('d'); $('.time_hour_dropdown_label').attr('data',dd);
			checktime();
		});

		$('.time_min_dropdown li').unbind('click').click(function(){
			var d = $(this).html(); 		$('.time_min_dropdown_label').html(d);
			var dd = $(this).attr('d'); $('.time_min_dropdown_label').attr('data',dd);
			checktime();
		});


		function checktime(){
			var day = $('.time_day_dropdown_label').attr('data');
			var month = $('.time_month_dropdown_label').attr('data');
			var year = $('.time_year_dropdown_label').attr('data');

			var hour = $('.time_hour_dropdown_label').attr('data');
			var min  = $('.time_min_dropdown_label').attr('data');

			var intime = new Date(year+"."+month+"."+day+" "+hour+":"+min).getTime()/1000;
			$('.time_input').attr('time',intime);

			$('.dropdown-toggle').removeClass('error'); $('.date_error').addClass('hide');

			if(intime < t_date){
				$('.time_day_dropdown_btn').addClass('error'); $('.time_month_dropdown_btn').addClass('error'); $('.time_year_dropdown_btn').addClass('error'); $('.time_hour_dropdown_btn').addClass('error'); $('.time_min_dropdown_btn').addClass('error');
				$('.date_error_time').removeClass('hide');
			}

			if( day == '31' && ( month == '2' || month == '4' || month == '6' || month == '9' || month == '11' )){
				$('.time_day_dropdown_btn').addClass('error'); $('.time_month_dropdown_btn').addClass('error');
				$('.date_error_time').addClass('hide'); $('.date_error_date').removeClass('hide');
			}

			if(day == '30' && month == '2'){
				$('.time_day_dropdown_btn').addClass('error'); $('.time_month_dropdown_btn').addClass('error');
				$('.date_error_time').addClass('hide'); $('.date_error_date').removeClass('hide');
			}

			if( day == '29' && month == '2' && year % 4 != 0){
				$('.time_day_dropdown_btn').addClass('error'); $('.time_month_dropdown_btn').addClass('error'); $('.time_year_dropdown_btn').addClass('error');
				$('.date_error_time').addClass('hide'); $('.date_error_date').removeClass('hide');
			}

			if(intime == "NaN"){
				$('.time_day_dropdown_btn').addClass('error'); $('.time_month_dropdown_btn').addClass('error'); $('.time_year_dropdown_btn').addClass('error'); $('.time_hour_dropdown_btn').addClass('error'); $('.time_min_dropdown_btn').addClass('error');
				$('.date_error_time').addClass('hide'); $('.date_error_ie').removeClass('hide');
			}
		}




	//beschreibung text
		$('.video_info_input').unbind('click').click(function(){
		  $(this).addClass('info_in_focus');
		});

		$(document).mouseup(function (e){
		    var container = $('.video_info_input');
		    if (!container.is(e.target) && container.has(e.target).length === 0){
		      if($('.info_in_focus').html() == "<br>"){
		        $('.info_in_focus').html('');
		      }
		      $('.video_info_input').removeClass('info_in_focus');
		    }
		});


    $editables = $('[contenteditable=true]');

    $editables.filter("p,span").on('keypress',function(e){
     if(e.keyCode==13){ //enter und shift

      e.preventDefault();
      if (window.getSelection) {
          var selection = window.getSelection(),
              range = selection.getRangeAt(0),
              br = document.createElement("br"),
              textNode = document.createTextNode("\u00a0"); //Passing " " directly will not end up being shown correctly
          range.deleteContents();
          range.insertNode(br);
          range.collapse(false);
          range.insertNode(textNode);
          range.selectNodeContents(textNode);

          selection.removeAllRanges();
          selection.addRange(range);
          return false;
      }

       }
    });


		$("[contenteditable=true]").unbind("paste drop").on('paste drop', function(e) { //gegen chrom copy paste mit class attr. (Warum auch immer).
		  e.preventDefault();
		  var text = null;
		  text = (e.originalEvent || e).clipboardData.getData('text/plain') || prompt('Paste Your Text Here');
		  document.execCommand("insertText", false, text);
		});




	//dropdowns

		$('.cat_dropdown_select').unbind('click').click(function(){
			var cat = $(this).attr('cat');
			var cont = $(this).attr('cont');
			$('.cat_dropdown_label').html($(this).html());
			$('.cat_dropdown_label').attr('cat',cat);
			$('.pre_cat').html(cont);
			$('.pre_cat').attr('cat',cat);
		});

		$('.lang_dropdown_select').unbind('click').click(function(){
			var lang = $(this).attr('lang');
			var cont = $(this).attr('cont');
			$('.lang_dropdown_label').html($(this).html());
			$('.lang_dropdown_label').attr('lang',lang);
			$('.pre_lang').html(cont);
			$('.pre_lang').attr('lang',lang);
		});

		$('.color_dropdown_select').unbind('click').click(function(){
			var color = $(this).attr('color');
			var color2 = $(this).attr('color2');
			$('.color_dropdown_label').html($(this).html());
			$('.color_dropdown_label').attr('color',color);
			$('.color_dropdown_label').attr('color2',color2);
			$('.thumb-info').css("background-color", color);
			$('.thumb-info').css("color", color2);
			$('.thumb-info p').css("color", color2);
			$('.thumb-info').attr('color',color);
			$('.thumb-info').attr('color2',color2);
		});



			$("#thumb").change(function(){
				$('.thumb_error').addClass('hide');
						function readURL(input) {
									var reader = new FileReader();
									reader.onload = function (e) {
											$('.thumb_preview').attr('src', e.target.result);
											$('.video_pre_thumb').removeClass('hide');
											$('.video_pre_thumb_error').addClass('hide');
											$('#thumb').attr('thumb_up','ready');
									}
									reader.readAsDataURL(input.files[0]);
						}

				if (this.files && this.files[0]) {
					if(this.files[0].type == "image/jpeg" || this.files[0].type == "image/png"){
						$('.video_pre_thumb').addClass('hide');
						$('.video_pre_thumb_error').removeClass('hide');

						readURL(this);
					}else{
						$('.thumb_error_7').removeClass('hide');
					}
				}

			});

      //add to playlist
        setTimeout(function(){
          loadfun_playlists();
        },2);

        $('.addplaylist_op_btn').unbind('click').click(function(){
          $('.pm_container_bg').removeClass('hide');
          $('.pm_pl_title').removeClass('hide');
          $('.pm_pl_container').removeClass('hide');
          $('.body').addClass('stop_srolling');
        });


        //alle schliessen
          $('.pm_close_btn').unbind('click').click(function(){
            $('.pm_to_hide').addClass('hide');
            $('.body').removeClass('stop_srolling');
          });

        $(document).mouseup(function (e){
          var container = $('.pm_container');
          if (!container.is(e.target) && container.has(e.target).length === 0){
            $('.pm_to_hide').addClass('hide');
            $('.body').removeClass('stop_srolling');
          }
        });

        //playlist add and remove
        function loadfun_playlists(){
          $('.pl_add_list_line').unbind('click').click(function(){
            var puid = $(this).attr('pl');
            $.post('<?php echo $_dhp;?>playlists/add',{'vuid': '<?php echo $vuid;?>', 'puid': puid, 'move': 'add/remove'}, function(data) {
              if(data == 'add'){
                $('.pl_'+puid).addClass('pl_add_list_line_selectet');
                $('.pl_'+puid+' .glyphicon').removeClass('glyphicon-plus');
                $('.pl_'+puid+' .glyphicon').addClass('glyphicon-ok');
              }else if(data == 'remove'){
                $('.pl_'+puid).removeClass('pl_add_list_line_selectet');
                $('.pl_'+puid+' .glyphicon').removeClass('glyphicon-ok');
                $('.pl_'+puid+' .glyphicon').addClass('glyphicon-plus');
              }else{
                $('.pm_add_pl_error').removeClass('hide');
              }
            });
          });
        }

        //new playlist
          $('.pm_new_pl_btn').unbind('click').click(function(){
            var pl_name = $('.pm_new_pl').val();
            var priv = $('.pm_new_pl').attr('pl_privacy');
            $.post('<?php echo $_dhp;?>playlists/add',{'vuid': '<?php echo $vuid;?>','move': 'new', 'priv': priv, 'pl_name': pl_name}, function(data) {
              if(data != "error" || data != ""){
                $('.pm_pl_container').find('.pm_scroll_container').html(data+""+$('.pm_pl_container').find('.pm_scroll_container').html());
                loadfun_playlists();

                //set default
                  $('.pm_new_pl').val('');
                  $('.pm_new_pl').attr('pl_privacy','privat');
                  $('.priv_btn').removeClass('activ');
                  $('.priv_btn_sel').addClass('activ');
              }else{
                $('.pm_new_pl_error').removeClass('hide');
              }
            });
          });

      //end add to playlist

			//save settings
			$('.up_save_btn').unbind('click').click(function(){
				up_save();
			});

			function up_save(){
				$('.thumb_error').addClass('hide');
				$('.save_error').addClass('hide');
				$('.save_error_saved').addClass('hide');
				var saved = 0;

				if (document.getElementById("thumb").files && document.getElementById("thumb").files[0] || $('#thumb').attr('thumb_up') == 'ready') {
						var file =  document.getElementById("thumb").files[0];
						//alert(file.name+" | "+file.size+" | "+file.type);
						var formdata = new FormData();
						formdata.append("thumb", file);
						var ajax = new XMLHttpRequest();
						ajax.addEventListener("load", thumbcompleteHandler, false);
						ajax.open("POST", "../../upload/save_thumb?vuid=<?php echo $vuid; ?>");
						ajax.send(formdata);

						function thumbcompleteHandler(event) {

							var data = event.target.responseText;
							if(data == "1"){
								$('.thumb_error_1').removeClass('hide');
								$('#thumb').attr('thumb_up','uploaded');

								saved++;
								if(saved == 2){
									//mach was
								}

							}else if(data == "2"){
								$('.thumb_error_2').removeClass('hide');
							}else if(data == "3"){
								$('.thumb_error_3').removeClass('hide');
							}else if(data == "5"){
								$('.thumb_error_5').removeClass('hide');
							}else if(data == "7"){
								$('.thumb_error_7').removeClass('hide');
							}
						}
				}else{
					saved = 1;
					$('.thumb_error_1').addClass('hide');
				}

				var title 	= $('.video_title_input').val();
				var info 		= $('.video_info_input').html();
				var privacy = $('.video_privacy').attr('priv');
				var time 		= $('.time_input').attr('time');
				var cat 		= $('.cat_dropdown_label').attr('cat');
				var lang 		= $('.lang_dropdown_label').attr('lang');
				var color 	= $('.color_dropdown_label').attr('color');
				var color2 	= $('.color_dropdown_label').attr('color2');
				var tags 		= $('.video_tag_input').val();

				$.post('../../upload/save',{'vuid':'<?php echo $vuid;?>', 'title':title, 'info':info, 'tags':tags, 'privacy':privacy, 'time':time, 'cat':cat, 'lang':lang, 'color':color, 'color2':color2},function(data){
					if(data == "saved"){

							$('.save_error_saved').removeClass('hide');

						saved++;
						if(saved == 2){
							//do something
						}
					}else if(data == "error"){
						$('.save_error').removeClass('hide');
					}else if(data == "error_time"){
						$('.save_error_time').removeClass('hide');
					}else if(data == "error_color"){
						$('.save_error_color').removeClass('hide');
					}else if(data == "error_color2"){
						$('.save_error_color2').removeClass('hide');
					}else if(data == "error_save"){
						$('.save_error_save').removeClass('hide');
					}
				});

			}

		</script>

	</div>

<?php
 if($infram != 1){?>
		</div>

	</body>
</html>

<?php }


}else{//if logged in
Header('Location: '.$_dhp.'');
}
?>
