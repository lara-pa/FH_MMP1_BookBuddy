<!-- Author: Lara Pantlitschko
MultiMediaTechnology / FH Salzburg
Purpose: MultiMediaProjekt 1 -->

<?php
include "../header.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
    exit;
}

$bookId = $_GET['book_id'] ?? null;

if ($bookId === null) {
    echo "Buch-ID fehlt.";
    exit;
}

$stmt = $dbh->prepare("SELECT * FROM books WHERE book_id = :book_id");
$stmt->execute([':book_id' => $bookId]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$book) {
    echo "Buch nicht gefunden.";
    exit;
}

?>

<div id="detailsbox">
    <div id="bookDetails">
        <?php if (!empty($book['thumbnail'])): ?>
            <img src="<?php echo htmlspecialchars($book['thumbnail']); ?>" alt="Coverbild" id="detailsimg">
        <?php endif; ?>
        <h2><?php echo htmlspecialchars($book['title']); ?></h2>
        <h3><?php echo htmlspecialchars($book['author']); ?></h3>
        <p id="description"><?php echo htmlspecialchars($book['description'] ?? 'Keine Beschreibung verfügbar'); ?></p>
        <p><strong>Verlag:</strong> <?php echo htmlspecialchars($book['publisher'] ?? 'Unbekannt'); ?></p>
        <p><strong>Erstveröffentlichung:</strong>
            <?php echo htmlspecialchars($book['published_date'] ?? 'Unbekannt'); ?></p>
    </div>
    <div id="bookdetailsUser">
        <div>
            <label for="list-select">Zu Liste hinzufügen:</label>
            <select id="list-select">
                <option value="toread">Noch zu lesen</option>
                <option value="read">Fertig gelesen</option>
                <option value="dnf">DNF</option>
                <option value="wishlist">Wunschliste</option>
                <option value="favourites">Lieblingbücher</option>
            </select>
            <button id="addListButton"
                onclick="addToReadlist('<?php echo htmlspecialchars($book['title']); ?>', '<?php echo htmlspecialchars($book['author']); ?>', '<?php echo htmlspecialchars($book['thumbnail']); ?>')">Hinzufügen</button>
        </div>
        <div>
            <input type="text" id="comment" placeholder="Schreibe hier einen Kommentar">
            <button
                onclick="addComment('<?php echo htmlspecialchars($book['title']); ?>', '<?php echo htmlspecialchars($book['author']); ?>')"
                id="commentbutton">Posten</button>
            <div id="commentsection">

                <?php
                $stmt = $dbh->prepare("SELECT c.comment_id, u.username, c.comments 
                                      FROM comments c
                                      JOIN newuser u ON c.user_id = u.user_id
                                      WHERE c.book_id = :book_id");
                $stmt->execute([':book_id' => $bookId]);
                $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo "<h2>Kommentare</h2>";

                foreach ($comments as $row) {
                    echo "<div>";
                    echo "<h3>" . htmlspecialchars($row['comments']) . "</h3>";
                    echo "<h4>" . htmlspecialchars($row['username']) . "</h4>";
                    echo "<hr>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>

</html>