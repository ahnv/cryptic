<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/inc/autoload.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/LeaderBoardHelper.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/LoginHelper.php';
$lb = new LeaderBoardHelper($db);
$log = new LoginHelper($db);  
$l = $lb->get();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>
Cryptic Hunt
</title>
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
<h2>Rules</h2>
<div class="row">
<div class="col-lg-12">
	<ul>
<li><h4>The cryptic hunt shall commence at 00:00:00 on 19th November 2016 to 17:59:59 on 20th November 2016 (IST).</h4></li>
<li><h4>This is a team event. Participation is open to every school. Credentials will be mailed on the registered e-mail address.</h4></li>
<li><h4>The event encompasses an Online Cryptic Treasure Hunt in which participants must make their way through a series of cryptic levels.</h4></li>
<li><h4>The participants' aim is to crack the levels as quickly as they can so as to place themselves at the top of the leaderboard.</h4></li>
<li><h4>At each level, the participants will encounter a number of clues which shall all, together, point to one answer. Each level has one correct answer.</h4></li>
<li><h4>Official clues may be released on the forum if and when deemed necessary by the admins.</h4></li>
<li><h4>Answers will always be lower-case, alphanumeric and will contain no spaces. Special characters are allowed. For example, if the answer is Harry Potter, you would type it in as “harrypotter”</h4></li>
<li><h4>Every clue in the question is important. If they weren't important, they wouldn't be there.</h4></li>
<li><h4>Beware of the spelling you enter, we are not autocorrect.</h4></li>
<li><h4>Special characters such as “.” and “,”must be written in words, “dot” and “comma” respectively.</h4></li>
</ul>
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
</script> 
</body>
</html>
