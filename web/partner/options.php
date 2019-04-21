<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = "../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include


//3. site vals
$html_title = $l->part_menu_title_2_2." | We-TeVe"; //Tap title


if($isUserLoggedIn === 1){

  $partner_sql = db::$link->query("SELECT partner_status FROM user_find_db WHERE uuid = '$user_uuid'");
  $partner_row = $partner_sql->fetch_assoc();
  $partner_status = $partner_row['partner_status'];
  if($partner_status > 0){

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
<?php	}?>

		<span id='site_scripts'>

			

      <script src='<?php echo $_dhp;?>js/sha256.js'></script>
			<script>

				var playlist_id = 'not_set';

				$(document).ready(function() {
					docready();
					sethtmltitle('<?php echo $html_title; ?>');
				});

			</script>
		</span>

			<div class='row'>
				<div class='col-lg-2 col-xl-2 col-spl'> </div>
				<div class=' col-lg-8 col-xl-8 col-spl'>
						<div class='option_holder option_navi col-lg-2 col-xl-2 col-spl'>
              <h3><?php echo $l->part_menu_title_0; ?>:</h3>
              <a href='../partner/dashboard' class='opt_a'> <?php echo $l->part_menu_title_1; ?> </a>
              <a href='../partner/options' class='opt_a opt_activ'> <?php echo $l->part_menu_title_2; ?> </a>
						</div>


						<div class='col-lg-10 col-xl-10'>
							<div class='option_content option_holder pad-bot-15'>

                <div class='col-md-12 col-lg-8 col-xl-8 col-spl'>
                  <h3><?php echo $l->part_menu_title_2_2; ?>:</h3>
                  <?php
                  echo "<h2>".$l->part_payment_opt_title."</h2>";
                  echo "<i class='marg-top-0 marg-bot-15 left'>".$l->part_payment_opt_text."</i>";

                  echo "<br/><div class='radiobtn'>
                    <label><input class='part_payment_btn part_payment_btn1 radio-inline' checked='' name='payments_meth' type='radio'>".$l->part_payment_infos_title1."</label>
                  </div>";
                    echo "<div class='part_payment_box1'>
                        <input type='text' class='monero_adress pay_in_form form-control' placeholder='".$l->part_payment_infos_text1."'/>

                      </div>
                    ";

                  echo "<br/><div class='radiobtn'>
                    <label><input class='part_payment_btn part_payment_btn2 radio-inline' name='payments_meth' type='radio'>".$l->part_payment_infos_title2."</label>
                  </div>";
                    echo "<div class='part_payment_box2 hide'>
                        <input type='text' class='paypal_adress pay_in_form form-control' placeholder='".$l->part_payment_infos_text2."'/>

                      </div>
                    ";


                  echo "<br/><div class='radiobtn'>
                    <label><input class='part_payment_btn part_payment_btn3 radio-inline' name='payments_meth' type='radio'>".$l->part_payment_infos_title3."</label>
                  </div>";
                    echo "<div class='part_payment_box3 hide'>
                        <input type='text' class='bank_adress pay_in_form form-control' placeholder='".$l->part_payment_infos_text3."'/>
                        <input type='text' class='bank_adress_name pay_in_form form-control marg-top-5' placeholder='".$l->part_payment_infos_text3_1."'/>
                      </div>
                    ";
                  echo "<br/>";

                  echo "<div class='b_error blue part_saved hide'>".$l->part_payment_saved."</div>";
                  echo "<div class='error part_error hide'>".$l->part_payment_error."</div>";
                  echo "<div class='error part_error1 hide'>".$l->part_payment_error1."</div>";
                  echo "<div class='error part_error2 hide'>".$l->part_payment_error2."</div>";
                  echo "<div class='error part_error3 hide'>".$l->part_payment_error3."</div>";
                  ?>
                  <div class='marg-top-5'> <div class='opt_linetitle'> <?php echo $l->opt_acctitle_10; ?>: </div> </div>
                    <div class=''>
                      <input type='password' class='form-control pay_in_form' id='pw_to_save' placeholder='<?php echo $l->regin_title_4; ?>'>
                      <div class='error error_texts marg-top-5 marg-bot-10'  id='pw_to_save_error'></div>
                    </div>
                  <?php
                  echo "<div class='part_go_partner_btn part_gray_btn marg-top-15 part_save_opt_btn'>".$l->save."</div>";
                  ?>
                </div>

                  <script>
                  $('.part_payment_btn1').click( function(){
                    $('.part_payment_box1').removeClass('hide');
                    $('.part_payment_box2').addClass('hide');
                    $('.part_payment_box3').addClass('hide');
                      if($('.part_payment_btn1').is(':checked')) {
                        if($('.monero_adress').val().length > 0){
                          $('.part_save_opt_btn').removeClass('part_gray_btn');
                        }else{
                          $('.part_save_opt_btn').addClass('part_gray_btn');
                        }
                      }
                  });

                  $('.part_payment_btn2').click( function(){
                    $('.part_payment_box2').removeClass('hide');
                    $('.part_payment_box1').addClass('hide');
                    $('.part_payment_box3').addClass('hide');
                      if($('.part_payment_btn2').is(':checked')) {
                        if($('.paypal_adress').val().length > 0){
                          $('.part_save_opt_btn').removeClass('part_gray_btn');
                        }else{
                          $('.part_save_opt_btn').addClass('part_gray_btn');
                        }
                      }
                  });

                  $('.part_payment_btn3').click( function(){
                    $('.part_payment_box3').removeClass('hide');
                    $('.part_payment_box1').addClass('hide');
                    $('.part_payment_box2').addClass('hide');
                      if($('.part_payment_btn3').is(':checked')) {
                        if($('.bank_adress').val().length > 0 && $('.bank_adress_name').val().length > 0){
                          $('.part_save_opt_btn').removeClass('part_gray_btn');
                        }else{
                          $('.part_save_opt_btn').addClass('part_gray_btn');
                        }
                      }
                  });

                    $('.pay_in_form').keyup(function() { 						test_pay_embty(); });
                    $('.pay_in_form').click(function() { 						test_pay_embty(); });
                    $('.pay_in_form').change(function() { 					test_pay_embty(); });
                    $('.pay_in_form').on('paste drop', function() { test_pay_embty(); });
                    $('.pay_in_form').on('cut', function() { 				test_pay_embty(); });

                    function test_pay_embty(){

                      if($('.part_payment_btn1').is(':checked')) {
                        if($('.monero_adress').val().length > 0 && $('#pw_to_save').val().length > 0){
                          $('.part_save_opt_btn').removeClass('part_gray_btn');
                        }else{
                          $('.part_save_opt_btn').addClass('part_gray_btn');
                        }
                      }

                      if($('.part_payment_btn2').is(':checked')) {
                        if($('.paypal_adress').val().length > 0 && $('#pw_to_save').val().length > 0){
                          $('.part_save_opt_btn').removeClass('part_gray_btn');
                        }else{
                          $('.part_save_opt_btn').addClass('part_gray_btn');
                        }
                      }

                      if($('.part_payment_btn3').is(':checked')) {
                        if($('.bank_adress').val().length > 0 && $('.bank_adress_name').val().length > 0 && $('#pw_to_save').val().length > 0){
                          $('.part_save_opt_btn').removeClass('part_gray_btn');
                        }else{
                          $('.part_save_opt_btn').addClass('part_gray_btn');
                        }
                      }

                      $('.error, .b_error').addClass('hide');

                    }


                    $('.part_save_opt_btn').click( function(){
											// final insert
											if($('.part_payment_btn1').is(':checked')) {
												var payment_info = $('.monero_adress').val();
												var payment_info_name = "";
												var payment_meth = "monero";
											}
											if($('.part_payment_btn2').is(':checked')) {
												var payment_info = $('.paypal_adress').val();
												var payment_info_name = "";
												var payment_meth = "paypal";
											}
											if($('.part_payment_btn3').is(':checked')) {
												var payment_info = $('.bank_adress').val();
												var payment_info_name = $('.bank_adress_name').val();
												var payment_meth = "iban";
											}

                      var pwd = sha256($('#pw_to_save').val());
											payment_info = payment_info.replace(/[\u00A0-\u9999<>\&]/gim, function(i) { return '&#'+i.charCodeAt(0)+';'; });
											payment_info_name = payment_info_name.replace(/[\u00A0-\u9999<>\&]/gim, function(i) { return '&#'+i.charCodeAt(0)+';'; });

											$.post('../partner/save_options',{'payment_info': payment_info, 'payment_info_name': payment_info_name, 'payment_meth': payment_meth, 'pwd': pwd },function(data){
												if(data == "ok"){
													$('.part_saved').removeClass('hide');
												}else if(data == "error1"){
													$('.part_error1').removeClass('hide');
												}else if(data == "error2"){
													$('.part_error2').removeClass('hide');
                        }else if(data == "error3"){
													$('.part_error3').removeClass('hide');
												}else{
													$('.part_error2').removeClass('hide');
												}

											});

										});
                  </script>

                  <div style="clear:both"> </div>
              </div>

            </div>
				</div>
				<div class='col-lg-2 col-xl-2 col-spl'> </div>
			</div>



<?php if($infram != 1){?>
		</div>

	</body>
</html>

<?php  }

}else{//if partner
    Header('Location: '.$_dhp.'r/go_partner');
  }

}else{//if logged in
	Header('Location: '.$_dhp.'login');
}
?>
