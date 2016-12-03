<?php
$hasError = 0;
if ((isset($_POST['name']) && $_POST['name'] != "") && 
    (isset($_POST['username']) && $_POST['username'] != "") && 
    (isset($_POST['email']) && $_POST['email'] != "") && 
    (isset($_POST['password']) && $_POST['password'] != "")){
  require $_SERVER['DOCUMENT_ROOT'].'/cryptic/inc/autoload.php';
  require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/RegisterHelper.php';

  $reg = new RegisterHelper($db);
  $error = $reg->register( $_POST['username'], $_POST['password'],$_POST['email'],$_POST['name']);
  if ($error == 2)
    $hasError =1;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>
        Register
    </title>

    <link href="//getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="//getbootstrap.com/examples/signin/signin.css" rel="stylesheet">
  <link href="//getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">

</head>
<body>
    <?php if ($hasError): ?>
    <div class="flash"><?php echo "Username Already Exists"; ?></div>
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
      <h3 class="text-muted">Users / Add</h3>
    </div>       
      <form class="form-signin" method="post">
      <div class="form-group">
              <label for="name" class="sr-only">School Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="School Name" required autofocus>
      </div>

      <div class="form-group">
        <label for="username" class="sr-only">Username</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
      </div>

      <div class="form-group">
        <label for="email" class="sr-only">E-mail</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="E-mail" required>
      </div>

      <div class="form-group">
        <label for="password" class="sr-only">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
      </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
          </form>
    <footer class="footer">
        
      </footer> 
    </div>
</body>
</html>