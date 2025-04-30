<?php
// Hlavička stránky a databáze
require_once 'incl/header.php';
require_once __DIR__ . '/database/ProductDB.php';
require_once __DIR__ . '/database/ClassDB.php';
require_once __DIR__ . '/database/TypeDB.php';

// Flash message (např. po přidání do košíku nebo uložení změn)
$flashMessage = $_SESSION['flash_message'] ?? null;
unset($_SESSION['flash_message']);

// Kontrola, zda je ID produktu v URL
if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>Produkt nebyl nalezen.</div>";
    require_once 'incl/footer.php';
    exit;
}

$productId = (int)$_GET['id'];
$productDB = new ProductDB();
$product = $productDB->getProductById($productId);

// Pokud produkt neexistuje
if (!$product) {
    echo "<div class='alert alert-danger'>Produkt neexistuje.</div>";
    require_once 'incl/footer.php';
    exit;
}

// Načtení podobných produktů (např. stejná classa)
$similar = $productDB->getSimilarProducts($product['class_id'], $product['product_id']);

// Kontrola, zda má uživatel administrátorská práva
$isAdmin = isset($_SESSION['privilege']) && $_SESSION['privilege'] >= 2;

// Potřebné seznamy pro výběr (admin část)
$classDB = new ClassDB();
$typeDB = new TypeDB();
$classes = $classDB->getAllClasses();
$types = $typeDB->getAllTypes();
?>

<div class="container mt-4 text-light">
    <div class="row">
        <div class="col-md-8">
            <?php if ($isAdmin): ?>
                <!-- ADMIN FORMULÁŘ PRO ÚPRAVU PRODUKTU -->
                <form method="POST" action="admin/update_product.php">
                    <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">

                    <!-- Základní informace -->
                    <label class="form-label">Název</label>
                    <input name="name" class="form-control mb-2" value="<?= htmlspecialchars($product['name']) ?>">

                    <label class="form-label">Popis</label>
                    <textarea name="description" class="form-control mb-2"><?= htmlspecialchars($product['description']) ?></textarea>

                    <label class="form-label">Cena</label>
                    <input name="price" type="number" class="form-control mb-2" value="<?= $product['price'] ?>">

                    <label class="form-label">URL obrázku</label>
                    <input name="url" class="form-control mb-2" value="<?= htmlspecialchars($product['url']) ?>">

                    <!-- Výběry: class, type, rarity -->
                    <label class="form-label">Specializace</label>
                    <select name="class_id" class="form-select mb-2">
                        <?php foreach ($classes as $class): ?>
                            <option value="<?= $class['class_id'] ?>" <?= $class['class_id'] == $product['class_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($class['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label class="form-label">Typ</label>
                    <select name="type_id" class="form-select mb-3">
                        <?php foreach ($types as $type): ?>
                            <option value="<?= $type['type_id'] ?>" <?= $type['type_id'] == $product['type_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($type['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label class="form-label">Vzácnost</label>
                    <select name="rarity" class="form-select mb-3">
                        <?php foreach (['common', 'rare', 'epic', 'legendary'] as $rarity): ?>
                            <option value="<?= $rarity ?>" <?= $product['rarity'] === $rarity ? 'selected' : '' ?>>
                                <?= $rarity ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <!-- Akce: uložit nebo smazat -->
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Uložit změny</button>
                        <a href="admin/delete_product.php?good_id=<?= $product['product_id'] ?>"
                           class="btn btn-danger"
                           onclick="return confirm('Opravdu chceš smazat tento produkt?');">
                           Smazat produkt
                        </a>
                    </div>
                </form>

            <?php else: ?>
                <!-- UŽIVATELSKÝ DETAIL PRODUKTU -->
                <h2 class="text-warning"><?= htmlspecialchars($product['name']) ?></h2>
                <p><?= htmlspecialchars($product['description']) ?></p>

                <div class="row">
                    <!-- Obrázek produktu -->
                    <div class="col-md-6">
                        <img src="<?= htmlspecialchars($product['url']) ?>" class="img-fluid border border-secondary rounded">
                    </div>

                    <!-- Informace o produktu -->
                    <div class="col-md-6">
                        <p><strong>Class:</strong> <?= htmlspecialchars($product['class_name']) ?></p>
                        <p><strong>Type:</strong> <?= htmlspecialchars($product['type_name']) ?></p>
                        <p><strong>Cena:</strong> <?= $product['price'] ?> gold</p>

                        <!-- Přidání do košíku -->
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <form method="POST" action="add_to_cart.php">
                                <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                <button class="btn btn-warning w-100">Přidat do košíku</button>
                            </form>
                            <?php if ($flashMessage): ?>
                                <div class="alert alert-success mt-3">
                                    <?= htmlspecialchars($flashMessage) ?>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="alert alert-info">Pro přidání do košíku se musíte přihlásit.</div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- PODOBNÉ PRODUKTY -->
        <div class="col-md-4">
            <h4 class="text-light">Podobné předměty</h4>
            <?php foreach ($similar as $s): ?>
                <div class="card bg-dark text-light mb-3">
                    <div class="card-body text-center">
                        <a href="product.php?id=<?= $s['product_id'] ?>" class="text-decoration-none text-warning">
                            <img src="<?= htmlspecialchars($s['url']) ?>" style="height: 60px;"><br>
                            <?= htmlspecialchars($s['name']) ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php
// Patička stránky
require_once 'incl/footer.php';
?>
