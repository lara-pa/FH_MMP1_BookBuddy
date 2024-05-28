<?php
include "functions.php";

$pagetitle = "Benutzer löschen";
include "header.php";

if (!isset($_SESSION['USER'])) {
    header("Location: login.php");
    exit;
} else {
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        if (isset($_GET['username'])) {
            $username = htmlspecialchars($_GET['username']);

            $userdelete = $dbh->prepare("DELETE FROM newuser WHERE username = ?");
            $userdelete->execute([$username]);

            if ($userdelete->rowCount() > 0) {
                echo "Benutzer $username wurde erfolgreich gelöscht.";
            } else {
                echo "Benutzer $username konnte nicht gelöscht werden.";
            }
        } else {
            echo "Benutzername nicht angegeben.";
        }
    }
}
?>