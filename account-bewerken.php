<?php
require __DIR__ . '/init.php';
require __DIR__ . "/parts/head.php";
require __DIR__ . '/databaseFuncties/account.php';

// De gebruiker wordt doorgestuurd naar de home pagina als hij niet is ingelogd
if (!isset($_SESSION['ingelogd']) || !$_SESSION['ingelogd']) {
    redirect('login.php');
}

// Haal de gegevens van het account op
$account = haalAccountOpID($_SESSION['id'])[0];

// Sla de nieuwe gegevens op
if (isset($_POST['bewerken'])) {
    if (werkAccountGegevensBij($_SESSION['id'], $_POST['voornaam'], $_POST['tussenvoegsel'], $_POST['achternaam'], $_POST['land'],  $_POST['woonplaats'], $_POST['postcode'], $_POST['huisnummer'], $_POST['straatnaam'], $_POST['telefoonnummer'])) {
    redirect('account-bewerken.php');
    } else {
        die('fout');
    }
}
?>
    <h1>Mijn gegevens</h1>
    <form method="post">
        <div class="container">
        <div class="row">
        <div class="col-lg-6 form-group">
            <label for="">Voornaam*</label>
            <input type="text" class="form-control" id="" name="voornaam"
                   value="<?= $account["firstName"] ?? '' ?>" required>
        </div>
        <div class="col-lg-6 form-group">
            <label for="tussenvoegsel">Tussenvoegsel</label>
            <input type="text" class="form-control" id="tussenvoegsel" name="tussenvoegsel"
                   value="<?= $account["tussenvoegsel"] ?? '' ?>">
        </div>
        <div class="col-lg-6 form-group">
            <label for="achternaam">Achternaam*</label>
            <input type="text" class="form-control" id="achternaam" name="achternaam"
                   value="<?= $account["lastName"] ?? '' ?>" required>
        </div>
            <div class="col-lg-6 form-group">
                <label for="land">Land</label>
                <input type="text" class="form-control" id="land" name="land"
                       value="<?= $account["country"] ?? '' ?>">
            </div>
        <div class="col-lg-6 form-group">
            <label for="woonplaats">Woonplaats*</label>
            <input type="text" class="form-control" id="woonplaats" name="woonplaats"
                   value="<?= $account["city"] ?? '' ?>" required>
        </div>
        <div class="col-lg-6 form-group">
            <label for="postcode">Postcode*</label>
            <input type="text" class="form-control" id="postcode" name="postcode"
                   value="<?= $account["postalCode"] ?? '' ?>" required>
        </div>
        <div class="col-lg-6 form-group">
            <label for="huisnummer">Huisnummer*</label>
            <input type="number" class="form-control" id="huisnummer" name="huisnummer"
                   value="<?= $account["houseNumber"] ?? '' ?>" required>
        </div>
        <div class="col-lg-6 form-group">
            <label for="straatnaam">Straatnaam*</label>
            <input type="text" class="form-control" id="straatnaam" name="straatnaam"
                   value="<?= $account["streetName"] ?? '' ?>" required>
        </div>
        <div class="col-lg-6 form-group">
            <label for="telefoonnummer">Telefoonnummer</label>
            <input type="text" class="form-control" id="telefoonnummer" name="telefoonnummer"
                   value="<?= $account["phoneNumber"] ?? '' ?>">
        </div>
        </div>
        </div>

        <button type="submit" name="bewerken" class="btn btn-primary mb-3">Bewerken</button>
    </form>
<?php
require __DIR__ . "/parts/footer.php";
?>