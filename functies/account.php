<?php
require_once 'databaseFuncties/account.php';
function login($mail, $password)
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
//                session_regenerate_id();
                $_SESSION['name'] = getFullName($account[0]['firstName'], $account[0]['tussenvoegsel'], $account[0]['lastName']);
                $_SESSION['ingelogd'] = TRUE;
                $_SESSION['email'] = $_POST[0]['email'];
                $_SESSION['id'] = $_POST[0]['id'];
                return true;
            } else {
                return false;
            }
        }
    }
    return false;
}

function getFullName($firstName, $insertion, $lastName)
{
    $name = $firstName;
    $name .= " ";
    if ($insertion != "") {
        $name .= $insertion;
        $name .= " ";
    }
    $name .= $lastName;
    return $name;
}