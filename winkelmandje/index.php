<?php

require __dir__ . "/../functies/algemeneFuncties.php";
require __dir__ . "/../functies/helpers.php";
require __dir__ . "/../functies/contentFuncties.php";
require __dir__ . "/../parts/head.php";

?>

<!--    <div class="my-5">-->
<!--        --><?php
//        $key = "StockItemID1";
//        if (strpos($key, 'StockItemID') !== false) {
//            echo "$key";
//            $key = str_replace('StockItemID', '', $key);
////            $_SESSION['producten'][$key] = $value;
//            echo "<h1>$key</h1>";
//        }
//        ?>
<!--    </div>-->

<?php
if (isset($_POST['opslaan'])) {
    echo "test 1";
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'StockItemID') !== false) {
            echo "$key";
            $key = str_replace('StockItemID', '', $key);
            $_SESSION['producten'][$key] = $value;
        }
    }
    redirect('winkelmandje/');
}

if (isset($_POST['StockItemID'])) {
    print_r($_SESSION['producten'][$_POST['StockItemID']]);
    if (isset($_SESSION['producten'][$_POST['StockItemID']])) {
        $i = $_SESSION['producten'][$_POST['StockItemID']] + 1;
    } else {
        $i = 1;
    }
    $_SESSION['producten'][$_POST['StockItemID']] = $i;

    redirect('winkelmandje/');
}


$winkelwagen = array();
if (isset($_SESSION['producten'])) {
    $winkelwagen = getStockItems($_SESSION['producten']);
}

$totaalorder = 0;

?>
    <div class="container">
        <form method="post">
            <?php
            foreach ($winkelwagen as $product):


                ?>
                <div class="container row product_kaart my-4">
                    <?php require "parts/item.php" ?>


                </div>
            <?php


            endforeach;


            ?>

            <button type="submit" value="opslaan" class="opslaan_winkelmandje btn btn-primary" name="opslaan">
                Winkelmandje opslaan
            </button>
        </form>
    </div>

    <div class="my-5">
        <?php
        print_r($_SESSION);
        echo "<br>";
        print_r($_POST)
        ?>
    </div>
<?php


require __dir__ . "/../parts/footer.php";
?>