<?php
/**
 * menu
 * @package nonproflite
 */
?>

<!-- menu -->
<?php
wp_nav_menu(array(
  'theme_location' => 'menu_module',
  'depth' => 2,
  'container' => 'div',
  'container_class' => 'menuModuleWrap',
  'container_id' => 'menuModuleWrap',
  'menu_class' => 'menuModule',
));
?>