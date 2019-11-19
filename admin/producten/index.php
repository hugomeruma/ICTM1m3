<?php
require "../../parts/admin/head.php";
require "../../parts/admin/menu.php";
require "../../functies/helpers.php";
require "../../databaseFuncties/producten.php";

$count = 0;
?>
    <div class="container">
        <form method="post">
            <div class="row mt-3 mb-3">
                <div class="col-6">
                    <h1 class="mb-0">Producten</h1>
                </div>
                <div class="col-6 pt-1">
                    <a class="btn btn-success float-right" href="/admin/producten/create.php"
                       role="button">Toevoegen</a>
                    <button type="submit" class="btn btn-danger float-right mr-2">Verwijderen</button>
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
                    <?php foreach (productenBeherenOverzicht(15, $_GET['pagina'] ?? 0) as $product): ?>
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input overview-checkbox"
                                           id="customCheck<?= $count ?>">
                                    <label class="custom-control-label" for="customCheck<?= $count ?>"></label>
                                </div>
                            </td>
                            <td><a class="text-white"
                                   href="/admin/producten/bewerken.php?id=<?= $product['StockItemID'] ?>"><?= $product['StockItemName'] ?></a>
                            </td>
                            <td><?= $product['unitPrice'] ?></td>
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
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item<?= ($vorige < 1) ? ' disabled' : '' ?>">
                    <a class="page-link" href="/admin/producten?pagina=<?= $vorige ?>" tabindex="-1"
                       aria-disabled="true">Previous</a>
                </li>
                <?php foreach (paginaNummering($_GET['pagina'] ?? 0, $aantalPaginas) as $key => $paginaNummer): ?>
                    <li class="page-item<?= ($key === 'selected') ? ' active' : '' ?>"><a class="page-link"
                                                                                          href="/admin/producten?pagina=<?= $paginaNummer ?>"><?= $paginaNummer ?></a>
                    </li>
                <?php endforeach; ?>
                <li class="page-item<?= ($volgende >= $aantalPaginas) ? ' disabled' : '' ?>">
                    <a class="page-link" href="/admin/producten?pagina=<?= $volgende ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
<?php
require "../../parts/admin/footer.php";