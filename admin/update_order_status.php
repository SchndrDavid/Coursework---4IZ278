<?php
// Spuštění session kvůli ověření práv a flash message
session_start();
require_once __DIR__ . '/../database/OrderDB.php';

// Kontrola oprávnění – pouze administrátor
if (!isset($_SESSION['privilege']) || $_SESSION['privilege'] < 2) {
    header('Location: ../index.php');
    exit;
}

// Zpracování POST požadavku na změnu stavu objednávky
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['order_id'];
    $status = $_POST['status'];

    // Aktualizace stavu objednávky v databázi
    $orderDB = new OrderDB();
    $orderDB->updateOrderStatus($orderId, $status);
}

// Flash zpráva a přesměrování zpět na přehled objednávek
$_SESSION['flash_message'] = "Order was updated.";
header('Location: orders.php');
exit;
