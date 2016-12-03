<?php
$password = array(
	'name'	=> 'password',
	'id'		=> 'password',
	'size' 	=> 30
);

?>
<?php echo form_open($this->uri->uri_string(), ['class'=>'cs-login-signup cs-login-signup-form cs-flex-column']); ?>

<?php echo $this->dx_auth->get_auth_error(); ?>

<div class="cs-login-form-row cs-flex-column">
    <label for="cs-login-form-username"><?php echo form_label('Username', $password['id']); ?></label>
    <?php echo form_input($password) ?>
    <?php echo form_error($password['name']); ?>
</div>
<div class="cs-login-form-row cs-flex-column">
    <button type="submit" class="cs-button">Cancel Account</button>
</div>

<?php echo form_close(); ?>
