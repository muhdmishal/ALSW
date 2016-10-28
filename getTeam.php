<?php
  include 'admin/DB.php';

  if (isset($_GET['id'])) {
    $conn = new mysqli(SERVER, USER, PASSWORD, DB);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $id = $_GET['id'];
    $sql = "SELECT `tbl_team`.*, `tbl_member`.`name`,`tbl_member`.`image`
      FROM `tbl_team`
      INNER JOIN `tbl_member` ON `tbl_member`.`id` = `tbl_team`.`member_id`
        AND `tbl_member`.`status` = '1'
      WHERE `tbl_team`.`category_id` = '$id'
        AND `tbl_team`.`status` = '1'";
    $result = $conn->query($sql);

  }

 ?>

<div class="col-sm-12 text-center">
  <?php while ($row = $result->fetch_assoc()) { ?>
  <div class="col-sm-3">
    <img src="<?php echo $row['image'] ?>" alt="<?php echo $row['name'] ?>" class="img-circle img-profile"/>
    <h4><a href="<?php echo $row['link'] ?>"><?php echo $row['name'] ?></a></h4>
  </div>
  <?php } ?>
</div>
