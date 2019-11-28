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
        <?php dd($_GET['in']); endif; ?>

<?php
require __DIR__ . "/parts/footer.php";
?>

