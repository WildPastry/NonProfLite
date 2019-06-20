<?php
/**
 * single-dog
 * @package nonproflite
 */

// get feature image
$defaultImg = get_template_directory_uri() . '/assets/img/default-feature.jpg';
$featureImg = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

get_header(); ?>

<!-- main content area -->
<section class='main-content-area'>

	<?php  /* start posts if */ if (have_posts()) :
		while /* start posts while */ (have_posts()) : the_post(); ?>

			<!-- feature image -->
			<div class="container-fluid-feature">

				<!-- feature image -->
				<div class="fullImgWrap">
					<?php /* start feature if */ if (has_post_thumbnail()) : ?>
						<?php echo '<div class="fullImg" style="background-image: url(' . $featureImg . ');background-position: center; background-size: cover;  background-repeat: no-repeat;"></div>';
					else :
						echo '<div class="fullImg" style="background-image: url(' . $defaultImg . ');background-position: center; background-size: cover;  background-repeat: no-repeat;"></div>';
						?>
					<?php /* end feature if */ endif; ?>
				</div> <!-- feature image -->

			</div> <!-- feature image -->

			<!-- posts and content -->
			<div class='container-fluid'>

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

	</div> <!-- container-fluid -->

</section> <!-- main content-area -->

<?php get_footer(); ?>