<?php
ob_start();
session_start();
require __DIR__ . "/functies/algemeen.php";
require __DIR__ . "/functies/helpers.php";
require __DIR__ . "/functies/content.php";
require __DIR__ . '/parts/head.php';
require __DIR__ . '/databaseFuncties/account.php';
require __DIR__ . '/validatieFuncties/account.php';


// Haal de gegevens van het account op
$account = haalAccountOpID($_SESSION['id'])[0];

// wachtwoord wijzigen
if (isset($_POST['wwWijzigen']) && herhaalWachtwoord($_POST['email'], $_POST['huidigWW'], $_POST['nieuwWW'], $_POST['herhaalWW'])) {
    wijzigWachtwoord($_SESSION['id'], password_hash($_POST['herhaalWW'], PASSWORD_DEFAULT));
}


// CHECKEN OF PASSWORD DATABASE EN HUIDIGE WW WERKT NOG NIET
$message = '';
if(isset($_POST['email'],$_POST['huidigWW'] ,  $_POST['nieuwWW'] , $_POST['herhaalWW'])) {
if (password_verify($account['password'], PASSWORD_DEFAULT)  != $_POST['huidigWW']) {
    $message = 'huidige wachtwoord is onjuist';
} elseif ($_POST['nieuwWW'] != $_POST['herhaalWW']) {
    $message = 'Nieuw wachtwoord komt niet overeen';
}}


// foutmelding
if (isset($message)) {
    echo $message;
}

?>
<form method="post">
    <div class="col-lg-6 form-group">
        <label for="">Email*</label>
        <input type="text" class="form-control" id="" name="email"
               value="<?= $account['email'] ?? '' ?>" readonly required>
    </div>
    <div class="col-lg-6 form-group">
        <label for="">voer uw huidige wachtwoord in*</label>
        <input type="password" class="form-control" id="" name="huidigWW"
               value="" required>
    </div>
    <div class="col-lg-6 form-group">
        <label for="">Nieuw wachtwoord*</label>
        <input type="password" class="form-control" id="" name="nieuwWW"
               value="" required>
    </div>
    <div class="col-lg-6 form-group">
        <label for="">Herhaal nieuw wachtwoord *</label>
        <input type="password" class="form-control" id="" name="herhaalWW"
               value="" required>
    </div>

    <button onclick="" type="submit" name="wwWijzigen" class="btn btn-primary mb-3">Wachtwoord wijzigen</button>
</form>

</div>
<?php
require __DIR__ . "/parts/footer.php";
?>
