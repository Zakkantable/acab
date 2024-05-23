<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
</head>
<body>
    <h2>Regisztráció</h2>
    <?php
    include_once 'config.php';
    include 'header.php'; 
// Ellenőrizze, hogy a formát elküldték-e
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ellenőrizze, hogy minden kötelező mezőt kitöltöttek-e
        if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['firstname']) && !empty($_POST['lastname'])) {
            // Kapcsolódás az adatbázishoz
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            // Ellenőrizze a kapcsolatot
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            // Ellenőrizze, hogy a felhasználónév egyedi-e
            $username = $_POST['username'];
            $sql = "SELECT id FROM users WHERE username='$username'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "Ez a felhasználónév már foglalt.";
            } else {
                // Új felhasználó hozzáadása az adatbázishoz
                $username = $_POST['username'];
                $password = $_POST['password']; // Biztonsági okokból meg kell fontolni a jelszó hashelését!
                // Hash-elés
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $teljes_nev = $_POST['teljes_nev'];
                                $sql = "INSERT INTO users (username, password, teljes_nev) VALUES ('$username', '$hashed_password', '$teljes_nev')";
                if ($conn->query($sql) === TRUE) {
                    echo "Sikeres regisztráció. Most már bejelentkezhet.";
                } else {
                    echo "Hiba: " . $sql . "<br>" . $conn->error;
                }
            }
            $conn->close();
        } else {
            echo "Kérjük, töltse ki az összes mezőt.";
        }
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Felhasználónév: <input type="text" name="username"><br>
        Jelszó: <input type="password" name="password"><br>
        Vezetéknév: <input type="text" name="firstname"><br>
        Keresztnév: <input type="text" name="lastname"><br>
        <input type="submit" value="Regisztráció">
    </form>
    <p>Vissza a kezdőképernyőre: <a href="index.php">Kezdőlap</a></p>
</body>
</html>
