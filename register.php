<?php
require_once 'incl/header.php'; 
require 'database/UsersDB.php';
require 'database/ClassDB.php';

$error = null;

// Načtení všech dostupných tříd pro dropdown ve formuláři
$classDB = new ClassDB();
$classes = $classDB->getAllClasses();

// Zpracování formuláře
if (isset($_POST['email'], $_POST['password'], $_POST['confirm_password'], $_POST['name'], $_POST['class_id'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $name = trim($_POST['name']);
    $classId = (int) $_POST['class_id'];

    // Validace vstupních polí
    if (empty($email) || empty($password) || empty($name) || empty($classId)) {
        $error = 'Všechna pole jsou povinná.';
    } elseif ($password !== $confirmPassword) {
        $error = 'Hesla se neshodují.';
    } else {
        $userDB = new UsersDB();
        $existingUser = $userDB->findOneByEmail($email);

        // Kontrola, zda uživatel s tímto emailem už existuje
        if ($existingUser) {
            $error = 'Uživatel s tímto emailem již existuje.';
        } else {
            // Zahashování hesla a vytvoření uživatele v DB
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $userDB->create([
                'email' => $email,
                'password' => $passwordHash,
                'name' => $name,
                'class_id' => $classId,
                'privilege_id' => 1, // defaultní práva pro nového uživatele
                'filter' => 0,       // výchozí nastavení filtru
            ]);

            // Flash message a přesměrování na přihlášení
            $_SESSION['flash_message'] = 'Registrace byla úspěšná! Můžeš se přihlásit.';
            header("Location: login.php");
            exit;
        }
    }
}
?>

<div class="container mt-5 text-light" style="max-width: 500px;">
  <h2>Registrace</h2>

  <!-- Zobrazení chybové zprávy (pokud existuje) -->
  <?php if ($error): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>

  <!-- Formulář pro registraci -->
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <div class="mb-3 text-light">
          <label for="email" class="form-label">Email</label>
          <input name="email" id="email" type="email" class="form-control">
      </div>
      <div class="mb-3 text-light">
          <label for="password" class="form-label">Heslo</label>
          <input name="password" id="password" type="password" class="form-control">
      </div>
      <div class="mb-3 text-light">
          <label for="confirm_password" class="form-label">Potvrzení hesla</label>
          <input name="confirm_password" id="confirm_password" type="password" class="form-control">
      </div>
      <div class="mb-3 text-light">
          <label for="name" class="form-label">Jméno</label>
          <input name="name" id="name" class="form-control">
      </div>
      <div class="mb-3">
          <label for="class_id" class="form-label">Třída</label>
          <select name="class_id" id="class_id" class="form-select">
              <option value="">-- Vyberte třídu --</option>
              <?php foreach ($classes as $class): ?>
                  <option value="<?php echo $class['class_id']; ?>">
                      <?php echo htmlspecialchars($class['name']); ?>
                  </option>
              <?php endforeach; ?>
          </select>
      </div>
      <button type="submit" class="btn btn-primary">Registrovat</button>
  </form>
</div>

<?php include 'incl/footer.php'; ?>
