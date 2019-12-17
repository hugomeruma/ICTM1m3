<?php
$meestPopulair = populaireProducten();
foreach ($meestPopulair as $product): ?>
    <div class="col-sm-3">
        <?php require __DIR__ . '/parts/product.php'; ?>
    </div>
<?php endforeach; ?>


<!--<div class="Popular-Products" style="width: 18rem;">-->
<!--  <img class="card-img-top" src="..." alt="Card image cap">-->
<!--  <div class="card-body">-->
<!--    <h5 class="card-title"> --><?// ?><!-- </h5>-->
<!--    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
<!--    <a href="--><?php //?><!--" class="btn btn-primary">Ga naar artikel</a>-->
<!--  </div>-->
<!--</div>-->
<!---->
<!--<div class="Popular-Products" style="width: 18rem;">-->
<!--    <img class="card-img-top" src="..." alt="Card image cap">-->
<!--    <div class="card-body">-->
<!--        <h5 class="card-title">Card title</h5>-->
<!--        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
<!--        <a href="--><?php //?><!--" class="btn btn-primary">Ga naar artikel</a>-->
<!--    </div>-->
<!--</div>-->
<!---->
<!--<div class="Popular-Products" style="width: 18rem;">-->
<!--    <img class="card-img-top" src="..." alt="Card image cap">-->
<!--    <div class="card-body">-->
<!--        <h5 class="card-title">Card title</h5>-->
<!--        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
<!--        <a href="--><?php //?><!--" class="btn btn-primary">Ga naar artikel</a>-->
<!--    </div>-->
<!--</div>-->