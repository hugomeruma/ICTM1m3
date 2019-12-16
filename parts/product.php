<div class="card mb-3">
    <a href="<?= getBaseUrl() ?>product.php?id=<?= $product['StockItemID'] ?>">
        <img src="<?= getBaseUrl() ?>assets/afbeeldingen/<?= $product['afbeelding']['location'] ?? 'afbeelding_niet_beschikbaar.png' ?>"
             class="card-img-top" alt="...">
    </a>
    <div class="card-body">
        <a href="<?= getBaseUrl() ?>product.php?id=<?= $product['StockItemID'] ?>">
            <h5 class="card-title"><?= $product['StockItemName'] ?></h5>
        </a>

        <!-- Gemiddelde beoordeling -->
        <span class="text-primary">
    <?php if ($product['gemiddeldeBeoordeling']):
        // for loop tot het aantal sterren
        for ($x = 0; $x <= $product['gemiddeldeBeoordeling']; $x++):
            // Als het de laatste ster is en het aantal sterren oneven is: laat een half ingevulde ster zien
            if ((($x + 1) == $product['gemiddeldeBeoordeling']) && !(($product['gemiddeldeBeoordeling'] % 2) == 0)): ?>
                <i class="fas fa-star-half-alt"></i>
                <!-- Als er vaker is geloopt dan het aantal sterren en de laatste geen halve ster is -->
            <?php elseif (($x + 1) < $product['gemiddeldeBeoordeling']): ?>
                <i class="fas fa-star"></i>
                <!-- Extra plus omdat een hele ster voor twee telt -->
                <?php $x++; endif;
        endfor;
        // Vul het resterende aan met lege sterren
        while ($x < 10): ?>
            <i class="far fa-star"></i>
            <?php $x += 2;
        endwhile; ?>
        (<?= $product['aantalBeoordelingen'] ?>)
    <?php endif; ?>
    </span>

        <h5><strong><?= $product['UnitPrice'] ?></strong></h5>
        <form method="post">
            <input type="hidden" name="productID" value="<?= $product['StockItemID'] ?>">
            <button type="submit" name="toevoegenAanWinkelwagen"
                    class="btn btn-success btn-block justify-content-around">
                <i class="fas fa-plus button-icon"></i>
                <i class="fas fa-shopping-cart button-icon"></i>
            </button>
        </form>
    </div>
</div>