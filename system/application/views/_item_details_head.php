<div class="cs-flex cs-details-head">
    <div class="cs-flex cs-flex-grow cs-flex-wrap cs-flex-center">
        <?php if (isset($icon)) { ?>
            <img src='<?= $icon ?>'/>
        <?php } ?>
        <h1><?= $name ?></h1>
        <div>
            <?php if ($author != "" && $author != "none") { ?>
                by <?= $author ?>
            <?php } ?>
        </div>
    </div>
    <div class="cs-flex cs-flex-center">
        <?php if ($this->session->userdata('oauth')) { ?>
            <?php if ($liked) { ?>
                <h3>You like it!&nbsp;&nbsp;</h3>
            <?php } else { ?>
                <?= anchor("/$type/rate/$id", "I like it!", "class='cs-button cs-button-sm'") ?>
            <?php } ?>
            &nbsp;
        <?php } ?>
        <?= anchor("https://github.com/linuxmint/cinnamon-spices-$type/tree/master/$uuid", "Website", "target='_blank' class='cs-button  cs-button-sm cs-button-outline cs-button-outline-gray'") ?>
        &nbsp;
        <?= anchor("/files/$type/$uuid.zip", "Download", "class='cs-button cs-button-sm'") ?>
    </div>
</div>
