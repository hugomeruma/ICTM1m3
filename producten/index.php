<?php
require $_SERVER['DOCUMENT_ROOT'] . "/ICTM1m3/functies/helpers.php";
require $_SERVER['DOCUMENT_ROOT'] . "/ICTM1m3/functies/contentFuncties.php";
require $_SERVER['DOCUMENT_ROOT'] . "/ICTM1m3/parts/head.php";
//body
?>

<div class="container my-3">
    <?php toonProducten(); ?>
</div>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/ICTM1m3/parts/footer.php";
?>

