<?php
function maakKlant(string $voornaam, string $tussenvoegsel, string $achternaam, string $telefoonnummer, $email)
{
    $conn = maakVerbinding();
    $stmt = $conn->prepare("INSERT INTO webshop_customers (FirstName, Insertion, LastName, PhoneNumber, Email) VALUES (?,?,?,?,?)");
    $stmt->bind_param('sssss', $voornaam, $tussenvoegsel, $achternaam, $telefoonnummer, $email);
    $stmt->execute();
    $stmt->fetch();
    $stmt->close();
    // Return id van toegevoegde klant
    return $conn->insert_id;
}