<!-- Author: Lara Pantlitschko
MultiMediaTechnology / FH Salzburg
Purpose: MultiMediaProjekt 1 -->

<?php
include "../header.php";

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit;
} else {
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = htmlspecialchars($_POST['email']);
    $username = htmlspecialchars($_POST['username']);
    $original_username = htmlspecialchars($_POST['original_username']);
    $password = !empty($_POST['password']) ? password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT) : null;

    try {
      if ($password) {
        $sth = $dbh->prepare("UPDATE newuser SET email = ?, username = ?, password = ? WHERE username = ?");
        $sth->execute([$email, $username, $password, $original_username]);
      } else {
        $sth = $dbh->prepare("UPDATE newuser SET email = ?, username = ? WHERE username = ?");
        $sth->execute([$email, $username, $original_username]);
      }
      header("Location: ../index.php");
      exit;
    } catch (PDOException $e) {
      if ($e->getCode() == '23505') {
        echo "Error: Eindeutigkeitsverletzung. Bitte stellen Sie sicher, dass der Benutzername eindeutig ist.";
      } else {
        echo "Error: " . $e->getMessage();
      }
    }
  }
}
?>