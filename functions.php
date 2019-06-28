<?php
/**
 * functions
 * @package nonproflite
 */

function the_mx_customizer_controls() {
	wp_enqueue_script( 'the-mx-customizer-controls', get_template_directory_uri() . 'assets/js/customize-controls.js', array( 'jquery' ), '1', true );
}
add_action( 'customize_controls_enqueue_scripts', 'the_mx_customizer_controls' );




// customiser ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
require get_template_directory() . '/inc/npl-customiser.php';
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

// enqueue css & scripts –––––––––––––––––––––––––––––––––––––––––––––––––
require get_template_directory() . '/inc/npl-enqueue-files.php';
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

// admin –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
// load admin menu
require get_template_directory() . '/inc/admin/npl-admin-menu.php';
// load admin styles
require get_template_directory() . '/inc/admin/npl-admin-styles.php';
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

// control –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
// greeting control
require get_template_directory() . '/inc/control/npl-control-greeting.php';
// dashboard control
require get_template_directory() . '/inc/control/npl-control-dashboard.php';
// sidebar control
require get_template_directory() . '/inc/control/npl-control-sidebar.php';
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

// functions –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
// custom fields
require get_template_directory() . '/inc/functions/npl-custom-fields.php';
// custom menu
require get_template_directory() . '/inc/functions/npl-custom-menu.php';
// custom post types
require get_template_directory() . '/inc/functions/npl-custom-post-types.php';
// misc functions
require get_template_directory() . '/inc/functions/npl-misc-functions.php';
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

// theme support –––––––––––––––––––––––––––––––––––––––––––––––––––––––––
require get_template_directory() . '/inc/npl-theme-support.php';
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

// plugin support ––––––––––––––––––––––––––––––––––––––––––––––––––––––––
// plugin activation
require_once get_template_directory() . '/inc/functions/plugins/class-tgm-plugin-activation.php';
// plugin function
require get_template_directory() . '/inc/functions/plugins/npl-plugins.php';
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

// woocommerce –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
require get_template_directory() . '/inc/functions/npl-woocommerce.php';
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––