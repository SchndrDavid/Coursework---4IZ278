<?php
require_once 'database/ClassDB.php';
require_once 'database/TypeDB.php';
require_once 'database/ProductDB.php';
require_once 'database/UsersDB.php';

$classDB = new ClassDB();
$typeDB = new TypeDB();
$productDB = new ProductDB();
$userDB = new UsersDB();

$isLoggedIn = isset($_SESSION['user_id']);
$classes = [];

// Pokud je uživatel přihlášený a má aktivní filtr podle class_id, zobrazí se pouze jeho třída
if ($isLoggedIn) {
    $user = $userDB->getUserById($_SESSION['user_id']);
    if (!empty($user['filter'])) {
        $singleClass = $classDB->getClassById($user['class_id']);
        if ($singleClass) $classes = [$singleClass];
    } else {
        $classes = $classDB->getAllClasses();
    }
} else {
    // Nepřihlášený uživatel – zobrazit všechny třídy
    $classes = $classDB->getAllClasses();
}

// Načtení typů a produktů
$types = $typeDB->getAllTypes(); // obsahuje: type_id, name, section
$products = $productDB->getAllProducts(); // obsahuje: class_id, type_id

// Indexace typů podle type_id pro snadný přístup
$typesById = [];
foreach ($types as $type) {
    $typesById[$type['type_id']] = $type;
}

// Vytvoření struktury: class_id → section → typy
$classStructure = [];

foreach ($products as $product) {
    $classId = $product['class_id'];
    $typeId = $product['type_id'];

    if (!isset($typesById[$typeId])) continue;

    $type = $typesById[$typeId];
    $section = $type['section'];

    $classStructure[$classId][$section][$typeId] = $type;
}
?>

<!-- HTML část: Sidebar s akordeonem tříd a typů -->
<div class="col-md-1 sidebar">
    <div class="accordion" id="classAccordion">
        <?php foreach ($classes as $class): ?>
            <div class="accordion-item">
                <!-- Hlavička třídy -->
                <h2 class="accordion-header" id="heading<?= $class['class_id'] ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse<?= $class['class_id'] ?>" aria-expanded="false"
                            aria-controls="collapse<?= $class['class_id'] ?>">
                        <img src="<?= htmlspecialchars($class['url']) ?>" alt="<?= htmlspecialchars($class['name']) ?>" style="height: 20px;" class="me-2">
                        <?= htmlspecialchars($class['name']) ?>
                    </button>
                </h2>

                <!-- Obsah rozbalovací sekce -->
                <div id="collapse<?= $class['class_id'] ?>" class="accordion-collapse collapse"
                     aria-labelledby="heading<?= $class['class_id'] ?>" data-bs-parent="#classAccordion">
                    <div class="accordion-body">
                        <?php if (!empty($classStructure[$class['class_id']])): ?>
                            <!-- Výpis sekcí a typů pro danou třídu -->
                            <?php foreach ($classStructure[$class['class_id']] as $section => $sectionTypes): ?>
                                <div class="mb-2">
                                    <!-- Odkaz na sekci -->
                                    <a href="index.php?class_id=<?= $class['class_id'] ?>&section=<?= urlencode($section) ?>"
                                       class="text-light fw-bold text-decoration-none d-block mb-1">
                                       <?= htmlspecialchars($section) ?>
                                    </a>
                                    <!-- Výpis typů v sekci -->
                                    <ul class="list-unstyled ms-2">
                                        <?php foreach ($sectionTypes as $type): ?>
                                            <li>
                                                <a href="index.php?class_id=<?= $class['class_id'] ?>&type_id=<?= $type['type_id'] ?>"
                                                   class="text-secondary ms-2">
                                                    <?= htmlspecialchars($type['name']) ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="small">Žádné předměty</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
