<?php
    $username = "root";
    $password = "";
    $servername = "localhost";
    $db = "bilibili";
    $conn = new mysqli($servername, $username, $password, $db);

    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_FILES['filmik']) && $_FILES['filmik']['error'] == 0) {
            $nazwaPliku = basename($_FILES['filmik']['name']);
            $sciezkaDocelowa = 'uploads/' . $nazwaPliku;

            if (move_uploaded_file($_FILES['filmik']['tmp_name'], $sciezkaDocelowa)) {
                $tytul = $_POST['tytul'];
                $opis = $_POST['opis'];
                $tagi = $_POST['tagi'];
                $sql = "INSERT INTO filmy (nazwa, opis, plik, tagi) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $tytul, $opis, $sciezkaDocelowa, $tagi);

                if ($stmt->execute()) {
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
        tagi: <input type="text" name="tagi" required><br>
        Wybierz filmik: <input type="file" name="filmik" accept="video/mp4" required><br>
        <input type="submit" value="Prześlij">
    </form>
    </body>
</html>