<?php //if ($stock <= 0): ?>
    <!--<div class="container" style="position: absolute">-->
    <!--    <div class="disabled d-flex" id="centerThis">-->
    <!--        Dit product is niet beschikbaar-->
    <!--    </div>-->
    <!--    --><?php //endif; ?>
    <div class="container row product_kaart my-4" <?php if ($stock <= 0): ?>id="test" <?php endif; ?>>
        <?php if ($stock <= 0): ?>
        <?php endif; ?>

        <div class="col-2">
            <img src="
    <?php
            $img = imgIDs($product["StockItemID"], true);
            echo("http://" . $_SERVER['SERVER_NAME'] . "/ICTM1m3/assets/afbeeldingen/" . $img . ".png");
            ?>"
                 class="img<?php if ($stock <= 0): ?> GrayOut<?php endif; ?>"
                 <?php if ($stock <= 0): ?>id="wrapper"<?php endif; ?>>
            <a href="<?= getBaseUrl() ?>product/index.php?view=<?= $product['StockItemID'] ?>&in=<?= $_GET['in'] ?>"
               class="stretched-link"></a>
            <?php if (getDiscount($product['StockItemID']) != null): ?>
                <div class="discount-icon-div-on-item">
                <span class="fa-stack discount-icon-on-item">
                    <i class="fas fa-certificate fa-stack-2x"></i>
                    <i class="fas fa-percent fa-stack-1x fa-inverse"></i>
                </span>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-6 product-item_content py-2">

            <div class="product_info" style="<?php if ($stock <= 0): ?>color: darkgray <?php endif; ?>">
                <h5><?= $product['StockItemName'] ?></h5>
                <?php
                if (!empty($product['MarketingComments'])): ?>
                    <h6><?= $product['MarketingComments'] ?></h6>
                <?php else: ?>
                    <h6><?= $product['Tags'] ?></h6>
                <?php endif;
                $review = getAvgReviews($product['StockItemID']);
                echo stars($review[0]["AVG(Rating)"]);
                ?>
                <a href="<?= getBaseUrl() ?>product/index.php?view=<?= $product['StockItemID'] ?>&in=<?= $_GET['in'] ?>"
                   class="stretched-link"></a>
            </div>

        </div>

        <div class="col-3 product-prijs"
             style="text-align: right<?php if ($stock <= 0): ?>; color: darkgray <?php endif; ?>">

            <h5 style="margin-bottom: 0px">
                <div class="€"> € <?=    price($product["UnitPrice"], $product["TaxRate"], $product['StockItemID']) ?>,-
                </div>
            </h5>


            <span style="font-size: 12px">incl. btw (<?= $product["TaxRate"] / 100 ?>%) </span>
            <br>
            <?php if ($stock > 0): ?>
                <span style="font-size: 12px">nog
        <?php
        if ($stock <= 10000) {
            $span = "<span class='StockIsDanger'>";
        } else {
            $span = "<span>";
        }
        echo $span . $stock . "</span>"
        ?>
        op vooraad.</span>
            <?php endif; ?>
        </div>
        <div class="col-1">
            <div class="SmallBasket">
                <form action="<?= getBaseUrl() ?>winkelmandje/index.php" method="post" class="form-inline my-2 my-lg-0 d-flex">
                    <input type="hidden" name="StockItemID" value="<?= $product['StockItemID'] ?>">


                    <button type="submit" class="btn btn-primary button-toevoegen justify-content-around">
                        <i class="fas fa-shopping-basket button-icon"></i>
                    </button>

                </form>
            </div>
        </div>
    </div>
    <!--    --><?php //if ($stock <= 0): ?>
    <!--</div>-->
<?php //endif; ?>