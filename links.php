<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Short Link</title>
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Open+Sans&display=swap">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="path_to_your_css_file.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMcPsS0xfMrx8o4G2v+P5pni4cnE+3iJp3y8Xf7" crossorigin="anonymous">

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
                <li><a href="#p" class="navbar-link" data-nav-link>Review</a></li>
                <li><a href="Price.php" class="navbar-link" data-nav-link>Price Platform</a></li>
            </ul>
        </nav>
        <div class="header-actions">
            <a href="Links.php" class="btn" aria-labelledby="aria-label-txt">
                <ion-icon name="link-outline"></ion-icon>
                <span id="aria-label-txt">Uploaded Links</span>
            </a>
            <?php
            session_start();
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

<div class="links-container">
    <h2>Linkurile tale</h2>
    <ul class="links-list">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "short_link";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            http_response_code(500);
            echo "Conexiune esuata: " . $conn->connect_error;
            exit();
        }

        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }

        if (!isset($_SESSION['is_admin'])) {

            $user_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM urls WHERE user_id = '$user_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<li class="link-item">';
                    echo '<p class="link-short" style="width: 12ch">Link scurt: <a href="redirect.php?url=' . urlencode($row["short_url"]) . '" target="_blank">' . $row["short_url"] . '</a></p>';
                    echo '<p class="link-original" style="margin-left: 20px;">Link original: <a href="' . $row["original_url"] . '" target="_blank">' . $row["original_url"] . '</a></p>';
                    echo '<button class="copy-button"><i class="fas fa-copy"></i></button>';
                    echo '<button class="share-button"><i class="fas fa-share"></i></button>';
                    echo '<button class="edit-button"><i class="fas fa-edit"></i></button>';
                     echo '</li>';
                }
            } else {
                echo '<li class="no-links">Nu există linkuri adăugate.</li>';
            }
        }
        else{
            $sql = "SELECT * FROM urls ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<li class="link-item">';
                    echo '<p class="link-short" style="width: 12ch">Link scurt: <a href="redirect.php?url=' . urlencode($row["short_url"]) . '" target="_blank">' . $row["short_url"] . '</a></p>';
                    echo '<p class="link-original" style="margin-left: 20px;">Link original: <a href="' . $row["original_url"] . '" target="_blank">' . $row["original_url"] . '</a></p>';
                    echo '<p class="link-visits">Vizite: ' . $row["visits"] . '</p>';
                    echo '<button class="copy-button"><i class="fas fa-copy"></i></button>';
                    echo '<button class="share-button"><i class="fas fa-share"></i></button>';
                    echo '<button class="edit-button"><i class="fas fa-edit"></i></button>';
                    echo '</li>';
                }
            } else {
                echo '<li class="no-links">Nu există linkuri adăugate.</li>';
            }

        }

        $conn->close();
        ?>
    </ul>
</div>

<script>
    document.querySelectorAll('.copy-button').forEach(button => {
        button.addEventListener('click', (event) => {
            const linkShortElement = event.target.closest('.link-item').querySelector('.link-short a');
            const linkToCopy = linkShortElement.href;

            navigator.clipboard.writeText(linkToCopy).then(() => {
                console.log('Link copiat: ' + linkToCopy);
                alert('Link copiat în clipboard!');
            }).catch(err => {
                console.error('Eroare la copierea linkului: ', err);
            });
        });
    });

    document.querySelectorAll('.share-button').forEach(button => {
        button.addEventListener('click', (event) => {
            const linkShortElement = event.target.closest('.link-item').querySelector('.link-short a');
            const linkToShare = linkShortElement.href;

            if (navigator.share) {
                navigator.share({
                    title: 'Link scurt',
                    url: linkToShare
                }).then(() => {
                    console.log('Link partajat: ' + linkToShare);
                }).catch(err => {
                    console.error('Eroare la partajarea linkului: ', err);
                });
            } else {
                alert('Partajarea nu este suportată de acest browser.');
            }
        });
    });

    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', (event) => {
            const linkItemElement = event.target.closest('.link-item');
            const linkShortElement = linkItemElement.querySelector('.link-short a');
            const originalLinkElement = linkItemElement.querySelector('.link-original a');

            const newOriginalUrl = prompt('Introduceți noul URL original:', originalLinkElement.href);

            if (newOriginalUrl) {

                console.log('Linkul original a fost editat: ' + newOriginalUrl);

                // Actualizăm URL-ul original în interfață
                originalLinkElement.href = newOriginalUrl;
                originalLinkElement.textContent = newOriginalUrl;

                alert('Linkul a fost actualizat!');
            }
        });
    });
</script>

<script>

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMcPsS0xfMrx8o4G2v+P5pni4cnE+3iJp3y8Xf7" crossorigin="anonymous"></script>
</body>
</html>




