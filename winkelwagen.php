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
        if ($aantal < 0){
            $_SESSION['winkelwagen']['producten'][$productID] = 1;
            $aantal = 1;
            ?>  <strong> U kunt geen negatief aantal producten bestellen </strong>  <?php
        }

        $product = haalWinkelwagenProductOp($productID)[0];
        $winkelwagen[] = $product;
        $totaalPrijs += $aantal * price($product['StockItemID'], false);
    }
}

// Verwijder een product uit de winkelwagen
if (isset($_GET['te-verwijderen-product'])) {
    if (isset($_SESSION['winkelwagen']['producten'][$_GET['te-verwijderen-product']])) {
        unset($_SESSION['winkelwagen']['producten'][$_GET['te-verwijderen-product']]);
        redirect("?toonWinkelWagen=true");
    }
}
//dd($_POST);
?>
<form method="post">
    <div class="row">
        <div class="col-6 align-self-center">
            <h1>Winkelwagen</h1>
        </div>
        <div class="col-6 align-self-center">
            <!-- Laat alleen zien als er producten in de winkelwagen zitten -->
            <?php if (isset($_SESSION['winkelwagen']['producten']) || !empty($_SESSION['winkelwagen']['producten'])): ?>
                <a class="btn btn-success float-right"
                   href="<?= getBaseUrl() ?>bestelling-afronden.php">Bestellen</a>
            <?php endif; ?>
        </div>
        <!-- Laat zien als er producten in de winkelwagen zitten -->
        <?php if (!isset($_SESSION['winkelwagen']['producten']) || empty($_SESSION['winkelwagen']['producten'])): ?>
            <div class="col-12 text-center">
                <p>Uw heeft nog geen producten in uw winkelwagen.</p>
                <a class="btn btn-primary" href="<?= getBaseUrl() ?>?categorie=alle">Winkelen</a>
            </div>
        <?php endif;
        foreach ($winkelwagen as $product):
            $thumbnail = getImages($product['StockItemID'], true)[0]['Location'] ?? '';
            ?>
            <div class="col-12 mb-2">
                <div class="border">
                    <div class="row">
                        <div class="col-3 d-flex justify-content-center align-items-center">
                            <img src="<?= getBaseUrl() ?>assets/afbeeldingen/<?= $thumbnail ?>"
                                 class="winkelwagen-product-afbeelding w-100" alt="">
                        </div>
                        <div class="col-7 py-2">
                            <a href="<?= getBaseUrl() ?>product.php?id=<?= $product['StockItemID'] ?>">
                                <h5 class="text-primary"><?= $product['StockItemName'] ?></h5>
                            </a>
                            <strong>&euro;<?= price($product['StockItemID']) ?></strong>
                        </div>
                        <div class="col-2 py-2 text-right">
                            <div class="form-group text-left mr-2">
                                <label for="aantal">Aantal</label>
                                <input type="number" id="aantal"
                                       value="<?= $_SESSION['winkelwagen']['producten'][$product['StockItemID']] ?>"
                                       placeholder="<?= $_SESSION['winkelwagen']['producten'][$product['StockItemID']] ?>"
                                       name="StockItemID<?= $product['StockItemID'] ?>"
                                       class="form-control">
                            </div>
                            <a class="btn btn-danger mr-2"
                               href="<?= getBaseUrl() ?>?toonWinkelWagen=true&te-verwijderen-product=<?= $product['StockItemID'] ?>">Verwijderen</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <!-- Laat alleen zien als er producten in de winkelwagen zitten -->
        <?php if (isset($_SESSION['winkelwagen']['producten']) || !empty($_SESSION['winkelwagen']['producten'])): ?>
            <div class="col-12 text-right">
                <strong>Totaalbedrag:</strong> € <?= str_replace(".", ",", number_format($totaalPrijs, 2)) ?><br>
                <button class="btn btn-primary mt-1" type="submit" name="toevoegenAanWinkelwagen" value="test">Opslaan</button>
            </div>
        <?php endif; ?>
    </div>
</form>
