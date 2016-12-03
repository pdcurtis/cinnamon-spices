<?php
$old_password = array(
    'name' => 'old_password',
    'id' => 'old_password',
    'size' => 30,
    'value' => set_value('old_password')
);

$new_password = array(
    'name' => 'new_password',
    'id' => 'new_password',
    'size' => 30
);

$confirm_new_password = array(
    'name' => 'confirm_new_password',
    'id' => 'confirm_new_password',
    'size' => 30
);

?>
<?php echo form_open($this->uri->uri_string(), ['class'=>'cs-login-signup cs-login-signup-form cs-flex-column']); ?>

<?php echo $this->dx_auth->get_auth_error(); ?>

<div class="cs-login-form-row cs-flex-column">
    <label for="cs-login-form-username"><?php echo form_label('Old Password', $old_password['id']); ?></label>
    <?php echo form_input($old_password) ?>
    <?php echo form_error($old_password['name']); ?>
</div>
<div class="cs-login-form-row cs-flex-column">
    <label for="cs-login-form-username"><?php echo form_label('Username', $new_password['id']); ?></label>
    <?php echo form_input($new_password) ?>
    <?php echo form_error($new_password['name']); ?>
</div>
<div class="cs-login-form-row cs-flex-column">
    <label for="cs-login-form-username"><?php echo form_label('Username', $confirm_new_password['id']); ?></label>
    <?php echo form_input($confirm_new_password) ?>
    <?php echo form_error($confirm_new_password['name']); ?>
</div>
<div class="cs-login-form-row cs-flex-column">
    <button type="submit" class="cs-button">Change Password</button>
</div>

<?php echo form_close() ?>
