<?php
require __DIR__ . '/init.php';
require __DIR__ . "/parts/head.php";

// Als het bestand niet via de index wordt ingeladen
if (strpos($_SERVER['REQUEST_URI'], 'home.php') !== false) {
    redirect('');
}
?>
    <div class="startpagina" align="middle"> welkom op onze site</div>

    <h2 class="region__header-title" data-test="region-header-title" align="middle"> Onze aanraders</h2>

    <div class="container my-5" style="vertical-align:middle">
    </div>

<?php
require __DIR__ . "/parts/footer.php";