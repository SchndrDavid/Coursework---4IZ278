<?php
// Načtení přihlašovacích údajů a konfigurace k databázi
require_once 'database-config.php';

class DatabaseConnection {
    // Statická proměnná pro uchování instance PDO (singleton pattern)
    private static $pdo;

    // Vrací instanci PDO, pokud ještě neexistuje, vytvoří nové připojení
    public static function getPDOConnection() {
        if (!self::$pdo) {
            // Vytvoření nové PDO instance
            self::$pdo = new PDO(
                "mysql:host=" . DB_SERVER_URL . ';dbname=' . DB_DATABASE,
                DB_USERNAME,
                DB_PASSWORD
            );

            // Nastavení výchozího režimu fetchování na asociativní pole
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            // Zapnutí výjimek při chybách (pro lepší debugování)
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        // Vrácení instance PDO
        return self::$pdo;
    }
}
