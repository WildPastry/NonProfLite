<?php
/**
 * index
 * @package nonproflite
 */

// get custom intro text
$customText = get_theme_mod('custom_intro_setting');
$defaultText = 'Welcome to CHCH Bull Breed Rescue';

get_header(); ?>

<!-- feature slideshow -->
<div class="container-fluid-feature">

	<div id="homePageSlider" class="carousel slide carousel-fade" data-ride="carousel">

		<!-- slideshow indicators -->
		<ol id="indicators" class="carousel-indicators">
			<li data-target="#homePageSlider" data-slide-to="0" class="active"></li>
			<li data-target="#homePageSlider" data-slide-to="1"></li>
			<li data-target="#homePageSlider" data-slide-to="2"></li>
		</ol>

		<!-- inner slideshow loop -->
		<div class="carousel-inner fullImgWrap">

			<?php
			$default_slide = get_template_directory_uri() . '/assets/img/default-slide.jpg';

			// theme mod loop
			for ($i = 1; $i < 4; $i++) {
				$all_slides = array(
					$featured_slide = get_theme_mod('featured_slide_' . $i . '_setting'),
				);
				if ($featured_slide == "") : $featured_slide = $default_slide;
				endif;

				// display loop
				if ($i == 1) {
					echo '<div class="carousel-item active fullImg embed-responsive-item" style="background-image: url(' . $featured_slide . ');background-position: center; background-size: cover; background-repeat: no-repeat;"></div>';
				} else {
					echo '<div class="carousel-item fullImg embed-responsive-item" style="background-image: url(' . $featured_slide . ');background-position: center; background-size: cover; background-repeat: no-repeat;"></div>';
				}
			}
			?>

		</div> <!-- inner slideshow -->

		<!-- slideshow controls -->
		<a class="carousel-control-prev" href="#homePageSlider" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#homePageSlider" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>

</div> <!-- feature slideshow -->

<!-- menu -->
<?php get_template_part('inc/templates/menu'); ?>

<!-- posts and content -->
<div class='container-fluid'>

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

	<!-- post content -->
	<div class="row">
		<?php /* start posts if */ if (have_posts()) : ?>
			<?php /* start posts while */ while (have_posts()) : the_post() ?>
				<!-- get content -->
				<?php get_template_part('inc/templates/content', get_post_format()); ?>
			<?php /* end posts if */ endwhile; ?>
		<?php  /* end posts while */ endif; ?>
	</div> <!-- row -->

	<!-- featured dogs -->
	<?php
	$args = array(
		'orderby' => 'title',
		'order' => 'ASC',
		'post_type' => 'dog',
	);
	$allDogs = new WP_Query($args);
	?>

	<!-- featured dogs title -->
	<div class="row mt-3">
		<div class="col-12">
			<h2>Latest dogs for adoption</h2>
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
								<?php the_post_thumbnail('medium_large', ['class' => 'card-img-top img-fluid', 'alt' => 'image from dog post type']) ?>
							</a>
							<div class="card-header">
								<?php the_title(); ?>
							</div>
							<div class="card-body">
								<?php the_excerpt(); ?>
							</div>
						</div>
					</div>

				<?php /* else */ else : ?>

					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 mb-3">
						<div class="card">
							<div class="card-header">
								<?php the_title(); ?>
							</div>
							<div class="card-body">
								<?php the_excerpt(); ?>
							</div>
						</div>
					</div>

				<?php /* end dogs image if */ endif; ?>
			<?php /* end dogs while */ endwhile; ?>
			<?php /* end dogs count */ $dogNum++; ?>
		<?php /* end dogs if */ endif; ?>

	</div> <!-- row -->

</div> <!-- container-fluid -->

<?php get_footer(); ?>