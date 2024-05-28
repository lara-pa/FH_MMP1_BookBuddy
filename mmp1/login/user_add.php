<?php
include "../header.php";


$sth_check = $dbh->prepare("SELECT COUNT(*) FROM newuser WHERE username = ?");
$sth_check->execute(array($username));
$count = $sth_check->fetchColumn();

if ($count == 0) {
  $sth = $dbh->prepare("INSERT INTO newuser (email, username, password) VALUES (?, ?, ?)");
  $sth->execute(
    array(
      htmlspecialchars($_POST['email']),
      htmlspecialchars($_POST['username']),
      htmlspecialchars($_POST['password']),
    )
  );
  header("Location: ../index.php");
  exit;
} else {
  echo "Error: Der Benutzername existiert bereits. Bitte versuchen Sie es erneut:<a href='user_add.php'>Zurückgehen</a>";
}
