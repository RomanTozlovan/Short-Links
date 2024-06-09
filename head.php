<?php
session_start();
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Short Link</title>
        <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
        <link rel="stylesheet" href="./css/header.css">
        <link rel="stylesheet" href="./css/head.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Open+Sans&display=swap">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    </head>
    <body>

    <!-- #HEADER -->
    <header class="header" data-header>
        <div class="container">
            <div class="overlay" data-overlay></div>
            <a href="#" class="logo">
                <img src="images/logo.png" width="" alt="Events" id="logou">
            </a>
            <nav class="navbar" data-navbar>
                <ul class="navbar-list">
                    <li><a href="index.php" class="navbar-link" data-nav-link>Home</a></li>
                    <li><a href="#" class="navbar-link" data-nav-link>About us</a></li>
                    <li><a href="#" class="navbar-link" data-nav-link>Review</a></li>
                    <li><a href="Price.php" class="navbar-link" data-nav-link>Price Platform</a></li>
                </ul>
            </nav>
            <div class="header-actions">

                <a href="Links.php" class="btn" aria-labelledby="aria-label-txt">
                    <ion-icon name="link-outline"></ion-icon>
                    <span id="aria-label-txt">Uploaded Links</span>
                </a>
            <?php

            if (isset($_SESSION['firstname'])) {
                echo '<form action="logout.php"> <button id="togglePopup" aria-label="Profile">Log Out <ion-icon name="log-out"></ion-icon></button></form>';
            } else {

            }
            ?>

            <button class="nav-toggle-btn" data-nav-toggle-btn aria-label="Toggle Menu">
                <span class="one"></span>
                <span class="two"></span>
                <span class="three"></span>
            </button>
        </div>
        </div>
    </header>
    <main>
        <article>
            <script src="./script/script.js"></script>
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        </article>
    </main>
    </body>
    </html>
<?php
