<?php require_once 'Database.php'; ?>

<?php
class ClassDB extends Database {
    // Název tabulky – může se hodit pro případné obecné metody v rodičovské třídě
    protected $tableName = 'sp_classes';

    // Vrátí seznam všech specializací (classes)
    public function getAllClasses() {
        $stmt = $this->connection->prepare("SELECT * FROM sp_classes");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Vrátí jednu specializaci podle ID
    public function getClassById($classId) {
        $stmt = $this->connection->prepare("SELECT * FROM sp_classes WHERE class_id = ?");
        $stmt->execute([$classId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
