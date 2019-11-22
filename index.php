<?php
require __DIR__ . "/functies/algemeneFuncties.php";
require __DIR__ . "/functies/helpers.php";
require __DIR__ . "/functies/contentFuncties.php";
require __DIR__ . "/parts/head.php";
//body
?>
<div class="container my-5" style="vertical-align:middle">
    <?php
    $producten = opvragenProducten();
    if (empty($producten)): ?>
        <br> Er zijn geen producten gevonden <br>
    <?php endif; ?>
    <?php if (!empty($producten)) {
        foreach ($producten
                 as $product): ?>
            <div class="container row product_kaart my-5">
                <?php require "producten/productkaart.php" ?>
            </div>

        <?php endforeach;
    }
    ?>

<?php
require __DIR__ . "/parts/footer.php";
?>

