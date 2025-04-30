<?php require_once 'incl/header.php'; ?>
<?php
require_once 'database/CartDB.php';
require_once 'database/ProductDB.php';

// Inicializace databází
$cartDB = new CartDB();
$productDB = new ProductDB();

// Načtení údajů z košíku pro přihlášeného uživatele
$userId = $_SESSION['user_id'];
$cartItems = $cartDB->getCartItemsWithDetails($userId);

// Zobrazení flash zprávy (např. po vytvoření objednávky)
$flashMessage = $_SESSION['flash_message'] ?? null;
unset($_SESSION['flash_message']);

// Výpočty pro souhrn
$totalItems = 0;
$uniqueItems = count($cartItems);
$totalPrice = 0;
?>

<!-- OBSAH STRÁNKY: Košík -->
<div class="container-fluid mt-5 text-light">
    <div class="row">
        <!-- LEVÝ SLOUPEC: Výpis produktů v košíku -->
        <div class="col-md-9">
            <h3 class="text-warning mb-4">Váš košík</h3>

            <!-- Pokud je košík prázdný -->
            <?php if (empty($cartItems)): ?>
                <div class="alert alert-info">Košík je prázdný.</div>
            <?php endif; ?>

            <!-- Iterace přes položky v košíku -->
            <?php foreach ($cartItems as $item): 
                $totalItems += $item['quantity'];
                $totalPrice += $item['price'] * $item['quantity'];
            ?>
                <div class="card bg-dark text-light mb-3 border-secondary shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <!-- Obrázek produktu -->
                        <img src="<?= htmlspecialchars($item['url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="height: 80px; width: 80px; object-fit: contain;" class="me-4 rounded border border-secondary bg-secondary bg-opacity-25">

                        <!-- Informace o produktu -->
                        <div class="flex-grow-1">
                            <h5 class="mb-1 text-warning">
                                <a href="product.php?id=<?= $item['product_id'] ?>" class="text-warning text-decoration-none">
                                    <?= htmlspecialchars($item['name']) ?>
                                </a>
                            </h5>
                            <p class="mb-1 small"><?= htmlspecialchars($item['description']) ?></p>
                            <p class="mb-1"><strong><?= $item['price'] ?> zlata</strong></p>
                            <p class="mb-1 small">Typ: <?= htmlspecialchars($item['type_name']) ?></p>
                        </div>

                        <!-- Formulář pro změnu množství -->
                        <form method="POST" action="update_amount.php" class="d-flex gap-2 align-items-center">
                            <input type="hidden" name="item_id" value="<?= $item['cart_item_id'] ?>">
                            <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" class="form-control form-control-sm" style="width: 70px;">
                            <button type="submit" class="btn btn-sm btn-outline-warning">Uložit</button>
                        </form>

                        <!-- Formulář pro odstranění položky -->
                        <form method="POST" action="remove_from_cart.php" class="ms-2">
                            <input type="hidden" name="item_id" value="<?= $item['cart_item_id'] ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger">Odebrat</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- PRAVÝ SLOUPEC: Souhrn -->
        <div class="col-md-3">
            <!-- Statistika položek -->
            <div class="bg-dark text-light border border-secondary p-3 mb-3 rounded">
                <h6 class="text-warning">Celkový počet položek</h6>
                <div class="fw-bold fs-5"><?= $totalItems ?></div>
            </div>

            <div class="bg-dark text-light border border-secondary p-3 mb-3 rounded">
                <h6 class="text-warning">Počet unikátních produktů</h6>
                <div class="fw-bold fs-5"><?= $uniqueItems ?></div>
            </div>

            <div class="bg-dark text-light border border-secondary p-3 mb-4 rounded">
                <h6 class="text-warning">Celková cena</h6>
                <div class="fw-bold fs-5"><?= $totalPrice ?> zlata</div>
            </div>

            <!-- Akce: vyprázdnit nebo vytvořit objednávku -->
            <div class="d-grid gap-2">
                <form method="POST" action="remove_cart.php">
                    <button type="submit" class="btn btn-danger">Vyprázdnit košík</button>
                </form>

                <form method="POST" action="create_order.php">
                    <button type="submit" class="btn btn-success">Vytvořit objednávku</button>
                </form>
            </div>

            <!-- Flash zpráva po akci -->
            <?php if ($flashMessage): ?>
                <div class="alert alert-success mt-4">
                    <?= htmlspecialchars($flashMessage) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'incl/footer.php'; ?>
