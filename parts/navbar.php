<div class="container-fluid row top-navbar">
    <div class="col">
        <a class="" href="<?= getBaseUrl() ?>">
            <img src="<?= getBaseUrl() ?>assets/afbeeldingen/logo.png"
                 style="object-fit: contain" class="navbar-image"
                 alt="">
        </a>
    </div>
    <div class="col d-flex justify-content-center">
<!--        <div class="input-group mb-3">-->
<!--            <input type="text" class="form-control search-bar" placeholder="--><?//= searchFor() ?><!--" name='searchFor'-->
<!--                   aria-describedby="basic-addon1">-->
<!--            <div class="input-group-prepend">-->
<!--                <button class="btn btn-outline-success my-2 my-sm-0 btn-search" type="submit">Search</button>-->
<!--            </div>-->
<!--        </div>-->
<!--        -->
        <form action="<?= getBaseUrl() ?>browsen" method='get' class="">
            <div class="input-group-prepend">
                <input type="text" class="form-control search-bar" placeholder="<?= searchFor() ?>" name='searchFor'
                       aria-describedby="basic-addon1">

                <div class="input-group-prepend">
                    <button class="btn btn-outline-success my-2 my-sm-0 btn-search" type="submit">Search</button>
                </div>
            </div>
            <!--                <input type="text" name='searchFor' class="form-control search-bar"-->
            <!--                       placeholder="--><?//= searchFor() ?><!--">-->
            <input type="hidden" name="page" value="1">
            <input type="hidden" name="in" value="<?= $_GET['in'] ?>">
            <input type="hidden" name="pp" value="<?= $_GET['pp'] ?>">
            <!--                <button class="btn btn-outline-success my-2 my-sm-0 btn-search" type="submit">Search</button>-->
        </form>
    </div>
    <div class="col d-flex justify-content-end">
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
                        <a class="dropdown-item" href="<?= getBaseUrl() . '/uitloggen.php' ?>">Account beheren</a>
                    </li>
                </ul>
            </div>
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= getBaseUrl() ?>/login.php">Login</a>
            </li>
        <?php endif; ?>
    </div>
</div>


<div class="button-bar d-flex justify-content-around">
    <div class="divStockGroup col<?php if (isset($_GET['in']) && $_GET['in'] == null) echo " divStockGroup-selected" ?>">
        <a href="/ICTM1m3/browsen/?in=&page=1&pp=10" class="stockGroup stretched-link">Alle producten</a>
    </div>
    <?php foreach (selecterenStockgroups() as $stockgroup): ?>
        <div class="divStockGroup col<?php if (isset($_GET['in']) && $_GET['in'] == $stockgroup['StockGroupID']) echo " divStockGroup-selected" ?>">
            <a href="/ICTM1m3/browsen/?in=<?= $stockgroup['StockGroupID'] ?>&page=1&pp=10"
               class="stockGroup stretched-link"> <?= $stockgroup['StockGroupName'] ?>
            </a>

            <?php if (getDiscount(null, $stockgroup['StockGroupID']) != null): ?>
                <div class="discount-icon-div-on-stockgroup">
                    <span class="fa-stack discount-icon-on-stockgroup">
                        <i class="fas fa-certificate fa-stack-2x"></i>
                        <i class="fas fa-percent fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
            <?php endif; ?>

        </div>

    <?php endforeach; ?>
</div>


