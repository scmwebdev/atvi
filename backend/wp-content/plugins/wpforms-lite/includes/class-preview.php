<?php
/**
 * Preview class.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.1.5
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
*/
class WPForms_Preview {

	/**
	 * Primary class constructor.
	 *
	 * @since 1.1.5
	 */
	public function __construct() {

		// Maybe load a preview page
		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Determing if the user should see a preview page, if so, party on.
	 *
	 * @since 1.1.5
	 */
	public function init() {

		// Check for preview param with allowed values
		if ( empty( $_GET['wpforms_preview'] ) || !in_array( $_GET['wpforms_preview'], array( 'print' ) ) ) {
			return;
		}

		// Check for authenticated user with correct capabilities
		if ( !is_user_logged_in() || !current_user_can( apply_filters( 'wpforms_manage_cap', 'manage_options' ) ) ) {
			return;
		}

		// Only load if we are actually on the settings page
		if ( 'print' == $_GET['wpforms_preview'] && !empty( $_GET['entry_id'] ) ) {
			$this->print_preview();
		}
	}

	/**
	 * Preview page header.
	 *
	 * @since 1.1.5
	 */
	public function preview_header( $type = '', $title = '' ) {
		?>
		<!doctype html>
		<html>
		<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>WPForms <?php echo ucfirst( sanitize_text_field( $type ) ); ?> Preview - <?php echo ucfirst( sanitize_text_field( $title ) ); ?> </title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="robots" content="noindex,nofollow,noarchive">
		<link rel="stylesheet" href="<?php echo includes_url('css/buttons.min.css'); ?>" type="text/css">
		<link rel="stylesheet" href="<?php echo WPFORMS_PLUGIN_URL; ?>assets/css/wpforms-preview.css" type="text/css">
		<script type="text/javascript" src="<?php echo includes_url('js/jquery/jquery.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo WPFORMS_PLUGIN_URL; ?>assets/js/wpforms-preview.js"></script>
		</head>
		<body class="wp-core-ui">
			<div class="wpforms-preview" id="<?php echo sanitize_html_class( $type ); ?>">
		<?php
	}

	/**
	 * Preview page footer.
	 *
	 * @since 1.1.5
	 */
	public function preview_footer() {

		?>
			</div><!-- .wrap -->
			<p class="site"><a href="<?php echo home_url(); ?>"><?php echo get_bloginfo( 'name'); ?></a></p>
		</body><?php
	}

	/**
	 * Print Preview.
	 *
	 * @since 1.1.5
	 */
	public function print_preview() {

		// Load entry details
		$entry = wpforms()->entry->get( absint( $_GET['entry_id'] ) );

		// Double check that we found a real entry
		if ( ! $entry || empty( $entry ) ) {
			return;
		}

		// Get form details
		$form_data = wpforms()->form->get( $entry->form_id, array( 'content_only' => true ) );
		
		// Double check that we found a valid entry
		if ( ! $form_data || empty( $form_data ) ) {
			return;
		}
	
		$this->preview_header( 'print', $form_data['settings']['form_title'] );
		
		// Page header
		echo '<h1>';
			echo sanitize_text_field( $form_data['settings']['form_title'] );
			echo '<span> - ';
			printf( __( 'Entry #%d', 'wpforms' ), absint( $entry->entry_id ) ); 
			echo '</span>';

			echo '<div class="buttons">';
				echo '<a href="" class="button button-secondary close-window">Close</a>';
				echo '<a href="" class="button button-primary print">Print</a>';
			echo '</div>';
		echo '</h1>';

		$fields = apply_filters( 'wpforms_entry_single_data', wpforms_decode( $entry->fields ), $entry, $form_data );

		if ( empty( $fields ) ) {

			// Whoops, no fields! This shouldn't happen under normal use cases.
			echo '<p class="no-fields">' . __( 'This entry does not have any fields', 'wpforms' ) . '</p>';

		} else {

			echo '<div class="fields">';

			// Display the fields and their values
			foreach ( $fields as $key => $field ) {

				$field_value  = apply_filters( 'wpforms_html_field_value', wp_strip_all_tags( $field['value'] ), $field, $form_data );
				$field_class  = sanitize_html_class( 'wpforms-field-' . $field['type'] );
				$field_class .= empty( $field_value ) ? ' empty' : '';  

				echo '<div class="wpforms-entry-field ' . $field_class . '">';

					// Field name
					echo '<p class="wpforms-entry-field-name">';
						echo !empty( $field['name'] ) ? wp_strip_all_tags( $field['name'] ) : sprintf( __( 'Field ID #%d', 'wpforms' ), absint( $field['id'] ) );
					echo '</p>';

					// Field value
					echo '<p class="wpforms-entry-field-value">';
						echo !empty( $field_value ) ? nl2br( make_clickable( $field_value ) ) : __( 'Empty', 'wpforms' );
					echo '</p>';

				echo '</div>';
			}

			echo '</div>';
		}
		
		$this->preview_footer();

		exit();
	}
}
new WPForms_Preview;