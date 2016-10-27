<?php
  include 'DB.php';
  session_start();

  $errorMessage = '';
  if (isset($_POST['login'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $conn = new mysqli(SERVER, USER, PASSWORD, DB);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM `tbl_user` WHERE `username` = '$user' AND `password` = '$pass' AND `status` = '1'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $_SESSION['loginStatus'] = true;
      header('Location: family.php');
    } else {
      $errorMessage = "Please enter the correct username and password.";
    }
    $conn->close();

  }


 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="../css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- Font awesome CSS -->
    <link href="../css/font-awesome.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/custom.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="admin.css" rel="stylesheet">

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
      <div class="loginmodal-container">
					<h1>Login to Your Account</h1><br>
          <?php if ($errorMessage != ''): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $errorMessage; ?>
            </div>
          <?php endif; ?>
				  <form action="" method="post" >
					<input type="text" name="user" placeholder="Username" required="">
					<input type="password" name="pass" placeholder="Password" required="">
					<input type="submit" name="login" class="loginmodal-submit primary" value="Login">
				  </form>
				</div>

    </div>
  </body>
</html>
