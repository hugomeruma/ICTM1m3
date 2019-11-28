<?php
?>
<div class="startpagina" > hier ga ik allemaal vet coole shit in Zetten </div>

    <h2 class="region__header-title" data-test="region-header-title"> Onze aanraders</h2>
        <h6 style="vertical-align: bottom" > zie hier de items in de aanbieding </h6>

<div class="container my-5" style="vertical-align:middle">
    <?php
    $producten = opvragenProducten();
    if (empty($producten)): ?>
        <br> Er zijn geen producten gevonden <br>
    <?php endif; ?>

    <?php if (!empty($producten))
        require "parts/Deals.php"
    ?>

