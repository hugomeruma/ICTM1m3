<?php

function maakAccount($voornaam, $tussenvoegsel, $achternaam, $email, $wachtwoord, $land, $plaats, $postcode, $huisnummer, $straat, $telefoonnummer)
{
    // Hash wachtwoord
    $wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

    $conn = maakVerbinding();
    $stmt = $conn->prepare("INSERT INTO accounts (FirstName, Insertion, LastName, Email, Password, Country, City, PostalCode, Street, HouseNumber, phoneNumber) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param( 'sssssssssss', $voornaam, $tussenvoegsel, $achternaam, $email, $wachtwoord, $land , $plaats, $postcode, $huisnummer, $straat, $telefoonnummer);
    $result = $stmt->execute();
    $stmt->fetch();
    $stmt->close();
    return $result;
}

function werkAccountGegevensBij($ID, $voornaam, $tussenvoegsel, $achternaam, $land, $plaats, $postcode, $huisnummer, $straat, $telefoonnummer) {
    $conn = maakVerbinding();
    $stmt = $conn->prepare("UPDATE accounts SET FirstName=?, Insertion=?, LastName=?, Country=?, City=?, PostalCode=?, HouseNumber=?, Street=?, PhoneNumber=? WHERE ID=?");
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
    // Hash wachtwoord
    $wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

    $conn = maakVerbinding();
    $stmt = $conn->prepare('UPDATE accounts set Password = ? WHERE ID = ?');
    $stmt->bind_param('si', $wachtwoord, $id);
    $result = $stmt->execute();
    $stmt->fetch();
    $stmt->close();
    return $result;
}

function login($mail, $password, $noSessions = false)
{
    $conn = maakVerbinding();

    if ($stmt = $conn->prepare('SELECT * FROM accounts WHERE Email = ? LIMIT 1')) {
        $stmt->bind_param('s', $mail);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->fetch();
        $stmt->close();
        $account = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (isset($account[0])) {
            if (password_verify($password, $account[0]['Password'])) {
                if (!$noSessions) {
                    $_SESSION['name'] = getFullName($account[0]['FirstName'], $account[0]['Insertion'], $account[0]['LastName']);
                    $_SESSION['ingelogd'] = TRUE;
                    $_SESSION['email'] = $account[0]['Email'];
                    $_SESSION['id'] = $account[0]['ID'];
                }
                return true;
            } else {
                return false;
            }
        }
    }
    return false;
}