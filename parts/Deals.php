<?php
?>
<div class="container">
    <div class="row">
        <div class="col-sm">

            <div class="card"  style="width: 18rem;">

                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" >
                    <div class="carousel-inner">
                        <?php
                        $imageIDs = imgIDs(17);
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
                </div>
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-sm">

            <div class="card"  style="width: 18rem;">

                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" >
                    <div class="carousel-inner">
                        <?php
                        $imageIDs = imgIDs(17);
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
                </div>

                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-sm">

            <div class="card"  style="width: 18rem;">

                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" >
                    <div class="carousel-inner">
                        <?php
                        $imageIDs = imgIDs(17);
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
                </div>

                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
</div>