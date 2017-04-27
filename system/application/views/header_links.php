<div class="cs-header-menu">
    <a class="cs-header-menu-link <?= preg_match('|^/$|',$_SERVER['REQUEST_URI'])?'active':'' ?>" href="/">Home</a>
    <a class="cs-header-menu-link <?= preg_match('|^/themes.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>" href="/themes">Themes</a>
    <a class="cs-header-menu-link <?= preg_match('|^/applets.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>" href="/applets">Applets</a>
    <a class="cs-header-menu-link <?= preg_match('|^/desklets.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>" href="/desklets">Desklets</a>
    <a class="cs-header-menu-link <?= preg_match('|^/extensions.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>" href="/extensions">Extensions</a>
    <?php if (!$this->session->userdata('oauth')) { ?>
        <a class="cs-header-menu-login cs-button cs-button-thin-text <?= preg_match('|^/auth/login.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>" href="/auth/login">Log In</a>
    <?php } else { ?>
        <a class="cs-header-menu-avatar" href="<?php echo $this->session->userdata('link') ?>" target="_blank"><img align="top" src="<?php echo $this->session->userdata('avatar') ?>"></a>
        <a class="cs-header-menu-logout cs-button cs-button-outline cs-button-thin-text" href="/auth/logout">Log Out</a>
    <?php } ?>
</div>
