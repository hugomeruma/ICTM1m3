<?php
require __DIR__ . "/functies/helpers.php";
require __DIR__ . "/functies/contentFuncties.php";
require __DIR__ . "/parts/head.php";
//body
?>

<div class="container">
    <?php
    echo "index.php <br>";
    echo $_SERVER['DOCUMENT_ROOT'] . "    (_SERVER['DOCUMENT_ROOT'])";
    echo "<br>";
    echo __DIR__ . "    (__DIR__)";

    ?>
</div>

<?php
require __DIR__ . "/parts/footer.php";
?>

