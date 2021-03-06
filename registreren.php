<?php
require __DIR__ . '/init.php';
require __DIR__ . '/parts/head.php';
require __DIR__ . '/databaseFuncties/account.php';

// Als een gebruiker al is ingelogd wordt hij doorgestuurd naar de home pagina
if (isset($_SESSION['ingelogd']) && $_SESSION['ingelogd']) {
    redirect('');
}

// Registreer de gebruiker
if (isset($_POST["registreren"])) {
    if (maakAccount($_POST['voornaam'], $_POST['tussenvoegsel'], $_POST['achternaam'], $_POST['email'], $_POST['wachtwoord'], $_POST['land'], $_POST['woonplaats'], $_POST['postcode'], $_POST['huisnummer'], $_POST['straatnaam'], $_POST['telefoonnummer'])) {
        redirect('login.php');
    } else {
        die('#gaatfout');
    }
}
?>
    <h1 class="mt-3 mb-3">Registreren</h1>
    <form method="post">
        <div class="row">
            <div class="col-lg-6 form-group">
                <label for="">Voornaam*</label>
                <input type="text" class="form-control" id="" name="voornaam"
                       value="<?= $_POST["voornaam"] ?? '' ?>" required>
            </div>
            <div class="col-lg-6 form-group">
                <label for="tussenvoegsel">Tussenvoegsel</label>
                <input type="text" class="form-control" id="tussenvoegsel" name="tussenvoegsel"
                       value="<?= $_POST["tussenvoegsel"] ?? '' ?>">
            </div>
            <div class="col-lg-6 form-group">
                <label for="achternaam">Achternaam*</label>
                <input type="text" class="form-control" id="achternaam" name="achternaam"
                       value="<?= $_POST["achternaam"] ?? '' ?>" required>
            </div>
            <div class="col-lg-6 form-group">
                <label for="email">E-mail*</label>
                <input type="email" class="form-control" id="email" name="email"
                       value="<?= $_POST["email"] ?? '' ?>" required>
            </div>
            <div class="col-lg-6 form-group">
                <label for="wachtwoord">Wachtwoord*</label>
                <input type="password" class="form-control" id="wachtwoord" name="wachtwoord"
                       value="<?= $_POST["wachtwoord"] ?? '' ?>" required>
            </div>
            <div class="col-lg-6 form-group">
                <label for="land">Land*</label>
                <input type="text" class="form-control" id="land" name="land"
                       value="<?= $_POST["land"] ?? '' ?>" required>
            </div>
            <div class="col-lg-6 form-group">
                <label for="woonplaats">Woonplaats*</label>
                <input type="text" class="form-control" id="woonplaats" name="woonplaats"
                       value="<?= $_POST["woonplaats"] ?? '' ?>" required>
            </div>
            <div class="col-lg-6 form-group">
                <label for="postcode">Postcode*</label>
                <input type="text" class="form-control" id="postcode" name="postcode"
                       value="<?= $_POST["postcode"] ?? '' ?>" required>
            </div>
            <div class="col-lg-6 form-group">
                <label for="huisnummer">Huisnummer*</label>
                <input type="number" class="form-control" id="huisnummer" name="huisnummer"
                       value="<?= $_POST["huisnummer"] ?? '' ?>" required>
            </div>
            <div class="col-lg-6 form-group">
                <label for="straatnaam">Straatnaam*</label>
                <input type="text" class="form-control" id="straatnaam" name="straatnaam"
                       value="<?= $_POST["straatnaam"] ?? '' ?>" required>
            </div>
            <div class="col-lg-6 form-group">
                <label for="telefoonnummer">Telefoonnummer</label>
                <input type="text" class="form-control" id="telefoonnummer" name="telefoonnummer"
                       value="<?= $_POST["telefoonnummer"] ?? '' ?>">
            </div>
        </div>
        <button type="submit" name="registreren" class="btn btn-primary mb-3">Registreren</button>
    </form>
<?php
require __DIR__ . "/parts/footer.php";
?>