<div class="cs-content-filter">
    <ul>
        <li class="<?= $mode == 'popular' ? 'active' : '' ?>">
            <a href="/applets/popular">Popular</a>
        </li>
        <li class="<?= $mode == 'latest' ? 'active' : '' ?>">
            <a href="/applets/latest">Latest</a>
        </li>
        <li class="search">
            <label>Search Applet:</label>
            <input type="text" id="cs-xlet-search-input" data-search-url="/applets/search" data-search-type="applets">
            <div id="cs-xlet-search-results-container" class="search-results" style="display: none">
                <ul id="cs-xlet-search-results-list">
<!--                    <li>-->
<!--                        <a href="/">-->
<!--                            <img src="/git/applets/a4techTool@mous/icon.png"/>-->
<!--                            A4Tech battery checker-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <img src="/git/applets/AutostartPrograms@spacy01/icon.png"/>-->
<!--                        <a href="/">Autostart programs</a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <img src="/git/applets/brightness-and-gamma-applet@cardsurf/icon.png"/>-->
<!--                        <a href="/">Brightness and gamma applet</a>-->
<!--                    </li>-->
                </ul>
            </div>
        </li>
    </ul>
</div>

<?php
$this->view('applet_desklet_extension_list', ['items' => $items,'type'=>'applets']);
