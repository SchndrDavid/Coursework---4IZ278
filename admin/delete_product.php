<?php
session_start();
require_once __DIR__ . '/../database/ProductDB.php';

// Kontrola oprávnění – pouze administrátor (privilege >= 2) může mazat produkty
if (!isset($_SESSION['privilege']) || $_SESSION['privilege'] < 2) {
    $_SESSION['flash_message'] = "Nemáš oprávnění k této akci.";
    header('Location: ../index.php');
    exit();
}

// Kontrola existence a validity ID produktu v URL
if (!isset($_GET['good_id']) || !is_numeric($_GET['good_id'])) {
    $_SESSION['flash_message'] = "Neplatné ID produktu.";
    header('Location: ../index.php');
    exit();
}

// Bezpečně převedeme ID na celé číslo
$goodId = (int) $_GET['good_id'];

// Smazání produktu z databáze
$productDB = new ProductDB();
$productDB->deleteProduct($goodId);

// Flash zpráva o úspěchu
$_SESSION['flash_message'] = "Produkt byl úspěšně smazán.";

// Přesměrování zpět na homepage nebo admin výpis
header('Location: /www/schd22/sp/index.php');
exit();
