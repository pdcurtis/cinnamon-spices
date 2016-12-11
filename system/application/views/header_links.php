<div class="cs-header-menu">
    <a class="cs-header-menu-link <?= preg_match('|^/$|',$_SERVER['REQUEST_URI'])?'active':'' ?>" href="/">Home</a>
    <a class="cs-header-menu-link <?= preg_match('|^/themes.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>" href="/themes">Themes</a>
    <a class="cs-header-menu-link <?= preg_match('|^/applets.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>" href="/applets">Applets</a>
    <a class="cs-header-menu-link <?= preg_match('|^/desklets.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>" href="/desklets">Desklets</a>
    <a class="cs-header-menu-link <?= preg_match('|^/extensions.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>" href="/extensions">Extensions</a>
    <?php if (!$this->dx_auth->is_logged_in()) { ?>
        <a class="cs-header-menu-link cs-header-menu-login <?= preg_match('|^/auth/login.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>"
           href="/auth/login">Log In</a>
        <a class="cs-header-menu-signup cs-button cs-button-thin-text" href="/auth/register">Sign Up</a>
    <?php } else { ?>
        <a class="cs-header-menu-link cs-header-menu-login <?= preg_match('|^/users/change_details.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>"
           href="/users/change_details">My Profile</a>
        <a class="cs-header-menu-signup cs-button cs-button-thin-text" href="/auth/logout">Log Out</a>
    <?php } ?>
</div>
