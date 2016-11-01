<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/inc/autoload.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/LoginHelper.php';
$log = new LoginHelper($db);
if (!$log->isLoggedIn()){
  header("Location: http://localhost/cryptic/");
}
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/PlayerHelper.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/QuestionHelper.php';
$play = new PlayerHelper($db);
$ques = new QuestionHelper($db);
$_SESSION['level'] = $play->getLevel($_SESSION['user_id']);
$question = $ques->getOne($_SESSION['level']);
if (isset($_POST['answer']) && $_POST['answer'] != ""){
  $play->checkAnswer($_POST['answer'],$question['answer'],$_SESSION['user_id'],$_SESSION['level']);
  $_SESSION['level'] = $play->getLevel($_SESSION['user_id']);
  $question = $ques->getOne($_SESSION['level']);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>
      nCrypt
    </title>
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://getbootstrap.com/examples/signin/signin.css" rel="stylesheet">
    <link href="http://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="header clearfix">
        <h3 class="text-muted">nCrypt
        </h3>
      </div>
      <form class="form-signin" action="" method="post">
      <div class="panel panel-default">
        <div class="panel-heading">
          Level <?php echo $_SESSION['level']?>
        </div>
        <div class="panel-body">
          <?php echo $question['hint1']?>
        </div>
      </div>  
        <div class="form-group">
          <label for="answer" class="sr-only">Answer
          </label>
          <input type="text" name="answer" id="answer" class="form-control" placeholder="Answer" required autofocus>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Answer
        </button>
      </form>   
      <footer class="footer">
        <p>&copy; 2016 Abhinav Dhiman
        </p>
      </footer>        
    </div>
  </body>
</html>
<!-- <?php echo $question['hint2'] ?> -->