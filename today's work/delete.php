<?php
  //delete selected data from $dataBase
  $id=$_GET['id'];

  //connect
  require_once('connection/db_connect.php');

  //specify
  $sql_Delete="DELETE FROM tb_companies WHERE id=$id";

  //do it
  $companies=$conn->query($sql_Delete);

  //close
  $conn->close();

  //relocate
  header("location:display.php");
?>
