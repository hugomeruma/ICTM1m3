<?php
require __dir__ . "/../functies/algemeneFuncties.php";
require __dir__ . "/../functies/helpers.php";
require __dir__ . "/../functies/contentFuncties.php";
require __dir__ . "/../parts/head.php";

require __dir__ . "/../Deals/discountBanner.php";
require __dir__ . "/../functies/productFuncties.php";

?>
    <div class="container 1">
        <h6>Producten > <?php if (!empty($_GET['in'])) {
                echo currentStockGroup($product["StockItemID"]) . " > ";
            }
            echo "<span style='font-weight: bold'>" . $product['StockItemName'] . "</span>" ?></h6>
        <?php
        echo "<br>";
        if (isset($_POST['rating'])) {
            print_r($_POST);
            insertReview($_POST['stockItemID'], $_POST['userID'], $_POST['name'], $_POST['rating'], $_POST['Description']);
            redirect('product/index.php?view=' . $_GET['view'] . '&in=' . $_GET['in'] . "&opgeslagen=opgeslagen#show-reviews");
        }
        ?>

    </div>
    <div class="container my-2 mb-5">
        <div class="row">
            <div class="col-6">
                <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
                    <div class="carousel-inner">
                        <?php
                        $imageIDs = imgIDs($product["StockItemID"], "true");
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
            </div>

            <div class="col-6 product-info">
                <!-- <div class="col-6"> -->

                <div class="prijs centerd">
                    <?php if (getDiscount($_GET['view']) != null): ?>
                        <div class="price-with-discount">
        <span class="fa-stack discount-icon">
            <i class="fas fa-certificate fa-stack-2x"></i>
            <i class="fas fa-percent fa-stack-1x fa-inverse"></i>
        </span>
                            <div class="€discount">
                                € <?= price($product["UnitPrice"], $product["TaxRate"], $_GET['view']) ?></div>
                        </div>
                    <?php else: ?>
                        <div class="€"> € <?= price($product["UnitPrice"], $product["TaxRate"], $_GET['view']) ?></div>
                    <?php endif; ?>
                    <div class="opmerking">
                        incl. btw (<?= $product["TaxRate"] / 100 ?>%)<br>
                    </div>
                    <?php
                    $stock = getStockHolding($_GET['view']);
                    if ($stock >= 0): ?>
                        Dit product is niet meer op voorraad
                    <?php endif; ?>

                    <!--    <div class="opmerking"> --><? //= $stock ?><!--</div>-->
                </div>
                <div class="button centerd">
                    <form action="<?= getBaseUrl() ?>winkelmandje/index.php" method="post"
                          class="form-inline my-2 my-lg-0 d-inline-block">
                        <input type="hidden" name="StockItemID" value="<?= $product['StockItemID'] ?>">


                        <button type="submit" class="btn btn-primary button-toevoegen justify-content-around">
                            <i class="fas fa-shopping-basket button-icon"></i>
                            <span class="button-tekst">&nbsp;Toevoegen aan winkelmandje</span>
                        </button>

                    </form>
                </div>


                <table class="table table-striped">
                    <!-- <table> -->
                    <tr>
                        <th scope="row"></th>
                        <th>Product Eigenschappen</th>
                    </tr>
                    <?php
                    if (!empty ($product['MarketingComments'])):
                        ?>
                        <tr>
                            <th scope="row"> Opmerkingen</th>
                            <td><?= $product['MarketingComments'] ?></td>
                        </tr>
                    <?php
                    endif;
                    if (!empty ($product['Brand'])):
                        ?>
                        <tr>
                            <th scope="row"> Merk</th>
                            <td><?= $product['Brand'] ?></td>
                        </tr>
                    <?php
                    endif;
                    if (!empty ($product['ColorID'])):
                        ?>
                        <tr>
                            <th scope="row"> Kleur</th>
                            <td><?= getColor($product['ColorID']) ?></td>
                        </tr>
                    <?php
                    endif;
                    if (!empty ($product['Size'])):
                        ?>
                        <tr>
                            <th scope="row"> Groote</th>
                            <td><?= $product['Size'] ?></td>
                        </tr>
                    <?php
                    endif;
                    if ($product['IsChillerStock'] != 0):
                        ?>
                        <tr>
                            <th scope="row"> Gekoeld</th>
                            <td> Ja</td>
                        </tr>
                        <!--    <tr>-->
                        <!--        <th scopoe="row">-->
                        <!--        <td>--><?//= "niks"
                        ?><!--</td>-->
                        <!--    </tr>-->
                    <?php
                    endif;
                    ?>
                </table>


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
                        data-target="#plaats-een-review" href="#show-reviews"
                        aria-expanded="false" aria-controls="collapseExample">
                    Plaats een review &nbsp;<i class="fas fa-pencil-alt"></i>
                </button>
            <?php endif; ?>
        </div>
        </p>
        <div class="collapse" id="plaats-een-review">
            <div class="card card-body review-form">
                <?php
                if (!isset($_SESSION['ingelogd'])):?>
                    <h6 class="review-form-NA-text">Je bent nog niet ingelogd.</h6>
                    <div class="button centerd">
                        <button type="button" class="btn btn-primary justify-content-around review-NA-btn">
                            Klik hier om in te loggen.
                        </button>
                    </div>

                    <?php
//Hier komt een "elseif" om te kijken of het voorwerp daadwerkelijk gekocht is.
                    ?>
                    <div class="review-form-NA justify-content-center">
                        <h6 class="review-form-NA-text">Je hebt het product nog niet gekocht.</h6>
                    </div>
                <?php else: ?>
                    <form method="POST">
                        <input type="hidden" name="stockItemID" value="<?= $_GET['view'] ?>">
                        <input type="hidden" name="userID" value="<?= $_SESSION['id'] ?>">
                        <input type="hidden" name="name" value="<?= $_SESSION['name'] ?>">

                        <div class="form-group">
                            <input type="number" name="rating" value="10" placeholder="">
                            <button type="submit" class="btn btn-primary mb-2 review-option">Verstuur</button>
                        </div>


                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Plaats hier uw review</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="Description"
                                      rows="5"></textarea>
                        </div>
                    </form>
                <?php
                endif;
                ?>
            </div>
        </div>

        <div class="collapse in" id="show-reviews" class="show-review">
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
                                    <?= $review['Name'] ?>
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