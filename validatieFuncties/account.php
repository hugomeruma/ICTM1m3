<?php
function HerhaalWachtwoord($mail, $huidigWachtwoord, $nieuwWachtwoord, $nieuwWachtwoordHerhaling)
{
    if (login($mail, $huidigWachtwoord, true)) {
        if ($nieuwWachtwoord == $nieuwWachtwoordHerhaling) {
            return true;
        }
    }
    return false;
}