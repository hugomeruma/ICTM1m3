<?php
$product = getStockItem($_GET['product'])
?>

<div class="d-flex flex-row">
    <div class="w-50 d-flex justify-content-center">
        <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
            <div class="carousel-inner">
                <?php
                $imageInfo = getImages($product['StockItemID']);
                $first = true;
                foreach ($imageInfo as $image): ?>
                    <div class="carousel-item <?php if ($first == true) {
                        echo "active";
                    } ?>">
                        <img class="d-block w-100 carousel-image"
                             src="<?php echo("http://" . $_SERVER['SERVER_NAME'] . "/ICTM1m3/assets/afbeeldingen/dummy/" . $image[0]['ImageName']); ?>"
                             style="height: 450px; width: 450px; object-fit: contain"
                        >
                    </div>
                    <?php $first = false;
                endforeach; ?>
            </div>

            <a class="carousel-control-prev h-auto" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <a class="carousel-control-next h-auto" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div>
    </div>
    <div class="w-50 d-flex justify-content-center align-items-center flex-column">
        <div>

            <div class="prijs centerd">
                <?php if (getDiscount($_GET['view']) != null): ?>
                    <div class="price-with-discount">
        <span class="fa-stack discount-icon">
            <i class="fas fa-certificate fa-stack-2x"></i>
            <i class="fas fa-percent fa-stack-1x fa-inverse"></i>
        </span>
                        <div class="€discount">
                            € <?= price($product["RecommendedRetailPrice"], $product["TaxRate"], $_GET['product']) ?></div>
                    </div>
                <?php else: ?>
                    <div class="€">
                        € <?= price($product["RecommendedRetailPrice"], $product["TaxRate"], $_GET['product']) ?></div>
                <?php endif; ?>
                <div class="opmerking">
                    incl. btw (<?= $product["TaxRate"] / 100 ?>%)<br>
                </div>
                <?php
                $stock = getStockHolding($_GET['product']);
                if ($stock >= 0): ?>
                    Dit product is niet meer op voorraad
                <?php endif; ?>

                <!--    <div class="opmerking"> --><? //= $stock ?><!--</div>-->
            </div>

        </div>

        <div>
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

</div>

<div class="container justify-content-end d-flex">
    <div class="w-50">
        Tabel met info van het product
    </div>
</div>

