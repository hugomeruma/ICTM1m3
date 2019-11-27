<?php
require __DIR__ . "/../functies/helpers.php";
require __DIR__ . "/../functies/algemeneFuncties.php";
require __DIR__ . "/../databaseFuncties/account.php";
require __DIR__ . "/../parts/admin/head.php";
require __DIR__ . "/../parts/admin/menu.php";

if (isset($_POST['submit'])) {
    if (wijzigEmail($_POST['email'], $_SESSION['id'])) {
        $_SESSION['email'] = $_POST['email'];
    }
    redirect('admin/instellingen.php');
}

?>
    <div class="container">
        <div class="row mt-3 mb-3">
            <div class="col-12">
                <h1 class="text-dark">Instellingen</h1>
            </div>
            <div class="col-12">
                <form method="post">
                    <div class="form-group">
                        <label for="email">E-mail adres*</label>
                        <input type="email" name="email" class="form-control" id="email"
                               value="<?= $_SESSION['email'] ?>" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success">Opslaan</button>
                </form>
            </div>
        </div>
    </div>

<?php
require "../parts/admin/footer.php";