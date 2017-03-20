<!-- START comments-box -->
<div class="cs-comment-box">

    <h2 class="cs-comments-title"><?= $comments->num_rows ?> Comments</h2>

    <?php foreach ($comments->result() as $comment):
        $avatar = '/img/default_avatar.jpg';
        if (file_exists(FCPATH . 'uploads/avatars/' . $comment->user . ".jpg")) {
            $avatar = '/uploads/avatars/' . $comment->user . ".jpg";
        }
        $array = preg_split("/,/", timespan($comment->timestamp, time()));
        $time_span = strtolower($array[0]) . " ago";
        $time_actual = date("Y-m-d, H:i", $comment->timestamp);
        ?>
        <div class="cs-media cs-comment-row">
            <div class="cs-media-image cs-comment-image">
                <img alt='' src='<?= $avatar ?>' class='avatar avatar-50 photo'/>
            </div>
            <div class="cs-media-content cs-flex-column cs-flex-grow">
                <div class="cs-comment-author cs-flex-row">
                    <div class="cs-comment-author-name"><?= anchor("/users/view/$comment->user", "$comment->username", "class='url'") ?></div>
                    -
                    <div class="cs-comment-date" title='<?= $time_actual ?>'><?= $time_span ?></div>
                </div>
                <div class="cs-comment-text"><?= str_replace("\n","<br>\n",htmlspecialchars(trim($comment->body))) ?></div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php if (False) { ?>
        <div class="cs-comment-form">
            <h3>Leave A Comment</h3>
            <?= form_open("$type/comment/$id") ?>
            <textarea name="body" cols="100%" rows="3"></textarea>
            <input type="submit" class="cs-button cs-button-sm" value="Submit"/>
            </form>
        </div>
    <?php } ?>
</div>
<!-- END comments-box -->
