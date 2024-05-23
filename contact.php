<?php
include_once 'config.php';
include 'header.php';

// Adatbázis kapcsolat
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Űrlap adatok feldolgozása és mentése az adatbázisba
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Adatok megszerzése az űrlapról
    $name = isset($_POST['name']) ? $_POST['name'] : 'Vendég';
    $email = $_POST['email'];
    $message = $_POST['message'];
    $created_at = date('Y-m-d H:i:s'); // Aktuális dátum és idő

    // SQL utasítás az adatok beszúrására az adatbázisba
    $sql = "INSERT INTO messages (username, email, message, created_at) VALUES ('$name', '$email', '$message', '$created_at')";

    if ($conn->query($sql) === TRUE) {
        // Sikeres adatbázis művelet esetén átirányítjuk a felhasználót az ötödik oldalra
        header('Location: display_message.php');
        exit;
    } else {
        echo "Hiba az adatok beszúrása közben: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kapcsolat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Kapcsolat Űrlap</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="name">Név:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="message">Üzenet:</label><br>
        <textarea id="message" name="message" rows="4" required></textarea><br>
        <input type="submit" value="Küldés">
        <a href="display_message.php" class="button">Üzenetek megtekintése</a>
    </form>
</body>
</html>
