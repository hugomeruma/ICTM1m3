<?php
require __DIR__ . "/init.php";
require __DIR__ . '/parts/head.php';
require __DIR__ . '/databaseFuncties/account.php';
require __DIR__ . '/validatieFuncties/account.php';

// Als de gebruiker niet is ingelogd wordt de gerbuiker doorgestuurd naar de login pagina
if (!$_SESSION['ingelogd']) {
    redirect('login.php');
}

// wachtwoord wijzigen
//if (isset($_POST['wwWijzigen']) && herhaalWachtwoord($_POST['email'], $_POST['huidigWW'], $_POST['nieuwWW'], $_POST['herhaalWW'])) {
//    wijzigWachtwoord($_SESSION['id'], password_hash($_POST['herhaalWW'], PASSWORD_DEFAULT));
//}

// Valideer en verander wachtwoord indien succesvol
if (isset($_POST['veranderen'])) {
    if (wachtwoordVeranderenValidatie($_SESSION['email'], $_POST['huidigWachtwoord'], $_POST['nieuwWachtwoord'], $_POST['herhalingNieuwWachtwoord'])) {
        wijzigWachtwoord($_SESSION['id'], $_POST['nieuwWachtwoord']);
        die('goed');
        redirect('wachtwoord-veranderen.php');
    }
    die('fout');
    redirect('wachtwoord-veranderen.php');
}

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
