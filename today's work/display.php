<?php
  session_start();
  //check if user has logged in successfully
  if (!isset($_SESSION['sUsername'])) {
    header("location:login.php");
  }
  require_once("connection/db_connect.php");
  $sort="";
  if (isset($_GET['sort'])) {
    $sort=$_GET['sort'];
  }

  //get data from search form
  $search_text="";
  if (isset($_POST['search_text'])) {
    $search_text=$_POST['search_text']; //get the search string
  }

  //specify sorting
  if ($sort==1) {
    $sql_getData="SELECT * FROM tb_companies WHERE sCompanyName LIKE '%{$search_text}%' ORDER BY sCompanyName asc";
  } elseif ($sort==2) {
    $sql_getData="SELECT * FROM tb_companies WHERE sCompanyName LIKE '%{$search_text}%' ORDER BY iAllowance asc";
  } elseif ($sort==3) {
    $sql_getData="SELECT * FROM tb_companies WHERE sCompanyName LIKE '%{$search_text}%' ORDER BY sJobDesc asc";
  } else {
    $sql_getData="SELECT * FROM tb_companies WHERE sCompanyName LIKE '%{$search_text}%'";
  }

  //do it
  //$companies is a recordset of many records
  $companies=$conn->query($sql_getData);

  //specify 2
  $sql_getCategory="SELECT DISTINCT eCategory FROM tb_companies";

  //do it 2
  $categories=$conn->query($sql_getCategory);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>Company Info</title>
    <style media="screen">
      table {padding: 10px;}
      tr,th,td {border-bottom: .5px solid lightblue;}
      th {background-color: turquoise; padding: 5px; border-radius: 4px;}
      a {text-decoration: none;}
      td a {color: red;}
      td a:linked, a:visited {color: red;}
      .hover:hover {background-color: aqua; border-radius: 4px; padding: 5px;}
    </style>
  </head>
  <body>
    <h1>Welcome, <?php echo $_SESSION['sUsername']; ?></h1>
    <h2>Company Info</h2>
    <form action="#" method="post">
      <label for="search_text">Search: </label>
      <input type="text" name="search_text" />
      <input type="submit" value="Search">
      <input type="submit" value="refresh" />
    </form>
    <form action="" method="post">
      <label for="eCategory">Select Category: </label>
      <select name="eCategory">
        <?php
          while ($category=$categories->fetch_assoc()) {
            $c=$category['eCategory'];
            echo "<option value='$c'>$c</option>";
          }
        ?>
      </select>
      <button type="submit" name="filter">Filter</button>
    </form>
    <table>
      <tr>
        <th><a href="display.php?sort=1">Company Name</a></th>
        <th><a href="display.php?sort=2">Allowance</a></th>
        <th><a href="display.php?sort=3">Job Description</a></th>
        <th>Category</th>
      </tr>
      <?php
        while ($company=$companies->fetch_assoc()) {
          $id=$company['id'];
          echo "<tr>";
          echo "<td class='hover'><a href='update.php?id=$id'>{$company['sCompanyName']}</a></td>";
          echo "<td>{$company['iAllowance']}</td>";
          echo "<td>{$company['sJobDesc']}</td>";
          echo "<td>{$company['eCategory']}</td>";
          echo "</tr>";
        }
      ?>
    </table>
  </body>
</html>
<?php
  $conn->close();
?>
