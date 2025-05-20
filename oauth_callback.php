<?php
// Načtení knihoven a DB třídy
require_once __DIR__ . '/vendor/autoload.php';
require_once 'database/UsersDB.php';
session_start();

// Nastavení OAuth poskytovatele (Google)
$provider = new League\OAuth2\Client\Provider\Google([
    'clientId'     => 'xx',
    'clientSecret' => 'xx',
    'redirectUri'  => 'http://localhost/schd22/sp/oauth_callback.php',
]);

// Pokud chybí kód v URL, přihlášení bylo zrušeno nebo selhalo
if (!isset($_GET['code'])) {
    exit('Přístup byl zamítnut.');
}

try {
    // Získání access tokenu od Googlu pomocí autorizačního kódu
    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);

    // Načtení informací o uživateli z Google účtu
    $user = $provider->getResourceOwner($token)->toArray();

    // Získání potřebných údajů z odpovědi
    $email = $user['email'];
    $name = $user['name'];
    $oauthId = $user['sub']; // Unikátní ID uživatele od Googlu
    $oauthProvider = 'google';

    // Připojení k databázi uživatelů
    $usersDB = new UsersDB();

    // Hledání existujícího uživatele podle OAuth údajů
    $existingUser = $usersDB->findByOAuth($oauthProvider, $oauthId);

    // Pokud uživatel neexistuje, vytvoříme nový účet
    if (!$existingUser) {
        $usersDB->createOAuth([
            'email' => $email,
            'name' => $name,
            'oauth_provider' => $oauthProvider,
            'oauth_id' => $oauthId,
            'class_id' => 1,         // Výchozí class_id
            'privilege_id' => 1,     // Výchozí privilegium
        ]);
        // Znovu načteme uživatele, abychom získali jeho user_id
        $existingUser = $usersDB->findByOAuth($oauthProvider, $oauthId);
    }

    // Uložení údajů do session = přihlášení uživatele
    $_SESSION['user'] = $existingUser['name'];
    $_SESSION['user_id'] = $existingUser['user_id'];
    $_SESSION['privilege'] = $existingUser['privilege_id'];

    // Přesměrování na hlavní stránku
    header('Location: index.php');
    exit;

} catch (\Exception $e) {
    // Zachycení chyby při přihlašování
    exit('Přihlášení selhalo: ' . $e->getMessage());
}
?>
