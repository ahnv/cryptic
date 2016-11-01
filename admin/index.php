<?php
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/inc/autoload.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
  <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="http://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>

<body>
  <div class="container">
    <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
              <li role="presentation" class="active"><a href="">Home</a></li>
              <li role="presentation"><a href="user">Users</a></li>
              <li role="presentation"><a href="question">Questions</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Admin Panel</h3>
      </div>
    <div class="jumbotron">
      <h1>Hello</h1>
    </div>
    <footer class="footer">
        <p>&copy; 2016 nCrypt</p>
      </footer>
  </div>
</body>
</html>