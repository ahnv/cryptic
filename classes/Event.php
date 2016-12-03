<?php
class Event {
  
  private $event_status;
  
  public function __construct() {
    $current_time = time()+19800;
    
    if ( $current_time < EVENT_START )
      $this->event_status = EVENT_NOT_STARTED;
    else if ( $current_time >= EVENT_START && $current_time < EVENT_END)
      $this->event_status = EVENT_STARTED;
    else
      $this->event_status = EVENT_CLOSED;
  }
  
  public function _getIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else 
      $ip = $_SERVER['REMOTE_ADDR'];
    return $ip;
  }

  public function get_event_status() {
    return $this->event_status;
  }
  
}
?>