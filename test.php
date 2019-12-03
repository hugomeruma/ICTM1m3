<?php
require __DIR__ . "/functies/algemeneFuncties.php";
require __DIR__ . "/functies/helpers.php";
require __DIR__ . "/functies/contentFuncties.php";
//require __DIR__ . "/parts/head.php";


//body

require __DIR__ . "/Deals/parts/FirstBanner.php ";


//$deals = getSpecialDeals();
//foreach ($deals as $deal): ?>
<!---->
<!--    --><?php
//    require __DIR__ . "/Deals/parts/UniversalBanner.php";
//    ?>
<!---->
<!---->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CSS Overlaying One DIV over Another DIV</title>
    <style>
        .container {
            width: 200px;
            height: 200px;
            position: relative;
            /*margin: 20px;*/
        }

        .box {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0.8; /* for demo purpose  */

        }

        .stack-top {
            /*z-index: 9;*/
            /*margin: 20px; !* for demo purpose  *!*/
        }
    </style>
</head>
<body>
<div class="container">
    <div class="box" style="background: red;"></div>
    <div class="box stack-top" style="background: blue;">test</div>
</div>
</body>
</html>


<?php
//endforeach;
require __DIR__ . "/parts/footer.php";
?>
