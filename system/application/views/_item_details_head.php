<?php

$server_path = realpath(BASEPATH.'/../');
if (file_exists("$server_path/git/$type/$uuid/icon.png")) {
    $icon = "/git/$type/$uuid/icon.png";
}
?>
<div class="cs-flex cs-details-head">
    <?php if (isset($icon)) { ?>
        <div class="cs-details-icon cs-flex-center">
            <img src='<?= $icon ?>'/>
        </div>
    <?php } ?>
    <div class="cs-flex cs-flex-grow cs-flex-wrap cs-flex-center">
        <h1><?= $name ?></h1>
        <div class="cs-details-head-author-name">
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
