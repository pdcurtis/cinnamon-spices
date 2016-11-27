<!DOCTYPE html>
<html>
<head>
    <title>Cinnamon Spices</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body class="cs-flex-column">

<div class="cs-login-signup-header cs-flex-column">
    <div class="cs-login-signup-header-logo"><img src="/resources/cinnamon-logo.svg"></div>
    <div class="cs-login-signup-header-text">Sign in to CINNAMON</div>
</div>

<div class="cs-login-wrap">
    <?php echo form_open($this->uri->uri_string(),array('class'=>'cs-login-signup cs-login-signup-form cs-flex-column')) ?>
    <?php
    $username = array(
        'name' => 'username',
        'id' => 'username',
        'size' => 30,
        'value' => set_value('username')
    );

    $password = array(
        'name' => 'password',
        'id' => 'password',
        'size' => 30
    );

    $remember = array(
        'name' => 'remember',
        'id' => 'remember',
        'value' => 1,
        'checked' => set_value('remember'),
        'style' => 'margin:0;padding:0'
    );

    $confirmation_code = array(
        'name' => 'captcha',
        'id' => 'captcha',
        'maxlength' => 8
    );

    ?>

    <?php echo $this->dx_auth->get_auth_error(); ?>

    <div class="cs-login-form-row cs-flex-column">
        <label for="cs-login-form-username"><?php echo form_label('Username', $username['id']); ?></label>
        <?php echo form_input($username) ?>
        <?php echo form_error($username['name']); ?>
    </div>
    <div class="cs-login-form-row cs-flex-column">
        <div class="cs-login-form-forgot-password">
            <label for="cs-login-form-password"><?php echo form_label('Password', $password['id']); ?></label>
            <a class="cs-link-alternate" href="/auth/forgot_password">Forgot password?</a>
        </div>
        <?php echo form_password($password) ?>
        <?php echo form_error($password['name']); ?>
    </div>
    <?php if($show_captcha) { ?>
        <div class="cs-login-form-row cs-flex-column">
            <small>Enter the code exactly as it appears. There is no zero.</small>
            <div>
                <?php echo $this->dx_auth->get_captcha_image(); ?>
            </div>
        </div>
        <div class="cs-login-form-row cs-flex-column">
            <label
                for="cs-login-form-username"><?php echo form_label('Confirmation Code', $confirmation_code['id']); ?></label>
            <?php echo form_input($confirmation_code); ?>
            <?php echo form_error($confirmation_code['name']); ?>
        </div>
    <?php } ?>
    <div class="cs-login-form-options">
        <?php echo form_checkbox($remember); ?>
        <?php echo form_label('Remember me', $remember['id']); ?>
    </div>
    <div class="cs-login-form-row cs-flex-column">
        <button class="cs-button" type="submit">Login</button>
    </div>

    <?php echo form_close() ?>
    <div class="cs-login-signup cs-login-signup-call">
        New to CINNAMON?
        <a class="cs-link-alternate" href="/auth/register">Create an account</a>
    </div>
</div>

<?php require __DIR__.'/../footer_links.php' ?>

</body>
</html>
