<?php
/**
 * content-none
 * @package nonproflite
 */

?>

<div class="row row-404 d-flex align-items-center">
	<div class="col-12">
		<?php
		if (is_home() && current_user_can('publish_posts')) :

			printf(
				'<p>' . wp_kses(
					__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'nonproflite'),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url(admin_url('post-new.php'))
			);

		else :
			?>

			<p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for.', 'nonproflite'); ?></p>
		<?php

	endif;
	?>
	</div>
</div> <!-- row -->