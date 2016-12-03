<?php
define( 'HOST',   'localhost');
define( 'USERNAME', 'cryptic');
define( 'PASSWORD', 'hunt');
define( 'DATABASE', 'cryptic');
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/Database.php';

$db = (new Database())->getInstance();

