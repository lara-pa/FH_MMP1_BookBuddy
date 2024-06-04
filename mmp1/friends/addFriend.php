<!-- Author: Lara Pantlitschko
MultiMediaTechnology / FH Salzburg
Purpose: MultiMediaProjekt 1 -->


<?php
include "../header.php";

// Freundschaftsanfrage senden
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_friend') {
    $userId = $_POST['user_id'];
    $friendId = $_POST['friend_id'];

    // Prüfen, ob bereits eine Freundschaftsanfrage existiert
    $sth_check = $dbh->prepare("SELECT COUNT(*) FROM friends WHERE user_id = ? AND friend_id = ?");
    $sth_check->execute(array($userId, $friendId));
    $count = $sth_check->fetchColumn();

    if ($count == 0) {
        $sth_insert = $dbh->prepare("INSERT INTO friends (user_id, friend_id, status) VALUES (?, ?, 'waiting')");
        $sth_insert->execute(array($userId, $friendId));
        echo 'Freundschaftsanfrage gesendet!';
    } else {
        echo 'Freundschaftsanfrage bereits gesendet!';
    }

    exit();
}
?>