<!-- <div class="col-6"> -->
<?php
$reviews = getReviews($_GET['view']);
foreach ($reviews as $review):
    ?>
    <div class="row review-header-row">
        <div class="col-4 review-header">
            <?= $review['UserName'] ?>
    </div>
        <div class="col-1 review-rating">
            <?= stars($review['Rating']) ?>
    </div>
</div>
    <div class="row review-text-row">
        <div class="col review-text">
            <?= $review['Description'] ?>
    </div>
</div>
<div class="row justify-content-end">
    <div class="col-1 review-rating">
        <?= $review['Rating'] ?>
    </div>
</div>
<?php
endforeach;
?>

<!-- <div> -->