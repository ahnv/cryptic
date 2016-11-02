<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/inc/autoload.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/LoginHelper.php';
$wrong = false;
$log = new LoginHelper($db);
if (!$log->isLoggedIn()){
header("Location: ".SITE_URL);
}
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/PlayerHelper.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/QuestionHelper.php';
$play = new PlayerHelper($db);
$ques = new QuestionHelper($db);
$_SESSION['level'] = $play->getLevel($_SESSION['user_id']);
$question = $ques->getOne($_SESSION['level']);
if ((isset($_POST['answer']) && $_POST['answer'] != "")){
if(!$play->checkAnswer($_POST['answer'],$question['answer'],$_SESSION['user_id'],$_SESSION['level']))
$wrong = true;
$_SESSION['level'] = $play->getLevel($_SESSION['user_id']);
$question = $ques->getOne($_SESSION['level']);
} else{
$wrong = true;
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
<div class="col-lg-12">
<h1 class="page-header">Level <?php echo $_SESSION['level']?></h1>
<div class="well"><?php echo $question['hint1']?></div>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<form method="post">
<div class="form-group <?php if ($wrong) echo "has-error"; ?>">
<label class="control-label" for="answer">Answer</label>
<input type="text" class="form-control" id="answer" name="answer">
</div>
<button type="submit" class="btn btn-default">Submit Button</button>
</form>
</div>
</div>
</div>
</div>
<script type="text/javascript" src="<?php echo SSTATIC; ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo SSTATIC; ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo SSTATIC; ?>js/sb-admin-2.js"></script> 
</body>
</html>
<!-- <?php echo $question['hint2'] ?> -->
