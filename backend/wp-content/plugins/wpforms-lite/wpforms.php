<?php
/**
 * Plugin Name: WPForms Lite
 * Plugin URI:  https://wpforms.com
 * Description: Beginner friendly WordPress contact form plugin. Use our Drag & Drop form builder to create your WordPress forms.
 * Author:      WPForms
 * Author URI:  https://wpforms.com
 * Version:     1.1.8.4
 * Text Domain: wpforms
 * Domain Path: languages
 *
 * WPForms is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * WPForms is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with WPForms. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Main WPForms class
 *
 * @since 1.0.0
 * @package WPForms
 */
final class WPForms_Lite {

	/**
	 * One is the loneliest number that you'll ever do.
	 *
	 * @since 1.0.0
	 * @var object
	 */
	private static $instance;

	/**
	 * Plugin version for enqueueing, etc.
	 *
	 * @since 1.0.0
	 * @var sting
	 */
	private $version = '1.1.8.4';

	/**
	 * The form data handler instance.
	 *
	 * @var object WPForms_Form_Handler
	 * @since 1.0.0
	 */
	public $form;

	/**
	 * The front-end instance.
	 *
	 * @var object WPForms_Frontend
	 * @since 1.0.0
	 */
	public $frontend;

	/**
	 * The process instance.
	 *
	 * @var object WPForms_Process
	 * @since 1.0.0
	 */
	public $process;

	/**
	 * The smart tags instance.
	 *
	 * @var object WPForms_Smart_Tags
	 * @since 1.0.0
	 */
	public $smart_tags;

	/**
	 * The Logging instance.
	 *
	 * @var object WPForms_Logging
	 * @since 1.0.0
	 */
	public $logs;

	/**
	 * Main WPForms Instance.
	 *
	 * Insures that only one instance of WPForms exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @since 1.0.0
	 * @return WPForms
	 */
	public static function instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof WPForms_Lite ) ) {

			self::$instance = new WPForms_Lite;
			self::$instance->constants();
			self::$instance->load_textdomain();
			self::$instance->includes();

			add_action( 'plugins_loaded', array( self::$instance, 'objects' ), 10 );
		}
		return self::$instance;
	}

	/**
	 * Include files.
	 *
	 * @since 1.0.0
	 */
	private function includes() {

		// Global includes
		require_once WPFORMS_PLUGIN_DIR . 'includes/functions.php';
		require_once WPFORMS_PLUGIN_DIR . 'includes/class-install.php';
		require_once WPFORMS_PLUGIN_DIR . 'includes/class-db.php';
		require_once WPFORMS_PLUGIN_DIR . 'includes/class-form.php';
		require_once WPFORMS_PLUGIN_DIR . 'includes/class-fields.php';
		require_once WPFORMS_PLUGIN_DIR . 'includes/class-frontend.php';
		require_once WPFORMS_PLUGIN_DIR . 'includes/class-templates.php';
		require_once WPFORMS_PLUGIN_DIR . 'includes/class-process.php';
		require_once WPFORMS_PLUGIN_DIR . 'includes/class-smart-tags.php';
		require_once WPFORMS_PLUGIN_DIR . 'includes/class-logging.php';
		require_once WPFORMS_PLUGIN_DIR . 'includes/class-widget.php';
		require_once WPFORMS_PLUGIN_DIR . 'includes/class-preview.php';
		require_once WPFORMS_PLUGIN_DIR . 'includes/emails/class-emails.php';

		// Admin/Dashboard only includes
		if ( is_admin() ) {
			require_once WPFORMS_PLUGIN_DIR . 'includes/admin/class-menu.php';
			require_once WPFORMS_PLUGIN_DIR . 'includes/admin/class-settings.php';
			require_once WPFORMS_PLUGIN_DIR . 'includes/admin/overview/class-overview.php';
			require_once WPFORMS_PLUGIN_DIR . 'includes/admin/builder/class-builder.php';
			require_once WPFORMS_PLUGIN_DIR . 'includes/admin/class-welcome.php';
			require_once WPFORMS_PLUGIN_DIR . 'includes/admin/class-editor.php';
			require_once WPFORMS_PLUGIN_DIR . 'includes/admin/ajax-actions.php';
			require_once WPFORMS_PLUGIN_DIR . 'includes/admin/class-upgrades.php';
			require_once WPFORMS_PLUGIN_DIR . 'lite/lite.php';
		}
	}

	/**
	 * Setup objects.
	 *
	 * @since 1.0.0
	 */
	public function objects() {

		// Global objects
		$this->form         = new WPForms_Form_Handler;
		$this->frontend     = new WPForms_Frontend;
		$this->process      = new WPForms_Process;
		$this->smart_tags   = new WPForms_Smart_Tags;
		$this->logs         = new WPForms_Logging;

		// Hook now that all of the WPForms stuff is loaded.
		do_action( 'wpforms_loaded' );
	}

	/**
	 * Setup plugin constants.
	 *
	 * @since 1.0.0
	 */
	private function constants() {

		// Plugin version
		if ( ! defined( 'WPFORMS_VERSION' ) ) {
			define( 'WPFORMS_VERSION', $this->version );
		}

		// Plugin Folder Path
		if ( ! defined( 'WPFORMS_PLUGIN_DIR' ) ) {
			define( 'WPFORMS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Plugin Folder URL
		if ( ! defined( 'WPFORMS_PLUGIN_URL' ) ) {
			define( 'WPFORMS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		// Plugin Root File
		if ( ! defined( 'WPFORMS_PLUGIN_FILE' ) ) {
			define( 'WPFORMS_PLUGIN_FILE', __FILE__ );
		}
	}

	/**
	 * Loads the plugin language files.
	 *
	 * @since 1.0.0
	 */
	public function load_textdomain() {

		load_plugin_textdomain( 'wpforms', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}
}

/**
 * The function which returns the one WPForms instance.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $wpforms = wpforms(); ?>
 *
 * @since 1.0.0
 * @return object
 */
function wpforms() {

	return WPForms_Lite::instance();
}
wpforms();