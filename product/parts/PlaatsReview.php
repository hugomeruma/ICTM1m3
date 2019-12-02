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
    print_r($_SESSION);
    ?>

    <form action="<?php getCurrentURL() ?>" method="POST">
        <input type="hidden" name="stockItemID" value="<?= $_GET['view'] ?>">
        <input type="hidden" name="userID" value="<?= $_SESSION['id'] ?>">
        <input type="hidden" name="name" value="<?= $_SESSION['name'] ?>">

        <div class="form-group">
            <input type="number" name="rating" value="10" placeholder="">
            <button type="submit" class="btn btn-primary mb-2 review-option">Verstuur</button>
        </div>


        <div class="form-group">
            <label for="exampleFormControlTextarea1">Plaats hier uw review</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="Description" rows="5"></textarea>
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
