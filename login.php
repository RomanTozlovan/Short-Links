<?php
session_start();

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT name, id, is_admin FROM user WHERE login ='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $user_data = mysqli_fetch_assoc($result);
        $firstname = $user_data['name'];
        $id = $user_data['id'];
        $is_admin = $user_data['is_admin'];
        $_SESSION['firstname'] = $user_data['name'];
        $_SESSION['user_id'] = $user_data['id'];
        if($is_admin == 1) {
            $_SESSION['is_admin'] = $user_data['is_admin'];
        }
        http_response_code(200);
        echo "Autentificare reușită! Bine ai revenit, $id!";
    } else {
        http_response_code(401);
        echo "Email sau parolă incorecte. Te rog să încerci din nou.";
    }
}

$conn->close();
?>



