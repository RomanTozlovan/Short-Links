<?php
session_start();
if (isset($_SESSION['is_admin'])) {
header("index.php");
}
if (isset($_SESSION['firstname'])) {
    require 'head.php';

    echo '<main xmlns="http://www.w3.org/1999/html">
    <article><section class="section hero" id="home">
            <div class="container">

                <div class="hero-content">
                    <h2 class="h1 hero-title">Bine ai venit pe Short Link! <img src="images/exem.png " id="exem" </img></h2>

                <div class="hero-banner">
                    <img src="images/short.png" loop muted autoplay  id="carvideo" ></img>

                </div>

<form action="shorten.php" method="POST" class="hero-form" id="heroForm" onsubmit="return validateForm();">
    <div class="input-wrapper">
        <label for="input-1" class="input-label">Paste a long URL</label>
        <input type="text" name="link-url" id="input-1" class="input-field"
               placeholder="Example: http://long-link-for-short.com/short-it">
    </div>
    <button type="submit" class="btn" id="sign">Get your link for Free</button>
    <div class="popup" id="popup">
        <div class="popup-content">
            <button id="closePopup"><ion-icon name="close-outline"></ion-icon></button>
            <div id="popupContent"></div>
        </div>
    </div>
</form>
<div id="errorMessage"></div><br>
            </div>
        </section>
        </article>
        </main>';
}
else {
    require 'header.php';
    echo '<main>
    <article><section class="section hero" id="home">
            <div class="container">

                <div class="hero-content">
                    <h2 class="h1 hero-title">WELCOME TO Short Link! <img src="images/Shortlog.png " id="exemlog" </img></h2>
                  


                </div>

                <div class="hero-banner">
                    <img src="images/short.png" loop muted autoplay  id="carvideo" ></img>

                </div>

<form action="" method="POST" class="hero-form" id="heroForm" onsubmit="return validateForm1();">
    <div class="input-wrapper">
        <label for="input-1" class="input-label">Paste a long URL</label>
        <input type="text" name="link-url" id="input-1" class="input-field"
               placeholder="Example: http://long-link-for-short.com/short-it">
    </div>
    <button type="submit" class="btn" id="signing">Sign up and get your link</button>
    <div class="popup" id="popup">
        <div class="popup-content">
            <button id="closePopup"><ion-icon name="close-outline"></ion-icon></button>
            <div id="popupContent"></div>
        </div>
    </div>
</form>
<div id="errorMessage"></div><br>
            </div>
        </section>
        </article>
        </main>';
}
?>

<script>
    // Verifică dacă există un URL salvat în localStorage
    window.addEventListener('load', () => {
        const savedUrl = localStorage.getItem('link-url');
        if (savedUrl) {
            document.getElementById('input-1').value = savedUrl;
            localStorage.removeItem('link-url');

            // Retrimite formularul automat
            document.getElementById('heroForm').submit();
        }
    });

    function isValidURL(url) {
        try {
            const newUrl = new URL(url);
            return (newUrl.protocol === "http:" || newUrl.protocol === "https:") ;//&&
              //  (newUrl.hostname.endsWith('.com') || newUrl.hostname.endsWith('.ru') ||newUrl.hostname.endsWith('') );
        } catch (_) {
            return false;
        }
    }

    function checkLogin() {
        var loggedIn = <?php echo isset($_SESSION['firstname']) ; ?>;

        if (!loggedIn) {
            const togglePopupButton = document.getElementById('sign');
            const closePopupButton = document.getElementById('closePopup');
            const popup = document.getElementById('popup');
            const popupContent = document.getElementById('popupContent');

            // Salvează URL-ul în localStorage
            const url = document.getElementById('input-1').value.trim();
            localStorage.setItem('link-url', url);

            togglePopupButton.addEventListener('click', (event) => {
                event.preventDefault(); // Previne trimiterea formularului

                if (popup.style.display === 'block') {
                    popup.style.display = 'none';
                    popupContent.innerHTML = '';
                    fetch('close.php');
                } else {
                    popup.style.display = 'block';
                    const iframe = document.createElement('iframe');
                    iframe.src = 'autentificare_pop_up.php';
                    iframe.style.width = '100%';
                    iframe.style.height = '550px';
                    popupContent.appendChild(iframe);
                }
            });

            closePopupButton.addEventListener('click', () => {
                popup.style.display = 'none';
                popupContent.innerHTML = '';
                window.location.reload();
            });

            window.addEventListener('message', function(event) {
                if (event.data === 'closePopup') {
                    document.getElementById('popup').style.display = 'none';
                    window.location.reload();
                }
            });

            return false;
        }
        return true;
    }

    function validateForm() {
        const url = document.getElementById('input-1').value.trim();
        const errorMessage = document.getElementById('errorMessage');

        if (url === '' || !isValidURL(url)) {
            errorMessage.textContent = 'Please enter a valid URL starting with http: and ending with .com or .ru.';
            errorMessage.style.display = 'block';
            return false;
        }

        return checkLogin();

    }

</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const savedUrl = localStorage.getItem('link-url');
        if (savedUrl) {
            document.getElementById('input-1').value = savedUrl;
            localStorage.removeItem('link-url');
            document.getElementById('heroForm').submit();
        }
    });

    function isValidURL(url) {
        try {
            const newUrl = new URL(url);
            return (newUrl.protocol === "http:" || newUrl.protocol === "https:"); //&&
               // (newUrl.hostname.endsWith('.com') || newUrl.hostname.endsWith('.ru'));
        } catch (_) {
            return false;
        }
    }

    function checkLogin() {
        const loggedIn = <?php echo isset($_SESSION['firstname']) ? 'true' : 'false'; ?>;

        if (!loggedIn) {
            const togglePopupButton = document.getElementById('signing');
            const closePopupButton = document.getElementById('closePopup');
            const popup = document.getElementById('popup');
            const popupContent = document.getElementById('popupContent');

            const url = document.getElementById('input-1').value.trim();
            localStorage.setItem('link-url', url);

            togglePopupButton.addEventListener('click', (event) => {
                event.preventDefault();
                if (popup.style.display === 'block') {
                    popup.style.display = 'none';
                    popupContent.innerHTML = '';
                } else {
                    popup.style.display = 'block';
                    const iframe = document.createElement('iframe');
                    iframe.src = 'autentificare_pop_up.php';
                    iframe.style.width = '100%';
                    iframe.style.height = '550px';
                    popupContent.appendChild(iframe);
                }
            });

            closePopupButton.addEventListener('click', () => {
                popup.style.display = 'none';
                popupContent.innerHTML = '';
                window.location.reload();
            });

            window.addEventListener('message', function(event) {
                if (event.data === 'closePopup') {
                    document.getElementById('popup').style.display = 'none';
                    window.location.reload();
                }
            });

            return false;
        }
        return true;
    }

    function validateForm1() {
        const url = document.getElementById('input-1').value.trim();
        const errorMessage = document.getElementById('errorMessage');

        if (url === '' || !isValidURL(url)) {
            errorMessage.textContent = 'Please enter a valid URL starting with http: and ending with .com or .ru.';
            errorMessage.style.display = 'block';

            return false;
        }

        errorMessage.textContent = 'URL is valid, redirecting to login...';
        errorMessage.style.color = 'green';
        errorMessage.style.display = 'block';

        localStorage.setItem('link-url', url); // Salvăm URL-ul în localStorage pentru a fi accesibil în iframe-ul de autentificare

        // Deschidem pop-up-ul de autentificare
        const popup = document.getElementById('popup');
        const popupContent = document.getElementById('popupContent');
        const iframe = document.createElement('iframe');
        iframe.src = 'autentificare_pop_up.php';
        iframe.style.width = '100%';
        iframe.style.height = '550px';
        popupContent.appendChild(iframe);
        popup.style.display = 'block';

        return false;
    }



</script>