<?php
/*

                                                   +-+-+-+-+-+-+
                                                   |I|m|E|m|i|l|
                                                   +-+-+-+-+-+-+
                                         
*/
class U_SYSTEM {
  
  private $s;

  public function __construct($pdo) {
    $this->s = $pdo;
  }

  public function refresh($page, $seconds) {
    echo '<meta http-equiv="refresh" content="'.$seconds.';url='.$page.'">';
  }

  public function login($username, $password) {
    $date = time();
    $exc  = $this->s->prepare("SELECT `password`, `id` FROM `users` WHERE `username` = ?");
    $exc->execute( [$username] );
    
      $u_data           = $exc->fetch();
      $u_pass           = $u_data['password'];
      $id               = $u_data['id'];
      $updateLastLogin  = ("UPDATE users SET lastlogin = '{$date}' WHERE id = '{$id}'");

        if($u_pass === sha1($password)){
          $this->s->query($updateLastLogin);
          return $id;
        }
        else {
          return false; 
      }
  }
  
  public function register($username, $password, $email){
    $val = array( $username, sha1($password), $email, $_SERVER['REMOTE_ADDR'], time(), 1);
    $exc = $this->s->prepare("INSERT INTO `users` (`username`, `password`, `email`, `ip`, `joindate`, `rank`) VALUES (?, ?, ?, ?, ?, ?) ")->execute($val);
    return true;
  }

  public function updateUser($user, $email, $rank) {
    $val = array( $rank, $email, $user );
    $exc = $this->s->prepare("UPDATE `users` SET `rank`= ?, `email`= ? WHERE `username`= ?")->execute($val);
    return true;
  }

  public function updateSettings($username, $email, $password) {
    $val = array( sha1($password), $email, $username );
    $exc = $this->s->prepare("UPDATE `users` SET `password`= ?, `email`= ? WHERE `username`= ?")->execute($val);
    return true;
  }

  public function insertComment($username, $touser, $comment, $time, $ip) {
    $values = array( $username, $touser, $comment, $time, $ip );
    $exc = $this->s->prepare("INSERT INTO `comments` (`from`, `to`, `comment`, `time`, `ip`) VALUES (?, ?, ?, ?, ?)")->execute($values);
    return true;
  }
    
  public function displayComments($username) {
    $exc = $this->s->prepare("SELECT * FROM `comments` WHERE `to`= ? ORDER BY `time` DESC");
    $exc->execute( [$username] );
    return $exc->fetchAll();
  }

  public function displayMembers() {
    $exc = $this->s->prepare("SELECT * FROM `users` ORDER BY `joindate` DESC");
    $exc->execute();
    return $exc->fetchAll();
  }

  public function userData($username) {
    $exc = $this->s->prepare("SELECT * FROM `users` WHERE `username`= ?");
    $exc->execute( [$username] );
    return $exc->fetch(PDO::FETCH_OBJ);
  }

  public function doExist($find, $table, $column) {
    $exc = $this->s->prepare("SELECT COUNT(`id`) FROM `{$table}` WHERE `{$column}` = ?");
    $exc->execute( [$find] );

    if(intval($exc->fetchColumn()) === 0) {
      return false;
    }
    else {
      return true;
    }
  }

  public function rowCount($find, $table, $column) {
    $exc = $this->s->prepare("SELECT COUNT(`id`) FROM `{$table}` WHERE `{$column}` = ?");
    $exc->execute( [$find] );

    $count = $exc->fetchColumn();
    
    return $count;
  }
  public function rank($username) {
    $exc = $this->s->prepare("SELECT `rank` FROM `users` WHERE `username`= ?");
    $exc->execute( [$username] );

    $rank = $exc->fetch();
    $rank = $rank['rank'];

    switch ($rank) {
      case 1:
        $rank = "<span style=\"color:turquoise;\">Member</span>";
        break;
      case 2:
        $rank = "<span style=\"color:red;\">Admin</span>";
        break;
      default:
        $rank = "Blank";
      }
    return $rank;
  }

  public function error() {
    if(isset($_GET['error'])) {
      $get = intval($_GET['error']);

      switch ($get) {
        case 1:
        $error = "<div id=\"_error\" class=\"notification error-msg shadow\">Missing data</div>";
        break;
        case 2:
        $error = "<div id=\"_error\" class=\"notification error-msg shadow\">Incorrect data</div>";
        break;
        case 3:
        $error = "<div id=\"_error\" class=\"notification success-msg shadow\">You are now logged in</div>";
        break;
        case 4:
        $error = "<div id=\"_error\" class=\"notification success-msg shadow\">Your commment has been posted</div>";
        break;
        case 5:
        $error = "<div id=\"_error\" class=\"notification success-msg shadow\">You've created your account successfully! Please login now using the login form > </div>";
        break;
        case 6:
        $error = "<div id=\"_error\" class=\"notification error-msg shadow\">The data you entered already exists!</div>";
        break;
        case 7:
        $error = "<div id=\"_error\" class=\"notification success-msg shadow\">You are now logged out!</div>";
        break;
        case 8:
        $error = "<div id=\"_error\" class=\"notification success-msg shadow\">Saved!</div>";
        break;
        default:
        $error = "<div id=\"_error\" class=\"warning-msg shadow\">N/A<div>";
        break;
      }
      return $error;
    }
  }

  public function c_form($form) {
    return (isset($_POST["{$form}"]) ? true : false);                                                
  }

  public function __destruct() {
    $this->s = null;
  }
    
    
}