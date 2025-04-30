<?php
require_once 'database/CartDB.php';

// Spuštění session kvůli přístupu k datům uživatele (např. user_id)
session_start();

// Zkontrolujeme, zda byl požadavek odeslán metodou POST a je nastavený item_id
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id'])) {

    // Inicializace instance CartDB
    $cartDB = new CartDB();

    // Odstranění položky z košíku podle ID
    $cartDB->removeItem($_POST['item_id']);

    // Přesměrování zpět na stránku košíku po odstranění
    header('Location: cart.php');
    exit;
}
