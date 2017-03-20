<html>
<head>
    <title>Spices : Cinnamon</title>
    <!-- Stylesheet & Favicon -->
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link rel="stylesheet" href="/style.css?<?= time() ?>">
</head>
<body>

<div class="cs-jumbotron cs-flex-column">
    <div class="cs-header cs-flex-row">
        <a href="/" class="cs-link-alternate cs-header-logo">
            <img src="/resources/cinnamon.svg" alt="">
            <div>spices</div>
        </a>
        <?php require('header_links.php') ?>
    </div>
    <div class="cs-jumbotron-content cs-flex-column">
    <?php if (preg_match('|^/themes.*?|',$_SERVER['REQUEST_URI'])) { ?>
        <h1 class="cs-heading-large">Themes</h1>
        <p>
            Change the look and feel of Cinnamon with themes!
            <br>
            <span class="cs-jumbotron-highlight">To install a theme: Download it and decompress it in ~/.themes.</span>
            <br>
            You can also download and install themes straight from within Cinnamon, using the "Themes" configuration tool in the "System Settings".
        </p>
    <?php } elseif (preg_match('|^/applets.*?|',$_SERVER['REQUEST_URI'])) { ?>
        <h1 class="cs-heading-large">Applets</h1>
        <p>
            Add applets to your Cinnamon panel!
            <br>
            <span class="cs-jumbotron-highlight">To install an applet: Download it and decompress it in ~/.local/share/cinnamon/applets.</span>
            <br>
            You can also download and install applets straight from within Cinnamon, using the "Applets" configuration tool in the "System Settings".
        </p>
    <?php } elseif (preg_match('|^/desklets.*?|',$_SERVER['REQUEST_URI'])) { ?>
        <h1 class="cs-heading-large">Desklets</h1>
        <p>
            Add desklets on top of your desktop wallpaper!
            <br>
            <span class="cs-jumbotron-highlight">To install a desklet: Download it and decompress it in ~/.local/share/cinnamon/desklets.</span>
            <br>
            You can also download and install desklets straight from within Cinnamon, using the "Desklets" configuration tool in the "System Settings".
        </p>
    <?php } elseif (preg_match('|^/extensions.*?|',$_SERVER['REQUEST_URI'])) { ?>
        <h1 class="cs-heading-large">Extensions</h1>
        <p>
            Change the way Cinnamon works with extensions!
            <br>
            <span class="cs-jumbotron-highlight">To install an extension: Download it and decompress it in ~/.local/share/cinnamon/extensions.</span>
            <br>
            You can also download and install extensions straight from within Cinnamon, using the "Extensions" configuration tool in the "System Settings".
        </p>
    <?php } ?>
    </div>
</div>

<div class="cs-main-wrap cs-flex">
    <div class="cs-sidebar">
        <div class="title">Addons</div>
        <ul class="cs-sidebar-links">
            <li class="<?= preg_match('|^/themes.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>"><a href="/themes">Themes</a></li>
            <li class="<?= preg_match('|^/applets.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>"><a href="/applets">Applets</a></li>
            <li class="<?= preg_match('|^/desklets.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>"><a href="/desklets">Desklets</a></li>
            <li class="<?= preg_match('|^/extensions.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>"><a href="/extensions">Extensions</a></li>
        </ul>
    </div>
    <div class="cs-main-content">
