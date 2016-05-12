<?php
/**
 * Settings class.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
*/
class WPForms_Settings {

	/**
	 * Holds the plugin settings
	 *
	 * @since 1.0.0
	 */
	protected $options;

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Maybe load settings page
		add_action( 'admin_init', array( $this, 'init' ) );

		// Plugin settings link
		add_filter( 'plugin_action_links_' . plugin_basename( WPFORMS_PLUGIN_DIR . 'wpforms.php' ), array( $this, 'settings_link' ) );
	}

	/**
	 * Get the value of a specific setting.
	 *
	 * @since 1.0.0
	 * @return mixed
	*/
	public function get( $key, $default = false, $option = 'wpforms_settings' ) {

		if ( 'wpforms_settings' == $option && !empty( $this->options ) ) {
			$options = $this->options;
		} else {
			$options = get_option( $option, false );
		}

		$value = ! empty( $options[ $key ] ) ? $options[ $key ] : $default;
		return $value;
	}

	/**
	 * Determing if the user is viewing the settings page, if so, party on.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		
		// Check what page we are on
		$page = isset( $_GET['page'] ) ? $_GET['page'] : '';

		// Only load if we are actually on the settings page
		if ( $page == 'wpforms-settings' ) {

			// Retrieve settings
			$this->options = get_option( 'wpforms_settings', array() );

			add_action( 'wpforms_tab_settings_general',    array( $this, 'settings_page_tab_general'    ) );
			add_action( 'wpforms_tab_settings_payments',   array( $this, 'settings_page_tab_payments'   ) );
			add_action( 'wpforms_tab_settings_providers',  array( $this, 'settings_page_tab_providers'  ) );
			add_action( 'admin_enqueue_scripts',           array( $this, 'enqueues'                     ) );
			add_action( 'wpforms_admin_page',              array( $this, 'output'                       ) );

			// Hook for add-ons
			do_action( 'wpforms_settings_init' );
		}
	}

	/**
	 * Enqueue assets for the settings page.
	 *
	 * @since 1.0.0
	 */
	public function enqueues() {

		wp_enqueue_media();

		// CSS
		wp_enqueue_style( 
			'font-awesome', 
			WPFORMS_PLUGIN_URL . 'assets/css/font-awesome.min.css', 
			null, 
			'4.4.0'
		);

		wp_enqueue_style( 
			'wpforms-settings',
			WPFORMS_PLUGIN_URL . 'assets/css/admin-settings.css', 
			null,
			WPFORMS_VERSION
		);

		// JS
		wp_enqueue_script( 
			'wpforms-settings', 
			WPFORMS_PLUGIN_URL . 'assets/js/admin-settings.js',
			array( 'jquery', 'jquery-ui-tabs' ), 
			WPFORMS_VERSION, 
			false
		);
		wp_localize_script(
			'wpforms-settings',
			'wpforms_settings',
			array(
				'ajax_url'               => admin_url( 'admin-ajax.php' ),
				'nonce'                  => wp_create_nonce( 'wpforms-settings' ),
				'saving'                 => __( 'Saving ...', 'wpforms' ),
				'provider_disconnect'    => __( 'Are you sure you want to disconnect this account?', 'wpforms' ),
				'upload_title'           => __( 'Upload or Choose Your Image', 'wpforms' ),
				'upload_button'          => __( 'Use Image', 'wpforms' ),
			)
		);
	
		// Hook for add-ons
		do_action( 'wpforms_settings_enqueue' );
	}

	/**
	 * Handles generating the appropriate tabs and setting sections.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	public function setting_page_tabs() {

		// Define our base tabs
		$tabs = array(
			'general'   => __( 'General', 'wpforms' ),
			'payments'  => __( 'Payments', 'wpforms' ),
			'providers' => __( 'Integrations', 'wpforms' ),
		);

		// Allow for addons and extensions to add additional tabs
		$tabs = apply_filters( 'wpform_settings_tabs', $tabs );

		return $tabs;
	}

	/**
	 * Build the output for General tab on the settings page and check for save.
	 *
	 * @since 1.0.0
	 */
	public function settings_page_tab_general() {

		// Check for save, if found let's dance
		if ( !empty( $_POST['wpforms-settings-general-nonce'] ) ) {

			// Do we have a valid nonce and permission?
			if ( ! wp_verify_nonce( $_POST['wpforms-settings-general-nonce'], 'wpforms-settings-general-nonce' ) || !current_user_can( apply_filters( 'wpforms_manage_cap', 'manage_options' ) ) ) {

				// No funny business
				printf( '<div class="error below-h2"><p>%s</p></div>', __( 'Settings check failed.', 'wpforms' ) );

			} else {

				// Save General Settings
				if ( isset( $_POST['submit-general'] ) ) {

					// Prep and sanatize settings for save
					$this->options['email-template']       = !empty( $_POST['email-template'] ) ? esc_attr( $_POST['email-template'] ) : 'default';
					$this->options['email-header-image']   = !empty( $_POST['email-header-image'] ) ? esc_url_raw( $_POST['email-header-image'] ) : '';
					$this->options['disable-css']          = !empty( $_POST['disable-css'] ) ? intval( $_POST['disable-css'] ) : '1';
					$this->options['recaptcha-site-key']   = !empty( $_POST['recaptcha-site-key'] ) ? esc_html( $_POST['recaptcha-site-key'] ) : '';
					$this->options['recaptcha-secret-key'] = !empty( $_POST['recaptcha-secret-key'] ) ? esc_html( $_POST['recaptcha-secret-key'] ) : '';
					$this->options = apply_filters( 'wpforms_settings_save', $this->options, $_POST, 'general' );

					// Update settings in DB
					update_option( 'wpforms_settings' , $this->options );

					printf( '<div class="updated below-h2"><p>%s</p></div>', __( 'General settings updated.', 'wpforms' ) );

				}
			}
		}
		?>

		<div id="wpforms-settings-general">
			
			<form method="post">

				<?php wp_nonce_field( 'wpforms-settings-general-nonce', 'wpforms-settings-general-nonce' ); ?>
				
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row">
								<label for="wpforms-settings-general-css"><?php _e( 'Include Form Styling', 'wpforms' ); ?></label>
							</th>
							<td>
								<select name="disable-css" id="wpforms-settings-general-css">
									<option value="1" <?php selected( '1', $this->get( 'disable-css' ) ); ?>><?php _e( 'Base and form theme styling', 'wpforms' ); ?></option>
									<option value="2" <?php selected( '2', $this->get( 'disable-css' ) ); ?>><?php _e( 'Base styling only', 'wpforms' ); ?></option>
									<option value="3" <?php selected( '3', $this->get( 'disable-css' ) ); ?>><?php _e( 'None', 'wpforms' ); ?></option>
								</select>
								<p class="description"><?php _e( 'Determines which CSS files to load for the site.', 'wpforms' ); ?></p>
							</td>
						</tr>
						<tr>
							<td class="section" colspan="2">
								<hr>
								<h4><?php _e( 'Email', 'wpforms' ); ?></h4>
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="wpforms-settings-email-template"><?php _e( 'Email Template', 'wpforms' ); ?></label>
							</th>
							<td>
								<select name="email-template" id="wpforms-settings-email-template">
									<option value="default" <?php selected( 'default', $this->get( 'email-template' ) ); ?>><?php _e( 'Default HTML template', 'wpforms' ); ?></option>
									<option value="none" <?php selected( 'none', $this->get( 'email-template' ) ); ?>><?php _e( 'Plain Text', 'wpforms' ); ?></option>
								</select>
								<p class="description"><?php _e( 'Determines how email notifications will be formatted.', 'wpforms' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="wpforms-settings-email-header-image"><?php _e( 'Email Header Image ', 'wpforms' ); ?></label>
							</th>
							<td>
								<label for="wpforms-settings-email-header-image" class="wpforms-settings-upload-image-display">
									<?php 
									$email_header = $this->get( 'email-header-image' );
									if ( $email_header ) {
										echo '<img src="' . esc_url_raw( $email_header ) . '">';
									}
									?>
								</label>
								<input type="text" name="email-header-image" id="wpforms-settings-email-header-image" class="wpforms-settings-upload-image-value" value="<?php echo esc_url_raw( $this->get( 'email-header-image' ) ); ?>" />
								<a href="#" class="button button-secondary wpforms-settings-upload-image"><?php _e( 'Upload Image', 'wpforms' ); ?></a>
								<p class="description">
									<?php _e( 'Upload or choose a logo to be displayed at the top of email notifications.', 'wpforms' ); ?><br>
									<?php _e( 'Recommended size is 300x100 or smaller for best support on all devices.', 'wpforms' ); ?>
								</p>
							</td>          
						</tr>
						<tr>
							<td class="section" colspan="2">
								<hr>
								<h4><?php _e( 'reCAPTCHA', 'wpforms' ); ?></h4>
								<p><?php _e( 'reCAPTCHA is a free anti-spam service from Google. Its helps protect your website from spam and abuse while letting real people pass through with ease. <a href="http://www.google.com/recaptcha/intro/index.html" target="_blank">Visit reCAPTCHA</a> to learn more and sign up for a free account or <a href="https://wpforms.com/docs/setup-captcha-wpforms/" target="_blank">read our walk through</a> for step-by-step directions.', 'wpforms' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="wpforms-settings-general-recaptcha-site-key"><?php _e( 'reCAPTCHA Site key', 'wpforms' ); ?></label>
							</th>
							<td>
								<input type="text" name="recaptcha-site-key" value="<?php echo esc_attr( $this->get( 'recaptcha-site-key' ) ); ?>" id="wpforms-settings-general-recaptcha-site-key">
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="wpforms-settings-general-recaptcha-secret-key"><?php _e( 'reCAPTCHA Secret key', 'wpforms' ); ?></label>
							</th>
							<td>
								<input type="text" name="recaptcha-secret-key" value="<?php echo esc_attr( $this->get( 'recaptcha-secret-key' ) ); ?>" id="wpforms-settings-general-recaptcha-secret-key">
							</td>
						</tr>
					</tbody>
				</table>

				<?php submit_button( __( 'Save General Settings', 'wpforms'), 'primary', 'submit-general' ); ?>

			</form>
	
		</div>
		<?php
	}

	/**
	 * Build the output for Payments tab on the settings page and check for save.
	 *
	 * @since 1.0.0
	 */
	public function settings_page_tab_payments() {
		
		// Check for save, if found let's dance
		if ( !empty( $_POST['wpforms-settings-payments-nonce'] ) && isset( $_POST['submit-payments'] ) ) {

			// Do we have a valid nonce and permission?
			if ( ! wp_verify_nonce( $_POST['wpforms-settings-payments-nonce'], 'wpforms-settings-payments-nonce' ) || !current_user_can( apply_filters( 'wpforms_manage_cap', 'manage_options' ) ) ) {

				// No funny business
				printf( '<div class="error below-h2"><p>%s</p></div>', __( 'Settings check failed.', 'wpforms' ) );

			} else {

				$this->options['currency'] = !empty( $_POST['currency'] ) ? esc_html( $_POST['currency'] ) : 'USD';
				$this->options = apply_filters( 'wpforms_settings_save', $this->options, $_POST, 'payments' );

				// Update settings in DB
				update_option( 'wpforms_settings' , $this->options );

				// Winning
				printf( '<div class="updated below-h2"><p>%s</p></div>', __( 'Settings updated.', 'wpforms' ) );
			}
		}
		?>

		<div id="wpforms-settings-payments">

			<form method="post">

				<table class="form-table">
					<tbody>

						<tr>
							<th scope="row">
								<label for="wpforms-settings-payments-currency"><?php _e( 'Currency', 'wpforms' ); ?></label>
							</th>
							<td>
								<select name="disable-css" id="wpforms-settings-general-css">
									<option value="USD" <?php selected( 'USD', $this->get( 'currency' ) ); ?>><?php _e( 'US Dollars (USD)', 'wpforms' ); ?></option>
								</select>
								<p class="description"><?php _e( 'Determines which currency to use for payments.', 'wpforms' ); ?></p>
							</td>
						</tr>

						<?php do_action( 'wpforms_payments_settings_table', $this->options ); ?>

					</tbody>
				</table>

				<?php wp_nonce_field( 'wpforms-settings-payments-nonce', 'wpforms-settings-payments-nonce' ); ?>

				<?php submit_button( __( 'Save', 'wpforms'), 'primary', 'submit-payments' ); ?>

			</form>
			
		</div>
		<?php
	}

	/**
	 * Build the output for Integrations (providers) tab on the settings page and check for save.
	 *
	 * @since 1.0.0
	 */
	public function settings_page_tab_providers() {

		$providers = get_option( 'wpforms_providers', false );
		$active    = apply_filters( 'wpforms_providers_available', array() );
		
		// If no provider addons are activated display a message and bail
		if ( empty( $active ) ) {
			echo '<div class="notice notice-info below-h2"><p>' . sprintf( __( 'You do not have any marketing add-ons activated. You can head over to the <a href="%s">Add-Ons page</a> to install and activate the add-on for your provider.', 'wpforms' ), admin_url( 'admin.php?page=wpforms-addons' ) ) . '</p></div>';
			return;
		}
		?>

		<div id="wpforms-settings-providers">
				
			<?php do_action( 'wpforms_settings_providers', $active, $providers ); ?>
			
		</div>
		<?php
	}

	/**
	 * Build the output for the plugin settings page.
	 *
	 * @since 1.0.0
	 */
	public function output() {

		?>
		<div id="wpforms-settings" class="wrap">

			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			
			<div id="wpforms-tabs" class="wpforms-clear">

				<!-- Output tabs navigation -->
				<h2 id="wpforms-tabs-nav" class="wpforms-clear nav-tab-wrapper">
					<?php $i = 0; foreach ( (array) $this->setting_page_tabs() as $id => $title ) : $class = 0 === $i ? 'wpforms-active nav-tab-active' : ''; ?>
						<a class="nav-tab <?php echo $class; ?>" href="#wpforms-tab-<?php echo $id; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
					<?php $i++; endforeach; ?>
				</h2>

				<!-- Output tab sections -->
				<?php $i = 0; foreach ( (array) $this->setting_page_tabs() as $id => $title ) : $class = 0 === $i ? 'wpforms-active' : ''; ?>
				<div id="wpforms-tab-<?php echo $id; ?>" class="wpforms-tab wpforms-clear <?php echo $class; ?>">
					<?php do_action( 'wpforms_tab_settings_' . $id ); ?>
				</div>
				<?php $i++; endforeach; ?>

			</div>

		</div>
		<?php
	}

	/**
	 * Add settings link to the Plugins page.
	 *
	 * @since 1.0.0
	 * @param array $links
	 * @return array $links
	 */
	public function settings_link( $links ) {

		$setting_link = sprintf( '<a href="%s">%s</a>', add_query_arg( array( 'page' => 'wpforms-settings' ), admin_url( 'admin.php' ) ), __( 'Settings', 'wpforms' ) );
		array_unshift( $links, $setting_link );

		return $links;
	}
}
new WPForms_Settings;