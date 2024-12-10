<?php
echo '<header>';
echo '<a href="index.php" class="home-link">Powrót na stronę główną</a>';
echo '</header>';
?>

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

// Pobranie głównego filmu
$sql = "SELECT plik, nazwa, opis, tagi FROM filmy WHERE id_filmiku = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

echo '<link rel="stylesheet" href="video.css">';
echo '<div class="container">';

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $video_file = $row['plik'];
    $video_title = $row['nazwa'];
    $video_desc = $row['opis'];
    $video_tags = $row['tagi'];

    echo '<div class="main-player">';
    echo "<h1>$video_title</h1>";
    echo "<video controls><source src='$video_file' type='video/mp4'></video>";
    echo "<p>$video_desc</p>";
    echo "<p><strong>Tagi:</strong> $video_tags</p>";
    echo '</div>';
} else {
    echo '<div class="main-player">';
    echo "<h1>Film nie znaleziony</h1>";
    echo '</div>';
}

// Pobranie innych filmów 
// ZAMIEN NA FILMIKI Z TAKIMI SAMYMI TAGAMI LUB JAK NIE ISTNIEJA TO NAJBARDZIEJ POPULARNE idk taki pomysl mi przyszedl do glowy 
$sql_sidebar = "SELECT id_filmiku, plik, nazwa FROM filmy WHERE id_filmiku != ? LIMIT 5";
$stmt_sidebar = $conn->prepare($sql_sidebar);
$stmt_sidebar->bind_param("i", $id);
$stmt_sidebar->execute();
$result_sidebar = $stmt_sidebar->get_result();

echo '<div class="sidebar">';
if ($result_sidebar && $result_sidebar->num_rows > 0) {
    while ($row = $result_sidebar->fetch_assoc()) {
        $sidebar_id = $row['id_filmiku'];
        $sidebar_file = $row['plik'];
        $sidebar_title = $row['nazwa'];

        echo '<div class="sidebar-item">';
        echo "<a href='?id=$sidebar_id'>";
        echo "<video><source src='$sidebar_file' type='video/mp4'></video>";
        echo "<p>$sidebar_title</p>";
        echo "</a>";
        echo '</div>';
    }
}
echo '</div>'; // sidebar

echo '</div>'; // container

$conn->close();
?>

<link rel="stylesheet" href="video.css">