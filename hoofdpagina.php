<?php
?>
<div class="startpagina" > hier ga ik allemaal vet coole shit in Zetten </div>

    <h2 class="region__header-title" data-test="region-header-title"> Onze aanraders</h2>
        <h6 style="vertical-align: bottom" > zie hier de items in de aanbieding </h6>

<div id="carouselIndicators" class="carousel slide my-5" data-ride="carousel" style=" width: 400px;">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block " src="assets/afbeeldingen/Deals/Rockets.gif" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block " src="assets/afbeeldingen/Deals/Mugs.gif" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block " src="assets/afbeeldingen/Deals/T-shirts.gif" alt="Third slide">
        </div>
    </div>
   </div>

<div class="container my-5" style="vertical-align:middle">
    <?php
    $producten = opvragenProducten();
    if (empty($producten)): ?>
        <br> Er zijn geen producten gevonden <br>
    <?php endif; ?>

    <?php if (!empty($producten))
        require "parts/Deals.php"
    ?>

