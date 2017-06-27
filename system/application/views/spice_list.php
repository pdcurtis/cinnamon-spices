<?php
$wwwroot = realpath(BASEPATH.'/../');
?>
<div class="cs-content-filter">
    <ul>
        <li class="<?= $mode == 'popular' ? 'active' : '' ?>">
            <a href="/<?= $type ?>/popular">Popular</a>
        </li>
        <li class="<?= $mode == 'latest' ? 'active' : '' ?>">
            <a href="/<?= $type ?>/latest">Latest</a>
        </li>
        <li class="search">
            <label>Search:</label>
            <input type="text" id="cs-xlet-search-input" data-search-url="/<?= $type ?>/search" data-search-type="<?= $type ?>">
            <div id="cs-xlet-search-results-container" class="cs-xlet-search-results-container" style="display: none">
                <ul id="cs-xlet-search-results-list"></ul>
            </div>
        </li>
    </ul>
</div>


<?php
$this->view('spice_list_items', ['items' => $items, 'wwwroot' => $wwwroot]);
