<?php
/**
 * checkout template
 * Template Name: Checkout
 * @package nonproflite
 */

get_header(); ?>

<!-- main content area -->
<section class='main-content-area'>

	<?php  /* start posts if */ if (have_posts()) :
		while /* start posts while */ (have_posts()) : the_post(); ?>

			<!-- posts and content -->
			<div class='container-fluid'>

				<!-- menu -->
				<?php get_template_part('inc/templates/menu'); ?>

				<!-- title -->
				<div class="col-12">
					<header>
						<h1><?php the_title(); ?></h1>
					</header>
				</div>

				<!-- content -->
				<div class="wooWrap">
					<?php the_content(); ?>
				</div>

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