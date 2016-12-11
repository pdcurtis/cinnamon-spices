<div class="cs-flex">
    <div class="cs-flex cs-flex-grow">
        <?=anchor("$icon", "<img src='$icon' width='48'/>")?>
        <h1><?=$name?> <?=$version?></h1>
        <div>by <?=anchor("/users/view/$user_id", $username)?></div>
    </div>
    <div class="cs-flex">
        <?php if ($this->dx_auth->is_logged_in() && $this->dx_auth->get_user_id() == $user_id) {?>
            <?=anchor("/desklets/edit/$id", "Edit", "class='cs-button cs-button-sm'")?>&nbsp;
            <?=anchor("/desklets/delete/$id", "Delete", "class='cs-button', onClick=\"return confirm('Are you sure you want to delete this desklet?\\nAll comments and information about this desklet will be permanently lost.')\"")?>&nbsp;
        <?php } ?>
        <?php if (preg_match('/https?:\/\//', $website) === 1) { ?>
            <?=anchor("$website", "Website", "class='cs-button cs-button-sm'")?>&nbsp;
        <?php } ?>
        <?=anchor("$file", "Download", "class='cs-button cs-button-sm'")?><br/><br/>
    </div>
</div>

<hr>

<?=anchor("$screenshot", "<img src='$screenshot'/>")?><br/><br/>

<?php $this->view('_rate_item',['type'=>'desklets','rate_message'=>'Give this desklet the rating it deserves:']) ?>

<p><?=$description?></p>
                
<div id="post-author" class="clearfix">
    <div id="author-avatar">
        <?php
        $avatar = '/img/default_avatar.jpg';
		if (file_exists(FCPATH.'uploads/avatars/'.$user_id.".jpg")) {
			$avatar = '/uploads/avatars/'.$user_id.".jpg";
		}
        ?>
        <img alt='' src='<?=$avatar?>' class='avatar avatar-50 photo' height='50' width='50' />                
    </div><!-- END author-avatar -->
    <div id="author-description">
        <h4>About The Author</h4>
        <?=anchor("/users/view/$user_id", $username)?><br/>
        <?=$signature?><br/>
        <?=$biography?><br/>
    </div><!-- END author-description -->
</div><!-- END post-author -->

<?php $this->view('_comments',['type'=>'desklets']); ?>
