<div class="cs-footer cs-footer-login-signup">
    <div class="cs-footer-navigation">
        <div class="cs-main-wrap cs-flex">
            <ul class="cs-footer-sub-navigation cs-inline-list">
                <li><a href="/">Home</a></li>
                <li><a href="/themes">Themes</a></li>
                <li><a href="/applets">Applets</a></li>
                <li><a href="/desklets">Desklets</a></li>
                <li><a href="/extensions">Extensions</a></li>
                <?php if (!$this->dx_auth->is_logged_in()) { ?>
                    <li><a href="/auth/login">Log In</a></li>
                    <li><a xclass="active" href="/auth/register">Sign Up</a></li>
                <?php } else { ?>
                    <li><a href="/auth/logout">Log Out</a></li>
                <?php } ?>
            </ul>
            <ul class="cs-footer-sub-navigation cs-inline-list">
                <li><a href="#">Documentation</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Terms of Use</a></li>
            </ul>
        </div>
    </div>
    <div class="cs-footer-copyright cs-main-wrap cs-flex">
        <div class="cs-copyright">
            Cinnamon is ©copyrighted 2011 and trademarked through the Linux Mark Institute. All rights reserved.
        </div>
        <div class="cs-sponsor">
            Brought to you by
            <a href="//www.linuxmint.com">LINUX MINT</a>
        </div>
    </div>
</div>