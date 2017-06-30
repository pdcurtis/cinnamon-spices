<html>
<head>
    <title><?= ucfirst($type) ?> : Cinnamon Spices</title>
    <!-- Stylesheet & Favicon -->
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link rel="stylesheet" href="/style.css?<?= time() ?>">

    <meta property="og:site_name" content="Cinnamon Spices" />
    <meta property="og:title" content="<?= ucfirst($type) ?>" />
    <?php if (preg_match('|^/themes.*?|',$_SERVER['REQUEST_URI'])) { ?>
        <meta property="og:description" content="Change the look and feel of Cinnamon with themes!" />
    <?php } elseif (preg_match('|^/applets.*?|',$_SERVER['REQUEST_URI'])) { ?>
        <meta property="og:description" content="Add applets to your Cinnamon panel!" />
    <?php } elseif (preg_match('|^/desklets.*?|',$_SERVER['REQUEST_URI'])) { ?>
        <meta property="og:description" content="Add desklets on top of your desktop wallpaper!" />
    <?php } elseif (preg_match('|^/extensions.*?|',$_SERVER['REQUEST_URI'])) { ?>
        <meta property="og:description" content="Change the way Cinnamon works with extensions!" />
    <?php } ?>
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://cinnamon-spices.linuxmint.com/<?= $type ?>" />
    <meta property="og:image" content="https://cinnamon-spices.linuxmint.com/resources/og.jpg" />

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
    <h1 class="cs-heading-large"><?= ucfirst($type); ?></h1>
    <?php if (preg_match('|^/themes.*?|',$_SERVER['REQUEST_URI'])) { ?>
        <p>
            Change the look and feel of Cinnamon with themes!
            <br>
            <span class="cs-jumbotron-highlight">To install a theme: Download it and decompress it in ~/.themes.</span>
    <?php } elseif (preg_match('|^/applets.*?|',$_SERVER['REQUEST_URI'])) { ?>
        <p>
            Add applets to your Cinnamon panel!
            <br>
            <span class="cs-jumbotron-highlight">To install an applet: Download it and decompress it in ~/.local/share/cinnamon/applets.</span>
    <?php } elseif (preg_match('|^/desklets.*?|',$_SERVER['REQUEST_URI'])) { ?>
        <p>
            Add desklets on top of your desktop wallpaper!
            <br>
            <span class="cs-jumbotron-highlight">To install a desklet: Download it and decompress it in ~/.local/share/cinnamon/desklets.</span>
    <?php } elseif (preg_match('|^/extensions.*?|',$_SERVER['REQUEST_URI'])) { ?>
        <p>
            Change the way Cinnamon works with extensions!
            <br>
            <span class="cs-jumbotron-highlight">To install an extension: Download it and decompress it in ~/.local/share/cinnamon/extensions.</span>
    <?php } ?>
            <br>
            You can also download and install <?= $type ?> straight from within Cinnamon, using the "<?= ucfirst($type) ?>" configuration tool in the "System Settings".
        </p>
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
