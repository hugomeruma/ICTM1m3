<?php
//require 'databaseFuncties.php';

//function MaakVerbinding()
//{
//    $DATABASE_HOST = 'localhost';
//    $DATABASE_USER = 'root';
//    $DATABASE_PASS = '';
//    $DATABASE_NAME = 'wideworldimporters';
//    $connection = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
//    return $connection;
//}

$gegevens = array("id" => 0, "voornaam" => "", "tussenvoegsel" => "", "achternaam" => "", "email" => "", "wachtwoord" => "", "woonplaats" => "", "postcode" => "", "huisnummer" => "", "straatnaam" => "", "telefoonnr" => "", "melding" => "");

function maakAccount($firstName, $tussenvoegsel, $lastName, $email, $password, $city, $postalCode, $houseNumber, $streetName, $phoneNumber)
{
    $conn = maakVerbinding();
    $statement = mysqli_prepare($conn, "INSERT INTO accounts (firstName, tussenvoegsel, lastName, email, password, city, postalCode, houseNumber, streetName, phoneNumber) VALUES(?,?,?,?,?,?,?,?,?,?)");
    mysqli_stmt_bind_param($statement, 'ssssssssss', $firstName, $tussenvoegsel, $lastName, $email, $password, $city, $postalCode, $houseNumber, $streetName, $phoneNumber);
    return mysqli_stmt_execute($statement);
}

function WijzigAccount($connection, $id, $firstName, $tussenvoegsel, $lastName, $email, $city, $postalCode, $houseNumber, $streetName, $phoneNumber)
{
    $statement = mysqli_prepare($connection, "UPDATE accounts SET firstName=?, tussenvoegsel=?, lastName=?, email=?, city=?, postalCode=?, houseNumber=?, streetName=?, phoneNumber=? WHERE id=?");
    mysqli_stmt_bind_param($statement, 'sssssssssi', $firstName, $tussenvoegsel, $lastName, $email, $city, $postalCode, $houseNumber, $streetName, $phoneNumber, $id);
    mysqli_stmt_execute($statement);
    return mysqli_stmt_affected_rows($statement) == 1;
}


function SelecteerAccount($connection, $id)
{
    $statement = mysqli_prepare($connection, "SELECT * FROM accounts WHERE id=?");
    mysqli_stmt_bind_param($statement, 'i', $id);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $id, $firstName, $tussenvoegsel, $lastName, $email, $password, $city, $postalCode, $houseNumber, $streetName, $phoneNumber);
    mysqli_stmt_fetch($statement);
    $result = array("id" => $id, "voornaam" => $firstName, "tussenvoegsel" => $tussenvoegsel, "achternaam" => $lastName, "email" => $email, "wachtwoord" => $password, "woonplaats" => $city, "postcode" => $postalCode, "huisnummer" => $houseNumber, "straatnaam" => $streetName, "telefoonnr" => $phoneNumber);
    mysqli_stmt_close($statement);
    return $result;
}

//function ophalengegevens($id)
//{
//
//    $conn = MaakVerbinding();
//    $sql = "SELECT * FROM accounts WHERE ID = ?";
//    mysqli_stmt_bind_param($sql, 'i', $id);
//    mysqli_stmt_execute($sql);
//    $result = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
//    return $result;
//}

function AccountGegevensWijzigen($gegevens)
{
    if (!empty($gegevens["id"])) {
        $connection = MaakVerbinding();
        if (WijzigAccount($connection, $gegevens["id"], $gegevens["voornaam"], $gegevens["tussenvoegsel"], $gegevens["achternaam"], $gegevens["email"], $gegevens["woonplaats"], $gegevens["postcode"], $gegevens["huisnummer"], $gegevens["straatnaam"], $gegevens["telefoonnr"]) == 1)
            $gegevens["melding"] = "De gegevens zijn gewijzigd en opgeslagen";
        else $gegevens["melding"] = "De gegevens zijn niet gewijzigd!";
        SluitVerbinding($connection);
    } else $gegevens["melding"] = "Het id ontbreekt";
    return $gegevens;
}

function  AccountGegevensOpvragen($gegevens)
{
    if (!empty($gegevens["id"])) {
        $connection = MaakVerbinding();
        $gegevens = SelecteerAccount($connection, $gegevens["id"]);
        $gegevens["melding"] = "";
        SluitVerbinding($connection);
    } else $gegevens["melding"] = "Het id ontbreekt";
    return $gegevens;
}

//function accountGegevensToevoegen(array $account)
//{
//    $connection = MaakVerbinding();
//    if (MaakAccount($connection, $gegevens["voornaam"], $gegevens["tussenvoegsel"], $gegevens["achternaam"], $gegevens["email"], $gegevens["wachtwoord"], $gegevens["woonplaats"], $gegevens["postcode"], $gegevens["huisnummer"], $gegevens["straatnaam"], $gegevens["telefoonnr"]) == 1)
//        $gegevens["melding"] = "Uw account is geregistreerd.";
//    else $gegevens["melding"] = "Het registreren is mislukt.";
//    SluitVerbinding($connection);
//    return $gegevens;
//}

//function SluitVerbinding($connection)
//{
//    mysqli_close($connection);
//}