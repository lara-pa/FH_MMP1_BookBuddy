<!-- Author: Lara Pantlitschko
MultiMediaTechnology / FH Salzburg
Purpose: MultiMediaProjekt 1 -->

<?php
include "../header.php";

$tables = [
    'readlist' => 'readlist_id',
    'comments' => 'comment_id'
];

foreach ($tables as $table => $primaryKey) {
    $stmt = $dbh->query("SELECT $primaryKey, books FROM $table WHERE books IS NOT NULL");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $booksJson = json_decode($row['books'], true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($booksJson)) {
            foreach ($booksJson as $bookJson) {
                if (is_array($bookJson)) {
                    $bookStmt = $dbh->prepare("
                        SELECT book_id FROM books 
                        WHERE title = :title 
                        AND author = :author 
                        AND published_date = :published_date
                    ");
                    $bookStmt->execute([
                        'title' => $bookJson['title'] ?? '',
                        'author' => $bookJson['author'] ?? '',
                        'published_date' => $bookJson['published_date'] ?? null
                    ]);
                    $book = $bookStmt->fetch(PDO::FETCH_ASSOC);

                    if (!$book) {
                        $insertStmt = $dbh->prepare("
                            INSERT INTO books (title, author, published_date, description, thumbnail) 
                            VALUES (:title, :author, :published_date, :description, :thumbnail)
                        ");
                        $insertStmt->execute([
                            'title' => $bookJson['title'] ?? '',
                            'author' => $bookJson['author'] ?? '',
                            'published_date' => $bookJson['published_date'] ?? null,
                            'description' => $bookJson['description'] ?? '',
                            'thumbnail' => $bookJson['thumbnail'] ?? ''
                        ]);
                        $bookId = $dbh->lastInsertId();
                    } else {
                        $bookId = $book['book_id'];
                    }

                    $updateStmt = $dbh->prepare("
                        UPDATE $table 
                        SET book_id = :book_id 
                        WHERE $primaryKey = :id
                    ");
                    $updateStmt->execute(['book_id' => $bookId, 'id' => $row[$primaryKey]]);
                } else {
                    error_log("Ungültige Daten in $table, ID: " . $row[$primaryKey]);
                }
            }
        } else {
            error_log("JSON decoding ist fü $table fehlgeschlagen, ID: " . $row[$primaryKey] . ", Error: " . json_last_error_msg());
        }
    }
}
?>