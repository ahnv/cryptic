<?php
require( $_SERVER['DOCUMENT_ROOT'].'/cryptic/config/consts.php' );
session_start();
echo "<pre>";
var_dump($_SESSION);
var_dump($_COOKIE);
echo "</pre>";
?>