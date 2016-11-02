<?php
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/Logger.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/config/consts.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/config/db.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/app.php';
if($_SERVER['HTTP_HOST'] != ORIGIN){
  die("STAY AWAY!!");
}