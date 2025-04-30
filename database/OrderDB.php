<?php
require_once 'Database.php';
require_once 'CartDB.php';

class OrderDB extends Database {

    // Vytvoří objednávku z aktuálního obsahu košíku daného uživatele
    public function createOrderFromCart($userId) {
        $this->connection->beginTransaction(); // Začátek transakce

        $cartDB = new CartDB();
        $cartItems = $cartDB->getCartItemsWithDetails($userId);

        if (empty($cartItems)) {
            throw new Exception("Košík je prázdný.");
        }

        // Vytvoření nové objednávky
        $stmt = $this->connection->prepare("
            INSERT INTO sp_orders (user_id, order_date, status) 
            VALUES (?, NOW(), 'unconfirmed')
        ");
        $stmt->execute([$userId]);
        $orderId = $this->connection->lastInsertId();

        // Vložení všech položek objednávky
        foreach ($cartItems as $item) {
            $stmt = $this->connection->prepare("
                INSERT INTO sp_order_items (order_id, product_id, quantity, price)
                VALUES (?, ?, ?, ?)
            ");
            $stmt->execute([
                $orderId,
                $item['product_id'],
                $item['quantity'],
                $item['price']
            ]);
        }

        // Vyprázdnění košíku po vytvoření objednávky
        $cartDB->clearCart($userId);

        $this->connection->commit(); // Potvrzení transakce
    }

    // Vrací seznam objednávek daného uživatele včetně celkové ceny
    public function getOrdersByUser($userId) {
        $stmt = $this->connection->prepare("
            SELECT o.*, 
                   IFNULL(SUM(oi.quantity * oi.price), 0) AS total_price
            FROM sp_orders o
            LEFT JOIN sp_order_items oi ON o.order_id = oi.order_id
            WHERE o.user_id = ?
            GROUP BY o.order_id
            ORDER BY o.order_date DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Vrací detail konkrétní objednávky včetně položek
    public function getOrderDetail($orderId) {
        $stmt = $this->connection->prepare("
            SELECT * FROM sp_orders WHERE order_id = ?
        ");
        $stmt->execute([$orderId]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$order) return null;

        // Načte položky dané objednávky
        $stmt = $this->connection->prepare("
            SELECT oi.quantity, oi.price, p.name, p.url
            FROM sp_order_items oi
            JOIN sp_products p ON oi.product_id = p.product_id
            WHERE oi.order_id = ?
        ");
        $stmt->execute([$orderId]);
        $order['items'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $order;
    }

    // Vrací počet objednávek zadaného uživatele
    public function getOrderCount($userId) {
        $stmt = $this->connection->prepare("
            SELECT COUNT(*) as count
            FROM sp_orders
            WHERE user_id = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchColumn();
    }

    // Vrací celkovou utracenou částku uživatele za všechny objednávky
    public function getOrderTotal($userId) {
        $stmt = $this->connection->prepare("
            SELECT IFNULL(SUM(oi.quantity * oi.price), 0) as total
            FROM sp_orders o
            JOIN sp_order_items oi ON o.order_id = oi.order_id
            WHERE o.user_id = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchColumn();
    }

    // Vrací seznam všech objednávek v systému včetně jména uživatele a celkové ceny
    public function getAllOrdersWithUser() {
        $stmt = $this->connection->prepare("
            SELECT o.*, u.name AS user_name,
                   IFNULL(SUM(oi.quantity * oi.price), 0) AS total_price
            FROM sp_orders o
            JOIN sp_users u ON o.user_id = u.user_id
            LEFT JOIN sp_order_items oi ON o.order_id = oi.order_id
            GROUP BY o.order_id
            ORDER BY o.order_date DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Změní stav objednávky (např. na confirmed, shipped apod.)
    public function updateOrderStatus($orderId, $status) {
        $stmt = $this->connection->prepare("UPDATE sp_orders SET status = ? WHERE order_id = ?");
        $stmt->execute([$status, $orderId]);
    }

    // Smaže objednávku i všechny její položky (transakčně)
    public function deleteOrder($orderId) {
        $this->connection->beginTransaction();

        // Smazání položek objednávky
        $stmt = $this->connection->prepare("DELETE FROM sp_order_items WHERE order_id = ?");
        $stmt->execute([$orderId]);

        // Smazání samotné objednávky
        $stmt = $this->connection->prepare("DELETE FROM sp_orders WHERE order_id = ?");
        $stmt->execute([$orderId]);

        $this->connection->commit();
    }
}
