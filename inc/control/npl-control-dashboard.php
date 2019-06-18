<?php
/**
 * dashboard control
 * @package nonproflite
 */

// disable default dashboard widgets –––––––––––––––––––––––––––––––––––––
function disable_default_dashboard_widgets()
{
	global $wp_meta_boxes;
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	//   unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	//   unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
}
add_action('wp_dashboard_setup', 'disable_default_dashboard_widgets', 999);
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

// disable default dashboard menu items ––––––––––––––––––––––––––––––––––
function edit_admin_menu()
{
	// Dashboard
	// First Separator ––––––––––––––––––––––––––––––––––––––––––––––––––
	// remove_menu_page('edit.php?post_type=page'); // Pages
	// remove_menu_page('edit.php'); // Posts
	// remove_menu_page('edit.php?post_type=custom'); //Custom Post Type
	// remove_menu_page('upload.php'); // Media
	// remove_menu_page('link-manager.php'); // Links
	remove_menu_page('edit-comments.php'); // Comments
	// Second Separator ––––––––––––––––––––––––––––––––––––––––––––––––––
	// remove_menu_page('themes.php'); // Appearance
	// remove_menu_page('plugins.php'); // Plugins
	// remove_menu_page('users.php'); // Users
	// remove_menu_page('tools.php'); // Tools
	// remove_menu_page('options-general.php'); // Settings
	// Last Separator ––––––––––––––––––––––––––––––––––––––––––––––––––––
}
add_action('admin_menu', 'edit_admin_menu');
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

// re-order dashboard menu items –––––––––––––––––––––––––––––––––––––––––
function custom_menu_order($menu_ord)
{
	if (!$menu_ord) return true;

	return array(
		'index.php', // Dashboard
		'separator1', // First Separator
		// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
		'edit.php?post_type=page', // Pages
		'edit.php', // Posts
		'edit.php?post_type=dog', // Custom Post Type
		'upload.php', // Media
		// 'link-manager.php', // Links
		// 'edit-comments.php', // Comments
		'separator2', // Second Separator
		// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
		'themes.php', // Appearance
		'plugins.php', // Plugins
		'users.php', // Users
		'tools.php', // Tools
		'options-general.php', // Settings
		'separator-last', // Last Separator
		// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	);
}
add_filter('custom_menu_order', 'custom_menu_order');
add_filter('menu_order', 'custom_menu_order');
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

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

// rename dashboard menu items –––––––––––––––––––––––––––––––––––––––––––
// function edit_admin_menus() {
//   global $menu;
//   global $submenu;

//   $menu[5][0] = 'Recipes'; // Change Posts to Recipes
//   $submenu['edit.php'][5][0] = 'All Recipes';
//   $submenu['edit.php'][10][0] = 'Add a Recipe';
//   $submenu['edit.php'][15][0] = 'Meal Types'; // Rename categories to meal types
//   $submenu['edit.php'][16][0] = 'Ingredients'; // Rename tags to ingredients
// }
// add_action( 'admin_menu', 'edit_admin_menus' );
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
