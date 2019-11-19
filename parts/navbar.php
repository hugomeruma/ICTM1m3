<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- fucntie voor weergeven logo. -->
    <?= logo() ?>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <!-- functie schrijven voor aanmaak dropdown-->
            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>

                <!-- function schrijven voor de catogarien in dropdown -->
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <!-- <div class="dropdown-divider"></div>   dropdonw devider.-->
                    <a> </a>
                </div>
            </li>

        </ul>
        <!-- oplossing bedenken voor index.php naam file -->
        <?= zoekenOptie("index.php") ?>
        <!-- oplossing voor button account-->
    </div>
</nav>