<?php
/**
 * front page
 * @package nonproflite
 */

// get custom intro text
$customText = get_theme_mod('custom_intro_setting');
$customTextOne = get_theme_mod('custom_frontOne_headings_setting');
$customTextTwo = get_theme_mod('custom_frontTwo_headings_setting');
$defaultText = 'Welcome to CHCH Bull Breed Rescue';
$defaultTextOne = 'Latest News';
$defaultTextTwo = 'Latest Dogs for Adoption';

get_header(); ?>

<!-- slideshow -->
<?php get_template_part('inc/templates/slideshow'); ?>

<!-- posts and content -->
<div class='container-fluid'>

	<!-- menu -->
	<?php get_template_part('inc/templates/menu'); ?>

	<!-- custom greeting -->
	<div class="row">
		<div class="col-12">
			<?php if ($customText == "") : echo '<h1>' . $defaultText . '</h1>';
			else :
				echo '<h1>' . $customText . '</h1>';
			endif;
			?>
		</div>
	</div> <!-- row -->

</div> <!-- posts and content -->

<!-- posts and content -->
<div class='container-fluid'>

	<!-- home page content -->
	<div class="row justify-content-center">
		<?php /* start posts if */ if (have_posts()) : ?>
			<?php /* start posts while */ while (have_posts()) : the_post() ?>

				<!-- get content -->
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
					<article class="two-column">
						<?php the_content(); ?>
					</article>
				</div>

			<?php /* end posts if */ endwhile; ?>
		<?php  /* end posts while */ endif; ?>
	</div> <!-- row -->

</div> <!-- posts and content -->

<!-- feature section -->
<div class="container-fluid-feature container-background">

	<!-- posts and content -->
	<div class='container-fluid'>

		<!-- latest news -->
		<?php
		$args = array(
			'orderby' => 'date',
			'order' => 'ASC',
			'post_type' => 'post',
			'posts_per_page' => 2
		);
		$allNews = new WP_Query($args);
		?>

		<!-- latest news title -->
		<div class="row mt-3">
			<div class="col-12">
			<?php if ($customTextOne == "") : echo '<h2>' . $defaultTextOne . '</h2>';
			else :
				echo '<h2>' . $customTextOne . '</h2>';
			endif;
			?>
			</div>
		</div> <!-- row -->

		<!-- post content -->
		<div class="row">

			<?php /* start news if */ if ($allNews->have_posts()) : ?>
				<?php /* start news count */ $newsNum = 1; ?>
				<?php /* start news while */ while ($allNews->have_posts()) : $allNews->the_post(); ?>
					<?php /* start news image if */ if (has_post_thumbnail()) : ?>

						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<div class="card">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('medium_large', ['class' => 'img-fluid', 'alt' => 'image from dog post type']) ?>
								</a>
								<div class="card-body">
									<h4 class="card-title"><?php the_title(); ?></h4>

									<!-- excerpt -->
									<?php the_excerpt(); ?>
								</div>
								<div class="card-footer">
									<button class="button cardButton"><a href="<?php the_permalink(); ?>">Find out more...</a></button>
									<p class="card-text"><small class="text-muted">News posted at: <?php the_date('F j, Y'); ?><?php the_time('g:i a'); ?></small></p>
								</div> <!-- card-footer -->
							</div>
						</div>

					<?php /* else */ else : ?>

						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title"><?php the_title(); ?></h4>

									<!-- excerpt -->
									<?php the_excerpt(); ?>
								</div>
								<div class="card-footer">
									<button class="button cardButton"><a href="<?php the_permalink(); ?>">Find out more...</a></button>
									<p class="card-text"><small class="text-muted">News posted at: <?php the_date('F j, Y'); ?><?php the_time('g:i a'); ?></small></p>
								</div> <!-- card-footer -->
							</div>
						</div>

					<?php /* end news image if */ endif; ?>
				<?php /* end news while */ endwhile; ?>
				<?php /* end news count */ $newsNum++; ?>
			<?php /* end news if */ endif; ?>

		</div> <!-- row -->

	</div> <!-- container-fluid -->

</div> <!-- feature section -->

<!-- posts and content -->
<div class='container-fluid'>

	<!-- featured dogs -->
	<?php
	$args = array(
		'orderby' => 'date',
		'order' => 'ASC',
		'post_type' => 'dog',
		'posts_per_page' => 3
	);
	$allDogs = new WP_Query($args);
	?>

	<!-- featured dogs title -->
	<div class="row mt-3">
		<div class="col-12">
		<?php if ($customTextTwo == "") : echo '<h2>' . $defaultTextTwo . '</h2>';
			else :
				echo '<h2>' . $customTextTwo . '</h2>';
			endif;
			?>
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
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('medium_large', ['class' => 'img-fluid', 'alt' => 'image from dog post type']) ?>
							</a>
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

</div> <!-- container-fluid -->

<?php get_footer(); ?>