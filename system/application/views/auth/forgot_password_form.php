<!DOCTYPE html>
<html class="cs-login-signup">
<head>
	<title>Cinnamon Spices</title>

	<link rel="stylesheet" href="/style.css">
</head>
<body>
<?php

$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'maxlength'	=> 80,
	'size'	=> 30,
	'value' => set_value('login'),
);

?>
<div class="cs-login-wrap">
	<div class="cs-login-signup-header">
		<div class="cs-login-signup-header-logo"><img src="/resources/cinnamon-logo.svg"></div>
		<div class="cs-login-signup-header-text">Password to CINNAMON</div>
	</div>
	<?php echo form_open($this->uri->uri_string())?>
		<div class="cs-login-form-row">
			<?php echo form_label('Enter your Username or Email Address', $login['id']);?>
			<?php echo form_input($login); ?>
			<?php echo form_error($login['name']); ?>
		</div>
		<div class="cs-login-form-row">
			<button class="cs-button" type="submit">Reset Now</button>
		</div>
	<?php echo form_close() ?>
</div>

</body>
</html>