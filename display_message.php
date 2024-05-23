<?php
include_once 'config.php';
include_once 'header.php'; 
// Adatbázis kapcsolódás
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Ellenőrizzük a kapcsolatot
if ($conn->connect_error) {
    die("Sikertelen kapcsolódás: " . $conn->connect_error);
}

// SQL lekérdezés az üzenetek lekérésére
$sql = "SELECT username, email, message, created_at FROM messages ORDER BY created_at DESC";
$result = $conn->query($sql);

// Ellenőrizzük az eredményt
if ($result->num_rows > 0) {
    // Adatok megjelenítése
    while($row = $result->fetch_assoc()) {
        echo "<p><strong>Név:</strong> " . $row["username"]. " - <strong>E-mail:</strong> " . $row["email"]. " - <strong>Üzenet:</strong> " . $row["message"]. " - <strong>Időpont:</strong> " . $row["created_at"]. "</p>";
    }
} else {
    echo "Nincsenek üzenetek.";
}

// Bezárjuk az adatbázis kapcsolatot
$conn->close();
?>
