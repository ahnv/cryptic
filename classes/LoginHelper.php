<?php
  class LoginHelper {
    private $db;
    private $app;
    public function __construct($db) { $this->db =  $db; $this->app = new APP();}
    public function login($username, $password){
      $username = $this->app->_cleanAlphaNumeric($username);
      $password = $this->app->_cleanAlphaNumeric($password);
       $query = $this->db->prepare("
            SELECT `id`, `username`, `password` FROM `users` WHERE `username` = ?");
       $query->execute(array($username));
       $row = $query->fetch(PDO::FETCH_ASSOC);
       if(hash_equals($row['password'], crypt($password, $row['password']))){
          $ip = $this->app->_getIP();
          $q = $this->db->prepare("
            SELECT `status` FROM `login_log` WHERE `user_id` = ? AND `ip` = ?;");
          $row = $q->execute(array($row['id'], $ip));
          if (count($row) > 0){
            print_r($row);
          }
          return 1;
       }
    }
    public function isLoggedIn(){
      if(isset($_SESSION['logged_in'])) return true;
      if ( isset( $_COOKIE['ip'] ) && isset( $_COOKIE['user'] ) ) {
        $ip = $_COOKIE['ip'];
        $user_id = $_COOKIE['user'];
        $q = $this->db->prepare("SELECT `status` FROM `login_log` WHERE `user_id` = ? AND `ip` = ? AND `status` = 1");
        $q->exec(array($user_id, $ip));
        if (count($q) > 0)
          return true;
      }
      return false;
    }
  }

?>