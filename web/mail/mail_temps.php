<?php



class mail_temps extends mail {  // extends time


  public function get_mail_content($sendto,$use,$user_name,$regincode){

    $mail_style        = "<style>body{background-color:#A8A8A8;font-family: 'Segoe UI', Serif;}h1{color: #007abf;}a{color: #007abf;}wrapper{width: 600px;margin: auto;display: block;}header{background-color: #DEDEDE;color: #333333;height: 36px;}header img{float: left;}header p{float: left;margin: 7px 0 0 10px;}content{width: 580px;float:left;background-color: #ffffff;color: #333333;padding: 0 10px 0 10px;}footer{background-color: #DEDEDE;color: #333333;clear: both;width: 600px;height: 36px;display:block;}minifooter{display:block;width: 350px;margin: auto;}fconntent a{float:left;color: #333333;margin: 0 15px 0 15px;}</style>";
    $mail_footer       = "<footer><minifooter><fconntent><a href='https://www.we-teve.com'>".$this->home."</a></fconntent><fconntent><a href='https://www.we-teve.com/login/'>".$this->login_title_0."</a></fconntent><fconntent><a href='https://www.we-teve.com/registry/'>".$this->regin_title_0."</a></fconntent></minifooter></footer>";



if($use == 'login'){


      $mail_subject = "=?utf-8?b?".base64_encode("".$this->mail_login_subject."")."?=";

      $mail_content = "
      <html><head>".$mail_style."</head><body><wrapper>
          <header><img src='https://www.we-teve.com/images/icons/logo.png' alt='We-TeVe'/><p>".$this->mail_service_title."</p></header>

          <content>
					<h1>".$this->mail_login_text_1." ".$user_name."</h1>
					".$this->mail_login_text_2."<br/>
					".$this->mail_login_text_3."<br/>
					<h2>".$regincode."</h2>

					".$this->mail_use_info."
					<br/>
					<br/>
					</content>
        ".$mail_footer."
      </wrapper></body></html>";


}elseif($use == 'regin'){


      $mail_subject = "=?utf-8?b?".base64_encode("".$this->mail_login_subject."")."?=";

      $mail_content = "
      <html><head>".$mail_style."</head><body><wrapper>
          <header><img src='https://www.we-teve.com/images/icons/logo.png' alt='We-TeVe'/><p>".$this->mail_service_title."</p></header>

          <content>
          <h1>".$this->mail_regin_text_1." ".$user_name."</h1>
          ".$this->mail_regin_text_2."<br/>
          ".$this->mail_regin_text_3."<br/>
          <h2>".$regincode."</h2>

          ".$this->mail_use_info."
          <br/>
          <br/>
          </content>
        ".$mail_footer."
      </wrapper></body></html>";


}elseif($use == 'new_mail_code'){


      $mail_subject = "=?utf-8?b?".base64_encode("".$this->mail_new_mc_subject."")."?=";

      $mail_content = "
      <html><head>".$mail_style."</head><body><wrapper>
          <header><img src='https://www.we-teve.com/images/icons/logo.png' alt='We-TeVe'/><p>".$this->mail_service_title."</p></header>

          <content>
					<h1>".$this->mail_new_mc_text_1." ".$user_name."</h1>
					".$this->mail_new_mc_text_2."<br/>
					".$this->mail_new_mc_text_3."<br/>
					<h2>".$regincode."</h2>

					".$this->mail_new_use_info."
					<br/>
					<br/>
					</content>
        ".$mail_footer."
      </wrapper></body></html>";


}elseif($use == 'new_pw'){


      $mail_subject = "=?utf-8?b?".base64_encode("".$this->mail_new_pw_subject."")."?=";

      $mail_content = "
      <html><head>".$mail_style."</head><body><wrapper>
          <header><img src='https://www.we-teve.com/images/icons/logo.png' alt='We-TeVe'/><p>".$this->mail_service_title."</p></header>

          <content>
          <h1>".$this->mail_regin_text_1." ".$user_name."</h1>
          ".$this->mail_new_pw_text_2."<br/>
          ".$this->mail_new_pw_text_3."<br/>
          <br/>
          <br/>
          </content>
        ".$mail_footer."
      </wrapper></body></html>";


}elseif($use == 'new_email'){


      $mail_subject = "=?utf-8?b?".base64_encode("".$this->mail_login_subject."")."?=";

      $mail_content = "
      <html><head>".$mail_style."</head><body><wrapper>
          <header><img src='https://www.we-teve.com/images/icons/logo.png' alt='We-TeVe'/><p>".$this->mail_service_title."</p></header>

          <content>
          <h1>".$this->mail_new_mail_text_1." ".$user_name."</h1>
          ".$this->mail_new_mail_text_2."<br/>
          ".$this->mail_new_mail_text_3."<br/>
          <br/>
          <br/>
          </content>
        ".$mail_footer."
      </wrapper></body></html>";


}elseif($use == 'new_payment'){


      $mail_subject = "=?utf-8?b?".base64_encode("".$this->mail_new_payment_subject."")."?=";

      $mail_content = "
      <html><head>".$mail_style."</head><body><wrapper>
          <header><img src='https://www.we-teve.com/images/icons/logo.png' alt='We-TeVe'/><p>".$this->mail_service_title."</p></header>

          <content>
          <h1>".$this->mail_new_payment_text_1." ".$user_name."</h1>
          ".$this->mail_new_payment_text_2."<br/>
          ".$this->mail_new_payment_text_3."<br/>
          <br/>
          <br/>
          </content>
        ".$mail_footer."
      </wrapper></body></html>";


}




    $this->sendmail($sendto,$mail_subject,$mail_content);
  }

}

$mt = new mail_temps;

?>
