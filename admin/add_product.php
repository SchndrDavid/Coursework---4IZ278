<?php
require_once __DIR__ . '/../incl/header.php';
require_once __DIR__ . '/../database/ProductDB.php';
require_once __DIR__ . '/../database/ClassDB.php';
require_once __DIR__ . '/../database/TypeDB.php';

// Kontrola oprávnění (pouze admin může přidávat produkty)
if (!isset($_SESSION['privilege']) || $_SESSION['privilege'] < 2) {
    header("Location: ../index.php");
    exit;
}

$productDB = new ProductDB();
$classDB = new ClassDB();
$typeDB = new TypeDB();

$classes = $classDB->getAllClasses();
$types = $typeDB->getAllTypes();

$flashMessage = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Získání a základní sanitizace vstupů
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = (int)($_POST['price'] ?? 0);
    $url = trim($_POST['img'] ?? '');
    $classId = (int)($_POST['class_id'] ?? 0);
    $typeId = (int)($_POST['type_id'] ?? 0);
    $rarity = $_POST['rarity'] ?? 'common';

    // Validace povinných polí
    if ($name && $price > 0 && $classId && $typeId && filter_var($url, FILTER_VALIDATE_URL)) {
        $productDB->addProduct($name, $description, $price, $url, $classId, $typeId, $rarity);
        $_SESSION['flash_message'] = "Produkt byl úspěšně přidán.";
        header("Location: ../index.php");
        exit;
    } else {
        $flashMessage = "Všechna povinná pole musí být správně vyplněna.";
    }
}
?>

<div class="container mt-4 text-light">
    <h2>Přidat nový produkt</h2>

    <?php if ($flashMessage): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($flashMessage) ?></div>
    <?php endif; ?>

    <form method="POST">
        <!-- Název -->
        <div class="mb-3">
            <label class="form-label">Název</label>
            <input name="name" class="form-control" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
        </div>

        <!-- Popis -->
        <div class="mb-3">
            <label class="form-label">Popis</label>
            <textarea name="description" class="form-control"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
        </div>

        <!-- Cena -->
        <div class="mb-3">
            <label class="form-label">Cena</label>
            <input type="number" name="price" class="form-control" required value="<?= htmlspecialchars($_POST['price'] ?? '') ?>">
        </div>

        <!-- Ikona (URL obrázku) -->
        <div class="mb-3">
            <label class="form-label">URL obrázku</label>
            <select name="img" id="img" class="form-control" required>
                <option value="">-- Vyber ikonu --</option>
                <?php
                $icons = [
                    "https://wow.zamimg.com/images/wow/icons/large/classicon_warrior.jpg" => "Meč",
                    "https://wow.zamimg.com/images/wow/icons/large/spell_shaman_improvedstormstrike.jpg" => "Meč 2",
                    "https://wow.zamimg.com/images/wow/icons/large/classicon_priest.jpg" => "Staff",
                    "https://wow.zamimg.com/images/wow/icons/large/spell_shadow_demonform.jpg" => "Staff 2",
                    "https://wow.zamimg.com/images/wow/icons/large/achievement_boss_lichking.jpg" => "Helmet",
                    "https://wow.zamimg.com/images/wow/icons/large/inv_helm_armor_bastioncosmetic_d.jpg" => "Shoulders",
                    "https://wow.zamimg.com/images/wow/icons/large/inv_chest_cloth_43.jpg" => "Chest",
                    "https://wow.zamimg.com/images/wow/icons/large/inv_gauntlets_61.jpg" => "Hands",
                    "https://wow.zamimg.com/images/wow/icons/large/inv_fabric_mageweave_03.jpg" => "Legs",
                    "https://wow.zamimg.com/images/wow/icons/large/achievement_zone_outland_01.jpg" => "Boots",
                    "https://wow.zamimg.com/images/wow/icons/large/inv_weapon_crossbow_19.jpg" => "Bow",
                    "https://wow.zamimg.com/images/wow/icons/large/inv_jewelry_trinketpvp_01.jpg" => "Ring 1",
                    "https://wow.zamimg.com/images/wow/icons/large/inv_jewelry_ring_05.jpg" => "Ring 2",
                ];

                foreach ($icons as $link => $label):
                    $selected = ($link === ($_POST['img'] ?? '')) ? 'selected' : '';
                    echo "<option value=\"$link\" $selected>$label</option>";
                endforeach;
                ?>
            </select>
        </div>

        <!-- Specializace (Class) -->
        <div class="mb-3">
            <label class="form-label">Specializace</label>
            <select name="class_id" class="form-select" required>
                <?php foreach ($classes as $class): ?>
                    <option value="<?= $class['class_id'] ?>" <?= ($class['class_id'] == ($_POST['class_id'] ?? '')) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($class['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Typ -->
        <div class="mb-3">
            <label class="form-label">Typ</label>
            <select name="type_id" class="form-select" required>
                <?php foreach ($types as $type): ?>
                    <option value="<?= $type['type_id'] ?>" <?= ($type['type_id'] == ($_POST['type_id'] ?? '')) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($type['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Vzácnost -->
        <div class="mb-3">
            <label class="form-label">Vzácnost</label>
            <select name="rarity" class="form-select">
                <?php
                foreach (['common', 'rare', 'epic', 'legendary'] as $r):
                    $selected = ($r === ($_POST['rarity'] ?? 'common')) ? 'selected' : '';
                    echo "<option value=\"$r\" $selected>$r</option>";
                endforeach;
                ?>
            </select>
        </div>

        <!-- Tlačítko -->
        <button type="submit" class="btn btn-success">Přidat produkt</button>
    </form>
</div>

<?php require_once __DIR__ . '/../incl/footer.php'; ?>
