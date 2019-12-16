<?php

function maakAccount($voornaam, $tussenvoegsel, $achternaam, $email, $wachtwoord,$land , $plaats, $postcode, $huisnummer, $straat, $telefoonnummer)
{
    $conn = maakVerbinding();
    $stmt = $conn->prepare("INSERT INTO accounts (firstName, tussenvoegsel, lastName, email, password,country,city, postalCode, houseNumber, streetName, phoneNumber) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param( 'sssssssssss', $voornaam, $tussenvoegsel, $achternaam, $email, $wachtwoord, $land , $plaats, $postcode, $huisnummer, $straat, $telefoonnummer);
    $result = $stmt->execute();
    $stmt->fetch();
    $stmt->close();
    return $result;
}

function werkAccountGegevensBij($ID, $voornaam, $tussenvoegsel, $achternaam, $land, $plaats, $postcode, $huisnummer, $straat, $telefoonnummer) {
    $conn = maakVerbinding();
    $stmt = $conn->prepare("UPDATE accounts SET firstName=?, tussenvoegsel=?, lastName=?, country=? , city=?, postalCode=?, houseNumber=?, streetName=?, phoneNumber=? WHERE id=?");
    $stmt->bind_param( 'sssssssssi', $voornaam, $tussenvoegsel, $achternaam, $land , $plaats, $postcode, $huisnummer, $straat, $telefoonnummer, $ID);
    $result = $stmt->execute();
    $stmt->fetch();
    $stmt->close();
    return $result;
}

function haalAccountOpID(int $id)
{
    $conn = maakVerbinding();
    $stmt = $conn->prepare('SELECT * FROM accounts WHERE ID = ? LIMIT 1');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->fetch();
    $stmt->close();
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
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