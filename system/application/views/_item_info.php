<?php
$array = preg_split("/,/", timespan($last_edited, time()));
$time_span = strtolower($array[0]) . " ago";
$time_actual = date("Y-m-d, H:i", $last_edited);
?>

<div class="cs-details-body">
    <?php if(isset($uuid) && !empty($uuid)) echo "<div>UUID: $uuid</div>" ?>
    <div>Score: <?= $score ?></div>
    <div>Last edited: <span title="<?= $time_actual ?>"><?= $time_span ?></span></div>
    <div>Last commit: <?= anchor("https://github.com/linuxmint/cinnamon-spices-$type/commits/master/$uuid", $last_commit) ?></div>
    <br>
    <?= anchor("/git/$type/$uuid/screenshot.png", "<img src='/git/$type/$uuid/screenshot.png' class='cs-item-details-screenshot'/>") ?>

    <?php $this->view('_rate_item', ['type' => '$type', 'rate_message' => 'Give this spice the rating it deserves:']) ?>

    <?php if(trim($description)!='') { ?>
    <div class="cs-item-details-description"><?= $description ?></div>
    <?php } ?>

    <?php
    $server_path = realpath(BASEPATH.'/../');
    if (file_exists("$server_path/git/$type/$uuid/README.md")) {
        include("$server_path/parsedown/Parsedown.php");
        $markdown = file_get_contents("$server_path/git/$type/$uuid/README.md");
        $Parsedown = new Parsedown();
    ?>
        <div class="cs-item-details-description">
        <?php echo $Parsedown->text($markdown); ?>
        </div>
    <?php } ?>
</div>
