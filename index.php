<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="favicon.png">
        <title>Lepszy Jutub</title>
    </head>
    
    <body>
    <?php
    session_start();
    ?>

    <div class="header">
        <?php if (isset($_SESSION['username'])): ?>
            <div class="user-info">
                <h1><a href="upload.php"><img src="upload_icon.png"/></a></h1>
                <span>Witaj, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                
                <form action="logout.php" method="post" style="display:inline;">
                    <button type="submit" class="logout-btn">Wyloguj się</button>
                </form>
            </div>
        <?php else: ?>
            <h1><a href="login.php"><img src="user.png" alt="Login"></a></h1><br>
        <?php endif; ?>
       
    </div>
    
    </div><br>
    <?php
    $username = "root";
    $password = "";
    $servername = "localhost";
    $db = "bilibili";

    // Połączenie z bazą danych
    $conn = new mysqli($servername, $username, $password, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Zapytanie o losowy film
    $sql_random = "SELECT id_filmiku, plik, nazwa FROM filmy ORDER BY RAND() LIMIT 1";
    $result_random = $conn->query($sql_random);

    if ($result_random && $result_random->num_rows > 0) {
        
        $row_random = $result_random->fetch_assoc();
        $id_filmiku = $row_random['id_filmiku']; 
        $video_random = $row_random['plik'];
        $title_random = $row_random['nazwa'];
        echo "<div style='margin-top:110px;'></div>";
        echo "<a href='video.php?id=" . $id_filmiku . "'>";
        echo "<div class='main_video'>";
        
        echo "<video controls><source src='$video_random' type='video/mp4'></video>";
        
        echo "<div class='title'>$title_random</div>";
        echo "</div>";
        echo "</a>";
    } else {
        echo "Nie znaleziono żadnego filmu.";
    }
    ?>

    <?php
    $sql_all = "SELECT id_filmiku, plik, nazwa, wyswietlenia
                FROM filmy
                ORDER BY wyswietlenia DESC";  
    $result_all = $conn->query($sql_all);

    if ($result_all && $result_all->num_rows > 0) {
        echo "<div class='video-grid-container'>";
        echo "<div class='video-grid'>";
        
        while ($row_all = $result_all->fetch_assoc()) {
            $id_filmiku = $row_all['id_filmiku']; 
            $video_all = $row_all['plik'];
            $title_all = $row_all['nazwa'];
            $wyswietlenia_all = $row_all['wyswietlenia'];

            echo "<a href='video.php?id=" . $id_filmiku . "'>";
            echo "<div class='video-item'>";
            echo "<video controls><source src='$video_all' type='video/mp4'></video>";
            echo "<div class='title'>$title_all</div>";
            echo "<div class='views'>Wyświetlenia: $wyswietlenia_all</div>"; 
            echo "</div>";
            echo "</a>";
        }
        
        echo "</div></div>";
    } else {
        echo "Nie znaleziono żadnych filmików";
    }
    ?>

    </body> 
</html>
