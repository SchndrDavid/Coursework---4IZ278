<?php
// Spuštění session kvůli kontrole práv a flash message
session_start();
require_once __DIR__ . '/../database/ProductDB.php';

// Kontrola oprávnění – přístup pouze pro administrátory
if (!isset($_SESSION['privilege']) || $_SESSION['privilege'] < 2) {
    header('Location: index.php');
    exit;
}

// Zpracování POST požadavku pro úpravu produktu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $url = trim($_POST['url']);
    $price = (float)$_POST['price'];
    $classId = (int)$_POST['class_id'];
    $typeId = (int)$_POST['type_id'];
    $rarity = trim($_POST['rarity']);

    // Aktualizace produktu v databázi
    $productDB = new ProductDB();
    $productDB->updateProduct($productId, $name, $description, $url, $price, $classId, $typeId, $rarity);

    // Flash zpráva a přesměrování zpět na stránku produktu
    $_SESSION['flash_message'] = "Produkt byl úspěšně upraven.";
    header("Location: /www/schd22/sp/product.php?id=$productId");
    exit;
}
