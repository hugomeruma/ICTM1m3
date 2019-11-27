<?php
require __DIR__ . "/../functies/helpers.php";
require __DIR__ . "/../functies/algemeneFuncties.php";
require __DIR__ . "/../databaseFuncties/account.php";
require __DIR__ . "/../parts/admin/head.php";
require __DIR__ . "/../parts/admin/menu.php";

if (isset($_POST['submit'])) {
    if (wijzigEmail($_POST['email'], $_SESSION['id'])) {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['alert']['success']['title'] = 'Succesvol!';
        $_SESSION['alert']['success']['message'] = 'De instellingen zijn succesvol aangepast.';
    }
    $_SESSION['alert']['error']['title'] = 'Error!';
    $_SESSION['alert']['error']['message'] = 'Er is iets fout gegaan.';
    redirect('admin/instellingen.php');
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