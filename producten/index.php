<?php
require $_SERVER['DOCUMENT_ROOT'] . "/ICTM1m3/functies/helpers.php";
require $_SERVER['DOCUMENT_ROOT'] . "/ICTM1m3/functies/contentFuncties.php";
require $_SERVER['DOCUMENT_ROOT'] . "/ICTM1m3/parts/head.php";

$aantalPaginas = telPaginas(tellenProducten($_GET['in']), $_GET['pp']);
if (isset($_GET['page'])) {
    $vorige = $_GET['page'] - 1;
    $volgende = $_GET['page'] + 1;
} else {
    $vorige = 0;
    $volgende = 2;
}
//body
?>

<div class="container">
    <h5>Producten > <?= currentStockGroup() ?></h5>
    <div class="container-fluid pagination justify-content-between mt-">

        <form action='' method='get'>
            Resultaten per pagina
            <input type="number" name="pp" min="10" max="50" step="10" value="<?= $_GET['pp'] ?>">
            <input type="hidden" name="page" value="<?= $_GET['page'] ?>">
            <input type="hidden" name="in" value="<?= $_GET['page'] ?>">
        </form>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item<?= ($vorige < 1) ? ' disabled' : '' ?>">
                    <a class="page-link"
                       href="/ICTM1m3/producten?page=<?= $vorige ?>&in=<?= $_GET['in'] ?>&pp=<?= $_GET['pp'] ?>"
                       tabindex="-1"
                       aria-disabled="true">Vorige</a>
                </li>
                <?php foreach (paginaNummering($_GET['page'], $aantalPaginas) as $key => $paginaNummer): ?>
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

    </div>

    <?php
    $producten = opvragenProducten();
    if (empty($producten)): ?>
        <br> Er zijn geen producten gevonden <br>
    <?php endif; ?>
    <?php if (!empty($producten)) {
        foreach ($producten
                 as $product): ?>
            <div class="container">
                <h6><?= $product['StockItemName'] ?></h6>
            </div>
        <?php endforeach;
    }
    ?>
    <div class="container-fluid pagination justify-content-between my-5">

        <form action='' method='get' class="">
            Resultaten per pagina
            <input type="number" name="pp" min="10" max="50" step="10" value="<?= $_GET['pp'] ?>">
            <input type="hidden" name="page" value="<?= $_GET['page'] ?>">
            <input type="hidden" name="in" value="<?= $_GET['page'] ?>">
        </form>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item<?= ($vorige < 1) ? ' disabled' : '' ?>">
                    <a class="page-link"
                       href="/ICTM1m3/producten?page=<?= $vorige ?>&in=<?= $_GET['in'] ?>&pp=<?= $_GET['pp'] ?>"
                       tabindex="-1"
                       aria-disabled="true">Vorige</a>
                </li>
                <?php foreach (paginaNummering($_GET['page'], $aantalPaginas) as $key => $paginaNummer): ?>
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

    </div>
</div>
<?php

require $_SERVER['DOCUMENT_ROOT'] . "/ICTM1m3/parts/footer.php";
?>

