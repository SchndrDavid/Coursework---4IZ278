<?php
require_once 'database/CartDB.php';

// Spuštění session pro práci s přihlášeným uživatelem a flash zprávami
session_start();

// Pokud uživatel není přihlášený, přesměrujeme ho na login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Inicializace instance CartDB
$cartDB = new CartDB();

// Vyprázdnění košíku pro daného uživatele
$cartDB->clearCart($_SESSION['user_id']);

// Nastavení flash zprávy pro potvrzení akce
$_SESSION['flash_message'] = "Košík byl úspěšně vyprázdněn.";

// Přesměrování zpět na stránku košíku
header('Location: cart.php');
exit;
