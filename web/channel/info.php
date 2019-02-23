<?php

$channel_uuif = sha1(sha1($channel_uuid));
$channel_beitrit = $u->userin('beitrit',0,$channel_uuif,'');

$date_beitrit = $channel_beitrit;
$date_info = $t->normtime($date_beitrit,'date');

$channel_design = db::$link->query("SELECT * FROM channel_design_db WHERE uuid = '$channel_uuid'");
$channel_design = $channel_design->fetch_assoc();

$land_label = "land_label_".$channel_land;
$land_info = $l->$land_label;

$info_date_value = $channel_design['view_date'];
$info_country_value = $channel_design['view_country'];
$title_1 = $channel_design['info_title_1'];
$text_1 = $channel_design['info_text_1'];
$title_2 = $channel_design['info_title_2'];
$text_2 = $channel_design['info_text_2'];
$title_3 = $channel_design['info_title_3'];
$text_3 = $channel_design['info_text_3'];
$title_4 = $channel_design['info_title_4'];
$text_4 = $channel_design['info_text_4'];

echo"<div class='info_frame'>";
echo"<profil>".$l->edit_info_title8."</profil>";
echo"<div class='info'>";

    if($info_date_value == 1){
    echo"<info_line>";
    echo"<InfoTitle>".$l->edit_info_title3.":</InfoTitle> <InfoText>".$date_info."</InfoText>";
    echo"</info_line>";
    }

    if($info_country_value == 1){
    echo"<info_line>";
    echo"<InfoTitle>".$l->edit_info_title3_5.":</InfoTitle> <InfoText>".$land_info."</InfoText>";
    echo"</info_line>";
    }

    if($title_1 != "" AND $text_1 != ""){
    echo"<info_line>";
    echo"<InfoTitle>".$title_1.":</InfoTitle> <InfoText>".$text_1."</InfoText>";
    echo"</info_line>";
    }

    if($title_2 != "" AND $text_2 != ""){
    echo"<info_line>";
    echo"<InfoTitle>".$title_2.":</InfoTitle> <InfoText>".$text_2."</InfoText>";
    echo"</info_line>";
    }

    if($title_3 != "" AND $text_3 != ""){
    echo"<info_line>";
    echo"<InfoTitle>".$title_3.":</InfoTitle> <InfoText>".$text_3."</InfoText>";
    echo"</info_line>";
    }

    if($title_4 != "" AND $text_4 != ""){
    echo"<info_line>";
    echo"<InfoTitle>".$title_4.":</InfoTitle> <InfoText>".$text_4."<InfoText>";
    echo"</info_line>";
    }

echo"</div>";
echo"</div>";
?>
