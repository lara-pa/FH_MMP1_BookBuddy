<?php
include "../header.php";
?>

<div id="bookDetails">
    <?php if (!empty($_GET['thumbnail'])): ?>
        <img src="<?php echo htmlspecialchars($_GET['thumbnail']); ?>" alt="Coverbild">
    <?php endif; ?>
    <h2><?php echo htmlspecialchars($_GET['title'] ?? 'Kein Titel'); ?></h2>
    <h3><?php echo htmlspecialchars($_GET['authors'] ?? 'Kein Autor'); ?></h3>
    <p><?php echo htmlspecialchars($_GET['description'] ?? 'Keine Beschreibung verfügbar'); ?></p>
    <p><strong>Publisher:</strong> <?php echo htmlspecialchars($_GET['publisher'] ?? 'Unbekannt'); ?></p>
    <p><strong>Published Date:</strong> <?php echo htmlspecialchars($_GET['publishedDate'] ?? 'Unbekannt'); ?></p>
    <p><strong>Page Count:</strong> <?php echo htmlspecialchars($_GET['pageCount'] ?? 'Unbekannt'); ?></p>
</div>

</body>

</html>