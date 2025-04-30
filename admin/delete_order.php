<?php
// Spuštění session kvůli kontrole práv a flash zprávě
session_start();

// Načtení databázové třídy pro objednávky
require_once __DIR__ . '/../database/OrderDB.php';

// Kontrola přístupu – pouze administrátor má právo mazat objednávky
if (!isset($_SESSION['privilege']) || $_SESSION['privilege'] < 2) {
    header('Location: ../index.php');
    exit;
}

// Kontrola, jestli bylo zadáno order_id v URL
if (isset($_GET['order_id'])) {
    $orderId = (int) $_GET['order_id']; // bezpečné převedení na číslo

    $orderDB = new OrderDB();

    // Volání metody pro smazání objednávky
    $orderDB->deleteOrder($orderId);

    // Nastavení flash zprávy
    $_SESSION['flash_message'] = "Objednávka č. $orderId byla smazána.";
}

// Přesměrování zpět na přehled objednávek
header('Location: orders.php');
exit;
