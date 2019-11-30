<?php
if (!isset($_SESSION['ingelogd'])):?>
    <h6 class="review-form-NA-text">Je bent nog niet ingelogd.</h6>
    <div class="button centerd">
        <button type="button" class="btn btn-primary justify-content-around review-NA-btn">
            Klik hier om in te loggen.
        </button>
    </div>

    <?php
//Hier komt een "elseif" om te kijken of het voorwerp daadwerkelijk gekocht is.
    ?>
    <div class="review-form-NA justify-content-center">
        <h6 class="review-form-NA-text">Je hebt het product nog niet gekocht.</h6>
    </div>
<?php
else:
    ?>
    <form method="$_GET">
        <input type="hidden" name="StockItemID" value="<?= $_POST['view'] ?>">
        <input type="hidden" name="User">
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Example textarea</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
        </div>
        <div class="form-group">
            <input type="number" name="rating" value="10" placeholder="">
            <button type="submit" class="btn btn-primary mb-2">Verstuur</button>
        </div>
    </form>
<?php
endif;
?>


<!--    <div class="justify-content-around">-->
<!--        <a href="--><? //= getBaseUrl()
?><!--login.php" class="btn btn-primary review-NA-btn centerd"> Klik hier om in te-->
<!--            loggen</a>-->
<!--    </div>-->
