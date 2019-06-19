<?php
/**
 * 404
 * @package nonproflite
 */

get_header(); ?>

<div class="container-fluid">

			<div class="row">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'nonproflite' ); ?></h1>

					<p><?php _e( 'It looks like nothing was found at this location.', 'nonproflite' ); ?></p>
					<?php get_search_form(); ?>
			</div> <!-- row -->

</div><!-- container -->

<?php get_footer(); ?>