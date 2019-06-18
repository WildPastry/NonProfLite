<?php
/**
 * page
 * @package nonproflite
 */

get_header(); ?>

	<!-- main content area -->
	<section class='main-content-area'>

			<?php  /* start posts if */ if (have_posts()) :
				while /* start posts while */ (have_posts()) : the_post();

					get_template_part('templates/content');

				/* end posts while */
				endwhile;

			else :

				get_template_part('templates/content', 'none');

			/* end posts if */
			endif; ?>

	</section> <!-- main content-area -->

<?php get_footer(); ?>