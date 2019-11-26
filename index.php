<?php
require __DIR__ . "/functies/algemeneFuncties.php";
require __DIR__ . "/functies/helpers.php";
require __DIR__ . "/functies/contentFuncties.php";
require __DIR__ . "/parts/head.php";
//body
dd(__DIR__ . "/assets/afbeeldingen/cat" . $img . ".png");
?>
<div class="container my-5" style="vertical-align:middle">
    <?php
    $producten = opvragenProducten();
    if (empty($producten)): ?>
        <br> Er zijn geen producten gevonden <br>
    <?php endif; ?>

    <?php if (!empty($producten))
                require "hoofdpagina.php"
    ?>

<?php
require __DIR__ . "/parts/footer.php";
?>

