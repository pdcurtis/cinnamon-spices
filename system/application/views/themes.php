<?php
$wwwroot = realpath(BASEPATH.'/../');
?>
<div class="cs-content-filter">
    <ul>
        <li class="<?= $mode == 'popular' ? 'active' : '' ?>">
            <a href="/themes/popular">Popular</a>
        </li>
        <li class="<?= $mode == 'latest' ? 'active' : '' ?>">
            <a href="/themes/latest">Latest</a>
        </li>
        <li class="search">
            <label>Search:</label>
            <input type="text" id="cs-xlet-search-input"
                   data-search-url="/themes/search"
                   data-search-key="uuid"
                   data-search-type="themes">
            <div id="cs-xlet-search-results-container" class="cs-xlet-search-results-container" style="display: none">
                <ul id="cs-xlet-search-results-list"></ul>
            </div>
        </li>
    </ul>
</div>

<?php
if (isset($themes) && $themes->num_rows > 0) {
    ?>
    <div class="cs-items-list-container cs-items-list-theme cs-flex cs-flex-wrap">
        <?php

        foreach ($themes->result() as $theme) {

            $themePreviewUrl = "/git/themes/".$theme->uuid."/screenshot.png";
            if(file_exists($wwwroot.'/uploads/themes/preview/'.$theme->uuid.'.jpg')) {
                $themePreviewUrl = '/uploads/themes/preview/'.$theme->uuid.'.jpg';
            } else if(file_exists($wwwroot.'/uploads/themes/thumbs/'.$theme->uuid.'.png')) {
                $themePreviewUrl = '/uploads/themes/thumbs/'.$theme->uuid.'.png';
            }

            $array = preg_split("/,/", timespan($theme->last_edited, time()));
            $time_span = strtolower($array[0]) . " ago";
            $time_actual = date("Y-m-d, H:i", $theme->last_edited);

            ?>
            <div class="cs-items-list-item cs-flex-column">
                <a href="/themes/view/<?= $theme->uuid ?>">
                    <div class="cs-items-list-image">
                        <div class="cs-items-list-overlay">
                            <div class="cs-items-list-title"><?= $theme->name ?></div>
                        </div>
                        <div class="cs-items-bg-image"
                             style="background-image: url(<?= $themePreviewUrl ?>)"></div>
                    </div>
                </a>
                <div class="cs-items-list-info-bar">
                    <a href="/files/themes/<?= $theme->uuid ?>.zip" class="cs-button cs-button-sm">Download</a>
                    <span>
                        <svg><use xlink:href="/resources/icons/sprite.svg#cs-star"></use></svg>
                        <?= $theme->score ?>
                    </span>
                    <!--span>
                        <svg><use xlink:href="resources/icons/sprite.svg#cs-cloud"></use></svg>
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

    echo $this->pagination->create_links();

}
