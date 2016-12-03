<div class="cs-breadcrumbs">
    <ul>
        <li><a href="/">Home</a></li>
        <li>/</li>
        <li>Edit My Profile</li>
    </ul>
</div>

<h1>Edit your profile</h1>

<?= form_open_multipart('users/save_details',['class'=>'cs-flex']); ?>
<div>
    <img src="<?=$avatar?>" style="margin-right: 32px"/>
</div>
<div class="cs-flex-grow">
    <div class="cs-form-row cs-flex-column">
        <label>Avatar</label>
        <input type="file" name="avatar" size="20">
        <em>(.jpg, 100x100px, 100KB max)</em>
    </div>
    <div class="cs-form-row cs-flex-column">
        <label>Signature</label>
        <input type="text" name="signature" value="<?=$signature?>">
    </div>
    <div class="cs-form-row cs-flex-column">
        <label>Biography</label>
        <textarea name="biography" rows="5" cols="50"><?=$biography?></textarea>
    </div>
    <div class="cs-form-row cs-flex-column">
        <label>Country</label>
        <select name="country">
            <option value="0">None</option>
            <?php foreach($countries->result() as $country):
                echo "<option value=\"".$country->id."\" ";
                if ($country_id == $country->id) {
                    echo "SELECTED";
                }
                echo ">".$country->name."</option>";
            endforeach;?>
        </select>
    </div>
    <div class="cs-form-row cs-flex-column">
        <label>Distribution</label>
        <select name="distribution">
            <option value="0">None</option>
            <?php foreach($distributions->result() as $distribution):
                echo "<option value=\"".$distribution->id."\" ";
                if ($distribution_id == $distribution->id) {
                    echo "SELECTED";
                }
                echo ">".$distribution->name."</option>";
            endforeach;?>
        </select>
    </div>
    <div class="cs-form-row cs-flex-column">
        <button class="cs-button">Submit</button>
    </div>

</div>

<script type="text/javascript">
	CKEDITOR.replace( 'biography' );
</script>
