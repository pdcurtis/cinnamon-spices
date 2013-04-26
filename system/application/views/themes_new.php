<div id="main">
    <div id="post-content" class="clearfix">
	<h1 class="page-title">Upload a new theme</h1>	

<b><font color="red"><?php echo validation_errors(); ?></font></b>

<b><font color="red"><?=$error?></font></b>

<?php echo form_open_multipart('themes/create_new_save');?>
    <table>
	<tr><th>Theme</th><td><input type="file" name="file" size="30"> (.zip, 10MB max) </td></tr>
	<tr><th>Name</th><td><input type=text size=50 name="name" value="<?php echo set_value('name'); ?>" /></td></tr>
	<tr><th>Version</th><td><input type=text size=50 name="version" value="<?php echo set_value('version'); ?>" /></td></tr>
	<tr><th>Website</th><td><input type=text size=50 name="website" value="<?php echo set_value('website'); ?>" /></td></tr>
	<tr><th>Description</th><td><textarea name="description" rows=10 cols=50><?php echo set_value('description'); ?></textarea></td></tr>	
	<tr><th>Screenshot</th><td><input type="file" name="screenshot" size="30"> (.png, 1MB max) </td></tr>	
	<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Upload"/></td></tr>
    </table>
</form> 

<script type="text/javascript">CKEDITOR.replace( 'description' );</script>

</div>
<!-- END post-content -->
