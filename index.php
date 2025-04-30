<?php
// Hlavička stránky — navbar, session start apod.
include 'incl/header.php';

// Načtení databáze pro specializace (classy)
require_once 'database/ClassDB.php';

// Inicializace a načtení všech herních tříd (např. Warrior, Mage atd.)
$classDB = new ClassDB();
$classes = $classDB->getAllClasses(); // můžeš použít v komponentě CategoryDisplay
?>

<!-- OBSAH STRÁNKY -->
<div class="container-fluid">
  <div class="row">
    <!-- Postranní panel s kategoriemi (třídy) -->
    <?php include 'components/CategoryDisplay.php'; ?>

    <!-- Výpis produktů podle vybrané kategorie nebo všech -->
    <?php include 'components/ProductsDisplay.php'; ?>
  </div>
</div>

<?php
// Patička stránky
include 'incl/footer.php';
?>
