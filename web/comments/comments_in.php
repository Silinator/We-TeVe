<?php


class comments extends country{


  public function fulltext($input){
    $text = preg_replace('`<br>`','\n',$input);
    $text = preg_replace('`<br/>`','\n',$text);
    $text = preg_replace('`<br />`','\n',$text);
    $text = htmlentities($text, ENT_QUOTES);
    $text = str_replace('\n', '<br>', $text);

    return $text;
  }


  public function com_replace_time($com,$vuid,$_dhp){


    $com_s = str_replace("<br>", " <br> ", $com);

    $com_string = explode(" ", $com_s);


    for($i = 0; $i < count($com_string); $i++){

        if(strpos($com_string[$i], ":") != false){
          $time = $com_string[$i];
          $time_stemp = strpos($time, ":");

          $times = explode(":", $com_string[$i]);

          //echo implode(",", $times);

          $skip = 0;

          if(count($times) == 3){
            if(is_numeric($times[0]) AND is_numeric($times[1]) AND is_numeric($times[2])){
              $dauer = $times[0] * 3600 + $times[1] * 60 + $times[2]; $skip = 0;
            }else{
              $skip = 1;
            }
          }elseif(count($times) == 2){
            if(is_numeric($times[0]) AND is_numeric($times[1])){
              $dauer = $times[0] * 60 + $times[1]; $skip = 0;
            }else{
              $skip = 1;
            }
          }else{
            $skip = 1;
          }

          if($skip == 0){
            $time = str_replace(" ", "", $time);
            if($time != ""){
              $replace_time = "<a href='".$_dhp."watch/".$vuid."&t=".$dauer."' target='_blank' skipto='".$dauer."' class='vid_t_stamp blue'>".$time."</a>";
              $com = str_replace($time,$replace_time,$com);
            }
          }

        }//end if

    }//end for

    $com = str_replace("  ", " ", $com);
    return $com;

  }


  public function draw_comment($kuid,$layer,$mes_s,$show,$_dhp){   //type = ob host re oder rere  / show = ob 'zum Kommentar angezeigt wird oder nicht'


    //own usserinfo
      if($this->isUserLoggedIn() == 1){
        $user_uuid = $this->userin('uuid',0,'this','');
        $user_name = $this->userin('name',0,'this','');
        $user_rang = $this->userin('rang',0,'this','');
      }

    //com info
      $com_sql = db::$link->query("SELECT * FROM kommentar_db WHERE kuid = '$kuid'");
      $com_row = $com_sql->fetch_assoc();
        $com_vuid   = $com_row['vuid'];
        $com_cuid   = $com_row['cuid'];
        $com_uuid   = $com_row['uuid'];  $com_uuif = sha1(sha1($com_uuid));

            $sonderzeichen = array(
              '&auml;' => 'ä',
              '&uuml;' => 'ü',
              "&ouml;" => 'ö',
            );
              $com_text = str_replace(array_keys($sonderzeichen),
            array_values($sonderzeichen), $com_row['kommentar']);
        $com_text   = $this->fulltext($com_text);

        $com_vid    = $com_row['added_video'];
        $com_pos    = $com_row['pos_vote'];
        $com_neg    = $com_row['neg_vote'];
        $com_status = $com_row['status'];
        $com_time   = $com_row['time'];


    if($mes_s == 0 OR $mes_s == 1){ $mes_s = $mes_s; }else{ $mes_s = 0;}


    //channel
      if($com_cuid != ""){
        $channel_sql = db::$link->query("SELECT user_name FROM user_find_db WHERE uuid = '$com_cuid'");
        $channel_row = $channel_sql->fetch_assoc();

        $com_cuid = $channel_row['user_name'];
      }

    //com op info
      $com_op_user_sql = db::$link->query("SELECT uuid FROM video_db WHERE vuid = '$com_vuid'");
      $com_op_user_row = $com_op_user_sql->fetch_assoc();

        $com_video_uuid   = $com_op_user_row['uuid'];
          //op_class
          if($com_uuid == $com_video_uuid){
            $op_class = "com_op"; $op_text = "<span class='com_op_text'>OP</span>";
          }else{
            $op_class = ""; $op_text = "";
          }

    //com user info
        $com_uuid         = $this->userin('uuid',0,$com_uuif,'');
        $com_user_name    = $this->userin('name',0,$com_uuif,'');
        $com_user_land    = $this->userin('land',0,$com_uuif,'');
        $com_user_xp      = $this->userin('xp',0,$com_uuif,'');

      //avatar
        $com_user_avatar  = $_dhp.$this->draw_avatar($com_uuid,'small');

      //level
        $com_user_level   = $this->lvlinfo('level',$com_user_xp);
        $com_user_c_level = $this->lvlicon('c',$com_user_level);

      //land
        $com_user_land    = $this->draw_land($com_user_land,0);

      //time
        $com_time         = $this->invor($com_time);

      //layer
        $layer_class      = "com_layer".$layer;

        if($layer < 5)    {$re_layer = $layer+1;}else{$re_layer = $layer;}
        $re_layer_class   = "com_layer".$re_layer;

      //text
        $com_text         = $this->com_replace_time($com_text,$com_vuid,$_dhp);
        //status update
        if($com_status == "deleted"){
          $com_text       = "<i>[".$this->com_status_deleted."]</i>";
        }


      //re to
        if($layer > 1){
          $com_re_kuid    = $com_row['re_kuid'];

          $com_re_sql = db::$link->query("SELECT uuid FROM kommentar_db WHERE kuid = '$com_re_kuid'");
          $com_re_row = $com_re_sql->fetch_assoc();
            $com_re_uuid = $com_re_row['uuid'];  $com_re_uuif = sha1(sha1($com_re_uuid));

            $com_re_uuid      = $this->userin('uuid',0,$com_re_uuif,'');
            $com_re_user_name = $this->userin('name',0,$com_re_uuif,'');
        }

      //liked or not
        if($this->isUserLoggedIn() == 1){

          $vote_sql = db::$link->query("SELECT vote FROM kommentar_vote_db WHERE kuid = '$kuid' AND uuid = '$user_uuid' AND status = 'public'");
          $vote_row = $vote_sql->fetch_assoc();

          if($vote_row['vote'] == 'pos'){
            $upvote_class="com_vote_activ";
            $downvote_class="";
          }elseif($vote_row['vote'] == 'neg'){
            $upvote_class="";
            $downvote_class="com_vote_activ";
          }else{
            $upvote_class="";
            $downvote_class="";
          }

        }


      //vote
      $com_vote = $com_pos - $com_neg;
      if($com_vote > 0){
        $com_vote_class = "blue";
      }elseif($com_vote == 0){
        $com_vote_class = "blue";
      }else{
        $com_vote_class = "red";
      }


    //return



        if($show == 0){
          echo "<div class='com_line cl".$layer."'>";
            echo "<div class='com_layer_mark layer_mark".$layer." left'>
              <div class='layer_mark left lm1'>■  </div>
              <div class='layer_mark left lm2'>■  </div>
              <div class='layer_mark left lm3'>■  </div>
              <div class='layer_mark left lm4'>■  </div>
            </div>";
        }elseif($show == 2){
          echo "<div class='com_line cl".$layer."'>";
            echo "<div class='com_layer_mark layer_mark".$layer." left'>
              <div class='layer_mark left'>■  </div>
              <div class='layer_mark left'>■  </div>
              <div class='layer_mark left'>■  </div>
              <div class='layer_mark left'>■  </div>
            </div>";
        }else{
          echo "<div class='com_line cl1'>";
          $layer_class = "com_layer1";
        }



        echo "<div com='".$kuid."' class='com_container ".$layer_class." com_containe_".$kuid."'>";

          echo "<a class='left' href='".$_dhp."user/".$com_user_name."'>       <div class='com_avatar'><img alt='".$com_user_name."' src='".$com_user_avatar."'/></div> </a>";

          echo "<div class='com_content'>";

            echo "<div class='com_head'>";  //kopf
              echo "<a href='".$_dhp."user/".$com_user_name."'>        <div class='com_user_name ".$op_class."'>                   ".$com_user_name." ".$op_text."</div> </a>";
              echo "<a href=''>                                        <div class='com_user_land'>                                 ".$com_user_land."             </div> </a>";
              echo "<a href='".$_dhp."user/".$com_user_name."/achv'>   <div class='com_user_level f_color_".$com_user_c_level."'>  ".$com_user_level."            </div> </a>";
            echo "</div>";

            echo "<div class='com_text'>"; //bauch
              echo "<div class='text_cont com_text_".$kuid."'>";
                //added video box here
                if($layer > 1){ echo "<a href='".$_dhp."user/".$com_re_user_name."' class='com_re_usermane'>@".$com_re_user_name." </a>";}
                echo $com_text;
              echo "</div>";

              echo "<div for='".$kuid."' class='com_showmore showmore_".$kuid." hide'>";
                echo "<span class='com_showmore_press com_showmore_press_".$kuid."'> ".$this->com_show_more." </span>";
                echo "<span class='com_showless_press com_showless_press_".$kuid." hide'> ".$this->com_show_less." </span>";
              echo "</div> ";

            echo "</div>";


            echo "<div class='com_footer'>"; //fuss
              if($this->isUserLoggedIn() == 1){

                  if($show == 0 OR $show == 2){
                    echo "<div title='".$this->com_re_send_title."' for='new_re_com_".$kuid."' class='com_re_btn_box com_re_btn_press'> <span class='com_re_btn glyphicon glyphicon-share-alt'></span> </div>";
                  }else{
                    if($com_cuid == ""){
                      echo "<div title='".$this->com_to_com_title."' class='com_to_com_btn_box'> <a href='".$_dhp."watch/".$com_vuid."&k=".$kuid."' tocom='".$kuid."' class='com_to_com'> <i class='fa fa-commenting-o' aria-hidden='true'></i> </a> </div>";
                    }else{
                      echo "<div title='".$this->com_to_com_title."' class='com_to_com_btn_box'> <a href='".$_dhp."user/".$com_cuid."&k=".$kuid."' tocom='".$kuid."' class='com_to_com'> <i class='fa fa-commenting-o' aria-hidden='true'></i> </a> </div>";
                    }
                  }


                  if($user_uuid != $com_uuid){
                    echo "<div title='".$this->com_up_vote."'   for='".$kuid."' mes='".$mes_s."' class='".$upvote_class." com_up_btn_box com_up_btn_".$kuid."'>        <span class='com_up_btn glyphicon glyphicon-arrow-up'    ></span> </div>";
                    echo "<div title='".$this->com_down_vote."' for='".$kuid."' mes='".$mes_s."' class='".$downvote_class." com_down_btn_box com_down_btn_".$kuid."'>  <span class='com_down_btn glyphicon glyphicon-arrow-down'></span> </div>";
                  }

              }else{
                if($show == 0 OR $show == 2){
                  echo "<a href='".$_dhp."login/' target='_blank' title='".$this->login_title_0."' class='com_re_btn_box'>   <span class='com_re_btn glyphicon glyphicon-share-alt'>   </span> </a>";
                  echo "<a href='".$_dhp."login/' target='_blank' title='".$this->login_title_0."' class='com_up_btn_box'>   <span class='com_up_btn glyphicon glyphicon-arrow-up'>    </span> </a>";
                  echo "<a href='".$_dhp."login/' target='_blank' title='".$this->login_title_0."' class='com_down_btn_box'> <span class='com_down_btn glyphicon glyphicon-arrow-down'></span> </a>";
                }else{
                  if($com_cuid == ""){
                    echo "<div title='".$this->com_to_com_title."' class='com_to_com_btn_box'> <a href='".$_dhp."watch/".$com_vuid."&k=".$kuid."' tocom='".$kuid."' class='com_to_com'> <i class='fa fa-commenting-o' aria-hidden='true'></i> </a> </div>";
                  }else{
                    echo "<div title='".$this->com_to_com_title."' class='com_to_com_btn_box'> <a href='".$_dhp."user/".$com_cuid."&k=".$kuid."' tocom='".$kuid."' class='com_to_com'> <i class='fa fa-commenting-o' aria-hidden='true'></i> </a> </div>";
                  }
                }
              }

              //vote
                echo "<div class='com_votes com_vote_".$kuid." ".$com_vote_class."'>".$com_vote."</div>";

              //time
                echo "<div class='com_time_spamp'>".$com_time."</div>";

              //del menu
              if($this->isUserLoggedIn() == 1){
                if($user_uuid == $com_uuid OR $user_uuid == $com_video_uuid OR $user_rang == 1){
                  echo "<div for='".$kuid."' class='com_more_menu_btn'>";
                    echo "<span class='glyphicon glyphicon-option-horizontal'></span>";
                  echo "</div>";
                }
              }


            echo "</div>";

            //vote error
            if($this->isUserLoggedIn() == 1){
              echo "<div class='com_vote_error com_vote_error_".$kuid." hide'>".$this->com_alert_not_like."</div>";
              echo "<div class='com_vote_error com_vote_error2_".$kuid." hide'>".$this->com_alert_not_like2."</div>";
              echo "<div class='com_vote_error com_del_error1_".$kuid." hide'>".$this->com_alert_not_del."</div>";
            }


          echo "</div>"; //end com_content

        echo "</div>"; //end com_container

        if($this->isUserLoggedIn() == 1){
            if($user_uuid == $com_uuid OR $user_uuid == $com_video_uuid OR $user_rang == 1){
            echo "<div class='com_more_menu com_more_menu_".$kuid." hide'>";
              echo "<div kuid='".$kuid."' class='com_more_mebu_btns com_del_btn'>".$this->com_del_title ."</div>";
            }

          if($user_uuid == $com_uuid OR $user_uuid == $com_video_uuid OR $user_rang == 1){
            echo "</div>";
          }
        }


  echo "</div>"; //end com_line


  //Antwort Formular
    if($this->isUserLoggedIn() == 1 AND ($show == 0 OR $show == 2)){

      echo "<div class='re_com_line new_re_com_".$kuid." cl".$re_layer." hide'>";


          echo "<div class='com_layer_mark layer_mark".$re_layer." left'>
              <div class='layer_mark left lm1'>■  </div>
              <div class='layer_mark left lm2'>■  </div>
              <div class='layer_mark left lm3'>■  </div>
              <div class='layer_mark left lm4'>■  </div>
          </div>";




        echo "<div class='".$re_layer_class." new_re_com_container'>";
          $user_avatar = $_dhp.$this->draw_avatar($user_uuid,"small");
            echo "<div class='new_re_com_avatar'><img alt='".$user_name."' src='".$user_avatar."'/></div>";
            echo "<div class='new_com_name'>".$user_name."</div>";
            echo "<div contentEditable='true' syn='new_com_".$kuid."' class='com_input new_re_com_text new_com_".$kuid." ph_empty' placeholder='".$this->com_re_placeholder."'></div>";
            echo "<div class='video_selecter vid_new_com_".$kuid."'></div>";
            echo "<div class='hide com_alert alert_new_com_".$kuid."'>".$this->com_alert_not_send."</div>";
            echo "<div class='hide com_alert alert2_new_com_".$kuid."'>".$this->com_alert_not_send2."</div>";

          echo "<div for_com='new_com_".$kuid."' vid='' mes='".$mes_s."' re='".$kuid."' class='com_send_btn com_enter'>
            <span class='com_send_text'>".$this->com_re_send_title."</span>
            <span class='com_send_loading hide'><img src='".$_dhp."images/icons/ajax-loader.gif' alt='We-Teve'/> ".$this->loading."</span>
          </div>";

          echo "<div class='cancel_re_texting'> Abbrechen </div>";
        echo "</div>";

      echo "</div>";

      //vorschau des neuen kommentars nach drücken von enter
      echo "<div class='answ_new_com_".$kuid."'></div>";
    }


  }//end function draw_comment



  public function findhostcom($re_kuid){
    $com_sql = db::$link->query("SELECT re_kuid FROM kommentar_db WHERE kuid = '$re_kuid'");
    $com_row = $com_sql->fetch_assoc();

    if($com_row['re_kuid'] == ""){
      return $re_kuid;
    }else{
      return $this->findhostcom($com_row['re_kuid']);
    }
  }



  public function re_commenting($rekuid,$mes_s,$show,$_dhp){
    $re_results = db::$link->query("SELECT kuid FROM kommentar_db WHERE re_kuid = '$rekuid' ORDER BY time ASC");
      while($re_row = $re_results->fetch_array()){
        $kuid = $re_row['kuid'];
        if($kuid != ""){
          $this->draw_comment($kuid,'5',$mes_s,$show,$_dhp);
          $this->re_commenting($kuid,$mes_s,$show,$_dhp);
        }
      }
  }


}//end class

$com = new comments;

?>
