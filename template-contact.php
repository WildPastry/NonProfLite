<?php
/**
 * contact template
 * Template Name: Contact
 * @package nonproflite
 */

// get thumbnail image
$defaultThumb = get_template_directory_uri() . '/assets/img/default-thumb.jpg';
$thumbnailImg = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

get_header(); ?>

<!-- main content area -->
<section class='main-content-area'>

	<?php  /* start posts if */ if (have_posts()) :
		while /* start posts while */ (have_posts()) : the_post(); ?>

			<!-- feature map -->
			<div class="container-fluid-feature">

				<!-- map -->
				<div class="fullImageWrap">
					<div id="map" class="map"></div>
				</div>

			</div> <!-- feature map -->

			<!-- menu -->
			<?php get_template_part('inc/templates/menu'); ?>

			<!-- content -->
			<?php get_template_part('inc/templates/content'); ?>

			<!-- end posts while -->
		<?php endwhile;

else : ?>

		<!-- no content -->
		<?php get_template_part('templates/content', 'none'); ?>

		<!-- end posts if -->
	<?php endif; ?>

</section> <!-- main content-area -->

<?php get_footer(); ?>