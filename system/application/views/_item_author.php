<style>
    .cs-details-author {
        margin-bottom: 1rem;
    }
    .cs-details-author-heading {
        margin-bottom: 1rem;
    }
    .cs-details-author-avatar > img {
        height: 5rem;
        width: 5rem;
        border-radius: .5rem;
        margin-right: 1rem;
    }
</style>
<h2 class="cs-details-author-heading">About The Author</h2>
<div class="cs-flex-row cs-details-author">
    <div class="cs-details-author-avatar">
        <?php
        $avatar = '/img/default_avatar.jpg';
        if (file_exists(FCPATH . 'uploads/avatars/' . $user_id . ".jpg")) {
            $avatar = '/uploads/avatars/' . $user_id . ".jpg";
        }
        ?>
        <img src='<?= $avatar ?>'/>
    </div><!-- END author-avatar -->
    <div class="cs-details-author-info">
        <?= anchor("/users/view/$user_id", $username) ?><br/>
        <?= $signature ?><br/>
        <?= $biography ?><br/>
    </div>
</div>