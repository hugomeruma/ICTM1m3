<?php
require_once "functies/content.php";
$review = getAvgReviews($product['StockItemID']);
$stock = getStockHolding($product['StockItemID']);
$discount = "";

?>

<div class="card mb-3" <?php if ($stock <= 0): ?>style="opacity: 0.4" <?php endif; ?>>

    <img src="<?= getBaseUrl() ?>assets/afbeeldingen/dummy/<?= getImages($product['StockItemID'], "thumbnail")[0]["ImageName"] ?>"
         class="card-img-top" alt="...">

    <div class="card-body">
        <div style="height: 10ex">
            <h5 class="card-title"><?= $product['StockItemName'] ?></h5>
        </div>
        <h5><strong> <?= price($product['StockItemID']) ?> </strong><span
                    class="float-right"><div class="d-inline-flex"
                                             style="align-items: center"><?= stars($review['avg']) ?></div>
                &nbsp;(<?= $review['count'] ?>)</span></h5>
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