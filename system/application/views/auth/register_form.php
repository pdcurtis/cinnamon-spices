<!DOCTYPE html>
<html class="cs-login-signup">
<head>
    <title>Cinnamon Spices</title>

    <link rel="stylesheet" href="/style.css">
</head>
<body>
<?php
$username = array(
    'name' => 'username',
    'id' => 'username',
    'size' => 30,
    'value' => set_value('username'),
);

$password = array(
    'name' => 'password',
    'id' => 'password',
    'size' => 30,
    'value' => set_value('password'),
);

$confirm_password = array(
    'name' => 'confirm_password',
    'id' => 'confirm_password',
    'size' => 30,
    'value' => set_value('confirm_password'),
);

$email = array(
    'name' => 'email',
    'id' => 'email',
    'maxlength' => 80,
    'size' => 30,
    'value' => set_value('email'),
);

$captcha = array(
    'name' => 'captcha',
    'id' => 'captcha',
);
?>

<div class="cs-login-wrap">
    <div class="cs-login-signup-header">
        <div class="cs-login-signup-header-logo"><a href="/"><img src="/resources/cinnamon-logo.svg"></a></div>
        <div class="cs-login-signup-header-text">Sign up to CINNAMON</div>
    </div>

    <?php echo form_open($this->uri->uri_string()) ?>

    <div class="cs-login-form-row">
        <?php echo form_label('Username', $username['id']); ?>
        <?php echo form_input($username) ?>
        <?php echo form_error($username['name']); ?>
    </div>
    <div class="cs-login-form-row">
        <?php echo form_label('Password', $password['id']); ?>

        <?php echo form_password($password) ?>

        <?php echo form_error($password['name']); ?>
    </div>
    <div class="cs-login-form-row">
        <?php echo form_label('Confirm Password', $confirm_password['id']); ?>

        <?php echo form_password($confirm_password); ?>

        <?php echo form_error($confirm_password['name']); ?>
    </div>
    <div class="cs-login-form-row">
        <?php echo form_label('Email Address', $email['id']); ?>

        <?php echo form_input($email); ?>

        <?php echo form_error($email['name']); ?>
    </div>
    <div class="cs-login-form-row">

        <?php if(true): // ($this->dx_auth->captcha_registration): ?>
            <small>Enter the code exactly as it appears. There is no zero.</small><br/>
            <?php echo $this->dx_auth->get_captcha_image(); ?><br/>
            <?php echo form_label('Confirmation Code', $captcha['id']); ?><?php echo form_input($captcha); ?><?php echo form_error($captcha['name']); ?>
            <br/>
        <?php endif; ?>
    </div>

    <div class="cs-login-form-row">
        <button class="cs-button" type="submit">Register</button>
    </div>
    <?php echo form_close() ?>

    <div class="cs-login-signup-new-to-cinnamon">
        Already have an account?
        <a href="/auth/login">Sign in</a>
    </div>
</div>


</body>
</html>
