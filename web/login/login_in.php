<?php

if(!isset($upload_in)){

  session_start();
  $isUserLoggedIn = 0;

  //wenn user nur über die cookies angemeldet ist. Wird die session gesetzt
  if(isset($_COOKIE["usercode"])) {
    $usercode = $_COOKIE["usercode"];
    setcookie("usercode", $usercode, time()+2592000, "/");
    $_SESSION["usercode"] = $usercode;
    $usercode = hash('sha256', "$usercode");
    $usercode = sha1($usercode);
    $isUserLoggedIn = 1;
  }

  //wenn user nur über die session angemeldet ist
  if(isset($_SESSION["usercode"])){
    $isUserLoggedIn = 1;
    $usercode = $_SESSION["usercode"];
    $usercode = hash('sha256', "$usercode");
    $usercode = sha1($usercode);
  }

  //wenn user "eingeloggt bleinben drückt"
  if(isset($_SESSION['keeplogedin']) AND isset($_SESSION['usercode'])){
    setcookie("usercode", $_SESSION["usercode"], time()+2592000, "/");
    unset($_SESSION['keeplogedin']);
  }

  //test ob gültig
  if($isUserLoggedIn === 1) {
    $my_query = db::$link->query("SELECT * FROM user_db WHERE uukc = '$usercode'");
    $row = $my_query->fetch_assoc();
    $user_id = $row['uuid'];
    if($user_id == ""){
      $isUserLoggedIn = 0;
      session_destroy();
      setcookie("usercode","",time()-3600, "/");
      session_start();
    }
  }

}

//=================================================
//================ USER INFOS =====================
//=================================================

//$isUserLoggedIn = 1;


if(!isset($upload_in)){

  class user extends verschluesseln{


        public function get_usercode(){

          //wenn user nur über die cookies angemeldet ist. Wird die session gesetzt
          if(isset($_COOKIE["usercode"])) {
            $usercode = $_COOKIE["usercode"];
            $usercode = hash('sha256', "$usercode");
            $usercode = sha1($usercode);
          }

          //wenn user nur über die session angemeldet ist
          if(isset($_SESSION["usercode"])){
            $usercode = $_SESSION["usercode"];
            $usercode = hash('sha256', "$usercode");
            $usercode = sha1($usercode);
          }

          return $usercode;
        }


        public function isUserLoggedIn(){

          $isUserLoggedIn = 0;
          //wenn user nur über die cookies angemeldet ist. Wird die session gesetzt
          if(isset($_COOKIE["usercode"])) {
            $usercode = $_COOKIE["usercode"];
            $usercode = hash('sha256', "$usercode");
            $usercode = sha1($usercode);
            $isUserLoggedIn = 1;
          }

          //wenn user nur über die session angemeldet ist
          if(isset($_SESSION["usercode"])){
            $isUserLoggedIn = 1;
            $usercode = $_SESSION["usercode"];
            $usercode = hash('sha256', "$usercode");
            $usercode = sha1($usercode);
          }

          //test ob gültig
          if($isUserLoggedIn === 1) {
            $my_query = db::$link->query("SELECT * FROM user_db WHERE uukc = '$usercode'");
            $row = $my_query->fetch_assoc();
            $user_id = $row['uuid'];
            if($user_id == ""){
              $isUserLoggedIn = 0;
              session_destroy();
              setcookie("usercode","",time()-3600, "/");
              session_start();
            }
          }

          return $isUserLoggedIn;

        }


      public function userin($erg,$ver,$user,$usercode_up){

       if($user == "this"){
         $usercode = $this->get_usercode();
         $my_query = db::$link->query("SELECT * FROM user_db WHERE uukc = '$usercode'");
       }elseif($user == ''){
         $user_code = hash('sha256', $usercode_up);
         $user_code = sha1($user_code);
         $my_query = db::$link->query("SELECT * FROM user_db WHERE uukc = '$user_code'");
       }else{
         $my_query = db::$link->query("SELECT * FROM user_db WHERE uuif = '$user'");
       }
         $row = $my_query->fetch_assoc();

         if($ver == 1){
           if
           ($erg == "key"){$ec = $row['uuka'];}elseif
           ($erg == "key2"){$ec = $row['uukb'];}elseif
           ($erg == "uuid"){$ec = $row['uuid'];}elseif
           ($erg == "rang"){$ec = $row['user_rang'];}elseif
           ($erg == "name"){$ec = $row['user_name'];}elseif
           ($erg == "name_s"){$ec = $row['user'];}elseif
           ($erg == "mail"){$ec = $row['email'];}elseif
           ($erg == "abos"){$ec = $row['abos'];}elseif
           ($erg == "friends"){$ec = $row['friends'];}elseif
           ($erg == "max_friends"){$ec = $row['max_friends'];}elseif
           ($erg == "xp"){$ec = $row['xp'];}elseif
           ($erg == "level"){$ec = $row['level'];}elseif
           ($erg == "max_level"){$ec = $row['max_level'];}elseif
           ($erg == "vpw"){$ec = $row['vpw'];}elseif
           ($erg == "strikes"){$ec = $row['strikes'];}elseif
           ($erg == "blocked"){$ec = $row['blocked'];}elseif
           ($erg == "ip"){$ec = $row['ip'];}elseif
           ($erg == "host"){$ec = $row['host'];}elseif
           ($erg == "beitrit"){$ec = $row['beitrit'];}elseif
           ($erg == "birthday"){$ec = $row['birthday'];}elseif
           ($erg == "land"){$ec = $row['land'];}elseif
           ($erg == "lang"){$ec = $row['sprache'];}elseif
           ($erg == "last_online_time"){$ec = $row['last_online_time'];}elseif
           ($erg == "coins"){$ec = $row['coins'];}
         }else{
           $key = $row['uuka'];
           $key2 = $row['uukb'];

           if
           ($erg == "key"){$ec = $row['uuka'];}elseif
           ($erg == "key2"){$ec = $row['uukb'];}elseif
           ($erg == "uuid"){$ec = $this->ent($row['uuid'],$key,$key2);}elseif
           ($erg == "rang"){$ec = $this->ent($row['user_rang'],$key,$key2);}elseif
           ($erg == "name"){$ec = $this->ent($row['user_name'],$key,$key2);}elseif
           ($erg == "name_s"){$ec = $this->ent($row['user'],$key,$key2);}elseif
           ($erg == "mail"){$ec = $this->ent($row['email'],$key,$key2);}elseif
           ($erg == "abos"){$ec = $this->ent($row['abos'],$key,$key2);}elseif
           ($erg == "friends"){$ec = $this->ent($row['friends'],$key,$key2);}elseif
           ($erg == "max_friends"){$ec = $this->ent($row['max_friends'],$key,$key2);}elseif
           ($erg == "xp"){$ec = $this->ent($row['xp'],$key,$key2);}elseif
           ($erg == "level"){$ec = $this->ent($row['level'],$key,$key2);}elseif
           ($erg == "max_level"){$ec = $this->ent($row['max_level'],$key,$key2);}elseif
           ($erg == "vpw"){$ec = $this->ent($row['vpw'],$key,$key2);}elseif
           ($erg == "strikes"){$ec = $this->ent($row['strikes'],$key,$key2);}elseif
           ($erg == "blocked"){$ec = $this->ent($row['blocked'],$key,$key2);}elseif
           ($erg == "ip"){$ec = $this->ent($row['ip'],$key,$key2);}elseif
           ($erg == "host"){$ec = $this->ent($row['host'],$key,$key2);}elseif
           ($erg == "beitrit"){$ec = $this->ent($row['beitrit'],$key,$key2);}elseif
           ($erg == "birthday"){$ec = $this->ent($row['birthday'],$key,$key2);}elseif
           ($erg == "land"){$ec = $this->ent($row['land'],$key,$key2);}elseif
           ($erg == "lang"){$ec = $this->ent($row['sprache'],$key,$key2);}elseif
           ($erg == "last_online_time"){$ec = $this->ent($row['last_online_time'],$key,$key2);}elseif
           ($erg == "coins"){$ec = $this->ent($row['coins'],$key,$key2);}
         }

         $null = ""; //wenn abfrage leer ist.

           return $ec;

     }



     public function userinset($in,$val,$user){
       $my_query = db::$link->query("SELECT * FROM user_db WHERE uuif = '$user'");
       $row = $my_query->fetch_assoc();

       $key = $row['uuka'];
       $key2 = $row['uukb'];

       $val = $this->ver($val,$key,$key2);

       $up = "UPDATE user_db SET $in = '$val' WHERE uuif = '$user'";
       $up = db::$link->query($up);

       return $up;
     }



      public function draw_avatar($user_uuid,$size){
          $user_avatar_sql = db::$link->query("SELECT avatar_type,background_type FROM channel_design_db WHERE uuid = '$user_uuid'");
          $avatar_user_row = $user_avatar_sql->fetch_assoc();

          $img_type = $avatar_user_row['avatar_type'];

          if($img_type == "png" OR $img_type == "jpg" OR $img_type == "gif")
            {$user_avatar = "images/avatar/".$size."/".$user_uuid.".".$img_type;}
            else
            {$user_avatar = "images/avatar/default/".$img_type.".png";}

        return $user_avatar;
      }


  }


  $u = new user;


}else{

  class user extends verschluesseln{


      public function get_usercode(){
        return "_";
      }

      public function userin($erg,$ver,$user,$usercode_up){

       if($user == "this"){
         $usercode = $this->get_usercode();
         $my_query = db::$link->query("SELECT * FROM user_db WHERE uukc = '$usercode'");
       }elseif($user == ''){
         $user_code = hash('sha256', $usercode_up);
         $user_code = sha1($user_code);
         $my_query = db::$link->query("SELECT * FROM user_db WHERE uukc = '$user_code'");
       }else{
         $my_query = db::$link->query("SELECT * FROM user_db WHERE uuif = '$user'");
       }
         $row = $my_query->fetch_assoc();

         if($ver == 1){
           if
           ($erg == "key"){$ec = $row['uuka'];}elseif
           ($erg == "key2"){$ec = $row['uukb'];}elseif
           ($erg == "uuid"){$ec = $row['uuid'];}elseif
           ($erg == "rang"){$ec = $row['user_rang'];}elseif
           ($erg == "name"){$ec = $row['user_name'];}elseif
           ($erg == "name_s"){$ec = $row['user'];}elseif
           ($erg == "mail"){$ec = $row['email'];}elseif
           ($erg == "abos"){$ec = $row['abos'];}elseif
           ($erg == "friends"){$ec = $row['friends'];}elseif
           ($erg == "max_friends"){$ec = $row['max_friends'];}elseif
           ($erg == "xp"){$ec = $row['xp'];}elseif
           ($erg == "level"){$ec = $row['level'];}elseif
           ($erg == "max_level"){$ec = $row['max_level'];}elseif
           ($erg == "vpw"){$ec = $row['vpw'];}elseif
           ($erg == "strikes"){$ec = $row['strikes'];}elseif
           ($erg == "blocked"){$ec = $row['blocked'];}elseif
           ($erg == "ip"){$ec = $row['ip'];}elseif
           ($erg == "host"){$ec = $row['host'];}elseif
           ($erg == "beitrit"){$ec = $row['beitrit'];}elseif
           ($erg == "birthday"){$ec = $row['birthday'];}elseif
           ($erg == "land"){$ec = $row['land'];}elseif
           ($erg == "lang"){$ec = $row['sprache'];}elseif
           ($erg == "last_online_time"){$ec = $row['last_online_time'];}elseif
           ($erg == "coins"){$ec = $row['coins'];}
         }else{
           $key = $row['uuka'];
           $key2 = $row['uukb'];

           if
           ($erg == "key"){$ec = $row['uuka'];}elseif
           ($erg == "key2"){$ec = $row['uukb'];}elseif
           ($erg == "uuid"){$ec = $this->ent($row['uuid'],$key,$key2);}elseif
           ($erg == "rang"){$ec = $this->ent($row['user_rang'],$key,$key2);}elseif
           ($erg == "name"){$ec = $this->ent($row['user_name'],$key,$key2);}elseif
           ($erg == "name_s"){$ec = $this->ent($row['user'],$key,$key2);}elseif
           ($erg == "mail"){$ec = $this->ent($row['email'],$key,$key2);}elseif
           ($erg == "abos"){$ec = $this->ent($row['abos'],$key,$key2);}elseif
           ($erg == "friends"){$ec = $this->ent($row['friends'],$key,$key2);}elseif
           ($erg == "max_friends"){$ec = $this->ent($row['max_friends'],$key,$key2);}elseif
           ($erg == "xp"){$ec = $this->ent($row['xp'],$key,$key2);}elseif
           ($erg == "level"){$ec = $this->ent($row['level'],$key,$key2);}elseif
           ($erg == "max_level"){$ec = $this->ent($row['max_level'],$key,$key2);}elseif
           ($erg == "vpw"){$ec = $this->ent($row['vpw'],$key,$key2);}elseif
           ($erg == "strikes"){$ec = $this->ent($row['strikes'],$key,$key2);}elseif
           ($erg == "blocked"){$ec = $this->ent($row['blocked'],$key,$key2);}elseif
           ($erg == "ip"){$ec = $this->ent($row['ip'],$key,$key2);}elseif
           ($erg == "host"){$ec = $this->ent($row['host'],$key,$key2);}elseif
           ($erg == "beitrit"){$ec = $this->ent($row['beitrit'],$key,$key2);}elseif
           ($erg == "birthday"){$ec = $this->ent($row['birthday'],$key,$key2);}elseif
           ($erg == "land"){$ec = $this->ent($row['land'],$key,$key2);}elseif
           ($erg == "lang"){$ec = $this->ent($row['sprache'],$key,$key2);}elseif
           ($erg == "last_online_time"){$ec = $this->ent($row['last_online_time'],$key,$key2);}elseif
           ($erg == "coins"){$ec = $this->ent($row['coins'],$key,$key2);}
         }

         $null = ""; //wenn abfrage leer ist.

           return $ec;

     }



     public function userinset($in,$val,$user){
       $my_query = db::$link->query("SELECT * FROM user_db WHERE uuif = '$user'");
       $row = $my_query->fetch_assoc();

       $key = $row['uuka'];
       $key2 = $row['uukb'];

       $val = $this->ver($val,$key,$key2);

       $up = "UPDATE user_db SET $in = '$val' WHERE uuif = '$user'";
       $up = db::$link->query($up);

       return $up;
     }



      public function draw_avatar($user_uuid,$size){
          $user_avatar_sql = db::$link->query("SELECT avatar_type,background_type FROM channel_design_db WHERE uuid = '$user_uuid'");
          $avatar_user_row = $user_avatar_sql->fetch_assoc();

          $img_type = $avatar_user_row['avatar_type'];

          if($img_type == "png" OR $img_type == "jpg" OR $img_type == "gif")
            {$user_avatar = "images/avatar/".$size."/".$user_uuid.".".$img_type;}
            else
            {$user_avatar = "images/avatar/default/".$img_type.".png";}

        return $user_avatar;
      }


  }


  $u = new user;

}

?>
