//=============================================
///\/\/\/\/\/\/\  Javascript  /\/\/\/\/\/\/\/\
//\/\/\/\/\/\  Video Functionen  /\/\/\/\/\/\/
//=============================================
///\/\/\/\/\/\/\  We-TeVe.com /\/\/\/\/\/\/\/\
//\/\/\/\/\/\/\/   Sivan Fux  \/\/\/\/\/\/\/\/
//=============================================
///\/\/\/\/\/\/\  Version 4.0 /\/\/\/\/\/\/\/\
//\/\/\/\/\/\/\/  24.11.2018  \/\/\/\/\/\/\/\/
//=============================================

var dhp = _path;

//müssen globla sein -> können sonnst nicht gecleart werden und alle intervale bugen!!!
var inter_testvolum_change       = null;
var inter_add_playedtime         = null;
var inter_testvolum_change       = null;
var inter_test_inactiv           = null;
var inter_test_touch_interaction = null;
var inter_test_touch_inactiv     = null;
var inter_testvolum_is_changed   = null;
var inter_video_ended            = null;
var player;

function loadfun_video(miniplayer){


if ( $('#column2 video').length || miniplayer == 1) {  //if video auf der Seite

var big_play = 0;
var fsim;

if(Cookies.get('fsim') == "auto"){
  fsim = 'auto';
}else if(Cookies.get('fsim') == "on"){
  fsim = 'on';
}else if(Cookies.get('fsim') == "off"){
  fsim = 'off';
}else{
  fsim = 'auto';
}


//$.getScript("../video/video.js");
//$.getScript("../video/video-hotkey.js");


//Browser
if (/Firefox[\/\s](\d+\.\d+)/.test(navigator.userAgent)){ //test for Firefox/x.x or Firefox x.x (ignoring remaining digits);
 var ffversion=new Number(RegExp.$1) // capture x.x portion and store as a number
}else{
 var ffversion = 0;
}

var ua = window.navigator.userAgent;
var msie = ua.indexOf("MSIE ");
if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)){
  var internetwixxer = "1";
}

if((!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0){
  var opera = "1";
}else{
  var opera = "0";
}

var is_chrome = navigator.userAgent.indexOf('Chrome') > -1;
var is_explorer = navigator.userAgent.indexOf('MSIE') > -1;
var is_firefox = navigator.userAgent.indexOf('Firefox') > -1;
var is_safari = navigator.userAgent.indexOf("Safari") > -1;
var is_opera = navigator.userAgent.toLowerCase().indexOf("op") > -1;
if ((is_chrome)&&(is_safari)) {is_safari=false;}
if ((is_chrome)&&(is_opera)) {is_chrome=false;}


  if( $("#channel_video").length ){
    var player_name = "channel_video";
  }else{
    var player_name = "we-teve_video";
  }
  if( miniplayer == 1){
    var player_name = "we-teve_video";
  }

//minplayer destroy
if( $('#column2 video').length && $('.channel_home_main_container video').length == false && $('.miniplayer').html() != ""){
  videojs("we-teve_video").dispose();
  $('.miniplayer_box_header').html('');
  $('.miniplayer_box').addClass('hide');
  $('.miniplayer .video-js .vjs-backtowatch-control').addClass('hide');
  $('.miniplayer').html('');
  $('.miniplayer_watch_site').html('');
}

videojs(player_name).ready(function(){


      $('.video_blac').addClass('hide');
      $('.video-js').removeClass('hide');

      //Player ist von videoJS selber und video ist für das normale JavaScript
        player = videojs(player_name);


        if ($('video').length) {
          var video = document.getElementById(player_name);
        }else{
          var video = "";
        }

        var vid_autoplay   = $('.vid_info').attr('vid_autoplay');
        var video_duration = $('.vid_info').attr('long');
        var long_p         = $('.vid_info').attr('long_p');
        var defaultvolume  = $('.vid_info').attr('default_vol');
        var vid_hud        = $('.vid_info').attr('vid_hud');
        var defaultqualli  = $('.vid_info').attr('default_result');
        var org_resolution = $('.vid_info').attr('org_resolution');
        var avai_resolution= $('.vid_info').attr('available_resolution');
        var video_title    = $('.vid_info').attr('video_title');
        var datavuid       = $('.vid_info').attr('datavuid');
        var vuid           = $('.vid_info').attr('vuid');
        var vid_play,view_added;
        var played_time = 0;

        if(playlist_id != "not_set"){
          $('.vid_info').attr('playlist_id',playlist_id);
        }


      //set defaultvolume
        //alert(defaultvolume);
        player.volume(defaultvolume);

      //set video ratio
        var video_ratio_ar = org_resolution.split("x");
        var video_ratio = parseInt(video_ratio_ar[1]) / parseInt(video_ratio_ar[0]) * 100;

        $('.channel_home_main_container .video_container .video-js').addClass('vjs-fill');
        if($('.video_container .video-js').hasClass('vjs-fill') === false){
          if(video_ratio >= 75){
            $('.video_container .video-js').removeClass('vjs-21-9');
            $('.video_container .video-js').removeClass('vjs-16-9');
            $('.video_container .video-js').removeClass('vjs-4-3');
            $('.video_container .video-js').addClass('vjs-4-3');
          }else if(video_ratio < 75 && video_ratio > 50){
            $('.video_container .video-js').removeClass('vjs-21-9');
            $('.video_container .video-js').removeClass('vjs-16-9');
            $('.video_container .video-js').removeClass('vjs-4-3');
            $('.video_container .video-js').addClass('vjs-16-9');
          }else if(video_ratio <= 50){
            $('.video_container .video-js').removeClass('vjs-21-9');
            $('.video_container .video-js').removeClass('vjs-16-9');
            $('.video_container .video-js').removeClass('vjs-4-3');
            $('.video_container .video-js').addClass('vjs-21-9');
          }
        }

      //remove hud
        if(vid_hud == 'hide'){
          $('.video_container .vjs-text-track-display').remove();
          $('.video_container .vjs-control-bar').remove();
        }

      //autoplay
        /*if(vid_autoplay == '1'){

          if(is_safari == 1){
            video.oncanplay = function() {
              if(Cookies.get('v_'+vuid)){
                  var sec = Cookies.get('v_'+vuid);
                  if(video_duration - 5 < sec){
                    sec = 0;
                  }

                  player.currentTime(sec);
                  player.play();
              }else{
                player.play();
              }
              big_play = 1;

              $('.video_container .vjs-tech').attr('autoplay', true);
              $('.video_container .vjs-loading-spinner').removeAttr('style');

              if (typeof $('.video_container .vid_info').attr('skipto') !== undefined && $('.video_container .vid_info').attr('skipto') !== false) {
                player.currentTime($('.video_container .vid_info').attr('skipto'));
              }
            }

          }else{
              //test ob defaultvolume gesetzt wurde (gegen Hertzattacken bei voller lautstärke);
              var is_changed = 0;
              if(typeof inter_testvolum_is_changed != 'undefined'){ clearInterval(inter_testvolum_is_changed);}
                inter_testvolum_is_changed = setInterval(function(){
                  if(defaultvolume == player.volume() && is_changed == 0){
                    //alert(defaultvolume+">"+player.volume());
                    if(Cookies.get('v_'+vuid)){
                      var sec = Cookies.get('v_'+vuid);
                      if(video_duration - 5 < sec){
                        sec = 0;
                      }
                      player.currentTime(sec);
                      player.play();
                    }else{
                      player.play();
                    }
                    big_play = 1;

                    $('.video_container .vjs-tech').attr('autoplay', true);
                    $('.video_container .vjs-loading-spinner').removeAttr('style');

                    if (typeof $('.video_container .vid_info').attr('skipto') !== undefined && $('.video_container .vid_info').attr('skipto') !== false) {
                      player.currentTime($('.video_container .vid_info').attr('skipto'));
                    }

                    is_changed = 1;
                    clearInterval(inter_testvolum_is_changed);

                  }
                }, 1);
          }

        }else{

          if(Cookies.get('v_'+vuid)){
              var sec = Cookies.get('v_'+vuid);
              if(video_duration - 5 < sec){
                sec = 0;
              }
              player.currentTime(sec);
          }

          if (typeof $('.video_container .vid_info').attr('skipto') !== undefined && $('.video_container .vid_info').attr('skipto') !== false) {
            player.currentTime($('.video_container .vid_info').attr('skipto'));
          }

        }*/


      //load hotkeys plugin
      if($('.channel_home_main_container .video-js').lenght && $('.channel_home_main_container .video-js').attr('hotkey_loaded') != 1){

        videojs(player_name).hotkeys({
            volumeStep: 0.1,
            seekStep: 5,
            enableModifiersForNumbers: false
        });
        $('#'+player_name).attr('hotkey_loaded','1');

      }else if( $('.video-js').attr('hotkey_loaded') != 1 ){

        videojs('we-teve_video').hotkeys({
            volumeStep: 0.1,
            seekStep: 5,
            enableModifiersForNumbers: false
        });
        $('.video-js').attr('hotkey_loaded','1');

      }


      //set focus für die hotkeys
        $('#'+player_name).focus();
        $('.video_container .vjs-fullscreen-control').click(function(){ setTimeout(function(){ $('#'+player_name).focus(); },20); });



      //add view
        if($('.vid_info').attr('playlist_id') !== 'not_set'){var pl_info = $('.vid_info').attr('playlist_id');}else{var pl_info = "";}

        if(typeof inter_add_playedtime != 'undefined'){ clearInterval(inter_add_playedtime);}
          inter_add_playedtime = setInterval(function(){
    					if ( !player.paused() ) {
    						played_time++;
                $('.video_container .vjs-tech').attr('autoplay', true); //bei autoplay off, will es bei loop nicht erneut starten... ¯\_(ツ)_/¯

    						if(played_time > long_p && view_added != 1){
                  // / wird gelöscht:
    							$.post('/video/add_views',{'vuid':vuid, 'pl': pl_info});

    							view_added = 1;
    						}
                Cookies.set('v_'+vuid, player.currentTime(), { path: '/',secure  : true});
    					}
    			},1000);

      //end add view


      //update defaultvolume
        var old_volume = defaultvolume;
        if(typeof inter_testvolum_change != 'undefined'){ clearInterval(inter_testvolum_change);}
          inter_testvolum_change = setInterval(function(){
                if(played_time >= 1){
                  if ($('video').length) {
                    var new_volume = player.volume();
                    if(old_volume != new_volume)
                    {
                      Cookies.set('defaultvolume', new_volume, { expires: 100, path: '/',secure  : true});
                    }
                    old_volume = new_volume;
                  }
                }
          }, 1000);
      //end update defaultvolume


      //test ob video zu ende ist
      if(typeof inter_video_ended != 'undefined'){ clearInterval(inter_video_ended);}
        inter_video_ended = setInterval(function(){
          if(player.ended() == true){
            if($(".com_input").hasClass('com_in_focus') === false){
              if($('.vid_info').attr('playlist_id') !== 'not_set' && $('.vid_info').attr('in_pl') != "no"
              && $('.vid_info').attr('playlist_id') != "" && typeof $('.vid_info').attr('playlist_id') !== typeof undefined){
                if (typeof $('video').attr('loop') !== typeof undefined && $('video').attr('loop') !== false) {}else{
                  var next_video = $('.vid_info').attr('pl_next_vuid');

                  gotovideosite(dhp+'watch/'+next_video+'&pl='+$('.vid_info').attr('playlist_id'),'','0');
                }
              }else if($('.vid_info').attr('next_vuid') != "" && typeof $('.vid_info').attr('next_vuid') !== typeof undefined){
                if (typeof $('video').attr('loop') !== typeof undefined && $('video').attr('loop') !== false) {}else{
                  var next_video = $('.vid_info').attr('next_vuid');

                  gotovideosite(dhp+'watch/'+next_video,'','0');
                }
              }else{

              }
            }
          }
        },1000);



      //in Video preview
      if( $(".vjs-progress-holder .vid_in_preview").length < 1 ){
        $('.vjs-progress-holder').append("<div class='vid_in_preview'></div>");
      }

      $('.vjs-progress-holder').mousemove( function(e) {
        $('.vid_in_preview').css('display','block');

        var parentOffset = $(this).parent().offset();
        var hover_pos_from_left = e.pageX - parentOffset.left;
        var max_width = $('.vjs-progress-holder').width();
        var max_time = player.duration();

        var hover_time = Math.floor(max_time/(max_width/hover_pos_from_left) + 5);

        var new_pos = hover_pos_from_left - ($('.vid_in_preview').width() / 2);
          if(new_pos < 10){ new_pos = 10; }
          if(new_pos + $('.vid_in_preview').width() > max_width - 10 ){ new_pos = max_width - $('.vid_in_preview').width() - 10; }

        //set posi
        $('.vid_in_preview').css('left',new_pos);

        var get_img = Math.floor(hover_time/5/20);
        var get_img_pre = get_img + 1;
        var get_img2 = Math.floor(hover_time/5 - get_img*20);

        var img_pos;
        switch (get_img2) {
          case 1: img_pos = '-80em 0px'; break;     case 2: img_pos = '-96em 0px';     break;  case 3: img_pos = '-112em 0px';     break;  case 4: img_pos = '-128em 0px';     break; case 5: img_pos = '-144em 0px';     break;
          case 6: img_pos = '-80em -9em'; break;   case 7: img_pos = '-96em -9em';   break;  case 8: img_pos = '-112em -9em';   break;  case 9: img_pos = '-128em -9em';   break; case 10: img_pos = '-144em -9em';  break;
          case 11: img_pos = '-80em -18em'; break; case 12: img_pos = '-96em -18em'; break;  case 13: img_pos = '-112em -18em'; break;  case 14: img_pos = '-128em -18em'; break; case 15: img_pos = '-144em -18em'; break;
          default: img_pos = '-80em 0px';
        }

        $('.vid_in_preview').css('background-image', 'url('+dhp+'images/thumb/preview/'+vuid+'/pre'+get_img_pre+'.jpg)' );
        $('.vid_in_preview').css('background-position', img_pos);
      });


      $('.vjs-progress-holder').mouseleave( function() {
        $('.vid_in_preview').css('display','none');
      });

      //end invideo Preview



      //Channel_video_player click to remove the mini player
      $('.channel_home_main_container .video-js').unbind("click").click( function(){
        if( $('.channel_home_main_container .video-js').hasClass("vjs-has-started") == false && $('.miniplayer').html() != "" ){
          videojs("we-teve_video").dispose();
          $('.miniplayer_box').addClass('hide');
          $('.miniplayer .video-js .vjs-backtowatch-control').addClass('hide');
          $('.miniplayer').html("");
          $('.miniplayer_watch_site').html("");
        }
      });


      //miniplayer
      $('.miniplayer').on("keypress", function(e){
        if (e.keyCode === 102 || e.keyCode === 70) { loadfun_pl_w_videos(); }
      });

      $('.miniplayer video').unbind('dblclick').dblclick( function(e){
        loadfun_pl_w_videos();
      });


  if(vid_hud == 'show'){
      //zusatzinfos im video

        //linke und rechte spalte
        if(isMobile === false){ //nur am PC
          if( $(".video_container .video-js #video_full_info").length < 1 ){
            $(".video_container .video-js").append("<div id='video_full_info' class='video_full_info col-lg-3 col-spl'></div>");
            $(".video_container .video-js").append("<div id='user_full_info' class='user_full_info col-lg-2 col-spl'></div>");
          }

            var video_extra_info = $("#column3").html();
            $("#video_full_info").html(video_extra_info);

            var user_extra_info = $("#column1").html();
            $("#user_full_info").html(user_extra_info);

            //functionen load
              loadfun_thumbpreview();
              loadfun_sub_button();
              if (typeof loadfun_more_vids !== "undefined") { loadfun_more_vids(); }
              coms_loaded();
        }

        // mobile touch navigation / soll auch für laptops mit touch gehn (wird erst angezeigt wenn man auch das video toucht)
          if( $(".video_container .video-js #video_mobile_navi").length < 1 ){
            $(".video_container .video-js").append("<div id='video_mobile_navi' class='video_mobile_navi fade_out_hide'></div>");
            $(".video_container #video_mobile_navi").html("<div class='mobile_controls'> <span class='mobile_video_btn mobile_pause_btn vjs-play-control vjs-icon-pause'></span> <span class='mobile_video_btn mobile_play_btn vjs-play-control vjs-icon-play hide'> </span> </div> "); //navigation
          }


        //miniplayer back to watch site
          if( $(".video_container .vjs-control-bar .vjs-backtowatch-control").length < 1 ){
            $("<div tabindex='0' class='vjs-backtowatch-control'> <span class='glyphicon glyphicon-arrow-right'></span> </div>").insertAfter( $('.video_container .vjs-fullscreen-control') );
          }



        //playlist controll
          setTimeout(function(){
          //prev
            if( $(".video_container .vjs-control-bar .vjs-prev-control").length < 1 ){
              $("<div tabindex='0' class='vjs-prev-control vjs-pl-control hide'> <span class='glyphicon glyphicon-step-backward'></span> </div>").insertBefore( $('.video_container .vjs-pl-play-control') );
            }

          //next
            if( $(".video_container .vjs-control-bar .vjs-next-control").length < 1 ){
              $("<div tabindex='0' class='vjs-next-control vjs-pl-control hide'> <span class='glyphicon glyphicon-step-forward'></span> </div>").insertAfter( $('.video_container .vjs-pl-play-control') );
            }

          //remove die die zuviel sind
          $('.video_container .mobile_controls.vjs-next-control').remove();
          },10);




        //videotitel
          video_title = video_title.replace(/[\u00A0-\u9999<>\&]/gim, function(i) {return '&#'+i.charCodeAt(0)+';';});
          if( $(".video_container .vjs-control-bar .fullscreen_videotitle").length < 1 ){
            $(".video_container .vjs-control-bar").append("<div class='vjs-control fullscreen_videotitle' >"+video_title+"</div>");
          }else{
            $('.video_container .fullscreen_videotitle').html(video_title);
          }

        //fullscreen Infos switcher
          if(isMobile === false){ //nur am PC

            //coockie vals
            if( $(".video_container .vjs-control-bar .fullscreen_infos_menu").length < 1 ){

              $("<div tabindex='0' class='fullscreen_infos_switcher'> <span class='glyphicon glyphicon-comment'> </span> </div> <div class='fullscreen_infos_menu hide'> <div val='auto' class='fsim_auto fsim_txt'><b class='point'> </b>Auto</div> <div val='on' class='fsim_on fsim_txt'><b class='point'></b>On</div><div val='off' class='fsim_off fsim_txt'><b class='point'></b>Off</div></div> <div class='fsim_arrow hide'><span class='glyphicon glyphicon-triangle-bottom'></span></div>").insertBefore( $('.video_container .vjs-fullscreen-control') );

              $('.video_container .fsim_'+fsim).html("<b class='point'>• </b>"+$('.fsim_'+fsim).html());
            }
          }else{
            $('.video_container .vjs-captions-button').css('right','55px'); //verschiebt den untertietel button
          }


        // result_switch button
          if( $(".vjs-control-bar .result_switch_menu").length < 1 ){
            $("<div tabindex='0'  class='result_switcher'> <span class='glyphicon glyphicon glyphicon-cog'> </span> </div><div class='result_switch_menu hide'></div> <div class='result_arrow hide'><span class='glyphicon glyphicon-triangle-bottom'></span></div>").insertBefore( $('.vjs-fullscreen-control') );
          }

          if(avai_resolution.search("2160") >= 0){var res2160 = "<div id='2160p'     res='2160p'     class='result_txt 2160p result'>2160p</div>";}else{var res2160 = "";}
          if(avai_resolution.search("1440") >= 0){var res1440 = "<div id='1440p'     res='1440p'     class='result_txt 1440p result'>1440p</div>";}else{var res1440 = "";}
          if(avai_resolution.search("1080") >= 0){var res1080 = "<div id='1080p'     res='1080p'     class='result_txt 1080p result'>1080p</div>";}else{var res1080 = "";}
          if(avai_resolution.search("720") >= 0){var res720 = "<div   id='720p'      res='720p'      class='result_txt 720p result'>720p</div>";}else{var res720 = "";}
          if(avai_resolution.search("480") >= 0){var res480 = "<div   id='480p'      res='480p'      class='result_txt 480p result'>480p</div>";}else{var res480 = "";}
          if(avai_resolution.search("360") >= 0){var res360 = "<div   id='360p'      res='360p'      class='result_txt 360p result'>360p</div>";}else{var res360 = "";}
          if(avai_resolution.search("240") >= 0){var res240 = "<div   id='240p'      res='240p'      class='result_txt 240p result'>240p</div>";}else{var res240 = "";}
          var resav = "<div id='audioviso' res='audioviso' class='result_txt audioviso result'>AV</div>";

          var results = res2160+" "+res1440+" "+res1080+" "+res720+" "+res480+" "+res360+" "+res240+" "+resav;
          $(".result_switch_menu").html(results);

          //setzt den punkt vor der standerdquallität
          $("."+defaultqualli).html( "<b class='respoint'>• </b>" + $("."+defaultqualli).html() );


            setTimeout(function(){
              if (typeof loadfun_icon_btn !== "undefined") {
                loadfun_icon_btn();
              }
            },10);


        //button function
          $('.result_switcher').unbind('click').click( function(){
              $('.result_switch_menu,.result_arrow').toggleClass('hide');
          });
          $('.result_switcher').unbind('keypress').on("keypress", function(e) {
            if (e.keyCode === 13) {

              $('.result_switch_menu,.result_arrow').toggleClass('hide');
                $('.fullscreen_infos_menu,.fsim_arrow').addClass('hide');
                $('.fsim_txt').removeAttr('tabindex');

              if( $('.result_switch_menu,.result_arrow').hasClass('hide') ){
                $('.result_txt').removeAttr('tabindex');
              }else{
                $('.result_txt').attr('tabindex','0');
              }
            }
          });


        //click auf link in der Videobeschreibung
          setTimeout(function(){
            $('.video_container .video_description').find('a').unbind('click').click( function(){
              if(!$(this).hasClass("vid_t_stamp")){
                player.pause();
              }
            });
          },100);

          //hide
          $(document).mouseup(function (e){
              var container = $('.result_switcher');
              var container2 = $('.result_switch_menu');

              if (!container.is(e.target) && container.has(e.target).length === 0 && !container2.is(e.target) && container2.has(e.target).length === 0)
              {
                $('.video_container .result_switch_menu,.result_arrow').addClass('hide');
              }
          });

      //end zusatzinfos im video


      //result_switch_function

        $('.result').unbind('click').click(function(){
          var res = $(this).attr('res');
          $('.video_container b.respoint').html('');
          $(this).html("<b class='respoint'>• </b>"+$(this).html());

          setTimeout(function(){
            $('.video_container .result_switch_menu,.result_arrow').addClass('hide');
          },20);

          switchres(datavuid,res,0,0,0);
        });

        $('.result').unbind('keypress').on("keypress", function(e) {
          if (e.keyCode === 13) {
            var res = $(this).attr('res');
            $('.video_container b.respoint').html('');
            $(this).html("<b class='respoint'>• </b>"+$(this).html());

            setTimeout(function(){
              $('.video_container .result_switch_menu,.result_arrow').addClass('hide');
            },20);

            switchres(datavuid,res,0,0,1);
            $('.video_container video').focus();
          }
        });


      //zusatzinfos im video ein und ausblenden  (option: automatisch)
        if(isMobile === false){ //nur am PC
          if(typeof inter_test_inactiv != 'undefined'){ clearInterval(inter_test_inactiv);}
          inter_test_inactiv = setInterval(function(){
            if(fsim == 'auto'){
                //at doing nothing
                if($('.video_container .video-js').hasClass('vjs-fullscreen') === true){
                  if(inactive_t >= 2500 && !player.paused() && $('.video_full_info').is(':hover') === false){
                    $('.video_container .video_full_info').addClass('full_info-fade-out');
                  }else{
                    $('.video_container .video_full_info').removeClass('full_info-fade-out');
                  }

                  if(inactive_t >= 2500 && !player.paused() && $('.video_container .user_full_info').is(':hover') === false){
                    $('.video_container .user_full_info').addClass('full_info-fade-out');
                  }else{
                    $('.video_container .user_full_info').removeClass('full_info-fade-out');
                  }
                }else{
                  $('.video_container .user_full_info').removeClass('full_info-fade-out');
                  $('.video_container .video_full_info').removeClass('full_info-fade-out');
                }

                //at hoverig
                if(!player.paused() && $('.video_container .video-js').hasClass('vjs-fullscreen') === true){
                  if( $('.video_container .video_full_info').is(':hover') === true){
                    $('.video_container .user_full_info').addClass('fade_out_hide');
                    $('.video_container .vjs-control-bar').addClass('hide');
                  }

                  if( $('.video_container .user_full_info').is(':hover') === true){
                    $('.video_container .video_full_info').addClass('fade_out_hide');
                    $('.video_container .vjs-control-bar').addClass('hide');
                  }

                  if( $('.video_container .user_full_info').is(':hover') === false && $('.video_container .video_full_info').is(':hover') === false){
                    $('.video_container .video_full_info').removeClass('fade_out_hide');
                    $('.video_container .user_full_info').removeClass('fade_out_hide');
                    $('.video_container .vjs-control-bar').removeClass('hide');
                  }

                }else{
                  $('.video_container .video_full_info').removeClass('hide');
                  $('.video_container .user_full_info').removeClass('hide');
                  $('.video_container .vjs-control-bar').removeClass('hide');
                }
             }else if(fsim == 'off'){ //end if auto
               $('.video_container .video_full_info').addClass('hide');
               $('.video_container .user_full_info').addClass('hide');
             }//end if off
          }, 100);
        }


  //end zusatzinfos im video ein und ausblenden

    //fullscreen Infos switcher
      if(isMobile === false){ //nur am PC

        $('.video_container .fullscreen_infos_switcher').unbind('click').click(function(){
          $('.video_container .fullscreen_infos_menu,.fsim_arrow').toggleClass('hide');
        });
        $('.video_container .fullscreen_infos_switcher').unbind('keypress').on("keypress", function(e) {
          if (e.keyCode === 13) {

            $('.video_container .fullscreen_infos_menu,.fsim_arrow').toggleClass('hide');
              $('.video_container .result_switch_menu,.result_arrow').addClass('hide');
              $('.video_container .result_txt').removeAttr('tabindex');

            if( $('.video_container .fullscreen_infos_menu,.fsim_arrow').hasClass('hide') ){
              $('.video_container .fsim_txt').removeAttr('tabindex');
            }else{
              $('.video_container .fsim_txt').attr('tabindex','0');
            }
          }
        });

        $(document).mouseup(function (e){
            var container = $('.video_container .fullscreen_infos_switcher');
            var container2 = $('.video_container .fullscreen_infos_menu');

            if (!container.is(e.target) && container.has(e.target).length === 0 && !container2.is(e.target) && container2.has(e.target).length === 0)
            {
              $('.video_container .fullscreen_infos_menu,.fsim_arrow').addClass('hide');
            }
        });

        $('.video_container .fsim_txt').unbind('click').click(function(){

          var val = $(this).attr('val');
          $('.video_container b.point').html('');
          $(this).html("<b class='point'>• </b>"+$(this).html());
          fsim = val;

          $('.video_container .video_full_info').removeClass('hide');
          $('.video_container .user_full_info').removeClass('hide');

          Cookies.set('fsim', val, { expires: 100, path: '/',secure  : true});

          setTimeout(function(){
            $('.video_container .fullscreen_infos_menu,.fsim_arrow').addClass('hide');
          },10);
        });

        $('.video_container .fsim_txt').unbind('keypress').on("keypress", function(e) {
          if (e.keyCode === 13) {
            var val = $(this).attr('val');
            $('.video_container b.point').html('');
            $(this).html("<b class='point'>• </b>"+$(this).html());
            fsim = val;

            $('.video_container .video_full_info').removeClass('hide');
            $('.video_container .user_full_info').removeClass('hide');

            Cookies.set('fsim', val, { expires: 100, path: '/',secure  : true});

            setTimeout(function(){
              $('.video_container .fullscreen_infos_menu,.fsim_arrow').addClass('hide');
            },10);
            $('.video_container video').focus();
          }
        });



      }



      //mobile navigation
          $('.video-js').on({ 'touchstart' : function(){
              $('.video_mobile_navi').toggleClass('fade_out_hide');
          } });


          $('.mobile_pause_btn').unbind('click').click(function(){
            player.pause();
            $('.mobile_pause_btn').addClass('hide');
            $('.mobile_play_btn').removeClass('hide');
          });

          $('.mobile_play_btn').unbind('click').click(function(){
            player.play();
            $('.mobile_play_btn').addClass('hide');
            $('.mobile_pause_btn').removeClass('hide');
          });


          player.on("pause", function(){
            $('.mobile_pause_btn').addClass('hide');
            $('.mobile_play_btn').removeClass('hide');
          });

          player.on("play", function(){
            $('.mobile_play_btn').addClass('hide');
            $('.mobile_pause_btn').removeClass('hide');
          });


          //touch vor video

          var inactive_touch_t = 0; //milisekunden

          $('video').on({ 'touchstart' : function(){
            inactive_touch_t = 0;
          } });

          if(typeof inter_test_touch_interaction != 'undefined'){ clearInterval(inter_test_touch_interaction);}
            inter_test_touch_interaction = setInterval(function(){
              inactive_touch_t = inactive_touch_t + 500;
              //afk_schutz: stop other intervals if afk here
              //clearInterval(interval xy);
            }, 500);

          if(typeof inter_test_touch_inactiv != 'undefined'){ clearInterval(inter_test_touch_inactiv);}
            inter_test_touch_inactiv = setInterval(function(){
                if(inactive_touch_t >= 2500 && !player.paused() && $('.video_mobile_navi').is(':visible') ){
                  $('.video_mobile_navi').addClass('fade_out_hide');
                }
            }, 100);




      //video stay on top on mobile
      if(isMobile === true){
        var $window = $(window);

          $window.scroll(function() {
              var distance = $('.sticky-video').offset().top;

              if($window.height() > $window.width()){
                if ( $window.scrollTop() >= distance ) {
                  $('.sticky-video').height( $('.vjs-tech').height() );
                  $('.video_container #we-teve_video').addClass('stick');

                  //navi_dropdown schliessen
                    $('.messages_dropdown').addClass('hide'); $('.messages_dd_arrow').addClass('hide');
                    $('.messages_dropdown').html("<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");

                    $('.level_dropdown').addClass('hide'); $('.level_dd_arrow').addClass('hide');
                    $('.level_dropdown').html("<div class='blanc_load_spinner'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></div>");

                }else{
                  $('.video_container #we-teve_video').removeClass('stick');
                  $('.sticky-video').height(0);
                }
              }else{
                $('.video_container #we-teve_video').removeClass('stick');
                $('.sticky-video').height(0);
              }
          });
      }

  } //end if(vid_hud == 'hide')


}); //if player ready

} // end if video exist

} //end loadfun_video




function switchres(datavuid,res,backtozero,unpause,miniplayer){

  //Browser
  if (/Firefox[\/\s](\d+\.\d+)/.test(navigator.userAgent)){ //test for Firefox/x.x or Firefox x.x (ignoring remaining digits);
   var ffversion=new Number(RegExp.$1) // capture x.x portion and store as a number
  }else{
   var ffversion = 0;
  }

  var ua = window.navigator.userAgent;
  var msie = ua.indexOf("MSIE ");
  if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)){
    var internetwixxer = "1";
  }

  if((!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0){
    var opera = "1";
  }else{
    var opera = "0";
  }

  var is_chrome = navigator.userAgent.indexOf('Chrome') > -1;
  var is_explorer = navigator.userAgent.indexOf('MSIE') > -1;
  var is_firefox = navigator.userAgent.indexOf('Firefox') > -1;
  var is_safari = navigator.userAgent.indexOf("Safari") > -1;
  var is_opera = navigator.userAgent.toLowerCase().indexOf("op") > -1;
  if ((is_chrome)&&(is_safari)) {is_safari=false;}
  if ((is_chrome)&&(is_opera)) {is_chrome=false;}


  //$(".result_options").html(results);
  var video = document.getElementsByTagName("video")[0];
  $('.video_container .vjs-big-play-button').addClass('hide');
  $('.video_container .vjs-loading-spinner').show();


  if( $("#channel_video").length ){
    var player_name = "channel_video";
  }else{
    var player_name = "we-teve_video";
  }
  if( miniplayer == 1 ){
    var player_name = "we-teve_video";
  }

  player = videojs(player_name);


  if(backtozero == 0){
    var ctime = player.currentTime();
  }else{
    var ctime = 0;
  }

  if(res != "audioviso"){
    c_res = res.replace("p", "");
    Cookies.set('result', c_res, { expires: 100, path: '/',secure  : true});
  }else{
    Cookies.set('result', 120, { expires: 100, path: '/',secure  : true});
  }

  var ifplaying = player.paused();

  player.muted(true);
  player.pause();


    player.src(dhp+"videos/"+datavuid+"/"+res+".mp4");
    player.load();

    $('.video_container .vjs-big-play-button').removeClass('hide');
    $('.video_container .vjs-loading-spinner').removeAttr('style');

  if (internetwixxer == 1 || (ffversion <46 && ffversion> 30)){  // If Internet Explorer, return version number

    video.oncanplay = function() {
      player.currentTime(ctime);
      if(ifplaying === true && unpause == 0){
        player.pause();
      }else{
        player.play();
      }
      player.muted(false);
    }

  }else if(is_safari == 1){

    //alert('safari');

    video.oncanplay = function() {
      player.currentTime(ctime);

      if(typeof spinervis != 'undefined'){ clearInterval(spinervis);}
        var spinervis = setInterval( function(){
          if($('.video_container .vjs-loading-spinner').is(":visible") == false){
            player.play();
            player.muted(false);
            clearInterval(spinervis);
          }
        },80);
    }

  }else{

    player.play();
    player.currentTime(ctime);
    player.muted(false);

    if(ifplaying === true && unpause == 0){
      video.oncanplay = function() {player.pause(); }
    }else{
      video.oncanplay = function() {player.play(); }
    }

  }

}
//end result_switch_function




//skip to function
function vid_skip_to(sec){

  var vid = document.getElementsByTagName('video')[0];
  /*if (internetwixxer == 1 || (ffversion <46 && ffversion> 30))  // If Internet Explorer, return version number
  {
    vid.addEventListener("canplay",function(){vid.currentTime = sec;});
  }*/

  vid.currentTime = sec;

  var isPlaying = vid.currentTime > 0 && !vid.paused && !vid.ended && vid.readyState > 2;
    if (!isPlaying){
      vid.play();
    }
}
//end skip to function

function vid_pause(){
  var vid = document.getElementsByTagName('video')[0];

  var isPlaying = vid.currentTime > 0 && !vid.paused && !vid.ended && vid.readyState > 2;
    if (isPlaying){
      vid.pause()
    }
  return false;
}

function vid_play(){
  var vid = document.getElementsByTagName('video')[0];

  var isPlaying = vid.currentTime > 0 && !vid.paused && !vid.ended && vid.readyState > 2;
    if (!isPlaying){
      vid.play();
    }
  return false;
}
