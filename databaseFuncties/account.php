<?php

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

function ophalenOpID(int $id)
{
    $conn = maakVerbinding();
    $stmt = $conn->prepare('SELECT * FROM accounts WHERE ID = ? LIMIT 1');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->fetch();
    $stmt->close();
    return $result;
}


function wijzigEmail($email, $id)
{
    $conn = maakVerbinding();
    $stmt = $conn->prepare('UPDATE accounts set email = ? WHERE id = ?');
    $stmt->bind_param('si', $email, $id);
    $result = $stmt->execute();
    $stmt->fetch();
    $stmt->close();
    return $result;
}

function wijzigWachtwoord($id, $wachtwoord)
{
    $conn = maakVerbinding();
    $stmt = $conn->prepare('UPDATE accounts set password = ? WHERE id = ?');
    $stmt->bind_param('si', $wachtwoord, $id);
    $result = $stmt->execute();
    $stmt->fetch();
    $stmt->close();
    return $result;
}

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

function AccountGegevensOpvragen($gegevens)
{
    if (!empty($gegevens["id"])) {
        $connection = MaakVerbinding();
        $gegevens = SelecteerAccount($connection, $gegevens["id"]);
        $gegevens["melding"] = "";
        SluitVerbinding($connection);
    } else $gegevens["melding"] = "Het nummer ontbreekt";
    return $gegevens;
}

function login($mail, $password, $noSessions = false)
{
    $conn = maakVerbinding();

    if ($stmt = $conn->prepare('SELECT * FROM accounts WHERE email = ? LIMIT 1')) {
        $stmt->bind_param('s', $mail);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->fetch();
        $stmt->close();
        $account = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (isset($account[0])) {
            if (password_verify($password, $account[0]['password'])) {
                if (!$noSessions) {
                    $_SESSION['name'] = getFullName($account[0]['firstName'], $account[0]['tussenvoegsel'], $account[0]['lastName']);
                    $_SESSION['ingelogd'] = TRUE;
                    $_SESSION['email'] = $account[0]['email'];
                    $_SESSION['id'] = $account[0]['id'];
                    $_SESSION['isAdmin'] = $account[0]['isAdmin'];
                }
                return true;
            } else {
                return false;
            }
        }
    }
    return false;
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
