<!-- START comments-box -->
<div id="comment-box" class="cs-comment-box">
    <?php if ($this->session->userdata('oauth')) { ?>
        <h2 id="form_header" class="cs-comments-title">Leave A Comment.</h2>
        <div class="cs-comment-form">
            <?php
                $attributes = array('id'=>'comment_form');
                echo form_open("comment/submit/$type/$id", $attributes);
            ?>
            <textarea name="body" style="width:100%" rows="5" placeholder="comment here....."></textarea>
            <input name="parent_id" value="0" id="parent_id" style="display: none;"/>
            <input type="submit" class="cs-button cs-button-sm" value="Submit"/>
            <a href="#" id="form_clear" class="cs-button cs-button-sm cs-button-cancel">Cancel</a>
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
    <h3 class="cs-comments-amount"><?= $count ?> Comments</h3>
    <div id="comments">
        <?php echo $comments ?>
    </div>
</div>
<!-- END comments-box -->
