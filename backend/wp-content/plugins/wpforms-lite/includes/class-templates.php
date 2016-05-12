<?php
/**
 * Pre-configured packaged templates.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
*/
class WPForms_Templates {

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$this->load();
	}

	/**
	 * Load default form templates.
	 *
	 * @since 1.0.0
	 */
	public function load() {

		// Parent class template
		require_once WPFORMS_PLUGIN_DIR . 'includes/templates/class-base.php';

		$templates = apply_filters( 'wpforms_load_templates', array(
			'blank',
			'contact',
			'request-quote',
			'donation',
			'order',
			'subscribe',
			'suggestion',
		) );

		foreach ( $templates as $template ) {
			
			if ( file_exists( WPFORMS_PLUGIN_DIR . 'includes/templates/class-' . $template . '.php' ) ) {
				require_once WPFORMS_PLUGIN_DIR . 'includes/templates/class-' . $template . '.php';
			}
		}
	}
}
new WPForms_Templates;