<?php
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