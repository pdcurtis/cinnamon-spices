<?php $this->view('_item_details_head',['type'=>'extensions']) ?>

<!--<br>-->
<!--UUID: --><?//=$uuid?>
<!--<br/>-->
<!--Score: --><?//=$score?>

<?=anchor("$screenshot", "<img src='$screenshot'/>")?><br/><br/>

<?php $this->view('_rate_item',['type'=>'extensions','rate_message'=>'Give this extension the rating it deserves:']) ?>

<div style="border: solid 1px silver; border-radius: 0.25rem;padding: 2rem;margin-bottom: 1rem;background-color: white">
    <?=$description?>
</div>

<?php $this->view('_item_author') ?>

<?php $this->view('_comments',['type'=>'extensions']); ?>
