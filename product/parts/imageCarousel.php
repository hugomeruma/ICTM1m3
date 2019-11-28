<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
    <div class="carousel-inner">
        <?php
        $imageIDs = imgIDs($product["StockItemID"]);
        $first = true;
        foreach ($imageIDs as $imgID): ?>
            <div class="carousel-item <?php if ($first == true) {
                echo "active";
            } ?>">
                <img class="d-block w-100 carousel-image"
                     src="<?php echo("http://" . $_SERVER['SERVER_NAME'] . "/ICTM1m3/assets/afbeeldingen/" . $imgID . ".png"); ?>">
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
