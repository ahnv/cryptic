<?php
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/Logger.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/config/consts.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/config/db.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/app.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/Event.php';

if($_SERVER['HTTP_HOST'] != ORIGIN){
  SysLog::send("Origin Mismatch Detected".(new APP)->_getIP(),LOG_ALERT);
  die("STAY AWAY!!");
}
$event = new Event();
if($event->get_event_status() == 2)
	die("Event Closed");