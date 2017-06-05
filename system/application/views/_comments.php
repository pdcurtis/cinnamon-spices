<!-- START comments-box -->
<div id="comment-box" class="cs-comment-box" data-type="<?= $type ?>" data-spice="<?= $id ?>">
    <?php if ($this->session->userdata('oauth')) { ?>
        <h2 class="cs-comments-title">Leave A Comment.</h2>
        <div class="cs-comment-form cs-comment-form-main">
            <form id="form-master">
                <textarea id="master-body" name="body" rows="5" placeholder="comment here....."></textarea>
            </form>
        </div>
    <?php } else { ?>
        <h2 class="cs-comments-title">Log In To Comment!</h2>
        <div class="cs-comment-form cs-comment-form-main">
            <div class="cs-comment-login cs-flex-row">
                <?php $this->view('oauth/_login-button') ?>
            </div>
        </div>
    <?php } ?>
    <h3 class="cs-comments-amount"><?= $count ?> Comments</h3>
    <div id="comments">
        <?php echo $comments ?>
    </div>
</div>
<!-- END comments-box -->
