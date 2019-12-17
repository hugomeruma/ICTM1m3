<div class="startpagina_header container-fluid">
    <h2 class="startpagina_header_medium fly-in">
        Welkom bij</h2>
    <h1 class="startpagina_header_large fly-in-rtl">
        Wide World <span style="font-size: 100px">&nbsp;</span>
        <span style="color: #8F8F8E">
         Importers</span>
    </h1>
    <!--    <h2 class="region__header-title" data-test="region-header-title"> Onze aanraders</h2>-->
</div>
<div class="container-fluid divider">
    <div class="divider-text"> Our Special Deals</div>
</div>
<?php
require __DIR__ . "/Deals/Deals.php";
?>

<div class="container-fluid Popular-divider">
    <div class="Popular-divider-text"> Our popular products </div>
</div>

<?php
$meestPopulair = populaireProducten();
foreach ($meestPopulair as $product): ?>
    <div class="col-sm-3">
        <?php require __DIR__ . '/parts/product.php'; ?>
    </div>
<?php endforeach; ?>

<?php
require __DIR__ . "/Deals/parts/PopularProducts.php";
?>

    <?php
require __DIR__ . "/parts/footer.php";
?>
