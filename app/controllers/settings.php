<?php
  require("c_engine.php");

    if($session->loggedOut()) {
      $s->refresh("../../index.php", 0);
    }
    else {

      if($s->c_form("post_s")) {

        $email    = clean($_POST["email"]);
        $password = clean($_POST["password"]);

        if(empty($email) OR empty($password)) {

          $s->refresh("../../index.php?page=settings&error=1#_error", 0);

        }

        elseif($s->doExist($email, 'users', 'email') === true) {

          $s->refresh("../../index.php?page=settings&error=6", 0);

        }

        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {

          $s->refresh("../../index.php?page=settings&error=6", 0);
        
        }

        else {

          $s->updateSettings($_SESSION['username'], $email, $password);

          $s->refresh("../../index.php?page=settings&error=8#_error", 0);
        }
      }
    }