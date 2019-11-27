<!-- <table> -->

<?php
foreach ($product as $key => $value) {
    if ("" == ($value) or "0" == ($value)) {
        unset($product[$key]);
    }
}
foreach ($product as $key => $value) :
    ?>
    <tr>
        <th scope="row"><?= $key ?></th>
        <td><?= $value ?></td>
    </tr>
<?php
endforeach;
?>

<tr>
    <th scope="row"><?= $key ?></th>
    <td><?= $product ?></td>
</tr>

<!-- </table> -->