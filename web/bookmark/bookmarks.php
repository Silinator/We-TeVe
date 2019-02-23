<?php

//1. Pfad zum Stammverzeichniss wo sich die index befindet

$_hp = '../'; //für include
$_dhp = "../"; // für daten

//2. all include
$in_save_code_all_include = '&TB2wStZ7u9GY&3yY*bqxUy4nz_vY#^Z';
require_once ($_hp.'include/all_include.php'); //haupt include


if($isUserLoggedIn === 1){

$item_per_page = 20;

$get_total_rows = 0;
$results = db::$link->query("SELECT COUNT(bm_id) FROM bookmark_db WHERE uuid = '$user_uuid' AND status = 'public'");
if($results){
  $get_total_rows = $results->fetch_row();
}
$total_pages = ceil($get_total_rows[0]/$item_per_page);


if($get_total_rows[0] != 0){
    echo "<div class='bookmarks_list'>";
      $page = 0;
      require_once ($_hp."bookmark/bookmarks_list.php");
    echo "</div>";

  echo "</div>";

  ?>

    <div center='marg-l-10' align="center">
    <button class="load_more_bookmarks w-100 blue_btn btn-default button <?php if($total_pages <= 1){echo "hide";}else{} ?>" id="load_more_button" <?php if($total_pages <= 1){echo "disabled='disabled'";}else{} ?> ><?php echo $l->loadmore; ?></button>
    <div class="animation_image_friends" style="display:none;"><img src="<?php echo $_dhp; ?>images/icons/ajax-loader.gif"> <?php echo $l->loading; ?></div>
    </div>
<?php

}else{
  echo $l->bms_title_empty;
}

?>

<script>

var track_click = 1;
var total_pages = <?php echo $total_pages; ?>;
loadfun_falseLink(); loadfun_bms(); coms_loaded();

$(".load_more_bookmarks").click(function (e) {
  $(this).hide();
  $('.animation_image_friends').show();

    if(track_click <= total_pages)
    {
        $.post('<?php echo $_dhp; ?>bookmark/bookmarks_list', {'page': track_click}, function(data) {
          $(".load_more_bookmarks").show();
          $(".bookmarks_list").append(data);
          loadfun_falseLink(); loadfun_bms(); coms_loaded();

          //scroll die seite automatisch
          //$("html, body").animate({scrollTop: $("#load_more_button").offset().top}, 500);

          $('.animation_image_friends').hide();
          track_click++;

        });

        if(track_click >= total_pages-1)
        {
          $(".load_more_bookmarks").attr("disabled", "disabled");
          $(".load_more_bookmarks").addClass('hide');
        }

    } //end track_click <= total_pages
}); //end load more function


function loadfun_bms(){

  $('.bm_list_edit_btn').unbind().click( function(){

    $('.bm_list_main').removeClass('hide');
    $('.bm_list_main_edit').addClass('hide');

    $('.bm_list_save_btn .glyphicon').addClass('glyphicon-cog');
    $('.bm_list_save_btn .glyphicon').removeClass('glyphicon-ok');
      $('.bm_list_save_btn').addClass('bm_list_edit_btn');
      $('.bm_list_save_btn').removeClass('bm_list_save_btn');

    $('.bm_list_abort_btn .glyphicon').addClass('glyphicon-trash');
    $('.bm_list_abort_btn .glyphicon').removeClass('glyphicon-remove');
      $('.bm_list_abort_btn').addClass('bm_list_del_btn');
      $('.bm_list_abort_btn').removeClass('bm_list_abort_btn');


    var for_bm = $(this).attr('for');
    $('.bm_list_main_'+for_bm).addClass('hide');
    $('.bm_list_main_edit_'+for_bm).removeClass('hide');

    $('.bm_list_edit_btn_'+for_bm+' .glyphicon').removeClass('glyphicon-cog');
    $('.bm_list_edit_btn_'+for_bm+' .glyphicon').addClass('glyphicon-ok');
      $('.bm_list_edit_btn_'+for_bm).removeClass('bm_list_edit_btn');
      $('.bm_list_edit_btn_'+for_bm).addClass('bm_list_save_btn');

    $('.bm_list_del_btn_'+for_bm+' .glyphicon').removeClass('glyphicon-trash');
    $('.bm_list_del_btn_'+for_bm+' .glyphicon').addClass('glyphicon-remove');
      $('.bm_list_del_btn_'+for_bm).removeClass('bm_list_del_btn');
      $('.bm_list_del_btn_'+for_bm).addClass('bm_list_abort_btn');

    loadfun_bms();
  });


  $('.bm_list_abort_btn').unbind().click( function(){
    $('.bm_list_main').removeClass('hide');
    $('.bm_list_main_edit').addClass('hide');

    $('.bm_list_save_btn .glyphicon').addClass('glyphicon-cog');
    $('.bm_list_save_btn .glyphicon').removeClass('glyphicon-ok');
      $('.bm_list_save_btn').addClass('bm_list_edit_btn');
      $('.bm_list_save_btn').removeClass('bm_list_save_btn');

    $('.bm_list_abort_btn .glyphicon').addClass('glyphicon-trash');
    $('.bm_list_abort_btn .glyphicon').removeClass('glyphicon-remove');
      $('.bm_list_abort_btn').addClass('bm_list_del_btn');
      $('.bm_list_abort_btn').removeClass('bm_list_abort_btn');

    loadfun_bms();
  });

  $('.bm_list_del_btn').unbind().click( function(){
    var for_bm = $(this).attr('for');
    $.post('<?php echo $_dhp; ?>bookmark/del', {'bm': for_bm}, function(data) {
      if(data == 'ok'){
        $('.bm_list_line_'+for_bm).remove();
      }
    });

  });

  $('.bm_list_save_btn').unbind().click( function(){
    var for_bm = $(this).attr('for');
    var bm_title = $('.bm_list_edit_first_line_'+for_bm).val();
    var bm_url = $('.bm_list_edit_second_line_'+for_bm).val();
    $.post('<?php echo $_dhp; ?>bookmark/save', {'bm': for_bm, 'title': bm_title, 'url': bm_url}, function(data) {
      if(data == 'ok'){
        $('.bm_list_first_line_'+for_bm+' a').html(bm_title);
        $('.bm_list_first_line_'+for_bm+' a').attr('href','<?php echo $_dhp; ?>'+bm_url);
        $('.bm_list_second_line_'+for_bm).html('www.We-TeVe.com/'+bm_url);


        $('.bm_list_main').removeClass('hide');
        $('.bm_list_main_edit').addClass('hide');

        $('.bm_list_save_btn .glyphicon').addClass('glyphicon-cog');
        $('.bm_list_save_btn .glyphicon').removeClass('glyphicon-ok');
          $('.bm_list_save_btn').addClass('bm_list_edit_btn');
          $('.bm_list_save_btn').removeClass('bm_list_save_btn');

        $('.bm_list_abort_btn .glyphicon').addClass('glyphicon-trash');
        $('.bm_list_abort_btn .glyphicon').removeClass('glyphicon-remove');
          $('.bm_list_abort_btn').addClass('bm_list_del_btn');
          $('.bm_list_abort_btn').removeClass('bm_list_abort_btn');

        loadfun_bms();
      }
    });

  });



}

</script>

<?php
  }
?>
