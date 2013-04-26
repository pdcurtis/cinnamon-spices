<div id="main">
    <div id="post-content" class="clearfix">
	<h1 class="page-title">Edit your profile</h1>	

<?php
echo form_open_multipart('users/save_details');
?>

<img src="<?=$avatar?>" style="float: left"/>
<table>
<tr><th>Avatar</th><td><input type="file" name="avatar" size="20"> (.jpg, 100x100px, 100KB max) </td></tr>

<tr><th>Signature</th><td><input type=text name="signature" value="<?=$signature?>" /></td></tr>

<tr><th>Biography</th><td><textarea name="biography" rows=10 cols=50><?=$biography?></textarea></td></tr>

<tr><th>Country</th><td><select name="country"><option value="0">None</option>
<?php foreach($countries->result() as $country):
	echo "<option value=\"".$country->id."\" ";
	if ($country_id == $country->id) {
		echo "SELECTED";
	}
	echo ">".$country->name."</option>";
endforeach;?>
</select></td></tr>

<tr><th>Distribution</th><td><select name="distribution"><option value="0">None</option>
<?php foreach($distributions->result() as $distribution):
	echo "<option value=\"".$distribution->id."\" ";
	if ($distribution_id == $distribution->id) {
		echo "SELECTED";
	}
	echo ">".$distribution->name."</option>";
endforeach;?>
</select></td></tr>

<td colspan="2" align="center">
                	<input type="submit" name="submit" value="Save"/>
</td></tr>
</table>
</form> 

<script type="text/javascript">
	CKEDITOR.replace( 'biography' );
</script>

        </div>
            <!-- END post-content -->
