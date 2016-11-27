<!DOCTYPE html>
<html>
<head>
    <title>Cinnamon Spices</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body class="cs-flex-column">

<div class="cs-login-signup-header cs-flex-column">
    <div class="cs-login-signup-header-logo"><img src="/resources/cinnamon-logo.svg"></div>
    <div class="cs-login-signup-header-text">Sign in to <a href="/">CINNAMON</a></div>
</div>

<div class="cs-login-wrap">

    <div class="cs-login-signup cs-login-signup-form cs-flex-column">
        <?php echo $auth_message ?><br/>
    </div>

    <div class="cs-login-signup cs-login-signup-call">
        Already have an account?
        <a class="cs-link-alternate" href="login.html">Sign in</a>
    </div>
</div>

<?php require __DIR__.'/../footer_links.php' ?>

</body>
</html>
