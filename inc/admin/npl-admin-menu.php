<?php
/**
 * admin menu
 * @package nonproflite
 */

// create the admin page
function nonproflite_create_page()
{
    require_once get_template_directory() . '/inc/admin/npl-admin-page.php';
}
add_action('admin_menu', 'nonproflite_add_admin_page');

// add menu to admin page
function nonproflite_add_admin_page()
{
    add_menu_page('Map Options', 'Map', 'manage_options', 'nonproflite_page', 'nonproflite_create_page', 'dashicons-admin-site-alt2', 111);

    add_action('admin_init', 'nonproflite_theme_settings');
}

// settings for menu
function nonproflite_theme_settings()
{
    register_setting('nonproflite_settings_group', 'first_name');

    add_settings_section('nonproflite_sidebar_options', 'Google Map Key Options', 'nonproflite_sidebar_options', 'nonproflite_page');

    add_settings_field('sidebar-name', 'Key', 'nonproflite_sidebar_name', 'nonproflite_page', 'nonproflite_sidebar_options');

}

// create the sidebar
function nonproflite_sidebar_name()
{
    echo '<input type="text" name="key value="" placeholder="Enter key here..."/>';
}

// settings for sidebar
function nonproflite_sidebar_options()
{
    echo 'Add your map key to your site';
}
