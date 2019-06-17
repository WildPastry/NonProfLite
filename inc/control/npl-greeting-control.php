<?php
/**
 * greeting control
 * @package nonproflite
 */

// custom greeting
function wp_admin_bar_my_custom_account_menu($wp_admin_bar)
{
  $user_id = get_current_user_id();
  $current_user = wp_get_current_user();
  $profile_url = get_edit_profile_url($user_id);

  if (0 != $user_id) {

    // account menu items
    $avatar = get_avatar($user_id, 28);
    $greet = sprintf(__('Welcome, %1$s'), $current_user->display_name);
    $class = empty($avatar) ? '' : 'with-avatar';

    $wp_admin_bar->add_menu(array(
      'id' => 'my-account',
      'parent' => 'top-secondary',
      'title' => $greet . $avatar,
      'href' => $profile_url,
      'meta' => array(
        'class' => $class,
      ),
    ));
  }
}
add_action('admin_bar_menu', 'wp_admin_bar_my_custom_account_menu', 11);