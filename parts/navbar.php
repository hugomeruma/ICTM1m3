<nav class="navbar navbar-expand-lg navbar-light top-navbar">
    <!-- logo -->
    <a class="navbar-brand" href="<?= getBaseUrl() ?>">
        <img src="<?= getBaseUrl() ?>/assets/afbeeldingen/logo.png"
             width="150" height="54" class="d-inline-block align-top"
             alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="ml-auto form-inline">
            <form action="<?= getBaseUrl() ?>browsen" method='get' class="form-inline my-2 my-lg-0">
                <input type="text" name='searchFor' class="form-control mr-sm-2 px-3 search-bar"
                       placeholder="<?= searchFor() ?>">
                <input type="hidden" name="page" value="1">
                <input type="hidden" name="in" value="<?= $_GET['in'] ?>">
                <input type="hidden" name="pp" value="<?= $_GET['pp'] ?>">
                <button class="btn btn-outline-success my-2 my-sm-0 btn-search" type="submit">Search</button>
            </form>
            <!-- oplossing voor button account-->
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['ingelogd']) && $_SESSION['ingelogd'] == true): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= $_SESSION['name'] ?? '' ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= getBaseUrl() . '/uitloggen.php' ?>">Uitloggen</a>
                        </div>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= getBaseUrl() ?>/login.php">Login</a>
                    </li>
                <?php endif; ?>
                <li>
                    <!--Button winkelmandje-->
                </li>
            </ul>


        </div>


    </div>
</nav>

<div class="button-bar d-flex justify-content-around">
    <div class="divStockGroup col<?php if ($_GET['in'] == null) echo " divStockGroup-selected"?>">
        <a href="/ICTM1m3/browsen/?in=&page=1&pp=10" class="stockGroup stretched-link">Alle producten</a>
    </div>
    <?php foreach (selecterenStockgroups() as $stockgroup): ?>
        <div class="divStockGroup col<?php if ($_GET['in'] == $stockgroup['StockGroupID']) echo " divStockGroup-selected"?>">
            <a href="/ICTM1m3/browsen/?in=<?= $stockgroup['StockGroupID'] ?>&page=1&pp=10"
               class="stockGroup stretched-link"> <?= $stockgroup['StockGroupName'] ?>
            </a>
        </div>
    <?php endforeach; ?>
</div>

<?php ?>