<?php if ($deal['StockItemID'] != null): ?>

    <div class="grid-container my-5">
        <div class="banner-text">
            Some text
        </div>
        <div class="banner-image">

        </div>
    </div>


<?php endif;
if ($deal['StockGroupID'] != null): ?>

    <div class="container col banner-base my-5">

        <div class="banner-text d-inline">
            <?= $deal['DealDescription'] ?>
        </div>

        <!--        <a class="stretched-link " href="--><? //= getBaseUrl() ?><!--browsen/?in=-->
        <? //= $deal['StockGroupID'] ?><!--&page=1&pp=10"></a>-->
    </div>
<?php endif; ?>