<?php
/**
 * functions
 * @package nonproflite
 */

// enqueue css & scripts –––––––––––––––––––––––––––––––––––––––––––––––––
require get_template_directory() . '/inc/npl-enqueue-files.php';
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

// control –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
// greeting control
require get_template_directory() . '/inc/control/npl-greeting-control.php';
// dashboard control
require get_template_directory() . '/inc/control/npl-dashboard-control.php';
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

// theme support –––––––––––––––––––––––––––––––––––––––––––––––––––––––––
// require get_template_directory() . '/inc/theme-support.php';
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

// customiser ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
require get_template_directory() . '/inc/npl-customiser.php';
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

// misc functions ––––––––––––––––––––––––––––––––––––––––––––––––––––––––
require get_template_directory() . '/inc/npl-misc-functions.php';
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
