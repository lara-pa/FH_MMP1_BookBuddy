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


$id = $_GET['id'];

$sth = $dbh->prepare('SELECT * FROM readlist WHERE readlist_id = ? ');
$sth->execute([$id]);
$list = $sth->fetch()->list_name;


$sth = $dbh->prepare('DELETE FROM readlist WHERE readlist_id = ?');
$sth->execute([$id]);

if ($list) {

    if ($list == "favourites") {
        header('Location: toread.php?list=favourites');
    } elseif ($list == "toread") {
        header('Location: toread.php?list=toread');
    } elseif ($list == "read") {
        header('Location: toread.php?list=read');
    } elseif ($list == "dnf") {
        header('Location: toread.php?list=dnf');
    } elseif ($list == "wishlist") {
        header('Location: toread.php?list=wishlist');
    }
}

exit;



?>