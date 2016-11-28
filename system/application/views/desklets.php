<div class="cs-content-filter">
    <ul>
        <!--        <li class="active">-->
        <!--            <a href="/themes/featured">Featured</a>-->
        <!--        </li>-->
        <li class="<?= $mode == 'popular' ? 'active' : '' ?>">
            <a href="/desklets/popular">Popular</a>
        </li>
        <li class="<?= $mode == 'latest' ? 'active' : '' ?>">
            <a href="/desklets/latest">Latest</a>
        </li>
        <!--        <li>-->
        <!--            <a href="/themes/all">See All</a>-->
        <!--        </li>-->
        <!--        <li>-->
        <!--            <a href="#">Upload your theme</a>-->
        <!--        </li>-->
    </ul>
</div>


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
                <a href="/desklets/view/<?= $item->id ?>" title="Icing Task Manager" class="cs-items-list-details cs-flex-row">
                    <img src="<?= $item->icon ?>">
                    <label><?= $item->name ?></label>
                </a>
                <div class="cs-items-list-info-bar">
                    <a href="<?= $item->file ?>" download class="cs-button cs-button-sm">Download</a>
                    <span><img src="/resources/icons/black.star.svg"><?= $item->score ?></span>
                    <span title="<?= $time_actual ?>"><img src="/resources/icons/time-ago.png"><?= $time_span ?></span>
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
