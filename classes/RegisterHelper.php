<?php
  class RegisterHelper{
    private $db;
    private $app;
    private $salt;
    public function __construct($db = null) { $this->db = $db; $this->app = new APP();}

    public function usernameExists($username){
      $username = $this->app->_cleanAlphaNumeric($username);
      if (!$username) return false;
      $query = $this->db->prepare("SELECT `id` FROM `cryptic_users` WHERE `username` =  ?");
      $query->execute(array($username));
      $rows = $query->fetchAll(PDO::FETCH_ASSOC);
      print_r($username);
      if (count($rows)) return true;
      return false;
    }
    private function generate_html($userid, $pass){
      //Mail Tempate
      //return '';

    }

    public function register($username, $password, $email, $name){
      $username = $this->app->_cleanAlphaNumeric($username);
      $password = $this->app->_cleanAlphaNumeric($password);
      $email = $this->app->_cleanEMAIL($email);
      $name = $this->app->_cleanString($name);
      if (!$username || !$password || !$email || !$name) return 0;
      $pwd = crypt($password,password_hash($password, PASSWORD_BCRYPT));
      try{
        $this->db->beginTransaction();
        $query = $this->db->prepare("
            INSERT INTO 
            `cryptic_users` (`username`, `email`, `password`, `name`) 
            VALUES 
            (?, ?, ?, ?)");
        $query->execute(array($username, $email,  $pwd,$name));
        $query = $this->db->prepare("SELECT `id` FROM `cryptic_users` WHERE `username` = ?");
        $query->execute(array($username));
        $id = $query->fetch(PDO::FETCH_ASSOC);
        $id = $id['id'];
        $query = $this->db->prepare("
          INSERT INTO 
            `cryptic_user_stats` (`user_id`) 
            VALUES 
            (?)");
        $query->execute(array($id));
        $query = $this->db->prepare("INSERT INTO `cryptic_gameplay` (`user_id`,`level`,`attempts`) VALUES (?,'0','0')");
        $query->execute(array($id));
        $header = "From:no-reply@*****.*** \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
        $mail = mail($email,"Login Details", self::generate_html($username, $password) , $header);
        $this->db->commit();
        return 1;
      }
      catch(PDOException $e){
        if ($e->errorInfo[1]== 1062)
          return 2;
        else
          SysLog::send($e,LOG_ERR);
      }
    }

    public function getList(){
      try{
        $query = $this->db->prepare("
            SELECT `id`, `username`, `email`, `name`,`status` FROM `cryptic_users`
            ");
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
      }
      catch(PDOException $e){
          SysLog::send($e,LOG_ERR);
      }
    }
  }
?>