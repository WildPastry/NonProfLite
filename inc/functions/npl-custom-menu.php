<?php
/**
 * custom menu
 * @package nonproflite
 */

// ADD HEADER AND FOOTER MENUS
add_action('init', 'register_my_menu');
function register_my_menu()
{
    register_nav_menu('menu_module', __('Main Menu'));
}
