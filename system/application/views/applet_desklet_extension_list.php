<?php
if (isset($items) && $items->num_rows > 0) {
    ?>
    <div class="cs-items-list-container cs-flex cs-flex-wrap">
        <?php

        foreach ($items->result() as $item) {

            $array = preg_split("/,/", timespan($item->last_edited, time()));
            $time_span = strtolower($array[0]) . " ago";
            $time_actual = date("Y-m-d, H:i", $item->last_edited);

            ?>
            <div class="cs-items-list-item cs-flex-column">
                <a href="/<?= $type ?>/view/<?= $item->id ?>" title="<?= $item->name ?>"
                   class="cs-items-list-details cs-flex-row">
                    <img src="/git/<?= $type ?>/<?= $item->uuid ?>/icon.png">
                    <label><?= $item->name ?></label>
                </a>
                <div class="cs-items-list-info-bar">
                    <a href="/files/<?= $type ?>/<?= $item->uuid ?>.zip" class="cs-button cs-button-sm">Download</a>
                    <span>
                        <svg><use xlink:href="/resources/icons/sprite.svg#cs-star"></use></svg>
                        <?= $item->score ?>
                    </span>
                    <!--span>
                        <svg><use xlink:href="/resources/icons/sprite.svg#cs-cloud"></use></svg>
                        123
                    </span-->
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
}
