<?php
require __dir__ . "/../functies/algemeneFuncties.php";
require __dir__ . "/../functies/helpers.php";
require __dir__ . "/../functies/contentFuncties.php";
require __dir__ . "/../parts/head.php";
require __DIR__ . "/../functies/productFuncties.php";
//require __dir__ . "/../Deals/discountBanner.php";
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

        <p>
        <div class="form-inline">
            <button class="btn btn-primary review-option mr-5" type="button" data-toggle="collapse"
                    data-target="#show-reviews"
                    aria-expanded="false" aria-controls="collapseExample">
                Reviews tonen
            </button>
            <?php
            if (isset($_SESSION["ingelogd"])):
                ?>
                <button class="btn btn-primary review-option w-100" type="button" data-toggle="collapse"
                        data-target="#plaats-een-review"
                        aria-expanded="false" aria-controls="collapseExample">
                    Plaats een review &nbsp;<i class="fas fa-pencil-alt"></i>
                </button>
            <?php else: ?>
                <button class="btn btn-secondary w-auto" type="button" data-toggle="collapse"
                        data-target="#plaats-een-review"
                        aria-expanded="false" aria-controls="collapseExample">
                    Plaats een review &nbsp;<i class="fas fa-pencil-alt"></i>
                </button>
            <?php endif; ?>
        </div>
        </p>
        <div class="collapse" id="plaats-een-review">
            <div class="card card-body review-form">
                <?php require "parts/PlaatsReview.php"; ?>
            </div>
        </div>

        <div class="collapse" id="show-reviews" class="show-review">
            <div class="card card-body">
                <?php
                $reviews = getReviews($_GET['view']);
                if (empty($reviews)): ?>
                    <h4> Er zijn geen reviews gevonden bij dit product</h4>
                <?php
                else:
                    foreach ($reviews as $review):
                        ?>
                        <div class="col review-box">
                            <div class="row review-header-row">
                                <div class="col review-header">
                                    <?= $review['UserName'] ?>
                                </div>
                                <div class="col review-rating">
                                    <?= stars($review['Rating']) ?>
                                </div>
                            </div>
                            <div class="row review-text-row">
                                <div class="col review-text">
                                    <?= $review['Description'] ?>
                                </div>
                            </div>
                            <div class="row justify-content-end review-bottom">
                                <div class="col review-rating">
                                    <?= stars($review['Rating']) ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </div>

<?php
//print_r (imgIDs($product['StockItemID']));
require __dir__ . "/../parts/footer.php";
?>