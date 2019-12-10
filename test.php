<?php
ob_start();
require __DIR__ . "/functies/algemeneFuncties.php";
require __DIR__ . "/functies/helpers.php";
require __DIR__ . "/functies/contentFuncties.php";
require __DIR__ . '/parts/head.php';
require __DIR__ . '/databaseFuncties/account.php';
require __DIR__ . '/functies/account.php';
?>
<form>
    <div class="container">
<div class="row">
    <div class="col-lg-6 form-group">
        <label>Label1</label>
        <input class="form-control" type="text"/>
    </div>
    <div class="col-lg-6 form-group">
        <label>Label2</label>
        <input class="form-control" type="text"/>
    </div>
    <div class="col-lg-6 form-group">
        <label>Label3</label>
        <input class="form-control" type="text"/>
    </div>
    <div class="col-lg-6 form-group">
        <label>Label4</label>
        <input class="form-control" type="text"/>
    </div>
</div>
    </div>
</form>
<?php

require __DIR__ . "/parts/footer.php";
?>