<?php
$hasError = 0;
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/inc/autoload.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/QuestionHelper.php';
$reg = new QuestionHelper($db);
$levels = $reg->getLevelList();

if ((isset($_POST['level']) && $_POST['level'] != "") && 
    (isset($_POST['hint1']) && $_POST['hint1'] != "") && 
    (isset($_POST['hint2']) && $_POST['hint2'] != "") && 
    (isset($_POST['answer']) && $_POST['answer'] != "")){

  $error = $reg->add( $_POST['level'], $_POST['hint1'],$_POST['hint2'],$_POST['answer']);
  if ($error == 2)
    $hasError =1;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>
        Questions
    </title>

    <link href="//getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="//getbootstrap.com/examples/signin/signin.css" rel="stylesheet">
  <link href="//getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">

</head>
<body>
    <?php if ($hasError): ?>
    <div class="flash"><?php echo "Question Already Exists"; ?></div>
    <?php endif; ?>
    <div class="container">
    <div class="header clearfix">  
            <nav>
          <ul class="nav nav-pills pull-right">
              <li role="presentation"><a href="../">Home</a></li>
              <li role="presentation"><a href="../user">Users</a></li>
              <li role="presentation" class="active"><a href="../question">Questions</a></li>
    </ul>
        </nav>  
      <h3 class="text-muted">Questions / Add</h3>
    </div>       
      <form class="form-signin" method="post">
      <div class="form-group">
            <label for="level" >Level Number</label>
            <select name="level" class="form-control" required autofocus>
              <option></option>
              <?php for ($i =0 ; $i < count($levels) + 10 ; $i++): ?>
                <option <?php echo in_array($i, $levels)? "disabled": "" ?>><?php echo $i ?></option>
              <?php endfor; ?>
            </select>
      </div>

      <div class="form-group">
        <label for="hint1" class="sr-only">Hint 1</label>
        <textarea type="text" id="hint1" name="hint1" class="form-control" rows="5" placeholder="Hint 1" required></textarea>
      </div>

      <div class="form-group">
        <label for="hint2" class="sr-only">Hint 2</label>
        <textarea type="text" id="hint2" name="hint2" class="form-control" rows="5" placeholder="Hint 2" required></textarea>
      </div>
      <div class="form-group">
            <label for="answer" class="sr-only">Answer</label>
            <input type="text" id="name" name="answer" class="form-control" placeholder="Answer" required autofocus>
      </div>      
            <button class="btn btn-lg btn-primary btn-block" type="submit">Add Question</button>
          </form>
    <footer class="footer">
        
      </footer> 
    </div>
</body>
</html>