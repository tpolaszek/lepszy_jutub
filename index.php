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
            <h1><a href="login.php"><img src="user.png" alt="Login"></a></h1>
        <?php endif; ?>
    </div>

        <?php
        $username = "root";
        $password = "";
        $servername = "localhost";
        $db = "bilibili";

        $conn = new mysqli($servername, $username, $password, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql_random = "SELECT plik, nazwa, opis, tagi FROM filmy ORDER BY RAND() LIMIT 1";
        $result_random = $conn->query($sql_random);

        if ($result_random && $result_random->num_rows > 0) {
            $row_random = $result_random->fetch_assoc();
            $video_random = $row_random['plik'];
            $title_random = $row_random['nazwa'];
            $desc_random = $row_random['opis'];
            $tags = $row_random['tagi'];

			echo "<div class='main_video'>";
            echo "<video width='1080px' height='640px' controls><source src='$video_random' type='video/mp4'></video>";
            echo "<div class='title'>$title_random</div>";
            echo "<div class='desc'>$desc_random</div>";
            echo "<div class='desc'>$tags</div>";
			echo "</div>";
        } else {
            echo "No random video found.";
        }

        $sql_all = "SELECT plik, nazwa, opis, tagi FROM filmy";
        $result_all = $conn->query($sql_all);

        if ($result_all && $result_all->num_rows > 0) {
            echo "<h2>Wszystkie filmiki</h2>";
            echo "<div class='video-grid'>";
            while ($row_all = $result_all->fetch_assoc()) {
                $video_all = $row_all['plik'];
                $title_all = $row_all['nazwa'];
                $desc_all = $row_all['opis'];
                $tags = $row_all['tagi'];
                
                echo "<div class='video-item'>";
                echo "<video width='360px' height='180px' controls><source src='$video_all' type='video/mp4'></video>";
                echo "<div class='title'>$title_all</div>";
                echo "<div class='desc'>$desc_all</div>";
                echo "<div class='desc'>$tags</div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "Nie znaleziono żadnych filmików";
        }

        $conn->close();
        ?>

    </body> 
</html>
