//=============================================
///\/\/\/\/\/\/\  Javascript  /\/\/\/\/\/\/\/\
//\/\/\/\/\/\/\/  Functionen  \/\/\/\/\/\/\/\/
//=============================================
///\/\/\/\/\/\/\ (c)We-TeVe.com /\/\/\/\/\/\/\
//\/\/\/\/\/\/\/  (c)Silvan Fux \/\/\/\/\/\/\/
//=============================================
///\/\/\/\/\/\/\  Version 4.0 /\/\/\/\/\/\/\/\
//\/\/\/\/\/\/\/  24.11.2018  \/\/\/\/\/\/\/\/
//=============================================


//============================================================
//
//   Funktionen die geladen werden wenn die seite geladen ist
//
//============================================================

//$(document).ready(function() {
  //docready();
//});


//erkennung von mobiledeviced Thx to: https://stackoverflow.com/questions/3514784/

if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;


var video_del = 0;
var dhp = _path;


//müssen globla sein -> können sonnst nicht gecleart werden und alle intervals bugen!!!
var inter_thumb    = null;
var inter_looptime = null;
var ach_animation_interval = null;


function docready(){

  if(isMobile === true){ $('.body').addClass('mobile'); }

  loadfun_falseLink();
  loadfun_sub_button();
  ready_navigator();
  resetval();

  setTimeout( function(){
    $('.docready-script').remove();
    $('.check_js').remove();
  },100);

  if( typeof loadfun_video !== "undefined" ){
    loadfun_video(0);
  }

}

function resetval(){
  var played_time = 0;
}

//============================================================
//
//   Funktionen die die von loadmore geändert werden
//
//============================================================

function resultloadedforthumbpreview(){

    //alert('resultloaded');
    loadfun_falseLink();
    loadfun_thumbpreview();
    loadfun_sub_button();
}


//============================================================
//
//            bei klick auf link nicht neu öffnen
//
//============================================================


  var backsite = "";
  var linkclicked = 0;

function ready_navigator(){
    window.onpopstate = function(event){ //wenn man die navigation nutz (zurück und vorwärt im browser)
      var url = location.search;

      if($('#column2 video').length && $('#column2 .video-js').hasClass('vjs-has-started') && $('#column2 .video-js').hasClass('vjs-error') == false
      && $('.channel_home_main_container video').length == false) {
        move_video();
        gotosite(url,2,'0');
      }else{
        gotosite(url,2,'0');
      }

    };
}



function loadfun_falseLink(){

    $('a').unbind("click").click(function (e) {

      if ($(this).attr('target') != "_blank" && $(this).attr('load') != 'new'){
      if (e.ctrlKey || e.shiftKey || e.which == 2 || e.button == 4) {}else{
        if(linkclicked != 1){
            linkclicked = 1;

            var url = $(this).attr('href');

            if( typeof $(this).attr('data-sbs') != "undefined" ){var sbs = $(this).attr('data-sbs');}else{var sbs = '';}

            if($(this).hasClass('video_link') && $('#column2 video').length ){
              gotovideosite(url,sbs,'0');
            }else{

              if($('#column2 video').length && $('#column2 .video-js').hasClass('vjs-has-started') && $('#column2 .video-js').hasClass('vjs-error') == false
              && $('.channel_home_main_container video').length == false) {

                if($('.miniplayer').html() == ""){
                  move_video();
                  gotosite(url,sbs,'0');

                }else{
                  gotosite(url,sbs,'0');
                }


              }else{
                gotosite(url,sbs,'0');
              }
            }

            relinkclicked();
            return false;
          }
      }
      }
    });

    function relinkclicked(){
      //damit doppelklicks nur einmal die seite laden
      setTimeout( function(){
        linkclicked = 0;
      },500);
    }

    $('.vjs-backtowatch-control').unbind("click").click(function() {
      if( $('.miniplayer').html() != "" ){
        go_back_to_watch();
      }
    });

    $('.close_miniplayer').unbind("click").click(function() {
      if( $('.miniplayer').html() != "" ){
        close_miniplayer();
      }
    });

}



  function move_video(){
    if(isMobile === false){
      $('.miniplayer_box').removeClass('hide');
      $('.miniplayer').html($('.video_container_u'));

      if( $('.miniplayer .video-js').hasClass('vjs-playing') ){
        document.getElementsByTagName("video")[0].play();
      }

      $('.miniplayer_box_header').html( $('.miniplayer .vid_info').attr('video_title') );
      $('.miniplayer_watch_site').html($('.main_container').html());
      $('.miniplayer_watch_url').attr('url',document.location);
      $('.miniplayer .video-js').removeClass('vjs-fill');
      $('.miniplayer .video-js').attr('id','miniplayer_video');
      $('.miniplayer video').attr('id','miniplayer_video_html5_api');

    }else{
      //noch nichts
    }

  }


  function close_miniplayer(){
    videojs("miniplayer_video").dispose();

    $('.miniplayer_box_header').html('');
    $('.miniplayer_box').addClass('hide');
    $('.miniplayer .video-js .vjs-backtowatch-control').addClass('hide');
    $('.miniplayer').html('');
    $('.miniplayer_watch_site').html('');
  }


  function go_back_to_watch(){

    if($('#channel_video').length){videojs("channel_video").dispose();}

    $('.main_container').html($('.miniplayer_watch_site').html());
    $('.main_container .video_container').html($('.miniplayer .video_container_u'));

    if( $('.main_container .video-js').hasClass('vjs-playing') ){
      document.getElementsByTagName("video")[0].play();
    }


    $('.miniplayer_box_header').html( $('.miniplayer .vid_info').attr('video_title') );
    $('.miniplayer_watch_site').html('');
    $('.miniplayer').html('');
    $('.miniplayer_box').addClass('hide');

    history.pushState({page: true}, null, document.location); //zurück link setzten
    var videourl = $('.miniplayer_watch_url').attr('url');
    window.history.replaceState('page2', 'OWWO', videourl);

    document.title = $('.main_container .vid_info').attr('video_title') + " | We-TeVe";

    $('.video-js').attr('id','we-teve_video');
    $('video').attr('id','we-teve_video_html5_api');

    loadfun_falseLink();
    loadfun_sub_button();
    loadfun_icon_btn();
    loadfun_icon_btn2();
    loadfun_playlists();
    loadfun_more_vids();
    ready_navigator();
    loadfun_thumbpreview();

  }



  function gotosite(url,sbs,all){
    //alert('falseLink');

    $('.site_loadering_progress').animate({width: "70%",}, 500 );

    if(all != 1){

      if(sbs != 2){
        history.pushState({page: true}, null, document.location); //zurück link setzten
      }

      if(sbs == ""){
        var backsite = document.location;
        backsite = backsite.toString();
      }else if(sbs != "" && sbs != 1 && sbs != 2){
        backsite = sbs;
      }

      $.post(url,{'inframed':1, 'backsite': backsite},function(data){//ladet die neue Seite
        $('#main_container').html(data);
        $('.site_loadering_progress').animate({width: "100%",}, 100 );
        setTimeout(function() {
          $('.site_loadering_progress').animate({width: "0%",}, 1 );
        }, 100);
        //scroolt to # angabe von url
        var urlHash = url.split("#")[1];
        if(typeof urlHash !== typeof undefined && urlHash !== false){
          $('html,body').animate({
            scrollTop: $('#'+urlHash).offset().top
          }, 500);
        }
      });

      $('html,body').scrollTop(0); //jump to top

      window.history.replaceState('page2', 'OWWO', url); //url ändern

        if(navileft == 1){
            setTimeout(function () {
              $('body').removeClass('stop_srolling');
              $('.navileft').animate({left:'-='+left_width}, 200, function() {
               $('.navileft').hide(); //hide navi
               navileft = 0;
             });
           }, 100);
        }
        $('.set_bm_opt').addClass('hide'); $('.bookmark_dd_arrow').addClass('hide');//hide bookmark
        $('.bm_container_bg').addClass('hide'); // hide bookmark menu
        //$('.body').removeClass('channel-background'); //hide  channel-background
        //dd close
        $('.friend_dropdown').addClass('hide');$('.friend_dd_arrow').addClass('hide');
        $('.friend_dropdown').html("<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");
        $('.messages_dropdown').addClass('hide'); $('.messages_dd_arrow').addClass('hide');
        $('.messages_dropdown').html("<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");
        $('.level_dropdown').addClass('hide'); $('.level_dd_arrow').addClass('hide');
        $('.level_dropdown').html("<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");
        $(window).unbind('scroll');


        if($('#we-teve_video').length || $('#channel_video').length) {
          if($('#we-teve_video').length){videojs("we-teve_video").dispose();}
          if($('#channel_video').length){videojs("channel_video").dispose();}
          //Intervale löschen damit keine parallel laufen
            clearInterval(inter_testvolum_change);
            clearInterval(inter_add_playedtime);
            clearInterval(inter_test_inactiv);
            clearInterval(inter_test_touch_inactiv);
            clearInterval(inter_thumb);
            clearInterval(inter_looptime);
            clearInterval(inter_testvolum_is_changed);
            clearInterval(ach_animation_interval);
            clearInterval(inter_video_ended);
        }


      return false;
    }else{
      window.location.href = url;
    }
  }
  //end gotosite


  //function gotovideosite
    //wird genutzt für playlisten und im Vollbildmodus

  function gotovideosite(url,sbs,all){

    $('.site_loadering_progress').animate({width: "70%",}, 500 );

    if(all != 1){
      history.pushState({page: true}, null, document.location); //zurück link setzten

      if(sbs == ""){
        var backsite = document.location;
        backsite = backsite.toString();
      }else if(sbs != "" && sbs != 1){
        backsite = sbs;
      }


    if($('.miniplayer').html() == ""){

      $.post(url,{'inframed':1, 'backsite': backsite},function(data){//ladet die neue Seite
        $('#hidden_container').html(data);
        $('.site_loadering_progress').animate({width: "100%",}, 100 );
        setTimeout(function() {
          $('.site_loadering_progress').animate({width: "0%",}, 1 );
        }, 100);
        //scroolt to # angabe von url
        var urlHash = url.split("#")[1];
        if(typeof urlHash !== typeof undefined && urlHash !== false){
          $('html,body').animate({
            scrollTop: $('#'+urlHash).offset().top
          }, 500);
        }

        //new
          $('#hidden_container video').attr('id','del_video');
          videojs("del_video").dispose(); //lösch new player

          var vid_autoplay   = $('#hidden_container .vid_info').attr('vid_autoplay');
          var video_duration = $('#hidden_container .vid_info').attr('long');
          var long_p         = $('#hidden_container .vid_info').attr('long_p');
          var defaultvolume  = $('#hidden_container .vid_info').attr('default_vol');
          var vid_hud        = $('#hidden_container .vid_info').attr('vid_hud');
          var defaultqualli  = $('#hidden_container .vid_info').attr('default_result');
          var org_resolution = $('#hidden_container .vid_info').attr('org_resolution');
          var avai_resolution= $('#hidden_container .vid_info').attr('available_resolution');
          var video_title    = $('#hidden_container .vid_info').attr('video_title');
          var datavuid       = $('#hidden_container .vid_info').attr('datavuid');
          var skipto         = $('#hidden_container .vid_info').attr('skipto');
          var vuid           = $('#hidden_container .vid_info').attr('vuid');
          var playlist_id    = $('#hidden_container .vid_info').attr('playlist_id');
          var vid_play,view_added;
          var played_time = 0;

          $('#hidden_container .vid_info').remove();

          $('.video_container .vid_info').attr('vid_autoplay',vid_autoplay);
          $('.video_container .vid_info').attr('long',video_duration);
          $('.video_container .vid_info').attr('long_p',long_p);
          $('.video_container .vid_info').attr('default_vol',defaultvolume);
          $('.video_container .vid_info').attr('vid_hud',vid_hud);
          $('.video_container .vid_info').attr('default_result',defaultqualli);
          $('.video_container .vid_info').attr('org_resolution',org_resolution);
          $('.video_container .vid_info').attr('available_resolution',avai_resolution);
          $('.video_container .vid_info').attr('video_title',video_title);
          $('.video_container .vid_info').attr('datavuid',datavuid);
          $('.video_container .skipto').attr('skipto',skipto);
          $('.video_container .vid_info').attr('vuid',vuid);
          $('.video_container .vid_info').attr('playlist_id',playlist_id);
          $('.video_container .video-js').attr('poster','../images/thumb/large_img/'+vuid+'.jpg');
          $('.video_container .vjs-tech').attr('poster','../images/thumb/large_img/'+vuid+'.jpg');

          //setzt next video auf null
          $('.video_container .vid_info').attr('next_vuid','');

          //entfernt die playlist buttons
          $('.video_container .vjs-play-control').removeClass('vjs-pl-play-control');
          $('.video_container .vjs-volume-panel').removeClass('vjs-pl-volume-panel');
          $('.video_container .vjs-current-time').removeClass('vjs-pl-current-time');
          $('.video_container .vjs-time-divider').removeClass('vjs-pl-time-divider');
          $('.video_container .vjs-duration').removeClass('vjs-pl-duration');
          $('.video_container .vjs-pl-control').addClass('hide');

          switchres(datavuid,defaultqualli,1,1,0); //setTimeout(function () { document.getElementsByTagName("video")[0].play(); }, 500);

            var video_extra_info = $("#hidden_container #column3").html();
            $("#hidden_container #column3").remove();
            $("#column3").html(video_extra_info);

            var user_extra_info = $("#hidden_container #column1").html();
            $("#hidden_container #column1").remove();
            $("#column1").html(user_extra_info);

            var watch_under_info = $("#hidden_container .watch_under_video").html();
            $("#hidden_container .watch_under_video").remove();
            $(".watch_under_video").html(watch_under_info);

            var watch_pop_up_menues = $("#hidden_container .watch_pop_up_menues").html();
            $("#hidden_container .watch_pop_up_menues").remove();
            $(".watch_pop_up_menues").html(watch_pop_up_menues);

          //$('#hidden_container').html('');

          docready();
          setTimeout(function(){
            loadfun_icon_btn();
            loadfun_icon_btn2();
            loadfun_playlists();
            loadfun_more_vids();
            coms_loaded();
          },2);

      });

      $('html,body').scrollTop(0); //jump to top

      window.history.replaceState('page2', 'OWWO', url); //url ändern

        if(navileft == 1){
            setTimeout(function () {
              $('body').removeClass('stop_srolling');
              $('.navileft').animate({left:'-='+left_width}, 200, function() {
               $('.navileft').hide(); //hide navi
               navileft = 0;
             });
           }, 100);
        }
        $('.set_bm_opt').addClass('hide'); $('.bookmark_dd_arrow').addClass('hide');//hide bookmark
        $('.bm_container_bg').addClass('hide'); // hide bookmark menu
        //$('.body').removeClass('channel-background'); //hide  channel-background
        //dd close
        $('.friend_dropdown').addClass('hide');$('.friend_dd_arrow').addClass('hide');
        $('.friend_dropdown').html("<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");
        $('.messages_dropdown').addClass('hide'); $('.messages_dd_arrow').addClass('hide');
        $('.messages_dropdown').html("<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");
        $('.level_dropdown').addClass('hide'); $('.level_dd_arrow').addClass('hide');
        $('.level_dropdown').html("<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");
        $(window).unbind('scroll');


        if($('video').length) {
          //videojs("we-teve_video").dispose();
          //Intervale löschen damit keine parallel laufen
            clearInterval(inter_testvolum_change);
            clearInterval(inter_add_playedtime);
            clearInterval(inter_test_inactiv);
            clearInterval(inter_test_touch_inactiv);
            clearInterval(inter_thumb);
            clearInterval(inter_looptime);
            clearInterval(inter_testvolum_is_changed);
            clearInterval(ach_animation_interval);
            clearInterval(inter_video_ended);
        }



    }else{ // end if miniplayer is empty


      $.post(url,{'inframed':1, 'backsite': backsite},function(data){//ladet die neue Seite
        $('.miniplayer_watch_site').html(data);
        $('.site_loadering_progress').animate({width: "100%",}, 100 );
        setTimeout(function() {
          $('.site_loadering_progress').animate({width: "0%",}, 1 );
        }, 100);

        //new
          $('.miniplayer_watch_site video').attr('id','del_video');
          videojs("del_video").dispose(); //lösch new player

          var vid_autoplay   = $('.miniplayer_watch_site .vid_info').attr('vid_autoplay');
          var video_duration = $('.miniplayer_watch_site .vid_info').attr('long');
          var long_p         = $('.miniplayer_watch_site .vid_info').attr('long_p');
          var defaultvolume  = $('.miniplayer_watch_site .vid_info').attr('default_vol');
          var vid_hud        = $('.miniplayer_watch_site .vid_info').attr('vid_hud');
          var defaultqualli  = $('.miniplayer_watch_site .vid_info').attr('default_result');
          var org_resolution = $('.miniplayer_watch_site .vid_info').attr('org_resolution');
          var avai_resolution= $('.miniplayer_watch_site .vid_info').attr('available_resolution');
          var video_title    = $('.miniplayer_watch_site .vid_info').attr('video_title');
          var datavuid       = $('.miniplayer_watch_site .vid_info').attr('datavuid');
          var skipto         = $('.miniplayer_watch_site .vid_info').attr('skipto');
          var vuid           = $('.miniplayer_watch_site .vid_info').attr('vuid');
          var playlist_id    = $('.miniplayer_watch_site .vid_info').attr('playlist_id');
          var vid_play,view_added;
          var played_time = 0;

          $('.miniplayer_watch_site .vid_info').remove();

          $('.miniplayer .vid_info').attr('vid_autoplay',vid_autoplay);
          $('.miniplayer .vid_info').attr('long',video_duration);
          $('.miniplayer .vid_info').attr('long_p',long_p);
          $('.miniplayer .vid_info').attr('default_vol',defaultvolume);
          $('.miniplayer .vid_info').attr('vid_hud',vid_hud);
          $('.miniplayer .vid_info').attr('default_result',defaultqualli);
          $('.miniplayer .vid_info').attr('org_resolution',org_resolution);
          $('.miniplayer .vid_info').attr('available_resolution',avai_resolution);
          $('.miniplayer .vid_info').attr('video_title',video_title);
          $('.miniplayer .vid_info').attr('datavuid',datavuid);
          $('.miniplayer .skipto').attr('skipto',skipto);
          $('.miniplayer .vid_info').attr('vuid',vuid);
          $('.miniplayer .vid_info').attr('playlist_id',playlist_id);
          $('.miniplayer .video-js').attr('poster','../images/thumb/large_img/'+vuid+'.jpg');
          $('.miniplayer .vjs-tech').attr('poster','../images/thumb/large_img/'+vuid+'.jpg');

          //setzt next video auf null
          $('.miniplayer .vid_info').attr('next_vuid','');

          //entfernt die playlist buttons
          $('.miniplayer .vjs-play-control').removeClass('vjs-pl-play-control');
          $('.miniplayer .vjs-volume-panel').removeClass('vjs-pl-volume-panel');
          $('.miniplayer .vjs-current-time').removeClass('vjs-pl-current-time');
          $('.miniplayer .vjs-time-divider').removeClass('vjs-pl-time-divider');
          $('.miniplayer .vjs-duration').removeClass('vjs-pl-duration');
          $('.miniplayer .vjs-pl-control').addClass('hide');

          switchres(datavuid,defaultqualli,1,1,1); //setTimeout(function () { document.getElementsByTagName("video")[0].play(); }, 500);


          var video_extra_info = $(".miniplayer_watch_site #column3").html();
          $("#video_full_info").html(video_extra_info);

          var user_extra_info = $(".miniplayer_watch_site #column1").html();
          $("#user_full_info").html(user_extra_info);


          $('.video-js').attr('id','we-teve_video');
          $('video').attr('id','we-teve_video_html5_api');
          $('.miniplayer_box_header').html( $('.miniplayer .vid_info').attr('video_title') );

          docready();
          setTimeout(function(){
            loadfun_icon_btn();
            loadfun_icon_btn2();
            loadfun_playlists();
            loadfun_more_vids();
            loadfun_video(1);
            coms_loaded();
          },2);

          $('.miniplayer .video-js').attr('id','miniplayer_video');
          $('.miniplayer video').attr('id','miniplayer_video_html5_api');


          //set video ratio
            var video_ratio_ar = org_resolution.split("x");
            var video_ratio = parseInt(video_ratio_ar[1]) / parseInt(video_ratio_ar[0]) * 100;

            $('.channel_home_main_container .video-js').addClass('vjs-fill');

            if($('.miniplayer .video-js').hasClass('vjs-fill') === false){
              if(video_ratio > 75){
                $('.miniplayer .video-js').removeClass('vjs-21-9');
                $('.miniplayer .video-js').removeClass('vjs-16-9');
                $('.miniplayer .video-js').removeClass('vjs-4-3');
                $('.miniplayer .video-js').addClass('vjs-4-3');
              }else if(video_ratio < 75 && video_ratio > 50){
                $('.miniplayer .video-js').removeClass('vjs-21-9');
                $('.miniplayer .video-js').removeClass('vjs-16-9');
                $('.miniplayer .video-js').removeClass('vjs-4-3');
                $('.miniplayer .video-js').addClass('vjs-16-9');
              }else if(video_ratio < 50){
                $('.miniplayer .video-js').removeClass('vjs-21-9');
                $('.miniplayer .video-js').removeClass('vjs-16-9');
                $('.miniplayer .video-js').removeClass('vjs-4-3');
                $('.miniplayer .video-js').addClass('vjs-21-9');
              }
            }


      });

      $('.miniplayer_watch_url').attr('url',url);



    }//end if miniplayer is not empty


      return false;
    }else{
      window.location.href = url;
    }
  }
  //end gotovideosite


//============================================================
//
//               Draggable DIV
//
//============================================================


//Make the DIV element draggagle:
if ( $("#miniplayer_box").length ){
  dragElement(document.getElementById("miniplayer_box"));
}

function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "_header")) {
    /* if present, the header is where you move the DIV from:*/
    document.getElementById(elmnt.id + "_header").onmousedown = dragMouseDown;
  } else {
    /* otherwise, move the DIV from anywhere inside the DIV:*/
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }


  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;

    var min_pos_top     = 0;
    var min_pos_left    = 0;
    var max_pos_top     = (window.innerHeight) - $('.miniplayer_box').height();
    var max_pos_left    = (window.innerWidth) - 334;


    // set the element's new position:
    if(elmnt.offsetLeft - pos1 < min_pos_left){
      elmnt.style.left = min_pos_left+"px";
    }else if(elmnt.offsetLeft - pos1 > max_pos_left){
      elmnt.style.left = max_pos_left+"px";
    }else{
      elmnt.style.left = (elmnt.offsetLeft - pos1)+"px";
    }

    if(elmnt.offsetTop - pos2 < min_pos_top){
      elmnt.style.top = min_pos_top+"px";
    }else if(elmnt.offsetTop - pos2 > max_pos_top ){
      elmnt.style.top = max_pos_top+"px";
    }else{
      elmnt.style.top = (elmnt.offsetTop - pos2)+"px";
    }



  }

  function closeDragElement() {
    /* stop moving when mouse button is released:*/
    document.onmouseup = null;
    document.onmousemove = null;
  }
}



//============================================================
//
//               user interaction
//
//============================================================

  //all
  var inactive_t = 0; //milisekunden


  $("body,html").bind("touchstart touchmove scroll mousemove mousedown DOMMouseScroll mousewheel keyup", function(){
    inactive_t = 0;
  });

  inter_test_interaction = setInterval(function()
  {
    inactive_t = inactive_t + 500;
    //afk_schutz: stop other intervals if afk here
    //clearInterval(interval xy);
  }, 500);



//============================================================
//
//               sethtmltitle
//
//============================================================

function sethtmltitle(htmltitle){
    document.title = htmltitle;
}



//============================================================
//
//               thumbvorschau
//
//============================================================

var oldide = 0, ide,  num = 1, looptime = 0;

function loadfun_thumbpreview(){

    $(".thumb_preview").mouseover(function() {
      //$('#'+ide).attr("id","");

      $(this).attr('id','vid_'+Math.floor((Math.random() * 10000) + 1));
      ide = $(this).attr('id');

      loadimg(ide);

      inter_thumb = setInterval(function(){
        loadimg(ide);
      },700);
    });



  function loadimg(ide){
      if($("#"+ide+":hover").length > 0 || $("#thumb_"+ide+":hover").length > 0) {

        if(ide == oldide || oldide == 0){
          var pre_vuid = $('#'+ide).attr('data-vuid');
          var path = $('#'+ide).attr('data-path');
          var time = $('#'+ide).attr('data-time');
          //var max_num = time - 1 / 21;
          max_num = 20; //Math.floor(max_num);
          if(looptime == 500){
            $("#thumb_"+ide).css('display', 'block');
            $('#'+ide).parent().find('.thumb_preview_counter').removeClass('hide');
            $('#'+ide).parent().find('.thumb_preview_counter').html(num+'/20');
            $('#'+ide).attr("src",path+"images/thumb/preview/"+pre_vuid+"/"+num+".jpg");
            looptime = 0;
          num++;
          }
          if(num > max_num){num=1;}
          oldide = ide;
        }else{
          num = 1;
          var old_pre_vuid = $('#'+oldide).attr('data-vuid');
          var old_path = $('#'+oldide).attr('data-path');
          if($('#'+oldide).attr('data-large') == 1){var size = "large_img";}else{var size = "small_img";}
          $("#thumb_"+oldide).css('display', 'none');
          $('#'+oldide).parent().find('.thumb_preview_counter').addClass('hide');
          $('#'+oldide).parent().find('.thumb_preview_counter').html('1/20');
          $('#'+oldide).attr("src",old_path+"images/thumb/"+size+"/"+old_pre_vuid+".jpg");
          $('#'+oldide).attr("id","");
          oldide = 0;
        }
      }else{
        num = 1;
        var old_pre_vuid = $('#'+oldide).attr('data-vuid');
        var old_path = $('#'+oldide).attr('data-path');
        if($('#'+oldide).attr('data-large') == 1){var size = "large_img";}else{var size = "small_img";}
        $("#thumb_"+oldide).css('display', 'none');
        $('#'+oldide).parent().find('.thumb_preview_counter').addClass('hide');
        $('#'+oldide).parent().find('.thumb_preview_counter').html('1/20');
        $('#'+oldide).attr("src",old_path+"images/thumb/"+size+"/"+old_pre_vuid+".jpg");
        $('#'+oldide).attr("id","");
        oldide = 0;
      }
    }



  clearInterval(inter_looptime);
  inter_looptime = setInterval(function(){
    if(looptime != 500){
      looptime = looptime + 100;
    }
  },100);

}


//============================================================
//
//               Friend management
//
//============================================================

function loadfun_friend(){

  $('.add_friend').unbind("click").click(function(){
    $('.fr_to_hide').addClass('hide');
    var data = add_friend( $(this).attr('friend_uuid') );
      if (typeof $(this).attr('isnavi') !== typeof undefined && $(this).attr('isnavi') !== false && data != "failed") { open_friend_menu(1); }
  });

  $('.accept_friend').unbind("click").click(function(){
    $('.fr_to_hide').addClass('hide');
    var data = accept_friend( $(this).attr('friend_uuid') );
      if (typeof $(this).attr('isnavi') !== typeof undefined && $(this).attr('isnavi') !== false && data != "failed") { open_friend_menu(1); }
  });

  $('.remove_friend').unbind("click").click(function(){
    $('.fr_to_hide').addClass('hide');
    var data = remove_friend( $(this).attr('friend_uuid') );
      if (typeof $(this).attr('isnavi') !== typeof undefined && $(this).attr('isnavi') !== false && data != "failed") { open_friend_menu(1); }
  });

  $('.block_friend').unbind("click").click(function(){
    $('.fr_to_hide').addClass('hide');
    var data = block_friend( $(this).attr('friend_uuid') );
      if (typeof $(this).attr('isnavi') !== typeof undefined && $(this).attr('isnavi') !== false && data != "failed") { open_friend_menu(1); }
  });

  $('.unblock_friend').unbind("click").click(function(){
    $('.fr_to_hide').addClass('hide');
    var data = unblock_friend( $(this).attr('friend_uuid') );
      if (typeof $(this).attr('isnavi') !== typeof undefined && $(this).attr('isnavi') !== false && data != "failed") { open_friend_menu(1); }
  });



  function add_friend(friend_uuid){ //anfrage -> action 1
    $.post(dhp+'friends/friend_management',{'friend_uuid':friend_uuid, 'action':1},function(data){
      if(data < 10 ){
        $('.friend_return_'+data).removeClass('hide'); return data;
      }else{
        $('.friend_error_1').removeClass('hide'); return "failed";
      }
    });
  }

  function accept_friend(friend_uuid){ //accept -> action 2
    $.post(dhp+'friends/friend_management',{'friend_uuid':friend_uuid, 'action':2},function(data){
      if(data < 10 ){
        $('.friend_return_'+data).removeClass('hide'); return data;
      }else{
        $('.friend_error_1').removeClass('hide'); return "failed";
      }
    });
  }

  function remove_friend(friend_uuid){ //entfernen / ablehnen / zurückziehen -> action 3
    $.post(dhp+'friends/friend_management',{'friend_uuid':friend_uuid, 'action':3},function(data){
      if(data < 10 ){
        $('.friend_return_'+data).removeClass('hide'); return data;
      }else{
        $('.friend_error_1').removeClass('hide'); return "failed";
      }
    });
  }

  function block_friend(friend_uuid){ //blockieren -> action 4
    $.post(dhp+'friends/friend_management',{'friend_uuid':friend_uuid, 'action':4},function(data){
      if(data < 10 ){
        $('.friend_return_'+data).removeClass('hide'); return data;
      }else{
        $('.friend_error_1').removeClass('hide'); return "failed";
      }
    });
  }

  function unblock_friend(friend_uuid){ //blockieren -> action 4
    $.post(dhp+'friends/friend_management',{'friend_uuid':friend_uuid, 'action':5},function(data){
      if(data < 10 ){
        $('.friend_return_'+data).removeClass('hide'); return data;
      }else{
        $('.friend_error_1').removeClass('hide'); return "failed";
      }
    });
  }


}



//============================================================
//
//               abonnieren click
//
//============================================================


function loadfun_sub_button(){

  $('.sub_btn').unbind("click").click(function(){

    var sub_user = $(this).attr('user');

    $.post(dhp+'ajax/sub',{'user':sub_user},function(data){

      if(data != "error"){
        if(data == 1 || data == 2){
        //ändere Button auf abonniet
        $('.sub_btn_'+sub_user).find('.abo_subed').removeClass('hide');
        $('.sub_btn_'+sub_user).find('.abo_sub').addClass('hide');

        var abos = parseInt($(".user-"+sub_user).html()) + 1;
        $(".user-"+sub_user).html(abos);


        }else if(data == 0){
        //ändere Button auf abonnieren
        $('.sub_btn_'+sub_user).find('.abo_sub').removeClass('hide');
        $('.sub_btn_'+sub_user).find('.abo_subed').addClass('hide');

        var abos = parseInt($(".user-"+sub_user).html()) - 1;
        $(".user-"+sub_user).html(abos);
        }
      }

    });

  });


  $('.sub_more_opt').unbind("click").click(function(){
    $('.bm_container_bg').removeClass('hide');
    $('.bm_pm_title').addClass('hide');
    $('.sub_group_pm_title').removeClass('hide');
    $('.body').addClass('stop_srolling');
    player.exitFullscreen();

    var abo_user_uuid = $(this).attr('sub_uuid');
    $.post(dhp+'subs/groups', {'sub_uuid': abo_user_uuid },function(data){
      $('.bm_pm_pl_container').html(data);
    });
  });




}
