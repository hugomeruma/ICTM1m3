<div class="card mb-3">
    <img src="<?= getBaseUrl() ?>assets/afbeeldingen/image_not_available.png" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title"><?= $product['StockItemName'] ?></h5>
        <h5><strong><?= $product['UnitPrice'] ?></strong></h5>
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