<?php

require_once "functies/content.php";

$discount = "";
$thumbnail = $product["stockItemAfbeeldingLocation"] ?? $product["afbeeldingLocation"] ?? 'afbeelding_niet_beschikbaar.png';

?>
<div class="card">
    <div class="img-productkaart">
        <img src="<?= getBaseUrl() ?>assets/afbeeldingen/<?= $thumbnail ?>"
             class="card-img-top" alt="...">
    </div>

    <div class="card-body">
        <div style="height: 10ex">
            <h5 class="card-title"><?= $product['StockItemName'] ?></h5>
        </div>
        <h5><strong> &euro;<?= price($product['StockItemID']) ?> </strong><span
                    class="float-right"><div class="d-inline-flex"
                                             style="align-items: center">
                    <?= stars($product['gemiddeldeBeoordeling']) ?>
                </div>
                &nbsp;(<?= $product['aantalBeoordelingen'] ?>)
            </span></h5>
        <form method="post" style="z-index: 5">
            <input type="hidden" value="1" name="<?= $product['StockItemID'] ?>StockItemID">
            <input type="hidden" value="1" name="toevoegenAanWinkelwagen">
            <button type="submit" name="toevoegenAanWinkelwagen " value="" style="z-index: 2; position: relative"
                    class="btn btn-success btn-block justify-content-around"
            ">
            <i class="fas fa-plus button-icon"></i>
            <i class="fas fa-shopping-cart button-icon"></i>
            </button>
        </form>
    </div>

    <a class="stretched-link" style=" z-index: 0"
       href="<?= getBaseUrl() ?>?product=<?= $product['StockItemID'] ?>&categorie=<?= $_GET['categorie'] ?>"></a>
</div>