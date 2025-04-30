<?php
// Načtení základní konfigurace a rozhraní pro práci s databází
require_once 'database-config.php';
require_once 'DatabaseConnection.php';

// Abstraktní třída pro dědění – poskytuje základní databázové funkce
abstract class Database {
    // PDO připojení k databázi
    protected $connection;

    // Název tabulky – očekává se, že ho nastaví potomková třída
    protected $tableName;

    // Konstruktor naváže spojení přes singleton DatabaseConnection
    public function __construct() {
        $this->connection = DatabaseConnection::getPDOConnection();
    }

    // Základní SELECT * FROM tabulka
    public function find() {
        $sql = "SELECT * FROM $this->tableName";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    // SELECT * FROM tabulka WHERE sloupec = hodnota (hodnota je binda)
    public function findBy($field, $value) {
        $sql = "SELECT * FROM $this->tableName WHERE $field = :value";
        $statement = $this->connection->prepare($sql);
        $statement->execute(['value' => $value]);
        return $statement->fetchAll();
    }

    // Obecná metoda fetch – momentálně ignoruje $args, může být rozšířena
    public function fetch($args) {
        $sql = "SELECT * FROM $this->tableName;";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
}
