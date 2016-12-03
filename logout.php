<?php
session_start();

require $_SERVER['DOCUMENT_ROOT'].'/cryptic/inc/autoload.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/LoginHelper.php';
$log = new LoginHelper($db);
$log->logout($_SESSION['user_id']);
session_destroy();
header("Location: ".SITE_URL);