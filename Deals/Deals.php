<div class="container-fluid">
    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
        <div class="carousel-inner">
            <?php
            $first = true;
            foreach (getSpecialDeals() as $deal):
                if (empty($deal["StockItemID"])) {
                    $inputID = $deal["StockGroupID"];
                } else {
                    $inputID = $deal["StockItemID"];
                }
                ?>
                <div class="carousel-item deal-carousel-item <?php if ($first == true) {
                    echo "active";
                } ?>">
                    <div class="jumbotron-item jumbotron-deals">
                        <div class="jumbotron-info">
                            <h1><?= $deal["DealDescription"] ?></h1>
                            <h2><?php
                                if (empty($deal["StockItemID"])): echo getMaxDiscountStockGroup($deal["StockGroupID"], $deal["DiscountPercentage"]) ?>

                                <?php endif ?>
                            </h2>
                        </div>
                        <div class="jumbotron-item jumbotron-deals-images">
                            <img src="
                                 <?php
                            $img = imgIDs($inputID, true);
                            echo("http://" . $_SERVER['SERVER_NAME'] . "/ICTM1m3/assets/afbeeldingen/" . $img . ".png");
                            ?>">
                        </div>
                    </div>
                    <!--                    <a class="stretched-link" href=""></a>-->
                </div>
                <?php
                $first = false;
            endforeach;
            ?>
        </div>
    </div>
</div>
