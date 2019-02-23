<?php

if(isset($_POST['vuid']) OR isset($_POST['cuid'])){

    //1. Pfad zum Stammverzeichniss wo sich die index befindet

    $_hp = '../'; //für include
    $_dhp = '../'; // für daten

    //2. all include
    $in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
    require_once ($_hp.'include/all_include.php'); //haupt includ

}

if(isset($_POST['vuid'])){$com_video_vuid = $_POST['vuid'];}
elseif(isset($com_video_vuid)){$com_video_vuid = $com_video_vuid;}
else{$com_video_vuid = '!';}  $com_video_vuid = mysqli_real_escape_string(db::$link,$com_video_vuid);

if(isset($_POST['cuid']) AND $_POST['cuid'] != ""){$com_cuid = $_POST['cuid'];}
elseif(isset($com_cuid) AND $com_cuid != ""){$com_cuid = $com_cuid;}
else{$com_cuid = '!';}  $com_cuid = mysqli_real_escape_string(db::$link,$com_cuid);


if(isset($_POST['sort']) AND is_numeric($_POST['sort'])){$sort = $_POST['sort'];}
elseif(isset($sort)){$sort = $sort;}
else{$sort = 1;}


  if($com_video_vuid == ""){
    $com_video_vuid = "!";
  }
  if($com_cuid == ""){
    $com_cuid = "!";
  }



    //rechnet wie viele Seiten angezeigt werden solllen.
    $get_total_rows = 0;
    $get_total_rows_d = 0;
    $total_pages = 0;
    $item_per_page = 20;



  if($sort == 1 OR $sort == 2 OR $sort == 3 OR $sort == 4){

      //sort 1,2,3,4
      $c_results = db::$link->query("SELECT COUNT(kuid) FROM kommentar_db WHERE (vuid = '$com_video_vuid' OR cuid = '$com_cuid') AND status = 'public'");

      if($c_results){
        $get_total_rows   = $c_results->fetch_row();
        $get_total_rows_d = $get_total_rows[0];
        $get_total_rows   = number_format($get_total_rows_d,0, ",", ".");
      }

      //for page
      $c_results = db::$link->query("SELECT COUNT(kuid) FROM kommentar_db WHERE (vuid = '$com_video_vuid' OR cuid = '$com_cuid') AND re_kuid = '' AND status = 'public'");

      if($c_results){
        $get_total_pages   = $c_results->fetch_row();
        $get_total_pages = $get_total_pages[0];
        $total_pages = ceil($get_total_pages/$item_per_page);
      }


  }elseif($sort == 5){

      //sort 5
      $sql_results = db::$link->query("SELECT kuid FROM kommentar_db WHERE (vuid = '$com_video_vuid' OR cuid = '$com_cuid')  AND re_kuid = '' AND status = 'public'");

      while ($erg_results = $sql_results->fetch_array())
      {
        $result_id = $erg_results['kuid'];

        $kommentar_sql = db::$link->query("SELECT kuid FROM kommentar_db WHERE re_kuid = '$result_id'");
        $kommentar_sql = $kommentar_sql->fetch_assoc(); //gibt nur ein ergebniss raus!
        $kommentar_erg = $kommentar_sql['kuid'];

        if($kommentar_erg == ""){
          $get_total_rows_d++;
        }
      }
      $get_total_rows = number_format($get_total_rows_d,0, ",", ".");
      $total_pages = ceil($get_total_rows_d/$item_per_page);

  }elseif($sort == 6){

      //sort 6
      $sql_results = db::$link->query("SELECT kuid FROM kommentar_db WHERE (vuid = '$com_video_vuid' OR cuid = '$com_cuid') AND re_kuid = '' AND status = 'public'");

      while ($erg_results = $sql_results->fetch_array())
      {
        $result_id = $erg_results['kuid'];

        $kommentar_sql = db::$link->query("SELECT kuid FROM kommentar_db WHERE re_kuid = '$result_id'");
        $kommentar_sql = $kommentar_sql->fetch_assoc(); //gibt nur ein ergebniss raus!
        $kommentar_erg = $kommentar_sql['kuid'];

        if($kommentar_erg != ""){
          $get_total_rows_d++;
        }
      }
      $get_total_rows = number_format($get_total_rows_d,0, ",", ".");
      $total_pages = ceil($get_total_rows_d/$item_per_page);


  }elseif($sort == 7){

      //sort 7
      $c_results = db::$link->query("SELECT COUNT(kuid) FROM kommentar_db WHERE (vuid = '$com_video_vuid' OR cuid = '$com_cuid') AND added_video != '' AND status = 'public'");

      if($c_results){
        $get_total_rows = $c_results->fetch_row();
        $get_total_rows_d = $get_total_rows[0];
        $get_total_rows = number_format($get_total_rows_d,0, ",", ".");
        $total_pages = ceil($get_total_rows_d/$item_per_page);
      }


  }elseif($sort == 8 AND $isUserLoggedIn === 1){

      //sort 8 Kommentare von Freunden

      //Freundes Datenbank muss noch auf uuid geupdatet werden
      $results = db::$link->query(" SELECT COUNT(kuid) FROM kommentar_db INNER JOIN friend_db ON friend_db.second_uuid = kommentar_db.uuid
      WHERE (kommentar_db.vuid = '$com_video_vuid' OR kommentar_db.cuid = '$com_cuid') AND friend_db.first_uuid = '$user_uuid' AND friend_db.status = 'confirmed' AND kommentar_db.status = 'public'") ;
      if($results){
        $get_total_rows = $results->fetch_row();
        $get_total_rows_d = $get_total_rows[0];
        $get_total_rows = number_format($get_total_rows_d,0, ",", ".");
        $total_pages = ceil($get_total_rows_d/$item_per_page);
      }


  }elseif($sort == 9 AND $isUserLoggedIn === 1){

      //sort 9
      $c_results = db::$link->query("SELECT COUNT(kuid) FROM kommentar_db WHERE (vuid = '$com_video_vuid' OR cuid = '$com_cuid') AND uuid = '$user_uuid' AND status = 'public'");

      if($c_results){
        $get_total_rows = $c_results->fetch_row();
        $get_total_rows_d = $get_total_rows[0];
        $get_total_rows = number_format($get_total_rows_d,0, ",", ".");
        $total_pages = ceil($get_total_rows_d/$item_per_page);
      }


  }elseif($sort == 10 OR $sort == 11){

      //sort 10 / 11
        $get_total_rows = 1;
        $total_pages = 1;


  }




  if($sort == 1){
      $top_com_sql = db::$link->query("SELECT kuid FROM kommentar_db WHERE (vuid = '$com_video_vuid' OR cuid = '$com_cuid') AND re_kuid = '' AND status = 'public' AND (pos_vote - neg_vote) >= '2' ORDER BY time DESC,(pos_vote - neg_vote) DESC LIMIT 2");
      $top_com_c = 0;
      while($row = $top_com_sql->fetch_array()){
          $top_com_c++;
          if($top_com_c == 1){ echo "<h4>".$l->com_top_title."</h4>"; }

          $kuid = $row['kuid'];
          echo $com->draw_comment($kuid,1,0,1,$_dhp);
      }
  }

  echo "<h4>".$l->com_all_title." (".$get_total_rows.")</h4>";

  echo "<div class='answ_new_com_blac'></div>";

    echo "<div class='new_coms'>";
      $page = 0;
      require_once('first_level_coms.php');
      echo "<script> loadfun_falseLink(); </script>";
    echo"</div>";

  echo "<div class='float_line'>Float</div>";



  //$total_pages = 2;

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
                $.post('../comments/first_level_coms', {'vuid': '<?php echo $com_video_vuid; ?>','cuid': '<?php echo $com_cuid; ?>','sort': '<?php echo $sort;?>', 'page': track_click}, function(data) {



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
