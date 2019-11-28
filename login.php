<?php
ob_start();
require __DIR__ . "/functies/algemeneFuncties.php";
require __DIR__ . "/functies/helpers.php";
require __DIR__ . "/functies/contentFuncties.php";
require __DIR__ . "/functies/account.php";
require __DIR__ . "/parts/head.php";

if (isset($_SESSION['ingelogd']) && $_SESSION['ingelogd']) {
    redirect('');
}

if (isset($_POST['login'])) {
    if (login($_POST['email'], $_POST['wachtwoord'])) {
        redirect('');
    } else {
        $message = 'Inloggen mislukt, controlleer de velden.';
        redirect('login.php');
    }
}

?>
    <div class="container">
        <h1 class="mt-3 mb-3">Login</h1>
        <form method="post">
            <div class="form-group">
                <label for="email">Email address*</label>
                <input type="email" name="email" class="form-control" id="email" required>
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