<?php
include_once 'config.php';


// Függvény a felhasználó bejelentkezésének ellenőrzésére
function checkLoggedIn() {
    return isset($_SESSION['username']);
}


// Menüpontok megjelenítése
if (!function_exists('displayMenu')) {
    function displayMenu($menuItems) {
        $menuHTML = '<ul>';
        foreach ($menuItems as $item) {
            $menuHTML .= '<li><a href="' . $item['link'] . '">' . $item['text'] . '</a></li>';
        }
        $menuHTML .= '</ul>';
        return $menuHTML;
    }
}


// Felhasználó adatainak megjelenítése
function displayUserInfo() {
    if (checkLoggedIn()) {
        return "Bejelentkezett: " . $_SESSION[''] . " " . $_SESSION['username'];
    }
}
?>
