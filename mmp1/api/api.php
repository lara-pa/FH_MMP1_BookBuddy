<!-- Author: Lara Pantlitschko
MultiMediaTechnology / FH Salzburg
Purpose: MultiMediaProjekt 1 -->

<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../login/config.php';

$query = $_GET['query'] ?? '';

if (empty($query)) {
    echo json_encode(['error' => 'Query parameter is missing.']);
    exit;
}

try {
    $stmt = $dbh->prepare("SELECT * FROM books WHERE title ILIKE :query OR author ILIKE :query");
    $stmt->execute([':query' => "%$query%"]);
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($books)) {
        $url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($query) . "&key=$apiKey&maxResults=20&orderBy=relevance";
        $response = file_get_contents($url);

        if ($response === FALSE) {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to fetch data from Google Books API.']);
            exit;
        }

        $data = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(500);
            echo json_encode(['error' => 'Invalid JSON from Google Books API.']);
            exit;
        }

        if (!empty($data['items'])) {
            foreach ($data['items'] as $item) {
                $volumeInfo = $item['volumeInfo'];
                $title = $volumeInfo['title'] ?? 'Kein Titel';
                $authors = isset($volumeInfo['authors']) ? implode(', ', $volumeInfo['authors']) : 'Kein Autor';
                $publishedDate = $volumeInfo['publishedDate'] ?? null;
                $description = $volumeInfo['description'] ?? '';
                $thumbnail = $volumeInfo['imageLinks']['thumbnail'] ?? '';

                $stmt = $dbh->prepare("INSERT INTO books (title, author, published_date, description, thumbnail) VALUES (:title, :author, :published_date, :description, :thumbnail)");
                $stmt->execute([
                    ':title' => $title,
                    ':author' => $authors,
                    ':published_date' => $publishedDate,
                    ':description' => $description,
                    ':thumbnail' => $thumbnail
                ]);

                $books[] = [
                    'book_id' => $bookId,
                    'title' => $title,
                    'author' => $authors,
                    'published_date' => $publishedDate,
                    'description' => $description,
                    'thumbnail' => $thumbnail
                ];
            }
        }
    }

    echo json_encode($books);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}