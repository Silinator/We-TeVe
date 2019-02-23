<?php
  if(isset($in_save_code_db_include) AND $in_save_code_db_include == "X@86AH5K8.pZ_m@6_^-{3BD4cD^s<kF4"){

    class db {
      public static $link;
    }

    db::$link = new mysqli($_db_host, $_db_user, $_db_pw, $_db_name);


    /*

    Bei nur einer ausgabe keinem array oder für while schleifen
    -
    $my_query = db::$link->query("SELECT * FROM video_db WHERE user_name = 'we-teve' ORDERBY 'video_id' asc LIMIT 3, 3");
    $row = $my_query->fetch_assoc();
    echo $row['vuid'];

    ---------------------------------------------------

    Update
    -
    $pl_views = "UPDATE playlist_bank SET views = (views + 1) WHERE playlist_id = '$playlist_id'";
    $pl_views = db::$link->query($pl_views);


    */



  }else{

    header("HTTP/1.0 404 Not Found");

  }
?>
