<?php

class language extends user{

  public $htmldata              = "en";

//=========================================================================================================
//=========================================================================================================
//================ auf allen Seiten  ======================================================================
//=========================================================================================================
//=========================================================================================================

  public $hometitle             = "The user-oriented video platform";
  public $home                  = "Home";

  public $showmore              = "Show more";
  public $showless              = "Show less";
  public $loadmore              = "Load laden";
  public $loading               = "Loading...";

  public $error_text            = "An unknown error has occurred!";

  public $save                  = "Save";

  public $yes_del               = "Yes, Delete!";
  public $no_del                = "Cancel";



  //===================== coinhive ========================

  public $coinhive_js_error     = "Unblock authedmine.com and reload this page!";
  public $coinhive_site_error   = "<h2 class='blue'>At confirmation:</h2>Just reload the page! You then get to the side.<br/><br/> <h2 class='red'>If rejected:</h2>In order to use this page you have to provide all but a maximum of 37% of your computing power. <br/><span class='blue'>In exchange, there is no advertising on the site!</span>";

  public $coinhive_why_title    = "Why we need your PC power";
  public $coinhive_why_stitle1  = "No advertising!";
  public $coinhive_why_stitle2  = "No censorship!";
  public $coinhive_why_stitle3  = "No strong fluctuations in revenue!";
  public $coinhive_why_stitle4  = "No inequality!";

  public $coinhive_why_text1    = "For making your PC power available, you do not have to endure annoying ads!";
  public $coinhive_why_text2    = "Without advertising, there are also no people who have problems with the content, which comes after the advertisement!";
  public $coinhive_why_text3    = "Without advertising you are not dependent on seasons, contract extensions etc.!";
  public $coinhive_why_text4    = "Without advertising, there is no content that has a better audience than another and is therefore better paid!";

  public $coinhive_video_payout_title = "Payments";
  public $coinhive_video_payout_text = "Payments are only made, which are generated from the start on of the partnership. <a href=/r/go_partner>Become a partner</a>";



  //===================== Navi ========================

  public $my_channel_title      = "My channel";
  public $my_subs_title         = "My subs";
  public $my_recoms_title       = "Recommended videos";
  public $myvideo_title         = "My videos";
  public $options_title         = "Options";
  public $partner_title         = "Partner Dashboard";
  public $admin_title           = "Admin";
  public $logout_title          = "Log out";


  public $playlists_title       = "Playlists";

  public $bookmark_title        = "Bookmarks";


  public $footertitle1          = "Data protection";
  public $footertitle2          = "Terms of Use";
  public $footertitle3          = "Copyright";
  public $footertitle4          = "Community Guidelines";
  public $footertitle5          = "Imprint";
  public $footertitle6          = "Disclaimer";
  public $footertitle7          = "Supporter";
  public $footertitle8          = "Become a partner";


  /*Dropdown-boxen*/

  /*Level*/
  public $level_now_title       = "Current level";

  public $level_now_text0       = "Only";
  public $level_now_text01      = "to the next level";


  public $level_diary_title     = "Level diary";


  /*notification*/
  public $not_title_type2       = "You reached level ";
  public $not_title_type21      = "";

  public $not_title_type4       = "New comment";
  public $not_title_type41      = "New answer";

  public $not_title_type5       = "Your comment is voted positiv";
  public $not_title_type6       = "Your channel has a new subscriber";
  public $not_title_type7       = "Your video is voted positiv";
  public $not_title_type10      = "New friend requests";
  public $not_title_type11      = "A friend is online now";


  public $not_text_type2        = "Friends slots";

  public $not_text_type4        = "commented on your video";
  public $not_text_type41       = "answered your comment";

  public $not_text_type5        = "rated your comment positiv";
  public $not_text_type6        = "subscribed to your channel";
  public $not_text_type7        = "rated your video positiv";
  public $not_text_type10       = "would like to add you as a friend";
  public $not_text_type11       = "is now online";


  /*messages*/
  public $mes_title             = "Messages";
  public $mes_title_empty       = "You do not have any messages!";

  public $mes_text_type4        = "commented on your video";
  public $mes_text_type41       = "answered your comment";


  public $mes_title_type5       = "and";
  public $mes_title_type51      = "more";

  public $mes_text_type5        = "have";
  public $mes_text_type50       = "has";
  public $mes_text_type51       = "your comment";
  public $mes_text_type52       = "voted positiv";


  public $mes_title_type6       = "and";
  public $mes_title_type61      = "more";

  public $mes_text_type6        = "have subscribed to your channel";
  public $mes_text_type60       = "has subscribed to your channel";


  public $mes_title_type7       = "and";
  public $mes_title_type71      = "more";

  public $mes_text_type7        = "have";
  public $mes_text_type70       = "has";
  public $mes_text_type71       = "your video";
  public $mes_text_type72       = "voted positiv";


  /*friends*/
  public $fri_title             = "Friends";
  public $fri_title_empty       = "You do not have any friends yet!";
  public $fri_new_title         = "Friend requests";
  public $fri_new_add_title     = "Sent friend requests";

  public $fri_offline_title     = "Offline";
  public $fri_online_title      = "Online";

  public $fri_accept_title      = "Accept";
  public $fri_reject_title      = "Deny";
  public $fri_delete_title      = "Remove";
  public $fri_block_title       = "Block";


  //================= Video vorschläge ===============

    public $views_title = "Views";



  //========================= Time ===================

  public $time_vor1 = ""; //wenn deutsch
  public $time_vor2 = "ago"; //wenn englisch
  public $time_eine = "A"; //wenn englisch
  public $time_ein = "An"; //wenn englisch
  public $time_einer = "one";
  public $time_einem = "one";
  public $time_einem_a = "A";


  public $time_sekunde = "second";
  public $time_sekunden = "seconds";

  public $time_minute = "minute";
  public $time_minuten = "minutes";

  public $time_stunde = "hour";
  public $time_stunden = "hours";

  public $time_tage = "day";
  public $time_tagen = "days";

  public $time_woche = "week";
  public $time_wochen = "weeks";

  public $time_monate = "month";
  public $time_monaten = "months";

  public $time_jahr = "year";
  public $time_jahren = "years";



  //====================== Monate =====================

  public $monat_january         = "January";
  public $monat_february        = "February";
  public $monat_march           = "March";
  public $monat_april           = "April";
  public $monat_may             = "May";
  public $monat_june            = "June";
  public $monat_july            = "July";
  public $monat_august          = "August";
  public $monat_september       = "September";
  public $monat_october         = "October";
  public $monat_november        = "November";
  public $monat_december        = "December";



  //====================== Länder =====================

  public $land_label_eg         = "Ägypten";
  public $land_label_dz         = "Algerien";
  public $land_label_ar         = "Argentinien";
  public $land_label_az         = "Aserbaidschan";
  public $land_label_au         = "Australien";
  public $land_label_bh         = "Bahrain";
  public $land_label_be         = "Belgien";
  public $land_label_ba         = "Bosnien und Herzegowina";
  public $land_label_br         = "Brasilien";
  public $land_label_bg         = "Bulgarien";
  public $land_label_cl         = "Chile";
  public $land_label_dk         = "Dänemark";
  public $land_label_de         = "Deutschland";
  public $land_label_ee         = "Estland";
  public $land_label_fi         = "Finnland";
  public $land_label_fr         = "Frankreich";
  public $land_label_ge         = "Georgien";
  public $land_label_gh         = "Ghana";
  public $land_label_gr         = "Griechenland";
  public $land_label_hk         = "Hongkong";
  public $land_label_in         = "Indien";
  public $land_label_id         = "Indonesien";
  public $land_label_iq         = "Irak";
  public $land_label_ie         = "Irland";
  public $land_label_is         = "Island";
  public $land_label_il         = "Israel";
  public $land_label_it         = "Italien";
  public $land_label_jm         = "Jamaika";
  public $land_label_jp         = "Japan";
  public $land_label_ye         = "Jemen";
  public $land_label_jo         = "Jordanien";
  public $land_label_ca         = "Kanada";
  public $land_label_kz         = "Kasachstan";
  public $land_label_qa         = "Katar";
  public $land_label_ke         = "Katar";
  public $land_label_co         = "Kolumbien";
  public $land_label_hr         = "Kroatien";
  public $land_label_kw         = "Kuwait";
  public $land_label_lv         = "Lettland";
  public $land_label_lb         = "Libanon";
  public $land_label_li         = "Liechtenstein";
  public $land_label_lt         = "Litauen";
  public $land_label_lu         = "Luxemburg";
  public $land_label_mk         = "Makedonien";
  public $land_label_my         = "Malaysia";
  public $land_label_ma         = "Marokko";
  public $land_label_mx         = "Mexiko";
  public $land_label_me         = "Montenegro";
  public $land_label_np         = "Nepal";
  public $land_label_nz         = "Neuseeland";
  public $land_label_nl         = "Niederlande";
  public $land_label_ng         = "Nigeria";
  public $land_label_no         = "Norwegen";
  public $land_label_om         = "Oman";
  public $land_label_at         = "Österreich";
  public $land_label_pw         = "Palau";
  public $land_label_pk         = "Pakistan";
  public $land_label_pe         = "Peru";
  public $land_label_ph         = "Philippinen";
  public $land_label_pl         = "Polen";
  public $land_label_pt         = "Portugal";
  public $land_label_pr         = "Puerto Rico";
  public $land_label_ro         = "Rumänien";
  public $land_label_ru         = "Russland";
  public $land_label_sa         = "Saudi-Arabien";
  public $land_label_se         = "Schweden";
  public $land_label_ch         = "Schweiz";
  public $land_label_sn         = "Senegal";
  public $land_label_rs         = "Serbien";
  public $land_label_zw         = "Simbabwe";
  public $land_label_sg         = "Singapur";
  public $land_label_sk         = "Slowakei";
  public $land_label_si         = "Slowenien";
  public $land_label_es         = "Spanien";
  public $land_label_lk         = "Sri Lanka";
  public $land_label_za         = "Südafrika";
  public $land_label_kr         = "Südkorea";
  public $land_label_tw         = "Taiwan";
  public $land_label_tz         = "Tansania";
  public $land_label_th         = "Thailand";
  public $land_label_cz         = "Tschechien";
  public $land_label_tn         = "Tunesien";
  public $land_label_tr         = "Türkei";
  public $land_label_ug         = "Uganda";
  public $land_label_ua         = "Ukraine";
  public $land_label_hu         = "Ungarn";
  public $land_label_us         = "USA";
  public $land_label_ae         = "Vereinigten Arabischen Emirate";
  public $land_label_gb         = "Vereinigtes Königreich";
  public $land_label_vn         = "Vietnam";
  public $land_label_by         = "Weissrussland";



  //===================== Kategorie ===================

  public $cat_ent_title         = "Entertainment";
  public $cat_com_title         = "Comedy";
  public $cat_mov_title         = "Movie";
  public $cat_mus_title         = "Music";
  public $cat_gam_title         = "Games";
  public $cat_eat_title         = "Food";
  public $cat_spo_title         = "Sports";
  public $cat_vlo_title         = "Vlog";
  public $cat_ads_title         = "Advertising";



  //====================== Sprachen ===================

  public $lang_label_de         = "German";
  public $lang_label_en         = "English";
  public $lang_label_fr         = "French";



  //====================== Color ======================

  public $color_blue            = "blue";
  public $color_green           = "green";
  public $color_red             = "red";
  public $color_orange          = "orange";
  public $color_white           = "white";
  public $color_black           = "black";



  //====================== Mail =======================

  public $mail_service_title      = "Service E-Mail";


  //login
  public $mail_login_subject    = "Verification code for your login on We-TeVe.com";
  public $mail_login_text_1     = "Hello";
  public $mail_login_text_2     = "Nice to see you again.";
  public $mail_login_text_3     = "Here is your validation code for your login:";

  //regin
  public $mail_regin_subject    = "Verification code for your registration on We-TeVe.com";
  public $mail_regin_text_1     = "Hello";
  public $mail_regin_text_2     = "Thank you for registering on We-TeVe!";
  public $mail_regin_text_3     = "Here's your validation code to complete your registration:";

  //new_mail_code
  public $mail_new_mc_subject   = "Confirmation code for emailing your We-TeVe.com account";
  public $mail_new_mc_text_1    = "Hello";
  public $mail_new_mc_text_2    = "So that you can use this e-mail address as a new e-mail address,";
  public $mail_new_mc_text_3    = "you get this validation code you can enter in the options for confirmation.";
  public $mail_new_use_info     = "Copy and paste the above validation code into the field provided on the website.<br/>";

  //new_pw
  public $mail_new_pw_subject   = "Your We-TeVe account password has changed successfully";
  public $mail_new_pw_text_1    = "Hello";
  public $mail_new_pw_text_2    = "Your We-TeVe account password has changed successfully.";
  public $mail_new_pw_text_3    = "";

  //new_mail
  public $mail_new_mail_subject   = "Your e-mail address for your We-TeVe account has been successfully changed";
  public $mail_new_mail_text_1    = "Hello";
  public $mail_new_mail_text_2    = "Your e-mail address for your We-TeVe account has been successfully changed.";
  public $mail_new_mail_text_3    = "";

  //new_paymentinfos
  public $mail_new_payment_subject   = "Your payment account for your We-TeVe account has been successfully changed";
  public $mail_new_payment_text_1    = "Hello";
  public $mail_new_payment_text_2    = "Your payment account for your We-TeVe account has been successfully changed.";
  public $mail_new_payment_text_3    = "";

  public $mail_use_info         = "Copy the above validation code and add it to the field provided on the website.<br/>
                                <br/>If you have already closed the window,<br/> you have to login again on <a href='https://www.we-teve.com/login'>www.we-teve.com/login</a>,
                                then you come back to the page, where you can enter the validation code.";


  //====================== Bookmark ===================

  public $bm_ph_name            = "Name of the bookmark";
  public $bm_new_title          = "Add a new bookmark";
  public $bm_new_text           = "Start at";
  public $bm_error              = "Bookmark could not be saved!";
  public $bm_index_error        = "The home page can not be added as a bookmark!";

  public $bm_edit_title         = "Edit bookmark";
  public $bms_title_empty       = "You do not have bookmarks yet";



  //==================== Abonnieren ===================

  public $sub_sub               = "Subscribe";
  public $sub_subed             = "<b>&#10003;</b> Subscribed";
  public $sub_desub             = "Unsubscribe";



  //==================== Freunde ===================

  public $friend_alert0         = "You do not have any friends yet!";

  public $friend_title_1        = "Send friend requests &#43;";
  public $friend_title_2        = "Add this channel as a friend &#43;";
  public $friend_title_3        = "Withdraw request";
  public $friend_title_4        = "Remove channel as friend -";

  public $friend_text_1         = "Friend requests sent!";
  public $friend_text_2         = "Friend requests accepted!";
  public $friend_text_3         = "Friend requests rejected!";
  public $friend_text_4         = "Friend requests withdrawn!";
  public $friend_text_5         = "Friend removed!";
  public $friend_text_6         = "You have reached the maximum number of friends for the moment.";
  public $friend_text_7         = "The other person has reached the maximum number of friends for the moment.";

  public $friend_error1         = "Unknown error";



  //==================== blockieren ===================

  public $block_friend_title_1  = "User blocked successfully!";
  public $block_friend_title_2  = "User successfully unblocked!";

  public $block_friend_text_1   = "This channel blocked you!";

  public $block_friend_error_2  = "This channel has you or you blocked him!";



  //==================== Playlist ===================

  public $pl_add_title0         = "Add video to playlist";
  public $pl_add_title1         = "Add to existing playlists";
  public $pl_add_title2         = "Create a new playlist";
  public $pl_add_title3         = "Remove video from playlist";
  public $pl_add_title4         = "Set video as a playlist thumbnail";

  public $pl_add_text           = "Name of playlist";
  public $pl_add_new_pl         = "Create";

  public $pl_error0             = "Video could not be added to the playlist!";
  public $pl_error1             = "Playlist could not be created!";

  public $pl_title_embty        = "No videos in this playlist yet!";

  //==== on Channel =====

  public $pl_video_titel0       = "Videos";

  //==== on playlist =====

  public $pl_edit_title1        = "Name of playlist";
  public $pl_edit_title2        = "Delete playlist";
  public $pl_edit_title3        = "Save";

  public $pl_del_text           = "Are you sure you want to delete this playlist";
  public $pl_del_title1         = "Yes, delete";
  public $pl_del_title2         = "No, cancel";

  public $pl_edit_sort_title    = "Sort playlist by";
  public $pl_edit_sort_text0    = "Manual";
  public $pl_edit_sort_text1    = "Added - newest first";
  public $pl_edit_sort_text2    = "Added - oldest first";
  public $pl_edit_sort_text3    = "Upload Date - newest First";
  public $pl_edit_sort_text4    = "Upload date - oldest first";

  public $pl_edit_info_text1    = "Playlist description";

  public $pl_edit_alert_0       = "Changes saved!";
  public $pl_edit_alert_1       = "Changes could not be saved!";

  public $pl_alert_1            = "Playlist could not be found!";
  public $pl_alert_2            = "This playlist is private!";
  public $pl_alert_3            = "This playlist has been deleted!";
  public $pl_alert_9            = "Unknown error";



  //==================== Share ===================

  public $sh_title0             = "Share this video";

  public $sh_title1             = "QR-CODE";
  public $sh_title2             = "Share on";
  public $sh_title3             = "Embed codee";
  public $sh_title4             = "Video link";

  public $sh_text1              = "Watch this video on We-TeVe";
  public $sh_text2              = "Watch this video on We-TeVe:";



  //==================== Download ===================

  public $dw_title0             = "Download video";
  public $dw_title1             = "Video and Audio";
  public $dw_title2             = "Audio";
  public $dw_title3             = "Audiovisual";



//==========================================================================================================
//==========================================================================================================
//================= Einzelne Seiten  =======================================================================
//==========================================================================================================
//==========================================================================================================

  //==== Index =====

  public $index_public_videos   = "Featured videos";
  public $index_all_videos      = "All videos";



  //==== search =====

  public $search_title          = "search";
  public $search_title2         = "Results for";
  public $search_title21        = "filter";
  public $search_title3         = "User results for";
  public $search_title4         = "Video results for";
  public $search_non_result     = "No results found";


  //==== Login =====

  public $login_title_0         = "Log in";

  public $login_title_1         = "e-mail";
  public $login_title_2         = "Password";
  public $login_title_3         = "Remember me";
  public $login_title_4         = "Verification code";

  public $login_alert4         = "Invalid e-mail address!";
  public $login_alert5         = "Invalid password!";
  public $login_alert6         = "Invalid confirmation code! Failed attempts 3/3 </br> A new verification code has been sent!";
  public $login_alert7         = "Invalid confirmation code! Failed attempts";

  public $login_text_1          = "Did not receive a verification code?";
  public $login_text_2          = "Resend verification code";

  public $login_text_3          = "A new verification code has been sent";

  public $login_gologin_text    = "You have the <span class='blue'>Two-factor authentication</span> turned on. </br/> That means you have now received an email in which a <span class='blue'>Verification code</span> is included. </br/> Please enter this below to sign up.";
  public $login_goregin_text    = "To complete the registration, you need the <span class='blue'>Verification code</span>,</br/> which you received via e-mail below.";



  //===== Regin ======

  public $regin_title_0         = "Sigh up";

  public $regin_title_1         = "Username";
  public $regin_title_1_1       = "Verify username";
  public $regin_title_1_2       = "Click again on register so that the user name can be verified!";
  public $regin_title_2         = "Date of birth";
  public $regin_title_2_01      = "Day";
  public $regin_title_2_02      = "Month";
  public $regin_title_2_03      = "Year";
  public $regin_title_3         = "e-mail";
  public $regin_title_4         = "Password";
  public $regin_title_5         = "Repeat password";
  public $regin_title_6         = "Country";
  public $regin_title_7         = "Language";
  public $regin_title_8         = "Channel color";
  public $regin_title_9         = "I accept the";
  public $regin_title_10        = "Please choose";

  public $regin_alert_00        = "The terms of use must be accepted!";
  public $regin_alert_0         = "This field can not be empty!";
  public $regin_alert_11        = "The password confirmation is not correct!";
  public $regin_alert_1         = "Username already used by someone else!";
  public $regin_alert_2         = "Username is too long!";
  public $regin_alert_3         = "The username can not contain any special characters!";
  public $regin_alert_4         = "The password must be at least 8 characters long!";
  public $regin_alert_5         = "The date is invalid!";
  public $regin_alert_51        = "You must be at least 14 years old to create a We-TeVe account!";
  public $regin_alert_6         = "This username already belongs to a YouTube channel with more than 50&apos;000+ subscribers and is thus reserved. If this channel sounds to you, you can verify it and the name is yours!";
  public $regin_alert_7         = "The username could not be verified!";
  public $regin_alert_8         = "Please enter a valid e-mail address!";
  public $regin_alert_9         = "This e-mail address is already being used by another user!";



  //===== options ======

  public $opt_title_0           = "Options";
  public $opt_title_1           = "User data";
  public $opt_title_2           = "Connected accounts";
  public $opt_title_2_empty     = "You do not have connected YouTube accounts yet";
  public $opt_title_2_error     = "Account could not be connected!";
  public $opt_title_2_error2    = "Account has already been connected!";
  public $opt_title_2_1         = "YouTube accounts";
  public $opt_title_2_2         = "Connect more accounts";

  public $opt_text_1            = "Added";

  public $opt_acctitle_0         = "Username";
  public $opt_acctitle_1         = "E-mail address";
  public $opt_acctitle_1_1       = "Verification code for your new e-mail";
  public $opt_acctitle_2         = "Change password";
  public $opt_acctitle_2_1       = "New password";
  public $opt_acctitle_2_2       = "Confirm new password";

  public $opt_acctitle_3         = "Country";
  public $opt_acctitle_4         = "Language";
  public $opt_acctitle_5         = "Autoplay";
  public $opt_acctitle_5_1       = "On";
  public $opt_acctitle_5_2       = "Off";
  public $opt_acctitle_10        = "Current password to confirm the changes";

  public $opt_acc_alert_1        = "May only be changed every 30 days";
  public $opt_acc_alert_1_1      = "The username has already changed in the last 30 days!";
  public $opt_acc_alert_2        = "This field can not be empty!";
  public $opt_acc_alert_3        = "Current password to confirm is wrong";
  public $opt_acc_alert_4        = "A confirmation code has been sent to the new e-mail address!";



  //===== Partner ======

  public $part_menu_title_0     = "Partner";
  public $part_menu_title_1     = "Dashboard";
  public $part_menu_title_2     = "Options";
  public $part_menu_title_2_2   = "Partner options";

  public $part_text_1           = "To become a partner you have to meet the following requirements:";

  public $part_needs_title_1    = "Publicly uploaded videos";
  public $part_needs_title_2    = "Total video views";
  public $part_needs_title_3    = "Achieved levels";

  public $part_go_partner_title = "Become a We-TeVe partner now!";
  public $part_go_partner_title1= "Become a We-TeVe partner and earn money with your videos!";
  public $part_go_partner_title2= "I accept the We-TeVe Partner Terms of Use";
  public $part_go_partner_title3= "Confirm and continue";
  public $part_go_partner_title4= "To the We-TeVe Partner Dashboard";

  public $part_terms_of_use_titel= "We-TeVe Partner Terms of Use";
  public $part_terms_of_use_text= " <p>1. To become a We-TeVe partner, you must be at least 18 years old.</p>
                                    <p>2. Payments can be made to PayPal, bank account and Monero Wallet.</p>
                                    <p>3. Paid 60% of our revenue for each user. This 60% of revenue is displayed in the Partner Dashboard.</p>
                                    <p>3.1. The payout minimum can be viewed in the Partner Dashboard. (It is about 50 francs)</p>
                                    <p>3.2. Transaction fees are borne by the recipient.</p>
                                    <p>3.3. Our revenues are in Monero (XMR). Payments to PayPal and bank account are therefore dependent on the exchange rate.</p>
                                    <p>4. Paid income can be viewed in the Partner Dashboard..</p>
                                    <p>4.1. Paid receipts and disbursement information (bank account, etc.) are stored in encrypted form.</p>
                                    <p>5. For invalid payout information, you will be notified by us after the payout attempt. <br>
                                    You then have a maximum of 30 days to provide valid payout information. The amount to be paid will be deducted.</p>
                                    <p>5.1. We are not responsible and accept no responsibility if the payment due to wrong or incomplete information will be paid to a wrong account or wrong Wallet.</p>
                                    <p>5.2. We are not responsible and accept no responsibility if third parties change their payout information without your knowledge.</p>
                                    <p>6. We reserve the right to terminate this affiliate program if necessary.</p>
                                    <p>7. We reserve the right to change We-TeVe Partner Terms of Use if necessary.</p>
  ";

  public $part_payment_infos_title= "Payment account";
  public $part_payment_infos_title1= "Pay out on Monero Wallet";
  public $part_payment_infos_title2= "Pay out on PayPal";
  public $part_payment_infos_title3= "Pay out on bank account";

  public $part_payment_infos_text1= "Monero Wallet address";
  public $part_payment_infos_text2= "PayPal E-Mail address";
  public $part_payment_infos_text3= "IBAN";
  public $part_payment_infos_text3_1= "First and last name of the account holder";

  public $part_payment_error    = "Please fill in the fields";
  public $part_payment_error1   = "Please enter a valid e-mail address";
  public $part_payment_error2   = "Unknown error";
  public $part_payment_error3   = "Current password to confirm is wrong";
  public $part_payment_saved    = "Payout account successfully updated";

  public $part_payment_opt_title= "Change Payout account";
  public $part_payment_opt_text = "The current payout account is not displayed for security reasons.";


  //Dashboard
  public $part_title_1          = "Paid payments";
  public $part_no_payments      = "Still no paid payments";

  public $part_title_2          = "Pending payment";
  public $part_title_2_1        = "Channel revenue";
  public $part_title_2_2        = "Video revenue";
  public $part_title_2_3        = "Total revenue";
  public $part_title_2_4        = "Total revenue";
  public $part_title_3          = "The payout minimum is 0.2 XMR";

  public $part_payment_title0   = "Transaction to";
  public $part_payment_title1   = "Paypal account";
  public $part_payment_title2   = "Bank account";
  public $part_payment_title3   = "Monero wallet";
  public $part_payment_title10  = "paid";



  //===== admin ======

  public $admin_menu_title_0    = "Admin";
  public $admin_menu_title_1    = "Dashboard";
  public $admin_menu_title_2    = "Requests";
  public $admin_menu_title_3    = "Pending payments";
  public $admin_menu_title_4    = "All videos";

  public $admin_head_title      = "Shows a maximum of 3 pending payments!";

  public $admin_pay_payents     = "Pay off";
  public $admin_pay_payents1    = "paid";
  public $admin_pay_payents2    = "Amount spent in XMR without XMR at the end";
  public $admin_pay_payents2_1  = "Paid amount rounded in / with the currency in which it was disbursed";



  //===== watch ======

  public $watch_views           = "views";
  public $watch_hochgeladen_am  = "Published on:";
  public $watch_no_description  = "No video description";
  public $watch_more_vids_title = "More videos";
  public $watch_more_vids_user  = "More videos from";

  //share btns
  public $watch_btn_title0      = "Recommend";
  public $watch_btn_title1      = "Share";
  public $watch_btn_title2      = "Add to";
  public $watch_btn_title3      = "Download";

  //playlist
  public $watch_pl_switch_title = "Playlist turn in order";
  public $watch_pl_random_title = "Random playback";

  //error
  public $watch_error_msg0      = "This video has been removed by the user.";
  public $watch_error_msg1      = "This video has been removed for copyright issue.";
  public $watch_error_msg2      = "This video was removed for violation of our Community Guidelines.";
  public $watch_error_msg3      = "This video is still being processed. It should be available soon.";
  public $watch_error_msg4      = "This video could not be found";
  public $watch_error_msg5      = "This video is private";


  //more videos
  public $morev_search          = "Search for more videos";
  public $morev_next_video      = "Next video";
  public $morev_backtomorevideos= "Back to More Videos";
  public $morev_play_next       = "Play next";


  //===== Upload ======

  public $up_title_0            = "Upload video from hard disk";
  public $up_title_1            = "Upload video";
  public $up_title_yt           = "Upload video from YouTube";

  public $up_alert_blocked      = "This feature has been blocked for you!";
  public $up_alert_time1        = "You can only upload as many videos per week";
  public $up_alert_time2        = "Next video can be uploaded on ";

  public $up_text_0             = "Cancel upload";

  public $up_video_title        = "Video title";
  public $up_video_des          = "Video description";
  public $up_video_preview      = "Thumbnail preview";

  public $up_video_preview_text1= "[Video title]";
  public $up_video_preview_text2= "[Video description]";
  public $up_video_preview_text3= "0 seconds ago";
  public $up_video_preview_text4= "0 views";

  //thumb
  public $up_thumb_title0       = "Video thumbnail";
  public $up_thumb_title1       = "Select thumbnail";

  //thumb alerts
  public $up_thumb_alert1       = "Thumbnail has been uploaded successfully.";
  public $up_thumb_alert2       = "You do not have the right to change this thumbnail.";
  public $up_thumb_alert3       = "Unknown error! Thumbnail could not be saved.";
  public $up_thumb_alert5       = "The thumbnail can be up to only 3MB in size.";
  public $up_thumb_alert7       = "Only .jpg and .png files can be uploaded as a thumbnail!";

  //save
  public $up_save               = "Save";

  //save alerts
  public $up_save_alert1        = "Inputs were saved successfully.";
  public $up_save_alert2        = "Unknown error! Inputs could not be saved.";
  public $up_save_alert3        = "Planned upload date could not be saved.";
  public $up_save_alert4        = "Thumbnail color could not be saved.";
  public $up_save_alert5        = "Thumbnail color could not be saved.";
  public $up_save_alert6        = "Some inputs could not be saved.";


  //privacy
  public $up_privacy_title0     = "Data protection";
  public $up_privacy_title1     = "Public";
  public $up_privacy_title2     = "Unlisted";
  public $up_privacy_title3     = "Unlisted &#43; visible to friends";
  public $up_privacy_title4     = "Private";
  public $up_privacy_title5     = "Planned";

  public $up_privacy_time       = "Publish on";

  //time
  public $up_date_error_time    = "As long as the video is not processed yet.<br> The scheduled release date can be in the earliest 24 hours!";
  public $up_date_error_time2   = "Invalid upload date!";
  public $up_date_error_date    = "Entered date does not exist";
  public $up_date_error_ie      = "This feature does not seem to work in your browser!";

  //category
  public $up_cat_title0         = "Category";

  //Sprache
  public $up_lang_title0        = "Language";

  //color
  public $up_color_title0        = "Color";

  //youtube
  public $up_yt_url             = "Video URL";
  public $up_yt_save            = "Upload video";

  //status
  public $up_status             = "Video is uploading:";
  public $up_render_status      = "Processing:";
  public $video_fin_render      = "The video was successfully uploaded";

  //alerts
  public $up_yt_alert0          = "Video could not be found. Make sure the URL is correct and the video is not private.";
  public $up_yt_alert1          = "To upload a video from this channel, you must first connect it to your account! <br> Go for this on <a href='../options/linked' load='new'>www.We-TeVe.com/options/linked</a> ";
  public $up_yt_alert2          = "Only one video can be uploaded at a time.";
  public $up_yt_alert3          = "Invalid URL";
  public $up_yt_alert4          = "Unknown error";

  public $up_norm_alert0        = "The video file is too big! The video file may be up to 10 GB in size.";
  public $up_norm_alert1        = "To upload a video from this channel, you must first connect it to your account! <br> Go for this on <a href='../options/linked' load='new'>www.We-TeVe.com/options/linked</a> ";
  public $up_norm_alert2        = "This file format is not supported.";
  public $up_norm_alert3        = "Unknown error while uploading";
  public $up_norm_alert4        = "The upload was canceled!";

  public $up_norm_alert5        = "The upload will be aborted and entered data will be lost!";



  //===== comments ======

  public $com_new_title         = "Write a new comment";
  public $com_new_placeholder   = "Write a new comment";
  public $com_re_placeholder    = "Write an answer";
  public $com_new_send_title    = "Send";
  public $com_re_send_title     = "Reply";
  public $com_to_com_title      = "To the comment";
  public $com_up_vote           = "I like itr";
  public $com_down_vote         = "I do not like it";

  public $com_show_more         = "Show more";
  public $com_show_less         = "Show less";

  public $com_all_title         = "All comments";
  public $com_top_title         = "Popular comments";
  public $com_show_ans          = "Show answers";
  public $com_hide_ans          = "Hide answers";

  public $com_del_title         = "Delete comment";

  public $com_backtoallcoms     = "Back to all comments";

  //Sort
  public $com_sort_title0       = "Sort by";
  public $com_sort_title1       = "Default";
  public $com_sort_title2       = "Newest first";
  public $com_sort_title3       = "Oldest first";
  public $com_sort_title4       = "Top comments";
  public $com_sort_title5       = "Without answers";
  public $com_sort_title6       = "With answers";
  public $com_sort_title7       = "With video response";
  public $com_sort_title8       = "From friends";
  public $com_sort_title9       = "My comments";
  public $com_sort_title10      = "Random";

  public $com_sort_title11      = "Full commentary";
  public $com_sort_title11_1    = "Connections";

  public $com_sort_title12      = "Results for";

  //alerts
  public $com_alert_not_send    = "Comment could not be sent";
  public $com_alert_not_send2   = "You write too fast, wait a moment and try again.";

  public $com_alert_not_like    = "Rating could not be saved.";
  public $com_alert_not_like2   = "You rate too fast, wait a moment and try again.";


  public $com_alert_not_del     = "This comment could not be deleted.";

  //status
  public $com_status_deleted    = "Comment removed";



  //===== subscriptions ======
  public $sub_title0            = "My subscriptions";
  public $sub_title_embty       = "You have not subscribed to any channels! <br/> Maybe you chose one of these channels:";



  //===== video-manager ======
  public $vm_title0             = "My videos";
  public $vm_title1             = "Edit";
  public $vm_title2             = "Delete";
  public $vm_title2_0           = "Are you sure you want to permanently delete this video?";
  public $vm_title2_1           = "Yes, Delete!";
  public $vm_title2_2           = "No, Cancel";
  public $vm_title_embty        = "You have not uploaded any videos yet!";

  public $vm_text0              = "Status";
  public $vm_text1              = "Video has been successfully published!";
  public $vm_text2              = "Video will be published on";
  public $vm_text3              = "Video uploaded successfully!";
  public $vm_text4              = "Video is uploading!";
  public $vm_text5              = "Canceled";
  public $vm_text6              = "Video is still being processed";
  public $vm_text7              = "Video removed for copyright issues.";

  public $vm_alert1             = "Video can not be deleted during processing!";

  //edit
  public $vm_edit_title0        = "Edit video";



  //===== recommends ======
  public $recoms_title0         = "Recommended videos";
  public $recoms_title1         = "Recommend this video";
  public $recoms_title2         = "Choose the friends from which you would like to recommend this video";
  public $recoms_title3         = "Added";
  public $recoms_title_embty    = "Here are videos that your friends recommend!";

  public $recoms_text1          = "Recommended by";
  public $recoms_text2          = "and";
  public $recoms_text3          = "more";


  public $recoms_alert1         = "Video could not be recommended!";



  //============= achievement und  level  ===============================================================================

  public $achievement_level_title= "Level progress";
  public $achievement_main_title= "Achievements";
  public $achievement_video_title= "Video achievements";

  public $level_title1          = "Current level";
  public $level_title2          = "Level diary";
  public $level_title3          = "Current level progress";
  public $level_title4          = "Total level progress";
  public $level_title_empty     = "You have not collected XP yet!";
  public $noch_level_title      = "Only";
  public $level_xp_title        = "xp";
  public $bis_level_up_title    = "xp to the level";

  public $level_du_hast         = "You have";
  public $level_level           = "Level";
  public $level_erreicht        = "reached";
  public $level_big_text_ok     = "OK";

  public $level_gifts0          = "Highest level achieved";
  public $level_gifts1          = "New level Icon";
  public $level_gifts2          = "One extra video per week";
  public $level_gifts3          = "New level color";
  public $level_gifts4          = "+5 friends slots";
  public $level_gifts5          = "+100 Coins";

  public $ach_at                = "received at";

  public $ach_yea               = "Congratulations!";
  public $ach_for               = "for the achievement";
  public $ach_title             = "Achievement:";

  public $achstep1              = "Step 1";
  public $achstep2              = "Step 2";
  public $achstep3              = "Step 3";


  //actions
  public $res_action_title_01   = "Rate a video positive";
  public $res_action_title_02   = "Rate a video negative";

  public $res_action_title_03   = "Your video has been rated positive";
  public $res_action_title_04   = "Your video has been rated negative";

  public $res_action_title_10   = "Upload a video";
  public $res_action_title_11   = "Upload a video in Full HD";
  public $res_action_title_12   = "Upload a video in 4k";

  public $res_action_title_15   = "Your comments have been rated positively";
  public $res_action_title_16   = "Your comments were rated negative";
  public $res_action_title_17   = "Your comment has a rating of -5";

  public $res_action_title_20   = "Write a comment";
  public $res_action_title_21   = "Write a reply comment";
  public $res_action_title_22   = "Reply the comments of your videos";

  public $res_action_title_25   = "Rate a comment Positive";
  public $res_action_title_26   = "Rate a comment Negative";

  public $res_action_title_30   = "Subscribe a channel";
  public $res_action_title_31   = "You were subscribed";

  public $res_action_title_35   = "Watch a video";


  //achievements titel (achievements Namen)
  public $res_ach_title_100     = "Viewers' rate";
  public $res_ach_title_101     = "Viewers' rate";
  public $res_ach_title_102     = "Viewers' rate";

  public $res_ach_title_110     = "Commentary collector";
  public $res_ach_title_111     = "Commentary collector";
  public $res_ach_title_112     = "Commentary collector";

  public $res_ach_title_120     = "5 star rating";
  public $res_ach_title_121     = "5 star rating";
  public $res_ach_title_122     = "5 star rating";

  public $res_ach_title_140     = "Show us what you like";
  public $res_ach_title_141     = "Show us what you like";
  public $res_ach_title_142     = "Show us what you like";

  public $res_ach_title_150     = "Raise your voice";
  public $res_ach_title_151     = "Raise your voice";
  public $res_ach_title_152     = "Raise your voice";

  public $res_ach_title_160     = "Loyally from the audience";
  public $res_ach_title_161     = "Loyally from the audience";
  public $res_ach_title_162     = "Loyally from the audience";

  public $res_ach_title_170     = "Loyal watcher";
  public $res_ach_title_171     = "Loyal watcher";
  public $res_ach_title_172     = "Loyal watcher";

  public $res_ach_title_180     = "Extend the platform";
  public $res_ach_title_181     = "Extend the platform";
  public $res_ach_title_182     = "Extend the platform";

  public $res_ach_title_200     = "Sharper than the reality";
  public $res_ach_title_201     = "Not alone";
  public $res_ach_title_202     = "Rate it";
  public $res_ach_title_203     = "Detective";
  public $res_ach_title_204     = "Order must be";
  public $res_ach_title_205     = "Go hog wild";
  public $res_ach_title_206     = "Handyman";
  public $res_ach_title_207     = "Friends hold together";
  public $res_ach_title_208     = "Entertainment around the clock";
  public $res_ach_title_209     = "Entertainment for a whole football stadium";
  public $res_ach_title_210     = "take your time";

  public $res_ach_title_2016    = "Merry Christmas 2016";


  //achievements text (was muss man machen)
  public $res_ach_text_100      = "Reach 100, 1.000 or 10.000 views on this video";
  public $res_ach_text_110      = "Get on this video 10, 100 or 1.000 comment";
  public $res_ach_text_120      = "Reach 10, 100 or 1.000 positive votes on this video";

  public $res_ach_text_140      = "Rate 5, 50 or 500 videos positive!";
  public $res_ach_text_150      = "Write 10, 100 or 1,000 comments!";
  public $res_ach_text_160      = "10, 100 or 1,000 users subscribe!";
  public $res_ach_text_170      = "Subscribe to 5, 25 or 250 users!";
  public $res_ach_text_180      = "Upload 5, 50 or 100 videos publicly!";

  public $res_ach_text_200      = "Upload a video in 4k!";
  public $res_ach_text_201      = "Add a friend!";
  public $res_ach_text_202      = "Rate a comment!";
  public $res_ach_text_203      = "Browse the comments!";
  public $res_ach_text_204      = "Sort the comments!";
  public $res_ach_text_205      = "Edit your channel design!";
  public $res_ach_text_206      = "Make settings!";
  public $res_ach_text_207      = "Like a video of a friend!";
  public $res_ach_text_208      = "To watch all your videos you need at least 24 hours!";
  public $res_ach_text_209      = "Reach at least 50,000 views with all your videos!";
  public $res_ach_text_210      = "Upload a video that takes more than 10 minutes!";

  public $res_ach_text_2016     = "Get a present from us at Christmas 2016!";

  public $all_achievements_from = "All the achievements of";

  public $hidden_achievement    = "Not yet received!";



  //===== channel ======

  public $channel_error_1       = "Channel isn&apos;t available!";
  public $home_navi_title       = "Startpage";
  public $video_navi_title      = "Video";
  public $pl_navi_title         = "Playlist";
  public $achievement_navi_title= "Achievements";
  public $info_navi_title       = "About";
  public $infofulltext_navi_title= "Channel comments";
  public $home_edit_navi_title  = "Edit <br/> Channel";

  public $alle_videos           = "All videos";
  public $allvideos_from_title  = "All videos from";

  public $allplaylists_from_title= "All playlists from";

  public $sortier_nach_title    = "Sort by";

  public $sortiert_nach         = "Sort by";
  public $sort_title1           = "Newest first";
  public $sort_title2           = "Oldest first";
  public $sort_title3           = "Most views";
  public $sort_title4           = "Best rating";


  /* info */
  public $i_flag_title          = "Report channel";
  public $i_edit_title          = "Edit";

  public $i_edit_title_long     = "Edit channel information";
  public $i_edit_profile_title  = "Profile photo";
  public $i_edit_profile_title2 = "New profile photo";
  public $i_edit_profile_title3 = "Current profile photo";
  public $i_edit_upload_title   = "Upload";

  public $s_title               = "Statistics";
  public $s_title_abos          = "Subscribers";
  public $s_title_videos        = "Videos";
  public $s_title_totalview     = "Total views";
  public $s_title_online_time   = "Total online time";
  public $s_title_last          = "Last activity";
  public $s_title_time          = "Length of all videos";

  public $i_info_placeholder    = "Add channel Description";

  /* edit */



  //===== channel edit ======
  public $bild_edit_title       = "Image";
  public $info_edit_title       = "Info";
  public $infofulltext_edit_title= "Channel description";
  public $no_channel_description = "No channel description";
  public $video_edit_title      = "Video";
  public $videobeschreibung_edit_title = "Video description";
  public $abonnenten_edit_title = "Subscribers";
  public $diskussion_edit_title = "Channelcomments";
  public $comming_soon_edit_title= "Comming Soon";


  public $addContent            = "Add Content:";
  public $hintergrund_add_title = "Edit background";
  public $avatar_add_title      = "Edit avatar";

  public $zumkanalvon           = "To the channel from";
  public $abonenten_count       = "Subscribers";

  public $automatisch           = "Will Automatically created";

//background edit
  public $edit_background_title = "Edit background:";
  public $edit_background_title1 = "Upload backgroundimage:";
  public $edit_background_title2 = "Allowed image formats: jpg, png and gif. (Recommended size: 1920p x 1710p / Maximum filesize: 2.5mb)";
  public $edit_background_title3 = "Upload";
  public $edit_background_title4 = "Preview:";
  public $edit_background_title4_5 = "Choose a image...";
  public $edit_background_title5 = "Present backgroundimage";
  public $edit_background_title6 = "No backgroundimage";
  public $edit_background_title7 = "Choose backgroundcolor:";
  public $edit_background_title8 = "The backgroundcolor will be also showed, when the background image is too small or no background image is chosen.";
  public $edit_background_title8_5 = "Choose";
  public $edit_background_title9 = "No backgroundcolor";
  public $edit_background_title10 = "Save background";
  public $edit_background_title11 = "Save";

  public $edit_background_alert1  = "For the channel background only .jpg, .png images are allowed!";
  public $edit_background_alert2  = "Image could not be saved!";
  public $edit_background_alert3  = "File can not be bigger than 2.5mb!";

//avatar edit
  public $edit_avatar_title     = "edit avatar:";
  public $edit_avatar_title1    = "Upload avatar:";
  public $edit_avatar_title2    = "Allowed image formats: jpg, png and gif. (Recommended size: 200p x 200p / Maximum filesize: 1mb)";
  public $edit_avatar_title3    = "Upload";
  public $edit_avatar_title4    = "Preview:";
  public $edit_avatar_title4_5  = "Choose a image...";
  public $edit_avatar_title5    = "Present avatar";
  public $edit_avatar_title6    = "Save avatar";
  public $edit_avatar_title7    = "Save";

  public $edit_avatar_alert1    = "With the avatar image only .jpg, .png and .gif images are allowed!";
  public $edit_avatar_alert3    = "File can not be bigger than 1mb";

//img edit
  public $edit_img_title        = "Edit content:";
  public $edit_img_title1       = "Add image URL";
  public $edit_img_title2       = "Right-click on the image in your internet browser and &apos;Copy image URL&apos; or &apos;Copy imageadress&apos; Choose. Than paste below.";
  public $edit_img_title2_5     = "Paste image URL";
  public $edit_img_title3       = "Upload Imges:";
  public $edit_img_title4       = "Allowed image formats: jpg, png and gif.";
  public $edit_img_title5       = "Upload";
  public $edit_img_title5_5     = "Current image";
  public $edit_img_title6       = "Preview:";
  public $edit_img_title6_5     = "Choose a image...";
  public $edit_img_title7       = "Save image";
  public $edit_img_title8       = "Save";
  public $edit_img_title9       = "";

//info edit
  public $edit_info_title       = "Edit content:";
  public $edit_info_title1      = "Title";
  public $edit_info_title2      = "Content";
  public $edit_info_title3      = "Member since";
  public $edit_info_title3_5    = "Origin";
  public $edit_info_title4      = "Standard";
  public $edit_info_title5      = "Show";
  public $edit_info_title6      = "Hide";
  public $edit_info_title7      = "Save";
  public $edit_info_title8      = "Short profile:";

  public $edit_info_alert1      = "In the profile picture only .jpg and .png pictures are allowed!";
  public $edit_info_alert2      = "Profile photo has been uploaded!";
  public $edit_info_alert3      = "The file can not be bigger than 2.0mb!";


//info edit
  public $edit_infofulltext_title = "Edit content:";

//Video edit
  public $edit_video_title      = "Edit content:";
  public $edit_video_title1     = "My videos:";
  public $edit_video_title2     = "Others videos:";
  public $edit_video_title8     = "Save";

  public $edit_video_text1      = "Enter the url of the video";
  public $edit_video_text2      = "Video could not be found!";

} ?>
