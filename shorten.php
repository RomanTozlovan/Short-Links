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

$user_id = $_SESSION['user_id'];
$original_url = $_POST['link-url'];
$short_url = generateShortURL();
$visits = '0';

$sql = "INSERT INTO urls (user_id, original_url, short_url, visits) VALUES ('$user_id', '$original_url', '$short_url', '$visits')";
if ($conn->query($sql) === TRUE) {
    header("Location: links.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

function generateShortURL() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    $length = 10;

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}
?>

