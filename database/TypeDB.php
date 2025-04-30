<?php require_once 'Database.php'; ?>

<?php
// Třída pro práci s tabulkou typů předmětů (sp_type)
class TypeDB extends Database {
    // Název databázové tabulky
    protected $tableName = 'sp_type';

    // Vrací všechny záznamy z tabulky sp_type
    public function getAllTypes() {
        $stmt = $this->connection->prepare("SELECT * FROM sp_type");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
