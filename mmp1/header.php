<!-- Author: Lara Pantlitschko
MultiMediaTechnology / FH Salzburg
Purpose: MultiMediaProjekt 1 -->

<?php
include "../login/config.php";
session_start();

?>

<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Book Buddy</title>
  <link rel="icon" type="image/x-icon" href="../images/BookBuddyLogo.png">
  <link rel="stylesheet" href="../styles.css">
  <link rel="stylesheet" href="../search/search.css">
  <link rel="stylesheet" href="../login/login.css">
  <link rel="stylesheet" href="../readlist/list.css">
  <link rel="stylesheet" href="../friends/friends.css">
  <script src="../login/config.js"></script>
  <script src="../search/search.js"></script>
  <script src="../readlist/readlist.js"></script>
</head>

<body>
  <header>
    <div id="logo"></div>
    <nav>
      <div id="menubox" class="menu">
        <p><a href="../index.php">Book Buddy</a></p>
        <p><a href="../readlist/toread.php?list=toread">Leselisten</a></p>
        <p><a href="../search/search.php">Suche</a></p>
        <p><a href="../friends/friends.php">Freunde</a></p>
        <p><a href="../impressum.php">Impressum</a></p>
        <?php
        if (isset($_SESSION['username'])) {
          $username = htmlspecialchars($_SESSION['username']);
          echo "<p><a href='../login/user_edit.php?username=$username'>$username</a></p>";
          echo "<p><a href='../login/logout.php'>Logout</a></p>";
        } else {
          echo "<p><a href='../login/login.php'>Login</a></p>";
        }
        ?>
      </div>
      <div class="burger-menu">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
      </div>
    </nav>
  </header>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const burgerMenu = document.querySelector('.burger-menu');
      const menu = document.querySelector('.menu');

      burgerMenu.addEventListener('click', () => {
        menu.classList.toggle('active');
      });
    });
  </script>