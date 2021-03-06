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


function coms_loaded(){

var dhp = "/we-teve/";

  //if chrome and opera -> for com input
  var browser_chrome = /chrom(e|ium)/.test(navigator.userAgent.toLowerCase());
    if(browser_chrome){
      $('.com_input').attr('contenteditable','plaintext-only');
    }else{
      $('.com_input').attr('contenteditable','true');
    }


  //skip to
  $('.vid_t_stamp').unbind("mousedown").mousedown(function(e){ //damit die mitteltaste erfast wird (ist kein click)
    if (e.which == 2) { videojs("we-teve_video").pause(); }
  });

  $('.vid_t_stamp').unbind("click").click(function (e) {
    if (e.ctrlKey || e.shiftKey || e.which == 2) {
      videojs("we-teve_video").pause();
    }else{
      var vid_sec = $(this).attr('skipto');
      vid_skip_to(vid_sec);
      return false;
    }
  });


  // fügt show more und show less hinzu wenn der kommentar zu lang ist
  show_more_btn();

  //video change fullscreeen
  $('body').unbind('webkitfullscreenchange mozfullscreenchange fullscreenchange MSFullscreenChange').on('webkitfullscreenchange mozfullscreenchange fullscreenchange MSFullscreenChange', function() {
    setTimeout(function(){
     show_more_btn();
   },10);
  });

  function show_more_btn(){
    var coms_content = $('.text_cont');
    coms_content.each(function(){
      if($(this).height() > 63){ //wenn höher als 50px
        $(this).addClass('com_text_max');
        $(this).parent().find('.com_showmore').removeClass('hide');
      }
    });
  }




//============================================================
//
//        synchronisiert die kommentar eingabe
//
//============================================================

  $('.column3 .com_input').keyup(function() { twin1($(this).attr('syn')); });
  $('.column3 .com_input').click(function() { twin1($(this).attr('syn')); });
  $('.column3 .com_input').change(function() { twin1($(this).attr('syn')); });
  $('.column3 .com_input').on('paste drop', function() { twin1($(this).attr('syn')); });
  $('.column3 .com_input').on('cut', function() { twin1($(this).attr('syn')); });


  $('.video_full_info .com_input').keyup(function() { twin2($(this).attr('syn')); });
  $('.video_full_info .com_input').click(function() { twin2($(this).attr('syn')); });
  $('.video_full_info .com_input').change(function() { twin2($(this).attr('syn')); });
  $('.video_full_info .com_input').on('paste drop', function() { twin2($(this).attr('syn')); });
  $('.video_full_info .com_input').on('cut', function() { twin2($(this).attr('syn')); });


  //sucheingabe
  $('.column3 .com_search_in').keyup(function() { stwin1(); });
  $('.column3 .com_search_in').click(function() { stwin1(); });
  $('.column3 .com_search_in').change(function() { stwin1(); });
  $('.column3 .com_search_in').on('paste drop', function() { stwin1(); });
  $('.column3 .com_search_in').on('cut', function() { stwin1(); });

  $('.video_full_info .com_search_in').keyup(function() { stwin2(); });
  $('.video_full_info .com_search_in').click(function() { stwin2(); });
  $('.video_full_info .com_search_in').change(function() { stwin2(); });
  $('.video_full_info .com_search_in').on('paste drop', function() { stwin2(); });
  $('.video_full_info .com_search_in').on('cut', function() { stwin2(); });

  //filter


  function twin1(synclass) {
    setTimeout(function(){
      $('.video_full_info .'+synclass).html($('.column3 .'+synclass).html());
    },1);
  }

  function twin2(synclass) {
    setTimeout(function(){
      $('.column3 .'+synclass).html($('.video_full_info .'+synclass).html());
    },1);
  }


  //sucheingabe
  function stwin1() {
    setTimeout(function(){
      $('.video_full_info .com_search_in').val($('.column3 .com_search_in').val());
    },1);
  }

  function stwin2() {
    setTimeout(function(){
      $('.column3 .com_search_in').val($('.video_full_info .com_search_in').val());
    },1);
  }


$('.com_input').unbind('click').click(function(){
  $(this).addClass('com_in_focus');
});

$(document).mouseup(function (e)
{
    var container = $('.com_input');

    if (!container.is(e.target) && container.has(e.target).length === 0)
    {
      if($('.com_in_focus').html() == "<br>"){
        $('.com_in_focus').html('');
      }

      $('.com_input').removeClass('com_in_focus');
    }
});


//=======================================

$.fn.convertLineBreaks = function() {
  this.each(function() {
    $(this).on("keypress click change paste cut", function(e) {
      var br, range, selection, textNode;
      if (e.keyCode === 13) {
        e.preventDefault();
        if (window.getSelection) {
          selection = window.getSelection();
          range = selection.getRangeAt(0);
          br = document.createElement("br");
          textNode = document.createTextNode("\u00a0");
          range.deleteContents();
          range.insertNode(br);
          range.collapse(false);
          range.insertNode(textNode);
          range.selectNodeContents(textNode);
          selection.removeAllRanges();
          selection.addRange(range);
          return false;
        }
      }
    });
  });
};

$editField = $('com_in_focus');

$editField.convertLineBreaks();


$(".com_input").unbind("paste drop").on('paste drop', function(e) {

  e.preventDefault();
  var text = null;
  text = (e.originalEvent || e).clipboardData.getData('text/plain') || prompt('Paste Your Text Here');
  document.execCommand("insertText", false, text);

});



//Nur ein Kommentar anzeigen / tocom
  if(typeof tocomkuid != 'undefined'){
      $(document).ready(function(){
        if(tocomkuid != '0' && tocomkuid != '' && com_linked != 1){
          tocom(tocomkuid);
        com_linked = 1;
        resetcomlinkedtimeout();
      }
    });
  }

  function resetcomlinkedtimeout(){
    setTimeout( function(){
      com_linked = 0;
      tocomkuid = '0';
    },500);
  }


  $('.com_to_com').unbind("mousedown").mousedown(function(e){ //damit die mitteltaste erfast wird (ist kein click)
    if (e.which == 2) { videojs("we-teve_video").pause(); }
  });

  $('.com_to_com').unbind('click').click(function(e) {
    if (e.ctrlKey || e.shiftKey || e.which == 2) {
      videojs("we-teve_video").pause();
    }else{
      var kuid = $(this).attr('tocom');
      tocom(kuid);
      return false;
    }
  });

  function tocom(kuid){
    $('.com_result_first_level').html("<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");
    $.post(dhp+'comments/tocom',{'kuid': kuid},function(data){
      $('.com_result_first_level').html(data);
        setTimeout(function(){
          loadfun_falseLink(); //die links müssen vor den kommentaren laden sonnst erkennt es den link an und nicht die zeitangebe zum skipen
          coms_loaded();

          $(".com_containe_"+kuid).find('.com_content').addClass('com_content_selected');

          var new_linked2 = $('.com_text_'+kuid).html();
          var new_linked2_a = $('.com_text_'+kuid).find('a').html();
          new_linked2 = new_linked2.replace(/<{1}[^<>]{1,}>{1}/g," ");
          new_linked2 = new_linked2.replace(new_linked2_a," ");
          new_linked = new_linked2.substring(0, 14);

          if(new_linked != new_linked2){
            new_linked = new_linked+"...";
          }

          var new_linked = new_linked.replace(/[\u00A0-\u9999<>\&]/gim, function(i) {
           return '&#'+i.charCodeAt(0)+';';
          });

          if(com_linked_count == 0){
            $('.com_filter_in_group_title').removeClass('hide');
          }

          com_linked_count++;

          new_linked = "<option for='"+kuid+"' class='com_filter tocomlink filter_"+kuid+"'>"+new_linked+"</option>";

          $('.com_filter_in_group_title').append(new_linked);
          $('.filter_'+kuid).prop('selected', true);

          $('.column3 .video_comments').animate({scrollTop: $(".column3 .video_comments .com_containe_"+kuid).offset().top }, 200);
          $('.video_full_info .video_comments').animate({scrollTop: $(".video_full_info .video_comments .com_containe_"+kuid).offset().top }, 200);

        },5);
    });
  }

  $('.backtoallcoms').unbind('click').click(function(){
    backtoallcom();
  });



//============================================================
//
//                  neuer kommentar schreiben
//
//============================================================


var com_alowed = 1;

  $('.com_enter').unbind("click").click(function(){

    if(com_alowed == 1){

      $('.com_alert').addClass('hide');

      setcomtimeout(); com_alowed = 0;
        var who       = $(this).attr('for_com');
        var mes       = $(this).attr('mes');
        var re        = $(this).attr('re');
        var addedvid  = $(this).attr('vid');

      if(mes == 0){
        var token     = $('.com_i').attr('tok');
        var vuid      = $('.com_i').attr('vid');
        var cuid      = $('.com_i').attr('channel');
      }else{
        var token     = $('.mes_token').attr('tok');
        var vuid      = $(this).closest('.mes_vcuid_info').attr('vid');
        var cuid      = $(this).closest('.mes_vcuid_info').attr('channel');
      }

      if($("#we-teve_video").hasClass("vjs-fullscreen")){
        $(this).find('.com_send_text').addClass('hide');
        $(this).find('.com_send_loading').removeClass('hide');
        var com_text = $('.'+who).html();
      }else{
        $(this).find('.com_send_text').addClass('hide');
        $(this).find('.com_send_loading').removeClass('hide');
        var com_text = $('.'+who).html();
      }
        if(com_text == ""){

          com_alowed = 1;
          $('.com_send_text').removeClass('hide');
          $('.com_send_loading').addClass('hide');

        }else{
          com_text = encodeURIComponent(com_text);

          $.post(dhp+'comments/add',{'content':com_text, 'token':token, 'vuid':vuid, 'cuid':cuid, 'mes':mes, 're':re, 'addedvid':addedvid},function(data){

            if(data == "error" || data == ""){

              $('.com_alert.alert_'+who).addClass('error');
              $('.com_alert.alert_'+who).removeClass('hide');

              com_alowed = 0;

              $('.com_send_text').removeClass('hide');
              $('.com_send_loading').addClass('hide');

            }else if(data == "error3"){

              $('.com_send_text').removeClass('hide');
              $('.com_send_loading').addClass('hide');

              $('.com_alert.alert2_'+who).addClass('error');
              $('.com_alert.alert2_'+who).removeClass('hide');

            }else if(data == 'empty'){ //wenn der Kommentar nur Leerziechen oder enter hatte

              $('.column3 .'+who).html('');
              $('.com_send_text').removeClass('hide');
              $('.com_send_loading').addClass('hide');

            }else{
              tok = data.substring(0, 80);
              com = data.substring(81);

              if(mes == 0){
                $('.com_i').attr('tok',tok);
              }else{
                $('.mes_token').attr('tok',tok);
              }

              $('.column3 .'+who).html('');
              $('.video_full_info .'+who).html('');
              $(".re_com_line").addClass('hide');

              $('.answ_'+who).html(com+$('.answ_'+who).html());

              $('.com_send_text').removeClass('hide');
              $('.com_send_loading').addClass('hide');
              coms_loaded()
            }

          });

        }
    }

  }); //function end


  //PRESS ON RE
  $('.com_re_btn_press').unbind("click").click(function(){
    var re_for     = $(this).attr('for');
      if( $("."+re_for).is(":visible") == false){
        $(".re_com_line").addClass('hide');
        $("."+re_for).removeClass('hide');
      }else{
        $(".re_com_line").addClass('hide');
      }
  });

  //Press Cancel
  $('.cancel_re_texting').unbind("click").click(function(){
    $(".re_com_line").addClass('hide');
  });

  //kommentare disable timeout
    function setcomtimeout(){
      setTimeout(function () {
        com_alowed = 1;
      }, 2000);
    }


  //Press ON show more
  $('.com_showmore').unbind('click').click(function(){
    var com = $(this).attr('for');

    if($('.com_text_'+com).hasClass('open')){
      $('.com_text_'+com).css('max-height','63px');
      $('.com_text_'+com).css('height','63px');
      $('.com_text_'+com).removeClass('open');

      $('.com_showmore_press_'+com).removeClass('hide');
      $('.com_showless_press_'+com).addClass('hide');
    }else{
      $('.com_text_'+com).css('max-height','none');
      $('.com_text_'+com).css('height','auto');
      $('.com_text_'+com).addClass('open');

      $('.com_showmore_press_'+com).addClass('hide');
      $('.com_showless_press_'+com).removeClass('hide');
    }
  });


  //PRESS ON show ans
    $('.toggle_ans_btn').unbind("click").click(function(){

        var for_kuid = $(this).attr('for');
        var for_ans = "ans_"+for_kuid;

          if($("."+for_ans).html() == ""){
            $('.com_show_ans_load_'+for_kuid).removeClass('hide');
            $('.com_show_ans_'+for_kuid).addClass('hide');

            $.post(dhp+'comments/second_level_coms',{'kuid':for_kuid},function(data){



              setTimeout(function(){
                loadfun_falseLink(); //die links müssen vor den kommentaren laden sonnst erkennt es den link an und nicht die zeitangebe zum skipen
                coms_loaded();
              },1);

              $("."+for_ans).html(data);

                $(".com_ans").slideUp( 0 );
                  $(".com_ans").removeClass( "open" );

                $("."+for_ans).slideDown( 150 );
                  $("."+for_ans).addClass( "open" );

              //load anzeige schliessen
              $('.com_show_ans_load').addClass('hide');

              //alle anderen "show more btns" schlieseen
              $(".com_show_ans").removeClass('hide');
              $(".com_hide_ans").addClass('hide');
                //this "show more btn" öffnen
                $(".com_show_"+for_ans).addClass('hide');
                $(".com_hide_"+for_ans).removeClass('hide');

            });
         }else{
           open_ans(for_ans);
         }
    });

    function open_ans(for_ans){

        if( $("."+for_ans).hasClass( "open" ) == false){
          $(".com_ans").slideUp( 150 );
            $(".com_ans").removeClass( "open" );

          $("."+for_ans).slideDown( 150 );
            $("."+for_ans).addClass( "open" );

          //alle anderen "show more btns" schlieseen
          $(".com_show_ans").removeClass('hide');
          $(".com_hide_ans").addClass('hide');
            //this "show more btn" öffnen
            $(".com_show_"+for_ans).addClass('hide');
            $(".com_hide_"+for_ans).removeClass('hide');

        }else{
          $(".com_ans").slideUp( 150 );
            $(".com_ans").removeClass( "open" );

          //alle anderen "show more btns" schlieseen
          $(".com_show_ans").removeClass('hide');
          $(".com_hide_ans").addClass('hide');
        }
    }


    var lm_click = 0;

    //layer show and hide
      //layer mark1 -> hide layer 2,3,4  | für cl +1 immer
      $('.lm1').unbind('click').click(function(){
        if(lm_click == 0){
        lmclicked();
          if($('.lm1').hasClass('lm_45')){
            $('.cl3,.cl4,.cl5').slideDown(300);
            $('.lm_45').removeClass('lm_45');
          }else{
            $('.cl3,.cl4,.cl5').slideUp(300);;
            $('.lm1').addClass('lm_45');
          }
        lm_click = 1;
        }
      });

      //layer mark2 -> hide layer 3,4
      $('.lm2').unbind('click').click(function(){
        if(lm_click == 0){
        lmclicked();
          if($('.lm2').hasClass('lm_45')){
            $('.cl4,.cl5').slideDown(300);
            $('.lm_45').removeClass('lm_45');
          }else{
            $('.cl4,.cl5').slideUp(300);
            $('.lm2').addClass('lm_45');
          }
        lm_click = 1;
        }
      });

      //layer mark3 -> hide layer 4
      $('.lm3').unbind('click').click(function(){
        if(lm_click == 0){
        lmclicked();
          if($('.lm3').hasClass('lm_45')){
            $('.cl5').slideDown(300);
            $('.lm_45').removeClass('lm_45');
          }else{
            $('.cl5').slideUp(300);
            $('.lm3').addClass('lm_45');
          }
        lm_click = 1;
        }
      });

      function lmclicked(){
        setTimeout(function(){
          lm_click = 0;
        },300);
      }


//============================================================
//
//                  kommentar vote
//
//============================================================


$('.com_up_btn_box').unbind("click").click(function(){

    $('.com_vote_error').addClass('hide');

      var kuid      = $(this).attr('for');
      var mes       = $(this).attr('mes');

    if(mes == 0){
      var votetoken     = $('.com_i').attr('vote_tok');
    }else{
      var votetoken     = $('.mes_token').attr('vote_tok');
    }

      $.post(dhp+'comments/vote',{'kuid': kuid, 'tok': votetoken, 'vote': 'pos'}, function(data) {

        if(data != 'error' && data != 'tok_error'){
          votetoken = data.substring(0, 80);
          var vote = data.substring(81, 87);
          var com_votes = parseInt($('.com_vote_'+kuid).html());

          if(vote == "addpos"){
            com_votes = com_votes + 1;
            $('.com_up_btn_'+kuid).addClass('com_vote_activ');
          }else if(vote == "rempos"){
            com_votes = com_votes - 1;
            $('.com_up_btn_'+kuid).removeClass('com_vote_activ');
          }else if(vote == "switch"){
            com_votes = com_votes + 2;
            $('.com_up_btn_'+kuid).addClass('com_vote_activ');
            $('.com_down_btn_'+kuid).removeClass('com_vote_activ');
          }

          $('.com_vote_'+kuid).html(com_votes);
            if(com_votes > 0){
              $('.com_vote_'+kuid).removeClass('white');
              $('.com_vote_'+kuid).removeClass('red');
              $('.com_vote_'+kuid).addClass('blue');
            }else if(com_votes == 0){
              $('.com_vote_'+kuid).removeClass('blue');
              $('.com_vote_'+kuid).removeClass('red');
              $('.com_vote_'+kuid).addClass('blue');
            }else{
              $('.com_vote_'+kuid).removeClass('blue');
              $('.com_vote_'+kuid).removeClass('white');
              $('.com_vote_'+kuid).addClass('red');
            }

          if(mes == 0){
            $('.com_i').attr('vote_tok',votetoken);
          }else{
            $('.mes_token').attr('vote_tok',votetoken);
          }

        }else if(data == 'tok_error'){
          $('.com_vote_error2_'+kuid).removeClass('hide');
        }else{
          $('.com_vote_error_'+kuid).removeClass('hide');
        }
    });
});


$('.com_down_btn_box').unbind("click").click(function(){

    $('.com_vote_error').addClass('hide');

      var kuid      = $(this).attr('for');
      var mes       = $(this).attr('mes');

    if(mes == 0){
      var votetoken     = $('.com_i').attr('vote_tok');
    }else{
      var votetoken     = $('.mes_token').attr('vote_tok');
    }

      $.post(dhp+'comments/vote',{'kuid': kuid, 'tok': votetoken, 'vote': 'neg'}, function(data) {
        if(data != 'error' && data != 'tok_error'){
          votetoken = data.substring(0, 80);
          var vote = data.substring(81, 87);
          var com_votes = parseInt($('.com_vote_'+kuid).html());

          if(vote == "addneg"){
            com_votes = com_votes - 1;
            $('.com_down_btn_'+kuid).addClass('com_vote_activ');
          }else if(vote == "remneg"){
            com_votes = com_votes + 1;
            $('.com_down_btn_'+kuid).removeClass('com_vote_activ');
          }else if(vote == "switch"){
            com_votes = com_votes - 2;
            $('.com_down_btn_'+kuid).addClass('com_vote_activ');
            $('.com_up_btn_'+kuid).removeClass('com_vote_activ');
          }

          $('.com_vote_'+kuid).html(com_votes);
            if(com_votes > 0){
              $('.com_vote_'+kuid).removeClass('white');
              $('.com_vote_'+kuid).removeClass('red');
              $('.com_vote_'+kuid).addClass('blue');
            }else if(com_votes == 0){
              $('.com_vote_'+kuid).removeClass('blue');
              $('.com_vote_'+kuid).removeClass('red');
              $('.com_vote_'+kuid).addClass('white');
            }else{
              $('.com_vote_'+kuid).removeClass('blue');
              $('.com_vote_'+kuid).removeClass('white');
              $('.com_vote_'+kuid).addClass('red');
            }

          if(mes == 0){
            $('.com_i').attr('vote_tok',votetoken);
          }else{
            $('.mes_token').attr('vote_tok',votetoken);
          }

        }else if(data == 'tok_error'){
          $('.com_vote_error2_'+kuid).removeClass('hide');
        }else{
          $('.com_vote_error_'+kuid).removeClass('hide');
        }
    });
});


//============================================================
//
//                  more menu click
//
//============================================================


$('.com_more_menu_btn').unbind('click').click( function(){
  var com_for = $(this).attr('for');

  if($('.com_more_menu_'+com_for).hasClass('hide')){
    $('.com_more_menu').addClass('hide');
    $('.com_more_menu_'+com_for).removeClass('hide');
  }else{
    $('.com_more_menu_'+com_for).addClass('hide');
  }
});

  $(document).mouseup(function (e){
      var container = $('.com_more_menu_btn'); var container2 = $('.com_more_menu');
      if (!container.is(e.target) && container.has(e.target).length === 0 && !container2.is(e.target) && container2.has(e.target).length === 0){
        $('.com_more_menu').addClass('hide');
      }
  });


  //com del
  $('.com_del_btn').unbind('click').click( function(){
    var com_kuid = $(this).attr('kuid');

      $('.com_vote_error').addClass('hide');
      $.post(dhp+'comments/del',{'kuid': com_kuid}, function(data) {
        if(data != "error" && data != ""){
          $('.com_text_'+com_kuid).html(data);
          $('.com_more_menu').addClass('hide');
        }else{
          $('.com_del_error1_'+com_kuid).removeClass('hide');
          $('.com_more_menu').addClass('hide');
        }
      });
  });



}// function com loaded
