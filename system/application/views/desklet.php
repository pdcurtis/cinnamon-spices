<?php $this->view('_item_details_head',['type'=>'desklets']) ?>

<?=anchor("$screenshot", "<img src='$screenshot'/>")?><br/><br/>

<?php $this->view('_rate_item',['type'=>'desklets','rate_message'=>'Give this desklet the rating it deserves:']) ?>

<p><?=$description?></p>

<?php $this->view('_item_author') ?>

<?php $this->view('_comments',['type'=>'desklets']); ?>
