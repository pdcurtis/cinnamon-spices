<div class="cs-content-filter">
    <ul>
        <!--        <li class="active">-->
        <!--            <a href="/themes/featured">Featured</a>-->
        <!--        </li>-->
        <li class="<?= $mode == 'popular' ? 'active' : '' ?>">
            <a href="/themes/popular">Popular</a>
        </li>
        <li class="<?= $mode == 'latest' ? 'active' : '' ?>">
            <a href="/themes/latest">Latest</a>
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
if (isset($themes) && $themes->num_rows > 0) {
    ?>
    <div class="cs-items-list-container">
        <?php
        $i = 0;
        foreach ($themes->result() as $theme) {
            if ($i == 0) {
                echo '<div class="cs-items-list-row">';
            }

            $array = preg_split("/,/", timespan($theme->last_edited, time()));
            $time_span = strtolower($array[0]) . " ago";
            $time_actual = date("Y-m-d, H:i", $theme->last_edited);

            ?>
            <div class="cs-items-list-item cs-flex-column">
                <a href="/themes/view/<?= $theme->id ?>">
                    <div class="cs-items-list-image">
                        <div class="cs-items-list-overlay">
                            <div class="cs-items-list-title"><?= $theme->name ?></div>
                        </div>
                        <div class="cs-items-bg-image"
                             style="background-image: url(<?= $theme->screenshot ?>)"></div>
                    </div>
                </a>
                <div class="cs-items-list-info-bar">
                    <a href="<?= $theme->file ?>" class="cs-button cs-button-sm">Download</a>
                    <span>
                        <svg><use xlink:href="resources/icons/sprite.svg#cs-star"></use></svg>
                        <?= $theme->score ?>
                    </span>
                    <!--span>
                        <svg><use xlink:href="resources/icons/sprite.svg#cs-cloud"></use></svg>
                        123
                    </span-->
                    <span title="<?= $time_actual ?>">
                        <svg><use xlink:href="resources/icons/sprite.svg#cs-update"></use></svg>
                        <?= $time_span ?>
                    </span>
                </div>
            </div>
            <?php
            $i++;
            if ($i == 2) {
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
