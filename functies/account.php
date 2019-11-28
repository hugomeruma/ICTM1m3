<?php
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
            echo "<br><br><br><br><br>";
//            da($account);
            if ($account[0]["password"] === $password) {

//                session_regenerate_id();
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