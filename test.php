<?php
require __DIR__ . "/functies/algemeneFuncties.php";
require __DIR__ . "/functies/helpers.php";
require __DIR__ . "/functies/contentFuncties.php";
require __DIR__ . "/parts/head.php";
//body
$deals = getSpecialDeals();
foreach ($deals as $deal): ?>
<div>
    <?php
    require __DIR__ . "/Deals/parts/UniversalBanner.php";
    ?>
</div>



<?php
endforeach;
require __DIR__ . "/parts/footer.php";
?>
