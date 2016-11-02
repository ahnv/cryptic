<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/inc/autoload.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/LoginHelper.php';
$log = new LoginHelper($db);
if ((isset($_POST['username']) && $_POST['username'] !=  "") && 
(isset($_POST['password']) && $_POST['password'] !=  "")){
$log->login($_POST['username'], $_POST['password']);
}
if ($log->isLoggedIn()){
//print_r($_SESSION);
header("Location: ".SITE_URL."play");
//unset($_SESSION['logged_in']);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>nCrypt</title>
<link href="<?php echo SSTATIC; ?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo SSTATIC; ?>css/sb-admin-2.css" rel="stylesheet">
<link href="<?php echo SSTATIC; ?>css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<div id="wrapper">
<?php include 'inc/nav.php';?>
</div>
<div id="page-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-md-4 col-md-offset-4">
<div class="login-panel panel panel-default">
<div class="panel-heading"><h3 class="panel-title">Please Sign In</h3></div>
<div class="panel-body">
<form role="form" action="#" method="post">
<fieldset>
<div class="form-group"><input class="form-control" placeholder="Username" name="username" type="text" autofocus></div>
<div class="form-group"><input class="form-control" placeholder="Password" name="password" type="password" value=""></div>
<button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
</fieldset>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript" src="<?php echo SSTATIC; ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo SSTATIC; ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo SSTATIC; ?>js/sb-admin-2.js"></script> 
</body>
</html>