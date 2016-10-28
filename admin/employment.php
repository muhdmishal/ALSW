<?php
  include 'DB.php';

  $teamid = 4; // Employment id;

  $errorMessage = '';

  session_start();
  $loginStatus = $_SESSION["loginStatus"];
  if ($loginStatus) {

    $conn = new mysqli(SERVER, USER, PASSWORD, DB);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['add'])) {
          $id = $_POST['id'];
          $link = $_POST['link'];
          $sql = "INSERT INTO `tbl_team` (`member_id`, `link`, `category_id`) VALUES ('$id', '$link', '$teamid')";
          $conn->query($sql);
    }

    $sql = "SELECT `tbl_team`.*, `tbl_member`.`name`,`tbl_member`.`image`
      FROM `tbl_team`
      INNER JOIN `tbl_member` ON `tbl_member`.`id` = `tbl_team`.`member_id`
        AND `tbl_member`.`status` = '1'
      WHERE `tbl_team`.`category_id` = '$teamid'
        AND `tbl_team`.`status` = '1'";
    $result = $conn->query($sql);

    $sql = "SELECT * FROM `tbl_member` WHERE `status` = '1'";
    $members = $conn->query($sql);

    $conn->close();

  } else {
    header('Location: index.php');
  }



 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employment Team</title>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="../css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- Font awesome CSS -->
    <link href="../css/font-awesome.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/custom.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="team.php">Team</a></li>
              <li><a href="family.php">Family</a></li>
              <li><a href="wills.php">Wills & Probate</a></li>
              <li><a href="property.php">Property</a></li>
              <li class="active"><a href="employment.php">Employment</a></li>
              <li><a href="crime.php">Crime</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <h1>Employment Team</h1>
      <?php if ($errorMessage != ''): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <?php foreach ($errorMessage as $value) {
            echo $value . '<br />' ;
          } ?>
        </div>
      <?php endif; ?>
      <div class="row">
        <table class="table table-striped">
          <thead>
            <tr>
              <th class="col-xs-4">Profile</th>
              <th class="col-xs-7">Name</th>
              <th class="col-xs-1"></th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
              <tr>
                <td>
                  <img src="../<?php echo $row['image'] ?>" class="img-responsive img-circle" alt="" style="max-width:100px;" />
                </td>
                <td>
                  <a href="../<?php echo $row['link'] ?>" target="_blank"> <?php echo $row['name'] ?></a>
                </td>
                <td>
                  <a href="delete.php?id=<?php echo $row['member_id'] ?>" class="btn btn-danger" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
              </tr>
            <?php } ?>
            <tr>
              <form class="" action="" method="post" enctype="multipart/form-data">
                <td>
                  <div class="form-group">
                    <label for="image">Member</label>
                    <select class="form-control" name="id" required="">
                      <option value="">Select Member</option>
                      <?php while ($row = $members->fetch_assoc()) { ?>
                        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Link to profile</label>
                    <input type="text" name="link" value="" class="form-control" required="">
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <label for="add"></label>
                    <button type="submit" name="add" class="btn btn-primary form-control" value="add"><span class="glyphicon glyphicon-plus"></span></button>
                  </div>
                </td>
              </form>
            </tr>

          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
