<?php
  require("c_engine.php");

    if($session->loggedOut()) {
      $s->refresh("../../index.php", 0);
    }
    else {

      if($s->c_form("post_e")) {

        $user     = clean($_POST['user']);
        $email    = clean($_POST["email"]);
        $rank     = intval($_POST["rank"]);


        if($s->doExist($email, 'users', 'email') === true) {

          $s->refresh("../../index.php?page=edit_user&name={$user}&error=6", 0);

        }

        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {

          $s->refresh("../../index.php?page=edit_user&name={$user}&error=6", 0);
        
        }

        else {

          $s->updateUser($user, $email, $rank);

          $s->refresh("../../index.php?page=edit_user&name={$user}&error=8#_error", 0);
        }
      }
    }