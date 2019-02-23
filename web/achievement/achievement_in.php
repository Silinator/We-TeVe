<?php
class achievement extends level{
	//'extends time' fügt die andere Class hinzu

  //xp liste bei level/lvelin.php

  //add event Achivement
  public function add_ach_event($ach,$uuid){

    $this->add_not('1',$ach,$uuid);

  }


  //add ach hinzufügen
  public function add_ach($ach,$ach_data,$uuid)
  {
    $xp_bank_sql = db::$link->query("SELECT COUNT(ach_id) FROM achievement_db WHERE uuid = '$uuid' AND achievement = '$ach' AND achievement_data = '$ach_data' AND status = 'public'");
    $xp_bank_row = $xp_bank_sql->fetch_row();

    if($xp_bank_row[0] == 0){

      $time = date('H:i:s d-m-Y');
      $time = strtotime($time);

      $add_ach = "INSERT INTO achievement_db
            (uuid,achievement,achievement_data,time,status)
            VALUES
            ('$uuid','$ach','$ach_data','$time','public')";
      $add_ach = db::$link->query($add_ach);

      if($add_ach == true){
          $this->add_ach_event($ach,$uuid);
          $this->add_xp($ach,$ach_data,$uuid);
      }
    }
  }

}//end class

$ach = new achievement;
//funktions besispiele zum kopieren:
//ach => achievment
//ach add für den actionsausfürenden         ->    add_ach('01',0,$ach_100,$db_link,$user_id);
?>
