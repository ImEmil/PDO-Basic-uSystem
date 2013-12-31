<?php
  require("c_engine.php");

    if($session->loggedOut()) {
      $s->refresh("../../index.php", 0);
    }
    else {

      if($s->c_form("post_c")) {

        $touser   = clean($_POST["touser"]);
        $comment  = clean($_POST["comment"]);

        if(empty($touser) OR empty($comment)) {

          $s->refresh("../../index.php?page=profile&name={$touser}&error=1#_error", 0);

        }

        else {

          $s->insertComment($_SESSION['username'], $touser, $comment, time(), $_SERVER['REMOTE_ADDR']);

          $s->refresh("../../index.php?page=profile&name={$touser}&error=4#_error", 0);
        }
      }
    }