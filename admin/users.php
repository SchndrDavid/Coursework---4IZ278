<?php
require_once __DIR__ . '/../incl/header.php';
require_once __DIR__ . '/../database/UsersDB.php';

// Flash zpráva po akci (např. změna práv, smazání)
$flashMessage = $_SESSION['flash_message'] ?? null;
unset($_SESSION['flash_message']);

// Kontrola oprávnění – pouze administrátor
if (!isset($_SESSION['privilege']) || $_SESSION['privilege'] < 2) {
    header('Location: ../index.php');
    exit;
}

// Inicializace databázové třídy
$usersDB = new UsersDB();

// Změna privilegia uživatele (z POST požadavku)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $privilege = $_POST['privilege_id'];
    $usersDB->updatePrivilege($userId, $privilege);

    $_SESSION['flash_message'] = 'Privilegia byla změněna.';
    header('Location: users.php');
    exit;
}

// Načtení všech uživatelů
$users = $usersDB->getAllUsers();
?>

<!-- OBSAH STRÁNKY -->
<div class="container mt-4 text-light">
    <h2>Správa uživatelů</h2>

    <!-- Flash zpráva -->
    <?php if ($flashMessage): ?>
        <div class="alert alert-success" style="max-width: 300px;">
            <?= htmlspecialchars($flashMessage) ?>
        </div>
    <?php endif; ?> 

    <!-- Tabulka uživatelů -->
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Jméno</th>
                <th>Email</th>
                <th>Privilegia</th>
                <th>Akce</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= $user['privilege_id'] ?></td>
                    <td>
                        <!-- Formulář pro změnu privilegia -->
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                            <select name="privilege_id" class="form-select form-select-sm d-inline w-auto">
                                <option value="1" <?= $user['privilege_id'] == 1 ? 'selected' : '' ?>>Uživatel</option>
                                <option value="2" <?= $user['privilege_id'] == 2 ? 'selected' : '' ?>>Admin</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-success">Uložit</button>
                        </form>

                        <!-- Tlačítko pro smazání uživatele -->
                        <a href="delete_user.php?user_id=<?= $user['user_id'] ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Opravdu chceš tohoto uživatele smazat?');">
                            Smazat
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../incl/footer.php'; ?>
