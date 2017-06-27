<?php
if (isset($items) && $items->num_rows > 0) {

    $themeclass = ($type === 'themes') ? 'cs-items-list-theme' : '';

    ?>
    <div class="cs-items-list-container <?= $themeclass ?> cs-flex cs-flex-wrap">
        <?php

        foreach ($items->result() as $item) {

            if ($type === 'themes') {
                $themePreviewUrl = "/git/themes/".$item->uuid."/screenshot.png";
                if(file_exists($wwwroot.'/uploads/themes/preview/'.$item->uuid.'.jpg')) {
                    $themePreviewUrl = '/uploads/themes/preview/'.$item->uuid.'.jpg';
                } else if(file_exists($wwwroot.'/uploads/themes/thumbs/'.$item->uuid.'.png')) {
                    $themePreviewUrl = '/uploads/themes/thumbs/'.$item->uuid.'.png';
                }
            }

            $array = preg_split("/,/", timespan($item->last_edited, time()));
            $time_span = strtolower($array[0]) . " ago";
            $time_actual = date("Y-m-d, H:i", $item->last_edited);

            ?>
            <div class="cs-items-list-item cs-flex-column">
                <?php
                    if ($type == 'themes') {
                ?>
                    <a href="/<?= $type ?>/view/<?= $item->uuid ?>">
                        <div class="cs-items-list-image">
                            <div class="cs-items-list-overlay">
                                <div class="cs-items-list-title"><?= $item->name ?></div>
                            </div>
                            <div class="cs-items-bg-image"
                                 style="background-image: url(<?= $themePreviewUrl ?>)"></div>
                        </div>
                    </a>
                <?php
                    } else {
                ?>
                    <a href="/<?= $type ?>/view/<?= $item->id ?>" title="<?= $item->name ?>"
                       class="cs-items-list-details cs-flex-row">
                        <img src="/git/<?= $type ?>/<?= $item->uuid ?>/icon.png">
                        <label><?= $item->name ?></label>
                    </a>
                <?php
                    }
                ?>

                <div class="cs-items-list-info-bar">
                    <a href="/files/<?= $type ?>/<?= $item->uuid ?>.zip" class="cs-button cs-button-sm">Download</a>
                    <span>
                        <svg><use xlink:href="/resources/icons/sprite.svg#cs-star"></use></svg>
                        <?= $item->score ?>
                    </span>
                    <span title="<?= $time_actual ?>">
                        <svg><use xlink:href="/resources/icons/sprite.svg#cs-update"></use></svg>
                        <?= $time_span ?>
                    </span>
                </div>
            </div>
            <?php
                }
            ?>
    </div>
    <?php

    echo $this->pagination->create_links();
}
?>
