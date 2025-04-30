<?php
// Spuštění session pro práci s přihlášeným uživatelem a flash zprávou
session_start();

// Načtení databázové třídy pro práci s košíkem
require_once 'database/CartDB.php';

// Kontrola: požadavek musí být typu POST a musí obsahovat ID produktu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {

    // Načtení ID uživatele ze session
    $userId = $_SESSION['user_id'];

    // Načtení ID produktu z formuláře
    $productId = $_POST['product_id'];

    // Inicializace třídy CartDB a zajištění existence košíku
    $cartDB = new CartDB();
    $cartId = $cartDB->getOrCreateCartId($userId);

    // Přidání položky nebo navýšení množství, pokud už v košíku existuje
    $cartDB->addOrIncrementItem($cartId, $productId);

    // Uložení flash zprávy
    $_SESSION['flash_message'] = "Předmět byl přidán do košíku.";

    // Přesměrování zpět na původní stránku
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;

}
