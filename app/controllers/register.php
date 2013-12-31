<?php
  require("c_engine.php");

    if($session->loggedIn()) {
      $s->refresh("../../index.php?error=0", 0);
    }
    else {

      if($s->c_form("register_c")) {

        $username  = clean($_POST["username"]);

        $email     = clean($_POST["email"]);

        $password  = clean($_POST["password"]);
        
        $password2 = clean($_POST["password2"]);

        if(empty($username) OR empty($email) OR empty($password) OR empty($password2)) {

        $s->refresh("../../index.php?page=register&error=1", 0);

        }

        elseif($s->doExist($email, 'users', 'email') === true) {

          $s->refresh("../../index.php?page=register&error=6", 0);

        }

        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {

          $s->refresh("../../index.php?page=register&error=6", 0);
        
        }
        
        elseif($s->doExist($username, 'users', 'username') === true) {

          $s->refresh("../../index.php?page=register&error=6", 0);

        }

        elseif($password != $password2) {

          $s->refresh("../../index.php?page=register&error=2", 0);

        }

        else {

          $s->register($username, $password, $email);

          $s->refresh("../../index.php?error=5", 0);
        }
      }
    }