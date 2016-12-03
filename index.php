<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/inc/autoload.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/LoginHelper.php';
if(!$event->get_event_status())
    header("Location: ".SITE_URL."countdown");
$log = new LoginHelper($db);
if ((isset($_POST['username']) && $_POST['username'] !=  "") && 
(isset($_POST['password']) && $_POST['password'] !=  "")){
$log->login($_POST['username'], $_POST['password']);
}
if ($log->isLoggedIn()){
header("Location: ".SITE_URL."play");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Cryptic Hunt</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php if(!LIVE): ?>
<link href="<?php echo SSTATIC; ?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo SSTATIC; ?>css/font-awesome.min.css" rel="stylesheet">
<link rel='stylesheet' href='<?php echo SSTATIC; ?>css/style.css'>
<?php endif; ?>
<?php if(LIVE): ?>
<link rel='stylesheet' href='<?php echo SSTATIC; ?>css/app.css'>
<?php endif; ?>
</head>
<body>
<?php include 'inc/nav.php';?>

<section class="main-section">
<div class="container">
<h2>Log In - cryptic '16</h2>
<div class="row">
<div class="col-lg-offset-4 col-lg-4 col-sm-6 wow fadeInLeft delay-05s">
<div class="form">
<form action="#" method="post" role="form" class="contactForm">
<div class="form-group">
<input type="text" name="username" class="form-control input-text" placeholder="Username" />
</div>
<div class="form-group">
<input class="form-control input-text" name="password" type="text"  placeholder="Password"  />
</div>
<div class="text-center"><button type="submit" class="input-btn">Login</button></div>
</form>
</div>
</div>
</div>
</div>
</section>
<?php if(!LIVE): ?>
<script type="text/javascript" src="<?php echo SSTATIC; ?>js/jquery.min.js">
</script>
<script type="text/javascript" src="<?php echo SSTATIC; ?>js/bootstrap.min.js">
</script>
<script type="text/javascript" src="<?php echo SSTATIC; ?>js/sb-admin-2.js">
</script> 
<?php endif; ?>
<?php if(LIVE): ?>
<script type="text/javascript" src="<?php echo SSTATIC; ?>js/app.js">
</script> 
<?php endif; ?>
</body>
</html>