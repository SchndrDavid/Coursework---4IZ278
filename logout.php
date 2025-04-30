<?php
// Spuštění session pro práci s uživatelskými daty
session_start();

// Vymazání všech session proměnných
$_SESSION = [];

// Zrušení celé session
session_destroy();

// Přesměrování na úvodní stránku
header('Location: index.php');
exit();
