//=============================================
///\/\/\/\/\/\/\  Javascript  /\/\/\/\/\/\/\/\
//\/\/\/\/\/\/\/  Functionen  \/\/\/\/\/\/\/\/
//=============================================
///\/\/\/\/\/\/\  We-TeVe.com /\/\/\/\/\/\/\/\
//\/\/\/\/\/\/\/   Sivan Fux  \/\/\/\/\/\/\/\/
//=============================================
///\/\/\/\/\/\/\  Version 1.0 /\/\/\/\/\/\/\/\
//\/\/\/\/\/\/\/  22.02.2017  \/\/\/\/\/\/\/\/
//=============================================


//============================================================
//
//            load first
//
//============================================================

var lm_0=0, lm_1=0, lm_2=0, lm_3=0, lm_4=0, lm_5=0;

function loadfirst(page,target,sort,who){

  //var track_click = 0;

  //var total_pages = <?php echo $total_pages; ?>;
  $('#'+target).load(page, {'site':'0', 'sort': sort}, function() { resultloadedforthumbpreview();}); //initial data to load

  if(who == 0){lm_0 = 1;}
  if(who == 1){lm_1 = 1;}
  if(who == 2){lm_2 = 1;}
  if(who == 3){lm_3 = 1;}
  if(who == 4){lm_4 = 1;}
  if(who == 5){lm_5 = 1;}
}


//==================================================
//
//              load more
//
//===================================================




$(document).ready(function() {
  $('.load_more_result_btn').click(function () {
    var page = $(this).attr('data-page');
    var target = $(this).attr('data-trget');
    var sort = $(this).attr('data-sort');
    var total_pages = $(this).attr('data-total_pages');
    var who = $(this).attr('data-who');

    loadmore(page,target,sort,total_pages,who);
  });

  function loadmore(page,target,sort,total_pages,who){

    if(who == 0){var lm_select = lm_0;}
    if(who == 1){var lm_select = lm_1;}
    if(who == 2){var lm_select = lm_2;}
    if(who == 3){var lm_select = lm_3;}
    if(who == 4){var lm_select = lm_4;}
    if(who == 5){var lm_select = lm_5;}


      $('.load_more_text').addClass('hide');
      $('.load_more_loading').removeClass('hide');

      if(lm_select <= total_pages)
      {
        $.post(page, {'site':lm_select, 'sort': sort}, function(data) {

          if(who == 0){lm_0++; lm_select = lm_0;}
          if(who == 1){lm_1++; lm_select = lm_1;}
          if(who == 2){lm_2++; lm_select = lm_2;}
          if(who == 3){lm_3++; lm_select = lm_3;}
          if(who == 4){lm_4++; lm_select = lm_4;}
          if(who == 5){lm_5++; lm_select = lm_5;}

          $(".load_more_text").removeClass('hide');

          $('#'+target).append(data);

          //scroll page to button element
          //$("html, body").animate({scrollTop: $("#load_more_button").offset().top}, 500);

          $('.load_more_loading').addClass('hide');

          resultloadedforthumbpreview();

        }).fail(function(xhr, ajaxOptions, thrownError) {
          alert(thrownError);
          $(".load_more_text").removeClass('hide');
          $('.load_more_loading').addClass('hide');
        });


        if(lm_select >= total_pages-1)
        {
          //reached end of the page yet? disable load button
          $(".load_more_result_btn").attr("disabled", "disabled");
        }
       }
  }

});
