<?php
  class LeaderBoardHelper {
    private $db;
    private $app;
    public function __construct($db) { $this->db =  $db; $this->app = new APP();}
    public function get(){
      $stmt = $this->db->prepare("SELECT 
          cryptic_user_stats.level,
          cryptic_gameplay.clear_time,
          cryptic_gameplay.user_id,
          cryptic_users.name 
        FROM 
          cryptic_gameplay, cryptic_user_stats, cryptic_users 
        WHERE 
          cryptic_user_stats.user_id = cryptic_gameplay.user_id 
          AND cryptic_gameplay.level = (cryptic_user_stats.level -1) 
          AND cryptic_users.id = cryptic_user_stats.user_id 
        ORDER BY cryptic_gameplay.level DESC , cryptic_gameplay.clear_time");
      $stmt->execute();
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt = $this->db->prepare("SELECT 
        cryptic_user_stats.level, cryptic_users.name FROM cryptic_user_stats, cryptic_users WHERE cryptic_users.id = cryptic_user_stats.user_id AND cryptic_user_stats.level = '0' ORDER BY user_id");
      $stmt->execute();
      return array_merge($rows,$stmt->fetchAll(PDO::FETCH_ASSOC));
    }
  }
?>