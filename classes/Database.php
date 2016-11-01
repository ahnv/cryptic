<?php 
/**
 * Log PDO errors
 * @return null
*/

class Database{
  protected $db = NULL;
  public function __construct(){
    $this->db = NULL;
  }
  public function __destruct(){$this->db = NULL;}
  /**
   * Do MySQL inet_aton() function
   * @return int
  */
  public function inet_aton($ip) {
      $ip = trim($ip);
      if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) return 0;
      return sprintf("%u", ip2long($ip));  
  }
  /**
   * Do MySQL inet_ntoa() function
   * @return string
  */
  public function inet_ntoa($num) {
      $num = trim($num);
      if ($num == "0") return "0.0.0.0";
      return long2ip(-(4294967295 - ($num - 1))); 
  }
  /**
   * Database connection
   * @return null
  */
  public function getInstance() {
    try{
      $db = new PDO('mysql:host='.HOST.';dbname='.DATABASE, USERNAME, PASSWORD);
      $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $db;
    }catch(PDOException $e){
      SysLog::send($e,LOG_ERR);
    }
  }  
}