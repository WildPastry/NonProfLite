<?php
/**
 * custom menu
 * @package nonproflite
 */

// add custom menu –––––––––––––––––––––––––––––––––––––––––––––––––––––––
function register_my_menu()
{
    register_nav_menu('menu_module', __('Main Menu'));
}
add_action('init', 'register_my_menu');
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––