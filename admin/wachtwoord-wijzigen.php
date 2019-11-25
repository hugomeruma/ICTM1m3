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
            redirect('admin/wijzig-wachtwoord.php');
        }
    }
}

?>
    <div class="container">
        <div class="row mt-3 mb-3">
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