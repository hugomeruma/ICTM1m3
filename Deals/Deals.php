<div class="jumbotron">
    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="2500">
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
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="jumbotron-title"><?= $deal['SpecialDealID'] ?></h5>
                                <h5 class="jumbotron-title"><?= $deal['StockItemID'] ?></h5>
                                <p class="jumbotron-text"><?= $deal['DealDescription'] ?></p>
                                <a class="btn btn-primary btn-lg" data-toggle="button" aria-pressed="true" href="<?= getBaseUrl() ?>product/index.php?view=<?= $product['StockItemID'] ?>&in=<?= $_GET['in'] ?>                                   role="button">Bekijk deal</a>
                            </div>
                            <div class="col-6">
                                <img src="
                                 <?php
                                $img = imgIDs($inputID, true);
                                echo("http://" . $_SERVER['SERVER_NAME'] . "/ICTM1m3/assets/afbeeldingen/" . $img . ".png");
                                ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $first = false;
            endforeach;
            ?>
        </div>
    </div>
</div>
