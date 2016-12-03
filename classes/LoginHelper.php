<?php
  class LoginHelper {
    private $db;
    private $app;
    public function __construct($db) { $this->db =  $db; $this->app = new APP();}
    public function login($username, $password){
      $username = $this->app->_cleanAlphaNumeric($username);
      $password = $this->app->_cleanAlphaNumeric($password);
       $query = $this->db->prepare("
            SELECT `id`, `username`, `password` FROM `cryptic_users` WHERE `username` = ?");
       $query->execute(array($username));
       $row = $query->fetch(PDO::FETCH_ASSOC);
       if ($row['password']){
         if(hash_equals($row['password'], crypt($password, $row['password']))){
            $ip = $this->app->_getIP();
            $q = $this->db->prepare("
              SELECT * FROM `cryptic_login_log` WHERE `user_id` = ? AND `ip` = ?;");
            $q->execute(array($row['id'], $ip));
            $r = $q -> fetchAll(PDO::FETCH_ASSOC);
            if (count($r) > 0){
              if ($r[0]['status']){
                $stmt = $this->db->prepare("
                    UPDATE `cryptic_login_log` SET `status` = '0', `count` = ? WHERE `cryptic_login_log`.`id` = ?;
                  ");
                $stmt->execute(array($r[0]['count']+1,$r[0]['id']));
              }
              $_SESSION['logged_in'] = true;
            }else{
              $st = $this->db->prepare("
                INSERT INTO `cryptic_login_log` (`user_id`,`ip`) VALUES (?,?)");
              $st->execute(array($row['id'],$ip));
              $_SESSION['logged_in'] = true;
            }
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            return 1;
         }
       }
    }
    public function logout($userid){
       $ip = $this->app->_getIP();
       $q = $this->db->prepare("
              SELECT * FROM `cryptic_login_log` WHERE `user_id` = ? AND `ip` = ?;");
       $q->execute(array($userid, $ip));
       $r = $q -> fetchAll(PDO::FETCH_ASSOC);
       if (count($r) > 0){
            $stmt = $this->db->prepare("
                      UPDATE `cryptic_login_log` SET `status` = '1'WHERE `cryptic_login_log`.`id` = ?;
                  ");
            $stmt->execute(array($r[0]['id']));
       }
    }
    public function isLoggedIn(){
      if(isset($_SESSION['logged_in'])) return true;
      if ( isset( $_COOKIE['ip'] ) && isset( $_COOKIE['user'] ) ) {
        $ip = $_COOKIE['ip'];
        $user_id = $_COOKIE['user'];
        $q = $this->db->prepare("SELECT `status` FROM `cryptic_login_log` WHERE `user_id` = ? AND `ip` = ? AND `status` = 1");
        $q->exec(array($user_id, $ip));
        if (count($q) > 0)
          return true;
      }
      return false;
    }
    public function isActive($userid){
       $q = $this->db->prepare("
              SELECT `status` FROM `cryptic_users` WHERE `id` = ?");
       $q->execute(array($userid));
       $r = $q -> fetchAll(PDO::FETCH_ASSOC);
       if (count($r) > 0){
          if($r[0]['status']){
            return false;
          }else{
            return true;
          }
       }
    }
  }

?>