<?php
$array = preg_split("/,/", timespan($last_edited, time()));
$time_span = strtolower($array[0]) . " ago";
$time_actual = date("Y-m-d, H:i", $last_edited);
if ($certification == 0) {
    $certified = "None";
} else {
    $this->db->where("id", $certification);
    $certification_details = $this->db->get("themes_certifications");
    $certified = "Cinnamon " . $certification_details->row()->name;
}
?>

<div class="cs-flex">
    <div class="cs-flex cs-flex-grow cs-flex-center">
        <h1><?=$name?> <?=$version?></h1>
        <div>by <?=anchor("/users/view/$user_id", $username)?></div>
    </div>
    <div class="cs-flex">
        <?php if ($this->dx_auth->is_logged_in() && $this->dx_auth->is_admin()) {
            $certifications = $this->db->get("themes_certifications"); ?>
            <?= anchor("/themes/certify/$id/0", "Un-certify", "class='cs-button cs-button-sm'") ?>&nbsp;
            <?php foreach ($certifications->result() as $certif) { ?>
                <?= anchor("/themes/certify/$id/$certif->id", "Certify $certif->name", "class='cs-button cs-button-sm'") ?>&nbsp;
            <?php } ?>
        <?php } ?>
        <?php if ($this->dx_auth->is_logged_in() && $this->dx_auth->get_user_id() == $user_id) {?>
            <?=anchor("/themes/edit/$id", "Edit", "class='cs-button cs-button-sm'")?>&nbsp;
            <?=anchor("/themes/delete/$id", "Delete", "class='cs-button', onClick=\"return confirm('Are you sure you want to delete this theme?\\nAll comments and information about this theme will be permanently lost.')\"")?>&nbsp;
        <?php } ?>
        <?php if (preg_match('/https?:\/\//', $website) === 1) { ?>
            <?=anchor("$website", "Website", "class='cs-button cs-button-sm'")?>&nbsp;
        <?php } ?>
        <?=anchor("$file", "Download", "class='cs-button cs-button-sm'")?><br/><br/>
    </div>
</div>

<hr>

<!--<i><font color="#555555">Certification: <?= $certified ?></font></i><br/>-->
<div>Score: <?= $score ?></font></div>
<div>Last edited: <span title="<?= $time_actual ?>"><?= $time_span ?></span></div>
<br/>

<?= anchor("$screenshot", "<img src='$screenshot' width='400'/>") ?><br/><br/>

<?php $this->view('_rate_item',['type'=>'themes','rate_message'=>'Give this theme the rating it deserves:']) ?>

<p><?= $description ?></p>

<div id="post-author" class="clearfix">
    <div id="author-avatar">
        <?php
        $avatar = '/img/default_avatar.jpg';
        if (file_exists(FCPATH . 'uploads/avatars/' . $user_id . ".jpg")) {
            $avatar = '/uploads/avatars/' . $user_id . ".jpg";
        }
        ?>
        <img alt='' src='<?= $avatar ?>' class='avatar avatar-50 photo' height='50' width='50'/>
    </div><!-- END author-avatar -->
    <div id="author-description">
        <h4>About The Author</h4>
        <?= anchor("/users/view/$user_id", $username) ?><br/>
        <?= $signature ?><br/>
        <?= $biography ?><br/>
    </div><!-- END author-description -->
</div><!-- END post-author -->

<?php $this->view('_comments',['type'=>'themes']); ?>
