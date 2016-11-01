<?php
  class LeaderBoardHelper {
    private $db;
    private $app;
    public function __construct($db) { $this->db =  $db; $this->app = new APP();}
    public function get(){
      $stmt = $this->db->prepare("SELECT user_stats.level, gameplay.clear_time, gameplay.user_id, users.name FROM gameplay, user_stats, users WHERE user_stats.user_id = gameplay.user_id AND gameplay.level = (user_stats.level -1) AND users.id = user_stats.user_id ORDER BY gameplay.level DESC , gameplay.clear_time");
      $stmt->execute();
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt = $this->db->prepare("SELECT user_stats.level, users.name FROM user_stats, users WHERE users.id = user_stats.user_id AND user_stats.level = '0' ORDER BY user_id");
      $stmt->execute();
      return array_merge($rows,$stmt->fetchAll(PDO::FETCH_ASSOC));
    }
  }
?>