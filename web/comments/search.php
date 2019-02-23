<?php


if(!isset($com_video_vuid) AND !isset($com_cuid) AND !isset($search_val)){

    //1. Pfad zum Stammverzeichniss wo sich die index befindet

    $_hp = '../'; //für include
    $_dhp = '../'; // für daten

    //2. all include
    $in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
    require_once ($_hp.'include/all_include.php'); //haupt includ

}


//rechnet wie viele Seiten angezeigt werden solllen.
$get_total_rows = 0;
$get_total_rows_d = 0;
$total_pages = 0;
$item_per_page = 20;


if(isset($_POST['vuid'])){$com_video_vuid = $_POST['vuid'];}
elseif(isset($com_video_vuid)){$com_video_vuid = $com_video_vuid;}
else{$com_video_vuid = "!";}  $com_video_vuid = mysqli_real_escape_string(db::$link,$com_video_vuid);

if(isset($_POST['cuid']) AND $_POST['cuid'] != ""){$com_cuid = $_POST['cuid'];}
elseif(isset($com_cuid) AND $com_cuid != ""){$com_cuid = $com_cuid;}
else{$com_cuid = '!';}  $com_cuid = mysqli_real_escape_string(db::$link,$com_cuid);


if(isset($_POST['search_val'])){
  $search_val = $_POST['search_val'];
}elseif(isset($search_val)){
  $search_val = $search_val;
}else{
  $search_val = 0;
}

$search_val_encode = urldecode($search_val);
$search_val = urldecode($search_val); $search_val2 = mysqli_real_escape_string(db::$link,$search_val);



  if($com_video_vuid == ""){
    $com_video_vuid = "!";
  }
  if($com_cuid == ""){
    $com_cuid = "!";
  }


  $c_results = db::$link->query("SELECT COUNT(kuid) FROM kommentar_db WHERE (vuid = '$com_video_vuid' OR cuid = '$com_cuid') AND kommentar LIKE '%$search_val2%' AND status = 'public'");

  if($c_results){
    $get_total_rows   = $c_results->fetch_row();
    $get_total_rows_d = $get_total_rows[0];
    $get_total_rows   = number_format($get_total_rows_d,0, ",", ".");
    $total_pages      = ceil($get_total_rows_d/$item_per_page);
  }

  $search_val3 = htmlentities($search_val, ENT_QUOTES);


  echo "<h4>".$l->com_sort_title12." \"".$search_val3."\" (".$get_total_rows.")</h4>";

  echo "<div class='answ_new_com_blac'></div>";

    echo "<div class='new_coms'>";
      $page = 0;
      require_once('search_coms.php');
      echo "<script> loadfun_falseLink(); </script>";
    echo"</div>";

  echo "<div class='float_line'>Float</div>";

  if($isUserLoggedIn === 1) {
    //add Ach
      $ach->add_ach('203','',$user_uuid);
  }

  if($total_pages > 1){
      echo "
        <div class='load_more_coms_result_btn blue_btn btn-default button' type='button'>
            <span class='load_more_text'>".$l->loadmore."</span>
            <span class='load_more_loading hide'><img src='".$_dhp."images/icons/ajax-loader.gif' alt='We-Teve'/> ".$l->loading."</span>
        </div>";
  }

  ?>

  <script>


    var track_clicked = 0;

    $(document).ready(function() {

      /*setTimeout(function(){
        loadfun_falseLink(); //die links müssen vor den kommentaren laden sonnst erkennt es den link an und nicht die zeitangebe zum skipen
        coms_loaded();
      },1);*/

      track_click = 1;

      total_pages = <?php echo $total_pages; ?>;
      $(".load_more_coms_result_btn").click(function() {

        if(track_clicked == 0){
          track_clicked = 1;
          set_track_clicked_load();

              $('.load_more_coms_result_btn .load_more_text').addClass('hide');
              $('.load_more_coms_result_btn .load_more_loading').removeClass('hide');
              if(track_click <= total_pages)
              {
                $.post('../comments/search_coms.php', {'vuid': '<?php echo $com_video_vuid; ?>','cuid': '<?php echo $com_cuid; ?>','search_val': '<?php echo $search_val_encode;?>', 'page': track_click}, function(data) {

                  setTimeout(function(){
                    loadfun_falseLink(); //die links müssen vor den kommentaren laden sonnst erkennt es den link an und nicht die zeitangebe zum skipen
                    coms_loaded();
                  },1);


                  $('.load_more_coms_result_btn .load_more_text').removeClass('hide');
                  $(".new_coms").append(data);
                  $('.load_more_coms_result_btn .load_more_loading').addClass('hide');
                  track_click++;

                });

                if(track_click >= total_pages-1)
                {
                  $(this).addClass('hide');
                }
               }
        }

      });

      function set_track_clicked_load(){
        setTimeout(function(){
          track_clicked = 0;
        },500);
      }

    });
  </script>
