<?php if (isset($auth_user) && $review["customer_id"] != $auth_user["id"]): ?>
<div class="vote-block">
    <button class="like review-like <?= $review["is_like"] ? "active" : "" ?>" data-id="<?= $review["id"] ?>">
        <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
        <p class="m-t-5 m-b-10 counter"><?= $review["like_count"] ?></p>
    </button>

    <button class="dislike review-dislike <?= $review["is_dislike"] ? "active" : "" ?>" data-id="<?= $review["id"] ?>">
        <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
        <p class="m-t-5 m-b-10 counter"><?= $review["dislike_count"] ?></p>
    </button>
</div>

<?php else: ?>

<div class="vote-block">
    <button class="like">
        <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
        <p class="m-t-5 m-b-10 counter"><?= $review["like_count"] ?></p>
    </button>

    <button class="dislike">
        <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
        <p class="m-t-5 m-b-10 counter"><?= $review["dislike_count"] ?></p>
    </button>
</div>

<?php endif; ?>