<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = "../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include


echo "<div class='w-100 left mes_dd_title blue'>".$l->mes_title."</div>";

$item_per_page = 20;

$get_total_rows = 0;
$results = db::$link->query("SELECT COUNT(message_id) FROM message_db WHERE uuid = '$user_uuid' AND message_data2 != '' AND status = 'public'");
if($results){
  $get_total_rows = $results->fetch_row();
}


//break total records into pages
$total_pages = ceil($get_total_rows[0]/$item_per_page);

$token = $f->settoken('com','blanc');
$com_token = $f->settoken('com_like','blanc');

echo "<div tok='".$token."' vote_tok='".$com_token."' class='mes_token'></div>";

if($get_total_rows[0] != 0){
  echo "<div class='messages_list'>";
    echo "<div class='messages_list_content'>";
      $page = 0;
      require_once ($_hp."messages/messages_list.php");
    echo "</div>";

    ?>
    <div center='marg-l-10' align="center">
      <button class="load_more_messages w-100 blue_btn btn-default button <?php if($total_pages <= 1){echo "hide";}else{} ?>" id="load_more_button" <?php if($total_pages <= 1){echo "disabled='disabled'";}else{} ?> ><?php echo $l->loadmore; ?></button>
      <div class="animation_image_messages" style="display:none;"><img src="<?php echo $_dhp; ?>images/icons/ajax-loader.gif"> <?php echo $l->loading; ?></div>
    </div>
    <?php

  echo "</div>";

}else{
  echo $l->mes_title_empty;
}


?>

<script>


$('.new_mes_count').html('');

var track_click = 1;
var total_pages = <?php echo $total_pages; ?>;
loadfun_falseLink(); loadfun_mes(); resultloadedforthumbpreview(); coms_loaded();

$(".load_more_messages").click(function (e) {
  $(this).hide();
  $('.animation_image_messages').show();

    if(track_click <= total_pages)
    {
        $.post('<?php echo $_dhp; ?>messages/messages_list', {'page': track_click}, function(data) {
          $(".load_more_messages").show();
          $(".messages_list_content").append(data);
          loadfun_falseLink(); loadfun_mes(); resultloadedforthumbpreview(); coms_loaded();

          //scroll die seite automatisch
          //$("html, body").animate({scrollTop: $("#load_more_button").offset().top}, 500);

          $('.animation_image_messages').hide();
          track_click++;

        });

        if(track_click >= total_pages-1)
        {
          $(".load_more_messages").attr("disabled", "disabled");
          $(".load_more_messages").addClass('hide');
        }

    } //end track_click <= total_pages
}); //end load more function


function loadfun_mes(){

  $('.mes_open_btn').unbind('click').click(function(){
    var for_mes = $(this).attr('for');
    $('.mes_hidden_content').slideUp(200);
    $('.'+for_mes).slideDown(200);
    $('.'+for_mes+'_line').removeClass('mes_not_read');

    $('.mes_switch_btn').removeClass('mes_close_btn');
    $('.mes_switch_btn').removeClass('glyphicon-chevron-up');
    $('.mes_switch_btn').addClass('mes_open_btn');
    $('.mes_switch_btn').addClass('glyphicon-chevron-down');

    $(this).removeClass('mes_open_btn');
    $(this).removeClass('glyphicon-chevron-down');
    $(this).addClass('mes_close_btn');
    $(this).addClass('glyphicon-chevron-up');

    loadfun_mes();
  });

  $('.mes_close_btn').unbind('click').click(function(){
    $('.mes_hidden_content').slideUp(200);

    $('.mes_switch_btn').removeClass('mes_close_btn');
    $('.mes_switch_btn').removeClass('glyphicon-chevron-up');
    $('.mes_switch_btn').addClass('mes_open_btn');
    $('.mes_switch_btn').addClass('glyphicon-chevron-down');

    loadfun_mes();
  });

}

</script>
