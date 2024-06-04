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


$user_id = $_SESSION['user_id'];
$list = $_GET['list'];
$bookTitle = $_GET['bookTitle'];
$bookAuthor = $_GET['bookAuthor'];
$bookThumbnail = $_GET['bookThumbnail'];

class Book
{
    public $title;
    public $author;
    public $thumbnail;
}

$url = "$_SERVER[QUERY_STRING]";

$book = new Book();
$book->title = $bookTitle;
$book->author = $bookAuthor;


$params = explode('&', $url);
$bookThumbnail = '';

$found = false;


foreach ($params as $param) {
    if (str_contains($param, "bookThumbnail")) {
        $found = true;
    }

    if ($found) {
        $new_query_str = str_replace("bookThumbnail=", '', $param);
        $bookThumbnail .= $new_query_str . '&';
    }
}

$bookThumbnail = substr($bookThumbnail, 0, -1);
echo $bookThumbnail;

$book->thumbnail = $bookThumbnail;

$sth = $dbh->prepare('INSERT INTO readlist (user_id, list_name, books) VALUES (?, ?, ?)');
$sth->execute([$user_id, $list, json_encode($book)]);


if (isset($_GET['list'])) {

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