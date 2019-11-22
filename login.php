<?php
require __DIR__ . "/functies/algemeneFuncties.php";
require __DIR__ . "/functies/helpers.php";
require __DIR__ . "/functies/contentFuncties.php";
require __DIR__ . "/parts/head.php";
?>

    <div class="container">
        <form method="post" class="mt-3 pt-3">
            <div class="form-group">
                <label for="email">Email address*</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord*</label>
                <input type="password" name="wachtwoord" class="form-control" id="password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
            <a class="mt-3" href="<?= getBaseUrl() ?>/registreren.php">Registreer</a>
        </form>

    </div>

<?php
require __DIR__ . "/parts/footer.php";
?>