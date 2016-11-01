<?php

  require $_SERVER['DOCUMENT_ROOT'].'/cryptic/inc/autoload.php';
  require $_SERVER['DOCUMENT_ROOT'].'/cryptic/classes/QuestionHelper.php';

  $reg = new QuestionHelper($db);
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
              <li role="presentation"><a href="">Users</a></li>
              <li role="presentation" class="active"><a href="../question">Questions</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Users</h3>
      </div>
    <div class="jumbotron">
          <?php foreach($list as $data):?>
          <div class="panel panel-default">
            <div class="panel-heading"><h3>Level 
              <?php echo $data['level']?>
              </h3>
            </div>
            <div class="panel-body">
              <div class=" col-sm-4">
                <div class="panel panel-default">
                  <div class="panel-heading">Hint 1
                  </div>
                  <div class="panel-body">
                    <?php echo $data['hint1']?>
                  </div>
                </div>
              </div>
              <div class=" col-sm-4">
                <div class="panel panel-default">
                  <div class="panel-heading">Hint 2
                  </div>
                  <div class="panel-body">
                    <?php echo $data['hint2']?>
                  </div>
                </div>
              </div>
              <div class=" col-sm-4">
                <div class="panel panel-default">
                  <div class="panel-heading">Hint 3
                  </div>
                  <div class="panel-body">
                    <?php echo $data['hint3']?>
                  </div>
                </div>
              </div>
            </div>
              <div class="panel-footer"><h4>Answer : <?php echo $data['answer'] ?></h4></div>
              <div class="panel-footer"><a href="edit?lvl=<?php echo $data['level']?>"><h6>Edit</h6></a></div>
          </div>
          <?php endforeach;?>
    </div>
    <footer class="footer">
        <p>&copy; 2016 nCrypt</p>
      </footer>
  </div>
</body>
</html>