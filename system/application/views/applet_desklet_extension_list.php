<?php
if (isset($items) && $items->num_rows > 0) {
    ?>
    <div class="cs-items-list-container">
        <?php
        $i = 0;
        foreach ($items->result() as $item) {
            if ($i == 0) {
                echo '<div class="cs-items-list-row">';
            }

            $array = preg_split("/,/", timespan($item->last_edited, time()));
            $time_span = strtolower($array[0]) . " ago";
            $time_actual = date("Y-m-d, H:i", $item->last_edited);

            ?>
            <div class="cs-items-list-item cs-flex-column">
                <a href="/<?= $type ?>/view/<?= $item->id ?>" title="<?= $item->name ?>"
                   class="cs-items-list-details cs-flex-row">
                    <img src="<?= $item->icon ?>">
                    <label><?= $item->name ?></label>
                </a>
                <div class="cs-items-list-info-bar">
                    <a href="<?= $item->file ?>" class="cs-button cs-button-sm">Download</a>
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
            $i++;
            if ($i == 3) {
                echo "</div>";
                $i = 0;
            }
        }
        if ($i > 0) {
            echo "</div>";
        }
        ?>
    </div>
    <?php
}