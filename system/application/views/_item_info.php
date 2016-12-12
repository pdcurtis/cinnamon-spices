<?php
$array = preg_split("/,/", timespan($last_edited, time()));
$time_span = strtolower($array[0]) . " ago";
$time_actual = date("Y-m-d, H:i", $last_edited);
if(isset($certification)) {
    if ($certification == 0) {
        $certified = "None";
    } else {
        $this->db->where("id", $certification);
        $certification_details = $this->db->get("themes_certifications");
        $certified = "Cinnamon " . $certification_details->row()->name;
    }
}
?>
<style>
    .cs-item-details-screenshot {
        width: auto;
        max-width: 100%;
    }

    .cs-item-details-description {
        border: solid 1px silver;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1rem;
        background-color: white
    }
</style>

<!--<i><font color="#555555">Certification: <?= $certified ?></font></i><br/>-->
<?php if(isset($uuid) && !empty($uuid)) echo "<div>UUID: $uuid</div>" ?>
<div>Score: <?= $score ?></div>
<div>Last edited: <span title="<?= $time_actual ?>"><?= $time_span ?></span></div>
<br>
<?= anchor("$screenshot", "<img src='$screenshot' class='cs-item-details-screenshot'/>") ?><br/><br/>

<?php $this->view('_rate_item', ['type' => 'themes', 'rate_message' => 'Give this theme the rating it deserves:']) ?>

<?php if(trim($description)!='') { ?>
<div class="cs-item-details-description"><?= $description ?></div>
<?php } ?>

