<div class="cs-flex cs-details-head">
    <div class="cs-flex cs-flex-grow cs-flex-wrap cs-flex-center">
        <?php if(isset($icon)) { ?>
        <img src='<?= $icon ?>'/>
        <?php } ?>
        <h1><?=$name?></h1>
        <div>by <?=$author?></div>
    </div>
    <div class="cs-flex cs-flex-center">
        <?=anchor("https://github.com/linuxmint/cinnamon-spices-$type/tree/master/$uuid", "Website", "target='_blank' class='cs-button cs-button-white'")?>&nbsp;
        <?=anchor("/files/$type/$uuid.zip", "Download", "class='cs-button'")?>
    </div>
</div>
