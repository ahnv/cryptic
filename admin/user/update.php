<?php

  require $_SERVER['DOCUMENT_ROOT'].'/cryptic/inc/autoload.php';
  require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/UserHelper.php';
  $user = new UserHelper($db);
  if (isset($_GET['dq']) && $_GET['dq'] != ""){
    $user->disqualify($_GET['dq']);
  }
  if (isset($_GET['rq']) && $_GET['rq'] != ""){
    $user->requalify($_GET['rq']);
  }
 
  header('Location: '.SITE_URL.'admin/user/list');