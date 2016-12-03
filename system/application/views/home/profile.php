<div class="cs-breadcrumbs">
    <ul>
        <li><a href="/">Home</a></li>
        <li>/</li>
        <li>View Profile</li>
    </ul>
</div>

<h1><?= $user_name ?></h1>
<img src="<?= $avatar ?>"><br/>
<?php if ($distribution != 0) { ?>
    Distribution: <img height=16 src="/img/distributions/<?= $distribution ?>.ico"/><br/>
<?php } ?>
<?php if ($country_name != "None") { ?>
    Country: <img src="/img/flags/<?= $country_code ?>.gif"/><br/>
<?php } ?>
Last login: <?= $last_login ?><br/>
Signature: <i><font size="1"><?= $signature ?></font></i><br/>
<?php if ($biography != "") { ?>
    Biography:</br>
    <p>
        <?= $biography ?>
    </p>
<?php } ?>


</div>
<!-- END post-content -->
