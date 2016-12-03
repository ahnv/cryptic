<?php
  class PlayerHelper {
    private $db;
    private $app;
    public function __construct($db) { $this->db =  $db; $this->app = new APP();}
    public function getLevel($user_id){
      $stmt = $this->db->prepare("SELECT level FROM cryptic_user_stats WHERE user_id = ?");
      $stmt->execute(array($user_id));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return $row['level'];
    }
    public function checkAnswerLevelZero($answer,$id){
      $stmt  = $this->db->prepare("SELECT `password` FROM `cryptic_users` WHERE `id` = ?");
      $stmt->execute(array($id));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($row['password']){
        if(hash_equals($row['password'], crypt($answer, $row['password']))){
          return true;
        }else{
          return false;
        }
      }
    }
    public function checkAnswer($answer,$ans,$id,$lvl){
      $answer = $this->app->_cleanString($answer);
      $answerStatus = false;
      if ($lvl == 0){
        $answerStatus = $this->checkAnswerLevelZero($answer,$id);
      }elseif($ans == $answer){
        $answerStatus = true;
      }
      if ($answerStatus){
        $stmt = $this->db->prepare("SELECT `user_id`, `level`, `attempts` FROM `cryptic_gameplay` WHERE `user_id` = ? AND `level` = ?");
        $stmt->execute(array($id,$lvl));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) > 0){
          $stmt = $this->db->prepare("UPDATE `cryptic_gameplay` SET `attempts` = ?, `clear_time` = now() WHERE `user_id` = ? AND `level` = ?");
          $stmt->execute(array(($rows[0]['attempts']+1),$id,$lvl));
        } else {
          $query = $this->db->prepare("INSERT INTO `cryptic_gameplay` (`user_id`,`level`,`attempts`, `clear_time`) VALUES (?,?,'1',now() )");
          $query->execute(array($id,$lvl));
        }
        $query = $this->db->prepare("UPDATE `cryptic_user_stats` SET `level` = ? WHERE `user_id` = ?");
        $query->execute(array($lvl+1,$id));
        $query = $this->db->prepare("SELECT `attempts` FROM `cryptic_gameplay` WHERE `level` = ? AND `user_id` = ?");
        $query->execute(array($lvl,$id));
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $query = $this->db->prepare("SELECT `username` FROM `cryptic_users` WHERE `id` = ?");
        $query->execute(array($id));
        $name = $query->fetch(PDO::FETCH_ASSOC);
        SysLog::send($name['username'].' cleared level : '.$lvl.'. Attempts :'.$row['attempts'].' IP : '.$this->app->_getIP(),LOG_WARNING);
        return 1;
      }else{
        $stmt = $this->db->prepare("SELECT `user_id`, `level`, `attempts` FROM `cryptic_gameplay` WHERE `user_id` = ? AND `level` = ?");
        $stmt->execute(array($id,$lvl));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) > 0){
          $stmt = $this->db->prepare("UPDATE `cryptic_gameplay` SET `attempts` = ? WHERE `user_id` = ? AND `level` = ?");
          $stmt->execute(array(($rows[0]['attempts']+1),$id,$lvl));
        } else{
          $query = $this->db->prepare("INSERT INTO `cryptic_gameplay` (`user_id`,`level`,`attempts`) VALUES (?,?,'1')");
          $query->execute(array($id,$lvl));
        }
        return 0;
      }
    }
  }
?>