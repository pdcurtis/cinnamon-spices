        </div>
    </div>
    <?php require('footer_links.php') ?>
</body>
</html>


<?php /*
<div id="wpadminbar" class="nojq nojs" role="navigation">
    <div class="quicklinks">	
	<ul id="wp-admin-bar-root-default" class="ab-top-menu">		

	<?php if ($this->dx_auth->is_logged_in()) { ?>	    
	    <li id="wp-admin-bar-new-content" class="menupop">
		<a class="ab-item" tabindex="10" aria-haspopup="true" href="#" title="Add New"><span class="ab-icon"></span><span class="ab-label">New</span></a>
		<div class="ab-sub-wrapper">
		    <ul id="wp-admin-bar-new-content-default" class="ab-submenu">
			<li id="wp-admin-bar-new-post" class=""><?=anchor("themes/create_new", "Theme", "class='ab-item' tabindex='10'")?></li>
			<li id="wp-admin-bar-new-media" class=""><?=anchor("applets/create_new", "Applet", "class='ab-item' tabindex='10'")?></li>
            <li id="wp-admin-bar-new-media" class=""><?=anchor("desklets/create_new", "Desklet", "class='ab-item' tabindex='10'")?></li>
			<li id="wp-admin-bar-new-link" class=""><?=anchor("extensions/create_new", "Extension", "class='ab-item' tabindex='10'")?></li>		    
		    </ul>
		</div>
	    </li>
	<?php } ?>
	</ul>
        
        <ul id="wp-admin-bar-top-secondary" class="ab-top-secondary ab-top-menu">

        <?php if (!$this->dx_auth->is_logged_in()) { 
            $avatar = '/img/default_avatar.jpg';
        ?>
            <li id="wp-admin-bar-my-account" class="menupop with-avatar">
                <?=anchor("auth/login", "Sign in <img alt='' src='$avatar?>' class='avatar avatar-16 photo' height='16' width='16' />", "class='ab-item' tabindex='10' aria-haspopup='true' title='Login'")?>
                <div class="ab-sub-wrapper">
                        <ul class=" ab-submenu">                        
                            <li class=""><?=anchor("auth/login", "Login", "class='ab-item' tabindex='10'")?></li>
                            <li class=""><?=anchor("auth/register", "Register", "class='ab-item' tabindex='10'")?></li>                            
                        </ul>
                    </div>
                </li>     
            
        <?php }	else {
            $user_id = $this->dx_auth->get_user_id();
            $username = $this->dx_auth->get_username();
            $avatar = '/img/default_avatar.jpg';
            if (file_exists(FCPATH.'uploads/avatars/'.$user_id.".jpg")) {
                    $avatar = '/uploads/avatars/'.$user_id.".jpg";
            }					
        ?>        
                <li id="wp-admin-bar-my-account" class="menupop with-avatar">
                    <?=anchor("users/view/$user_id", "Howdy, $username <img alt='' src='$avatar?>' class='avatar avatar-16 photo' height='16' width='16' />", "class='ab-item' tabindex='10' aria-haspopup='true' title='My Account'")?>
                    <div class="ab-sub-wrapper">
                        <ul class=" ab-submenu">                        
                            <li class=""><?=anchor("users/change_details", "Edit my profile", "class='ab-item' tabindex='10'")?></li>
                            <li class=""><?=anchor("auth/change_password", "Change password", "class='ab-item' tabindex='10'")?></li>
                            <li class=""><?=anchor("auth/logout", "Logout", "class='ab-item' tabindex='10'")?></li>
                        </ul>
                    </div>
                </li>        
            			        
           
        <?php } ?>
        </ul>
         </div>
		</div>

		</body>
</html>

 */
?>