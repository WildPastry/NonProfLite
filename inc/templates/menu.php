<?php
/**
 * menu
 * @package nonproflite
 */

?>

<!-- menu -->
<?php /* start menu if */ if (has_nav_menu( 'menu_module' )) :

	wp_nav_menu(array(
		'theme_location' => 'menu_module',
		'depth' => 2,
		'container' => 'div',
		'container_class' => 'menuModuleWrap',
		'container_id' => 'menuModuleWrap',
		'menu_class' => 'menuModule',
	));

else : ?>

	<div class="row menuWarningWrap">
		<div class="col-12">
			<h4 class="menuWarning">This is where the menu will appear once you have created it</h4>
		</div>
	</div> <!-- menuWarningWrap -->

<?php /* end menu if */ endif; ?>