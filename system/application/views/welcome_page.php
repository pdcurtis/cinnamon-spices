<!DOCTYPE html>
<html>
<head>
    <title>Cinnamon Spices</title>

    <link rel="stylesheet" href="/style.css">
</head>
<body>

<div class="cs-landing-jumbotron cs-flex-column">
    <div class="cs-header">
        <div class="cs-header-logo">
            <img src="/resources/cinnamon.svg" alt="">
            <div>spices</div>
        </div>
        <?php require('header_links.php') ?>
    </div>
    <div class="cs-jumbotron-content cs-flex-column">
        <div>
            <h1>The official<br/>addons repository</h1>
            <p>
                Modify Cinnamon with themes, applets and extensions. Themes
                change the look and aspects of Cinnamon. Applets are icons or
                texts that appear on the panel. Developers are free to create
                their own. A tutorial for creating simple applets is available.
            </p>
            <a href="#" class="cs-button cs-button-thin-text">Learn How Today</a>
        </div>
    </div>
</div>

<div class="cs-addons">
    <h2 class="cs-addons-header cs-header-thin"> Amazing addons you can download and install freely!</h2>
    <h3 class="cs-addons-sub-header cs-header-thin"> The Cinnamon spices repository hosts over a 1000 open source addons
        you can install and use today.</h3>
    <div class="cs-main-wrap cs-flex-row">
        <div class="cs-addons-item cs-flex-column cs-flex-center">
            <a href="/themes">
                <div class="cs-addons-item-icon cs-flex cs-flex-middle">
                    <svg style="max-width: 40%;" class="octicon octicon-paintcan" viewBox="0 0 12 16" version="1.1"
                         aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M6 0C2.69 0 0 2.69 0 6v1c0 .55.45 1 1 1v5c0 1.1 2.24 2 5 2s5-.9 5-2V8c.55 0 1-.45 1-1V6c0-3.31-2.69-6-6-6zm3 10v.5c0 .28-.22.5-.5.5s-.5-.22-.5-.5V10c0-.28-.22-.5-.5-.5s-.5.22-.5.5v2.5c0 .28-.22.5-.5.5s-.5-.22-.5-.5v-2c0-.28-.22-.5-.5-.5s-.5.22-.5.5v.5c0 .55-.45 1-1 1s-1-.45-1-1v-1c-.55 0-1-.45-1-1V7.2c.91.49 2.36.8 4 .8 1.64 0 3.09-.31 4-.8V9c0 .55-.45 1-1 1zM6 7c-1.68 0-3.12-.41-3.71-1C2.88 5.41 4.32 5 6 5c1.68 0 3.12.41 3.71 1-.59.59-2.03 1-3.71 1zm0-3c-2.76 0-5 .89-5 2 0-2.76 2.24-5 5-5s5 2.24 5 5c0-1.1-2.24-2-5-2z"></path>
                    </svg>
                </div>
            </a>
            <h3 class="cs-addons-item-header cs-category-header">
                <a class="cs-link-alternate" href="/themes">Themes</a>
            </h3>
            <p class="cs-addons-item-content">
                Suspendisse id diam nec turpis semper facilisis vitae id nibh. Donec varius rutrum libero, sed congue
                orci.
            </p>
        </div>
        <div class="cs-addons-item cs-flex-column cs-flex-center">
            <a href="/applets">
                <div class="cs-addons-item-icon cs-flex cs-flex-middle">
                    <svg style="max-width: 40%;" class="octicon octicon-browser" viewBox="0 0 14 16" version="1.1"
                         aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M5 3h1v1H5V3zM3 3h1v1H3V3zM1 3h1v1H1V3zm12 10H1V5h12v8zm0-9H7V3h6v1zm1-1c0-.55-.45-1-1-1H1c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1V3z"></path>
                    </svg>
                </div>
            </a>
            <h3 class="cs-addons-item-header cs-category-header">
                <a class="cs-link-alternate" href="/applets">Applets</a>
            </h3>
            <p class="cs-addons-item-content">
                Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut ac
                gravida ante.
            </p>
        </div>
        <div class="cs-addons-item cs-flex-column cs-flex-center">
            <a href="/desklets">
                <div class="cs-addons-item-icon cs-flex cs-flex-middle">
                    <svg style="max-width: 40%;" class="octicon octicon-device-desktop" viewBox="0 0 16 16"
                         version="1.1" aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M15 2H1c-.55 0-1 .45-1 1v9c0 .55.45 1 1 1h5.34c-.25.61-.86 1.39-2.34 2h8c-1.48-.61-2.09-1.39-2.34-2H15c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1zm0 9H1V3h14v8z"></path>
                    </svg>
                </div>
            </a>
            <h3 class="cs-addons-item-header cs-category-header">
                <a class="cs-link-alternate" href="/desklets">Desklets</a>
            </h3>
            <p class="cs-addons-item-content">
                Donec eget enim eu leo ultricies mattis vitae et nisl. Vivamus fermentum turpis nec dui sollicitudin, id
                posuere enim posuere.
            </p>
        </div>
        <div class="cs-addons-item cs-flex-column cs-flex-center">
            <a href="/extensions">
                <div class="cs-addons-item-icon cs-flex cs-flex-middle">
                    <svg style="max-width: 40%" class="octicon octicon-package" viewBox="0 0 16 16" version="1.1"
                         aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M1 4.27v7.47c0 .45.3.84.75.97l6.5 1.73c.16.05.34.05.5 0l6.5-1.73c.45-.13.75-.52.75-.97V4.27c0-.45-.3-.84-.75-.97l-6.5-1.74a1.4 1.4 0 0 0-.5 0L1.75 3.3c-.45.13-.75.52-.75.97zm7 9.09l-6-1.59V5l6 1.61v6.75zM2 4l2.5-.67L11 5.06l-2.5.67L2 4zm13 7.77l-6 1.59V6.61l2-.55V8.5l2-.53V5.53L15 5v6.77zm-2-7.24L6.5 2.8l2-.53L15 4l-2 .53z"></path>
                    </svg>
                </div>
            </a>
            <h3 class="cs-addons-item-header cs-category-header">
                <a class="cs-link-alternate" href="/extensions">Extensions</a>
            </h3>
            <p class="cs-addons-item-content">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sit amet accumsan nibh, ac feugiat
                nisl. Morbi luctus finibus facilisis.
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
                    <img src="resources/demo/accuweather-desklet.png">
                </a>
            </figure>
            <div class="cs-media-content">
                <h3 class="cs-spotlight-item-header cs-category-header">
                    <a class="cs-link-alternate" href="#">Accuweather</a>
                </h3>
                <p class="cs-spotlight-item-description">
                    It does weather and shit...
                </p>
                <p class="cs-spotlight-item-publish">
                    <span>4.0.5</span> published 4 months ago by <a class="cs-link-alternate" href="#">Sirikon</a>
                </p>
            </div>
        </div>
        <div class="cs-spotlight-item cs-media">
            <figure class="cs-media-image cs-flex cs-flex-middle">
                <a href="#">
                    <img src="resources/demo/weather-desklet.png">
                </a>
            </figure>
            <div class="cs-media-content">
                <h3 class="cs-spotlight-item-header cs-category-header">
                    <a class="cs-link-alternate" href="#">Weather</a>
                </h3>
                <p class="cs-spotlight-item-description">
                    This does some other weather stuff..
                </p>
                <p class="cs-spotlight-item-publish">
                    <span>0.8.2</span> published 4 days ago by <a class="cs-link-alternate" href="#">Mr.Electronick</a>
                </p>
            </div>
        </div>
        <div class="cs-spotlight-item cs-media">
            <figure class="cs-media-image cs-flex cs-flex-middle">
                <a href="#">
                    <img src="resources/demo/drives-manager-desklet.png">
                </a>
            </figure>
            <div class="cs-media-content">
                <h3 class="cs-spotlight-item-header cs-category-header">
                    <a class="cs-link-alternate" href="#">Drives Manager</a>
                </h3>
                <p class="cs-spotlight-item-description">
                    This one isnt weather related!!!!
                </p>
                <p class="cs-spotlight-item-publish">
                    <span>1.13.2</span> published 1 week ago by <a class="cs-link-alternate" href="#">Nyrrad</a>
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
                    <img src="/resources/globe-filler.png" alt="Downloads">
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
            <a href="//www.linuxmint.com">LINUX MINT</a>
        </div>
    </div>
</div>

</body>
</html>
