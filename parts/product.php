<?php
require_once "functies/content.php";
$discount = "";
$thumbnail = $product["afbeeldingLocation"];
//$thumbnail = getImages($product['StockItemID'], "thumbnail")[0]["Location"];
//$thumbnail = $product['afbeelding']['location'];
?>

<div class="card">
    <img src="<?= getBaseUrl() ?>assets/afbeeldingen/<?= $thumbnail ?>"
         class="card-img-top" alt="...">

    <div class="card-body">
        <div style="height: 10ex">
            <h5 class="card-title"><?= $product['StockItemName'] ?></h5>
        </div>
        <h5><strong> <?= price($product['StockItemID']) ?> </strong><span
                    class="float-right"><div class="d-inline-flex"
                                             style="align-items: center">
                    <?= stars($product['gemiddeldeBeoordeling']) ?>
                </div>
                &nbsp;(<?= $product['aantalBeoordelingen'] ?>)
            </span></h5>
        <form method="post">
            <input type="hidden" name="productID" value="<?= $product['StockItemID'] ?>">
            <button type="submit" name="toevoegenAanWinkelwagen"
                    class="btn btn-success btn-block justify-content-around">
                <i class="fas fa-plus button-icon"></i>
                <i class="fas fa-shopping-cart button-icon"></i>
            </button>
        </form>
    </div>

    <a class="stretched-link"
       href="<?= getBaseUrl() ?>?product=<?= $product['StockItemID'] ?>&categorie=<?= $_GET['categorie'] ?>"></a>
</div>