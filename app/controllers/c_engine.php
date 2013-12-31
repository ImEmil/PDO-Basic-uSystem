<?php
/*

                                                   +-+-+-+-+-+-+
                                                   |I|m|E|m|i|l|
                                                   +-+-+-+-+-+-+
                                         
*/
  session_start();
  
  function clean($string) {
    return trim(strip_tags(htmlspecialchars($string, ENT_QUOTES, 'UTF-8')));
  }
  
  require('../config.php');
  require('../classes/class.config.php');
  require('../classes/class.usystem.php');
  require('../classes/class.session_handler.php');

  $session  = new Sessions();
  $s  = new U_SYSTEM($s);