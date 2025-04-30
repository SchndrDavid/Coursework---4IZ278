<?php
// Hlavička stránky (navigace, styl, session start)
include 'incl/header.php';

// Načtení třídy pro práci s objednávkami
require_once 'database/OrderDB.php';

// Kontrola, zda bylo zadáno ID objednávky
if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>Nebyla zadána žádná objednávka.</div>";
    include 'incl/footer.php';
    exit;
}

$orderId = $_GET['id'];
$orderDB = new OrderDB();
$order = $orderDB->getOrderDetail($orderId);

// Kontrola, zda objednávka existuje
if (!$order) {
    echo "<div class='alert alert-danger'>Objednávka nebyla nalezena.</div>";
    include 'incl/footer.php';
    exit;
}
?>

<!-- OBSAH STRÁNKY -->
<div class="container mt-5 text-light">

    <!-- Informace o objednávce -->
    <div class="card bg-dark border-secondary mb-4 shadow-sm">
        <div class="card-body">
            <h3 class="card-title text-warning">Objednávka č. <?= htmlspecialchars($order['order_id']) ?></h3>
            <p class="card-text mb-0"><strong>Datum:</strong> <?= htmlspecialchars($order['order_date']) ?></p>
            <p class="card-text"><strong>Stav:</strong> <?= htmlspecialchars($order['status']) ?></p>
        </div>
    </div>

    <!-- Položky objednávky -->
    <div class="card bg-dark border-secondary shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">
                    <thead class="text-dark">
                        <tr>
                            <th style="width: 80px;">Obrázek</th>
                            <th>Název</th>
                            <th class="text-center">Množství</th>
                            <th class="text-end">Cena / ks</th>
                            <th class="text-end">Celkem</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                        <?php foreach ($order['items'] as $item): ?>
                            <?php
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                            ?>
                            <tr>
                                <td>
                                    <img src="<?= htmlspecialchars($item['url']) ?>" alt="" class="img-fluid" style="max-height: 50px;">
                                </td>
                                <td><?= htmlspecialchars($item['name']) ?></td>
                                <td class="text-center"><?= $item['quantity'] ?></td>
                                <td class="text-end"><?= $item['price'] ?> gold</td>
                                <td class="text-end fw-bold text-warning"><?= $subtotal ?> gold</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Součet objednávky -->
        <div class="card-footer text-end text-light bg-dark border-top border-secondary">
            <h5 class="mb-0">Celková cena: <span class="text-warning"><?= $total ?> gold</span></h5>
        </div>
    </div>
</div>

<?php
// Patička stránky
include 'incl/footer.php';
?>
