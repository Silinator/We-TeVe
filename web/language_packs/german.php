<?php

class language extends user{

  public $htmldata              = "de";

//=========================================================================================================
//=========================================================================================================
//================ auf allen Seiten  ======================================================================
//=========================================================================================================
//=========================================================================================================

  public $hometitle             = "Die Benutzerorientierte Videoplattform";
  public $home                  = "Home";

  public $showmore              = "Mehr anzeigen";
  public $showless              = "Weniger anzeigen";
  public $loadmore              = "Mehr laden";
  public $loading               = "Lädt...";

  public $error_text            = "Ein unbekannter Fehler ist aufgetreten!";

  public $save                  = "Speichern";

  public $yes_del               = "Ja, Löschen!";
  public $no_del                = "Abbrechen";



  //===================== coinhive ========================

  public $coinhive_js_error     = "Entblocken Sie authedmine.com und laden Sie diese Seite erneut!";
  public $coinhive_site_error   = "<h2 class='blue'>Bei Bestätigung:</h2>Einfach die Seite neu laden und du gelangst dann zur Seite.<br/><br/> <h2 class='red'>Bei Ablehnung:</h2>Um diese Seite nutzen zu können müsst du aller höchstens 37% deine Rechenpower zur verfügungen stellen. <br/><span class='blue'>Dafür ist auf der Seite keine Werbung!</span>";

  public $coinhive_why_title    = "Warum wir deine PC-Power brauchen";
  public $coinhive_why_stitle1  = "Keine Werbung!";
  public $coinhive_why_stitle2  = "Keine Zensur!";
  public $coinhive_why_stitle3  = "Keine stark schwankenden Einnahmen!";
  public $coinhive_why_stitle4  = "Keine Ungleichberechtigung!";

  public $coinhive_why_text1    = "Dafür das du deine PC-Power zur Verfügung stellst, musst du keine nervige Werbung ertragen!";
  public $coinhive_why_text2    = "Ohne Werbung gibt es auch keine Leute, die mit dem Content Probleme haben, welcher nach der Werbung kommt!";
  public $coinhive_why_text3    = "Ohne Werbung ist man auch nicht abhängig von Jahreszeiten, Vertragsverlängerungen etc.!";
  public $coinhive_why_text4    = "Ohne Werbung gibt es keinen Content, welcher eine bessere Zielgruppe hat als ein anderer und deshalb besser bezahlt wird.!";

  public $coinhive_video_payout_title = "Einnahmen";
  public $coinhive_video_payout_text = "Ausbezahlt werden nur Einnahmen, welche ab start der Partnerschaft generiert werden. <a href=/r/go_partner>Partner werden</a>";



  //===================== Navi ========================

  public $my_channel_title      = "Mein Kanal";
  public $my_subs_title         = "Meine Abos";
  public $my_recoms_title       = "Empfohlene Videos";
  public $myvideo_title         = "Meine Videos";
  public $options_title         = "Einstellungen";
  public $partner_title         = "Partner Dashboard";
  public $admin_title           = "Admin";
  public $logout_title          = "Abmelden";


  public $playlists_title       = "Playlists";

  public $bookmark_title        = "Lesezeichen";


  public $footertitle1          = "Datenschutzerklärung";
  public $footertitle2          = "Nutzungsbedingungen";
  public $footertitle3          = "Copyright";
  public $footertitle4          = "Community-Richtlinien";
  public $footertitle5          = "Impressum";
  public $footertitle6          = "Haftungsausschluss";
  public $footertitle7          = "Unterstützer";
  public $footertitle8          = "Partner werden";


  /*Dropdown-boxen*/

  /*Level*/
  public $level_now_title       = "Aktueller Level";

  public $level_now_text0       = "Nur noch";
  public $level_now_text01      = "bis zum nächsten Level";


  public $level_diary_title     = "Level Tagebuch";


  /*notification*/
  public $not_title_type2       = "Du hast Level";
  public $not_title_type21      = "erreicht!";

  public $not_title_type4       = "Neuer Kommentar";
  public $not_title_type41      = "Neue Antwort";

  public $not_title_type5       = "Dein Kommentar wurde positiv bewertet";
  public $not_title_type6       = "Dein Kanal hat einen neuen Abonnent";
  public $not_title_type7       = "Dein Video wurde positiv bewertet";
  public $not_title_type10      = "Neue Freundschaftsanfragen";
  public $not_title_type11      = "Ein Freund ist so eben Online gegangen";


  public $not_text_type2        = "Freundesslots";

  public $not_text_type4        = "hat neben deinem Video kommentiert";
  public $not_text_type41       = "hat auf deinen Kommentar geantwortet";

  public $not_text_type5        = "hat deinen Kommentar positiv bewertet";
  public $not_text_type6        = "hat deinen Kanal abonniert";
  public $not_text_type7        = "hat dein Video positiv bewertet";
  public $not_text_type10       = "möchte dich als Freund hinzufügen";
  public $not_text_type11       = "ist nun online";


  /*messages*/
  public $mes_title             = "Nachrichten";
  public $mes_title_empty       = "Du hast noch keine Nachrichten!";

  public $mes_text_type4        = "hat neben deinem Video kommentiert";
  public $mes_text_type41       = "hat auf deinen Kommentar geantwortet";


  public $mes_title_type5       = "und";
  public $mes_title_type51      = "weitere";

  public $mes_text_type5        = "haben";
  public $mes_text_type50       = "hat";
  public $mes_text_type51       = "dein Kommentar";
  public $mes_text_type52       = "positiv bewertet";


  public $mes_title_type6       = "und";
  public $mes_title_type61      = "weitere";

  public $mes_text_type6        = "haben dein Kanal abonniert";
  public $mes_text_type60       = "hat dein Kanal abonniert";


  public $mes_title_type7       = "und";
  public $mes_title_type71      = "weitere";

  public $mes_text_type7        = "haben";
  public $mes_text_type70       = "hat";
  public $mes_text_type71       = "dein Video";
  public $mes_text_type72       = "positiv bewertet";


  /*friends*/
  public $fri_title             = "Freunde";
  public $fri_title_empty       = "Du hast noch keine Freunde!";
  public $fri_new_title         = "Freundschaftsanfragen";
  public $fri_new_add_title     = "Gesendete Freundschaftsanfragen";

  public $fri_offline_title     = "Offline";
  public $fri_online_title      = "Online";

  public $fri_accept_title      = "Annehmen";
  public $fri_reject_title      = "Ablehnen";
  public $fri_delete_title      = "Entfernen";
  public $fri_block_title       = "Blockieren";


  //================= Video vorschläge ================

  public $views_title           = "Aufrufe";



  //========================= Time ====================

  public $time_vor1             = "vor"; //wenn deutsch
  public $time_vor2             = ""; //wenn englisch
  public $time_eine             = "einer";
  public $time_ein              = "einer";
  public $time_einer            = "einer";
  public $time_einem            = "einem";
  public $time_einem_a          = "einem";


  public $time_sekunde          = "Sekunde";
  public $time_sekunden         = "Sekunden";

  public $time_minute           = "Minute";
  public $time_minuten          = "Minuten";

  public $time_stunde           = "Stunde";
  public $time_stunden          = "Stunden";

  public $time_tage             = "Tag";
  public $time_tagen            = "Tagen";

  public $time_woche            = "Woche";
  public $time_wochen           = "Wochen";

  public $time_monate           = "Monat";
  public $time_monaten          = "Monaten";

  public $time_jahr             = "Jahr";
  public $time_jahren           = "Jahren";



  //====================== Monate =====================

  public $monat_january         = "Januar";
  public $monat_february        = "Februar";
  public $monat_march           = "März";
  public $monat_april           = "April";
  public $monat_may             = "Mai";
  public $monat_june            = "Juni";
  public $monat_july            = "Juli";
  public $monat_august          = "August";
  public $monat_september       = "September";
  public $monat_october         = "Oktober";
  public $monat_november        = "November";
  public $monat_december        = "Dezember";



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

  public $cat_ent_title         = "Unterhaltung";
  public $cat_com_title         = "Komödie";
  public $cat_mov_title         = "Film";
  public $cat_mus_title         = "Musik";
  public $cat_gam_title         = "Spiel";
  public $cat_eat_title         = "Nahrung";
  public $cat_spo_title         = "Sport";
  public $cat_vlo_title         = "Vlog";
  public $cat_ads_title         = "Werbung";



  //====================== Sprachen ===================

  public $lang_label_de         = "Deutsch";
  public $lang_label_en         = "Englisch";
  public $lang_label_fr         = "Französisch";



  //====================== Color ======================

  public $color_blue            = "blau";
  public $color_green           = "grün";
  public $color_red             = "rot";
  public $color_orange          = "orange";
  public $color_white           = "weiss";
  public $color_black           = "schwarz";



  //====================== Mail =======================

  public $mail_service_title    = "Service E-Mail";


  //login
  public $mail_login_subject    = "Bestätigungscode für deine Anmeldung auf We-TeVe.com";
  public $mail_login_text_1     = "Hallo";
  public $mail_login_text_2     = "Sch&ouml;n dich wieder zu sehen.";
  public $mail_login_text_3     = "Hier ist dein Best&auml;tigungscode f&uuml;r dein Login:";

  //regin
  public $mail_regin_subject    = "Bestätigungscode für deine Registration auf We-TeVe.com";
  public $mail_regin_text_1     = "Hallo";
  public $mail_regin_text_2     = "Vielen Dank, dass du dich auf We-TeVe registriert hast!";
  public $mail_regin_text_3     = "Hier ist dein Best&auml;tigungscode f&uuml;r um deine Registration zu vollenden:";

  //new_mail_code
  public $mail_new_mc_subject   = "Bestätigungscode für die E-Mail änderung deines We-TeVe.com Kontos";
  public $mail_new_mc_text_1    = "Hallo";
  public $mail_new_mc_text_2    = "Damit du diese E-Mail Adresse als neue E-Mail Adresse nutzen kannst,";
  public $mail_new_mc_text_3    = "bekommst du diesen Best&auml;tigungscode, den du zur Best&auml;tigung in den Einstellungen eingeben kannst.";
  public $mail_new_use_info     = "Kopiere den oben stehenden Best&auml;tigungscode und f&uuml;ge ihn, in das daf&uuml;r vorgesehene Feld auf der Webseite ein.<br/>";

  //new_pw
  public $mail_new_pw_subject   = "Dein Passwort für dein We-TeVe Konto wurde erfolgreich geändert";
  public $mail_new_pw_text_1    = "Hallo";
  public $mail_new_pw_text_2    = "Dein Passwort für dein We-TeVe Konto wurde erfolgreich ge&auml;ndert.";
  public $mail_new_pw_text_3    = "";

  //new_mail
  public $mail_new_mail_subject = "Deine E-Mail Adresse für dein We-TeVe Konto wurde erfolgreich geändert";
  public $mail_new_mail_text_1  = "Hallo";
  public $mail_new_mail_text_2  = "Deine E-Mail Adresse für dein We-TeVe Konto wurde erfolgreich ge&auml;ndert.";
  public $mail_new_mail_text_3  = "";

  //new_paymentinfos
  public $mail_new_payment_subject= "Deine Auszahlungskonto für dein We-TeVe Konto wurde erfolgreich geändert";
  public $mail_new_payment_text_1 = "Hallo";
  public $mail_new_payment_text_2 = "Deine Auszahlungskonto für dein We-TeVe Konto wurde erfolgreich ge&auml;ndert.";
  public $mail_new_payment_text_3 = "";

  public $mail_use_info         = "Kopiere den oben stehenden Best&auml;tigungscode und f&uuml;ge ihn, in das daf&uuml;r vorgesehene Feld auf der Webseite ein.<br/>
                                <br/>Falls du das Fenster bereits geschlossen hast,<br/> musst du dich wieder auf <a href='https://www.we-teve.com/login'>www.we-teve.com/login</a> anmelden, danach kommst du nochmal auf die Seite, wo du den
                                Best&auml;tigungscode eingeben kannst.";


  //====================== Bookmark ===================

  public $bm_ph_name            = "Name des Lesezeichens";
  public $bm_new_title          = "Neues Lesezeichen hinzufügen";
  public $bm_new_text           = "Starten bei";
  public $bm_error              = "Lesezeichen konnte nicht gespeichert werden!";
  public $bm_index_error        = "Die Startseite kann nicht als Lesezeichen hinzugefügt werden!";

  public $bm_edit_title         = "Lesezeichen bearbeiten";
  public $bms_title_empty       = "Du hast noch keine Lesezeichen";



  //==================== Abonnieren ===================

  public $sub_sub               = "Abonnieren";
  public $sub_subed             = "<b>&#10003;</b> Abonniert";
  public $sub_desub             = "Deabonnieren";



  //==================== Freunde ===================

  public $friend_alert0         = "Du hast noch keine Freunde!";

  public $friend_title_1        = "Freundschaftsanfragen senden &#43;";
  public $friend_title_2        = "Kanal als Freund hinzufügen &#43;";
  public $friend_title_3        = "Anfrage zurückziehen";
  public $friend_title_4        = "Kanal als Freund entfernen -";

  public $friend_text_1         = "Freundschaftsanfragen gesendet!";
  public $friend_text_2         = "Freundschaftsanfragen angenommen!";
  public $friend_text_3         = "Freundschaftsanfragen abgelehnt!";
  public $friend_text_4         = "Freundschaftsanfragen zurückgezogen!";
  public $friend_text_5         = "Freund entfernt!";
  public $friend_text_6         = "Du hast die maximale Anzahl von Freunden für den Moment erreicht.";
  public $friend_text_7         = "Die andere Person hast die maximale Anzahl von Freunde für den Moment erreicht.";

  public $friend_error1         = "Unbekannter Fehler";



  //==================== Party ===================

  public $party_title_0         = "Party";
  public $party_title_1         = "Party erstellen";

  public $party_text_1          = "Zusammen mit Freunden Videos anschauen";



  //==================== blockieren ===================

  public $block_friend_title_1  = "Benutzer erfolgreich blockiert!";
  public $block_friend_title_2  = "Benutzer erfolgreich entblockt!";

  public $block_friend_text_1   = "Dieser Kanal hat dich blockiert!";

  public $block_friend_error_2  = "Dieser Kanal hat dich oder du ihn blockiert!";



  //==================== Playlist ===================

  public $pl_add_title0         = "Video zu Playlist hinzufügen";
  public $pl_add_title1         = "Zu bestehenden Playlists hinzufügen";
  public $pl_add_title2         = "Neue Playlist erstellen";
  public $pl_add_title3         = "Video aus Playlist entfernen";
  public $pl_add_title4         = "Video als Playlist-Thumbnail festlegen";

  public $pl_add_text           = "Playlistname";
  public $pl_add_new_pl         = "Erstellen";

  public $pl_error0             = "Video konnte nicht zur Playlist hinzugefügt werden!";
  public $pl_error1             = "Playlist konnte nicht erstelt werden!";

  public $pl_title_embty        = "Noch keine Videos in dieser Playlist!";

  //==== on Channel =====

  public $pl_video_titel0       = "Videos";

  //==== on playlist =====

  public $pl_edit_title1        = "Playlist Name";
  public $pl_edit_title2        = "Playlist löschen";
  public $pl_edit_title3        = "Speichern";

  public $pl_del_text           = "Bist du sicher, dass du diese Playlist löschen möchtest";
  public $pl_del_title1         = "Ja, löschen";
  public $pl_del_title2         = "Nein, abbrechen";

  public $pl_edit_sort_title    = "Playlist sortieren nach";
  public $pl_edit_sort_text0    = "Manuell";
  public $pl_edit_sort_text1    = "Hinzugefügt - Neueste zuerst";
  public $pl_edit_sort_text2    = "Hinzugefügt - Älteste zuerst";
  public $pl_edit_sort_text3    = "Hochladedatum - Neueste zuerst";
  public $pl_edit_sort_text4    = "Hochladedatum - Älteste zuerst";

  public $pl_edit_info_text1    = "Playlist Beschreibung";

  public $pl_edit_alert_0       = "Änderungen gespeichert!";
  public $pl_edit_alert_1       = "Änderungen konnten nicht gespeichert werden!";

  public $pl_alert_1            = "Playlist konnte nicht gefunden werden!";
  public $pl_alert_2            = "Diese Playlist ist privat!";
  public $pl_alert_3            = "Diese Playlist wurde gelöscht!";
  public $pl_alert_9            = "Unbekannter Fehler";



  //==================== Share ===================

  public $sh_title0             = "Video Teilen";

  public $sh_title1             = "QR-CODE";
  public $sh_title2             = "Teilen über";
  public $sh_title3             = "Einbettungscode";
  public $sh_title4             = "Videolink";

  public $sh_text1              = "Schau dir dieses Video auf We-TeVe an";
  public $sh_text2              = "Schau dir dieses Video auf We-TeVe an:";



  //==================== Download ===================

  public $dw_title0             = "Video downloaden";
  public $dw_title1             = "Video und Audio";
  public $dw_title2             = "Audio";
  public $dw_title3             = "Au­dio­vi­su­ell";



//==========================================================================================================
//==========================================================================================================
//================= Einzelne Seiten  =======================================================================
//==========================================================================================================
//==========================================================================================================

  //==== Index =====

  public $index_public_videos   = "Featured Videos";
  public $index_all_videos      = "Alle Videos";



  //==== search =====

  public $search_title          = "Suche";
  public $search_title2         = "Ergebnisse für";
  public $search_title21        = "Filter";
  public $search_title3         = "Benutzerergebnisse für";
  public $search_title4         = "Videoergebnisse für";
  public $search_non_result     = "Kein Treffer gefunden";


  //==== Login =====

  public $login_title_0         = "Anmelden";

  public $login_title_1         = "E-Mail";
  public $login_title_2         = "Passwort";
  public $login_title_3         = "Angemeldet bleiben";
  public $login_title_4         = "Bestätigungscode";

  public $login_alert4          = "Ungültige E-Mail-Adresse!";
  public $login_alert5          = "Ungültiges Passwort!";
  public $login_alert6          = "Ungültiger Bestätigungscode! Fehlversuche 3/3 </br> Ein neuer Bestätigungscode wurde gesendet!";
  public $login_alert7          = "Ungültiger Bestätigungscode! Fehlversuche";

  public $login_text_1          = "Keinen Bestätigungscode erhalten?";
  public $login_text_2          = "Bestätigungscode erneut senden";

  public $login_text_3          = "Ein neuer Bestätigungscode wurde gesendet";

  public $login_gologin_text    = "Du hast die <span class='blue'>Zwei-Faktor-Authentifizierung</span> angeschaltet. </br/> Das heisst, du hast nun eine E-Mail bekommen, in welcher ein <span class='blue'>Bestätigungscode</span> enthalten ist. </br/> Bitte gib diesen unten ein, um dich anzumelden.";
  public $login_goregin_text    = "Um die Registrierung abzuschliessen, musst du den <span class='blue'>Bestätigungscode</span>,</br/> den du über E-Mail bekommen hast, unten eingeben.";



  //===== Regin ======

  public $regin_title_0         = "Registrieren";

  public $regin_title_1         = "Benutzername";
  public $regin_title_1_1       = "Benutzername verifizieren";
  public $regin_title_1_2       = "Klicke erneut auf Registrieren damit der Benutzername verifiziert werden kann!";
  public $regin_title_2         = "Gebutsdatum";
  public $regin_title_2_01      = "Tag";
  public $regin_title_2_02      = "Monat";
  public $regin_title_2_03      = "Jahr";
  public $regin_title_3         = "E-Mail";
  public $regin_title_4         = "Passwort";
  public $regin_title_5         = "Passwort wiederholen";
  public $regin_title_6         = "Land";
  public $regin_title_7         = "Sprache";
  public $regin_title_8         = "Kanalfarbe";
  public $regin_title_9         = "Ich akzeptiere die";
  public $regin_title_10        = "Bitte wählen";

  public $regin_alert_00        = "Die Nutzungsbestimmungen müssen akzeptiert werden!";
  public $regin_alert_0         = "Dieses Feld darf nicht leer sein!";
  public $regin_alert_11        = "Die Passwortbestätigung ist nicht korrekt!";
  public $regin_alert_1         = "Benutzername wird bereits von jemand anderem genutzt!";
  public $regin_alert_2         = "Benutzername ist zu lang!";
  public $regin_alert_3         = "Der Benutzername darf keine Sonderzeichen enthalten!";
  public $regin_alert_4         = "Das Passwort muss mindestens 8 Zeichen lang sein!";
  public $regin_alert_5         = "Das Datum ist ungültig!";
  public $regin_alert_51        = "Du musst mindestens 14 Jahre alt sein, um ein We-TeVe Konto zu erstellen!";
  public $regin_alert_6         = "Dieser Benutzername gehört bereits zu einem YouTube-Kanal mit mehr als 50&apos;000 Abonnenten und ist somit reserviert. Gerhört dieser Kanal dir, kannst du diesen verifizieren und der Name gehört dir!";
  public $regin_alert_7         = "Der Benutzername konnte nicht verifiziert werden!";
  public $regin_alert_8         = "Bitte gib eine gültige E-Mail-Adresse ein!";
  public $regin_alert_9         = "Diese E-Mail-Adresse wird bereits von einem anderen Benutzer verwendet!";



  //===== options ======

  public $opt_title_0           = "Einstellungen";
  public $opt_title_1           = "Benutzerdaten";
  public $opt_title_2           = "Verbundene Konten";
  public $opt_title_2_empty     = "Du hast noch keine verbundene YouTube Konten";
  public $opt_title_2_error     = "Konto konnte nicht vernunden werden!";
  public $opt_title_2_error2    = "Konto wurde bereits verbunden!";
  public $opt_title_2_1         = "YouTube-Konten";
  public $opt_title_2_2         = "Weitere Konten verbinden";

  public $opt_text_1            = "Hinzugefügt";

  public $opt_acctitle_0        = "Benutzername";
  public $opt_acctitle_1        = "E-Mail Adresse";
  public $opt_acctitle_1_1      = "Bestätigunscode für die neue E-Mail";
  public $opt_acctitle_2        = "Passwort ändern";
  public $opt_acctitle_2_1      = "Neues Passwort";
  public $opt_acctitle_2_2      = "Neues Passwort bestätigen";

  public $opt_acctitle_3        = "Land";
  public $opt_acctitle_4        = "Sprache";
  public $opt_acctitle_5        = "Autoplay";
  public $opt_acctitle_5_1      = "An";
  public $opt_acctitle_5_2      = "Aus";
  public $opt_acctitle_10       = "Momentanes Passwort zum Bestätigen der Änderungen";

  public $opt_acc_alert_1       = "Darf nur alle 30 Tage geändert werden";
  public $opt_acc_alert_1_1     = "Der Benutzername wurde bereits in den letzten 30 Tagen geändert!";
  public $opt_acc_alert_2       = "Dieses Feld darf nicht leer sein!";
  public $opt_acc_alert_3       = "Momentanes Passwort zum Bestätigen ist falsch!";
  public $opt_acc_alert_4       = "Ein Bestätigungscode wurde an die neue E-Mail Adresse gesendet!";



  //===== Partner ======

  public $part_menu_title_0     = "Partner";
  public $part_menu_title_1     = "Dashboard";
  public $part_menu_title_2     = "Einstellungen";
  public $part_menu_title_2_2   = "Partner Einstellungen";

  public $part_text_1           = "Um Partner zu werden musst du folgende Anforderungen erfüllen:";

  public $part_needs_title_1    = "Öffentlich hochgeladene Videos";
  public $part_needs_title_2    = "Totale Videoaufrufe";
  public $part_needs_title_3    = "Erreichte Level";

  public $part_go_partner_title = "Jetzt We-TeVe Partner werden!";
  public $part_go_partner_title1= "Jetzt We-TeVe Partner werden und mit deinen Videos Geld verdienen!";
  public $part_go_partner_title2= "Ich akzeptiere die We-TeVe Partner Nutzungsbedingungen";
  public $part_go_partner_title3= "Bestätigen und fortfahren";
  public $part_go_partner_title4= "Zum We-TeVe Partner Dashboard";

  public $part_terms_of_use_titel= "We-TeVe Partner Nutzungsbedingungen";
  public $part_terms_of_use_text= " <p>1. Um We-TeVe Partner zu werden musst du mindestens 18 Jahre alt sein.</p>
                                    <p>2. Einnahmen können an PayPal, Bankkonto und Monero Wallet ausgezahlt werden.</p>
                                    <p>3. Ausgezahlt werden 60% unserer Einahmen für den jeweiligen nutzer. Diese 60% der Einnahmen werden im Partner Dashboard angezeigt.</p>
                                    <p>3.1. Das Auszahlungsminimum kann im Partner Dashboard eingesehen werden. (Es liegt umgerechnet bei ungefähr 50 FR.)</p>
                                    <p>3.2. Transaktionsgebühren werden vom empfänger getragen.</p>
                                    <p>3.3. Unsere Einnahmen sind in Monero(XMR). Auszahlungen an PayPal und Bankkonto sind daher von dem Wechselkurs abhängig.</p>
                                    <p>4. Ausgezahlte Einnahmen sind im Partner Dashboard einsehbar.</p>
                                    <p>4.1. Ausgezahlte Einnahmen und Auszahlungsinfrmationen (Bankkonto etc.) werden verschlüsselt gespeichert.</p>
                                    <p>5. Bei ungültigen Auszahlungsinformationen werden Sie von uns, nach Auszahlungsversuch, benachrichtigt. <br>
                                    Sie haben dann maximal 30 Tage Zeit eine gültige Auszahlungsinformationen anzugeben. Ansonnsten wird der zubezahlende Betrag einbehalten.</p>
                                    <p>5.1. Wir haften nicht und übernehmen auch keine Verantwortung wenn die Auszahlung wegen falschen oder unzureichenden Angaben auf ein falschen Konto oder falsche Wallet ausgezahlt wird.</p>
                                    <p>5.2. Wir haften nicht und übernehmen auch keine Verantwortung wenn sich Dritte ihre Auszahlungsinformationen ohne ihr Wissen ändern.</p>
                                    <p>6. Wir behalten es uns vor dieses Partnerprogramm falls nötig zu kündigen.</p>
                                    <p>7. Wir behalten es uns vor We-TeVe Partner Nutzungsbedingungen falls nötig zu ändern.</p>
  ";

  public $part_payment_infos_title= "Auszahlungskonto";
  public $part_payment_infos_title1= "Auf Monero Wallet Auszahlen";
  public $part_payment_infos_title2= "Auf PayPal Auszahlen";
  public $part_payment_infos_title3= "Auf Bankkonto Auszahlen";

  public $part_payment_infos_text1= "Monero Wallet Adresse";
  public $part_payment_infos_text2= "PayPal E-Mail Adresse";
  public $part_payment_infos_text3= "IBAN";
  public $part_payment_infos_text3_1= "Vor- und Nachname des Kontoinhabers";

  public $part_payment_error    = "Bitte fülle die Felder aus";
  public $part_payment_error1   = "Bitte gebe eine gültige E-Mail-Adresse ein";
  public $part_payment_error2   = "Unbekannter Fehler";
  public $part_payment_error3   = "Momentanes Passwort zum Bestätigen ist falsch";
  public $part_payment_saved    = "Auszahlungskonto erfolgreich aktualisiert";

  public $part_payment_opt_title= "Auszahlungskonto ändern";
  public $part_payment_opt_text = "Das momentane Auszahlungskonto wird aus Sicherheitsgründen nicht angezeigt.";


  //Dashboard
  public $part_title_1          = "Ausgezahlte Zahlungen";
  public $part_no_payments      = "Noch keine ausbezalte Zahlungen";

  public $part_title_2          = "Ausstehende Zahlung";
  public $part_title_2_1        = "Kanal Einnahmen";
  public $part_title_2_2        = "Video Einnahmen";
  public $part_title_2_3        = "Gesamte Einnahmen";
  public $part_title_2_4        = "Totale Einnahmen";
  public $part_title_3          = "Das Auszahlungsminimum ist 0.2 XMR";

  public $part_payment_title0   = "Überweisung auf";
  public $part_payment_title1   = "PayPal-Konto";
  public $part_payment_title2   = "Bank-Konto";
  public $part_payment_title3   = "Monero-Wallet";
  public $part_payment_title10  = "Ausgezahlt";



  //===== admin ======

  public $admin_menu_title_0    = "Admin";
  public $admin_menu_title_1    = "Dashboard";
  public $admin_menu_title_2    = "Anfragen";
  public $admin_menu_title_3    = "Ausstehende Zahlungen";
  public $admin_menu_title_4    = "Alle Videos";

  public $admin_head_title      = "Zeigt Maximal 3 Ausstehende Zahlungen an!";

  public $admin_pay_payents     = "Auszahlen";
  public $admin_pay_payents1    = "Ausgezahlt";
  public $admin_pay_payents2    = "Ausgezahlter Betrag in XMR ohne XMR am ende";
  public $admin_pay_payents2_1  = "Ausgezahlter Betrag gerundet in/mit der Währung in welcher er ausgezahlt wurde";



  //===== watch ======

  public $watch_views           = "Aufrufe";
  public $watch_hochgeladen_am  = "Veröffentlicht am:";
  public $watch_no_description  = "Keine Videobeschreibung";
  public $watch_more_vids_title = "Weitere Videos";
  public $watch_more_vids_user  = "Weitere Videos von";

  //share btns
  public $watch_btn_title0      = "Empfehlen";
  public $watch_btn_title1      = "Teilen";
  public $watch_btn_title2      = "Hinzufügen";
  public $watch_btn_title2_5    = "Zu einer Playlist hinzufügen";
  public $watch_btn_title3      = "Herunterladen";

  //playlist
  public $watch_pl_switch_title = "Playlistreihenfolge umdrehen";
  public $watch_pl_random_title = "Zufällige Wiedergabe";

  //error
  public $watch_error_msg0      = "Dieses Video wurde vom Nutzer entfernt.";
  public $watch_error_msg1      = "Dieses Video wurde wegen Verstoss gegen das Copyright entfernt.";
  public $watch_error_msg2      = "Dieses Video wurde wegen Verstoss gegen unsere Community-Richtlinien entfernt.";
  public $watch_error_msg3      = "Dieses Video wird noch verarbeitet. Es sollte in Kürze verfügbar sein.";
  public $watch_error_msg4      = "Dieses Video konnte nicht gefunden werden";
  public $watch_error_msg5      = "Dieses Video ist privat";

  //more videos
  public $morev_search          = "Nach weiteren Videos suchen";
  public $morev_next_video      = "Nächstes Video";
  public $morev_backtomorevideos= "Zurück zu Weitere Videos";
  public $morev_play_next       = "Als nächstes abspielen";


  //===== Upload ======

  public $up_title_0            = "Video von Festplatte hochladen";
  public $up_title_1            = "Video hochladen";
  public $up_title_yt           = "Video von YouTube hochladen";

  public $up_alert_blocked      = "Diese Funktion wurde für dich blockiert!";
  public $up_alert_time1        = "Du kannst pro Woche nur so viele Videos hochladen";
  public $up_alert_time2        = "Nächstes Video kann hochgeladen werden am ";

  public $up_text_0             = "Hochladen abbrechen";

  public $up_video_title        = "Videotitel";
  public $up_video_des          = "Videobeschreibung";
  public $up_video_tags         = "Videotags";
  public $up_video_preview      = "Thumbnail Vorschau";

  public $up_video_preview_text1= "[Video Titel]";
  public $up_video_preview_text2= "[Videobeschreibung]";
  public $up_video_preview_text2_5= "Tag1, Tag2, Tag3";
  public $up_video_preview_text3= "vor 0 Sekunden";
  public $up_video_preview_text4= "0 Aufrufe";

  //thumb
  public $up_thumb_title0       = "Video Thumbnail";
  public $up_thumb_title1       = "Thumbnail wählen";

  //thumb alerts
  public $up_thumb_alert1       = "Thumbnail wurde erfolgreich hochgeladen.";
  public $up_thumb_alert2       = "Du hast nicht das Recht, dieses Thumbnail zu ändern.";
  public $up_thumb_alert3       = "Unbekannter Fehler! Thumbnail konnte nicht gespeichert werden.";
  public $up_thumb_alert5       = "Das Thumbnail darf höchstens 3MB gross sein.";
  public $up_thumb_alert7       = "Es dürfen nur .jpg und .png Dateien als Thumbnail hochgeladen werden!";

  //save
  public $up_save               = "Speichern";

  //save alerts
  public $up_save_alert1        = "Eingaben wurden erfolgreich gespeichert.";
  public $up_save_alert2        = "Unbekannter Fehler! Eingaben konnten nicht gespeichert werden.";
  public $up_save_alert3        = "Geplanter Hochladetermin konnte nicht gespeichert werden.";
  public $up_save_alert4        = "Thumbnailfarbe konnte nicht gespeichert werden.";
  public $up_save_alert5        = "Thumbnailfarbe konnte nicht gespeichert werden.";
  public $up_save_alert6        = "Manche Eingaben konnten nicht gespeichert werden.";


  //privacy
  public $up_privacy_title0     = "Datenschutz";
  public $up_privacy_title1     = "Öffentlich";
  public $up_privacy_title2     = "Ungelistet";
  public $up_privacy_title3     = "Ungelistet &#43; sichtbar für Freunde";
  public $up_privacy_title4     = "Privat";
  public $up_privacy_title5     = "Geplant";

  public $up_privacy_time       = "Veröffentlichen am";

  //time
  public $up_date_error_time    = "Solange das Video noch nicht verarbeitet ist.<br> Darf der geplante Veröffentlichungstermin in frühesten 24 Stunden sein!";
  public $up_date_error_time2   = "Ungültiger Hochladetermin!";
  public $up_date_error_date    = "Eingegebenes Datum existiert nicht";
  public $up_date_error_ie      = "Diese Funktion scheint in deinem Browser nicht zu funktionieren!";

  //category
  public $up_cat_title0         = "Kategorie";

  //Sprache
  public $up_lang_title0        = "Sprache";

  //color
  public $up_color_title0        = "Farbe";

  //youtube
  public $up_yt_url             = "Video URL";
  public $up_yt_save            = "Video Hochladen";

  //status
  public $up_status             = "Video wird hochgeladen:";
  public $up_render_status      = "Verarbeitung:";
  public $video_fin_render      = "Das Video wurde erfolgreich hochgeladen";

  //alerts
  public $up_yt_alert0          = "Video konnte nicht gefunden werden. Stell sicher dass die URL richtig ist und das Video nicht privat ist.";
  public $up_yt_alert1          = "Um ein Video von diesem Kanal hochladen zu können, musst du ihn zuerst mit deinem Konto verbinden! <br> Gehe dafür auf <a href='../options/linked' load='new'>www.We-TeVe.com/options/linked</a> ";
  public $up_yt_alert2          = "Es darf nur ein Video auf einmal hochgeladen werden.";
  public $up_yt_alert3          = "Ungültige URL";
  public $up_yt_alert4          = "Unbekannter Fehler";

  public $up_norm_alert0        = "Die Videodatei ist zu gross! Die Videodatei darf maximal 10 GB gross sein.";
  public $up_norm_alert1        = "Um ein Video von diesem Kanal hochladen zu können, müsst du ihn zuerst mit deinem Konto verbinden! <br> Gehe dafür auf <a href='../options/linked' load='new'>www.We-TeVe.com/options/linked</a> ";
  public $up_norm_alert2        = "Dieses Dateiformat wird nicht unterstützt.";
  public $up_norm_alert3        = "Unbekannter Fehler beim Hochladen";
  public $up_norm_alert4        = "Das Hochladen wurde abgebrochen!";

  public $up_norm_alert5        = "Das Hochladen wird abgebrochen und eingegebene Daten gehen verloren!";



  //===== comments ======

  public $com_new_title         = "Neuer Kommentar schreiben";
  public $com_new_placeholder   = "Schreib einen neuen Kommentar";
  public $com_re_placeholder    = "Schreib eine Antwort";
  public $com_new_send_title    = "Senden";
  public $com_re_send_title     = "Antworten";
  public $com_to_com_title      = "Zum Kommentar";
  public $com_up_vote           = "Gefällt mir";
  public $com_down_vote         = "Gefällt mir nicht";

  public $com_show_more         = "Mehr anzeigen";
  public $com_show_less         = "Weniger anzeigen";

  public $com_all_title         = "Alle Kommentare";
  public $com_top_title         = "Beliebte Kommentare";
  public $com_show_ans          = "Antworten anzeigen";
  public $com_hide_ans          = "Antworten ausblenden";

  public $com_del_title         = "Kommentar Löschen";

  public $com_backtoallcoms     = "Zurück zu allen Kommentaren";

  //Sort
  public $com_sort_title0       = "Sortieren nach";
  public $com_sort_title1       = "Standard";
  public $com_sort_title2       = "Neueste zuerst";
  public $com_sort_title3       = "Älteste zuerst";
  public $com_sort_title4       = "Top Kommentare";
  public $com_sort_title5       = "Ohne Antworten";
  public $com_sort_title6       = "Mit Antworten";
  public $com_sort_title7       = "Mit Videoantwort";
  public $com_sort_title8       = "Von Freunden";
  public $com_sort_title9       = "Meine Kommentare";
  public $com_sort_title10      = "Zufällig";

  public $com_sort_title11      = "Ganzer Kommentarverlauf";
  public $com_sort_title11_1    = "Verknüpfungen";

  public $com_sort_title12      = "Ergebnisse für";

  //alerts
  public $com_alert_not_send    = "Kommentar konnte nicht gesendet werden";
  public $com_alert_not_send2   = "Du schreibst zu schnell, warte kurz und versuche es erneut.";

  public $com_alert_not_like    = "Bewertung konnte nicht gespeichert werden.";
  public $com_alert_not_like2   = "Du bewertest zu schnell, warte kurz und versuche es erneut.";


  public $com_alert_not_del     = "Dieser Kommentar konnte nicht gelöscht werden.";

  //status
  public $com_status_deleted    = "Kommentar entfernt";



  //===== subscriptions ======
  public $sub_title0            = "Meine Abos";
  public $sub_title1            = "Meine Abonnenten Gruppen";
  public $sub_title2            = "Neue Abonnenten Gruppen erstellen";
  public $sub_title_embty       = "Du hast noch keine Kanäle abonniert!<br/>Vielleicht gefällt dir einer dieser Kanäle:";
  public $sub_group_title_embty = "Du hast noch keine Abonnenten Gruppen!";

  public $sub_group_add_text    = "Gruppenname";
  public $sub_add_group         = "Erstellen";


  //===== video-manager ======
  public $vm_title0             = "Meine Videos";
  public $vm_title1             = "Bearbeiten";
  public $vm_title2             = "Löschen";
  public $vm_title2_0           = "Möchtest du dieses Video wirklich unwiderruflich löschen";
  public $vm_title2_1           = "Ja, löschen!";
  public $vm_title2_2           = "Nein, abbrechen";
  public $vm_title_embty        = "Du hast noch keine Videos hochgeladen!";

  public $vm_text0              = "Status";
  public $vm_text1              = "Video wurde erfolgreich veröffentlicht!";
  public $vm_text2              = "Video wird veröffentlicht am";
  public $vm_text3              = "Video wurde erfolgreich hochgeladen!";
  public $vm_text4              = "Video wird hochgeladen!";
  public $vm_text5              = "Abgebrochen";
  public $vm_text6              = "Video wird noch verarbeitet";
  public $vm_text7              = "Video wurde wegen Verletzung des Copyrights entfernt.";

  public $vm_alert1             = "Video kann während des Verarbeitens nicht gelöscht werden!";

  //edit
  public $vm_edit_title0        = "Video bearbeiten";



  //===== recommends ======
  public $recoms_title0         = "Empfohlene Videos";
  public $recoms_title1         = "Video empfehlen";
  public $recoms_title2         = "Wähle die Freunde aus, denen du das Video empfehlen möchtest";
  public $recoms_title3         = "Hinzugefügt";
  public $recoms_title_embty    = "Hier werden Videos aufgelistet, die deine Freunde dir empfehlen!";

  public $recoms_text1          = "Empfohlen von";
  public $recoms_text2          = "und";
  public $recoms_text3          = "weiteren";


  public $recoms_alert1         = "Video konnte nicht empfohlen werden.";



  //===== achievement und level =====

  public $achievement_level_title= "Level-Fortschritt";
  public $achievement_main_title= "Errungenschaften";
  public $achievement_video_title= "Video-Errungenschaften";

  public $level_title1          = "Aktueller Level";
  public $level_title2          = "Level Tagebuch";
  public $level_title3          = "Aktueller Level-Fortschritt";
  public $level_title4          = "Totaler Level-Fortschritt";
  public $level_title_empty     = "Du hast noch keine XP gesammelt!";
  public $noch_level_title      = "Nur noch";
  public $level_xp_title        = "xp";
  public $bis_level_up_title    = "xp bis zum Level";

  public $level_big_text_a1      = "Du hast";
  public $level_big_text_blue    = "Level";
  public $level_big_text_b1      = "erreicht";
  public $level_big_text_ok      = "OK";

  public $level_gifts0          = "Höchstes Level erreicht";
  public $level_gifts1          = "Neues Level Icon";
  public $level_gifts2          = "Ein Zusätzliches Video pro Woche";
  public $level_gifts3          = "Neue Level Farbe";
  public $level_gifts4          = "&#43;5 Freundesslots";
  public $level_gifts5          = "&#43;100 Coins";

  public $ach_at                = "erhalten";

  public $ach_yea               = "Herzlichen Glückwunsch!";
  public $ach_for               = "für die Errungenschaft";
  public $ach_title             = "Errungenschaft:";

  public $achstep1              = "Stufe 1";
  public $achstep2              = "Stufe 2";
  public $achstep3              = "Stufe 3";


  //actions
  public $res_action_title_01   = "Bewerte ein Video positiv";
  public $res_action_title_02   = "Bewerte ein Video Negativ";

  public $res_action_title_03   = "Dein Video wurde positiv bewertet";
  public $res_action_title_04   = "Dein Video wurde negativ bewertet";

  public $res_action_title_10   = "Lade ein Video hoch";
  public $res_action_title_11   = "Lade ein Video in Full HD hoch";
  public $res_action_title_12   = "Lade ein Video in 4k hoch";

  public $res_action_title_15   = "Dein Kommentare wurde positiv bewertet";
  public $res_action_title_16   = "Dein Kommentare wurde negativ bewertet";
  public $res_action_title_17   = "Dein Kommentar hat eine bewertung von -5 erreicht";

  public $res_action_title_20   = "Schreibe einen Kommentar";
  public $res_action_title_21   = "Schreibe einen Antwortkommentar";
  public $res_action_title_22   = "Beantworte Kommentare neben deiner Videos";

  public $res_action_title_25   = "Bewerte einen Kommentar Positiv";
  public $res_action_title_26   = "Bewerte einen Kommentar Negativ";

  public $res_action_title_30   = "Abonniere einen Kanal";
  public $res_action_title_31   = "Du wurdest abonniert";

  public $res_action_title_35   = "Schaue ein Video";


  //achievements titel (achievements Namen)
  public $res_ach_title_100     = "Zuschauerquote";
  public $res_ach_title_101     = "Zuschauerquote";
  public $res_ach_title_102     = "Zuschauerquote";

  public $res_ach_title_110     = "Kommentaresammler";
  public $res_ach_title_111     = "Kommentaresammler";
  public $res_ach_title_112     = "Kommentaresammler";

  public $res_ach_title_120     = "5 Sterne Bewertung";
  public $res_ach_title_121     = "5 Sterne Bewertung";
  public $res_ach_title_122     = "5 Sterne Bewertung";

  public $res_ach_title_140     = "Zeig uns was dir gefällt";
  public $res_ach_title_141     = "Zeig uns was dir gefällt";
  public $res_ach_title_142     = "Zeig uns was dir gefällt";

  public $res_ach_title_150     = "Erhebe deine Stimme";
  public $res_ach_title_151     = "Erhebe deine Stimme";
  public $res_ach_title_152     = "Erhebe deine Stimme";

  public $res_ach_title_160     = "Treue Zuschauerschaft";
  public $res_ach_title_161     = "Treue Zuschauerschaft";
  public $res_ach_title_162     = "Treue Zuschauerschaft";

  public $res_ach_title_170     = "Treuer Zuschauer";
  public $res_ach_title_171     = "Treuer Zuschauer";
  public $res_ach_title_172     = "Treuer Zuschauer";

  public $res_ach_title_180     = "Erweitere die Plattform";
  public $res_ach_title_181     = "Erweitere die Plattform";
  public $res_ach_title_182     = "Erweitere die Plattform";

  public $res_ach_title_200     = "Schärfer als die Realität";
  public $res_ach_title_201     = "Nicht alleine";
  public $res_ach_title_202     = "Bewerte mit";
  public $res_ach_title_203     = "Detektiv";
  public $res_ach_title_204     = "Ordnung muss sein";
  public $res_ach_title_205     = "Tob dich aus";
  public $res_ach_title_206     = "Bastler";
  public $res_ach_title_207     = "Freunde halten zusammen";
  public $res_ach_title_208     = "Unterhaltung rund um die Uhr";
  public $res_ach_title_209     = "Unterhaltung für ein ganzes Fussballstadion";
  public $res_ach_title_210     = "Nimm dir die Zeit";

  public $res_ach_title_2016    = "Frohe Weihnachten 2016";


  //achievements text (was muss man machen)
  public $res_ach_text_100      = "Erreiche auf dieses Video 100, 1.000 oder 10.000 Aufrufe";
  public $res_ach_text_110      = "Bekomme auf dieses Video 10, 100 oder 1.000 Kommentare";
  public $res_ach_text_120      = "Bekomme auf dieses Video 10, 100 oder 1.000 positive Bewertungen";

  public $res_ach_text_140      = "Bewerte 5, 50 oder 500 Videos positiv!";
  public $res_ach_text_150      = "Schreibe 10, 100 oder 1.000 Kommentare!";
  public $res_ach_text_160      = "10, 100 oder 1.000 User haben dich abonniert!";
  public $res_ach_text_170      = "Abonniere 5, 25 oder 250 User!";
  public $res_ach_text_180      = "Lade 5, 50 oder 100 Videos öffentlich hoch!";

  public $res_ach_text_200      = "Lade ein Video in 4k hoch!";
  public $res_ach_text_201      = "Füge einen Freund hinzu!";
  public $res_ach_text_202      = "Bewerte einen Kommentar positiv!";
  public $res_ach_text_203      = "Durchsuche die Kommentare!";
  public $res_ach_text_204      = "Sortiere die Kommentare!";
  public $res_ach_text_205      = "Bearbeite dein Kanaldesign!";
  public $res_ach_text_206      = "Nehme Einstellungen vor!";
  public $res_ach_text_207      = "Bewerte ein Video eines Freundes positiv!";
  public $res_ach_text_208      = "Um alle deine Videos schauen zu können, braucht man mindestens 24 Stunden!";
  public $res_ach_text_209      = "Erreiche mit allen deinen Videos zusammen mindestens 50.000 Aufrufe!";
  public $res_ach_text_210      = "Lade ein Video hoch welches länger als 10 Minuten geht!";

  public $res_ach_text_2016     = "Bekomme an Weihnachten 2016 ein Geschenk von uns!";

  public $all_achievements_from = "Alle Errungenschaften von";

  public $hidden_achievement    = "Noch nicht erhalten!";



  //===== channel ======

  public $channel_error_1       = "Kanal nicht vorhanden!";
  public $home_navi_title       = "Startseite";
  public $video_navi_title      = "Video";
  public $pl_navi_title         = "Playlist";
  public $achievement_navi_title= "Errungen-<br/>schaften";
  public $info_navi_title       = "Info";
  public $infofulltext_navi_title= "Kanalkommentare";
  public $home_edit_navi_title  = "Kanal <br/>bearbeiten";

  public $alle_videos           = "Alle Videos";
  public $allvideos_from_title  = "Alle Videos von";

  public $allplaylists_from_title= "Alle Playlists von";

  public $sortier_nach_title    = "Sortier_snach";

  public $sortiert_nach         = "Sortiert nach";
  public $sort_title1           = "Neuste zuerst";
  public $sort_title2           = "Ältere zuerst";
  public $sort_title3           = "Meiste Aufrufe";
  public $sort_title4           = "Beste Bewertung";


  /* info */
  public $i_flag_title          = "Kanal melden";
  public $i_edit_title          = "Bearbeiten";

  public $i_edit_title_long     = "Kanalinformation bearbeiten";
  public $i_edit_profile_title  = "Profilfoto";
  public $i_edit_profile_title2 = "Neues Profilfoto";
  public $i_edit_profile_title3 = "Aktuelles Profilfoto";
  public $i_edit_upload_title   = "Hochladen";

  public $s_title               = "Statistik";
  public $s_title_abos          = "Abonnenten";
  public $s_title_videos        = "Videos";
  public $s_title_totalview     = "Totale Aufrufe";
  public $s_title_online_time   = "Totale Onlinezeit";
  public $s_title_last          = "Letzte Aktivität";
  public $s_title_time          = "Länge aller Videos";

  public $i_info_placeholder    = "Schreibe hier deine Kanalbeschreibung";

  /* edit */



  //===== channel edit ======
  public $bild_edit_title       = "Bild";
  public $info_edit_title       = "Info";
  public $infofulltext_edit_title= "Kanalbeschreibung";
  public $no_channel_description = "Keine Kanalbeschreibung";
  public $video_edit_title      = "Video";
  public $videobeschreibung_edit_title = "Videobeschreibung";
  public $abonnenten_edit_title = "Abonnenten";
  public $diskussion_edit_title = "Kanalkommentare";
  public $comming_soon_edit_title = "Comming Soon";


  public $addContent            = "Inhalt hinzufügen:";
  public $hintergrund_add_title = "Hintergrund bearbeiten";
  public $avatar_add_title      = "Avatar bearbeiten";

  public $zumkanalvon           = "Zum Kanal von";
  public $abonenten_count       = "Abonnenten";

  public $automatisch           = "Wird Automatisch erstellt";

//background edit
  public $edit_background_title = "Hintergrund bearbeiten";
  public $edit_background_title1 = "Hintergrundbild hochladen";
  public $edit_background_title2 = "Erlaubte Bildformate: jpg und png (Empfohlene Grösse: 1920p x 1710p / Maximale Dateigrösse: 2.5mb)";
  public $edit_background_title3 = "Hochladen";
  public $edit_background_title4 = "Vorschau";
  public $edit_background_title4_5 = "Bild wählen...";
  public $edit_background_title5 = "Momentanes Hintergrundbild";
  public $edit_background_title6 = " Kein Hintergrundbild";
  public $edit_background_title7 = "Hintergrundfarbe wählen";
  public $edit_background_title8 = "Die Hintergrundfarbe wird auch da angezeigt, wo das Bild eventuel zu klein ist.";
  public $edit_background_title8_5 = "Wählen";
  public $edit_background_title9 = " Keine Hintergrundfarbe";
  public $edit_background_title10 = "Hintergrund speichern";
  public $edit_background_title11 = "Speichern";

  public $edit_background_alert1  = "Bei den Kanalhintergrund sind nur .jpg, .png Bilder erlaubt!";
  public $edit_background_alert2  = "Bild konnte nicht gespeichert werden!";
  public $edit_background_alert3  = "Datei darf nicht grösser als 2.5mb sein!";

//avatar edit
  public $edit_avatar_title     = "Avatar bearbeiten";
  public $edit_avatar_title1    = "Avatarbild hochladen";
  public $edit_avatar_title2    = "Erlaubte Bildformate: jpg, png und gif. (Empfole Grösse: 200p x 200p / Maximale Dateigrösse: 1mb)";
  public $edit_avatar_title3    = "Hochladen";
  public $edit_avatar_title4    = "Vorschau";
  public $edit_avatar_title4_5  = "Bild wählen...";
  public $edit_avatar_title5    = "Momentaner Avatar";
  public $edit_avatar_title6    = "Avatar Speichern";
  public $edit_avatar_title7    = "Speichern";

  public $edit_avatar_alert1    = "Bei dem Avatarbild sind nur .jpg, .png und .gif Bilder erlaubt!";
  public $edit_avatar_alert3    = "Datei darf nicht grösser als 1mb sein!";

//img edit
  public $edit_img_title        = "Inhalt bearbeiten";
  public $edit_img_title1       = "Bild URL hinzufügen";
  public $edit_img_title2       = "Rechtsklick auf das Bild in Ihrem Internet Browser und 'Bild URL kopiern' oder 'Grafikadresse kopiern' wählen. Dann unten einfügen.";
  public $edit_img_title2_5     = "Bild URL einfügen";
  public $edit_img_title3       = "Bild hochladen";
  public $edit_img_title4       = "Erlaubte Bildformate: jpg, png und gif. (Maximale Dateigrösse: 2mb)";
  public $edit_img_title5       = "Hochladen";
  public $edit_img_title5_5     = "Momentanes Bild";
  public $edit_img_title6       = "Vorschau";
  public $edit_img_title6_5     = "Bild wählen...";
  public $edit_img_title7       = "Bild Speichern";
  public $edit_img_title8       = "Speichern";
  public $edit_img_title9       = "";

//info edit
  public $edit_info_title       = "Inhalt bearbeiten";
  public $edit_info_title1      = "Titel";
  public $edit_info_title2      = "Inhalt";
  public $edit_info_title3      = "Mitglied seit";
  public $edit_info_title3_5    = "Herkunft";
  public $edit_info_title4      = "Standard";
  public $edit_info_title5      = "Einblenden";
  public $edit_info_title6      = "Ausblenden";
  public $edit_info_title7      = "Speichern";
  public $edit_info_title8      = "Kurzprofil";

  public $edit_info_alert1      = "Bei dem Profilbild sind nur .jpg und .png Bilder erlaubt!";
  public $edit_info_alert2      = "Profilfoto wurde hochgeladen!";
  public $edit_info_alert3      = "Die Datei darf nicht grösser als 2.0mb sein!";


//info edit
  public $edit_infofulltext_title = "Inhalt bearbeiten";

//Video edit
  public $edit_video_title      = "Inhalt bearbeiten";
  public $edit_video_title1     = "Meine Videos";
  public $edit_video_title2     = "Andere Videos";
  public $edit_video_title8     = "Speichern";

  public $edit_video_text1      = "Gib die URL des Videos ein";
  public $edit_video_text2      = "Video konnte nicht gefunden werden!";

} ?>
