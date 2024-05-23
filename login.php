<?php
include_once 'config.php';
include 'header.php';
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
</head>
<body>
    <h2>Bejelentkezés</h2>
    <?php
        // Ellenőrizze, hogy a felhasználó már be van-e jelentkezve
        
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: index.php");
        exit;
    }
    // Kapcsolódás az adatbázishoz
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // Ellenőrizze a kapcsolatot
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Ellenőrizze, hogy a formát elküldték-e
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ellenőrizze, hogy minden kötelező mezőt kitöltöttek-e
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            // Ellenőrizze a felhasználót az adatbázisban
            $username = $_POST['username'];
            $password = $_POST['password'];
            $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
            $result = $conn->query($sql);
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if(password_verify($password, $row['password'])){
                    // Sikeres bejelentkezés, indítsa el a munkamenetet
                   
                    // Tartsa nyilván a munkamenet adatait
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $row['id'];
                    $_SESSION["username"] = $username;
                    // Irányítsa a felhasználót a köszöntő oldalra
                    header("location: index.php");
                } else{
                    // Hibás jelszó
                    echo "Hibás felhasználónév vagy jelszó.";
                }
            } else {
                // Nincs ilyen felhasználó
                echo "Hibás felhasználónév vagy jelszó.";
            }
        } else {
            // Hiányzó felhasználónév vagy jelszó
            echo "Kérjük, töltse ki mindkét mezőt.";
        }
    }
    
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Felhasználónév: <input type="text" name="username"><br>
        Jelszó: <input type="password" name="password"><br>
        <input type="submit" value="Bejelentkezés">
    </form>
    <body>
        <!-- A regisztrációra mutató link -->
    <p>Még nem vagy regisztrálva? <a href="register.php">Regisztrálj most!</a></p>
    <p>Vissza a kezdőképernyőre: <a href="index.php">Kezdőlap</a></p>
   </body>
</body>
</html>
