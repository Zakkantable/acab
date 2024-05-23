<?php
include_once 'config.php';

// Ellenőrizzük, hogy be van-e jelentkezve a felhasználó
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Ha nincs bejelentkezve, átirányítjuk a felhasználót a bejelentkezési oldalra
    header('Location: login.php');
    exit;
}
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

?>


<h2>Képgaléria</h2>




<di class="image-gallery">
    <?php
    // Megjelenítjük a feltöltött képeket a galériában
    $files = glob('uploads/*.*');
    foreach ($files as $file) {
        echo '<div class="gallery-item">';
        echo '<img src="' . $file . '" alt="Kép">';
        echo '</div>';
    }
    ?>
</di>
<!-- Oldal tartalma: Képgaléria és képfeltöltő űrlap -->
<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) : ?>
    <!-- Ha be van jelentkezve a felhasználó, megjelenítjük a kép feltöltő űrlapot -->
    <h2>Kép feltöltése</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Kép feltöltése" name="submit">
    </form>
<?php endif; ?>


