<div class="cs-breadcrumbs">
    <ul class="cs-inline-list">
        <li><a href="/index.html">Home</a></li>
        <li>View Profile</li>
    </ul>
</div>

<h1 class="page-title"><?= $user_name ?></h1>

<div class="cs-profile-view cs-flex-row">
    <div class="cs-sidebar">
        <figure class="cs-profile-avatar" style="background-image: url('<?= $avatar ?>')"></figure>
        <ul class="cs-block-list">
            <li>
                <h4>Last login:</h4>
                <?= $last_login ?>
            </li>
            <?php if ($distribution != 0) { ?>
            <li>
                <h4>Distribution:</h4>
                <img height=16 src="/img/distributions/<?= $distribution ?>.ico"/>
                <!--Linux Mint 18.1-->
            </li>
            <?php } ?>
            <?php if ($country_name != "None") { ?>
            <li>
                <h4>Country:</h4><img src="/img/flags/<?= $country_code ?>.gif">
                <?= $country_name ?>
            </li>
            <?php } ?>
        </ul>
    </div>
    <?php if ($signature != "" || $biography != "") { ?>
    <div class="cs-main-content">
        <?php if ($signature != "") { ?>
        <div style="border: solid 0.0625rem #c0c0c0; border-radius: .25rem; padding: 1rem; background: #fff;">
            <h4>Signature:</h4>
            <i><?= $signature ?></i>
        </div>
        <?php } ?>
        <?php if ($biography != "") { ?>
        <div style="border: solid 0.0625rem #c0c0c0; border-radius: .25rem; padding: 1rem; margin-top: 1rem; background: #fff;">
            <h4>Biography:</h4>
            <?= $biography ?>
        </div>
        <?php } ?>
    </div>
    <?php } ?>
</div>
