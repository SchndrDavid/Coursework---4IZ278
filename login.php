<?php require_once 'incl/header.php'; ?>
<?php
require 'database/UsersDB.php';

$flashMessage = null;
$error = null;

// Načtení a zobrazení flash zprávy (např. po registraci)
if (isset($_SESSION['flash_message'])) {
    $flashMessage = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
}

// Zpracování přihlášení po odeslání formuláře
if (!empty($_POST)) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $userDB = new UsersDB();
    $user = $userDB->findOneByEmail($email);

    // Uživatel nenalezen
    if ($user == null) {
        $error = "Uživatel nebyl nalezen.";
    }
    // Heslo nesouhlasí
    elseif (!password_verify($password, $user['password'])) {
        $error = "Neplatné heslo.";
    }
    // Přihlášení úspěšné
    else {
        $_SESSION['user'] = $user['name'];
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['privilege'] = $user['privilege_id'];

        header('Location: index.php');
        exit;
    }
}
?>

<!-- FORMULÁŘ -->
<div class="container mt-5" style="max-width: 500px;">
    <h1 class="mb-4 text-light">Přihlášení</h1>

    <!-- Flash zpráva (např. po registraci) -->
    <?php if ($flashMessage): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($flashMessage) ?>
        </div>
    <?php endif; ?>

    <!-- Chyba při přihlášení -->
    <?php if ($error): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <!-- Přihlašovací formulář -->
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="mb-3 text-light">
            <label for="email" class="form-label">Email</label>
            <input name="email" id="email" type="email" class="form-control">
        </div>
        <div class="mb-3 text-light">
            <label for="password" class="form-label">Heslo</label>
            <input name="password" id="password" type="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Přihlásit se</button>
        
    <!-- Google prihlaseni -->
        <hr class="my-4">
            <a href="google_login.php" class="btn btn-danger">
                Přihlásit se přes Google
            </a>
        </div>
    </form>
</div>

<?php include 'incl/footer.php'; ?>
