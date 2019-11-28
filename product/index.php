<?php
require __dir__ . "/../functies/algemeneFuncties.php";
require __dir__ . "/../functies/helpers.php";
require __dir__ . "/../functies/contentFuncties.php";
require __dir__ . "/../parts/head.php";
require __DIR__ . "/../functies/productFuncties.php";
?>
<div class="container 1 mt-5">
    <h6>Producten > <?php if (!empty($_GET['in'])) {
            echo currentStockGroup($product["StockItemID"]) . " > ";
        }
        echo "<span style='font-weight: bold'>" . $product['StockItemName'] . "</span>" ?></h6>
    <?php
    echo "<br>";
    ?>
</div>

<div class="container my-2 mb-5">
    <div class="row">
        <div class="col-6">

            <?php
            require __DIR__ . "/parts/imageCarousel.php";
            ?>

        </div>

        <div class="col-6 product-info">

            <?php
            require __DIR__ . "/parts/productInfo(1).php";
            ?>

        </div>
    </div>
</div>

<div class="container">
    <div class="row d-block">
        <?php
        require __DIR__ . "/parts/showReview.php";
        ?>

        <?php
        require __DIR__ . "/parts/plaatsReview.php";
        ?>
    </div>
</div>

<?php

//print_r (imgIDs($product['StockItemID']));

require __dir__ . "/../parts/footer.php";
?>

