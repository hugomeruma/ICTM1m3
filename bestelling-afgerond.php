<?php
require __DIR__ . '/init.php';
require __DIR__ . "/parts/head.php";
?>

<h1 class="text-center"><?= $_SESSION['melding']['titel'] ?></h1>
<p class="text-center text-primary"><?= $_SESSION['melding']['bericht'] ?></p>

<?php
unset($_SESSION['melding']['titel']);
unset($_SESSION['melding']['bericht']);
require __DIR__ . "/parts/footer.php";
?>

