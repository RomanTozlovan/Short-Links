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