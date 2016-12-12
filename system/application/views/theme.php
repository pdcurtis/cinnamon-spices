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
<style>
    .cs-button-certify {
        font-size: 0.75rem;
        border: solid 1px silver;
        padding: 0.25rem;
    }
</style>
<?php if ($this->dx_auth->is_logged_in() && $this->dx_auth->is_admin()) {
    $certifications = $this->db->get("themes_certifications"); ?>
    Certification:
    <a href="<?= "/themes/certify/$id/0" ?>" class='cs-button-certify'>Un-certify</a>
    <?php foreach ($certifications->result() as $certif) { ?>
        <a href="<?= "/themes/certify/$id/$certif->id" ?>" class='cs-button-certify'><?= "Certify $certif->name" ?></a>
    <?php } ?>
    <hr>
<?php } ?>

<?php $this->view('_item_details_head',['type'=>'themes']) ?>

<!--<i><font color="#555555">Certification: <?= $certified ?></font></i><br/>-->
<div>Score: <?= $score ?></font></div>
<div>Last edited: <span title="<?= $time_actual ?>"><?= $time_span ?></span></div>
<br/>

<?= anchor("$screenshot", "<img src='$screenshot' width='400'/>") ?><br/><br/>

<?php $this->view('_rate_item',['type'=>'themes','rate_message'=>'Give this theme the rating it deserves:']) ?>

<div style="border: solid 1px silver; border-radius: 0.5rem;padding: 1rem;margin-bottom: 1rem;background-color: white"><?= $description ?></div>

<?php $this->view('_item_author') ?>

<?php $this->view('_comments',['type'=>'themes']); ?>
