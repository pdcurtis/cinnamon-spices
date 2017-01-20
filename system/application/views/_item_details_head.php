<style>
    .cs-details-head {
    }
    .cs-details-head > div > img {
        height: 3rem;
        margin-right: .5rem;
        width: 3rem;
    }
    .cs-details-head h1 {
        font-size: 1.9rem;
        margin-right: .5rem;
    }
    .cs-details-head-button {
        line-height: 1.75rem;
        height: 1.75rem;
        font-size: 0.75rem;
        font-weight: normal;
        padding: 0 1rem;
        text-transform: none;
    }
    .cs-details-head-button-w {
        line-height: 1.75rem;
        height: 1.75rem;
        font-size: 0.75rem;
        font-weight: normal;
        padding: 0 1rem;
        background-color: transparent;
        color: black;
        border:solid 1px silver;
        text-transform: none;
    }
</style>
<div class="cs-flex cs-details-head">
    <div class="cs-flex cs-flex-grow cs-flex-center">
        <?php if(isset($icon)) { ?>
        <img src='<?= $icon ?>'/>
        <?php } ?>
        <h1><?=$name?></h1>
        <div>by <?=$author?></div>
    </div>
    <div class="cs-flex cs-flex-center">
        <?=anchor("https://github.com/linuxmint/cinnamon-spices-$type/tree/master/$uuid", "Website", "target='_blank' class='cs-button cs-details-head-button-w'")?>&nbsp;
        <?=anchor("/files/$type/$uuid.zip", "Download", "class='cs-button cs-details-head-button'")?>
    </div>
</div>

<hr>