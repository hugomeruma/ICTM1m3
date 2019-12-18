<?php
$review = haalUserReviewOp($_GET['product']);
?>

<div class="review-modal">

    <div class="review-modal-item">
        <div class="modal-top bg-primary">Uw Review is opgeslagen
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
