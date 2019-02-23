<?php
class messages extends time{



  public function add_not($not_type,$not_data,$uuid){

			$time = strtotime(date('Y-m-d H:i:s'));

			$add_notification = "INSERT INTO notification_db
				(notification_type,notification_data,uuid,time,viewed,status)
				VALUES
				('$not_type','$not_data','$uuid','$time','0','public')";
			$add_notification = db::$link->query($add_notification);

	}


  public function remove_not($not_type,$not_data,$uuid){

      $mes_up = "DELETE FROM notification_db WHERE notification_type = '$not_type' AND notification_data = '$not_data' AND uuid = '$uuid'";
      $mes_up = db::$link->query($mes_up);

  }



	public function add_mes($mes_type,$mes_data,$mes_data2,$del,$uuid){

			$time = strtotime(date('Y-m-d H:i:s'));

			if($mes_type > 4){

				$mes_sql = db::$link->query("SELECT message_id,message_data2,status FROM message_db WHERE message_type = '$mes_type' AND message_data = '$mes_data' AND uuid = '$uuid'");
				$mes_row = $mes_sql->fetch_assoc();

				if($mes_row['status'] == "public" OR $mes_row['status'] == "deleted"){

					$mes_id = $mes_row['message_id'];

          $mes_olddata2 = $mes_row['message_data2'];
					$mes_data2 = $mes_data2.",".$mes_olddata2;

						$mes_up = "UPDATE message_db SET message_data2 = '$mes_data2' WHERE message_id = '$mes_id'";
						$mes_up = db::$link->query($mes_up);

            if($del == 0){
              //damit die message wieder oben angezeigt wird
              $mes_up = "UPDATE message_db SET viewed = '0' WHERE message_id = '$mes_id'";
              $mes_up = db::$link->query($mes_up);

              $mes_up = "UPDATE message_db SET time = '$time' WHERE message_id = '$mes_id'";
              $mes_up = db::$link->query($mes_up);
            }

            //else nix, wenn es gelöscht war soll es nicht nochmal obenkommen.



				}else{ //normal setzen
					$set_message = "INSERT INTO message_db
						(message_type,message_data,message_data2,uuid,viewed,status,time) VALUES
						('$mes_type','$mes_data','$mes_data2','$uuid','0','public','$time')";
					$set_message = db::$link->query($set_message);
				}

			}else{
				//einfach setzten aber nur für neu/antwort kommentare
				$set_message = "INSERT INTO message_db
					(message_type,message_data,message_data2,uuid,viewed,status,time) VALUES
					('$mes_type','$mes_data','$mes_data2','$uuid','0','public','$time')";
				$set_message = db::$link->query($set_message);
			}

	}


	public function remove_mes($mes_type,$mes_data,$uuid){

    $mes_sql = db::$link->query("SELECT message_id,message_data2,status FROM message_db WHERE message_type = '$mes_type' AND message_data = '$mes_data' AND uuid = '$uuid' AND status = 'public'");
    $mes_row = $mes_sql->fetch_assoc();

      $mes_id = $mes_row['message_id'];


    if($mes_type > 4){
        $mes_olddata2     = (explode(",",$mes_row['message_data2']));
        $mes_olddate_key  = array_search(",".$uuid,$mes_olddata2);

        if($mes_olddate_key == ""){ //damit das komma nicht alleine zurück bleibt und eine leere arrayposition ensteht
          $mes_olddate_key = array_search($uuid,$mes_olddata2);
        }

        unset($mes_olddata2[$mes_olddate_key]);

          $mes_data2 = implode(",", $mes_olddata2);

          $mes_up = "UPDATE message_db SET message_data2 = '$mes_data2' WHERE message_id = '$mes_id'";
          $mes_up = db::$link->query($mes_up);

          $mes_up = "UPDATE message_db SET viewed = '1' WHERE message_id = '$mes_id'";
          $mes_up = db::$link->query($mes_up);

    }else{
      //einfach löschen aber nur für neu/antwort kommentare
      $mes_up = "UPDATE message_db SET status = 'deleted' WHERE message_id = '$mes_id'";
      $mes_up = db::$link->query($mes_up);
    }


	}



}//end class

$mes = new messages;
