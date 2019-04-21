<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = "../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include


//3. site vals
$html_title = $l->partner_title." | We-TeVe"; //Tap title


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
              <a href='../partner/dashboard' class='opt_a opt_activ'> <?php echo $l->part_menu_title_1; ?> </a>
              <a href='../partner/options' class='opt_a'> <?php echo $l->part_menu_title_2; ?> </a>
						</div>


						<div class='col-lg-10 col-xl-10'>
							<div class='option_content option_holder pad-bot-15'>

                <div class='col-md-12 col-lg-8 col-xl-8 col-spl'>
                  <h3 class='part_title'><?php echo $l->part_title_1; ?>:</h3>
                  <?php
                    $item_per_page = 12;

                    $user_ver_uuid = $u->userin('uuid',1,'this','');
                    $user_uuif = sha1(sha1($user_uuid));
                    $key = $u->userin('key',0,$user_uuif,'');
                    $key2 = $u->userin('key2',0,$user_uuif,'');
                    $status_ok_ver = $ver->ver('ok',$key,$key2);

                    $payments_results = db::$link->query("SELECT COUNT(payment_id) FROM payments_db WHERE uuid = '$user_ver_uuid' AND status = '$status_ok_ver'");
                    if($payments_results){
                      $get_total_rows = $payments_results->fetch_row();
                      $get_total_rows = $get_total_rows[0];
                      $allpayments  = $get_total_rows;
                      $allpayments  = number_format($allpayments,0, ",", ".");
                      $total_pages = ceil($get_total_rows/$item_per_page);
                    }

                    if($allpayments != 0){
                      ?>
                      <div id="results">
                        <?php
                        $page_number = 0;
                        require_once ($_hp."partner/payments.php");
                        ?>
                      </div>
                        <div align="center">
                        <button class="load_more w-100 marg-l-15 blue_btn btn-default btn" id="load_more_button" <?php if($allpayments <= $item_per_page){echo "disabled='disabled'";}else{} ?> ><?php echo $l->loadmore; ?></button>
                        <div class="animation_image" style="display:none;"><img src="<?php echo $_dhp; ?>images/icons/ajax-loader.gif"> <?php echo $l->loading; ?></div>
                        </div>

                        <script>
                          $(document).ready(function() {

                            var track_click = 1;
                            var total_pages = <?php echo $total_pages; ?>;

                            $(".load_more").click(function (e) {
                              $(this).hide();
                              $('.animation_image').show();

                                if(track_click <= total_pages)
                                {
                                  $.post('<?php echo $_dhp; ?>partner/payments', {'page': track_click}, function(data) {
                                    $(".load_more").show();
                                    $("#results").append(data);

                                    $('.animation_image').hide();
                                    track_click++; resultloadedforthumbpreview();

                                  });

                                  if(track_click >= total_pages-1)
                                  {
                                    $(".load_more").attr("disabled", "disabled");
                                    $(".load_more").addClass('hide');
                                  }

                                 } //end track_click <= total_pages
                              }); //end load more function
                          }); //end document load
                        </script>
                    <?php
                      }else{
                        //noch keine ausbezahleten Zahlungen
                        echo $l->part_no_payments;
                      }
                  ?>

                </div>

                <div class='col-md-12 col-lg-4 col-xl-4 col-spl'>
                  <h3 class='part_title'><?php echo $l->part_title_2_3; ?>:</h3>

                  <?php
                    echo "<div class='pending_payments_results'>";
                      echo "<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>";
                    echo "</div>";
                  ?>

                  <script>
                    $(document).ready(function() {
                      $.post('<?php echo $_dhp; ?>partner/pending_payments', function(data) {
                        $('.pending_payments_results').html(data);
                      });
                    });
                  </script>

                </div>

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
