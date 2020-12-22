<?php
  //update database with new data
  $id=$_POST['id'];
  $sJobDesc=$_POST['sJobDesc'];
  $iAllowance=$_POST['iAllowance'];

  //connect
  require_once ('connection/db_connect.php');

  //specify
  echo $sql_Update="UPDATE tb_companies SET sJobDesc='$sJobDesc', iAllowance=$iAllowance WHERE id=$id";

  //do it
  $compaines=$conn->query($sql_Update);

  //close
  $conn->close();

  //return to display.php
  header("location:display.php");
?>
