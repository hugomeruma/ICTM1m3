<?php
require __dir__ . "/../functies/algemeneFuncties.php";
require __dir__ . "/../functies/helpers.php";
require __dir__ . "/../functies/contentFuncties.php";
require __dir__ . "/../parts/head.php";
require __DIR__ . "/../parts/navbar.php";
require __dir__ . "/../Deals/discountBanner.php";


if (!isset($_GET['searchFor'])) {
    $_GET['searchFor'] = null;
}

$aantalPaginas = telPaginas(tellenProducten($_GET['in'], $_GET["searchFor"]), $_GET['pp']);
if (isset($_GET['page'])) {
    $vorige = $_GET['page'] - 1;
    $volgende = $_GET['page'] + 1;
} else {
    $vorige = 0;
    $volgende = 2;
}
//body
?>

<div class="container my-5">
    <h5>Producten > <?= currentStockGroup() ?></h5>
    <div class="container-fluid pagination justify-content-between form-inline">

        <form action='' method='get' class="">
            Resultaten per pagina
            <input type="number" name="pp" min="10" max="50" step="5" value="<?= $_GET['pp'] ?>"
                   class="mx-3 product_per_pagina_form">
            <input type="hidden" name="page" value="<?= $_GET['page'] ?>">
            <input type="hidden" name="in" value="<?= $_GET['in'] ?>">
            <?php if (isset($_GET['searchFor'])): ?>
                <input type="hidden" name="searchFor" value="<?= $_GET['searchFor'] ?>">
            <?php endif ?>
        </form>

        <nav aria-label="Page navigation example pagination">
            <ul class="pagination justify-content-center">
                <li class="page-item<?= ($vorige < 1) ? ' disabled' : '' ?>">
                    <a class="page-link"
                       href="<?= getBaseUrl() ?>/browsen?<?php if (isset($_GET['searchFor'])): ?>searchFor=<?= $_GET['searchFor'] ?>&<?php endif; ?>page=<?= $vorige ?>&in=<?= $_GET['in'] ?>&pp=<?= $_GET['pp'] ?>"
                       tabindex="-1"
                       aria-disabled="true">Vorige</a>
                </li>
                <?php foreach (paginaNummering($_GET['page'], $aantalPaginas) as $key => $paginaNummer): ?>
                    <li class="page-item<?= ($key === 'selected') ? ' active' : '' ?>">
                        <a class="page-link"
                           href="<?= getBaseUrl() ?>/browsen?<?php if (isset($_GET['searchFor'])): ?>searchFor=<?= $_GET['searchFor'] ?>&<?php endif; ?>page=<?= $paginaNummer ?>&in=<?= $_GET['in'] ?>&pp=<?= $_GET['pp'] ?>">
                            <?= $paginaNummer ?>
                        </a>
                    </li>
                <?php endforeach; ?>
                <li class="page-item<?= ($volgende >= $aantalPaginas) ? ' disabled' : '' ?>">
                    <a class="page-link"
                       href="<?= getBaseUrl() ?>/browsen?<?php if (isset($_GET['searchFor'])): ?>searchFor=<?= $_GET['searchFor'] ?>&<?php endif; ?>page=<?= $volgende ?>&in=<?= $_GET['in'] ?>&pp=<?= $_GET['pp'] ?>">Volgende</a>
                </li>
            </ul>
        </nav>

    </div>
    <div class="container my-3">
        <?php
        $producten = opvragenProducten();
        if (empty($producten)): ?>
            <br> Er zijn geen producten gevonden <br>
        <?php endif; ?>
        <?php if (!empty($producten)) {
            foreach ($producten as $product) {
                $stock = getStockHolding($product["StockItemID"]);
                require "parts/item.php";
            }
        }
        ?>
    </div>
    <div class="container-fluid pagination justify-content-between my-5">

        <form action='' method='get' class="">
            Resultaten per pagina
            <input type="number" name="pp" min="10" max="50" step="5" value="<?= $_GET['pp'] ?>"
                   class="mx-3 product_per_pagina_form">
            <input type="hidden" name="page" value="<?= $_GET['page'] ?>">
            <input type="hidden" name="in" value="<?= $_GET['in'] ?>">
            <?php if (isset($_GET['searchFor'])): ?>
                <input type="hidden" name="searchFor" value="<?= $_GET['searchFor'] ?>">
            <?php endif ?>
        </form>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item<?= ($vorige < 1) ? ' disabled' : '' ?>">
                    <a class="page-link"
                       href="<?= getBaseUrl() ?>/browsen?<?php if (isset($_GET["searchFor"])) {
                           echo("searchFor=" . $_GET['searchFor'] . "&");
                       } ?>page=<?= $vorige ?>&in=<?= $_GET['in'] ?>&pp=<?= $_GET['pp'] ?>"
                       tabindex="-1"
                       aria-disabled="true">Vorige</a>
                </li>
                <?php foreach (paginaNummering($_GET['page'], $aantalPaginas) as $key => $paginaNummer): ?>
                    <li class="page-item<?= ($key === 'selected') ? ' active' : '' ?>"><a class="page-link"
                                                                                          href="<?= getBaseUrl() ?>/browsen?<?php if (isset($_GET["searchFor"])) {
                                                                                              echo "searchFor=" . $_GET['searchFor'] . "&";
                                                                                          } ?>page=<?= $paginaNummer ?>&in=<?= $_GET['in'] ?>&pp=<?= $_GET['pp'] ?>"><?= $paginaNummer ?></a>
                    </li>
                <?php endforeach; ?>
                <li class="page-item<?= ($volgende >= $aantalPaginas) ? ' disabled' : '' ?>">
                    <a class="page-link"
                       href="<?= getBaseUrl() ?>/browsen?<?php if (isset($_GET["searchFor"])) {
                           echo "searchFor=" . $_GET['searchFor'] . "&";
                       } ?>page=<?= $volgende ?>&in=<?= $_GET['in'] ?>&pp=<?= $_GET['pp'] ?>">Volgende</a>
                </li>
            </ul>
        </nav>

    </div>
</div>
<?php
require __dir__ . "/../parts/footer.php";
?>
