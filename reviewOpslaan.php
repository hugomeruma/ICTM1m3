<?php
if (!isset($_GET['review'])) {
    $review = haalUserReviewOp($_GET['product']);
} else $review = array(
    'Rating' => 10,
    'Name' => "Wide World Importers",
    'Description' => "Wij geven jouw review zeker 5 sterren, maar helaas voldoet jouw review niet aan de eisen.<br> <br> Eisen die wij stellen aan een review: <ul> <li>Een review mag niet leeg zijn.</li><li>Een review mag geen 'code' bevatten.</li> <ul> 
"
)
?>

<div class="review-modal">
    <div class="review-modal-item">
        <div class="modal-top bg-primary"> <?php if(!isset($_GET["review"])): ?> Uw Review is opgeslagen <?php else: ?> Helaas... <?php endif; ?>
            <a href="<?= getBaseUrl() ?>?product=<?= $_GET['product'] ?>&categorie=<?= $_GET['categorie'] ?>"
               style="color: white; font-size: 60px; line-height: 30px; text-decoration: none;">
                &times
            </a>
        </div>
        <div class="modal-inhoud">

            <div class="d-flex justify-content-between">
                <?php stars($review['Rating']) ?>
                <strong><?= $review['Name'] ?></strong>
            </div>

            <div class="py-3">
                <?= $review['Description'] ?>
            </div>
        </div>
    </div>
</div>
