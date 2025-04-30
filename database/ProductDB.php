<?php require_once 'Database.php'; ?>

<?php
class ProductDB extends Database {
    // Název tabulky, využívaný například pro generické metody (např. find)
    protected $tableName = 'sp_products';

    // Vrátí všechny produkty (jen jejich class_id a type_id) – používá se pro strukturování v kategoriích
    public function getAllProducts() {
        $stmt = $this->connection->prepare("SELECT class_id, type_id FROM {$this->tableName}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Přidá nový produkt do databáze
    public function addProduct($name, $description, $price, $url, $classId, $typeId, $rarity = 'common') {
        $stmt = $this->connection->prepare("
            INSERT INTO sp_products (name, description, price, url, class_id, type_id, rarity)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$name, $description, $price, $url, $classId, $typeId, strtolower($rarity)]);
    }

    // Vrací všechny produkty s možností filtrování a řazení
    public function getAllFull($sort = null, $filterClass = null, $classId = null, $typeId = null, $section = null) {
        $sql = "
            SELECT p.*, c.name AS class_name, t.name AS type_name, t.section
            FROM sp_products p
            JOIN sp_classes c ON p.class_id = c.class_id
            JOIN sp_type t ON p.type_id = t.type_id
            WHERE 1=1
        ";
    
        $params = [];

        // Dynamické filtrování podle různých parametrů
        if ($filterClass !== null) {
            $sql .= " AND p.class_id = ?";
            $params[] = $filterClass;
        }

        if ($classId !== null) {
            $sql .= " AND p.class_id = ?";
            $params[] = $classId;
        }

        if ($typeId !== null) {
            $sql .= " AND p.type_id = ?";
            $params[] = $typeId;
        }

        if ($section !== null) {
            $sql .= " AND t.section = ?";
            $params[] = $section;
        }

        // Připojí řazení
        $sql .= $this->buildSortQuery($sort);

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Vrátí detail produktu podle ID (včetně názvu specializace a typu)
    public function getProductById($id) {
        $stmt = $this->connection->prepare("
            SELECT p.*, c.name AS class_name, t.name AS type_name
            FROM sp_products p
            JOIN sp_classes c ON p.class_id = c.class_id
            JOIN sp_type t ON p.type_id = t.type_id
            WHERE p.product_id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Vrací až 4 náhodné produkty ze stejné specializace kromě zadaného
    public function getSimilarProducts($classId, $excludeId) {
        $stmt = $this->connection->prepare("
            SELECT product_id, name, url 
            FROM sp_products 
            WHERE class_id = ? AND product_id != ? 
            ORDER BY RAND() LIMIT 4
        ");
        $stmt->execute([$classId, $excludeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Vyhledá produkty podle názvu s možností dalšího filtrování
    public function searchProducts($term, $sort = null, $classFilter = null, $classId = null, $typeId = null, $section = null) {
        $sql = "
            SELECT p.*, c.name AS class_name, t.name AS type_name
            FROM sp_products p
            JOIN sp_classes c ON p.class_id = c.class_id
            JOIN sp_type t ON p.type_id = t.type_id
            WHERE p.name LIKE ?
        ";
        $params = ['%' . $term . '%'];

        if ($classFilter !== null) {
            $sql .= " AND p.class_id = ?";
            $params[] = $classFilter;
        }
        if ($classId !== null) {
            $sql .= " AND p.class_id = ?";
            $params[] = $classId;
        }
        if ($typeId !== null) {
            $sql .= " AND p.type_id = ?";
            $params[] = $typeId;
        }
        if ($section !== null) {
            $sql .= " AND t.section = ?";
            $params[] = $section;
        }

        $sql .= $this->buildSortQuery($sort);

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Vytváří SQL úsek pro řazení podle zadaného parametru
    private function buildSortQuery($sort) {
        switch ($sort) {
            case 'asc':
                return ' ORDER BY p.price ASC';
            case 'desc':
                return ' ORDER BY p.price DESC';
            case 'rarity':
                return ' ORDER BY FIELD(p.rarity, "common", "uncommon", "rare", "epic", "legendary") ASC';
            case 'rarity_desc':
                return ' ORDER BY FIELD(p.rarity, "legendary", "epic", "rare", "uncommon", "common") ASC';
            default:
                return '';
        }
    }

    // Aktualizuje záznam produktu
    public function updateProduct($productId, $name, $description, $url, $price, $classId, $typeId, $rarity) {
        $stmt = $this->connection->prepare("
            UPDATE sp_products 
            SET name = ?, description = ?, url = ?, price = ?, class_id = ?, type_id = ?, rarity = ?
            WHERE product_id = ?
        ");
        $stmt->execute([$name, $description, $url, $price, $classId, $typeId, $rarity, $productId]);
    }

    // Smaže produkt z databáze
    public function deleteProduct($productId) {
        $stmt = $this->connection->prepare("DELETE FROM sp_products WHERE product_id = ?");
        $stmt->execute([$productId]);
    }
}
?>
