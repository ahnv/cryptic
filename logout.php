<?php
session_start();
session_destroy();
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/inc/autoload.php';
header("Location: ".SITE_URL);