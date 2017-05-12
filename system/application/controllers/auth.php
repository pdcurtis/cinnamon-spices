<?php

/**
 * Class Auth
 *
 * @property CI_Session $session
 * @property CI_Config $config
 * @property CI_Loader $load
 */
class Auth extends Controller
{
	// Used for registering and changing password form validation
	var $min_username = 4;
	var $max_username = 20;
	var $min_password = 4;
	var $max_password = 20;

	function __construct()
	{
		parent::Controller();

		$this->load->library('session');

		$this->config->load('oauth');
//
//		$this->load->library('Form_validation');
//		$this->load->library('DX_Auth');
//
		$this->load->helper('url');
//		$this->load->helper('form');
	}
	
	function index()
	{
		//$this->login();
	}


    public function facebook()
    {
        if($this->session->userdata('oauth')) {
            redirect('/auth/success');
        }

        /** @var array $ocnf */
        $ocnf = $this->config->item('oauth');
		$clientid = $ocnf['facebook']['client_id'];
        $client_secret = $ocnf['facebook']['client_secret'];

		$q = str_replace('/auth/facebook/?','',$_SERVER['REQUEST_URI']);
		parse_str($q,$_GET);

    	$me = $this->config->site_url('/auth/facebook').'/';

    	if(!isset($_GET['code'])) {
            redirect('https://www.facebook.com/v2.8/dialog/oauth?client_id='.$clientid.'&redirect_uri='.urldecode($me));
		}

		$code = $_GET['code'];

		$tokenResponse = file_get_contents('https://graph.facebook.com/v2.8/oauth/access_token?'.http_build_query([
				'client_id'=>$clientid,
				'redirect_uri'=>$me,
				'client_secret'=>$client_secret,
				'code'=>$code
			]));

		$tokenResponse = json_decode($tokenResponse);

		if(is_object($tokenResponse) && isset($tokenResponse->access_token)) {

            $url = 'https://graph.facebook.com/me?'.http_build_query(array(
                    'access_token' => $tokenResponse->access_token,
                ));

            $user = json_decode(file_get_contents($url));

            $this->session->set_userdata([
                'oauth'=>true,
                'type'=>'facebook',
                'avatar'=>'https://graph.facebook.com/'.$user->id.'/picture?type=large',
                'name'=>$user->name,
                'link'=>$user->link
            ]);

            redirect('/auth/success');
        }
    }

    public function google()
    {
        if($this->session->userdata('oauth')) {
            redirect('/auth/success');
        }
        /** @var array $ocnf */
        $ocnf = $this->config->item('oauth');
		$clientid = $ocnf['google']['client_id'];
        $client_secret = $ocnf['google']['client_secret'];

		$q = str_replace('/auth/google/?','',$_SERVER['REQUEST_URI']);
		parse_str($q,$_GET);

    	$me = $this->config->site_url('/auth/google').'/';

    	if(!isset($_GET['code'])) {
            redirect('https://accounts.google.com/o/oauth2/auth?'.
                'client_id='.$clientid.
                '&redirect_uri='.urldecode($me).
                '&state='.$this->session->userdata('session_id').
                '&response_type=code'.
                '&scope=openid'
            );
		}

		$code = $_GET['code'];

        $opts = array(
            'http' => array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query([
                    'client_id'=>$clientid,
                    'redirect_uri'=>$me,
                    'client_secret'=>$client_secret,
                    'code'=>$code,
                    'grant_type'=>'authorization_code'
                ]),
            )
        );

        $_default_opts = stream_context_get_params(stream_context_get_default());
        $context = stream_context_create(array_merge_recursive($_default_opts['options'], $opts));
        $tokenResponse = file_get_contents('https://www.googleapis.com/oauth2/v4/token', false, $context);

		$tokenResponse = json_decode($tokenResponse);

        if(is_object($tokenResponse) && isset($tokenResponse->access_token)) {

            $url = 'https://www.googleapis.com/oauth2/v1/userinfo?alt=json&'.http_build_query(array(
                    'access_token' => $tokenResponse->access_token,
                ));

            $user = json_decode(file_get_contents($url));

            $this->session->set_userdata([
                'oauth'=>true,
                'type'=>'google',
                'avatar'=>$user->picture,
                'name'=>$user->name,
                'link'=>$user->link
            ]);

            redirect('/auth/success');

        }
    }

    public function github()
    {
        if($this->session->userdata('oauth')) {
            redirect('/auth/success');
        }
        /** @var array $ocnf */
        $ocnf = $this->config->item('oauth');
        $clientid = $ocnf['github']['client_id'];
        $client_secret = $ocnf['github']['client_secret'];

        $q = str_replace('/auth/github/?','',$_SERVER['REQUEST_URI']);
        parse_str($q,$_GET);

        $me = $this->config->site_url('/auth/github').'/';

        if(!isset($_GET['code'])) {
            redirect('https://github.com/login/oauth/authorize?scope=&client_id='.$clientid.'&redirect_uri='.urldecode($me));
        }

        $code = $_GET['code'];

        $opts = array(
            'http' => array(
                'method'  => 'POST',
                'header'  => [
                    'Content-type: application/x-www-form-urlencoded',
                    'Accept: application/json'
                ],
                'content' => http_build_query([
                    'client_id'=>$clientid,
                    'redirect_uri'=>$me,
                    'client_secret'=>$client_secret,
                    'code'=>$code,
                ]),
            )
        );

        $_default_opts = stream_context_get_params(stream_context_get_default());
        $context = stream_context_create(array_merge_recursive($_default_opts['options'], $opts));
        $tokenResponse = file_get_contents('https://github.com/login/oauth/access_token', false, $context);

        $tokenResponse = json_decode($tokenResponse);

        if(is_object($tokenResponse) && isset($tokenResponse->access_token)) {

            $opts = array(
                'http' => array(
                    'method'  => 'GET',
                    'header'  => [
                        'User-Agent: Cinnamon-Spices-Website-Login',
                        'Accept: application/json'
                    ]
                )
            );

            $_default_opts = stream_context_get_params(stream_context_get_default());
            $context = stream_context_create(array_merge_recursive($_default_opts['options'], $opts));
            $userResponse = file_get_contents('https://api.github.com/user?access_token='.$tokenResponse->access_token, false, $context);

            $user = json_decode($userResponse);

            $this->session->set_userdata([
                'oauth'=>true,
                'type'=>'github',
                'avatar'=>$user->avatar_url,
                'name'=>$user->name,
                'link'=>$user->html_url
            ]);

            redirect('/auth/success');
        }
    }

    public function success()
    {
        echo "
<script>
if(window.name==='CinnamonSpicesOAuthLoginWindow'){
    window.opener.location.reload();
    window.close();
}
</script>";
    }

    /* Callback function */
	
//	function username_check($username)
//	{
//		$result = $this->dx_auth->is_username_available($username);
//		if ( ! $result)
//		{
//			$this->form_validation->set_message('username_check', 'Username already exist. Please choose another username.');
//		}
//
//		return $result;
//	}
//
//	function email_check($email)
//	{
//		$result = $this->dx_auth->is_email_available($email);
//		if ( ! $result)
//		{
//			$this->form_validation->set_message('email_check', 'Email is already used by another user. Please choose another email address.');
//		}
//
//		return $result;
//	}
//
//	function captcha_check($code)
//	{
//		$result = TRUE;
//
//		if ($this->dx_auth->is_captcha_expired())
//		{
//			// Will replace this error msg with $lang
//			$this->form_validation->set_message('captcha_check', 'Your confirmation code has expired. Please try again.');
//			$result = FALSE;
//		}
//		elseif ( ! $this->dx_auth->is_captcha_match($code))
//		{
//			$this->form_validation->set_message('captcha_check', 'Your confirmation code does not match the one in the image. Try again.');
//			$result = FALSE;
//		}
//
//		return $result;
//	}
//
//	function recaptcha_check()
//	{
//		$result = $this->dx_auth->is_recaptcha_match();
//		if ( ! $result)
//		{
//			$this->form_validation->set_message('recaptcha_check', 'Your confirmation code does not match the one in the image. Try again.');
//		}
//
//		return $result;
//	}
	
	/* End of Callback function */

	function login() {
	    if(!$this->session->userdata('oauth')) {
            // Load login page view
            $this->load->view("header_login", ['title' => 'Sign in to CINNAMON']);
            $this->load->view('oauth/login');
            $this->load->view("footer_login");
        } else {
	        redirect('/');
        }
    }
	
//	function login()
//	{
//		if ( ! $this->dx_auth->is_logged_in())
//		{
//			$val = $this->form_validation;
//
//			// Set form validation rules
//			$val->set_rules('username', 'Username', 'trim|required|xss_clean');
//			$val->set_rules('password', 'Password', 'trim|required|xss_clean');
//			$val->set_rules('remember', 'Remember me', 'integer');
//
//			// Set captcha rules if login attempts exceed max attempts in config
//			if ($this->dx_auth->is_max_login_attempts_exceeded())
//			{
//				$val->set_rules('captcha', 'Confirmation Code', 'trim|required|xss_clean|callback_captcha_check');
//			}
//
//			if ($val->run() AND $this->dx_auth->login($val->set_value('username'), $val->set_value('password'), $val->set_value('remember')))
//			{
//				// Redirect to homepage
//				redirect('', 'location');
//			}
//			else
//			{
//				// Check if the user is failed logged in because user is banned user or not
//				if ($this->dx_auth->is_banned())
//				{
//					// Redirect to banned uri
//					$this->dx_auth->deny_access('banned');
//				}
//				else
//				{
//					// Default is we don't show captcha until max login attempts eceeded
//					$data['show_captcha'] = FALSE;
//
//					// Show captcha if login attempts exceed max attempts in config
//					if ($this->dx_auth->is_max_login_attempts_exceeded())
//					{
//						// Create catpcha
//						$this->dx_auth->captcha();
//
//						// Set view data to show captcha on view file
//						$data['show_captcha'] = TRUE;
//					}
//
//					// Load login page view
//					$this->load->view("header_login", ['title'=>'Sign in to CINNAMON']);
//					$this->load->view($this->dx_auth->login_view, $data);
//					$this->load->view("footer_login");
//				}
//			}
//		}
//		else
//		{
//			#$data['auth_message'] = 'You are already logged in.';
//			#$this->load->view($this->dx_auth->logged_in_view, $data);
//			redirect("/themes", "location");
//		}
//	}
//
	function logout()
	{
	    $this->session->set_userdata('oauth',0);
	    $this->session->unset_userdata();

//		$this->dx_auth->logout();

		#$data['auth_message'] = 'You have been logged out.';
		#$this->load->view($this->dx_auth->logout_view, $data);
		redirect("/", "location");
	}
//
//	function register()
//	{
//		if ( ! $this->dx_auth->is_logged_in() AND $this->dx_auth->allow_registration)
//		{
//			$val = $this->form_validation;
//
//			// Set form validation rules
//			$val->set_rules('username', 'Username', 'trim|required|xss_clean|min_length['.$this->min_username.']|max_length['.$this->max_username.']|callback_username_check|alpha_dash');
//			$val->set_rules('password', 'Password', 'trim|required|xss_clean|min_length['.$this->min_password.']|max_length['.$this->max_password.']|matches[confirm_password]');
//			$val->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean');
//			$val->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback_email_check');
//
//			if ($this->dx_auth->captcha_registration)
//			{
//				$val->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback_captcha_check');
//			}
//
//			// Run form validation and register user if it's pass the validation
//			if ($val->run() AND $this->dx_auth->register($val->set_value('username'), $val->set_value('password'), $val->set_value('email')))
//			{
//				// Set success message accordingly
//				if ($this->dx_auth->email_activation)
//				{
//					$data['auth_message'] = 'You have successfully registered. Check your email address to activate your account.';
//				}
//				else
//				{
//					$data['auth_message'] = 'You have successfully registered. '.anchor(site_url($this->dx_auth->login_uri), 'Login');
//				}
//
//				// Load registration success page
//				$this->load->view("header_login", ['title'=>'Sign up to CINNAMON']);
//				$this->load->view($this->dx_auth->register_success_view, $data);
//				$this->load->view("footer_login");
//			}
//			else
//			{
//				// Is registration using captcha
//				if ($this->dx_auth->captcha_registration)
//				{
//					$this->dx_auth->captcha();
//				}
//
//				// Load registration page
//				$this->load->view("header_login", ['title'=>'Sign up to CINNAMON']);
//				$this->load->view($this->dx_auth->register_view);
//				$this->load->view("footer_login");
//			}
//		}
//		elseif ( ! $this->dx_auth->allow_registration)
//		{
//			$data['auth_message'] = 'Registration has been disabled.';
//			$this->load->view("header_login", ['title'=>'Sign up to CINNAMON']);
//			$this->load->view($this->dx_auth->register_disabled_view, $data);
//			$this->load->view("footer_login");
//		}
//		else
//		{
//			$data['auth_message'] = 'You have to logout first, before registering.';
//			$this->load->view("header_login", ['title'=>'Sign up to CINNAMON']);
//			$this->load->view($this->dx_auth->logged_in_view, $data);
//			$this->load->view("footer_login");
//		}
//	}
//
//	function register_recaptcha()
//	{
//		if ( ! $this->dx_auth->is_logged_in() AND $this->dx_auth->allow_registration)
//		{
//			$val = $this->form_validation;
//
//			// Set form validation rules
//			$val->set_rules('username', 'Username', 'trim|required|xss_clean|min_length['.$this->min_username.']|max_length['.$this->max_username.']|callback_username_check|alpha_dash');
//			$val->set_rules('password', 'Password', 'trim|required|xss_clean|min_length['.$this->min_password.']|max_length['.$this->max_password.']|matches[confirm_password]');
//			$val->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean');
//			$val->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback_email_check');
//
//			// Is registration using captcha
//			if ($this->dx_auth->captcha_registration)
//			{
//				// Set recaptcha rules.
//				// IMPORTANT: Do not change 'recaptcha_response_field' because it's used by reCAPTCHA API,
//				// This is because the limitation of reCAPTCHA, not DX Auth library
//				$val->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback_recaptcha_check');
//			}
//
//			// Run form validation and register user if it's pass the validation
//			if ($val->run() AND $this->dx_auth->register($val->set_value('username'), $val->set_value('password'), $val->set_value('email')))
//			{
//				// Set success message accordingly
//				if ($this->dx_auth->email_activation)
//				{
//					$data['auth_message'] = 'You have successfully registered. Check your email address to activate your account.';
//				}
//				else
//				{
//					$data['auth_message'] = 'You have successfully registered. '.anchor(site_url($this->dx_auth->login_uri), 'Login');
//				}
//
//				// Load registration success page
//				$this->load->view("header");
//				$this->load->view($this->dx_auth->register_success_view, $data);
//				$this->load->view("footer");
//			}
//			else
//			{
//				// Load registration page
//				$this->load->view("header");
//				$this->load->view('auth/register_recaptcha_form');
//				$this->load->view("footer");
//			}
//		}
//		elseif ( ! $this->dx_auth->allow_registration)
//		{
//			$data['auth_message'] = 'Registration has been disabled.';
//			$this->load->view("header");
//			$this->load->view($this->dx_auth->register_disabled_view, $data);
//			$this->load->view("footer");
//		}
//		else
//		{
//			$data['auth_message'] = 'You have to logout first, before registering.';
//			$this->load->view("header");
//			$this->load->view($this->dx_auth->logged_in_view, $data);
//			$this->load->view("footer");
//		}
//	}
//
//	function activate()
//	{
//		// Get username and key
//		$username = $this->uri->segment(3);
//		$key = $this->uri->segment(4);
//
//		// Activate user
//		if ($this->dx_auth->activate($username, $key))
//		{
//			$data['auth_message'] = 'Your account have been successfully activated. '.anchor(site_url($this->dx_auth->login_uri), 'Login');
//            $this->load->view("header_login",['title'=>'Account activation']);
//			$this->load->view($this->dx_auth->activate_success_view, $data);
//            $this->load->view("footer_login");
//		}
//		else
//		{
//			$data['auth_message'] = 'The activation code you entered was incorrect. Please check your email again.';
//            $this->load->view("header_login",['title'=>'Account activation']);
//			$this->load->view($this->dx_auth->activate_failed_view, $data);
//            $this->load->view("footer_login");
//		}
//	}
//
//	function forgot_password()
//	{
//		$val = $this->form_validation;
//
//		// Set form validation rules
//		$val->set_rules('login', 'Username or Email address', 'trim|required|xss_clean');
//
//		// Validate rules and call forgot password function
//		if ($val->run() AND $this->dx_auth->forgot_password($val->set_value('login')))
//		{
//			$data['auth_message'] = 'An email has been sent to your email with instructions with how to activate your new password.';
//			$this->load->view("header_login",['title'=>'Password to CINNAMON']);
//			$this->load->view($this->dx_auth->forgot_password_success_view, $data);
//			$this->load->view("footer_login");
//		}
//		else
//		{
//            $this->load->view("header_login",['title'=>'Password to CINNAMON']);
//			$this->load->view($this->dx_auth->forgot_password_view);
//            $this->load->view("footer_login");
//		}
//	}
//
//	function reset_password()
//	{
//		// Get username and key
//		$username = $this->uri->segment(3);
//		$key = $this->uri->segment(4);
//
//		// Reset password
//		if ($this->dx_auth->reset_password($username, $key))
//		{
//			$data['auth_message'] = 'You have successfully reset you password, '.anchor(site_url($this->dx_auth->login_uri), 'Login');
//			$this->load->view("header");
//			$this->load->view($this->dx_auth->reset_password_success_view, $data);
//			$this->load->view("footer");
//		}
//		else
//		{
//			$data['auth_message'] = 'Reset failed. Your username and key are incorrect. Please check your email again and follow the instructions.';
//			$this->load->view("header");
//			$this->load->view($this->dx_auth->reset_password_failed_view, $data);
//			$this->load->view("footer");
//		}
//	}
//
//	function change_password()
//	{
//		// Check if user logged in or not
//		if ($this->dx_auth->is_logged_in())
//		{
//			$val = $this->form_validation;
//
//			// Set form validation
//			$val->set_rules('old_password', 'Old Password', 'trim|required|xss_clean|min_length['.$this->min_password.']|max_length['.$this->max_password.']');
//			$val->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->min_password.']|max_length['.$this->max_password.']|matches[confirm_new_password]');
//			$val->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean');
//
//			$user_id = $this->dx_auth->get_user_id();
//
//			// Validate rules and change password
//			if ($val->run() AND $this->dx_auth->change_password($val->set_value('old_password'), $val->set_value('new_password')))
//			{
//				$data['auth_message'] = 'Your password has successfully been changed.';
//				$this->load->view("header");
//				$this->load->view($this->dx_auth->change_password_success_view, $data);
//				$this->load->view("footer");
//			}
//			else
//			{
//				$this->load->view("header");
//				$this->load->view($this->dx_auth->change_password_view);
//				$this->load->view("footer");
//			}
//		}
//		else
//		{
//			// Redirect to login page
//			$this->dx_auth->deny_access('login');
//		}
//	}
//
//	function cancel_account()
//	{
//		// Check if user logged in or not
//		if ($this->dx_auth->is_logged_in())
//		{
//			$val = $this->form_validation;
//
//			// Set form validation rules
//			$val->set_rules('password', 'Password', "trim|required|xss_clean");
//
//			// Validate rules and change password
//			if ($val->run() AND $this->dx_auth->cancel_account($val->set_value('password')))
//			{
//				// Redirect to homepage
//				redirect('', 'location');
//			}
//			else
//			{
//				$this->load->view($this->dx_auth->cancel_account_view);
//			}
//		}
//		else
//		{
//			// Redirect to login page
//			$this->dx_auth->deny_access('login');
//		}
//	}
//
//	// Example how to get permissions you set permission in /backend/custom_permissions/
//	function custom_permissions()
//	{
//		if ($this->dx_auth->is_logged_in())
//		{
//			echo 'My role: '.$this->dx_auth->get_role_name().'<br/>';
//			echo 'My permission: <br/>';
//
//			if ($this->dx_auth->get_permission_value('edit') != NULL AND $this->dx_auth->get_permission_value('edit'))
//			{
//				echo 'Edit is allowed';
//			}
//			else
//			{
//				echo 'Edit is not allowed';
//			}
//
//			echo '<br/>';
//
//			if ($this->dx_auth->get_permission_value('delete') != NULL AND $this->dx_auth->get_permission_value('delete'))
//			{
//				echo 'Delete is allowed';
//			}
//			else
//			{
//				echo 'Delete is not allowed';
//			}
//		}
//	}
}