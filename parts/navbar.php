<nav class="navbar navbar-expand-lg navbar-light top-navbar">
    <!-- logo -->
    <a class="navbar-brand" href="#">
        <img src="assets/afbeeldingen/logo.png" width="150" height="54" class="d-inline-block align-top" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- oplossing bedenken voor index.php naam file -->
        <div class="ml-auto">
            <form method='get' class="form-inline my-2 my-lg-0">
                <input type=\"search\" name='searchFor' class="form-control mr-sm-2"
                       placeholder=<?= searchFor() ?> aria-label=\"$searchFor\">
            </form>
        </div>
        <!-- oplossing voor button account-->
    </div>
</nav>
<nav class="navbar navbar-expand-lg py-0 button-navbar">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="d-flex justify-content-around">
            <ul class="navbar-nav">
                <?php foreach (ophalenStockgroups() as $stockgroup): ?>
                    <div class="col px-0">
                        <button class="btn btn-primary btn-lg btn-block"
                                type="button"><?= $stockgroup['StockGroupName'] ?></button>
                    </div>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</nav>
