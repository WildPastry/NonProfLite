<?php
/**
 * admin menu
 * @package nonproflite
 */

// create the admin page
function nonproflite_create_page()
{
	require_once get_template_directory() . '/inc/admin/npl-admin-page.php';
}
add_action('admin_menu', 'nonproflite_add_admin_page');

// add menu to admin page
function nonproflite_add_admin_page()
{
	add_menu_page(
		'Map Options', //title tag of the menu page
		'Map', //title of the menu in the panel
		'manage_options', //capability of menu
		'npl_map_page', //the menu page's slug name
		'nonproflite_create_page', //callback to output this menu's content
		'dashicons-admin-site-alt2' //custom icon for the menu
	);

	add_action('admin_init', 'nonproflite_theme_settings');
}

// settings for menu
function nonproflite_theme_settings()
{
	register_setting('nonproflite_settings_group', 'mapKeyInput');

	// section
	add_settings_section(
		'npl_map_options_section', //the section slug name
		'Google Map Options', //section title visible on the page
		'npl_map_options_section', //callback for section content
		'npl_map_page' //slug name of page where section is added
	);

	// key
	add_settings_field(
		'key_value', //the field's slug name
		'Map Key', //the field's title visible on the page
		'npl_key_value', //callback for the field's content
		'npl_map_page', //page to which the field will be added
		'npl_map_options_section' //section id for parent section
	);

	// location
	add_settings_field(
		'location_value', //the field's slug name
		'Location', //the field's title visible on the page
		'npl_location_value', //callback for the field's content
		'npl_map_page', //page to which the field will be added
		'npl_map_options_section' //section id for parent section
	);
}

// sub title for options
function npl_map_options_section()
{
	echo 'Configure your map options';
}

// call map key settings
function npl_key_value()
{
	// get value
	if (isset($_POST['mapKeyInput'])) {
		$map_key = $_POST['mapKeyInput'];
		update_option('mapKeyInput', $map_key);
	}

	// check value
	$map_key = get_option('mapKeyInput');
	if (FALSE === $map_key) {
		$map_key = '';
	}

	// output value
	echo '<input type="textarea" name="mapKeyInput" id="mapKeyInput" placeholder="Enter key here..." value="' . $map_key . '"/>';
}

// call map location settings
function npl_location_value()
{
	// get map location value
	if (isset($_POST['locationInput'])) {
		$map_location = $_POST['locationInput'];
		update_option('locationInput', $map_location);
	}

	// check map location value
	$map_location = get_option('locationInput');
	if (FALSE === $map_location) {
		$map_location = '';
	}

	// get lat value
	if (isset($_POST['latValue'])) {
		$latValue = $_POST['latValue'];
		update_option('latValue', $latValue);
	}

	// check lat value
	$latValue = get_option('latValue');
	if (FALSE === $latValue) {
		$latValue = -43.5321;
	}

	// get lng value
	if (isset($_POST['lngValue'])) {
		$lngValue = $_POST['lngValue'];
		update_option('lngValue', $lngValue);
	}

	// check lng value
	$lngValue = get_option('lngValue');
	if (FALSE === $lngValue) {
		$lngValue = 172.6362;
	}

	// output value
	echo '<input type="textarea" autocomplete="off" name="locationInput" id="locationInput" placeholder="Enter location here..." value="' . $map_location . '"/>' . '<br>';

	// lat field
	echo '<input hidden type="textarea" name="latValue" id="latValue" value="' . $latValue . '"/>';

	// lng field
	echo '<input hidden type="textarea" name="lngValue" id="lngValue" value="' . $lngValue . '"/>';

}