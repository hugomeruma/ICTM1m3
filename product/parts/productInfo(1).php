<!-- <div class="col-6"> -->

<div class="prijs centerd">
    <?php if (getDiscount($_GET['view']) != null): ?>
        <div class="price-with-discount">
        <span class="fa-stack discount-icon">
            <i class="fas fa-certificate fa-stack-2x"></i>
            <i class="fas fa-percent fa-stack-1x fa-inverse"></i>
        </span>
            <div class="€discount"> € <?= price($product["UnitPrice"], $product["TaxRate"], $_GET['view']) ?></div>
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

    <button type="button" class="btn btn-primary button-toevoegen justify-content-around">
        <i class="fas fa-shopping-basket button-icon"></i>
        <span class="button-tekst">&nbsp;Toevoegen aan winkelmandje</span>
    </button>
</div>


<table class="table table-striped">
    <?php
    require __DIR__ . "/infoTabel.php";
    ?>
</table>

<!-- </div> -->
