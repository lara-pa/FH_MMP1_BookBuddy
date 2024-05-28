<?php
include "../login/config.php";
session_start();
// $id = $_SESSION["id"];
?>

<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Book Buddy</title>
  <link rel="stylesheet" href="styles.css">


</head>

<body>
  <header>
    <?php echo $_SESSION['username']; ?>
    <p><a href="index.php">Book Buddy</a></p>
    <p><a href="readlist/readlist.php">Leselisten</a></p>
    <p><a href="search/search.php">Suche</a></p>
    <?php
    if (isset($_SESSION['username'])) {
      echo "<li><a href='login/logout.php'>Logout</a></li>";
    } else {
      echo "<li><a href='login/login.php'>Login</a></li>";
    }
    ?>
  </header>

  <div class="index">
    <div id="leftbox">
      <div id="botm"></div>

      <div id="qotm">
        “Gute Bücher enden nicht mit der letzten Seite, sie begleiten dich ein Leben lang.”
      </div>

    </div>

    <div id="rightbox">




    </div>
  </div>
</body>