<?php
// Načtení autoloaderu Composeru pro knihovnu league/oauth2-client
require_once __DIR__ . '/vendor/autoload.php';

session_start(); // Spuštění session pro uložení stavového tokenu

// Nastavení OAuth 2.0 poskytovatele (Google)
$provider = new League\OAuth2\Client\Provider\Google([
    'clientId'     => 'xx',
    'clientSecret' => 'xx',
    'redirectUri'  => 'http://localhost/schd22/sp/oauth_callback.php', // URL, kam Google přesměruje po přihlášení
]);

// Vytvoření URL pro přihlášení přes Google
$authUrl = $provider->getAuthorizationUrl();

// Uložení náhodného stavu do session pro ochranu proti CSRF útoku
$_SESSION['oauth2state'] = $provider->getState();

// Přesměrování uživatele na Google přihlašovací stránku
header('Location: ' . $authUrl);
exit;
