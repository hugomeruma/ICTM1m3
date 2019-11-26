<?php
require __dir__ . "/../functies/algemeneFuncties.php";
require __dir__ . "/../functies/helpers.php";
require __dir__ . "/../functies/contentFuncties.php";
require __dir__ . "/../parts/head.php";

$product = getStockItem($_GET['view']);

?>
<div class="container mt-5">
    <h6>Producten > <?php if (!empty($_GET['in'])) {
            echo currentStockGroup($_GET['in']) . " > ";
        }
        echo $product['StockItemName'] ?></h6>
    <?php
    echo "<br>";
    ?>
</div>

<div class="container my-2">
    <div class="row">
        <div class="col-5">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

                <div class="carousel-inner">

                    <?php
                    $imageIDs = imgIDs();
                    $first = true;
                    foreach ($imageIDs as $imgID): ?>

                        <div class="carousel-item<?php if ($first == true) {
                            echo " active";
                        } ?>">

                            <img class="d-block w-100"
                                 src="<?php echo("http://" . $_SERVER['SERVER_NAME'] . "/ICTM1m3/assets/afbeeldingen/" . $imgID . ".png"); ?>"
                                 alt="">

                        </div>

                        <?php $first = false;
                    endforeach; ?>

                </div>

                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>

                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>

            </div>

        </div>

        <div class="col-1">

        </div>
        <div class="col-6 py-2" style="background: #f1f1f1">
            <h2 style="margin-bottom: 0px">
                € <?= number_format($product["UnitPrice"] * (($product["UnitPrice"] / 100) + 1), 2) ?>,-</h2>
            <dl class="row mt-2">
                <dt class="col-sm-3">Description lists</dt>
                <dd class="col-sm-9"></dd>

            </dl>
            </dd>
            </dl>
        </div>

    </div>
</div>


<?php

//print_r (imgIDs($product['StockItemID']));

require __dir__ . "/../parts/footer.php";
?>

