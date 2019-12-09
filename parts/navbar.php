<!-- Topbar -->
<div class="container-fluid row p-1">

    <!-- Logo -->
    <div class="col-3 h-75">
        <a href="<?= getBaseUrl() ?>">
            <img src="<?= getBaseUrl() ?>assets/afbeeldingen/logo.png" class="navigatiebalk-logo" alt="">
        </a>
    </div>

    <!-- Zoekbalk -->
    <div class="col-6 d-flex justify-content-center my-auto">
        <form method='get' class="w-100">
            <div class="input-group">
                <input type="hidden" name="categorie" value="<?= $_GET['categorie'] ?? 'alle' ?>">
                <input type="hidden" name="producten-per-pagina"
                       value="<?= $_GET['producten-per-pagina'] ?? standaardProductenPerPagina() ?>">
                <input type="text" class="form-control"
                       placeholder="<?= (!empty($_GET['zoek-opdracht']) ? $_GET['zoek-opdracht'] : 'Zoeken...') ?>"
                       name='zoek-opdracht'>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Zoeken
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Login menu item & winkelwagen -->
    <ul class="col-3 d-flex justify-content-end my-auto nav">
        <li class="nav-item">
            <a class="nav-link" href="<?= getBaseUrl() ?>winkelwagen.php">
                Winkelwagen <i class="fas fa-shopping-cart"></i>
            </a>
        </li>
        <?php if (isset($_SESSION['ingelogd']) && $_SESSION['ingelogd'] == true): ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <?= $_SESSION['name'] ?? '' ?>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="<?= getBaseUrl() . 'account-bewerken.php' ?>">Gegevens</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="<?= getBaseUrl() . 'uitloggen.php' ?>">Uitloggen</a>
                    </li>
                </ul>
            </li>
        <?php else: ?>
            <a class="nav-link" href="<?= getBaseUrl() ?>login.php">Login &nbsp;<i
                        class="fas fa-user"></i></a>
        <?php endif; ?>
    </ul>
</div>

<!-- Categorieën -->
<div class="button-group d-flex justify-content-around">
    <!-- Alle categorieën menu item -->
    <a href="<?= getBaseUrl() ?>?categorie=alle&producten-per-pagina=<?= $_GET['producten-per-pagina'] ?? standaardProductenPerPagina() ?>"
       class="btn btn-primary col rounded-0<?= (isset($_GET['categorie']) && $_GET['categorie'] == 'alle') ? ' active' : '' ?>">Alle
        producten</a>
    <!-- Categorieën uit de database -->
    <?php foreach (haalCategorieënOp() as $categorie): ?>
        <a href="<?= getBaseUrl() ?>?categorie=<?= $categorie['StockGroupID'] ?>&pagina=1&producten-per-pagina=<?= $_GET['producten-per-pagina'] ?? standaardProductenPerPagina() ?>"
           class="btn btn-primary col rounded-0<?= (isset($_GET['categorie']) && $_GET['categorie'] == $categorie['StockGroupID']) ? ' active' : '' ?>">
            <?= $categorie['StockGroupName'] ?>
        </a>
    <?php endforeach; ?>
</div>