<?php
require_once 'database/CartDB.php';

// Spuštění session kvůli přístupu k $_SESSION proměnným
session_start();

// Kontrola, zda byl formulář odeslán metodou POST a zda jsou dostupné potřebné hodnoty
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id'], $_POST['quantity'])) {

    // Inicializace instance CartDB
    $cartDB = new CartDB();

    // Aktualizace množství dané položky v košíku
    $cartDB->updateItemQuantity($_POST['item_id'], $_POST['quantity']);

    // Přesměrování zpět na stránku košíku po úspěšné aktualizaci
    header('Location: cart.php');
    exit;
}
