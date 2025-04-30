<?php
require_once 'incl/header.php';
require_once 'database/UsersDB.php';
require_once 'database/ClassDB.php';
require_once 'database/CartDB.php';
require_once 'database/OrderDB.php';

// Kontrola přihlášení uživatele
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Načtení flash message a následné odstranění ze session
$flashMessage = $_SESSION['flash_message'] ?? null;
unset($_SESSION['flash_message']);

// Inicializace databázových objektů
$userDB = new UsersDB();
$classDB = new ClassDB();
$cartDB = new CartDB();
$orderDB = new OrderDB();

// Načtení dat aktuálního uživatele
$user = $userDB->getUserById($_SESSION['user_id']);
$classes = $classDB->getAllClasses();
$cartStats = $cartDB->getCartStats($_SESSION['user_id']);
$orderCount = $orderDB->getOrderCount($user['user_id']);
$orderTotal = $orderDB->getOrderTotal($user['user_id']);

// Zpracování POST požadavku (změna třídy nebo filtru)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['class_id'])) {
        $userDB->updateUserClass($_SESSION['user_id'], $_POST['class_id']);
    }

    $filter = isset($_POST['filter_by_class']) ? 1 : 0;
    $userDB->updateFilterPreference($_SESSION['user_id'], $filter);

    $_SESSION['flash_message'] = "Nastavení bylo uloženo.";
    header("Location: profile.php");
    exit;
}

// Načtení aktuální třídy uživatele
$userClass = $classDB->getClassById($user['class_id']);
?>

<!-- PROFIL UŽIVATELE -->
<div class="container mt-5 text-light">
    <h2 class="mb-4">Profil uživatele: <?= htmlspecialchars($user['name']) ?></h2>

    <!-- Zobrazení flash zprávy (např. po uložení nastavení) -->
    <?php if ($flashMessage): ?>
        <div class="alert alert-success" style="max-width: 400px;">
            <?= htmlspecialchars($flashMessage) ?>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <!-- KARTA: Specializace a změna -->
        <div class="col-md-4">
            <div class="card bg-dark border border-secondary">
                <div class="card-header text-warning fw-bold">Specializace</div>
                <div class="card-body">
                    <div class="text-center mb-3 text-light">
                        <img src="<?= htmlspecialchars($userClass['url']) ?>" alt="class image" class="img-fluid rounded" style="max-height: 100px;">
                        <p class="mt-2"><strong><?= htmlspecialchars($userClass['name']) ?></strong></p>
                    </div>
                    <form method="POST">
                        <label class="form-label text-light">Změnit specializaci:</label>
                        <select name="class_id" class="form-select mb-3">
                            <?php foreach ($classes as $class): ?>
                                <option value="<?= $class['class_id'] ?>" <?= $class['class_id'] == $user['class_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($class['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <div class="form-check mb-3 text-light">
                            <input class="form-check-input" type="checkbox" name="filter_by_class" id="filter_by_class"
                                   <?= $user['filter'] ? 'checked' : '' ?>>
                            <label class="form-check-label" for="filter_by_class">
                                Automaticky filtrovat produkty podle specializace
                            </label>
                        </div>

                        <button type="submit" class="btn btn-outline-warning w-100">Uložit nastavení</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- KARTA: Účet a košík -->
        <div class="col-md-4">
            <div class="card bg-dark border border-secondary text-light">
                <div class="card-header text-warning fw-bold">Účet a košík</div>
                <div class="card-body">
                    <p><strong>Email:</strong><br><?= htmlspecialchars($user['email']) ?></p>
                    <hr>
                    <p>
                        <strong>Košík:</strong><br>
                        Položek:
                        <?= $cartStats['count'] == 0 ? '<span class="text-danger">Prázdný</span>' : $cartStats['count'] ?><br>
                        <?php if ($cartStats['count'] > 0): ?>
                            Hodnota: <?= $cartStats['total'] ?> gold
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- KARTA: Objednávky -->
        <div class="col-md-4 text-light">
            <div class="card bg-dark border border-secondary text-light">
                <div class="card-header text-warning fw-bold">Objednávky</div>
                <div class="card-body">
                    <p><strong>Počet objednávek:</strong> <?= $orderCount ?></p>
                    <p><strong>Celkově utraceno:</strong> <?= $orderTotal ?> gold</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Patička stránky
require_once 'incl/footer.php';
?>
