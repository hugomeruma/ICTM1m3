<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= getBaseUrl() . '/admin' ?>">WWI CMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= getBaseUrl() ?>/admin/producten">Producten<span
                                class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= $_SESSION['name'] ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?= getBaseUrl() . '/admin/wachtwoord-wijzigen.php' ?>">Wachtwoord
                            wijzigen</a>
                        <a class="dropdown-item" href="<?= getBaseUrl() . '/admin/instellingen.php' ?>">Instellingen</a>
                        <a class="dropdown-item" href="<?= getBaseUrl() . '/uitloggen.php' ?>">Uitloggen</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>