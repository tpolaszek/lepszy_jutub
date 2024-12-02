

<DOCTYPE html>
<html lang="pl">
    <head>
        <link rel="stylesheet" href="login.css">
        <meta charset="utf-8">
        <title>Zarejestruj się</title>
    </head>
    <body>
        <div class="return_page">
            <a href="index.php">Wróć na stronę główną</a>
        </div>
        <form action="register.php" method="post" enctype="multipart/form-data">
            Login: <input type="text" name="login" required><br>
            Hasło: <input type="password" name="haslo" required><br>
            <input type="submit" value="Zarejestruj się">
            <?php
                $username = "root";
                $password = "";
                $servername = "localhost";
                $db = "bilibili";
                
                $conn = new mysqli($servername, $username, $password, $db);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                if (isset($_POST["login"]) && isset($_POST["haslo"])) {
                    $login = $_POST["login"];
                    $password = $_POST["haslo"];
                
                    $checkUserSql = "SELECT user_id FROM users WHERE username = ?";
                    $stmt = $conn->prepare($checkUserSql);
                    $stmt->bind_param("s", $login);
                    $stmt->execute();
                    $result = $stmt->get_result();
                
                    if ($result->num_rows > 0) {
                        echo "<div class='account_exists'>Konto o tej nazwie użytkownika już istnieje.</div>";
                    } else {
                        $salted_password = password_hash($password, PASSWORD_DEFAULT);
                        $insertUserSql = "INSERT INTO users (username, password) VALUES (?, ?)";
                        $stmt = $conn->prepare($insertUserSql);
                        $stmt->bind_param("ss", $login, $salted_password);
                
                        if ($stmt->execute()) {
                            echo "Konto zostało pomyślnie utworzone.";
                        } else {
                            echo "Wystąpił błąd podczas tworzenia konta: " . $stmt->error;
                        }
                    }
                
                    $stmt->close();
                }
                
                $conn->close();
            ?>
            
            <p> Masz konto? <a href="login.php">Zaloguj się</a></p>
        </form>
    </body>
</html>