<?php
require_once 'database/ProductDB.php';
require_once 'database/UsersDB.php';

$productDB = new ProductDB();
$userDB = new UsersDB();

$isLoggedIn = isset($_SESSION['user_id']);
$user = null;
$filterClassId = null;

// Pokud je uživatel přihlášený a má zapnutý filtr, omezíme výpis na jeho class_id
if ($isLoggedIn) {
    $user = $userDB->getUserById($_SESSION['user_id']);
    if (!empty($user['filter'])) {
        $filterClassId = $user['class_id'];
    }
}

// Flash message po akci (např. přidání do košíku)
$flashMessage = $_SESSION['flash_message'] ?? null;
unset($_SESSION['flash_message']);

// Parametry z URL (filtry, řazení, hledání)
$section = $_GET['section'] ?? null;
$searchTerm = $_GET['search'] ?? null;
$sort = $_GET['sort'] ?? null;
$classId = isset($_GET['class_id']) ? (int)$_GET['class_id'] : null;
$typeId = isset($_GET['type_id']) ? (int)$_GET['type_id'] : null;

// Počet produktů na stránku a offset pro stránkování
$itemsPerPage = 50;
$pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($pageNumber - 1) * $itemsPerPage;


// Výběr produktů podle hledání nebo obecně
if ($searchTerm) {
    $productsAll = $productDB->searchProducts($searchTerm, $sort, $filterClassId, $classId, $typeId, $section);
} else {
    $productsAll = $productDB->getAllFull($sort, $filterClassId, $classId, $typeId, $section);
}

// Spočítej počet stránek a ořízni pole produktů podle aktuální stránky
$totalProducts = count($productsAll);
$numberOfPages = ceil($totalProducts / $itemsPerPage);
$products = array_slice($productsAll, $offset, $itemsPerPage);

?>

<!-- HTML část – obsahuje vyhledávání, řazení a výpis karet produktů -->
<div class="col-md-10">
    <!-- Vyhledávací formulář -->
    <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
        <form class="d-flex gap-2" method="GET" action="index.php">
            <input class="form-control search-input" type="search" name="search" placeholder="Hledat předmět..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">

            <select name="sort" class="form-select w-auto">
                <option value="">Řazení</option>
                <option value="asc" <?= ($_GET['sort'] ?? '') === 'asc' ? 'selected' : '' ?>>Cena: od nejnižší</option>
                <option value="desc" <?= ($_GET['sort'] ?? '') === 'desc' ? 'selected' : '' ?>>Cena: od nejvyšší</option>
                <option value="rarity" <?= ($_GET['sort'] ?? '') === 'rarity' ? 'selected' : '' ?>>Vzácnost: od běžné</option>
                <option value="rarity_desc" <?= ($_GET['sort'] ?? '') === 'rarity_desc' ? 'selected' : '' ?>>Vzácnost: od legendární</option>
            </select>

            <!-- Skryté přeposílání aktivních filtrů -->
            <?php if (isset($_GET['class_id'])): ?>
                <input type="hidden" name="class_id" value="<?= htmlspecialchars($_GET['class_id']) ?>">
            <?php endif; ?>
            <?php if (isset($_GET['type_id'])): ?>
                <input type="hidden" name="type_id" value="<?= htmlspecialchars($_GET['type_id']) ?>">
            <?php endif; ?>
            <?php if (isset($_GET['section'])): ?>
                <input type="hidden" name="section" value="<?= htmlspecialchars($_GET['section']) ?>">
            <?php endif; ?>

            <button class="btn btn-secondary" type="submit">Hledat</button>
        </form>
    </div>

    <!-- Flash message -->
    <?php if ($flashMessage): ?>
        <div class="alert alert-success" style="max-width: 300px;">
            <?= htmlspecialchars($flashMessage) ?>
        </div>
    <?php endif; ?>           

    <!-- Výpis produktů ve formě kartiček -->
    <div class="d-flex flex-wrap gap-3 justify-content-start">
        <?php foreach ($products as $product): ?>
            <div class="item-card bg-dark text-light rounded-1 p-3 shadow-sm <?= strtolower($product['rarity']) ?>"
                 style="width: 210px; height: 300px; display: flex; flex-direction: column; justify-content: space-between;">
                 
                <div class="text-center">
                    <!-- Obrázek -->
                    <div class="border border-dark rounded mb-1" style="height: 90px; display: flex; align-items: center; justify-content: center;">
                        <img src="<?= htmlspecialchars($product['url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" style="height: 85px; object-fit: contain;">
                    </div>

                    <!-- Název produktu -->
                    <h6 class="rarity-name mb-1 <?= strtolower($product['rarity']) ?>" style="font-size: 1.2rem;">
                        <?= htmlspecialchars($product['name']) ?>
                    </h6>

                    <!-- Třída -->
                    <div class="mb-1" style="font-size: 0.85rem;">
                        <?= htmlspecialchars($product['class_name']) ?><br>
                    </div>

                    <!-- Cena -->
                    <div class="fw-bold text-light mb-2">
                        <?= $product['price'] ?> Gold
                    </div>
                </div>

                <!-- Tlačítka: Detail a Přidat do košíku -->
                <div class="d-flex gap-2 mt-auto">
                    <a href="product.php?id=<?= $product['product_id'] ?>" class="btn btn-sm btn-outline-warning flex-grow-1">
                        Detail
                    </a>
                    <?php if ($isLoggedIn): ?>
                        <form method="POST" action="add_to_cart.php">
                            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                            <button type="submit" class="btn btn-sm btn-success px-3">+</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<nav>
    <ul class="pagination justify-content-center mt-4">
    <?php for ($i = 1; $i <= $numberOfPages; $i++): ?>
        <li class="page-item <?= ($i == $pageNumber) ? 'active' : '' ?>">
            <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>">
                <?= $i ?>
            </a>
        </li>
    <?php endfor; ?>
    </ul>
</nav>
