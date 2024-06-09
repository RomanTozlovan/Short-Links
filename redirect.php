<?php
if (isset($_GET['url'])) {
    $short_url = $_GET['url'];

    // Conectare la baza de date
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

    // Evitare SQL injection
    $short_url = mysqli_real_escape_string($conn, $short_url);

    // Interogare pentru a obține linkul original asociat cu linkul scurt
    $sql = "SELECT original_url, visits FROM urls WHERE short_url = '$short_url'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Obținerea linkului original și numărul actual de vizite
        $row = $result->fetch_assoc();
        $original_url = $row['original_url'];
        $visits = $row['visits'] + 1;

        // Actualizarea numărului de vizite
        $update_sql = "UPDATE urls SET visits = $visits WHERE short_url = '$short_url'";
        $conn->query($update_sql);

        // Redirecționare către linkul original
        header("Location: " . $original_url);


        echo '<script>
                setTimeout(function() {
                    window.location.href = "links.php"; 
                    window.location.reload();
                }, 3000); 
              </script>';
        exit();
    } else {
        echo "Linkul scurt nu există în baza de date.";
    }

    // Închiderea conexiunii la baza de date
    $conn->close();
} else {
    echo "Linkul scurt lipsă.";
}
?>



