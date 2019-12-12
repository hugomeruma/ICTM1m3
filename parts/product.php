<?php
require_once "functies/content.php";
$review = getAvgReviews($product['StockItemID']);
?>

<div class="card mb-3">
    <div class="image-div">
        <img src="<?= getBaseUrl() ?>assets/afbeeldingen/dummy/<?= imgIDs($product["StockItemID"], "true") ?>.png"
             class="card-img-top product-image" alt="...">
    </div>
    <div class="card-body">
        <div style="height: 10ex">
            <h5 class="card-title"><?= $product['StockItemName'] ?></h5>
        </div>
        <h5><strong><?= $product['UnitPrice'] ?></strong><span
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
</div>