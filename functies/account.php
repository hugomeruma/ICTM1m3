<?php

function MaakVerbinding()
{
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'wideworldimporters';
    $connection = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    return $connection;
}

function MaakAccount($connection, $firstName, $tussenvoegsel, $lastName, $email, $password, $city, $postalCode, $houseNumber, $streetName, $phoneNumber)
{
    $statement = mysqli_prepare($connection, "INSERT INTO accounts (firstName, tussenvoegsel, lastName, email, password, city, postalCode, houseNumber, streetName, phoneNumber) VALUES(?,?,?,?,?,?,?,?,?,?)");
    mysqli_stmt_bind_param($statement, 'ssssssssss', $firstName, $tussenvoegsel, $lastName, $email, $password, $city, $postalCode, $houseNumber, $streetName, $phoneNumber);
    mysqli_stmt_execute($statement);
    return mysqli_stmt_affected_rows($statement) == 1;
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

function ophalengegevens($id)
{

    $conn = MaakVerbinding();
    $sql = "SELECT * FROM accounts WHERE ID = ?";
    mysqli_stmt_bind_param($sql, 'i', $id);
    mysqli_stmt_execute($sql);
    $result = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
    return $result;
}


function SluitVerbinding($connection)
{
    mysqli_close($connection);
}