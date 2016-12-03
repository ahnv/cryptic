<?php
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/Logger.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/app.php';
SysLog::send('Requested Admin Console. ACCESS DENIED. Error: 401 by '.(new APP)->_getIP(),LOG_ALERT);

?>


<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>401 Authorization Required</title>
</head><body>
<h1>Authorization Required</h1>
<p>This server could not verify that you
are authorized to access the document
requested. Either you supplied the wrong
credentials (e.g., bad password), or your
browser doesn't understand how to supply
the credentials required.</p>
</body></html>
