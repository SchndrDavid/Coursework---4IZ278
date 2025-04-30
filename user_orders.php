<?php
require_once 'incl/header.php';
require_once 'database/OrderDB.php';

// Inicializace instance OrderDB pro práci s objednávkami
$orderDB = new OrderDB();

// Získání všech objednávek aktuálně přihlášeného uživatele
$orders = $orderDB->getOrdersByUser($_SESSION['user_id']);
?>

<div class="container mt-5">
    <h2 class="text-warning mb-4">Moje objednávky</h2>

    <?php if (empty($orders)): ?>
        <!-- Zpráva pro uživatele, pokud zatím nemá žádné objednávky -->
        <div class="alert alert-info">Zatím jste nevytvořil žádné objednávky.</div>
    <?php else: ?>
        <!-- Přehled objednávek v tabulce -->
        <div class="table-responsive">
            <table class="table table-dark table-hover border border-secondary rounded-3 overflow-hidden align-middle">
                <thead class="table-dark border-bottom border-secondary">
                    <tr>
                        <th>#</th>
                        <th>Datum</th>
                        <th>Stav</th>
                        <th>Celková cena</th>
                        <th>Akce</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <!-- ID objednávky -->
                            <td class="text-warning"><?= htmlspecialchars($order['order_id']) ?></td>
                            
                            <!-- Datum vytvoření objednávky -->
                            <td><?= htmlspecialchars($order['order_date']) ?></td>
                            
                            <!-- Stav objednávky s barevným odlišením -->
                            <td>
                                <?php
                                $status = $order['status'];
                                $badgeClass = match ($status) {
                                    'confirmed' => 'success',
                                    'shipped' => 'primary',
                                    'cancelled' => 'danger',
                                    'unconfirmed' => 'secondary',
                                    default => 'light'
                                };
                                ?>
                                <span class="badge bg-<?= $badgeClass ?>">
                                    <?= htmlspecialchars($status) ?>
                                </span>
                            </td>

                            <!-- Celková cena objednávky -->
                            <td><strong><?= $order['total_price'] ?> gold</strong></td>
                            
                            <!-- Tlačítko pro zobrazení detailu objednávky -->
                            <td>
                                <a href="order.php?id=<?= $order['order_id'] ?>" class="btn btn-sm btn-outline-warning">
                                    Zobrazit
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php
// Načtení společné patičky (např. copyright)
include 'incl/footer.php';
?>
