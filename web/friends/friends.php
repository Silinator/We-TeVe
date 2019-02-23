<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = "../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include


$uuif = sha1(sha1($user_uuid));
$fri_c = $u->userin('friends',0,$uuif,'');
$max_fri_c = $u->userin('max_friends',0,$uuif,'');



$item_per_page = 20;

$get_total_rows = 0;
$results = db::$link->query("SELECT COUNT(friend_id) FROM friend_db WHERE first_uuid = '$user_uuid' AND status = 'confirmed'");
if($results){
  $get_total_rows = $results->fetch_row();
}
$total_pages = ceil($get_total_rows[0]/$item_per_page);


echo "<div class='friend_dropdown_content'>";

  //error and alerts
  echo "<div class='w-100 left marg-bot-5'>";
    echo "<div class='blue friend_return_1 fr_to_hide hide'>".$l->friend_text_1."</div>";
    echo "<div class='blue friend_return_2 fr_to_hide hide'>".$l->friend_text_2."</div>";
    echo "<div class='blue friend_return_3 fr_to_hide hide'>".$l->friend_text_3."</div>";
    echo "<div class='blue friend_return_4 fr_to_hide hide'>".$l->friend_text_4."</div>";
    echo "<div class='blue friend_return_5 fr_to_hide hide'>".$l->friend_text_5."</div>";
    echo "<div class='red  friend_return_6 fr_to_hide hide'>".$l->friend_text_6."</div>";
    echo "<div class='red  friend_return_7 fr_to_hide hide'>".$l->friend_text_7."</div>";
    echo "<div class='blue friend_return_8 fr_to_hide hide'>".$l->block_friend_title_1."</div>";
    echo "<div class='blue friend_return_9 fr_to_hide hide'>".$l->block_friend_title_2."</div>";
    echo "<div class='red  friend_return_10 fr_to_hide hide'>".$l->block_friend_error_2."</div>";
    echo "<div class='red  friend_error_1  fr_to_hide hide'>".$l->friend_error1."</div>";
  echo "</div>";


//fri_count auf 0 setzten

$up = "DELETE FROM notification_db WHERE notification_type = '10' AND viewed = '1' AND uuid = '$user_uuid' LIMIT 1";
$up = db::$link->query($up);


//Neue Anfragen
  $results_c_sql = db::$link->query("SELECT friend_id FROM friend_db WHERE second_uuid = '$user_uuid' AND status = 'sent' ORDER BY time ASC LIMIT 1");
    $results_c = $results_c_sql->fetch_assoc();

    if($results_c['friend_id']){
      echo "<div class='w-100 left fri_dd_title blue'>".$l->fri_new_title."</div>";
    }

  $results2 = db::$link->query("SELECT * FROM friend_db WHERE second_uuid = '$user_uuid' AND status = 'sent' ORDER BY time ASC LIMIT 30");
      while($row2 = $results2->fetch_array()){

        $fri_uuid = $row2['first_uuid']; $fri_uuif = sha1(sha1($fri_uuid));
          $avatar_img = $_dhp.$f->draw_avatar($fri_uuid,'small');
          $fri_user_name = $u->userin('name',0,$fri_uuif,'');

        echo "<div class='fri_line fri_".$fri_uuid."_line'>";
          echo "<div class='fri_user_avatar noselect'> <a href='".$_dhp."user/".$fri_user_name."'> <img src='".$avatar_img."'/> </a> </div>";
            echo "<div class='fri_main_content_full'>";
              echo "<div class='fri_title noselect no_overflow'><a href='".$_dhp."user/".$fri_user_name."'>".$fri_user_name."</a> </div>";
              echo "<div class='fri_text noselect no_overflow'>";
                echo "<span title='".$l->fri_accept_title."' isnavi='' friend_uuid='".$fri_uuid."' class='glyphicon accept_friend glyphicon-ok-circle blue'></span>";
                echo "<span title='".$l->fri_reject_title."' isnavi='' friend_uuid='".$fri_uuid."' class='glyphicon remove_friend glyphicon-remove-circle red'></span>";
                echo "<span title='".$l->fri_block_title."'  isnavi='' friend_uuid='".$fri_uuid."' class='glyphicon block_friend  glyphicon-ban-circle white'></span>";
              echo "</div>";
            echo "</div>";

        echo "<div style='clear:both;'></div>";
        echo "</div>";

      }



//gesendete Anfragen
  $results_c_sql = db::$link->query("SELECT friend_id FROM friend_db WHERE first_uuid = '$user_uuid' AND status = 'sent' ORDER BY time ASC LIMIT 1");
    $results_c = $results_c_sql->fetch_assoc();

    if($results_c['friend_id']){
      echo "<div class='w-100 left fri_dd_title blue'>".$l->fri_new_add_title."</div>";
    }

  $results2 = db::$link->query("SELECT * FROM friend_db WHERE first_uuid = '$user_uuid' AND status = 'sent' ORDER BY time ASC LIMIT 30");
      while($row2 = $results2->fetch_array()){

        $fri_uuid = $row2['second_uuid']; $fri_uuif = sha1(sha1($fri_uuid));
          $avatar_img = $_dhp.$f->draw_avatar($fri_uuid,'small');
          $fri_user_name = $u->userin('name',0,$fri_uuif,'');

        echo "<div class='fri_line fri_".$fri_uuid."_line'>";
          echo "<div class='fri_user_avatar noselect'> <a href='".$_dhp."user/".$fri_user_name."'> <img src='".$avatar_img."'/> </a> </div>";
            echo "<div class='fri_main_content_full'>";
              echo "<div class='fri_title noselect no_overflow'><a href='".$_dhp."user/".$fri_user_name."'>".$fri_user_name."</a> </div>";
              echo "<div class='fri_text noselect no_overflow'>";
                echo "<span title='".$l->fri_reject_title."' isnavi='' friend_uuid='".$fri_uuid."' class='glyphicon remove_friend glyphicon-remove-circle red'></span>";
              echo "</div>";
            echo "</div>";

        echo "<div style='clear:both;'></div>";
        echo "</div>";

      }




echo "<div class='w-100 left fri_dd_title'><span class='blue'>".$l->fri_title."</span> <span class='white right pad-r-5'>".$fri_c."/".$max_fri_c."</span> </div>";

if($get_total_rows[0] != 0){
    echo "<div class='friends_list'>";
      $page = 0;
      require_once ($_hp."friends/friends_list.php");
    echo "</div>";

  echo "</div>";

  ?>

    <div center='marg-l-10' align="center">
    <button class="load_more_friends w-100 blue_btn btn-default button <?php if($total_pages <= 1){echo "hide";}else{} ?>" id="load_more_button" <?php if($total_pages <= 1){echo "disabled='disabled'";}else{} ?> ><?php echo $l->loadmore; ?></button>
    <div class="animation_image_friends" style="display:none;"><img src="<?php echo $_dhp; ?>images/icons/ajax-loader.gif"> <?php echo $l->loading; ?></div>
    </div>
<?php

}else{
  echo $l->fri_title_empty;
}

?>

<script>

$('.new_fri_req').html('');

var track_click = 1;
var total_pages = <?php echo $total_pages; ?>;
loadfun_falseLink(); loadfun_fri(); loadfun_friend(); coms_loaded();

$(".load_more_friends").click(function (e) {
  $(this).hide();
  $('.animation_image_friends').show();

    if(track_click <= total_pages)
    {
        $.post('<?php echo $_dhp; ?>friends/friends_list', {'page': track_click}, function(data) {
          $(".load_more_friends").show();
          $(".friends_list").append(data);
          loadfun_falseLink(); loadfun_fri(); loadfun_friend(); coms_loaded();

          //scroll die seite automatisch
          //$("html, body").animate({scrollTop: $("#load_more_button").offset().top}, 500);

          $('.animation_image_friends').hide();
          track_click++;

        });

        if(track_click >= total_pages-1)
        {
          $(".load_more_friends").attr("disabled", "disabled");
          $(".load_more_friends").addClass('hide');
        }

    } //end track_click <= total_pages
}); //end load more function


function loadfun_fri(){

  $('.fri_open_btn').unbind('click').click(function(){
    var for_fri = $(this).attr('for');
    $('.fri_hidden_content').slideUp(200);
    $('.'+for_fri).slideDown(200);
    $('.'+for_fri+'_line').removeClass('fri_not_read');

    $('.fri_switch_btn').removeClass('fri_close_btn');
    $('.fri_switch_btn').removeClass('glyphicon-chevron-up');
    $('.fri_switch_btn').addClass('fri_open_btn');
    $('.fri_switch_btn').addClass('glyphicon-chevron-down');

    $(this).removeClass('fri_open_btn');
    $(this).removeClass('glyphicon-chevron-down');
    $(this).addClass('fri_close_btn');
    $(this).addClass('glyphicon-chevron-up');

    loadfun_fri();
  });

  $('.fri_close_btn').unbind('click').click(function(){
    $('.fri_hidden_content').slideUp(200);

    $('.fri_switch_btn').removeClass('fri_close_btn');
    $('.fri_switch_btn').removeClass('glyphicon-chevron-up');
    $('.fri_switch_btn').addClass('fri_open_btn');
    $('.fri_switch_btn').addClass('glyphicon-chevron-down');

    loadfun_fri();
  });

}

</script>
