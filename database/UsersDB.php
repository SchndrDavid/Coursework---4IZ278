<?php require_once 'Database.php'; ?>

<?php
// Třída pro práci s uživatelskou tabulkou sp_users
class UsersDB extends Database {
    protected $tableName = 'sp_users';

    // Vytvoří nového uživatele (při registraci)
    public function create($args) {
        $sql = "INSERT INTO {$this->tableName} (email, password, name, class_id, privilege_id) VALUES (:email, :password, :name, :class_id, :privilege_id)";
        $statement = $this->connection->prepare($sql);
        $statement->execute([
            ':email' => $args['email'],
            ':password' => $args['password'],
            ':name' => $args['name'],
            ':class_id' => $args['class_id'],
            ':privilege_id' => $args['privilege_id'],
        ]);
    }

    // Najde uživatele podle e-mailu (používá se při přihlašování nebo registraci)
    public function findOneByEmail($email) {
        $sql = "SELECT * FROM {$this->tableName} WHERE email = :email";
        $statement = $this->connection->prepare($sql);
        $statement->execute([':email' => $email]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    // Smaže uživatele podle ID (využívá admin)
    public function deleteUser($userId) {
        $stmt = $this->connection->prepare("DELETE FROM sp_users WHERE user_id = ?");
        $stmt->execute([$userId]);
    }

    // Nastaví privilegium uživateli podle e-mailu (starší metoda)
    public function setPrivilege($email, $privilege_id) {
        $sql = "UPDATE {$this->tableName} SET privilege_id = :privilege_id WHERE email = :email";
        $statement = $this->connection->prepare($sql);
        $statement->execute([
            ':privilege_id' => $privilege_id,
            ':email' => $email,
        ]);
    }

    // Vrací základní informace o všech uživatelích (pro tabulku v admin zóně)
    public function getAllUsers() {
        $stmt = $this->connection->prepare("SELECT user_id, name, email, privilege_id FROM sp_users ORDER BY name");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Získá jen privilegium (číslo) daného uživatele podle e-mailu
    public function getPrivilege($email) {
        $sql = "SELECT privilege_id FROM {$this->tableName} WHERE email = :email";
        $statement = $this->connection->prepare($sql);
        $statement->execute([':email' => $email]);
        return $statement->fetchColumn();
    }

    // Vrací všechny uživatele (nepoužívá se, redundantní s getAllUsers)
    public function findAll() {
        $sql = "SELECT * FROM {$this->tableName}";
        return $this->connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Aktualizuje privilegium uživatele podle jeho ID
    public function updatePrivilege($userId, $privilege) {
        $stmt = $this->connection->prepare("UPDATE sp_users SET privilege_id = ? WHERE user_id = ?");
        $stmt->execute([$privilege, $userId]);
    }

    // Alternativa ke deleteUser – smaže uživatele podle ID pomocí pojmenovaného parametru
    public function deleteById($userId) {
        $stmt = $this->connection->prepare("DELETE FROM {$this->tableName} WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $userId]);
    }

    // Vrací detail uživatele podle jeho ID
    public function getUserById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM sp_users WHERE user_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Upraví class_id uživatele (specializace) – používá se v nastavení profilu
    public function updateUserClass($userId, $classId) {
        $stmt = $this->connection->prepare("UPDATE sp_users SET class_id = ? WHERE user_id = ?");
        $stmt->execute([$classId, $userId]);
    }

    // Nastaví filtr podle class_id (zapnutí/vypnutí automatického filtrování podle specializace)
    public function updateFilterPreference($userId, $filter) {
        $stmt = $this->connection->prepare("UPDATE sp_users SET filter = ? WHERE user_id = ?");
        return $stmt->execute([$filter ? 1 : 0, $userId]);
    }
}
?>
