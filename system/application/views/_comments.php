<!-- START comments-box -->
<style>
.cs-details-head .cs-button {
    border: .0625rem solid transparent;
    font-size: .75rem;
    padding: .5rem 1rem;
}

.cs-button-white {
    background: transparent;
    border: .0625rem solid #999 !important;
    color: #333;
    transition-property: all;
    margin-right: .25rem;
}

.cs-button-white:hover {
    border-color: transparent !important;
}

.cs-button-outline {
    background: transparent;
    border: 2px solid #dc6830;
}

.cs-details-body {
    padding: 1.25rem 0 1.5rem;
}

.cs-item-details-description {
    margin-top: 0;
}

.cs-comment-form {
    border-bottom: .0625rem solid #414141;
    padding: 0 0 1.25rem;
    margin-bottom: 1rem;
}
.cs-comment-form > form > textarea {
    margin-bottom: 1rem;
}

.cs-comment-form form {
    max-width: 55rem;
}

.cs-comments-title {
    font-size: 1.675rem;
    margin-bottom: 1rem;
}

.cs-comments-amount {
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.cs-comment-row {
    max-width:  55rem;
}

</style>
<div class="cs-comment-box">

    <?php if ($this->session->userdata('oauth')) { ?>
        <h2 class="cs-comments-title">Leave A Comment</h2>
        <div class="cs-comment-form">
            <?= form_open("$type/comment/$id") ?>
            <textarea name="body" style="width:100%" rows="5" placeholder="comment here....."></textarea>
            <input type="submit" class="cs-button cs-button-sm" value="Submit"/>
            <?= form_close() ?>
        </div>
    <?php } else { ?>
        <h2 class="cs-comments-title">Log In To Comment!</h2>
        <div class="cs-comment-form">
            <div class="cs-comment-login cs-flex-row">
                <?php $this->view('oauth/_login-button') ?>
            </div>
        </div>
    <?php } ?>

    <h3 class="cs-comments-amount"><?= $comments->num_rows ?> Comments</h3>

    <?php foreach ($comments->result() as $comment):
        $array = preg_split("/,/", timespan($comment->timestamp, time()));
        $time_span = strtolower($array[0]) . " ago";
        $time_actual = date("Y-m-d, H:i", $comment->timestamp);
        ?>

        <div class="cs-media cs-comment-row">
            <div class="cs-media-image cs-comment-image">
                <?= anchor($comment->user_link, "<img alt=' $comment->user_full_name ' src='$comment->user_avatar' class='avatar avatar-50 photo'/>", "target='_blank' class='url'") ?>            </div>
            <div class="cs-media-content cs-flex-column cs-flex-grow">
                <div class="cs-comment-author cs-flex-row">
                    <div class="cs-comment-author-name"><?= anchor($comment->user_link, $comment->user_full_name, "target='_blank' class='url'") ?></div>
                    -
                    <div class="cs-comment-date" title='<?= $time_actual ?>'><?= $time_span ?></div>
                </div>
                <div class="cs-comment-text"><?= str_replace("\n","<br>\n",htmlspecialchars(trim($comment->message))) ?></div>
            </div>
        </div>

    <?php endforeach; ?>

</div>
<!-- END comments-box -->
