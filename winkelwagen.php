<?php

//require __DIR__ . '/init.php';
//require __DIR__ . "/parts/head.php";
//require __DIR__ . "/databaseFuncties/product.php";
// Sla producten op in sessie array

if (isset($_POST['toevoegenAanWinkelwagen'])) {
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'StockItemID') !== false) {
            $key = str_replace('StockItemID', '', $key);

            $_SESSION['winkelwagen']['producten'][$key] = $value;
        }
    }

    redirect("?toonWinkelWagen=true");
}
// Haal de producten uit de database en bereken de totaalprijs
$totaalPrijs = 0;
$winkelwagen = [];

if (isset($_SESSION['winkelwagen']['producten'])) {
    foreach ($_SESSION['winkelwagen']['producten'] as $productID => $aantal) {
        if ($aantal < 0) {
            $_SESSION['winkelwagen']['producten'][$productID] = 1;
            $aantal = 1;
            ?>  <strong> U kunt geen negatief aantal producten bestellen </strong>  <?php
        }

        $product = haalWinkelwagenProductOp($productID)[0];
        $winkelwagen[] = $product;
        $totaalPrijs += $aantal * price($product['StockItemID']);
    }
}

// Verwijder een product uit de winkelwagen
if (isset($_GET['te-verwijderen-product'])) {
    if (isset($_SESSION['winkelwagen']['producten'][$_GET['te-verwijderen-product']])) {
        unset($_SESSION['winkelwagen']['producten'][$_GET['te-verwijderen-product']]);
        redirect("?toonWinkelWagen=true");
    }
}

?>
<form id="delete" method="get" action=""></form>

<div class="container">
    <?php if (!isset($_SESSION['winkelwagen']['producten']) || empty($_SESSION['winkelwagen']['producten'])): ?>
        <div class="col-12 text-center">
            <p>Uw heeft nog geen producten in uw winkelwagen.</p>
            <a class="btn btn-primary" href="<?= getBaseUrl() ?>?categorie=alle">Winkelen</a>
        </div>
    <?php else: ?>
        <form method="post" class="row">
            <div class="col-9">
                <div class="col-9">
                    <button class="btn btn-primary" type="submit" name="toevoegenAanWinkelwagen"
                            value="test">
                        Winkelwagen opslaan
                    </button>
                </div>
                <div class="col-12 border border-danger">
                    <?php
                    foreach ($winkelwagen as $product):
                        $thumbnail = getImages($product['StockItemID'], true)[0]['Location'];
                        ?>
                        <div class="row w-100 border rounded-lg border border-danger">
                            <div class="col-10 row">
                                <div class="col-4">
                                    <img src="<?= getBaseUrl() ?>/assets/afbeeldingen/<?= $thumbnail ?>"
                                         style="max-height: 120px; max-width: 140px; object-fit: contain; height: 100%">
                                </div>
                                <div class="col">
                                    <h5><?= $product['StockItemName'] ?> </h5>
                                </div>
                            </div>
                            <div class="form-group text-left mr-2 col w-100">
                                <label for="aantal">Aantal</label>
                                <input type="number" id="aantal"
                                       value="<?= $_SESSION['winkelwagen']['producten'][$product['StockItemID']] ?>"
                                       placeholder="<?= $_SESSION['winkelwagen']['producten'][$product['StockItemID']] ?>"
                                       name="StockItemID<?= $product['StockItemID'] ?>"
                                       class="form-control">
                                <button type="submit" class="btn btn-danger"
                                        name="te-verwijderen-product"
                                        value="<?= $product['StockItemID'] ?>"
                                        form="delete">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </div>
                <div class="col-9">
                    <button class="btn btn-primary" type="submit" name="toevoegenAanWinkelwagen"
                            value="test">
                        Winkelwagen opslaan
                    </button>
                </div>
            </div>
            <div class="col-3 flex d-flex flex-column"
                 style="min-height: 400px; background: lightgray; border-radius: 25px">
                <div class="d-flex justify-content-center flex-column">
                    <h1>&euro; <?= $totaalPrijs ?></h1>
                    <button class="btn btn-success mt-1"
                            href="<?= getBaseUrl() ?>bestelling-afronden.php">Bestellen
                    </button>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>