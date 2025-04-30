<?php
require_once __DIR__ . '/../incl/header.php';
require_once __DIR__ . '/../database/CartDB.php';
require_once __DIR__ . '/../database/UsersDB.php';

// Načtení a smazání flash zprávy (zobrazí se jednorázově)
$flashMessage = $_SESSION['flash_message'] ?? null;
unset($_SESSION['flash_message']);

// Kontrola oprávnění – pouze administrátor
if (!isset($_SESSION['privilege']) || $_SESSION['privilege'] < 2) {
    header("Location: ../index.php");
    exit;
}

// Inicializace databázových tříd
$cartDB = new CartDB();
$userDB = new UsersDB();

// Získání všech aktivních košíků, které mají položky
$carts = $cartDB->getAllCartsWithItems();
?>

<!-- OBSAH STRÁNKY -->
<div class="container mt-4 text-light">
    <div class="d-flex justify-content-between mb-4">
        <h2>Správa košíků</h2>
    </div>

    <!-- Flash zpráva po akci (např. vyprázdnění košíku) -->
    <?php if ($flashMessage): ?>
        <div class="alert alert-success" style="max-width: 300px;">
            <?= htmlspecialchars($flashMessage) ?>
        </div>
    <?php endif; ?>  

    <!-- Informace, pokud nejsou žádné aktivní košíky -->
    <?php if (empty($carts)): ?>
        <div class="alert alert-info">Žádné aktivní košíky s položkami.</div>

    <!-- Výpis tabulky košíků -->
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-dark table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Vlastník košíku</th>
                        <th>Počet položek</th>
                        <th>Celková cena</th>
                        <th>Akce</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($carts as $cart): ?>
                        <tr>
                            <td><?= htmlspecialchars($cart['name']) ?></td>
                            <td><?= $cart['item_count'] ?></td>
                            <td><?= $cart['total_price'] ?> gold</td>
                            <td>
                                <!-- Formulář pro vyprázdnění košíku (odesílá user_id) -->
                                <form method="POST" action="admin_remove_cart.php" onsubmit="return confirm('Opravdu chcete košík vyprázdnit?');">
                                    <input type="hidden" name="user_id" value="<?= $cart['user_id'] ?>">
                                    <button class="btn btn-sm btn-danger">Vyprázdnit košík</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../incl/footer.php'; ?>
