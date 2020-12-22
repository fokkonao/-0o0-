<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <h2>Login</h2>
    <form action="login_process.php" method="post">
      <label for="sUsername">Username: </label>
      <input type="text" name="sUsername" required /> <p>
      <label for="sPassword">Password: </label>
      <input type="password" name="sPassword" required /> <p>
      <input type="submit" value="Login" />
    </form>
    <?php
      if (isset($_GET['error'])) {
        echo "Your username or password is incorrect.";
        $counter=$_GET['error'];

        if ($counter>=3) {
          header("location: failed.html");
        }
      } else {
        //counting the number of times user failed
        $counter=0;
      }
    ?>
    <input style="width:25px" type="hidden" name="counter" value="<?php echo $counter; ?>" />
  </body>
</html>
