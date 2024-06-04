<!-- Author: Lara Pantlitschko
MultiMediaTechnology / FH Salzburg
Purpose: MultiMediaProjekt 1 -->

<?php
include "login/config.php";
session_start();
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Book Buddy</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="search/search.css">
    <script src="login/config.js"></script>
    <script src="search/search.js"></script>
    <script src="newbooks.js"></script>

    <style>
        .impressumbox {
            background-color: #A3BFA8;
            width: 500px;
            height: 400px;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0 50px 0;
        }

        .impressumbody {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 70px 0 0 0;
        }

        .impressumtext {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 0;
        }

        @media (max-width: 800px) {

            .impressumtext {
                font-size: small;
            }

            .impressumbox {
                width: auto;
                height: auto;
                padding: 10px 20px;
                margin: 20px 40px;
            }
        }
    </style>
</head>

<body>
    <header>
        <div id="logo"></div>
        <nav>
            <div id="menubox" class="menu">
                <p><a href="index.php">Book Buddy</a></p>
                <p><a href="readlist/toread.php?list=toread">Leselisten</a></p>
                <p><a href="search/search.php">Suche</a></p>
                <p><a href="friends/friends.php">Freunde</a></p>
                <p><a href="impressum.php">Impressum</a></p>
                <?php
                if (isset($_SESSION['username'])) {
                    $username = htmlspecialchars($_SESSION['username']);
                    echo "<p><a href='login/user_edit.php?username=$username'>$username</a></p>";
                    echo "<p><a href='login/logout.php'>Logout</a></p>";
                } else {
                    echo "<p><a href='login/login.php'>Login</a></p>";
                }
                ?>
            </div>
            <div class="burger-menu">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </nav>
    </header>



    <div class="impressumbody">
        <div class="impressumbox">
            <p class="impressumtext">Diese Webseite entstand durch mein MultiMedia Projekt 1 and der FH Salzburg des
                Studienganges MMT</p>
            <p class="impressumtext">© Lara Pantlitschko</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const burgerMenu = document.querySelector('.burger-menu');
            const menu = document.querySelector('.menu');

            burgerMenu.addEventListener('click', () => {
                menu.classList.toggle('active');
            });
        });
    </script>