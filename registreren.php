<?php
require __DIR__ . '/parts/head.php';
require __DIR__ . '/functies/account.php';

if (isset($_POST["toevoegen"])) {
    $gegevens["voornaam"] = isset($_POST["voornaam"]) ? $_POST["voornaam"] : "";
    $gegevens["tussenvoegsel"] = isset($_POST["tussenvoegsel"]) ? $_POST["tussenvoegsel"] : "";
    $gegevens["achternaam"] = isset($_POST["achternaam"]) ? $_POST["achternaam"] : "";
    $gegevens["email"] = isset($_POST["email"]) ? $_POST["email"] : "";
    $gegevens["wachtwoord"] = isset($_POST["wachtwoord"]) ? $_POST["wachtwoord"] : "";
    $gegevens["woonplaats"] = isset($_POST["woonplaats"]) ? $_POST["woonplaats"] : "";
    $gegevens["postcode"] = isset($_POST["postcode"]) ? $_POST["postcode"] : "";
    $gegevens["huisnummer"] = isset($_POST["huisnummer"]) ? $_POST["huisnummer"] : "";
    $gegevens["straatnaam"] = isset($_POST["straatnaam"]) ? $_POST["straatnaam"] : "";
    $gegevens["telefoonnr"] = isset($_POST["telefoonnr"]) ? $_POST["telefoonnr"] : "";
    $gegevens = AccountGegevensToevoegen($gegevens);
}
?>
<form method="post">
    Voornaam : <input type="text" name="voornaam" value="<?= $gegevens["voornaam"] ?? '' ?>"><br> <br>
    tussenvoegsel : <input type="text" name="tussenvoegsel" value="<?= $gegevens["tussenvoegsel"] ?? '' ?>"><br>
    <br>
    Achternaam : <input type="text" name="achternaam" value="<?= $gegevens["achternaam"] ?? '' ?>"><br> <br>
    E-mail: <input type="text" name="email" value="<?= $gegevens["email"] ?? '' ?>"><br><br>
    wachtwoord: <input type="password" name="wachtwoord" value="<?= $gegevens["wachtwoord"] ?? '' ?>"><br><br>
    woonplaats: <input type="text" name="woonplaats" value="<?= $gegevens["woonplaats"] ?? '' ?>"><br><br>
    postcode: <input type="text" name="postcode" value="<?= $gegevens["postcode"] ?? '' ?>"><br><br>
    huisnummer: <input type="text" name="huisnummer" value="<?= $gegevens["huisnummer"] ?? '' ?>"><br><br>
    straatnaam: <input type="text" name="straatnaam" value="<?= $gegevens["straatnaam"] ?? '' ?>"><br><br>
    telefoonnr: <input type="text" name="telefoonnr" value="<?= $gegevens["telefoonnr"] ?? '' ?>"><br><br>
    <input type="submit" name="toevoegen" value="toevoegen"/>
</form>
<br><?= $gegevens["melding"] ?? '' ?><br>
<a href="index.html">Terug naar de inlogpagina</a>
</body>
</html>