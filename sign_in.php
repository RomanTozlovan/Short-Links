<?php
session_start();

// Conectare la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "short_link";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexiune esuata: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password1 = mysqli_real_escape_string($conn, $_POST['password1']);

    if ($password !== $password1) {
        echo "Parolele nu se potrivesc.";
    } elseif (strlen($password) < 6) {
        echo "Parola trebuie să aibă cel puțin 6 caractere.";
    } else {
        $sql = "SELECT * FROM user WHERE login='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "Email-ul este deja utilizat.";
        } else {
            // Inserarea utilizatorului în baza de date
            $sql = "INSERT INTO user (name, surname, login, password) VALUES ('$firstname', '$lastname', '$email', '$password')";

            if ($conn->query($sql) === TRUE) {
                // Obținerea ID-ului utilizatorului nou creat
                $user_id = $conn->insert_id;

                // Setarea sesiunii
                $_SESSION['firstname'] = $firstname;
                $_SESSION['user_id'] = $user_id;

                echo "Înregistrarea a fost realizată cu succes.";
                // Redirecționare sau altă logică după înregistrare
            } else {
                echo "Eroare: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

$conn->close();
?>



