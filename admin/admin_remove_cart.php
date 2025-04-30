<?php
session_start();
require_once __DIR__ . '/../database/CartDB.php';

// Kontrola práv administrátora
if (!isset($_SESSION['privilege']) || $_SESSION['privilege'] < 2) {
    header('Location: ../index.php');
    exit;
}

// Kontrola POST požadavku a user_id
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $userId = (int)$_POST['user_id'];

    $cartDB = new CartDB();
    $cartDB->clearCart($userId);

    $_SESSION['flash_message'] = "Košík uživatele byl úspěšně vyprázdněn.";
    header('Location: carts.php');
    exit;
}

// Pokud není POST nebo chybí user_id
$_SESSION['flash_message'] = "Chybný požadavek.";
header('Location: carts.php');
exit;
