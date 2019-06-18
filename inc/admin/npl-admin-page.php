<?php
/**
 * admin page
 * @package nonproflite
 */
?>

<form method="post" action="">
  <?php settings_fields('nonproflite_settings_group'); ?>

  <?php do_settings_sections('nonproflite_page'); ?>

  <?php submit_button(); ?>

</form>