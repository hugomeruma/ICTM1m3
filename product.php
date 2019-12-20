<?php
if (isset($_POST['reviewOpslaan'])) {
//    print_r($_POST);
    trim($_POST['Description']);
    $_POST['Description'] = (strip_tags($_POST['Description']));
    if ((!empty($_POST['Description']) or $_POST['Description'] = "") &&  $_POST['Description'] == strip_tags($_POST['Description'])) {
        insertReview($_POST['StockItemID'], $_POST['UserID'], $_POST['Name'], $_POST['Rating'], $_POST['Description']);
        redirect(haalGetVariabelenOpVoorUrl($_GET) . "&reviewOpslaan=true");
    } else {
        redirect(haalGetVariabelenOpVoorUrl($_GET) . "&reviewOpslaan=true&review=nva");
    }
}

$product = haalProductOpID($_GET['product'])[0];
$reviews = getAvgReviews($product["StockItemID"]);
$productTags = json_decode($product['CustomFields'], true)['Tags'];
$productData = array(
    "Omschrijving" => $product['MarketingComments'],
    "Merk" => $product['Brand'],
    "Maat" => $product['Size'],
    "Kleur" => haalKleurOp($product['ColorID']),
    "Dit product is gekoeld" => haalTempOp($product['IsChillerStock']),
    "Vooraad" => "",
    "Geproduceerd in" => json_decode($product['CustomFields'], true)['CountryOfManufacture']);
?>


<div class="d-flex flex-row container">
    <div class="w-50 d-flex justify-content-center justify-content-between">
        <div id="myCarousel" class="carousel slide" style="max-width: 500px; width: 500px" data-ride="carousel"
             data-interval="false">
            <div class="carousel-inner">
                <?php
                $imageInfo = getImages($product['StockItemID']);
                $first = true;
                foreach ($imageInfo as $image): ?>
                    <div class="carousel-item <?php if ($first == true) {
                        echo "active";
                    } ?>">
                        <img class="d-block w-100 carousel-image"
                             src="<?php echo("http://" . $_SERVER['SERVER_NAME'] . "/ICTM1m3/assets/afbeeldingen/" . $image[0]['Location']); ?>"
                             class="carousel-image">
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
    <div class="w-50 d-flex justify-content-center align-items-center flex-column">
        <div class="prijs position-relative d-flex justify-content-end" style="color: var(--gray);">€
            <?= price($product['StockItemID']); ?>
            <?php if (isset($off)): ?>
                <div class="discount-icon">
                    <div>
                        <span class="fa-stack " style="color: var(--green)"><i
                                    class="fas fa-certificate fa-stack-2x"></i>
                            <i class="fas fa-percent fa-stack-1x fa-inverse"></i></span>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php if (isset($off)): ?>

            <strong class="opmerking">Met <?= $off ?>% Korting!</strong>
        <?php endif; ?>
        <strong class="opmerking">Nog <?= haalVooraadOp($product['StockItemID']) ?> op vooraad.</strong>
        <div>
            <form method="post" class="my-3" action="<?= getBaseUrl() ?>">
                <input type="hidden" value="1" name="<?= $product['StockItemID'] ?>StockItemID">
                <button type="submit" name="toevoegenAanWinkelwagen"
                        class="btn btn-success btn-block justify-content-around">
                    <strong>Toevoegen aan winkelwagen</strong>
                    <i class="fas fa-shopping-cart button-icon"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<div class="mt-5 container d-flex">
    <div class="w-50">
        <div class="divider mb-3">
            <span class=divider-text-sm>Reviews</span>
        </div>

        <?php
        foreach (getReviews($product['StockItemID']) as $review):
            ?>

            <div class="border rounded m-2 p-2 bg-white">
                <div class="d-flex justify-content-between">
                    <div><?php stars($review['Rating']) ?> &nbsp; <b>(<?= $review['Rating'] / 2 ?>)</b></div>
                    <strong><?= $review['Name'] ?>&nbsp;</strong>
                </div>

                <div class="py-3">
                    <?= $review['Description'] ?>
                </div>
            </div>

        <?php
        endforeach;
        ?>
    </div>

    <div class="w-50 flex-column d-flex justify-content-between ml-5" style="height: 100%">
        <div class="divider mb-3">
            <span class=divider-text-sm>Product Eigenschappen</span>
        </div>

        <table class="table table-striped w-100">

            <tr>
                <th scope="row">Reviews:</th>
                <td>
                    <?= stars($reviews["avg"]) ?>&nbsp;&nbsp;<strong>(<?= $reviews['count'] ?>)</strong>
                </td>
            </tr>
            <?php
            if (!empty($productTags)):
                ?>
                <tr>
                    <th scope="row">Tags:</th>
                    <td>
                        <?php foreach ($productTags as $tag) {
                            echo "$tag &nbsp";
                        }
                        ?>
                    </td>
                </tr>
            <?php
            endif;
            foreach ($productData as $key => $value):
                if (!empty($value) or $value != ""):
                    ?>
                    <tr>
                        <th scope="row"><?= $key ?></th>
                        <td><?= $value ?></td>
                    </tr>
                <?php
                endif;
            endforeach;
            ?>
        </table>
        <?php
        if (!isset($_GET['ReviewOpgeslagen'])) {
            $magReview = reviewValidatie($product['StockItemID']);
            if ($magReview == 0):
                ?>
                <div class="h-100 d-flex flex-column w-100">

                    <div class="divider">
                        <span class=divider-text-sm>Schrijf hier je review</span>
                    </div>
                    <form action="<?= getBaseUrl() ?>?product=<?= $_GET['product'] ?>&categorie=<?= $_GET['categorie'] ?>"
                          class="d-block w-100" method="post">
                        <input type="hidden" name="StockItemID" value="<?= $product['StockItemID'] ?>">
                        <input type="hidden" name="UserID" value="<?= $_SESSION['id'] ?> ">
                        <input type="hidden" name="Name" value="<?= $_SESSION['name'] ?>">

                        <div class="flex-column d-flex form-group">
                            <div class="h-100 d-inline justify-content-center flex-column">

                                <div class="d-flex align-items-center">
                                    <div>
                                        <strong> Aantal sterren: &nbsp; &nbsp; </strong>
                                    </div>
                                    <fieldset class="Rating d-inline-block">

                                        <input type="radio" id="star5" name="Rating" value="10"/>
                                        <label class="full" for="star5"></label>

                                        <input type="radio" id="star4half" name="Rating" value="9"/>
                                        <label class="half" for="star4half"></label>

                                        <input type="radio" id="star4" name="Rating" value="8"/>
                                        <label class="full" for="star4"></label>

                                        <input type="radio" id="star3half" name="Rating" value="7"/>
                                        <label class="half" for="star3half"></label>

                                        <input type="radio" id="star3" name="Rating" value="6"/>
                                        <label class="full" for="star3"></label>

                                        <input type="radio" id="star2half" name="Rating" value="5"/>
                                        <label class="half" for="star2half"></label>

                                        <input type="radio" id="star2" name="Rating" value="4"/>
                                        <label class="full" for="star2"></label>

                                        <input type="radio" id="star1half" name="Rating" value="3"/>
                                        <label class="half" for="star1half"></label>

                                        <input type="radio" id="star1" name="Rating" value="2"/>
                                        <label class="full" for="star1"></label>

                                        <input type="radio" id="starhalf" name="Rating" value="1"/>
                                        <label class="half" for="starhalf"></label>
                                    </fieldset>
                                </div>
                            </div>

                            <textarea name="Description" type="text" placeholder="Plaats hier je review..."
                                      rows="5"
                                      class="text_review form-control-plaintext form-control form-control-sm form p-2"></textarea>
                            <div>
                                <button type="submit" class="btn btn-success py-1 px-3 m-1"
                                        name="reviewOpslaan">
                                    Review Opslaan <i class="fas fa-save ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            <?php
            elseif ($magReview == 1):
                ?>
                <div class="bg-primary d-block p-2 rounded-lg">
                    <?php
                    $userReview = haalUserReviewOp($_GET['product']);
                    ?>
                    <strong style="color: White; padding-left: 10px">
                        Je hebt al een review staan op dit product </strong>
                    <div class="border rounded m-2 p-2 bg-white">
                        <div class="d-flex justify-content-between row">
                            <div class="col-6 w-100 d-flex"><?php stars($userReview['Rating']) ?></div>
                            <div class="col-6 w-100"><strong><?= $userReview['Name'] ?></strong></div>
                        </div>

                        <div class="py-3">
                            <?= $userReview['Description'] ?>
                        </div>
                    </div>
                </div>
            <?php
            elseif ($magReview == 2):
                ?>
                <div class="d-block flex-column justify-content-center w-100 align-items-center">
                    <div class="border rounded p-3 d-flex flex-column justify-content-center align-items-center">
                        <strong>Om een review te kunnen plaatsen moet je ingelogd zijn</strong>
                        <a href="<?= getBaseURL() ?>login.php">
                            <button class="btn btn-success my-2"> Klink hier om in te loggen</button>
                        </a>
                    </div>
                </div>
            <?php
            endif;
        }
        ?>
    </div>
</div>
