<!-- <table> -->

<?php

?>
<tr>
    <th scope="row"></th>
    <th>Product Eigenschappen</th>
</tr>
<?php
if (!empty ($product['MarketingComments'])):
    ?>
    <tr>
        <th scope="row"> Opmerkingen</th>
        <td><?= $product['MarketingComments'] ?></td>
    </tr>
<?php
endif;
if (!empty ($product['Brand'])):
    ?>
    <tr>
        <th scope="row"> Merk</th>
        <td><?= $product['Brand'] ?></td>
    </tr>
<?php
endif;
if (!empty ($product['ColorID'])):
    ?>
    <tr>
        <th scope="row"> Kleur</th>
        <td><?= getColor($product['ColorID']) ?></td>
    </tr>
<?php
endif;
if (!empty ($product['Size'])):
    ?>
    <tr>
        <th scope="row"> Groote</th>
        <td><?= $product['Size'] ?></td>
    </tr>
<?php
endif;
if ($product['IsChillerStock'] != 0):
    ?>
    <tr>
        <th scope="row"> Gekoeld</th>
        <td> Ja</td>
    </tr>
    <!--    <tr>-->
    <!--        <th scopoe="row">-->
    <!--        <td>--><?//= "niks"
    ?><!--</td>-->
    <!--    </tr>-->
<?php
endif;
?>

<!-- </table> -->