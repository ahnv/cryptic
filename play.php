<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/inc/autoload.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/LoginHelper.php';
$wrong = false;
$log = new LoginHelper($db);
$userid = $_SESSION['user_id'];
if (!$userid) { header("Location: ".SITE_URL."logout"); }
if (!$log->isLoggedIn()){
header("Location: ".SITE_URL);
}
if (!$log->isActive($userid)) {
header("Location: ".SITE_URL."disqualified");
}
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/PlayerHelper.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/QuestionHelper.php';
$play = new PlayerHelper($db);
$ques = new QuestionHelper($db);
$_SESSION['level'] = $play->getLevel($userid);
$question = $ques->getOne($_SESSION['level']);
if ((isset($_POST['answer']) && $_POST['answer'] != "")){
if(!$play->checkAnswer($_POST['answer'],$question['answer'],$userid,$_SESSION['level']))
$wrong = true;
$_SESSION['level'] = $play->getLevel($userid);
$question = $ques->getOne($_SESSION['level']);
} else{
$wrong = true;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cryptic Hunt</title>
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
<h2>Level <?php echo $_SESSION['level']?></h2>
<div class="row">
<div class="col-lg-4 col-lg-offset-4 col-sm-6 col-sm-3"><?php echo $question['hint1']?></div>
</div>
<div class="row">
<div class="col-lg-offset-4 col-lg-4 col-sm-6">
<div class="form">
<form action="#" method="post" role="form">
<div class="form-group">
<input class="form-control input-text" name="answer" type="text"  placeholder="Answer"  />
</div>
<div class="text-center"><button type="submit" class="input-btn">Answer</button></div>
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
<!-- <?php echo $question['hint2'] ?> -->
