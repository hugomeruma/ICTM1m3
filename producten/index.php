<?php
require $_SERVER['DOCUMENT_ROOT'] . "/ICTM1m3/functies/helpers.php";
require $_SERVER['DOCUMENT_ROOT'] . "/ICTM1m3/functies/contentFuncties.php";
require $_SERVER['DOCUMENT_ROOT'] . "/ICTM1m3/parts/head.php";
//body
?>

<div class="container my-3">
    <h4>Producten > </h4>
    <form action='' method='get'>
        Resultaten per pagina
        <input type="number" name="pp" min="10" max="50" step="10" value="<?= $_GET['pp'] ?>">
        <input type="hidden" name="page" value="<?= $_GET['page'] ?>">
        <input type="hidden" name="in" value="<?= $_GET['page'] ?>">
    </form>
    <?php
    $producten = opvragenProducten();
    if (empty($producten)): ?>
        <br> Er zijn geen producten gevonden <br>
    <?php endif; ?>
    <?php if (!empty($producten)) {
        foreach ($producten

                 as $product): ?>
            <div class='product_item row'>
                <div class="col-1">
                    image
                </div>
                <div class="col-5 row">
                    <div class="col-5">
                        <h5>  <?= $product["StockItemName"] ?></h5>
                    </div>
                </div>
            </div>>
        <?php endforeach;
    }
    $aantalPaginas = telPaginas(tellenProducten($_GET['in']), $_GET['pp']);
    if (isset($_GET['page'])) {
        $vorige = $_GET['page'] - 1;
        $volgende = $_GET['page'] + 1;
    } else {
        $vorige = 0;
        $volgende = 2;
    }
    ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item<?= ($vorige < 1) ? ' disabled' : '' ?>">
                <a class="page-link"
                   href="/ICTM1m3/producten?page=<?= $vorige ?>&in=<?= $_GET['in'] ?>&pp=<?= $_GET['pp'] ?>"
                   tabindex="-1"
                   aria-disabled="true">Vorige</a>
            </li>
            <?php foreach (paginaNummering($_GET['page'] ?? 0, $aantalPaginas) as $key => $paginaNummer): ?>
                <li class="page-item<?= ($key === 'selected') ? ' active' : '' ?>"><a class="page-link"
                                                                                      href="/ICTM1m3/producten?page=<?= $paginaNummer ?>&in=<?= $_GET['in'] ?>&pp=<?= $_GET['pp'] ?>"><?= $paginaNummer ?></a>
                </li>
            <?php endforeach; ?>
            <li class="page-item<?= ($volgende >= $aantalPaginas) ? ' disabled' : '' ?>">
                <a class="page-link"
                   href="/ICTM1m3/producten?page=<?= $volgende ?>&in=<?= $_GET['in'] ?>&pp=<?= $_GET['pp'] ?>">Volgende</a>
            </li>
        </ul>
    </nav>
    <form action='' method='get'>
        Resultaten per pagina
        <input type="number" name="pp" min="10" max="50" step="10" value="<?= $_GET['pp'] ?>">
        <input type="hidden" name="page" value="<?= $_GET['page'] ?>">
        <input type="hidden" name="in" value="<?= $_GET['page'] ?>">
    </form>
</div>
<?php

require $_SERVER['DOCUMENT_ROOT'] . "/ICTM1m3/parts/footer.php";
?>

