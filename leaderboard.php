<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/inc/autoload.php';
require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/LeaderBoardHelper.php';
$lb = new LeaderBoardHelper($db);
$l = $lb->get();
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
        <div class="table-responsive">
          <table class="table table-striped">
              <tr>
                <th>Position</th>
                <th>Name</th>
                <th>Level</th>
              </tr>
              <?php $i = 1; foreach($l as $data):?>
              <tr>
                <td><?php echo $i++?></td>
                <td><?php echo $data['name'] ?></td>
                <td><?php echo $data['level'] ?></td>
              </tr>
              <?php endforeach;?>
          </table>
        </div>
    <footer class="footer">
        <p>&copy; 2016 Abhinav Dhiman</p>
      </footer>        
    </div>
</div>
</body>
</html>