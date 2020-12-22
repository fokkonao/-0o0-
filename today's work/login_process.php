<?php
  session_start();
  session_unset($_SESSION['sUsername']);

  //connect
  require_once ('connection/db_connect.php');

  //update database with new data
  $sUsername=$_POST['sUsername'];
  $sPassword=md5($_POST['sPassword']);
  $counter=$_POST['counter'];

  //specify
  echo $sql_Login="SELECT * FROM tb_userinfo WHERE sUsername='$sUsername' AND sPassword='$sPassword'";

  //do it
  $result=$conn->query($sql_Login);

  //close
  $conn->close();

  if ($result->num_rows>0) {
    //this means record is found and login is successful
    $_SESSION['sUsername']=$sUsername; //store username in the global session array
    //return to display.php
    //header("location:display.php");
  } else {
    //this person failed at their login atempt
    //header("location:login.php?error=$counter");
  }
?>
