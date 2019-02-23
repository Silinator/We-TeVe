<?php
  if(!isset($cuid)){
    $com_cuid = '';
    $com_video_vuid = $video_vuid;
  }else{
    $com_video_vuid = '';
    $com_cuid = $cuid;
  }

  if($isUserLoggedIn === 1){

    $token = $f->settoken('com','blanc');
    $vote_token = $f->settoken('com_like','blanc');

    $user_avatar = $_dhp.$f->draw_avatar($user_uuid,"small");

    echo "<h4>".$l->com_new_title."</h4>";
      echo "<span class='com_i' tok='".$token."' vote_tok='".$vote_token."' vid='".$com_video_vuid."' channel='".$com_cuid."' ></span>";

      echo "<div class='new_com_avatar'><img alt='".$user_avatar."' src='".$user_avatar."'/></div>";
      echo "<div class='new_com_name'>".$user_name."</div>";
      echo "<div contentEditable='true' syn='new_com_blac' class='com_input new_com_text new_com_blac ph_empty' placeholder='".$l->com_new_placeholder."'></div>";
      echo "<div class='video_selecter vid_new_com_blac'></div>";
      echo "<div class='hide com_alert alert_new_com_blac'>".$l->com_alert_not_send."</div>";
      echo "<div class='hide com_alert alert2_new_com_blac'>".$l->com_alert_not_send2."</div>";

    echo "<div for_com='new_com_blac' vid='' mes='0' re='' class='com_send_btn com_enter'>
      <span class='com_send_text'>".$l->com_new_send_title."</span>
      <span class='com_send_loading hide'><img src='".$_dhp."images/icons/ajax-loader.gif' alt='We-Teve'/> ".$l->loading."</span>
    </div>";
  }


  echo "<div class='com_sort_line'>";
    echo "<div class='com_search_line'>";
      echo "<input class='com_search_in' placeholder='Suchen' type='text'/> <div class='com_search_sent button btn-default btn-x left blue_btn'><span class='glyphicon glyphicon-search' aria-hidden='true'></span></div>";
    echo "</div>";
    echo "<div class='com_filter_line'>";
      echo "<select class='com_filter_in'>";
            echo "<option class='com_filter' disabled='disabled' selected> ".$l->com_sort_title0." </option>";
            echo "<option for='v1'  class='com_filter filter_v1'  value='1'> ".$l->com_sort_title1." </option>";
            echo "<option for='v2'  class='com_filter filter_v2'  value='2'> ".$l->com_sort_title2." </option>";
            echo "<option for='v3'  class='com_filter filter_v3'  value='3'> ".$l->com_sort_title3." </option>";
            echo "<option for='v4'  class='com_filter filter_v4'  value='4'> ".$l->com_sort_title4." </option>";
            echo "<option for='v5'  class='com_filter filter_v5'  value='5'> ".$l->com_sort_title5." </option>";
            echo "<option for='v6'  class='com_filter filter_v6'  value='6'> ".$l->com_sort_title6." </option>";
            echo "<option for='v7'  class='com_filter filter_v7'  value='7'> ".$l->com_sort_title7." </option>";
            if($isUserLoggedIn === 1){echo "<option for='v8'  class='com_filter filter_v8'  value='8'> ".$l->com_sort_title8." </option>";}
            if($isUserLoggedIn === 1){echo "<option for='v9'  class='com_filter filter_v9'  value='9'> ".$l->com_sort_title9." </option>";}
            echo "<option for='v10' class='com_filter filter_v10' value='10'>".$l->com_sort_title10."</option>";

            echo "<optgroup class='com_filter_in_group_title com_filter hide' label='".$l->com_sort_title11_1.":'>";
            echo "</optgroup>";

            //die zum Kommentar Kommentare
      echo "</select>";
    echo "</div>";
  echo "</div>";


  if(isset($_GET['k']) AND $_GET['k'] != ""){
    $tocom = mysqli_real_escape_string(db::$link,$_GET['k']);
    echo "<script> var tocomkuid = '".$tocom."';</script>";
  }else{
    echo "<script> var tocomkuid = '0';</script>";
  }

  echo "<script>
    var com_linked;
    var com_linked_count = 0;
  </script>";


  echo "<div class='com_result_first_level'>";

      $sort = 1;
      $linked = "";
      require_once($_hp.'comments/first_level.php');

  echo "</div>";


?>


<script>


  $('.com_search_in').unbind('click').click(function(){
    $(this).addClass('com_in_focus');
  });

  var container = $('.com_search_in');
  $(document).mouseup(function (e){
    if (!container.is(e.target) && container.has(e.target).length === 0){
      $('.com_search_in').removeClass('com_in_focus');
    }
  });


  $('.com_search_in').unbind("keyup").keyup(function (e) {
      if (e.keyCode === 13) {
         comsearch();
      }
  });

  $('.com_search_sent').unbind("click").click(function(){
    comsearch();
  });


  function comsearch(){
    var search = $('.com_search_in').val();
    search = encodeURIComponent(search);

    if(search != "" && search != " "){
        $('.com_result_first_level').html("<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");
        $.post('../comments/search',{'vuid':'<?php echo $com_video_vuid; ?>', 'cuid':'<?php echo $com_cuid; ?>', 'search_val':search},function(data){
          $('.com_result_first_level').html(data);
            setTimeout(function(){
              loadfun_falseLink(); //die links müssen vor den kommentaren laden sonnst erkennt es den link an und nicht die zeitangebe zum skipen
              coms_loaded();
            },1);

            $('.filter_v1').prop('selected', true);
        });
    }else{
      backtoallcom();
    }
  }


  function backtoallcom(){
    $('.com_result_first_level').html("<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");
    $.post('../comments/first_level',{'vuid':'<?php echo $com_video_vuid; ?>', 'cuid':'<?php echo $com_cuid; ?>', 'sort':1},function(data){
      $('.com_result_first_level').html(data);
        setTimeout(function(){
          loadfun_falseLink(); //die links müssen vor den kommentaren laden sonnst erkennt es den link an und nicht die zeitangebe zum skipen
          coms_loaded();
        },1);

        $('.filter_v1').prop('selected', true);
    });
  }


  $('.com_filter_in').unbind("change").change(function(){
    var sort = $(this).find(":selected").val();
    $('.com_result_first_level').html("<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");

      if($(this).find(":selected").hasClass("tocomlink")){

        var kuid = $(this).find(":selected").attr('for');

        //für den twin im fullscreen
        var filter_for = $(this).find(":selected").attr('for');
        $('.filter_'+filter_for).prop('selected', true);

        $.post('../comments/tocom',{'kuid': kuid},function(data){
          $('.com_result_first_level').html(data);
            setTimeout(function(){
              loadfun_falseLink(); //die links müssen vor den kommentaren laden sonnst erkennt es den link an und nicht die zeitangebe zum skipen
              coms_loaded();

              $(".com_containe_"+kuid).find('.com_content').addClass('com_content_selected');

              $('.column3 .video_comments').animate({scrollTop: $(".column3 .video_comments .com_containe_"+kuid).offset().top }, 200);
              $('.video_full_info .video_comments').animate({scrollTop: $(".video_full_info .video_comments .com_containe_"+kuid).offset().top }, 200);

            },5);
        });

      }else{
         //für den twin im fullscreen
         var filter_for = $(this).find(":selected").attr('for');
         $('.filter_'+filter_for).prop('selected', true);

        $.post('../comments/first_level',{'vuid':'<?php echo $com_video_vuid; ?>', 'cuid':'<?php echo $com_cuid; ?>', 'sort':sort},function(data){
          $('.com_result_first_level').html(data);
            setTimeout(function(){
              loadfun_falseLink(); //die links müssen vor den kommentaren laden sonnst erkennt es den link an und nicht die zeitangebe zum skipen
              coms_loaded();
            },1);
        });
      }

  });

</script>
