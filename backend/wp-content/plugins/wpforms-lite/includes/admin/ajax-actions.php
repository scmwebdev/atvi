<?php
/**
 * Ajax actions used in by admin.
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