<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="5000">
    <div class="carousel-inner">
        <?php
        $first = true;
        foreach (getSpecialDeals() as $deal): ?>
            <div class="carousel-item <?php if ($first == true) {
                echo "active";
            } ?>">
                <div class="jumbotron">
                    <img src="
                    <?php
                    if (empty($deal["StockItemID"])) {
                        $inputID = $deal["StockGroupID"];
                    } else {
                        $inputID = $deal["StockItemID"];
                    }

                    $img = imgIDs($inputID, true);
                    echo("http://" . $_SERVER['SERVER_NAME'] . "/ICTM1m3/assets/afbeeldingen/" . $img . ".png");
                    ?>">

                    <h5 class="jumbotron-title"><?= $deal['SpecialDealID'] ?></h5>
                    <p class="jumbotron-text"><?= $deal['DealDescription'] ?></p>
                    <a class="btn btn-primary btn-lg" href="#" role="button">Bekijk deal</a>
                </div>
            </div>
            <?php $first = false;
        endforeach; ?>
    </div>
</div>