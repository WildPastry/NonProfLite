<?php
/**
 * enqueue files
 * @package nonproflite
 */

function enqueue_files()
{
	// map ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// get page template
	$pageTemplate = get_page_template_slug();

	// map key info
	$map_key = get_option('mapKeyInput');
	$gmaps = 'https://maps.googleapis.com/maps/api/js?key=' . $map_key . '&callback=initMap#asyncload';

	// christchurch lat lng
	$latInput = -43.5321;
	$lngInput = 172.6362;

	// load map script
	if ($pageTemplate === 'template-contact.php') {
		wp_enqueue_script('nonproflite_map_key', $gmaps, array(), '1.0', true);
	}
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// css
	// fonts ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// fira sans
	wp_enqueue_style('nonproflite_fira_font', 'https://fonts.googleapis.com/css?family=Fira+Sans:300,400,700&display=swap', array(), '1.0');

	// merriweather
	wp_enqueue_style('nonproflite_merriweather_font', 'https://fonts.googleapis.com/css?family=Merriweather:300,400,700&display=swap', array(), '1.0');

	// quicksand
	wp_enqueue_style('nonproflite_quicksand_font', 'https://fonts.googleapis.com/css?family=Quicksand:300,400,700&display=swap', array(), '1.0');
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// vendor –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// bootstrap
	wp_enqueue_style('nonproflite_bootstrap_css', get_template_directory_uri() . '/assets/css/vendor/bootstrap.min.css', array(), '4.1.3');
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// custom –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// nonproflite
	wp_enqueue_style('nonproflite_css', get_template_directory_uri() . '/assets/css/nonproflite.css', array(), '1.0');
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// js
	// vendor –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// jquery
	wp_enqueue_script('nonproflite_jquery_js', get_template_directory_uri() . '/assets/js/vendor/jquery.min.js', array(), '3.3.1', true);

	// bootstrap
	wp_enqueue_script('nonproflite_bootstrap_js', get_template_directory_uri() . '/assets/js/vendor/bootstrap.min.js', array(), '4.1.3', true);

	// popper
	wp_enqueue_script('nonproflite_popper_js', get_template_directory_uri() . '/assets/js/vendor/popper.min.js', array(), '1.0.0', true);
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// custom –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// nonproflite
	wp_enqueue_script('nonproflite_js', get_template_directory_uri() . '/assets/js/nonproflite.js', array(), '1.0', true);

	// nonproflite admin
	wp_enqueue_script('nonproflite_admin_js', get_template_directory_uri() . '/assets/js/nonproflite-admin.js', array(), '1.0', true);
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// map script addons ––––––––––––––––––––––––––––––––––––––––––––––––––––
	wp_enqueue_script('nonproflite_map_js', get_template_directory_uri() . '/assets/js/nonproflite-map.js', array(), '1.0', true);

	// localize javascript
	wp_localize_script('nonproflite_map_js', 'latLngInput', array(
		'latInput' => $latInput,
		'lngInput' => $lngInput
	));

	// async load
	add_filter('clean_url', 'ikreativ_async_scripts', 11, 1);
	function ikreativ_async_scripts($url)
	{
		if (strpos($url, '#asyncload') === false) {
			return $url;
		} elseif (is_admin()) {
			return str_replace('#asyncload', '', $url);
		} else {
			return str_replace('#asyncload', '', $url) . "' async='async";
		}
	}
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

}
add_action('wp_enqueue_scripts', 'enqueue_files');
