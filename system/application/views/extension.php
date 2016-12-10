<div class="cs-breadcrumbs">
    <ul>
        <li><a href="/">Home</a></li>
        <li>/</li>
        <li><a href="/extensions">Extensions</a></li>
        <li>/</li>
        <li><?= $name ?></li>
    </ul>
</div>

<div id="main">
        	<div id="post-content" class="clearfix">                
				        		<h1 class="page-title"><?=anchor("$icon", "<img src='$icon' width='48'/>")?> <?=$name?> <?=$version?></h1>	                                
                                <i><font color="#555555">UUID: <?=$uuid?></font></i><br/>
                                <i><font color="#555555">Score: <?=$score?></font></i><br/><br/>

<?php if ($this->dx_auth->is_logged_in() && $this->dx_auth->get_user_id() == $user_id) {?>
    <?=anchor("/extensions/edit/$id", "Edit", "class='small blue awesome'")?>&nbsp;
    <?=anchor("/extensions/delete/$id", "Delete", "class='small red awesome', onClick=\"return confirm('Are you sure you want to delete this extension?\\nAll comments and information about this extension will be permanently lost.')\"")?>&nbsp;
<?php } ?>
<?php if (preg_match('/https?:\/\//', $website) === 1) { ?>
    <?=anchor("$website", "Website", "class='small yellow awesome'")?>&nbsp;
<?php } ?>
<?=anchor("$file", "Download", "class='small awesome'")?><br/><br/>

<?=anchor("$screenshot", "<img src='$screenshot'/>")?><br/><br/>

<?php if ($this->dx_auth->is_logged_in()) { ?>
    Give this extension the rating it deserves: <br/><br/>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <?php 
        $color="grey"; if ($rating == 1) { $color = "red"; }
        echo anchor("/extensions/rate/$id/1", "<div align=center>*<br/>1-star</div>", "class='small $color awesome'")."&nbsp;";
        $color="grey"; if ($rating == 2) { $color = "orange"; }
        echo anchor("/extensions/rate/$id/2", "<div align=center>**<br/>2-stars</div>", "class='small $color awesome'")."&nbsp;";
        $color="grey"; if ($rating == 3) { $color = "yellow"; }
        echo anchor("/extensions/rate/$id/3", "<div align=center>***<br/>3-stars</div>", "class='small $color awesome'")."&nbsp;";
        $color="grey"; if ($rating == 4) { $color = "blue"; }
        echo anchor("/extensions/rate/$id/4", "<div align=center>****<br/>4-stars</div>", "class='small $color awesome'")."&nbsp;";
        $color="grey"; if ($rating == 5) { $color = "green"; }
        echo anchor("/extensions/rate/$id/5", "<div align=center>*****<br/>5-stars</div>", "class='small $color awesome'")."&nbsp;";
    ?>
    <br/><br/>
<?php } ?>

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
	
<!-- You can start editing here. -->
<div id="commentsbox">

    <?php if ($this->dx_auth->is_logged_in()) { ?>
        <div id="comment-form">
            <div id="respond">
                <h3 id="comments-respond">Leave A Comment</h3>          
                <?=form_open("extensions/comment/$id") ?>
                    <textarea name="body" cols="100%" rows="10"></textarea><br/>
                    <input type="submit" value="Submit" />                
                </form>
            </div><!-- END respond -->
        </div><!-- END comment-form -->
    <?php } ?>

    <h3 id="comments"><?=$comments->num_rows?> Comments</h3>

    <ol class="commentlist">
    <?php foreach($comments->result() as $comment):
        $avatar = '/img/default_avatar.jpg';
		if (file_exists(FCPATH.'uploads/avatars/'.$comment->user.".jpg")) {
			$avatar = '/uploads/avatars/'.$comment->user.".jpg";
                }
        $array = preg_split("/,/", timespan($comment->timestamp, time()));
        $time_span = strtolower($array[0])." ago";
        $time_actual = date("Y-m-d, H:i", $comment->timestamp);
		
    ?>    
        <li class="comment even thread-even depth-1">
            <div class="comment-body">
                <div class="comment-avatar">
                    <img alt='' src='<?=$avatar?>' class='avatar avatar-50 photo' height='50' width='50' />                
                </div><!-- END avatar -->
                <div class="comment-author vcard">
                    <cite class="fn"><?=anchor("/users/view/$comment->user", "$comment->username", "class='url'")?></cite> <span class="says">says:</span>
                    <p class='comment-timestamp' title='<?=$time_actual?>'><?=$time_span?></p><span class="clearfix" />
                </div><!-- END comment-author vcard -->
                
                <p><?=$comment->body?></p>
            </div><!-- END comment -->
        </li>
    <?php endforeach;?>	
    </ol>

    <div class="comment-nav">
        <div class="alignleft"></div>
        <div class="alignright"></div>
    </div>
    <!-- END comment-navigation -->

</div><!-- END comments-box -->

</div>
<!-- END post-content -->
