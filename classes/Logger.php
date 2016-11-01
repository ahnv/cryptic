<?php
  class Syslog{

  public static $hostname   = "logs4.papertrailapp.com";
  public static $port       = 45401;
  public static $program    = "[]";
  public static $embedLevel = true;

  public static function level2String($level){
    // taken from syslog + http:// nl3.php.net/syslog for log levels
    switch( $level ){
      case LOG_EMERG:   return "EMERGENCY"; break; // system is unusable
      case LOG_ALERT:   return "ALERT";     break; // action must be taken immediately
      case LOG_CRIT:    return "CRITICAL";  break; // critical conditions
      case LOG_ERR:     return "ERROR";     break; // error conditions
      case LOG_WARNING: return "WARNING";   break; // warning conditions
      case LOG_NOTICE:  return "NOTICE";    break; // normal, but significant, condition
      case LOG_INFO:    return "INFO";      break; // informational message
      case LOG_DEBUG:   return "DEBUG";     break; // debug-level message
    }
  }

  public static function send( $message, $level = LOG_NOTICE, $component = "web" ){
    if( self::$embedLevel ) $message = "[".self::level2String($level)."] ".$message;
    if( self::$hostname == false ) return syslog( $level, $message );
    $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    $facility = 1; // user level
    $pri = ($facility*8)+$level; // multiplying the Facility number by 8 + adding the nume
    $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    foreach(explode("\n", $message) as $line) {
      $syslog_message = "<{$pri}>" . date('M d H:i:s ') . self::$program . ' ' . $component . ': ' . $message;
      socket_sendto($sock, $syslog_message, strlen($syslog_message), 0, self::$hostname, self::$port );
    }
    socket_close($sock);    
  }
}
?>