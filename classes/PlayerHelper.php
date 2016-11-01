<?php
  class PlayerHelper {
    private $db;
    private $app;
    public function __construct($db) { $this->db =  $db; $this->app = new APP();}
    public function getLevel($user_id){
      $stmt = $this->db->prepare("SELECT level FROM user_stats WHERE user_id = ?");
      $stmt->execute(array($user_id));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return $row['level'];
    }
    public function checkAnswer($answer,$ans,$id,$lvl){
      $answer = $this->app->_cleanString($answer);
      if ($ans == $answer){
        $stmt = $this->db->prepare("SELECT `user_id`, `level`, `attempts` FROM `gameplay` WHERE `user_id` = ? AND `level` = ?");
        $stmt->execute(array($id,$lvl));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) > 0){
          $stmt = $this->db->prepare("UPDATE `gameplay` SET `attempts` = ?, `clear_time` = now() WHERE `user_id` = ? AND `level` = ?");
          $stmt->execute(array(($rows[0]['attempts']+1),$id,$lvl));
        } else {
          $query = $this->db->prepare("INSERT INTO `gameplay` (`user_id`,`level`,`attempts`, `clear_time`) VALUES (?,?,'1',now() )");
          $query->execute(array($id,$lvl));
        }
        $query = $this->db->prepare("UPDATE `user_stats` SET `level` = ? WHERE `user_id` = ?");
        $query->execute(array($lvl+1,$id));
      }else{
        $stmt = $this->db->prepare("SELECT `user_id`, `level`, `attempts` FROM `gameplay` WHERE `user_id` = ? AND `level` = ?");
        $stmt->execute(array($id,$lvl));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) > 0){
          $stmt = $this->db->prepare("UPDATE `gameplay` SET `attempts` = ? WHERE `user_id` = ? AND `level` = ?");
          $stmt->execute(array(($rows[0]['attempts']+1),$id,$lvl));
        } else{
          $query = $this->db->prepare("INSERT INTO `gameplay` (`user_id`,`level`,`attempts`) VALUES (?,?,'1')");
          $query->execute(array($id,$lvl));
        }
      }
    }
  }
?>