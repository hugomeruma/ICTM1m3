<?php
require __DIR__ . "/../functies/helpers.php";
require __DIR__ . "/../functies/algemeneFuncties.php";
require __DIR__ . "/../databaseFuncties/product.php";
require __DIR__ . "/../parts/admin/head.php";
require __DIR__ . "/../parts/admin/menu.php";
?>
    <div class="container">
        <div class="row mt-3 mb-3">
            <div class="col-12 mb-3">
                <h1 class="text-dark">Welkom <?= $_SESSION['name'] ?></h1>
            </div>
            <div class="col-sm-4">
                <div class="bg-white shadow p-3">
                    <h3 class="text-dark text-center">Aantal producten</h3>
                    <h2 class="text-dark text-center"><?= tellenProducten() ?></h2>
                </div>
            </div>
        </div>
    </div>

<?php
require "../parts/admin/footer.php";