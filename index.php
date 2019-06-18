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
		<div class="carousel-inner fullImageWrap">

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
					echo '<div class="carousel-item active fullImage embed-responsive-item" style="background-image: url(' . $featured_slide . ');background-position: center; background-size: cover; background-repeat: no-repeat;"></div>';
				} else {
					echo '<div class="carousel-item fullImage embed-responsive-item" style="background-image: url(' . $featured_slide . ');background-position: center; background-size: cover; background-repeat: no-repeat;"></div>';
				}
			}
			?>

		</div><!-- inner slideshow -->

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

</div><!-- feature slideshow -->

<div class='container-fluid'>

	<div class="row">
		<?php if ($customText == "") : echo '<h1>' . $defaultText . '</h1>';
		else :
			echo '<h1>' . $customText . '</h1>';
		endif;
		?>
	</div> <!-- row -->

	<div class="row">
		<p>Non-Prof Lite is a user-friendly and free WordPress theme. It is a simple, clean and professional theme that is best suited for Charity, NGO, foundations, churches, political organizations etc. It is very easy to setup and it comes with all the basic features that is needed to create your own website.</p>
	</div> <!-- row -->

</div> <!-- container-fluid -->

<?php get_footer(); ?>