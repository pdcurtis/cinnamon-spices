<div class="cs-content-filter">
    <ul>
        <li class="<?= $mode == 'popular' ? 'active' : '' ?>">
            <a href="/extensions/popular">Popular</a>
        </li>
        <li class="<?= $mode == 'latest' ? 'active' : '' ?>">
            <a href="/extensions/latest">Latest</a>
        </li>
        <li class="search">
            <label>Search:</label>
            <input type="text" id="cs-xlet-search-input" data-search-url="/extensions/search" data-search-type="extensions">
            <div id="cs-xlet-search-results-container" class="cs-xlet-search-results-container" style="display: none">
                <ul id="cs-xlet-search-results-list"></ul>
            </div>
        </li>
    </ul>
</div>


<?php
$this->view('applet_desklet_extension_list', ['items' => $items,'type'=>'extensions']);
