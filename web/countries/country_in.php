<?php
class country extends mail{
	//'extends mail' fügt die andere Class hinzu


  public function draw_land($land,$label){

    if($label == 1){

      if($land == "id"){ $land_echo = "<div class='land_icon_id land_icon'> </div>   <div class='land_label'>".$this->land_label_id."</div>";}
      if($land == "is"){ $land_echo = "<div class='land_icon_is land_icon'> </div>   <div class='land_label'>".$this->land_label_is."</div>";}
      if($land == "il"){ $land_echo = "<div class='land_icon_il land_icon'> </div>   <div class='land_label'>".$this->land_label_il."</div>";}
      if($land == "it"){ $land_echo = "<div class='land_icon_it land_icon'> </div>   <div class='land_label'>".$this->land_label_it."</div>";}
      if($land == "eg"){ $land_echo = "<div class='land_icon_eg land_icon'> </div>   <div class='land_label'>".$this->land_label_eg."</div>";}
      if($land == "dz"){ $land_echo = "<div class='land_icon_dz land_icon'> </div>   <div class='land_label'>".$this->land_label_dz."</div>";}
      if($land == "ar"){ $land_echo = "<div class='land_icon_ar land_icon'> </div>   <div class='land_label'>".$this->land_label_ar."</div>";}
      if($land == "az"){ $land_echo = "<div class='land_icon_az land_icon'> </div>   <div class='land_label'>".$this->land_label_az."</div>";}
      if($land == "au"){ $land_echo = "<div class='land_icon_au land_icon'> </div>   <div class='land_label'>".$this->land_label_au."</div>";}
      if($land == "bh"){ $land_echo = "<div class='land_icon_bh land_icon'> </div>   <div class='land_label'>".$this->land_label_bh."</div>";}
      if($land == "be"){ $land_echo = "<div class='land_icon_be land_icon'> </div>   <div class='land_label'>".$this->land_label_be."</div>";}
      if($land == "ba"){ $land_echo = "<div class='land_icon_ba land_icon'> </div>   <div class='land_label'>".$this->land_label_ba."</div>";}
      if($land == "br"){ $land_echo = "<div class='land_icon_br land_icon'> </div>   <div class='land_label'>".$this->land_label_br."</div>";}
      if($land == "bg"){ $land_echo = "<div class='land_icon_bg land_icon'> </div>   <div class='land_label'>".$this->land_label_bg."</div>";}
      if($land == "cl"){ $land_echo = "<div class='land_icon_cl land_icon'> </div>   <div class='land_label'>".$this->land_label_cl."</div>";}
      if($land == "dk"){ $land_echo = "<div class='land_icon_dk land_icon'> </div>   <div class='land_label'>".$this->land_label_dk."</div>";}
      if($land == "de"){ $land_echo = "<div class='land_icon_de land_icon'> </div>   <div class='land_label'>".$this->land_label_de."</div>";}
      if($land == "ee"){ $land_echo = "<div class='land_icon_ee land_icon'> </div>   <div class='land_label'>".$this->land_label_ee."</div>";}
      if($land == "fi"){ $land_echo = "<div class='land_icon_fi land_icon'> </div>   <div class='land_label'>".$this->land_label_fi."</div>";}
      if($land == "fr"){ $land_echo = "<div class='land_icon_fr land_icon'> </div>   <div class='land_label'>".$this->land_label_fr."</div>";}
      if($land == "ge"){ $land_echo = "<div class='land_icon_ge land_icon'> </div>   <div class='land_label'>".$this->land_label_ge."</div>";}
      if($land == "gh"){ $land_echo = "<div class='land_icon_gh land_icon'> </div>   <div class='land_label'>".$this->land_label_gh."</div>";}
      if($land == "gr"){ $land_echo = "<div class='land_icon_gr land_icon'> </div>   <div class='land_label'>".$this->land_label_gr."</div>";}
      if($land == "hk"){ $land_echo = "<div class='land_icon_hk land_icon'> </div>   <div class='land_label'>".$this->land_label_hk."</div>";}
      if($land == "in"){ $land_echo = "<div class='land_icon_in land_icon'> </div>   <div class='land_label'>".$this->land_label_in."</div>";}
      if($land == "iq"){ $land_echo = "<div class='land_icon_iq land_icon'> </div>   <div class='land_label'>".$this->land_label_iq."</div>";}
      if($land == "ie"){ $land_echo = "<div class='land_icon_ie land_icon'> </div>   <div class='land_label'>".$this->land_label_ie."</div>";}
      if($land == "jm"){ $land_echo = "<div class='land_icon_jm land_icon'> </div>   <div class='land_label'>".$this->land_label_it."</div>";}
      if($land == "jp"){ $land_echo = "<div class='land_icon_jp land_icon'> </div>   <div class='land_label'>".$this->land_label_jp."</div>";}
      if($land == "ye"){ $land_echo = "<div class='land_icon_ye land_icon'> </div>   <div class='land_label'>".$this->land_label_ye."</div>";}
      if($land == "jo"){ $land_echo = "<div class='land_icon_jo land_icon'> </div>   <div class='land_label'>".$this->land_label_jo."</div>";}
      if($land == "ca"){ $land_echo = "<div class='land_icon_ca land_icon'> </div>   <div class='land_label'>".$this->land_label_ca."</div>";}
      if($land == "kz"){ $land_echo = "<div class='land_icon_kz land_icon'> </div>   <div class='land_label'>".$this->land_label_kz."</div>";}
      if($land == "qa"){ $land_echo = "<div class='land_icon_qa land_icon'> </div>   <div class='land_label'>".$this->land_label_qa."</div>";}
      if($land == "ke"){ $land_echo = "<div class='land_icon_ke land_icon'> </div>   <div class='land_label'>".$this->land_label_ke."</div>";}
      if($land == "co"){ $land_echo = "<div class='land_icon_co land_icon'> </div>   <div class='land_label'>".$this->land_label_co."</div>";}
      if($land == "hr"){ $land_echo = "<div class='land_icon_hr land_icon'> </div>   <div class='land_label'>".$this->land_label_hr."</div>";}
      if($land == "kw"){ $land_echo = "<div class='land_icon_kw land_icon'> </div>   <div class='land_label'>".$this->land_label_kw."</div>";}
      if($land == "lv"){ $land_echo = "<div class='land_icon_lv land_icon'> </div>   <div class='land_label'>".$this->land_label_lv."</div>";}
      if($land == "lb"){ $land_echo = "<div class='land_icon_lb land_icon'> </div>   <div class='land_label'>".$this->land_label_lb."</div>";}
      if($land == "li"){ $land_echo = "<div class='land_icon_li land_icon'> </div>   <div class='land_label'>".$this->land_label_li."</div>";}
      if($land == "lt"){ $land_echo = "<div class='land_icon_lt land_icon'> </div>   <div class='land_label'>".$this->land_label_lt."</div>";}
      if($land == "lu"){ $land_echo = "<div class='land_icon_lu land_icon'> </div>   <div class='land_label'>".$this->land_label_lu."</div>";}
      if($land == "mk"){ $land_echo = "<div class='land_icon_mk land_icon'> </div>   <div class='land_label'>".$this->land_label_mk."</div>";}
      if($land == "my"){ $land_echo = "<div class='land_icon_my land_icon'> </div>   <div class='land_label'>".$this->land_label_my."</div>";}
      if($land == "ma"){ $land_echo = "<div class='land_icon_ma land_icon'> </div>   <div class='land_label'>".$this->land_label_ma."</div>";}
      if($land == "mx"){ $land_echo = "<div class='land_icon_mx land_icon'> </div>   <div class='land_label'>".$this->land_label_mx."</div>";}
      if($land == "me"){ $land_echo = "<div class='land_icon_me land_icon'> </div>   <div class='land_label'>".$this->land_label_me."</div>";}
      if($land == "np"){ $land_echo = "<div class='land_icon_np land_icon'> </div>   <div class='land_label'>".$this->land_label_np."</div>";}
      if($land == "nz"){ $land_echo = "<div class='land_icon_nz land_icon'> </div>   <div class='land_label'>".$this->land_label_nz."</div>";}
      if($land == "nl"){ $land_echo = "<div class='land_icon_nl land_icon'> </div>   <div class='land_label'>".$this->land_label_nl."</div>";}
      if($land == "ng"){ $land_echo = "<div class='land_icon_ng land_icon'> </div>   <div class='land_label'>".$this->land_label_ng."</div>";}
      if($land == "no"){ $land_echo = "<div class='land_icon_no land_icon'> </div>   <div class='land_label'>".$this->land_label_no."</div>";}
      if($land == "om"){ $land_echo = "<div class='land_icon_om land_icon'> </div>   <div class='land_label'>".$this->land_label_om."</div>";}
      if($land == "at"){ $land_echo = "<div class='land_icon_at land_icon'> </div>   <div class='land_label'>".$this->land_label_at."</div>";}
      if($land == "pw"){ $land_echo = "<div class='land_icon_pw land_icon'> </div>   <div class='land_label'>".$this->land_label_pw."</div>";}
      if($land == "pk"){ $land_echo = "<div class='land_icon_pk land_icon'> </div>   <div class='land_label'>".$this->land_label_pk."</div>";}
      if($land == "pe"){ $land_echo = "<div class='land_icon_pe land_icon'> </div>   <div class='land_label'>".$this->land_label_pe."</div>";}
      if($land == "ph"){ $land_echo = "<div class='land_icon_ph land_icon'> </div>   <div class='land_label'>".$this->land_label_ph."</div>";}
      if($land == "pl"){ $land_echo = "<div class='land_icon_pl land_icon'> </div>   <div class='land_label'>".$this->land_label_pl."</div>";}
      if($land == "pt"){ $land_echo = "<div class='land_icon_pt land_icon'> </div>   <div class='land_label'>".$this->land_label_pt."</div>";}
      if($land == "pr"){ $land_echo = "<div class='land_icon_pr land_icon'> </div>   <div class='land_label'>".$this->land_label_pr."</div>";}
      if($land == "ro"){ $land_echo = "<div class='land_icon_ro land_icon'> </div>   <div class='land_label'>".$this->land_label_ro."</div>";}
      if($land == "ru"){ $land_echo = "<div class='land_icon_ru land_icon'> </div>   <div class='land_label'>".$this->land_label_ru."</div>";}
      if($land == "sa"){ $land_echo = "<div class='land_icon_sa land_icon'> </div>   <div class='land_label'>".$this->land_label_sa."</div>";}
      if($land == "se"){ $land_echo = "<div class='land_icon_se land_icon'> </div>   <div class='land_label'>".$this->land_label_se."</div>";}
      if($land == "ch"){ $land_echo = "<div class='land_icon_ch land_icon'> </div>   <div class='land_label'>".$this->land_label_ch."</div>";}
      if($land == "sn"){ $land_echo = "<div class='land_icon_sn land_icon'> </div>   <div class='land_label'>".$this->land_label_sn."</div>";}
      if($land == "rs"){ $land_echo = "<div class='land_icon_rs land_icon'> </div>   <div class='land_label'>".$this->land_label_rs."</div>";}
      if($land == "zw"){ $land_echo = "<div class='land_icon_zw land_icon'> </div>   <div class='land_label'>".$this->land_label_zw."</div>";}
      if($land == "sg"){ $land_echo = "<div class='land_icon_sg land_icon'> </div>   <div class='land_label'>".$this->land_label_sg."</div>";}
      if($land == "sk"){ $land_echo = "<div class='land_icon_sk land_icon'> </div>   <div class='land_label'>".$this->land_label_sk."</div>";}
      if($land == "si"){ $land_echo = "<div class='land_icon_si land_icon'> </div>   <div class='land_label'>".$this->land_label_si."</div>";}
      if($land == "es"){ $land_echo = "<div class='land_icon_es land_icon'> </div>   <div class='land_label'>".$this->land_label_es."</div>";}
      if($land == "lk"){ $land_echo = "<div class='land_icon_lk land_icon'> </div>   <div class='land_label'>".$this->land_label_lk."</div>";}
      if($land == "za"){ $land_echo = "<div class='land_icon_za land_icon'> </div>   <div class='land_label'>".$this->land_label_za."</div>";}
      if($land == "kr"){ $land_echo = "<div class='land_icon_kr land_icon'> </div>   <div class='land_label'>".$this->land_label_kr."</div>";}
      if($land == "tw"){ $land_echo = "<div class='land_icon_tw land_icon'> </div>   <div class='land_label'>".$this->land_label_tw."</div>";}
      if($land == "tz"){ $land_echo = "<div class='land_icon_tz land_icon'> </div>   <div class='land_label'>".$this->land_label_tz."</div>";}
      if($land == "th"){ $land_echo = "<div class='land_icon_th land_icon'> </div>   <div class='land_label'>".$this->land_label_th."</div>";}
      if($land == "cz"){ $land_echo = "<div class='land_icon_cz land_icon'> </div>   <div class='land_label'>".$this->land_label_cz."</div>";}
      if($land == "tn"){ $land_echo = "<div class='land_icon_tn land_icon'> </div>   <div class='land_label'>".$this->land_label_tn."</div>";}
      if($land == "tr"){ $land_echo = "<div class='land_icon_tr land_icon'> </div>   <div class='land_label'>".$this->land_label_tr."</div>";}
      if($land == "ug"){ $land_echo = "<div class='land_icon_ug land_icon'> </div>   <div class='land_label'>".$this->land_label_ug."</div>";}
      if($land == "ua"){ $land_echo = "<div class='land_icon_ua land_icon'> </div>   <div class='land_label'>".$this->land_label_ua."</div>";}
      if($land == "hu"){ $land_echo = "<div class='land_icon_hu land_icon'> </div>   <div class='land_label'>".$this->land_label_hu."</div>";}
      if($land == "us"){ $land_echo = "<div class='land_icon_us land_icon'> </div>   <div class='land_label'>".$this->land_label_us."</div>";}
      if($land == "ae"){ $land_echo = "<div class='land_icon_ae land_icon'> </div>   <div class='land_label'>".$this->land_label_ae."</div>";}
      if($land == "gb"){ $land_echo = "<div class='land_icon_gb land_icon'> </div>   <div class='land_label'>".$this->land_label_gb."</div>";}
      if($land == "vn"){ $land_echo = "<div class='land_icon_vn land_icon'> </div>   <div class='land_label'>".$this->land_label_vn."</div>";}
      if($land == "by"){ $land_echo = "<div class='land_icon_by land_icon'> </div>   <div class='land_label'>".$this->land_label_by."</div>";}

    }elseif($label == 0){

      if($land == "eg"){ $land_echo = "<div title='".$this->land_label_eg."' class='land_icon_eg land_icon'> </div>";}
      if($land == "dz"){ $land_echo = "<div title='".$this->land_label_dz."' class='land_icon_dz land_icon'> </div>";}
      if($land == "ar"){ $land_echo = "<div title='".$this->land_label_ar."' class='land_icon_ar land_icon'> </div>";}
      if($land == "az"){ $land_echo = "<div title='".$this->land_label_az."' class='land_icon_az land_icon'> </div>";}
      if($land == "au"){ $land_echo = "<div title='".$this->land_label_au."' class='land_icon_au land_icon'> </div>";}
      if($land == "bh"){ $land_echo = "<div title='".$this->land_label_bh."' class='land_icon_bh land_icon'> </div>";}
      if($land == "be"){ $land_echo = "<div title='".$this->land_label_be."' class='land_icon_be land_icon'> </div>";}
      if($land == "ba"){ $land_echo = "<div title='".$this->land_label_ba."' class='land_icon_ba land_icon'> </div>";}
      if($land == "br"){ $land_echo = "<div title='".$this->land_label_br."' class='land_icon_br land_icon'> </div>";}
      if($land == "bg"){ $land_echo = "<div title='".$this->land_label_bg."' class='land_icon_bg land_icon'> </div>";}
      if($land == "cl"){ $land_echo = "<div title='".$this->land_label_cl."' class='land_icon_cl land_icon'> </div>";}
      if($land == "dk"){ $land_echo = "<div title='".$this->land_label_dk."' class='land_icon_dk land_icon'> </div>";}
      if($land == "de"){ $land_echo = "<div title='".$this->land_label_de."' class='land_icon_de land_icon'> </div>";}
      if($land == "ee"){ $land_echo = "<div title='".$this->land_label_ee."' class='land_icon_ee land_icon'> </div>";}
      if($land == "fi"){ $land_echo = "<div title='".$this->land_label_fi."' class='land_icon_fi land_icon'> </div>";}
      if($land == "fr"){ $land_echo = "<div title='".$this->land_label_fr."' class='land_icon_fr land_icon'> </div>";}
      if($land == "ge"){ $land_echo = "<div title='".$this->land_label_ge."' class='land_icon_ge land_icon'> </div>";}
      if($land == "gh"){ $land_echo = "<div title='".$this->land_label_gh."' class='land_icon_gh land_icon'> </div>";}
      if($land == "gr"){ $land_echo = "<div title='".$this->land_label_gr."' class='land_icon_gr land_icon'> </div>";}
      if($land == "hk"){ $land_echo = "<div title='".$this->land_label_hk."' class='land_icon_hk land_icon'> </div>";}
      if($land == "in"){ $land_echo = "<div title='".$this->land_label_in."' class='land_icon_in land_icon'> </div>";}
      if($land == "id"){ $land_echo = "<div title='".$this->land_label_id."' class='land_icon_id land_icon'> </div>";}
      if($land == "iq"){ $land_echo = "<div title='".$this->land_label_iq."' class='land_icon_iq land_icon'> </div>";}
      if($land == "ie"){ $land_echo = "<div title='".$this->land_label_ie."' class='land_icon_ie land_icon'> </div>";}
      if($land == "is"){ $land_echo = "<div title='".$this->land_label_is."' class='land_icon_is land_icon'> </div>";}
      if($land == "il"){ $land_echo = "<div title='".$this->land_label_il."' class='land_icon_il land_icon'> </div>";}
      if($land == "it"){ $land_echo = "<div title='".$this->land_label_it."' class='land_icon_it land_icon'> </div>";}
      if($land == "jm"){ $land_echo = "<div title='".$this->land_label_jm."' class='land_icon_jm land_icon'> </div>";}
      if($land == "jp"){ $land_echo = "<div title='".$this->land_label_jp."' class='land_icon_jp land_icon'> </div>";}
      if($land == "ye"){ $land_echo = "<div title='".$this->land_label_ye."' class='land_icon_ye land_icon'> </div>";}
      if($land == "jo"){ $land_echo = "<div title='".$this->land_label_jo."' class='land_icon_jo land_icon'> </div>";}
      if($land == "ca"){ $land_echo = "<div title='".$this->land_label_ca."' class='land_icon_ca land_icon'> </div>";}
      if($land == "kz"){ $land_echo = "<div title='".$this->land_label_kz."' class='land_icon_kz land_icon'> </div>";}
      if($land == "qa"){ $land_echo = "<div title='".$this->land_label_qa."' class='land_icon_qa land_icon'> </div>";}
      if($land == "ke"){ $land_echo = "<div title='".$this->land_label_ke."' class='land_icon_ke land_icon'> </div>";}
      if($land == "co"){ $land_echo = "<div title='".$this->land_label_co."' class='land_icon_co land_icon'> </div>";}
      if($land == "hr"){ $land_echo = "<div title='".$this->land_label_hr."' class='land_icon_hr land_icon'> </div>";}
      if($land == "kw"){ $land_echo = "<div title='".$this->land_label_kw."' class='land_icon_kw land_icon'> </div>";}
      if($land == "lv"){ $land_echo = "<div title='".$this->land_label_lv."' class='land_icon_lv land_icon'> </div>";}
      if($land == "lb"){ $land_echo = "<div title='".$this->land_label_lb."' class='land_icon_lb land_icon'> </div>";}
      if($land == "li"){ $land_echo = "<div title='".$this->land_label_li."' class='land_icon_li land_icon'> </div>";}
      if($land == "lt"){ $land_echo = "<div title='".$this->land_label_lt."' class='land_icon_lt land_icon'> </div>";}
      if($land == "lu"){ $land_echo = "<div title='".$this->land_label_lu."' class='land_icon_lu land_icon'> </div>";}
      if($land == "mk"){ $land_echo = "<div title='".$this->land_label_mk."' class='land_icon_mk land_icon'> </div>";}
      if($land == "my"){ $land_echo = "<div title='".$this->land_label_my."' class='land_icon_my land_icon'> </div>";}
      if($land == "ma"){ $land_echo = "<div title='".$this->land_label_ma."' class='land_icon_ma land_icon'> </div>";}
      if($land == "mx"){ $land_echo = "<div title='".$this->land_label_mx."' class='land_icon_mx land_icon'> </div>";}
      if($land == "me"){ $land_echo = "<div title='".$this->land_label_me."' class='land_icon_me land_icon'> </div>";}
      if($land == "np"){ $land_echo = "<div title='".$this->land_label_np."' class='land_icon_np land_icon'> </div>";}
      if($land == "nz"){ $land_echo = "<div title='".$this->land_label_nz."' class='land_icon_nz land_icon'> </div>";}
      if($land == "nl"){ $land_echo = "<div title='".$this->land_label_nl."' class='land_icon_nl land_icon'> </div>";}
      if($land == "ng"){ $land_echo = "<div title='".$this->land_label_ng."' class='land_icon_ng land_icon'> </div>";}
      if($land == "no"){ $land_echo = "<div title='".$this->land_label_no."' class='land_icon_no land_icon'> </div>";}
      if($land == "om"){ $land_echo = "<div title='".$this->land_label_om."' class='land_icon_om land_icon'> </div>";}
      if($land == "at"){ $land_echo = "<div title='".$this->land_label_at."' class='land_icon_at land_icon'> </div>";}
      if($land == "pw"){ $land_echo = "<div title='".$this->land_label_pw."' class='land_icon_pw land_icon'> </div>";}
      if($land == "pk"){ $land_echo = "<div title='".$this->land_label_pk."' class='land_icon_pk land_icon'> </div>";}
      if($land == "pe"){ $land_echo = "<div title='".$this->land_label_pe."' class='land_icon_pe land_icon'> </div>";}
      if($land == "ph"){ $land_echo = "<div title='".$this->land_label_ph."' class='land_icon_ph land_icon'> </div>";}
      if($land == "pl"){ $land_echo = "<div title='".$this->land_label_pl."' class='land_icon_pl land_icon'> </div>";}
      if($land == "pt"){ $land_echo = "<div title='".$this->land_label_pt."' class='land_icon_pt land_icon'> </div>";}
      if($land == "pr"){ $land_echo = "<div title='".$this->land_label_pr."' class='land_icon_pr land_icon'> </div>";}
      if($land == "ro"){ $land_echo = "<div title='".$this->land_label_ro."' class='land_icon_ro land_icon'> </div>";}
      if($land == "ru"){ $land_echo = "<div title='".$this->land_label_ru."' class='land_icon_ru land_icon'> </div>";}
      if($land == "sa"){ $land_echo = "<div title='".$this->land_label_sa."' class='land_icon_sa land_icon'> </div>";}
      if($land == "se"){ $land_echo = "<div title='".$this->land_label_se."' class='land_icon_se land_icon'> </div>";}
      if($land == "ch"){ $land_echo = "<div title='".$this->land_label_ch."' class='land_icon_ch land_icon'> </div>";}
      if($land == "sn"){ $land_echo = "<div title='".$this->land_label_sn."' class='land_icon_sn land_icon'> </div>";}
      if($land == "rs"){ $land_echo = "<div title='".$this->land_label_rs."' class='land_icon_rs land_icon'> </div>";}
      if($land == "zw"){ $land_echo = "<div title='".$this->land_label_zw."' class='land_icon_zw land_icon'> </div>";}
      if($land == "sg"){ $land_echo = "<div title='".$this->land_label_sg."' class='land_icon_sg land_icon'> </div>";}
      if($land == "sk"){ $land_echo = "<div title='".$this->land_label_sk."' class='land_icon_sk land_icon'> </div>";}
      if($land == "si"){ $land_echo = "<div title='".$this->land_label_si."' class='land_icon_si land_icon'> </div>";}
      if($land == "es"){ $land_echo = "<div title='".$this->land_label_es."' class='land_icon_es land_icon'> </div>";}
      if($land == "lk"){ $land_echo = "<div title='".$this->land_label_lk."' class='land_icon_lk land_icon'> </div>";}
      if($land == "za"){ $land_echo = "<div title='".$this->land_label_za."' class='land_icon_za land_icon'> </div>";}
      if($land == "kr"){ $land_echo = "<div title='".$this->land_label_kr."' class='land_icon_kr land_icon'> </div>";}
      if($land == "tw"){ $land_echo = "<div title='".$this->land_label_tw."' class='land_icon_tw land_icon'> </div>";}
      if($land == "tz"){ $land_echo = "<div title='".$this->land_label_tz."' class='land_icon_tz land_icon'> </div>";}
      if($land == "th"){ $land_echo = "<div title='".$this->land_label_th."' class='land_icon_th land_icon'> </div>";}
      if($land == "cz"){ $land_echo = "<div title='".$this->land_label_cz."' class='land_icon_cz land_icon'> </div>";}
      if($land == "tn"){ $land_echo = "<div title='".$this->land_label_tn."' class='land_icon_tn land_icon'> </div>";}
      if($land == "tr"){ $land_echo = "<div title='".$this->land_label_tr."' class='land_icon_tr land_icon'> </div>";}
      if($land == "ug"){ $land_echo = "<div title='".$this->land_label_ug."' class='land_icon_ug land_icon'> </div>";}
      if($land == "ua"){ $land_echo = "<div title='".$this->land_label_ua."' class='land_icon_ua land_icon'> </div>";}
      if($land == "hu"){ $land_echo = "<div title='".$this->land_label_hu."' class='land_icon_hu land_icon'> </div>";}
      if($land == "us"){ $land_echo = "<div title='".$this->land_label_us."' class='land_icon_us land_icon'> </div>";}
      if($land == "ae"){ $land_echo = "<div title='".$this->land_label_ae."' class='land_icon_ae land_icon'> </div>";}
      if($land == "gb"){ $land_echo = "<div title='".$this->land_label_gb."' class='land_icon_gb land_icon'> </div>";}
      if($land == "vn"){ $land_echo = "<div title='".$this->land_label_vn."' class='land_icon_vn land_icon'> </div>";}
      if($land == "by"){ $land_echo = "<div title='".$this->land_label_by."' class='land_icon_by land_icon'> </div>";}

    }
    return $land_echo;
  }




  public function draw_lang($lang,$label){

    if($label == 1){

      if($lang == "de"){ $lang_echo = "<div class='land_icon_de land_icon'> </div>   <div class='land_label'>".$this->lang_label_de."</div>";}
      if($lang == "en"){ $lang_echo = "<div class='land_icon_gb land_icon'> </div>   <div class='land_label'>".$this->lang_label_en."</div>";}
      if($lang == "fr"){ $lang_echo = "<div class='land_icon_fr land_icon'> </div>   <div class='land_label'>".$this->lang_label_fr."</div>";}

    }elseif($label == 0){

      if($lang == "de"){ $lang_echo = "<div title='".$this->lang_label_de."' class='land_icon_de land_icon'> </div>";}
      if($lang == "en"){ $lang_echo = "<div title='".$this->lang_label_en."' class='land_icon_gb land_icon'> </div>";}
      if($lang == "fr"){ $lang_echo = "<div title='".$this->lang_label_fr."' class='land_icon_fr land_icon'> </div>";}

    }

    return $lang_echo;
  }




}//end class


$c = new country;
?>
