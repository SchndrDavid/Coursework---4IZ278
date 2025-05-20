<?php
// Spuštění session pro práci s uživatelem
session_start();

// Kontrola, jestli je uživatel přihlášen
$isLoggedIn = isset($_SESSION['user']);

// Absolutní cesta k základnímu adresáři
$base = '/schd22/sp/';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor</title>

    <!-- Bootstrap 5 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Vlastní styly -->
    <link rel="stylesheet" href="<?= $base ?>css/style.css">
</head>
<body>

<!-- NAVIGACE -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <!-- Logo a odkaz na homepage -->
    <a class="navbar-brand d-flex align-items-center" href="<?= $base ?>index.php">
        <img src="https://wow.zamimg.com/images/wow/icons/large/wow_store.jpg" alt="WoW Logo" style="height: 40px;" class="me-2">
    </a>

    <!-- Navigační položky -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">

        <!-- Admin dashboard (vidí jen admini) -->
        <?php if (isset($_SESSION['privilege']) && $_SESSION['privilege'] >= 2): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= $base ?>admin/dashboard.php">Dashboard</a>
            </li>
        <?php endif; ?>

        <!-- Přihlášený uživatel -->
        <?php if ($isLoggedIn): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= $base ?>profile.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= $base ?>cart.php">Cart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= $base ?>user_orders.php">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= $base ?>logout.php">Odhlásit se (<?= htmlspecialchars($_SESSION['user']) ?>)</a>
            </li>
        <?php else: ?>
            <!-- Nepřihlášený uživatel -->
            <li class="nav-item">
                <a class="nav-link" href="<?= $base ?>login.php">Přihlásit se</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= $base ?>register.php">Registrace</a>
            </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
