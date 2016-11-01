<?php
  class UserHelper{
    private $db;
    private $app;
    public function __construct($db = null) { $this->db = $db; $this->app = new APP();}
    public function disqualify($id) {

      $id = $this->app->_cleanINT($id);
      try{
        $query = $this->db->prepare("
            UPDATE `users` SET `status` = 1 WHERE `id` = ?");
        $query->execute(array($id));
        SysLog::send($id.' is Disqualified',LOG_CRIT);
        return 1;
      }
       catch(PDOException $e){
        SysLog::send($e,LOG_ERR);
      }
    }
    public function requalify($id) {

      $id = $this->app->_cleanINT($id);
      try{
        $query = $this->db->prepare("
            UPDATE `users` SET `status` = 0 WHERE `id` = ?");
        $query->execute(array($id));
        SysLog::send($id.' is Reinstated',LOG_CRIT);
        return 1;
      }
       catch(PDOException $e){
        SysLog::send($e,LOG_ERR);
      }
    }
    public function resetPassword($id, $password){
      $id = $this->app->_cleanINT($id);
      $password = $this->app->_cleanAlphaNumeric($password);
      $pwd = crypt($password,password_hash($password, PASSWORD_BCRYPT));
      try{
        $query = $this->db->prepare("
            UPDATE `users` SET `password` = ? WHERE `id` = ?");
        $query->execute(array($pwd, $id));
        return 1;
      }
      catch(PDOException $e){
        SysLog::send($e,LOG_ERR);
      }
    }
  }