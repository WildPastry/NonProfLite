<?php
/**
 * custom post types
 * @package nonproflite
 */

// dog post type ––––––––––––––––––––––––––––––––––––––––––––––––––––––––
function add_dog_post_type()
{
	$labels = array(
		'name'               => _x('dogs', 'post type general name', 'nonproflite'),
		'singular_name'      => _x('dog', 'post type singular name', 'nonproflite'),
		'menu_name'          => _x('Dogs', 'admin menu', 'nonproflite'),
		'name_admin_bar'     => _x('Dog', 'add new on admin bar', 'nonproflite'),
		'add_new'            => _x('Add New', 'dog', 'nonproflite'),
		'add_new_item'       => __('Add New Dog', 'nonproflite'),
		'new_item'           => __('New Dog', 'nonproflite'),
		'edit_item'          => __('Edit Dog', 'nonproflite'),
		'view_item'          => __('View Dog', 'nonproflite'),
		'all_items'          => __('All Dogs', 'nonproflite'),
		'search_items'       => __('Search Dogs', 'nonproflite'),
		'parent_item_colon'  => __('Parent Dogs:', 'nonproflite'),
		'not_found'          => __('No Dogs found.', 'nonproflite'),
		'not_found_in_trash' => __('No Dogs found in Trash.', 'nonproflite')
	);

	$args = array(
		'labels' => $labels,
		'description' => 'All of our dogs ready to be adopted',
		'public' => true,
		'show_in_nav_menus' => false,
		'show_in_menu' => true,
		'show_in_rest' => true,
		'menu_icon' => 'data:image/svg+xml;base64,' . base64_encode('<svg width="20" height="20" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12.23 18.51"><title>dog-post-type</title><path fill="black" d="M11.31,1.13a8.13,8.13,0,0,0,.39,1c.2.36.63.26,1,.38.62.2.59.44,1.35.47a15.11,15.11,0,0,1,1.51.09c.56.11.68.55.42,1a2.79,2.79,0,0,1-1.5,1.08c-.52.15-1.33,0-1.33.78s.53,1.43.62,2.21a7.1,7.1,0,0,1-.57,3.55c-.36.94-.79,6.07,0,6.59a1,1,0,0,1,.34.29.75.75,0,0,1,.09.35c0,.08,0,.09-.36.09A11.92,11.92,0,0,1,12,19c-.35,0-.38-.12-.44-.45-.2-1.2-.35-2.41-.55-3.61-.07-.4-.08-.39-.23-.26s-1,.51-1.06.58a2.68,2.68,0,0,0,0,.44C9.52,16.52,8.21,17.51,8,18s2-.31,1.9.92c0,.12,0,.17-.84.19s-2.43,0-3.32,0-1.07-.21-1.22-.45c-.82-1.29-.76-3.7-.5-5.12.36-2,2-3.33,3.37-4.71,2.18-2.27,2.21-3.09,2.75-6,.1-.53.47-3.31,1.13-1.6Z" transform="translate(-3.89 -0.58)"/></svg>'),
		'supports' => array('title', 'thumbnail', 'excerpts', 'editor')
	);

	register_post_type('dog', $args);
}
add_action('init', 'add_dog_post_type');
// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

// enquiries post type ––––––––––––––––––––––––––––––––––––––––––––––––––
function add_enquiries_post_type()
{
	$labels = array(
		'name' => _x('Enquiries', 'post type name', 'nonproflite'),
		'singular_name' => _x('Enquiry', 'post types singluar name', 'nonproflite')
	);
	$args = array(
		'labels' => $labels,
		'description' => 'Enquiries from the contact and donate form',
		'public' => true,
		'query_var' => true,
		'menu_icon' => 'dashicons-email-alt',
		'supports' => array(
			'title',
			'editor'
		)
		// 'capabilities' => array(
		// 	'create_posts' => false
		// )
	);
	register_post_type('enquiries', $args);
}
add_action('init', 'add_enquiries_post_type');
// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
