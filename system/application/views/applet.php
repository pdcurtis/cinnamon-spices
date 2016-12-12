<?php $this->view('_item_details_head',['type'=>'applets']) ?>

<?=anchor("$screenshot", "<img src='$screenshot'/>")?><br/><br/>

<?php $this->view('_rate_item',['type'=>'applets','rate_message'=>'Give this applet the rating it deserves:']) ?>

<p><?=$description?></p>

<?php $this->view('_item_author') ?>
	
<?php $this->view('_comments',['type'=>'applets']);

