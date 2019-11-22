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
        <!-- oplossing bedenken voor index.php naam file -->
        <div class="ml-auto form-inline">
            <form action="<?= url("SearchFor", "empty") ?>" method='get' class="form-inline my-2 my-lg-0">
                <input type="text" name='searchFor' class="form-control mr-sm-2 px-3"
                       placeholder="<?= searchFor() ?>">
                <input type="hidden" name="page" value="1">
                <input type="hidden" name="in" value="<?= $_GET['in'] ?>">
                <input type="hidden" name="pp" value="<?= $_GET['pp'] ?>">
                <button class="btn btn-outline-success my-2 my-sm-0 btn-search" type="submit">Search</button>
            </form>
        </div>
        <!-- oplossing voor button account-->

    </div>
</nav>
<nav class="navbar navbar-expand-lg pt-0 button-navbar">
    <div class="collapse navbar-collapse d-flex justify-content-around" id="navbarSupportedContent ">
        <div class="col px-0">
            <a href="<?= getBaseUrl() ?>/producten/?in=&page=1&pp=10"
               class="btn btn-primary btn-lg btn-block btn-nav"
               role="button">Alle producten</a>
        </div>
        <?php foreach (selecterenStockgroups() as $stockgroup): ?>
            <div class="col px-0">
                <a href="<?= getBaseUrl() ?>/producten/?in=<?= $stockgroup['StockGroupID'] ?>&page=1&pp=10"
                   class="btn btn-primary btn-lg btn-block btn-nav"
                   role="button"> <?= $stockgroup['StockGroupName'] ?></a>
            </div>
        <?php endforeach; ?>
    </div>
</nav>
