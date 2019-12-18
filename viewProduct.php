<?php
require_once "functies/content.php";
$product = haalProductOpID($_GET['product'])[0];
//dd($product);
//print_r(json_decode($product['CustomFields']));
$productTags = json_decode($product['CustomFields'], true)['Tags'];
$productData = array(
    "Omschrijving" => $product['MarketingComments'],
    "Merk" => $product['Brand'],
    "Maat" => $product['Size'],
    "Kleur" => haalKleurOp($product['ColorID']),
    "Dit product is gekoeld" => haalTempOp($product['IsChillerStock']),
    "Vooraad" => "",
    "Geproduceerd in" => json_decode($product['CustomFields'], true)['CountryOfManufacture'])
?>

<div class="d-flex flex-row">
    <div class="w-50 d-flex justify-content-center">
        <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
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
        <div class="prijs">€ <?= price($product['StockItemID']) ?></div>
        <?php if (isset($off)): ?>
            <strong class="opmerking">Met <?= $off ?>% Korting!</strong>
        <?php endif; ?>
        <strong class="opmerking">Nog <?= haalVooraadOp($product['StockItemID']) ?> op vooraad.</strong>
        <div>
            <form method="post" class="my-3">
                <input type="hidden" name="productID" value="<?= $product['StockItemID'] ?>">
                <button type="submit" name="toevoegenAanWinkelwagen"
                        class="btn btn-success btn-block justify-content-around">
                    <strong>Toevoegen aan winkelwagen</strong>
                    <i class="fas fa-shopping-cart button-icon"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<div class="mt-5 container justify-content-end d-flex">
    <div class="w-50">
        <table class="table table-striped">
            <tr>
                <th scope="row">Reviews:</th>
                <td>
                    <!--                    --><?php //stars();
                    //                    ?>
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
    </div>
</div>


<div class="mt-5 container d-flex flex-row">
    <div class="w-50"> Laat reviews zien</div>
    <div class="w-50"> Plaats een review</div>
</div>