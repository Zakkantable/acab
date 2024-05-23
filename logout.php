<?php
session_start();
// Indítsa el a munkamenetet

// Törölje a munkamenet összes változóját
$_SESSION = array();
// Törölje a munkamenetet
session_destroy();
// Átirányítás a bejelentkezési oldalra
header("location: login.php");
exit;
?>
