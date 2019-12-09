<?php
require __DIR__ . '/init.php';
require __DIR__ . "/parts/head.php";
require __DIR__ . "/databaseFuncties/account.php";

// Als de gebruiker al ingelogd is wordt hij doorgestuurd naar de home
if (isset($_SESSION['ingelogd']) && $_SESSION['ingelogd']) {
    redirect('');
}

// Check de gegeven en als ze kloppen wordt de gebruiker ingelogt
if (isset($_POST['login'])) {
    if (login($_POST['email'], $_POST['wachtwoord'])) {
        redirect('');
    } else {
        $message = 'Inloggen mislukt, controlleer de velden.';
        redirect('login.php');
    }
}
?>
    <h1>Login</h1>
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
        <a class="mt-3" href="<?= getBaseUrl() ?>registreren.php">Registreer</a>
    </form>
<?php
require __DIR__ . "/parts/footer.php";
?>