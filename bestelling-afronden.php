<?php
require __DIR__ . '/init.php';
require __DIR__ . "/parts/head.php";
require __DIR__ . "/databaseFuncties/account.php";
require __DIR__ . "/databaseFuncties/product.php";
require __DIR__ . "/databaseFuncties/klant.php";
require __DIR__ . "/databaseFuncties/bestelling.php";

// Als de gebruiker vanaf deze pagina wil inloggen
if (isset($_POST['login'])) {
    if (login($_POST['email'], $_POST['wachtwoord'])) {
        redirect('bestelling-afronden.php');
    } else {
        $_SESSION['alert']['danger']['title'] = 'Inloggen mislukt!';
        $_SESSION['alert']['danger']['message'] = 'Controleer de waardes van de ingevulde velden en probeer het opnieuw.';
        redirect('bestelling-afronden.php');
    }
}

// Haal de gegevens van de ingelogde op als een gebruiker ingelogd en hij de gegevens automatisch ingevuld wil hebben
if(isset($_GET['automatisch-invullen']) && $_GET['automatisch-invullen'] === 'ja') {
    $account = haalAccountOpID($_SESSION['id'])[0];
}

// Als de winkelwagen leeg is: redirect met alert
if (empty($_SESSION['winkelwagen']['producten'])) {
    $_SESSION['alert']['info']['title'] = 'Geen producten!';
    $_SESSION['alert']['info']['title'] = 'Voeg producten toe aan de winkelwagen om een bestelling af te ronden.';
    redirect('winkelwagen.php');
}

// Als het get formulier is verstuurd haal waardes op voor naw velden
if (isset($_GET['automatisch-invullen']) && $_GET['automatisch-invullen'] === 'ja') {
    $account = haalAccountOpID($_SESSION['id'])[0];
}


// Bestelling opslaan in database
if (isset($_POST['bestelling-afronden'])) {
    // Maak klant en bestelling aan en haal ID op
    $klantID = maakKlant($_POST['voornaam'], $_POST['tussenvoegsel'], $_POST['achternaam'], $_POST['telefoonnummer'], $_POST['email']);
    $bestellingID = maakBestelling($klantID, $_POST['plaats'], $_POST['postcode'], $_POST['huisnummer'], $_POST['postcode']);
    $succes = true;

    // Check of de bestelling en klant succesvol zijn opgeslagen anders word $succes false
    if ($bestellingID && $klantID) {
        // Loop door de producten heen en maak bestelregels
        foreach ($_SESSION['winkelwagen']['producten'] as $productID => $aantal) {
            $product = haalProductOpID($productID);
            // Als bestelling niet goed gaat wordt $succes false
            if (!maakBestellingsRegel($bestellingID, $productID, $aantal, $product[0]['StockItemName'], $product[0]['RecommendedRetailPrice'], $product[0]['TaxRate'])) {
                $succes = false;
            }
        }
    } else {
        $succes = false;
    }

    // Pak het juiste bericht op basis van de waarde van $succes
    if ($succes) {
        $_SESSION['melding']['titel'] = 'Succesvol!';
        $_SESSION['melding']['bericht'] = 'Uw bestelling is geplaatst!';
    } else {
        $_SESSION['melding']['titel'] = 'Error!';
        $_SESSION['melding']['bericht'] = 'Er is iets fout gegaan, neem contact met ons op om de bestelling alsnog te plaatsen.';
    }
    // Redirect naat de pagina waarop de melding word getoont
    redirect('bestelling-afgerond.php');
}
?>
<div class="container">
    <h1>Bestelling afronden</h1>
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-4">
            <!-- ///////////// Account opties ///////////// -->
            <!-- Als je ingelogd bent kan je de gegeven automatisch laten invullen -->
            <?php if (isset($_SESSION['ingelogd']) && $_SESSION['ingelogd']): ?>
                <h2>Account</h2>
                <p>We kunnen gegevens automatisch invullen, omdat je bent ingelogd.</p>
                <form method="get">
                    <input type="hidden" name="automatisch-invullen" value="ja">
                    <button class="btn btn-primary" type="submit">Automatisch invullen</button>
                </form>
                <!--  Als je niet ingelogd bent kun je inloggen -->
            <?php else: ?>
                <h2>Inloggen</h2>
                <p>Log in om uw gegevens op te halen.</p>
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
                    <!-- Link om te registreren -->
                    <a class="mt-3" href="<?= getBaseUrl() ?>registreren.php">Registreer</a>
                </form>
            <?php endif; ?>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-8">
            <h2>Uw gegevens</h2>
            <p>Voer hier u gegevens in.</p>
            <form method="post">
                <div class="form-group">
                    <label for="">Voornaam*</label>
                    <input type="text" class="form-control" id="" name="voornaam"
                           value="<?= $account["FirstName"] ?? '' ?>" required>
                </div>
                <div class="form-group">
                    <label for="tussenvoegsel">Tussenvoegsel</label>
                    <input type="text" class="form-control" id="tussenvoegsel" name="tussenvoegsel"
                           value="<?= $account["Insertion"] ?? '' ?>">
                </div>
                <div class="form-group">
                    <label for="achternaam">Achternaam*</label>
                    <input type="text" class="form-control" id="achternaam" name="achternaam"
                           value="<?= $account["LastName"] ?? '' ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail*</label>
                    <input type="email" class="form-control" id="email" name="email"
                           value="<?= $account["Email"] ?? '' ?>" required>
                </div>
                <div class="form-group">
                    <label for="land">land*</label>
                    <input type="text" class="form-control" id="land" name="land"
                           value="<?= $account["Country"] ?? '' ?>" required>
                </div>
                <div class="form-group">
                    <label for="plaats">Woonplaats*</label>
                    <input type="text" class="form-control" id="plaats" name="plaats"
                           value="<?= $account["City"] ?? '' ?>" required>
                </div>
                <div class="form-group">
                    <label for="postcode">Postcode*</label>
                    <input type="text" class="form-control" id="postcode" name="postcode"
                           value="<?= $account["PostalCode"] ?? '' ?>" required>
                </div>
                <div class="form-group">
                    <label for="huisnummer">Huisnummer*</label>
                    <input type="text" class="form-control" id="huisnummer" name="huisnummer"
                           value="<?= $account["HouseNumber"] ?? '' ?>" required>
                </div>
                <div class="form-group">
                    <label for="straatnaam">Straatnaam*</label>
                    <input type="text" class="form-control" id="straatnaam" name="straatnaam"
                           value="<?= $account["Street"] ?? '' ?>" required>
                </div>
                <div class="form-group">
                    <label for="telefoonnummer">Telefoonnummer</label>
                    <input type="text" class="form-control" id="telefoonnummer" name="telefoonnummer"
                           value="<?= $account["PhoneNumber"] ?? '' ?>">
                </div>
                <button type="submit" name="bestelling-afronden" class="btn btn-primary mb-3">Bestelling afronden
                </button>
            </form>
        </div>
    </div>
</div>
<?php
require __DIR__ . "/parts/footer.php";
?>