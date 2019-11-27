<!-- <div class="col-6"> -->

<div class="prijs centerd">
    <span class="€"> € <?= price($product["UnitPrice"], $product["UnitPrice"]) ?>,-</span>
    <div class="opmerking"> incl. btw (<?= $product["UnitPrice"] / 100 ?>%)</div>
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
