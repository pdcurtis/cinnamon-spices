<style>
    .cs-details-head {
    }
    .cs-details-head > div > img {
        height: 3rem;
        margin-right: .5rem;
        width: 3rem;
    }
    .cs-details-head h1 {
        font-size: 1.9rem;
        margin-right: .5rem;
    }
    .cs-details-head-button {
        line-height: 1.75rem;
        height: 1.75rem;
        font-size: 0.75rem;
        font-weight: normal;
        padding: 0 1rem;
        text-transform: none;
    }
    .cs-details-head-button-w {
        line-height: 1.75rem;
        height: 1.75rem;
        font-size: 0.75rem;
        font-weight: normal;
        padding: 0 1rem;
        background-color: transparent;
        color: black;
        border:solid 1px silver;
        text-transform: none;
    }
</style>
<div class="cs-flex cs-details-head">
    <div class="cs-flex cs-flex-grow cs-flex-center">
        <?php if(isset($icon)) { ?>
        <img src='$icon'/>
        <?php } ?>
        <h1><?=$name?> <?=$version?></h1>
        <div>by <?=anchor("/users/view/$user_id", $username)?></div>
    </div>
    <div class="cs-flex cs-flex-center">
        <?php if ($this->dx_auth->is_logged_in() && $this->dx_auth->get_user_id() == $user_id) {?>
            <?=anchor("/$type/edit/$id", "Edit", "class='cs-button cs-details-head-button'")?>&nbsp;
            <?=anchor("/$type/delete/$id", "Delete", "class='cs-button cs-details-head-button', onClick=\"return confirm('Are you sure you want to delete this applet?\\nAll comments and information about this applet will be permanently lost.')\"")?>&nbsp;
        <?php } ?>
        <?php if (preg_match('/https?:\/\//', $website) === 1) { ?>
            <?=anchor("$website", "Website", "class='cs-button cs-details-head-button-w'")?>&nbsp;
        <?php } ?>
        <?=anchor("$file", "Download", "class='cs-button cs-details-head-button'")?>
    </div>
</div>

<hr>