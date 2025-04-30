<?php
// Spuštění session pro ověření práv a práci s flash message
session_start();
require_once __DIR__ . '/../database/UsersDB.php';

// Kontrola oprávnění – přístup jen pro admina
if (!isset($_SESSION['privilege']) || $_SESSION['privilege'] < 2) {
    header('Location: ../index.php');
    exit;
}

// Kontrola, zda bylo zadáno validní ID uživatele
if (isset($_GET['user_id']) && is_numeric($_GET['user_id'])) {
    $userId = (int)$_GET['user_id'];

    // Inicializace DB a smazání uživatele
    $usersDB = new UsersDB();
    $usersDB->deleteUser($userId);

    // Flash message o úspěchu
    $_SESSION['flash_message'] = "Uživatel byl úspěšně odstraněn.";
} else {
    // Flash message při chybě
    $_SESSION['flash_message'] = "Neplatné ID uživatele.";
}

// Přesměrování zpět na seznam uživatelů
header('Location: users.php');
exit;
