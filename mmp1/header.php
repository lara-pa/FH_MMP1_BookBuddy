<?php
include "../login/config.php";
//include "../login/config.js";
session_start();
// $id = $_SESSION["id"];
?>

<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Book Buddy</title>
  <link rel="stylesheet" href="../styles.css">
  <link rel="stylesheet" href="../search/search.css">
  <script src="../login/config.js"></script>
  <script src="../search/search.js"></script>
</head>

<body>
  <header>
    <p><a href="../index.php">Book Buddy</a></p>
    <p><a href="../readlist/readlist.php">Leselisten</a></p>
    <p><a href="../search/search.php">Suche</a></p>

    <?php
    if (isset($_SESSION['username'])) {
      echo "<li><a href='../login/logout.php'>Logout</a></li>";
    } else {
      echo "<li><a href='../login/login.php'>Login</a></li>";
    }
    ?>
  </header>