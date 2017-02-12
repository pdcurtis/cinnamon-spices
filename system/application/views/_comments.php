<!-- START comments-box -->
<style>
    .cs-comments-title {
        margin-bottom: 1rem;
    }

    .cs-comment-avatar {
        margin-right: 1rem;
    }

    .cs-comment-avatar > img {
        height: 5rem;
        width: 5rem;
        border-radius: .5rem;
    }

    .cs-comment-row {
        margin-bottom: 1rem;
    }

    .cs-comment-author {
        margin-bottom: .5rem;
    }

    .cs-comment-author-name {
        font-weight: bold;
        margin-right: 1rem;
    }

    .cs-comment-date {
        margin-left: 1rem;
        color: silver;
    }

    .cs-comment-form > h3, .cs-comment-form > form {
        margin-bottom: .5rem;
    }

    .cs-comment-form > form > textarea {
        margin-bottom: .5rem;
        display: block;
    }
</style>

<hr>

<div class="cs-comment-box">

    <h2 class="cs-comments-title"><?= $comments->num_rows ?> Comments</h2>

    <?php foreach ($comments->result() as $comment):
        $array = preg_split("/,/", timespan($comment->timestamp, time()));
        $time_span = strtolower($array[0]) . " ago";
        $time_actual = date("Y-m-d, H:i", $comment->timestamp);
        ?>
        <div class="cs-comment-row cs-flex-row">
            <div class="cs-comment-avatar">
                <img alt='<?= $comment->user_full_name ?>' src='<?= $comment->user_avatar ?>' class='avatar avatar-50 photo'/>
            </div>
            <div class="cs-comment-body cs-flex-column cs-flex-grow">
                <div class="cs-comment-author cs-flex-row">
                    <div class="cs-comment-author-name"><?= anchor($comment->user_link, $comment->user_full_name, "target='_blank' class='url'") ?></div>
                    -
                    <div class="cs-comment-date" title='<?= $time_actual ?>'><?= $time_span ?></div>
                </div>
                <div class="cs-comment-text"><?= str_replace("\n","<br>\n",htmlspecialchars(trim($comment->message))) ?></div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php if ($this->session->userdata('oauth')) { ?>
        <div class="cs-comment-form">
            <h3>Leave A Comment</h3>
            <?= form_open("$type/comment/$id") ?>
            <textarea name="body" cols="100%" rows="3"></textarea>
            <input type="submit" class="cs-button cs-button-sm" value="Submit"/>
            <?= form_close() ?>
        </div>
    <?php } else { ?>
        <hr>
        <h3>To leave comment - please authenticate:</h3>
        <div class="cs-flex-row">
            <a href="#" id="lnkLoginFacebook" style="width:100%;
            padding: 10px; color: white;
            display: block; background-color: blue">Login with Facebook</a>
            <a href="#" id="lnkLoginGoogle" style="width:100%;
            padding: 10px; color: white;
            display: block; background-color: red">Login with Google</a>
            <a href="#" id="lnkLoginGitHub" style="width:100%;
            padding: 10px; color: white;
            display: block; background-color: slategray">Login with GitHub</a>
        </div>
    <?php } ?>

</div>
<!-- END comments-box -->