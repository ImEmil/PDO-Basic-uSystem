<?php
  header("Cache-control: private");
  require("c_engine.php");

    if($session->loggedIn()) {
      $s->refresh("../../index.php?error=0", 0);
    }
    else {

      if($s->c_form("login_c")) {

        $username = clean($_POST["username"]);
        $password = clean($_POST["password"]);

        if(empty($username) OR empty($password)) {

          $s->refresh("../../index.php?error=1", 0);

        }

        else {

          $login = $s->login($username, $password);

          if($login === false) {
            
            $s->refresh("../../index.php?error=2", 0);
          
          }
          
          else {

            session_regenerate_id(true);   

            $_SESSION["loggedin"] = true;

            $_SESSION["username"] = $username;

            $_SESSION["password"] = sha1($password);

            $s->refresh("../../index.php?error=3", 0);

      }
    }
  }
}