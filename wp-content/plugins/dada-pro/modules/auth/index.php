<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'DadaProAuth' ) ) {

	class DadaProAuth {
		
		private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {
			add_filter ( 'theme_page_templates', array( $this, 'dada_auth_template_attribute' ) );
			add_filter ( 'template_include', array( $this, 'dada_registration_template' ) );

			$this->load_modules();
			$this->frontend();

			add_action('wp_ajax_dada_pro_register_user_front_end', array( $this, 'dada_pro_register_user_front_end', 0 ) );
			add_action('wp_ajax_nopriv_dada_pro_register_user_front_end', array( $this, 'dada_pro_register_user_front_end' ) );

			add_action('user_register', array( $this, 'dada_pro_registration_mail' ) );
        }

		/**
		 * Add Custom Templates to page template array
		*/
		function dada_auth_template_attribute($templates) {
			$templates = array_merge($templates, array(
				'tpl-registration.php' => esc_html__('Registration Page Template', 'dada-pro') ,
			));
			return $templates;
		}

		/**
		 * Include Custom Templates page from plugin
		*/
		function dada_registration_template($template){

			global $post;
			$id = get_the_ID();
			$file = get_post_meta($id, '_wp_page_template', true);
			if ('tpl-registration.php' == $file){
				$template = DADA_PRO_DIR_PATH . 'modules/auth/templates/tpl-registration.php';
			}
			return $template;

		}

		function load_modules() {
			include_once DADA_PRO_DIR_PATH.'modules/auth/customizer/index.php';
		}

		function frontend() {
			add_action( 'dada_after_main_css', array( $this, 'enqueue_css_assets' ), 30 );
			add_action( 'dada_before_enqueue_js', array( $this, 'enqueue_js_assets' ) );
		}

		function enqueue_css_assets() {
			wp_enqueue_style( 'dada-pro-auth', DADA_PRO_DIR_URL . 'modules/auth/assets/css/style.css', false, DADA_PRO_VERSION, 'all');
		}

		function enqueue_js_assets() {
			wp_enqueue_script( 'dada-pro-auth', DADA_PRO_DIR_URL . 'modules/auth/assets/js/script.js', array(), DADA_PRO_VERSION, true );
		}

		/**
		 * User Registration Save Data
		 */

		function dada_pro_register_user_front_end() {

			$first_name = isset( $_POST['first_name'] ) ? dada_sanitization($_POST['first_name']) : '';
			$last_name  = isset( $_POST['last_name'] )  ? dada_sanitization($_POST['last_name'])  : '';
			$password   = isset( $_POST['password'] )   ? dada_sanitization($_POST['password'] )  : '';
			$user_name  = isset( $_POST['user_name'] )  ? dada_sanitization($_POST['user_name'])  : '';
			$user_email = isset( $_POST['user_email'] ) ? dada_sanitization($_POST['user_email']) : '';

			$user = array(
				'user_login'  =>  $user_name,
				'user_email'  =>  $user_email,
				'user_pass'   =>  $password,
				'first_name'  =>  $first_name,
				'last_name'   =>  $last_name
			);

			$result = wp_insert_user( $user );
			if (!is_wp_error($result)) {
					echo 'We have Created an account for you.';
					dada_pro_registration_mail($user_id);
			} else {
				if (isset($result->errors['empty_user_login']) &&  (isset($result->errors['empty_user_email']))){
					echo 'User Name and Email are required';
				} elseif (isset($result->errors['existing_user_login'])) {
					echo 'User name already exixts.';
				} else {
					echo 'Something Went Wrong.';
				}
			}

		}
		
		function dada_pro_registration_mail($user_id , $user_name , $password ) {

			$dada_pro_user = get_userdata($user_id);
			$dada_pro_user_email = $dada_pro_user->dada_pro_user_email;

			// email will send registers
			$dada_pro_to = $dada_pro_user_email;
			$dada_pro_subject = "Hi";
			$dada_pro_body = '
						<p>
						We have successfully registered you as a Student.
						Username ='.$user_name.';
						Password ='.$password .';
						</p>
			';
			$dada_pro_headers = array('Content-Type: text/html; charset=UTF-8');
			wp_mail($dada_pro_to, $dada_pro_subject, $dada_pro_body, $dada_pro_headers);

		}

	}

	add_action( 'wp_ajax_dada_pro_show_login_form_popup', 'dada_pro_show_login_form_popup' );
	add_action( 'wp_ajax_nopriv_dada_pro_show_login_form_popup', 'dada_pro_show_login_form_popup' );
	function dada_pro_show_login_form_popup() {
		echo dada_pro_login_form();

		die();
	}

	// Login form
	if(!function_exists('dada_pro_login_form')) {
		function dada_pro_login_form() {

			$out = '<div class="dada-pro-login-form-container">';

				$out .= '<div class="dada-pro-login-form">';

					$out .= '<div class="dada-pro-login-form-wrapper">';
						$out .= '<div class="dada-pro-title dada-pro-login-title"><h2><span class="dada-pro-login-title"><strong>'.esc_html__('Create Your Account', 'dada-pro').'</strong></span></h2>
							<span class="dada-pro-login-description">'.esc_html__('Please enter your login credentials to access your account.', 'dada-pro').'</span></div>';
							$out .= '<div class="login-form-custom-logo">'; 
								$out .= '<img class="pre_loader_image" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" src="'.dada_customizer_settings('enable_auth_logo').'"/>';
						$out .= '</div>';
						$social_logins = (dada_customizer_settings( 'enable_social_logins' ) !== null) && !empty(dada_customizer_settings( 'enable_social_logins' )) ? dada_customizer_settings( 'enable_social_logins' ) : 0;
						$enable_facebook_login = (dada_customizer_settings( 'enable_facebook_login' ) !== null) && !empty(dada_customizer_settings( 'enable_facebook_login' )) ? dada_customizer_settings( 'enable_facebook_login' ) : 0;
						$facebook_app_id = (dada_customizer_settings( 'facebook_app_id' ) !== null) && !empty(dada_customizer_settings( 'facebook_app_id' )) ? dada_customizer_settings( 'facebook_app_id' ) : '';
						$facebook_app_secret = (dada_customizer_settings( 'facebook_app_secret' ) !== null) && !empty(dada_customizer_settings( 'facebook_app_secret' )) ? dada_customizer_settings( 'facebook_app_secret' ) : '';
						$enable_google_login = (dada_customizer_settings( 'enable_google_login' ) !== null) && !empty( dada_customizer_settings( 'enable_google_login' ) ) ? dada_customizer_settings( 'enable_google_login' ) : 0;

						if( $social_logins ) {
							if( $enable_google_login ) {
								$out .= '<div class="dada-pro-social-google-logins-container">';
									if($enable_google_login) {
										$out .= '<a href="'.dada_pro_google_login_url().'" class="dada-pro-social-google-connect"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">

										<g>
											<path class="google-color-1" d="M95,51.1c0-3.1-0.3-6.3-0.8-9.3H50.9v17.7h24.8c-1,5.7-4.3,10.7-9.2,13.9l14.8,11.5C90,76.8,95,65,95,51.1   L95,51.1z"/>
											<path class="google-color-2" d="M50.9,95.9c12.4,0,22.8-4.1,30.4-11.1L66.5,73.4c-4.1,2.8-9.4,4.4-15.6,4.4c-12,0-22.1-8.1-25.8-18.9L9.9,70.6   C17.7,86.1,33.5,95.9,50.9,95.9z"/>
											<path class="google-color-3" d="M25.1,58.8c-1.9-5.7-1.9-11.9,0-17.6L9.9,29.4c-6.5,13-6.5,28.3,0,41.2L25.1,58.8z"/>
											<path class="google-color-4" d="M50.9,22.3c6.5-0.1,12.9,2.4,17.6,6.9L81.6,16C73.3,8.2,62.3,4,50.9,4.1c-17.4,0-33.2,9.8-41,25.3l15.2,11.8   C28.8,30.3,38.9,22.3,50.9,22.3z"/>
										</g>
										</svg></i>'.esc_html__('Google', 'dada-pro').'</a>';
									}
									$out .= '<div class="dada-pro-social-logins-divider">'.esc_html__('Or', 'dada-pro').'</div>';
								$out .= '</div>';
		
							}
						}
						$out .= '<div class="dada-pro-login-form-holder">';

						$my_login_args = apply_filters( 'login_form_defaults', array(
							'echo'           => false,
							'redirect'       => site_url( $_SERVER['REQUEST_URI'] ), 
							'form_id'        => 'loginform',
							'label_username' => '',
							'label_password' => '',
							'label_remember' => esc_html__( 'Remember Me' ),
							'label_log_in'   => esc_html__( 'Sign In' ),
							'id_username'    => 'user_login',
							'id_password'    => 'user_pass',
							'id_remember'    => 'rememberme',
							'id_submit'      => 'wp-submit',
							'remember'       => true,
							'value_username' => NULL,
							'value_remember' => false
						) );

							$out .= wp_login_form( $my_login_args );
							$out .= '<p class="tpl-forget-pwd"><a href="'.wp_lostpassword_url( get_permalink() ).'">'.esc_html__('Forgot password ?','dada-pro').'</a></p>';

						$out .= '</div>';

						if( $social_logins ) {
							$out .= '<div class="dada-pro-social-logins-divider">'.esc_html__('Or', 'dada-pro').'</div>';
							if( $enable_facebook_login ) {
								$out .= '<div class="dada-pro-social-facebook-logins-container">';
									if($enable_facebook_login) {
										if(!session_id()) {
											session_start();
										}

										include_once DADA_PRO_DIR_PATH.'modules/auth/apis/facebook/Facebook/autoload.php';

										$appId     = $facebook_app_id; //Facebook App ID
										$appSecret = $facebook_app_secret; // Facebook App Secret
		
										$fb = new Facebook\Facebook([
											'app_id' => $appId,
											'app_secret' => $appSecret,
											'default_graph_version' => 'v2.10',
										]);
		
										$helper = $fb->getRedirectLoginHelper();
										$permissions = ['email'];
										$loginUrl = $helper->getLoginUrl( site_url('wp-login.php') . '?dtLMSFacebookLogin=1', $permissions);
		
										$out .= '<a href="'.htmlspecialchars($loginUrl).'" class="dada-pro-social-facebook-connect"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 30 30" style="enable-background:new 0 0 30 30;" xml:space="preserve">
										<style type="text/css"> 
										.wdt-custom-logion-facebook-class-1{fill:#185bb0;}
										</style>
										<path class="wdt-custom-logion-facebook-class-1" d="M23.4,0.1c-0.3,0-0.6,0-0.9,0c-0.4,0-0.8,0-1.2,0H8.2c-0.5,0-0.9,0-1.4,0c-1.4,0-2.8,0.4-4,
										1.2 C1.9,1.9,1.2,2.8,0.7,3.8C0.3,4.7,0.1,5.6,0.1,6.6c0,0.2,0,0.5,0,0.7c0,1.8,0,3.5,0,5.3c0,1.4,0,2.7,
										0,4.1v0.3c0,0.1,0,0.3,0,0.4 c0,1.2,0,2.5,0,3.8c0,1,0,2,0.2,3c0.1,0.8,0.4,1.6,0.8,2.4c0,0,0,0.1,0.1,0.1c0.4,0.7,
										1,1.4,1.7,1.9c0.7,0.5,1.5,0.9,2.3,1.1 C5.9,29.9,6.8,30,7.8,30c0.8,0,1.6,0,2.3,0c0.9,0,1.8,0,2.7,0l0,
										0l0,0l0-0.1c0-0.2,0-1.8,0-3.6c0-1,0-2.1,0-3.2c0-1.6,0-3.1,0-3.7 c-0.2,0-0.4,0-0.6,0c-0.5,0-1,0-1.4,
										0c-0.6,0-1.3,0-1.9,0c0-0.2,0-0.3,0-0.5c0-0.7,0-1.3,0-2c0-0.6,0-1.2,0-1.8h1.5 c0.8,0,1.6,0,2.4,0c0-1.1,
										0-2.2,0-3.3c0-0.7,0.1-1.4,0.3-2c0.2-0.7,0.5-1.3,0.9-1.8c0.2-0.3,0.5-0.6,0.8-0.8 c0.4-0.3,0.8-0.5,
										1.2-0.7c0.9-0.3,2-0.5,3-0.4c1,0,2,0.1,2.9,0.2c0,1.2-0.1,2.5-0.1,3.7c-0.7,0-1.5,0-2.3,0.1 c-0.3,0-0.6,
										0.1-0.9,0.2c-0.3,0.1-0.5,0.3-0.7,0.6c-0.3,0.4-0.5,1-0.4,1.5c0,0.9,0,1.9,0,2.8c0.9,0,1.9,0,2.8,0h1.6 c0,
										0.1-0.2,0.9-0.3,1.7c-0.2,1-0.4,2.2-0.5,2.6h-3.5v0c0,0.9,0,1.8,0,2.6c0,1.1,0,2.2,0,3.3c0,1.5,0,3,0,4.5c0,
										0,0,0.1,0,0.1 c0.5,0,1.1,0,1.6,0c0.3,0,0.6,0,0.9,0c0.3,0,0.6,0,0.9,0c1.2,0,2.5,0,3.7-0.2c1-0.2,2-0.6,
										2.9-1.2c0.8-0.6,1.5-1.5,1.9-2.4 c0.5-1.2,0.7-2.4,0.7-3.7c0-0.7,0-1.5,0-2.2v-0.1c0-0.9,0-1.7,0-2.6c0-0.9,
										0-1.7,0-2.6c0-1.2,0-2.5,0-3.7c0-1.3,0-2.6,0-3.9 c0-0.2,0-0.5,0-0.7c0-1.2-0.3-2.4-0.9-3.4c-0.7-1.3-2-2.4-3.4-2.8C24.9,
										0.3,24.2,0.1,23.4,0.1L23.4,0.1L23.4,0.1L23.4,0.1z"/>
										</svg>'.esc_html__('Facebook', 'dada-pro').'</a>';
									}
								$out .= '</div>';
		
							}
						}

					$out .= '</div>';
				$out .= '</div>';

			$out .= '</div>';

			$out .= '<div class="dada-pro-login-form-overlay"></div>';

			return $out;

		}
	}

	/* ---------------------------------------------------------------------------
	* Google login utils
	* --------------------------------------------------------------------------- */

	if( !function_exists( 'dada_pro_google_login_url' ) ) {
		function dada_pro_google_login_url() {
			return site_url('wp-login.php') . '?dtLMSGoogleLogin=1';
		}
	}

	function dada_pro_google_login() {

		$dtLMSGoogleLogin = isset($_REQUEST['dtLMSGoogleLogin']) ? dada_sanitization($_REQUEST['dtLMSGoogleLogin']) : '';
		if ($dtLMSGoogleLogin == '1') {
			dada_pro_google_login_action();
		}
	
	}
	add_action('login_init', 'dada_pro_google_login');

	if( !function_exists('dada_pro_google_login_action') ) {
		function dada_pro_google_login_action() {

			require_once DADA_PRO_DIR_URL.'modules/auth/apis/google/Google_Client.php';
			require_once DADA_PRO_DIR_URL.'modules/auth/apis/google/contrib/Google_Oauth2Service.php';
			
			$google_client_id = (dada_customizer_settings( 'google_client_id' ) !== null) && !empty(dada_customizer_settings( 'google_client_id' )) ? dada_customizer_settings( 'google_client_id' ) : '';
			$google_client_secret = (dada_customizer_settings( 'google_client_secret' ) !== null) && !empty(dada_customizer_settings( 'google_client_secret' )) ? dada_customizer_settings( 'google_client_secret' ) : '';

			$clientId     = $google_client_id; //Google CLIENT ID
			$clientSecret = $google_client_secret; //Google CLIENT SECRET
			$redirectUrl  = dada_pro_google_login_url();  //return url (url to script)
		
			$gClient = new Google_Client();
			$gClient->setApplicationName(esc_html__('Login To Website', 'dada-pro'));
			$gClient->setClientId($clientId);
			$gClient->setClientSecret($clientSecret);
			$gClient->setRedirectUri($redirectUrl);
		
			$google_oauthV2 = new Google_Oauth2Service($gClient);
		
			if(isset($google_oauthV2)){
		
				$gClient->authenticate();
				$_SESSION['token'] = $gClient->getAccessToken();
		
				if (isset($_SESSION['token'])) {
					$gClient->setAccessToken($_SESSION['token']);
				}
		
				$user_profile = $google_oauthV2->userinfo->get();
		
				$args = array(
					'meta_key'     => 'google_id',
					'meta_value'   => $user_profile['id'],
					'meta_compare' => '=',
				 );
				$users = get_users( $args );
		
				if(is_array($users) && !empty($users)) {
					$ID = $users[0]->data->ID;
				} else {
					$ID = NULL;
				}
		
				if ($ID == NULL) {
		
					if (!isset($user_profile['email'])) {
						$user_profile['email'] = $user_profile['id'] . '@gmail.com';
					}
		
					$random_password = wp_generate_password($length = 12, $include_standard_special_chars = false);
		
					$username = strtolower($user_profile['name']);
					$username = trim(str_replace(' ', '', $username));
		
					$sanitized_user_login = sanitize_user('google-'.$username);
		
					if (!validate_username($sanitized_user_login)) {
						$sanitized_user_login = sanitize_user('google-' . $user_profile['id']);
					}
		
					$defaul_user_name = $sanitized_user_login;
					$i = 1;
					while (username_exists($sanitized_user_login)) {
					  $sanitized_user_login = $defaul_user_name . $i;
					  $i++;
					}
		
					$ID = wp_create_user($sanitized_user_login, $random_password, $user_profile['email']);
		
					if (!is_wp_error($ID)) {
		
						wp_new_user_notification($ID, $random_password);
						$user_info = get_userdata($ID);
						wp_update_user(array(
							'ID' => $ID,
							'display_name' => $user_profile['name'],
							'first_name' => $user_profile['name'],
						));
		
						update_user_meta($ID, 'google_id', $user_profile['id']);
		
					}
		
				}
		
				// Login
				if ($ID) {
		
				  $secure_cookie = is_ssl();
				  $secure_cookie = apply_filters('secure_signon_cookie', $secure_cookie, array());
				  global $auth_secure_cookie;
		
				  $auth_secure_cookie = $secure_cookie;
				  wp_set_auth_cookie($ID, false, $secure_cookie);
				  $user_info = get_userdata($ID);
				  update_user_meta($ID, 'google_profile_picture', $user_profile['picture']);
				  do_action('wp_login', $user_info->user_login, $user_info, 10, 2);
				  update_user_meta($ID, 'google_user_access_token', $_SESSION['token']);
		
				//   wp_redirect(dada_pro_get_login_redirect_url($user_info));
				wp_redirect(home_url());
		
				}
		
			} else {
		
				$authUrl = $gClient->createAuthUrl();
				header('Location: ' . $authUrl);
				exit;
		
			}
		
		}
	}

	/* if( !function_exists( 'dada_pro_get_login_redirect_url' ) ) {
		function dada_pro_get_login_redirect_url($user_info) {

			$dtlms_redirect_url = '';
			if(isset($user_info->data->ID)) {
				$current_user = $user_info;

			}

		}
	} */

}

DadaProAuth::instance();