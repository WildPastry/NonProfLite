<?php
/**
 * misc functions
 * @package nonproflite
 */

// word excerpts –––––––––––––––––––––––––––––––––––––––––––––––––––––––––
function wpdocs_custom_excerpt_length($length)
{
  return 25;
}
add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––