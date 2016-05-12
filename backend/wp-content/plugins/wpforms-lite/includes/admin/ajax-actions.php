<?php
/**
 * Ajax actioned used in by admin.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
*/

/**
 * Save a form
 *
 * @todo  pull out the saving function to the form handler class
 * @since 1.0.0
 */
function wpforms_save_form() {

	// Run a security check
	check_ajax_referer( 'wpforms-builder', 'nonce' );

	// Check for permissions
	if ( !current_user_can( apply_filters( 'wpforms_manage_cap', 'manage_options' ) ) )
		die( __( 'You do no have permission.', 'wpforms' ) );

	// Check for form data
	if ( empty( $_POST['data'] ) ) 
		die( __( 'No data provided', 'wpforms' ) );

	$data    = wp_parse_args( $_POST['data'], array() );
	$form_id = wpforms()->form->update( $data['id'], $data );

	if ( ! $form_id ) {
		die( __( 'An error occured and the form could not be saved', 'wpforms'  ) );
	} else {
		$data = array(
			'form_name' => esc_html( $data['settings']['form_title'] ),
			'form_desc' => $data['settings']['form_desc'],
			'redirect'  => admin_url( 'admin.php?page=wpforms-overview' ),
		);
		wp_send_json_success( $data );
	}
}
add_action( 'wp_ajax_wpforms_save_form', 'wpforms_save_form' );

/**
 * Create a new form
 *
 * @since 1.0.0
 */
function wpforms_new_form() {

	// Run a security check
	check_ajax_referer( 'wpforms-builder', 'nonce' );

	// Check for form title
	if ( empty( $_POST['title'] ) ) 
		die( __( 'No form title provided', 'wpforms' ) );

	// Create form
	$form_title    = sanitize_text_field( $_POST['title'] );
	$form_template = sanitize_text_field( $_POST['template'] );
	$title_exists  = get_page_by_title( $form_title, 'OBJECT', 'wpforms' );
	$form_id       = wpforms()->form->add( 
		$form_title,
		array(), 
		array( 'template' => $form_template )
	);
	if ( NULL != $title_exists ) {
		wp_update_post( array( 
			'ID'         => $form_id,
			'post_title' => $form_title . ' (ID #' . $form_id . ')',
		) );
	}

	if ( $form_id ) {
		$data = array(
			'id'       => $form_id,
			'redirect' => add_query_arg( array( 'view' => 'fields', 'form_id' => $form_id, 'newform' => '1' ), admin_url( 'admin.php?page=wpforms-builder' ) ),
		);
		wp_send_json_success( $data );
	} else {
		die( __( 'Error creating form', 'wpforms' ) ); 
	}
}
add_action( 'wp_ajax_wpforms_new_form', 'wpforms_new_form' );

/**
 * Update form template.
 *
 * @since 1.0.0
 */
function wpforms_update_form_template() {

	// Run a security check
	check_ajax_referer( 'wpforms-builder', 'nonce' );

	// Check for form title
	if ( empty( $_POST['form_id'] ) ) 
		die( __( 'No form ID provided', 'wpforms' ) );

	$data    = wpforms()->form->get( $_POST['form_id'], array( 'content_only' => true ) );
	$form_id = wpforms()->form->update( $_POST['form_id'], $data, array( 'template' => $_POST['template'] ) );

	if ( $form_id ) {
		$data = array(
			'id'       => $form_id,
			'redirect' => add_query_arg( array( 'view' => 'fields', 'form_id' => $form_id ), admin_url( 'admin.php?page=wpforms-builder' ) ),
		);
		wp_send_json_success( $data );
	} else {
		die( __( 'Error updating form template', 'wpforms' ) ); 
	}
}
add_action( 'wp_ajax_wpforms_update_form_template', 'wpforms_update_form_template' );

/**
 * Deactivate addon
 *
 * @since 1.0.0
 */
function wpforms_deactivate_addon() {

	// Run a security check
	check_ajax_referer( 'wpforms-addons', 'nonce' );

	if ( isset( $_POST['plugin'] ) ) {
		$deactivate = deactivate_plugins( $_POST['plugin'] );
		wp_send_json_success( __( 'Addon deactivated.', 'wpforms' ) );
	} else {
		wp_send_json_error( __( 'Could not deactivate addon. Please deacticate from the Plugins page.', 'wpforms' ) );
	}
}
add_action( 'wp_ajax_wpforms_deactivate_addon', 'wpforms_deactivate_addon' );

/**
 * Activate addon
 *
 * @since 1.0.0
 */
function wpforms_activate_addon() {

	// Run a security check
	check_ajax_referer( 'wpforms-addons', 'nonce' );

	if ( isset( $_POST['plugin'] ) ) {
		
		$activate = activate_plugins( $_POST['plugin'] );

		if ( !is_wp_error( $activate ) ) {
			wp_send_json_success( __( 'Addon activated.', 'wpforms' ) );
		}
	}

	wp_send_json_error( __( 'Could not activate addon. Please activate from the Plugins page.', 'wpforms' ) );
}
add_action( 'wp_ajax_wpforms_activate_addon', 'wpforms_activate_addon' );

/**
 * Install addon
 *
 * @since 1.0.0
 */
function wpforms_install_addon() {

	// Run a security check
	check_ajax_referer( 'wpforms-addons', 'nonce' );

	if ( empty( $_POST['plugin'] ) ) {
		wp_send_json_error( __( 'Could not install addon. Please download from wpforms.com and install manually.', 'wpforms' ) );
	}

	global $hook_suffix;

	// Set the current screen to avoid undefined notices.
	set_current_screen();
	
	// Prepare variables.
	$download_url = $_POST['plugin'];
	$url          = esc_url_raw( add_query_arg( array( 'page' => 'wpforms-addons' ), admin_url( 'admin.php' ) ) );

	// Check for file system permissions
	if ( false === ( $creds = request_filesystem_credentials( $url, '', false, false, null ) ) ) {
		wp_send_json_error( __( 'Could not install addon. Please download from wpforms.com and install manually.', 'wpforms' ) );
	}
	if ( ! WP_Filesystem( $creds ) ) {
		wp_send_json_error( __( 'Could not install addon. Please download from wpforms.com and install manually.', 'wpforms' ) );
	}

	// We do not need any extra credentials if we have gotten this far, so let's install the plugin.
	require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
	require_once WPFORMS_PLUGIN_DIR . 'includes/admin/class-install-skin.php';

	// Create the plugin upgrader with our custom skin.
	$installer = new Plugin_Upgrader( $skin = new WPForms_Install_Skin() );
	$installer->install( $download_url );

	// Flush the cache and return the newly installed plugin basename.
	wp_cache_flush();

	if ( $installer->plugin_info() ) {

		$plugin_basename = $installer->plugin_info();

		wp_send_json_success( array(
			'msg'      => __( 'Addon installed.', 'wpforms' ),
			'basename' => $plugin_basename
		) );
	}

	wp_send_json_error( __( 'Could not install addon. Please download from wpforms.com and install manually.', 'wpforms' ) );
}
add_action( 'wp_ajax_wpforms_install_addon', 'wpforms_install_addon' );

/**
 * Toggle entry stars from Entries table.
 *
 * @since 1.1.6
 */
function wpforms_entry_list_star() {

	// Run a security check
	check_ajax_referer( 'wpforms-entries-list', 'nonce' );

	// Check for permissions
	if ( !current_user_can( apply_filters( 'wpforms_manage_cap', 'manage_options' ) ) ) {
		wp_send_json_error();
	}

	if ( empty( $_POST['entry_id'] ) || empty( $_POST['task'] ) ) {
		wp_send_json_error();
	}

	$task     = $_POST['task'];
	$entry_id = absint( $_POST['entry_id'] );

	if ( 'star' == $task ) {
		wpforms()->entry->update( $entry_id, array( 'starred' => '1' ) );
	} elseif ( 'unstar' == $task ) {
		wpforms()->entry->update( $entry_id, array( 'starred' => '0' ) );
	}
	wp_send_json_success();
}
add_action( 'wp_ajax_wpforms_entry_list_star', 'wpforms_entry_list_star' );

/**
 * Toggle entry read state from Entries table.
 *
 * @since 1.1.6
 */
function wpforms_entry_list_read() {

	// Run a security check
	check_ajax_referer( 'wpforms-entries-list', 'nonce' );

	// Check for permissions
	if ( !current_user_can( apply_filters( 'wpforms_manage_cap', 'manage_options' ) ) ) {
		wp_send_json_error();
	}

	if ( empty( $_POST['entry_id'] ) || empty( $_POST['task'] ) ) {
		wp_send_json_error();
	}

	$task     = $_POST['task'];
	$entry_id = absint( $_POST['entry_id'] );

	if ( 'read' == $task ) {
		wpforms()->entry->update( $entry_id, array( 'viewed' => '1' ) );
	} elseif ( 'unread' == $task ) {
		wpforms()->entry->update( $entry_id, array( 'viewed' => '0' ) );
	}
	wp_send_json_success();
}
add_action( 'wp_ajax_wpforms_entry_list_read', 'wpforms_entry_list_read' );