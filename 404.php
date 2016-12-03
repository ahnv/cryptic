<?php
$actual_link = "$_SERVER[REQUEST_URI]";
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/Logger.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/app.php';
SysLog::send('Requested: '.$actual_link.' Error: 404 by '.(new APP)->_getIP(),LOG_ALERT);

?>



<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested URL <?php echo $actual_link?> was not found on this server.</p>
</body></html>
