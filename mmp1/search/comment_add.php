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
$comment = $_GET['comment'];
$bookTitle = $_GET['bookTitle'];
$bookAuthor = $_GET['bookAuthor'];

class Book
{
    public $title;
    public $author;
}

$url = "$_SERVER[QUERY_STRING]";

$book = new Book();
$book->title = $bookTitle;
$book->author = $bookAuthor;



$sth = $dbh->prepare('INSERT INTO comments (user_id, comments, books) VALUES (?, ?, ?)');
$sth->execute([$user_id, $comment, json_encode($book)]);



header('Location: ../index.php');


exit;

?>