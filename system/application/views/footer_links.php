<div class="cs-footer cs-footer-login-signup">
    <div class="cs-footer-navigation">
        <div class="cs-main-wrap cs-flex">
            <ul class="cs-footer-sub-navigation cs-inline-list">
                <li><a class="<?= preg_match('|^/$|',$_SERVER['REQUEST_URI'])?'active':'' ?>" href="/">Home</a></li>
                <li><a class="<?= preg_match('|^/themes.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>" href="/themes">Themes</a></li>
                <li><a class="<?= preg_match('|^/applets.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>" href="/applets">Applets</a></li>
                <li><a class="<?= preg_match('|^/desklets.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>" href="/desklets">Desklets</a></li>
                <li><a class="<?= preg_match('|^/extensions.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>" href="/extensions">Extensions</a></li>
                <?php if (!$this->dx_auth->is_logged_in()) { ?>
                    <!-- <li><a class="<?= preg_match('|^/auth/login.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>" href="/auth/login">Log In</a></li>
                    <li><a  class="<?= preg_match('|^/auth/register.*?|',$_SERVER['REQUEST_URI'])?'active':'' ?>" href="/auth/register">Sign Up</a></li> -->
                <?php } else { ?>
                    <!-- <li><a href="/auth/logout">Log Out</a></li> -->
                <?php } ?>
            </ul>
            <ul class="cs-footer-sub-navigation cs-inline-list">
                <li><a href="http://developer.linuxmint.com/reference/git/cinnamon-tutorials/extension-system.html">Development</a></li>
                <li><a href="http://github.com/linuxmint">Github</a></li>
            </ul>
        </div>
    </div>
    <div class="cs-footer-copyright cs-main-wrap cs-flex">
        <div class="cs-copyright">
        </div>
        <div class="cs-sponsor">
            Brought to you by <a class="cs-link-alternate" href="https://www.linuxmint.com">LINUX MINT</a>
        </div>
    </div>
</div>