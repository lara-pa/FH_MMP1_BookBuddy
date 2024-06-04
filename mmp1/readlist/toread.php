<!-- Author: Lara Pantlitschko
MultiMediaTechnology / FH Salzburg
Purpose: MultiMediaProjekt 1 -->

<?php
include "../header.php";

$user_id = $_SESSION['user_id'];

if (!isset($_SESSION['username'])) {
  header("Location: ../login/login.php");
  exit;
}
?>

<div class="readlist">
  <div id="lists">
    <div id="mylist">
      <p>Meine Listen</p>
      <nav>
        <ul>
          <li class="mylist"><a href="toread.php?list=toread">Noch zu lesen</a></li>
          <li class="mylist"><a href="toread.php?list=read">Fertig gelesen</a></li>
          <li class="mylist"><a href="toread.php?list=dnf">DNF</a></li>
          <li class="mylist"><a href="toread.php?list=wishlist">Wunschliste</a></li>
          <li class="mylist"><a href="toread.php?list=favourites">Lieblingbücher</a></li>
        </ul>
      </nav>
    </div>

    <div id="mygoal">
    </div>

  </div>

  <div id="mybooks">

    <?php

    $list = $_GET["list"];

    if (isset($list)) {

      $sth = $dbh->prepare("SELECT * FROM readlist WHERE list_name = ? AND user_id = ?");
      $sth->execute([$list, $user_id]);
      $listContent = $sth->fetchAll();

      foreach ($listContent as $row) {
        $book = json_decode($row->books);

        echo "<img src='$book->thumbnail' alt= '$book->title' >";
        echo "<div>";
        echo "<h3>$book->title</h3>";
        echo "<h4>$book->author</h3>";
        echo " <button onclick='removeFromReadlist($row->readlist_id)'>X</button>";
        echo "</div>";

      }

    }
    ?>

  </div>
</div>
</body>