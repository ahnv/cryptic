<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/inc/autoload.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/LoginHelper.php';
if ((isset($_POST['username']) && $_POST['username'] !=  "") && 
    (isset($_POST['password']) && $_POST['password'] !=  "")){
  $log = new LoginHelper($db);
  $log->login($_POST['username'], $_POST['password']);
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
            <nav>
          <ul class="nav nav-pills pull-right">
              <li role="presentation"><a href="">Home</a></li>
    </ul>
        </nav>      
      <h3 class="text-muted">nCrypt</h3>
    </div>
        <form class="form-signin" action="" method="post">
      <div class="form-group">
        <label for="username" class="sr-only">Username</label>
        <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
      </div>
      <div class="form-group">
              <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
      </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
          </form>   
    <footer class="footer">
        <p>&copy; 2016 Abhinav Dhiman</p>
      </footer>        
    </div>
</div>
</body>
</html>