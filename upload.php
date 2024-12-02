<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_FILES['filmik']) && $_FILES['filmik']['error'] == 0) {
            $nazwaPliku = basename($_FILES['filmik']['name']);
            $sciezkaDocelowa = 'uploads/' . $nazwaPliku;
    
            if (move_uploaded_file($_FILES['filmik']['tmp_name'], $sciezkaDocelowa)) {
                $tytul = $_POST['tytul'];
                $opis = $_POST['opis'];
                $tagi = $_POST['tagi'];
                $recipientUsername = $_POST['recipient_username'];
    
                $sql = "INSERT INTO filmy (nazwa, opis, plik, tagi) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $tytul, $opis, $sciezkaDocelowa, $tagi);
    
                if ($stmt->execute()) {
                    $videoId = $conn->insert_id;
                    if (!empty($recipientUsername)) {
                        $sqlRecipient = "SELECT user_id FROM users WHERE username = ?";
                        $stmtRecipient = $conn->prepare($sqlRecipient);
                        $stmtRecipient->bind_param("s", $recipientUsername);
                        $stmtRecipient->execute();
                        $resultRecipient = $stmtRecipient->get_result();
    
                        if ($resultRecipient->num_rows > 0) {
                            $recipientRow = $resultRecipient->fetch_assoc();
                            $recipientId = $recipientRow['user_id'];
    
                            $sharedById = $_SESSION['user_id']; 
    
                            $sqlShare = "INSERT INTO shared_videos (video_id, shared_with_user_id, shared_by_user_id) VALUES (?, ?, ?)";
                            $stmtShare = $conn->prepare($sqlShare);
                            $stmtShare->bind_param("iii", $videoId, $recipientId, $sharedById);
                            $stmtShare->execute();
                        } else {
                            echo "User to share with not found.";
                        }
                    }
    
                    echo "Plik został przesłany i zapisany pomyślnie!";
                } else {
                    echo "Błąd zapisu do bazy: " . $stmt->error;
                }
    
                $stmt->close();
            } else {
                echo "Błąd podczas przesyłania pliku.";
            }
        } else {
            echo "Nieprawidłowy plik lub błąd przesyłania.";
        }
    }
    
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Prześlij filmik</title>
        <link rel="stylesheet" href="upload.css">
    </head>
    <body>
    <a href="index.php">Wróć na stronę główną</a>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        Tytuł: <input type="text" name="tytul" required><br>
        Opis: <input type="text" name="opis" required><br>
        Tagi: <input type="text" name="tagi" required><br>
        Wybierz filmik: <input type="file" name="filmik" accept="video/mp4" required><br>
        Udostępnij użytkownikowi: <input type="text" name="recipient_username"><br>
        <input type="submit" value="Prześlij">
    </form>

    </body>
</html>
