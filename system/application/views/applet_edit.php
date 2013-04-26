
<div id="main">
        	<div id="post-content" class="clearfix">
				        		<h1 class="page-title">Edit applet</h1>	

<?php if ($this->dx_auth->is_logged_in() && $this->dx_auth->get_user_id() == $user) {?>

    <b><font color="red"><?=$error?></font></b><br/><br/>
    
    <?php echo form_open_multipart("applets/edit_save/$id");?>
        <table>	
        <tr><th>Applet</th><td><input type="file" name="file" size="30"> (.zip, 10MB max) </td></tr>
        <tr><th>Name</th><td><input type=text size=50 name="name" value="<?=$name?>" /></td></tr>
        <tr><th>UUID</th><td><input type=text size=50 name="uuid" value="<?=$uuid?>" /></td></tr>
        <tr><th>Version</th><td><input type=text size=50 name="version" value="<?=$version?>" /></td></tr>
        <tr><th>Website</th><td><input type=text size=50 name="website" value="<?=$website?>" /></td></tr>
        <tr><th>Description</th><td><textarea name="description" rows=20 cols=50><?=$description?></textarea></td></tr>	
        <tr><th>Screenshot</th><td><input type="file" name="screenshot" size="30"> (.png, 1MB max) </td></tr>		
        <tr><th>Icon</th><td><input type="file" name="icon" size="30"> (.png, 48x48, 100KB max) </td></tr>		
        <tr><td colspan="2" align="center"><input type="submit" name="submit" value="Save"/></td></tr>
        </table>
    </form> 
    <br/><br/>
    <p>Note: Leave the screenshot/applet/icon fields empty unless you want to overwrite the files with new ones.</p>

    <script type="text/javascript">CKEDITOR.replace( 'description' );</script>                

<?php } ?>

</div>
<!-- END post-content -->
