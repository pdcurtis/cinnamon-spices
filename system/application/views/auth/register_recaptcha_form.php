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
    'size' => 30,
    'value' => set_value('password')
);

$confirm_password = array(
    'name' => 'confirm_password',
    'id' => 'confirm_password',
    'size' => 30,
    'value' => set_value('confirm_password')
);

$email = array(
    'name' => 'email',
    'id' => 'email',
    'maxlength' => 80,
    'size' => 30,
    'value' => set_value('email')
);
?>

<?php echo form_open($this->uri->uri_string(), array('class' => 'cs-login-signup cs-login-signup-form cs-flex-column')) ?>
    <div class="cs-login-form-row cs-flex-column">
        <?php echo form_label('Username', $username['id']); ?>
        <?php echo form_input($username) ?>
        <?php echo form_error($username['name']); ?>
    </div>
    <div class="cs-login-form-row cs-flex-column">
        <?php echo form_label('Password', $password['id']); ?>
        <?php echo form_password($password) ?>
        <?php echo form_error($password['name']); ?>
    </div>
    <div class="cs-login-form-row cs-flex-column">
        <?php echo form_label('Confirm Password', $confirm_password['id']); ?>
        <?php echo form_password($confirm_password); ?>
        <?php echo form_error($confirm_password['name']); ?>
    </div>
    <div class="cs-login-form-row cs-flex-column">
        <?php echo form_label('Email Address', $email['id']); ?>
        <?php echo form_input($email); ?>
        <?php echo form_error($email['name']); ?>
    </div>
<?php if (true): //($this->dx_auth->captcha_registration): ?>
    <div class="cs-login-form-row cs-flex-column">
        <small>Enter the code exactly as it appears. There is no zero.</small>
        <?php
        // Show recaptcha imgage
        echo $this->dx_auth->get_recaptcha_image();
        // Show reload captcha link
        echo $this->dx_auth->get_recaptcha_reload_link();
        // Show switch to image captcha or audio link
        echo $this->dx_auth->get_recaptcha_switch_image_audio_link();
        ?>
    </div>
    <div class="cs-login-form-row cs-flex-column">
        <?php echo $this->dx_auth->get_recaptcha_label(); ?></div>
    <div class="cs-login-form-row cs-flex-column">
        <?php echo $this->dx_auth->get_recaptcha_input(); ?>
        <?php echo form_error('recaptcha_response_field'); ?>
    </div>
    <div class="cs-login-form-row cs-flex-column">
        <?php
        // Get recaptcha javascript and non javasript html
        echo $this->dx_auth->get_recaptcha_html();
        ?>
    </div>
<?php endif; ?>
    <div class="cs-login-form-row cs-flex-column">
        <button class="cs-button" type="submit">Register</button>
    </div>
<?php echo form_close() ?>