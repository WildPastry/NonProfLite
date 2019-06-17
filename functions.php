<?php
/**
 * functions
 * @package nonproflite
 */

// customiser ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
require get_template_directory() . '/inc/npl-customiser.php';
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

// enqueue css & scripts –––––––––––––––––––––––––––––––––––––––––––––––––
require get_template_directory() . '/inc/npl-enqueue-files.php';
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

// admin –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
// require get_template_directory() . '/inc/admin/theme-support.php';
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
// misc functions
require get_template_directory() . '/inc/functions/npl-function-misc.php';
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

// theme support –––––––––––––––––––––––––––––––––––––––––––––––––––––––––
require get_template_directory() . '/inc/npl-theme-support.php';
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
