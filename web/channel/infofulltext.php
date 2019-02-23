<?php
$full_text = $channel_design['info_full_text'];
$full_text = $com->fulltext($full_text);
$full_text = $f->autolink($full_text,array("target"=>"_blank"));

echo"<div class='infofulltext_frame'>";
echo"<profil>".$l->infofulltext_edit_title.":</profil>";
echo"<div class='info'>";

if($full_text == "" OR $full_text == " "){echo $no_descriptions;}
else
{echo $full_text; }

echo"</div>";
echo"</div>";
?>
