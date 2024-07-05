<!-- Author: Lara Pantlitschko
MultiMediaTechnology / FH Salzburg
Purpose: MultiMediaProjekt 1 -->

<?php
include "../header.php";
?>

<div id="searchbox">
    <label for="searchquery">Buchtitel oder Autor </label><input type="text" id="searchquery">
    <button onclick="searchBooks()" id="searchbutton">Suchen</button>
</div>

<div id="resultbox">
    <div id="results"></div>
</div>

</body>

</html>