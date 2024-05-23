<?php
session_start();
include_once 'config.php';
include_once 'navbar.php';

 // $menuItems definíciója

// A displayMenu() függvény azután legyen definiálva, hogy a $menuItems tömb már létezik


?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Segítech Látni</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Segítech Látni</h1>
        <nav class="navbar navbar-dark bg-dark">
            <div class="container">
                <?php echo displayMenu($menuItems); ?>
                <?php echo displayUserInfo(); ?>
            </div>
        </nav>
    </header>
    <main>
