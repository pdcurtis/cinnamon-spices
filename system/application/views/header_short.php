<?php
    $server_path = realpath(BASEPATH.'/../');
    $stripped_name = preg_replace('(\s+)', '-' , $name);

    $og_description = strip_tags(substr($description, 0, 200));
    $og_url = ($type == 'themes') ? $stripped_name : $id;


    if (file_exists("$server_path/git/$type/$uuid/icon.png")) {
        $og_icon = "git/$type/$uuid/icon.png";
    }
 ?>

<html>
<head>
    <title><?= ucfirst($type) ?> : <?= $stripped_name ?> : Cinnamon Spices</title>
    <!-- Stylesheet & Favicon -->
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link rel="stylesheet" href="/style.css?<?= time() ?>">

    <meta property="og:site_name" content="Cinnamon Spices" />
    <meta property="og:title" content="<?= ucfirst($type) ?> : <?= $name ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://cinnamon-spices.linuxmint.com/<?= $type ?>/view/<?= $og_url ?>" />
    <meta property="og:description" content="<?= $og_description ?>" />
    <?php if (isset($og_icon)) { ?>
        <meta property="og:image" content="https://cinnamon-spices.linuxmint.com/<?= $og_icon ?>" />
    <?php } else { ?>
        <meta property="og:image" content="https://cinnamon-spices.linuxmint.com/resources/og.jpg" />
    <?php } ?>


</head>
<body class="cs-flex-column">

<div class="cs-jumbotron cs-jumbotron-small">
    <div class="cs-header cs-flex-row">
        <a href="/" class="cs-link-alternate cs-header-logo cs-header-logo-inline cs-flex-row cs-flex-center">
            <img src="/resources/cinnamon.svg" alt="">
            <div>spices</div>
        </a>
        <?php require('header_links.php') ?>
    </div>
</div>

<div class="cs-main-wrap cs-flex-column cs-flex-grow">
    <div class="cs-main-content">
