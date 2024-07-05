<!-- Author: Lara Pantlitschko
MultiMediaTechnology / FH Salzburg
Purpose: MultiMediaProjekt 1 -->

<?php
include "../header.php";

$sth_check = $dbh->prepare("SELECT COUNT(*) FROM newuser WHERE username = ?");
$sth_check->execute(array(($_POST['username'])));
$count = $sth_check->fetchColumn();

if ($count == 0) {
  $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $sth = $dbh->prepare("INSERT INTO newuser (email, username, password) VALUES (?, ?, ?)");
  $sth->execute(
    array(
      ($_POST['email']),
      ($_POST['username']),
      $hashed_password
    )
  );
  header("Location: login.php");
  exit;
} else {
  echo "Error: Der Benutzername existiert bereits. Bitte versuchen Sie es erneut: <a href='user_add.php'>Zurückgehen</a>";
}
?>