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

            $thumb = str_replace("themes", "themes/thumbs", $theme->screenshot);
            if (file_exists(FCPATH . $thumb)) {
                $screenshot = $thumb;
            } else {
                $screenshot = $theme->screenshot;
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
                             style="background-image: url(<?= $screenshot ?>)"></div>
                    </div>
                </a>
                <div class="cs-items-list-info-bar">
                    <a href="#" class="cs-button btn-download">Download</a>
                    <span><img src="/resources/icons/black.star.svg"><?= $theme->score ?></span>
                    <span title="<?= $time_actual ?>"><img src="resources/icons/time-ago.png"><?= $time_span ?></span>
                    <!--span><img src="resources/icons/download.png">123</span-->
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
