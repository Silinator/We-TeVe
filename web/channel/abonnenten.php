<?php

$abos = $channel_sub_n;


echo"<abonennten_box>";
echo"<profil>".$l->abonnenten_edit_title." (".$abos."):</profil>";
echo"<div style='display:block; height:20px; width:100%; float:left;'></div>";

$results = db::$link->query("SELECT user_uuid FROM abo_db WHERE abo_user_uuid = '$channel_uuid' ORDER BY first_time DESC");
while($row = $results->fetch_array()){


echo "<user_box>";

  $f->draw_user_preview($row['user_uuid'],$_dhp);

//ende Abobutton
echo "</user_box>";

}
echo"</abonennten_box>";
?>
