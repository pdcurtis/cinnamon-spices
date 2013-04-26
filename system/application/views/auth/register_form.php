<div id="main">
        	<div id="post-content" class="clearfix">
				        		<h1 class="page-title">Register</h1>	
							
<?php
$username = array(
	'name'	=> 'username',
	'id'	=> 'username',
	'size'	=> 30,
	'value' =>  set_value('username'),
	'style' => 'width: 95%;'
);

$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
	'value' => set_value('password'),
	'style' => 'width: 95%;'
);

$confirm_password = array(
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
	'size'	=> 30,
	'value' => set_value('confirm_password'),
	'style' => 'width: 95%;'
);

$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'maxlength'	=> 80,
	'size'	=> 30,
	'value'	=> set_value('email'),
	'style' => 'width: 95%;'
);

$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'style' => 'width: 95%;'
);
?>


	<?php echo form_open($this->uri->uri_string())?>	

        <?php echo form_label('Username', $username['id']);?><?php echo form_input($username)?><?php echo form_error($username['name']); ?><br/>
        <?php echo form_label('Password', $password['id']);?><?php echo form_password($password)?><?php echo form_error($password['name']); ?><br/>
	<?php echo form_label('Confirm Password', $confirm_password['id']);?><?php echo form_password($confirm_password);?><?php echo form_error($confirm_password['name']); ?><br/>
	<?php echo form_label('Email Address', $email['id']);?><?php echo form_input($email);?><?php echo form_error($email['name']); ?><br/>

	<?php if ($this->dx_auth->captcha_registration): ?>
		<small>Enter the code exactly as it appears. There is no zero.</small><br/>
		<?php echo $this->dx_auth->get_captcha_image(); ?><br/>
		<?php echo form_label('Confirmation Code', $captcha['id']);?><?php echo form_input($captcha);?><?php echo form_error($captcha['name']); ?><br/>
	<?php endif; ?>	

        <span class="art-button-wrapper">
        	<span class="l"> </span>
        	<span class="r"> </span>
        	<input class="art-button" type="submit" name="register" value="Register"/>
        </span>
        </form>
	
	<br/>
	
 </div>
            <!-- END post-content -->
