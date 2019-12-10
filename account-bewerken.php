<?php
session_start();
require "functies\account.php";
require_once "databaseFuncties\account.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<?php

$gegevens['id'] = $_SESSION['id'];
$gegevens = AccountGegevensOpvragen($gegevens);
print_r($gegevens);

?>
<h1>Account bewerken </h1><br><br>
<form method="post" action="">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">id</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="nummer" readonly="<?= $gegevens["id"] ?>"
            />
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Voornaam</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="voornaam" value="<?php print($gegevens["voornaam"]); ?>"
                   required/>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Tussenvoegsel</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="tussenvoegsel"
                   value="<?php print($gegevens["tussenvoegsel"]); ?> "/>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Achternaam</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="achternaam" value="<?php print($gegevens["achternaam"]); ?>"
                   required/>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">E-mail</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="email" value="<?php print($gegevens["email"]); ?>" required/>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Woonplaats</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="woonplaats" value="<?php print($gegevens["woonplaats"]); ?>"
                   required/>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Postcode</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="postcode" value="<?php print($gegevens["postcode"]); ?>"
                   required/>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Huisnummer</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="huisnummer" value="<?php print($gegevens["huisnummer"]); ?>"
                   required/>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Straatnaam</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="straatnaam" value="<?php print($gegevens["straatnaam"]); ?>"
                   required/>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Telefoonnr</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="telefoonnr" value="<?php print($gegevens["telefoonnr"]); ?>"/>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
            <input class="form-control" type="hidden" name="wachtwoord" readonly
                   placeholder="<?php print(md5($gegevens["wachtwoord"])); ?>"/>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">

            <input class="btn btn-primary" type="submit" name="opslaan" value="Opslaan"/>
        </div>
    </div>

</form>

<?php
$gegevens["id"] = isset($_SESSION["id"]) ? $_SESSION["id"] : 0;
if (isset($_POST["opslaan"])) {
    $gegevens["voornaam"] = $_POST["voornaam"] ?? "";
    $gegevens["tussenvoegsel"] = $_POST["tussenvoegsel"] ?? "";
    $gegevens["achternaam"] = $_POST["achternaam"] ?? "";
    $gegevens["email"] = $_POST["email"] ?? "";
    $gegevens["woonplaats"] = $_POST["woonplaats"] ?? "";
    $gegevens["postcode"] = $_POST["postcode"] ?? "";
    $gegevens["huisnummer"] = $_POST["huisnummer"] ?? "";
    $gegevens["straatnaam"] = $_POST["straatnaam"] ?? "";
    $gegevens["telefoonnr"] = $_POST["telefoonnr"] ?? "";
    // $gegevens["wachtwoord"] = $_POST["wachtwoord"] ?? "";
    $gegevens = AccountGegevensWijzigen($gegevens);
} else {
    AccountGegevensOpvragen($gegevens);
}
?>
<br><?php print($gegevens["melding"]); ?><br>
<a href="hoofdpagina.php">Terug naar de hoofdpagina</a>

</body>
</html>
