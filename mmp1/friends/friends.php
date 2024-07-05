<!-- Author: Lara Pantlitschko
MultiMediaTechnology / FH Salzburg
Purpose: MultiMediaProjekt 1 -->

<?php
include "../header.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
    exit;
}

$userId = $_SESSION['user_id'];


$sth_waiting = $dbh->prepare("
    SELECT f.user_id AS requester_id, u1.username AS requester_username,
           f.friend_id AS friend_id, u2.username AS friend_username
    FROM friends f
    JOIN newuser u1 ON f.user_id = u1.user_id
    JOIN newuser u2 ON f.friend_id = u2.user_id
    WHERE f.status = 'waiting' AND u2.user_id = ?
");
$sth_waiting->execute([$userId]);
$pendingRequests = $sth_waiting->fetchAll();


$sth_friends = $dbh->prepare("
SELECT f.user_id AS requester_id, u1.username AS requester_username,
           f.friend_id AS friend_id, u2.username AS friend_username
    FROM friends f
    JOIN newuser u1 ON f.user_id = u1.user_id
    JOIN newuser u2 ON f.friend_id = u2.user_id
    WHERE f.status = 'accepted' AND u2.user_id = ? OR u1.user_id = ?");
$sth_friends->execute([$userId, $userId]);
$friends = $sth_friends->fetchAll();


?>

<div id="friendsBox">
    <h3>Deine ID: <?php echo htmlspecialchars($userId); ?></h3>

    <h3>Benutzer hinzufügen</h3>
    <form id="addFriendForm" method="post" action="addFriend.php">
        <input type="hidden" name="action" value="add_friend">
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($userId); ?>">
        <label for="friend_id">Freund ID:</label>
        <input type="number" id="friend_id" name="friend_id" required>
        <button id="addFriendButton" type="submit">Freund hinzufügen</button>
    </form>

    <h3>Freundschaftsanfragen</h3>
    <ul>
        <?php foreach ($pendingRequests as $request): ?>
            <li>
                <?php echo htmlspecialchars($request->requester_username) ?>
                <form method="post" action="acceptFriend.php" style="display:inline;">
                    <input type="hidden" name="action" value="accept_friend">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($userId); ?>">
                    <input type="hidden" name="friend_id" value="<?php echo htmlspecialchars($request->requester_id); ?>">
                    <button type="submit">Akzeptieren</button>
                </form>
                <form method="post" action="declineFriend.php" style="display:inline;">
                    <input type="hidden" name="action" value="decline_friend">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($userId); ?>">
                    <input type="hidden" name="friend_id" value="<?php echo htmlspecialchars($request->requester_id); ?>">
                    <button type="submit">Ablehnen</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>


    <h3>Freunde</h3>
    <ul>
        <?php foreach ($friends as $friend): ?>
            <li>
                <?php if ($userId == $friend->requester_id): ?>
                    <?php echo htmlspecialchars($friend->friend_username) ?>
                <?php elseif ($userId == $friend->friend_id): ?>
                    <?php echo htmlspecialchars($friend->requester_username) ?>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

</body>

</html>