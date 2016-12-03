<html>
<head>
    <title>Spices : Cinnamon</title>
    <!-- Stylesheet & Favicon -->
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link rel="stylesheet" href="/style.css?<?= time() ?>">
</head>
<body>

<div class="cs-landing-jumbotron">
    <div class="cs-header">
        <div class="cs-header-logo">
            <img src="/resources/cinnamon.svg" alt="">
            <div>spices</div>
        </div>
        <?php require('header_links.php') ?>
    </div>
</div>

<div class="cs-main-wrap cs-flex">
    <div class="cs-main-left-sidebar">
        <div class="title">Addons</div>
        <ul>
            <li class="<?= preg_match('|^/themes.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>"><a href="/themes">Themes</a></li>
            <li class="<?= preg_match('|^/applets.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>"><a href="/applets">Applets</a></li>
            <li class="<?= preg_match('|^/desklets.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>"><a href="/desklets">Desklets</a></li>
            <li class="<?= preg_match('|^/extensions.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>"><a href="/extensions">Extensions</a></li>
        </ul>
    </div>
    <div class="cs-main-content">
