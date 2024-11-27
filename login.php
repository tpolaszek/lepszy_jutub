<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaloguj się</title>
    <link rel="stylesheet" href="login.css"> 
</head>
    <body>
        <form action="login.php" method="post" enctype="multipart/form-data">
            Login: <input type="text" name="login" required><br>
            Hasło: <input type="password" name="haslo" pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?&quot;:{}|<>])[A-Za-z\d!@#$%^&*(),.?&quot;:{}|<>]{8,}$" required><br>
            <input type="submit" value="Zaloguj się">
            <?php
                $username = "root";
                $password = "";
                $servername = "localhost";
                $db = "bilibili";
                $conn = new mysqli($servername, $username, $password, $db);

                if (isset($_POST["login"]) && isset($_POST["haslo"])) {
                    $login = $_POST["login"];
                    $password = $_POST["haslo"];
                
                    $checkUserSql = "SELECT user_id FROM users WHERE username = ?";
                    $stmt = $conn->prepare($checkUserSql);
                    $stmt->bind_param("s", $login);
                    $stmt->execute();
                    $result = $stmt->get_result();
                
                    if ($result->num_rows > 0){
                        header("Location:index.php");
                    }
                }
            
            ?>
        </form>
    </body>
</html>