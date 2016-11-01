<?php

  require $_SERVER['DOCUMENT_ROOT'].'/cryptic/inc/autoload.php';
  require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/RegisterHelper.php';

  $reg = new RegisterHelper($db);
  $list = $reg->getList();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Questions</title>
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
              <li role="presentation"><a href="../">Home</a></li>
              <li role="presentation" class="active"><a href="../user">Users</a></li>
              <li role="presentation"><a href="../question">Questions</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Users</h3>
      </div>
    <div class="jumbotron">
      <div class="table-responsive">
        <table class="table table-striped ">
          <th>UID</th><th>School Name</th><th>E-mail</th><th>Username</th><th>Status</th><th>Edit</th>
          <?php foreach($list as $data):?>
          <tr>
          <td><?php echo $data['id']?></td>
          <td><?php echo $data['name']?></td>
          <td><?php echo $data['email'] ?></td>
          <td><?php echo $data['username']?></td>
          <td><div style="width:10px;height:10px;border-radius:50%;background-color:<?php echo $data['status']?"red":"green"; ?>;"></div></td>
          <td><a href="update?<?php echo  $data['status']?"rq=":"dq="; echo $data['id']; ?>">Edit</a></td>
          </tr>
          <?php endforeach;?>
        </table>
      </div>
    </div>
    <footer class="footer">
        <p>&copy; 2016 nCrypt</p>
      </footer>
  </div>
</body>
</html>