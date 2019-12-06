<!-- Topbar -->
<div class="container-fluid row top-navbar">

    <!-- Logo -->
    <div class="col">
        <a class="" href="<?= getBaseUrl() ?>">
            <img src="<?= getBaseUrl() ?>assets/afbeeldingen/logo.png"
                 style="object-fit: contain" class="navbar-image"
                 alt="">
        </a>
    </div>

    <!-- Zoekbalk -->
    <div class="col d-flex justify-content-center">
        <form method='get' class="">
            <div class="input-group-prepend search-bar">
                <input type="hidden" name="categorie" value="<?= $_GET['categorie'] ?? 'alle' ?>">
                <input type="hidden" name="products-per-pagina"
                       value="<?= $_GET['products-per-pagina'] ?? standaardProductenPerPagina() ?>">
                <input type="text" class="form-control search-input"
                       placeholder="<?= (!empty($_GET['zoek-opdracht']) ? $_GET['zoek-opdracht'] : 'Zoeken...') ?>"
                       name='zoek-opdracht'>
                <div class="input-group-prepend">
                    <button class="btn btn-outline-success my-2 my-sm-0 btn-search" type="submit">Search
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Login menu item & winkelwagen -->
    <div class="col d-flex justify-content-end mr-3">
        <a class="nav-item navbar-dropdown" href="<?= getBaseUrl() ?>winkelwagen.php">
            Winkelwagen
            <i class="fas fa-shopping-cart"></i>
        </a>
        <?php if (isset($_SESSION['ingelogd']) && $_SESSION['ingelogd'] == true): ?>
            <div class="dropdown">
                <a class="dropdown-toggle navbar-dropdown" href="#" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?= $_SESSION['name'] ?? '' ?>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="<?= getBaseUrl() . '/uitloggen.php' ?>">Uitloggen</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="<?= getBaseUrl() . '/account-bewerken.php' ?>">Account
                            beheren</a>
                    </li>
                </ul>
            </div>
        <?php else: ?>
            <a class="navbar-dropdown" href="<?= getBaseUrl() ?>login.php">Login &nbsp;<i
                        class="fas fa-user icon-navbar"></i></a>
        <?php endif; ?>
    </div>
</div>

<!-- Categorieën -->
<div class="button-bar d-flex justify-content-around">
    <!-- Alle categorieën menu item -->
    <div class="divStockGroup col<?= (isset($_GET['categorie']) && $_GET['categorie'] == 'alle') ? ' divStockGroup-selected' : '' ?>">
        <a href="<?= getBaseUrl() ?>?categorie=alle&producten-per-pagina=<?= $_GET['producten-per-pagina'] ?? standaardProductenPerPagina() ?>"
           class="stockGroup stretched-link">Alle producten</a>
    </div>
    <!-- Categorieën uit de database -->
    <?php foreach (haalCategorieënOp() as $categorie): ?>
        <div class="divStockGroup col<?php if (isset($_GET['category']) && $_GET['category'] == $categorie['StockGroupID']) echo " divStockGroup-selected" ?>">
            <a href="<?= getBaseUrl() ?>?categorie=<?= $categorie['StockGroupID'] ?>&pagina=1&producten-per-pagina=<?= $_GET['producten-per-pagina'] ?? standaardProductenPerPagina() ?>"
               class="stockGroup stretched-link"> <?= $categorie['StockGroupName'] ?>
            </a>
            <!--            --><?php //if (getDiscount(null, $categorie['StockGroupID']) != null): ?>
            <!--                <div class="discount-icon">-->
            <!--                    <span class="fa-stack ">-->
            <!--                        <i class="fas fa-certificate fa-stack-2x"></i>-->
            <!--                        <i class="fas fa-percent fa-stack-1x fa-inverse"></i>-->
            <!--                    </span>-->
            <!--                </div>-->
            <!--            --><?php //endif; ?>
        </div>
    <?php endforeach; ?>
</div>


