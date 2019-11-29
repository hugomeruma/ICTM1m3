<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="5000">
    <div class="carousel-inner">
        <?php
        $first = true;
        foreach (getSpecialDeals() as $deal): ?>
            <div class="carousel-item <?php if ($first == true) {
                echo "active";
            } ?>">
                <div class="card" style="width: 18rem;">
                    <img src="
                    <?php
                    if (empty($deal["StockItemID"])) {
                        $inputID = $deal["StockGroupID"];
                    } else {
                        $inputID = $deal["StockItemID"];
                    }

                    $img = imgIDs($inputID, true);
                    echo("http://" . $_SERVER['SERVER_NAME'] . "/ICTM1m3/assets/afbeeldingen/" . $img . ".png");
                    ?>"
                         class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $deal['SpecialDealID'] ?></h5>
                        <p class="card-text"><?= $deal['DealDescription'] ?></p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <?php $first = false;
        endforeach; ?>
    </div>
</div>
