<!-- <div class="col-6"> -->

<div class="prijs centerd">
    <?php if(getDiscount($_GET['view']) != null):?>
        <span class="€%"> € <?= price($product["UnitPrice"], $product["TaxRate"], $_GET['view']) ?>,-</span>
    <?php else: ?>
        <span class="€"> € <?= price($product["UnitPrice"], $product["TaxRate"], $_GET['view']) ?>,-</span>
    <?php endif; ?>
    <div class="opmerking"> incl. btw (<?= $product["TaxRate"] / 100 ?>%)</div>
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
