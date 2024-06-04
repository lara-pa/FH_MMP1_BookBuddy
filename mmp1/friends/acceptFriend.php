<!-- Author: Lara Pantlitschko
MultiMediaTechnology / FH Salzburg
Purpose: MultiMediaProjekt 1 -->


<?php
include "../header.php";

// Freundschaftsanfrage senden
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'accept_friend') {
    $userId = $_POST['user_id'];
    $friendId = $_POST['friend_id'];

    $sth_update = $dbh->prepare("UPDATE friends SET status = 'accepted' WHERE user_id = ? AND friend_id = ?");
    $sth_update->execute([$friendId, $userId]);
    echo json_encode(['status' => 'success', 'message' => 'Freundschaftsanfrage akzeptiert!']);

    exit;
}
?>