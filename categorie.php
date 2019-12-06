<?php
require __DIR__ . '/init.php';
require __DIR__ . "/parts/head.php";
require __DIR__ . "/databaseFuncties/product.php";
require __DIR__ . "/parts/discountBanner.php";

// Als het bestand niet via de index wordt ingeladen
if (strpos($_SERVER['REQUEST_URI'], 'categorie.php') !== false) {
    redirect('');
}

// Zet producten per pagina op standaard waarde als het niet in de get variabele staat
$productenPerPagina = (isset($_GET['producten-per-pagina']) OR !empty($_GET['producten-per-pagina'])) ? $_GET['producten-per-pagina'] : standaardProductenPerPagina();

// Zet pagina op 1 als het niet in de get variable staat
$pagina = (isset($_GET['pagina']) OR !empty($_GET['pagina'])) ? $_GET['pagina'] : 1;

// Haal de producten op die getoont moeten worden
if (isset($_GET['zoek-opdracht']) && !empty($_GET['zoek-opdracht'])) { // Zoeken
    if ($_GET['categorie'] !== 'alle') { // Zoeken in een categorie
        $producten = zoekProducten($_GET['zoek-opdracht'], $pagina, $productenPerPagina, $_GET['categorie']);
    } else { // Zoeken in alle resultaten
        $producten = zoekProducten($_GET['zoek-opdracht'], $pagina, $productenPerPagina);
    }
} else { // Als er niet gezocht hoeft te worden
    if ($_GET['categorie'] !== 'alle') { // Specifieke categorie
        $producten = haalProductenOp($pagina, $productenPerPagina, $_GET['categorie']);
    } else { // Alle categorieën
        $producten = haalProductenOp($pagina, $productenPerPagina);
    }
}

// Haal pagina nummering op
$paginaNummering = paginaNummering($pagina, telProductenPagina($productenPerPagina));
if (isset($_GET['pagina'])) {
    $vorige = $_GET['pagina'] - 1;
    $volgende = $_GET['pagina'] + 1;
} else {
    $vorige = 0;
    $volgende = 2;
}

// Haal get variabelen op in url voormaat om waardes te behouden bij het klikken op een link
unset($_GET['pagina']);
$getVariabelenVoorUrl = haalGetVariabelenOpVoorUrl($_GET);

// Als er een knop is ingedrukt om een product in de winkelwagen te gooien
if (isset($_POST['toevoegenAanWinkelwagen'])) {
    if (isset($_SESSION['winkelwagen']) && array_key_exists($_POST['productID'], $_SESSION['winkelwagen'])) {
        $_SESSION['winkelwagen'][$_POST['productID']] += 1;
    } else {
        $_SESSION['winkelwagen'][$_POST['productID']] = 1;
    }
}

?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h5>Producten
                > <?= ($_GET['categorie'] === 'alle') ? 'Alle' : haalCategorieNaamOpID($_GET['categorie']) ?></h5>
        </div>
        <div class="col-6">
            <!-- Resultaten per pagina -->
            <form method='get'>
                <div class="form-inline">
                    Resultaten per pagina
                    <input type="number" name="pp" min="10" max="50" step="5"
                           class="mx-3 product_per_pagina_form form-control"
                           name="products-per-pagina"
                           value="<?= $_GET['products-per-pagina'] ?? standaardProductenPerPagina() ?>">
                </div>
                <!-- Verborgen velden om waardes van get variabelen te behouden -->
                <input type="hidden" name="categorie" value="<?= $_GET['categorie'] ?? 'alle' ?>">
                <input type="hidden" name="pagina" value="<?= $_GET['pagina'] ?? 1 ?>">
                <?php if (isset($_GET['zoek-opdracht'])): ?>
                    <input type="hidden" name="zoek-opdracht" value="<?= $_GET['zoek-opdracht'] ?>">
                <?php endif ?>
            </form>
        </div>
        <div class="col-6">
            <!-- Pagination bovenaan de pagina -->
            <nav aria-label="navigation pagination">
                <ul class="pagination justify-content-end">
                    <li class="page-item<?= ($vorige < 1) ? ' disabled' : '' ?>">
                        <a class="page-link"
                           href="<?= getBaseUrl() . (!empty($getVariabelenVoorUrl)) ? $getVariabelenVoorUrl . '&' : '?' ?>pagina=<?= $vorige ?>"
                           tabindex="-1"
                           aria-disabled="true">Vorige</a>
                    </li>
                    <?php foreach ($paginaNummering as $key => $paginaNummer): ?>
                        <li class="page-item<?= ($key === 'selected') ? ' active' : '' ?>">
                            <a class="page-link"
                               href="<?= getBaseUrl() . (!empty($getVariabelenVoorUrl)) ? $getVariabelenVoorUrl . '&' : '?' ?>pagina=<?= $paginaNummer ?>">
                                <?= $paginaNummer ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    <li class="page-item<?= ($volgende >= $aantalPaginas) ? ' disabled' : '' ?>">
                        <a class="page-link"
                           href="<?= getBaseUrl() . (!empty($getVariabelenVoorUrl)) ? $getVariabelenVoorUrl . '&' : '?' ?>pagina=<?= $volgende ?>">Volgende</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="col-12">
            <div class="row">
                <!-- Producten -->
                <?php foreach ($producten as $product): ?>
                    <div class="col-sm-3">
                        <?php require __DIR__ . '/parts/product.php'; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-6">
            <!-- Resultaten per pagina -->
            <form method='get'>
                <div class="form-inline">
                    Resultaten per pagina
                    <input type="number" name="pp" min="10" max="50" step="5"
                           class="mx-3 product_per_pagina_form form-control"
                           name="products-per-pagina"
                           value="<?= $_GET['products-per-pagina'] ?? standaardProductenPerPagina() ?>">
                </div>
                <!-- Verborgen velden om waardes van get variabelen te behouden -->
                <input type="hidden" name="categorie" value="<?= $_GET['categorie'] ?? 'alle' ?>">
                <input type="hidden" name="pagina" value="<?= $_GET['pagina'] ?? 1 ?>">
                <?php if (isset($_GET['zoek-opdracht'])): ?>
                    <input type="hidden" name="zoek-opdracht" value="<?= $_GET['zoek-opdracht'] ?>">
                <?php endif ?>
            </form>
        </div>
        <div class="col-6">
            <!-- Pagination bovenaan de pagina -->
            <nav aria-label="navigation pagination">
                <ul class="pagination justify-content-end">
                    <li class="page-item<?= ($vorige < 1) ? ' disabled' : '' ?>">
                        <a class="page-link"
                           href="<?= getBaseUrl() . (!empty($getVariabelenVoorUrl)) ? $getVariabelenVoorUrl . '&' : '?' ?>pagina=<?= $vorige ?>"
                           tabindex="-1"
                           aria-disabled="true">Vorige</a>
                    </li>
                    <?php foreach ($paginaNummering as $key => $paginaNummer): ?>
                        <li class="page-item<?= ($key === 'selected') ? ' active' : '' ?>">
                            <a class="page-link"
                               href="<?= getBaseUrl() . (!empty($getVariabelenVoorUrl)) ? $getVariabelenVoorUrl . '&' : '?' ?>pagina=<?= $paginaNummer ?>">
                                <?= $paginaNummer ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    <li class="page-item<?= ($volgende >= $aantalPaginas) ? ' disabled' : '' ?>">
                        <a class="page-link"
                           href="<?= getBaseUrl() . (!empty($getVariabelenVoorUrl)) ? $getVariabelenVoorUrl . '&' : '?' ?>pagina=<?= $volgende ?>">Volgende</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>