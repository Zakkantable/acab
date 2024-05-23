<?php
// upload.php
session_start();


// Ellenőrizzük, hogy be van-e jelentkezve a felhasználó
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Ha nincs bejelentkezve, hibaüzenetet küldünk és kilépünk
    echo "Hiba: Nincs engedélyezve a képfeltöltés. Kérem, először jelentkezzen be.";
    exit;
}

// Ellenőrizzük, hogy a form elküldésekor meg lett-e adva a fileToUpload mező
if (!isset($_FILES["fileToUpload"])) {
    echo "Hiba: Hiányzó fájl.";
    exit;
}

// Méretkorlát ellenőrzése
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Hiba: A fájl mérete túl nagy.";
    exit;
}

// Engedélyezett fájltípusok ellenőrzése
$allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
$uploadedFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
if (!in_array($uploadedFileType, $allowedTypes)) {
    echo "Hiba: Csak JPG, JPEG, PNG és GIF fájlok engedélyezettek.";
    exit;
}

// Fájl feltöltése a feltöltések mappába
$targetDir = "uploads/";
$targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
    echo "A fájl feltöltése sikeres volt: " . basename($_FILES["fileToUpload"]["name"]);
} else {
    echo "Hiba történt a fájl feltöltése közben.";
}
?>
