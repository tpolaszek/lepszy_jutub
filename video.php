<?php
// Połączenie z bazą danych
$username = "root";
$password = "";
$servername = "localhost";
$db = "bilibili";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pobranie ID filmu z URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT plik, nazwa, opis, tagi FROM filmy WHERE id_filmiku = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $video_file = $row['plik'];
    $video_title = $row['nazwa'];
    $video_desc = $row['opis'];
    $video_tags = $row['tagi'];

    echo "<h1>$video_title</h1>";
    echo "<video width='1080px' height='640px' controls><source src='$video_file' type='video/mp4'></video>";
    echo "<p>$video_desc</p>";
    echo "<p><strong>Tagi:</strong> $video_tags</p>";
} else {
    echo "<h1>Film nie znaleziony</h1>";
}
?>
<link rel="stylesheet" href="style.css">
