<!-- <table> -->

<?php
foreach ($product as $key => $value) {
    if ("" != ($value)) {
        unset($product[$value]);
    }
}

?>

<!-- </table> -->