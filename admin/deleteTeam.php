<?php

  include 'DB.php';

  session_start();

  $loginStatus = $_SESSION["loginStatus"];

  if ($loginStatus) {
    if (isset($_GET['id'])) {

      $conn = new mysqli(SERVER, USER, PASSWORD, DB);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $id = $_GET['id'];
      $sql = "UPDATE `tbl_team` SET `status`= '0' WHERE `id`='$id'";
      $conn->query($sql);

      $conn->close();
    }
  }

 ?>
