<?php include __DIR__ . '/../incl/header.php'; ?>

<!-- HLAVNÍ OBSAH ADMIN DASHBOARDU -->
<div class="container mt-5">
    <h2 class="text-light mb-4">Admin Dashboard</h2>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        
        <!-- KARTA: Objednávky -->
        <div class="col">
            <a href="orders.php" class="text-decoration-none">
                <div class="card bg-dark text-light border-warning h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Objednávky</h5>
                        <p class="card-text">Spravuj a sleduj vytvořené objednávky.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- KARTA: Košíky -->
        <div class="col">
            <a href="carts.php" class="text-decoration-none">
                <div class="card bg-dark text-light border-warning h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Košíky</h5>
                        <p class="card-text">Zobrazit obsah aktuálních košíků uživatelů.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- KARTA: Produkty -->
        <div class="col">
            <a href="../index.php" class="text-decoration-none">
                <div class="card bg-dark text-light border-warning h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Produkty</h5>
                        <p class="card-text">Zpět na výpis všech herních předmětů.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- KARTA: Uživatelé -->
        <div class="col">
            <a href="users.php" class="text-decoration-none">
                <div class="card bg-dark text-light border-warning h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Uživatelé</h5>
                        <p class="card-text">Správa uživatelů a jejich práv.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- KARTA: Přidat produkt -->
        <div class="col">
            <a href="add_product.php" class="text-decoration-none">
                <div class="card bg-dark text-light border-warning h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Přídat produkt</h5>
                        <p class="card-text">Přídání produktu.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../incl/footer.php'; ?>
