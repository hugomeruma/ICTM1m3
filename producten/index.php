<?php
require $_SERVER['DOCUMENT_ROOT'] . "/ICTM1m3/functies/helpers.php";
require $_SERVER['DOCUMENT_ROOT'] . "/ICTM1m3/functies/contentFuncties.php";
require $_SERVER['DOCUMENT_ROOT'] . "/ICTM1m3/parts/head.php";
//body
?>

<div class="container">
    <?php
    echo "index.php producten<br>";
    echo $_SERVER['DOCUMENT_ROOT'] . "    (_SERVER['DOCUMENT_ROOT'])";
    echo "<br>";
    echo __DIR__ . "    (__DIR__)";
    ?>
</div>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/ICTM1m3/parts/footer.php";
?>

