<!DOCTYPE html>
<html>
<head>
    <title>Cinnamon Spices</title>

    <link rel="stylesheet" href="/style.css">
</head>
<body>

<div class="cs-jumbotron cs-flex-column">
    <div class="cs-header cs-flex-row">
        <div class="cs-header-logo">
            <img src="/resources/cinnamon.svg" alt="">
            <div>spices</div>
        </div>
        <?php require('header_links.php') ?>
    </div>
    <div class="cs-jumbotron-content cs-jumbotron-index cs-flex-column">
        <h1 class="cs-heading-large">The official<br />addons repository</h1>
        <p>
            Modify Cinnamon with themes, applets and extensions. Themes
            change the look and aspects of Cinnamon. Applets are icons or
            texts that appear on the panel. Developers are free to create
            their own. A tutorial for creating simple applets is available.
        </p>
        <a href="#" class="cs-button cs-button-thin-text cs-button-large">Get Started Today</a>
    </div>
</div>
<div class="cs-addons">
    <h2 class="cs-addons-header cs-header-thin"> Amazing addons you can download and install freely!</h2>
    <h3 class="cs-addons-sub-header cs-header-thin"> The Cinnamon spices repository hosts over a 1000 open source addons you can install and use today.</h3>
    <div class="cs-main-wrap cs-flex-row">
        <div class="cs-addons-item cs-flex-column cs-flex-center">
            <a href="/themes">
                <div class="cs-addons-item-icon cs-flex cs-flex-middle">
                    <svg>
                        <use xlink:href="/resources/icons/sprite.svg#cs-paintcan"></use>
                    </svg>
                </div>
            </a>
            <h3 class="cs-addons-item-header cs-category-header">
                <a href="/themes">Themes</a>
            </h3>
            <p class="cs-addons-item-content">
                Suspendisse id diam nec turpis semper facilisis vitae id nibh. Donec varius rutrum libero, sed congue orci.
            </p>
        </div>
        <div class="cs-addons-item cs-flex-column cs-flex-center">
            <a href="/applets">
                <div class="cs-addons-item-icon cs-flex cs-flex-middle">
                    <svg>
                        <use xlink:href="/resources/icons/sprite.svg#cs-browser"></use>
                    </svg>
                </div>
            </a>
            <h3 class="cs-addons-item-header cs-category-header">
                <a href="/applets">Applets</a>
            </h3>
            <p class="cs-addons-item-content">
                Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut ac gravida ante.
            </p>
        </div>
        <div class="cs-addons-item cs-flex-column cs-flex-center">
            <a href="/desklets">
                <div class="cs-addons-item-icon cs-flex cs-flex-middle">
                    <svg>
                        <use xlink:href="/resources/icons/sprite.svg#cs-monitor"></use>
                    </svg>
                </div>
            </a>
            <h3 class="cs-addons-item-header cs-category-header">
                <a href="/desklets">Desklets</a>
            </h3>
            <p class="cs-addons-item-content">
                Donec eget enim eu leo ultricies mattis vitae et nisl. Vivamus fermentum turpis nec dui sollicitudin, id posuere enim posuere.
            </p>
        </div>
        <div class="cs-addons-item cs-flex-column cs-flex-center">
            <a href="/extensions">
                <div class="cs-addons-item-icon cs-flex cs-flex-middle">
                    <svg>
                        <use xlink:href="/resources/icons/sprite.svg#cs-box"></use>
                    </svg>
                </div>
            </a>
            <h3 class="cs-addons-item-header cs-category-header">
                <a href="/extensions">Extensions</a>
            </h3>
            <p class="cs-addons-item-content">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sit amet accumsan nibh, ac feugiat nisl. Morbi luctus finibus facilisis.
            </p>
        </div>
    </div>
</div>

<div class="cs-spotlight">
    <h2 class="cs-spotlight-header cs-header-thin"> Popular addon spotlight </h2>
    <div class="cs-main-wrap cs-flex-row">
        <div class="cs-spotlight-item cs-media">
            <figure class="cs-media-image cs-flex cs-flex-middle">
                <a href="#">
                    <img src="/resources/demo/accuweather-desklet.png" alt=" SOMETHING HERE ">
                </a>
            </figure>
            <div class="cs-media-content">
                <h3 class="cs-spotlight-item-header cs-category-header">
                    <a href="#">Accuweather</a>
                </h3>
                <p class="cs-spotlight-item-description">
                    It does weather and shit...
                </p>
                <p class="cs-spotlight-item-publish">
                    <span>4.0.5</span> published 4 months ago by <a href="#">Sirikon</a>
                </p>
            </div>
        </div>
        <div class="cs-spotlight-item cs-media">
            <figure class="cs-media-image cs-flex cs-flex-middle">
                <a href="#">
                    <img src="/resources/demo/weather-desklet.png" alt=" SOMETHING HERE ">
                </a>
            </figure>
            <div class="cs-media-content">
                <h3 class="cs-spotlight-item-header cs-category-header">
                    <a href="#">Weather</a>
                </h3>
                <p class="cs-spotlight-item-description">
                    This does some other weather stuff..
                </p>
                <p class="cs-spotlight-item-publish">
                    <span>0.8.2</span> published 4 days ago by <a  href="#">Mr.Electronick</a>
                </p>
            </div>
        </div>
        <div class="cs-spotlight-item cs-media">
            <figure class="cs-media-image cs-flex cs-flex-middle">
                <a href="#">
                    <img src="/resources/demo/drives-manager-desklet.png" alt=" SOMETHING HERE ">
                </a>
            </figure>
            <div class="cs-media-content">
                <h3 class="cs-spotlight-item-header cs-category-header">
                    <a  href="#">Drives Manager</a>
                </h3>
                <p class="cs-spotlight-item-description">
                    This one isnt weather related!!!!
                </p>
                <p class="cs-spotlight-item-publish">
                    <span>1.13.2</span> published 1 week ago by <a  href="#">Nyrrad</a>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="cs-footer">
    <div class="cs-footer-fact">
        <div class="cs-main-wrap cs-flex">
            <h4>This is a cinnamon spices fun fact. It has some stuff</h4>
        </div>
    </div>
    <div class="cs-footer-downloads">
        <div class="cs-main-wrap cs-flex">
            <div class="cs-footer-download-card">
                <div class="cs-footer-download-item">
                    <svg>
                        <use xlink:href="resources/icons/sprite.svg#cs-globe"></use>
                    </svg>
                </div>
                <div class="cs-footer-download-item">
                    <h4 class="cs-heading-large">7501223</h4>
                    <span>Global Addon Downloads</span>
                </div>
                <ul class="cs-footer-download-item cs-footer-sub-navigation cs-inline-list">
                    <li><a href="#">Documentation</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Terms of Use</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="cs-footer-copyright cs-main-wrap cs-flex">
        <div class="cs-copyright">
            Cinnamon is ©copyrighted 2011 and trademarked through the Linux Mark Institute. All rights reserved.
        </div>
        <div class="cs-sponsor">
            Brought to you by
            <a class="cs-link-alternate" href="//www.linuxmint.com">LINUX MINT</a>
        </div>
    </div>
</div>

</body>
</html>
