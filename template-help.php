<?php

/**
 * how to help template
 * Template Name: Help
 * @package nonproflite
 */

// get custom intro text
$customText = get_theme_mod('custom_help_headings_setting');
$defaultText = 'All Dogs for Adoption';

get_header(); ?>

<!-- main content area -->
<section class='main-content-area'>

	<?php  /* start posts if */ if (have_posts()) :
		while /* start posts while */ (have_posts()) : the_post(); ?>

			<!-- feature image -->
			<?php get_template_part('inc/templates/feature'); ?>

			<!-- posts and content -->
			<div class='container-fluid'>

				<!-- menu -->
				<?php get_template_part('inc/templates/menu'); ?>

				<!-- content -->
				<?php get_template_part('inc/templates/content-no-image'); ?>

				<!-- end posts while -->
			<?php endwhile;

		else : ?>

			<!-- no content -->
			<?php get_template_part('templates/content', 'none'); ?>

			<!-- end posts if -->
		<?php endif; ?>

		<!-- all dogs -->
		<?php
		$args = array(
			'orderby' => 'date',
			'order' => 'ASC',
			'post_type' => 'dog',
			'posts_per_page' => -1
		);
		$allDogs = new WP_Query($args);
		?>

		<!-- all dogs title -->
		<div class="row justify-content-center mt-3">
			<div class="col-12">
				<header>
					<?php if ($customText == "") : echo '<h2>' . $defaultText . '</h2>';
					else :
						echo '<h2>' . $customText . '</h2>';
					endif;
					?>
				</header>
			</div>
		</div> <!-- row -->

		<!-- post content -->
		<div class="row">

			<?php /* start dogs if */ if ($allDogs->have_posts()) : ?>
				<?php /* start dogs count */ $dogNum = 1; ?>
				<?php /* start dogs while */ while ($allDogs->have_posts()) : $allDogs->the_post(); ?>
					<?php /* start dogs image if */ if (has_post_thumbnail()) : ?>

						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
							<div class="card">
								<div class="tile">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail('medium_large', ['class' => 'img-fluid', 'alt' => 'image from dog post type']) ?>
										<div class="tile-colour"></div>
									</a>
								</div>
								<div class="card-body">
									<h4 class="card-title"><?php the_title(); ?></h4>

									<!-- excerpt -->
									<?php the_excerpt(); ?>
								</div>
								<div class="card-footer">
									<button class="button cardButton"><a href="<?php the_permalink(); ?>">Find out more...</a></button>
									<p class="card-text"><small class="text-muted">Dog listed at: <?php the_date('F j, Y'); ?><?php the_time('g:i a'); ?></small></p>
								</div> <!-- card-footer -->
							</div>
						</div>

					<?php /* else */ else : ?>

						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title"><?php the_title(); ?></h4>

									<!-- excerpt -->
									<?php the_excerpt(); ?>
								</div>
								<div class="card-footer">
									<button class="button cardButton"><a href="<?php the_permalink(); ?>">Find out more...</a></button>
									<p class="card-text"><small class="text-muted">Dog listed at: <?php the_date('F j, Y'); ?><?php the_time('g:i a'); ?></small></p>
								</div> <!-- card-footer -->
							</div>
						</div>

					<?php /* end dogs image if */ endif; ?>
				<?php /* end dogs while */ endwhile; ?>
				<?php /* end dogs count */ $dogNum++; ?>
			<?php /* end dogs if */ endif; ?>

		</div> <!-- row -->

	</div> <!-- posts and content -->

</section> <!-- main content-area -->

<?php get_footer(); ?>