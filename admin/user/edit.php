<?php
$hasError = 0;
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/inc/autoload.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/RegisterHelper.php';

?>
<!DOCTYPE html>
<html>
<head>
    <title>
        Questions
    </title>

    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://getbootstrap.com/examples/signin/signin.css" rel="stylesheet">
  <link href="http://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">

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
              <li role="presentation" class="active"><a href="../user">Users</a></li>
              <li role="presentation"><a href="../question">Questions</a></li>
    </ul>
        </nav>  
      
    <footer class="footer">
        
      </footer> 
    </div>
</body>
</html>