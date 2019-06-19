<?php
/**
 * theme support
 * @package nonproflite
 */

// add general theme support
function themename_add_theme_support()
{
	  add_theme_support('post-thumbnails');
	//   add_theme_support('wp-block-styles');
	//   add_theme_support('automatic-feed-links');
	//   add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
	//   add_theme_support('title-tag');
	// add_theme_support('custom-header');
	//   add_theme_support('customize-selective-refresh-widgets');
	//   add_theme_support('post-formats', array('video', 'audio', 'image'));
	$defaults = array(
		'flex-height' => true,
		'flex-width'  => true
	);
	add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'themename_add_theme_support');
