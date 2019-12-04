<?php
require __DIR__ . "/../functies/helpers.php";
require __DIR__ . "/../functies/algemeneFuncties.php";
require __DIR__ . "/../functies/account.php";
require __DIR__ . "/../databaseFuncties/account.php";
require __DIR__ . "/../validatieFuncties/account.php";
require __DIR__ . "/../parts/admin/head.php";
require __DIR__ . "/../parts/admin/menu.php";

if (isset($_POST['submit'])) {
    if (wijzigWachtwoordValidatie($_SESSION['email'], $_POST['huidigWachtwoord'], $_POST['huidigWachtwoord'], $_POST['nieuwWachtwoordHerhaling'])) {
        if (wijzigWachtwoord($_SESSION['id'], $_POST['huidigWachtwoord'])) {
            $_SESSION['alert']['success']['title'] = 'Succes!';
            $_SESSION['alert']['success']['message'] = 'Het wachtwoord is aangepast.';
        } else {
            $_SESSION['alert']['error']['title'] = 'Error!';
            $_SESSION['alert']['error']['message'] = 'Er is iets fout gegaan.';
        }
    } else {
        $_SESSION['alert']['error']['title'] = 'Error!';
        $_SESSION['alert']['error']['message'] = 'De velden voldoen niet aan de juiste waarden.';
    }
    redirect('admin/wachtwoord-wijzigen.php');
}

?>
    <div class="container">
        <div class="row mt-3 mb-3">
            <?php if (isset($_SESSION['alert']['success'])): ?>
                <div class="col-12">
                    <div class="alert alert-success" role="alert">
                        <strong><?= $_SESSION['alert']['success']['title'] ?></strong> <?= $_SESSION['alert']['success']['message'] ?>
                    </div>
                </div>
                <?php
                unset($_SESSION['alert']);
            elseif (isset($_SESSION['alert']['error'])):
                ?>
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <strong><?= $_SESSION['alert']['error']['title'] ?></strong> <?= $_SESSION['alert']['error']['message'] ?>
                    </div>
                </div>
                <?php
                unset($_SESSION['alert']);
            endif;
            ?>
            <div class="col-12">
                <h1 class="text-dark">Wachtwoord wijzigen</h1>
            </div>
            <div class="col-12">
                <form method="post">
                    <div class="form-group">
                        <label for="huidigWachtwoord">Huidig wachtwoord*</label>
                        <input type="password" name="huidigWachtwoord" class="form-control" id="huidigWachtwoord"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="nieuwWachtwoord">Nieuw wachtwoord*</label>
                        <input type="password" name="nieuwWachtwoord" class="form-control" id="nieuwWachtwoord"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="nieuwWachtwoordHerhaling">Nieuw wachtwoord herhaling*</label>
                        <input type="password" name="nieuwWachtwoordHerhaling" class="form-control"
                               id="nieuwWachtwoordHerhaling" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success">Opslaan</button>
                </form>
            </div>
        </div>
    </div>

<?php
require "../parts/admin/footer.php";