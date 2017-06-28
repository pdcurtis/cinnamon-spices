<!DOCTYPE html>
<html>
<head>
    <title>Cinnamon Spices</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link rel="stylesheet" href="/style.css?<?= time() ?>">

    <meta property="og:site_name" content="Cinnamon Spices" />
    <meta property="og:title" content="Cinnamon Spices" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://cinnamon-spices.linuxmint.com" />
    <meta property="og:description" content="Modify your Cinnamon desktop environment and extend its features with Cinnamon Spices.
    Cinnamon supports the following types of spices: Themes, applets, desklets and extensions." />
    <meta property="og:image" content="https://cinnamon-spices.linuxmint.com/resources/og.jpg" />

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
            Modify your Cinnamon desktop environment and extend its features with Cinnamon Spices.
            Cinnamon supports the following types of spices: Themes, applets, desklets and extensions.
        </p>
        <!-- <a href="#" class="cs-button cs-button-thin-text cs-button-large">Get Started Today</a> -->
    </div>
</div>
<div class="cs-addons">
    <h2 class="cs-addons-header cs-header-thin"> Amazing addons for your Cinnamon desktop!</h2>
    <h3 class="cs-addons-sub-header cs-header-thin"> The Cinnamon spices repository hosts hundreds of addons you can install and use today.</h3>
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
                Themes change the look and feel of your Cinnamon desktop.
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
                Applets are little programs you can add to your Cinnamon panel.
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
                Desklets are little programs which you can place on your desktop, on top of your desktop background.
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
                Extensions are addons which modify the way Cinnamon works.
            </p>
        </div>
    </div>
</div>



<div class="cs-footer">
    <div class="cs-footer-fact">
        <div class="cs-main-wrap cs-flex">
            <h4>Spice things up!</h4>
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
                    <h4 class="cs-heading-large"><?= $spices_count ?></h4>
                    <span>Spices currently available</span>
                </div>
                <ul class="cs-footer-download-item cs-footer-sub-navigation cs-inline-list">
                    <li><a href="http://developer.linuxmint.com/reference/git/cinnamon-tutorials/extension-system.html">Development</a></li>
                    <li><a href="http://github.com/linuxmint">Github</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="cs-footer-copyright cs-main-wrap cs-flex">
        <div class="cs-copyright">
        </div>
        <div class="cs-sponsor">
            Brought to you by
            <a class="cs-link-alternate" href="//www.linuxmint.com">LINUX MINT</a>
        </div>
    </div>
</div>

</body>
</html>
