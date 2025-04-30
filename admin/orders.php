<?php
require_once __DIR__ . '/../incl/header.php';
require_once __DIR__ . '/../database/OrderDB.php';

// Načtení všech objednávek i s informací o uživateli
$orderDB = new OrderDB();
$orders = $orderDB->getAllOrdersWithUser();

// Načtení a smazání flash zprávy
$flashMessage = $_SESSION['flash_message'] ?? null;
unset($_SESSION['flash_message']);
?>

<div class="container mt-5 text-light">
    <h2>Administrace objednávek</h2>
    <br>

    <!-- Flash message (např. po změně stavu nebo smazání) -->
    <?php if ($flashMessage): ?>
        <div class="alert alert-success" style="max-width: 300px;">
            <?= htmlspecialchars($flashMessage) ?>
        </div>
    <?php endif; ?>

    <!-- Tabulka objednávek -->
    <table class="table table-dark table-bordered table-hover mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Uživatel</th>
                <th>Datum</th>
                <th>Stav</th>
                <th>Celkem</th>
                <th>Akce</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['order_id'] ?></td>
                    <td><?= htmlspecialchars($order['user_name']) ?></td>
                    <td><?= $order['order_date'] ?></td>

                    <!-- Formulář pro změnu stavu objednávky -->
                    <td>
                        <form method="POST" action="update_order_status.php" class="d-flex gap-1">
                            <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                            <select name="status" class="form-select form-select-sm">
                                <?php foreach (['unconfirmed', 'confirmed', 'shipped', 'cancelled'] as $status): ?>
                                    <option value="<?= $status ?>" <?= $order['status'] === $status ? 'selected' : '' ?>>
                                        <?= ucfirst($status) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <button class="btn btn-sm btn-warning">Uložit</button>
                        </form>
                    </td>

                    <!-- Cena -->
                    <td><?= $order['total_price'] ?> gold</td>

                    <!-- Smazání objednávky -->
                    <td>
                        <a href="delete_order.php?order_id=<?= $order['order_id'] ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Opravdu chceš smazat tuto objednávku?')">
                           Smazat
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../incl/footer.php'; ?>
