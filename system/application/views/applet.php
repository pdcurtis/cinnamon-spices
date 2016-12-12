<?php $this->view('_item_details_head',['type'=>'applets']) ?>

<?=anchor("$screenshot", "<img src='$screenshot'/>")?><br/><br/>

<?php $this->view('_rate_item',['type'=>'applets','rate_message'=>'Give this applet the rating it deserves:']) ?>

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
	
<?php $this->view('_comments',['type'=>'applets']);

