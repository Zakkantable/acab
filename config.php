<?php
// Adatbázis kapcsolat beállításai
define('DB_HOST', 'localhost');
define('DB_USER', 'acab');
define('DB_PASS', '@CAB2024');
define('DB_NAME', 'acab');

// Menüpontok

$menuItems = array(
    array('text' => 'Kezdőlap', 'link' => 'index.php'),
    array('text' => 'Galéria', 'link' => 'gallery.php'),
    array('text' => 'Kapcsolat', 'link' => 'contact.php'),
    array('text' => 'Bejelentkezés', 'link' => 'login.php'),
    array('text' => 'Kijelentkezés', 'link' => 'logout.php'),
    array('text' => 'Regisztráció', 'link' => 'register.php')
);

//A kezdőlap linkje 
$homelink = 'index.php';



$pages = array(
    'home',
    'gallery',
    'contact',
    'login',
    'logout',
    'register'
);

// Ellenőrizzük, hogy mely oldalt kérte a felhasználó
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// A kért oldal alapján irányítjuk az alkalmazást
switch ($page) {
    case 'login':
        include 'login.php'; // Bejelentkezési oldal
        break;
    case 'register':
        include 'register.php'; // Regisztrációs oldal
        break;
    case 'gallery':
        include 'gallery.php'; // Képgaléria oldal
        break;
    case 'contact':
        include 'contact.php'; // Kapcsolat oldal
        break;
    case 'logout':
        include 'logout.php'; // Kijelentkezési folyamat
        break;
    default:
        include_once 'index.php'; // Alapértelmezett kezdőlap
        break;
}
?>