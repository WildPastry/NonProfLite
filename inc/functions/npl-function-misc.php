<?php
/**
 * dashboard control
 * @package nonproflite
 */

// custom dashboard widget –––––––––––––––––––––––––––––––––––––––––––––––
function register_nonproflite_dash()
{
  wp_add_dashboard_widget(
    'nonproflite_dash',
    'Non-Prof Lite Dashboard',
    'nonproflite_dash_display'
  );
}

function nonproflite_dash_display()
{
  echo 'Welcome to Non-Prof Lite...';
}
add_action('wp_dashboard_setup', 'register_nonproflite_dash');
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

// word excerpts –––––––––––––––––––––––––––––––––––––––––––––––––––––––––
function wpdocs_custom_excerpt_length($length)
{
  return 25;
}
add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––