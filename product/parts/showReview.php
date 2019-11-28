<!-- <div class="col-6"> -->
<?php
$reviews = getReviews($_GET['view']);
foreach ($reviews as $review):
    ?>
    <div class="col review-box">
        <div class="row review-header-row">
            <div class="col-5 review-header">
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
        <span inline-block>
        <?= $review['Rating'] ?>
        </span>
            </div>
        </div>
</div>
<?php
endforeach;
?>

<!-- <div> -->