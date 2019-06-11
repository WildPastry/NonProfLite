<?php
/**
 * enqueue files
 * @package nonproflite
 */

function enqueue_files()
{
  // css
//   fira sans
  wp_enqueue_style('nonproflite_fonts', get_template_directory_uri() . 'https://fonts.googleapis.com/css?family=Fira+Sans:300,400,700&display=swap', array(), '1.0');
//   merriweather
// 'https://fonts.googleapis.com/css?family=Merriweather:300,400,700&display=swap'

//   quicksand
// 'https://fonts.googleapis.com/css?family=Quicksand:300,400,700&display=swap'


//   wp_enqueue_style('nonproflite_bootstrap_css', get_template_directory_uri() . '/assets/css/vendor/bootstrap.css', array(), '4.1.3');
  wp_enqueue_style('nonproflite_css', get_template_directory_uri() . '/assets/css/nonproflite.css', array(), '1.0');

  // js
//   wp_enqueue_script('nonproflite_jquery_js', get_template_directory_uri() . '/assets/js/vendor/jquery.min.js', array(), '3.3.1', true);
//   wp_enqueue_script('nonproflite_bootstrap_js', get_template_directory_uri() . '/assets/js/vendor/bootstrap.min.js', array(), '4.1.3', true);
//   wp_enqueue_script('nonproflite_popper_js', get_template_directory_uri() . '/assets/js/vendor/popper.min.js', array(), '1.0.0', true);
//   wp_enqueue_script('nonproflite_js', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_files');