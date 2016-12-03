<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/inc/autoload.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/LoginHelper.php';
$log = new LoginHelper($db);
if ($log->isLoggedIn()){
if ($log->isActive($_SESSION['user_id'])) {
header("Location: ".SITE_URL);
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Cryptic Hunt</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="<?php echo SSTATIC; ?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo SSTATIC; ?>css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo SSTATIC; ?>css/style.css" rel="stylesheet">
</head>
<body>
<?php include 'inc/nav.php';?>

<section class="main-section">
<div class="container">
<h2>You're Disqualified</h2>
<h3 class="text-center">If you think this is by mistake, please contact us.</h3><br>
</div>
</section>
<script type="text/javascript" src="<?php echo SSTATIC; ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo SSTATIC; ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo SSTATIC; ?>js/sb-admin-2.js"></script> 
</body>
</html>
