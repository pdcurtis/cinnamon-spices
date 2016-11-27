<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<html>
<head>
    <title>Spices : Cinnamon</title>
    <!-- Stylesheet & Favicon -->
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link rel="stylesheet" href="/style.css">
</head>
<body>

<div class="cs-landing-jumbotron">
    <div class="cs-header">
        <div class="cs-header-logo">
            <img src="/resources/cinnamon.svg" alt="">
            <div>spices</div>
        </div>
        <div class="cs-header-menu">
            <a class="cs-header-menu-link" href="/">Home</a>
            <a class="cs-header-menu-link <?= preg_match('|^/themes.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>" href="/themes">Themes</a>
            <a class="cs-header-menu-link <?= preg_match('|^/applets.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>" href="/applets">Applets</a>
            <a class="cs-header-menu-link <?= preg_match('|^/desklets.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>" href="/desklets">Desklets</a>
            <a class="cs-header-menu-link <?= preg_match('|^/extensions.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>" href="/extensions">Extensions</a>
            <?php if (!$this->dx_auth->is_logged_in()) { ?>
                <a class="cs-header-menu-login" href="/auth/login">Log In</a>
                <a class="cs-header-menu-signup cs-button cs-button-thin-text" href="/auth/register">Sign Up</a>
            <?php } else { ?>
                <a class="cs-header-menu-signup cs-button cs-button-thin-text" href="/auth/logout">Log Out</a>
            <?php } ?>
        </div>
    </div>
    <div class="cs-jumbotron-content">
        <div>
            <h1>Applets</h1>
            <p>
                Change the look and feel of Cinnamon with themes!
                <br>
                Developers are free to create their own themes and share them with other users here.
            </p>
            <a href="#" class="cs-button cs-button-thin-text">Learn How Today</a>
        </div>
    </div>
</div>

<div class="cs-main-wrap">
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
