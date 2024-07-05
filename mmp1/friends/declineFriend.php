<!-- Author: Lara Pantlitschko
MultiMediaTechnology / FH Salzburg
Purpose: MultiMediaProjekt 1 -->


<?php
include "../header.php";

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// Freundschaftsanfrage senden
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'decline_friend') {
    $userId = $_POST['user_id'];
    $friendId = $_POST['friend_id'];

    $sth_check = $dbh->prepare("SELECT COUNT(*) FROM friends WHERE (user_id = ? AND friend_id = ?) OR (user_id = ? AND friend_id = ?)");
    $sth_check->execute([$userId, $friendId, $friendId, $userId]);
    $count = $sth_check->fetchColumn();

    if ($count > 0) {
        $sth_update = $dbh->prepare("UPDATE friends SET status = 'declined' WHERE user_id = ? AND friend_id = ?");
        $sth_update->execute([$friendId, $userId]);
        echo json_encode(['status' => 'success', 'message' => 'Freundschaftsanfrage abgelehnt!']);
    } else {
        echo 'Freundschaftsanfrage existiert nicht!';
    }

    exit;
}
?>