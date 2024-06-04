<!-- Author: Lara Pantlitschko
MultiMediaTechnology / FH Salzburg
Purpose: MultiMediaProjekt 1 -->

<?php
include "../header.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
    exit;
}
?>

<div id="detailsbox">
    <div id="bookDetails">
        <?php if (!empty($_GET['thumbnail'])): ?>
            <img src="<?php echo htmlspecialchars($_GET['thumbnail']); ?>" alt="Coverbild" id="detailsimg">
        <?php endif; ?>
        <h2><?php echo htmlspecialchars($_GET['title'] ?? 'Kein Titel'); ?></h2>
        <h3><?php echo htmlspecialchars($_GET['authors'] ?? 'Kein Autor'); ?></h3>
        <p id="description"><?php echo htmlspecialchars($_GET['description'] ?? 'Keine Beschreibung verfügbar'); ?></p>
        <p><strong>Verlag:</strong> <?php echo htmlspecialchars($_GET['publisher'] ?? 'Unbekannt'); ?></p>
        <p><strong>Erstveröffentlichung:</strong>
            <?php echo htmlspecialchars($_GET['publishedDate'] ?? 'Unbekannt'); ?></p>
        <p><strong>Seitenanzahl:</strong> <?php echo htmlspecialchars($_GET['pageCount'] ?? 'Unbekannt'); ?></p>
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
            <button
                onclick="addToReadlist('<?php echo htmlspecialchars($_GET['title']); ?>', '<?php echo htmlspecialchars($_GET['authors']); ?>', '<?php echo htmlspecialchars($_GET['thumbnail']); ?>')">Hinzufügen</button>
        </div>
        <div>
            <input type="text" id="comment" placeholder="Schreibe hier einen Kommentar">
            <button
                onclick="addComment('<?php echo htmlspecialchars($_GET['title']); ?>', '<?php echo htmlspecialchars($_GET['authors']); ?>')"
                id="commentbutton">Posten</button>
            <div id="commetsection">

                <?php


                $title = $_GET['title'];
                $authors = $_GET['authors'];

                if (isset($title) && isset($authors)) {

                    class Book
                    {
                        public $title;
                        public $author;
                    }

                    $book = new Book();
                    $book->title = $title;
                    $book->author = $authors;
                    $encoded = json_encode($book);


                    $sth = $dbh->prepare("SELECT c.comment_id, u.username, c.comments, c.books
                                            FROM comments c
                                            JOIN newuser u ON c.user_id = u.user_id
                                            WHERE c.books::json::text = ?::json::text;");
                    $sth->execute([$encoded]);
                    $commentContent = $sth->fetchAll();



                    foreach ($commentContent as $row) {

                        echo "<div>";
                        echo "<h3>$row->comments</h3>";
                        echo "<h4>$row->username</h3>";
                        echo "</div>";
                    }

                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>

</html>