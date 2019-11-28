<?php
require "../../functies/helpers.php";
require "../../functies/algemeneFuncties.php";
require "../../parts/admin/head.php";
require "../../parts/admin/menu.php";
require "../../databaseFuncties/product.php";

$count = 0;

if (isset($_POST['verwijder'])) {
    verwijderProducten($_POST['productIDs']);
}

if (isset($_POST['zoeken_knop'])) {
    redirect("admin/producten?zoek-opdracht={$_POST['zoeken']}");
}

if (isset($_GET['zoek-opdracht'])) {
    $producten = zoekProductenOpNaam($_GET['zoek-opdracht']);
} else {
    $producten = productenBeherenOverzicht(20, $_GET['pagina'] ?? 0);
}
?>
    <div class="container">
        <form method="post">
            <div class="row mt-3 mb-3">
                <div class="col-sm-5">
                    <h1 class="mb-0 text-dark">Producten</h1>
                </div>
                <div class="col-sm-7 pt-1 pb-3">
                    <a class="btn btn-success float-sm-right" href="/admin/producten/create.php"
                       role="button">Toevoegen</a>
                    <button type="submit" name="verwijder" class="btn btn-outline-danger float-sm-right mr-2">
                        Verwijderen
                    </button>
                </div>
                <div class="col-12">
                    <div class="p-2 shadow-sm bg-dark">
                        <div class="input-group">
                            <input type="text" placeholder="Producten zoeken op naam..."
                                   class="form-control border-0 bg-dark text-white" name="zoeken" id="crudSearch">
                            <div class="input-group-append">
                                <button type="submit" name="zoeken_knop" class="btn btn-link text-white"
                                        id="crudSearchSubmit"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th scope="col">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="select_all" id="select-all" class="custom-control-input">
                                <label class="custom-control-label" for="select-all"></label>
                            </div>
                        </th>
                        <th scope="col">Artikelnaam</th>
                        <th scope="col">Prijs</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($producten as $product): ?>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input overview-checkbox"
                                           id="customCheck<?= $count ?>" name="productIDs[]"
                                           value="<?= $product['StockItemID'] ?>">
                                    <label class="custom-control-label" for="customCheck<?= $count ?>"></label>
                                </div>
                            </td>
                            <td><a class="text-white"
                                   href="/admin/producten/bewerken.php?id=<?= $product['StockItemID'] ?>"><?= $product['StockItemName'] ?></a>
                            </td>
                            <td><?= $product['UnitPrice'] ?></td>
                        </tr>
                        <?php
                        $count++;
                    endforeach;
                    ?>
                    </tbody>
                </table>
            </div>
        </form>

        <!-- Pagination -->

        <?php
        $aantalPaginas = telPaginas(15) ?? 0;
        if (isset($_GET['pagina'])) {
            $vorige = $_GET['pagina'] - 1;
            $volgende = $_GET['pagina'] + 1;
        } else {
            $vorige = 0;
            $volgende = 2;
        }
        ?>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item<?= ($vorige < 1) ? ' disabled' : '' ?>">
                    <a class="page-link bg-dark text-white" href="/admin/producten?pagina=<?= $vorige ?>" tabindex="-1"
                       aria-disabled="true">Previous</a>
                </li>
                <?php foreach (paginaNummering($_GET['pagina'] ?? 0, $aantalPaginas) as $key => $paginaNummer):
                    $getVariables = $_GET;
                    unset($getVariables['pagina']);
                    if (empty($getVariables)): ?>
                        <li class="page-item<?= ($key === 'selected') ? ' active' : '' ?>"><a
                                    class="page-link bg-dark text-white"
                                    href="<?= getBaseUrl() ?>/admin/producten?pagina=<?= $paginaNummer ?>"><?= $paginaNummer ?></a>
                        </li>
                    <?php else: ?>
                        <li class="page-item<?= ($key === 'selected') ? ' active' : '' ?>"><a
                                    class="page-link bg-dark text-white"
                                    href="<?= getBaseUrl() . $_SERVER['REQUEST_URI'] ?>&pagina=<?= $paginaNummer ?>"><?= $paginaNummer ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
                <li class="page-item<?= ($volgende >= $aantalPaginas) ? ' disabled' : '' ?>">
                    <a class="page-link bg-dark text-white" href="/admin/producten?pagina=<?= $volgende ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
<?php
require "../../parts/admin/footer.php";