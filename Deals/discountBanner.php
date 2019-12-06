<?php
$deals = getSpecialDeals();
?>

<div class="container-fluid">
    <div id="carouselExampleSlidesOnly" class="carousel slide deal-carousel-item" data-ride="carousel"
         date-interval="500">
        <div class="carousel-inner">
            <div class="carousel-item active deal-carousel-item">
                <?php
                require __DIR__ . "/parts/FirstBanner.php"; ?>
            </div>
            <?php
            foreach ($deals as $deal):
            ?>
            <div class="carousel-item deal-carousel-item">
                <?php
                require __DIR__ . "/parts/FirstBanner.php"; ?>

            </div>
            <?php
            endforeach;
            ?>
        </div>
    </div>
</div>
