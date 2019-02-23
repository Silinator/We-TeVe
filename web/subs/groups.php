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
$results = db::$link->query("SELECT COUNT(abo_group_id) FROM abo_group_db WHERE uuid = '$user_uuid' AND status = 'public'");
if($results){
  $get_total_rows = $results->fetch_row();
}
$total_pages = ceil($get_total_rows[0]/$item_per_page);


if($get_total_rows[0] != 0){
    echo "<div class='sub_group_list'>";
      $page = 0;
      require_once ($_hp."subs/groups_list.php");
    echo "</div>";

  echo "</div>";

  ?>

    <div center='marg-l-10' align="center">
    <button class="load_more_sub_groups w-100 blue_btn btn-default button <?php if($total_pages <= 1){echo "hide";}else{} ?>" id="load_more_button" <?php if($total_pages <= 1){echo "disabled='disabled'";}else{} ?> ><?php echo $l->loadmore; ?></button>
    <div class="animation_image_friends" style="display:none;"><img src="<?php echo $_dhp; ?>images/icons/ajax-loader.gif"> <?php echo $l->loading; ?></div>
    </div>
<?php

}else{
  echo $l->sub_group_title_embty;
}


//new group
echo "<div style='clear:both;'></div><br><div>".$l->sub_title2.":</div>";
echo "<div class='pm_new_pl_error error w-100 pm_to_hide hide'>".$l->pl_error1."</div>";
  echo "<input class='form-control pm_new_pl new_sub_group_name' placeholder='".$l->sub_group_add_text."' type='text'/>";
  echo "<div class='new_sub_group_btn'>".$l->sub_add_group ."</div>";

?>

<script>

var track_click = 1;
var total_pages = <?php echo $total_pages; ?>;
var abo_user_uuid = '<?php echo $abo_user_uuid; ?>';
loadfun_falseLink(); loadfun_bms(); coms_loaded();

$(".load_more_sub_groups").click(function (e) {
  $(this).hide();
  $('.animation_image_friends').show();

    if(track_click <= total_pages)
    {
        $.post('<?php echo $_dhp; ?>subs/groups_list', {'page': track_click, 'sub_uuid': abo_user_uuid}, function(data) {
          $(".load_more_sub_groups").show();
          $(".sub_group_list").append(data);
          loadfun_falseLink(); loadfun_bms(); coms_loaded();

          //scroll die seite automatisch
          //$("html, body").animate({scrollTop: $("#load_more_button").offset().top}, 500);

          $('.animation_image_friends').hide();
          track_click++;

        });

        if(track_click >= total_pages-1)
        {
          $(".load_more_sub_groups").attr("disabled", "disabled");
          $(".load_more_sub_groups").addClass('hide');
        }

    } //end track_click <= total_pages
}); //end load more function

$('.new_sub_group_btn').unbind('click').click( function(){
  var sub_group_name = $('.new_sub_group_name').val();

  $.post('<?php echo $_dhp; ?>subs/manager', {'sub_group_name': sub_group_name, 'action': 'new'}, function(data) {

  });

});

</script>

<?php
  }
?>
