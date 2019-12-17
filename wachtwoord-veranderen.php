<?php
require __DIR__ . "/init.php";
require __DIR__ . '/parts/head.php';
require __DIR__ . '/databaseFuncties/account.php';
require __DIR__ . '/validatieFuncties/account.php';

// Als de gebruiker niet is ingelogd wordt de gerbuiker doorgestuurd naar de login pagina
if (!$_SESSION['ingelogd']) {
    redirect('login.php');
}

// Valideer en verander wachtwoord indien succesvol
if (isset($_POST['veranderen'])) {
    if (wachtwoordVeranderenValidatie($_SESSION['email'], $_POST['huidigWachtwoord'], $_POST['nieuwWachtwoord'], $_POST['herhalingNieuwWachtwoord'])) {
        $_SESSION['melding']['class'] = 'alert-danger';
        $_SESSION['melding']['titel'] = 'Error!';
        $_SESSION['melding']['bericht'] = 'Er is iets fout gegaan, controleer uw gegevens en probeer het opnieuw.';
        if (wijzigWachtwoord($_SESSION['id'], $_POST['nieuwWachtwoord'])) {
            $_SESSION['melding']['class'] = 'alert-success';
            $_SESSION['melding']['titel'] = 'Succesvol!';
            $_SESSION['melding']['bericht'] = 'Uw wachtwoord is aangepast.';
        }
        redirect('wachtwoord-veranderen.php');
    }
    $_SESSION['melding']['class'] = 'alert-danger';
    $_SESSION['melding']['titel'] = 'Error!';
    $_SESSION['melding']['bericht'] = 'Er is iets fout gegaan, controleer uw gegevens en probeer het opnieuw.';
    redirect('wachtwoord-veranderen.php');
}

// Laat melding zien als de variabelen waarvan hij gebruikt maakt niet bestaan of leeg zijn
if (isset($_SESSION['melding'])): ?>
    <div class="alert <?= $_SESSION['melding']['class'] ?>" role="alert">
        <strong><?= $_SESSION['alert']['titel'] ?></strong> <?= $_SESSION['alert']['bericht'] ?>
    </div>
    <?php
    unset($_SESSION['alert']);
endif;
?>
    <h1>Wachtwoord veranderen</h1>
    <form method="post">
        <div class="form-group">
            <label for="huidig-wachtwoord">Huidige wachtwoord*</label>
            <input type="password" class="form-control" id="huidig-wachtwoord" name="huidigWachtwoord" required>
        </div>
        <div class="form-group">
            <label for="nieuw-wachtwoord">Nieuw wachtwoord*</label>
            <input type="password" class="form-control" id="nieuw-wachtwoord" name="nieuwWachtwoord" required>
        </div>
        <div class="form-group">
            <label for="herhaling-nieuw-wachtwoord">Herhaling nieuw wachtwoord*</label>
            <input type="password" class="form-control" id="herhaling-nieuw-wachtwoord" name="herhalingNieuwWachtwoord"
                   required>
        </div>
        <button type="submit" name="veranderen" class="btn btn-primary mb-3">Veranderen</button>
    </form>
<?php
require __DIR__ . "/parts/footer.php";
?>