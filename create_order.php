<?php
// Spuštění session kvůli přihlášení a flash zprávám
session_start();

// Načtení databázové třídy pro objednávky
require_once 'database/OrderDB.php';

// Kontrola, zda je uživatel přihlášen
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Vytvoření instance OrderDB a přenesení položek z košíku do objednávky
$orderDB = new OrderDB();
$orderDB->createOrderFromCart($_SESSION['user_id']);

// Nastavení úspěšné flash zprávy
$_SESSION['flash_message'] = "Objednávka byla úspěšně vytvořena!";

// Přesměrování zpět na stránku košíku
header('Location: cart.php');
exit;
