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
$this->view('applet_desklet_extension_list', ['items' => $items,'type'=>'desklets']);