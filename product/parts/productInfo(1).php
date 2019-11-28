<!-- <div class="col-6"> -->

<div class="prijs centerd">
    <span class="€"> € <?= price($product["UnitPrice"], $product["TaxRate"]) ?>,-</span>
    <div class="opmerking"> incl. btw (<?= $product["TaxRate"] / 100 ?>%)</div>
    <!--    <div class="opmerking"> --><? //= $stock ?><!--</div>-->
</div>
<form action="<?= getBaseUrl() ?>winkelmandje/index.php" method="post" class="form-inline my-2 my-lg-0">
    <input type="hidden" name="StockItemID" value="<?= $product['StockItemID'] ?>">

    <div class="button centerd">
        <button type="submit" class="btn btn-primary button-toevoegen justify-content-around">
            <i class="fas fa-shopping-basket button-icon"></i>
            <span class="button-tekst">&nbsp;Toevoegen aan winkelmandje</span>
        </button>
    </div>
</form>


<table class="table table-striped">
    <?php
    require __DIR__ . "/infoTabel.php";
    ?>
</table>

<!-- </div> -->
<?php
require __dir__ . "/../parts/footer.php";
?>