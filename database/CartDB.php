<?php
require_once 'Database.php';

class CartDB extends Database {

    // Vrátí cart_id uživatele nebo vytvoří nový košík, pokud ještě žádný nemá
    public function getOrCreateCartId($userId) {
        $stmt = $this->connection->prepare("SELECT cart_id FROM sp_carts WHERE user_id = ?");
        $stmt->execute([$userId]);
        $cart = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cart) {
            return $cart['cart_id'];
        }

        // Vytvoření nového košíku
        $stmt = $this->connection->prepare("INSERT INTO sp_carts (user_id) VALUES (?)");
        $stmt->execute([$userId]);
        return $this->connection->lastInsertId();
    }

    // Přidá produkt do košíku nebo zvýší množství, pokud už tam je
    public function addOrIncrementItem($cartId, $productId) {
        $stmt = $this->connection->prepare("SELECT cart_item_id FROM sp_cart_items WHERE cart_id = ? AND product_id = ?");
        $stmt->execute([$cartId, $productId]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($item) {
            // Produkt už v košíku je – zvýšíme množství
            $stmt = $this->connection->prepare("UPDATE sp_cart_items SET quantity = quantity + 1 WHERE cart_item_id = ?");
            $stmt->execute([$item['cart_item_id']]);
        } else {
            // Produkt není – vložíme nový záznam
            $stmt = $this->connection->prepare("INSERT INTO sp_cart_items (cart_id, product_id, quantity) VALUES (?, ?, 1)");
            $stmt->execute([$cartId, $productId]);
        }
    }

    // Odebere jednu položku z košíku podle jejího ID
    public function removeItem($itemId) {
        $stmt = $this->connection->prepare("DELETE FROM sp_cart_items WHERE cart_item_id = ?");
        $stmt->execute([$itemId]);
    }

    // Změní množství u dané položky v košíku, minimum je 1 ks
    public function updateItemQuantity($itemId, $quantity) {
        $quantity = max(1, (int)$quantity);
        $stmt = $this->connection->prepare("UPDATE sp_cart_items SET quantity = ? WHERE cart_item_id = ?");
        $stmt->execute([$quantity, $itemId]);
    }

    // Vyprázdní celý košík uživatele (smaže všechny položky)
    public function clearCart($userId) {
        $stmt = $this->connection->prepare("SELECT cart_id FROM sp_carts WHERE user_id = ?");
        $stmt->execute([$userId]);
        $cart = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cart) {
            $cartId = $cart['cart_id'];
            $stmt = $this->connection->prepare("DELETE FROM sp_cart_items WHERE cart_id = ?");
            $stmt->execute([$cartId]);
        }
    }

    // Vrátí všechny položky v košíku uživatele i s detaily o produktu
    public function getCartItemsWithDetails($userId) {
        $stmt = $this->connection->prepare("SELECT cart_id FROM sp_carts WHERE user_id = ?");
        $stmt->execute([$userId]);
        $cart = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$cart) {
            return [];
        }

        $cartId = $cart['cart_id'];

        $stmt = $this->connection->prepare("
            SELECT ci.cart_item_id,
                   ci.quantity AS quantity,
                   p.product_id,
                   p.name,
                   p.price,
                   p.description,
                   p.url,
                   t.name AS type_name
            FROM sp_cart_items ci
            JOIN sp_products p ON ci.product_id = p.product_id
            JOIN sp_type t ON p.type_id = t.type_id
            WHERE ci.cart_id = ?
        ");
        $stmt->execute([$cartId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Vrátí počet položek a celkovou cenu košíku uživatele
    public function getCartStats($userId) {
        $stmt = $this->connection->prepare("SELECT cart_id FROM sp_carts WHERE user_id = ?");
        $stmt->execute([$userId]);
        $cart = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$cart) return ['count' => 0, 'total' => 0];

        $stmt = $this->connection->prepare("
            SELECT SUM(quantity) as count, SUM(quantity * p.price) as total
            FROM sp_cart_items ci
            JOIN sp_products p ON ci.product_id = p.product_id
            WHERE cart_id = ?
        ");
        $stmt->execute([$cart['cart_id']]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Pro administraci – vrátí přehled všech košíků, které mají nějaké položky
    public function getAllCartsWithItems() {
        $stmt = $this->connection->prepare("
            SELECT c.user_id, u.name, COUNT(i.cart_item_id) as item_count, IFNULL(SUM(i.quantity * p.price), 0) as total_price
            FROM sp_carts c
            JOIN sp_users u ON c.user_id = u.user_id
            JOIN sp_cart_items i ON c.cart_id = i.cart_id
            JOIN sp_products p ON i.product_id = p.product_id
            GROUP BY c.user_id
            HAVING item_count > 0
            ORDER BY total_price DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
