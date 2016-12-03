<?php

$login = array(
    'name' => 'login',
    'id' => 'login',
    'maxlength' => 80,
    'size' => 30,
    'value' => set_value('login'),
);

?>
<?php echo form_open($this->uri->uri_string(), array('class' => 'cs-login-signup cs-login-signup-form cs-flex-column')) ?>
<div class="cs-login-form-row cs-flex-column">
    <?php echo form_label('Enter your Username or Email Address', $login['id']); ?>
    <?php echo form_input($login); ?>
    <?php echo form_error($login['name']); ?>
</div>
<div class="cs-login-form-row cs-login-form-row-tall cs-flex-column">
    <button class="cs-button" type="submit">Reset Now</button>
</div>
<?php echo form_close() ?>
