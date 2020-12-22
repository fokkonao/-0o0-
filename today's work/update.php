<?php
  //get existing data from the selected Company
  require_once("connection/db_connect.php");
  $id=$_GET['id'];

  //specify
  $sql_getCompany="SELECT * FROM tb_companies WHERE id=$id";

  //do it
  $data=$conn->query($sql_getCompany);
  $company=$data->fetch_assoc(); //there is only one company being selected, no need for a loop
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>Update Form</title>
    <style media="screen">
      label {width: 120px; float: left;}
    </style>
  </head>
  <body>
    <h2>Update Form</h2>
    <form action="update_process.php" method="post">
      <label for="sJobDesc">Job Description</label>
      <input type="text" name="sJobDesc" value="<?php echo $company['sJobDesc']; ?>" />
      <br />
      <label for="iAllowance">Allowance</label>
      <input type="text" name="iAllowance" value="<?php echo $company['iAllowance']; ?>" />
      <br />
      <input type="hidden" name="id" value="<?php echo $company['id']; ?>" />
      <br />
      <input type="submit" value="Update" />
      <a href="delete.php?id=<?php echo $company['id']; ?>"><button type="button">Delete</button></a>
    </form>
  </body>
</html>
