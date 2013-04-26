<div id="main">
        	<div id="post-content" class="clearfix">
				        		<h1 class="page-title">Forgotten password</h1>
	    
<?php

$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'maxlength'	=> 80,
	'size'	=> 30,
	'value' => set_value('login'),
	'style' => 'width: 95%;'
);

?>


	<?php echo form_open($this->uri->uri_string())?>

	<?php echo $this->dx_auth->get_auth_error(); ?>	

        <?php echo form_label('Enter your Username or Email Address', $login['id']);?><?php echo form_input($login); ?><?php echo form_error($login['name']); ?><br/>
        <span class="art-button-wrapper">
        	<span class="l"> </span>
        	<span class="r"> </span>
        	<input class="art-button" type="submit" name="reset" value="Reset Now"/>
        </span>
        </form>
<br/>

 </div>
            <!-- END post-content -->
