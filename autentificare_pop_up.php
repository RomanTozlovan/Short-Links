<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/autentificare.css">
    <script src="https://kit.fontawesome.com/aa7454d09f.js" crossorigin="anonymous"></script>
</head>
<body>

<section id="section">
    <i class="fa-solid fa-moon themeButton" id="themeBtn"></i>
    <div class="overlay" id="overlay"></div>
    <div class="container">
        <h1 class="heading">Create new account</h1>

        <p class="para"><span class="ask">Already a member?</span><span class="link" id="link">Login</span></p>
        <form id="signupForm" class="form-container">
            <div class="usernameContainer">
                <div class="formGroup">
                    <input type="text" class="input firstname" id="firstname" name="firstname" required>
                    <label for="firstname" class="placeholder">First Name</label>
                </div>
                <div class="formGroup">
                    <input type="text" class="input lastname" id="lastname" name="lastname" required>
                    <label for="lastname" class="placeholder">Last Name</label>
                </div>
            </div>
            <div class="formGroup">
                <input type="text" class="input" id="email" name="email" required>
                <label for="email" class="placeholder">Login</label>
            </div>
            <div class="formGroup">
                <input type="password" class="input" id="signuppassword" name="password" required>
                <label for="signuppassword" class="placeholder">Password</label>
            </div>
            <div class="formGroup">
                <input type="password" class="input" id="repeatpassword" name="password1" required>
                <label for="repeatpassword" class="placeholder">Repeat Password</label>
            </div>
            <div class="btn-container">
                <button type="submit" class="btn btn2" id="closeButton">create account</button>
            </div>
            <div id="errorMessage" style="color: red; display: none;"></div>
        </form>

        <script>
            document.getElementById('signupForm').addEventListener('submit', function(event) {
                event.preventDefault();

                const password = document.getElementById('signuppassword').value;
                const repeatPassword = document.getElementById('repeatpassword').value;
                const errorMessage = document.getElementById('errorMessage');

                if (password.length < 6) {
                    errorMessage.textContent = 'Parola trebuie să aibă cel puțin 6 caractere.';
                    errorMessage.style.display = 'block';
                    return;
                } else if (password !== repeatPassword) {
                    errorMessage.textContent = 'Parolele nu se potrivesc.';
                    errorMessage.style.display = 'block';
                    return;
                } else {
                    errorMessage.style.display = 'none';
                }

                const formData = new FormData(this);

                fetch('sign_in.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.text())
                    .then(data => {
                        if (data.includes('Email-ul este deja utilizat') || data.includes('Parolele nu se potrivesc') || data.includes('Parola trebuie să aibă cel puțin 8 caractere')) {
                            errorMessage.textContent = data;
                            errorMessage.style.display = 'block';
                        } else {

                            window.parent.postMessage('closePopup', '*');

                        }
                    })


                        .catch(error => console.error('Error:', error));
            });



        </script>


        <form class="form-container" id="loginForm">
            <div id="errorMessage1" style="display: none color: red;"></div><br>
            <div class="formGroup">
                <i class="fa-solid fa-envelope inputIcon"></i>
                <input type="text" class="input" id="email" name="email" required>
                <label for="email" class="placeholder">Login</label>
            </div>
            <div class="formGroup">
                <i class="fa-solid fa-eye inputIcon" id="showLoginPassword" onclick="togglePassword()"></i>
                <input type="password" class="input" id="loginpassword" name="password" required>
                <label for="password" class="placeholder">Password</label>
            </div>
            <div class="btn-container">
                <button type="submit" class="btn btn2">Login</button>
            </div>
        </form>


        <script>
            document.getElementById('loginForm').addEventListener('submit', function(event) {
                event.preventDefault();

                const email = document.getElementById('email').value;
                const password = document.getElementById('loginpassword').value;
                const errorMessage1 = document.getElementById('errorMessage1');

                const formData1 = new FormData(this);

                fetch('login.php', {
                    method: 'POST',
                    body: formData1
                })
                    .then(response => response.text())
                    .then(data => {
                        if (data.includes('Autentificare reușită')) {
                            errorMessage1.style.color = 'green';
                            errorMessage1.textContent = data;
                            errorMessage1.style.display = 'block';
                            window.parent.postMessage('closePopup', '*');
                            // Poți închide popup-ul sau redirecționa utilizatorul după succes, dacă e necesar
                        } else {
                            errorMessage1.style.color = 'red';
                            errorMessage1.textContent = data;
                            errorMessage1.style.display = 'block';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        </script>



        <?php
        if (isset($_GET['info']) && $_GET['info'] == 'corect'){
            echo '<p style="text-align: center color: red> Succes </p>';
        }
        ?>
    </div>
</section>

<script src="script/autentificare.js"></script>
<script src="script/close.js"></script>

<script>
    function togglePassword() {
        var passwordInput = document.getElementById('loginpassword');
        var icon = document.getElementById('showLoginPassword');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
</body>
</html>
